<?php
include('weixin.sdk.class.php');
$weixin = new weixinSDK;
$weixin->getOpenID($_GET['code']);
echo $weixin->openid;
//$weixin->sendMessage($weixin->openid,'ÊÚÈ¨³É¹¦!');
?>