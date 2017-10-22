<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>





<div style='width:100%;overflow:hidden;background:#fff;'>
   <div class="auction_phone_product_start_banner">
      <ul id="slider">
        <li style="display:block">
            <img src="<?php echo $output['prodinfo']['pgoods_image'];?>" alt="" jqimg="images/201506/goods_img/9785_P_1433975538932.jpg"  width="320" height="320"/></a>
        </li>

      </ul>
        <div id="pagenavi">
         <!-- <a href="javascript:void(0);" class="active">1</a>
         <a href="javascript:void(0);" class="active">2</a>
         <a href="javascript:void(0);" class="active">3</a> -->
      </div>
   </div>
</div>
<script type="text/javascript">
  var active=0,
    as=document.getElementById('pagenavi').getElementsByTagName('a');
    
  for(var i=0;i<as.length;i++){
    (function(){
      var j=i;   
      as[i].onclick=function(){
        t2.slide(j);
        return false;
      }
    })();
  }
  var t1=new TouchScroll({id:'wrapper','width':5,'opacity':0.7,color:'#555',minLength:20});
  var t2=new TouchSlider({id:'slider', speed:600, timeout:6000, before:function(index){
      as[active].className='';
      active=index;
      as[active].className='active';
    }});
</script>   
<script type="text/javascript"> 
  function margin_type(type){
    if(type == 1){
      $("#margin_xianjin").css({border:"1px solid #a20000"});
      $("#margin_scb").css({border:"1px solid #ccc"});
      // $("#margin_xianjin").addClass('auction_phone_product_start_status_margin_right_active');
      // $("#margin_scb").removeClass('auction_phone_product_start_status_margin_right_active');
       document.getElementById("margintype").value = 1;
    }
    if(type == 2){
      $("#margin_scb").css({border:"1px solid #a20000"});
      $("#margin_xianjin").css({border:"1px solid #ccc"});
      // $("#margin_xianjin").removeClass('auction_phone_product_start_status_margin_right_active');
      // $("#margin_scb").addClass('auction_phone_product_start_status_margin_right_active');
      document.getElementById("margintype").value = 2;
    }
  }
</script>

 <div class="mss_vip_center">
      <header>
        <div class="mss_vip_cc">
          <div class="mss_vip_hp"><p><?php echo $output['prodinfo']['pgoods_points'];?>积分</p><s>￥<?php echo $output['prodinfo']['pgoods_price'];?></s></div>
          <div class="mss_vip_title">
               <div class="mss_vip_tit">
                  <strong><?php echo $output['prodinfo']['pgoods_name'];?>
                      <!--<a href="javascript:collect(9481)"><img src="themes/96567goods/images/mss_header_dott.jpg" /></a>-->
                      <a href="<?php echo urlWap('vip','integral_exchange_order',array('pgid'=>$output['prodinfo']['pgoods_id']));?>">
                        立即兑换
                      </a>
                  </strong>
               </div>
          </div>
        </div>
      </header>


      <ul class="mss_vip_ul">

        <li><a class="mss_vip_a" href="#spxq"><span>商品详情</span><span>&gt;</span></a></li>

      </ul>
</div>



<div style="padding:20px 2%; color:#e4393c; font-weight:bold; border-top:1px solid #e4393c;">
   商品详情：
   <a id="spxq"></a>
</div>

<?php echo $output['prodinfo']['pgoods_body'];?>

