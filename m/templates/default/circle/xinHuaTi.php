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
		 	 <h1><?php echo $output['circle_info']['circle_name'];?></h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			<ul class="new-nav-ht">
				<li class="active" data-href="javascript:void(0);"><?php echo $lang['circle_new_theme'];?></li>
				<li data-href="index.php?act=circle_theme&op=new_theme&sp=1&c_id=<?php echo $output['c_id'];?>"><?php echo $lang['circle_new_poll'];?></li>
			</ul>
			<div class="demo-item">
				<div class="demo-block">
					<div class="ui-form">
<!--						<form action="index.php?act=circle_theme?op=save_theme&c_id=--><?php //echo $output['c_id'];?><!--" method="post">-->
						<form action="">
							<div class="ui-form-item">
								<input type="hidden" id="c_id" value="<?php echo $output['circle_info']['circle_id'];?>">
							    <label><?php echo $lang['nc_title'];?>：</label>
							    <input class="inputxt" type="text" id="name" name="name" placeholder="输入帖子标题，限3-45个字">
							</div>
							<div class="ui-form-item-textarea">
							    <label><?php echo $lang['nc_content'];?>:</label>
							    <textarea class="inputxt" id="themecontent" name="themecontent" rows="" cols=""></textarea>
						    </div>
							<div class="ui-btn-wrap">
								<a class="ui-btn-lg ui-btn-danger" id="Tbutton">
									<?php echo $lang['nc_release_op']?>
								</a>
							</div>
					    </form>
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

<script>
	$('#Tbutton').click(function(){
		var name = $('#name').val();
		var themecontent = $('#themecontent').val();
		var c_id = $('#c_id').val();
		$.ajax({
			url:"index.php?act=circle_theme&op=save_theme&c_id="+c_id,
			type:"POST",
			data:{'name':name,'themecontent':themecontent,'c_id':c_id},
			success:function(data)
			{
				if(data == 1){
					self.location='<?php echo M_CIRCLE;?>/index.php?act=circle_group&op=index&c_id='+c_id;
				}

			}
		});
	})
</script>