<?php /* Smarty version 2.6.26, created on 2016-03-24 11:16:44
         compiled from manage/user/menu.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>菜单管理 - <?php echo $this->_tpl_vars['W_NAME']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
<link href="static/js/asyncbox/skins/Ext/asyncbox.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<script src="static/js/asyncbox/AsyncBox.v1.4.js"></script>
<script src="static/js/common.js"></script>
<script>
//显示默认显示菜单
<?php if ($this->_tpl_vars['tid']): ?>
$(function(){
	var obj = $('#a<?php echo $this->_tpl_vars['tid']; ?>
');
	nTabs(obj,<?php echo $this->_tpl_vars['tid']; ?>
)	;
})
<?php endif; ?>

//菜单栏目切换
function nTabs(obj,id){
	if($(obj).attr('class')=='active'){ return ;}
	$('#myTab2 li').each(function(i) {
        $('#myTab2 li:eq(' + i + ')').removeClass('active');
    });
	$(obj).addClass('active');
	$('#showContent table').hide();
	$('#myTab2_Content' + id).show();
	$('#myTab2_Content' + id + ' .con:odd').addClass('con_a');
}

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
function ajaxGetSmallMenu(id){
	$.get("index.php?m=manageMenu&c=ajaxGetSmallMenu&p=manage&cid=" + id,function(option){
		$('#C_Level').html(option);
	})
}

//文本检测
function checkFrom(){
	if($('#C_CateName').val()==''){
		alert('菜单名称不能为空!');
		return false;	
	}
	
	if($('#C_Type').val()==''){
		alert('请选择菜单一级栏目!');
		return false;
	}
	
	if($('#C_Level').val() && $('#C_Link').val()==''){
		alert('请输入菜单地址');
		return false;
	}
	return true;
}
</script>
</head>

<body>
<div class="list_main_r">
  <form id="form1" name="form1" method="post" action="index.php?m=manageMenu&c=addMenu&p=manage">
    <table class="table" width="100%" border="0" cellspacing="1" cellpadding="0">
      <tr class="title">
        <td colspan="4">菜单添加</td>
      </tr>
      <tr class="con con_a">
        <td width="25%" align="center" style="text-align:right; padding-right:10px;"> 菜单名称：
          <input name="C_CateName" type="text" id="C_CateName" size="15" maxlength="10" onchange="checkInput(this,'C_Type')"/></td>
        <td width="25%" style="text-align:left; padding-left:10px;"> 菜单级别：
          <select name="C_Type" id="C_Type" onchange="checkInput(this,'C_Level')" disabled="disabled">
            <option value=''>==请选择==</option> 
                <?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menuTop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menuTop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['menuTop']['iteration']++;
?>
                    <option value='<?php echo $this->_tpl_vars['k']; ?>
'><?php echo $this->_tpl_vars['v']['menuName']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
          </select>
          <select name="C_Level" id="C_Level" onchange="checkInput(this,'C_Link')" disabled="disabled">
          <option value=''>一级菜单</option>
          </select>
        </td>
        <td width="30%" style="text-align:left; padding-left:10px;"> 菜单地址：
          <input name="C_Link" type="txt" id="C_Link" maxlength="100" style="width:250px;" disabled="disabled"/></td>
        <td width="20%" style="padding-left:20px;"><input type="submit" value="提交" class="a70-26" style="margin-left:10px;" onclick="return checkFrom();"/>
          <input name="重置" type="reset" class="a70-26-2" style="margin-left:10px;" value="重置" /></td>
      </tr>
    </table>
  </form>
  <div class="qiehuan">
    <ul id="myTab2">
    	<?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menuTop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menuTop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['menuTop']['iteration']++;
?>
      <li class="<?php if (($this->_foreach['menuTop']['iteration'] <= 1)): ?>active<?php else: ?>normal<?php endif; ?>" onClick="nTabs(this,<?php echo $this->_tpl_vars['k']; ?>
);" id="a<?php echo $this->_tpl_vars['k']; ?>
"><a href="javascript:;"><?php echo $this->_tpl_vars['v']['menuName']; ?>
</a></li> 
		<?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<div id="showContent">
<?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['menu']['iteration']++;
?>
<table class="table" width="100%" border="0" cellspacing="1" cellpadding="0" id="myTab2_Content<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! ($this->_foreach['menu']['iteration'] <= 1)): ?>style="display:none"<?php endif; ?>>
      <tr class="title">
        <td width="5%"  style=" text-align:center;">ID</td>
        <td width="15%" style=" text-align:center;">菜单名称</td>
        <td width="50%" style=" text-align:center;">链接地址</td>
        <td width="20%" style=" text-align:center;">所属类别</td>
        <td width="10%" style=" text-align:center;">详细操作</td>
      </tr>
	<?php $_from = $this->_tpl_vars['v']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['v1']):
?>
      <tr class="con">
        <td width="5%"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v1']['C_ID']; ?>
</td>
        <td width="15%"  style="text-align:left;text-indent:1em;"><?php echo $this->_tpl_vars['v1']['C_CateName']; ?>
</td>
        <td width="50%" align="center"  style="text-indent:1em;">一级栏目</td>
        <td width="20%"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['menuName']; ?>
</td>
        <td width="10%" style="text-align:center;">
          <a href="index.php?m=manageMenu&c=delMenu&p=manage&type=<?php echo $this->_tpl_vars['v1']['C_Type']; ?>
&tid=<?php echo $this->_tpl_vars['v1']['C_ID']; ?>
" onclick="javascript:return delConfirm(this);">删除</a>
          <a href="javascript:showPOP('index.php?m=manageMenu&c=popMenuUpdate&p=manage&tid=<?php echo $this->_tpl_vars['v1']['C_ID']; ?>
',450,300,'菜单修改');">修改</a>
        </td>
      </tr>
      	<?php $_from = $this->_tpl_vars['v1']['Menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['smallMenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['smallMenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['v2']):
        $this->_foreach['smallMenu']['iteration']++;
?>
          <tr class="con">
            <td width="5%"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v2']['C_ID']; ?>
</td>
            <td width="15%"  style="text-align:left;text-indent:3em;"><?php if (($this->_foreach['smallMenu']['iteration'] == $this->_foreach['smallMenu']['total'])): ?>└<?php else: ?>├<?php endif; ?><?php echo $this->_tpl_vars['v2']['C_CateName']; ?>
</td>
            <td width="50%"  style="text-align:left;text-indent:1em;"><?php echo $this->_tpl_vars['v2']['C_Link']; ?>
</td>
            <td width="10%"  style="text-indent:1em;"><?php echo $this->_tpl_vars['v']['menuName']; ?>
</td>
            <td width="10%" style="text-align:center;">
            <a href="index.php?m=manageMenu&c=delMenu&p=manage&type=<?php echo $this->_tpl_vars['v2']['C_Type']; ?>
&tid=<?php echo $this->_tpl_vars['v2']['C_ID']; ?>
" onclick="javascript:return delConfirm(this);">删除</a>
            <a href="javascript:showPOP('index.php?m=manageMenu&c=popMenuUpdate&p=manage&tid=<?php echo $this->_tpl_vars['v2']['C_ID']; ?>
',450,300,'菜单修改');">修改</a>
            </td>
          </tr>
      	<?php endforeach; endif; unset($_from); ?>
    <?php endforeach; endif; unset($_from); ?>
</table>
<?php endforeach; endif; unset($_from); ?>
</div>
</div>
</body>
</html>