<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/css/new_file.css"/>

	<style>
	.error-tips p{
		color:red;
	}
</style>
<?php 

$array['P']['title'] = '第三套人民币 惊爆抢藏价 188一套 ';
$array['P']['imgUrl'] = '';
$array['P']['link'] = urlWap('zhuanti','ad_20160901_2',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['link'] = urlWap('zhuanti','ad_20160901_2',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['title'] = '第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚';
$array['Y']['desc'] = '第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚';
$array['Y']['imgUrl'] = '';
echo weixinShare($array);

?>
	<div class="rmb-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_08.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_09.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_10.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_11.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_12.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_13.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_14.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_15.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_16.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_17.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_18.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_19.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_20.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_21.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_22.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_23.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_24.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_25.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_26.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_27.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_28.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_29.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_30.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_31.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_32.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_33.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_34.jpg"/>
		<img id="go" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_35.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_36.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_37.jpg"/>
		
		<div class="formbox">
		<form id="form1" action="<?php echo urlWap('zhuanti','ad_20160901_2',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan']));?>" method="post">
          <span class="item">
          	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入姓名" />
          </span>	
          <span class="item">
          	<input type="tel" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" value="" placeholder="请输入手机号" />
          </span>	
          <span class="item-yz">
          	<input class="l" type="tel" name="yzm" id="yzm" value=""  maxlength='4' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="发送验证码" />
          	<input class="r" type="button" id='push_yzm' value="发送验证码"/>
          </span>            
          <span class="item">
          	<input type="tel" name="goods_sum" id="goods_sum"  maxlength='3' onkeyup="value=value.replace(/[^\d]/g,'')" value="" placeholder="请输入订购数量" />
          </span>	              
           	<span class="item-select">

  			<input type="hidden" name="city_id" id="city_id">
			<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
			<input type="hidden" name="area_info" id="area_info" class="area_names"/>

			<input type="hidden" name="prov_name" >
			<input type="hidden" name="city_name" />
			<input type="hidden" name="region_name"/>

			<select class="valid" name="prov" id="vprov">
				<option value="">-请选择-</option>
			</select>
			<select class="valid" name="city" id="vcity">
				<option value="">-请选择-</option>
			</select>
	   
			<select class="valid" name="region" id="vregion">
				<option value="">-请选择-</option>
			</select>			                  	
        </span>
          <span class="item">
          	<input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
          </span>			 
          <p class="emphasis">(免快递费)</p>
          <p class="commitment">我们郑重承诺：严格保护用户个人信息，绝不外泄</p>
		  <span class="item error-tips" ></span>

			<?php Security::getToken();?>
			<input type="hidden" name="form_submit" value="ok">
          <button class="btn-go">立即订购</button>   
		  </form>
		</div>		
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_38.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160901_2/images/rmb_39.jpg"/>
	</div>
	<div class="btn-play">
		<a href="tel:4008059622">电话咨询</a>
		<a href="#go">立即订购</a>
	</div>
 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>

$(function(){
	// 登录
	$("#form1").validate({

	    errorElement: "p",
	    errorPlacement: function(error, element){
	    error.appendTo($(".error-tips").show());
	    },
	    rules: {
	        true_name: "required",
	        mob_phone: "required",
	        goods_sum: "required",
	        yzm: "required",
	        prov: "required",
	        city: "required",
	        region: "required",
	        address: "required"
	    },
	    messages: {
	        true_name: "用户姓名不能为空！",
	        mob_phone: "手机号不能为空！",
	        goods_sum: "订购数量不能为空！",
	        yzm: "验证码不能为空",
	        prov: "省不能为空！",
	        city: "市不能为空！",
	        region: "区不能为空！",
	        address: "详细地址不能为空！"
	    }

	});


	$("#push_yzm").click(function(){
		var mob_phone = $("#mob_phone").val();

		if(!!mob_phone === false){
			alert('手机号码不能为空');
			return false;
		}

		$.post("index.php?act=zhuanti&op=getOnePhoneYzm",{'mobile':mob_phone},function(data){

			if(data.state){
				alert(data.msg);
			}else if(data === true){
				alert('发送成功！');
			}

    },'json');


	})

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

});


</script>