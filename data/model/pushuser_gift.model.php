<?php
/**
推荐有礼
 */
defined('InShopNC') or exit('Access Invalid!');


class pushuser_giftModel extends Model{


    public function __construct(){

        parent::__construct('cangdou_log');

    }

    /*
     * 藏豆记录
     */
    public function getCangdouLogList($condition = array(), $field = '*', $page = 0, $order = 'C_Id desc', $limit = '') {
        return $this->table('cangdou_log')->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    /*
     * 获取藏豆礼品列表
     */
    public function getCangdouGiftList($condition = array(), $field = '*', $page = 0, $order = 'cangdou_gift.addtime desc', $limit = '') {
        return $this->table('cangdou_gift,goods')->field($field)->join('inner')->on('cangdou_gift.goods_id=goods.goods_id')->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    /*
     * 获取单个藏豆兑换礼品信息
     */
    public function getCangdouGiftInfo($condition) {
        return $this->table('cangdou_gift,goods')->join('inner')->on('cangdou_gift.goods_id=goods.goods_id')->where($condition)->find();
    }

    /*
     * 添加藏豆礼品
     */
    public function addCangdouGift($param){
        return $this->table('cangdou_gift')->insert($param);
    }

    /*
     * 编辑藏豆礼品
     */
    public function editCangdouGift($update, $condition) {
        return $this->table('cangdou_gift')->where($condition)->update($update);
    }

    /*
    实现二级分销、给当前用户的推荐人加藏豆、并给推荐人的上级加藏豆
    $uid        当前用户
    $pushid     推荐人
    */
    public function setUserPoints($uid,$order_id=0){
        $model = Model('setting');
        $setting = $model->getListSetting();

        //藏豆赠送是否打开
        if($setting['cangdou'] != '1'){
            return false;
        }

        //找出注册用户上级
        $pushid = $this->table('member')->field('inviter_id,member_name,member_mobile_bind')->where(array('member_id'=>$uid))->find();

        //找出配送规则
        $Pone = $setting['cangdou_one'];//绑定手机会员一级送藏豆
        $Ptwo = $setting['cangdou_two'];//二级送藏豆

        if($order_id > 0){
            //计算订单商品支付总金额
            $order_goods_total = Model('order_goods')->where(array('order_id'=>$order_id))->sum('goods_pay_price');
            $Porder = round(($setting['cangdou_order_one'] / 1000 * $order_goods_total),2);//一级
            $PorderTwo = round(($setting['cangdou_order_two'] / 1000 * $order_goods_total),2);//二级
        }



        //一级
        if(intval($pushid['inviter_id']) > 0){
            //一级存$uid 和 pushid
            $oneArr['C_Uid'] = $uid;
            $oneArr['C_PushId'] = $pushid['inviter_id'];
            $oneArr['C_Time'] = time();
            //判断注册还是完成订单
            if($order_id > 0){
                $oneArr['C_CangDou'] = $Porder;
                $oneArr['C_DouType'] = 'orderone';
                $oneArr['C_Remark'] = '邀请好友（'.$pushid['member_name'].'）购物奖励';
                if(!empty($Porder)){
                    $oneResult = $this->table('cangdou_log')->insert($oneArr);
                }else{
                    return false;
                }
            }else{
				if($pushid['member_mobile_bind'] == 1){
					$oneArr['C_CangDou'] = $Pone;
					$oneArr['C_DouType'] = 'douone';
					$oneArr['C_Remark'] = '邀请好友（'.$pushid['member_name'].'）奖励';
					$oneResult = $this->table('cangdou_log')->insert($oneArr);
				}
            }

            if(!empty($oneResult)){
				if($pushid['member_mobile_bind'] == 1){
					$this->table('member')->where(array('member_id'=>$pushid['inviter_id']))->setInc('cangdou',$oneArr['C_CangDou']);
					dcache($pushid['inviter_id'], 'member');
				}
            }else{
                return false;
            }

        }else{
            return false;
        }


        //二级
        $pushidTwo = $this->table('member')->field('inviter_id,member_name,member_mobile_bind')->where(array('member_id'=>$pushid['inviter_id']))->find();
        if(intval($pushidTwo['inviter_id']) > 0){
            //二级存$pushid 和 pushidTwo
            $oneArr['C_Uid'] = $pushid['inviter_id'];
            $oneArr['C_PushId'] = $pushidTwo['inviter_id'];
            $oneArr['C_Time'] = time();
            //判断注册还是完成订单
            if($order_id > 0){
                $oneArr['C_CangDou'] = $PorderTwo;
                $oneArr['C_DouType'] = 'ordertwo';
                $oneArr['C_Remark'] = '邀请好友（'.$pushid['member_name'].'）购物奖励';
                if(!empty($PorderTwo)){
                    $twoResult = $this->table('cangdou_log')->insert($oneArr);
                }else{
                    return false;
                }
            }else{
				if($pushidTwo['member_mobile_bind'] == 1){
					$oneArr['C_CangDou'] = $Ptwo;
					$oneArr['C_DouType'] = 'doutwo';
					$oneArr['C_Remark'] = '邀请好友（'.$pushid['member_name'].'）奖励';
					$twoResult = $this->table('cangdou_log')->insert($oneArr);
				}
            }

            if(!empty($twoResult)){
				if($pushidTwo['member_mobile_bind'] == 1){
					$this->table('member')->where(array('member_id'=>$pushidTwo['inviter_id']))->setInc('cangdou',$oneArr['C_CangDou']);
					dcache($pushidTwo['inviter_id'], 'member');
				}
            }else{
                return false;
            }
            
        }else{
            return false;
        }

		dcache($uid, 'member');
    }
	
	/*
    实现二级分销、给当前用户的推荐人加藏豆、并给推荐人的上级加藏豆
    $uid        当前用户
    $order_id   订单编号
	$total_price   退款金额
    */
    public function setUserJianQuPoints($uid,$order_id=0,$total_price=0){
        $model = Model('setting');
        $setting = $model->getListSetting();

        //藏豆赠送是否打开
        if($setting['cangdou'] != '1'){
            return false;
        }

		if(intval($uid) <= 0 || intval($order_id) <= 0 || $total_price <= 0){
			return false;
		}

        //找出注册用户上级
        $pushid = $this->table('member')->field('inviter_id,member_name')->where(array('member_id'=>$uid))->find();
		

        //找出配送规则
        $Pone = $setting['cangdou_one'];//绑定手机会员一级送藏豆
        $Ptwo = $setting['cangdou_two'];//二级送藏豆

        if($order_id > 0){
            //计算减去藏豆数额
            $Porder = round(($setting['cangdou_order_one'] / 1000 * $total_price),2);//一级
            $PorderTwo = round(($setting['cangdou_order_two'] / 1000 * $total_price),2);//二级
        }



        //一级 减去用户赠送藏豆
        if(intval($pushid['inviter_id']) > 0){
            //一级存$uid 和 pushid
            $oneArr['C_Uid'] = $uid;
            $oneArr['C_PushId'] = $pushid['inviter_id'];
            $oneArr['C_Time'] = time();
           
			$oneArr['C_CangDou'] = '-'.$Porder;
			$oneArr['C_DouType'] = 'orderone';
			$oneArr['C_Remark'] = '好友'.$pushid['member_name'].'订单退货，扣除藏豆';
			if(!empty($Porder)){
				$oneResult = $this->table('cangdou_log')->insert($oneArr);
			}else{
				return false;
			}
            if(!empty($oneResult)){
                $this->table('member')->where(array('member_id'=>$pushid['inviter_id']))->setInc('cangdou',$oneArr['C_CangDou']);
				dcache($pushid['inviter_id'], 'member');
            }else{
                return false;
            }

        }else{
            return false;
        }


        //二级 减去藏豆
        $pushidTwo = $this->table('member')->field('inviter_id,member_name')->where(array('member_id'=>$pushid['inviter_id']))->find();
		
        if(intval($pushidTwo['inviter_id']) > 0){
            //二级存$pushid 和 pushidTwo
            $oneArr['C_Uid'] = $pushid['inviter_id'];
            $oneArr['C_PushId'] = $pushidTwo['inviter_id'];
            $oneArr['C_Time'] = time();

			$oneArr['C_CangDou'] = '-'.$PorderTwo;
			$oneArr['C_DouType'] = 'ordertwo';
			$oneArr['C_Remark'] = '好友'.$pushid['member_name'].'订单退货，扣除藏豆';
			if(!empty($PorderTwo)){
				$twoResult = $this->table('cangdou_log')->insert($oneArr);
			}else{
				return false;
			}
	   

            if(!empty($twoResult)){
                $this->table('member')->where(array('member_id'=>$pushidTwo['inviter_id']))->setInc('cangdou',$oneArr['C_CangDou']);
				dcache($pushidTwo['inviter_id'], 'member');
            }else{
                return false;
            }
            
        }else{
            return false;
        }

    }


	/*
     * 获取藏豆推荐产品列表
     */
    public function getCangdouTuiJianList($condition = array(), $field = '*', $page = 0, $order = 'cangdou_tuijian.addtime desc', $limit = '') {
        return $this->table('cangdou_tuijian,goods')->join('inner')->on('cangdou_tuijian.goods_id=goods.goods_id')->where($condition)->page($page)->order($order)->limit($limit)->select();
    }
	/*
     * 获取单个推荐商品的信息
     */
    public function getCangdouTuiJianInfo($condition) {
        return $this->table('cangdou_tuijian,goods')->join('inner')->on('cangdou_tuijian.goods_id=goods.goods_id')->where($condition)->find();
    }

	/*
     * 添加推荐商品
     */
    public function addCangdouTuiJian($param){
		// 发布推荐商品
        //add 发布抢购锁定商品SKU及商品
		Model('goods')->editGoodsSkuLock($param['goods_id']);
        $result = $this->table('cangdou_tuijian')->insert($param);
		if ($result) {
            $this->_dGoodsCangdouTuiJianCache($param['goods_id']);
            return $result;
        } else {
            return false;
        }
    }

    /*
     * 编辑推荐商品
     */
    public function editCangdouTuiJian($update, $condition) {
		$tuijian_list = $this->getCangdouTuiJianList($condition,'goods_id');
		$result = $this->table('cangdou_tuijian')->where($condition)->update($update);
		if ($result) {
            if (!empty($tuijian_list)) {
                foreach ($tuijian_list as $val) {
                    // 更新缓存
                    $this->_dGoodsCangdouTuiJianCache($val['goods_id']);
                }
            }
        }
        return $result;
    }


//	/*
//	 * 检测产品是否有折扣活动 《优惠购买》
//     * 同时检测用户是否有资格参加打八折活动、
//     */
//    public function getYouHuiByGoodsID($goods_id){
//		//找出注册用户上级
//		$uid = $_SESSION['member_id'];
//        $pushid = $this->table('member')->field('inviter_id')->where(array('member_id'=>$uid))->find();
//		//如果用户不是《被推荐》用户则参加不了活动
//		if (empty($pushid['inviter_id'])) {
//			//检测用户是否是《推荐人》且他的《被推荐人》是否购买过该商品
//			$z_member_id = $this->table('member')->field('member_id')->where(array('inviter_id'=>$uid))->select();
//			if (empty($z_member_id)) {
//				return false;
//			}else{
//				$memberid = array();
//				foreach($z_member_id as $pk=>$pv){
//					$memberid[] = $pv['member_id'];  //获取当前用户所有《被推荐》人的会员id
//				}
//				//查询当前用户所有《被推荐》人是否购买过该商品
//				$where = "order.order_state > 0 AND buyer_id in(".join(',',$memberid).") AND order_goods.goods_id = '".$goods_id."'";
//				$count = $this->table('order,order_goods')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->count();
//				//未购买过不能参加活动
//				if(intval($count) <= 0){
//					return false;
//				}
//			}
//		}
//		
//		$info = $this->_rGoodsCangdouTuiJianCache($goods_id);
//		if (empty($info)) {
//			$condition = array();
//			$condition['starttime'] = array('lt', TIMESTAMP);
//			$condition['endtime'] = array('gt', TIMESTAMP);
//			$condition['goods_id'] = $goods_id;
//			$cangdou_tuijian_list = $this->table('cangdou_tuijian')->field('*')->where($condition)->order('starttime desc')->select();
//			$info['info'] = serialize($cangdou_tuijian_list[0]);
//			$this->_wGoodsCangdouTuiJianCache($goods_id, $info);
//		}
//		$cangdou_tuijian = unserialize($info['info']);
//		if (!empty($cangdou_tuijian) && ($cangdou_tuijian['starttime'] > TIMESTAMP || $cangdou_tuijian['endtime'] < TIMESTAMP)) {
//            $cangdou_tuijian = array();
//        }
//		
//		return $cangdou_tuijian;
//	}

	/*
	 * 检测产品是否有折扣活动 《优惠购买》
     * 同时检测用户是否有资格参加打八折活动、
     */
    public function getYouHuiByGoodsID($goods_id){
		
		if(intval($_SESSION['tjgoods']) == 0){
			//检查是否是被推荐购买 且 同一个用户显示原价
			if(intval($_SESSION['tjid']) > 0 && $goods_id == intval($_SESSION['tjgoodsid']) && intval($_SESSION['tjid']) != $_SESSION['member_id']){
				
			}else{
				if(intval($_SESSION['member_id']) == 0 || intval($goods_id) == 0){ return false;}
				//检测用户是否推荐人购买过该商品
				$where = "order.order_state > 10 AND order.zrm_id = '".$_SESSION['member_id']."' AND order_goods.goods_id = '".$goods_id."'";
				$count = $this->table('order,order_goods')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->count();
				//未购买过不能参加活动
				if(intval($count) <= 0){
					return false;
				}
			}
		}
		
		//$info = $this->_rGoodsCangdouTuiJianCache($goods_id);
		
		if (empty($info)) {
			$condition = array();
			$condition['starttime'] = array('lt', TIMESTAMP);
			$condition['endtime'] = array('gt', TIMESTAMP);
			$condition['goods_id'] = $goods_id;
			$cangdou_tuijian_list = $this->table('cangdou_tuijian')->field('*')->where($condition)->order('starttime desc')->select();
			$info['info'] = serialize($cangdou_tuijian_list[0]);
			$this->_wGoodsCangdouTuiJianCache($goods_id, $info);
		}
		$cangdou_tuijian = unserialize($info['info']);
		if (!empty($cangdou_tuijian) && ($cangdou_tuijian['starttime'] > TIMESTAMP || $cangdou_tuijian['endtime'] < TIMESTAMP)) {
            $cangdou_tuijian = array();
        }
		$_SESSION['tjgoods'] = 0;
	
		return $cangdou_tuijian;
	}


	
    /**
     * 读取商品优惠推荐缓存
     * @param int $goods_id
     * @return array/bool
     */
    private function _rGoodsCangdouTuiJianCache($goods_id) {
        return rcache($goods_id, 'goods_cangdoutuijian');
    }

	/**
     * 写入商品优惠推荐缓存
     * @param int $goods_id
     * @param array $info
     * @return boolean
     */
    private function _wGoodsCangdouTuiJianCache($goods_id, $info) {
        return wcache($goods_id, $info, 'goods_cangdoutuijian');
    }

	/**
     * 删除商品优惠推荐缓存
     * @param int $goods_id
     * @return boolean
     */
    private function _dGoodsCangdouTuiJianCache($goods_id) {
        return dcache($goods_id, 'goods_cangdoutuijian');
    }

	/*
	 * 删除兑换礼品列表商品
     */
    public function getGiftDel($condition){
	   return $this->table('cangdou_gift')->where($condition)->delete();
		
	}

	/*
	 * 删除推荐商品
     */
    public function getTuiJianDel($condition){
		$TuiJian = $this->getCangdouTuiJianInfo($condition); //查询删除推荐商品
		Model('goods')->editGoodsSkuUnlock($TuiJian['goods_id']);//解锁商品
		$this->_dGoodsCangdouTuiJianCache($TuiJian['goods_id']);//删除推荐商品缓存
		return $this->table('cangdou_tuijian')->where($condition)->delete(); //删除推荐商品
		
	}


}
?>