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
		 	 <h1><?php echo $output['circle_info']['circle_name'];?></h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			<ul class="new-nav-ht">
				<li data-href="javascript:void(0)">新话题</li>
				<li class="active" data-href="javascript:void(0)">新投票</li>
			</ul>
			<div class="demo-item">
				<div class="demo-vote">
					<div class="vote-title ui-nowrap"><span>投票:</span><?php echo $output['theme_info']['theme_name']?></div>
					<div class="vote-cen">
						<div class="demo-title">
							<div class="ui-avatar-s fl">
	                            <span style="background-image:url(images/12759440818951.jpg)"></span>
	                        </div>
	                        <div class="fl"><i class="ui-nowrap mr"><?php echo $output['theme_info']['member_name']?></i><i><?php echo date('Y-m-d',$output['theme_info']['theme_addtime'])?></i></div>
							<p class="ui-txt-tips read-box "><i><?php echo $output['theme_info']['theme_browsecount'];?></i><i><?php echo $output['theme_info']['theme_commentcount'];?></i></p>
						</div>
					    <div class="ui-form">
					        <form action="index.php?act=circle_theme&op=save_votepoll&c_id=<?php echo $output['c_id'];?>&t_id=<?php echo $output['t_id'];?>" method="post">
								<?php $i = 0;foreach ($output['option_list'] as $val){ $i++;?>
					            <div class="ui-form-item ui-form-item-radio">
					                <label class="ui-radio" for="radio">
										<?php if($output['poll_info']['poll_multiple'] == 1){?>
					                    <input type="checkbox" name="pollopid[]" value="<?php echo $val['pollop_id'];?>">
										<?php }else{?>
										<input type="radio" name="pollopid[]" value="<?php echo $val['pollop_id'];?>">
										<?php }?>
					                </label>
					                <div class="txt"><p><?php echo $val['pollop_option']?></p><span><?php echo $val['pollop_votes']?>人已投票</span></div>
					            </div>
								<?php }?>
							<div class="ui-btn-wrap">
<!--							    <button class="ui-btn ui-btn-danger" nctype="poll_submit">提交</button>-->
								<input type="submit" value="提交" class="ui-btn ui-btn-danger">
							</div>
						</form>
					    </div>
					</div>
				</div>

				<div class="vote-com mb">
					<div class="allAnswers">
						<div class="block">
							<p class="AllAswertitle">全部评论</p>
						</div>
					</div>
					<div class="answerItem ui-border-b">
						<div class="ui-avatar">
					         <img src="images/1120036787b213839al.jpg">
					    </div>
					    <div class="ui-name">有事说话</div>
					    <div class="ui-contxt">
					    	必须参与下！必须参与下！必须参与下！必须参与下！必须参与下！
					    </div>
					    <div class="com-bottom">
					    	<time>2016-07-03 17:52</time>
					    	<span>
					    		<i class="icon-vote-praise">0</i>
					    		<i class="icon-vote-comments"></i>
					    	</span>
					    </div>
					</div>
					<div class="answerItem ui-border-b">
						<div class="ui-avatar">
					         <img src="images/1120036787b213839al.jpg">
					    </div>
					    <div class="ui-name">有事说话</div>
					    <div class="ui-contxt">
					    	必须参与下！必须参与下！必须参与下！必须参与下！必须参与下！
					    </div>
					    <div class="com-bottom">
					    	<time>2016-07-03 17:52</time>
					    	<span>
					    		<i class="icon-vote-praise">0</i>
					    		<i class="icon-vote-comments"></i>
					    	</span>
					    </div>
					</div>
				</div>
				
				<div class="ui-form-item-textarea">
				    <label>内容：</label>
				    <textarea class="inputxt" name="" rows="" cols=""></textarea>
				    
				</div>
				<div class="ui-btn-wrap">
					<button class="ui-btn-lg ui-btn-danger">
					回复
					</button>
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
