<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
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
		 	 <h1>收藏天下圈子</h1>
		 	 <h1 style="margin-left: 240px" data-href="index.php?act=circle_index&op=add_group">创建圈子</h1>
<!--		 	 <h1 class="ui-fr-btn" style="margin-left: 236px" >创建圈子</h1>-->
		  </header>

		  <section class="ui-container">
			<div class="swiper-con">
			 <div class="tabs four">
			 	<a href="#" class="active"><strong>全部</strong></a> 
			 	<a href="#"><strong>书画艺术</strong></a> 
			 	<a href="#"><strong>鉴定专区</strong></a> 
			 	<a href="#"><strong>金银制品</strong></a>
			    <a href="#"><strong>把玩/手串</strong></a>
			    <a href="#"><strong>翡翠玉器</strong></a>
			 </div>

			 <div class="swiper-container">
			    <div class="swiper-wrapper join">
			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
								<?php if($val['class_id'] == 2 || $val['class_id'] == 3 || $val['class_id'] == 4 || $val['class_id'] == 5 || $val['class_id'] == 7){?>
						    <li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
								<div class="ui-list-thumb2">
								    <span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
								</div>
						        <div class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
						            <p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
						            <p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
						        </div>
									<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
										<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
									<?php }else{?>
										<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a>
										<?php }?>
						    </li>
									<?php }?>
							<?php }?>
			        	</ul>
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
					  	 	  <ul>
					  	 	  	 <li><a href="">所有店铺</a></li>
					  	 	  	 <li><a href="">帮助中心</a></li>
					  	 	  	 <li><a href="">关于我们</a></li>
					  	 	  </ul>
					  	 	  <p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
						  </div>
			        </div>
			      </div>

			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
								<?php if($val['class_id'] == 2){?>
									<li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
										<div class="ui-list-thumb2">
											<span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
										</div>
										<div class="ui-list-info">
											<h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
											<p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
											<p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
										</div>
										<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
										<?php }else{?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
										<?php }?>
									</li>
								<?php }?>
							<?php }?>
			        	</ul>
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
					  	 	  <ul>
					  	 	  	 <li><a href="">所有店铺</a></li>
					  	 	  	 <li><a href="">帮助中心</a></li>
					  	 	  	 <li><a href="">关于我们</a></li>
					  	 	  </ul>
					  	 	  <p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
						  </div>
			        </div>
			      </div>
			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
								<?php if($val['class_id'] == 7){?>
									<li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
										<div class="ui-list-thumb2">
											<span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
										</div>
										<div class="ui-list-info">
											<h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
											<p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
											<p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
										</div>
										<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
										<?php }else{?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
										<?php }?>
									</li>
								<?php }?>
							<?php }?>
			        	</ul>
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
					  	 	  <ul>
					  	 	  	 <li><a href="">所有店铺</a></li>
					  	 	  	 <li><a href="">帮助中心</a></li>
					  	 	  	 <li><a href="">关于我们</a></li>
					  	 	  </ul>
					  	 	  <p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
						  </div>
			        </div>
			      </div>
			      <div class="swiper-slide">
			        <div class="content-slide">
			        	<ul class="ui-list ui-border-tb">
							<?php foreach($output['circle_list'] as $val){?>
								<?php if($val['class_id'] == 5){?>
									<li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
										<div class="ui-list-thumb2">
											<span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
										</div>
										<div class="ui-list-info">
											<h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
											<p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
											<p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
										</div>
										<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
										<?php }else{?>
											<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
										<?php }?>
									</li>
								<?php }?>
							<?php }?>
			        	</ul>
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
					  	 	  <ul>
					  	 	  	 <li><a href="">所有店铺</a></li>
					  	 	  	 <li><a href="">帮助中心</a></li>
					  	 	  	 <li><a href="">关于我们</a></li>
					  	 	  </ul>
					  	 	  <p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
						  </div>
			        </div>
			      </div>

					<div class="swiper-slide">
						<div class="content-slide">
							<ul class="ui-list ui-border-tb">
								<?php foreach($output['circle_list'] as $val){?>
									<?php if($val['class_id'] == 4){?>
										<li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
											<div class="ui-list-thumb2">
												<span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
											</div>
											<div class="ui-list-info">
												<h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
												<p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
												<p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
											</div>
											<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
												<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
											<?php }else{?>
												<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
											<?php }?>
										</li>
									<?php }?>
								<?php }?>
							</ul>
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
								<ul>
									<li><a href="">所有店铺</a></li>
									<li><a href="">帮助中心</a></li>
									<li><a href="">关于我们</a></li>
								</ul>
								<p>Copyright © 2012-2015 搜藏天下96567.com 版权所有</p>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="content-slide">
							<ul class="ui-list ui-border-tb">
								<?php foreach($output['circle_list'] as $val){?>
									<?php if($val['class_id'] == 3){?>
										<li data-href="index.php?act=circle_group&c_id=<?php echo $val['circle_id']?>&mid=<?php echo $val['circle_masterid']?>" class="ui-border-t">
											<div class="ui-list-thumb2">
												<span style="background-image:url(<?php echo circleLogo($val['circle_id']);?>)"></span>
											</div>
											<div class="ui-list-info">
												<h4 class="ui-nowrap"><?php echo $val['circle_name']?></h4>
												<p class="cj">创建于：<?php echo date('Y-m-d	',$val['circle_addtime'])?></p>
												<p class="yt"><strong>用户数：<?php echo $val['circle_mcount']?></strong><strong>帖子数：<?php echo $val['circle_thcount']?></strong></p>
											</div>
											<?php if($val['identity'] != 1 && $val['identity'] != 2 && $val['identity'] != 3) {?>
												<a class="check-txt-circle" href="index.php?act=circle_group&op=applyview&c_id=<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a><br>
											<?php }else{?>
												<a class="check-txt-circle" href="index.php?act=circle_group&op=quit&c_id=<?php echo $val['circle_id'];?>" style="background-color: #999999">退出圈子</a><br>
											<?php }?>
										</li>
									<?php }?>
								<?php }?>
							</ul>
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
						</div>
					</div>
			    </div>
			 </div>
			</div>
		  </section>

		  <?php require_once('footer.php');?>
	</body>
</html>
