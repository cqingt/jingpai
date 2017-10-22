<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_vip.css">
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>




<!--会员活动 start-->
<div class="m_ww">
     <div class="m_vip_title"></div>

<?php if($output['pointprod_list']){?>

<?php foreach($output['pointprod_list'] as $k => $v){?>
  <div class="m_vip_hg_hyzx">
       <div class="m_vip_hg_hyzx_left">
            <a href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$v['pgoods_id']));?>" >
               <img src="<?php echo $v['pgoods_image'];?>" alt="" title="" width="100%">
            </a>
        </div>
        <div class="m_vip_hg_hyzx_right">
       <dl>
          <dd style="width: 100%;"><?php echo $v['pgoods_name'];?></dd>
          <dt>
             <strong><em class="em1"><?php echo $v['pgoods_points'];?></em>积分</strong>
             <!-- <i>已有 <font color="#e72a2d">1</font>人兑换</i> -->
          </dt>
          <dt class="ljdh"><a href="javascript:window.location.href='<?php echo urlWap('vip','integral_goods',array('goods_id'=>$v['pgoods_id']));?>';">立即兑换</a></dt>
        </dl>
        </div>
  </div>
<?php }?>

<?php }?>




<?php echo $output['show_page'];?>

     <span id='loadingsave'>
           <!-- 两种状态 之 2 -->
           <a href="vip.html" style="display:block; text-align:center;">
              没有喜欢的？去俱乐部发现更多惊喜&gt;&gt;
           </a>
     </span>
</div>
<!--会员活动 end-->
