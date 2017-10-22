<?php
class weixinAPI{
	private $weixin;
	
	public function __construct(){
		$this->weixin = new weixinSDK;
	}

	/**
	 * @ 获取微信jsAPI信息
	 */
	public function getJsAPI(){
		$arr['ticket'] = $this->weixin->getJsApi();
		$arr['timestamp'] = time();
		$arr['appId'] = $this->weixin->app_id;
		$arr['nonceStr'] = $this->createStr();
		$arr['weburl'] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		return $this->createSignature($arr);
	}

	/**
	 * @ 生成signature
	 */
	private function createSignature($arr){
		$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$string = "jsapi_ticket=".$arr['ticket']."&noncestr=".$arr['nonceStr']."&timestamp=".$arr['timestamp']."&url=http://".$url;
		$arr['signature'] = sha1($string);
		return $arr;
	}

	/**
	 * @ 生成随机字符串
	 */
	private function createStr($length=16){
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
		  $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
}

?>