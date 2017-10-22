<?php
/**
 * 接收微信支付异步通知回调地址

 */

$_GET['act']	= 'payment';
$_GET['op']		= 'notify';
$_GET['payment_code'] = 'wxpay';
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
//file_put_contents('wx_notify',print_r($postStr,true),FILE_APPEND);

$array_data = json_decode(json_encode(simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

foreach($array_data as $k=>$v){
    $_POST[$k] = $v;
}
require_once(dirname(__FILE__).'/../../../../index.php');
