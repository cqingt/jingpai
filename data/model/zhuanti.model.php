<?php
/**
 * 专题Model
 *
 * 
 */
defined('InShopNC') or exit('Access Invalid!');
class zhuantiModel extends Model{
	/**
	 * 获取满足条件的订单
	 *
	 */
	public function getOrder($condition, $field = '*'){
		 return $this->table('order')->field($field)->where($condition)->select();
	}

	 /**
     * 插入用户抽奖信息
     * @param array $data
     * @return int 返回 insert_id
     */
    public function addLottery($data) {
        return $this->table('lottery_member')->insert($data);
    }
	
	/**
     * 插入领奖会员信息
     * @param array $data
     * @return int 返回 insert_id
     */
    public function insertLinQu($data) {
        return $this->table('lottery_receive')->insert($data);
    }
	
	/**
     * 判断当前奖品是否已被领取
     */
	public function LinQuCount($condition) {
        return $this->table('lottery_receive')->where($condition)->count();
    }

	/**
     * 修改已领取
     */
	public function upLotteryReceive($param,$where) {
		if(empty($param)) {
			return false;
		}
		$result = $this->table('lottery_member')->where($where)->update($param);
		return $result;
	}
	
	/**
     * 获取满足条件的会员信息
     */
   	public function getLotteryReceiveList($condition, $field = '*',$pagesize = '',$order='id desc',$limit = ''){
		 return $this->table('lottery_receive')->field($field)->where($condition)->page($pagesize)->order($order)->limit($limit)->select();
	}

	/**
     * 获取满足条件的已抽奖数量
     */
   	public function getLotteryCount($condition){
		 return $this->table('lottery_member')->where($condition)->count();
	}

	/**
     * 获取每天免费的抽奖次数
	 * $condition 条件array()
	 * $num 免费次数
     */
   	public function getMianFeiLottery($condition,$num='0'){
		 $lot_count = $this->table('lottery_member')->where($condition)->count();
		 return intval($num-$lot_count);
	}

	/**
     * 获取满足条件的奖品列表
     */
   	public function getLotteryList($condition, $field = '*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name',$pagesize = '',$order='id desc',$limit = ''){
		 return $this->table('lottery_member')->field($field)->where($condition)->page($pagesize)->order($order)->limit($limit)->select();
	}
	
	/**
     * 获得领奖人资料
     */
	public function getLotteryReceive($condition){
		return $this->table('lottery_receive')->field('*')->where($condition)->find();
	}

	/**
	 * 读取限时折扣商品列表
	 *
	 */
	public function getXianshiGoodsList($condition, $field='*') {
        return $xianshi_goods_list = $this->table('p_xianshi_goods')->field($field)->where($condition)->order("xianshi_goods_id desc")->select();
	}

	/**
	 * 读取限时折扣商品列表
	 *
	 */
	public function getXianshiGoodsExtendList($condition, $field='*') {
        $xianshi_goods_list = $this->getXianshiGoodsList($condition,  $field);
        if(!empty($xianshi_goods_list)) {
            for($i=0, $j=count($xianshi_goods_list); $i < $j; $i++) {
                $xianshi_goods_list[$i] = $this->getXianshiGoodsExtendInfo($xianshi_goods_list[$i]);
            }
        }
        return $xianshi_goods_list;
	}


	/**
     * 获取限时折扣商品扩展信息
     *
     */
    public function getXianshiGoodsExtendInfo($xianshi_info) {
        $xianshi_info['goods_url'] = urlShop('goods', 'index', array('goods_id' => $xianshi_info['goods_id']));
        $xianshi_info['image_url'] = cthumb($xianshi_info['goods_image'], 240, $xianshi_info['store_id']);
        $xianshi_info['xianshi_price'] = ncPriceFormat($xianshi_info['xianshi_price']);
        $xianshi_info['xianshi_discount'] = number_format($xianshi_info['xianshi_price'] / $xianshi_info['goods_price'] * 10, 1).'折';
        return $xianshi_info;
    }
	
	/**
     * 插入投票信息
     * @param array $data
     * @return int 返回 insert_id
     */
    public function insertTouPiao($data) {
        return $this->table('vote')->insert($data);
    }

