<?php
include('weixin.sdk.class.php');
$weixin = new weixinSDK;
$token = $weixin->__get('token');
/*
$returnURL = 'http://m.96567.com/weixin/getCode.php';
//$weixin->sendMessage('op6P9t1Q3BiQLNj6b-V-e1iFyLLA','我是一个微信消息哦!');
$weixin->getCode($returnURL);
*/
?>
<form action="sucai.class.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <input type="file" name="f" id="f" />
  <input type="submit" name="button" id="button" value="提交" />
</form>