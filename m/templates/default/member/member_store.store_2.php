<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">


<!-- 默认城市联动 -->
<script>
  var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<!-- End -->



<form id="form_company_info" action="<?php echo urlWap('member_store_joinin','store_2_save');?>" method="post" enctype="multipart/form-data" >

<section>
    <div class="headline">
      <h1>财务资质信息</h1>
      <h2 class="mt">注意事项：</h2>
      <p>以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。</p>
    </div>
    


  <div class="merchant">

    <h3>开户银行信息</h3>

    <div class="form-team">
      <label for=""><em>*</em>银行开户名：</label>
      <input class="same1" type="text" value="" name="bank_account_name">
    </div>
    

    <div class="form-team">
      <label for=""><em>*</em>公司银行账号：</label>
        <input class="same1" type="text" value="" name="bank_account_number">
    </div>  
    

    <div class="form-team">
      <label for=""><em>*</em>开户银行支行名称：</label>
      <input class="same1" type="text" value="" name="bank_name">
    </div>

    <!-- <div class="form-team">
      <label for=""><em>*</em>支行联行号：</label>
      <input  class="same1" type="text"  value="" name="bank_code"/>
    </div> -->
    

    <div class="form-team">
      <label for=""><em>*</em>开户银行所在地：</label>
      <input id="bank_address" name="bank_address" type="hidden" />
    </div>


    <div class="form-team">
      <label for=""><em>*</em>开户银行许可证电子版：</label>
      <input class="same1 image" type="file" value=""  name="bank_licence_electronic"/>
      <p class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
    </div>

<input id="is_settlement_account" name="is_settlement_account" type="hidden" value="1"/>

<!-- <h3></h3>

    <h3>结算账号信息</h3>

    <div class="form-team">
      <label for=""><em>*</em>银行开户名：</label>
      <input class="same1" type="text" value="" id="settlement_bank_account_name" name="settlement_bank_account_name">
    </div>
    

    <div class="form-team">
      <label for=""><em>*</em>公司银行账号：</label>
      <input class="same1" type="text" value="" id="settlement_bank_account_number" name="settlement_bank_account_number">
    </div>  
    

    <div class="form-team">
      <label for=""><em>*</em>开户银行支行名称：</label>
      <input class="same1" type="text" value="" id="settlement_bank_name" name="settlement_bank_name">
    </div>


    <div class="form-team">
      <label for=""><em>*</em>支行联行号：</label>
      <input  class="same1" type="text"  value=""  id="settlement_bank_code" name="settlement_bank_code"/>
    </div>
    

    <div class="form-team">
      <label for=""><em>*</em>开户银行所在地：</label>
      <input id="settlement_bank_address" name="settlement_bank_address" type="hidden" />
    </div>


<h3></h3>

    <h3>结算账号信息</h3>

    <div class="form-team">
      <label for=""><em>*</em>税务登记证号：</label>
      <input class="same1" type="text" value="" name="tax_registration_certificate">
    </div>
    

    <div class="form-team">
      <label for=""><em>*</em>纳税人识别号：</label>
      <input class="same1" type="text" value=""  name="taxpayer_id">

    </div>  
    

    <div class="form-team">
      <label for=""><em>*</em>税务登记证号电子版：</label>
      <input class="same1 image" type="file" value="" name="tax_registration_certificate_electronic" />
      <p class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
    </div> -->


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

<script type="text/javascript">

$(document).ready(function(){

    $("#bank_address").nc_region();
    $("#settlement_bank_address").nc_region();


      $('#form_company_info').validate({
        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".error-tips").show());
        },



      rules: {
          bank_account_name: {
                required: true,
            },
            bank_account_number: {
                required: true,
            },
            bank_name: {
                required: true,
            },
            // bank_code: {
            //     required: true,
            // },
            bank_address: {
                required: true
            },
            bank_licence_electronic: {
                required: true
            }
            // settlement_bank_account_name: {
            //   required: true
            // },
            // settlement_bank_account_number: {
            //   required: true
            // },
            // settlement_bank_name: {
            //   required: true
            // },
            // settlement_bank_code: {
            //   required: true
            // },
            // settlement_bank_address: {
            //   required: true
            // },
            // tax_registration_certificate: {
            //     required: true,
            // },
            // taxpayer_id: {
            //     required: true,
            // },
            // tax_registration_certificate_electronic: {
            //     required: true  
            // }

      },


      messages: {
          bank_account_name: {
                required: '请填写银行开户名',
            },
            bank_account_number: {
                required: '请填写公司银行账号',
            },
            bank_name: {
                required: '请填写开户银行支行名称',
            },
            // bank_code: {
            //     required: '请填写支行联行号',
            // },
            bank_address: {
                required: '请选择开户银行所在地'
            },
            bank_licence_electronic: {
                required: '请选择上传开户银行许可证电子版文件'
            }
            // settlement_bank_account_name: {
            //     required: '请填写银行开户名',
            // },
            // settlement_bank_account_number: {
            //     required: '请填写公司银行账号',
            // },
            // settlement_bank_name: {
            //     required: '请填写开户银行支行名称',
            // },
            // settlement_bank_code: {
            //     required: '请填写支行联行号',
            // },
            // settlement_bank_address: {
            //     required: '请选择开户银行所在地'
            // },
            // tax_registration_certificate: {
            //     required: '请填写税务登记证号',
            // },
            // taxpayer_id: {
            //     required: '请填写纳税人识别号',
            // },
            // tax_registration_certificate_electronic: {
            //     required: '请选择上传税务登记证号电子版文件'
            // }
      }


    });


})


</script>