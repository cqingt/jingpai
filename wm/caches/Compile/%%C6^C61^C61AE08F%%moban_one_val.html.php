<?php /* Smarty version 2.6.26, created on 2016-03-31 16:45:48
         compiled from manage/user/moban_one_val.html */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <metahttp-equivmetahttp-equiv="x-ua-compatible"content="IE=7"/> 
    <title>系统弹窗3个</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/hello.css">
    <link rel="stylesheet" href="static/css/plugin.css">
    <!--[if lt IE 9]>
      <script src="js/ie/respond.min.js"></script>
      <script src="js/ie/html5.js"></script>
    <![endif]-->
</head>
<body>



<!-- addition 2-->
<div class="col-12 text-center cmp addition">
     <section class="panelling clearfix deepen">
              <div class="text-left">
                   <p class="inf">添加模板消息</p>
              </div>
     </section>
     <section class="panelling clearfix m-t">
              <div class="text-left">

<?php if ($this->_tpl_vars['mobanArray']['V_Id']): ?>
<form id="form1"  target="_parent" action="index.php?m=manageUser&p=manage&c=setMobanVal" method="POST">
<?php else: ?>
<form id="form1"  target="_parent" action="index.php?m=manageUser&p=manage&c=addMobanVal" method="POST">
<?php endif; ?>


  <div class="form-group">
     <label class="col-lg-1 control-label">应用场景：</label>
     <div class="col-lg-8">
          <input type="text" name="V_ChangJing"  id="V_ChangJing" value="<?php echo $this->_tpl_vars['mobanArray']['V_ChangJing']; ?>
"  class="form-control parsley-validated"  required="required">
     </div>
  </div>

  
  <div class="form-group">
       <label class="col-lg-1 control-label">模板选择：</label>
       <div class="col-lg-8">

      <select id="V_MoBanName" name="V_MoBanName" class="form-control" required="required">
          
        <option value="">请选择</option>

  <?php $_from = $this->_tpl_vars['mobanStyleArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>

        <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['mobanArray']['V_MoBanId']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>

<?php endforeach; endif; unset($_from); ?>

      </select>

       </div>
  </div>


  <div class="form-group">
       <label class="col-lg-1 control-label">模板广告：</label>
       <div class="col-lg-8">

      <select id="V_Ad" name="V_Ad" class="form-control"  required="required">
          
        <option value="">请选择</option>

  <?php $_from = $this->_tpl_vars['mobanAd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>

        <option value="<?php echo $this->_tpl_vars['v']['A_Id']; ?>
" <?php if ($this->_tpl_vars['v']['A_Id'] == $this->_tpl_vars['mobanArray']['V_Ad']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']['A_Content']; ?>
</option>

<?php endforeach; endif; unset($_from); ?>

      </select>

       </div>
  </div>



  <input type="hidden" name="form_submit" value="ok"/>
  <button type="submit"  class="btn btn-ecf">提交</button>

                  </form>
              </div>

     </section>
</div>

  

  <!-- / footer -->
  <script src="static/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="static/js/bootstrap.js"></script>
</body>
</html>