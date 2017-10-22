<?php
/**
 * 支付行为
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class paymentLogic {

    /**
     * 取得实物订单所需支付金额等信息
     * @param int $pay_sn
     * @param int $member_id
     * @return array
     */
    public function getRealOrderInfo($pay_sn, $member_id = null) {
    
        //验证订单信息
        $model_order = Model('order');
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        if (!empty($member_id)) {
            $condition['buyer_id'] = $member_id;
        }
        $order_pay_info = $model_order->getOrderPayInfo($condition);
        if(empty($order_pay_info)){
            return callback(false,'该支付单不存在');
        }

        $order_pay_info['subject'] = '实物订单_'.$order_pay_info['pay_sn'];
        $order_pay_info['order_type'] = 'real_order';

        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $order_list = $model_order->getNormalOrderList($condition);
		
		
        //计算本次需要在线支付的订单总金额
        $pay_amount = 0;
        if (!empty($order_list)) {
            foreach ($order_list as $order_info) {
				//计算所需要支付金额(支付卡+余额支付了)//zmr>v60
                $money_paid = Model('crm')->getPaidMoneyByOrderId($order_info['order_id']);//获取订单已付款字段 add xin 20151117
		        $payed_amount = floatval($order_info['rcb_amount']) + floatval($order_info['pd_amount'])+floatval($money_paid);
				//排除货到付款的金额
				if ($order_info['payment_code'] != 'offline') {
					$pay_amount += ncPriceFormat(floatval($order_info['order_amount']) - $payed_amount);
				}
		        //zmr<v60
                //$pay_amount += ncPriceFormat(floatval($order_info['order_amount']) - floatval($order_info['pd_amount']));
            }            
        }

        $order_pay_info['api_pay_amount'] = $pay_amount;
        $order_pay_info['order_list'] = $order_list;
    
        return callback(true,'',$order_pay_info);
    }

    /**
     * 取得虚拟订单所需支付金额等信息
     * @param int $order_sn
     * @param int $member_id
     * @return array
     */
    public function getVrOrderInfo($order_sn, $member_id = null) {
    
        //验证订单信息
        $model_order = Model('vr_order');
        $condition = array();
        $condition['order_sn'] = $order_sn;
        if (!empty($member_id)) {
            $condition['buyer_id'] = $member_id;
        }
        $order_info = $model_order->getOrderInfo($condition);
        if(empty($order_info)){
            return callback(false,'该订单不存在');
        }

        $order_info['subject'] = '虚拟订单_'.$order_sn;
        $order_info['order_type'] = 'vr_order';
        $order_info['pay_sn'] = $order_sn;




         //计算所需要支付金额(支付卡+余额支付了)//zmr>v60
        $payed_amount = floatval($order_info['rcb_amount']) + floatval($order_info['pd_amount']);
		$pay_amount += ncPriceFormat(floatval($order_info['order_amount']) - $payed_amount);
		 //zmr<v60
				
        //计算本次需要在线支付的订单总金额
        //$pay_amount = ncPriceFormat(floatval($order_info['order_amount']) - floatval($order_info['pd_amount']));

        $order_info['api_pay_amount'] = $pay_amount;
    
        return callback(true,'',$order_info);
    }

    /**
     * 取得充值单所需支付金额等信息
     * @param int $pdr_sn
     * @param int $member_id
     * @return array
     */
    public function getPdOrderInfo($pdr_sn, $member_id = null) {

        $model_pd = Model('predeposit');
        $condition = array();
        $condition['pdr_sn'] = $pdr_sn;
        if (!empty($member_id)) {
            $condition['pdr_member_id'] = $member_id;
        }

        $order_info = $model_pd->getPdRechargeInfo($condition);
        if(empty($order_info)){
            return callback(false,'该订单不存在');
        }

        $order_info['subject'] = '预存款充值_'.$order_info['pdr_sn'];
        $order_info['order_type'] = 'pd_order';
        $order_info['pay_sn'] = $order_info['pdr_sn'];
        $order_info['api_pay_amount'] = $order_info['pdr_amount'];
        return callback(true,'',$order_info);
    }

    /**
     * 取得所使用支付方式信息
     * @param unknown $payment_code
     */
    public function getPaymentInfo($payment_code) {
        if (in_array($payment_code,array('offline','predeposit')) || empty($payment_code)) {
            return callback(false,'系统不支持选定的支付方式');
        }
        $model_payment = Model('payment');
        $condition = array();
        $condition['payment_code'] = $payment_code;
        $payment_info = $model_payment->getPaymentOpenInfo($condition);
        if(empty($payment_info)) {
            return callback(false,'系统不支持选定的支付方式');
        }

        $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$payment_info['payment_code'].DS.$payment_info['payment_code'].'.php';
        if(!file_exists($inc_file)){
            return callback(false,'系统不支持选定的支付方式');
        }
        require_once($inc_file);
        $payment_info['payment_config']	= unserialize($payment_info['payment_config']);

        return callback(true,'',$payment_info);
    }

    /**
     * 支付成功后修改实物订单状态
     */
    public function updateRealOrder($out_trade_no, $payment_code, $order_list, $trade_no) {
        $post['payment_code'] = $payment_code;
        $post['trade_no'] = $trade_no;
        return Logic('order')->changeOrderReceivePay($order_list, 'system', '系统', $post);
    }

    /**
     * 支付成功后修改虚拟订单状态
     */
    public function updateVrOrder($out_trade_no, $payment_code, $order_info, $trade_no) {
        $post['payment_code'] = $payment_code;
        $post['trade_no'] = $trade_no;
        return Logic('vr_order')->changeOrderStatePay($order_info, 'system', $post);
    }

    /**
     * 支付成功后修改充值订单状态
     * @param unknown $out_trade_no
     * @param unknown $trade_no
     * @param unknown $payment_info
     * @throws Exception
     * @return multitype:unknown
     */
    public function updatePdOrder($out_trade_no,$trade_no,$payment_info,$recharge_info) {

        $condition = array();
        $condition['pdr_sn'] = $recharge_info['pdr_sn'];
        $condition['pdr_payment_state'] = 0;
        $update = array();
        $update['pdr_payment_state'] = 1;
        $update['pdr_payment_time'] = TIMESTAMP;
        $update['pdr_payment_code'] = $payment_info['payment_code'];
        $update['pdr_payment_name'] = $payment_info['payment_name'];
        $update['pdr_trade_sn'] = $trade_no;

        $model_pd = Model('predeposit');
        try {
            $model_pd->beginTransaction();
			$pdnum=$model_pd->getPdRechargeCount(array('pdr_sn'=>$recharge_info['pdr_sn'],'pdr_payment_state'=>1));
			if (intval($pdnum)>0) {
                throw new Exception('订单已经处理');
            }
            //更改充值状态
            $state = $model_pd->editPdRecharge($update,$condition);
            if (!$state) {
                throw new Exception('更新充值状态失败');
            }
            //变更会员预存款
            $data = array();
            $data['member_id'] = $recharge_info['pdr_member_id'];
            $data['member_name'] = $recharge_info['pdr_member_name'];
            $data['amount'] = $recharge_info['pdr_amount'];
            $data['pdr_sn'] = $recharge_info['pdr_sn'];
            $model_pd->changePd('recharge',$data);
            $model_pd->commit();
            return callback(true);

        } catch (Exception $e) {
            $model_pd->rollback();
            return callback(false,$e->getMessage());
        }
    }

    //add 拍卖惠订单  xin  20151026
    /**
     * 取得拍卖惠订单所需支付金额信息
     * @param int $pdr_sn
     * @param int $member_id
     * @return array
     */
    public function getLepaiOrderInfo($pay_sn) {

        $h_model = Model('lepai_home');

        $order_info = $h_model->getLepaiOrderOne(array('pay_sn'=>$pay_sn));
        if(empty($order_info)){
            return callback(false,'该订单不存在');
        }

        $order_info['subject'] = '拍卖惠订单_'.$pay_sn;
        $order_info['order_type'] = 'lepai_order';
        $order_info['pay_sn'] = $pay_sn;
        //网上支付金额等于订单金额减去充值卡支付金额及余额支付金额
        $order_info['api_pay_amount'] = $order_info['order_amount'] - $order_info['rcb_amount'] - $order_info['pd_amount'];
        return callback(true,'',$order_info);
    }

    /**
     * 支付成功后修改实物订单状态
     */
    public function updateLepaiOrder($out_trade_no, $payment_code, $order_info, $trade_no) {

        $h_model = Model('lepai_home');

        try {
            $h_model->beginTransaction();

            $model_pd = Model('predeposit');
            $rcb_amount = floatval($order_info['rcb_amount']);
            if ($rcb_amount > 0) {
                $data_pd = array();
                $data_pd['member_id'] = $order_info['buyer_id'];
                $data_pd['member_name'] = $order_info['buyer_name'];
                $data_pd['amount'] = $rcb_amount;
                $data_pd['order_sn'] = $order_info['order_sn'];
                $model_pd->changeRcb('order_comb_pay',$data_pd);
            }

            //下单，支付被冻结的预存款
            $pd_amount = floatval($order_info['pd_amount']);
            if ($pd_amount > 0) {
                $data_pd = array();
                $data_pd['member_id'] = $order_info['buyer_id'];
                $data_pd['member_name'] = $order_info['buyer_name'];
                $data_pd['amount'] = $pd_amount;
                $data_pd['order_sn'] = $order_info['order_sn'];
                $model_pd->changePd('order_comb_pay',$data_pd);
            }


            //更新订单状态
            $update_order = array();
            $update_order['order_state'] = ORDER_STATE_PAY;
            $update_order['payment_time'] = TIMESTAMP;
            $update_order['payment_code'] = $payment_code;
            $update_order['trade_no'] = $trade_no;
            $update = $h_model->updateLepaiOrder($update_order,array('pay_sn'=>$order_info['pay_sn']));
            if (!$update) {
                throw new Exception('更新订单操作失败');
            }

            //获取用户保证金 如果是收藏币就退回
            $baoming = $h_model->getLepaiBaoming(array('auction_id'=>$order_info['lepai_goods_id'],'member_id'=>$order_info['buyer_id'],'is_return'=>'0'));
            if($baoming['type'] == 2){
                //变更积分
                if($baoming['amount'] > 0){
                    $points_arr = array();
                    $points_arr['pl_memberid'] = $order_info['buyer_id'];
                    $points_arr['pl_membername'] = $order_info['buyer_name'];
                    $points_arr['pl_points'] = intval($baoming['amount']);
                    $points_arr['pl_desc'] = '【解冻】拍卖惠活动结束退还收藏币保证金，活动编号：'.$order_info['lepai_goods_id'];
                    $res = Model('points')->savePointsLog('other',$points_arr);
                    if(!$res){
                        throw new Exception('解冻会员积分失败');
                    }
                }

            }

            $h_model->commit();
        } catch (Exception $e) {
            $h_model->rollback();
            return callback(false,$e->getMessage());
        }


        // 支付成功发送买家消息
        $param = array();
        $param['code'] = 'order_payment_success';
        $param['member_id'] = $order_info['buyer_id'];
        $param['param'] = array(
            'order_sn' => $order_info['order_sn'],
            'order_url' => urlShop('lepai_order', 'show_order', array('order_id' => $order_info['order_id']))
        );
        QueueClient::push('sendMemberMsg', $param);

        /*
        // 支付成功发送店铺消息
        $param = array();
        $param['code'] = 'new_order';
        $param['store_id'] = $order_info['store_id'];
        $param['param'] = array(
            'order_sn' => $order_info['order_sn']
        );
        QueueClient::push('sendStoreMsg', $param);
        */
        return callback(true,'操作成功');

    }
    //add end
}