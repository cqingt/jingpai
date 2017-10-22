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

		<script type="text/javascript" src="http://resource.96567.com/js/jquery.js"></script>
<!--		<script type="text/javascript" src="http://resource.96567.com/js/jquery-ui/jquery.ui.js"></script>-->
<!--		<script type="text/javascript" src="http://resource.96567.com/js/jquery.validation.min.js"></script>-->
<!--		<script type="text/javascript" src="http://resource.96567.com/js/jquery.charCount.js"></script>-->
<!--		<script type="text/javascript" src="http://resource.96567.com/js/common.js" charset="utf-8"></script>-->
		<script type="text/javascript" src="http://resource.96567.com/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<!--		<script type="text/javascript" src="http://resource.96567.com/js/member.js" charset="utf-8"></script>-->
		<script type="text/javascript" src="http://resource.96567.com/js/sns.js" charset="utf-8"></script>
<!--		<script type="text/javascript" src="http://resource.96567.com/js/sns_friend.js" charset="utf-8"></script>-->
<!--		<script type="text/javascript" src="http://resource.96567.com/js/sns_store.js" charset="utf-8"></script>-->
		<script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/smilies.js" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/smilies_data.js" charset="utf-8"></script>
		<script type="text/javascript" src="http://resource.96567.com/js/jquery.caretInsert.js" charset="utf-8"></script>


		<!-- New -->
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/circle.css"/>
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.css">
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/frozen.css" />
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/js/jquery.ajaxdatalazy.js"></script>


	</head>
	<body class="demo" id="top">
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>新鲜事</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
			  <div class="demo-item">
				  <div class="demo-fresh">
					  <?php if($output['mid'] == $_SESSION['member_id']){?>
					  <div class="ui-fresh-one">
						  <h2>分享心情</h2>
							  <span class="icon-today-visitors" data-href="index.php?act=circle_sns_circle&op=visitor&mid=<?php echo $output['mid'];?>">我的访客：<?php echo $output['me_num']?></span>
					  </div>
					  <?php }else{?>
						  <div class="ui-fresh-one">
							  <span class="icon-today-visitors" data-href="index.php?act=circle_sns_circle&op=visitor&mid=<?php echo $output['mid']?>">TA的访客：<?php echo $output['other_num']?></span>
						  </div>
					  <?php }?>

					  <?php if($output['mid'] == $_SESSION['member_id']){?>
					  <form action="index.php?act=circle_member_snsindex&op=addtrace" method="post">
						  <textarea class="alltxt" name="content" rows="" cols="" id="content_weibo" nc_type="contenttxt" resize="none"></textarea>
<!--						  <textarea name="content" id="content_weibo" nc_type="contenttxt" class="textarea" resize="none"></textarea>-->
						  <div class="ui-btn-wrap fr">
							  <select name="privacy" id="">
								  <option value="0">所有人可见</option>
								  <option value="1">仅好友可见</option>
								  <option value="2">仅自己可见</option>
							  </select>

							  <div class="smile"><em></em><a href="javascript:void(0)" nc_type="smiliesbtn" data-param='{"txtid":"weibo"}'>表情</a></div>
							  <div id="weibocharcount" class="weibocharcount"></div>
							  <div id="weiboseccode" class="weiboseccode">
								  <label for="captcha" class="ml5 fl"><strong><?php echo $lang['nc_checkcode'].$lang['nc_colon'];?></strong></label>
								  <input name="captcha" class="w40 fl text" type="text" id="captcha" size="4" maxlength="4"/>
								  <a href="javascript:void(0)" class="ml5 fl"><img src="" title="<?php echo $lang['wrong_checkcode_change'];?>" name="codeimage" border="0" id="codeimage" onclick="this.src='index.php?act=seccode&op=makecode&nchash=<?php echo $output['nchash'];?>&t=' + Math.random()" /></a>
								  <input type="hidden" name="nchash" value="<?php echo $output['nchash'];?>"/>
							  </div>

							  <input type="submit" value="分享" class="ui-btn ui-btn-danger">
						  </div>
					  </form>
					  <div id="smilies_div" class="smilies-module"></div>
					  <?php }else{?>
					  <?php }?>

				  </div>
			  </div>
		  	
		     <div class="demo-item">
				 <?php if($output['mid'] == $_SESSION['member_id']){?>
					<div class="shaop-title"><strong>我的新鲜事</strong></div>
				 <?php }else{?>
				 	<div class="shaop-title"><strong>TA的新鲜事</strong></div>
				 <?php }?>

			 </div>
			 <div class="demo-item">
			 	<div class="demo-block">
			 		<!-- 动态列表 start-->
			 		<ul class="shop-dynamic-list mb">
						<?php if(empty($output['tracelist'])){?>
						<h3>很遗憾，他很懒哦！</h3>
						<?php }else{?>
			 			<?php foreach ((array)$output['tracelist'] as $k=>$v){?>
			 			<li class="ui-border-b">
			 				<div class="demo-sn">
								<div data-href="" class="ui-avatar-s">
								    <span style="background-image:url(<?php echo getMemberAvatarForID($v['trace_memberid']);?>)"></span>
								</div>
								<div class="sn-name">
									<h4 class="ui-nowrap"><strong><?php echo $v['trace_membername'];?>:</strong><?php echo (parsesmiles($v['trace_title']) ? parsesmiles($v['trace_title']):'分享话题');?></h4>
									<?php if($output['mid'] == $_SESSION['member_id']){?><h4 data-href="index.php?act=circle_member_snshome&op=trace_del&id=<?php echo $v['trace_id']?>" id="del">删除</h4>
									<?php }else{?>
									<?php }?>
								</div>
								<?php if ($v['trace_originalid'] > 0 || $v['trace_from'] == '2'){// 转帖内容?>
								<?php echo parsesmiles($v['trace_content']);?>
			 				</div>
								<div class="demo-block mt">
									<ul class="ui-row see">
										<li class="ui-col ui-col-44">发布时间：<?php echo date('Y-m-d H:i',$v['trace_addtime']);?></li>
										<li class="ui-col ui-col-56">
											<p class="ui-txt-tips read-box"><i><?php echo $v['trace_copycount']?></i><a
													href="index.php?act=circle_comment_view"><i><?php echo $v['trace_commentcount']?></i></a></p>
										</li>
									</ul>
								</div>
							<?php }else{?>
<!--								<div class="demo-shop-share">-->
<!--									<div data-href="" class="ui-list-thumb2">-->
<!--										<span><img src="images/68_05204396316536742_240.jpg"/></span>-->
<!--									</div>-->
<!--									<div class="sn-box">-->
<!--										<h2 data-href="" class="ui-nowrap-multi">澳门生肖猴钞-鸡钞-后三同 十连号</h2>-->
<!--										<p class="ui-txt-default">价格：<strong>¥620.00</strong></p>-->
<!--										<p class="ui-txt-info">运费：¥20.00</p>-->
<!--										<i class="icon-like">收藏该宝贝<strong>（12人收藏）</strong></i>-->
<!--									</div>-->
<!--								</div>-->
<!---->

									<?php }?>
								<?php echo parsesmiles($v['trace_content']);?>
										<div class="demo-block mt">
											<ul class="ui-row see">
												<li class="ui-col ui-col-44">发布时间：<?php echo date('Y-m-d H:i',$v['trace_addtime']);?></li>
												<li class="ui-col ui-col-56">
													<p class="ui-txt-tips read-box"><i><?php echo $v['trace_copycount']?></i><a
															href="index.php?act=circle_comment_view"><i><?php echo $v['trace_commentcount']?></i></a></p>
												</li>
											</ul>
										</div>
			 			</li>
			 			 <?php  }?>
						<?php }?>
			 		</ul>
			 		<!-- 动态列表 end-->
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

