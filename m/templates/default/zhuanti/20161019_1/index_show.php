
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/css/new_file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/css/component.css" />
	<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/js/tabulous.js" ></script>
	<script>
	$(function(){
		$('.tabs').tabulous({
			effect: 'scale'
		});
	});
	</script>   
	<div class="silver-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_01.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_02.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_03.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_04.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_05.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_06.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_07.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_08.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_09.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_10.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_11.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_12.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_13.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_14.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_15.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_16.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_17.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_18.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_19.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_20.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_21.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_22.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_23.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_24.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_25.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_26.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_27.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_28.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_29.jpg" alt="" />
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmb_30.jpg" alt="" />
	</div>


	<div class="btn-play">
		<img class="md-trigger" data-modal="modal-from1" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/images/rmbfudong_02.jpg"/>
	</div>
	
	<!-- 弹出层 Start -->

	<div class="md-modal md-effect-11" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
					<!-- Demo start 1-->
					<div class="tabs formbox" id="Demo_start2" >
						<ul class="tabsnav tc-tabsnav">
							<li><a href="#tabs-1" title="">注册</a></li>
							<!--
							<li><a href="#tabs-2" title="">登录</a></li>
							-->
						</ul>
			
						<div id="tabs_container">
							<div class="demo  showscale" id="tabs-1">
							<!--
			                  <span class="item">
			                  	<input type="text" name="userName" id="name" value="" placeholder="请输入用户名" />
			                  </span>	
							-->
			                  <span class="item">
			                  	<input type="number" name="mobile" id="mobile" pattern="[0-9]*" value="" placeholder="请输入手机号" />
			                  </span>   
			                  <span class="item-yz">
			                  	<input class="l" type="number" pattern="[0-9]*" id="code" type="tel" value="" placeholder="请输入验证码" />
			                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码"/>
			                  </span>  
			                  <button class="tc-btn-vote mt" id="member_reg">立即注册</button>
			                  <p class="postage">我们郑重承诺：严格保护用户个人信息</p>
							</div>
			<!--
			     			<div class="demo formbox" id="tabs-2">
			                  <span class="item">
			                  	<input type="text" name="log_name" id="log_name" value="" placeholder="请输入账号" />
			                  </span>	
			                  <span class="item">
			                  	<input type="password" name="log_password" id="log_password" value="" placeholder="请输入密码" />
			                  </span>	
			                  <button class="tc-btn-vote mt" id="member_login">立即登录</button>    
							</div>
			-->
						</div>
					</div>
					<!-- Demo end --> 

					<!-- Demo start 2-->
	     			<div class="demo formbox" id="Demo_start1" style="display:none;">
						<h1 class="yes">恭喜您注册成功</h1>
						<span class="celebrate">
	                  	<p>恭喜您成为收藏天下会员！</p>
	                  	<p style="color: red;">账号：<strong id='user_namedf'>XXXXX</strong></p>
	                  	<p id="gong-passwordf" style="color: red;">密码：XXXXX</p>
	                  	<strong>请登录http://www.96567.com及时修改密码</strong>
	                  </span>
	     			  <h3>领取金条</h3>
	                  <span class="item">
	                  	<input type="text"  name="true_name" id="true_name" value="" placeholder="请输入收货人姓名" />
	                  </span>  
	                  <span class="item">
	                  	<input type="number" pattern="[0-9]*" name="mob_phone" id="mob_phone" value="" placeholder="请输入收货人电话" />
	                  </span>  
	                  <span class="item-select">
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
	                  </span>
	                  <span class="item">
	                  	<input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
	                  </span>  	                  
<!--	                  <p class="postage">由于图书贵重，邮费需自理哦（9.9元）</p>-->
	                  <button class="tc-btn-vote mt" id="btnLingQu">立即领取（包邮）</button>
	                  <!--<p class="what">为什么要收<em>运费</em>？</p>-->
	                  <!--<p class="word">为高效的将银条送达客户手中，我们选择“顺丰、中通”等高质量快递公司，由于赠送数量大，赠品价格高昂，我们无法面向全国会员免邮。<em>但是，图书的价值要远远超越运费，请您放心领取。</em></p>-->
					</div>
					<!-- Demo end -->  
 
					<!-- Demo start 3-->
	     			<div class="demo formbox" id="modal-from99" style="display:none;">
	                  
	                  <button class="tc-btn-vote mt md-close"  id='member_df_login'>立即领取</button>
					</div>
					<!-- Demo end -->  
 
 
                </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>

	        </div>
	    </div>
	</div>
	 
	 <!-- 这是遮罩 -->
	<div class="md-overlay"></div>	
	<!-- 弹出层 End -->
	

 

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161019_1/js/modalEffects.js"></script>
	<script>
		var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161018_1/js/';
$("#member_reg").bind("click", function() {
	var mobile = $.trim($("#mobile").val());
	//var name = $.trim($("#name").val());,name:name
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20161019_1&action=regs",
		data:{mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				 $("#Demo_start2").hide();
				 $("#Demo_start1").show();
				 $("#user_namedf").html(result.username);
				 $("#gong-passwordf").html('密码：'+result.password);
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
			url:"index.php?act=zhuanti&op=ad_20161019_1&action=lingqu",
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

$("#member_df_login").bind("click", function() {
	$("#Demo_start1").show();
	$("#modal-from99").hide();
	$('.tabs').tabulous({
		effect: 'scale'
	});
});

    function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#mobile").val();
		
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
            url:"http://m.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
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

$array['P']['title'] = "金条19块8包邮，感恩回馈，疯狂派送！";
$array['P']['imgUrl'] = '';
$array['Y']['title'] = "金条19块8包邮，感恩回馈，疯狂派送！";
$array['Y']['desc'] = "收藏天下感恩回馈，每天新会员注册即可19块8领取金条，每天限量500条！";
$array['Y']['imgUrl'] = '';

echo weixinShare($array);

?>