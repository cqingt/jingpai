<?php
include('../weixin.sdk.class.php');
$weixin = new weixinSDK;

$redirect_uri = trim($_GET['url']);
setCookie('url',$redirect_uri);


/*2015-11-18 Add is name Lt shopnc get openid*/
$type = trim($_GET['type']);
setCookie('type',$type);


$rurl = trim($_GET['rurl']);
setCookie('rurl',$rurl);
/*End*/

$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
if(!$_GET['code']){
	$weixin->getCode($url);
}else{
	$weixin->getOpenID($_GET['code']);
	if($_COOKIE['type'] == 'shopnc'){
		$ul = urldecode($_COOKIE['rurl']).'&url='.urlencode($_COOKIE['url']).'&openid='.$weixin->openid;
		header('location:'.urldecode($_COOKIE['rurl']).'&url='.urlencode($_COOKIE['url']).'&openid='.$weixin->openid);
		exit;
	}
	header('location:'.$_COOKIE['url'].'/sw=1yuan&openid='.$weixin->openid);
}
?>