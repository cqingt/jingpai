<?php defined('InShopNC') or exit('Access Invalid!');?>

<?php include template('layout/cur_local');?>
<?php if(isset($output['miaosha'])) {?>
		<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/js/jquery.bxslider.js"></script>
		<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
        $(document).ready(function(){
          $('.slider3').bxSlider({
            slideWidth: 168,
            minSlides: 15,
            maxSlides: 5,
			moveSlides: 5,
            slideMargin: 30
          });
        });
    </script>
<?php } ?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_goods.css" rel="stylesheet" type="text/css">

<style type="text/css">
.ncs-goods-picture .levelB, .ncs-goods-picture .levelC { cursor: url(<?php echo SHOP_TEMPLATES_URL;?>/images/shop/zoom.cur), pointer;}
.ncs-goods-picture .levelD { cursor: url(<?php echo SHOP_TEMPLATES_URL;?>/images/shop/hand.cur), move\9;}
.ncs-detail {border: none;}
.ncs-goods-summary {border-right: none;}
</style>

<div id="content" class="wrapper pr">
    <input type="hidden" id="lockcompare" value="unlock" />
  <div class="ncs-detail<?php if ($output['store_info']['is_own_shop']) echo ' ownshop'; ?>">
    <!-- S 商品图片 -->
      <style type="text/css">
          #preview{ float:left;text-align:center; width:350px; margin: 8px;}
          .jqzoom{ width:350px; height:350px; position:relative; border:1px solid #dcdcdc;}

          .zoomdiv{ left:859px; height:400px; width:400px;}
          .list-h li{ float:left;}
          #spec-n5{width:350px; height:56px; padding-top:6px; overflow:hidden;}
          #spec-left{  width:17px; height:54px; float:left; cursor:pointer; margin-top:0px;}
          #spec-right{ width:17px; height:54px; float:left;cursor:pointer; margin-top:0px;}
          #spec-list{ width:325px; float:left; overflow:hidden; margin-left:2px; display:inline;}
          #spec-list ul li{ float:left; margin-right:0px; display:inline; width:62px;}
          #spec-list ul li img{ padding:2px ; border:1px solid #ccc; width:50px; height:50px;}
          /*jqzoom*/
          .jqzoom{position:relative;padding:0;}
          .zoomdiv{z-index:100;position:absolute;top:1px;left:0px;width:400px;height:400px;background:url(i/loading.gif) #fff no-repeat center center;border:1px solid #e4e4e4;display:none;text-align:center;overflow: hidden;}
          .bigimg{width:800px;height:800px;}
          .jqZoomPup{z-index:10;visibility:hidden;position:absolute;top:0px;left:0px;width:50px;height:50px;border:1px solid #aaa;background:#FEDE4F 50% top no-repeat;opacity:0.5;-moz-opacity:0.5;-khtml-opacity:0.5;filter:alpha(Opacity=50);cursor:move;}
          #spec-list{ position:relative; width:308px; margin-right:6px;}
          #spec-list div{ margin-top:0;margin-left:-30px; *margin-left:0;}
.bx-wrapper {
            max-width: 960px !important;
           }
      </style>
      <div id="preview">
          <div class="jqzoom" id="spec-n1" onclick="window.open('')">
		  <?php if ($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0 ||  ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_indate'] < TIMESTAMP)) {?>
		  <i class="icon-nothing"></i>
		  <?php } ?>
              <img height="350" src="<?php echo cthumb($output['goods']['goods_image'],360)?>" bigsrc="<?php echo cthumb($output['goods']['goods_image'],1280)?>" width="350">
          </div>
          <div id="spec-n5">
              <div class="control" id="spec-left">
                  <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/left_on.gif">
              </div>
              <div id="spec-list">
                  <ul class="list-h"  >
                      <?php if (!empty($output['goods_images'])) {?>
                          <?php foreach($output['goods_images'] as $k=>$v){?>
                              <li>
                                      <img src="<?php echo cthumb($v['goods_image'],360)?>" alt="<?php echo $output['goods']['goods_name']; ?>" jqimg="<?php echo cthumb($v['goods_image'],1280)?>" onload="DrawImage(this,50,50);" width="50" height="50" style="margin-top: 0px; margin-left: 0px; border: 1px solid rgb(204, 204, 204); padding: 2px;">
                              </li>
                          <?php }?>
                      <?php }?>
                  </ul>
              </div>
              <div class="control" id="spec-right">
                  <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/right_on.gif">
              </div>
          </div>
      </div>
      <script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/lib_20110119zzjs_net.js" type="text/javascript"></script>
      <script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/Magnifier-min.js"></script>
      <script type="text/javascript">
          $(function(){

              $("#spec-list").jdMarquee({
                  deriction:"left",
                  width:313,
                  height:56,
                  step:2,
                  speed:4,
                  delay:10,
                  control:true,
                  _front:"#spec-right",
                  _back:"#spec-left"
              });
              $("#spec-list img").bind("mouseover",function(){
                  var src=$(this).attr("src");
                  var srcs=$(this).attr("jqimg");
                  $("#spec-n1 img").eq(0).attr({
                      src:src.replace("\/n5\/","\/n1\/"),
                      bigsrc:srcs.replace("\/n5\/","\/n0\/")
                  });
                  $(this).css({
                      "border":"2px solid #ff6600",
                      "padding":"1px"
                  });
              }).bind("mouseout",function(){
                  $(this).css({
                      "border":"1px solid #ccc",
                      "padding":"2px"
                  });
              });
          })
      </script>
   <!-- S 商品基本信息 art914 -->
    <div class="ncs-goods-summary demo-artpages">
      <div class="name">
        <h1><?php echo $output['goods']['goods_name']; ?></h1>
        <strong><?php echo str_replace("\n", "<br>", $output['goods']['goods_jingle']);?></strong> 
      </div>
      <div class="ncs-meta">



<div class="artpages-rmb">
        	<p>
			<?php if (isset($output['goods']['title']) && $output['goods']['title'] != '') {?>
				<i><?php echo $output['goods']['title'];?><?php echo $lang['nc_colon'];?></i>
            <?php }else{ ?>
				<i>价 格<?php echo $lang['nc_colon'];?></i>
			<?php } ?>
            <?php if (isset($output['goods']['promotion_price']) && !empty($output['goods']['promotion_price'])) {?>
            <strong><?php echo $lang['currency'].$output['goods']['promotion_price'];?></strong><em style="color: #999;text-decoration: line-through;">(原售价<?php echo $lang['nc_colon'];?><?php echo $lang['currency'].$output['goods']['goods_price'];?>)</em>
            <?php } else {?>
            <strong><?php echo ($output['goods']['goods_price'] < 1)?"咨询客服":($lang['currency'].$output['goods']['goods_price']);?></strong>
            <?php }?>
			</p>
			<?php if($output['store_yijia']){ ?>
        	<a id="bargain" href="javascript:;"><?php echo ($output['goods']['goods_price'] < 1)?"我要询价":"我要议价";?></a>
			<?php } ?>
</div>



        <div class="artpages-meg">
		<?php if (isset($output['goods']['promotion_type']) || $output['goods']['have_gift'] == 'gift') {?>
		<!-- S 促销 -->
			促销信息：
			<!-- S 限时折扣 -->
            <?php if ($output['goods']['promotion_type'] == 'xianshi') {?>
            <?php echo '直降：'.$lang['currency'].$output['goods']['down_price'];?>
            <?php if($output['goods']['lower_limit']) {?>
            <em><?php echo sprintf('最低%s件起',$output['goods']['lower_limit']);?></em>
            <?php } ?>
            <span><?php echo $output['goods']['explain'];?></span><br>
            <?php }?>
            <!-- E 限时折扣  -->
			<!-- S 藏品惠-->
            <?php if ($output['goods']['promotion_type'] == 'groupbuy') {?>
            <?php if ($output['goods']['upper_limit']) {?>
            <em>该商品已享受藏品惠活动价</em>
            <?php } ?>
            <?php }?>
            <!-- E 藏品惠 -->
          <!-- add 秒杀模块  xin -->
          <!-- M 秒杀 -->
          <?php if ($output['goods']['promotion_type'] == 'miaosha') {?>
              <?php if ($output['goods']['upper_limit']) {?>
                  <em><?php echo sprintf('每人限购%s件',$output['goods']['upper_limit']).sprintf('，秒杀还剩%s件',$output['goods']['goods_storage']);?></em>
              <?php } ?>
              <span><?php echo $output['goods']['remark'];?></span><br>
          <?php }?>
          <!-- add end -->

		 <!-- 推荐优惠 -->
          <?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
			  <?php if ($output['goods']['tuijian_limit']) {?>
                  <em><?php echo sprintf('每人限购%s件',$output['goods']['tuijian_limit']).sprintf('，优惠还剩%s件',$output['goods']['tuijian_storage']);?><br />超过<?php echo $output['goods']['tuijian_limit'];?>件或者推荐条件未达成前，下单以商品原价计算</em>
              <?php } ?>
          <?php }?>
          <!-- 推荐优惠 end -->
            <!-- S 赠品 -->
            <?php if ($output['goods']['have_gift'] == 'gift') {?>
            <?php echo '赠品'?> <span>赠下方的热销商品，赠完即止</span>
            <?php }?>
            <!-- E 赠品 -->
			
		<!-- E 促销 -->
		 <?php }?>

			 <!-- S 会员特价   xin  20151130 -->
          <?php if (is_array($output['goods']['vipsale_info']) && !empty($output['goods']['vipsale_info'])) {?>
              <dl>
                  <dt style="color: #E4393C;line-height:24px">会员特价：</dt>
                  <dd class="promotion-info">
                          <em style="color: #E4393C"><?php echo '￥'.intval($output['goods']['vipsale_info']['vipsale_price']).'（'.$output['goods']['vipsale_info']['level_name'].'及以上级别专享）';?></em>

                  </dd>
              </dl>
          <?php }?>
          <!-- E 会员特价 -->

        <!-- S 满即送 -->
        <?php if (isset($output['mansong_info']) && !empty($output['mansong_info'])) {?>
          <dl>
              <dt style="line-height:24px">满 就 送：</dt>
              <dd class="promotion-info">
                  <?php foreach($output['mansong_info']['rules'] as $rule) { ?>
                      <span>单笔订单<?php echo ($output['mansong_info']['mansong_type'] ==2 )?'每':'';?>满<em style="width: 60px;text-align:center;display:inline-block;vertical-align: baseline"><?php echo ncPriceFormat($rule['price']);?></em><?php echo $lang['nc_yuan'];?>
                          <?php if(!empty($rule['discount'])) { ?>
                              ， <?php echo $lang['nc_reduce'];?><i><?php echo ncPriceFormat($rule['discount']);?></i><?php echo $lang['nc_yuan'];?>
                          <?php } ?>
                          <?php if(!empty($rule['goods_id'])) { ?>
                              ， <?php echo $lang['nc_gift'];?> <a href="<?php echo $rule['goods_url'];?>" title="<?php echo $rule['mansong_goods_name'];?>" target="_blank"> <img src="<?php echo cthumb($rule['goods_image'], 60);?>" alt="<?php echo $rule['mansong_goods_name'];?>" style="max-width: 28px;max-height:28px;"> </a>
                          <?php } ?>
                </span><br>
                  <?php } ?>
              </dd>
          </dl>
        <?php }?>
        <!-- E 满即送 -->
		</div>
      </div>
	  

	     <div class="ncs-plus">
        <!-- S 物流运费  预售商品不显示物流 -->
        <?php if ($output['goods']['is_virtual'] == 0) {?>
        <dl class="ncs-freight">
          <dt>
            <?php if ($output['goods']['goods_transfee_charge'] == 1){?>
            <?php echo $lang['goods_index_freight'].$lang['nc_colon'];?>
            <?php }else{?>
            <!-- 如果买家承担运费 -->
            <!-- 如果使用了运费模板 -->
            <?php if ($output['goods']['transport_id'] != '0'){?>
            <?php echo $lang['goods_index_trans_to'];?><a href="javascript:void(0)" id="ncrecive"><?php echo $lang['goods_index_trans_country'];?></a><?php echo $lang['nc_colon'];?>
            <div class="ncs-freight-box" id="transport_pannel">
              <?php if (is_array($output['area_list'])){?>
              <?php foreach($output['area_list'] as $k=>$v){?>
              <a href="javascript:void(0)" nctype="<?php echo $k;?>"><?php echo $v;?></a>
              <?php }?>
              <?php }?>
            </div>
            <?php }else{?>
            <?php echo $lang['goods_index_trans_zcountry'];?><?php echo $lang['nc_colon'];?>
            <?php }?>
            <?php }?>
          </dt>
          <dd id="transport_price">
            <?php if ($output['goods']['goods_freight'] == 0){?>
            <span id="nc_kd"><?php echo $lang['goods_index_trans_for_seller'];?></span>
            <?php }else{?>
            <!-- 如果买家承担运费 -->
            <span id="nc_kd">运费<?php echo $lang['nc_colon'];?><em><?php echo $output['goods']['goods_freight'];?></em><?php echo $lang['goods_index_yuan'];?></span>
            <?php }?>
          </dd>
          <dd style="color:red;display:none" id="loading_price">loading.....</dd>
        </dl>
        <?php }?>
        <!-- E 物流运费 --->

        <!-- S 赠品 -->
        <?php if ($output['goods']['have_gift'] == 'gift') {?>
        <dl>
          <dt>赠&#12288;&#12288;品：</dt>
          <dd class="goods-gift" id="ncsGoodsGift">
            <?php if (!empty($output['gift_array'])) {?>
            <ul>
              <?php foreach ($output['gift_array'] as $val){?>
              <li>
                <div class="goods-gift-thumb"><span><img src="<?php echo cthumb($val['gift_goodsimage'], '60', $output['goods']['store_id']);?>"></span></div>
                <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $val['gift_goodsid']));?>" class="goods-gift-name" target="_blank"><?php echo $val['gift_goodsname']?></a><em>x<?php echo $val['gift_amount'];?></em> </li>
              <?php }?>
            </ul>
            <?php }?>
          </dd>
        </dl>
        <?php }?>
        <!-- S 赠品 -->
      </div>
       <?php if($output['goods']['goods_state'] != 10 && $output['goods']['goods_verify'] == 1){?>
      <div class="ncs-key">
	  <!--
	   <div class="artpage-period">该艺术家接受订制  周期为*天</div>
	   -->
		<!-- S 关联商品-->
		<?php if(!empty($output['GetGoodsLink']) && $output['goods']['promotion_type'] != 'tuijianyouhui'){?>
	
		 <dl nctype="nc-spec">
          <dt>规格：</dt>
          <dd>
            <ul nctyle="ul_sign">
              	<?php foreach($output['GetGoodsLink'] as $val){?>
				<?php foreach($val['goods_list'] as $gl){?>
				<?php if(isset($gl['goods_id'])) {?>

				<li class="sp-img"><a href="<?php if ($gl['goods_id'] != $output['goods']['goods_id']) {echo urlShop('goods', 'index', array('goods_id' => $gl['goods_id']));}?>" class="<?php if ($gl['goods_id'] == $output['goods']['goods_id']) {echo 'hovered';}?>" title="<?php echo $val['title'][$gl['goods_id']];?>"><img src="<?php echo cthumb($gl['goods_image'], 60);?>"/><?php echo $val['title'][$gl['goods_id']];?><i></i></a></li>
				
				<?php }?>
				<?php }?>
				<?php }?>
            </ul>
          </dd>
        </dl>
		<?php }?>
		<!-- E 关联商品-->

        <!-- S 商品规格值-->
        <?php if (is_array($output['goods']['spec_name'])) { ?>
        <?php foreach ($output['goods']['spec_name'] as $key => $val) {?>

<?php if((is_array($output['goods']['spec_value'][$key]) and !empty($output['goods']['spec_value'][$key]))){?>
        <dl nctype="nc-spec">
          <dt><?php echo $val;?><?php echo $lang['nc_colon'];?></dt>
          <dd>
            <?php if (is_array($output['goods']['spec_value'][$key]) and !empty($output['goods']['spec_value'][$key])) {?>
            <ul nctyle="ul_sign">
              <?php foreach($output['goods']['spec_value'][$key] as $k => $v) {?>
              <?php if( $key == 1 ){?>
              <!-- 图片类型规格-->
              <li class="sp-img"><a href="javascript:void(0);" class="<?php if (isset($output['goods']['goods_spec'][$k])) {echo 'hovered';}?>" data-param="{valid:<?php echo $k;?>}" title="<?php echo $v;?>"><img src="<?php echo $output['spec_image'][$k];?>"/><?php echo $v;?><i></i></a></li>
              <?php }else{?>
              <!-- 文字类型规格-->
              <li class="sp-txt"><a href="javascript:void(0)" class="<?php if (isset($output['goods']['goods_spec'][$k])) { echo 'hovered';} ?>" data-param="{valid:<?php echo $k;?>}"><?php echo $v;?><i></i></a></li>
              <?php }?>
              <?php }?>
            </ul>
            <?php }?>
          </dd>
        </dl>
<?php }?>

        <?php }?>
        <?php }?>
        <!-- E 商品规格值-->
        <?php if ($output['goods']['is_virtual'] == 1) {?>
        <dl>
          <dt>提货方式：</dt>
          <dd>
            <ul>
              <li class="sp-txt"><a href="javascript:void(0)" class="hovered">电子兑换券<i></i></a></li>
            </ul>
          </dd>
        </dl>
        <?php }?>
        <?php if ($output['goods']['is_virtual'] == 1) {?>
        <!-- 虚拟商品有效期 -->
        <dl>
          <dt>有&nbsp;效&nbsp;期：</dt>
          <dd>即日起 到 <?php echo date('Y-m-d H:i:s', $output['goods']['virtual_indate']);?></dd>
        </dl>
        <?php }else if ($output['goods']['is_presell'] == 1) {?>
        <!-- 预售商品发货时间 -->
        <dl>
          <dt>预&#12288;&#12288;售：</dt>
          <dd><ul><li class="sp-txt"><a href="javascript:void(0)" class="hovered"><?php echo date('Y-m-d', $output['goods']['presell_deliverdate']);?>&nbsp;日发货<i></i></a></li></ul></dd>
        </dl>
        <?php }?>
        <?php if ($output['goods']['is_fcode']) {?>
        <!-- 预售商品发货时间 -->
        <dl>
          <dt>购买类型：</dt>
          <dd><ul><li class="sp-txt"><a href="javascript:void(0)" class="hovered">F码优先购买<i></i></a></li></ul></dd>
        </dl>
        <?php }?>
        <!-- S 购买数量及库存 -->
        <?php if ($output['goods']['goods_state'] != 0 && $output['goods']['goods_storage'] >= 0) {?>
        <dl>
          <dt><?php echo $lang['goods_index_buy_amount'];?><?php echo $lang['nc_colon'];?></dt>
          <dd class="ncs-figure-input">

            <input type="text" name="" id="quantity" value="1" size="3" maxlength="6" class="text w30" <?php if ($output['goods']['is_fcode'] == 1) {?>readonly<?php }?>>
            <?php if ($output['goods']['is_fcode'] == 1) {?>
            <span style="margin-left: 5px;">（每个F码优先购买一件商品）</span>(<?php echo $lang['goods_index_stock'];?><em nctype="goods_stock"><?php echo $output['goods']['goods_storage']; ?></em><?php echo $lang['nc_jian'];?>)
            <?php } else {?>
            <a href="javascript:void(0)" class="increase">+</a><a href="javascript:void(0)" class="decrease">-</a> <span><?php echo ($output['goods']['goods_storage'] >= 10)?'(当前库存充足，请放心下单)':(($output['goods']['goods_storage'] < 1)?'':'(当前库存紧张，请及时下单)');?><em nctype="goods_stock" style="display: none"><?php echo $output['goods']['goods_storage']; ?></em>
            <!-- 虚拟商品限购数 -->
            <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) { ?>，每人次限购<strong>
              <!-- 虚拟藏品惠 设置了虚拟藏品惠限购数 该数小于原商品限购数 -->
              <?php echo ($output['goods']['promotion_type'] == 'groupbuy' && $output['goods']['upper_limit'] > 0 && $output['goods']['upper_limit'] < $output['goods']['virtual_limit']) ? $output['goods']['upper_limit'] : $output['goods']['virtual_limit'];?>
              </strong>件<?php } ?>
            </span><?php } ?>
          </dd>
        </dl>
        <?php }?>
        <!-- E 购买数量及库存 -->
      </div>
      <!-- S 购买按钮 -->
        <div class="ncs-btn"><!-- S 提示已选规格及库存不足无法购买 -->
          <div nctype="goods_prompt" class="ncs-point">
            <?php if (!empty($output['goods']['goods_spec'])) {?>
            <span class="yes"><?php echo $lang['goods_index_you_choose'];?> <strong><?php echo implode($lang['nc_comma'], $output['goods']['goods_spec']);?></strong></span>
            <?php }?>
            <?php if ($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0) {?>
            <span class="no"><i class="icon-exclamation-sign"></i>&nbsp;<?php echo $lang['goods_index_understock_prompt'];?></span>
            <?php }?>
          </div>
          <!-- E 提示已选规格及库存不足无法购买 -->
          <!-- S到货通知 -->
          <?php if ($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0) {?>
          <a href="javascript:void(0);" nctype="arrival_notice" name="arrival_notice" class="arrival" title="到货通知">（<i class="icon-bullhorn"></i>到货通知）</a>
          <?php }?>
          <!-- E到货通知 -->
          <div class="clear"></div>
          
          <!-- 预约 -->
          <?php if (($output['goods']['goods_price'] <= 1 || $output['goods']['goods_storage'] <= 0) && $output['goods']['is_appoint'] == 1) {?>
          <div>销售时间：<?php echo date('Y-m-d H:i:s', $output['goods']['appoint_satedate']);?></div>
		  <br />
          <a href="javascript:void(0);" nctype="appoint_submit" name="appoint_submit" class="addcart" title="立即预订">立即预订</a>
          <?php }?>

		  <!-- 立即分享-->
		  <?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
				<div style="height: 40px;font-size: 16px;color: #D93600;">将商品分享给朋友，双方均以最低折扣价购买，每人限购<?php echo $output['goods']['tuijian_limit']; ?>件</div>
				<a href="javascript:void(0);" class="share" title="立即分享" nctype="share_submit" name="share_submit">立即分享</a>
		  <?php }?>

          <!-- 立即购买-->
          <a href="javascript:void(0);" nctype="buynow_submit" name="buynow_submit" class="buynow <?php if ($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0 || intval($output['goods']['goods_price']) < 1 || ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_indate'] < TIMESTAMP)) {?>no-buynow<?php }?>" title="<?php echo $output['goods']['buynow_text'];?>"><?php echo $output['goods']['buynow_text'];?></a>
          <?php if ($output['goods']['cart'] == true && $output['goods']['promotion_type'] != 'tuijianyouhui') {?>
          <!-- 加入购物车-->
          <a href="javascript:void(0);" <?php echo (intval($output['goods']['goods_price']) < 1)?'':'nctype="addcart_submit"'?> name="addcart_submit" class="addcart <?php if ($output['goods']['goods_state'] == 0 || intval($output['goods']['goods_price']) < 1 || $output['goods']['goods_storage'] <= 0) {?>no-addcart<?php }?>" title="<?php echo $lang['goods_index_add_to_cart'];?>"><i class="icon-shopping-cart"></i><?php echo $lang['goods_index_add_to_cart'];?></a>
          <?php } ?>

          <!-- S 加入购物车弹出提示框 -->
          <div class="ncs-cart-popup">
            <dl>
              <dt><?php echo $lang['goods_index_cart_success'];?><a title="<?php echo $lang['goods_index_close'];?>" onClick="$('.ncs-cart-popup').css({'display':'none'});">X</a></dt>
              <dd><?php echo $lang['goods_index_cart_have'];?> <strong id="bold_num"></strong> <?php echo $lang['goods_index_number_of_goods'];?> <?php echo $lang['goods_index_total_price'];?><?php echo $lang['nc_colon'];?><em id="bold_mly" class="saleP"></em></dd>
              <dd class="btns"><a href="javascript:void(0);" class="ncs-btn-mini ncs-btn-green" onClick="location.href='<?php echo SHOP_SITE_URL.DS?>index.php?act=cart'"><?php echo $lang['goods_index_view_cart'];?></a> <a href="javascript:void(0);" class="ncs-btn-mini" value="" onClick="$('.ncs-cart-popup').css({'display':'none'});"><?php echo $lang['goods_index_continue_shopping'];?></a></dd>
            </dl>
          </div>
          <!-- E 加入购物车弹出提示框 -->

        </div>
        <!-- E 购买按钮 -->
      <?php }else{?>
      <div class="ncs-saleout">
        <dl>
          <dt><i class="icon-info-sign"></i><?php echo $lang['goods_index_is_no_show'];?></dt>
          <dd><?php echo $lang['goods_index_is_no_show_message_one'];?></dd>
          <dd><?php echo $lang['goods_index_is_no_show_message_two_1'];?>&nbsp;<a href="<?php echo urlShop('show_store', 'index', array('store_id'=>$output['goods']['store_id']), $output['store_info']['store_domain']);?>" class="ncs-btn-mini"><?php echo $lang['goods_index_is_no_show_message_two_2'];?></a>&nbsp;<?php echo $lang['goods_index_is_no_show_message_two_3'];?> </dd>
        </dl>
      </div>
      <?php }?>
      <!--E 商品信息 -->



