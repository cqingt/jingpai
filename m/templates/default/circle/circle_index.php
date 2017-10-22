<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $lang['circle_shoucang'];?></title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/tzxy/css/normalize.css" />


    <link rel="stylesheet" href="http://m.96567.com/templates/default/css/member.css" />
    <link rel="stylesheet" href="http://m.96567.com/templates/default/css/navigation.css" />
    <link rel="stylesheet" href="http://m.96567.com/templates/default/css/main.css" />
    <link rel="stylesheet" href="http://m.96567.com/templates/default/css/new_page.css" />
    <script src="http://m.96567.com/templates/default/js/jquery-1.9.js"></script>

    <!-- New -->
    <link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/circle.css"/>
    <link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.css">
    <link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/frozen.css" />
    <script  src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
    <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
</head>
<body class="demo" id="top">
<header class="home-header">
    <a href=""><i class="fa icon-logo"></i></a>
    <h1>收藏天下圈子</h1>
    <?php if(intval($_SESSION['member_id']) <= 0) {?>
        <div class="ui-fr-btn"><a href="index.php?act=circle_login&op=index">登录</a></div>
    <?php }else{ ?>
        <div class="ui-fr-btn"><a href="index.php?act=circle_sns_circle&mid=<?php echo $_SESSION['member_id']?>"><i class="fa fa-user fa-2x"></i></a></div>
    <?php } ?>
</header>

