<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站点配置</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery-1.7.2.min.js" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery.form.js" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<style>
.set_top{background:url('<?php echo RES;?>/images/set_top.png');height:60px;}
.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('<?php echo RES;?>/images/set_top_li.png');}
#set_top_li_bg{background:url('<?php echo RES;?>/images/set_top_li_hover.png');}
</style>
<div class="set_top">
	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(ACTION_NAME == $vo['name']): ?>id="set_top_li_bg"<?php endif; ?>><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>6,'level'=>3));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<script>
function changeuploadtype(v){
	if(v=='local'){
		document.getElementById('upload_bucket').style.display='none';
		document.getElementById('upload_secret').style.display='none';
		document.getElementById('upload_username').style.display='none';
		document.getElementById('upload_password').style.display='none';
		document.getElementById('upload_domain').style.display='none';
	}else{
		document.getElementById('upload_bucket').style.display='';
		document.getElementById('upload_secret').style.display='';
		document.getElementById('upload_username').style.display='';
		document.getElementById('upload_password').style.display='';
		document.getElementById('upload_domain').style.display='';
	}
}
</script>
<div id="artlist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">
 <form id="myform" action="<?php echo U('Site/insert');?>" method="post">
 <tr> 
      <td  height="48" align="right"><strong>保存方式：</strong></td>
      <td><select onchange="changeuploadtype(this.value)" name="upload_type" id="upload_type"><option value="local"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' selected';}?>>保存到本服务器</option><option value="upyun"<?php if (C('upload_type')=='upyun'){echo ' selected';}?>>保存到又拍云</option></select>
	  </td>
    </tr>
<tr id="upload_bucket" class="upyun"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' style="display:none"';}?>> 
      <td  height="48" align="right"><strong>BUCKET：</strong></td>
      <td><input type="text" name="up_bucket" value="<?php echo C('up_bucket');?>" class="ipt" size="45" /><span></span>
	  </td>
    </tr>
    <tr id="upload_secret" class="upyun"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' style="display:none"';}?>> 
      <td  height="48" align="right"><strong>FORM_API_SECRET：</strong></td>
      <td><input type="text" name="up_form_api_secret" value="<?php echo C('up_form_api_secret');?>" class="ipt" size="45" /><span></span>
	  </td>
    </tr>
    <tr id="upload_username" class="upyun"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' style="display:none"';}?>> 
      <td  height="48" align="right"><strong>操作员用户名：</strong></td>
      <td><input type="text" name="up_username" value="<?php echo C('up_username');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;</span>
	  </td>
    </tr>
    <tr id="upload_password" class="upyun"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' style="display:none"';}?>> 
      <td  height="48" align="right"><strong>操作员密码：</strong></td>
      <td><input type="password" name="up_password" value="<?php echo C('up_password');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;</span>
	  </td>
    </tr>
    <tr id="upload_domain" class="upyun"<?php if (C('upload_type')==''||C('upload_type')=='local'){echo ' style="display:none"';}?>> 
      <td  height="48" align="right"><strong>云存储域名：</strong></td>
      <td><input type="text" name="up_domainname" value="<?php echo C('up_domainname');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;不包含http://</span>
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>上传文件类型：</strong></td>
      <td><input type="text" name="up_exts" value="<?php echo C('up_exts');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;多类型用,隔开</span>
	  
    </tr>
    <tr> 
      <td  height="48" align="right"><strong>上传文件大小限制：</strong></td>
      <td><input type="text" name="up_size" value="<?php echo C('up_size');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;Kb</span>
	  
    </tr>
	 <tr style="display:none"> 
      <td  height="48" align="right"><strong>文件存储路径：</strong></td>
      <td><input type="text" name="up_path" value="<?php echo C('up_path');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例:./data/upload</span>
    </tr> 
	<tr style="display:none"> 
      <td  height="48" align="right"><strong>微信过期提醒：</strong></td>
      <td><input type="text" name="connectnum" value="<?php echo C('connectnum');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;释：当微信请求超过或用户费用到期提示信息</span>
    </tr>
   <input type="hidden" name="files" value="upfile.php" />
    <tr> 
      <td height="48" colspan="2">
		  <div id="addkey"></div>
		  <div style="padding-left:100px;">
			<input type="submit" value="保存设置" />
		  </div>
	  </td>
    </tr>
	</form>
</table><br />
<br />
<br />

</div>
</body>
</html>