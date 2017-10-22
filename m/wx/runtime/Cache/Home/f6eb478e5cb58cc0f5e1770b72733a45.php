<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo C('site_name');?>——<?php echo C('site_title');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>"/>
<meta name="description" content="<?php echo C('content');?>"/>
<script src="<?php echo RES;?>/js/html5.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/index.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/weimob-index.js"></script>
<link rel="shortcut icon" href="<?php echo RES;?>/images/favicon.ico" />
</head>
<body>
<div class="nav clearfix">
	<div class="nav-content">
		<h1 class="left" href="/"><?php echo C('site_name');?></h1>
		<div class="left city" style="padding-left:20px;">
			<h2>全国</h2>
							<a href="#">
					切换城市<i class="tri4"></i>
				</a>
					</div>
		<div class="right line-li">
			<ul>
				<li><a href="/">首页</a></li>
                <li><a href="<?php echo U('Home/Index/fc');?>">功能介绍</a></li>
                <li><a href="<?php echo U('Home/Index/common');?>" class="hover">客户案例</a></li>
                <li><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
				<?php if($_SESSION[uid]==false): ?><li><a href="<?php echo U('Index/login');?>">会员登录</a></li>
				<li><a href="<?php echo U('Index/reg');?>">申请试用</a></li>
					<?php else: ?>
                <li><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
				<li><a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a></li><?php endif; ?>	
                <li <?php if((ACTION_NAME) == "help"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/help');?>">帮助中心</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="Public-content clearfix">
	<div class="Public">
		<h1 class="Public-h1">经典案例</h1>
		<div class="Public-box clearfix">
			<ul id="nav_lis" class="case-nav left">
				<li data-index="0" data-hash="#case-a">汽车</li>
				<li data-index="1" data-hash="#case-b">房产</li>
                <li data-index="6" data-hash="#case-g">电商</li>
                <li data-index="4" data-hash="#case-e">餐饮</li>
                <li data-index="9" data-hash="#case-j">婚纱摄影</li>
                <li data-index="17" data-hash="#case-r">婚庆</li>
                <li data-index="3" data-hash="#case-d">酒店</li>
				<li data-index="2" data-hash="#case-c">医疗</li>
				<li data-index="5" data-hash="#case-f">旅游</li>
                <li data-index="20" data-hash="#case-u">生活服务</li>
				<li data-index="7" data-hash="#case-h">娱乐</li>
				<li data-index="8" data-hash="#case-i">装潢装饰</li>
				<li data-index="10" data-hash="#case-k">通讯</li>
				<li data-index="11" data-hash="#case-l">养生美容健身</li>
				<li data-index="12" data-hash="#case-m">金融</li>
				<li data-index="13" data-hash="#case-n">广告传媒</li>
				<li data-index="14" data-hash="#case-o">零售</li>
				<li data-index="15" data-hash="#case-p">百货商场</li>
				<li data-index="16" data-hash="#case-q">法律</li>
   				<li data-index="18" data-hash="#case-s">IT</li>
				<li data-index="19" data-hash="#case-t">教育</li>
                
			</ul>
			<div id="nav_uls" style="overflow:hidden;">

			<!-- 汽车开始 -->
				<div data-index="0" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case car2 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">绿地宝马5S</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case car1" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">咸阳尚乘</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case car3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">奔驰世家</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case car4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">沃尔沃丰颐</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case car5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">长安福特阳天</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case car6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">长安铃木</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case car7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_car.png);"></i>
							</span>
							<h4 class="wm_case_t">郑州日产</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/car1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="7" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/car7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/car7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/car7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<span class="arrow" id="case_arrow">
						<i class="arrow_out"></i>
						<i class="arrow_in"></i>
					</span>
				</div>
			<!--汽车结束-->

			<!--房地产开始-->
				<div data-index="1" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case est1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">石梅湾九里</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case est2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">中诚地产</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case est3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">保利达翠堤湾</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case est4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">十里银滩</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case est5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">金地檀溪</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case est6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">悦美国际</h4>
						</li>
                           <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case est7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_est.png);"></i>
							</span>
							<h4 class="wm_case_t">万科学府</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0" >
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc8-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc8-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc8-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc5-erwei.jpg" width="180" height="180">
						</p>
					</div>
				
                    	<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc7-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/fdc9-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/fdc9-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/fdc9-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--房地产结束-->

			<!--医疗开始-->
				<div data-index="2" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case med1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">上海复大医院</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case med2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">美缔整形美容</h4>
						</li>
                        <li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case med3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">成都万年医院</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case med4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">玛丽亚妇产医院</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case med5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">苏州同济医院</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case med6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">泰安丽人妇产医院</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case med7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yl.png);"></i>
							</span>
							<h4 class="wm_case_t">济南爱容整形</h4>
						</li>
                       
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl9-2.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl9-1.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl9-erwei.jpg" width="180" height="180">
						</p>
					</div>

				</div>
			<!--医疗结束-->

			<!--酒店开始-->
				<div data-index="3" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">丽彩天禧酒店</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">年代风尚</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">五环大酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">最佳财富西方酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">大城小爱酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">宁波朗逸大酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_jd.png);"></i>
							</span>
							<h4 class="wm_case_t">深圳唐拉雅秀酒店</h4>
						</li> 
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/jd7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/jd7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/jd7-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
				</div>
			<!--酒店结束-->

			<!--餐饮开始-->
				<div data-index="4" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">海底捞</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">金龙海鲜烧烤</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">麦兜点点</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">南京典尚餐饮</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">黔香阁</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">舌尖上的酸菜鱼</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy7"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_cy.png);"></i>
							</span>
							<h4 class="wm_case_t">襄阳甜甜馆</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys10-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys10-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys10-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ys6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ys7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ys7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img"> <img id="case_ewm" src="<?php echo RES;?>/images/ys7-erwei.jpg" width="180" height="180"></p>
					</div>
				</div>
			<!--餐饮结束-->

			<!--旅游开始-->
				<div data-index="5" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">深圳东部华侨城</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">美地度假</h4>
						</li>
                        <li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">金假期旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">深圳天安旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">西林生态旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ly.png);"></i>
							</span>
							<h4 class="wm_case_t">众信旅游网</h4>
						</li>
                       
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="2">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="3">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                     <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                     <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/ly6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ly6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ly6-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--旅游结束-->

			<!--电商开始-->
				<div data-index="6" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">一号店</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds2"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">龙飞凤舞</h4>
						</li>
                        	<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds3"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">澳洲品质生活馆</h4>
						</li>
                        
                        	<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds4"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">景宁富特</h4>
						</li>
                        
                        	<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds5"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">品尚红酒</h4>
						</li>
                        	<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds6"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">宏艺隆电气</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds7"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ds.png);"></i>
							</span>
							<h4 class="wm_case_t">养福保健</h4>
						</li>
                        
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="2">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="3">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="5">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="6">
						<img id="case_img_left" src="<?php echo RES;?>/images/ds7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ds7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ds7-erwei.jpg" width="180" height="180">
						</p>
					</div>
                  
				</div>
			<!--电商结束-->

			<!--娱乐开始-->
				<div data-index="7" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yul.png);"></i>
							</span>
							<h4 class="wm_case_t">BBOSS至尊</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yul.png);"></i>
							</span>
							<h4 class="wm_case_t">丹东二人转大</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yul.png);"></i>
							</span>
							<h4 class="wm_case_t">名流之星KTV</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yul.png);"></i>
							</span>
							<h4 class="wm_case_t">西安倾国倾城</h4>
						</li>
                        <li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_yul.png);"></i>
							</span>
							<h4 class="wm_case_t">美宝之家</h4>
						</li>
                       
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl1-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl1-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl1-erwei01.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl2-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl2-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl2-erwei01.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl3-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl3-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl3-erwei01.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl4-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl4-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl4-erwei01.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/yl5-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/yl5-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/yl5-erwei01.jpg" width="180" height="180">
						</p>
					</div>
                    
				</div>
			<!--娱乐结束-->

			<!--装潢开始-->
				<div data-index="8" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case on zh1"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">大涌红木家具</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh2"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">鸿起顺门业</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh3"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">慧能地暖</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh4"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">健威人性家具</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh5"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">宁波浪琴屿</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh6"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">欧派木门</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_zh.png);"></i>
							</span>
							<h4 class="wm_case_t">欧然墙纸</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/zh7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/zh7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/zh7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--装潢结束-->

			<!--婚纱开始-->
				<div data-index="9" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
							</span>
							<h4 class="wm_case_t">爱女神3D婚纱</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
							</span>
							<h4 class="wm_case_t">iweddingstudio</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
							</span>
							<h4 class="wm_case_t">韩国艺匠</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
							</span>
							<h4 class="wm_case_t">美十摄影</h4>
						</li>
						<li class="wm_case_item" data-id="4">
									<span class="icon_wrapper">
										<i class="icon_wm_case hs5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
									</span>
							<h4 class="wm_case_t">星梦奇缘</h4>
						</li>
						<li class="wm_case_item" data-id="5">
									<span class="icon_wrapper">
										<i class="icon_wm_case hs6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
									</span>
							<h4 class="wm_case_t">拍吧视觉</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hs.png);"></i>
							</span>
							<h4 class="wm_case_t">罗门婚纱</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs4-erwei.jpg" width="180" height="180"></p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/hs7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hs7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hs7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--婚纱结束-->

			<!--通讯开始-->
				<div data-index="10" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_tx.png);"></i>
							</span>
							<h4 class="wm_case_t">衡阳金联合通讯</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_tx.png);"></i>
							</span>
							<h4 class="wm_case_t">洛阳移动</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_tx.png);"></i>
							</span>
							<h4 class="wm_case_t">莆田沃体验手机</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_tx.png);"></i>
							</span>
							<h4 class="wm_case_t">中国电信赣州网厅</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/tx1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/tx1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/tx1-erwei.jpg" width="180" height="180"></p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/tx2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/tx2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/tx2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/tx3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/tx3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/tx3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/tx4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/tx4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/tx4-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--通讯结束-->

			<!--美容开始-->
				<div data-index="11" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);" ></i>
							</span>
							<h4 class="wm_case_t">茗草泉</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">诗美诗格</h4>
						</li>

						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">辰嫣国际微刊</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">凤凰温泉</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">慧之通</h4>
						</li>
						<li class="wm_case_item"  data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">匠人造型</h4>
						</li>
						<li class="wm_case_item"  data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_mr.png);"></i>
							</span>
							<h4 class="wm_case_t">爵士美发</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;" >
						<img id="case_img_left" src="<?php echo RES;?>/images/mr1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/mr6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/mr6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/mr6-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--美容结束-->

			<!--金融开始-->
				<div data-index="12" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case bk1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bk.png);"></i>
							</span>
							<h4 class="wm_case_t">融易宝</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case bk2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bk.png);"></i>
							</span>
							<h4 class="wm_case_t">微诺亚</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0" >
						<img id="case_img_left" src="<?php echo RES;?>/images/bk1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bk1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bk1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bk2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bk2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bk2-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--金融结束-->

			<!--广告开始-->
				<div data-index="13" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">JM传媒</h4>
						</li>
                        <li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">四川<?php echo C('site_name');?></h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case  ad2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">车视传媒</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad3"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">彭城晚报</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">文创文化</h4>
						</li>
                        <li class="wm_case_item"  data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad6" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">微客</h4>
						</li>
                         <li class="wm_case_item"  data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case ad7" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_ad.png);"></i>
							</span>
							<h4 class="wm_case_t">满江红传媒</h4>
						</li>
                        	
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad1-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    	<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                     <div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ad7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ad7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ad7-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
				</div>
			<!--广告结束-->

			<!--零售开始-->
				<div data-index="14" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis1 on"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_lis.png);"></i>
							</span>
							<h4 class="wm_case_t">安贝儿童座椅</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_lis.png);"></i>
							</span>
							<h4 class="wm_case_t">拜耳水产</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_lis.png);"></i>
							</span>
							<h4 class="wm_case_t">超凡计算机</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_lis.png);"></i>
							</span>
							<h4 class="wm_case_t">牛牛生态水产</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_lis.png);"></i>
							</span>
							<h4 class="wm_case_t">YFAN伊梵</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls2-erwei.jpg" width="180" height="180">
						</p>

					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls3-erwei.jpg" width="180" height="180">
						</p>

					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls5-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--零售结束-->

			<!--百货结束-->
				<div data-index="15" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">潮流百货</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">兰州美伦百货</h4>
						</li>
						<li class="wm_case_item" name="shdz" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">廊坊万达广场</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">星摩尔购物广场</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh5"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">知名度服饰</h4>
						</li>
                        <li class="wm_case_item"  data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case bh6"  style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_bh.png);"></i>
							</span>
							<h4 class="wm_case_t">岳阳百货</h4>
						</li>
                        
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/bh6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/bh6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/bh6-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--百货场结束-->

			<!--法律开始-->
				<div data-index="16" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case fl1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_fl.png);"></i>
							</span>
							<h4 class="wm_case_t">大成律师</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/ls1-3.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/ls1-4.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/ls1-erwei01.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--法律结束-->

			<!--婚庆开始-->
				<div data-index="17" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case hq1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hq.png);"></i>
							</span>
							<h4 class="wm_case_t">铂菲婚礼顾问</h4>
						</li>
                        <li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case hq2 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hq.png);"></i>
							</span>
							<h4 class="wm_case_t">福州婚庆导航</h4>
						</li>
                        <li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case hq3 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hq.png);"></i>
							</span>
							<h4 class="wm_case_t">花香阁婚庆花艺</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case hq4 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_hq.png);"></i>
							</span>
							<h4 class="wm_case_t">施华洛婚纱婚庆</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0" >
						<img id="case_img_left" src="<?php echo RES;?>/images/hq1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hq1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hq1-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="1" >
						<img id="case_img_left" src="<?php echo RES;?>/images/hq2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hq2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hq2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="2" >
						<img id="case_img_left" src="<?php echo RES;?>/images/hq3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hq3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hq3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="3" >
						<img id="case_img_left" src="<?php echo RES;?>/images/hq4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/hq4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/hq4-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--婚庆结束-->

			<!--it开始-->
				<div data-index="18" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case it1 on" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_it.png);"></i>
							</span>
							<h4 class="wm_case_t">艾定义互动</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case it2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_it.png);"></i>
							</span>
							<h4 class="wm_case_t">方志电子</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case it3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_it.png);"></i>
							</span>
							<h4 class="wm_case_t">前十名</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case it4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_it.png);"></i>
							</span>
							<h4 class="wm_case_t">易维网络</h4>
						</li>
                        	<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case it5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_it.png);"></i>
							</span>
							<h4 class="wm_case_t">云图信息科技</h4>
						</li>
                        
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/it1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/it1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/it1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/it2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/it2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/it2-erwei.jpg" width="180" height="180">
						</p>

					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/it3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/it3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/it3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/it4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/it4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/it4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/it5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/it5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/it5-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--it结束-->

			<!--教育开始-->
				<div data-index="19" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case on edu1" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_edu.png);"></i>
							</span>
							<h4 class="wm_case_t">阿杰发艺</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case  edu2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_edu.png);"></i>
							</span>
							<h4 class="wm_case_t">见悟修教育</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case edu3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_edu.png);"></i>
							</span>
							<h4 class="wm_case_t">廊坊第六小学</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case edu4" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_edu.png);"></i>
							</span>
							<h4 class="wm_case_t">CZ娱乐培训</h4>
						</li>
                        	<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case edu5" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_edu.png);"></i>
							</span>
							<h4 class="wm_case_t">愚公移山美术</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/edu1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/edu1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/edu1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/edu2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/edu2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/edu2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/edu3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/edu3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/edu3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/edu4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/edu4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/edu4-erwei.jpg" width="180" height="180">
						</p>

					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/edu5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/edu5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/edu5-erwei.jpg" width="180" height="180">
						</p>

					</div>
				</div>
			<!--教育结束-->
            
            	<!--生活开始-->
				<div data-index="20" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case on wsh1" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_wsh.png);"></i>
							</span>
							<h4 class="wm_case_t">通灵珠宝</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case  wsh2" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_wsh.png);"></i>
							</span>
							<h4 class="wm_case_t">太仓南洋广场</h4>
						</li>
                        <li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case  wsh3" style="background-image:url(<?php echo RES;?>/images/img/icon_wm_case_wsh.png);"></i>
							</span>
							<h4 class="wm_case_t">云视界微生活</h4>
						</li>
						
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/wsh1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/wsh1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/wsh1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/wsh2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/wsh2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/wsh2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/wsh3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/wsh3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/wsh3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
				
				
                  
				</div>
			<!--生活结束-->


		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var hash=window.location.hash || "#case-a";
		if(hash){
			var lis=$("#nav_lis>li"),
				divs=$("#nav_uls>div");
			lis.each(function(index, v) {
				if(hash == v.getAttribute("data-hash")){
					v.className="hover";
					//.var divs = $("#nav_uls>div");
					for(var i=0,ci; ci = divs[i]; i++){
						if(index == ci.getAttribute("data-index")){
							$(ci).addClass("show");
						}else{
							$(ci).removeClass("show");
						}
					}
					/*divs.removeAttr("data-on").each(function(k,vv){
						if(index == vv.getAttribute("data-index")){
							vv.setAttribute("data-on", "true");
							return;
						}
					});*/
				}
			});
		}

	$("#nav_lis").on("mouseover", function(e){
			$(this).find("li").removeClass("hover");
			e.target.className = "hover";
			var index = e.target.getAttribute("data-index");
			//
			var divs = $("#nav_uls>div");
			for(var i=0,ci; ci = divs[i]; i++){
				if(index == ci.getAttribute("data-index")){
					$(ci).addClass("show");
				}else{
					$(ci).removeClass("show");
				}
			}

		});


		$("#nav_uls>div").each(function(k,v){
			function show_case(id, thi, pause) {
				if(pause){return;}
				$(thi).parent().find(".on").removeClass("on");
				$(thi).find(".icon_wm_case").addClass("on");
				var divs=$(thi).closest("div").find(".wm_case_desc");
				divs.css("display", "none")[id].style.display="";
			};
			(function(){
				var lis=$(v).find(".wm_case_item");
				var index=0;
				var pause=false;
				//
				$(v).on("mouseover", function(){
					pause=true;
				}).on("mouseout", function(){
						pause=false;
					}).find(".wm_case_item").hover(function () {
						index=$(this).attr("data-id");
						show_case(index, this);
					});
				//
				var timer=setInterval(function(){
					index=++index>=lis.length? 0: index;
					show_case(index, lis[index], pause);
				}, 3000);
			})();
		});
	});