<?php if($output['store_yijia']){ ?>

<!--S 我要议价-->
<div class="ui-bargain">

          <h2><i></i></h2>
          <div class="bar-con">
            <!--<div class="img"><img src="http://www.96567.com/shop/templates/default/images/kefu2.jpg" onclick="NTKF.im_openInPageChat('sc_1022_9999')"/></div>-->
            <div class="demo">
              
              <div class="bar-l">
                <span><strong>我要<?php echo ($output['goods']['goods_price'] < 1)?"询价":"议价";?></strong><em>（10分钟内回复）</em></span>
                <div class="item">
                  <input class="btnup1" type="text" name="phone" id="YjPhone" value="<?php echo $output['member_mobile'] == 0 ? '' : $output['member_mobile'];?>"  placeholder="请输入手机号码"/>
                  <input id="barClose" class="btnup2" type="button" value="提交">
                </div>
                
              </div>
              
              <div class="bar-r">
                <p class="p1">拨打免费热线，直接沟通</p>
                <h4>400-08-96567</h4>
                <p class="p2">24 小时客服手机号码：</p>
                <h4>15321248391<strong>（书画馆）</strong></h4>
              </div>
              
            </div>
            
            <div class="bar-bottom">
              <div class="bart1">
                <a href="javascript:;" onclick="NTKF.im_openInPageChat('sc_1022_9999')"><i></i></a>
              </div>
              <div class="bart2">
                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=3291858253&site=qq&menu=yes"><i></i>
                </a>


              </div>
              <div class="bart3">
                <i></i>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(function(){
            var btnBargain = $('#bargain'),
                uiBargain = $('.ui-bargain'),
                uiI = $('.ui-bargain h2 i'),
                barClose = $('#barClose');
                bArzz = $('.barzz');
            btnBargain.on('click',function(){
				<?php if(@intval($_SESSION['member_id']) > 0){?>
				 $.ajax({
					type:'post',
					url:"index.php?act=goods&op=YiJiaAdd",
					data:{YjPhone:"<?php echo $output['member_mobile'];?>",goods_id:"<?php echo $output['goods']['goods_id'];?>",goods_name:"<?php echo $output['goods']['goods_name']; ?>",store_id:"<?php echo $output['goods']['store_id']; ?>"},
					dataType:'json',
					success:function(result){
					}
				  }); 
			   <?php } ?>
               uiBargain.toggleClass('show');
               bArzz.toggleClass('show');
            })
            uiI.on('click',function(){
               uiBargain.toggleClass('show');
               bArzz.toggleClass('show');
            })
            bArzz.on('click',function(){
               uiBargain.toggleClass('show');
               bArzz.toggleClass('show');
            })
            barClose.on('click',function(){
          var YjName = $('#YjName').val();
          var YjPhone = $('#YjPhone').val();
          var YjContents = $('#YjContents').val();
          // if(YjName == ''){
          //   alert('请输入姓名');
          //   return false;
          // }
          if(!valid_shouji(YjPhone)){
            alert('请输入正确的手机号');
            return false;
          }
          // if(YjContents == ''){
          //   alert('请输入留言');
          //   return false;
          // }
          $("#barClose").attr("disabled",true);
          $.ajax({
            type:'post',
            url:"index.php?act=goods&op=YiJiaAdd",
            data:{YjPhone:YjPhone,goods_id:"<?php echo $output['goods']['goods_id'];?>",goods_name:"<?php echo $output['goods']['goods_name']; ?>",store_id:"<?php echo $output['goods']['store_id']; ?>"},
            dataType:'json',
            success:function(result){
              if(result.msg){
                alert("提交成功");
                uiBargain.toggleClass('show');
              }else{
                alert(result.error);
              }
              $("#barClose").attr("disabled",false);
            }
          }); 
              
            })
          })
    function valid_shouji(shouji) {
      var patten = new RegExp(/^0?1[34578]\d{9}$/);
      return patten.test(shouji);
    }
        </script>
<!--E 我要议价-->

<?php } ?>



 
    </div>
     <div class="barzz"></div>
    <!-- E 商品图片及收藏分享 -->
    <div class="ncs-handle">
      <!-- S 分享 -->
      <a href="javascript:void(0);" class="share" nc_type="sharegoods" data-param='{"gid":"<?php echo $output['goods']['goods_id'];?>"}'><i></i><?php echo $lang['goods_index_snsshare_goods'];?><span>(<em nc_type="sharecount_<?php echo $output['goods']['goods_id'];?>"><?php echo intval($output['goods']['sharenum'])>0?intval($output['goods']['sharenum']):0;?>)</em></span></a>
      <!-- S 收藏 -->
      <a href="javascript:collect_goods('<?php echo $output['goods']['goods_id']; ?>','count','goods_collect');" class="favorite"><i></i><?php echo $lang['goods_index_favorite_goods'];?><span>(<em nctype="goods_collect"><?php echo $output['goods']['goods_collect']?></em>)</span></a>
      <!-- S 对比
      <a href="javascript:void(0);" class="compare" nc_type="compare_<?php echo $output['goods']['goods_id'];?>" data-param='{"gid":"<?php echo $output['goods']['goods_id'];?>"}'><i></i>加入对比</a>--><!-- S 举报 -->
      <?php if($output['inform_switch']) { ?>
      <a href="<?php if ($_SESSION['is_login']) {?>index.php?act=member_inform&op=inform_submit&goods_id=<?php echo $output['goods']['goods_id'];?><?php } else {?>javascript:login_dialog();<?php }?>" title="<?php echo $lang['goods_index_goods_inform'];?>" class="inform"><i></i><?php echo $lang['goods_index_goods_inform'];?></a>
      <?php } ?>
      <!-- End --> </div>
	<?php if($output['getOne']){ ?>
    <!--S 艺术家信息-->
    <div style=" position: absolute; z-index: 1; top: -1px; right: -1px;">
		   <div class="artpage-left">
			  <a class="artpage-img" href="/artist/index.php?act=artist_blog&op=index&aid=<?php echo $output['getOne']['A_Id'];?>" target="_blank"><img src="<?php echo $output['getOne']['A_Img'];?>"/></a>
			  <h2><?php echo $output['getOne']['A_Name'];?></h2>
				<?php $A_ZhiCheng = @explode('|',$output['getOne']['A_ZhiCheng']);?>
			  <h5><?php echo $A_ZhiCheng[0];?></h5>
			  <div class="artpage-btn">
				<a href="/artist/index.php?act=artist_blog&op=zuoping&aid=<?php echo $output['getOne']['A_Id'];?>" target="_blank">在售作品<?php echo $output['OneGoods']['goodscount'];?>幅</a>
				<!--
				<a href="/artist/index.php?act=artist_blog&op=zuoping&aid=<?php echo $output['getOne']['A_Id'];?>" target="_blank">已售作品<?php echo $output['OneGoods']['OGoodsCount'];?>幅</a>
				-->
			  </div>
		   </div>
		   <a class="artpage-go" href="/artist/index.php?act=artist_blog&op=index&aid=<?php echo $output['getOne']['A_Id'];?>" target="_blank">进入艺术家官网</a>
    </div>
    <!--E 艺术家信息 -->
	<?php }else{ ?>
	<?php } ?>
    <div class="clear"></div>
  </div>
  <div class="ncs-goods-layout expanded" >
    <div class="ncs-goods-main" id="main-nav-holder">
      <!-- S 优惠套装 -->
      <div class="ncs-promotion" id="nc-bundling" style="display:none;"></div>
      <!-- E 优惠套装 -->
      <div class="tabbar pngFix" id="main-nav">
        <div class="ncs-goods-title-nav">
          <ul id="categorymenu">
            <li class="current"><a id="tabGoodsIntro" href="#content"><?php echo $lang['goods_index_goods_info'];?></a></li>
            <li><a id="tabGoodsRate" href="#content"><?php echo $lang['goods_index_evaluation'];?><em>(<?php echo intval($output['goods_evaluate_info']['all']);?>)</em></a></li>
            <li><a id="tabGoodsTraded" href="#content"><?php echo $lang['goods_index_sold_record'];?><em>(<?php echo intval($output['goods']['goods_salenum']); ?>)</em></a></li>
            <li><a id="tabGuestbook" href="#content"><?php echo $lang['goods_index_goods_consult'];?></a></li>
          </ul>
          <div class="switch-bar"><a href="javascript:void(0)" id="fold">&nbsp;</a></div>
        </div>
      </div>
      <div class="ncs-intro">
        <div class="content bd" id="ncGoodsIntro">


          <?php if(is_array($output['goods']['goods_attr']) || isset($output['goods']['brand_name'])){?>
          <ul class="nc-goods-sort">
            <li>商家货号：<?php echo $output['goods']['goods_serial'];?></li>
            <?php if(isset($output['goods']['brand_name'])){echo '<li>'.$lang['goods_index_brand'].$lang['nc_colon'].$output['goods']['brand_name'].'</li>';}?>
            <?php if(is_array($output['goods']['goods_attr']) && !empty($output['goods']['goods_attr'])){?>
            <?php foreach ($output['goods']['goods_attr'] as $val){ $val= array_values($val);echo '<li>'.$val[0].$lang['nc_colon'].$val[1].'</li>'; }?>
            <?php }?>
			<li>平尺：<?php echo $output['goods']['sh_width']."cm X ".$output['goods']['sh_height'].'cm（'.$output['goods']['sh_pingchi']."平尺）";?></li>
          </ul>
          <?php }?>
          <div class="ncs-goods-info-content">
              <?php $getadvImg = getadvImg(1093);
              if($getadvImg['is_use']){
                  ?>
                  <div style="height:110px;margin: 10px auto;">
                      <a href="<?php echo $getadvImg['Href']?>" target="_blank">
                          <img src="<?php echo $getadvImg['Img']?>" border="0">
                      </a>
                  </div>
              <?php } ?>
			  <!---->
			<?php if (isset($output['miaosha'])) {?>
<div class="slider3">
<?php foreach($output['miaosha'] as $k => $v){?>

      <div class="slide">
	  <?php if($v['is_shipping'] ==1){?>
	  <div class="icon-by"></div>
	  <?php } ?>
      	<a class="slideimg" href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['goods_image'];?>" title="<?php echo $v['goods_name'];?>" alt="<?php echo $v['goods_name'];?>"></a>
      	<a href="<?php echo $v['goods_url'];?>" target="_blank"><h2><?php echo $v['goods_name'];?></h2></a>
      	<h4><i class="miao_icon-time"></i>
		<?php if($v['start_time'] > TIMESTAMP){?>
		<label id = "leftTime2" class="leftTime" count_down="<?php echo $v['start_time'] - TIMESTAMP;?>" timestatus="1">载入中,请稍候...</label>
		<?php }else{ ?>
		<label id = "leftTime2"  class="leftTime"count_down="<?php echo $v['end_time'] - TIMESTAMP;?>" timestatus="2">载入中,请稍候...</label>
		<?php }?>
		
		</h4>
      	<p>秒杀价：<strong>¥<?php echo $v['miaosha_price'];?></strong></p>
      	<a class="sp-text" href="<?php echo $v['goods_url'];?>" target="_blank">
      		<span>仅剩：<?php echo $v['shengyukucun'];?>件</span>
			
		<?php if($v['start_time'] > TIMESTAMP){?>
      		
			
      		<span class="slider-jjks">即将开始</span>
		<?php }else{ ?>
		<span>立即秒杀</span>
		<?php }?>

      	</a>
      </div>
<?php }?>
    </div>

            <?php }?>


            <?php if (isset($output['plate_top'])) {?>
            <div class="top-template"><?php echo $output['plate_top']['plate_content']?></div>
            <?php }?>
            <div class="default"><?php echo $output['goods']['goods_body']; ?></div>
            <?php if (isset($output['plate_bottom'])) {?>
            <div class="bottom-template"><?php echo $output['plate_bottom']['plate_content']?></div>
            <?php }?>
          </div>
        </div>
      </div>
      <div class="ncs-comment">
        <div class="ncs-goods-title-bar hd">
          <h4><a href="javascript:void(0);"><?php echo $lang['goods_index_evaluation'];?></a></h4>
        </div>
        <div class="ncs-goods-info-content bd" id="ncGoodsRate">
          <div class="top">
            <div class="rate">
              <p><strong><?php echo $output['goods_evaluate_info']['good_percent'];?></strong><sub>%</sub>好评</p>
              <span>共有<?php echo intval($output['goods_evaluate_info']['all']);?>人参与评分</span></div>
            <div class="percent">
              <dl>
                <dt>好评<em>(<?php echo intval($output['goods_evaluate_info']['good_percent']);?>%)</em></dt>
                <dd><i style="width: <?php echo $output['goods_evaluate_info']['good_percent']?$output['goods_evaluate_info']['good_percent']:0;?>%"></i></dd>
              </dl>
              <dl>
                <dt>中评<em>(<?php echo intval($output['goods_evaluate_info']['normal_percent']);?>%)</em></dt>
                <dd><i style="width: <?php echo $output['goods_evaluate_info']['normal_percent']?$output['goods_evaluate_info']['normal_percent']:0;?>%"></i></dd>
              </dl>
              <dl>
                <dt>差评<em>(<?php echo intval($output['goods_evaluate_info']['bad_percent']);?>%)</em></dt>
                <dd><i style="width: <?php echo $output['goods_evaluate_info']['bad_percent']?$output['goods_evaluate_info']['bad_percent']:0;?>%"></i></dd>
              </dl>
            </div>
            <div class="btns"><span>您可对已购商品进行评价</span>
              <p><a href="<?php if ($output['goods']['is_virtual']) { echo urlShop('member_vr_order', 'index');} else { echo urlShop('member_order', 'index');}?>" class="ncs-btn ncs-btn-red" target="_blank"><i class="icon-comment-alt"></i>评价商品</a></p>
            </div>
          </div>
          <div class="ncs-goods-title-nav">
            <ul id="comment_tab">
              <li data-type="all" class="current"><a href="javascript:void(0);"><?php echo $lang['goods_index_evaluation'];?>(<?php echo intval($output['goods_evaluate_info']['all']);?>)</a></li>
              <li data-type="1"><a href="javascript:void(0);">好评(<?php echo intval($output['goods_evaluate_info']['good']);?>)</a></li>
              <li data-type="2"><a href="javascript:void(0);">中评(<?php echo intval($output['goods_evaluate_info']['normal']);?>)</a></li>
              <li data-type="3"><a href="javascript:void(0);">差评(<?php echo intval($output['goods_evaluate_info']['bad']);?>)</a></li>
            </ul>
          </div>
          <!-- 商品评价内容部分 -->
          <div id="goodseval" class="ncs-commend-main"></div>
        </div>
      </div>
      <div class="ncg-salelog">
        <div class="ncs-goods-title-bar hd">
          <h4><a href="javascript:void(0);"><?php echo $lang['goods_index_sold_record'];?></a></h4>
        </div>
        <div class="ncs-goods-info-content bd" id="ncGoodsTraded">
          <div class="top">
            <div class="price"><?php echo $lang['goods_index_goods_price'];?><strong><?php echo ($output['goods']['goods_price'] < 1)?"咨询客服":($lang['currency'].$output['goods']['goods_price']);?></div>
          </div>
          <!-- 成交记录内容部分 -->
          <div id="salelog_demo" class="ncs-loading"> </div>
        </div>
      </div>
      <div class="ncs-consult">
        <div class="ncs-goods-title-bar hd">
          <h4><a href="javascript:void(0);"><?php echo $lang['goods_index_goods_consult'];?></a></h4>
        </div>
        <div class="ncs-goods-info-content bd" id="ncGuestbook">
          <!-- 咨询留言内容部分 -->
          <div id="consulting_demo" class="ncs-loading"> </div>
        </div>
      </div>
      <?php if(!empty($output['goods_commend']) && is_array($output['goods_commend']) && count($output['goods_commend'])>1){?>
      <div class="ncs-recommend">
        <div class="title">
          <h4><?php echo $lang['goods_index_goods_commend'];?></h4>
        </div>
        <div class="content">
          <ul>
            <?php foreach($output['goods_commend'] as $key=>$goods_commend){?>
            <?php if($output['goods']['goods_id'] != $goods_commend['goods_id']){?>
            <li>
              <dl>
                <dt class="goods-name"><a href="<?php echo urlShop('goods', 'index', array('goods_id' => $goods_commend['goods_id']));?>" target="_blank" title="<?php echo $goods_commend['goods_name'];?>" name="goods_tuijian<?php echo $key;?>"><?php echo $goods_commend['goods_name'];?><em><?php echo $goods_commend['goods_jingle'];?></em></a></dt>
                <dd class="goods-pic"><a href="<?php echo urlShop('goods', 'index', array('goods_id' => $goods_commend['goods_id']));?>" target="_blank" title="<?php echo $goods_commend['goods_name'];?>" name="goods_tuijian<?php echo $key;?>"><img src="<?php echo thumb($goods_commend, 240);?>" alt="<?php echo $goods_commend['goods_name'];?>"/></a></dd>
                <dd class="goods-price"><?php if(intval($goods_commend['goods_price']) < 1){ ?>咨询客服<?php }else{ ?><em>￥</em><?php echo intval($goods_commend['goods_price']);?><?php } ?></dd>
              </dl>
            </li>
            <?php }?>
            <?php }?>
          </ul>
          <div class="clear"></div>
        </div>
      </div>
      <?php }?>
    </div>
    <div class="ncs-sidebar">
      <div class="ncs-sidebar-container">
        <div class="title">
          <h4>商品二维码</h4>
        </div>
        <div class="content">
          <div class="ncs-goods-code">
            <p><img src="<?php echo goodsQRCode($output['goods']);?>"  title="商品原始地址：<?php echo urlShop('goods', 'index', array('goods_id'=>$output['goods']['goods_id']));?>"></p>
            <span class="ncs-goods-code-note"><i></i>扫描二维码，手机查看分享</span> </div>
        </div>
      </div>
      <?php include template('store/callcenter');?>
      <?php include template('store/left');?>
    </div>
  </div>
