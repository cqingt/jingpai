<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $output['artist_info']['A_Name'];?>书画代表作品-收藏天下</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/css/frozen.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/css/navigation.css"/>
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/dist/idangerous.swiper.css" />

    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/css/main.css">

    <script src="http://cdn.uedsc.com/jquery/2.1.0/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/js/main.js" ></script>
    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/layer/layer.js" ></script>
</head>
<body>
<header class="ui-header ui-header-positive">
    <i class="ui-icon-return" onclick="history.back()"></i>
    <div class="ui-in in-two">
        <h3><?php echo $output['artist_info']['A_Name'];?> 官方网站</h3>
    </div>
    <div class="ui-header-right">
        <a class="icon-navtc" href="javascript:;" title="菜单"></a>
    </div>
</header>
<section>
<!--topNavBlogs-->
<div class="footerNav nofixed">
    <div class="ui-row-flex ui-border-b">
        <div class="ui-col ui-col" onclick="window.location.href='<?php echo M_SITE_URL;?>'">
            <i class="icon-home-nav1"></i>
            <p>商城首页</p>
        </div>
        <div class="ui-col ui-col" onclick="window.location.href='<?php echo M_SITE_URL;?>/index.php?act=artist&op=index'">
            <i class="icon-home-nav7"></i>
            <p>书画馆</p>
        </div>
        <div class="ui-col ui-col" onclick="window.location.href='<?php echo M_SITE_URL;?>/index.php?act=artist&op=FenLei'">
            <i class="icon-home-nav8"></i>
            <p>选画中心</p>
        </div>
        <div class="ui-col ui-col" onclick="window.location.href='<?php echo M_SITE_URL;?>/index.php?act=member&op=home'">
            <i class="icon-home-nav4"></i>
            <p>个人中心</p>
        </div>
    </div>
</div>
<!--topNavBlogs-->
<div class="blogs-card">
    <div class="ui-avatar-blogs">
        <span style="background-image:url(<?php echo BASE_SITE_URL . '/' . $output['artist_info']['A_Img']?>)"></span>
    </div>
    <div class="con-card">
        <h2><?php echo $output['artist_info']['A_Name'];?></h2>
        <?php foreach($output['artist_info']['array_zhicheng'] as $key => $val){?>
        <p class="ui-nowrap"><?php echo $val;?></p>
        <?php }?>
    </div>
</div>

<div class="blogs-interaction-nav ui-border-tb">
    <!--active 放到a标签里可变色-->
    <a href="javascript:void(0);" onclick="NTKF.im_openInPageChat('sc_1022_9999')"><i class="icon-int1"></i>咨询</a>
    <a href="javascript:void(0);" id="intPraise" aid="<?php echo $output['aid']?>" <?php if(isset($output['c_zan']) && $output['c_zan'] == 1){?>class="active"<?php }?>><i class="icon-int2"></i><strong>点赞</strong><em><?php echo $output['zan_num']?></em></a>
    <a href="javascript:void(0);" id="intCollect" aid="<?php echo $output['aid']?>" <?php if(isset($output['c_cang']) && $output['c_cang'] == 1){?>class="active"<?php }?>><i class="icon-int3"></i>收藏</a>
</div>