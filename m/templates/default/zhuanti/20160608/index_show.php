<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/css/demo.css"/>
		
    <div class="top">
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_01.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_02.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_03.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_04.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_05.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_06.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_07.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_08.jpg"/>    
    </div>
	<div class="formbox one" id="receiving2">
		<form action="" method="post">
			<div class="frow">
				<input type="text" id="user_name" name="user_name"  value="" placeholder="用户名："/>
			</div>
			<div class="frow">
				<input type="password" id="password" name="password" value="" placeholder="密码："/>
			</div>
			<div class="frow">
				<input type="password" id="password_confirm" name="password_confirm" value="" placeholder="确认密码："/>
			</div>			
			<div class="frow">
				<input type="number" id="mobile" name="mobile" pattern="[0-9]*" value="" placeholder="手机号："/>
			</div>		
			<div class="frow last">
				<input type="number" name="captcha_code" id="code" value="" pattern="[0-9]*" placeholder="验证码："/>
				<input class="button" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码"/>
			</div>	 
			<div class="submit">
			    <input id="member_reg" type="button" value="立即领取">
		    </div>
		</form>
	</div>
	
	<div class="formbox two" id="receiving1" style="display: none;">
		<form action="" method="post">
			<div class="frow">
				<input type="text" name="true_name" id="true_name" value="" placeholder="姓名："/>
			</div>		
			<div class="frow">
				<input type="number" name="mob_phone" id="mob_phone" pattern="[0-9]*" value="" placeholder="手机号："/>
			</div>		
			<div class="frow">
				 <label for="">请选择地区</label>
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
			<div class="frow">
				<input type="text" name="address" id="address" value="" placeholder="地址："/>
			</div>				 
			<div class="submit nt">
			    <input id="btnLingQu" type="button" value="完成领取">
		    </div>
		    <h5>由于猴币价值较高，邮费需自理哦（20元）</h5>
		</form>
	</div>
	

		
	<div class="photo">
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_11.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_12.jpg"/>
       <img class="banner" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160608/images/photo_13.jpg"/>
	</div>

<script type="text/javascript">
<?php if($output['is_lin'] != 1) { echo 'lingqu();';}?> 
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

	function lingqu(){
		$("#receiving1").css("display","block");
		$("#receiving2").css("display","none");
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
			url:"index.php?act=zhuanti&op=ad_20160608&action=lingqu",
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
		url:"index.php?act=zhuanti&op=ad_20160608&action=regs",
		data:{user_name:user_name,password:password,password1:password_confirm,mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				//window.location.href="http://www.96567.com/index.php?act=zhuanti&op=ad_20160608";
				//注册成功弹出领取框
				//数据统计分析数据
				var tprm = "userName="+$("#user_name").val();
				__ozfac2(tprm,"#regSuccess");
				setTimeout("",300);
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

$array['P']['title'] = "猴年纪念币免费领取啦！就是这么壕";
$array['P']['imgUrl'] = '';
$array['Y']['title'] = "猴年纪念币免费领取啦！就是这么壕";
$array['Y']['desc'] = "猴币不花钱，免费领！数量有限，速速前来";
$array['Y']['imgUrl'] = '';

echo weixinShare($array);

?>