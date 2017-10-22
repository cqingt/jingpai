<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">

<div class="login-form">
    <form action="" method ="post" id="login_form">
      <input type="hidden" name="act" value="login">
      <input type="hidden" name="op" value="register">
        <span>
            <input type="text" placeholder="用户名" class="input-40" name="username" id="username"/>
        </span>
         <span>
            <input type="password" placeholder="密码" class="input-40" name="password" id="password"/>
        </span>
        <span>
            <input type="password" placeholder="确认密码" class="input-40" name="password_confirm" id="password_confirm"/>
        </span>
         <span>
            <input type="text" placeholder="手机" class="input-40" name="mobile" id="mobile"/>
        </span>

        <!-- <span class="clearfix auto-login">
            <i class="s-chk1 fleft mr5"></i>
            <span>7天内免登录</span>
        </span> -->
        <div class="error-tips mt10"></div>

        <input type="hidden" name="form_submit" value="ok" />

        <input type="submit" class="l-btn-login mt10" id="loginbtn"  value="注册">
    </form>

    <div class="footer" id="footer">
    </div>

    <div class="footer-top">
    <div class="footer-tleft">
        <a href="<?php echo urlWap('login','index')?>" style="color:#D9434E;font-size:16px;">登陆</a>
		<a href="<?php echo urlWap('member_pas','pas_step1')?>" style="color:#D9434E;font-size:16px;">忘记密码</a>
    </div>
    </div>

</div>



<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(function(){
     $("#login_form").validate({
                errorElement: "p",
                errorPlacement: function(error, element){
                error.appendTo($(".error-tips").show());
                },
                rules: {
                    username: "required",
                    password: "required",
                    password_confirm: "required",
                    mobile: "required"
                },
                messages: {
                    username: "用户名必填！",
                    password: "密码必填！",
                    password_confirm: "确认密码必填！",
                    mobile: "手机号必填！"
                }
            });
})
</script>