</div>
<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php">
  <input id="act" name="act" type="hidden" value="buy" />
  <input id="op" name="op" type="hidden" value="buy_step1" />
  <input id="cart_id" name="cart_id[]" type="hidden"/>
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.charCount.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.F_slider.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" />
<script type="text/javascript">
/** 辅助浏览 **/


    //收藏分享处下拉操作
    jQuery.divselect = function(divselectid,inputselectid) {
      var inputselect = $(inputselectid);
      $(divselectid).mouseover(function(){
          var ul = $(divselectid+" ul");
          ul.slideDown("fast");
          if(ul.css("display")=="none"){
              ul.slideDown("fast");
          }
      });
      $(divselectid).live('mouseleave',function(){
          $(divselectid+" ul").hide();
      });
    };
$(function(){
	//赠品处滚条
	$('#ncsGoodsGift').perfectScrollbar();
    <?php if ($output['goods']['goods_state'] == 1 && $output['goods']['goods_storage'] > 0 ) {?>
    // 加入购物车
    $('a[nctype="addcart_submit"]').click(function(){
        addcart(<?php echo $output['goods']['goods_id'];?>, checkQuantity(),'addcart_callback');
    });
        <?php if (!($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_indate'] < TIMESTAMP)) {?>
        // 立即购买
        $('a[nctype="buynow_submit"]').click(function(){
            buynow(<?php echo $output['goods']['goods_id']?>,checkQuantity(),<?php echo $output['goods']['goods_price']?>);
        });
        <?php }?>
    <?php }?>
    // 到货通知
    <?php if ($output['goods']['goods_storage'] == 0 || $output['goods']['goods_state'] == 0) {?>
    $('a[nctype="arrival_notice"]').click(function(){
        <?php if ($_SESSION['is_login'] !== '1'){?>
        login_dialog();
        <?php }else{?>
        ajax_form('arrival_notice', '到货通知','<?php echo urlShop('goods', 'arrival_notice', array('goods_id' => $output['goods']['goods_id']));?>', 350);
        <?php }?>
    });
    <?php }?>
    <?php if (($output['goods']['goods_price'] <= 1 || $output['goods']['goods_storage'] <= 0) && $output['goods']['is_appoint'] == 1) {?>
    $('a[nctype="appoint_submit"]').click(function(){
        <?php if ($_SESSION['is_login'] !== '1'){?>
          
        <?php setNcCookie('yuyue_register','1');?>

        login_dialog();
        <?php }else{?>
        ajax_form('arrival_notice', '立即预约', '<?php echo urlShop('goods', 'arrival_notice', array('goods_id' => $output['goods']['goods_id'], 'type' => 2));?>', 350);
        <?php }?>
    });
    <?php }?>
	<?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
	$('a[nctype="share_submit"]').click(function(){
		<?php if ($_SESSION['is_login'] !== '1'){?>
		login_dialog();
		<?php }else{?>
		ajax_form('arrival_notice', '立即分享', '<?php echo urlShop('goods', 'share_notice', array('goods_id' => $output['goods']['goods_id']));?>', 650);
		<?php }?>
	});
	<?php }?>
    //浮动导航  waypoints.js
    $('#main-nav').waypoint(function(event, direction) {
        $(this).parent().parent().parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
    });

    // 分享收藏下拉操作
    $.divselect("#handle-l");
    $.divselect("#handle-r");

    // 规格选择
    $('dl[nctype="nc-spec"]').find('a').each(function(){
        $(this).click(function(){
            if ($(this).hasClass('hovered')) {
                return false;
            }
            $(this).parents('ul:first').find('a').removeClass('hovered');
            $(this).addClass('hovered');
            checkSpec();
        });
    });

});

