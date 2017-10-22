<?php 
/**
 * 微信扫码支付
 *
 */
defined('InShopNC') or exit('Access Invalid!');
require_once BASE_PATH.'/api/payment/wxpay/weixin.pay.class.php';

class wxpay extends weixinPAYBASE{

    /**
     * 存放支付订单信息
     * @var array
     */
    private $_order_info = array();

    /**
     * 支付信息初始化
     * @param array $payment_info
     * @param array $order_info
     */
    public function __construct($payment_info = array(), $order_info = array()) {

        define('WXN_APPID', $payment_info['payment_config']['wxpay_appid']);
        define('WXN_MCHID', $payment_info['payment_config']['wxpay_mch_id']);
        define('WXN_KEY', $payment_info['payment_config']['wxpay_key']);
        parent::__construct($_COOKIE['openid']);
        $this->_order_info = $order_info;
    }

    /**
     * 组装包含支付信息的url
     */
    public function submit() {

        $this->setParameter('attach',$this->_order_info['order_type']);          //支付类型，判定订单类型
        $this->setParameter('body','收藏天下'.$this->_order_info['subject']);                //订单名称
        $this->setParameter('out_trade_no',$this->_order_info['pay_sn']);//订单号
        $this->setParameter('total_fee',$this->_order_info['api_pay_amount']*100);//将金额换算成分
        $this->setParameter('notify_url','http://'.$_SERVER['HTTP_HOST'].'/mobile/api/payment/wxpay/notify_url.php');//通知页面
        $this->setParameter('trade_type','JSAPI');
        $this->send_pay();
        $jsPayStr = $this->cretaePayJs();
        return $jsPayStr;
    }
}
