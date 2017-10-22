<?php defined('InShopNC') or exit('Access Invalid!');

$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
{
    global $config;
    if(!empty($config['m_site_url'])){
        $url = $config['m_site_url'];
        switch ($_GET['act']){
            case 'goods':
                $url .= '/index.php?act=goods&op=index&goods_id=' . $_GET['goods_id'];
                break;
            case 'store_list':
                $url .= '/index.php?act=member_store&op=index';
                break;
            case 'show_store':
                $url .= '/index.php?act=member_store&op=store_info&store_id=' . $_GET['store_id'];
                break;
            default:
                $url = 'noheader';
                break;
        }

        //判定是否首页
        if($_GET['act'] == 'index' && $_GET['op'] == 'index'){
            $url = $config['m_site_url'];
        }
    } else {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    }
    if($url != 'noheader'){
        header('Location:' . $url);
        exit();
    }

    if (!empty($Loaction))
    {
        header("Location: $Loaction\n");
        exit;
    }
}
?>
<!doctype html>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
    <title><?php echo $output['html_title'];?></title>
	<?php if($output['seo_keywords'] != '收藏天下,'){?>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
	<?php }?>
	<?php if($output['seo_description'] != '收藏天下,'){?>
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
	<?php }?>
    <?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
	<meta property="qc:admins" content="15725167776165676375" />


<?php if($output['_360so']){?>
<meta property="og:type"  content="product"/>
<meta property="og:image"  content="<?php echo cthumb($output['goods']['goods_image']); ?>"/>
<meta property="og:title"  content="<?php echo $output['html_title'];?>"/>
<meta property="og:description"  content="<?php echo $output['seo_description']; ?>"/>
<meta property="og:product:price"  content="<?php echo $output['goods']['goods_price']; ?>"/>
<meta property="og:product:orgprice"  content="<?php echo $output['goods']['goods_marketprice']; ?>"/>
<meta property="og:product:currency"  content="CNY"/>
<?php }?>
<?php if($output['robots']){?>
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
<?php }?>   
    <style type="text/css">
        body {
            _behavior: url(<?php echo SHOP_TEMPLATES_URL;?>/css/csshover.htc);
        }
    </style>
    <link rel="shortcut icon" href="<?php echo BASE_SITE_URL;?>/favicon.ico" />
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_header.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_login.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
    <![endif]-->
    <!--[if IE 6]>
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
        var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
		_oztime = (new Date()).getTime();
    </script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/reveal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.reveal.js"></script>



    <script type="text/javascript">
        var PRICE_FORMAT = '<?php echo $lang['currency'];?>%s';
        $(function(){
            //首页左侧分类菜单
            $(".category ul.menu").find("li").each(
                function() {
                    $(this).hover(
                        function() {
                            var cat_id = $(this).attr("cat_id");
                            var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
                            menu.show();
                            $(this).addClass("hover");
                            var menu_height = menu.height();
                            if (menu_height < 60) menu.height(80);
                            menu_height = menu.height();
                            var li_top = $(this).position().top;
                            $(menu).css("top",-li_top + 38);
                        },
                        function() {
                            $(this).removeClass("hover");
                            var cat_id = $(this).attr("cat_id");
                            $(this).find("div[cat_menu_id='"+cat_id+"']").hide();
                        }
                    );
                }
            );
            $(".head-user-menu dl").hover(function() {
                    $(this).addClass("hover");
                },
                function() {
                    $(this).removeClass("hover");
                });
            $('.head-user-menu .my-mall').mouseover(function(){// 最近浏览的商品
                load_history_information();
                $(this).unbind('mouseover');
            });
            $('.head-user-menu .my-cart').mouseover(function(){// 运行加载购物车
                load_cart_information();
                $(this).unbind('mouseover');
            });
            $('#button').click(function(){
                if ($('#keyword').val() == '') {
                    return false;
                }
            });
            <?php if (C('fullindexer.open')) { ?>
            // input ajax tips
            $('#keyword').focus(function(){
                if ($(this).val() == $(this).attr('title')) {
                    $(this).val('').removeClass('tips');
                }
            }).blur(function(){
                if ($(this).val() == '' || $(this).val() == $(this).attr('title')) {
                    $(this).addClass('tips').val($(this).attr('title'));
                }
            }).blur().autocomplete({
                source: function (request, response) {
                    $.getJSON('<?php echo SHOP_SITE_URL;?>/index.php?act=search&op=auto_complete', request, function (data, status, xhr) {
                        $('#top_search_box > ul').unwrap();
                        response(data);
                        if (status == 'success') {
                            $('body > ul:last').wrap("<div id='top_search_box'></div>").css({'zIndex':'1000','width':'362px'});
                        }
                    });
                },
                select: function(ev,ui) {
                    $('#keyword').val(ui.item.label);
                    $('#top_search_form').submit();
                }
            });
            <?php } ?>
        });

        $(function(){
            //search
            var act = "<?php echo $_GET['act']?>";
            if (act == "store_list"){
                $("#search").children('ul').children('li:eq(1)').addClass("current");
                $("#search").children('ul').children('li:eq(0)').removeClass("current");
				$("#search_act").val('store_list');
				
            }
            $("#search").children('ul').children('li').click(function(){
                $(this).parent().children('li').removeClass("current");
                $(this).addClass("current");
                $('#search_act').attr("value",$(this).attr("act"));
                $('#keyword').attr("placeholder",$(this).attr("title"));
				if($(this).attr("act") == 'store_list'){
					//$(".home-all").show();
				}else{
					$(".home-all").hide();
				}
            });
            $("#keyword").blur();

        });
		function homeAll(){
			if($('.current').attr("act") == 'store_list'){
				$(".home-all").show();
			}
		}

		function homeAllhed(){
			//$(".home-all").hide();
		}

    </script>
