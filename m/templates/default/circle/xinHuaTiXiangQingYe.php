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
		 	 <a data-href="index.php?act=circle_index&op=index"><i class="fa fa-angle-left fa-lg"></i><strong>新话题详情</strong></a>
		 	 <h1></h1>
		 	 <div class="ui-fr-btn">
				 <?php if($output['is_identity'] < 1) {?>
		 	 	<a href="index.php?act=circle_group&op=applyview&c_id=<?php echo $output['circle_info']['circle_id'];?>">加入圈子</a>
				 <?php }else{ ?>

				 <?php }?>
		 	 	<a href="">主贴回复</a>
		 	 </div>
		  </header>

		  <section class="ui-container">
		  	<div class="demo-tiem">
		  		<div class="ui-topic-details-title">
		  			<h2 class="ui-nowrap"><?php echo $output['theme_info']['theme_name'];?></h2>
		  			<div class="ui-two">
		  				<p>标签：<?php echo $output['theme_info']['theme_name'];?></p>
		  				<span>
		  					<strong>回复：<em><?php echo $output['theme_info']['theme_commentcount'];?></em></strong>
		  					<strong>浏览：<?php echo $output['theme_info']['theme_browsecount'];?></strong>
		  				</span>
		  			</div>
		  		</div>
		  		<div class="list-topics top-Landlord">
					<div class="first-group">
						<p class="icon-img"><?php echo $output['theme_info']['member_name'];?><strong><?php echo $output['new_member']['cm_levelname']?></strong><strong>LV&nbsp;<?php echo $output['new_member']['cm_level']?></strong></p>
						<span>楼主</span>
					</div>
		  			<time>发表时间：<?php echo @date('Y-m-d H:i:s', $output['theme_info']['theme_addtime']);?></time>
		  			<div class="thematic-content">
						<?php echo ubb($output['theme_info']['theme_content']);?>
		  			</div>
		  			<div class="icon-reply" data-href="index.php?act=circle_theme&op=reply_view&c_id=<?php echo $output['theme_info']['circle_id']?>&t_id=<?php echo $output['theme_info']['theme_id'];?>">回复</div>
		  		</div>
				<?php foreach($output['reply_info'] as $val){?>
				<div class="list-topics top-Landlord">
					<div class="first-group">
					<p class="icon-img"><?php echo $val['member_name'];?><strong><?php echo $output['new_member']['cm_levelname']?></strong><strong>LV&nbsp;<?php echo $output['new_member']['cm_level']?></strong></p>
						<span><?php echo $val['reply_id'];?>楼</span>
					</div>
		  			<time>发表时间：<?php echo @date('Y-m-d H:i', $val['reply_addtime']);?></time>
		  			<div class="thematic-content">
		  				<div class="on-reply">
								<?php echo $val['reply_content']?>
		  				</div>
						<div class="icon-reply" data-href="index.php?act=circle_theme&op=reply_view&c_id=<?php echo $output['theme_info']['circle_id']?>&t_id=<?php echo $output['theme_info']['theme_id'];?>">回复</div>
		  			</div>
				<?php }?>
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
