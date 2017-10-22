<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="format-detection" content="telephone=no">
</head>
<!--线上正常引入-->
<link rel="stylesheet" href="<?php echo CIRCLE_TEMPLATES_URL;?>/css/layout.css">
<link rel="stylesheet" href="<?php echo CIRCLE_TEMPLATES_URL;?>/css/basis.css">
<link rel="stylesheet" href="<?php echo CIRCLE_TEMPLATES_URL;?>/css/circle.css">
<!--[if IE 6]><style type="text/css">body { _behavior: url(<?php echo CIRCLE_TEMPLATES_URL;?>/css/csshover.htc);}</style><![endif]-->
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
	var COOKIE_PRE = '<?php echo COOKIE_PRE;?>'; var _CHARSET = '<?php echo strtolower(CHARSET);?>'; var SITEURL = '<?php echo SHOP_SITE_URL;?>';
	var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';
	var CIRCLE_SITE_URL = '<?php echo CIRCLE_SITE_URL;?>'; var _ISLOGIN = <?php echo intval($_SESSION['is_login']);?>;
	var APP_SITE_URL = '<?php echo CIRCLE_SITE_URL;?>'; var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
	var NC_HASH = '<?php echo getNchash();?>'; var NC_TOKEN = '<?php echo Security::getTokenValue();?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>







<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.icheck.min.js"></script>
<script type="text/javascript" id="dialog_js" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo CIRCLE_RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.js"></script>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
		<title>收藏天下圈子</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/tzxy/css/normalize.css" />


        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/member.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/navigation.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/main.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/new_page.css" />
        <script type="text/javascript" src="http://m.96567.com/templates/default/js/jquery-1.9.js"></script>

		<!-- New -->
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/circle.css"/>
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.css">
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/frozen.css" />
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>

	</head>
	<body class="demo" id="top">
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1><?php echo $lang['circle_shoucang'];	?></h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			<div class="swiper-con">
			 <div class="tabs four">

			 </div>
			 <div class="swiper-container">
			    <div class="swiper-wrapper join">
			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
						    <li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
								<div class="ui-list-thumb2">
								    <span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
								</div>
						        <div class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
						            <p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
						            <p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
								</div>
								<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
								<a class="check-txt-circle" id="add_circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
								<?php }else{?>
									<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
								<?php }?>

						    </li>
							<?php }?>
			        	</ul>
						<div class="log-in-navigation">
							<?php if($_SESSION['member_id']){?>
								<a class="" href="index.php?act=login&op=login_out">退出</a>
							<?php }else{?>
								<a class="" href="http://m.96567.com/index.php?act=login&op=index">登录</a>
								<a class="" href="http://m.96567.com/index.php?act=login&op=register">注册</a>
							<?php }?>
							<a class="back-to-top" href="#top">返回顶部<i class="icon-arrow-up"></i></a>
						</div>
				          <div class="copyright">

						  </div>
			        </div>
			      </div>
			    </div>
			 </div>
			</div>

		  </section>

		  <?php require_once('footer.php');?>
	</body>

</html>