function checkSpec() {
    var spec_param = <?php echo $output['spec_list'];?>;
    var spec = new Array();
    $('ul[nctyle="ul_sign"]').find('.hovered').each(function(){
        var data_str = ''; eval('data_str =' + $(this).attr('data-param'));
        spec.push(data_str.valid);
    });
    spec1 = spec.sort(function(a,b){
        return a-b;
    });
    var spec_sign = spec1.join('|');
    $.each(spec_param, function(i, n){
        if (n.sign == spec_sign) {
            window.location.href = n.url;
        }
    });
}

// 验证购买数量
function checkQuantity(){
    var quantity = parseInt($("#quantity").val());
    if (quantity < 1) {
        alert("<?php echo $lang['goods_index_pleaseaddnum'];?>");
        $("#quantity").val('1');
        return false;
    }
    max = parseInt($('[nctype="goods_stock"]').text());
    <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) {?>
    max = <?php echo $output['goods']['virtual_limit'];?>;
    if(quantity > max){
        alert('最多限购'+max+'件');
        return false;
    }
    <?php } ?>
	<?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
		max = <?php echo $output['goods']['tuijian_limit'];?>;
		if(quantity > max){
			alert('最多限购'+max+'件');
			return false;
		}
	<?php }else{ ?>
		<?php if (!empty($output['goods']['upper_limit'])) {?>
		max = <?php echo $output['goods']['upper_limit'];?>;
		if(quantity > max){
			alert('最多限购'+max+'件');
			return false;
		}
		<?php } ?>
	<?php } ?>
    if(quantity > max){
        alert("<?php echo $lang['goods_index_add_too_much'];?>");
        return false;
    }
    return quantity;
}

