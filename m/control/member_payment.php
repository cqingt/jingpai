<?php
/**
 * 支付
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */

//use Shopnc\Tpl;

defined('InShopNC') or exit('Access Invalid!');

class member_paymentControl extends mobileMemberControl {

    private $payment_code = 'alipay';

	public function __construct() {
		parent::__construct();
        $this->payment_code = isset($_GET['payment_code']) && trim($_GET['payment_code']) != '' ? trim($_GET['payment_code']) :'unionpay';
	}

    /**
     * 实物订单支付
     */
    public function payOp() {
	    $pay_sn = $_GET['pay_sn'];

        $model_mb_payment = Model('mb_payment');
        $logic_payment = Logic('payment');

        $condition = array();
        $condition['payment_code'] = $this->payment_code;
        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);
        if(!$mb_payment_info) {
            showWapMessage('系统不支持选定的支付方式','','error');
        }

        //重新计算所需支付金额
        $result = $logic_payment->getRealOrderInfo($pay_sn, $this->member_info['member_id']);

        if(!$result['state']) {
            showWapMessage($result['msg'],'','error');
        }

        //第三方API支付
        $this->_api_pay($result['data'], $mb_payment_info);
    }

    /**
     * 预存款充值
     */
    public function pd_orderOp(){
        $pdr_sn = $_GET['pdr_sn'];
        $payment_code = $this->payment_code;
        $url = urlWap('member','home');

        if(!preg_match('/^\d{18}$/',$pdr_sn)){
            showWapMessage('参数错误','','error');
        }

        $model_mb_payment = Model('mb_payment');
        $logic_payment = Logic('payment');

        $condition = array();
        $condition['payment_code'] = $payment_code;
        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);
        if(!$mb_payment_info) {
            showWapMessage('系统不支持选定的支付方式', '', 'error');
        }

        $payment_info = $mb_payment_info;

        $result = $logic_payment->getPdOrderInfo($pdr_sn,$_SESSION['member_id']);
        if(!$result['state']) {
            showWapMessage($result['msg'],'','error');
        }
        if ($result['data']['pdr_payment_state'] || empty($result['data']['api_pay_amount'])) {
            showWapMessage('该充值单不需要支付', '', 'error');
        }

        //转到第三方API支付
        $this->_api_pay($result['data'], $payment_info);
    }

    //add 拍卖惠 xin 20151024
    /**
     * 拍卖惠订单
     */
    public function lepai_orderOp(){

        $h_model = Model('lepai_home');
        $logic_payment = Logic('payment');

        $pay_sn = $_GET['pay_sn'];
        $payment_code = $_GET['payment_code'];
        $url = urlWap('member','home');

        if(!preg_match('/^\d{18}$/',$pay_sn)){
            showWapMessage('参数错误','','error');
        }

        $orderInfo = $h_model->getLepaiOrderOne(array('pay_sn'=>$pay_sn));

        if($orderInfo['order_id'] < 1){
            showWapMessage('未找到需要支付的订单','','error');
        }

        if($orderInfo['order_state'] !=  10){
            showWapMessage('订单支付状态错误!','','error');
        }

        $model_mb_payment = Model('mb_payment');

        $condition = array();
        $condition['payment_code'] = $payment_code;
        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);
        if(!$mb_payment_info) {
            showWapMessage('系统不支持选定的支付方式','', 'error');
        }
        $payment_info = $mb_payment_info;

        $order_info = array();
        $order_info['pay_sn'] = $orderInfo['pay_sn'];
        $order_info['subject'] = '拍卖惠订单_'.$orderInfo['pay_sn'];
        $order_info['order_type'] = 'lepai_order';
        $order_info['api_pay_amount'] = $orderInfo['order_amount'] - $orderInfo['rcb_amount'] - $orderInfo['pd_amount'];

        //转到第三方API支付
        $this->_api_pay($order_info, $payment_info);
    }

	/**
	 * 第三方在线支付接口
	 *
	 */
	private function _api_pay($order_pay_info, $mb_payment_info) {
        $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$this->payment_code.DS.$this->payment_code.'.php';

    	if(!is_file($inc_file)){
            output_error('支付接口不存在');
    	}
    	require($inc_file);
		if($this->payment_code == 'wxpay'){

            $payment_api = new $this->payment_code($mb_payment_info,$order_pay_info);
            $return = $payment_api->submit();

            Tpl::output('html_title','微信支付页面');

            Tpl::output('jsapi', $return);
            Tpl::showpage('wx_pay');
            exit;
        }else{
            $payment_api = new $this->payment_code($mb_payment_info,$order_pay_info);

            $param = $mb_payment_info['payment_config'];
            $param['order_sn'] = $order_pay_info['pay_sn'];
            $param['order_type'] = $order_pay_info['order_type'];
            $param['order_amount'] = $order_pay_info['api_pay_amount'];

            $return = $payment_api->submit($param);
        }

        echo $return;
    	exit;
	}

    /**
     * 可用支付参数列表
     */
    public function payment_listOp() {
        $model_mb_payment = Model('mb_payment');

        $payment_list = $model_mb_payment->getMbPaymentOpenList();

        $payment_array = array();
        if(!empty($payment_list)) {
            foreach ($payment_list as $value) {
                $payment_array[] = $value['payment_code'];
            }
        }

        output_data(array('payment_list' => $payment_array));
    }

    /**
     * 货到付款页面
     */
    public function payment_bankOp() {
        Tpl::output('html_title','银行转账信息');

        $payment_bank = Model('payment')->getPaymentInfo(array('payment_code'=>'bank'));

        Tpl::output('payment_bank',unserialize($payment_bank['payment_config']));

        Tpl::showpage('buy_bank');
    }

}
