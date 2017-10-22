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
		 	 <h1>店铺</h1>
		 	 <div class="ui-fr-btn">
				 <?php if($output['master_id'] == $_SESSION['member_id']){?>
		 	 	<a class="ui-icon-share" href="index.php?act=circle_member_snsindex&op=collection_store&mid=<?php echo $output['master_id']?>">分享店铺</a>
				 <?php }else{?>
				 <?php }?>
		 	 </div>
		  </header>

		  <section class="ui-container">
		     <div class="demo-item">
				<div class="shaop-title"><strong>分享的店铺</strong></div>
			 </div>
			 <div class="demo-item">
			 	<div class="demo-block">
			 		<ul class="shop-dynamic-list mb">
						<?php foreach($output['storelist'] as $k=>$v){?>
			 			<li class="ui-border-b">
			 				<h4><?php echo $v['share_membername'];?></h4>
			 				<h5>"分享了店铺"</h5>
			 				<div class="demo-shop" data-href="<?php echo urlShop('show_store', 'index', array('store_id'=>$v['store_id']));?>">
								<div class="ui-row-flex">
								    <div class="ui-col ui-col">
								    	<h2 class="ui-nowrap"><?php echo $v['store_name'];?></h2>
								    </div>
								    <div class="ui-col ui-col">

										<div class="ui-row-flex">
										    <div class="ui-col ui-col" data-href="">
										    	<p><?php echo $v['goods_count'];?></p>
										    	<strong>所有宝贝</strong>
										    </div>
										    <div class="ui-col ui-col">
										    	<p><?php echo $v['store_collect'];?></p>
										    	<strong>收藏人气</strong>
										    </div>

										</div>

								    </div>
								</div>
			 				</div>
<!--							<div class="ui-btn-wrap">-->
<!--							    <button class="ui-btn ui-btn-progress"><a href="--><?php //echo urlShop('show_store', 'index', array('store_id'=>$v['store_id']));?><!--">逛逛店铺</a></button>-->
<!--							    <button class="ui-btn ui-btn-danger">收藏店铺</button>-->
<!--							</div>-->
			 			</li>
						<?php }?>
			 		</ul>
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
			  <a class="back-to-top" href="#top">返回顶部<i class="icon-arrow-up"></i></a>
		  </div>
          <div class="copyright">

		  </div>
		  <?php require_once('footer.php');?>
	</body>
</html>
