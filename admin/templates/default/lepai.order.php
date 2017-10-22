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
        <li><a href="JavaScript:void(0);" class="current" ><span>订单管理</span></a></li>

      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form  id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="order">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <td><input type="text" value="" name="search" id="search" class="txt" placeholder='订单编号、拍品名称'></td>
        <td>
          <select name="s_one" id="">
            <option value="">请选择</option>
            <option value="1">订单编号</option>
            <option value="2">拍品名称</option>
          </select>
        </td>
        <td>
          <select name="s_two" id="">
            <option value="">请选择</option>
            <?php foreach(C('lepai_order_type') as $k=>$v){?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select>
        </td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>




    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">订单号</th>
          <th class="align-center">商名名称</th>
          <th class="align-center">店铺名称</th>
          <th class="align-center">专场名称</th>
          <th class="align-center">买家名称</th>
          <th class="align-center">成交时间</th>
          <th class="align-center">订单金额</th>
          <th class="align-center">支付方式</th>
          <th class="align-center">订单状态</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

        <?php foreach ($output['result_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['order_sn'];?></td>
          <td class="align-center"><?php echo $v['G_Name'];?></td>
          <td class="align-center"><?php echo $v['store_member_name'];?></td>
          <td class="align-center"><?php echo $v['theme_name'];?></td>
          <td class="align-center"><?php echo $v['buyer_name'];?></td>
          <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['add_time']);?></td>
          <td class="align-center"><?php echo $v['order_amount'];?></td>
          <td class="align-center"><?php echo orderPaymentName($v['A_OrderBy']);?></td>
          <td class="align-center">
            <?php if($v['order_state'] == '0'){?>已取消<?php }?>
            <?php if($v['order_state'] == '10'){?>未付款<?php }?>
            <?php if($v['order_state'] == '20'){?>已付款<?php }?>
            <?php if($v['order_state'] == '30'){?>已发货<?php }?>
            <?php if($v['order_state'] == '40'){?>已收货<?php }?>
          </td>
          <td class="align-center"><a href="index.php?act=lepai&op=orderInfo&orderid=<?php echo $v['order_id'];?>">查看</a></td>
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
</script>
