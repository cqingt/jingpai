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
	<body>
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>申请加入</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			  	
			<div class="ui-sq">
				<form action="index.php?act=circle_group&op=apply&c_id=<?php echo $output['c_id']?>" method="post">
				<div class="demo-item mb">
				   <div class="demo-bt ui-border-b"><p class="demo-title icon-title ">申请加入“邮票圈子“的原因</p></div>
				   <div class="ui-whitespace">
				   	   <h5 class="ui-txt-justify">成为圈中成员之前，希望您能告诉我们是什么原因使您加入到本圈？</h5>
				   	   <h5 class="ui-txt-info mt-small">例如：本人乃购物达人，大家志同道合，有好多购物经验要和圈友分享哦！</h5>
				   	   <textarea class="alltxt" id="apply_content" name="apply_content" rows="" cols=""></textarea>
				   </div>
				</div>
				<div class="demo-item pb">
				   <div class="demo-bt ui-border-b"><p class="demo-title icon-newp ">新人自我介绍</p></div>
				   <div class="ui-whitespace">
				   	   <h5 class="ui-txt-justify">在这里写下你的个性介绍，是让别的圈友了解并熟悉你的最佳方法。</h5>
				   	   <h5 class="ui-txt-info mt-small">例如：大家好，我是咪咪，女，90后，天秤座，来自北京，我有好多好多的购物经验要跟大伙儿分享~ 爱好：买衣服，挑首饰，自拍，交朋友...</h5>
				   	   <textarea class="alltxt" name="intro" id="intro" rows="" cols=""></textarea>
				   </div>
				</div>
				<div class="ui-btn-wrap tc">
<!--					<a href="javascript:void(0)" class="ui-btn ui-btn-danger" id="button">提交申请</a>-->
					<input type="submit" class="ui-btn ui-btn-danger" value="提交申请">
					<button class="ui-btn ui-btn-progress">取消</button>
				</div>
				</form>
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

