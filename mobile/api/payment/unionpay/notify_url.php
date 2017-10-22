<?php
/**
 * 支付宝通知地址
 *
 * 
 
 */
$_GET['act']	= 'payment';
$_GET['op']		= 'notify_unionpay';
$_GET['payment_code'] = 'unionpay';
require_once(dirname(__FILE__).'/../../../index.php');
?>