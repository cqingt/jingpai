<?php
/**
 * 平台优惠劵Model
 *
 * 
 */
defined('InShopNC') or exit('Access Invalid!');
class store_voucherModel extends Model{
    const VOUCHER_STATE_UNUSED = 1;
    const VOUCHER_STATE_USED = 2;
    const VOUCHER_STATE_EXPIRE = 3;

    private $voucher_state_array = array(
        self::VOUCHER_STATE_UNUSED => '未使用',
        self::VOUCHER_STATE_USED => '已使用',
        self::VOUCHER_STATE_EXPIRE => '已过期',
    );

	/**
	 * 获得已领取优惠劵列表
	 */
	public function getVoucherList($where, $field = '*', $limit = 0, $page = 0, $order = '', $group = ''){
	    $voucher_list = array();
	    $voucher_list = $this->table('store_voucher')->field($field)->where($where)->page($page)->order($order)->group($group)->select();
	    return $voucher_list;
	}

    /**
     * 获得单个优惠券
     */
    public function getVoucherInfo($condition, $field = '*') {
        return $this->table('store_voucher')->field($field)->where($condition)->find();
    }

    /**
     * 更新平台优惠劵信息
     * @param array $data
     * @param array $condition
     */
    public function editVoucher($where,$data) {
        return $this->table('store_voucher')->where($where)->update($data);
    }

    /**
     * 返回代金券状态数组
     * @return array
     */
    public function getVoucherStateArray() {
        return $this->voucher_state_array;
    }

    /*
     * 返回可用优惠券
     */
    public function getPingtaiAvailableVoucherList($member_id,$store_cart_list,$store_goods_total){
        //获取用户可用优惠券
        $condition = array();
        $condition['voucher_owner_id'] = $member_id;
        $condition['voucher_state'] = 1;
        $condition['voucher_start_date'] = array('lt',TIMESTAMP);
        $condition['voucher_end_date'] = array('gt',TIMESTAMP);
        $list = $this->getVoucherList($condition);

        $can_used = array();
        if(empty($list) || !is_array($list)){
            return $can_used;
        }
        foreach($list as $k=>$v){
            if($v['voucher_store_id'] == '0'){
                //所有商家通用，只判断金额
                if($store_goods_total >= $v['voucher_limit']){
                    $can_used[] = $v;
                }

            }else{
                $can_use_store = explode(',',$v['voucher_store_id']);
                //计算优惠券可用店铺购物车总金额，判定是否大于优惠券最小可用金额
                $this_store_cart_list = $store_cart_list;
                $this_store_goods_total = 0;
                foreach($this_store_cart_list as $store_id=>$thisgoods){
                    if(in_array($store_id,$can_use_store)){
                        foreach($thisgoods as $key=>$val){
                            $this_store_goods_total += $val['goods_total'];
                        }
                    }
                }
                if($this_store_goods_total >= $v['voucher_limit']){
                    $can_used[] = $v;
                }
            }
        }
        return $can_used;

    }


