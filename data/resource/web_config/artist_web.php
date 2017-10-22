<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="art-works wrapper">
  <div class="works-title">
    <h2><?php echo $output['code_recommend_list']['show_name'];?></h2>
    <ul class="handover_title">

<?php if(!empty($output['code_recommend_list']['code_info'])){?>
  <?php foreach ($output['code_recommend_list']['code_info'] as $k => $v){?>
      <li <?php if($k == 1){echo 'class=\'on\'';}?>><?php echo $v['recommend']['name'];?></li>
  <?php }?>
<?php }?>

    </ul>
  </div>

  <div class="works-con handover_con">

<?php if(!empty($output['code_recommend_list']['code_info'])){?>
  <?php foreach ($output['code_recommend_list']['code_info'] as $k => $v){?>
    
    <?php if(!empty($v['pic_list'])){?>


    <div class="demo">
      <ul class="collect-list">

        <li>
          <a href="<?php echo $v['pic_list']['11']['pic_url'];?>" target="_blank">
            <img src="<?php echo UPLOAD_SITE_URL.'/'.$v['pic_list']['11']['pic_img'];?>"/>
          </a>
          <div class="suspend">
            <h2><?php echo $v['pic_list']['11']['pic_name'];?></h2>
            <em><?php echo ncPriceFormatForList($v['pic_list']['11']['pic_goods_price']);?></em>
          </div>          
        </li>

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

    <?php }else{?>

    <div class="demo">
      <ul class="works-list1">

      <?php foreach ($v['goods_list'] as $key => $val){?>


        <li>
          <a href="<?php echo urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>" target="_blank">
            <div class="worksimg">
              <img src="<?php echo strpos($val['goods_pic'],'http')===0 ? $val['goods_pic']:UPLOAD_SITE_URL."/".$val['goods_pic'];?>" alt="<?php echo $val['goods_name']; ?>"/>
            </div>
            <h2><?php echo $val['goods_name']; ?></h2>
            <h5><?php echo $val['goods_artist_name']; ?></h5>
            <h6><?php echo $val['goods_artist_zhiwei']; ?></h6>
            <em><?php echo ncPriceFormatForList($val['goods_price']); ?></em>
          </a>
        </li>

      <?php }?>
     
      </ul>
    </div>

    <?php }?>

  <?php }?>
<?php }?>
  </div>
</div>