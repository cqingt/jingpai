<?php 
/**
 * 京东支付接口
 *
 */
defined('InShopNC') or exit('Access Invalid!');
require_once BASE_PATH.'/api/payment/jdpay/config/RSAUtils.php';
require_once BASE_PATH.'/api/payment/jdpay/config/DesUtils.php';
class jdpay{

    /**
     * 存放支付订单信息
     * @var array
     */
    public function __construct($payment_info,$order_info){
    	$this->jdbank($payment_info,$order_info);
    }

	public function jdbank($payment_info = array(),$order_info = array()){
    	if(!empty($payment_info) and !empty($order_info)){
    		$this->payment	= $payment_info;
    		$this->order	= $order_info;
    	}
    }

    /**
     * 组装包含支付信息的url
     */
    public function submit() {
        $param = array();
		$param["currency"] = 'CNY'; //货币类型，固定填CNY
		$param["failCallbackUrl"] = 'http://m.96567.com/api/payment/jdpay/return_url.php'; //支付失败时跳转到商户的URL
		$param["merchantNum"] = '110008151008'; //商户号
		$param["merchantRemark"] = '支付单号:'.$this->order['pay_sn']; //商户备注信息
		$param["notifyUrl"] = "http://m.96567.com/api/payment/jdpay/notify_url.php"; //异步通知地址
		$param["successCallbackUrl"] = "http://m.96567.com/api/payment/jdpay/return_url.php"; //支付成功页面跳转路径
		$param["tradeAmount"] = $this->order['api_pay_amount']*100;  //交易金额
		$param["tradeDescription"] =''; //交易描述
		$param["tradeName"] = '收藏天下'; //交易名称
		$param["tradeNum"] = $this->order['pay_sn'].'-'.$this->order['order_type']; //交易流水号
		$param["tradeTime"] = date("Y-m-d H:i:s",time());
		$param["version"] = '1.0'; //版本号
		$param["token"] = ''; //用户交易令牌
		$sign = $this->sign($param);
		$param["merchantSign"] = $sign;
		$html = '<html><head></head><body>';
		$html .= '<form method="post" name="E_FORM" action="https://m.jdpay.com/wepay/web/pay">';
		foreach ($param as $key => $val){
			$html .= "<input type='hidden' name='$key' value='$val' />";
		}
		$html .= '</form><script type="text/javascript">document.E_FORM.submit();</script>';
		$html .= '</body></html>';
		echo $html;
		exit;
        
    }

	/**
	 * 返回地址验证(同步)
	 *
	 * @param 
	 * @return boolean
	 */
    public function return_verify() {
        $param = array();
		$param["token"] = $_GET["token"];
		$param["tradeAmount"] = $_GET["tradeAmount"];
		$param["tradeCurrency"] = $_GET["tradeCurrency"];
		$param["tradeDate"] = $_GET["tradeDate"];
		$param["tradeNote"] = $_GET["tradeNote"];
		$param["tradeNum"] = $_GET["tradeNum"];
		$param["tradeStatus"] = $_GET["tradeStatus"];
		$param["tradeTime"] = $_GET["tradeTime"];
		$unSignKeyList = array (
			"merchantSign",
			"version", 
			"successCallbackUrl",
			"forPayLayerUrl"
		);
		$data = $this->signString ($param,$unSignKeyList);
		error_log($data, 0);
		//1.解密签名内容
		$decryptStr = RSAUtils::decryptByPublicKey($_GET["sign"]);
		//2.对data进行sha256摘要加密
		$sha256SourceSignString = hash ( "sha256",$data);
		error_log($decryptStr, 0);
		error_log($sha256SourceSignString, 0);
		//3.比对结果
		if ($decryptStr == $sha256SourceSignString) {
			return true;
		}else{
			return false;
		}
    }

	/**
	 * 返回地址验证(异步)
	 *
	 * @param 
	 * @return boolean
	 */
	
	public function notify_verify() {
		return true;
    }
	


	/**
	 * 签名
	 *
	 * @author wylitu
	 *        
	 */
	public function sign($params) {
		$unSignKeyList = array (
			"merchantSign",
			"token",
			"version" 
		);
		ksort($params);
  		$sourceSignString = $this->signString( $params,$unSignKeyList );
  		$sha256SourceSignString = hash ( "sha256", $sourceSignString );	
        return RSAUtils::encryptByPrivateKey($sha256SourceSignString);
	}

	public function signString($params, $unSignKeyList) {
		
		// 拼原String
		$sb = "";
		// 删除不需要参与签名的属性
		foreach ( $params as $k => $arc ) {
			for($i = 0; $i < count ( $unSignKeyList ); $i ++) {
				
				if ($k == $unSignKeyList [$i]) {
					unset ( $params [$k] );
				}
			}
		}
		
		foreach ( $params as $k => $arc ) {
			
			$sb = $sb . $k . "=" . ($arc == null ? "" : $arc) . "&";
		}
		// 去掉最后一个&
		$sb = substr ( $sb, 0, - 1 );
		
		return $sb;
	}
}
