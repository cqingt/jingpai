<?php /* Smarty version 2.6.26, created on 2016-03-31 16:38:24
         compiled from manage/user/moban_list.html */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <metahttp-equivmetahttp-equiv="x-ua-compatible"content="IE=7"/> 
    <title>固定模板</title>
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
          <p class="inf">固定模板消息</p><p class="f-r inf" onclick="showOrder();">添加模板</p>
        </div>
     </section>



    <div class="col-lg-12">
       <div class="pull-out pull-manage">
          <table id="MyStretchGrid" class="table table-striped datagrid">
           <thead>
            <tr>
              <th class="sortable">ID</th>
              <th class="sortable">应用场景</th>
              <th class="sortable">调用次数</th>
              <th class="sortable">模板名称</th>
              <th class="sortable">广告内容</th>
              <th class="sortable">跳转链接</th>
              <th class="sortable">调用接口</th>
              <th class="sortable">操作</th>
            </tr>


<?php $_from = $this->_tpl_vars['mobanArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>

            <tr>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['V_Id']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['V_ChangJing']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['V_Click']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['V_MoBanName']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['A_Content']; ?>
</th>
              <th class="sortable"><?php echo $this->_tpl_vars['v']['A_Url']; ?>
</th>
              <th class="sortable">http://www.96567.com/wm/index.php?m=getMobanInfo&p=action&c=getOneMobanInfo&id=<?php echo $this->_tpl_vars['v']['V_Id']; ?>
</th>
              <th class="sortable"><a href="javascript:showOrder(<?php echo $this->_tpl_vars['v']['V_Id']; ?>
);">编辑</a><a href="index.php?m=manageUser&p=manage&c=delMoBan&id=<?php echo $this->_tpl_vars['v']['V_Id']; ?>
">删除</a></th>
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

function showOrder(id){
  if(id){
showPOP('index.php?m=manageUser&c=setMobanVal&p=manage&id='+id,600,300,'编辑模板');
  }else{
showPOP('index.php?m=manageUser&c=addMobanVal&p=manage',600,300,'添加模板');
  }
}


  </script>
</body>
</html>