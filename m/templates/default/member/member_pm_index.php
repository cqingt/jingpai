<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">



<div class="m-center">
    <ul class="mc-cnt">

        <li>
            <a href="<?php echo urlWap('member_pm','my_paimai')?>">
                <i class="im-order"></i>
                我的竟拍
                <span class="grayrightarrow"></span>
            </a>
        </li>

        <li>
            <a href="<?php echo urlWap('member_pm','my_deposit')?>">
                <i class="im-order"></i>
                我的保证金
                <span class="grayrightarrow"></span>
            </a>
        </li>

        <li>
            <a href="<?php echo urlWap('member_lepai','order')?>">
                <i class="im-order"></i>
                我的获拍
                <span class="grayrightarrow"></span>
            </a>
        </li>

        <li>
            <a href="">
                <i class="im-order"></i>
                退款
                <span class="grayrightarrow"></span>
            </a>
        </li>

        <li>
            <a href="">
                <i class="im-order"></i>
                退货
                <span class="grayrightarrow"></span>
            </a>
        </li>

    </ul>
</div>