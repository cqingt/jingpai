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
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/HHuploadify.css">
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/HHuploadify.js"></script>
        
	</head>
	<body class="demo" id="top">
		  <header class="home-header">
			  <a data-href="index.php?act=circle_index&op=index"><i class="fa fa-angle-left fa-lg"></i><?php echo $output['circle_info']['circle_name']?></a>
		 	 <h1></h1>
		  </header>

		  <section class="ui-container">
			<div class="ui-panel-simple">
				<ul class="ui-row inf-nav ui-border-b">
					<li data-href="index.php?act=circle_group&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>话题</strong></li>
					<li data-href="index.php?act=circle_group&op=group_member&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>圈友</strong></li>
					<li data-href="index.php?act=circle_group&op=group_goods&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong>商品</strong></li>
					<li data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col-25"><strong class="active">管理</strong></li>
				</ul>
			</div>
		  	<div class="demo-item">
		  		<div class="demo-block">
					<ul class="ui-row-flex ui-whitespace ringbox">
						<li class="ui-col ui-col">
							<div class="ui-avatar-lg">
								<img src="<?php echo getMemberAvatarForID($output['circle_info']['circle_masterid']);?>"/>
							</div>
							<div class="what-ring">
								<h5 class="ui-nowrap"><?php echo $output['circle_info']['circle_name'];?></h5>
								<h6>
									<a href="">圈主</a>
								</h6>
							</div>
						</li>
						<li class="ui-col ui-col">
							<p class="icon-manage">管理中心</p>
						</li>
					</ul>
		  		</div>
		  	</div>
		  	
		  	<div class="demo-tiem">
				<div class="ui-row-flex ui-whitespace manPilot">
				    <div data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col active">设置</div>
				    <div data-href="index.php?act=circle_manage&op=member_manage&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">成员</div>
				    <div data-href="index.php?act=circle_manage&op=applying&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">审核</div>
				    <div data-href="index.php?act=circle_manage&op=class&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">分类</div>
				    <div data-href="index.php?act=circle_manage_mapply&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">申请管理</div>
				</div>
		  	</div>
		  	
			<div class="demo-bf pt">
				<div class="demo-block">
					<form action="index.php?act=circle_manage&c_id=<?php echo $output['c_id'];?>" method="post" enctype="multipart/form-data">
						<input type="hidden" id="c_id" value="<?php echo $output['c_id'];?>">
						<div class="ui-form-item">
						    <label>圈子描述：</label>
			                <textarea  class="fourinput" name="c_desc" rows="" cols=""><?php echo $output['circle_info']['circle_desc'];?></textarea>
						</div>
						<div class="ui-form-item">
						    <label>圈子公告：</label>
			                <textarea  class="fourinput" name="c_notice" rows="" cols=""><?php echo $output['circle_info']['circle_notice'];?></textarea>
						</div>
<!--						<img src="--><?php //echo CIRCLE_PATH.$output['circle_img']['circle_img'];?><!--" class="ui-avatar-lg"/>圈子默认logo-->
						<div class="ui-form-item">
						    <label>圈子LOGO：</label>
			                <div id="upload2" class="fourdiv" name="c_img"></div>
						</div>
						<div class="ui-form-item">
						    <label>申请管理：</label>
			                <div class="fourdiv">
								<label class="ui-radio" for="radio1">
									<input type="radio" name="c_joinaudit" value="1" <?php if($output['circle_info']['circle_joinaudit'] == 1){?>checked="checked"<?php }?>>
								</label>
								<span>是</span>
								<label class="ui-radio" for="radio1">
									<input type="radio" name="c_joinaudit" value="0" <?php if($output['circle_info']['circle_joinaudit'] == 0){?>checked="checked"<?php }?>>
								</label>
								<span>否</span>
			                </div>
						</div>
						<div class="ui-form-item">
						    <label>申请审核：</label>
			                <div class="fourdiv">
								<label class="ui-radio" for="radio2">
									<input type="radio" name="c_mapply" value="1" <?php if($output['circle_info']['mapply_open'] == 1){?>checked="checked"<?php }?>>
								</label>
								<span>是</span>
								<label class="ui-radio" for="radio2">
									<input type="radio" name="c_mapply" value="0" <?php if($output['circle_info']['mapply_open'] == 0){?>checked="checked"<?php }?>>
								</label>
								<span>否</span>
			                </div>
						</div>
						<div class="ui-btn-wrap">
<!--							<button class="ui-btn-lg ui-btn-danger">发布</button>-->
							<input type="submit" value="提交设置" class="ui-btn-lg ui-btn-danger">
						</div>
				   </form>
				</div>
			</div>
			<script>
			    $('#upload2').HHuploadify({
					ime:true,
					auto:true,
					showUploadedBar: false, // 默认情况下，会显示进度条，如果想只显示百分比，则应该关掉
					showUploadedPercent: true,
					fileTypeExts:'*.jpg;*.png;*.gif',
					showPreview: true,
					fileSizeLimit:1024,
					scriptData:{'c_id':$('#c_id').val()},
			        uploader:'index.php?act=circle_manage&op=circle_pic&c_id=1'
			    });
			</script>
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
