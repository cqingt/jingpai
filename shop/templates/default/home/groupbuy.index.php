<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_group.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nch-breadcrumb-layout {display: none; }
</style>
<div class="nch-breadcrumb-layout" style="display: block;">
  <div class="nch-breadcrumb wrapper"> <i class="icon-home"></i> <span> <a href="<?php echo urlShop(); ?>">首页</a> </span> <span class="arrow">&gt;</span> <span>藏品惠</span></div>
</div>

<div class="ncg-container">



  
  <div class="ncg-content">
  <?php if (!empty($output['adv_list'])) { ?>
    <div class="ncg-slides-banner">
      <ul id="fullScreenSlides" class="full-screen-slides">
    <?php foreach($output['adv_list'][0]['code_info'] as $v) { ?>
        <li><a href="<?php echo $v['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL."/".$v['pic_img'];?>"></a></li>
        <?php } ?>
    </ul>
       </div>
  <?php } ?>
  </div>


    <div class="ncg-right-ad"><?php echo loadadv(1088);?></div>
    <div class="group-list mt20" style="margin-bottom:10px;">
      <div class="ncg-recommend-title">
        <h3>商品推荐</h3>
		<!--
        <a href="<?php echo urlShop('show_groupbuy', 'groupbuy_list'); ?>" class="more">查看更多</a>
		-->
		</div>
	<?php if (!empty($output['groupbuy'])) { ?>
      <ul>
        <?php foreach ($output['groupbuy'] as $groupbuy) { ?>
        <li class="<?php echo $output['current'];?>">
          <div class="ncg-list-content"> <a title="<?php echo $groupbuy['groupbuy_name'];?>" href="<?php echo $groupbuy['groupbuy_url'];?>" class="pic-thumb" target="_blank"><img src="<?php echo cthumb($groupbuy['groupbuy_image1'],'360');?>" alt=""></a>
            <h3 class="title"><a title="<?php echo $groupbuy['groupbuy_name'];?>" href="<?php echo $groupbuy['groupbuy_url'];?>" target="_blank"><?php echo $groupbuy['groupbuy_name'];?></a></h3>
            <?php list($integer_part, $decimal_part) = explode('.', $groupbuy['groupbuy_price']);?>
            <div class="item-prices"> <span class="price"><i><?php echo $lang['currency'];?></i><?php echo $integer_part;?><em>.<?php echo $decimal_part;?></em></span>
              <div class="dock"><span class="limit-num"><?php echo $groupbuy['groupbuy_rebate'];?>&nbsp;<?php echo $lang['text_zhe'];?></span> <del class="orig-price"><?php echo $lang['currency'].$groupbuy['goods_price'];?></del></div>
              <span class="sold-num"><em><?php echo $groupbuy['buy_quantity']+$groupbuy['virtual_quantity'];?></em><?php echo $lang['text_piece'];?><?php echo $lang['text_buy'];?></span><a href="<?php echo $groupbuy['groupbuy_url'];?>" target="_blank" class="buy-button">我要抢</a></div>
          </div>
        </li>
        <?php } ?>
      </ul>
      <?php } else { ?>
      <div class="norecommend">暂无产品推荐</div>
      <?php } ?>
 </div>
</div>