	/**
     * 获取满足条件的投票列表
     */
   	public function getTouPiaoList($condition, $field = '*',$pagesize = '',$order='id desc',$limit = ''){
		 return $this->table('vote')->field($field)->where($condition)->page($pagesize)->order($order)->limit($limit)->select();
	}

	/**
     * 修改投票信息
     */
	public function updetaTouPiao($param,$where) {
		if(empty($param)) {
			return false;
		}
		$result = $this->table('vote')->where($where)->update($param);
		return $result;
	}
	
	/**
     * 获取某个藏品的排名
     */
	public function getPaiMing($condition) {
		//->group('vote_num')
		return $this->table('vote')->where($condition)->count();
	}
	

	/**
     * 删除投票
     */
	public function delTouPiao($condition) {
		return $this->table('vote')->where($condition)->delete();
	}

	
	/**
     * 更具指定的代金卷id发放代金卷
     */
	public function exchangeVoucher($vid, $member_id, $member_name = ''){
		$where['voucher_t_id'] = $vid;
	    $template_info = $this->table('voucher_template')->field('*')->where($where)->find();
        //查询会员信息
        if (!$member_name){
            $member_info = Model('member')->getMemberInfoByID($member_id);
            $member_name = $member_info['member_name'];
        }
        //添加代金券信息
        $insert_arr = array();
        $insert_arr['voucher_code'] = $this->get_voucher_code();
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
        $result = $this->table('voucher')->insert($insert_arr);
        return $result;
    }

	/**
     * 检查当前会员是否已经领取过指定的代金卷
     */
	public function VoucherCount($condition){
		 return $this->table('voucher')->where($condition)->count();
    }


	/*
     * 获取代金券编码
     */
    public function get_voucher_code() {
		return mt_rand(10,99)
		      . sprintf('%010d',time() - 946656000)
		      . sprintf('%03d', (float) microtime() * 1000)
		      . sprintf('%03d', (int) $_SESSION['member_id'] % 1000);
    }

	/**
     * 发放平台优惠劵 id发放代金卷
     */
    public function store_exchangeVoucher($vid, $member_id, $member_name = ''){
        $where['voucher_t_id'] = $vid;
	    $template_info = $this->table('store_voucher_template')->field('*')->where($where)->find();
        //查询会员信息
        if (!$member_name){
            $member_info = Model('member')->getMemberInfoByID($member_id);
            $member_name = $member_info['member_name'];
        }
        //添加代金券信息
        $insert_arr = array();
        $insert_arr['voucher_code'] = $this->get_voucher_code();
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
        return $result;
    }

	/**
     * 检查当前会员是否已经领取过指定的平台优惠劵
     */
	public function store_VoucherCount($condition){
		 return $this->table('store_voucher')->where($condition)->count();
    }





