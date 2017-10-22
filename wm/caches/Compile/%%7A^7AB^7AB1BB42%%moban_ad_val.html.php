<?php /* Smarty version 2.6.26, created on 2016-03-31 14:43:44
         compiled from manage/user/moban_ad_val.html */ ?>
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
<?php if ($this->_tpl_vars['dataArr']['A_Id']): ?>
                   <p class="inf">编辑模板广告</p>
<?php else: ?>
                   <p class="inf">添加模板广告</p>
<?php endif; ?>
              </div>
     </section>
     <section class="panelling clearfix m-t">


              <div class="text-left">

<?php if ($this->_tpl_vars['dataArr']['A_Id']): ?>
<form id="form1"  target="_parent" action="index.php?m=manageUser&p=manage&c=saveAd" method="POST">
  <input type="hidden" name="V_Id" value="<?php echo $this->_tpl_vars['dataArr']['A_Id']; ?>
">
<?php else: ?>
<form id="form1"  target="_parent" action="index.php?m=manageUser&p=manage&c=addAd" method="POST">
<?php endif; ?>



    <div class="form-group">
       <label class="col-lg-1 control-label">广告内容：</label>
       <div class="col-lg-8">
            <input type="text" name="A_Content"  id="A_Content" value="<?php echo $this->_tpl_vars['dataArr']['A_Content']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated"  required="required">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">链接：</label>
       <div class="col-lg-8">
            <input type="text" name="A_Url"  id="A_Url" value="<?php echo $this->_tpl_vars['dataArr']['A_Url']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated"  required="required">
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