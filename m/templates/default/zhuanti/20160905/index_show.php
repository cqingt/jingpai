
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/css/new_file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/css/component.css" />
	<div class="silver-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_01.jpg" alt="" />
		<img class="md-trigger" data-modal="modal-from2" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_02.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_03.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_04.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_05.jpg" alt="" />
		<div class="zqbox">
			<form action=""></form>
				<input type="text"  value=""  name="ordersn" id="ordersn" placeholder="输入订单号" />
				<button type="button" class="btn" id="LingQu">领取</button>
			
		</div>
		<img class="md-trigger" data-modal="modal-from2" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_08.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_09.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_10.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_11.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_12.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_13.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_14.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_15.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_16.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_17.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_18.jpg" alt="" />
		<div class="zqbox">
	        <ul class="shopbox">	
			<?php foreach ($output['goods_list'] as $k => $v){?>
				<li>
					<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id'])); ?>" title="<?php echo $v['goods_name'];?>" alt="<?php echo $v['goods_name'];?>">
						<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>" title="<?php echo $v['goods_name'];?>"></div>
						<p class="text"><?php echo $v['goods_name'];?></p>
						<p class="rmb"><sup>¥</sup><?php echo intval($v['promotion_price']) > 0 ? $v['promotion_price'] : $v['goods_price'];?></p>
						<strong>立即购买</strong>
					</a>
				</li>	
			<?php }?>
			</ul>
		</div>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/images/zq_20.jpg" alt="" />
	</div>

	<div class="md-modal md-effect-11" id="modal-from2">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
					<!-- Demo start 2-->
	     			<div class="demo formbox" id="c2">
	     			  <h3>活动规则</h3>
	                  <p>1、活动时间：2016年9月5日——2016年9月18日~</p>
	                  <p>2、活动期间，单笔订单满1288元，且订单已付款完成或已确认收货，凭订单号即可免费领取银月饼1对；</p>
	                  <p>3、若已领取银月饼的订单发生退货，需将所获赠的银月饼一同退回，如银月饼未退回，我们将在订单退款时扣除银月饼的费用；</p>
	                  <p>4、本活动最终解释权归收藏天下所有。</p>
					</div>
					<!-- Demo end -->  
                </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>

	        </div>
	    </div>
	</div>
 
	<div class="md-modal md-effect-11" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
					<!-- Demo start 2-->
	     			<div class="demo formbox" id="c2">
	     			  <h3>领取《银月饼》</h3>
					  <input type="hidden" name="order_sn" id="order_sn" value=''>
					 <input type="hidden" name="lid" id="lid" value=''>
	                  <span class="item">
	                  	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入收货人姓名" />
	                  </span>  
	                  <span class="item">
	                  	<input type="number" name="mob_phone" id="mob_phone" pattern="[0-9]*" value="" placeholder="请输入收货人电话" />
	                  </span>  
	                  <span class="item-select" id="region">
							<input type="hidden" value="" name="city_id" id="city_id">
							<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
							<input type="hidden" name="area_info" id="area_info" class="area_names"/>
							<select name="prov" id="vprov">
								<option value="">-请选择-</option>
							</select>
							<select name="city" id="vcity">
								<option value="">-请选择-</option>
							</select>
					   
							<select name="region" id="vregion">
								<option value="">-请选择-</option>
							</select>        			                  	
	                  </span>
	                  <span class="item">
	                  	<input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
	                  </span>  	                  
	                  <button class="tc-btn-vote mt" id="btnLingQu">免费领取</button>
	         
					</div>
					<!-- Demo end -->  
                </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>

	        </div>
	    </div>
	</div>
	 
	 <!-- 这是遮罩 -->
	<div class="md-overlay"></div>	
	<!-- 弹出层 End -->
	

 

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/js/modalEffects.js"></script>
	<script>
	$(".icon-close").bind("click", function() {
		$("#modal-from1").removeClass("md-show");
	});
	var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160905/js/';
		//获取区域列表
	$.ajax({
		type:'post',
		url:"<?php echo urlWap('zhuanti','area_list')?>",
		data:'',
		dataType:'json',
		success:function(result){
			var data = result.datas;
			var prov_html = '';
			for(var i=0;i<data.area_list.length;i++){
				prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
			}
			$("select[name=prov]").append(prov_html);
		}
	});
	$("select[name=prov]").change(function(){//选择省市
		var prov_id = $(this).val();
		if(prov_id==''){
			var region_html = '<option value="">-请选择-</option>'; 
			$("select[name=city]").html(region_html);
			return false;
			}
		
		$.ajax({
			type:'post',
			url:"<?php echo urlWap('zhuanti','area_list')?>",
			data:{area_id:prov_id},
			dataType:'json',
			success:function(result){
				var data = result.datas;
				var city_html = '<option value="">-请选择-</option>';
				for(var i=0;i<data.area_list.length;i++){
					city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
				}
				$("select[name=city]").html(city_html);
				$("select[name=region]").html('<option value="">-请选择-</option>');
			}
		});
	});

	$("select[name=city]").change(function(){//选择城市
		var city_id = $(this).val();
		if(city_id==''){
			var region_html = '<option value="">-请选择-</option>'; 
			$("select[name=region]").html(region_html);
			return false;
			}
		$.ajax({
			type:'post',
			url:"<?php echo urlWap('zhuanti','area_list')?>",
			data:{area_id:city_id},
			dataType:'json',
			success:function(result){
				var data = result.datas;
				var region_html = '<option value="">-请选择-</option>';
				for(var i=0;i<data.area_list.length;i++){
					region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
				}
				$("select[name=region]").html(region_html);
			}
		});
	});
	$("#btnLingQu").bind("click", function() {
			var true_name = $.trim($("#true_name").val());
			var mob_phone = $.trim($("#mob_phone").val());
			var prov_index = $('select[name=prov]')[0].selectedIndex;
			var city_index = $('select[name=city]')[0].selectedIndex;
			var region_index = $('select[name=region]')[0].selectedIndex;
			var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
			var prov = $('select[name=prov]').val();
			var city_id = $('select[name=city]').val();
			var area_id = $('select[name=region]').val();
			var address = $.trim($("#address").val());
			var order_sn = $.trim($("#order_sn").val());
			var lid = $.trim($("#lid").val());
			$("#btnLingQu").attr("disabled",true);
			$.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op=ad_20160905&action=lingqu",
				data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,lid:lid,order_sn:order_sn},
				dataType:'json',
				success:function(result){
					if(result == -1){
						window.location.href="index.php?act=login";
						$("#btnLingQu").attr("disabled",false);
						return false;
					}else if(result.error){
						alert(result.error);
						$("#btnLingQu").attr("disabled",false);
					}else if(result.state){
						alert('领取成功，在【我的订单】里查看详情');
						window.location.href="index.php?act=zhuanti&op=ad_20160905";
					}else{
						alert(result.msg);
						$("#btnLingQu").attr("disabled",false);
					}
				}
			}); 
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
			url:"index.php?act=zhuanti&op=ad_20160905&action=YanZneg",
			data:{order_sn:ordersn},
			dataType:'json',
			success:function(result){
				if(result == -1){
					window.location.href="index.php?act=login";
					return false;
				}
				if(result.error){
					alert(result.error);
				}else{
					$("#lid").val(result.lid);
					$("#order_sn").val(result.order_sn);
					$("#modal-from1").addClass("md-show");
					
				}
				$("#LingQu").attr("disabled",false);
			}
		}); 
	});
    </script>
 