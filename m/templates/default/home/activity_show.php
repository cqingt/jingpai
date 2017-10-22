<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/component.css" />


 <!-- 20160510 s-->
          <article class="activity">
              
             <div class="activity-banner">
                <a href=""><img src="<?php if(is_file(BASE_UPLOAD_PATH.DS.ATTACH_ACTIVITY.DS.$output['activity']['activity_banner_m'])){echo UPLOAD_SITE_URL."/".ATTACH_ACTIVITY."/".$output['activity']['activity_banner_m'];}else{echo SHOP_TEMPLATES_URL."/images/sale_banner.jpg";}?>" alt=""></a>
             </div>



<?php if(!empty($output['out_list'])){ ?>
    <?php foreach ($output['out_list'] as $k=>$list) {?>


             <div class="activity-headline">
                 <h2><?php echo $k;?></h2>
             </div>






<ul class="activity-list">


    <?php if(is_array($list) and !empty($list)){?>
      <?php foreach ($list as $v) {?>
        <li>
           <div class="actimg">
              <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>"><img src="<?php echo thumb($v, 240);?>" alt=""<?php echo $v['goods_name'];?>""></a>
           </div>
           <div class="actcontent">
              <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>"><h1><?php echo $v['goods_name'];?></h1></a>
			  <?php if($v['xianshi_price']){ ?>
              <p class="p1">¥<?php echo $v['xianshi_price'];?></p>
              <p class="p2"><em>¥<?php echo ncPriceFormatForList($v['goods_price']);?></em><strong><?php echo ncPriceFormat(($v['xianshi_price'] / $v['goods_price'])*10);?>折</strong></p>
			  <?php }else{ ?>
					<p class="p1">¥<?php echo $v['goods_price'];?></p>
			  <?php } ?>
              <a class="btn-okey" href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">立即购买</a>
           </div>
        </li>

    <?php }?>
  <?php }?>

</ul>
          



    <?php } ?>
<?php } ?>


            <div class="pagination">
              <?php echo $output['show_page'];?>
            </div>
            <!-- 20160510 a-->

          </article>