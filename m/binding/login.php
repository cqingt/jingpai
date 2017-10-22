<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Keywords" content="" />
<meta name="Description" content="" />
<title>绑定_搜藏天下手机版</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta content="telephone=no" name="format-detection" /> 
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/navigation.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/font-awesome.min.css">

<script type="text/javascript" src="http://m.96567.com/templates/default/js/jquery-1.9.js"></script>
<body id="body">
<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];//
if (strpos($user_agent, 'MicroMessenger') === false) {
	//非微信浏览器打开提示
?>

<style type="text/css">
	.layoutToolBar{position:absolute;display:none;}
	.dialogBg{position:fixed;_position:absolute;top:0;left:0;background-color:#aaa;_background:#666;z-index:11;opacity:0.7;}

	.acti-tip2-cont{
		position: fixed;
		_position:absolute;
		_zoom: 1;
		width: 390px;
		height: 50px;
		padding: 20px;
		background-color: #fff;
		border: 6px solid #b91955;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		color: #232323;
		display:none;
		z-index:99999999;
	}
	.acti-tip2-cont .middle{text-align: left;}
	.acti-tip2-cont .middle p{
		font-family:"Microsoft YaHei";
		font-size: 16px;
		margin: 0 0 10px 0;
		padding: 0;
	}
	.acti-tip2-cont .bottom{font-family: "5b8b4f53";font-size: 13px;}
	.acti-tip2-cont .bottom span{color: #FD0100;}
	
</style>
<div class="dialogBg" style="width: 100%; z-index: 99999; display: none;"></div>
	<div class="acti-tip2-cont">
        <div class="middle">
            <p>哎呦~请使用微信浏览器打开啦。</p>
        </div>
        <div class="bottom">
            <span>3</span><span>秒钟后</span>，跳转到商城首页。
        </div>
    </div>
<script type="text/javascript">
	function timer(numContainer,callback){
    	var _con = $(numContainer),
    		_num = parseInt(_con.html()), 
    		
    	_timer = setInterval(function(){
    		if(_num > 1){
    			_num --;
    			_con.html(_num);
    		}
    		else{
    			clearInterval(_timer);
    			_timer = null;
    			if(typeof callback == 'function')
    				callback.call(this);
    		}
    	},1000);	
	}
	(function(){
		var end_result = '1';
		if(end_result){
			var _box = $('.acti-tip2-cont');
			$('body>.dialogBg').css({
				height : $(window).height() + 'px',
				width :$(window).width() + 'px',
				opacity : 0.8
			}).show();
			_box.css({
				top : ($(window).height() - _box.height())/2 + 'px',
				left : ($(window).width() - _box.width())/2 + 'px'
			}).show();
			timer($('.acti-tip2-cont .bottom>span').eq(0),function(){
				document.location.href = 'http://m.96567.com';
			});
			$(window).resize(function(){
				$('body>.dialogBg').css({
					height : $(window).height() + 'px',
					width :$('body').width() + 'px'
				});
				_box.css({
					top : ($(window).height() - _box.height())/2 + 'px',
					left : ($(window).width() - _box.width())/2 + 'px'
				});
				
			});
			if(jQuery.browser.msie&&jQuery.browser.version.match(/6\.0/)){
				$(window).scroll(function(){
					$('body>.dialogBg').css('top',$(this).scrollTop() + 'px');
					_box.css('top',($(window).height() - _box.height())/2 + $(this).scrollTop() + 'px');
				});
			}
		}
	})();
</script>
<?php
	exit;
}
?>
<a name="top"></a>
<header id="header">
    <div class="header-wrap">
        <a href="javascript:history.back();" class="header-back"><i class="fa fa-angle-left fa-2x"></i></a>
        <h2>业务员绑定</h2>
        <a href="javascript:void(0)" id="btn-opera" class="i-main-opera"><i class="fa fa-bars fa-lg"></i></a>
    </div>
    <div class="main-opera-pannel">
        <div class="main-op-table main-op-warp">
            <a href="http://m.96567.com" class="quarter">
                <i class="fa fa-home fa-2x"></i>
                <p>首页</p>
            </a>
            <a href="http://m.96567.com/index.php?act=goods_class&op=index" class="quarter">
                <i class="fa fa-list-ul fa-2x"></i>
                <p>分类</p>
            </a>
            <a href="http://m.96567.com/index.php?act=member_cart&op=cart_list" class="quarter"><i class="fa fa-shopping-cart fa-2x"></i><p>购物车</p></a>
            <a href="http://m.96567.com/index.php?act=member&op=home" class="quarter"><i class="fa fa-user fa-2x"></i><p>我的商城</p></a>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
                $("#btn-opera").click(function(event) {
                    $(".main-opera-pannel").toggle();
                });
            });
    </script>
