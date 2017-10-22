	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/css/parallax.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/css/parallax-animation.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/css/demo.css" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/css/component.css" />

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/js/tabulous.js"></script>
	<script>
	$(function(){
		$('.tabs').tabulous({
			effect: 'scale'
		});
	});
	</script>   
<div class="wrapper">
    <div class="pages">
 
        <section class="jieguo">
            <div class="jieguo-box"></div>     
            
            <div class="main6">   
                <ul class="zjbox">
					<?php foreach($output['JangName'] as $k=>$v){ ?>
                	<li><?php echo $v['W_Nickname'];?></li>
					<?php } ?>
					<li>吴大壮</li>
					<li>……财神……</li>
					<li>大淼</li>
					<li>蒋培强</li>
					<li>黑白漫画</li>
					<li>梅子</li>
					<li>立凡</li>
					<li>大肚能容</li>
					<li>油条儿</li>
					<li>Super婕</li>
                </ul>
                <a class="btn-next2 md-trigger" data-modal="modal-from1" href="JavaScript:;">点击领取奖品</a>
            </div>
        	<div class="jiangpin">
        		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/images/jiangpin.png"/>
        	</div>            
        </section>  

    </div>
</div>

	
	<!-- 登录与注册 -->
	<div class="md-modal md-effect-11" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
					
					<!-- Demo start 1-->
					<div class="tabs" id="Demotas1" <?php if(intval($_SESSION['member_id']) <= 0){ ?>style="display: none;"<?php }?>>
						<div id="tabs_container">
							<div class="demo formbox showscale" id="tabs-1">
							  <h1 class="txie">请正确填写收货信息领取藏品</h1>
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
			                  <button class="tc-btn-vote mt" id="btnLingQu">立即领取</button>    
			                  <p class="hint">因奖品价值贵重，邮费需<em>自理</em>哦（20元）</p>
							</div>		
			
						</div>
					</div>
					<!-- Demo end --> 
 							
 
					<!-- Demo start 2-->
					<div class="tabs" id="Demotas2" <?php if(intval($_SESSION['member_id']) > 0){ ?>style="display: none;"<?php }?>>
						<ul class="tabsnav tc-tabsnav">
							<li><a href="#tabs-1" title="">注册</a></li>
							<li><a href="#tabs-2" title="">登录</a></li>
						</ul>
			
						<div id="tabs_container">
							<div class="demo formbox showscale" id="tabs-1">
			                  <span class="item">
			                  	<input type="text" name="userName" id="name" value="" placeholder="请输入用户名" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" name="passWord" id="password" value="" placeholder="请输入密码" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" name="passWord_enter" id="password1" value="" placeholder="请在次输入密码" />
			                  </span>  
			                  <span class="item">
			                  	<input type="number" name="mobile" id="mobile" pattern="[0-9]*" value="" placeholder="请输入手机号" />
			                  </span>   
			                  <span class="item-yz">
			                  	<input class="l" type="number" name="captcha_code" id="code" value="" pattern="[0-9]*" placeholder="请输入验证码" />
			                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="点击获取验证码"/>
			                  </span>  
			                  <button class="tc-btn-vote mt" id="btnOne">立即注册</button>
							</div>
			
			     			<div class="demo formbox" id="tabs-2">			                  
			                  <span class="item">
			                  	<input type="text" name="log_name" id="log_name" value="" placeholder="请输入账号" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" name="log_password" id="log_password" value="" placeholder="请输入密码" />
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
	
	

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/js/modalEffects.js"></script>
	<script>
		var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160819/js/';

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
			url:"index.php?act=zhuanti&op=ad_20160819&action=lingqu",
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
				$("#Demotas1").show();
				$("#Demotas2").hide();
			}else{
				alert(result.error);
				$("#member_login").attr("disabled",false);
			}
		}
	}); 
});


    $("#btnOne").bind("click", function(event) {
		$("#btnOne").attr("disabled",true);
		var name = $('#name').val();
		var password = $('#password').val();
		var password1 = $('#password1').val();
		var mobile = $('#mobile').val();
		var code =  $('#code').val();
		var ua =  "<?php echo $_GET['ua'];?>";
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160819&action=yanzhengone",
			data:{user_name:name,password:password,password1:password1,mobile:mobile,code:code,ua:ua},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$("#Demotas1").show();
					$("#Demotas2").hide();
				}else{
					alert(result.error);
					$("#btnOne").attr("disabled",false);
				}
			}
		}); 
    });
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

    </script>
  