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
		 	 <h1>我的访客</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			<div class="swiper-con">
			 <div class="tabs">
				 <?php if($output['mid'] == $_SESSION['member_id']){?>
					<a href="#" class="active"><strong>谁来看过我</strong></a>
					<a href="#"><strong>我访问过的人</strong></a>
				 <?php }else{?>
					 <a href="#" class="active"><strong>谁来看过TA</strong></a>
					 <a href="#"><strong>TA访问过的人</strong></a>
				 <?php }?>
			 </div>
			 
			 <div class="swiper-container">
			    <div class="swiper-wrapper">
			      <div class="swiper-slide">
			        <div class="content-slide ui-border-t">
			        	<div class="demo-day"><?php echo date('m月-d日',time());?></div>
			        	<ul class="ui-list ui-border-b join">
						<?php if($output['mid'] == $_SESSION['member_id']){?>
							<?php foreach ($output['visitme_list'] as $k=>$v){?>
						    <li class="ui-border-t">
								<div data-href="" class="ui-avatar-lg plus">
								    <span style="background-image:url(<?php echo getMemberAvatarForID($v['v_mid']); ?>)"></span>
								</div>
						        <div data-href="" class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $v['v_mname']?></h4>
						            <p class="cj">城市：保密</p>
						            <p class="yt"><strong>生日：保密</strong></p>
						            <p class="yt"><strong>联系：...</strong></p>
						            <time class="visit"><?php echo date('H:i:s',$v['v_addtime']);?></time>
						        </div>
								<?php if($v['memlist'] > 0){?>
									<div class="check-txt-circle plus" data-href="javascript:void(0)">已关注</div>
								<?php }else{ ?>
						        <div class="check-txt-circle plus" data-href="index.php?act=circle_member_snsfriend&op=addfollow&mid=<?php echo $v['v_mid']?>">加关注</div>
								<?php }?>
						    </li>
								<?php }?>
							<?php }else{?>
								<?php foreach ($output['ta_visitme_list'] as $k=>$v){?>
									<li class="ui-border-t">
										<div data-href="" class="ui-avatar-lg plus">
											<span style="background-image:url(<?php echo getMemberAvatarForID($v['v_mid']); ?>)"></span>
										</div>
										<div data-href="" class="ui-list-info">
											<h4 class="ui-nowrap"><?php echo $v['v_mname']?></h4>
											<p class="cj">城市：保密</p>
											<p class="yt"><strong>生日：保密</strong></p>
											<p class="yt"><strong>联系：...</strong></p>
											<time class="visit"><?php echo date('H:i:s',$v['v_addtime']);?></time>
										</div>
										<?php if($v['memlist'] > 0){?>
											<div class="check-txt-circle plus" data-href="javascript:void(0)">已关注</div>
										<?php }else{ ?>
											<div class="check-txt-circle plus" data-href="index.php?act=circle_member_snsfriend&op=addfollow&mid=<?php echo $v['v_mid']?>">加关注</div>
										<?php }?>
									</li>
								<?php }?>
							<?php }?>
			        	</ul>
				          <div class="log-in-navigation mt">
							  <a class="" href="http://m.96567.com/index.php?act=login&op=index">登录</a>
							  <a class="" href="http://m.96567.com/index.php?act=login&op=register">注册</a>
							  <a class="" href="index.php?act=login&op=login_out">退出</a>
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
			        	<div class="demo-day"><?php echo date('m月-d日',time());?></div>
			        	<ul class="ui-list ui-border-b join">
						<?php if($output['mid'] == $_SESSION['member_id']){?>
							<?php foreach ($output['visitother_list'] as $k=>$v){?>
						    <li class="ui-border-t">
								<div data-href="" class="ui-avatar-lg plus">
								    <span style="background-image:url(<?php echo getMemberAvatarForID($v['v_ownermid']);?>)"></span>
								</div>
						        <div data-href="" class="ui-list-info">
						            <h4 class="ui-nowrap"><?php echo $v['v_ownermname'];?></h4>
						            <p class="cj">城市：保密</p>
						            <p class="yt"><strong>生日：保密</strong></p>
						            <p class="yt"><strong>联系：...</strong></p>
						            <time class="visit"><?php echo date('H:i',$v['v_addtime'])?></time>
						        </div>
								<?php if($v['outhlist'] > 0){?>
						        <div class="check-txt-circle plus" data-href="javascript:void(0)">已关注</div>
								<?php }else{?>
									<div class="check-txt-circle plus" data-href="index.php?act=circle_member_snsfriend&op=addfollow&mid=<?php echo $v['v_ownermid']?>">加关注</div>
								<?php }?>
						    </li>
							<?php }?>
							<?php }else{?>
							<?php foreach ($output['ta_visitother_list'] as $k=>$v){?>
								<li class="ui-border-t">
									<div data-href="" class="ui-avatar-lg plus">
										<span style="background-image:url(<?php echo getMemberAvatarForID($v['v_ownermid']);?>)"></span>
									</div>
									<div data-href="" class="ui-list-info">
										<h4 class="ui-nowrap"><?php echo $v['v_ownermname'];?></h4>
										<p class="cj">城市：保密</p>
										<p class="yt"><strong>生日：保密</strong></p>
										<p class="yt"><strong>联系：...</strong></p>
										<time class="visit"><?php echo date('H:i',$v['v_addtime'])?></time>
									</div>
									<?php if($v['outhlist'] > 0){?>
										<div class="check-txt-circle plus" data-href="javascript:void(0)">已关注</div>
									<?php }else{?>
										<div class="check-txt-circle plus" data-href="index.php?act=circle_member_snsfriend&op=addfollow&mid=<?php echo $v['v_ownermid']?>">加关注</div>
									<?php }?>
								</li>
							<?php }?>
							<?php }?>
			        	</ul>
				          <div class="log-in-navigation mt">
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
