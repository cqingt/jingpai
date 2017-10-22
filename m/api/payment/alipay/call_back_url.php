<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 */

$_GET['act'] = 'payment';
$_GET['op']	= 'return';
$_GET['payment_code']	= 'alipay';

file_put_contents('alipay_app_.txt',print_r($_GET,true),FILE_APPEND);
file_put_contents('alipay_app_.txt',print_r($_POST,true),FILE_APPEND);


require_once(dirname(__FILE__).'/../../../index.php');
?>
