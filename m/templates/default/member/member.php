<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<header id="header"></header>
    <div class="m-top clearfix">
        <div class="m-avatar fleft">
            <img src="<?php echo BASE_SITE_URL;?>/data/upload/shop/common/default_user_portrait.gif" id="avatar"/>
        </div>
        <div class="m-infor fleft">
            <div class="m-name mt10">
                 昵称：<span id="username"><?php echo $output['member_info']['member_name'];?></span>
            </div>
            <div class="clearfix mt10">
                <span class="m-jifen">
                    <span>积分</span>
                    <span class="clr-d94" id="point"><?php echo $output['member_info']['member_points'];?></span>
                </span>
                 <span class="m-yue">
                      <span>预存款</span>
                      <span class="clr-d94" id="predepoit"><?php echo $output['member_info']['available_predeposit'];?></span>
                 </span>
            </div>
        </div>
    </div>
    <div class="m-center">
        <ul class="mc-cnt">
            <li style="display: none">
                <a href="<?php echo urlWap('member_order','order_list')?>">
                    <i class="im-order"></i>
                    我的订单
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_lepai','order')?>">
                    <i class="im-order-xn"></i>
                    竞拍订单
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li style="display: none">
                <a href="<?php echo urlWap('member_integral','order')?>">
                    <i class="im-order-xn"></i>
                    积分兑换订单
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_voucher','voucher_list')?>">
                    <i class="im-quan"></i>
                    我的优惠券
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li style="display: none">
                <a href="<?php echo urlWap('member_favorites','favorites_list')?>">
                    <i class="im-collect"></i>
                    我的收藏商品
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li style="display: none">
                <a href="<?php echo urlWap('member_favorites','favorites_artist')?>">
                    <i class="im-collect"></i>
                    我的收藏艺术家
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li style="display: none">
                <a href="<?php echo urlWap('member_shop_class','index')?>">
                     <i class="im-collect-store"></i>
                    查看所有店铺
                     <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_ress','ress_list')?>">
                    <i class="im-address"></i>
                    地址管理
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_view','view_list')?>">
                    <i class="im-history"></i>
                    浏览历史
                     <span class="grayrightarrow"></span>
                </a>
            </li>

            <li style="display: none">
                <a href="<?php echo urlWap('member_pay','index')?>">
                    <i class="im-quan"></i>
                    充值
                    <span class="grayrightarrow"></span>
                </a>
            </li>


			     <li style="display: none">
                <a href="<?php echo urlWap('cangdou','index')?>">
                    <i class="im-order-xn"></i>
                    推荐有礼
                    <span class="grayrightarrow"></span>
                </a>
            </li>

			 <li>
                <a href="<?php echo urlWap('member_refund','index')?>">
                    <i class="im-order"></i>
                    退款及退货
                    <span class="grayrightarrow"></span>
                </a>
            </li>

        </ul>


<!-- 
        <ul class="mc-cnt">
            <li>
                <a href="<?php echo urlWap('member_order','order_list')?>">
                    <i class="im-order"></i>
                    我的订单
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="im-mepmh"></i>
                    我的拍卖惠
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_integral','order')?>">
                    <i class="im-order-xn"></i>
                    积分兑换订单
                    <span class="grayrightarrow"></span>
                </a>
            </li>

            <li>
                <a href="<?php echo urlWap('member_refund','index')?>">
                    <i class="im-order"></i>
                    退款退货
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('cangdou','index')?>">
                    <i class="im-order-xn"></i>
                    推荐有礼
                    <span class="grayrightarrow"></span>
                </a>
            </li>


            <li>
                <a href="">
                     <i class="im-yck"></i>
                    预存款
                     <span class="grayrightarrow"></span>
                </a>
            </li>


            <li>
                <a href="">
                    <i class="im-jifen"></i>
                    积分
                    <span class="grayrightarrow"></span>
                </a>
            </li>
            <li>
                <a href="<?php echo urlWap('member_voucher','voucher_list')?>">
                    <i class="im-quan"></i>
                    我的优惠券
                    <span class="grayrightarrow"></span>
                </a>
            </li>

            <li>
                <a href="<?php echo urlWap('member_favorites','favorites_list')?>">
                     <i class="im-collect"></i>
                    我的收藏商品
                     <span class="grayrightarrow"></span>
                </a>
            </li>


            <li>
                <a href="<?php echo urlWap('member_shop_class','index')?>">
                     <i class="im-collect-store"></i>
                    查看所有店铺
                     <span class="grayrightarrow"></span>
                </a>
            </li>

            <li>
                <a href="<?php echo urlWap('member_ress','ress_list')?>">
                    <i class="im-address"></i>
                    地址管理
                    <span class="grayrightarrow"></span>
                </a>
            </li>
                <a href="<?php echo urlWap('member_view','view_list')?>">
                    <i class="im-history"></i>
                    浏览历史
                     <span class="grayrightarrow"></span>
                </a>
            </li>

            <li>
                <a href="<?php echo urlWap('member_pay','index')?>">
                    <i class="im-quan"></i>
                    充值
                    <span class="grayrightarrow"></span>
                </a>
            </li>
        </ul> -->


    </div>