</head>
<body>
<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>

<!--//zmr>v92-->
<?php if (loadadv(1047)){?>

    <DIV id=homeTopAd01 style=" position:absolute; left:50%; margin:0 0 0 -600px; ">
        <div style="margin:0 auto; width:1200px;" ><?php echo loadadv(1047);?></div>
        <div style=" position:absolute; z-index:1; top:5px; right:5px; "><a style="CURSOR: hand" onClick="homeTopAd()"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/close.png" width="24" height="24" /></a></div>
    </DIV>
    <div id=homeTopAd02 style=" height:80px; "></div>
    <SCRIPT>
        function homeTopAd(){
            document.getElementById("homeTopAd01").style.display="none";
            document.getElementById("homeTopAd02").style.display="none";
        }
    </SCRIPT>
<?php } ?>

<!-- PublicHeadLayout Begin -->
<!-- 顶部广告展开效果-->
<!-- 顶部广告展开效果-->
<div  class="header-wrap"  <?php if ($output['hidden_nctoolbar'] == 1) {?>style="background: #FFF;"<?php }?>>
    <header class="public-head-layout wrapper">
        <h1 class="site-logo"><a href="<?php echo BASE_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.$output['setting_config']['site_logo']; ?>" class="pngFix"></a></h1>
        <?php if (C('mobile_isuse') && C('mobile_app')){?>
            <div class="head-app">
                <?php echo loadadv(1076);?>
            </div>
        <?php } ?>

        <div id="search" class="head-search-bar">
            <!--商品和店铺-->
            <ul class="tab">
                <li title="请输入您要搜索的商品关键字" act="search" class="current">商品</li>
                <li title="请输入您要搜索的店铺关键字" act="store_list">店铺</li>
            </ul>
            <form class="search-form" method="get" action="<?php echo SHOP_SITE_URL;?>">
                <input type="hidden" value="search" id="search_act" name="act">
                <input placeholder="请输入您要搜索的商品关键字" name="keyword" id="keyword" type="text" class="input-text" value="<?php echo $_GET['keyword'];?>" maxlength="60" x-webkit-speech lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search" onFocus="homeAll();" onblur="homeAllhed();"/>
				<div class="home-all" style="display:none;"><a href="http://www.96567.com/index.php?act=store_list&op=index">查看全部店铺>></a></div>
                <input type="submit" id="button" value="<?php echo $lang['nc_common_search'];?>" class="input-submit">
            </form>
            <!--搜索关键字-->
            <div class="keyword"><?php echo $lang['hot_search'].$lang['nc_colon'];?>
                <ul>
                    <?php if(is_array($output['hot_search']) && !empty($output['hot_search'])) { foreach($output['hot_search'] as $val) { ?>
                        <li><a href="<?php echo urlShop('search', 'index', array('keyword' => $val));?>"><?php echo $val; ?></a></li>
                    <?php } }?>
                </ul>
            </div>
        </div>
        <div class="head-user-menu">
            <dl class="my-mall">
                <dt><span class="ico"></span>我的商城<i class="arrow"></i></dt>
                <dd>
                    <div class="sub-title">
                        <h4><?php echo $_SESSION['member_name'];?>
                            <?php if ($output['member_info']['level_name']){ ?>
                                <div class="nc-grade-mini" style="cursor:pointer;" onClick="javascript:go('<?php echo urlShop('pointgrade','index');?>');"><?php echo $output['member_info']['level_name'];?></div>
                            <?php } ?>
                        </h4>
                        <a rel="nofollow"  href="<?php echo urlShop('member', 'home');?>" class="arrow">我的用户中心<i></i></a></div>
                    <div class="user-centent-menu">
                        <ul>
                            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_message&op=message">站内消息(<span><?php echo $output['message_num']>0 ? $output['message_num']:'0';?></span>)</a></li>
                            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order" class="arrow">我的订单<i></i></a></li>
                            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_consult&op=my_consult">咨询回复(<span id="member_consult">0</span>)</a></li>
                            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist" class="arrow">我的收藏<i></i></a></li>
                            <?php if (C('voucher_allow') == 1){?>
                                <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_voucher">代金券(<span id="member_voucher">0</span>)</a></li>
                            <?php } ?>
                            <?php if (C('points_isuse') == 1){ ?>
                                <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_points" class="arrow">我的积分<i></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="browse-history">
                        <div class="part-title">
                            <h4>最近浏览的商品</h4>
                            <span style="float:right;"><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_goodsbrowse&op=list">全部浏览历史</a></span>
                        </div>
                        <ul>
                            <li class="no-goods"><img class="loading" src="<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif" /></li>
                        </ul>
                    </div>
                </dd>
            </dl>
            <dl class="my-cart">
                <?php if ($output['cart_goods_num'] > 0) { ?>
                    <div class="addcart-goods-num"><?php echo $output['cart_goods_num'];?></div>
                <?php } ?>
                <dt><span class="ico"></span>购物车结算<i class="arrow"></i></dt>
                <dd>
                    <div class="sub-title">
                        <h4>最新加入的商品</h4>
                    </div>
                    <div class="incart-goods-box">
                        <div class="incart-goods"> <img class="loading" src="<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif" /> </div>
                    </div>
                    <div class="checkout"> <span class="total-price">共<i><?php echo $output['cart_goods_num'];?></i><?php echo $lang['nc_kindof_goods'];?></span><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=cart" class="btn-cart">结算购物车中的商品</a> </div>
                </dd>
            </dl>
        </div>
    </header>
</div>
<!-- PublicHeadLayout End -->

<!-- publicNavLayout Begin -->
<nav class="public-nav-layout">
    <div class="wrapper">
        <a class="spring-festival" href="http://www.96567.com/article-45.html" target="_blank"><img src="http://www.96567.com/shop/templates/default/images/spring-festival.png" alt=""></a>
        <div class="all-category">
            <?php require template('layout/home_goods_class');?>
        </div>
        <ul class="site-menu">
            <li><a href="<?php echo BASE_SITE_URL;?>" <?php if($output['index_sign'] == 'index' && $output['index_sign'] != '0') {echo 'class="current"';} ?>><?php echo $lang['nc_index'];?></a></li>
            <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
                <?php foreach($output['nav_list'] as $nav){?>
                    <?php if($nav['nav_location'] == '1'){?>
                        <li><a
                                <?php
                                if($nav['nav_new_open']) {
                                    echo ' target="_blank"';
                                }
                                switch($nav['nav_type']) {
                                    case '0':
                                        echo ' href="' . $nav['nav_url'] . '"';
                                        break;
                                    case '1':
                                        echo ' href="' . urlShop('search', 'index',array('cate_id'=>$nav['item_id'])) . '"';
                                        if (isset($_GET['cate_id']) && $_GET['cate_id'] == $nav['item_id']) {
                                            echo ' class="current"';
                                        }
                                        break;
                                    case '2':
                                        echo ' href="' . urlShop('article', 'article',array('ac_id'=>$nav['item_id'])) . '"';
                                        if (isset($_GET['ac_id']) && $_GET['ac_id'] == $nav['item_id']) {
                                            echo ' class="current"';
                                        }
                                        break;
                                    case '3':
                                        echo ' href="' . urlShop('activity', 'index', array('activity_id'=>$nav['item_id'])) . '"';
                                        if (isset($_GET['activity_id']) && $_GET['activity_id'] == $nav['item_id']) {
                                            echo ' class="current"';
                                        }
                                        break;
                                }
                                ?>><?php echo $nav['nav_title'];?></a></li>
                    <?php }?>
                <?php }?>
            <?php }?>
        </ul>



