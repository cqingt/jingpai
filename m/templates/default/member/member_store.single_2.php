<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/js/total.js"></script>



<!-- 默认城市联动 -->
<script>
  var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<!-- End -->



<form id="login_form" action="<?php echo urlWap('member_store_joinin','single_2_save');?>" method="post">

  <section>
    <div class="headline">
      <h1>结算账号信息</h1>

    </div>
    
    <div class="merchant">




    <div class="form-team">
      <label for=""><em>*</em>银行开户名：<p>请填写银行开户时所填的个人真实姓名</p></label>
      <input class="same1" type="text" value="" name="bank_account_name" id="bank_account_name">
    </div>  

    <div class="form-team">
      <label for=""><em>*</em>个人银行账号：<p>请不要使用信用卡和存折</p></label>
      <input class="same1" type="text" value="" name="bank_account_number" id="bank_account_number">
    </div>     
  

    <div class="form-team">
      <label for=""><em>*</em>开户银行支行名称：</label>
      <input class="same1" type="text" value="" name="bank_name" id="bank_name">
    </div>  

    <div class="form-team">
      <label for=""><em>*</em>公司所在地：</label>
      <input id="bank_address" name="bank_address" type="hidden" value=""/>
    </div>   




    <div class="error-tips mt10"></div>

    <?php Security::getToken();?>
    <input type="hidden" name="form_submit" value='ok'>

    <div class="submit">
      <input class="btn-next" type="submit" value="下一步">
    </div>

    </div>
        
  </section>

</form>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(function(){

  $('#bank_address').nc_region();



  $("#login_form").validate({
      errorElement: "p",
      errorPlacement: function(error, element){
      error.appendTo($(".error-tips").show());
      },

      rules: {
          bank_account_name: "required",
          bank_account_number: "required",
          bank_name: "required",
          bank_address: "required"
      },

      messages: {
          bank_account_name: "请填写银行开户名",
          bank_account_number: "请填写公司银行账号",
          bank_name: "请填写开户银行支行名称",
          bank_address: "请选择开户银行所在地"
      }

  });

})


</script>