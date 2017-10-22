<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
 <style type="text/css">
.denglu {margin:10px; font-size:14px;}
.denglu .kuang{width:100%; height:30px; line-height:30px; font-family:"Microsoft YaHei"; font-size:14px; margin:0px; padding:0px; text-indent:0.5em; border:none; border:0px;}
.denglu2{overflow:hidden; padding-top:10px; padding-bottom:5px;}
.denglu4{overflow:hidden; padding-top:10px; padding-bottom:5px;}
.denglu3 {border:1px  solid #ddd; overflow:hidden; margin-bottom: 14px;}
.denglu5 {border:1px  solid #ddd; overflow:hidden;}

.denglu6 {width:100%;overflow:hidden; padding-top:14px;}
.denglu7 {overflow:hidden; padding-top:10px;}
.denglu7 a {font-size:14px; font-family:"Microsoft YaHei"; text-decoration:none; color:#007be0;}

.denglu .anniu{width:100%; font-family:"Microsoft YaHei"; display:block; overflow:hidden; text-align:center; line-height:30px; border-radius:5px; border:1px solid #c00;background:-webkit-gradient(linear,0% 0,0% 100%,from(#e00),to(#c00)); font-size:18px; color:#fff; padding:0px; margin:0px;}

.denglu8 { display: -webkit-box !important;
	display: -moz-box !important;
	display: -o-box !important;
	display: box !important;
	position:relative;}
.denglu81 {position:relative;
	-webkit-box-flex: 1; 
	-moz-box-flex: 1; 
	-o-box-flex: 1; 
	box-flex: 1;
	border:1px solid #ddd; }
.denglu81 input {width:100%; height:30px; border:0px; font-family:"Microsoft YaHei"; font-size:14x; margin:0px; padding:0px; text-indent:0.5em;}
.denglu82 {height:32px; overflow:hidden; padding-left:10px;}
.denglu82 input{width:140px; height:32px ;font-family:"Microsoft YaHei";  color:#fff; border:none; border:0px; border-radius:5em; background:-webkit-gradient(linear,0% 0,0% 100%,from(#e00),to(#c00)); border:1px solid #c00; font-size: 14px !important;}
</style>
<script type="text/javascript">
function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}
var clock=60;
function checkmobile2()
{
	if($("#member_name").val()==""){
		alert("用户名不能为空");
		$("#member_name").focus();
		return false;	
	}
	var ab=/^(1[3-9][0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/;
	if($("#extend_field5").val()==""){
			alert("请输入手机号");
			$("#extend_field5").focus();
			return false;	
	}
	if(ab.test($("#extend_field5").val()) == false){
  		alert("请正确填写手机号码!");
		$("#extend_field5").focus();
   	 	return false;
 	}
	
	$("#button").attr("value",'正在验证...');
	$("#button").attr("disabled",true);
 	$.post("index.php?act=member_pas&op=ajax_mobile",{"arrnum":$("#extend_field5").val(),'member_name':$("#member_name").val()},function(result){
		if(result==1){
			$("#extend_field5").attr("disabled",true);
			$("#button").attr("value",'手机验证短信已发出');
			$("#button").attr("disabled",true);
			alert("您的验证短信已经发送");
			$("#code").focus();
			clock=60
			fun();
		}else if(result==0){
			alert("短信发布过快,请等待60秒后再次获取!");
			$("#button").attr("disabled",false);
			$("#button").attr('value','获取短信验证码');
			$("#extend_field5").focus();
			return false;
		}else{
			alert(result);
			$("#button").attr("disabled",false);
			$("#button").attr('value','获取短信验证码');
			$("#member_name").focus();
			return false;
		}

 	});
}

function fun(){ 
	if (clock==0) 
	{
		$("#button").attr("disabled",false);
		$("#PhoneCall").attr("disabled",false);
		$("#button").attr('value','获取短信验证码')
	} 
	else { 
		clock=clock-1;
		$("#button").attr('value','还有'+clock+'秒再次发送')
		setTimeout("fun()",1000);
	}
}

function getpassword(){
var member_name = document.getElementById('member_name');
var extend_field5 = document.getElementById('extend_field5');
var code = document.getElementById('code');
if(member_name.value == ""){
	alert("用户名不能为空");
	$("#member_name").focus();
	return false;	
}
if(extend_field5.value==""){
		alert("手机号码不能为空");
		extend_field5.focus();
		return false;
}
if(!valid_shouji(extend_field5.value)) {
		alert("请输入正确的手机号码");
		extend_field5.focus();
		return false;
}
if(code.value==""){
	alert("手机验证码不能为空")
	code.focus()
	return false;
}
$("#psubmit").attr("value",'正在提交...');
$("#psubmit").attr("disabled",true);
$.post("index.php?act=member_pas&op=getpassword",{"mobile":$("#extend_field5").val(),'member_name':$("#member_name").val(),"yzm":$("#code").val()},function(result){
		if(result==-1){
			alert("输入的用户名和手机号不匹配");
			$("#member_name").focus();
			$("#psubmit").attr("value",'提交');
			$("#psubmit").attr("disabled",false);
			 return false;
		}else if(result==0){
			alert("手机验证码输入错误");
			$("#code").focus();
			$("#psubmit").attr("value",'提交');
			$("#psubmit").attr("disabled",false);
			 return false;
		}else if(result==1){
			alert("您的密码已下发到您的手机，请注意查收！");
			location.href='index.php?act=login&op=index'
			return false;
		}
 	});
}

</script>
<div class="denglu">
<div class="denglu3" onmouseover="this.style.border='1px #f60 solid'"  onmouseout="this.style.border='1px #ddd solid'">
	 <input placeholder="用户名" name="member_name" id = "member_name" type="text"  class="kuang">
</div>
<div class="denglu3" onmouseover="this.style.border='1px #f60 solid'"  onmouseout="this.style.border='1px #ddd solid'">
	 <input placeholder="手机号" name="extend_field5" id = "extend_field5" type="tel" pattern="[0-9]*"  class="kuang">
</div>
<div class="denglu8">
     <div class="denglu81" onmouseover="this.style.border='1px #f60 solid'"  onmouseout="this.style.border='1px #ddd solid'">
     	  <input placeholder="动态码"  name="captcha" type="text" pattern="[0-9]*"  id="code" type="text">
     </div>
     <div class="denglu82">
          <input name="button" type="submit" value="获取动态码" id="button" onclick="return checkmobile2()" >
     </div>
</div>
<div class="denglu6"><input name="psubmit" id="psubmit" type="submit" value="提交" class="anniu" onclick="return getpassword()"></div>
</div>