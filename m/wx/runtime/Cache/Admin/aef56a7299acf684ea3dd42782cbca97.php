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
<div id="artlist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">
 <form id="myform" action="<?php echo U('Site/insert');?>" method="post">

    <tr> 
      <td  height="48" align="right"><strong>表单令牌：</strong></td>
      <td><input type="radio" name="TOKEN_ON" value="true" <?php if(C('TOKEN_ON')==='true') echo checked; ?> />开启
		  <input type="radio" name="TOKEN_ON" value="false" <?php if(C('TOKEN_ON')==='false') echo checked; ?> />关闭
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>令牌验证字段名：</strong></td>
      <td><input type="text" name="TOKEN_NAME" value="<?php echo C('TOKEN_NAME');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;一般不超过80个字符</span>
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>令牌验证加密：</strong></td>
      <td><input type="text" name="TOKEN_TYPE" value="<?php echo C('TOKEN_TYPE');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例:md5</span></td>
    </tr> 
	<tr> 
      <td  height="48" align="right"><strong>令牌错误重置：</strong></td>
      <td><input type="radio" name="TOKEN_RESET" value="true" <?php if(C('TOKEN_RESET')==='true') echo checked; ?> />开启
		  <input type="radio" name="TOKEN_RESET" value="false" <?php if(C('TOKEN_RESET')==='false') echo checked; ?> />关闭
		  </td>
    </tr>
	<tr> 
      <td height="48" align="right"><strong>字段验证：</strong></td>
      <td><input type="radio" name="DB_FIELDTYPE_CHECK" value="true" <?php if(C('DB_FIELDTYPE_CHECK')==='true') echo checked; ?> />开启
		  <input type="radio" name="DB_FIELDTYPE_CHECK" value="false" <?php if(C('DB_FIELDTYPE_CHECK')==='false') echo checked; ?> />关闭
		  </td>
    </tr>
	<tr> 
      <td  height="48" align="right"><strong>参数过滤：</strong></td>
      <td><input type="text" name="VAR_FILTERS" value="<?php echo C('VAR_FILTERS');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例如:trim</span>
    </tr>
	<input type="hidden" name="files" value="safe.php" />
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