// 立即购买js
function buynow(goods_id,quantity,goods_price){
<?php if ($_SESSION['is_login'] !== '1'){?>
	login_dialog();
<?php }else{?>
    if (!quantity) {
        return;
    }
    if(goods_price < 1){
        return;
    }
    <?php if ($_SESSION['store_id'] == $output['goods']['store_id']) { ?>
    alert('不能购买自己店铺的商品');return;
    <?php } ?>
    $("#cart_id").val(goods_id+'|'+quantity);
    $("#buynow_form").submit();
<?php }?>
}

$(function(){
    //选择地区查看运费
    $('#transport_pannel>a').click(function(){
    	var id = $(this).attr('nctype');
    	if (id=='undefined') return false;
    	var _self = this,tpl_id = '<?php echo $output['goods']['transport_id'];?>';
	    var url = 'index.php?act=goods&op=calc&rand='+Math.random();
	    $('#transport_price').css('display','none');
	    $('#loading_price').css('display','');
	    $.getJSON(url, {'id':id,'tid':tpl_id}, function(data){
	    	if (data == null) return false;
	        if(data != 'undefined') {$('#nc_kd').html('运费<?php echo $lang['nc_colon'];?><em>' + data + '</em><?php echo $lang['goods_index_yuan'];?>');}else{'<?php echo $lang['goods_index_trans_for_seller'];?>';}
	        $('#transport_price').css('display','');
	    	$('#loading_price').css('display','none');
	        $('#ncrecive').html($(_self).html());
	    });
    });
    $("#nc-bundling").load('index.php?act=goods&op=get_bundling&goods_id=<?php echo $output['goods']['goods_id'];?>', function(){
        if($(this).html() != '') {
            $(this).show();
        }
    });
    $("#salelog_demo").load('index.php?act=goods&op=salelog&goods_id=<?php echo $output['goods']['goods_id'];?>&store_id=<?php echo $output['goods']['store_id'];?>&vr=<?php echo $output['goods']['is_virtual'];?>', function(){
        // Membership card
        $(this).find('[nctype="mcard"]').membershipCard({type:'shop'});
    });
	$("#consulting_demo").load('index.php?act=goods&op=consulting&goods_id=<?php echo $output['goods']['goods_id'];?>&store_id=<?php echo $output['goods']['store_id'];?>', function(){
		// Membership card
		$(this).find('[nctype="mcard"]').membershipCard({type:'shop'});
	});

/** goods.php **/
	// 商品内容部分折叠收起侧边栏控制
	$('#fold').click(function(){
  		$('.ncs-goods-layout').toggleClass('expanded');
	});
	// 商品内容介绍Tab样式切换控制
	$('#categorymenu').find("li").click(function(){
		$('#categorymenu').find("li").removeClass('current');
		$(this).addClass('current');
	});
	// 商品详情默认情况下显示全部
	$('#tabGoodsIntro').click(function(){
		$('.bd').css('display','');
		$('.hd').css('display','');
	});
	// 点击评价隐藏其他以及其标题栏
	$('#tabGoodsRate').click(function(){
		$('.bd').css('display','none');
		$('#ncGoodsRate').css('display','');
		$('.hd').css('display','none');
	});
	// 点击成交隐藏其他以及其标题
	$('#tabGoodsTraded').click(function(){
		$('.bd').css('display','none');
		$('#ncGoodsTraded').css('display','');
		$('.hd').css('display','none');
	});
	// 点击咨询隐藏其他以及其标题
	$('#tabGuestbook').click(function(){
		$('.bd').css('display','none');
		$('#ncGuestbook').css('display','');
		$('.hd').css('display','none');
	});
	//商品排行Tab切换
	$(".ncs-top-tab > li > a").mouseover(function(e) {
		if (e.target == this) {
			var tabs = $(this).parent().parent().children("li");
			var panels = $(this).parent().parent().parent().children(".ncs-top-panel");
			var index = $.inArray(this, $(this).parent().parent().find("a"));
			if (panels.eq(index)[0]) {
				tabs.removeClass("current ").eq(index).addClass("current ");
				panels.addClass("hide").eq(index).removeClass("hide");
			}
		}
	});
	//信用评价动态评分打分人次Tab切换
	$(".ncs-rate-tab > li > a").mouseover(function(e) {
		if (e.target == this) {
			var tabs = $(this).parent().parent().children("li");
			var panels = $(this).parent().parent().parent().children(".ncs-rate-panel");
			var index = $.inArray(this, $(this).parent().parent().find("a"));
			if (panels.eq(index)[0]) {
				tabs.removeClass("current ").eq(index).addClass("current ");
				panels.addClass("hide").eq(index).removeClass("hide");
			}
		}
	});

//触及显示缩略图
	$('.goods-pic > .thumb').hover(
		function(){
			$(this).next().css('display','block');
		},
		function(){
			$(this).next().css('display','none');
		}
	);

	/* 商品购买数量增减js */
	// 增加
	$('.increase').click(function(){
		num = parseInt($('#quantity').val());
	    <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) {?>
	    max = <?php echo $output['goods']['virtual_limit'];?>;
	    if(num >= max){
	        alert('最多限购'+max+'件');
	        return false;
	    }
	    <?php } ?>
		<?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
		max = <?php echo $output['goods']['tuijian_limit'];?>;
		if(num >= max){
			alert('最多限购'+max+'件');
			return false;
		}
		<?php }else{ ?>
	    <?php if (!empty($output['goods']['upper_limit'])) {?>
	    max = <?php echo $output['goods']['upper_limit'];?>;
	    if(num >= max){
	        alert('最多限购'+max+'件');
	        return false;
	    }
	    <?php } ?>
		<?php } ?>
		max = parseInt($('[nctype="goods_stock"]').text());
		if(num < max){
			$('#quantity').val(num+1);
		}
	});
	//减少
	$('.decrease').click(function(){
		num = parseInt($('#quantity').val());
		if(num > 1){
			$('#quantity').val(num-1);
		}
	});

    //评价列表
    $('#comment_tab').on('click', 'li', function() {
        $('#comment_tab li').removeClass('current');
        $(this).addClass('current');
        load_goodseval($(this).attr('data-type'));
    });
    load_goodseval('all');
    function load_goodseval(type) {
        var url = '<?php echo urlShop('goods', 'comments', array('goods_id' => $output['goods']['goods_id']));?>';
        url += '&type=' + type;
        $("#goodseval").load(url, function(){
            $(this).find('[nctype="mcard"]').membershipCard({type:'shop'});
        });
    }

    //记录浏览历史
	$.get("index.php?act=goods&op=addbrowse",{gid:<?php echo $output['goods']['goods_id'];?>});
	//初始化对比按钮
	initCompare();
});
/* 加入购物车后的效果函数 */
function addcart_callback(data){
	$('#bold_num').html(data.num);
    $('#bold_mly').html(price_format(data.amount));
    $('.ncs-cart-popup').fadeIn('fast');
}

function lepaiclockdone(){
    setTimeout("lepaiclockdone()", 1000);
    $(".leftTime").each(function(){
        var obj = $(this);
        var tms = obj.attr("count_down");
        var t = obj.attr("timestatus");
        if(t == 2){
            var html = '距结束：';
        }else{
            var html = '距开始：';
        }
        if (tms>0) {
            tms = parseInt(tms)-1;
            var days = Math.floor(tms / (1 * 60 * 60 * 24));
            var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
            var minutes = Math.floor(tms / (1 * 60)) % 60;
            var seconds = Math.floor(tms / 1) % 60;

            if(days > 0){
                html += "<span>"+days+"</span>天";
            }
            if(hours > 0){
                html += "<span>"+hours+"</span>时";
            }
            if(minutes > 0){
                html += "<span>"+minutes+"</span>分";
            }
            html += "<span>"+parseInt(seconds)+"</span>秒";
            obj.html(html);
            obj.attr("count_down",tms);
        }else{
            // location.href = location.href;
        }
    });
}
lepaiclockdone();//启动倒计时
</script>

<?php if($output['goods']['goods_state'] != 10 && $output['goods']['goods_verify'] == 1){?>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<?php } ?>