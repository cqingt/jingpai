<?php defined('InShopNC') or exit('Access Invalid!');?>
<style>
  .xcConfirm {
  background: #fff;
  display: none;
  position: fixed;
  top: 30%;
  left: 50%;
  border: 1px #ccc solid;
  width: 520px;
  text-align: center;
  margin-left: -260px;
  padding-bottom: 20px;
  z-index: 1701;
}
.xcConfirm .top {
  border-bottom: 1px #eee solid;
  overflow: hidden;
  height: 40px;
}
.xcConfirm h2 {
  float: left;
  font-size: 14px;
  line-height: 40px;
  margin-left: 20px;
  color: #666;
}
.xcConfirm .close {
  float: right;  
  margin-top: 8px;
  margin-right: 16px;  
}
.xcConfirm p {
  clear: both;
  color: #666;
  font-size: 14px;
  margin: 20px 0 16px;
}
.xcConfirm input.btn {
  display:inline-block;*display:inline; *zoom:1;
  width: 84px;
  height: 28px;
  border: 1px #d2d2d2 solid;
  text-decoration: none;
  margin: 0 8px;
  font-size: 14px;
}
.xcConfirm .cancel {
  background: #f5f5f5;
  color: #666;
}
.xcConfirm .go-on {
  background: #5bb75b;
  border: 1px #5bb75b solid;
  color: #fff;
}
.tijiaoaddClass{
	position: absolute; z-index: 1700; top: 0px; left: 0px; width: 100%; height: 1567px; opacity: 0; background-color: transparent;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form method="get" action="index.php" target="_self">
    <table class="ncm-search-table">
      <input type="hidden" name="act" value="member_order" />
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
            <option value="state_noeval" <?php echo $_GET['state_type']=='state_noeval'?'selected':''; ?>>待评价</option>
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
        <th colspan="2">商品</th>
        <th class="w100">单价（元）</th>
        <th class="w40">数量</th>
        <th class="w100">售后</th>
        <th class="w120">订单金额</th>
        <th class="w100">交易状态</th>
        <th class="w150">交易操作</th>
      </tr>
    </thead>
    <?php if (is_array($output['order_group_list']) && !empty($output['order_group_list'])) { ?>
    <?php foreach ($output['order_group_list'] as $order_pay_sn => $group_info) { ?>
    <?php $p = 0;?>
    <tbody order_id="" <?php if (!empty($group_info['pay_amount']) && $p == 0) {?> class="pay" <?php }?>>
      <?php foreach($group_info['order_list'] as $order_id => $order_info) {?>
      <?php if (empty($group_info['pay_amount'])) {?>
      <tr>
        <td colspan="19" class="sep-row"></td>
      </tr>
      <?php }?>
      <?php if (!empty($group_info['pay_amount']) && $p == 0) {?>
      <tr>
        <td colspan="19" class="sep-row"></td>
      </tr>
      <tr>
        <td colspan="19" class="pay-td"><span class="ml15">在线支付金额：<em>￥<?php echo ncPriceFormat($group_info['pay_amount']);?></em></span> <a class="ncm-btn ncm-btn-orange fr mr15" href="index.php?act=buy&op=pay&pay_sn=<?php echo $order_pay_sn; ?>"><i class="icon-shield"></i>订单支付</a></td>
      </tr>
      <?php }?>
      <?php $p++;?>
      <tr>
        <th colspan="19"> <span class="ml10">
          <!-- order_sn -->
          <?php echo $lang['member_order_sn'].$lang['nc_colon'];?><?php echo $order_info['order_sn']; ?>
          <?php if ($order_info['order_from'] == 2){?>
          <i class="icon-mobile-phone"></i>
          <?php }?>
          </span>
          <!-- order_time -->
          <span><?php echo $lang['member_order_time'].$lang['nc_colon'];?><?php echo date("Y-m-d H:i:s",$order_info['add_time']); ?></span>

          <!-- store_name -->
          <span><a href="<?php echo urlShop('show_store','index',array('store_id'=>$order_info['store_id']), $order_info['extend_store']['store_domain']);?>" title="<?php echo $order_info['store_name'];?>"><?php echo $order_info['store_name']; ?></a></span>

          <span member_id="<?php echo $order_info['extend_store']['member_id'];?>">
		  <a style="float: left;display: block;background: url(/shop/templates/default/images/icon-chat.png)no-repeat;width: 16px;height: 14px;margin: 3px 0 0 8px;" href="javascript:void(0);" title="在线联系" <?php if(in_array($order_info['store_id'], model('store')->getOwnShopIds())){?>onclick="NTKF.im_openInPageChat('sc_1000_9999')"
		<?php }else{ ?>onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($order_info['store_id']);?>_9999')"
		<?php } ?>></a>
<!--
QQ 
          <?php if(!empty($order_info['extend_store']['store_qq'])){?>
          <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $order_info['extend_store']['store_qq'];?>&site=qq&menu=yes" title="QQ: <?php echo $order_info['extend_store']['store_qq'];?>"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $order_info['extend_store']['store_qq'];?>:52" style=" vertical-align: middle;"/></a>
          <?php }?>

           wang wang 
          <?php if(!empty($order_info['extend_store']['store_ww'])){?>
          <a target="_blank" href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo $order_info['extend_store']['store_ww'];?>&site=cntaobao&s=2&charset=<?php echo CHARSET;?>"  class="vm" ><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $order_info['extend_store']['store_ww'];?>&site=cntaobao&s=2&charset=<?php echo CHARSET;?>" alt="Wang Wang"  style=" vertical-align: middle;"/></a>
          <?php }?>
		  -->
          </span> <a href="javascript:void(0)" class="share-goods" nc_type="sharegoods" data-param='{"gid":"<?php echo $order_info['goods_list'][0]['goods_id'];?>"}'><i class="icon-share"></i><?php echo $lang['member_order_snsshare'];?></a>

          <!-- 放入回收站 

          <?php if ($order_info['if_delete']) { ?>
          <a href="javascript:void(0);" class="order-trash" onclick="ajax_get_confirm('您确定要删除吗?删除后该订单可以在回收站找回，或彻底删除', 'index.php?act=member_order&op=change_state&state_type=order_delete&order_id=<?php echo $order_info['order_id']; ?>');"><i class="icon-trash"></i>删除</a>
          <?php } ?>
-->
          <!-- 还原订单 -->

          <?php if ($order_info['if_restore']) { ?>
          <a href="javascript:void(0);" class="order-trash" onclick="ajax_get_confirm('您确定要还原吗?', 'index.php?act=member_order&op=change_state&state_type=order_restore&order_id=<?php echo $order_info['order_id']; ?>');"><i class="icon-refresh"></i>还原</a>
          <?php } ?>
        </th>
      </tr>

      <!-- S 商品列表 -->
      <?php $i = 0;?>
            <?php if (is_array($order_info['goods_list']) && !empty($order_info['goods_list'])) { ?>
      <?php foreach ($order_info['goods_list'] as $k => $goods_info) {?>
      <?php $i++;?>
      <tr>
        <td class="bdl"></td>
        <td class="w70"><div class="ncm-goods-thumb"><a href="<?php echo $goods_info['goods_url'];?>" target="_blank"><img src="<?php echo $goods_info['image_60_url'];?>" onMouseOver="toolTip('<img src=<?php echo $goods_info['image_240_url'];?>>')" onMouseOut="toolTip()"/></a></div></td>
        <td class="tl"><dl class="goods-name">
            <dt><a href="<?php echo $goods_info['goods_url'];?>" target="_blank"><?php echo $goods_info['goods_name']; ?></a></dt>
            <?php if (!empty($goods_info['goods_type_cn'])) { ?>
            <dd><span class="sale-type"><?php echo $goods_info['goods_type_cn'];?></span></dd>
            <?php } ?>
          </dl></td>
        <td><?php echo $goods_info['goods_price'];?></td>
        <td><?php echo $goods_info['goods_num']; ?></td>
        <td><!-- 退款 -->

          <?php if ($goods_info['refund'] == 1){?>
			<?php if($order_info['order_state'] < 40){ ?>
				<!--<p><a href="javascript:void(0);" onclick="get_confirm('确认系统将自动为您的整张订单确认收货，否则请取消申请！', 'index.php?act=member_refund&op=add_refund&order_id=<?php echo $order_info['order_id']; ?>&goods_id=<?php echo $goods_info['rec_id']; ?>');">退款/退货</a></p>
				-->
				<p><a href="javascript:void(0);" id="btn1">退款/退货</a></p>
				<!-- 点击弹出框 -->
					  <div class="xcConfirm" id="sub_form_1">
							<div class="top">
							  <h2>提示信息</h2>
							  <a class="close" href="javascript:;">X</a>     
							</div>             
							<p>点击继续申请，系统将自动为您的整张订单确认收货，否则请取消申请</p>
							<input class="btn go-on" type="button" id="JiXuTiJiao" value="继续申请" style="padding: 0px;font-weight:normal;cursor:pointer;" JiXuUrl="index.php?act=member_refund&op=add_refund&order_id=<?php echo $order_info['order_id']; ?>&goods_id=<?php echo $goods_info['rec_id']; ?>">
							<input class="btn cancel" type="button" value="取消申请" style="cursor:pointer; ">
					  </div>
					<div id="fwin_dialog_cover"></div>
				<!-- End -->
			<?php }else{ ?>
				<p><a href="index.php?act=member_refund&op=add_refund&order_id=<?php echo $order_info['order_id']; ?>&goods_id=<?php echo $goods_info['rec_id']; ?>">退款/退货</a></p>
			 <?php } ?>
          <?php }?>

          <!-- 投诉 -->

          <?php if ($order_info['if_complain']){ ?>
          <p><a href="index.php?act=member_complain&op=complain_new&order_id=<?php echo $order_info['order_id']; ?>&goods_id=<?php echo $goods_info['rec_id']; ?>">交易投诉</a></p>
          <?php } ?></td>

        <!-- S 合并TD -->
        <?php if (($order_info['goods_count'] > 1 && $k ==0) || ($order_info['goods_count'] == 1)){?>
        <td class="bdl" rowspan="<?php echo $order_info['goods_count'];?>"><p class=""><strong><?php echo $order_info['order_amount']; ?></strong></p>
          <p class="goods-freight">
            <?php if ($order_info['shipping_fee'] > 0){?>
            (<?php echo $lang['member_order_shipping_han'];?>运费<?php echo $order_info['shipping_fee'];?>)
            <?php }else{?>
            <?php echo $lang['nc_common_shipping_free'];?>
            <?php }?>
          </p>
          <p title="<?php echo $lang['member_order_pay_method'].$lang['nc_colon'];?><?php echo $order_info['payment_name']; ?>"><?php echo $order_info['payment_name']; ?></p></td>
        <td class="bdl" rowspan="<?php echo $order_info['goods_count'];?>"><p><?php echo $order_info['state_desc']; ?> <?php echo $order_info['evaluation_status'] ? $lang['member_order_evaluated'] : '';?></p>

          <!-- 订单查看 -->

          <p><a href="index.php?act=member_order&op=show_order&order_id=<?php echo $order_info['order_id']; ?>" target="_blank"><?php echo $lang['member_order_view_order'];?></a></p>

          <!-- 物流跟踪 -->

          <?php if ($order_info['if_deliver']){ ?>
          <p><a href='index.php?act=member_order&op=search_deliver&order_id=<?php echo $order_info['order_id']; ?>&order_sn=<?php echo $order_info['order_sn']; ?>' target="_blank"><?php echo $lang['member_order_show_deliver']?></a></p>
          <?php } ?></td>
        <td class="bdl bdr" rowspan="<?php echo $order_info['goods_count'];?>"><!-- 永久删除 -->

          <!-- 锁定-->

          <?php if ($order_info['if_lock']) { ?>
          <p>退款退货中</p>
          <?php } ?>

          <!-- 取消订单 -->

          <?php if ($order_info['if_cancel']) { ?>
          <p><a href="javascript:void(0)" class="ncm-btn ncm-btn-red" nc_type="dialog" dialog_width="480" dialog_title="<?php echo $lang['member_order_cancel_order'];?>" dialog_id="buyer_order_cancel_order" uri="index.php?act=member_order&op=change_state&state_type=order_cancel&order_id=<?php echo $order_info['order_id']; ?>"  id="order<?php echo $order_info['order_id']; ?>_action_cancel"><i class="icon-ban-circle"></i> <?php echo $lang['member_order_cancel_order'];?></a></p>
          <?php } ?>

          <!-- 退款取消订单 -->

          <?php if ($order_info['if_refund_cancel']){ ?>
          <p><a href="index.php?act=member_refund&op=add_refund_all&order_id=<?php echo $order_info['order_id']; ?>" class="ncm-btn"><i class="icon-legal"></i>订单退款</a></p>
          <?php } ?>

          <!-- 收货 -->

          <?php if ($order_info['if_receive']) { ?>
          <p><a href="javascript:void(0)" class="ncm-btn" nc_type="dialog" dialog_id="buyer_order_confirm_order" dialog_width="480" dialog_title="<?php echo $lang['member_order_ensure_order'];?>" uri="index.php?act=member_order&op=change_state&state_type=order_receive&order_sn=<?php echo $order_info['order_sn']; ?>&order_id=<?php echo $order_info['order_id']; ?>" id="order<?php echo $order_info['order_id']; ?>_action_confirm"><?php echo $lang['member_order_ensure_order'];?></a></p>
          <?php } ?>

          <!-- 评价 -->

          <?php if ($order_info['if_evaluation']  && $order_info['refund_state'] != 2) { ?>
          <p><a class="ncm-btn ncm-btn-acidblue" href="index.php?act=member_evaluate&op=add&order_id=<?php echo $order_info['order_id']; ?>"><i class="icon-thumbs-up-alt"></i><?php echo $lang['member_order_want_evaluate'];?></a></p>
          <?php } ?>

		  <?php if ($order_info['refund_state'] == 2){ ?>
            <p>退款\退货</p>
            <?php } ?>

          <!-- 已经评价 -->

          <?php if ($order_info['evaluation_state'] == 1) { echo $lang['order_state_eval'];} ?>
          <?php if ($order_info['if_drop']) { ?>
          <p><a href="javascript:void(0);" onclick="ajax_get_confirm('您确定要永久删除吗?永久删除后您将无法再查看该订单，也无法进行投诉维权，请谨慎操作！', 'index.php?act=member_order&op=change_state&state_type=order_drop&order_id=<?php echo $order_info['order_id']; ?>');" class="ncm-btn ncm-btn-red mt5"><i class="icon-trash"></i>永久删除</a></p>
          <?php } ?></td>
        <!-- E 合并TD -->
        <?php } ?>
      </tr>

      <!-- S 赠品列表 -->

      <?php if (!empty($order_info['zengpin_list']) && $i == count($order_info['goods_list'])) { ?>
      <tr>
        <td class="bdl"></td>
        <td colspan="5" class="tl"><div class="ncm-goods-gift"> 赠品：
            <ul>
              <?php foreach ($order_info['zengpin_list'] as $zengpin_info) { ?>
              <li><a title="赠品：<?php echo $zengpin_info['goods_name'];?> * <?php echo $zengpin_info['goods_num'];?>" href="<?php echo $zengpin_info['goods_url'];?>" target="_blank"><img src="<?php echo $zengpin_info['image_60_url'];?>" onMouseOver="toolTip('<img src=<?php echo $zengpin_info['image_240_url'];?>>')" onMouseOut="toolTip()"/></a></li>
              <?php } ?>
            </ul>
          </div></td>
      </tr>
      <?php } ?>
      <!-- E 赠品列表 -->

      <?php } ?>
          <?php } ?>
      <!-- E 商品列表 -->

      <?php } ?>
    </tbody>
    <?php } ?>
    <?php } else { ?>
    <tbody>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
    </tbody>
    <?php } ?>
    <?php if($output['order_pay_list']) { ?>
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

$("#btn1").click(function(){
  $("#sub_form_1").show();
  $("#fwin_dialog_cover").addClass('tijiaoaddClass');
});            
$(".close,.cancel").click(function(){
  $("#sub_form_1").hide();
  $("#fwin_dialog_cover").removeClass('tijiaoaddClass');
});

$("#JiXuTiJiao").click(function(){
  $("#sub_form_1").hide();
  $("#fwin_dialog_cover").removeClass('tijiaoaddClass');
  var value = $(this).attr("JiXuUrl");
  window.location.href=value;
});
</script>
