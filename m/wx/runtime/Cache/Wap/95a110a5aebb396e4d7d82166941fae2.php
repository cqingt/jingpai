<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl['wxname']); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/allcss/addnew64/iscroll.css" />

<script src="<?php echo RES;?>/js/ty/iscroll.js" type="text/javascript"></script>
        <script type="text/javascript">
            var myScroll;
            function loaded() {
                myScroll = new iScroll('wrapper', {
                    snap: true,
                    momentum: false,
                    hScrollbar: false,
                    onScrollEnd: function () {
                        document.querySelector('#indicator > li.active').className = '';
                        document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
                    }
                });
 
            }
            document.addEventListener('DOMContentLoaded', loaded, false);
        </script>

<style type="text/css">
body{
	background-color:black;
}

#cate8 .wz08menu {
	display: block;
	margin: 0;
	padding: 2px;
}

#cate8 .wz08menu li {
	width: 25%;
	float: left;
	overflow: hidden;
	border-radius: 0px;
}

#cate8 .wz08menu li .wz08btn {
	text-decoration: none;
	color: #000;
	overflow: hidden;
	border-radius: 5px;
	margin: 2px;
	background-color: rgba(255, 255, 255, 0.31);
	box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.15);
	-moz-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.15);
	-webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.15);
}

#cate8 .wz08menu li a {
	padding: 0px;
	font-size: 14px;
	color: #000000;
	text-decoration: none;
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}

#cate8 .wz08menu li .wz08btn .wz08img {
	overflow: hidden;
	position: relative;
}

#cate8 .wz08menu li div img {
	border: 0;
	width: 100%;
	margin: 0;
	padding: 0;
	border-radius: 0px;
}

#cate8 .wz08menu li .menutitle {
	text-align: center;
	text-decoration: none;
	color: #A48257;
	font-size: 0.7em;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
	position: absolute;
	bottom: 5px;
	width: 100%;
	display: block;
}

#cate8 .wz08menu li:nth-child(1) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(6) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(7) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(8) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(13) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(14) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(15) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(20) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(21) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(22) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(27) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(28) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(29) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(34) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(35) {
    width: 49.9%;
}
#cate8 .wz08menu li:nth-child(36) {
    width: 49.9%;
}
html,body {
	color: #ffffff;
	font-family: Microsoft YaHei, Helvitica, Verdana, Tohoma, Arial,
		san-serif;
	margin: 0;
	padding: 0;
	text-decoration: none;
}

* {
	margin: 0;
	padding: 0;
}

li {
	list-style-type: none;
}

a{
	text-decoration:none;
}
</style>

</head>
<body>
	<div class="banner">
		<div id="wrapper">
			<div id="scroller">
				<ul id="thelist"> 
				<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li><p><?php echo ($so["info"]); ?></p><a href="<?php echo ($so["url"]); ?>"><img src="<?php echo ($so["img"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div id="nav">
			<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,3);return false">&larr; prev</div>
			<ul id="indicator">
			<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li   <?php if($i == 1): ?>class="active"<?php endif; ?>  ><?php echo ($i); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
		</div>
		<div class="clr"></div>
	</div>
	<div id="insert1"></div>
	<script>


            var count = document.getElementById("thelist").getElementsByTagName("img").length;	


            for(i=0;i<count;i++){
                document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

            }

            document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";


            setInterval(function(){
                myScroll.scrollToPage('next', 0,400,count);
            },3500 );

            window.onresize = function(){ 
                for(i=0;i<count;i++){
                    document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

                }

                document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
            } 

	</script>
	<div id="insert2"></div>
	<div style="display:none"> </div>
	<div style="display:none"><script language="javascript" type="text/javascript" src=""></script></div>


<div id="cate8">
		<ul class="wz08menu">
		<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
				<div class="wz08btn">
					<a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo ($vo["url"]); endif; ?>">
						<div class="wz08img">
							<img src="<?php echo ($vo["img"]); ?>" />
						</div>
					</a>
				</div>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
	</div>

<div class="copyright">
<?php if($iscopyright == 1): echo ($homeInfo["copyright"]); ?>
<?php else: ?>
<?php echo ($siteCopyright); endif; ?>
</div>
</body>

<script type="text/javascript">
window.onload = function(){
	$(".wz08menu img").each(function(){
		$(this).height($(this).width());
	  });
};
</script>
</html>