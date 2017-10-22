<?php
/**
 * 会员中心——订单
 *
 *
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class member_orderControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 订单列表
     */
    public function order_listOp() {

        $model_order = Model('order');

        $condition = array();

        $condition['buyer_id'] = $_SESSION['member_id'];

        $order_list_array = $model_order->getNormalOrderList($condition, $this->page, '*', 'order_id desc','', array('order_common','order_goods'));

        $order_group_list = array();

        $order_pay_sn_array = array();
		
        foreach ($order_list_array as $value) {
            //显示取消订单
            $value['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$value);
            //显示收货
            $value['if_receive'] = $model_order->getOrderOperateState('receive',$value);
            //显示锁定中
            $value['if_lock'] = $model_order->getOrderOperateState('lock',$value);
            //显示物流跟踪
            $value['if_deliver'] = $model_order->getOrderOperateState('deliver',$value);

            //商品图
            foreach ($value['extend_order_goods'] as $k => $goods_info) {

                $value['extend_order_goods'][$k]['goods_image_url'] = cthumb($goods_info['goods_image'], 240, $value['store_id']);

            }

            $order_group_list[$value['pay_sn']]['order_list'][] = $value;


            //如果有在线支付且未付款的订单则显示合并付款链接
            if ($value['order_state'] == ORDER_STATE_NEW) {
                $order_group_list[$value['pay_sn']]['pay_amount'] += $value['order_amount'] - $value['rcb_amount'] - $value['pd_amount'];
            }
            $order_group_list[$value['pay_sn']]['add_time'] = $value['add_time'];

            //记录一下pay_sn，后面需要查询支付单表
            $order_pay_sn_array[] = $value['pay_sn'];
        }

        /*订单编号*/
        $new_order_group_list = array();
        foreach ($order_group_list as $key => $value) {
            $value['pay_sn'] = strval($key);
            $new_order_group_list[] = $value;
        }

        /*分页总数*/

        $page_count = $model_order->gettotalpage();

        $array_data = array('order_group_list' => $new_order_group_list);

        // if(isset($_GET['getpayment'])&&$_GET['getpayment']=="true"){

        $model_mb_payment = Model('mb_payment');

        $payment_list = $model_mb_payment->getMbPaymentOpenList();


        $payment_array = array();
        if(!empty($payment_list)) {
            foreach ($payment_list as $value) {
                $payment_array[] = array('payment_code' => $value['payment_code'],'payment_name' =>$value['payment_name']);
            }
        }
        $array_data['payment_list'] = $payment_array;

        // }

	

        Tpl::output('order_group_list',$array_data);

        Tpl::output('nav_title','订单列表');

        Tpl::output('html_title','订单列表 - 会员中心 - 收藏天下');

        Tpl::output('page',$model_order->showpage(88));

        Tpl::showpage('member_order.list');
    }



    /**
     * 取消订单
     */
    public function order_cancelOp() {
        $model_order = Model('order');
        $logic_order = Logic('order');
        $order_id = intval($_GET['order_id']);
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = $_SESSION['member_id'];
        $order_info = $model_order->getOrderInfo($condition);
        $if_allow = $model_order->getOrderOperateState('buyer_cancel',$order_info);
        if (!$if_allow){
            showWapMessage('无权操作','','error');
        }
		
        $result = $this->_order_cancel($order_info);
        if(!$result['state']) {
            showWapMessage($result['msg'],'','error');
        } else {
            showWapMessage('操作成功');
        }
    }

	 /**
     * 取消订单
     */
    private function _order_cancel($order_info) {
     
            $model_order = Model('order');
            $logic_order = Logic('order');
            /* 2016-01-12 Add is name lt 取消订单返回代金卷*/

            $order_common_info = $model_order->getOrderCommonInfo(array('order_id'=>$order_info['order_id']));
            $voucher_price = $order_common_info['voucher_price'];
            $voucher_code = $order_common_info['voucher_code'];

            if($voucher_price && $voucher_code){
                //修改order_common表、清空代金卷信息
                $order_common_up['voucher_price'] = null;
                $order_common_up['voucher_code'] = null;
                $order_common_result = $model_order->editOrderCommon($order_common_up,array('order_id'=>$order_info['order_id']));

                if($order_common_result){
                    //修改order表、把优惠卷金额加到商品金额和订单总额中
                    $order_up['goods_amount'] = $order_info['goods_amount'] + $voucher_price;
                    $order_up['order_amount'] = $order_info['order_amount'] + $voucher_price;
                    $order_result = $model_order->editOrder($order_up,array('order_id'=>$order_info['order_id']));
                    if($order_result){
                        $voucher_model = Model('voucher');
                        $voucher_where['voucher_state'] = 1;
                        $voucher_where['voucher_order_id'] = null;
                        $voucher_model->editVoucher($voucher_where,array('voucher_code'=>$voucher_code));
                        if(!$voucher_model){
                            return $result['msg'] = '代金卷信息错误';
                        }
                    }else{
                        return $result['msg'] = '代金卷信息错误';
                    }
                }else{
                    return $result['msg'] = '代金卷信息错误';
                }
            }
            /* End */

        /* Add is name lt 2016-04-25 秒杀和团购取消订单加回数量 */

        $model_order = Model('order');
        $model_miaosha = Model('miaosha');
        $model_groupbuy = Model('groupbuy');


        //秒杀
        $goods_info = $model_order->getOrderGoodsInfo(array('order_id'=>$order_info['order_id'],'goods_type'=>6));

        $miaosha_goods_id = $goods_info['goods_id'];
        $miaosha_goodsnum = $goods_info['goods_num'];

        if($miaosha_goods_id && $miaosha_goodsnum){

        $miaosha_info = $model_miaosha->getMiaoshaList(array('goods_id'=>$miaosha_goods_id,'state'=>20),null,'state asc','*',1);

        $miaosha_id = $miaosha_info[0]['miaosha_id'];

        $model_miaosha->table('miaosha')->where(array('miaosha_id'=>$miaosha_id))->setDec('buyer_count',1);
        $model_miaosha->table('miaosha')->where(array('miaosha_id'=>$miaosha_id))->setDec('buy_quantity',$miaosha_goodsnum);

        }

        //团购
        $tuangou_goods_info = $model_order->getOrderGoodsInfo(array('order_id'=>$order_info['order_id'],'goods_type'=>2));

        $tuangou_goods_id = $tuangou_goods_info['goods_id'];
        $tuangou_goodsnum = $tuangou_goods_info['goods_num'];

        if($tuangou_goods_id && $tuangou_goodsnum){

        $tuangou_info = $model_groupbuy->getGroupbuyList(array('goods_id'=>$tuangou_goods_id,'state'=>20),null,'state asc','*',1);

        $tuangou_id = $tuangou_info[0]['groupbuy_id'];

        $model_groupbuy->table('groupbuy')->where(array('groupbuy_id'=>$tuangou_id))->setDec('buyer_count',1);
        $model_groupbuy->table('groupbuy')->where(array('groupbuy_id'=>$tuangou_id))->setDec('buy_quantity',$tuangou_goodsnum);

        }
		return $logic_order->changeOrderStateCancel($order_info,'buyer', $_SESSION['member_name'], '其它原因');
       
    }



    /**
     * 确认订单
     */
    public function order_receiveOp() {
        $model_order = Model('order');
        $logic_order = Logic('order');
        $order_id = intval($_GET['order_id']);
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = $_SESSION['member_id'];
        $order_info = $model_order->getOrderInfo($condition);
        $if_allow = $model_order->getOrderOperateState('receive',$order_info);
        if (!$if_allow){
            showWapMessage('无权操作','','error');
        }
        $result = $logic_order->changeOrderStateReceive($order_info,'buyer', $_SESSION['member_name'], '其它原因');
        if(!$result['state']) {
            showWapMessage($result['msg'],'','error');
        } else {
            showWapMessage('操作成功');
        }
    }
    

	/**
     * 订单详细
     *
     */
    public function show_orderOp() {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            showWapMessage('该订单不存在','','error');
        }
        $model_order = Model('order');
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = $_SESSION['member_id'];
        $order_info = $model_order->getOrderInfo($condition,array('order_goods','order_common','store'));
        if (empty($order_info) || $order_info['delete_state'] == ORDER_DEL_STATE_DROP) {
            showWapMessage('该订单不存在','','error');
        }

        $model_refund_return = Model('refund_return');
        $order_list = array();
        $order_list[$order_id] = $order_info;
        $order_list = $model_refund_return->getGoodsRefundList($order_list,1);//订单商品的退款退货显示
        $order_info = $order_list[$order_id];
        $refund_all = $order_info['refund_list'][0];
        if (!empty($refund_all) && $refund_all['seller_state'] < 3) {//订单全部退款商家审核状态:1为待审核,2为同意,3为不同意
            Tpl::output('refund_all',$refund_all);
        }

        //显示锁定中
        $order_info['if_lock'] = $model_order->getOrderOperateState('lock',$order_info);

        //显示取消订单
        $order_info['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$order_info);

        //显示退款取消订单
        $order_info['if_refund_cancel'] = $model_order->getOrderOperateState('refund_cancel',$order_info);

        //显示投诉
        $order_info['if_complain'] = $model_order->getOrderOperateState('complain',$order_info);

        //显示收货
        $order_info['if_receive'] = $model_order->getOrderOperateState('receive',$order_info);

        //显示物流跟踪
        $order_info['if_deliver'] = $model_order->getOrderOperateState('deliver',$order_info);

        //显示评价
        $order_info['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order_info);

        //显示分享
        $order_info['if_share'] = $model_order->getOrderOperateState('share',$order_info);

        //显示系统自动取消订单日期
        if ($order_info['order_state'] == ORDER_STATE_NEW) {
            //$order_info['order_cancel_day'] = $order_info['add_time'] + ORDER_AUTO_CANCEL_DAY * 24 * 3600;
			// by abc.com
			// $order_info['order_cancel_day'] = $order_info['add_time'] + ORDER_AUTO_CANCEL_DAY + 3 * 24 * 3600;
            foreach ($order_info['extend_order_goods'] as $v) {
                if($v['goods_type'] == 6){
                    $miaosha_order_type = true;
                }
            }

            if($order_info['payment_code'] == 'bank'){
                $zhuanzhanghuikuan = true;
            }

            if($miaosha_order_type === true){
                $order_info['order_cancel_day'] = $order_info['add_time'] + 60*60;
            }elseif($zhuanzhanghuikuan === true){
                $order_info['order_cancel_day'] = $order_info['add_time'] + 60*60*72;
            }else{
                $order_info['order_cancel_day'] = $order_info['add_time'] + 60*60*24;
            }
            
        }

        //显示快递信息
        if ($order_info['shipping_code'] != '') {
            $express = rkcache('express',true);
            $order_info['express_info']['e_code'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_code'];
            $order_info['express_info']['e_name'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_name'];
            $order_info['express_info']['e_url'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_url'];
        }

        //显示系统自动收获时间
        if ($order_info['order_state'] == ORDER_STATE_SEND) {
           //$order_info['order_confirm_day'] = $order_info['delay_time'] + ORDER_AUTO_RECEIVE_DAY * 24 * 3600;
			//by abc.com
			$order_info['order_confirm_day'] = $order_info['delay_time'] + ORDER_AUTO_RECEIVE_DAY + 15 * 24 * 3600;
        }

        //如果订单已取消，取得取消原因、时间，操作人
        if ($order_info['order_state'] == ORDER_STATE_CANCEL) {
            $order_info['close_info'] = $model_order->getOrderLogInfo(array('order_id'=>$order_info['order_id']),'log_id desc');
        }

        foreach ($order_info['extend_order_goods'] as $value) {
            $value['image_60_url'] = cthumb($value['goods_image'], 60, $value['store_id']);
            $value['image_240_url'] = cthumb($value['goods_image'], 240, $value['store_id']);
            $value['goods_type_cn'] = orderGoodsType($value['goods_type']);
            $value['goods_url'] = urlShop('goods','index',array('goods_id'=>$value['goods_id']));
            if ($value['goods_type'] == 5) {
                $order_info['zengpin_list'][] = $value;
            } else {
                $order_info['goods_list'][] = $value;
            }
        }

        if (empty($order_info['zengpin_list'])) {
            $order_info['goods_count'] = count($order_info['goods_list']);
        } else {
            $order_info['goods_count'] = count($order_info['goods_list']) + 1;
        }
        Tpl::output('order_info',$order_info);

        //卖家发货信息
        if (!empty($order_info['extend_order_common']['daddress_id'])) {
            $daddress_info = Model('daddress')->getAddressInfo(array('address_id'=>$order_info['extend_order_common']['daddress_id']));
            Tpl::output('daddress_info',$daddress_info);
        }
		
			Tpl::output('nav_title','订单详情');
		Tpl::output('no_footer',true);
		Tpl::showpage('member_order.show');
    }

	
}
