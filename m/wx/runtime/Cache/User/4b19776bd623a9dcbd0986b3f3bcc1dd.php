<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>var SITEURL='';</script>
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/common.js"></script>


<script type="text/javascript">
function ying(){
	 document.getElementById('tiduser').style.display="none";
	 document.getElementById('quit').style.display="block";
}
function xian(){
	 document.getElementById('tiduser').style.display="block";
	 document.getElementById('quit').style.display="none";
}
setTimeout(xian,5000);
</script>
</head>

<body>
<div id="herder" >
	<div id="top">
		<img src="<?php echo RES;?>/images/logo.png" />
		<a href="/" >首页</a>
		<a href="<?php echo U('Home/Index/fc');?>" >功能介绍</a>
		<a href="<?php echo U('Home/Index/about');?>" >关于我们</a>
		<a href="<?php echo U('User/Index/index');?>" >管理中心</a>
        <a href="<?php echo U('Home/Index/help');?>" >帮助中心</a>
		<a class="line" ></a>
        <a href="#" class="a" id="tiduser" onmouseover="ying();" >您好：<span><?php echo (session('uname')); ?></span></a>
		<a href="#" class="a1" id="quit" onclick="Javascript:window.open('<?php echo U('System/Admin/logout');?>')" onLoad=setTimeout("abc.style.display='none'",5000) >安全退出</a>
	</div>
