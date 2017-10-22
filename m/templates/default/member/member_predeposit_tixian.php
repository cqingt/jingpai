<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/navigation.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />

<!-- add -->
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/paimaihui_pm.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo_pm.css" />
<!-- add end -->


<section>

<form id="form1" action="<?php echo urlWap('member_predeposit','tixian');?>" method="post">
  <div class="demo-boxes ui-border-tb mtb">
    <div class="ui-word">

      <div class="ui-form-link">
         <h4>手机号</h4>
         <input type="none" name="mob_phone" readonly="readonly" id="mob_phone" value="<?php echo encryptShow($output['member_info']['member_mobile'],4,4);?>" placeholder="请输入手机号"/>
      </div>

      <div class="ui-form-link no-border">
         <h4>验证码</h4>
         <input type="" name="yzm" id="yzm" value="" maxlength='4' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入验证码" />
         <input class="btn-get" type="button" name="push_yzm" id="push_yzm" value="获取验证码" />
      </div>  

    </div>
  </div>    
  

  <div class="btn-wrap">
    <input class="btn-okey" type="submit" name="" id="" value="下一步" />
  </div>

  <div class="error-tips mt10"></div>


  <?php Security::getToken();?>
  <input type="hidden" name="form_submit" value="ok">

</form>

</section>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>

$(function(){
  // 登录
  $("#form1").validate({
      errorElement: "p",
      errorPlacement: function(error, element){
      error.appendTo($(".error-tips").show());
      },
      rules: {
          mob_phone: "required",
          yzm: "required",
      },
      messages: {
          mob_phone: "手机号不能为空！",
          yzm: "验证码不能为空",
      }
  });



  $("#push_yzm").click(function(){
    var mob_phone = $("#mob_phone").val();

    if(!!mob_phone === false){
      alert('手机号码不能为空');
      return false;
    }

    $.post("index.php?act=member_predeposit&op=getOnePhoneYzm",{'mobile':mob_phone},function(data){

      if(data.state){
        alert(data.msg);
      }else if(data === true){
        alert('发送成功！');
      }

    },'json');


  })


})
</script>