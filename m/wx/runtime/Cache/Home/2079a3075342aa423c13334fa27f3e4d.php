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
                <li><a href="<?php echo U('Home/Index/common');?>">客户案例</a></li>
                <li><a href="<?php echo U('Home/Index/about');?>" class="hover">关于我们</a></li>
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
		<h2 class="Public-h2">代理合作</h2>
		<div class="Public-box">
			<div class="Proxy">
				<h3>尊敬的各位合作伙伴：</h3>
				<p>　　首先非常感谢您对<?php echo C('site_name');?>平台的认可和支持，信任是合作的基础，这是我们一直强调的核心价值观。</p>
				<p>　　<?php echo C('site_name');?>平台在大家的共同努力下，目前已经成长为在微信第三方平台中拥有较高知名度和用户数量的第三方平台。为了能使更多的用户享受<?php echo C('site_name');?>提供的高品质的微信营销产品和服务，目前我们正在全国范围内大力发展代理伙伴。我们的目标是：通过发展一批有实力的区域和行业代理商作为稳定的合作伙伴来承担销售业务，建立<?php echo C('site_name');?>的营销战略合作伙伴体系，共同投身于微信营销的事业。</p>
				<p>　　<?php echo C('site_name');?>平台通过市场与技术支持、各种媒体宣传、促消活动及完善的售后服务，为<?php echo C('site_name');?>的代理商提供及时的、量身定做的高效特色服务及全面支持。</p>
				<p>　　无论您在何方，不管您有多远，无论是个人还是团体，我们都欢迎您成为我们的一员，<?php echo C('site_name');?>平台希望每个人都能通过<?php echo C('site_name');?>实现价值，正像微信公众平台提出的一样：“再小的个体，也有自己的品牌。”我们将与您始终保持零距离的接触，提供零距离的服务。欢迎全国各地、各广告商、渠道代理商踊跃加盟，<?php echo C('site_name');?>对有意成为合作伙伴的朋友致以诚挚的谢意，感谢您对<?php echo C('site_name');?>平台的支持和信任。</p>
				<p>合作及代理联系方式：企业QQ：<span><?php echo C('site_qq');?></span></p>
			</div>
		</div>
        
        	<h2 class="Public-h2">总部提供支持</h2>
		<div class="Public-box">
			<div class="Proxy">
				<p>1、总部提供专业的研发团队，优先处理和研发代理商反馈的需求，定制模块开发支持；</p>
				<p>2、总部对独家代理商所在地区不参与直销，全权交给代理商，充分保护代理商的利益；</p>
				<p>3、总部通过网络推广得到的资源将全部转交给当地代理商，代理商无需承担推广费用；</p>
				<p>4、平台提供7×12小时的技术支持，随时提供响应；</p>
				<p>5、提供平台的产品介绍、活动策划、营销推广、代运营建议；</p>
				<p>6、免费提供总部微营销课程及代理商大礼包资料；</p>
				<p>7、总部会定期在代理商所在城市与代理商一起协作举办微营销会议，从而扩大代理商在当地的影响力和<?php echo C('site_name');?>的品牌知名度</p>
				<p>8、每个代理商确定正式合作关系后，将免费为代理商开通一个年费的全功能演示账号，供演示使用；</p>
				<p>9、总部为全国代理商提供统一的行业解决方案PPT；</p>
				<p>10、渠道经理后期会定期亲临代理商公司给予产品培训，销售技巧培训等，并协助代理商销售客户。</p>
			</div>
		</div>
        
		<h2 class="Public-h2">联系渠道经理</h2>
		<div class="Public-box">
			<div class="Proxy">
								<p><strong>方经理：</strong><span>QQ：<?php echo C('site_qq');?></span><br>
								</p>
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