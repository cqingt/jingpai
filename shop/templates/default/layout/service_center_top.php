<?php defined('InShopNC') or exit( 'Access Invalid!' ); ?>
<div class="global-nav">
    <div class="global wrapper">
        <div class="glo-entry">
            <p>
                <?php if ( $_SESSION['is_login'] == '1' ) { ?>
                    <?php echo $lang['nc_hello']; ?>
                    <span>
                        <a href="<?php echo urlShop('member' , 'home'); ?>"><?php echo $_SESSION['member_name']; ?></a>
                        <?php if ( $output['member_info']['level_name'] ) { ?>
                            <div class="nc-grade-mini" style="cursor:pointer;" onclick="javascript:go('<?php echo urlShop('pointgrade' , 'index'); ?>');">
                                <?php echo $output['member_info']['level_name']; ?>
                            </div>
                        <?php } ?>
                    </span>
                    <?php echo $lang['nc_comma'] , $lang['welcome_to_site']; ?>
                    <a href="<?php echo BASE_SITE_URL; ?>" title="<?php echo $lang['homepage']; ?>" alt="<?php echo $lang['homepage']; ?>">
                        <span><?php echo $output['setting_config']['site_name']; ?></span>
                    </a>
                    <span>[<a href="<?php echo urlShop('login' , 'logout'); ?>"><?php echo $lang['nc_logout']; ?></a>] </span>
                <?php } else { ?>
                    <?php echo $lang['nc_hello'] . $lang['nc_comma'] . $lang['welcome_to_site']; ?>
                    <a href="<?php echo BASE_SITE_URL; ?>" title="<?php echo $lang['homepage']; ?>" alt="<?php echo $lang['homepage']; ?>">
                        <?php echo $output['setting_config']['site_name']; ?>
                    </a>
                    <a href="<?php echo urlShop('login'); ?>" target="_blank">[<?php echo $lang['nc_login']; ?>]</a>
                    <a href="<?php echo urlShop('login' , 'register'); ?>" target="_blank">[<?php echo $lang['nc_register']; ?>]</a>
                <?php } ?>
            </p>
        </div>
        <a class="glo-home" href="<?php echo SHOP_SITE_URL;?>">收藏天下首页</a>
        <div class="glo-menu">
            <dl>
                <dt>
                    <a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=show_joinin&op=index" title="免费开店">免费开店</a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=show_joinin&op=index"
                               title="招商入驻">招商入驻</a></li>
                        <li><a href="<?php echo urlShop('seller_login' , 'show_login'); ?>" target="_blank"
                               title="登录商家管理中心">商家登录</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_order">我的订单</a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li>
                            <a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_order&state_type=state_new">待付款订单</a>
                        </li>
                        <li><a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_order&state_type=state_send">待确认收货</a>
                        </li>
                        <li><a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_order&state_type=state_noeval">待评价交易</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_favorites&op=fglist"><?php echo $lang['nc_favorites']; ?></a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_favorites&op=fglist">商品收藏</a>
                        </li>
                        <li><a href="<?php echo SHOP_SITE_URL; ?>/index.php?act=member_favorites&op=fslist">店铺收藏</a>
                        </li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>
                    <a href="" target="_blank">客户服务</a>
                    <i></i>
                </dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo urlShop('article', 'article', array('ac_id' => 2));?>">帮助中心</a></li>
                        <li><a href="<?php echo urlShop('article', 'article', array('ac_id' => 5));?>">售后服务</a></li>
                        <li><a href="<?php echo urlShop('article', 'article', array('ac_id' => 6));?>">客服中心</a></li>
                    </ul>
                </dd>
            </dl>
            <dl class="wechat">
                <dt><a href="" target="_blank">关注我们</a><i></i></dt>
                <dd>
                    <p>扫描二维码</p>
                    <p>关注商城微信号</p>
                    <img src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . $GLOBALS['setting_config']['site_logowx']; ?>">
                </dd>
            </dl>
        </div>
    </div>
</div>

<!-- 导航 -->
<div class="serve-nav-guidance">
    <div class="wrapper">
        <div class="nav-logo">
            <a class="logo" href="<?php echo SHOP_SITE_URL?>"></a>
            <a class="name" href="<?php echo BASE_SITE_URL;?>/servercenter.html">服务中心</a>
        </div>
        <div class="nav-items">
            <ul>
                <li <?php if($output['nav_type'] == 0){?>class="active"<?php }?>><a href="<?php echo BASE_SITE_URL;?>/servercenter.html">首页</a></li>
                <?php foreach($output['nav'] as $key => $val){?>
                    <?php if(isset($val['ac_id']['ac_id'])){?>
                        <li <?php if($output['nav_type'] == $val['ac_id']['ac_id']){?>class="active"<?php }?>>
                            <a href="<?php echo BASE_SITE_URL;?>/servercenter-ac_id-<?php echo $val['ac_id']['ac_id']?>.html">
                                <?php echo $val['ac_name']?>
                            </a>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>