<?php
/* *
 * 功能：支付宝服务器异步通知页面
 */


$_GET['act'] = 'payment';
$_GET['op']	= 'notify';
$_GET['payment_code']	= 'alipay';
$_GET['payment_code_app']	= 'alipay_app';


file_put_contents('notify_alipay_app_.txt',print_r($_GET,true),FILE_APPEND);
file_put_contents('notify_alipay_app_.txt',print_r($_POST,true),FILE_APPEND);


require_once(dirname(__FILE__).'/../../../index.php');
?>