<section class="ui-container">
    <div class="device">
        <a class="arrow-left" href="#"></a>
        <a class="arrow-right" href="#"></a>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach($output['adv_list'] as $k=>$v){ ?>
                    <div class="swiper-slide"><a href="<?php echo $v['data'];?>"> <img src="<?php echo $v['image'];?>"></a> </div>
                <?php }?>
            </div>
        </div>
        <div class="pagination"></div>
    </div>

    <script>
        var mySwiper = new Swiper('.swiper-container',{

            pagination: '.pagination',
            loop:true,
            grabCursor: true,
            calculateHeight: true,
            paginationClickable: true,
            autoplay: 4000
        })
    </script>
    <div class="demo-item mod-entrance">
        <div class="demo-block ui-border-b">
            <div class="ui-row-flex ui-whitespace ptb">
                <div data-href="" class="ui-col">
                    <a href="index.php?act=circle_search&op=group&class_id=2"><img class="icon" src="<?php echo M_TMP_DEF_URL;?>/images/home-hot1.png"></a>
                    <p class="name">书画艺术</p>
                </div>
                <div data-href="" class="ui-col">
                    <a href="index.php?act=circle_search&op=group&class_id=7"><img class="icon" src="<?php echo M_TMP_DEF_URL;?>/images/home-hot2.png"></a>
                    <p class="name">鉴定专区</p>
                </div>
                <div data-href="" class="ui-col">
                    <a href="index.php?act=circle_search&op=group&class_id=5"><img class="icon" src="<?php echo M_TMP_DEF_URL;?>/images/home-hot3.png"></a>
                    <p class="name">金银制品</p>
                </div>
                <div data-href="" class="ui-col">
                    <a href="index.php?act=circle_search&op=group&class_id=4"><img class="icon" src="<?php echo M_TMP_DEF_URL;?>/images/home-hot4.png"></a>
                    <p class="name">把玩/手串</p>
                </div>
                <div data-href="" class="ui-col">
                    <a href="index.php?act=circle_search&op=group&class_id=3"><img class="icon" src="<?php echo M_TMP_DEF_URL;?>/images/home-hot5.png"></a>
                    <p class="name">翡翠玉器</p>
                </div>
            </div>
        </div>
    </div>


    <div class="demo-item pt nomb">
        <div class="mod-box-header ui-whitespace">
            <h2><i class="icon-one4"></i><strong>近期热点</strong></h2>
            <!--						<a href="" class="more">更多&gt;</a>-->
        </div>
        <div class="demo-block txt-home ui-border-b">
            <div class="ui-row ui-whitespace">
                <div class="ui-col ui-col-50 ui-border-r">
                    <?php foreach ($output['ReDian_list'] as $key=>$val){?>
                        <?php if($key % 2 == 0) {?>
                            <a class="ui-nowrap ui-whitespace" href="index.php?act=circle_theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>"><?php echo $val['theme_name'];?></a>
                        <?php }?>
                    <?php }?>
                </div>
                <div class="ui-col ui-col-50">
                    <?php foreach ($output['ReDian_list'] as $key=>$val){?>
                        <?php if($key % 2 == 1) {?>
                            <a class="ui-nowrap ui-whitespace" href="index.php?act=circle_theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>"><?php echo $val['theme_name'];?></a>
                        <?php }?>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class="demo-item pt nomb">
        <div class="mod-box-header ui-whitespace">
            <h2><i class="icon-one1"></i><strong>热门圈子</strong></h2>
            <a href="index.php?act=circle_search&op=circlr_more" class="more">更多&gt;</a>
        </div>
        <div class="demo-block">
            <div class="swiper-recommend">
                <div class="swiper-wrapper">
                    <?php foreach ($output['circle_list'] as $k=>$val){ ?>
                        <div class="swiper-slide">
                            <div data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id'];?>" class="rec-img"><i style="background: url(<?php echo circleLogo($val['circle_id']);?>);"></i></div>
                            <p class="txt"><?php echo $val['circle_name']?></p>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var swiper = new Swiper('.swiper-recommend', {
                pagination: '.swiper-pagination',
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30,
                calculateHeight: true,

            });
        </script>
    </div>


    <div class="demo-item pt nomb ui-border-t">
        <div class="mod-box-header ui-whitespace">
            <h2><i class="icon-one5"></i><strong>明星圈主</strong></h2>
            <!--						<a href="" class="more">更多&gt;</a>-->
        </div>
        <div class="demo-block">
            <div class="swiper-recommend two">
                <div class="swiper-wrapper">
                    <?php foreach ($output['member_list'] as $val){?>
                        <div class="swiper-slide">
                            <div data-href="index.php?act=circle_sns_circle&mid=<?php echo $val['member_id']?>" class="rec-img"><i style="background: url(<?php echo getMemberAvatarForID($val['member_id']);?>);"></i></div>
                            <p class="txt"><?php echo $val['member_name'];?></p>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var swiper = new Swiper('.swiper-recommend.two', {
                pagination: '.swiper-pagination',
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30,
                calculateHeight: true,

            });
        </script>
    </div>


    <div class="demo-item pt mb ui-border-t">
        <div class="mod-box-header ui-whitespace">
            <h2><i class="icon-one3"></i><strong>资讯快递</strong></h2>
        </div>
        <div class="demo-block">
            <ul class="ui-list ui-border-tb">
                <?php foreach ($output['ZhiXun_list'] as $k=>$val){ ?>
                    <li data-href="index.php?act=circle_theme&op=theme_detail&c_id=<?php echo $val['circle_id']?>&t_id=<?php echo $val['theme_id']?>" class="ui-border-t">
                        <div class="ui-list-img">
                            <img src="<?php echo $val['affix']?>"/>
                        </div>
                        <div class="ui-list-info art-module">
                            <p class="ui-txt-tips"><i class="ui-nowrap"><?php echo $val['theme_name'];?></i><i><?php echo date('H:i Y-m-d' ,$val['theme_addtime']) ?></i></p>
                            <h4 class="ui-nowrap-multi"><?php echo mb_substr($val['theme_content'],0,20)?></h4>
                            <p class="ui-txt-tips read-box"><i><?php echo $val['theme_browsecount'];?></i><i><?php echo $val['theme_commentcount'];?></i></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <!--						<div class="to-load-more">-->
            <!--							<a href="javascript:;" onclick="loadMore();">加载更多</a>-->
            <!--						</div>-->
            <!--						<div class="ui-btn-wrap">-->
            <!--<!--						    <button class="ui-btn-lg">-->
            <!--<!--						                展开更多-->
            <!--<!--						    </button>-->
            <!--							<a href="javascript:;" class="ui-btn-lg" onclick="loadMore();">加载更多</a>-->
            <!--						</div>-->
        </div>
    </div>


</section>

<div class="log-in-navigation">
    <?php if($_SESSION['member_id']){?>
        <a class="" href="index.php?act=login&op=login_out">退出</a>
    <?php }else{?>
    <a class="" href="http://m.96567.com/index.php?act=login&op=index">登录</a>
    <a class="" href="http://m.96567.com/index.php?act=login&op=register">注册</a>
    <?php }?>
    <a class="back-to-top" href="#top">返回顶部</a>
</div>
<div class="copyright">

</div>
<?php require_once('footer.php');?>
</body>
</html>

<!--<script>-->
<!--	loadMore();-->
<!--	var j = 2;-->
<!--	function loadMore(){-->
<!--		$.ajax({-->
<!--			type: "GET", cache: false,-->
<!--			url : "index.php?act=circle_index&op=ajax_page",-->
<!--			data: 'curpage=' + j,-->
<!--			beforeSend:function(XMLHttpRequest){-->
<!--				$(".ui-btn-wrap").show();-->
<!--				$(".ui-btn-wrap").html('<a href="javascript:;">正在载入</a>');-->
<!--			},-->
<!--			success : function(html){-->
<!--				$('.zx-expressage').append(html);-->
<!--				if(html.length>30){-->
<!--					$(".ui-btn-wrap").html('<a href="javascript:;" onclick="loadMore();">加载更多</a>');-->
<!--				}else{-->
<!--					$(".ui-btn-wrap").html('<a href="javascript:;">没有更多了</a>');-->
<!--				}-->
<!--			}-->
<!--		});-->
<!--		j++;-->
<!--	}-->
<!--</script>-->