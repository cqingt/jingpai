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
	<body>
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>创建圈子</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			  	
			<div class="demo-item ui-sq">
			   <div class="demo-bt ui-border-b"><p class="demo-title icon-title ">创建一个圈子</p></div>
			   <div class="ui-whitespace">
			   	   <h5 class="ui-txt-justify">欢迎在收藏圈子这个快乐和谐的地方，聚集和你爱好相同，品位相当的好朋友，畅谈交流，分享心情，享受生活！</h5>		   	
			   </div>
			   <div class="demo-block">
					<ul class="ui-row ui-zy ui-border-tb">
					    <li class="ui-col ui-col-50">最多可创建圈子数：<strong><?php echo C('circle_createsum');?></strong></li>
					    <li class="ui-col ui-col-50">已经创建圈子数：<strong><?php echo $output['create_count'];?></strong></li>
					    <li class="ui-col ui-col-50">最多可加入圈子数：<strong><?php echo C('circle_joinsum');?></strong></li>
					    <li class="ui-col ui-col-50">已经加入圈子数：<strong><?php echo $output['join_count'];?></strong></li>
					</ul>
			   </div>
			</div>
		  	
		  	
		  	
			<div class="demo-item">
				<div class="demo-block">
					<form action="index.php?act=circle_index&op=add_group" method="post">
						<div class="ui-form-item">
						    <label>所属分类：</label>
			                <div class="fourinput">
			                    <div class="ui-txt-info">
			                    	<span class="xb">请选择</span>
			                    	<i class="icon-select"></i>
			                    </div>
			                    <div class="ui-txt-info">
									<select class="gender" name="class_id" id="class_id">
										<option value="0">请选择</option>
										<?php if(!empty($output['class_list'])){?>
											<?php foreach($output['class_list'] as $val){?>
												<option value="<?php echo $val['class_id'];?>"><?php echo $val['class_name'];?></option>
											<?php }?>
										<?php }?>
									</select>
			                    </div>

			                </div>
						    <h6 class="ui-txt-info four">根据您的圈子主题类型，选择适当的分类。</h6>
						</div>
						<div class="ui-form-item">
						    <label>圈子名称：</label>
			                <input class="fourinput" type="text" name="c_name" id="" value="" />
						    <h6 class="ui-txt-info four">圈子名称规定使用4~12个字符，确定后不可修改。</h6>
						</div>
						<div class="ui-form-item">
						    <label>圈子简介：</label>
			                <textarea  class="fourinput" name="c_desc" id="c_desc"  rows="" cols=""></textarea>
						    <h6 class="ui-txt-info four">对您建立的圈子进行简单的文字介绍，创建后圈主可做修改，字数不超过255字。</h6>
						</div>
						<div class="ui-form-item">
						    <label>圈子标签：</label>
			                <input class="fourinput" type="text" name="c_tag" id="" value="" />
						    <h6 class="ui-txt-info four">建立圈子标签有利于全局搜索查找到您的圈子，多个标签请用","进行分隔。</h6>
						</div>
						<div class="ui-form-item">
						    <label>申请理由：</label>
			                <textarea  class="fourinput" name="c_pursuereason" id="c_pursuereason" rows="" cols=""></textarea>
						    <h6 class="ui-txt-info four">认真填写申请圈子的理由提交至平台，以确保管理人员及时审核并通过，字数不要超过255字。</h6>
						</div>
						<div class="ui-btn-wrap">
							<p class="okread">
								<label class="ui-checkbox-s">
								   <input type="checkbox" name="checkbox">
								</label>
								<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=document&code=create_circle">我已认真阅读并同意<strong>《社区使用须知》</strong>中的所有条款</a>
							</p>
<!--							<button class="ui-btn-lg ui-btn-danger">-->
<!--							提交申请-->
<!--							</button>-->
							<input type="submit" value="提交申请" class="ui-btn-lg ui-btn-danger">
						</div>
				   </form>
				</div>
			</div>
		  </section>

          <div class="log-in-navigation">
	  	 	  <a class="" href="">登录</a>
	  	 	  <a class="" href="">QQ登录</a>
	  	 	  <a class="" href="">注册</a>
	  	 	  <a class="back-to-top" href="#top">返回顶部<i class="icon-arrow-up"></i></a>
	  	  </div>
          <div class="copyright">

		  </div>
		  <?php require_once('footer.php');?>
	</body>
</html>
