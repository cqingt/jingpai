<?php
include('../weixin.sdk.class.php');
include('../weixin.pay.class.php');

	$wx = new weixinSDK;
	if($_GET['code']){
		$wx->getOpenID($_GET['code']);
	}else{
		$wx->getCode("http://m.96567.com/weixin/pay");
	}
	$pay = new weixinPAY($wx->openid);
	$pay->keyStr = 'shengwei520soucang96567key1987sw';
	$pay->setParameter('attach','sctx_weixin_payment');
	$pay->setParameter('body','sctx');
	$pay->setParameter('mch_id','1226270402');
	$pay->setParameter('out_trade_no',date('YmdHis'));
	$pay->setParameter('total_fee',0.1);
	$pay->setParameter('notify_url','http://m.96567.com/weixin/pay/notice.php');
	
	$pay->send_pay();
	$jsPayStr = $pay->cretaePayJs();
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>
</head>
<body>

	</br></br></br></br>
	<div align="center">
    <?php echo $jsPayStr; ?>
		<button style="width:210px; height:30px; background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onClick="callpay()" >确认支付</button>
	</div>
</body>
</html>
