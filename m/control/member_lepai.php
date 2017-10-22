<?php
/**
 * 会员中心——账户概览
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_lepaiControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 我的商城
     */
    public function orderOp() {

        $h_model = Model('lepai_home');
        $user_orders = $h_model->getLepaiOrder(array('buyer_id'=>$_SESSION['member_id']));

        
        foreach ($user_orders as $k => $v) {
            $user_orders[$k]['goods_info'] = $h_model->getGoodsInfoOne(array('G_Id'=>$v['lepai_goods_id']));
			$express = Model('express')->getExpressInfo($v['shipping_ecode']);
			$user_orders[$k]['e_name'] = $express['e_name'];
			
        }

        $model_mb_payment = Model('mb_payment');

        $payment_list = $model_mb_payment->getMbPaymentOpenList();


        Tpl::output('user_orders',$user_orders);

        Tpl::output('payment_list',$payment_list);

        Tpl::output('page',$h_model->showpage(88));

        Tpl::output('nav_title','拍卖惠订单');

        Tpl::output('html_title','拍卖惠订单 - 会员中心 - 收藏天下');

        Tpl::showpage('member_lepai_order.list');
    }


    /*
     * 用户取消订单
     */
    public function order_cancelOp(){
        $h_model = Model('lepai_home');
        $order_id = intval($_GET['order_id']);
        $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$order_id,'buyer_id'=>$_SESSION['member_id']));
        showWapMessage('订单取消成功！');
    }


    /*
     * 用户确认订单
     */
    public function order_confirmOp(){
        $h_model = Model('lepai_home');
        $order_id = intval($_GET['order_id']);
        $h_model->updateLepaiOrder(array('order_state'=>'40','finnshed_time'=>time()),array('order_id'=>$order_id,'buyer_id'=>$_SESSION['member_id']));
        showWapMessage('订单确认成功！');
    }








}
