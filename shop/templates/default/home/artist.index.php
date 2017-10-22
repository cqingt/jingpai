<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/artist_style.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nc-appbar-tabs a.compare { display: none !important;}
</style>

<div class="hdwrap wrap">
   <img src="<?php echo '/'.$output['artist']['A_Topimg'];?>" width="1210" height="260">
</div>

<div class="wrap">
   <img class="mt30" src="<?php echo SHOP_TEMPLATES_URL;?>/images/artist/famous.jpg" alt="书画名家">
</div>

<div class="wrap">
   <div class="artleft fl">
      <div class="artimg oh"><img src="<?php echo '/'.$output['artist']['A_Img'];?>" alt=""></div>
      <?php if($output['artist']['A_QianYue'] == 1){?>
      <div class="artext"></div>
      <?php }?>
   </div>
   <div class="artright fr">
      <div class="aftname">
           <p class="fl"><?php echo $output['artist']['A_Name'];?></p>
            <?php foreach($output['zhi'] as $k=>$v){?>
               <span><?php echo $v;?></span>
            <?php }?>
        </div>
          <div class="artintroduce">
              <div style="width: 470px;
  float: left;">
               <?php echo html_entity_decode($output['artist']['A_JieShao']);?>
               </div>

               <ul class="artUl2">
                  <li>润　　格：<em><?php if($output['artist']['A_Money'] >= 1){ echo $output['artist']['A_Money'].'元/平方尺';}else{echo "咨询客服";}?></em></li>
                  <!-- <li>
                      <span><a href="">我要收藏</a></span>
                      <span><a href="">我要定制</a></span>
                  </li> -->
               </ul>
          </div>
      <div class="artcontent">
        <?php echo html_entity_decode($output['artist']['A_MiaoShu']);?>
      </div>
   </div>
</div>

<div class="wrap">
          <div class="resume">履历表</div>
          <div class="shmj_resume">
          <p></p>
      <div class="shmj_box">

<?php echo html_entity_decode($output['artist']['A_ShenYa']);?>

      </div>          
</div>

<div class="wrap">
   <div class="shmj_title2 oh">
      <p>作品展示</p>
      <!-- <a href="http://www.96567.com/shop/index.php?act=artist&op=list" target="_blank" style="">查看艺术家全部作品&gt;&gt;</a> -->
      <a href="###" target="_blank" style="">查看艺术家全部作品&gt;&gt;</a>
   </div>
   <ul class="works">

    <?php foreach($output['artistGoods'] as $k => $v){?>

     <li>
       <div class="worimg"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($v['goods_image'],360);?>" alt=""></a></div>
       <div class="wortex">
          <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank"><?php echo $v['goods_name'];?></a>
       </div>
       <div class="worRmb">
                  <p class="worp1"><?php if($v['goods_price'] == 0 ){echo '咨询客服';}else{echo '￥'.$v['goods_price'];}?></p>
                  <!-- <p class="worp2">咨询客服</p> -->
                  <p class="worp3">已定制 <em><?php echo $v['goods_salenum'];?></em> 件</p>
             </div>
     </li>
<?php }?>

   </ul>
</div>

<div class="wrap">
   <div class="shmj_title2 oh">
      <p>书画资讯</p>
   </div>
   <ul class="information">

<?php foreach($output['news'] as $k=>$v){?>
         <li>
          <span><?php echo date("Y-m-d",$v['article_publish_time']);?></span>
          <a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title'];?></a>
         </li>
<?php }?>

   </ul>
</div>

<div class="recommend">
   <div class="shmj_title1 oh">
          <p>艺术名家推荐</p>  
     </div>

     <div class="recdl">

<?php foreach($output['artistPush'] as $k => $v){?>
        <dl>
          <dd><a href="<?php echo url('artist','index',array('artist_id'=>$v['A_Id']));?>" target="_blank"><img src="<?php echo '/'.$v['A_Img'];?>"></a></dd>
          <dt class="recdt1"><a href="<?php echo url('artist','index',array('artist_id'=>$v['A_Id']));?>" target="_blank"><?php echo $v['A_Name'];?></a></dt>
          <dt class="recdt2"><?php echo $v['A_Zhi'];?></dt>
        </dl>
<?php }?>

     </div>
</div>
    </div>
