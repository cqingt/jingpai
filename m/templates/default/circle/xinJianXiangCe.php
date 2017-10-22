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
		 	 <h1>新建相册</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
  		  <form action="index.php?act=circle_sns_album&op=album_add_save" method="post">
		  	<div class="album-setting">
		  			<section class="ui-list-view ui-border-tb">
		  				<div class="ui-field ui-border-b">
		  					<label class="field-name">名称</label>
		  					<p class="field-area">        
		  						<input type="text" value="" name="name" placeholder="可输入30个字（必填）">
		  					</p>
		  				</div>
		  				<div class="ui-field">
		  					<label class="field-name">描述</label>
		  					<p class="field-area">        
		  						<input type="text" name="description" value="" placeholder="可输入200个字">
		  					</p>
		  				</div>
		  			</section>
		  	</div>
			<div class="album-setting-limits">
				<p class="demo-desc">排序</p>
			    <div class="ui-form ui-border-t">
		            <div class="ui-form-item-radio ui-border-b">
		                
<!--		                <label class="ui-radio" for="radio">-->
		                    <input type="text"  name="sort" placeholder="请输入排序号">
<!--		                </label>-->
		            </div>
			    </div>
			</div>
			
			<div class="ui-btn-wrap tc">
<!--				<button class="ui-btn ui-btn-danger">新建</button>-->
				<input type="submit" value="新建" class="ui-btn ui-btn-danger">
				<button class="ui-btn ui-btn-progress">取消</button>
			</div>
		  </form>
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
