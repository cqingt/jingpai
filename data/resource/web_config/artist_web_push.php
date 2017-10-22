<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="art-home-title wrapper">
   <h2>收藏推荐</h2>
</div>

<div class="collect wrapper">
  <ul class="collect-nav handover_title">
    <li class="on"><strong>新品</strong><em>NEW</em></li>
    <li><strong>精品</strong><em>Boutique</em></li>
    <li><strong>热卖</strong><em>Hot</em></li>
  </ul>

  <div class="collect-con handover_con">

<?php if(!empty($output['code_recommend_list']['code_info'])){?>
  <?php foreach ($output['code_recommend_list']['code_info'] as $k => $v){?>
    
    <?php if(!empty($v['pic_list'])){?>
    <div class="demo">
      <ul class="collect-list">

        <li>
          <a href="<?php echo $v['pic_list']['12']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['12']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['12']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['12']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['14']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['14']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['14']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['14']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['21']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['21']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['21']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['21']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['31']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['31']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['31']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['31']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['32']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['32']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['32']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['32']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['33']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['33']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['33']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['33']['pic_goods_price']);?></em>
          </div>          
        </li>

        <li>
          <a href="<?php echo $v['pic_list']['24']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['24']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['24']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['24']['pic_goods_price']);?></em>
          </div>          
        </li>

      </ul>
    </div>

    <?php }?>

  <?php }?>
<?php }?>
  </div>
</div>