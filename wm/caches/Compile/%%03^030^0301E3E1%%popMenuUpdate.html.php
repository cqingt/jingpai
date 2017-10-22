<?php /* Smarty version 2.6.26, created on 2016-03-28 14:31:51
         compiled from manage/user/pop/popMenuUpdate.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜单修改</title>
<link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<style type="text/css">
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 10px;
	margin-bottom: 10px;
}
</style>
<script>
$(function(){
	ajaxGetSmallMenu(<?php echo $this->_tpl_vars['dataArr']['C_Type']; ?>
,<?php echo $this->_tpl_vars['dataArr']['C_Level']; ?>
);	
})
</script>
</head>

<body>
  <form id="form1" name="form1" method="post" action="index.php?m=manageMenu&c=updateMenu&p=manage" target="main">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="table">
      <tr class="title">
        <td colspan="4">菜单修改</td>
      </tr>
      <tr class="con con_a">
        <td colspan="4" width="25%" align="left" style="text-align:left; padding-left:10px;"> 菜单名称：
          <input name="C_CateName" type="text" id="C_CateName" size="15" maxlength="10" value="<?php echo $this->_tpl_vars['dataArr']['C_CateName']; ?>
"/>
          <input name="C_ID" type="hidden" id="C_ID" value="<?php echo $this->_tpl_vars['dataArr']['C_ID']; ?>
" /></td>
      </tr>
      <tr class="con">
        <td colspan="4" align="left" style="text-align:left; padding-left:10px;"> 菜单级别：
          <select name="C_Type" id="C_Type" onchange="checkInput(this,'C_Level')">
            <option value=''>==请选择==</option> 
                <?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menuTop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menuTop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['menuTop']['iteration']++;
?>
                    <option value='<?php echo $this->_tpl_vars['k']; ?>
' <?php if ($this->_tpl_vars['dataArr']['C_Type'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']['menuName']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
          </select>
          <select name="C_Level" id="C_Level" onchange="checkInput(this,'C_Link')">
            <option value=''>一级菜单</option>
          </select>
        </td>
      </tr>
      <tr class="con con_a">
        <td colspan="4" align="left" style="text-align:left; padding-left:10px;"> 菜单地址：
          <input name="C_Link" type="txt" id="C_Link" size="40" maxlength="100" value="<?php echo $this->_tpl_vars['dataArr']['C_Link']; ?>
" <?php if ($this->_tpl_vars['dataArr']['C_Level'] == '0'): ?>disabled="disabled"<?php endif; ?>/>
        </td>
      </tr>
      <tr class="con">
        <td colspan="4" align="left" style="text-align:left; padding-left:10px;"> 菜单排序：
          <input name="C_Sort" type="txt" id="C_Sort" size="5" maxlength="2" value="<?php echo $this->_tpl_vars['dataArr']['C_Sort']; ?>
"/>
        </td>
      </tr>
      <tr class="con con_a">
        <td colspan="4" align="right">
        <input type="submit" value="提交" class="a70-26" style="margin-left:130px;margin-top:5px;margin-bottom:5px;" onclick="return checkFrom();"/>
        <input name="重置" type="reset" class="a70-26-2" style="margin-left:10px;margin-top:5px;margin-bottom:5px;" value="重置" />
        </td>
      </tr>
    </table>
  </form>
<script>
//连级检测文本域
function checkInput(obj,id){
	if($(obj).val()==''){
		$('#' + id).attr('disabled',true);	
	}else{
		$('#' + id).removeAttr('disabled');
		if(id=='C_Level'){
			ajaxGetSmallMenu($(obj).val());	
		}
	}
}

//ajax模式获取二级子菜单
function ajaxGetSmallMenu(id,tid){
	$.get("index.php?m=manageMenu&c=ajaxGetSmallMenu&p=manage&tid=" + tid + "&cid=" + id,function(option){
		$('#C_Level').html(option);
	})
}
</script>  
</body>
</html>