    /*
     * 订单返回用户提交优惠券是否可用
     */
    public function rePingtaiAvailableVoucher($member_id,$input_pingtai_voucher,$store_cart_list,$store_goods_total){
        //获取用户可用优惠券
        $condition = array();
        $condition['voucher_owner_id'] = $member_id;
        $condition['voucher_id'] = $input_pingtai_voucher['voucher_id'];
        $condition['voucher_state'] = 1;
        $condition['voucher_start_date'] = array('lt',TIMESTAMP);
        $condition['voucher_end_date'] = array('gt',TIMESTAMP);
        $voucher_info = $this->getVoucherInfo($condition);

        if(!empty($voucher_info) && is_array($voucher_info)){
            $input_pingtai_voucher['voucher_code'] = $voucher_info['voucher_code'];
            $input_pingtai_voucher['voucher_owner_id'] = $member_id;

            //计算优惠券可用店铺购物车总金额，判定是否大于优惠券最小可用金额
            $this_store_goods_total = 0;
            $store_total = array();//每个店铺商品订单金额
            $store_goods_voucher = array();//每个店铺每个商品可优惠金额

            if($voucher_info['voucher_store_id'] == '0'){
                $can_use_store = 'all';
            }else{
                $can_use_store = explode(',',$voucher_info['voucher_store_id']);
            }

            foreach($store_cart_list as $store_id=>$thisgoods){
                if((is_array($can_use_store) && in_array($store_id,$can_use_store)) || $can_use_store == 'all'){
                    foreach($thisgoods as $key=>$val){
                        $this_store_goods_total += $val['goods_total'];
                        $store_goods_voucher[$store_id][$val['goods_id']]['goods_total'] = $val['goods_total'];
                        $store_total[$store_id]['goods_total'] += $val['goods_total'];
                    }
                }
            }


            //当可用优惠券的商品金额大于优惠券最小可用金额 此优惠券可用，计算每个店铺及每个商品应使用的优惠券金额
            if($this_store_goods_total >= $voucher_info['voucher_limit']){
                $diff_sum = 0;//因计算存在四舍五入可能与优惠券金额不符，所以计算出差值，将差值赋给最后一个可用优惠券商品中，保证优惠券使用金额与优惠券一致
                foreach($store_goods_voucher as $store_id=>$val){
                    foreach($val as $goods_id=>$value){
                        $store_goods_voucher[$store_id][$goods_id]['use_voucher_money'] = round(($value['goods_total'] * $voucher_info['voucher_price'] / $this_store_goods_total),2);//小数点后两位四舍五入

                        $store_total[$store_id]['use_voucher_money'] += $store_goods_voucher[$store_id][$goods_id]['use_voucher_money'];

                        if($value['goods_total'] > 0){
                            //赋值最后一个有效的付款商品，用于当优惠金额不符合时候做差值计算
                            $last_store_id = $store_id;
                            $last_goods_id = $goods_id;
                        }
                    }
                    $diff_sum += $store_total[$store_id]['use_voucher_money'];
                }

                //判定各个商品计算出来的优惠券金额是否与真实优惠券金额不符，因四舍五入可能会有1分钱左右差距，如果不符合，将差值追加到最后一个有效的商品上，保证金额一致性
                if($diff_sum != $voucher_info['voucher_price']){
                    $diff_price = $voucher_info['voucher_price'] - $diff_sum;;
                    $store_total[$last_store_id]['use_voucher_money'] += $diff_price;
                    $store_goods_voucher[$store_id][$goods_id]['use_voucher_money'] += $diff_price;
                }

                $input_pingtai_voucher['store_total'] = $store_total;
                $input_pingtai_voucher['store_goods_voucher'] = $store_goods_voucher;
                return $input_pingtai_voucher;
            }
        }
        return array();
    }

    /**
     * 获取买家代金券列表
     *
     * @param int $member_id 用户编号
     * @param int $voucher_state 代金券状态
     * @param int $page 分页数
     */
    public function getMemberVoucherList($member_id, $voucher_state, $page = null) {
        if(empty($member_id)) {
            return false;
        }

        //更新过期代金券状态
        $this->_checkVoucherExpire($member_id);

        $field = '*';

        $on = 'store_voucher.voucher_t_id = store_voucher_template.voucher_t_id';

        $where = array('voucher_owner_id'=>$member_id);
        $voucher_state  = intval($voucher_state);
        if (intval($voucher_state) > 0 && array_key_exists($voucher_state, $this->voucher_state_array)){
            $where['voucher_state'] = $voucher_state;
        }

        $list = $this->table('store_voucher,store_voucher_template')->field($field)->join('inner')->on($on)->where($where)->order('voucher_id desc')->page($page)->select();

        return $list;
    }

    /**
     * 更新过期代金券状态
     */
    private function _checkVoucherExpire($member_id) {
        $condition = array();
        $condition['voucher_owner_id'] = $member_id;
        $condition['voucher_state'] = self::VOUCHER_STATE_UNUSED;
        $condition['voucher_end_date'] = array('lt', TIMESTAMP);

        $this->table('store_voucher')->where($condition)->update(array('voucher_state' => self::VOUCHER_STATE_EXPIRE));
    }

	/**
     * 更新平台优惠劵模板信息
     * @param array $data
     * @param array $condition
     */
    public function editVoucherTemplate($where,$data) {
        return $this->table('store_voucher_template')->where($where)->update($data);
    }

