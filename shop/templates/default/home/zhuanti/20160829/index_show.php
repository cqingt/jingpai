
		<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/css/new_file.css"/>
		<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
		<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/js/jquery.reveal.js"></script>
		<div class="photo1"></div>
		<div class="photo2"></div>
		<div class="photo3"></div>
		
		<div class="bar-wrap clearfix">
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_05.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_07.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_08.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_09.jpg"/>
			
			<a href="javascript:;" class="big-link" id="big-link1" data-reveal-id="mymodal-dz1" data-animation="fade"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_10.jpg"/></a>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_11.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_12.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_13.jpg"/>
			<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_14.jpg"/>
			<a href="javascript:;" class="big-link" id="big-link2" data-reveal-id="mymodal-dz1" data-animation="fade"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/photo_15.jpg"/></a>
		</div>
		
		
				
		<div id="mymodal-dz1" class="reveal-modal-dz rio word1">
			<div class="tcform" id="dd_address1">
				<h2>注册新会员即可参与等值兑换</h2>
				<p class="go">赶快注册吧~</p>
				<div class="dem-tiem">
					<input type="text" value="" id="user_name" name="user_name" placeholder="请输入姓名" />
				</div>
				<div class="dem-tiem">
					<input type="text" value="" id="mobile" name="mobile" placeholder="请输入手机号" />
				</div>
				<div class="dem-tiem-yz">
					<input class="in1" type="text" value="" name="captcha_code" id="code" placeholder="请输入验证码" />
					<input class="in2" type="button" value="发送验证码" onclick="getPhoneYzm();" name="getYzm" id="getYzm" />
				</div>
				<button class="btn-dz" id="member_reg">注册</button>
				
				
			</div>

			<div id="dd_address" class="tcform"   style="display: none;">
				<h2>第五套人民币等值兑换</h2><p class="go">赶快填写收货地址吧~</p>
			
				<div class="dem-tiem">
					<input type="text" name="true_name" id="true_name" value="" placeholder="请输入收货人姓名" />
				</div>
				<div class="dem-tiem">
					<input type="number" name="mob_phone" id="mob_phone" value="" placeholder="请输入收货人电话" />
				</div>
				<div class="dem-tiem" id="region">
					<select id='prov'></select>
					<input type="hidden" value="" name="city_id" id="city_id">
					<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
					<input type="hidden" name="area_info" id="area_info" class="area_names"/>	
				</div>
				<div class="dem-tiem">
					<input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
				</div>
				<div style="margin-top:20px;">
					<input type="radio" name="is_bao" id="is_bao" value="1" checked>全新裸钞 （10元运费） <input type="radio" name="is_bao" id="is_bao" value="2"> 含精美册（15元包装+10元运费）
				</div>
				<button class="btn-dz" id="btnLingQu" style="margin-top: 10px;">立即兑换</button>
			</div>
			<a class="close-reveal-modal-dz"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160829/images/close.jpg"/></a>
		</div>

		
<script>
$(document).ready(function(){
			regionInit("region");
		   
		});
$("#member_reg").bind("click", function() {
		var user_name = $.trim($("#user_name").val());
		var mobile = $.trim($("#mobile").val());
		var ua = "<?php echo $_GET['ua']?>";
		var code =  $('#code').val();
		$("#member_reg").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160829&action=regs",
			data:{user_name:user_name,mobile:mobile,ua:ua,code:code},
			dataType:'json',
			success:function(result){
				if(result.state){
					 var msg = '<h2>注册成功！</h2><h4>您的用户名是：'+result.username+'</h4><h4>您的密码是：'+result.password+'</h4><a href="javascript:void(0);" onclick="member_df_login();" class="btn-dz" style="margin-top: 10px;">立即等值兑换</a>';
					 $("#dd_address1").html(msg);
				}else{
					alert(result.msg);
					$("#member_reg").attr("disabled",false);
				}
			}
		}); 
	});
	$("#btnLingQu").bind("click", function() {
	 $('#city_id').val($('#region').find('select').eq(1).val());
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var area_info = $.trim($("#area_info").val());
		var city_id = $.trim($("#city_id").val());
		var area_id = $.trim($("#area_id").val());
		var address = $.trim($("#address").val());
		var prov = $.trim($("#prov").val());
		var temp = document.getElementsByName("is_bao");
	    for(var i=0;i<temp.length;i++)
	    {
		 if(temp[i].checked) var is_bao = temp[i].value;
	    }
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160829&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,is_bao:is_bao},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://www.96567.com/shop/index.php?act=buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
});
	function member_df_login(){
		$("#dd_address1").hide();
		$("#dd_address").show();
	}
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