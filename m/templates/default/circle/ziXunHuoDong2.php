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
			  <a data-href="index.php?act=circle_index&op=index"><i class="fa fa-angle-left fa-lg"></i><?php echo $output['circle_info']['circle_name']?></a>
			  <?php if($output['identity'] != 1 && $output['identity'] != 2 && $output['identity'] != 3) {?>
				  <a class="" style="padding-right: 120px" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $output['circle_info']['circle_id'];?>"><i>+</i>加入圈子</a>
			  <?php }else{?>
			  <?php }?>
			  <a style="margin-left: 200px" data-href="index.php?act=circle_theme&op=new_theme&c_id=<?php echo $output['circle_info']['circle_id'];?>">新话题</a>
		  </header>

		  <section class="ui-container">
			<div class="ui-panel-simple">
				<ul class="ui-row inf-nav ui-border-b">
					<li data-href="index.php?act=circle_group&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>话题</strong></li>
					<li data-href="index.php?act=circle_group&op=group_member&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong class="active">圈友</strong></li>
					<li data-href="index.php?act=circle_group&op=group_goods&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>商品</strong></li>
					<?php if($output['creator']['member_id'] == $_SESSION['member_id']){?>
					<li data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>管理</strong></li>
					<?php }else{?>
					<?php }?>
				</ul>
			</div>
			
			<div class="demo-item">
				<ul class="circle-of-friends">
					<?php foreach ($output['cm_list'] as $val){?>
					<li data-href="index.php?act=circle_sns_circle&mid=<?php echo $val['member_id'];?>">

						<div class=""><img src="<?php echo getMemberAvatarForID($val['member_id']);?>" /></div>

						<p class="ui-nowrap"><span><?php echo mb_substr($val['member_name'],0,4)?>...</span></p>
						<span>
							<strong><?php echo $val['cm_levelname']?></strong>
							<em>LV<?php echo $val['cm_level']?></em>
						</span>
					</li>
					<?php }?>
				</ul>
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
