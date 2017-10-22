<?php
//判断是否已经登录
if(isset($_SESSION['slast_key'])) 
{
	header("Location:".SHOP_SITE_URL."/index.php");
	exit;	
}
include_once(BASE_PATH.DS.'api'.DS.'sina'.DS.'config.php');
include_once(BASE_PATH.DS.'api'.DS.'sina'.DS.'saetv2.ex.class.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY);
///////////code需要传递////////////
if (isset($_REQUEST['code'])) {
	$keys = array();
	$keys['code'] = $_REQUEST['code'];
	$keys['redirect_uri'] = WB_CALLBACK_URL;
	try {
		$token = $o->getAccessToken( 'code', $keys ) ;
		file_put_contents('token.txt',print_r($token,true),FILE_APPEND);
	} catch (OAuthException $e) {
	}
}

if ($token) {
	$_SESSION['slast_key'] = $token;
	setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
	setcookie('cid',$o->client_id);//盛威添加 2015-11-25
	@header('location: index.php?act=sconnect');
	exit;
} else { echo "授权失败。"; }
