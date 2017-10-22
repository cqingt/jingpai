<?php defined('InShopNC') or exit('Access Invalid!');?>


<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>成交管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:history.go(-1);" ><span>订单列表</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>订单明细</span></a></li>
      </ul>
    </div>
  </div>


  <div class="fixed-empty"></div>


<!--   <form method="get" action="index.php" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="category" />
    <input type="hidden" name="op" value="index" />
    <table class="tb-type1 noborder search">
      <tbody>

<tr>


  <th><?php echo $lang['store_name'];?></th>
  <td><input class="txt-short" type="text" name="store_name" value="<?php echo $_GET['store_name'];?>" style="width:200px;"/></td>

  <th><label>类目选择</label></th>
  <td id="searchgc_td"></td>
  <input type="hidden" id="choose_gcid" name="choose_gcid" value="0"/>


  <th><label><?php echo $lang['order_state'];?></label></th>
  <td colspan="1">
    <select name="order_state" class="querySelect">
      <option value=""><?php echo $lang['nc_please_choose'];?></option>
      <option value="10" <?php if($_GET['order_state'] == '10'){?>selected<?php }?>><?php echo $lang['order_state_new'];?></option>
      <option value="20" <?php if($_GET['order_state'] == '20'){?>selected<?php }?>><?php echo $lang['order_state_pay'];?></option>
      <option value="30" <?php if($_GET['order_state'] == '30'){?>selected<?php }?>><?php echo $lang['order_state_send'];?></option>
      <option value="40" <?php if($_GET['order_state'] == '40'){?>selected<?php }?>><?php echo $lang['order_state_success'];?></option>
      <option value="0" <?php if($_GET['order_state'] == '0'){?>selected<?php }?>><?php echo $lang['order_state_cancel'];?></option>
    </select>
  </td>


	<th><label>店铺自营</label></th>
	<td>
	<select name="is_short">
		<option value="0" <?php if(intval($_GET['is_short']) == 0){ ?> selected <?php }?>>全部订单</option>
		<option value="1" <?php if(intval($_GET['is_short']) == 1){ ?> selected <?php }?>>自营订单</option>
		<option value="2" <?php if(intval($_GET['is_short']) == 2){ ?> selected <?php }?>>商家订单</option>
    <option value="3" <?php if(intval($_GET['is_short']) == 3){ ?> selected <?php }?>>代运营订单</option>
	</select>
	</td>
    


  <th>
    <label for="query_start_time"><?php echo $lang['order_time_from'];?></label>
  </th>

  <td>
      <input class="txt date" type="text" value="<?php echo $_GET['query_start_time'];?>" id="query_start_time" name="query_start_time">
      <label for="query_start_time">~</label>
      <input class="txt date" type="text" value="<?php echo $_GET['query_end_time'];?>" id="query_end_time" name="query_end_time"/>
  </td>

  <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>


</tr>


      </tbody>
    </table>
  </form> -->





<!--   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5><?php echo $lang['nc_prompts'];?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><?php echo $lang['order_help1'];?></li>
            <li><?php echo $lang['order_help2'];?></li>
            <li><?php echo $lang['order_help3'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table> -->


  <div style="text-align:right;"><a class="btns" target="_blank" href="index.php?act=category&op=shopCountInfo&exportExcel=1&hui=<?php echo $_GET['hui'];?>&class_type=<?php echo $_GET['class_type'];?>&store_name=<?php echo $_GET['store_name'];?>&order_state=<?php echo $_GET['order_state'];?>&is_short=<?php echo $_GET['is_short'];?>&query_start_time=<?php echo $_GET['query_start_time'];?>&query_end_time=<?php echo $_GET['query_end_time'];?>"><span><?php echo $lang['nc_export'];?>Excel</span></a></div>


  <table class="table tb-type2 nobdb">
    <thead>
      <tr class="thead">
        <th>商品名称</th>
        <!-- <th class="align-center">商品类目（二级）</th> -->
        <th class="align-center">订单号</th>
        <th class="align-center">下单时间</th>
        <th class="align-center">完成时间</th>
        <th class="align-center">订单金额</th>
        <th class="align-center">佣金</th>
        <th class="align-center">订单状态</th>
        <th class="align-center">所属店铺</th>
      </tr>
    </thead>
    <tbody>
      <?php if(count($output['order_list'])>0){?>


      <?php foreach($output['order_list'] as $order){?>
      <tr class="hover">
        <td><?php echo $order['goods_name'];?></td>
        <!-- <td class="nowrap align-center"><?php echo $output['class_list'][$order['gc_id_1']].' > '.$output['class_list'][$order['gc_id_2']];?></td> -->
        <td class="nowrap align-center"><a href="index.php?act=order&op=show_order&order_id=<?php echo $order['order_id'];?>"><?php echo $order['order_sn'];?></a></td>
        <td class="nowrap align-center"><?php echo date('Y-m-d',$order['add_time']);?></td>
        <td class="nowrap align-center"><?php echo $order['finnshed_time']?date('Y-m-d',$order['finnshed_time']):'';?></td>
        <td class="nowrap align-center"><?php echo $order['goods_pay_price'];?></td>
        <td class="nowrap align-center"><?php echo $order['goods_pay_price']*($order['commis_rate']/100);?></td>
        <td class="nowrap align-center">
          <?php 
            switch ($order['order_state']) {
              case '0':
                echo '已取消';
                break;
              case '10':
                echo '未付款';
                break;
              case '20':
                echo '已付款';
                break;
              case '30':
                echo '已发货';
                break;
              case '40':
                echo '已收货';
                break;
            }
          ?>
        </td>
        <td class="nowrap align-center"><?php echo $output['sotre_list_array'][$order['store_id']];?></td>
      </tr>
      <?php }?>



      <?php }else{?>
      <tr class="no_data">
        <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
      </tr>
      <?php }?>


    </tbody>
    <tfoot>
      <tr class="tfoot">
        <td colspan="15" id="dataFuncs"><div class="pagination"> <?php echo $output['page'];?> </div></td>
      </tr>
    </tfoot>
  </table>
</div>


<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />


<script type="text/javascript">
$(function(){
  
    // init_gcselect(<?php echo $output['gc_choose_json'];?>,<?php echo $output['gc_json']?>);

    $('#query_start_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#ncsubmit').click(function(){
    	$('input[name="op"]').val('index');$('#formSearch').submit();
    });
});
</script> 
