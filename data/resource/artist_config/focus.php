<?php defined('InShopNC') or exit('Access Invalid!');?>


<?php if(!empty($output['code_screen_list']['code_info'])){?>
  <ul class="lunbotu_box">
  
  <?php foreach ($output['code_screen_list']['code_info'] as $k => $v){?>
    <li><a href="<?php echo $v['pic_url'];?>" target="_blank" style="background:url(<?php echo UPLOAD_SITE_URL."/".$v['pic_img'];?>) center top no-repeat"></a></li>
	
  <?php }?>
  </ul>

<?php }?>