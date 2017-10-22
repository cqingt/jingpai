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
		 	 <a data-href="index.php?act=circle_sns_circle&mid=<?php echo $output['master_id']?>"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>宝贝</h1>
		 	 <div class="ui-fr-btn">
				 <?php if($output['master_id'] == $_SESSION['member_id']){?>
		 	 	<a class="ui-icon-share" href="index.php?act=circle_member_snsindex&op=collection_goods&mid=<?php echo $output['master_id']?>">分享宝贝</a>
				 <?php }else{?>
				 <?php }?>
		 	 </div>
		  </header>

		  <section class="ui-container">
			<div class="swiper-con">
				<div class="tabs">
					<a href="#" class="active"><strong>分享的宝贝</strong></a>
					<a href="#"><strong>喜欢的宝贝</strong></a>
				</div>
			 
			 <div class="swiper-container">
			    <div class="swiper-wrapper">
			      <div class="swiper-slide">
				<!--分享的宝贝-->
			        <div class="content-slide">
						<ul class="ui-list ui-border-tb">
							<?php foreach ($output['goodssharelist'] as $k=>$v){ ?>
								<li data-href="" class="ui-border-t">
									<div class="ui-list-thumb2">
										<span style="background-image:url(<?php echo cthumb($v['snsgoods_goodsimage'],240,$v['snsgoods_storeid']);?>)"></span>
									</div>
									<div class="ui-list-info">
										<h4 class="ui-nowrap"><?php echo $v['share_content'];?></h4>
										<p class="rmb">￥<?php echo $v['snsgoods_goodsprice'];?></p>
										<p class="ui-txt-tips read-box"><i class="icon-like">喜欢</i><a href=""><i><?php echo $v['snsgoods_likenum'];?></i></a></p>
									</div>
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
					  	 	  <ul>
					  	 	  	 <li><a href="">所有店铺</a></li>
					  	 	  	 <li><a href="">帮助中心</a></li>
					  	 	  	 <li><a href="">关于我们</a></li>
					  	 	  </ul>
					  	 	  <p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
						  </div>
			        </div>
			      </div>

<!--					喜欢的商品-->
			      <div class="swiper-slide">
			        <div class="content-slide">
						<ul class="ui-list ui-border-tb">
							<?php foreach ($output['goodslist'] as $k=>$val){ ?>
								<li data-href="" class="ui-border-t">
									<div class="ui-list-thumb2">
										<span style="background-image:url(<?php echo cthumb($val['snsgoods_goodsimage'],240,$val['snsgoods_storeid']);?>)"></span>
									</div>
									<div class="ui-list-info">
										<h4 class="ui-nowrap"><?php echo mb_substr($val['snsgoods_goodsname'],0,16);?>...</h4>
										<p class="rmb">￥<?php echo $val['snsgoods_goodsprice']?></p>
										<p class="ui-txt-tips read-box"><i class="icon-like">喜欢</i><i><?php echo $val['snsgoods_likenum'];?></i></p>
									</div>
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
