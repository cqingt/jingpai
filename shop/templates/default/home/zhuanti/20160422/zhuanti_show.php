<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/css/new_file.css"/>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/js/jq_scroll.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $("#scrollDiv-one").Scroll({line:1,speed:500,timer:2000});
});
$(document).ready(function(){
        $("#scrollDiv-two").Scroll({line:1,speed:500,timer:3000,up:"but_up",down:"but_down"});
});
</script>
<div class="banner1">
</div>
<div class="banner2">
</div>
<div class="banner3">
</div>
<div class="banner4">
</div>
<a href="#yuding" class="banner5">
</a>
<div class="flotage">
	<h2>中国区预定配额还剩</h2>
	<p><strong>套</strong><em><?php echo $output['shuliang']; ?></em></p>
</div>

<div class="content">
	<div class="lot-photo">
 
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/2.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/3.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/4.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/5.jpg"/>
		<a href="#yuding"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/6.jpg"/></a>
		<a href="#yuding"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/7.jpg"/></a>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/8.jpg"/>
		<a href="#yuding"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/9.jpg"/></a>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/10.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/11.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/12.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/13.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/14.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/15.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/16.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/17.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/18.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/19.jpg"/>
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/22.jpg"/>
	</div>
	<a name="yuding"></a>
	<div class="main">
		<div class="form-input" >
			<div class="rio2016">
				<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/rio2016.jpg" alt="">
			</div>
			<div class="in">
				<label for="">姓名：</label>
				<input type="text" name="true_name" id="true_name" value="" />
			</div>
			<div class="in">
				<label for="">手机：</label>
				<input type="text" name="mob_phone" id="mob_phone" value="" />
			</div>
<!-- 			<p class="last">支付方式：货到付款</p> -->
			<button id="submit" class="btn-okey"><!--提交--></button>
		</div>
		<div class="roll-list">
			<div class="scrollDiv-top" id="scrollDiv-one">
				<ul class="line">
					<?php foreach($output['o_list'] as $k => $vv){?>
					<li>
						<p><strong><?php echo mb_substr($vv['buyer_name'], 0, 1, 'utf-8').'**'; ?></strong><?php echo $vv['goods_name']; ?></p>
						<p><em><?php echo date('Y-m-d', time()); ?></em><span>
						已发货
						<!---
						<?php if($vv['order_state']=='10'){ ?>未付款
						<?php }elseif($vv['order_state']=='20'){ ?>已付款
						<?php }elseif($vv['order_state']=='30'){ ?>未发货
						<?php }elseif($vv['order_state']=='40'){ ?>已发货
						<?php }?>
						--->
						</span></p>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="rio-comment">
		<div id="scrollDiv-two">
		<ul>
			<?php foreach($output['c_list'] as $k => $v){ ?>
			<li>
				<div class="commentimg">
					<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/default.jpg"/>
				</div>
				<div class="alllist">
					<p><strong class="name"><?php echo mb_substr($v['geval_frommembername'], 0, 1, 'utf-8').'**'; ?></strong><em class="time"><?php echo date('[Y-m-d]', time()); ?></em></p>
					<p>用户评论：
					 <span class="raty">
					 	<?php if($v['geval_scores']=='1'){ ?><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="1" title="很满意"/>
						<?php }elseif($v['geval_scores']=='2'){ ?><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="1" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="2" title="很满意"/>
						<?php }elseif($v['geval_scores']=='3'){ ?><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="1" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="2" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="3" title="很满意"/>
						<?php }elseif($v['geval_scores']=='4'){ ?><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="1" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="2" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="3" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="4" title="很满意"/>
						<?php }elseif($v['geval_scores']=='5'){ ?><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="1" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="2" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="3" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="4" title="很满意"/>
					 	<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160422/images/star.jpg" alt="5" title="很满意"/>
						<?php }?>
					 </span>
					</p>
					<p class="last">
					  <span>
					  	评论详情：
					  </span>
					 <span class="remark">
					 	<?php echo $v['geval_content'];?>
					 </span>
					</p>
				</div>
			</li>
			<?php }?>
		</ul>
		</div>
		<div class="scroltit"><div class="updown" id="but_down">向上</div><div class="updown" id="but_up">向下</div></div>
	</div>
	
</div>
<div class="footer">
	<div class="footer-con">
		<p class="p1">剩余<?php echo $output['shuliang']; ?>套</p>
		<p class="p2">官方授权 • 奥组委认证</p>
		<p class="p3">
			<strong>全国统一抢订专线：</strong>
			<em>400-01-96567</em>
		</p>
	</div>
</div>

<script type="text/javascript">

$(function () { 
	$(window).scroll(function () { 
		if ($(window).scrollTop() > 1050) { 
		   $(".footer").fadeIn(500); 
		} 
		else { 
		   $(".footer").fadeOut(500); 
		} 
	}); 
}); 


$("#submit").bind("click", function() {
    var true_name = $.trim($("#true_name").val());
    var mob_phone = $.trim($("#mob_phone").val());
	var ua = '<?php echo $_GET["ua"];?>';
    // alert(mob_phone);die;
    $.ajax({
      type:'post',
      url:"index.php?act=zhuanti&op=ad_20160425",
      data:{true_name:true_name,mob_phone:mob_phone,ua:ua},
      dataType:'json',
      success:function(result){
		  if(result.state){
			alert(result.state);
			window.location.reload();
		  }else{
			alert(result.msg);
		  }
       }
    });
  });
</script>
