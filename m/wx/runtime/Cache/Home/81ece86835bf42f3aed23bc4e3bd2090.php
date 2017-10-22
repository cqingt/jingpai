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
<style type="text/css">
<!--
.red {color: #FF0000}
.login { color:#555555}
.login input { 
	padding: 5px;
	margin-top:12px;
	border: solid 1px #E1E1E1;
	outline: 0;
	font: normal 13px/100% Verdana, Tahoma, sans-serif;
	width: 150px;
	box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
	-moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
	-webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
	}
.login input:hover,.login input:focus{ 
	border-color: #C9C9C9; 
	-webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 8px;
	}
.think-login{ margin-top: 36px;padding-right: 60px; border-right: 1px solid #ddd; }
.think-login .body{ padding-top: 12px; }
.think-login{ float: left; }
.think-form{ padding-bottom: 36px; }
.think-form .submit{ background: #348FD4; color: #fff; font-size: 16px; height: 30px; line-height: 21px; padding: 0 24px; vertical-align: middle; border: 0; cursor: pointer; }
.think-form .submit:hover{ background-color: #2F81BF; }
-->
</style>
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
                <li><a href="<?php echo U('Home/Index/common');?>">客户案例</a></li>
                <li><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
				<?php if($_SESSION[uid]==false): ?><li><a href="<?php echo U('Index/login');?>" class="hover">会员登录</a></li>
				<li><a href="<?php echo U('Index/reg');?>">申请试用</a></li>
					<?php else: ?>
                <li><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
				<li><a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a></li><?php endif; ?>	
                <li <?php if((ACTION_NAME) == "help"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/help');?>">帮助中心</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- banner -->
<div class="banner gbanner">
</div>
<div class="Public-content clearfix">
	<div class="Public" style="height:500px">
		<h2 class="Public-h2">
			登陆
		</h2>
		<div class="Public-box clearfix">
			<div class="main">
				<div class="abody">
					<div class="contaier wp cf">
						<div class="think-login">
							<div class="head">
							</div>
							<DIV class="body think-form ">
								<FORM class=login method=post action=index.php?m=Users&amp;a=checklogin>
									<TABLE width="970" height=320 align="center" cellspacing="15">
										<TBODY>
											<TR>
												<TD width=115 rowspan="6">&nbsp;
													
											  </TD>
												<TD width=413 height="21">&nbsp;
													
											  </TD>
												<TD rowSpan=6 width=258>
													<IMG alt="" src="img/erwei_big.jpg" width=258 height=258>
												</TD>
												<TD rowSpan=6 width=99>&nbsp;
													
											  </TD>
											</TR>
											<TR>
												<TD height="56">
													用户名&nbsp;&nbsp;
													<input class="text" type="text" name="username" />
												</TD>
											</TR>
											<TR>
												<TD height="56">
													密　码&nbsp;&nbsp;
													<input class="text" type="password" name="password" />
												</TD>
											</TR>
											<TR>
												<TD height="36">
													<P>
														<input name="submit" type="submit" class="submit" value="请审核后再登录" />
												</TD>
											</TR>
											<TR>
												<TD height="100" style="line-height:26px;">
													<p>
														帐号审核：
													</p>
													<p>
														自助审核方法：关注右侧官方微信号
														（右侧扫一扫）
													</p>
													<p>
														在微信中输入：审核+注册的用户名（不含+号）如：审核weixin
													</p>
													<p>
														人工审核方法：客服QQ：<?php echo C('site_qq');?>，联系审核
													</p>
												</TD>
											</TR>
										</TBODY>
									</TABLE>
									</p>
								</FORM>
							</DIV>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
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