<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>艺术家列表</title>
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
        <h3>艺术家</h3>
    </div>
    <div class="ui-header-right">
        <a class="icon-navhome" href="<?php echo urlWap('artist','index')?>" title="首页"></a>
    </div>
</header>