</script>
<div class="erwei" title="微信扫一扫">
	<span class="hudongzhushou">官方微信</span>
	<div class="erwei_big" style="display:none;">
		<p>扫一扫，关注<?php echo C('site_name');?>官方微信，体验<?php echo C('site_name');?>智能服务<br>
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=760386673&site=qq&menu=yes"><img src="http://www.sunkf.net/codes/one/images/q_3.gif" border="0" alt="点击咨询" title="点击咨询"></a></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var erwei_time = null;
		$(".erwei").hover(function(){
			$(".erwei_big").show();
		}).mouseleave(function(){
				erwei_time = setTimeout(function(){
					$(".erwei_big").hide();
				},1000);
			});
		$(".erwei_big").mouseenter(function(){
			if(erwei_time){
				clearTimeout(erwei_time);
			}
		}).mouseleave(function(){
				erwei_time = setTimeout(function(){
					$(".erwei_big").hide();
				},1000);
			});
	});
</script>
<!--QQ咨询-->
<script charset="utf-8" type="text/javascript" src="<?php echo RES;?>/js/wpa.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/qqserver.css"/>

<div id="onlinebox" class="onlinebox onlinebox_1 onlinebox_1_2" style="position: fixed; top: 80px; right:35px; ">
  <div class="onlinebox-conbox" id="onlinebox-conbox" style="position: absolute; left: -94px; width: 118px; display:none;">
		<div class="onlinebox-top" id="onlinebox-top" title="点击可隐藏" onClick="qq(1)"><span>在线客服</span></div>
		<div class="onlinebox-center">
			<div class="onlinebox-center-box">
				<dl>
					<dt>使用帮助</dt>
						<dd><a href="tencent://message/?uin=<?php echo C('site_qq');?>&amp;Site=&amp;Menu=yes" title="QQ咨询服务">
						<img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('site_qq');?>:41"></a>
						</dd>
					</dl>
				<div class="clear"></div>
				<dl>
					<dt>技术询问</dt>
					<dd>
						<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">
							<img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('site_qq');?>:41" alt="在线咨询服务"/>
						</a>
					</dd>
				</dl>
				<div class="clear"></div>
				<dl><dt>合作加盟</dt>
				<dd>
					<a href="tencent://message/?uin=<?php echo C('site_qq');?>&amp;Site=&amp;Menu=yes" title="QQ合作加盟">
						<img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('site_qq');?>:41">
					</a>
				</dd>
				</dl>
				<div class="clear"></div>
			</div>
		</div>
		<div class="onlinebox-bottom">
			<div class="onlinebox-bottom-box">
				<div class="online-tbox">
					<div style="text-align: center; "><strong>在线时间</strong><br>	08:30-22:30<br>
						<span style="color:#999;">—————————</span><br>
						<span style="font-weight: bold; ">服务热线<br>13267656669
							<span style="font-weight: normal; "><br></span>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="onlinebox-bottom-bg"></div>
	</div>
</div>
<div class="footer">
	<div class="footer-content clearfix">
		<div class="foot-menu">
			<p>
				<a href="/">网站首页</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Index/reg');?>" target="_blank">申请入驻</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Home/Index/about');?>" target="_blank">渠道代理</a>&nbsp;|&nbsp;
				<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">接口定制</a>&nbsp;|&nbsp;
				<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">微信托管</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Home/Index/about');?>" target="_blank">关于我们</a>
			</p>
			<p>客服QQ：<?php echo C('site_qq');?>&nbsp;&nbsp;&nbsp;邮箱：<?php echo C('site_email');?></p>
		</div>
		<div class="copyright"><?php echo C('copyright');?></div>
	</div>
</div>
</body>
</html>