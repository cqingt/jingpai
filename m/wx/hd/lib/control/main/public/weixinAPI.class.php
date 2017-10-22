<?php
require_once(dirname(__FILE__)."/../../../model/class/weixin/weixin.sdk.class.php");
class weixinAPI{
	private $weixin;
	
	public function __construct(){
		$this->weixin = new weixinSDK;
	}

	/**
	 * @ 发送获取OpenID数据
	 * @ $backURL返回地址，返回后获取OpenID
	 */
	public function sendOpenIDInfo($backURL=''){
		if($backURL){
			$this->weixin->getCode($backURL);
		}
	}

	public function go(){
		$this->sendOpenIDInfo($_GET['backURL']);
	}
	
	/**
	 * @ 接受OpenID信息
	 */
	public function getOpenID(){
		$code = $_GET['code'];
		$this->weixin->getOpenID($code);
		return $this->weixin->openid;
	}

	/**
	 * @ 通过openid获取用户基本信息
	 */
	public function getWeixinUserInfo($openid){
		$arr = $this->weixin->getUserInfo($openid);
		$dataArr['openid'] = $arr['openid'];
		$dataArr['guanzhu'] = intval($arr['subscribe']);
		$dataArr['nickname'] = iconv('utf-8','gbk',$arr['nickname']);
		$dataArr['sex'] = $arr['sex'];
		$dataArr['city'] = iconv('utf-8','gbk',$arr['city']);
		$dataArr['province'] = iconv('utf-8','gbk',$arr['province']);
		$dataArr['country'] = iconv('utf-8','gbk',$arr['country']);
		$dataArr['img'] = iconv('utf-8','gbk',$arr['headimgurl']);
		$dataArr['guanzhu_time'] = iconv('utf-8','gbk',$arr['subscribe_time']);
		return $dataArr; 
	}

	/**
	 * @ 发送获取openid的请求
	 */
	public function sendOpenID($backURL=''){
		if($_SERVER['QUERY_STRING']){ $queryString = '?'.$_SERVER['QUERY_STRING']; }
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$queryString;//获取当前页面完整URL地址
		$backURL = $backURL ? $backURL : $url;
		$this->sendOpenIDInfo($backURL);
	}

	/**
	 * @ 跳转到授权页
	 */
	public function sq(){
		if($_SERVER['QUERY_STRING']){ $queryString = '?'.$_SERVER['QUERY_STRING']; }
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$queryString;//获取当前页面完整URL地址
		$this->weixin->oauth($url);
	}

	public function getOauthUserInfo($code){
		$arr = $this->weixin->getOauthUserInfo($code);
		$dataArr['openid'] = $arr['openid'];
		$dataArr['guanzhu'] = intval($arr['subscribe']);
		$dataArr['nickname'] = iconv('utf-8','gbk',$arr['nickname']);
		$dataArr['sex'] = $arr['sex'];
		$dataArr['city'] = iconv('utf-8','gbk',$arr['city']);
		$dataArr['province'] = iconv('utf-8','gbk',$arr['province']);
		$dataArr['country'] = iconv('utf-8','gbk',$arr['country']);
		$dataArr['img'] = iconv('utf-8','gbk',$arr['headimgurl']);
		$dataArr['guanzhu_time'] = iconv('utf-8','gbk',$arr['subscribe_time']);
		return $dataArr;
	}

	/**
	 * @ 获取微信jsAPI信息
	 */
	public function getJsAPI(){
		$arr['ticket'] = $this->weixin->getJsApi();
		$arr['timestamp'] = time();
		$arr['appId'] = $this->weixin->app_id;
		$arr['nonceStr'] = $this->createStr();
		
		return $this->createSignature($arr);
	}

	/**
	 * @ 生成signature
	 */
	private function createSignature($arr){
		if($_SERVER['QUERY_STRING']){
			$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		}else{
			$url = $_SERVER['HTTP_HOST'].'/hd/';
		}
		
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