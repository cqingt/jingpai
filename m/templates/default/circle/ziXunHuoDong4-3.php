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
			  <a data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['circle_info']['circle_id']?>"><i class="fa fa-angle-left fa-lg"></i><?php echo $output['circle_info']['circle_name']?></a>

			  <h1></h1>
		  </header>

		  <section class="ui-container">
		  	<div class="demo-item">
		  		<div class="demo-block">
					<ul class="ui-row-flex ui-whitespace ringbox">
						<li class="ui-col ui-col">
							<div class="ui-avatar-lg">
								<img src="http://a3.topitme.com/d/3e/4a/1104659916f404a3edl.jpg"/>
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
					<div data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">设置</div>
					<div data-href="index.php?act=circle_manage&op=member_manage&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">成员</div>
					<div data-href="index.php?act=circle_manage&op=applying&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col active">审核</div>
					<div data-href="index.php?act=circle_manage&op=class&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">分类</div>
					<div data-href="index.php?act=circle_manage_mapply&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">申请管理</div>
				</div>
		  	</div>
		  	
			<div class="demo-bf pt">
				<ul class="ui-never ui-border-tb mb-lg">
					<?php foreach ($output['cm_list'] as $val){?>
				    <li class="ui-row-flex ui-border-b">
				    	<div class="ui-col ui-col-4">
					        <div class="ui-avatar">
					            <img src="<?php echo getMemberAvatarForID($val['member_id']);?>"/>
					        </div>
					        <div class="ui-list-info">
					            <h4 class="ui-nowrap">用户名:<?php echo $val['member_name'];?></h4>
					            <p class="ui-nowrap">申请时间：<?php echo date('Y-m-d', $val['cm_applytime']);?></p>
					        </div>
							<div class="demo-txt">
								<p class="ui-nowrap-flex">申请理由：<?php echo $val['cm_applycontent'];?></p>
								<p class="ui-nowrap-flex">自我介绍：<?php echo $val['cm_intro'];?></p>
							</div>	
				    	</div>
				    	<div class="ui-col">
							<button class="ui-btn-ok" data-href="index.php?act=circle_manage&op=applying_manage&type=yes&cm_id=<?php echo $val['member_id'];?>&c_id=<?php echo $output['c_id'];?>">通过</button>
							<button class="ui-btn-no" data-href="index.php?act=circle_manage&op=applying_manage&type=no&cm_id=<?php echo $val['member_id'];?>&c_id=<?php echo $output['c_id'];?>" >拒绝</button>
				    	</div>
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

<!--<script>-->
<!--	//通过-->
<!--	$('#ok').click(function(){-->
<!--		var c_id = $('#ok').val();-->
<!--//		alert(c_id);-->
<!--		$.ajax({-->
<!--			url:"index.php?act=circle_manage&op=applying_manage&type=yes",-->
<!--			type:"POST",-->
<!--			data:{'c_id':c_id},-->
<!--			success:function(data)-->
<!--			{-->
<!--				alert(data+"123");-->
<!--			}-->
<!---->
<!--		});-->
<!--	})-->
<!--</script>-->
