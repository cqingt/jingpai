<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161207_1/css/new_file.css"/>

<div class="chicken-bar">
    <img src="http://img.96567.com/images/chicken20161207APP/chicken_00.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_01.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_02.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_03.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_04.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_05.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_06.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_07.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_08.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_09.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_10.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_11.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_12.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_13.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_14.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_15.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_16.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_17.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_18.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_19.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_20.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_21.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_22.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_23.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_24.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_25.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_26.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_27.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_28.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_29.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_30.jpg"/>
	<img src="http://img.96567.com/images/chicken20161207APP/chicken_31.jpg"/>
	


	<div id="chickenNav" class="fochickenox">
		<form id="form1" class="form" action="<?php echo urlWap('zhuanti','ad_20161207_1',array('ua'=>$_GET['ua']?$_GET['ua']:'m','action'=>'lingqu'));?>" method="post">
		<h4>填写收货信息</h4>
      <span class="item">
      	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入收货人姓名：" />
      </span>	
      <span class="item">
      	<input type="tel" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入收货人电话：" />
      </span>	        
	  <div class="item">
	    <div class="txt">选择购买数量:</div>
		<div class="gw_num">
			<em class="jian">-</em>
			<input type="text" value="1" class="num" name="goods_sum" id="goods_sum"  maxlength='3' onkeyup="value=value.replace(/[^\d]/g,'')" >
			<em class="add">+</em>
		</div>
	  </div>  
	  <div class="item">
	  	  <strong>（购满5套即送央行发行纪念币）</strong>
	  </div>
      <span class="item-select">

		<input type="hidden" name="city_id" id="city_id">
		<input type="hidden" name="area_id" id="area_id" />
		<input type="hidden" name="area_info" id="area_info"/>

		<input type="hidden" name="prov_name" id="prov_name">
		<input type="hidden" name="city_name" id="city_name">
		<input type="hidden" name="region_name" id="region_name">


      	<select name="prov" id="vprov">
      		<option value="">省</option>
      	</select>
		<select name="city" id="vcity">
      		<option value="">市</option>
      	</select>	
		<select name="region" id="vregion">
      		<option value="">区</option>
      	</select>

      </span>
      <span class="item">
      	<input type="text" name="address" id="address" value="" placeholder="请输入详细地址：" />
      </span>	

	<?php Security::getToken();?>
	<input type="hidden" name="form_submit" value="ok">	

      <span class="item error-tips" style="font-size:18px;"></span>

      <p class="emphasis">(免快递费)</p>
      <p class="commitment">请你如实填写订单信息，我们将按照您所填写的信息发货！</p>
      <p class="commitment">郑重承诺：我们会严格保护用户个人信息，绝不外泄，请您放心填写</p>
      <button class="btn-go">立即抢购</button>    
      </form>
	</div>	


</div>

<div class="chicken-nav"><a class="" href="#chickenNav">立即抢购</a></div>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(document).ready(function(){

	// 登录
	$("#form1").validate({
		errorElement: "span",
		debug:true,

		submitHandler:function() {
            ajaxSubmitForm();
        },

	    errorPlacement: function(error, element){
	    	error.appendTo($(".error-tips").show());
	    },
	    rules: {
	        true_name: "required",
	        mob_phone: "required",
	        goods_sum: "required",
	        prov: "required",
	        city: "required",
	        region: "required",
	        address: "required"
	    },
	    messages: {
	        true_name: "用户姓名不能为空！",
	        mob_phone: "手机号不能为空！",
	        goods_sum: "订购数量不能为空！",
	        prov: "省不能为空！",
	        city: "市不能为空！",
	        region: "区不能为空！",
	        address: "详细地址不能为空！"
	    }

	});

function ajaxSubmitForm(){
	var url = $("#form1").attr('action');
	var true_name = $("#true_name").val();
    var mob_phone = $("#mob_phone").val();
    var goods_sum = $("#goods_sum").val();
    var prov = $("#prov_name").val();
    var city = $("#city_name").val();
    var region = $("#region_name").val();
    var address = $("#address").val();
    var city_id = $("#city_id").val();
    var area_id = $("#area_id").val();
    var area_info = $("#area_info").val();
	var data = {'true_name':true_name,'mob_phone':mob_phone,'goods_sum':goods_sum,'prov':prov,'city':city,'region':region,'address':address,'city_id':city_id,'area_id':area_id,'area_info':area_info};

	$.ajax({
		type:'post',
		url:url,
		data:data,
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
			}else{
				alert(result.msg);
			}
		}
	});

}


	//加
	$(".add").click(function(){
	var n=$(this).prev().val();
	var num=parseInt(n)+1;
	if(num==1000){ return;}
	$(this).prev().val(num);
	});
	//减
	$(".jian").click(function(){
	var n=$(this).next().val();
	var num=parseInt(n)-1;
	if(num==0){ return}
	$(this).next().val(num);
	});
})







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
			prov_html+='<option value="'+data.area_list[i].area_id+'"  id="prov_'+data.area_list[i].area_id+'" data-value="'+data.area_list[i].area_name+'">'+data.area_list[i].area_name+'</option>';
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
	
	$("input[name='prov_name']").val($("#prov_"+prov_id).attr('data-value'));

	$("input[name='city_id']").val($("#prov_"+prov_id).val());


	$.ajax({
		type:'post',
		url:"<?php echo urlWap('zhuanti','area_list')?>",
		data:{area_id:prov_id},
		dataType:'json',
		success:function(result){
			var data = result.datas;
			var city_html = '<option value="">-请选择-</option>';
			for(var i=0;i<data.area_list.length;i++){
				city_html+='<option value="'+data.area_list[i].area_id+'" id="city_'+data.area_list[i].area_id+'" data-value="'+data.area_list[i].area_name+'">'+data.area_list[i].area_name+'</option>';
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

	$("input[name='city_name']").val($("#city_"+city_id).attr('data-value'));
	$("input[name='area_id']").val($("#city_"+city_id).val());

	$.ajax({
		type:'post',
		url:"<?php echo urlWap('zhuanti','area_list')?>",
		data:{area_id:city_id},
		dataType:'json',
		success:function(result){
			var data = result.datas;
			var region_html = '<option value="">-请选择-</option>';
			for(var i=0;i<data.area_list.length;i++){
				region_html+='<option value="'+data.area_list[i].area_id+'" id="region_'+data.area_list[i].area_id+'" data-value="'+data.area_list[i].area_name+'">'+data.area_list[i].area_name+'</option>';
			}
			$("select[name=region]").html(region_html);
		}
	});
});


$("select[name=region]").change(function(){//选择城市
	var region_id = $(this).val();

	$("input[name='region_name']").val($("#region_"+region_id).attr('data-value'));
	$("input[name='area_info']").val($("#region_"+region_id).val());


});








</script>
<?php

$array['P']['title'] = "2017鸡年纯金大红包";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161207_1/images/1207.jpg";
$array['Y']['title'] = "2017鸡年纯金大红包";
$array['Y']['desc'] = "2017鸡年纯金大红包限量发售！建国钞、人民币设计大师亲自设计，奢华纯金，送礼有面子！";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161207_1/images/1207.jpg";

echo weixinShare($array);

?> 