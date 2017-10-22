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
		 	 <a data-href="index.php?act=circle_sns_album&mid=<?php echo $output['master_id']?>"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1><?php echo $output['class_info']['ac_name']?></h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
		  	<div class="page-list-photo">
		  		<div class="album-detail">
		  			<p class="inner">
		  				<span class="album-name"><?php echo $output['class_info']['ac_name']?></span>
		  				<span class="album-desc"><?php echo $output['class_info']['ac_des']?></span>
		  			</p>
		  			<!--如果有图片就显示 -->
                    <b class="cover-img" style="background-image: url(<?php echo UPLOAD_SITE_URL.DS.ATTACH_MALBUM.DS.$output['master_id'].DS.$output['class_info']['ac_cover'];?>);"></b>
		  		</div>
				<?php if($output['master_id'] == $_SESSION['member_id']){?>
		  		<div class="photo-add">
		  			<button data-href="index.php?act=circle_sns_album&op=photo_upload" class="btn-upload">添加照片</button>
		  		</div>
				<?php }else{?>
				<?php }?>
		  		<div class="photo-list">
					<ul class="ui-img-list">
						<?php $ii=0;?>
						<?php foreach($output['pic_list'] as $v){?>
						<?php
						$curpage = intval($_GET['curpage']) ? intval($_GET['curpage']) : 1;
						$ii++;
						?>
						<li class="item">
							<p class="img loaded cover_id img_id=<?php echo $v['ac_id']?>" name="<?php echo $v['ap_id']?>" role="img" style="background-image: url(<?php echo UPLOAD_SITE_URL.DS.ATTACH_MALBUM.DS.$output['master_id'].DS.str_ireplace('.', '_240.', $v['ap_cover']);?>)"></p>

							<?php if($output['master_id'] == $_SESSION['member_id']){?>
							<button class="cover">设为封面</button><button class="del">删除</button>
							<?php }else{?>
							<?php }?>

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
<script>

//设为封面
	$('.cover').click(function(){
		var id = $(this).prev().attr('name');
//		alert(id);
		$.ajax({
			url:"index.php?act=circle_sns_album&op=change_album_cover",
			type:"GET",
			data:{'id':id},
			success:function(data)
			{
				window.location.href='index.php?act=circle_sns_album&op=album_pic_list';
			}
		});
	})

//删除照片
	$('.del').click(function(){
		var id = $(this).prev().prev().attr('name');
		$.ajax({
			url:"index.php?act=circle_sns_album&op=album_pic_del",
			type:"GET",
			data:{'id':id},
			success:function(data)
			{
				window.location.href='index.php?act=circle_sns_album&op=album_pic_list';
			}
		});
	})
</script>
