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
        <li><a href="<?php echo urlAdmin('lepai', 'songpai');?>" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>退货管理</span></a></li>

      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="tuihuo">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <td><input type="text" value="<?php echo $_GET['search'];?>" name="search" id="search" class="txt"></td>
        <td>
          <select name="s_one" id="">
            <option value="">请选择</option>
            <?php foreach($output['lepai_class'] as $k=>$v){?>
            <option value="<?php echo $v['C_Id'];?>" <?php if($_GET['s_one'] == $v['C_Id']){echo 'selected=\'selected\'';}?>><?php echo $v['C_Name'];?></option>
            <?php }?>
          </select>
        </td>


        <td>
          <select name="s_order_state" id="">
            <option value="">订单状态</option>
            <option value="30" <?php if($_GET['s_order_state'] == 30){echo 'selected=\'selected\'';}?>>已发货</option>
            <option value="40" <?php if($_GET['s_order_state'] == 40){echo 'selected=\'selected\'';}?>>已完成</option>
            <option value="2" <?php if($_GET['s_order_state'] == 2){echo 'selected=\'selected\'';}?>>已退款</option>
          </select>
        </td>

        <!-- <td>
          <select name="s_two" id="">
            <option value="">请选择</option>
            <?php foreach(C('lepai_goodstype') as $k=>$v){?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select>
        </td>

        <td>
          <select name="s_theme" id="">
            <option value="">请选择专场</option>
            <?php foreach($output['theme'] as $k=>$v){?>
            <option value="<?php echo $v['T_Id'];?>"><?php echo $v['T_Title'];?></option>
            <?php }?>
          </select>
        </td>

        <td>
          <select name="s_store" id="">
            <option value="">请选择店铺</option>
            <?php foreach($output['store'] as $k=>$v){?>
            <option value="<?php echo $v['member_id'];?>"><?php echo $v['store_name'];?></option>
            <?php }?>
          </select>
        </td> -->

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
          <!-- <th class="w24">ID</th> -->
          <th class="align-center">订单号</th>
          <th class="align-center">商品名称</th>
          <th class="align-center">店铺名称</th>
          <th class="align-center">专场名称</th>
          <th class="align-center">买家</th>
          <th class="align-center">成交时间</th>
          <th class="align-center">订单金额</th>
          <th class="align-center">支付方式</th>
          <th class="align-center">订单状态</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['order_list']) && is_array($output['order_list'])) { ?>

        <?php foreach ($output['order_list'] as $k => $v) {?>
        <tr class="hover edit">
          <!-- <td class="align-center"><?php echo $v['order_id'];?></td> -->
          <td class="align-center"><?php echo $v['order_sn'];?></td>
          <td class="align-center"><?php echo $v['G_Name'];?></td>
          <td class="align-center"><?php echo $v['company_name'];?></td>
          <td class="align-center"><?php echo $v['theme_name'];?></td>
          <td class="align-center"><?php echo $v['buyer_name'];?></td>
          <td class="align-center"><?php echo date('Y-m-d',$v['add_time']);?></td>
          <td class="align-center"><?php echo $v['order_amount'];?></td>
          <td class="align-center"><?php echo orderPaymentName($v['payment_code']);?></td>
          <td class="align-center"><?php if($v['order_state'] == 30){echo '已发货';}elseif($v['order_state'] == 40){echo '已完成';}elseif($v['refund_state'] >= 1){echo '已退款';}?></td>
          <td class="align-center">
            <?php if($v['order_state'] == 0 && ($v['refund_state'] == 1 || $v['refund_state'] == 2)){?>
              <span>已退款</span>
            <?php }else{?>
              <input type="text" id="tui_money_<?php echo $v['order_id'];?>" style="width:50px;"><input type="button" onclick="tuikuan(<?php echo $v['order_id'];?>)" value="退款">
            <?php }?>
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


      <tfoot>
        <tr class="tfoot">
          
          <td colspan="16">
            <div class="pagination"> <?php echo $output['page'];?> </div></td>

        </tr>
      </tfoot>
    </table>
  </form>
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

function delGoods(id){
  if(confirm("确定要删除该商品吗？")){
    window.location.href="index.php?act=lepai&op=delGoods&goodsid=" + id;
  }
}


function tuikuan(id){
  var money = $("#tui_money_" + id).val();

  if(!!!id || !!!money){
    alert('数据异常、重新选择！');
    return;
  }

  if(confirm("确定要删除该商品吗？")){
    $.post("index.php?act=lepai&op=doTuikuan",{'order_id':id,'refund_money':money},function(data){

      if(data.error == true){
        alert(data.msg);
      }else{
        alert(data.msg);
      }
      // console.log(data);
    },'json');
  }
}
</script>
