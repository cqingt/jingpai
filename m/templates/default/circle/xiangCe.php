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
		 	 <h1>相册</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
		     <div class="demo-item">
				<div class="shaop-title">
					<strong data-href="xiangCe.html" class="active">我的相册</strong>
				</div>
			 </div>
			 
			 <div class="demo-item">
			 	<div class="demo-block">
			 	
			 		<div class="album-list">
						<?php if($_SESSION['member_id'] == $output['master_id']){?>
						<div data-href="<?php echo M_CIRCLE;?>/index.php?act=circle_sns_album&op=photo_upload" class="item">
							<div class="col-l">
								<span class="create-btn"></span>
							</div>
							<div class="col-m">
								<div class="txt">
									<span class="create-txt">上传图片</span>
								</div>
							</div>
						</div>
				 		<div data-href="<?php echo M_CIRCLE;?>/index.php?act=circle_sns_album&op=album_add" class="item">
				 			<div class="col-l">
				 				<span class="create-btn"></span>
				 			</div>
				 			<div class="col-m">
				 				<div class="txt">
				 					<span class="create-txt">新建相册</span>
				 				</div>
				 			</div>
				 		</div>
						<?php }else{?>

						<?php }?>

				 		<?php foreach($output['ac_list'] as $key=> $val) {?>
				 		<div data-href="index.php?act=circle_sns_album&op=album_pic_list&id=<?php echo $val['ac_id']?>&mid=<?php echo $output['master_id'];?>" class="item">

				 			<div class="col-l">
				 				<span class="create-btn"><img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_MALBUM.DS.$output['master_id'].DS.$val['ac_cover'];?>" style="height: 91px"></span>
				 			</div>

				 			<div class="col-m">
				 				<div class="inner">
				 					<p class="album-name">
				 						<span class="txt"><?php echo $val['ac_name']?></span>
				 					</p>
				 					<p class="album-meta">
				 						<span class="count"><?php echo $val['count']?>张</span>
				 						<span class="limit"><?php echo $val['ac_des']?></span>
				 					</p>
				 				</div>
				 			</div>
				 		</div>
						<?php }?>

			 		</div>
			 		
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