</div>
<div id="Frame" class="shadow">
	<div id="nav">
		<img src="<?php echo ($wecha["headerpic"]); ?>" width="50" height="50" />
		<ul class="ul">
			<li><strong><?php echo ($wecha["wxname"]); ?></strong><img src="<?php echo RES;?>/images/vip.png" /></li>
			<li>微信号：<?php echo ($wecha["weixin"]); ?></li>
		</ul>
		<ul class="ul2">
			<li>VIP有效时间：<?php if($_SESSION['viptime'] != 0): echo (date("Y-m-d",$thisUser["viptime"])); else: ?>vip0不限时间<?php endif; ?></li>
			<li>图文自定义：<?php echo ($thisUser["diynum"]); ?>/<?php echo ($userinfo["diynum"]); ?></li>
		</ul>
		<ul>
			<li>活动创建数：<?php echo ($thisUser["activitynum"]); ?>/<?php echo ($userinfo["activitynum"]); ?></li>
			<li>请求数：<?php echo ($thisUser["connectnum"]); ?>/<?php echo ($userinfo["connectnum"]); ?></li>
		</ul>
		<ul>
			<li>请求数剩余：<?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?></li>
			<li>已使用：<?php echo $_SESSION['diynum']; ?></li>
		</ul>
		<ul>
			<li>当月赠送请求数：<?php echo ($userinfo["connectnum"]); ?></li>
			<li>当月剩余请求数：<?php echo $userinfo['connectnum']-$_SESSION['connectnum']; ?></li>
		</ul>
	</div>
    <div id="floatline"></div>
	<div id="Menu">
		<div class="top">
        	
            <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Index','Company','Other'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Ewm','Diymen','Flash','Photo','plugmenu'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-001.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Wedding','Research'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-003.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info','Estate'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-002.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member','replyInfoSet'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-004.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan','Reservation'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-005.png" />
            <?php } ?>
                <!--<img src="<?php echo RES;?>/images/AMenu-Ico.png" />-->
            <a>
            	<?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Index','Company','Other','Requerydata','Alipay_config','Alipay_m_config'))){ ?>基础功能<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Ewm','Diymen','Flash','Photo','plugmenu'))){ ?>微网站<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Research','Zadan','Wedding','Weidiaoyan'))){ ?>营销功能<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Research','Reply_info','Panorama','Estate'))){ ?>微商务<?php } ?>
                <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member','replyInfoSet'))){ ?>微会员<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan','Reservation'))){ ?>互动模块<?php } ?>
            </a>
            <span>
            	<?php if(MODULE_NAME == 'Function'): ?>- 功能管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Areply'): ?>- 关注回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Text'): ?>- 文本回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Voiceresponse'): ?>- 语音回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Index'): ?>- 短信邮箱<?php endif; ?>
                <?php if(MODULE_NAME == 'Index'): ?>- 短信邮箱<?php endif; ?>
                <?php if(MODULE_NAME == 'Alipay_config'): ?>- 支付宝设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Alipay_m_config'): ?>- 支付宝设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Requerydata'): ?>- 统计分析<?php endif; ?>
                <?php if(MODULE_NAME == 'Company'): ?>- LBS回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Home'): ?>- 首页设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Tmpls'): ?>- 模版管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Classify'): ?>- 分类管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Img'): ?>- 图文回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Diymen'): ?>- 自定义菜单<?php endif; ?>
                <?php if(MODULE_NAME == 'Flash'): ?>- 幻灯片<?php endif; ?>
                <?php if(MODULE_NAME == 'Photo'): ?>- 相册<?php endif; ?>
                <?php if(MODULE_NAME == 'plugmenu'): ?>- 相册<?php endif; ?>
                <?php if(MODULE_NAME == 'Panorama'): ?>- 360全景<?php endif; ?>
                <?php if(MODULE_NAME == 'Estate'): ?>- 楼盘房产<?php endif; ?>
                <?php if(MODULE_NAME == 'Reply_info'): ?>- 回复配置<?php endif; ?>
                <?php if(MODULE_NAME == 'Lottery'): ?>- 大转盘<?php endif; ?>
                <?php if(MODULE_NAME == 'Coupon'): ?>- 优惠券<?php endif; ?>
                <?php if(MODULE_NAME == 'Guajiang'): ?>- 刮刮卡<?php endif; ?>
                <?php if(MODULE_NAME == 'Zadan'): ?>- 砸金蛋<?php endif; ?>
                <?php if(MODULE_NAME == 'Wedding'): ?>- 微喜帖<?php endif; ?>
                <?php if(MODULE_NAME == 'Research'): ?>- 微调研<?php endif; ?>
                <?php if(MODULE_NAME == 'Weidiaoyan'): ?>- 微调研<?php endif; ?>
                <?php if(MODULE_NAME == 'Product'): ?>- 微商城<?php endif; ?>
                <?php if(MODULE_NAME == 'Ewm'): ?>- 扫码关注<?php endif; ?>
                <?php if(MODULE_NAME == 'Groupon'): ?>- 微团购<?php endif; ?>
                <?php if(MODULE_NAME == 'orders'): ?>- 无线订餐<?php endif; ?>
                <?php if(MODULE_NAME == 'Host'): ?>- 通用订单<?php endif; ?>
                <?php if(MODULE_NAME == 'Selfform'): ?>- 万能表单<?php endif; ?>
                <?php if(MODULE_NAME == 'Adma'): ?>- DIY宣传<?php endif; ?>
                <?php if(MODULE_NAME == 'info'): ?>- 商家设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Member_card'): ?>- 会员卡<?php endif; ?>
                <?php if(MODULE_NAME == 'privilege'): ?>- 会员特权<?php endif; ?>
                <?php if(MODULE_NAME == 'create'): ?>- 在线开卡<?php endif; ?>
                <?php if(MODULE_NAME == 'exchange'): ?>- 积分设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Member'): ?>- 资料管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Taobao'): ?>- 淘宝天猫<?php endif; ?>
                <?php if(MODULE_NAME == 'Api'): ?>- 第三方<?php endif; ?>
                <?php if(MODULE_NAME == 'Liuyan'): ?>- 留言板<?php endif; ?>
                <?php if(MODULE_NAME == 'Reservation'): ?>- 微预约<?php endif; ?>
            </span>
		</div>
		<div class="TwoMenu">
			<a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-06.png" />
            	<span>基础</span>
            </a>
			<div id="TwoMenu-01" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Img','Voiceresponse','Index','Ewm','Company','Other','Requerydata','Alipay_config','Alipay_m_config'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" /><a class="a">基础</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Home/set',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-01.png" />
                <span>3G站</span>
            </a>
			<div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Diymen','Flash','Photo'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-001.png" /><a class="a">3G站</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Lottery/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-03.png" /><span>营销</span>
            </a>
			<div id="TwoMenu-03" <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Wedding','Zadan','Wedding'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-003.png" /><a class="a">营销</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Product/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-02.png" /><span>商务</span>
            </a>
			<div id="TwoMenu-04" <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info','Estate'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-002.png" /><a class="a">商务</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Member_card/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-04.png" /><span>会员</span>
            </a>
			<div id="TwoMenu-05" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-004.png" /><a class="a">会员</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Taobao/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/6-0.png" /><span>互动</span>
            </a>
			<div id="TwoMenu-06" <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan','Reservation'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/6-00.png" /><a class="a">互动</a>
            </div>
		</div>
		<div class="ThreeMenu">
        	<div class="contab" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Img','Voiceresponse','Index','Company','Other','Requerydata','Alipay_config','Alipay_m_config','Ewm'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" class="Red" >
                	<img src="<?php echo RES;?>/images/1-0.png" /><span>功能管理</span>
                </a>
                <a href="<?php echo U('Areply/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/1-1.png" /><span>关注回复</span>
                </a>
                <a href="<?php echo U('Text/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/1-2.png" /><span>文本回复</span>
                </a>
                <a href="<?php echo U('Img/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-3.png" /><span>图文回复</span>
                </a>
                <a href="<?php echo U('Voiceresponse/index',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/1-3.png" /><span>语音回复</span>
                </a>
                <a href="<?php echo U('Index/editsms',array('id'=>session('wxid'),'token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/1-4.png" /><span>短信设置</span>
                </a>
                <a href="<?php echo U('Index/editemail',array('id'=>session('wxid'),'token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-07.png" /><span>邮箱设置</span>
                </a>
                <a href="<?php echo U('Company/index',array('token'=>$token));?>" class="Brown" >
                    <img src="<?php echo RES;?>/images/1-5.png" /><span>LBS回复</span>
                </a>
                <a href="<?php echo U('Alipay_m_config/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>支付宝</span>
                </a>
                <a href="<?php echo U('Requerydata/index',array('token'=>$token));?>" class="LightRed" >
                    <img src="<?php echo RES;?>/images/TwoMenu-ico-05.png" /><span>统计分析</span>
                </a>
                <a href="<?php echo U('Ewm/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/2-3.png" /><span>扫码关注</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        	<div class="contab" <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Diymen','Flash','Photo','plugmenu'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                 <a href="<?php echo U('Home/set',array('token'=>$token));?>" class="Red" >
                     <img src="<?php echo RES;?>/images/2-0.png" /><span>首页设置</span>
                 </a>
                <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/2-1.png" /><span>模版管理</span>
                </a>
                <a href="<?php echo U('Classify/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/2-2.png" /><span>分类管理</span>
                </a>
                <a href="<?php echo U('Diymen/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/2-4.png" /><span>DIY菜单</span>
                </a>
                <a href="<?php echo U('Flash/index',array('token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/2-5.png" /><span>幻灯片</span>
                </a>
                <a href="<?php echo U('Photo/index',array('token'=>$token));?>" class="Brown" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>相册</span>
                </a>
                <a href="<?php echo U('Home/plugmenu',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>拨号版权</span>
                </a>
                <a href="<?php echo U('Yulan/index',array('token'=>$token));?>" target="_blank" class="Highland" >
                    <img src="<?php echo RES;?>/images/2-1.png" /><span>在线预览</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Research','Zadan','Wedding','Weidiaoyan'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" class="Red"  >
                    <img src="<?php echo RES;?>/images/3-0.png" /><span>大转盘</span>
                </a>
                <a href="<?php echo U('Coupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/3-1.png" /><span>优惠券</span>
                </a>
                <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/3-2.png" /><span>刮刮卡</span>
                </a>
                 <a href="<?php echo U('Zadan/index',array('token'=>$token));?>" class="DarkGreen">
                    <img src="<?php echo RES;?>/images/3-3.png" /><span>砸金蛋</span>
                </a>
                <a href="<?php echo U('Wedding/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="<?php echo RES;?>/images/3-3.png" /><span>微喜帖</span>
                </a>
                <a href="<?php echo U('Weidiaoyan/index',array('token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/3-4.png" /><span>微调研</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info','Estate'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Product/index',array('token'=>$token));?>" class="Red"  >
                    <img src="<?php echo RES;?>/images/5-0.png" /><span>微商城</span>
                </a>
                <a href="<?php echo U('Groupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/5-1.png" /><span>微团购</span>
                </a>
                <a href="<?php echo U('Product/orders',array('token'=>$token,'dining'=>1));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/5-2.png" /><span>无线订餐</span>
                </a>
                <a href="<?php echo U('Host/index',array('token'=>$token));?>"  class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>通用订单</span>
                </a>
                <a href="<?php echo U('Selfform/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>万能表单</span>
                </a>
                <a href="<?php echo U('Adma/index',array('token'=>$token));?>"  class="Orange" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>DIY宣传</span>
                </a>
                <a href="<?php echo U('Panorama/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>360全景</span>
                </a>
                <a href="<?php echo U('Estate/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>楼盘房产</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Member_card/info',array('token'=>$token));?>"  class="Red"  >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>商家设置</span>
                </a>
                <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>会员卡</span>
                </a>
                <a href="<?php echo U('Member_card/replyInfoSet',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>回复配置</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan','Reservation'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Taobao/index',array('token'=>$token));?>"  class="Red"  >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>淘宝天猫</span>
                </a>
                <a href="<?php echo U('Api/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>第三方</span>
                </a>
                <a href="<?php echo U('Liuyan/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>留言板</span>
                </a>
                <a href="<?php echo U('Reservation/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>微预约</span>
                </a>
            </div>
		</div>
	</div>
	<div id="Content" >
	</div>  
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />
<script src="<?php echo C('site_url');?>/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="<?php echo C('site_url');?>/tpl/static/artDialog/plugins/iframeTools.js"></script>
        <div class="content" style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px;" >
