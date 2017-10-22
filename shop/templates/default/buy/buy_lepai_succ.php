<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="ncc-main">
  <div class="ncc-title">
    <h3><?php echo $lang['cart_index_buy_finish'];?></h3>
    <h5>拍卖惠订单已支付完成，祝您购物愉快。</h5>
  </div>
  <div class="ncc-receipt-info mb30">
  <div class="ncc-finish-a"><i></i>拍卖惠订单支付成功！您已成功支付订单金额<em>￥<?php echo $_GET['pay_amount'];?></em>。</div>
  <div class="ncc-finish-b">可通过用户中心<a href="<?php echo SHOP_SITE_URL?>/index.php?act=lepai_order">我的拍卖惠订单</a>查看订单状态。</div>
  <div class="ncc-finish-c mb30"><a href="<?php echo urlLepai('index','')?>" class="ncc-btn-mini ncc-btn-green mr15"><i class="icon-shopping-cart"></i>拍卖惠首页</a><a href="<?php echo SHOP_SITE_URL?>/index.php?act=lepai_order" class="ncc-btn-mini ncc-btn-acidblue"><i class="icon-file-text-alt"></i>查看拍卖惠订单</a></div>
  </div>
</div>