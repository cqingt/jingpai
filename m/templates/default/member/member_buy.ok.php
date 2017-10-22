<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member_pay.css">


<article>

    <div class="pay-success">
        <i class="icon-check">订单支付成功！</i>
        <a class="btn-look" href="<?php echo urlWap('member_order','order_list')?>">查看订单</a>
		<p style="
		font-size: 12px;
		text-align: left;
		text-indent: 2em;
		color: #d9434e;
		">温馨提示：双11期间，因各物流公司发货量暴增，物流派送速度可能会有所下降，我们已与合作物流达成共识，会尽快为您派送商品，感谢您对收藏天下的关注与支持，祝您生活愉快！
		</p>
    </div>

</article>