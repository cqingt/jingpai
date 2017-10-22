<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */

require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
require_once(dirname(__FILE__)."/../../../control/pc/isPay.class.php");
require_once(dirname(__FILE__)."/../../../../config/db.php");
require_once(dirname(__FILE__)."/../../../../config/function.php");

?>
<!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功

	$is = new isPay();
	$is->c->table('pay_log');//订单表
	if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
		$dataArr['L_is_paid'] = '1';
		$res=$is->c->update($dataArr,"L_order_id='".$_GET['out_trade_no']."'");
		show('验证成功',"http://pc.soocang.com/index.php?m=isPay&c=doPay&p=pc&type=1&dan=".$_GET['out_trade_no']);
		exit;
    }
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";
}
?>
        <title>支付宝纯网关接口</title>
	</head>
    <body>
    </body>
</html>