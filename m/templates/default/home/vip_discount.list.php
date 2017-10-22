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

<?php if($output['voucherlist']){?>

          <span id="lmlm_pic">
<?php foreach($output['voucherlist'] as $k => $v){?>

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
                           <span class="s_dhan"><a href="javascript:;"  onclick="discount_exchange(<?php echo $v['voucher_t_id'];?>);">立即<br>兑换</a></span>
                      </div>
                 </div>
                </div>
                <div class="m_vip_mb"></div>

<?php }?>
          </span>
<?php }?>

<?php echo $output['show_page'];?>

     <span id='loadingsave'>
           <!-- 两种状态 之 2 -->
           <a href="<?php echo urlWap('vip','index');?>" style="display:block; text-align:center;">
              没有喜欢的？去俱乐部发现更多惊喜&gt;&gt;
           </a>
     </span>
</div>
<!--会员活动 end-->


<script>
  function discount_exchange(id){
    $.ajax({
        type: "GET",
        cache: false,
        async: false,
        url : "<?php echo urlWap('vip','voucher_exchange');?>",
        data: 'vid=' + id,
        success : function(html){
          alert(html);
        }
    });  
  }
</script>