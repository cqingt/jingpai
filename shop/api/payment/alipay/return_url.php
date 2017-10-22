<?php
/**
 * 支付宝返回地址
 *
 * 
 
 */
$_GET['act']	= 'payment';
$_GET['op']		= 'return';
$_GET['payment_code'] = 'alipay';

file_put_contents('alipay_get_re.txt',print_r($_GET,true),FILE_APPEND);

file_put_contents('alipay_post_re.txt',print_r($_POST,true),FILE_APPEND);


require_once(dirname(__FILE__).'/../../../index.php');
?>