<div class="cLineB">
<h4 class="left">订单管理（<a href="<?php echo U('Product/orders',array('token'=>$token,'handled'=>0));?>">未处理订单<span style="color:#f00"><?php echo ($unhandledCount); ?></span>个</a>） (<?php echo ($page); ?>) </h4>
<div class="searchbar right">
<form method="post" action="">
<input type="text" id="msgSearchInput" class="txt left" placeholder="输入订购人名字搜索" name="searchkey" value="">
<input type="hidden" name="ac" value="hotels-list">
<input type="hidden" name="id" value="9878">
<input type="hidden" name="wxid" value="gh_423dwjkewad">
<input type="submit" value="搜索" id="msgSearchBtn" href="" class="btnGrayS" title="搜索">
<script>
function selectall(name) {
	var checkItems=$('.cbitem');
	if ($("#check_box").attr('checked')==false) {
		$.each(checkItems, function(i,val){
			val.checked=false;
		});
		
	} else {
		$.each(checkItems, function(i,val){
			val.checked=true;
		});
	}
}
</script>
<?php if(($parentid != '0') and ($parentid != '')): ?><a href="<?php echo U('Product/cats',array('token'=>$token,'parentid'=>$parentCat['parentid']));?>" class="btnGreen" style="margin-top:-27px">返回上</a><?php endif; ?>
</form>
</div>
<div class="clr"></div>
</div>
<!--tab start-->
<div class="tab">
<ul>
<li class="tabli" id="tab0"><a href="<?php echo U('Product/index',array('token'=>$token,'dining'=>$isDining));?>"><?php if($isDining != 1): ?>商品<?php else: ?>菜品<?php endif; ?>管理</a></li>
<li class="tabli" id="tab2"><a href="<?php echo U('Product/cats',array('token'=>$token,'dining'=>$isDining));?>"><?php if($isDining != 1): ?>商品分类<?php else: ?>菜品分类<?php endif; ?>管理</a></li>
<li class="current tabli" id="tab2"><a href="<?php echo U('Product/orders',array('token'=>$token,'dining'=>$isDining));?>">订单管理</a></li>
<?php if($isDining == 1): ?><li class="tabli" id="tab2"><a href="<?php echo U('Product/tables',array('token'=>$token,'dining'=>1));?>">桌台管理</a></li><?php endif; ?>
<?php if($isDining != 1): ?><li class="tabli" id="tab5"><a href="<?php echo U('Reply_info/set',array('token'=>$token,'infotype'=>'Shop'));?>">商城回复配置</a></li>
<?php else: ?>
<li class="tabli" id="tab5"><a href="<?php echo U('Reply_info/set',array('token'=>$token,'infotype'=>'Dining'));?>">订餐回复配置</a></li><?php endif; ?>
</ul>
</div>
<!--tab end-->
<div class="msgWrap">
<form method="post" action="" id="info">
<div class="cLine">
<div class="pageNavigator left"> <a href="###" onclick="$('#info').submit()" title="" class="btnGrayS vm bigbtn"><img src="<?php echo RES;?>/images/product/arrow_switch.png" class="vm">处理订单</a></div>
<div class="clr"></div>
</div>

