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
		 	 <a data-href="index.php?act=circle_index&op=index"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>个人中心</h1>
		 	 <div class="ui-fr-btn"></div>
		 	 
		  </header>

		  <section class="ui-container">
		  	
		  	<div class="demo-plr">
		  		<div class="demo-block">
					<ul class="ui-tiled my-center">
						<li>
							<div class="ui-avatar-lg">
								<img src="<?php echo getMemberAvatarForID($output['members_id']);?>" data-param="{'id':<?php echo $output['members_id'];?>}" nctype="mcard">
							</div>
						</li>
						<li>
							<h5 class="ui-nowrap"><?php echo $output['member_name']['member_name']?></h5>

							<?php if($_SESSION['member_id'] ==  $output['member_name']['member_id']) {?>
							<h6>
								<a href="index.php?act=circle_member_information&op=member">编辑资料</a>
							</h6>
							<?php }else{ ?>

							<?php }?>
						</li>
						<li>
							<h6>粉丝</h6>
							<h6><?php echo $output['master_info']['fan_count'];?></h6>
						</li>
						<li>
							<h6>关注</h6>
							<h6><?php echo $output['master_info']['attention_count'];?></h6>
						</li>
						<li>
							<h6>访问</h6>
							<h6><?php echo $output['master_info']['member_snsvisitnum'];?></h6>
						</li>
					</ul>
		  		</div>
		  	</div>

			<div class="demo-item mb">
			    <div class="demo-block">
			        <ul class="ui-list ui-list-one ui-list-link ui-border-tb">
			            <li data-href="index.php?act=circle_member_snshome&op=shareglist&type=''&mid=<?php echo $output['members_id']?>" class="ui-border-t">
			                <div class="ui-list-info">
			                	<i class="icon-pc1"></i>
			                    <h4 class="ui-nowrap">宝贝</h4>
			                </div>
			            </li>
			            <li data-href="index.php?act=circle_member_snshome&op=storelist&mid=<?php echo $output['members_id']?>" class="ui-border-t">
			                <div class="ui-list-info">
			                	<i class="icon-pc2"></i>
			                    <h4 class="ui-nowrap">店铺</h4>
			                </div>
			            </li>
			            <li data-href="index.php?act=circle_sns_album&mid=<?php echo $output['members_id']?>" class="ui-border-t">
			                <div class="ui-list-info">
			                	<i class="icon-pc3"></i>
			                    <h4 class="ui-nowrap">相册</h4>
			                </div>
			            </li>
			            <li data-href="index.php?act=circle_member_snshome&op=trace&mid=<?php echo $output['members_id']?>" class="ui-border-t">
			                <div class="ui-list-info">
			                	<i class="icon-pc4"></i>
			                    <h4 class="ui-nowrap">新鲜事</h4>
			                </div>
			            </li>
			            <li data-href="index.php?act=circle_sns_circle&op=quanzi&mid=<?php echo $output['members_id']?>" class="ui-border-t">
			                <div class="ui-list-info">
			                	<i class="icon-pc5"></i>
			                    <h4 class="ui-nowrap">圈子</h4>
			                </div>
			            </li>
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
