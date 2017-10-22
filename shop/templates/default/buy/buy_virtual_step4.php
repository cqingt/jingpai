<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="ncc-main">
  <div class="ncc-title">
    <h3>订单完成</h3>
    <h5>订单已支付完成，祝您购物愉快。</h5>
  </div>
  <div class="ncc-receipt-info mb30">
  <div class="ncc-finish-a"><i></i>订单支付成功！您已成功支付订单金额<em>￥<?php echo $_GET['order_amount'];?></em>，订单编号：<?php echo $_GET['order_sn'];?>。</div>
  <div class="ncc-finish-b"><a href="<?php echo SHOP_SITE_URL?>/index.php?act=member_vr_order&op=show_order&order_id=<?php echo $_GET['order_id'];?>">查看订单详情</a></div>
  <div class="ncc-finish-c mb30"><a href="<?php echo SHOP_SITE_URL?>" class="ncc-btn-mini ncc-btn-green mr15"><i class="icon-shopping-cart"></i>继续购物</a><a href="<?php echo SHOP_SITE_URL?>/index.php?act=member_vr_order" class="ncc-btn-mini ncc-btn-acidblue"><i class="icon-file-text-alt"></i>查看我的订单</a></div>
  <p style="
    font-size: 14px;
    text-align: left;
    text-indent: 2em;
    margin-top: -18px;
    margin-left: 6px;
    color: #d73d3f;
">温馨提示：双11期间，因各物流公司发货量暴增，物流派送速度可能会有所下降，我们已与合作物流达成共识，会尽快为您派送商品，感谢您对收藏天下的关注与支持，祝您生活愉快！
</p>
  </div>
</div>