	/*
     * 快速注册
     */
	public function register($register_info){
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
		array("input"=>$register_info["username"],		"require"=>"true",		"message"=>'用户名不能为空'),
		array("input"=>$register_info["password"],		"require"=>"true",		"message"=>'密码不能为空'),
		array("input"=>$register_info["password_confirm"],"require"=>"true", "validator"=>"Compare","operator"=>"==","to"=>$register_info["password"],"message"=>'密码与确认密码不相同')
		);
		$error = $obj_validate->validate();
		if ($error != ''){
            return array('error' => $error);
		}
		// 验证用户名是否重复
		$check_member_name	= Model('member')->getMemberInfo(array('member_name'=>$register_info['username']));
		if(is_array($check_member_name) and count($check_member_name) > 0) {
            return array('error' => '用户名已存在');
		}

	}

	/*
     * 检查活动用户是有资格参加活动
     */

	 public function JianChaHuoDong($array,$where_member_from='',$lai_yuan=''){
		if($where_member_from){
			$MemberNum = $this->table('member')->where($where_member_from)->count(); //检查用户是否已购买该商品
			if($MemberNum == 0) return array('error' => '您不符合领取资格');
		}
		$goodsid_array = array();
		if($array){
			foreach($array as $k=>$v){
				$goodsid_array[] = $k;
			}
		}
		$OGWhere['goods_id'] = array('in', $goodsid_array);
		$OGWhere['buyer_id'] = $_SESSION['member_id'];
		if($lai_yuan){
			$OGWhere['lai_yuan'] = $lai_yuan;
		}
		$GouMaiNum = $this->table('order_goods')->where($OGWhere)->count(); //检查用户是否已购买该商品
		if($GouMaiNum > 0) return array('error' => '您已领取不能重复领取');
	 }

	/*
     * 活动添加订单
	 * $other 非专题其他类型的订单
     */
	public function add_order($address_info,$array,$goods_amount,$shipping_fee,$referer='免费领取70周年纪念币',$lai_yuan='免费领取',$other=false,$lid=array(),$payment_code='online',$order_from=1,$goods_num=1,$is_ywinfo=1){
		$goodsid_array = array();
		if($array){
			foreach($array as $k=>$v){
				$goodsid_array[] = $k;
			}
		}
        if(!$other){
            $OGWhere['goods_id'] = array('in', $goodsid_array);
            $OGWhere['buyer_id'] = $_SESSION['member_id'];
            $GouMaiNum = $this->table('order_goods')->where($OGWhere)->count(); //检查用户是否已购买该商品
            if($GouMaiNum > 0) return array('error' => '您已领取不能重复领取');
        }

		$goods_id['goods_id'] = array('in', $goodsid_array);
		$user_info = Model('member')->getMemberInfoByID($_SESSION['member_id'],'member_mobile,tg_from');
		$store_cart_list = $this->table('goods')->field('goods_id,goods_name,store_id,gc_id_1,gc_id_2,gc_id_3,store_name,gc_id,goods_price,goods_image')->where($goods_id)->select(); //获取购买产品
        $model_order = Model('order');
		$member_id = intval($_SESSION['member_id']);
        $pay_sn = Model('buy')->makePaySn($member_id);
        $order_pay = array();
        $order_pay['pay_sn'] = $pay_sn;
        $order_pay['buyer_id'] = $member_id;
        $order_pay_id = $model_order->addOrderPay($order_pay);
        if (!$order_pay_id) {
			return array('error' => '领取失败1');
        }
		$store_id = $store_cart_list[0]['store_id'];

        //收货人信息
		$reciver_info = array(
			'phone' => 	JiaMiMobile($address_info['mob_phone']),
			'mob_phone' => JiaMiMobile($address_info['mob_phone']),
			'tel_phone' => 	JiaMiMobile($address_info['mob_phone']),
			'address'   => 	$address_info['area_info'].' '.$address_info['address'],
			'area' => 	$address_info['area_info'],
			'street' => $address_info['address']
		);
        $reciver_info = serialize($reciver_info);
        $reciver_name = $address_info['true_name'];
            
		$order = array();
		$order_common = array();
		$order_goods = array();
		//订单信息
		$order['order_sn'] = Model('buy')->makeOrderSn($order_pay_id);
		$order['pay_sn'] = $pay_sn;
		$order['store_id'] = $store_id;
		$order['store_name'] = $store_cart_list[0]['store_name'];
		$order['buyer_id'] = $member_id;
		$order['buyer_name'] = $_SESSION['member_name'];
		$order['buyer_email'] = '';
		$order['add_time'] = TIMESTAMP;
		$order['payment_code'] = $payment_code;
		$order['order_state'] = 10;
		$order['order_amount'] = $goods_amount+$shipping_fee;
		$order['shipping_fee'] = $shipping_fee;
		$order['goods_amount'] = $goods_amount;
		$order['order_from'] = $order_from;
		if($payment_code == 'offline' || $order['order_amount'] <= 0){//如果是活动付款商城默认变成代发货状态
			$order['order_state'] = 20;
			$order['payment_time'] = TIMESTAMP;
		}
		$order_id = $model_order->addOrder($order);
		if (!$order_id) {
			return array('error' => '领取失败2'.$payment_code);
		}
		$order['order_id'] = $order_id;
		$order_list[$order_id] = $order;

		$order_common['order_id'] = $order_id;
		$order_common['store_id'] = $store_id;
		$order_common['reciver_info']= $reciver_info;
		$order_common['reciver_name'] = $reciver_name;

		$order_common['reciver_province_id'] = $address_info['prov'];
		$order_common['reciver_city_id'] = $address_info['city_id'];
		$order_common['reciver_district_id'] = $address_info['area_id'];
		$order_id = $model_order->addOrderCommon($order_common);

		if (!$order_id) {
			return array('error' => '领取失败3');
		}
        //生成order_goods订单商品数据
        $i = 0;
		$store_gc_id_commis_rate_list = Model('store_bind_class')->getStoreGcidCommisRateList($store_cart_list);
        foreach ($store_cart_list as $goods_info) {

        		if(is_array($goods_num)){
        			$goods_num_ = $goods_num[$goods_info['goods_id']];
        		}else{
        			$goods_num_ = $goods_num;
        		}

				$order_goods[$i]['order_id'] = $order_id;
				$order_goods[$i]['goods_id'] = $goods_info['goods_id'];
				$order_goods[$i]['store_id'] = $store_id;
				$order_goods[$i]['goods_name'] = $goods_info['goods_name'];
				$order_goods[$i]['goods_price'] = $array[$goods_info['goods_id']];
				$order_goods[$i]['goods_num'] = $goods_num_;
				$order_goods[$i]['goods_image'] = $goods_info['goods_image'];
				$order_goods[$i]['buyer_id'] = $member_id;
				$order_goods[$i]['gc_id'] = $goods_info['gc_id'];
			
				$order_goods[$i]['goods_pay_price'] = $array[$goods_info['goods_id']] * $goods_num_;
				$order_goods[$i]['lai_yuan'] = $lai_yuan;
				$order_goods[$i]['commis_rate'] =floatval($store_gc_id_commis_rate_list[$store_id][$goods_info['gc_id']]);
				$i++;
            }
		$insert = $model_order->addOrderGoods($order_goods);
		if (!$insert) {
			return array('error' => '领取失败4');
		}

		if($is_ywinfo == 1){
			if(intval($_SESSION['yw_id']) > 0){
				$yw_id = "&yw_id=".intval($_SESSION['yw_id']);
			}
		
			//获取业务信息
			$yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=userOrder&ID='.$_SESSION['member_id'].'&M='.$user_info['member_mobile'].'&N='.urlencode($_SESSION['member_name']).$yw_id."&tg_from=".urlencode($user_info['tg_from']));
			$yw_info = explode('|',gbk_to_utf8($yw_info_get));
			$insert_data = array();
			$insert_data['Number'] = $yw_info[0];
			$insert_data['UserID'] = intval($yw_info[1]);
			$insert_data['MemberName'] = $yw_info[2];
			$insert_data['team'] = intval($yw_info[3]);
			$insert_data['ShopID'] = $_SESSION['member_id'];
			$insert_data['bumen'] = intval($yw_info[4]);
			$insert_data['MemberID'] = intval($yw_info[5]);
			$insert_data['order_sn'] = $order['order_sn'];
			$insert_data['orderid'] = $order_id;
			$insert_data['referer'] = $referer;
			if($order['order_amount'] <= 0){
				$insert_data['review'] = 1;
				$insert_data['confirm_time'] = TIMESTAMP;
				$insert_data['order_status'] = 1;
				$insert_data['shipping_status'] = 5;
				$insert_data['pay_status'] = 2;
			}
			Model('order')->ywInfoInsert($insert_data);//存入业务info
		}
		if($lid){
			//如果是抽奖领取奖品则修改领取状态
			$where['id'] = array('in',$lid);
			$param['order_sn'] = $order['order_sn'];
			$param['is_fafang']= 1;
			$this->table('lottery_member')->where($where)->update($param);
		}
		return array('pay_sn'=>$pay_sn);
	}
	
	/*
     * 专题管理insert
     */
	public function add_zhuanti($ztArray){
		return $this->table('zhuanti')->insert($ztArray);
	}

	/*
     * 修改专题专题管理
     */
	public function up_zhuanti($ztArray,$where){
		$result = $this->table('zhuanti')->where($where)->update($ztArray);
		return $result;
	}

	/**
     * 获取满足条件的专题列表
     */
   	public function getZhuanTiList($condition, $field = '*',$pagesize = '',$order='id desc',$limit = ''){
		 return $this->table('zhuanti')->field($field)->where($condition)->page($pagesize)->order($order)->limit($limit)->select();
	}

	/**
     * 获得专题单条记录
     */
	public function getZhuanTiInfo($condition){
		return $this->table('zhuanti')->field('*')->where($condition)->find();
	}

	/**
     * 删除
     */
	public function DelZhuanTi($condition){
		return $this->table('zhuanti')->where($condition)->delete();
	}

	
}