<script type="text/javascript">
	var max_recordnum = '<?php echo $output['max_recordnum'];?>';
	document.onclick = function(){ $("#smilies_div").html(''); $("#smilies_div").hide();};

	$(function(){
		//加载好友动态分页
		$('#dfdemo').lazyinit();
		$('#dfdemo').lazyshow({url:"index.php?act=member_snshome&op=tracelist&mid=<?php echo $output['master_info']['member_id'];?>&page=1",'iIntervalId':true});

		//提交分享心情表单
		$("#weibobtn").bind('click',function(){
			if($("#weiboform").valid()){
				var cookienum = $.cookie(COOKIE_PRE+'weibonum');
				cookienum = parseInt(cookienum);
				if(cookienum >= max_recordnum && $("#weiboseccode").css('display') == 'none'){
					//显示验证码
					$("#weiboseccode").show();
					$("#weiboseccode").find("#codeimage").attr('src','index.php?act=seccode&op=makecode&nchash=<?php echo $output['nchash'];?>&t=' + Math.random());
				}else if(cookienum >= max_recordnum && $("#captcha").val() == ''){
					showDialog('请填写验证码');
				}else{
					ajaxpost('weiboform', '', '', 'onerror');
					//隐藏验证码
					$("#weiboseccode").hide();
					$("#weiboseccode").find("#codeimage").attr('src','');
					$("#captcha").val('');
				}
			}
			return false;
		});

		$('#weiboform').validate({
			errorPlacement: function(error, element){
				element.next('.error').append(error);
			},
			rules : {
				content : {
					required : true,
					maxlength : 140
				}
			},
			messages : {
				content : {
					required : '<?php echo $lang['sns_sharemood_content_null'];?>',
					maxlength: '<?php echo $lang['sns_content_beyond'];?>'
				}
			}
		});
		//心情字符个数动态计算
		$("#content_weibo").charCount({
			allowed: 140,
			warning: 10,
			counterContainerID:'weibocharcount',
			firstCounterText:'<?php echo $lang['sns_charcount_tip1'];?>',
			endCounterText:'<?php echo $lang['sns_charcount_tip2'];?>',
			errorCounterText:'<?php echo $lang['sns_charcount_tip3'];?>'
		});
	});
</script>

