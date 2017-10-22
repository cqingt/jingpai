<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/css/new_file.css"/>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/js/new_file.js" ></script>
	 <div class="banner">
         <div class="banner-01"></div>
          <div class="banner-02"></div>
           <div class="banner-03"></div>
            <div class="banner-04"></div>
             <div class="banner-05"></div>
	 </div>
	 <div class="two">
        <div class="w">
		 	
	 <a href="javascript:;" class="first"  ></a>
		 	<a class="second" target="_blank"></a>        	
       
			</div>
	
			</div>
	 <div class="banner_ad" target="_blank"></div>
	 
	 <div class="heartbeat">
	 	<a class="w" href="http://www.96567.com/goods-1237.html" target="_blank">
	 	    <h2>剩余<em><?php echo $output['DuanWu'];?></em>个名额</h2>
	 	</a>
	 </div>
	 
	 <div class="product">
	 	<ul class="w">
	 		<li><a href="http://www.96567.com/goods-3131.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product1.jpg"/></a></li>
	 		<li><a href="http://www.96567.com/goods-3918.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product2.jpg"/></a></li>
	 		<li><a href="http://www.96567.com/goods-3450.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product3.jpg"/></a></li>
	 		<li><a href="http://www.96567.com/goods-18032.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product4.jpg"/></a></li>
	 		<li><a href="http://www.96567.com/goods-4076.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product5.jpg"/></a></li>
	 		<li><a href="http://www.96567.com/goods-1237.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160602/images/product6.jpg"/></a></li>	 		
	 	</ul>
	 </div>
	 <script type="text/javascript">
	    //兼容IE8
	 	$('.product ul li:nth-child(2n+1)').css('margin-right','30px')
	 </script>
	 
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
				         <input type="text" value="" id="mobile" name="mobile">		     	
				     </div>						     
				     <div class="row">
				         <label for="">验证码</label>
				         <input class="verify" type="text" value="" name="captcha_code" id="code">	
				         <input class="submit" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码" />
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
				         <input type="text" value="" name="mob_phone" id="mob_phone">		     	
				     </div>
				     <div class="row">
				         <label for="">地区</label>
				         <div class="select" id="region">
						  <select style="" class="valid" id='prov'></select>
							<input type="hidden" value="" name="city_id" id="city_id">
							<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
							<input type="hidden" name="area_info" id="area_info" class="area_names"/>
						 </div>     	
				     </div>			
				     <div class="row">
				         <label for="">详细地址</label>
				         <input type="text" value="" name="address" id="address">		     	
				     </div>
				     <input class="rio-button" type="button" id="btnLingQu" value="确认领取"> 
				     <h2>由于三枚邮票价值贵重，邮费需自理哦（20元）</h2>              
             </div>		     
         </div>


	</div>

		   <!-- 遮罩层 -->
		  <a id="fullbg" class="mask-layer" href="javascript:;" onclick="closeBg();"></a>
		</div>	 
	 
<script type="text/javascript">
$(document).ready(function(){
	regionInit("region");
   
});
	     $('.first').click(function(){
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
	 $('#city_id').val($('#region').find('select').eq(1).val());
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var area_info = $.trim($("#area_info").val());
		var city_id = $.trim($("#city_id").val());
		var area_id = $.trim($("#area_id").val());
		var address = $.trim($("#address").val());
		var prov = $.trim($("#prov").val());
		var goods_id = $('#goods_id').val();
		var type = $('#type').val();
		var lid = $('#lid').val();
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160602&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goods_id:goods_id,type:type,lid:lid},
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
            url:"http://www.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
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