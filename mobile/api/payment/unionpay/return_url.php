<?php
/**
 * 支付宝返回地址
 *
 * 
 
 */
$_GET['act']	= 'payment';
$_GET['op']		= 'return_unionpay';
$_GET['payment_code'] = 'unionpay';

require_once(dirname(__FILE__).'/../../../index.php');
?>