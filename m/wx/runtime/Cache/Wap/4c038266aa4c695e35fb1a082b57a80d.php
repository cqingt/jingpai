<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($thisForm["name"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link href="<?php echo RES;?>/css/style/css/hotels.css" rel="stylesheet" type="text/css">
<script src="<?php echo RES;?>/css/style/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $staticFilePath;?>/js/main.js"></script>

</head>

<body id="wrap">
<style>
.deploy_ctype_tip{z-index:1001;width:100%;text-align:center;position:fixed;top:50%;margin-top:-23px;left:0;}.deploy_ctype_tip p{display:inline-block;padding:13px 24px;border:solid #d6d482 1px;background:#f5f4c5;font-size:16px;color:#8f772f;line-height:18px;border-radius:3px;}
</style>
<div class="banner">
<div id="wrapper">
<div id="scroller" style="float:none">
<ul id="thelist">
               
<li style="float:none"><p><?php echo ($thisForm["name"]); ?></p>

<?php if($thisForm['logourl'] != ''): ?><a href="<?php echo U('Weidiaoyan/detail',array('token'=>$token,'id'=>$thisForm['id'],'wecha_id'=>$wecha_id));?>">
<img src="<?php echo ($thisForm["logourl"]); ?>" alt="<?php echo ($thisForm["name"]); ?>" style="width:100%"/></a><?php endif; ?>

</li>
 

</ul>
</div>
</div>

<div class="clr"></div>
</div>


<div class="cardexplain">


<?php if($_GET['success'] == 1): ?><ul class="round roundyellow" id="success">
<li style="height:40px;line-height:40px; font-size:16px; text-align:center"><?php echo ($thisForm["successtip"]); ?></li>
</ul>
<script type="text/javascript">
$(function() {
	$('#success').show().delay(1600).slideUp(1600);
	return;
});
</script><?php endif; ?>

<!--intro-->
<ul class="round">
<li>
<h2>简介</h2>
<div class="text">
<?php echo ($thisForm['intro']); ?>
</div>
</li>
<li><a href="<?php echo U('Weidiaoyan/detail',array('token'=>$token,'id'=>$thisForm['id'],'wecha_id'=>$wecha_id));?>"><span style="color:#666">详细介绍</span></a></li>
</ul>


<?php if($submitted != 1): ?><form method="post" action="" id="form" onSubmit="return tgSubmit()">   
<ul class="round">
<li class="title mb"><span class="none">请填写以下信息</span></li>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="nob">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th><?php echo ($item["displayname"]); ?></th>
<td><?php if($item['inputtype'] == 'select'): ?><select style="line-height:35px;" id="<?php echo ($item["fieldname"]); ?>" name="<?php echo ($item["fieldname"]); ?>"  class="dropdown-select"><?php echo ($item["optionStr"]); ?></select>
    			<?php elseif($item['inputtype'] == 'text'): ?>
    			<input type="text" class="px" placeholder="请输入<?php echo ($item["displayname"]); ?>" id="<?php echo ($item["fieldname"]); ?>" name="<?php echo ($item["fieldname"]); ?>" value="" />
    			<?php elseif($item['inputtype'] == 'textarea'): ?>
    			<textarea class="pxtextarea" style=" height:99px;overflow-y:visible" placeholder="请输入<?php echo ($item["displayname"]); ?>" id="<?php echo ($item["fieldname"]); ?>" name="<?php echo ($item["fieldname"]); ?>"></textarea><?php endif; ?></td>
</tr>
</table>
</li><?php endforeach; endif; else: echo "" ;endif; ?>                                                          
</ul>

<div class="footReturn" style="text-align:center">
<?php if($submitted != 1): ?><input type="submit" style="margin:0 auto 20px auto;width:90%"  class="submit" value="提交信息" /><?php endif; ?>
</div>
</form>
<?php else: ?>
<ul class="round">
<li class="title mb"><span class="none">您提交的信息</span></li>
<div style="margin:10px 0; text-align:center;line-height:26px;">您的二维码信息<br><img src="<?php echo $imgSrc;?>" /></div>
<?php if(is_array($submitInfo)): $i = 0; $__LIST__ = $submitInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li class="nob" style="height:35px;line-height:35px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="kuang">
<tr>
<th><?php echo ($item["displayname"]); ?></th>
<td><?php echo ($item["value"]); ?></td>
</tr>
</table>
</li><?php endforeach; endif; else: echo "" ;endif; ?>                                                          
</li>
</ul><?php endif; ?>
<script>
function showTip(tipTxt) {
	var div = document.createElement('div');
	div.innerHTML = '<div class="deploy_ctype_tip"><p>' + tipTxt + '</p></div>';
	var tipNode = div.firstChild;
	$("#wrap").after(tipNode);
	setTimeout(function () {
		$(tipNode).remove();
	}, 1500);
}
function tgSubmit(){
	//
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>var <?php echo ($item['fieldname']); ?>=$("#<?php echo ($item['fieldname']); ?>").val();
	<?php if($item['require'] != 0): ?>if($.trim(<?php echo ($item['fieldname']); ?>) == ""){
		showTip('<?php echo ($item['errortip']); ?>')
		return false;
	}<?php endif; ?>
	<?php if($item['regex'] != ''): ?>var patrn = <?php echo ($item['regex']); ?>;
	if (!patrn.exec($.trim(<?php echo ($item['fieldname']); ?>))) {
		showTip('<?php echo ($item['errortip']); ?>')
		return false;
	}<?php endif; endforeach; endif; else: echo "" ;endif; ?>
	return true;
}
	</script>
</div>
</body>
</html>