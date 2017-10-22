<?php /* Smarty version 2.6.26, created on 2016-03-22 11:53:49
         compiled from manage/user/index.html */ ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['COMPANY']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<script src="static/js/common.js"></script>
</head>

<body scroll="no">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" height="91">
    <table width="100%" height="91" border="0" cellspacing="0" cellpadding="0" class="top">
  <tr>
    <td width="196"><img src="<?php echo $this->_tpl_vars['LOGO']; ?>
" width="196" height="89"></a></td>
    <td>
    <div class="top_b">
    <div class="top_bl">
    <ul>
<?php $_from = $this->_tpl_vars['configMenuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['foo']['iteration']++;
?>
    <li id="m<?php echo $this->_tpl_vars['k']; ?>
"><a href="index.php?m=manageIndex&c=getFram&p=manage&t=left&LID=<?php echo $this->_tpl_vars['k']; ?>
" target="left" <?php if (($this->_foreach['foo']['iteration'] <= 1)): ?>class="here"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</a></li>               
<?php endforeach; endif; unset($_from); ?>    
    </ul>
    <div style="clear:both"></div>
    </div>
    <!-- <div class="top_br">
    <div class="top_bra">
    <ul>
    <li class="a1"><?php echo $this->_tpl_vars['userArr']['U_Name']; ?>
</li>
    <li class="a2"><span>部门:</span><?php echo $this->_tpl_vars['userArr']['DepName']; ?>
</li>
    <li class="a3"><span>职位:</span><?php echo $this->_tpl_vars['userArr']['Postion']; ?>
</li>
    </ul>
    </div>
    </div> -->
    </div>
    
    <div class="top_c">
    <div class="top_cl"><span>您的位置:</span><a href="#">控制台</a> > 欢迎页面</div>
    <div class="top_cr">
    <ul>
    <li class="a1"><a href="index.php?m=login&c=logout&p=manage">退出管理</a></li>
    <li class="a2"><a href="index.php?m=manageIndex&p=manage">返回首页</a></li>
    <li class="a3">
	<script type="text/javascript">var now=new Date();</script>
</li>
    </ul>
    </div>
    </div>
    </td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td width="200px" height="100%" valign="top">
<iframe height="100%" width="200" src="index.php?m=manageIndex&c=getFram&p=manage&t=left" border="0" frameborder="0" scrolling="no" name="left"></iframe></td>

<td valign="top" height="100%" align="left">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div id="layout" style="position: absolute; width:100%; height:100%; background:rgba(255,255, 255, 0.8) none repeat scroll 0 0 !important;
filter:Alpha(opacity=80); background:#fff; top:0px; left:0px;display:none"><img src="static/images/laod_wait.gif" style="padding-left:42%;padding-top:20%"/></div>
    <iframe height="100%" style="width:100%;" src="index.php?m=manageIndex&c=getFram&p=manage&t=main" border="0" frameborder="0" scrolling="yes" name="main" id="main"></iframe>
    </td>
  </tr>
</table>


</td>
  </tr>
</table>
<script>
$(function(){
	$(".top_bl a").click(function(){
		$(".top_bl a").removeClass("here");
		$(this).addClass("here");
	})	
	
})
</script>
</body>
</html>