<!--所有页面都要有  1021 A-->     
<?php if(!empty($output['ap_info'])){?>                                                                            
        <div class="txt_swiper_wrap">
            <ul class="font_inner">

<?php foreach ($output['ap_info'] as $k => $v) {?>
    <li>
        <a href="<?php echo $v['adv_content']['adv_pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL."/".ATTACH_ADV."/".$v['adv_content']['adv_pic'];?>"/></a>
    </li>
<?php }?>
    </ul>

        <a href="javascript:void(0)" class="lt"></a>
        <a href="javascript:void(0)" class="gt"></a>
        </div>   
        
        <script type="text/javascript">
        $(function(){
            $(".font_inner li:eq(0)").clone(true).appendTo($(".font_inner"));
            var liHeight = $(".txt_swiper_wrap").height();
            var totalHeight = ($(".font_inner li").length *  $(".font_inner li").eq(0).height()) -liHeight;
            $(".font_inner").height(totalHeight);
            var index = 0;
            var autoTimer = 0;
            var clickEndFlag = true;
        
            function tab(){
                $(".font_inner").stop().animate({
                    top: -index * liHeight
                },400,function(){
                    clickEndFlag = true;
                    if(index == $(".font_inner li").length -1) {
                        $(".font_inner").css({top:0});
                        index = 0;
                    }
                })
            }
            function next() {
                index++;
                if(index > $(".font_inner li").length - 1) {
                    index = 0;
                }
                tab();
            }
            function prev() {
                index--;
                if(index < 0) {
                    index = $(".font_inner li").size() - 2;
                    $(".font_inner").css("top",- ($(".font_inner li").size() -1) * liHeight);
                }
                tab();
            }
            //切换到下一张
            $(".txt_swiper_wrap .gt").on("click",function() {
                if(clickEndFlag) {
                    next();
                    clickEndFlag = false;
                }
            });
            //切换到上一张
            $(".txt_swiper_wrap .lt").on("click",function() {
                if(clickEndFlag) {
                    prev();
                    clickEndFlag = false;
                }
            });
            //自动轮播
            autoTimer = setInterval(next,8000);
            $(".font_inner a").hover(function(){
                clearInterval(autoTimer);
            },function() {
                autoTimer = setInterval(next,8000);
            })
        
            $(".txt_swiper_wrap .lt,.txt_swiper_wrap .gt").hover(function(){
                clearInterval(autoTimer);
            },function(){
                autoTimer = setInterval(next,8000);
            })
    
        })
        </script>
        
        
<!--所有页面都要有 1021 E-->
<?php }?>

    </div>
</nav>
