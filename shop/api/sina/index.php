<?php
session_start();
//判断是否已经登录
file_put_contents('session1.txt',print_r($_SESSION,true),FILE_APPEND);
unset($_SESSION['slast_key']);
if(isset($_SESSION['slast_key'])) 
{
	@header("Location:".SHOP_SITE_URL);
	exit;
}
include_once(BASE_PATH.DS.'api'.DS.'sina'.DS.'config.php' );
include_once(BASE_PATH.DS.'api'.DS.'sina'.DS.'saetv2.ex.class.php' );
$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
@header("location:$code_url");
exit;
?>