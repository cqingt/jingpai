<?php defined('InShopNC') or exit('Access Invalid!');?>
<style type="text/css">
#box {
	background: #FFF;
	width: 238px;
	height: 410px;
	margin: -390px 0 0 0;
	display: block;
	border: solid 4px #D93600;
	position: absolute;
	z-index: 999;
	opacity: .5
}
.shopMenu {
	position: fixed;
	z-index: 1;
	right: 25%;
	top: 0;
}
.goods-price strong {
    display: block; float: left;
    margin-left: 12px;
    font-weight: 100;
    background: red;
    color: #fff;
    padding: 0 4px;
}
</style>
<div class="squares" nc_type="current_display_mode">
    <input type="hidden" id="lockcompare" value="unlock" />
  <?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
  <ul class="list_pic">
    <?php foreach($output['goods_list'] as $value){?>
    <li class="item">
        <?php if ($value['is_virtual'] == 1) {?>
            <div class="top-icon" title="虚拟兑换商品">虚拟兑换</div>
        <?php }?>
        <?php if ($value['is_fcode'] == 1) {?>
            <div class="top-icon" title="F码优先购买商品">F码优先</div>
        <?php }?>
        <?php if ($value['is_presell'] == 1) {?>
            <div class="top-icon" title="预售购买商品">预售</div>
        <?php }?>
        <?php if ($value['have_gift'] == 1) {?>
            <div class="top-icon" title="赠品">赠品</div>
        <?php }?>
      <div class="goods-content" nctype_goods=" <?php echo $value['goods_id'];?>" nctype_store="<?php echo $value['store_id'];?>">
        <div class="goods-pic"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>" target="_blank" title="<?php echo $value['goods_name'];?>"><img src="<?php echo thumb($value, 240);?>" title="<?php echo $value['goods_name'];?>" alt="<?php echo $value['goods_name'];?>" /></a></div>
        <?php if (C('groupbuy_allow') && $value['goods_promotion_type'] == 1) {?>
        <!-- <div class="goods-promotion"><span>藏品惠</span></div> -->
        <?php } elseif (C('promotion_allow') && $value['goods_promotion_type'] == 2)  {?>
        <!-- <div class="goods-promotion"><span>限时折扣</span></div> -->
        <?php }?>
        <div class="goods-info">
          <div class="goods-pic-scroll-show">
            <ul>
            <?php if(!empty($value['image'])) {?>
              <?php $i=0;foreach ($value['image'] as $val) {$i++?>
              <li<?php if($i==1) {?> class="selected"<?php }?>><a href="javascript:void(0);"><img src="<?php echo thumb($val, 60);?>"/></a></li>
              <?php }?>
            <?php } else {?>
              <li class="selected"><a href="javascript:void(0);"><img src="<?php echo thumb($value, 60);?>" /></a></li>
            <?php }?>
            </ul>
          </div>
          <div class="goods-name"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>" target="_blank" title="<?php echo $value['goods_name'];?>"><?php echo $value['goods_name_highlight'];?><em><?php echo $value['goods_jingle'];?></em></a></div>
          <div class="goods-price"> 
		  <?php if(intval($value['promotion_price']) > 0){ ?><em class="sale-price" title="<?php echo $value['promotion_type'].$lang['nc_colon'].$lang['currency'].$value['promotion_price'];?>"><?php echo ncPriceFormatForList($value['promotion_price']);?></em><?php }else{ ?>
		  <?php if(intval($value['goods_price']) < 1){ ?><em class="sale-price">咨询客服</em><?php }else{ ?><em class="sale-price" title="<?php echo $lang['goods_class_index_store_goods_price'].$lang['nc_colon'].$lang['currency'].$value['goods_price'];?>"><?php echo ncPriceFormatForList($value['goods_price']);?></em><?php if(intval(C('show_goods_marketprice'))){?><em class="market-price" title="市场价：<?php echo $lang['currency'].$value['goods_marketprice'];?>"><?php echo ncPriceFormatForList($value['goods_marketprice']);?></em><?php }?><?php } ?><?php } ?>
			<?php if($value['promotion_type']){ ?>
			<strong><?php echo $value['promotion_type'];?></strong>
			<?php } ?>
		  <!-- <span class="raty" data-score="<?php echo $value['evaluation_good_star'];?>"></span> -->  <!-- <em class="market-price"><?php echo $value['promotion_type'];?></em> -->
		  
		  </div>
         
<!--           <div class="goods-sub">
               <div class="sell-stat">
                    <ul>
                       <li><a href="<?php echo urlShop('goods', 'index', array('goods_id' => $value['goods_id']));?>#ncGoodsRate" target="_blank" class="status"><?php echo $value['goods_salenum'];?></a>
                         <p>商品销量</p>
                       </li>
                       <li><a href="<?php echo urlShop('goods', 'comments_list', array('goods_id' => $value['goods_id']));?>" target="_blank"><?php echo $value['evaluation_count'];?></a>
                         <p>用户评论</p>
                       </li>
                       <li><em ><a class="chat chat_online" title="在线联系" target="_blank" href="http://kefu.qycn.com/vclient/chat/?websiteid=109465&groupid=38509">在线</a>&nbsp;</em><p>在线客服</p></li>
                       <li><em member_id="<?php echo $value['member_id'];?>">&nbsp;</em></li>
                    </ul>
               </div>
          </div> -->

        <div class="store">
          
             <a href="<?php echo urlShop('show_store','index',array('store_id'=>$value['store_id']), $value['store_domain']);?>" title="<?php echo $value['store_name'];?>" class="name"><?php echo $value['store_name'];?></a>
			 <!--http://kefu.qycn.com/vclient/chat/?websiteid=109465&amp;groupid=38509-->
             <a class="icon-chat-right" href="JavaScript:void(0);" title="在线联系" <?php if($value['is_own_shop'] == 1){?> 
		onclick="NTKF.im_openInPageChat('sc_1000_9999')"
	<?php
	}else{
	?>
		onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($value['store_id']);?>_9999')"
	<?php
	}
	?>></a>
        </div>

      </div>
    </li>
    <?php }?>
    <div class="clear"></div>
  </ul>
  <?php }else{?>
  <div id="no_results" class="no-results"><i></i><?php echo $lang['index_no_record'];?></div>
  <?php }?>
</div>
<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php" target="_blank">
  <input id="act" name="act" type="hidden" value="buy" />
  <input id="op" name="op" type="hidden" value="buy_step1" />
  <input id="goods_id" name="cart_id[]" type="hidden"/>
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function(){
        $('.raty').raty({
            path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
            readOnly: true,
            width: 80,
            score: function() {
              return $(this).attr('data-score');
            }
        });
      	//初始化对比按钮
    	initCompare();
    });
</script> 
