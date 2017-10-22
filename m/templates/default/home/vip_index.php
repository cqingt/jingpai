<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_vip.css">
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>





<div class="member-login">
  <a class="mem-img" href="">
     <img src="<?php echo getMemberAvatar($output['member_info']['member_avatar']);?>" alt="">
  </a>
  <div class="mem-word">
    <?php if(!$_SESSION['member_id']){?>
       <a class="memlook" href="<?php echo urlWap('login','index');?>">登陆查看会员信息</a>
    <?php }else{?>
       <strong><?php echo $output['member_info']['level_name'];?></strong>
       <h1><em><?php echo $output['member_info']['member_name'];?></em><i>(成长值<?php echo $output['member_info']['member_exppoints'];?>)</i></h1>
       <p>可用收藏币<?php echo $output['member_info']['member_points'];?></p>
       <p>可用优惠券<?php echo $output['userVoucherMax'];?>张</p>
    <?php }?>
  </div>
</div>




<!--banner-start-->
<div class="m_ww">
     <div class="swipe">
         <ul id="slider">
          <?php if($output['top']){?>
            <?php foreach($output['top'] as $k => $v){?>
             <li>
                 <a title="" href="<?php echo $v['Href'];?>" target="_blank"><img src="<?php echo $v['Img'];?>" alt="" width="100%"></a>
             </li>
             <?php }?>
          <?php }?>

         </ul>
         <div id="pagenavi">
              <a href="javascript:void(0);" class="active">0</a>
              <a href="javascript:void(0);" class="">1</a>
              <a href="javascript:void(0);" class="">2</a>
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
<!--banner-end-->
<div class="mss_vip_ul">
     <ul class="mss_vip_ulc">
           <li>
            <a href="http://www.96567.com/m/index.php?act=vip&op=integral_list">
               <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_vip_navimg1.png"></span>
               <span>礼品兑换</span>
            </a>
         </li>
         <li>
            <a href="http://www.96567.com/m/index.php?act=vip&op=discount_list">
                 <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_vip_navimg2.png"></span>
               <span>优惠券</span>
         </a>
         </li>
         <li>
            <a href="http://www.96567.com/m/index.php?act=lepai&op=index">
                 <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_vip_navimg3.png"></span>
               <span>拍卖惠</span>
            </a>
         </li>
         <li>
            <a href="http://www.96567.com/m/index.php?act=miaosha&op=index_list">
                 <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_vip_navimg4.png"></span>
               <span>秒杀</span>
            </a>
         </li>
         <li>
            <a href="http://www.96567.com/m/index.php?act=group_buy&op=index">
                 <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_vip_navimg5.png"></span>
               <span>藏品惠</span>
            </a>
         </li>
     </ul>
</div>




<!--优惠劵兑换 start-->
<div class="m_ww">
    <div class="m_vip_title"><span><a href="<?php echo urlWap('vip','discount_list');?>">更多>></a></span>优惠券兑换</div>
    
<?php if($output['recommend_voucher']){?>
<?php foreach($output['recommend_voucher'] as $k => $v){?>

    <div class="m_vip_yhj">
        <div class="m_vip_yhj_left">

<?php if($v['voucher_t_cate_rule'] == '3'){?>
<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['voucher_t_diff_goods']));?>">
<?php }else{?>
<a>
<?php }?>

      <img src="<?php echo $v['voucher_t_customimg'];?>" alt="" title="" width="100%"></a></div>
        <div class="m_vip_yhj_right">
               <dl>
                  <dd><?php echo $v['voucher_t_title'];?></dd>
                  <dt><strong><font color="#d2d2d2">￥</font><?php echo $v['voucher_t_price'];?></strong><i>有效期至<?php echo @date('Y-m-d',$v['voucher_t_end_date']);?></i></dt>
                  <span><!--优惠劵--></span>
               </dl>
               
               <div class="dhbox">
                    <span class="s_dhz"><i><?php echo $v['voucher_t_points'];?></i>积分</span>
                    <span class="s_dhan"><a href="javascript:;" onclick="discount_exchange(<?php echo $v['voucher_t_id'];?>);">立即<br>兑换</a></span>
               </div>
        </div>
    </div>
    <div class="m_vip_mb"></div>

<?php }?>
<?php }?>
         
</div>
<!--优惠劵兑换 end-->





<!--积分兑换 start-->
<div class="m_ww">
     <div class="m_vip_title"><span><a href="<?php echo urlWap('vip','integral_list');?>">更多>></a></span>礼品兑换</div>

<?php if($output['recommend_pointsprod_one']){?>

        <div class="m_vip_hg_hyzx">
          <div class="m_vip_hg_hyzx_left"><a href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$output['recommend_pointsprod_one']['pgoods_id']));?>" ><img src="<?php echo $output['recommend_pointsprod_one']['pgoods_image'];?>" alt="" title="" width="100%"></a></div>
          <div class="m_vip_hg_hyzx_right">
                 <dl>
                    <dd><?php echo $output['recommend_pointsprod_one']['pgoods_name'];?></dd>
                    <dt>
                       <strong><em class="em1"><?php echo $output['recommend_pointsprod_one']['pgoods_points'];?></em>积分</strong>
                             <!-- <i>已有 <font color="#e72a2d">1</font>人兑换</i> -->
            </dt>
                    <dt class="ljdh"><a href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$output['recommend_pointsprod_one']['pgoods_id']));?>" >立即兑换</a></dt>
                   </dl>
          </div>
        </div>     
<?php }?>


<?php if($output['recommend_pointsprod']){?>

     <div class="m_vip_hg" style="display:block">
      <?php foreach($output['recommend_pointsprod'] as $k => $v){?>
        <dl <?php if($k%2 != 0){echo "class='dllast'";}?>>
         <dd><a href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$v['pgoods_id']));?>" ><img src="<?php echo $v['pgoods_image'];?>" alt="" title="" width="100%"></a></dd>
         <dt class="dt01"><?php echo $v['pgoods_name'];?></dt>
         <dt class="dt02"><?php echo $v['pgoods_points'];?>积分</dt>
         <!-- <dt class="dt03">已有<i>1</i>人兑换</dt> -->
             <dt class="dt04"><a href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$v['pgoods_id']));?>">立即兑换</a></dt>
        </dl>
      <?php }?>
     </div>   

<?php }?>

</div>
<!--积分兑换 end-->


<script>
  function discount_exchange(id){
    if(confirm('确定要兑换该优惠券？')){
      $.ajax({
        type: "GET",
        cache: false,
        async: false,
        url : "<?php echo urlWap('vip','voucher_exchange');?>",
        data: 'vid=' + id,
        success : function(html){
          alert(html);
          if(html == '该用户未登录'){
            window.location.href="<?php echo urlWap('login','index');?>";
          }
        }
    }); 

    } 
  }
</script>


<?php 

$array['P']['title'] = '会员俱乐部,收藏天下优惠券,会员特价,优惠活动,礼品兑换,积分中心,抽奖';
$array['P']['imgUrl'] = 'http://m.96567.com/images/logo.png';
$array['Y']['title'] = '会员俱乐部,收藏天下优惠券,会员特价,优惠活动,礼品兑换,积分中心,抽奖';
$array['Y']['desc'] = '收藏天下会员俱乐部为全体收藏天下会员提供收藏币换券、礼品兑换服务和会员特价商品、收藏币抽奖等超值活动。来收藏天下会员俱乐部，享受优质会员服务！';
$array['Y']['imgUrl'] = 'http://m.96567.com/images/logo.png';

echo weixinShare($array);

?>