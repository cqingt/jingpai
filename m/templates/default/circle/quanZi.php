<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="format-detection" content="telephone=no">
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
		 	 <h1>圈子</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			<div class="swiper-con">
				<?php if($output['mid'] == $_SESSION['member_id']){?>
				<div class="tabs">
					<a href="#" class="active"><strong>我发布的话题</strong></a>
					<a href="#"><strong>我加入的圈子</strong></a>
				</div>
				<?php }else{?>
					<div class="tabs">
						<a href="#" class="active"><strong>TA发布的话题</strong></a>
						<a href="#"><strong>TA加入的圈子</strong></a>
					</div>
				<?php }?>
			 <div class="swiper-container">
			    <div class="swiper-wrapper">
			      <div class="swiper-slide">
			        <div class="content-slide">
						<ul class="ui-list ui-border-tb">
							<?php if(empty($output['theme_list'])){?>
								<h3>他很懒哦</h3>
							<?php }else{?>
							<?php foreach ($output['theme_list'] as $val){?>
						    <li data-href="index.php?act=circle_theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" class="ui-border-t">
						        <div class="ui-avatar">
<!--						            <span style="background-image:url(images/default.jpg)"></span>-->
						            <span style="background-image:url(<?php echo getMemberAvatarForID($val['member_id']);?>)"></span>
						        </div>
						        <div class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $val['theme_name'];?></h4>
						            <p class="time">发布时间：<?php echo @date('Y-m-d', $val['theme_addtime']);?></p>
						            <p class="ui-nowrap-multi3"><span><?php echo substr(removeUBBTag($val['theme_content']),0,90)?></span></p>
						            <p class="ui-txt-tips read-box"><i><?php echo $val['theme_browsecount'];?></i><i><?php echo $val['theme_commentcount'];?></i></p>
						        </div>
						    </li>
							<?php }?>
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

			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
						    <li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
								<div class="ui-list-thumb2">
								    <span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
								</div>
						        <div class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $val['circle_name'];?></h4>
						            <p class="cj">创建于：<?php echo @date('Y-m-d', $val['circle_addtime']);?></p>
						            <p class="yt"><strong>用户数：<?php echo $val['circle_mcount'];?></strong><strong>帖子数：<?php echo $val['circle_thcount'];?></strong></p>
						        </div>
						        <div class="check-txt-circle">查看圈子</div>
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
