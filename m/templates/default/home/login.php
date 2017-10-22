<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">

<div class="login-form">
    <form action="" method ="post" id="login_form">
      <input type="hidden" name="act" value="login">
      <input type="hidden" name="op" value="index">
        <input type="hidden" name="ref_url" value="<?php echo $output['ref_url']?>">
        <span>
            <input type="text" placeholder="用户名" class="input-40" name="username" id="username"/>
        </span>
         <span>
            <input type="password" placeholder="密码" class="input-40" name="password" id="password"/>
        </span>
        <!-- <span class="clearfix auto-login">
            <i class="s-chk1 fleft mr5"></i>
            <span>7天内免登录</span>
        </span> -->
        <div class="error-tips mt10"></div>

        <input type="hidden" name="form_submit" value="ok" />
        <input type="button" class="l-btn-login mt10" id="loginbtn"  value="登陆">
    </form>

    <div class="footer-top">
    <div class="footer-tleft">
        <a href="<?php echo urlWap('login','register')?>" style="color:#D9434E;font-size:16px;">注册</a>
		<a href="<?php echo urlWap('member_pas','pas_step1')?>" style="color:#D9434E;font-size:16px;">忘记密码</a>
    </div>
    </div>

</div>



<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(function(){$("#loginbtn").click(function(){
    if($("#login_form").valid()){
		 var tprm = "userName="+$("#username").val();
		 __ozfac2(tprm,"#logSuccess");
		 setTimeout("",300);
		 $("#login_form").submit();
	}
	});
});
$(function(){
     $("#login_form").validate({
                errorElement: "p",
                errorPlacement: function(error, element){
                error.appendTo($(".error-tips").show());
                },
                rules: {
                    username: "required",
                    password: "required"
                },
                messages: {
                    username: "用户名必填！",
                    password: "密码必填！"
                }
            });
})
</script>