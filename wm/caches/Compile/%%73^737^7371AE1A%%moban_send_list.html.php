<?php /* Smarty version 2.6.26, created on 2016-03-31 17:10:25
         compiled from manage/user/moban_send_list.html */ ?>
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


<section class="dominate padder">
  <div class="row">

    <div class="col-lg-12">
      <section class="panelling clearfix m-t-large m-b">
        <div class="text-left">
          <p class="inf">模板消息群发</p>
        </div>
      </section>
    </div>


    <div class="col-lg-12">
     <div class="pull-out pull-manage">
        <table id="MyStretchGrid" class="table table-striped datagrid">
           <thead>


            <tr>
              <th class="sortable">ID</th>
              <th class="sortable">发送时间</th>
              <th class="sortable">失败数量</th>
              <th class="sortable">模板样式</th>
              <th class="sortable">已参与活动</th>
              <th class="sortable">已购分类</th>
              <th class="sortable">已购商品</th>
              <th class="sortable">等级积分范围</th>
              <th class="sortable">发送类型</th>
              <th class="sortable">操作</th>
            </tr>


<?php $_from = $this->_tpl_vars['dataArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
            <tr>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_Id']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_Time']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_False']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_Vname']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_HuoDong']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_TypeClass']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_Goods']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_Points']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['S_MobanType']; ?>
</th>
              <th class="sortable"><a href="javascript:showFalse(<?php echo $this->_tpl_vars['v']['S_Id']; ?>
);">查看</a><a href="index.php?m=manageUser&p=manage&c=doFalseSendRecord&id=<?php echo $this->_tpl_vars['v']['S_Id']; ?>
" onclick="javascript:return sendConfirm(this);">失败重发</a></th>
            </tr>
<?php endforeach; endif; unset($_from); ?>


           </thead>
        </table>
     </div>
    </div>

 <div id="page" style="text-align:center;">
<?php echo $this->_tpl_vars['pageStr']; ?>

</div>


</section>


  <!-- / footer -->
  <script src="static/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="static/js/bootstrap.js"></script>

  <link href="static/js/asyncbox/skins/Ext/asyncbox.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<script src="static/js/asyncbox/AsyncBox.v1.4.js"></script>
<script src="static/js/common.js"></script>
<script language="javascript" type="text/javascript" src="static/js/My97DatePicker/WdatePicker.js"></script>

  <script>

  function showFalse(id){
  showPOP('index.php?m=manageUser&c=sendFalseShow&p=manage&id='+id,600,600,'失败内容');
  }




  </script>
</body>
</html>