	/**
     * 获取平台优惠劵模版列表
     */
    public function getVoucherTemplateList($where, $field = '*') {
        $voucher_list = $this->table('store_voucher_template')->field($field)->where($where)->select();
        return $voucher_list;
    }
	 /**
     * 发放平台优惠劵
     */
    public function exchangeVoucher($template_info, $member_id, $member_name = ''){
        if (intval($member_id) <= 0 || empty($template_info)){
            return array('state'=>false,'msg'=>'参数错误');
        }
		$where = array();
	    $where['voucher_owner_id'] = $member_id;
	    $where['voucher_t_id'] = $template_info['voucher_t_id'];
	    $voucher_list= $this->getVoucherList($where);
		if (!empty($voucher_list)){
	        $voucher_count = 0;//在该店铺兑换的代金券数量
	        $voucherone_count = 0;//该张代金券兑换的数量
	        foreach ($voucher_list as $k=>$v){
	            if ($v['voucher_t_id'] == $template_info['voucher_t_id']){
	                $voucherone_count += 1;
	            }
	        }
	        //同一张代金券最多能兑换的次数
	        if (!empty($template_info['voucher_t_eachlimit']) && $voucherone_count >= $template_info['voucher_t_eachlimit']){
	            $message = sprintf('该优惠劵您已兑换%s次，不可再兑换了',$template_info['voucher_t_eachlimit']);
	            return array('state'=>false,'msg'=>$message);
	        }
	    }
        //查询会员信息
        if (!$member_name){
            $member_info = Model('member')->getMemberInfoByID($member_id);
            $member_name = $member_info['member_name'];
        }
        //添加代金券信息
        $insert_arr = array();
        $insert_arr['voucher_code'] = Model('voucher')->get_voucher_code();
        $insert_arr['voucher_t_id'] = $template_info['voucher_t_id'];
        $insert_arr['voucher_title'] = $template_info['voucher_t_title'];
        $insert_arr['voucher_desc'] = $template_info['voucher_t_desc'];
        $insert_arr['voucher_start_date'] = time();
        $insert_arr['voucher_end_date'] = $template_info['voucher_t_end_date'];
        $insert_arr['voucher_price'] = $template_info['voucher_t_price'];
        $insert_arr['voucher_limit'] = $template_info['voucher_t_limit'];
        $insert_arr['voucher_store_id'] = $template_info['voucher_t_store_id'];
        $insert_arr['voucher_state'] = 1;
        $insert_arr['voucher_active_date'] = time();
        $insert_arr['voucher_owner_id'] = $member_id;
        $insert_arr['voucher_owner_name'] = $member_name;
        
        $result = $this->table('store_voucher')->insert($insert_arr);
        if ($result){
            //代金券模板的兑换数增加
            $this->editVoucherTemplate(array('voucher_t_id'=>$template_info['voucher_t_id']), array('voucher_t_giveout'=>array('exp','voucher_t_giveout+1')));
            return array('state'=>true,'msg'=>'兑换成功','voucher_id'=>$result);
        } else {
            return array('state'=>false,'msg'=>'兑换失败');
        }
    }


	/**
     * 兑换平台优惠劵
     * 2017-11-26 Add is name lt 
     * $uid     用户ID
     * $vid     代金卷模板ID
     */
    public function addPT_YouHuiJuan($uid,$vid){
		if(intval($uid) <= 0 || intval($vid) <= 0) return array('state'=>false,'msg'=>'网络繁忙请稍后');
		/*查出用户信息*/
		$userinfo = Model('member')->getMemberInfoByID($uid);
		/*查出代金卷模板*/
		$where['voucher_t_id'] = $vid;
		$where['voucher_t_end_date'] = array('gt', TIMESTAMP);
		$data = $this->getVoucherTemplateList($where);
		if(empty($data['0'])) return array('state'=>false,'msg'=>'平台优惠劵不存在或者已过期');
		/*添加代金卷*/
		$result = $this->exchangeVoucher($data['0'],$userinfo['member_id'],$userinfo['member_name']);
		return $result;
       
    }
}