
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/css/new_file.css"/>

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/js/new_file.js" ></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/js/xcConfirm.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/js/jq_scroll.js"></script>  
<script type="text/javascript">
$(document).ready(function(){
		$("#scrollDiv-two").Scroll({line:1,speed:500,timer:3000,up:"but_up",down:"but_down"});
});

var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
    var now_time = Date.parse(new Date()) / 1000;
    //alert(now_time);
    var Diffs = time -now_time;				
    if(t == 2){
        var html = '<p>距结束</p>';
    }else{
        var html = '<p>距开始</p>';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;
	html += '<p>剩余';
    if(DifferHour > 0){
        html += DifferHour+"时";
    }
    if(DifferMinute > 0){
        html += DifferMinute+"分";
    }
    html += Diffs+"秒";
	html += '</p>';
    document.getElementById("leftTime"+key).innerHTML =html;
}
</script>
	<div class="banner">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518_1/images/banner_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518_1/images/banner_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518_1/images/banner_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518_1/images/banner_04.jpg"/>
		
	</div>
		<!--
	<div class="navigation">
	    <a href="#nav1"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_01.jpg"/></a>
	    <a href="#nav2"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_02.jpg"/></a>
	    <a href="#nav3"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_03.jpg"/></a>
	    <a href="#nav4"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_04.jpg"/></a>
	    <a href="#nav5"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_05.jpg"/></a>
	    <a href="#nav6"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/nav_06.jpg"/></a>	
	</div>-->

	<div class="send-money" id="nav1">
		<div class="moneybox">
		    <div class="headline"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/money.jpg"/></div>
		    <h2 class="headline-h2">360元红包和10万面额外国真钞大放送</h2>
		    <a class="btn-eye" href="javascript:;" id="btn1">查看活动规则</a>
		    <div class="coupon">
		    	<div class="coupon1">
		    		<a href="javascript:void(0);" onclick="lingqu(1);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/Coupon_01.jpg"/></a>
		    		<a href="javascript:void(0);" onclick="lingqu(2);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/Coupon_03.jpg"/></a>
		    	</div> 
		    	<div class="coupon1">
		    		<a href="javascript:void(0);" onclick="lingqu(3);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/Coupon_02.jpg"/></a>
		    		<a href="javascript:void(0);" onclick="lingqu(4);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/Coupon_04.jpg"/></a>
		    	</div> 
		    	<div class="coupon2">
		    		<a href="javascript:void(0);" onclick="lingqu(5);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518_1/images/Coupon_05.jpg"/></a>
		    	</div> 			    	
		    </div>
		    <div class="coupon-bottom"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160518/images/Coupon_bottom.jpg"/></div>
		    <a class="btn-coupon " href="javascript:void(0);" onclick="lingqu(6);">一键领取所有</a>
		</div>
	</div>
	
       <br />
	   <br />


<div class="popup">
		   <!-- 弹窗 -->
		   <div id="dialog" class="content">
		     <input type="hidden" name="type" id="type" value="0">
			  <input type="hidden" name="lid" id="lid" value="0">
		     <a class="close" href="javascript:;" onclick="closeBg();"></a>
		     <h2 id="J_name">恭喜您抽中****1件</h2>
		     <h4 id="TiShiXinXi">请认真填写收货信息，以确保奖品能准确的寄到您的手中。</h4>
		     <div class="row">
		         
				 <label for="">姓名</label>
		         <input type="text" name="true_name" id="true_name" value="">		     	
		  
			 </div>
		     <div class="row">
		         <label for="">手机</label>
		         <input type="text" value="" name="mob_phone" id="mob_phone">		     	
		     </div>
		     <div class="row">		     
			     <label for="">省市</label>
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
		         <label for="">街道</label>
		         <input type="text" name="address" id="address" value="">		     	
		     </div>
		     <h5 id="df_yuan">生成订单后您需要支付的金额为：0元</h5>
		     <input class="rio-button" type="button" id="btnLingQu" value="提交订单">  
		   </div>
<div id="login" class="content only-login" >
		     <a class="close" href="javascript:;" onclick="closeBg();"></a>
		     <ul class="login-and-register df_investment_title">
                 <li class="on">登录</li>
                 <li>注册</li>
		     </ul>
             <div class="df_investment_con">
	             <div class="tab-content">
				     <div class="row">
				         <label for="">账号</label>
				         <input type="text" value="" name="log_name" id="log_name">		     	
				     </div>
				     <div class="row">
				         <label for="">密码</label>
				         <input type="password" value="" name="log_password" id="log_password">		     	
				     </div>
				     <input class="rio-button" type="button"  id="member_login" value="登录">
	             </div>		     
	             <div class="tab-content">
						<div class="">     
						      <dl>
						          <label>用户名</label>
						          <dd style="min-height:54px;">
						            <input id="user_name" name="user_name" class="text tip valid" title="3-15位字符，可由中文、英文、数字组成" autofocus="" type="text">
					 
						          </dd>
						        </dl>
						        <dl>
						          <label>设置密码</label>
						          <dd style="min-height:54px;">
						            <input id="password" name="password" class="text tip valid" title="6-20位字符，可由英文、数字及标点符号组成" type="password">
						   
						          </dd>
						        </dl>
						        <dl>
						          <label>确认密码</label>
						          <dd style="min-height:54px;">
						            <input id="password_confirm" name="password_confirm" class="text tip" title="请再次输入您的密码" type="password">
					 
						          </dd>
						        </dl>
						      <dl>
						          <label>手机</label>
						          <dd style="min-height:54px;">
						              <input id="mobile" name="mobile" class="text tip" title="请输入常用的手机号，将用来找回密码、接受订单通知等" type="text">
				 
						          </dd>
						      </dl>
                              <input id="member_reg" value="立即注册" class="submit rio-button" title="立即注册" type="button">
						    </div>              
	             </div>
             </div>
		   </div>
		   <!-- 遮罩层 -->
		  <a id="fullbg" class="mask-layer" href="javascript:;" ></a>
</div>


<script type="text/javascript">
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
				window.location.href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160518";
			}else{
				var txt=  "<p>"+result.error+"</p>";
				var option = {
					title: "提示信息：",										
				}
				window.wxc.xcConfirm(txt, "custom", option);
				$("#member_login").attr("disabled",false);
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
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160518&action=regs",
		data:{user_name:user_name,password:password,password1:password_confirm,mobile:mobile,ua:ua},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160518";
			}else{
				var txt=  "<p>"+result.msg+"</p>";
				var option = {
					title: "提示信息：",										
				}
				window.wxc.xcConfirm(txt, "custom", option);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});

</script>