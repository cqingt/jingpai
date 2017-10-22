
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/css/new_file.css"/>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/js/new_file.js" ></script>
	 <div class="banner">
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/banner_01.jpg"/>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/banner_02.jpg"/>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/banner_03.jpg"/>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/banner_04.jpg"/>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/banner_05.jpg"/>
        <a id="two" href="javascript:;"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/two.jpg"/></a>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/three.jpg"/>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/four.jpg"/>
	 </div>
	 
	 <div class="heartbeat">
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=1237"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/heartbeat.jpg"/></a>
	 	<a href="http://www.96567.com/goods-1237.html" target="_blank">
	 	    <h2>剩余<em><?php echo $output['DuanWu'];?></em>个名额</h2>
	 	</a>
	 </div>
	 
	 <div class="product">
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=3131"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product1.jpg"/></a>
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=3918"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product2.jpg"/></a>
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=3450"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product3.jpg"/></a>
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=18032"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product4.jpg"/></a>
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=4076"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product5.jpg"/></a>
	 	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=1237"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160602/images/product6.jpg"/></a>
	 </div>
	 
	
	 
	<div class="popup">
	   <!-- 弹窗 -->
	   <div id="dialog" class="content">
	     <a class="close" href="javascript:;" onclick="closeBg();"></a>
             <div class="tab-content">
                     <h1>注册领邮票</h1>
				     <div class="row">
				         <label for="">用户名</label>
				         <input type="text" value="" id="user_name" name="user_name">		     	
				     </div>
				     <div class="row">
				         <label for="">设置密码</label>
				         <input type="password" value="" id="password" name="password">		     	
				     </div>
				     <div class="row">
				         <label for="">确认密码</label>
				         <input type="password" value="" id="password_confirm" name="password_confirm">		     	
				     </div>			
				     <div class="row">
				         <label for="">手机号</label>
				         <input type="number" value="" id="mobile" name="mobile" pattern="[0-9]*">		     	
				     </div>						     
				     <div class="row">
				         <label for="">验证码</label>
				         <input class="verify" type="number" value="" name="captcha_code" id="code" pattern="[0-9]*">	
				         <input class="submit" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm"  value="获取验证码" />
				     </div>		   
				     <input class="rio-button" type="button" id="member_reg" value="确认">             
             </div>		     
         </div>

		 <!-- 收获地址 -->
	   <div id="address_list" class="content">
	     <a class="close" href="javascript:;" onclick="closeBg();"></a>
             <div class="tab-content">
                     <h1>请填写收货信息</h1>
				     <div class="row">
				         <label for="">姓名</label>
				         <input type="text" value="" name="true_name" id="true_name">		     	
				     </div>
				     <div class="row">
				         <label for="">手机</label>
				         <input type="text" value="" name="mob_phone" id="mob_phone" pattern="[0-9]*">		     	
				     </div>
				     <div class="row">
				         <label for="">地区</label>
				          <div class="select" id="region">
							<input type="hidden" value="" name="city_id" id="city_id">
							<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
							<input type="hidden" name="area_info" id="area_info" class="area_names"/>
						 <select class="valid" name="prov" id="vprov">
								<option value="">-请选择-</option>
							</select>
							<select class="valid" name="city" id="vcity">
								<option value="">-请选择-</option>
							</select>
					   
							<select class="valid" name="region" id="vregion">
								<option value="">-请选择-</option>
							</select>
						 </div>
				     </div>			
				     <div class="row">
				         <label for="">详细地址</label>
				         <input type="text" value="" name="address" id="address">		     	
				     </div>
				     <input class="rio-button" type="button" id="btnLingQu" value="确认领取">             
             </div>		     
         </div>

	</div>

		   <!-- 遮罩层 -->
		  <a id="fullbg" class="mask-layer" href="javascript:;" onclick="closeBg();"></a>
		</div>	 
	 
	 <script type="text/javascript">
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
	     $('#two').click(function(){
			 <?php if($output['is_lin'] == 1) {?> showBg(); <?php } else{ echo 'lingqu();';}?> 
	     })
	    
	 
	     function showBg() { 
		  $("#dialog,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#dialog,#fullbg").show(); 
		  } 

		  //关闭灰色 遮罩 
		  function closeBg() { 
		    $("#dialog,#address_list,#fullbg").hide(); 
		  } 
function lingqu(){
	$("#address_list,#fullbg").css({ 
		display:"block" 
    }); 
    $("#address_list,#fullbg").show();
	$("#dialog").hide();
}

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

		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160602&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
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

$("#member_reg").bind("click", function() {
	var user_name = $.trim($("#user_name").val());
	var password = $.trim($("#password").val());
	var password_confirm = $.trim($("#password_confirm").val());
	var mobile = $.trim($("#mobile").val());
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160602&action=regs",
		data:{user_name:user_name,password:password,password1:password_confirm,mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				//window.location.href="http://www.96567.com/index.php?act=zhuanti&op=ad_20160602";
				//注册成功弹出领取框
				lingqu();
			}else{
				alert(result.msg);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});
function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#user_name").val();
		if(name == ''){
            alert('用户名不能为空！');
            return false;
        }
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
            url:"index.php?act=zhuanti&op=getPhoneYzm",
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

$array['P']['title'] = "超值!纪念钞等值兑换";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160602/images/weixin.jpg";
$array['Y']['title'] = "超值!纪念钞等值兑换";
$array['Y']['desc'] = "端午送礼，收藏投资，就它了！";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160602/images/weixin.jpg";

echo weixinShare($array);

?>