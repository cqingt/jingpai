<?php /* Smarty version 2.6.26, created on 2016-03-28 14:16:28
         compiled from manage/user/moban_send_record.html */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <metahttp-equivmetahttp-equiv="x-ua-compatible"content="IE=7"/> 
    <title>模板消息发送列表</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/hello.css">
    <link rel="stylesheet" href="static/css/plugin.css">
    <!--[if lt IE 9]>
      <script src="js/ie/respond.min.js"></script>
      <script src="js/ie/html5.js"></script>
    <![endif]-->
</head>
<body>


<!-- addition -->
<div class="col-12 text-center cmp">
     <section class="panelling clearfix deepen">
              <div class="text-left">
                   <p class="inf">发送记录</p>
              </div>
     </section>
     <section class="panelling clearfix m-t no-broder-b">
              <div class="text-left">
                   <p class="col-6">发送时间：<?php echo $this->_tpl_vars['result']['S_Time']; ?>
</p>
                   <p class="col-3">发送数量：<?php echo $this->_tpl_vars['result']['S_Ture']; ?>
</p>
                   <p class="col-3">失败数量：<?php echo $this->_tpl_vars['result']['S_False']; ?>
</p>
              </div>
     </section>
     <section class="panelling clearfix color-bf">
              <div class="text-left">
                   <p>发送内容</p>
                   <?php if ($this->_tpl_vars['result']['S_MobanType'] == 'moban'): ?>

                   <?php $_from = $this->_tpl_vars['result']['S_Remark']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>

                   <h5><?php echo $this->_tpl_vars['k']; ?>
：<?php echo $this->_tpl_vars['v']; ?>
</h5>

                   <?php endforeach; endif; unset($_from); ?>


                   
                   <?php else: ?>
<h5><?php echo $this->_tpl_vars['result']['S_Remark']; ?>
</h5>
                   <?php endif; ?>
              </div>
     </section>
</div>


  <!-- / footer -->
  <script src="static/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="static/js/bootstrap.js"></script>

</body>
</html>