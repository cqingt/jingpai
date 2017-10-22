<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">

<div class="login-form">
    <form action="<?php echo urlWap('goods','arrival_notice_submit');?>" method ="post" id="login_form">

      <input type="hidden" name="type" value="<?php echo $output['type']?>">
      <input type="hidden" name="goods_id" value="<?php echo $output['goods_id']?>">
        <span>
            <input type="text" placeholder="手机号码" class="input-40" name="mobile" id="mobile"/>
        </span>
         <span>
            <input type="text" placeholder="邮箱号码" class="input-40" name="email" id="email"/>
        </span>

        <div class="error-tips mt10"></div>

        <input type="hidden" name="form_submit" value="ok" />
        <input type="submit" class="l-btn-login mt10" id="loginbtn"  value="提交">
    </form>

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
                    mobile: "required",
                    email: "required"
                },
                messages: {
                    mobile: "手机号码必填！",
                    email: "邮箱号码必填！"
                }
            });
})
</script>