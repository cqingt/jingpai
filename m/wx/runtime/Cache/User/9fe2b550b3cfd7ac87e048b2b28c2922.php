<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信营销系统</title>
<meta http-equiv="MSThemeCompatible" content="Yes" />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $apikey;?>"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />
 <script src="<?php echo C('site_url');?>/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="<?php echo C('site_url');?>/tpl/static/artDialog/plugins/iframeTools.js"></script>
</head>
<body style="background:#fff">
<?php if($result != 1): ?><div style="background:#fefbe4;border:1px solid #f3ecb9;color:#993300;padding:10px;width:90%;margin:40px auto 5px auto;">选中文件后点击上传按钮或者点击“从素材库选择”直接从已上传文件中选择</div>

<form enctype="multipart/form-data" action="http://v0.api.upyun.com/<?php echo ($bucket); ?>/" id="thumbForm" method="POST" style="font-size:14px;padding:30px 20px 10px 20px;">

<input type="hidden" name="policy" value="<?php echo ($policy); ?>">
<input type="hidden" name="signature" value="<?php echo ($sign); ?>">
<p><div style="font-size:14px;">选择本地文件：<br><br><input type="file" style="width:90%;border:1px solid #ddd" name="file"></input></div><div style="padding:50px 0;text-align:center;"><input id="submitbtn" name="doSubmit" type="submit" class="btnGreen" value="上传" onclick="this.value='上传中...'" /> <input name="btnchoose" onclick="location.href='<?php echo U('Attachment/my',array('type'=>'my'));?>'" type="button" class="btnGreen" value="从素材库选择" /></div></p>
</form>
<?php else: ?>
<div style="text-align:center;line-height:140px;font-size:14px;"> <img src="<?php echo C('site_url');?>/tpl/User/default/common/images/export.png" align="absmiddle" /> <?php echo ($message); ?> </div>
<script>
var domid=art.dialog.data('domid');
// 返回数据到主页面
function returnHomepage(url){
	var origin = artDialog.open.origin;
	var dom = origin.document.getElementById(domid);
	var domsrcid=domid+'_src';

	if(origin.document.getElementById(domsrcid)){
	origin.document.getElementById(domsrcid).src=url;
	}
	
	dom.value=url;
	setTimeout("art.dialog.close()", 1500 )
}
<?php if($_GET['code']==200){ ?>
returnHomepage('<?php echo $upyun_domain.$_GET['url']; ?>');
<?php } ?>
</script><?php endif; ?>
</body>
</html>