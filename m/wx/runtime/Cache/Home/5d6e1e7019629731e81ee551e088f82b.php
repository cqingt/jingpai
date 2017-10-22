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
﻿<body>
	 <!--[if lte IE 8]>  <script language="javascript">$(function (){$.browser.msie&&$("#ie9-tips").show().find("#stopSuggestA").click(function(){$("#ie9-tips").hide()})})</script><![endif]-->
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
				<li><a href="/" >首页</a></li>
                <li><a href="<?php echo U('Home/Index/fc');?>">功能介绍</a></li>
                <li><a href="<?php echo U('Home/Index/common');?>">客户案例</a></li>
                <li><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
				<?php if($_SESSION[uid]==false): ?><li><a href="<?php echo U('Index/login');?>">会员登录</a></li>
				<li><a href="<?php echo U('Index/reg');?>" class="hover">申请试用</a></li>
					<?php else: ?>
                <li><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
				<li><a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a></li><?php endif; ?>	
                <li <?php if((ACTION_NAME) == "help"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/help');?>">帮助中心</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="ie9-tips" class="clearfix">
	<div id="tipsPanel">
		<div id="tipsDesc">系统检测到您所使用的浏览器版本较低，推荐使用<a href="http://www.firefox.com.cn/download/" target="_blank">Firefox</a>或<a href="http://www.google.cn/intl/zh-CN/chrome/browser/index.html" target="_blank">Chrome</a>浏览器打开，否则将无法体验完整产品功能。</div>
		<a id="stopSuggestA" href="javascript:;">×</a>
	</div>
</div>
<div class="Public-content clearfix">
	<div class="Public">
		<h1 class="Public-h2">注册</h1>
		<div class="Public-box clearfix">
			<div class="reg-wrapper2">
		<form id="regform" class="form-horizontal" action="/index.php?m=Users&amp;a=checkreg" method="post">
		  <div class="control-group">
		    <label class="control-label" for="username">用户名</label>
		    <div class="controls" >
		      <input type="text" name="username" id="username" onClick="javascript:_gaq.push(['_trackPageview','/home/reg/virtual/Username']);">
		      <span class="maroon">*</span><span class="help-inline">长度为6~16位字符，可以为“数字/字母/中划线/下划线”组成</span>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="password">用户密码</label>
		    <div class="controls">
		      <input type="password" name="password" id="password" onClick="javascript:_gaq.push(['_trackPageview','/home/reg/virtual/Password']);">
		      <span class="maroon">*</span><span class="help-inline">长度为6~16位字符</span>
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="repassword">重复密码</label>
		    <div class="controls">
		      <input type="password" name="repassword" id="repassword" onClick="javascript:_gaq.push(['_trackPageview','/home/reg/virtual/Password']);">
		    </div>
		  </div>
		  <div class="control-group">
		    <label class="control-label" for="email">邮箱</label>
		    <div class="controls">
		      <input type="text" name="email" id="email" onClick="javascript:_gaq.push(['_trackPageview','/home/reg/virtual/Mail']);">
		      <span class="maroon">*</span><span class="help-inline">邮箱将与支付及优惠相关，请填写正确的邮箱</span>
		    </div>
		  </div>
		  <div class="control-group">
		  	<div class="controls">
			    <button type="submit" id="reg-btn" class="btn-register"></button>
		  	</div>
		  </div>
		</form>
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