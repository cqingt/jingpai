<?php
/**
 * 支付宝通知地址
 *
 * 
 
 */
$_GET['act']	= 'payment';
$_GET['op']		= 'notify';
$_GET['payment_code'] = 'alipay';

file_put_contents('alipay_get.txt',print_r($_GET,true),FILE_APPEND);

file_put_contents('alipay_post.txt',print_r($_POST,true),FILE_APPEND);

require_once(dirname(__FILE__).'/../../../index.php');
?>