<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>乐拍管理</h3>
      <ul class="tab-base">

		<li><a href="<?php echo urlAdmin('lepai', 'index');?>"><span>用户管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'adduser');?>"><span>用户添加</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>

      </ul>
    </div>
  </div>




  <div class="fixed-empty"></div>
  <!-- <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="index">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <th><label for="search_store_name">用户名称</label></th>
        <td><input type="text" value="" name="search" id="search" class="txt"></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form> -->




  <form method='POST' id="form_goods" action="<?php echo urlAdmin('artist', 'del_artist');?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">送拍类型</th>
          <th class="align-center">价格区间</th>
          <th class="align-center">卖家姓名</th>
          <th class="align-center">卖家电话</th>
          <th class="align-center">所在地区</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

        <?php foreach ($output['result_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['I_Id'];?></td>
          <td class="align-center"><?php echo $v['I_Class'];?></td>
          <td class="align-center"><?php echo $v['I_Money'];?></td>
          <td class="align-center"><?php echo $v['I_Name'];?></td>
          <td class="align-center"><?php echo $v['I_Phone'];?></td>
          <td class="align-center"><?php echo $v['I_Dizhi'];?></td>
        
          <td class="align-center"><a href="index.php?act=lepai&op=getSongpaiInfo&iid=<?php echo $v['I_Id'];?>">查看</a>
          </td>
        </tr>
        <tr style="display:none;">
          <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>


      
    </table>
  </form>

<tfoot>
        <tr class="tfoot">
          
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
  
</div>



<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
$(function (){

  $("#ncsubmit").click(function (){
      $("#form1").submit();
  });

})
function userType(val,id){
  if(confirm("确定要进行此操作吗？")){
  window.location.href="index.php?act=lepai&op=onLepai&type=" + val + "&id=" + id;
  }
}
</script>
