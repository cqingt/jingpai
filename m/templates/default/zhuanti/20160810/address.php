<h3>请正确填写收货信息领取藏品</h3>
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
<button class="tc-btn-vote mt" id="btnLingQu" onclick="btnLingQu();">提交</button>
<img class="what" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/what.jpg"/>
<script>
		//获取区域列表
	$(function(){
		add_list();
	});
	function add_list(){
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
	}
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
	</script>
