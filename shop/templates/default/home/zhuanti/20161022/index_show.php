	<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161022/css/new_file.css"/>
	<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
	<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161022/js/jquery.reveal.js"></script>
		<div class="photo1"></div>
		<div class="photo2"></div>
		<div class="photo3"></div>
		<div class="photo4"></div>
	    <div class="photo5">
			<div class="bar-wrap formbox1">
				 <input class="in1" type="text" value="" name="ordersn" id="ordersn" placeholder="输入订单号"/>
				 <input class="in2" type="button" value="领取" name=""  id="LingQu" />
				 <a href="javascript:;" class="big-link" data-reveal-id="mymodal-ht1" data-animation="fade">查看活动规则</a>
			</div>
	    </div>
	    <div class="photo6"></div>
	    <div class="photo7"></div>
	    <div class="photo8"></div>
	    <div class="photo9"></div>
	    <div class="photo10"></div>
 
	<?php if(!empty($output['goods_list'])){?>
		<div class="photo11">
			<div class="bar-wrap">
				<ul class="shopbox">
					<?php foreach ($output['goods_list'] as $k => $v){?>
						<li>
							<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
								<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>" /></div>
								<p class="text"><?php echo $v['goods_name'];?></p>
								<p class="rmb">¥<?php echo intval($v['promotion_price']) > 0 ? $v['promotion_price'] : $v['goods_price'];?></p>
								<strong>立即购买</strong>
							</a>
						</li>
					<?php }?>
				</ul>
				<a class="httop" href="http://www.96567.com/" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ht20161022/httop.jpg"/></a>
			</div>
		</div>
	<?php }?>
				
		<div id="mymodal-ht1" class="reveal-modal-ht rio word1">
			<div class="tcform">
				<h2>活动规则</h2>
				<p>1、活动时间：2016年10月24日——2016年10月31日</p>
				<p>2、活动期间，单笔订单满399元，且订单为已付款或已完成状态，凭订单号即可免费领取神十一航天员签名纪念封2枚和神舟十一号纪念封1枚；</p>
				<p>3、若已领取纪念封的订单发生退货，需将所领取的纪念封一并退回，如未退回，我们将在订单退款时扣除纪念封费用；</p>
				<p>4、本活动最终解释权归收藏天下所有。</p>
				
			</div>
			<a class="close-reveal-modal-ht"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ht20161022/close.jpg"/></a>
		</div>
		
				
		<div id="mymodal-ht2" class="reveal-modal-ht rio word2" style="opacity: 1; visibility: visible;display:none;">
			<div class="tcform">
				<input type="hidden" name="order_sn" id="order_sn" value=''>
				<input type="hidden" name="lid" id="lid" value=''>
				<h2>请填写收货地址</h2>
				<div class="dem-tiem">
					<input type="text" value="" name="true_name" id="true_name" placeholder="请输入姓名" />
				</div>
				<div class="dem-tiem">
					<input type="text" value="" name="mob_phone" id="mob_phone" placeholder="请输入手机号" />
				</div>
				<div class="dem-tiem" id="region">
					<select id='prov'></select>
					<input type="hidden" value="" name="city_id" id="city_id">
					<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
					<input type="hidden" name="area_info" id="area_info" class="area_names"/>
					
				</div>				
				<div class="dem-tiem">
					<input type="text" value="" name="address" id="address" placeholder="请输入收货地址" />
				</div>				
				<button class="btn-ht" id="btnLingQu">立即领取</button>
				
			</div>
			<a class="close-reveal-modal-ht" id="ying"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ht20161022/close.jpg"/></a>
		</div>		
<script>
$(document).ready(function(){
	regionInit("region");
});
$("#ying").bind("click", function() {
	$("#mymodal-ht2").hide();
});
$("#LingQu").bind("click", function() {
	var ordersn = $.trim($("#ordersn").val());
	if(ordersn == ''){
		alert('请输入订单号');
		return false
	}
	$("#LingQu").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20161022&action=YanZneg",
		data:{order_sn:ordersn},
		dataType:'json',
		success:function(result){
			if(result == -1){
				login_dialog();
				return false;
			}
			if(result.error){
				alert(result.error);
			}else{
				$("#lid").val(result.lid);
				$("#order_sn").val(result.order_sn);
				$("#mymodal-ht2").show();
			}
			$("#LingQu").attr("disabled",false);
		}
	}); 
});

$("#btnLingQu").bind("click", function() {
	 $('#city_id').val($('#region').find('select').eq(1).val());
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var area_info = $.trim($("#area_info").val());
		var city_id = $.trim($("#city_id").val());
		var area_id = $.trim($("#area_id").val());
		var address = $.trim($("#address").val());
		var prov = $.trim($("#prov").val());
		var order_sn = $.trim($("#order_sn").val());
		var lid = $.trim($("#lid").val());
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20161022&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,lid:lid,order_sn:order_sn},
			dataType:'json',
			success:function(result){
				if(result == -1){
					login_dialog();
					$("#btnLingQu").attr("disabled",false);
				}else if(result.error){
					alert(result.error);
					$("#btnLingQu").attr("disabled",false);
				}else if(result.state){
					alert('领取成功，在【我的订单】里查看详情');
					window.location.href="index.php?act=zhuanti&op=ad_20161022";
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
});
</script>