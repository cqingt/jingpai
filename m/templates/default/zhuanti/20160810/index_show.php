<?php
$array['P']['title'] = "免费领取：《世界财富钞》一套（10枚）！ ";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160810/images/100x100.jpg';
$array['Y']['title'] = "免费领取：《世界财富钞》一套（10枚）！";
$array['Y']['desc'] = "限时免费1人/套   每天送出500套";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160810/images/100x100.jpg';
echo weixinShare($array);
?>	 
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/css/new_file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/css/component.css" />


	<div class="silver-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_01.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_02.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_03.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_04.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_05.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_06.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_07.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_08.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_09.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_10.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_11.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_12.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_13.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_14.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_15.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_16.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_17.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_18.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_19.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_20.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_21.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_22.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_23.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_24.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_25.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_26.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_27.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_28.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_29.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_30.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shi_31.jpg" alt="" />
	</div>
	<div class="btn-play">
		<img class="md-trigger" data-modal="modal-from1" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shifudong_02.jpg"/>
	</div>
	
	<!-- 弹出层结束 Start -->
	<div class="md-modal md-effect-11" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
					<!-- Demo start 1-->
	     			<div class="demo formbox" id="c1">
	     			  <img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/shibj.jpg"/>
					  <span class="item">
	                  	<input type="text" id="name" name="name"  value="" placeholder="请输入用户名" />
	                  </span>
	                  <span class="item">
	                  	<input type="number" id="mobile" name="mobile" pattern="[0-9]*" value="" placeholder="请输入手机号" />
	                  </span>   
	                  <span class="item-yz">
	                  	<input class="l" type="number" name="captcha_code" id="code" value="" pattern="[0-9]*" placeholder="发送验证码" />
	                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="发送验证码"/>
	                  </span>  
	                  <button class="tc-btn-vote mt" id="member_reg" onclick="reg();">提交</button>
					</div>
					<!-- Demo end --> 
					<!-- Demo start 2-->
	     			<div class="demo formbox" id="c2" style="display: none;">
	                  <h1 class="yes">恭喜您领取成功</h1>
	                  <span class="celebrate">
	                  	<p>会员账号：<strong id='user_namedf'>XXXXX</strong></p>
	                  	<p id='gong-passwordf'>会员密码：手机号的明码</p>
						<strong>我们会马上与您取得联系，请注意查收短信</strong>
	                  	<strong>更多更好藏品，请点击前往 <a href="http://m.96567.com">m.96567.com</a></strong>
	                  </span>
	                  <button class="tc-btn-vote mt" id='member_df_login'>确认</button>
					</div>
					<!-- Demo end -->  
					<!-- Demo start 3-->
	     			<div class="demo formbox" id="c3" style="display: none;">
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
	                  <button class="tc-btn-vote mt" id="btnLingQu">提交</button>
	                  <img class="what" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/images/what.jpg"/>
					</div>
					<!-- Demo end -->  
 
				
                </div>
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>
	
	<div class="md-overlay"></div>	
	<!-- 弹出层结束 End -->
	

 

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/js/modalEffects.js"></script>
	<script>
	var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160810/js/';
	

function reg(){
	var mobile = $.trim($("#mobile").val());
	var name = $.trim($("#name").val());
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160810&action=regs",
		data:{mobile:mobile,ua:ua,code:code,name:name},
		dataType:'json',
		success:function(result){
			if(result.state){
				 $("#c1").hide();
				 $("#c2").show();
				 $("#user_namedf").html(result.username);
				 $("#gong-passwordf").html('您的密码为：'+result.password);
			}else{
				alert(result.msg);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
}

function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#name").val();
		if(name == ''){
            alert('请填写用户名');
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

	$("#member_df_login").bind("click", function() {
		 $("#c2").hide();
		 $("#c3").show();
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

		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160810&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
			dataType:'json',
			success:function(result){
				if(result.state){
					//alert("领取成功");
					window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
});
</script>