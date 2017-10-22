<?php
require_once(dirname(__FILE__)."/../../../model/class/weixin/weixin.sdk.class.php");
class weixinAPI{

	/**
	 * @ 发送获取OpenID数据
	 * @ $backURL返回地址，返回后获取OpenID
	 */
	public function sendOpenIDInfo($backURL){
		$weixin = new weixinSDK;
		if(!$backURL){ $backURL = W_DOMAIN; }
		$weixin->getCode($backURL);
	}
	public function go(){
		$this->sendOpenIDInfo(G('backURL',2));
	}
	
	/**
	 * @ 接受OpenID信息
	 */
	public function getOpenID(){
		$weixin = new weixinSDK;	
		$code = $_GET['code'];
		$weixin->getOpenID($code);
		return $weixin->openid;
	}
}

?>