</header>



<style type="text/css">
.denglu {margin:10px; font-size:18px;}
.denglu .kuang{width:100%; height:40px; line-height:40px; font-family:"微软雅黑"; font-size:16px; margin:0px; padding:0px; text-indent:0.5em; border:none; border:0px;}
.denglu2{overflow:hidden; padding-top:10px; padding-bottom:5px;}
.denglu4{overflow:hidden; padding-top:10px; padding-bottom:5px;}
.denglu3 {border:2px  solid #ddd; overflow:hidden;}
.denglu5 {border:2px  solid #ddd; overflow:hidden;}

.denglu6 {width:100%;overflow:hidden; padding-top:10px;}
.denglu7 {overflow:hidden; padding-top:10px;}
.denglu7 a {font-size:16px; font-family:"微软雅黑"; text-decoration:none; color:#007be0;}

.denglu .anniu{width:100%; height:40px; display:block; overflow:hidden; text-align:center; line-height:26px; border-radius:5px; border:1px solid #c00;background:-webkit-gradient(linear,0% 0,0% 100%,from(#e00),to(#c00)); font-size:18px; color:#fff; padding:0px; margin:0px;}
</style>


<div class="denglu">
 <form name="formLogin" action="bangding.php" method="post" onSubmit="return userLogin()">
<div class="denglu1">请登录crm帐号完成绑定</div>
<div class="denglu2">用户名：</div>
<div class="denglu3"  onmouseover="this.style.border='2px #f60 solid'"  onmouseout="this.style.border='2px #ddd solid'"><input name="username" id="username" type="text" class="kuang"></div>
<div class="denglu4">密    码：</div>
<div class="denglu5"  onmouseover="this.style.border='2px #f60 solid'"  onmouseout="this.style.border='2px #ddd solid'"><input name="password" id='password' type="password" class="kuang"></div>
<div class="denglu6">
<input name="" type="submit" value="绑定" class="anniu"></div>
</form>
</div>

<script>
function userLogin(){
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	if(username == ''){
		alert('用户名不能为空');
		return false;
	}
	if(password == ''){
		alert('密码不能为空');
		return false;
	}
}
</script>
<style>
	span.bds_more,.bds_tools a{
		padding-top: 0;
		display:inline;
		float:none;
	}
	#bdshare{
		float:none;
	}
	/*footer*/
	.m_footer {padding-bottom:10px; text-align: center;}
	.m_footer a {font-size: .85em; color: #666;}
	.m_footer .lg_bar {display:inline-block; padding:0px 2px; color:#666; font-size:.8em;}
	.m_footer .login {padding: .55em .71em; border-bottom: 1px solid #e5e5e5; text-align:left;}
	.m_footer .fk_db {float:right;}
	.m_footer .copyright {font-size:.85em; color:#666;}
	.m_footer .khd_down {font-size:1em; color:#666; padding-top: 5px;}
	.m_footer .khd_down a{margin-left: 10px; margin-right: 10px;}
	/*/footer*/
</style>
<div class="m_w m_footer">
     <div class="login">
     	<a href="http://m.96567.com/index.php?act=login&op=index">登录</a><span class="lg_bar">|</span><a href="http://m.96567.com/index.php?act=login&op=register">注册</a>	
	         <span class="fk_db"><a href="#top">回到顶部</a></span>
     </div>
     <div class="copyright">&copy;copyright 收藏天下</div>
</div>


</body>
</html>
