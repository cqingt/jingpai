<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161123/css/new_file.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161123/css/default.css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161123/css/component.css" /> -->

<div class="seven-bar">
	<img src="http://img.96567.com/images/qibaishi20161123App/seven_01.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_02.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_03.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_04.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_05.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_06.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_07.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_08.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_09.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_10.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_11.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_12.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_13.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_14.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_15.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_16.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_17.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_18.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_19.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_20.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_21.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_22.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_23.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_24.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_25.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_26.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_27.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_28.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_29.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_30.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_31.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_32.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_33.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_34.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_35.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_36.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_37.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_38.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_39.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_40.jpg"/>
	<img src="http://img.96567.com/images/qibaishi20161123App/1seven_41.jpg"/>
	
	<div id="sevenNav" class="fosevenox">
	<form id="form1" action="<?php echo urlWap('zhuanti','ad_20161123',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan']));?>" method="post">

      <span class="item">
          	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入姓名" />
      </span>	
      <span class="item">
          	<input type="tel" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" value="" placeholder="请输入手机号" />
      </span>	 
      <span class="item-yz">
          	<!-- <input type="text" value="" class="l" placeholder="请输入验证码"> -->
          	<input class="l" type="number" pattern="[0-9]*" id="code" name="code" type="tel" value="" placeholder="请输入验证码" />
          	<!-- <input type="button" value="发送验证码" class="r"> -->
          	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码"/>

      </span>	
<!-- 	  <div class="item">
		<div class="txt">数量:</div>
			<div class="gw_num">
				<em class="jian">-</em>
				<input type="text" value="1" class="num" name="goodsnumber" readonly="readonly" id="goodsnumber">
				<em class="add">+</em>
			</div>
	  </div> -->
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
          <input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
      </span>	

    <?php Security::getToken();?>
	<input type="hidden" name="form_submit" value="ok">	 

      <p class="emphasis">(免快递费)</p>
      <p class="commitment">郑重承诺：严格保护用户个人信息，绝不外泄</p>
      <span class="item error-tips" ></span>
      <button class="btn-go">立即订购</button>
    </form>
	</div>		
	<img src="http://img.96567.com/images/qibaishi20161123App/seven_42.jpg"/>
</div>

<div class="seven-nav" href="#sevenNav">
	<a href="#sevenNav">立即订购</a>
	<a href="tel:4008762770">订购热线</a>
</div>



<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>

$(function(){
	$(document).ready(function(){
			//加
			$(".add").click(function(){
			var n=$(this).prev().val();
			var num=parseInt(n)+1;
			if(num==5){ return;}
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

	// 登录
	$("#form1").validate({

	    errorElement: "span",
	    errorPlacement: function(error, element){
	    	error.appendTo($(".error-tips").show());
	    },
	    rules: {
	        true_name: "required",
	        mob_phone: "required",
	        goods_sum: {
	            required : true,
	            min: 1,
	            max: 5
	        },
	        yzm: "required",
	        prov: "required",
	        city: "required",
	        region: "required",
	        address: "required"
	    },
	    messages: {
	        true_name: "用户姓名不能为空！",
	        mob_phone: "手机号不能为空！",
	        goods_sum: {
	            required : '请填购买数量',
	            min : '购买数量不能小于1',
	            max: '购买数量不能大于5'
	        },
	        yzm: "验证码不能为空",
	        prov: "省不能为空！",
	        city: "市不能为空！",
	        region: "区不能为空！",
	        address: "详细地址不能为空！"
	    }

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



function getPhoneYzm(){
        var mobile = $("#mob_phone").val();
		var name = $("#mob_phone").val();
		
        if(mobile == ''){
            alert('手机号不能为空！');
            return false;
        }

        var wait=60; 
        function time() { 
            var o = document.getElementById("getYzm");
           if (wait == 0) { 
                o.removeAttribute("disabled"); 
                o.value="重新发送"; 
                o.style.background = "#ffda31";
                o.style.color = "#ac4700";
                wait = 60; 
            } 
            else { 
                o.setAttribute("disabled", true); 
                o.value=wait+"秒"; 
                o.style.background = "#959595";
                o.style.color = "#fff";
                wait--; 
                setTimeout(function() { 
                time(o) 
                }, 
                1000) 
            } 
        } 

        $.ajax({
            type:'post',
            url:"http://m.96567.com/index.php?act=zhuanti&op=pushPhoneYzm",
            data:{mobile:mobile,name:name},
            dataType:'json',
            success:function(result){
                if(result == 1){
                    time();
                }else{
                  alert(result.error);
                }
            }
        });

    }



</script>

<?php 

$array['P']['title'] = '齐白石《游虾图》只要498元！限量1000幅！';
$array['P']['imgUrl'] = '';
$array['P']['link'] = urlWap('zhuanti','ad_20161123',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['link'] = urlWap('zhuanti','ad_20161123',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['title'] = '齐白石《游虾图》只要498元！限量1000幅！';
$array['Y']['desc'] = '价格一降到底，抢完立止！';
$array['Y']['imgUrl'] = '';
echo weixinShare($array);

?>