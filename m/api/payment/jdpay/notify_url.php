<?php
/**
 * 网银在线返回地址
 *
 * 
 
 */
error_reporting(7);
require_once dirname(__FILE__).'/config/DesUtils.php';
class WebAsynNotificationCtrl {

	public function xml_to_array($xml) {
		$array = ( array ) (simplexml_load_string ( $xml ));
		foreach ( $array as $key => $item ) {
			$array [$key] = $this->struct_to_array ( ( array ) $item );
		}
		return $array;
	}
	public function struct_to_array($item) {
		if (! is_string ( $item )) {
			$item = ( array ) $item;
			foreach ( $item as $key => $val ) {
				$item [$key] = $this->struct_to_array ( $val );
			}
		}
		return $item;
	}

	/**
	 * 签名
	 */
	public function generateSign($data, $md5Key) {
		$sb = $data ['VERSION'] [0] . $data ['MERCHANT'] [0] . $data ['TERMINAL'] [0] . $data ['DATA'] [0] . $md5Key;
		
		return md5 ( $sb );
	}
	public function execute($md5Key, $desKey,$resp) {
		// 获取通知原始信息
		if (null == $resp) {
			return;
		}
		// 解析XML
		$params = $this->xml_to_array ( base64_decode ( $resp ) );
		$ownSign = $this->generateSign ( $params, $md5Key );
		$params_json = json_encode ( $params );
		if ($params ['SIGN'] [0] == $ownSign) {
			// 验签成功，业务处理
			// 对Data数据进行解密
			$des = new DesUtils (); // （秘钥向量，混淆向量）
			$decryptArr = $des->decrypt ( $params ['DATA'] [0], $desKey ); // 加密字符串
			$params ['data'] = $decryptArr;
			return $this->xml_to_array($params['data']);
		} else {
			return "签名验证错误!" . "\n";
		}
		
	}
}
$MD5_KEY = "SrBmMfqcEdnAVWkOrVocShIxekeggAQl";
$DES_KEY = "04qzLATjSn/LW4M3/RwCkbXvoj6S91Hy";
$w = new WebAsynNotificationCtrl ();
$res = $w->execute ($MD5_KEY,$DES_KEY,$_POST["resp"]);
$_GET['act']	= 'payment';
$_GET['op']		= 'notify';
$_GET['payment_code'] = 'jdpay';
//赋值，方便后面合并使用支付宝验证方法
$tradeNum = explode('-',$res['TRADE']['ID']);
$_POST['out_trade_no'] = $tradeNum[0];
$_POST['extra_common_param'] = $tradeNum[1];
$_POST['trade_no'] = $tradeNum[0];
require_once(dirname(__FILE__).'/../../../index.php');
?>