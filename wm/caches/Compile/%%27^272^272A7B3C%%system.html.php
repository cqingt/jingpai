<?php /* Smarty version 2.6.26, created on 2016-03-28 17:45:07
         compiled from manage/user/system.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'manage/user/system.html', 39, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>书画平台系统设置 - <?php echo $this->_tpl_vars['COMPANY']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
<link href="static/js/asyncbox/skins/Ext/asyncbox.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<script src="static/js/asyncbox/AsyncBox.v1.4.js"></script>
<script src="static/js/common.js"></script>
<script src="static/js/My97DatePicker/WdatePicker.js"></script>
</head>

<body>
<div class="list_main_r">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_title">
  <tr>
  	<td bgcolor="#ecf9ff" style="padding-top:10px;padding-bottom:10px;"><span class="title">系统配置</span></td>
  </tr>
</table>
<?php if ($this->_tpl_vars['a'] == 'list'): ?>
<table class="table" width="100%" border="0" cellspacing="1" cellpadding="0" id="myTab2_Content<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! ($this->_foreach['menu']['iteration'] <= 1)): ?>style="display:none"<?php endif; ?>>
<tr class="title">
        <td width="10%"  style=" text-align:center;">系统编号</td>
        <td width="18%" style=" text-align:center;">公司名称</td>
        <td width="12%" style=" text-align:center;">系统域名</td>
      <td width="10%" style=" text-align:center;">负责人</td>
        <td width="15%" style=" text-align:center;">联系电话</td>
        <td width="15%" style=" text-align:center;">到期时间</td>
        <td width="20%" style=" text-align:center;">操作</td>
      </tr>
<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>      
    <tr class="con">
        <td width="10%"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['W_Number']; ?>
</td>
        <td width="18%"  style="text-align:left;text-indent:1em;"><?php echo $this->_tpl_vars['v']['W_Company']; ?>
</td>
      <td width="12%" align="center"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['W_Domain']; ?>
</td>
      <td width="10%" align="center"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['W_Contact']; ?>
</td>
        <td width="15%" align="center"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['W_Mobile']; ?>
</td>
        <td width="15%"  style="text-indent:1em;"><?php if ($this->_tpl_vars['v']['W_ExpiryDate']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['v']['W_ExpiryDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
<?php else: ?>无限期<?php endif; ?></td>
        <td width="20%" style="text-align:center;">
            <a href="javascript:popMenuEditor(<?php echo $this->_tpl_vars['v']['W_Number']; ?>
);" title="菜单编辑"><img src="static/images/tag_green.png" class="manage_img"></a>
            <a href="javascript:smsConfig(<?php echo $this->_tpl_vars['v']['W_Number']; ?>
);" title="短信配置"><img src="static/images/icon/1/iphone-on.png" class="manage_img" height="16"></a>
       		<a href="index.php?m=manageSystem&p=manage&a=from&number=<?php echo $this->_tpl_vars['v']['W_Number']; ?>
" title="系统编辑"><img src="static/images/edit.png" class="manage_img"></a>
        	<a href="" title="系统删除"><img src="static/images/del.png" class="manage_img"></a>
        </td>
      </tr>
<?php endforeach; endif; unset($_from); ?>     
</table>
<?php else: ?>
<form action="index.php?m=manageSystem&c=updateSystem&p=manage" method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="number" id="number" value="<?php echo $this->_tpl_vars['dataArr']['W_Number']; ?>
"/>
  <table class="table" width="100%" border="0" cellspacing="1" cellpadding="0" id="padding">
    <tr class="con con_a">
      <td width="20%" style=" text-align:right;">网站域名：</td>
      <td colspan="2" style=" text-align:left;"><input name="W_Domain" type="text" id="W_Domain" size="25" maxlength="25" onchange="checkDomain(this.value);" value="<?php echo $this->_tpl_vars['dataArr']['W_Domain']; ?>
">
        (*请输入要绑定系统的访问域名,不带http://)</td>
    </tr>
    <tr class="con con_a">
      <td style=" text-align:right;">公司名称：</td>
      <td width="41%" style=" text-align:left;"><input name="W_Company" type="text" id="W_Company" size="30" maxlength="30" value="<?php echo $this->_tpl_vars['dataArr']['W_Company']; ?>
"></td>
      <td width="39%" rowspan="4" align="center"><img src="<?php echo $this->_tpl_vars['dataArr']['W_Logo']; ?>
" height="80"/></td>
    </tr>
    <tr class="con con_a">
      <td style=" text-align:right;">公司简称：</td>
      <td width="41%" style=" text-align:left;"><input name="W_Name" type="text" id="W_Name" size="15" maxlength="15" value="<?php echo $this->_tpl_vars['dataArr']['W_Name']; ?>
"></td>
    </tr>
	<tr class="con">
      <td style=" text-align:right;">公司LOGO：</td>
      <td style=" text-align:left;"><input type="file" name="img" id="img" />
        (*图片大小196*89透明背景png图片)</td>
      </tr>
    <tr class="con con_a">
      <td style=" text-align:right;">E-Mail：</td>
      <td colspan="2" style=" text-align:left;"><input name="W_Mail" type="text" id="W_Mail" size="20" maxlength="30" value="<?php echo $this->_tpl_vars['dataArr']['W_Mail']; ?>
"></td>
    </tr>
    <tr class="con">
      <td width="20%" style="text-align:right;">所在区域：</td>
      <td colspan="2" style="text-align:left;"><select name="W_Province" id="W_Province" onChange="getCity(this.value,0);">
        <option value="">请选择</option>
      </select>
        <select name="W_City" id="W_City">
          <option value="">请选择</option>
        </select>
        <input name="W_Adress" id="W_Adress" type="text" size="30" maxlength="30" value="<?php echo $this->_tpl_vars['dataArr']['W_Adress']; ?>
"></td>
    </tr>
	<tr class="con">
      <td width="20%" style="text-align:right;">编辑器设定：</td>
      <td colspan="2" style="text-align:left;">
      <select name="W_Edit" id="W_Edit">
      <?php $_from = $this->_tpl_vars['editArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
        <option value="<?php echo $this->_tpl_vars['v']; ?>
" <?php if ($this->_tpl_vars['v'] == $this->_tpl_vars['dataArr']['W_Edit']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
      <?php endforeach; endif; unset($_from); ?>
      </select></td>
    </tr>
	<tr class="con">
      <td width="20%" style="text-align:right;">关注回复内容：</td>
      <td colspan="2" style="text-align:left;"><textarea name="E_Content" id="E_Content" cols="45" rows="5"><?php echo $this->_tpl_vars['dataArr']['EventContent']; ?>
</textarea></td>
    </tr>
	<tr class="con">
      <td width="20%" style="text-align:right;">线上交易荣誉度：</td>
      <td colspan="2" style="text-align:left;">卖家：<input type="text" name="W_ONLineSell" value="<?php echo $this->_tpl_vars['dataArr']['W_ONLineSell']; ?>
" size = 5>%&nbsp;&nbsp;买家：<input type="text" name="W_ONLineBuy" value="<?php echo $this->_tpl_vars['dataArr']['W_ONLineBuy']; ?>
" size = 5>%
	  </td>
    </tr>

	<tr class="con">
       <td width="20%" style="text-align:right;">线下交易荣誉度：</td>
      <td colspan="2" style="text-align:left;">卖家：<input type="text" name="W_NextLineSell" value="<?php echo $this->_tpl_vars['dataArr']['W_NextLineSell']; ?>
" size = 5>&nbsp;&nbsp;&nbsp;买家：<input type="text" name="W_NexLineBuy" value="<?php echo $this->_tpl_vars['dataArr']['W_NexLineBuy']; ?>
" size = 5>
	  </td>
    </tr>

    <tr class="con">
      <td colspan="3"><div style="width:152px; margin:0 auto 0 auto;">
        <input type="submit" value="提交" class="a70-26" style="margin-top:10px; margin-bottom:10px;" onclick="return checkFrom();">
        <input type="submit" value="重置" class="a70-26-2" style="margin-left:10px; margin-top:10px; margin-bottom:10px;">
        </div></td>
    </tr>
  </table>
</form>
<?php endif; ?>
</div>
<script>
//菜单配置弹窗
function popMenuEditor(number){
	asyncbox.open({
		url : 'index.php?m=manageSystem&c=showMenu&p=manage&number=' + number,
		width : 850,
		height : 650,
		title : '功能菜单管理'
	});	
}

//短信配置弹窗
function smsConfig(number){
	asyncbox.open({
		url : 'index.php?m=manageSystem&c=showSMS&p=manage&number=' + number,
		width : 300,
		height : 240,
		title : '短信配置'
	});	
}

function tabOrder(id){
	if(id==1){
		$('#order').show();	
	}else{
		$('#order').hide();	
	}
}

function tabVer(id){
	if(id==1){
		$('#verTitle').text('验证手机：');
		$('#W_VerData').val($('#verdata1').text());
	}else{
		$('#verTitle').text('验证IP：');
		$('#W_VerData').val($('#verdata0').text());
	}
}

//表单检测
function checkFrom(){
	if($('#W_Domain').val()==''){
		alert('绑定域名不能为空!');
		return false;	
	}
<?php if (! $this->_tpl_vars['update']): ?>		
	if($('#U_UserName').val()==''){
		alert('超管账户不能为空!');
		return false;	
	}
	
	var pass = $('#U_Pass').val();
	var pass1 = $('#U_Pass1').val();
	if(pass.length<6){
		alert('密码长度不能小于6位!');
		return false;	
	}
	
	if(pass=='' || pass1==''){
		alert('请正确输入超管账户密码!');
		return false;
	}else if(pass!=pass1){
		alert('你设置的超管登陆密码不一致，请检查后重新输入!');
		return false;	
	}
<?php endif; ?>
	
	if($('#W_Company').val()==''){
		alert('公司名称不能为空!');
		return false;
	}
	
	var contact = $('#W_Contact').val();
	if( contact=='' ){
		alert('联系人不能为空!');
		return false;
	}
	if( !checkChinese(contact) ){
		alert('联系人必须为中文');	
		return false;
	}
	
	if($('#W_Mobile').val()==''){
		alert('联系人电话不能为空!');
		return false;
	}

	var mail = $('#W_Mail').val();
	if(mail==''){
		alert('电子邮件不能为空!');
		return false;
	}	
	if( !checkMail(mail) ){
		alert('电子邮件格式不正确!');
		return false;
	}
	
	if($('#W_Province').val()=='' || $('#W_City').val()=='' || $('#W_Adress').val()==''){
		alert('区域信息不完整!');
		return false;
	}

	if($('#W_VerData').val()==''){
		alert('验证数据不能为空!');
		return false;
	}
	return true;	
}

//域名重复检测
function checkDomain(value){
	if(value==''){
		$('.a70-26').attr('disabled',true);
		return false;
	}else{
		if(!verDomain(value)){
			alert('绑定域名不合法!');
			$('.a70-26').attr('disabled',true);
			return false;		
		}
	}
	var value = value.replace('http://','');
	$('#W_Domain').val(value);//替换掉http://
	$.post('index.php?m=inspection&c=checkDomain&p=action',{domain : value},function(status){
		status = parseInt(status);
		if(status){
			alert('域名已存在!');
			$('.a70-26').attr('disabled',true);
		}else{
			$('.a70-26').removeAttr('disabled');	
		}
	});	
}

function getCity(rid,sid){
	$.get('index.php?m=areaAction&c=showOptionStr&p=action&rid=' + rid + "&sid=" + sid,function(str){
		$('#W_City').html('<option value="">请选择</option>' + str);	
	});
}

function getProvince(rid,sid){
	$.get('index.php?m=areaAction&c=showOptionStr&p=action&rid=' + rid + "&sid=" + sid,function(str){
		$('#W_Province').html('<option value="">请选择</option>' + str);	
	});
}

$(function(){
	getProvince(1,'<?php echo $this->_tpl_vars['dataArr']['W_Province']; ?>
');
	<?php if ($this->_tpl_vars['update']): ?>
	getCity(<?php echo $this->_tpl_vars['dataArr']['W_Province']; ?>
,<?php echo $this->_tpl_vars['dataArr']['W_City']; ?>
);
	<?php endif; ?>
})
</script>
</body>
</html>