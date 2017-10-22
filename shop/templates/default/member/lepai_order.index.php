<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form method="get" action="index.php" target="_self">
    <table class="ncm-search-table">
      <input type="hidden" name="act" value="lepai_order" />
      <input type="hidden" name= "recycle" value="<?php echo $_GET['recycle'];?>" />
      <tr>
        <td>&nbsp;</td>
        <th><?php echo $lang['member_order_state'];?></th>
        <td class="w100"><select name="state_type">
            <option value="" <?php echo $_GET['state_type']==''?'selected':''; ?>><?php echo $lang['member_order_all'];?></option>
            <option value="state_new" <?php echo $_GET['state_type']=='state_new'?'selected':''; ?>>待付款</option>
            <option value="state_pay" <?php echo $_GET['state_type']=='state_pay'?'selected':''; ?>>待发货</option>
            <option value="state_send" <?php echo $_GET['state_type']=='state_send'?'selected':''; ?>>待收货</option>
            <option value="state_success" <?php echo $_GET['state_type']=='state_success'?'selected':''; ?>>已完成</option>
            <!--<option value="state_noeval" <?php echo $_GET['state_type']=='state_noeval'?'selected':''; ?>>待评价</option>-->
            <option value="state_cancel" <?php echo $_GET['state_type']=='state_cancel'?'selected':''; ?>>已取消</option>
          </select></td>
        <th><?php echo $lang['member_order_time'];?></th>
        <td class="w240"><input type="text" class="text w70" name="query_start_date" id="query_start_date" value="<?php echo $_GET['query_start_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;<input type="text" class="text w70" name="query_end_date" id="query_end_date" value="<?php echo $_GET['query_end_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label></td>
        <th><?php echo $lang['member_order_sn'];?></th>
        <td class="w160"><input type="text" class="text w150" name="order_sn" value="<?php echo $_GET['order_sn']; ?>"></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>"/>
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table order">
    <thead>
      <tr>
        <th class="w10"></th>
        <th colspan="2">拍卖惠拍品</th>
        <th class="w100">成交价（元）</th>
        <th class="w40">数量</th>
        <!--<th class="w100">售后</th>-->
        <th class="w120">订单金额</th>
        <th class="w100">交易状态</th>
        <th class="w150">交易操作</th>
      </tr>
    </thead>
    <?php if (is_array($output['user_orders']) && !empty($output['user_orders'])) { ?>
        <?php foreach($output['user_orders'] as $k=>$v){ ?>
        <tbody order_id="" class="pay">
        <tr>
            <td colspan="19" class="sep-row"></td>
        </tr>
        <?php if($v['order_state'] == '10'){?>
        <tr>
            <td colspan="19" class="pay-td"><span class="ml15">在线支付金额：<em>￥<?php echo ($v['order_amount'] - $v['rcb_amount'] - $v['pd_amount'])?></em> <?php if($v['pd_amount'] > 0){ ?><i style="color:#53514F;font-weight: normal;padding-left: 5px">(拍品保证金抵扣<?php echo $v['pd_amount'];?>元)</i><?php } ?></span> <a class="ncm-btn ncm-btn-blue fr mr15" href="index.php?act=buy&op=lepaiOrder&order_sn=<?php echo $v['order_sn'];?>"><i class="icon-ok-circle"></i>提交/修改订单</a> <?php if($v['pay_sn'] != ''){ ?><a class="ncm-btn ncm-btn-orange fr mr15" href="index.php?act=buy&op=lepaiPay&pay_sn=<?php echo $v['pay_sn'];?>"><i class="icon-shield"></i>订单支付</a><?php } ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th colspan="19"> <span class="ml10">
          <!-- order_sn -->
          订单号：<?php echo $v['order_sn'];?>                   </span>
                <!-- order_time -->
                <span>下单时间：<?php echo date('Y-m-d H:i:s',$v['add_time']);?></span>

                <!-- store_name -->
                <span><?php echo $v['store_name'];?></span>


            </th>
        </tr>

        <!-- S 商品列表 -->
        <tr>
            <td class="bdl"></td>
            <td class="w70"><div class="ncm-goods-thumb"><a href="<?php echo urlLepai('index','auction',array('id'=>$v['lepai_goods_id']));?>" target="_blank"><img src="<?php echo BASE_SITE_URL.$v['goods_info']['G_MainImg'];?>" onmouseover="toolTip('<img src=<?php echo BASE_SITE_URL.$v['goods_info']['G_MainImg'];?>>')" onmouseout="toolTip()"></a></div></td>
            <td class="tl"><dl class="goods-name">
                    <dt><a href="<?php echo urlLepai('index','auction',array('id'=>$v['lepai_goods_id']));?>" target="_blank"><?php echo $v['goods_info']['G_Name'];?></a></dt>
                </dl></td>
            <td><?php echo $v['goods_info']['goods_amount'];?></td>
            <td>1</td>


            <!-- S 合并TD -->
            <td class="bdl" rowspan="1"><p class=""><strong><?php echo $v['order_amount'];?></strong></p>
                <p class="goods-freight">
                    (含运费<?php echo $v['shipping_fee'];?>)
                </p>
                <?php if($v['payment_code'] != ''){?><p><?php echo orderPaymentName($v['payment_code']);?></p><?php } ?></td>
            <td class="bdl" rowspan="1"><p><span style="color:#36C"><?php if($v['refund_state'] >= 1){echo '已退款';}else{echo orderState($v);}?></span> </p>

                <!-- 订单查看 -->

            <?php if($v['pay_sn'] != ''){ ?><p><a href="index.php?act=lepai_order&op=show_order&order_id=<?php echo $v['order_id']; ?>" target="_blank">订单详情</a></p><?php } ?>

                <!-- 物流跟踪 -->

            </td>
            <td class="bdl bdr" rowspan="1"><!-- 永久删除 -->

                <!-- 锁定-->


                <!-- 取消订单 -->
            <?php if ($v['order_state'] == 10) { ?>
                <p><a href="javascript:void(0)" class="ncm-btn ncm-btn-red" dialog_id="buyer_order_cancel_order" onclick="ajax_get_confirm('您确定要取消订单吗?取消后该拍品保证金不退！', 'index.php?act=lepai_order&op=order_cancel&order_id=<?php echo $v['order_id']; ?>');" ><i class="icon-ban-circle"></i> 取消订单</a></p>
            <?php } ?>

                <!-- 退款取消订单 -->

            <?php if ($v['order_state'] == 30) { ?>
                <!-- 收货 -->
                <p><a href="javascript:void(0)" class="ncm-btn" nc_type="dialog" dialog_id="buyer_order_confirm_order" dialog_width="480" dialog_title="<?php echo $lang['member_order_ensure_order'];?>" uri="index.php?act=lepai_order&op=order_receive&order_id=<?php echo $v['order_id']; ?>" id="order<?php echo $v['order_id']; ?>_action_confirm"><?php echo $lang['member_order_ensure_order'];?></a></p>
            <?php } ?>
                <!-- 评价 -->


                <!-- 已经评价 -->

            </td>
            <!-- E 合并TD -->
        </tr>

        <!-- S 赠品列表 -->

        <!-- E 赠品列表 -->

        <!-- E 商品列表 -->

        </tbody>
        <?php } ?>
        <?php } else { ?>
    <tbody>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
    </tbody>
    <?php } ?>
    <?php if (is_array($output['user_orders']) && !empty($output['user_orders'])) { ?>
    <tfoot>
      <tr>
        <td colspan="19"><div class="pagination"> <?php echo $output['show_page']; ?> </div></td>
      </tr>
    </tfoot>
    <?php } ?>
  </table>
</div>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" ></script>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" ></script>
<script type="text/javascript">
$(function(){
    $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
