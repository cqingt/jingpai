<?php /* Smarty version 2.6.26, created on 2016-03-22 11:53:50
         compiled from manage/user/left.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(<?php echo $this->_tpl_vars['DIR']; ?>
images/200_bg.jpg);
	background-repeat: repeat-y;
	background-position: left;
}
img { border:none; border:0px;}
table,ul,li span{ margin:0px; padding:0px;}
li{ list-style-type:none;}
.main_l {width:200px; height:100%;  margin-bottom:10px;}
#main_lb { }
#main_lb li {width:200px; height:auto; overflow:hidden; border:none; border:0px; padding:0px;}
#main_lb li .main_box{ width:200px;  text-indent:3em; display:block; overflow:hidden;  line-height:28px;  color:#899098; font-size:12px; overflow:hidden;}
#main_lb li .main_box a{ width:200px; height:28px; text-indent:3em; display:block; overflow:hidden; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/main_box_a.jpg); margin:0px; padding:0px; line-height:28px; color:#899098; text-decoration:none; font-size:12px;}
#main_lb li .main_box a:hover,#main_lb li .main_box .here{background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/main_box_ah.jpg); color:#32444e; text-decoration:none;font-size:12px;}

.main_tit {width:200px; height:37px; display:block; overflow:hidden;}
.main_tit a{width:200px; height:37px; display:block; overflow:hidden; line-height:35px; text-indent:2.5em; font-size:14px; font-family:"微软雅黑"; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/main_lb_a.jpg); color:#7293a2; text-decoration:none;}
.main_tit a:hover{background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/main_lb_ah.jpg); color:#2e3740; }
</style>
<script src="<?php echo $this->_tpl_vars['DIR']; ?>
js/left_caidan.js" type="text/javascript"></script>
</head>

<body>

<div class="main_l">
  <div id="main_lb">
  <ul id="rolin">
  <?php $_from = $this->_tpl_vars['menuArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
      <li><span class="main_tit"><a><?php echo $this->_tpl_vars['v']['C_CateName']; ?>
</a></span>
      <div id="left" class="main_box">
      <?php $_from = $this->_tpl_vars['v']['Menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['v1']):
?>
      <a href="<?php echo $this->_tpl_vars['v1']['C_Link']; ?>
" target="main"><?php echo $this->_tpl_vars['v1']['C_CateName']; ?>
</a>
      <?php endforeach; endif; unset($_from); ?>
      </div>
      </li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  </div>
  </div>
</body>
</html>