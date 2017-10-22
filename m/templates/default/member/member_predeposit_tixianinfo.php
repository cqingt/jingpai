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


<form id="form1" action="<?php echo urlWap('member_predeposit','tixian_info');?>" method="post">

  <div class="demo-box mtb">
    <div class="ui-word">
      <p>提现金额</p>
      <h3><input type="text" name="pdc_amount" id="pdc_amount" value="" placeholder="提现金额"/></h3>
      <p class="ui-anf">当前可用余额<?php echo $output['member_info']['available_predeposit'];?>元</p>
    </div>
  </div>



  <div class="demo-box mb">
    <div class="ui-word">
      <div class="ui-form-link">
         <h4 class="asterisk">收款银行</h4>
        <input type="text" name="pdc_bank_name" id="pdc_bank_name" value="" placeholder="银行账号或支付宝账号"/>
      </div>
      <p class="ui-anf">支持全国各大银行及支付宝，银行卡提现请填写详细的开户银行分行名称，建议使用国有4大银行（中国银行、中国建设银行、中国工商银行和中国农业银行），使用支付宝提现直接填写“支付宝”即可。</p>
    </div>
  </div>
  
  <div class="demo-boxes ui-border-tb mb">
    <div class="ui-word">
      <div class="ui-form-link">
         <h4 class="asterisk">收款帐号</h4>
         <input type="text" name="pdc_bank_no" id="pdc_bank_no" value="" placeholder="银行账号或支付宝账号"/>
      </div>
      <div class="ui-form-link">
         <h4 class="asterisk">开户人姓名</h4>
         <input type="text" name="pdc_bank_user" id="pdc_bank_user" value="" placeholder="收款账号的开户人姓名" />
      </div>
      <div class="ui-form-link">
         <h4 class="asterisk">支付密码</h4>
         <input type="password" name="password" id="password" value="" />
      </div>            
    </div>
  </div>    
  
  <div class="error-tips mt10"></div>
  <?php Security::getToken();?>
  <input type="hidden" name="form_submit" value="ok">

  <div class="btn-wrap">
    <input class="btn-okey" type="submit" name="" id="" value="确认提现" />
  </div>
  
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
          pdc_amount: "required",
          pdc_bank_name: "required",
          pdc_bank_no: "required",
          pdc_bank_user: "required",
          password: "required"
      },
      messages: {
          pdc_amount: "提现金额不能为空！",
          pdc_bank_name: "收款银行不能为空！",
          pdc_bank_no: "收款帐号不能为空！",
          pdc_bank_user: "开户人姓名不能为空！",
          password: "请输入支付密码！"
      }
  });


})
</script>