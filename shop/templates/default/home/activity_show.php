<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_activity.css" rel="stylesheet" type="text/css">

<div class="nch-activity">
  <div id="banner_box">


    <div class="pic">
  <div style="z-index: 900; height: 420px; background: url(<?php if(is_file(BASE_UPLOAD_PATH.DS.ATTACH_ACTIVITY.DS.$output['activity']['activity_banner'])){echo UPLOAD_SITE_URL."/".ATTACH_ACTIVITY."/".$output['activity']['activity_banner'];}else{echo SHOP_TEMPLATES_URL."/images/sale_banner.jpg";}?>) center top no-repeat;">
         </div></div>
    
  </div>
<?php if(!empty($output['out_list'])){ ?>
    <?php foreach ($output['out_list'] as $k=>$list) {?>
<div class="djh_titlebox">
     <div class="djh_title0725">
          <span><?php echo $k;?></span>
     </div>
</div>

  <div class="sale" id="sale">
    <ul>
      <?php if(is_array($list) and !empty($list)){?>
      <?php foreach ($list as $v) {?>
<!--       <li class="c1">
        <dl>
          <dt class="goodspic"><a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['goods_id']));?>" target="_blank"><img src="<?php echo thumb($v, 240);?>"/></a></dt>
          <dd class="goodsname"><a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['goods_id']));?>" target="_blank" title="<?php echo $v['goods_name'];?>"><?php echo $v['goods_name'];?></a></dd>
          <dd class="price">
            <h4><?php echo ncPriceFormatForList($v['goods_price']);?></h4>
          </dd>
        </dl>
      </li> -->
<li class="dz_chanpin " onmouseover="this.className='dz_chanpin_2 ',document.getElementById('tuangou1_<?php echo $v['goods_id'];?>').style.display='none',document.getElementById('tuangous1_<?php echo $v['goods_id'];?>').style.display='block' " onmouseout="this.className='dz_chanpin ',document.getElementById('tuangous1_<?php echo $v['goods_id'];?>').style.display='none',document.getElementById('tuangou1_<?php echo $v['goods_id'];?>').style.display='block'  ">

    <div class="cp_img">
         <a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['goods_id']));?>" target="_blank"><img src="<?php echo thumb($v, 240);?>" width="248" height="248" title="<?php echo $v['goods_name'];?>"></a>
    </div>

    <div class="cp_name">
         <a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['goods_id']));?>" target="_blank">
             <?php
             if($v['is_appoint'] == 1){
                 echo '<font color="red">[预约]</font>';
             }elseif($v['is_presell'] == 1){
                 echo '<font color="red">[预售]</font>';
             }
             ?>
             <?php echo $v['goods_name'];?></a>
    </div> 

    <div class="cp_price cp_price0715">
      <?php if($v['goods_price'] < 1){ ?>
      <div class="cp_zj">
              <span class=" cp_col cp_size">咨询客服</span>
         </div>
      <?php }else{ ?>
	  <?php if($v['xianshi_price']){ ?>
         <div class="cp_zj">
              <span class="cp_col">￥</span><span class=" cp_col cp_size"><?php echo $v['xianshi_price'];?></span>
         </div>
<!-- -->
<div class="zi_xq"><span class="cprice_left"><strong>￥<?php echo $v['goods_price'];?>&nbsp</strong><em class="cp_del"><?php echo ncPriceFormat(($v['xianshi_price'] / $v['goods_price'])*10);?>折</em></span></div>
			<?php }else{ ?>
				  <div class="cp_zj">
              <span class="cp_col">￥</span><span class=" cp_col cp_size"><?php echo $v['goods_price'];?></span>
					 </div>
			<?php } ?>
      <?php } ?>
         <div class="gm_dj" id="tuangou1_<?php echo $v['goods_id'];?>" style="display: block;"><span><?php echo intval($v['goods_click']);?></span>人在关注</div>
         <div class="gm_dj" id="tuangous1_<?php echo $v['goods_id'];?>" style="display: none;">
              <a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['goods_id']));?>" target="_blank">
                 <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/tg_05.jpg" width="98" height="30">
              </a>
         </div>
    </div>

</li>

      <?php }?>
      <?php }?>
    </ul>
  </div>
    <?php } ?>
<?php } ?>
</div>
