<?php defined('InShopNC') or exit('Access Invalid!');?>
  <form method="get" action="index.php" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="bill" />
    <input type="hidden" name="op" value="show_bill" />
    <input type="hidden" name="ob_no" value="<?php echo $_GET['ob_no'];?>" />
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
        <th><label for="add_time_from">订单类型</label></th>
          <td>
			<select name="query_type" class="querySelect">
			<option value="order" <?php if($_GET['query_type'] == 'order'){?>selected<?php }?>>实物订单列表</option>
                <option value="lepaiorder" <?php if($_GET['query_type'] == 'lepaiorder'){?>selected<?php }?>>拍卖订单列表</option>
				<option value="lepaicancelorder" <?php if($_GET['query_type'] == 'lepaicancelorder'){?>selected<?php }?>>拍卖保证金结算</option>
			<option value="refund" <?php if($_GET['query_type'] == 'refund'){?>selected<?php }?>>退单列表</option>
			<option value="cost" <?php if($_GET['query_type'] == 'cost'){?>selected<?php }?>>店铺费用</option>
			</select>
          </td>
          <th><label for="add_time_from">成交时间</label></th>
          <td><input class="txt date" type="text" value="<?php echo $_GET['query_start_date'];?>" id="query_start_date" name="query_start_date">
            <label>~</label>
            <input class="txt date" type="text" value="<?php echo $_GET['query_end_date'];?>" id="query_end_date" name="query_end_date"/></td>       
          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a></a>
          <a class="btns" href="index.php?<?php echo $_SERVER['QUERY_STRING'];?>&op=lepaicancelorder"><span><?php echo $lang['nc_exposrt'];?>导出订单明细</span></a>
            </td>
        </tr>
      </tbody>
    </table>
  </form>
<table class="table tb-type2 nobdb">
    <thead>
      <tr class="thead">
        <th class="align-center">拍卖订单编号</th>
        <th class="align-center">专场</th>
        <th class="align-center">拍品名称</th>
        <th class="align-center">结束时间</th>
        <th class="align-center">保证金金额</th>
        <th><?php echo $lang['nc_handle'];?></th>
      </tr>
    </thead>
    <tbody>
      <?php if(is_array($output['order_list']) && !empty($output['order_list'])){?>
      <?php foreach($output['order_list'] as $order_info){?>
      <tr class="hover">
        <td class="align-center"><?php echo $order_info['order_sn'];?></td>
        <td class="align-center"><?php echo $order_info['teme_name'];?></td>
        <td class="align-center"><?php echo $order_info['goods_name'];?></td>
        <td class="align-center"><?php echo date('Y-m-d',$order_info['end_time']);?></td>
        <td class="align-center"><?php echo $order_info['pd_amount'];?></td>
		 <td class="align-center">
        <a href="index.php?act=lepai&op=orderInfo&orderid=<?php echo $order_info['order_id'];?>"><?php echo $lang['nc_view'];?></a>
        </td>
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
        <td colspan="15" id="dataFuncs"><div class="pagination"> <?php echo $output['show_page'];?> </div></td>
      </tr>
    </tfoot>
  </table>