<table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
<thead>
<tr>
<th class="select"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
<th width="70">姓名</th>
<th width="80">电话</th>
<th class="60">数量</th>
<th width="80">总价（元）</th>
<th class="160">付款状态/发货状态</th>
<th class="60">状态</th>
<th width="130">创建时间</th>
 

<th width="150" class="norightborder">操作</th>
</tr>
</thead>
<tbody>
<tr></tr>
<?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><tr>
<td><input type="checkbox" value="<?php echo ($o["id"]); ?>" class="cbitem" name="id_<?php echo ($i); ?>"></td>
<td><?php echo ($o["truename"]); ?> <?php if($isDining == 1): ?><span style="color:#f60">[<?php if($o["diningtype"] == 1): ?>点餐<?php elseif($o["diningtype"] == 2): ?>外卖<?php elseif($o["diningtype"] == 3): ?>预定<?php else: endif; ?>]</span><?php endif; ?></td>
<td><?php echo ($o["tel"]); ?></td>
<td><?php echo ($o["total"]); ?></td>
<td><?php echo ($o["price"]); ?></td>
<td><?php if($o["paid"] == 1): ?><span style="color:green">已付款</span><?php else: ?><span style="color:red">未付款</span><?php endif; ?> / <?php if($o["sent"] == 1): ?><span style="color:green">已发货</span><?php else: ?><span style="color:red">未发货</span><?php endif; ?></td>
<td><?php if($o["handled"] == 1): ?><span style="color:green">已处理</span><?php else: ?><span style="color:red">未处理</span><?php endif; ?></td>
<td><?php echo (date("Y-m-d H:i:s",$o["time"])); ?></td> 
<td class="norightborder"><a href="###" onclick="showIntroDetail(<?php echo ($o["id"]); ?>)">详细</a> <a href="javascript:drop_confirm('您确定要删除吗?', '<?php echo U('Product/deleteOrder',array('token'=>$token,'id'=>$o['id'],'dining'=>$isDining));?>');">删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
<input type="hidden" name="token" value="<?php echo ($_GET['token']); ?>" />
</form>

   <script>
function showIntroDetail(id){
	art.dialog.open('<?php echo U('Product/orderInfo',array('token'=>$token,'dining'=>$isDining));?>&id='+id,{lock:false,title:'订单详情',width:700,height:420,yesText:'关闭',background: '#000',opacity: 0.87});
}
</script>
</div>
<div class="cLine">
<div class="pageNavigator right">
<div class="pages"><?php echo ($page); ?></div>
</div>
<div class="clr"></div>
</div>
</div>

	<div style="clear:both;"></div>
</div>



</body>
</html>