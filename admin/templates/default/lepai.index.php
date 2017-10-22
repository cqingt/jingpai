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
        <li><a href="JavaScript:void(0);" class="current"><span>用户管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'adduser');?>" ><span>用户添加</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'songpai');?>" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'tuihuo');?>" ><span>退货管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'focus_edit');?>" ><span>幻灯片</span></a></li>

      </ul>
    </div>
  </div>




  <div class="fixed-empty"></div>
  <form id="form1" method="get" name="formSearch" id="formSearch">
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
  </form>




  <form method='POST' id="form_goods" action="<?php echo urlAdmin('artist', 'del_artist');?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">店铺名称</th>
          <th class="align-center">拍卖帐号</th>
          <th class="align-center">拍品总数</th>
          <th class="align-center">累计拍卖数</th>
          <th class="align-center">累计成交额</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

        <?php foreach ($output['result_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['member_id'];?></td>
          <td class="align-center"><?php if($v['company_name']){echo $v['company_name'];}else{echo $v['member_name'];}?></td>
          <td class="align-center"><?php echo $v['member_name'];?></td>
          <td class="align-center"><?php echo $v['U_Sum'];?></td>
          <td class="align-center"><?php echo $v['U_GoodsSum'];?></td>
          <td class="align-center"><?php echo $v['U_MoneySum'];?></td>
          <td class="align-center"><?php if($v['is_audit'] == '0'){?><a href="javascript:userType(1,<?php echo $v['member_id'];?>);">允许拍卖</a><?php }else{?><a href="javascript:userType(0,<?php echo $v['member_id'];?>);">禁止拍卖</a><?php }?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?act=lepai&op=adduser&themeid=<?php echo $v['member_id'];?>">编辑</a>
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
