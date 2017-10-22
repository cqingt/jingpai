<?php 
/**
 * 京东支付接口
 *
 */
defined('InShopNC') or exit('Access Invalid!');
require_once BASE_PATH.'/api/payment/jdpay/config/RSAUtils.php';
require_once BASE_PATH.'/api/payment/jdpay/config/DesUtils.php';
class jd{

    /**
     * 存放支付订单信息
     * @var array
     */
    private $_order_info = array();
    public function __construct($payment_info,$order_info){
    	$this->chinabank($payment_info,$order_info);
    }

	public function chinabank($payment_info = array(),$order_info = array()){
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
		$param["failCallbackUrl"] = 'http://m.96567.com/'; //支付失败时跳转到商户的URL
		$param["merchantNum"] = '110008151008'; //商户号
		$param["merchantRemark"] = '备注'; //商户备注信息
		$param["notifyUrl"] = SHOP_SITE_URL."/api/payment/chinabank/notify_url.php"; //异步通知地址
		$param["successCallbackUrl"] = SHOP_SITE_URL."/api/payment/jdpay/return_url.php"; //支付成功页面跳转路径
		$param["tradeAmount"] = 1;  //交易金额
		$param["tradeDescription"] ='描述'; //交易描述
		$param["tradeName"] = '商户提供的订单的标题/商品名称/关键字等'; //交易名称
		$param["tradeNum"] = $this->order['pay_sn']; //交易流水号
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
	public function return_verify($md5Key, $desKey,$resp){
		// 获取通知原始信息
		echo "异步通知原始数据:" . $resp . "\n";
		if (null == $resp) {
			return;
		}

		// 获取配置密钥
		echo "desKey:" . $desKey . "\n";
		echo "md5Key:" . $md5Key . "\n";
		// 解析XML
		$params = $this->xml_to_array ( base64_decode ( $resp ) );

		$ownSign = $this->generateSign ( $params, $md5Key );
		$params_json = json_encode ( $params );
		echo "解析XML得到对象:" . $params_json . '\n';
		echo "根据传输数据生成的签名:" . $ownSign . "\n";
		
		if ($params ['SIGN'] [0] == $ownSign) {
			// 验签不对
			echo "签名验证正确!" . "\n";
		} else {
			echo "签名验证错误!" . "\n";
			return;
		}
		// 验签成功，业务处理
		// 对Data数据进行解密
		$des = new DesUtils (); // （秘钥向量，混淆向量）
		$decryptArr = $des->decrypt ( $params ['DATA'] [0], $desKey ); // 加密字符串
		echo "对<DATA>进行解密得到的数据:" . $decryptArr . "\n";
		$params ['data'] = $decryptArr;
		echo "最终数据:" . json_encode ( $params ) . '\n';
		echo "**********接收异步通知结束。**********";
		
		return;
	}

    public function notify_verify() {
        return $this->return_verify($MD5_KEY,$DES_KEY,$_POST ( "resp" ));
    }
	
	public function xml_to_array($xml){
		$array = (array)(simplexml_load_string ($xml));
		foreach ($array as $key => $item){
			$array[$key] = $this->struct_to_array ((array)$item);
		}
		return $array;
	}
	public function struct_to_array($item){
		if (!is_string($item)) {
			$item = (array)$item;
			foreach($item as $key => $val){
				$item [$key] = $this->struct_to_array ($val);
			}
		}
		return $item;
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
