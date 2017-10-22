<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161121_2/css/new_file.css"/>
	<div class="seven-bar">
		<img src="http://img.96567.com/images/qicai20161121app/seven3_01.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_02.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_03.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_04.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_05.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_06.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_07.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_08.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_09.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_10.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_11.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_12.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_13.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_14.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_15.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_16.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_17.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_18.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_19.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_20.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_21.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_22.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_23.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_24.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_25.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_26.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_27.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_28.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_29.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_30.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_31.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_32.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_33.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_34.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_35.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_36.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_37.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_38.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_39.jpg"/>
		<img src="http://img.96567.com/images/qicai20161121app/seven3_40.jpg"/>
		
		<div id="sevenNav" class="fosevenox">
          <span class="item">
          	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入姓名" />
          </span>	
          <span class="item">
          	<input type="tel" name="mob_phone" id="mob_phone" pattern="[0-9]*" value="" placeholder="请输入手机号" />
          </span>	        
          <span class="item">
          	<input type="tel" name="goodsnumber" id="goodsnumber" pattern="[0-9]*" value=""  placeholder="请输入购买套数" />
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
          	<input type="text" name="address" id="address" value="" placeholder="请输入收货地址" />
          </span>			 
          <p class="emphasis">(免快递费)</p>
          <p class="commitment">请你如实填写订单信息，我们将按照您所填写的信息发货！</p>
          <p class="commitment">郑重承诺：我们会严格保护用户个人信息，绝不外泄，请您放心填写</p>
          <button class="btn-go"  id="btnLingQu">立即下单</button>    
		</div>		
		<img src="http://img.96567.com/images/qicai20161121app/seven3_42.jpg"/>
	</div>
	
	<a class="seven-nav" href="#sevenNav"><img src="http://img.96567.com/images/qicai20161121app/btn-seven2.jpg"/></a>

	<script>
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
			var goodsnumber = $.trim($("#goodsnumber").val());
			var prov_index = $('select[name=prov]')[0].selectedIndex;
			var city_index = $('select[name=city]')[0].selectedIndex;
			var region_index = $('select[name=region]')[0].selectedIndex;
			var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
			var prov = $('select[name=prov]').val();
			var city_id = $('select[name=city]').val();
			var area_id = $('select[name=region]').val();
			var address = $.trim($("#address").val());
			var ua = "<?php echo $_GET['ua'];?>";
			$("#btnLingQu").attr("disabled",true);
			$.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op=ad_20161121_2&action=lingqu",
				data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goodsnumber:goodsnumber,ua:ua},
				dataType:'json',
				success:function(result){
					if(result.state){
						window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
					}else{
						alert(result.msg);
						$("#btnLingQu").attr("disabled",false);
					}
				}
			}); 
	});

	</script>

<?php


$array['P']['title'] = "精品七彩冰裂餐具套装29.8元包邮！";
$array['P']['imgUrl'] = '';
$array['Y']['title'] = "精品七彩冰裂餐具套装29.8元包邮！";
$array['Y']['desc'] = "精品七彩冰裂茶具一壶六杯套装29.8元包邮！仅1000套！";
$array['Y']['imgUrl'] = '';

echo weixinShare($array);

?> 