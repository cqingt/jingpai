<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member_pay.css">


<article>

    <div class="payment">
        <h1><?php echo $output['order_remind']?></h1>
<!--
        <ul class="payment-li">
            <li>
                <p class="payment-li-number">订单号</p>
                <p class="payment-li-money">订单金额</p>
            </li>
            <?php foreach($output['order_list'] as $k=>$v){ ?>
                <li>
                    <p class="payment-li-number"><?php echo $v['order_sn'];?></p>
                    <p class="payment-li-money">￥<?php echo $v['order_amount'];?></p>
                </li>
            <?php } ?>

        </ul>
        -->
        <h1>需在线支付金额：<strong>¥<?php echo $output['pay_amount_online'] ?></strong></h1>
        <h1>支付单号：<?php echo $output['pay_sn']?></h1>
        <h1>请选择支付方式:</h1>
        <ul class="order-type">
            <?php if(!empty($output['payment_list'])){?>
                <?php foreach($output['payment_list'] as $payk => $payv){?>
                                        
                    <li data-type="<?php echo $payv['payment_code']?>" class="">
                        <a href="<?php echo urlWap('member_payment','pay',array('pay_sn'=>$output['pay_sn'],'payment_code'=>$payv['payment_code']));?>">
                            <i class="order-type-icon icon-<?php echo $payv['payment_code']?>"></i>
                            <p class="order-type-title"><?php echo $payv['payment_name']?></p>
                        </a>
                    </li>

                <?php }?>
            <?php }?>
        </ul>
    </div>


</article>