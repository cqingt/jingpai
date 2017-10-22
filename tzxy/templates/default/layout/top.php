<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo empty($output['seo_title'])?$output['html_title']:$output['seo_title'].'-'.$output['html_title'];?></title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />

    <link href="<?php echo CMS_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo CMS_TEMPLATES_URL;?>/css/cms.css" rel="stylesheet" type="text/css">


    <!--[if IE 6]><style type="text/css">body { _behavior: url("<?php echo CMS_TEMPLATES_URL;?>/css/csshover.htc");}</style><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
    <![endif]-->
    <!--[if IE 6]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_MAXMIX.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_PNG.js"></script>
    <script>
        DD_belatedPNG.fix('.pngFix');
    </script>
    <script>
        // <![CDATA[
	if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
	    try{
	        document.execCommand("BackgroundImageCache", false, true);
	   }
	catch(e){}
	// ]]>
	</script>
	<![endif]-->
    <script>
        var COOKIE_PRE = '<?php echo COOKIE_PRE;?>'; var _CHARSET = '<?php echo strtolower(CHARSET);?>'; var APP_SITE_URL = '<?php echo CMS_SITE_URL;?>'; var SITEURL = '<?php echo SHOP_SITE_URL;?>'; var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>'; var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
    </script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
    <script id="dialog_js" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo CMS_RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <link href="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript">
        var PRICE_FORMAT = '<?php echo $lang['currency'];?>%s';
        var LOADING_IMAGE = '<?php echo getLoadingImage();?>';
    </script>
</head>
<body>
<!-- 头 -->
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="public-top-layout w">
    <div class="topbar warp-all">
        <div class="user-entry">
            <?php if($_SESSION['is_login'] == '1'){?>
                <?php echo $lang['nc_hello'];?><span><a href="<?php echo urlShop('member', 'home');?>"><?php echo str_cut($_SESSION['member_name'],20);?></a></span><?php echo $lang['nc_comma'],$lang['welcome_to_site'];?> <a href="<?php echo SHOP_SITE_URL;?>"  title="<?php echo $lang['homepage'];?>" alt="<?php echo $lang['homepage'];?>"><span><?php echo $output['setting_config']['site_name']; ?></span></a> <span>[<a href="<?php echo urlShop('login','logout');?>"><?php echo $lang['nc_logout'];?></a>]</span>
            <?php }else{?>
                <?php echo $lang['nc_hello'].$lang['nc_comma'].$lang['welcome_to_site'];?> <a href="<?php echo BASE_SITE_URL;?>" title="<?php echo $lang['homepage'];?>" alt="<?php echo $lang['homepage'];?>"><?php echo $output['setting_config']['site_name']; ?></a> <span>[<a href="<?php echo urlShop('login');?>"><?php echo $lang['nc_login'];?></a>]</span> <span>[<a href="<?php echo urlShop('login','register');?>"><?php echo $lang['nc_register'];?></a>]</span>
            <?php }?>
        </div>
        <div class="quick-menu">
            <dl>
                <dt>我的投稿<i></i></dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo urlCMS('member_article','article_list');?>">文章列表</a></li>
                        <li><a href="<?php echo urlCMS('publish','publish_article');?>">发布文章</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order">我的订单</a><i></i></dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_new">待付款订单</a></li>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_send">待确认收货</a></li>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_noeval">待评价交易</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist">我的收藏</a><i></i></dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist">商品收藏</a></li>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fslist">店铺收藏</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>客户服务<i></i></dt>
                <dd>
                    <ul>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=article&ac_id=2">帮助中心</a></li>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=article&ac_id=5">售后服务</a></li>
                        <li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=article&ac_id=6">客服中心</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><a href="<?php echo SHOP_SITE_URL;?>">商城首页</a></dt>
            </dl>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".quick-menu dl").hover(function() {
                $(this).addClass("hover");
            },
            function() {
                $(this).removeClass("hover");
            });

    });
</script>

<header id="">
    <div class="channel warp-all">
        <div class="channel-logo">
            <a href="<?php echo CMS_SITE_URL;?>">
                <img src="<?php echo CMS_TEMPLATES_URL;?>/images/channel_logo.jpg">
            </a>
            <h1>收藏学院</h1>
        </div>
        <div class="search-channel">
            <div class="form-box">
                <form id="form_search" method="get" action="<?php echo CMS_SITE_URL.DS;?>index.php">
                    <input id="act" name="act" type="hidden" value="article"/>
                    <input id="op" name="op" type="hidden" value="article_search"/>
                    <input name="keyword" type="text" class="input-text" placeholder="抗战胜利邮票" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'';?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search">
                    <input type="submit" class="input-btn" value="搜索">
                </form>
            </div>
        </div>
    </div>
</header>



