<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title><?php echo C('site_name');?>——<?php echo C('site_title');?></title>
<meta name="keywords" content="<?php echo C('keyword');?>	"/>
<meta name="description" content="<?php echo C('content');?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/index.css" media="all" />
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
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
                <li><a href="<?php echo U('Home/Index/common');?>">客户案例</a></li>
                <li><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
				<?php if($_SESSION[uid]==false): ?><li><a href="<?php echo U('Index/login');?>">会员登录</a></li>
				<li><a href="<?php echo U('Index/reg');?>">申请试用</a></li>
					<?php else: ?>
                <li><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
				<li><a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a></li><?php endif; ?>	
                <li <?php if((ACTION_NAME) == "help"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/help');?>" class="hover">帮助中心</a></li>
			</ul>
		</div>
	</div>
</div>
<div style="clear:both;float: none;"></div>

</head>
<body>

<div class="Public-content clearfix">
<div class="pos"> &nbsp;&nbsp;&nbsp;</div>
<style type="text/css">
.normalTitle {
    border-bottom: 1px solid #D7DDE6;
    border-radius: 10px 10px 0 0;
    padding: 20px;
    text-shadow: 0 1px 1px #FFFFFF;
}
.normalTitle h2, .panelTitle h2, .processTitle h2 {
    font-size: 20px;
    font-weight: bold;
}
.content {
 margin: 0 auto;
    text-align: left;
    width: 707px;
}
.article, .intro, .download, .document, .developer {
margin:40px 0px;

background:#f5f6f7;
box-shadow:0px 1px 3px #ccc;
}
.section {
padding:0 0 20px 0;
margin:0 0 20px 0;
border-bottom:1px solid #eee;
overflow: hidden;
}
.lastSection {
border:none;
margin-bottom:0px;
}
.normalTitle {
border-bottom:1px solid #d7dde6;
border-radius:10px 10px 0 0;
padding:20px 40px;
text-shadow:0 1px 1px #fff;
}
.normalContent {
background:#fff;/*border-radius:0 0 10px 10px;*/
padding:40px;
}
.normalTitle h2, .panelTitle h2, .processTitle h2 {
font-size:20px;
font-weight:bold;
}
.green{ color:#090}
.red{ color: #F00}
.collapsible {
    background: none repeat scroll 0 0 #FFFFFF;
    padding: 20px;
}
.CollapsiblePanel {
    margin-bottom: 10px;
    width: 870px;
}
.CollapsiblePanelTab {
    background: url(style/images/img/arrow_unclick.png) no-repeat scroll 820px 20px #FFFFFF;
    border: 1px solid #DEDEDE;
    border-radius: 3px 3px 3px 3px;
    color: #626B8A;
    cursor: pointer;
    font-size: 18px;
    padding: 20px 40px 20px 20px;
    text-shadow: 0 1px 0 white;
}
.CollapsiblePanelTab.hover {
    background: url(style/images/img/arrow_unclick.png) no-repeat scroll 820px 20px #D7DDE6;
border: 1px solid #C1C9D4;
}
.CollapsiblePanelTab.clicked {
    background: url(style/images/img/arrow_click.png) no-repeat scroll 820px 20px #D7DDE6;
border: 1px solid #C1C9D4;
}
.CollapsiblePanelContent {
    display: none;
    overflow: hidden;
}
.CollapsiblePanelContent .normalContent {
    padding: 20px 20px 0;
}
</style>
<div class="content" style="width:985px;line-height:1.5">
<div class="document" >
            <div class="normalTitle"><h2>如何为微信公众号配置接口？</h2></div>
                <div class="collapsible">
<div class="section lastSection">
<p>请务必认真阅读以下2步内容，才能更有效的完成配置工作，有疑问的请联系QQ：<?php echo C('site_qq');?>提问。<br/>
<?php if($_GET['token'] != ''): ?>你的接口URL是：<font color="red"><?php echo C('site_url');?>/index.php/api/<?php echo $_GET['token']; ?></font><br>
您的token是：<font color="red"><?php echo $_GET['token']; ?></font><?php endif; ?></p>
</div>
                <div id="CollapsiblePanel2" class="CollapsiblePanel">
                    <div class="CollapsiblePanelTab clicked">第一步、在<?php echo C('site_name');?>绑定你的微信公众号。<span></span></div>
                    <div style="" class="">
                        <div class="articleContent catalogHome normalContent">
                            <div class="section lastSection">
                                <p>1、注册并登录<a href="<?php echo U('Index/login');?>"><?php echo C('site_name');?>接口平台</a></p>
                                <p>2、添加公众号 → 功能管理 → 勾选要开启的功能</p>									
								<p><img src="<?php echo STATICS;?>/help/help01.jpg" width="790px"></p>
								<p><img src="<?php echo STATICS;?>/help/help0.jpg" width="790px"></p>
                            </div>
                        </div>
                    </div>                        
                </div>
<div id="CollapsiblePanel3" class="CollapsiblePanel">
                        <div class="CollapsiblePanelTab clicked">第二步、到微信公众平台设置接口。<span></span></div>
                        <div style="" class="">
                            <div class="articleContent catalogHome normalContent">
                                <div class="section lastSection">
                                   <div class="section lastSection">
                                    <p>1、登录 <a href="http://mp.weixin.qq.com/">微信公众平台</a>（<a href="http://mp.weixin.qq.com/">http://mp.weixin.qq.com/</a>），进行身份认证，填写信息，提交身份证。</p>
                                    <p>认证后，点击高级功能 → 进入开发模式</p><br>
                                    <p><img src="<?php echo STATICS;?>/help/help002.jpg" width="790px"></p><br>
									<p>2、点击"成为开发者"按钮</p>
									<p><img src="<?php echo STATICS;?>/help/help003.jpg" width="790px"></p><br>
									<p>3、填写接口配置信息</p>
									<?php if($_GET['token'] == ''): ?><p>比如你<?php echo C('site_name');?>平台上的地址是<?php echo C('site_url');?>/index.php/api/demo</p>
									<p>那么URL就是<?php echo C('site_url');?>/INDEX.PHP/api/demo</p>
									<?php else: ?>
									<p>你的URL是 <font color="red"><?php echo C('site_url');?>index.php/api/<?php echo $_GET['token']; ?></font></p><?php endif; ?>
									<p>Token填写 <font color="red"><?php echo $_GET['token']; ?></font></p>
									<p><img src="<?php echo STATICS;?>/help/help004.jpg" width="790px"></p><br>
									<p>4、确认开启</p>
									<p>5、在手机上用微信给你的公众号输入"帮助"，测试你的接口是否配置正常！</p><br>									
                                </div>
                              
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div>
    </div>
<!--结束-->
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