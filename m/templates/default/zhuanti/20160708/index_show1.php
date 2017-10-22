	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/css/new_file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/css/component.css" />
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/js/tabulous.js"></script>
	<script>
	$(function(){
		$('.tabs').tabulous({
			effect: 'scale'
		});
	});
	</script>   
	<div class="silver-bar">
	    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_08.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_09.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_10.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_11.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_12.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_13.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_14.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_15.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_16.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_17.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_18.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_19.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_20.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_21.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_22.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_23.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_24.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_25.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_29.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_30.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_31.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_32.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_33.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_34.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/im2/photo2_35.jpg"/>		
	</div>
	<div class="btn-play">
		<img class="md-trigger" data-modal="modal-from1" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/btn.png"/>
	</div>
	
	
	<!-- 弹出层结束 End -->
	<!--NO.9  登录与注册 -->
	<div class="md-modal md-effect-3" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/images/sea-mew.jpg"/>
					</div>	
					
					<!-- Demo start 0-->
					<div class="tabs" id="modal-from99" style="display:none;">
						<ul class="tabsnav tc-tabsnav">
							<li><a class="no-no" href="#tabs-1" title="">恭喜，注册成功</a></li>
						</ul>
			
						<div id="tabs_container">
							<div class="demo formbox showscale" id="tabs-1">
			                  <p>恭喜您成为收藏天下会员！</p>		    
			                  <p>您的会员账号为：<strong id='user_namedf'>XXXXX</strong></p>
			                  <p id="gong-passwordf">您的密码为：手机号后6位的明码</p>
			                  <button class="tc-btn-vote mt" id='member_df_login'>确认</button>    
							</div>		
			
						</div>
					</div>
					<!-- Demo end --> 	
					<!-- Demo start 1-->
					<div class="tabs onlylq" id="Demo_start1" <?php if(intval($_SESSION['member_id']) <= 0){?>style="display:none;"<?php }?>>
						<ul class="tabsnav tc-tabsnav">
							<!----><li><a class="no-no" href="#tabs-1" title="">恭喜您抢到《好运投资银条》5g</a></li>
						</ul>
			
						<div id="tabs_container">
							<div class="demo formbox showscale" id="tabs-1">
			                  <span class="item">
			                  	<input type="text" name="true_name" id="true_name" value="" placeholder="收货人姓名" />
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
			                  	<input type="number" name="mob_phone" id="mob_phone" pattern="[0-9]*" value="" placeholder="收货人电话" />
			                  </span>	
			                  <span class="item">
			                  	<input type="text" name="address" id="address" value="" placeholder="详细地址" />
			                  </span>
			                  <p class="newp1">由于银条贵重，邮费需要自理哦（15元）</p>			                  
			                  <button class="tc-btn-vote" id="btnLingQu">免费领取</button>  
			                  <h4 class="newp">为什么要收运费？</h4>  
			                  <p class="newp2">为安全高效的将银条送达客户手中，我们选择“顺丰、中通”等高质量快递公司，由于赠送数量大，我们没能力面向全国会员免邮赠送。<strong>但是，银条的价值远远超越运费，所以，请您放心收藏。</strong></p>			    	
							</div>		
			
						</div>
					</div>
					<!-- Demo end --> 
 							
 
					<!-- Demo start 2-->
					<!----><div class="tabs" id="Demo_start2" <?php if(intval($_SESSION['member_id']) > 0){?>style="display:none;"<?php }?>>
						<ul class="tabsnav tc-tabsnav">
							<li><a href="#tabs-1" title="">注册</a></li>
							<li><a href="#tabs-2" title="">登录</a></li>
						</ul>
			
						<div id="tabs_container">
							<div class="demo formbox showscale" id="tabs-1">
							<!--
			                  <span class="item">
			                  	<input type="text" id="user_name" name="user_name" value="" placeholder="请输入用户名" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" id="password" name="password" value="" placeholder="请输入密码" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" id="password_confirm" name="password_confirm" value="" placeholder="请在次输入密码" />
			                  </span>  
							  -->
			                  <span class="item">
			                  	<input type="number" id="mobile" name="mobile" pattern="[0-9]*" value="" placeholder="请输入手机号" />
			                  </span>   
			                  <span class="item-yz">
			                  	<input class="l" type="number" name="captcha_code" id="code" value="" pattern="[0-9]*" value="" placeholder="请输入验证码" />
			                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="点击获取验证码"/>
			                  </span>  
			                  <button class="tc-btn-vote mt" id="member_reg">注册</button>
							</div>
			
			     			<div class="demo formbox" id="tabs-2">

			                  <span class="item">
			                  	<input type="text" id="log_name" name="log_name" value="" placeholder="请输入账号" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" id="log_password" name="log_password" value="" placeholder="请输入密码" />
			                  </span>	
			                  <button class="tc-btn-vote mt" id="member_login">立即登录</button>    

							</div>
			
						</div>
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
	



<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/js/modalEffects.js"></script>
	<script>
 
	var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160708/js/';

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

		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160708_1&action=lingqu",
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

$("#member_login").bind("click", function() {
	var user_name = $.trim($("#log_name").val());
	var password = $.trim($("#log_password").val());
	$("#member_login").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=login",
		data:{user_name:user_name,password:password},
		dataType:'json',
		success:function(result){
			if(result.state){
				 $("#Demo_start2").hide();
				 $("#Demo_start1").show();
				 $('.tabs').tabulous({
					effect: 'scale'
				});
			}else{
				alert(result.error);
				$("#member_login").attr("disabled",false);
			}
		}
	}); 
});
$("#member_df_login").bind("click", function() {
	$("#Demo_start1").show();
	$("#modal-from99").hide();
	$('.tabs').tabulous({
					effect: 'scale'
	});
});
$("#member_reg").bind("click", function() {
	//var user_name = $.trim($("#user_name").val());
	//var password = $.trim($("#password").val());
	//var password_confirm = $.trim($("#password_confirm").val());user_name:user_name,password:password,password1:password_confirm,
	var mobile = $.trim($("#mobile").val());
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160708_1&action=regs",
		data:{mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				 $("#Demo_start2").hide();
				 //$("#Demo_start1").show();
				 $("#modal-from99").show();
				 $("#user_namedf").html(result.username);
				 $("#gong-passwordf").html('您的密码为：'+result.password);
				 $('.tabs').tabulous({
					effect: 'scale'
				 });
			}else{
				alert(result.msg);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});
function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = mobile;
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
 

