<?php
define('IN_ECS', true);
include_once("../../includes/init.php");
include_once("../../includes/lib_payment.php");
include_once("./WxPayPubHelper/WxPayPubHelper.php");
//使用通用通知接口
$notify = new Wxpay_server_pub();
foreach ($_GET as $key=>$value)  
{
    logger("Key: $key; Value: $value");
}
$xml = $GLOBALS["HTTP_RAW_POST_DATA"];
$notify->saveData($xml);
$log_name="./notify_url.log";//log文件路径
logger($log_name,$xml);
$getData = $notify->getData();

$order_sn_arr = explode('_', $getData['out_trade_no']);
$order_sn		= $order_sn_arr[0];
$pay_id = $order_sn_arr[1];



//此处应该更新一下订单状态，商户自行增删操作
logger($log_name,"【支付成功】:\n".$xml."\n");

if (isset($_GET)){
	// 完成订单。
	order_paid($pay_id, 2,'微信支付查询单号【'.$getData['transaction_id'].'】');
}

// 日志记录
function  logger($file,$word) 
{
	$fp = fopen($file,"a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"执行日期：".strftime("%Y-%m-%d-%H：%M：%S",time())."\n".$word."\n\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}
?>