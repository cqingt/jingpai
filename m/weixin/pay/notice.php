<?php
define('IN_ECS', true);
include_once("../../includes/init.php");
include_once("../../includes/lib_payment.php");
include_once("./WxPayPubHelper/WxPayPubHelper.php");
//ʹ��ͨ��֪ͨ�ӿ�
$notify = new Wxpay_server_pub();
foreach ($_GET as $key=>$value)  
{
    logger("Key: $key; Value: $value");
}
$xml = $GLOBALS["HTTP_RAW_POST_DATA"];
$notify->saveData($xml);
$log_name="./notify_url.log";//log�ļ�·��
logger($log_name,$xml);
$getData = $notify->getData();

$order_sn_arr = explode('_', $getData['out_trade_no']);
$order_sn		= $order_sn_arr[0];
$pay_id = $order_sn_arr[1];



//�˴�Ӧ�ø���һ�¶���״̬���̻�������ɾ����
logger($log_name,"��֧���ɹ���:\n".$xml."\n");

if (isset($_GET)){
	// ��ɶ�����
	order_paid($pay_id, 2,'΢��֧����ѯ���š�'.$getData['transaction_id'].'��');
}

// ��־��¼
function  logger($file,$word) 
{
	$fp = fopen($file,"a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"ִ�����ڣ�".strftime("%Y-%m-%d-%H��%M��%S",time())."\n".$word."\n\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}
?>