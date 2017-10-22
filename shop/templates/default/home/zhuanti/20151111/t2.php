<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="Copyright" content="" />
<title></title>
<style>
* {padding: 0; margin: 0;}
a { text-decoration: none; border: 0;}
body, input, textarea, select, button { font-size: 14px; font-family: Tahoma, SimSun, sans-serif; }

.mt20 {
    margin-top: 20px;
}
#forlogin {
    width: 322px;
    padding: 10px;
    margin: 0 auto;
}
.buttonStyle{
    display: inline-block;
    border: 0;
    clear: both;
    cursor: pointer;
    width: 320px;
    font-size: 14px;
    padding: 8px 16px;
    color: #fff;
    margin: 10px 0;
    background: #dd2230;
}
.open {
  float: right;
  border: 0;
  background: #fff;
  font: 14px 'microsoft yahei'; 
  margin-bottom: 10px;
  cursor: pointer;
  width: 20px;
}
.box {
    margin-bottom: 10px;
}
.box .text {
    font: 14px 'microsoft yahei'; 
    float: left;
    width: 60px;
    padding: 8px 0;
}
.box input {
    padding: 8px 16px;
    border: 1px solid #d7d7d7;
    width: 226px;
}
p {
    font: 14px/30px 'microsoft yahei'; 
}


</style>
<script src="http://resource.96567.com/js/jquery.js"></script>

<script type="text/javascript">
function fun1()
{
}
function fun2()
{		
		var l_id = $("#l_id").val();
		var name=$("#name").val();
		var tel=$("#tel").val();
		if(name==""){
			alert("请输入姓名");
			$("#name").focus();
			return false;
		}
		if(tel==""){
			alert("请输入电话");
			$("#tel").focus();
			return false;
		}
		if (!valid_shouji(tel))
		{
			alert("请输入正确的电话");
			$("#tel").focus();
			return false;
		}
		$.post("/shop/index.php?act=zhuanti&op=ad_20151111&action=post_ajax",{"name":name,"mobile":tel,"l_id":l_id},function(result){
			if(result == -1){//未登录跳转到登录页面
						window.location.href="/shop/index.php?act=login&op=index";
						return false; 
					}
			if(result==-2){
					alert("您已经提交过了");
					$("#tel").focus();
					return false;
			}

			if(result==1){
					alert("您已成功兑换，请等待客服与您联系确认！");	
					window.open ("/shop/index.php?act=zhuanti&op=ad_20151111&t="+new Date().getTime()+"", "_top" );
					return false;
			}
		});
}
function fun3()
{
    parentDialog.close();
}

function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}
</script>
</head>
<body>
<div id="forlogin">
      <input onClick="fun3()" class="open" type="button" value="X" />
	  <input type="hidden" name="l_id" id="l_id" value="<?php echo $_GET['l_id'];?>">
      <div class="box mt20">
           <div class="text">姓名：</div>
           <div class="input"><input type="text" value="" name="name" id="name" /></div>
      </div>
      <div class="box">
           <div class="text">手机号：</div>
           <div class="input"><input type="text" value="" name="tel" id="tel" /></div>
      </div>
      <input onClick="fun2()" class="buttonStyle" type="button" value="提交" />
      <p>提交信息后，客服专员将尽快致电给您确认收货事宜</p>
</div>
</body>
</html>