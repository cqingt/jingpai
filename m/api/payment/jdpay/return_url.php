<?php
/**
 * 网银在线返回地址
 *
 * 
 
 */
error_reporting(7);
sleep(2);
$_GET['act']	= 'payment';
$_GET['op']		= 'return';
$_GET['payment_code'] = 'jdpay';
//赋值，方便后面合并使用支付宝验证方法
$tradeNum = explode('-',$_GET['tradeNum']);
$_GET['out_trade_no'] = $tradeNum[0];
$_GET['extra_common_param'] = $tradeNum[1];
$_GET['trade_no'] = $tradeNum[0];
require_once(dirname(__FILE__).'/../../../index.php');
?>