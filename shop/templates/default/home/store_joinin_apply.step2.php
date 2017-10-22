<?php defined('InShopNC') or exit('Access Invalid!');?>

<!-- 公司资质 -->

<div id="apply_credentials_info" class="apply-credentials-info">
  <div class="alert">
    <h4>注意事项：</h4>
    以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。</div>
  <form id="form_credentials_info" action="index.php?act=store_joinin&op=step3" method="post" enctype="multipart/form-data" >
    <table border="0" cellpadding="0" cellspacing="0" class="all">
      <thead>
        <tr>
          <th colspan="20">开户银行信息</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="w150"><i>*</i>银行开户名：</th>
          <td><input name="bank_account_name" type="text" class="w200" />
            <span></span>
            
            </td>
        </tr>
        <tr>
          <th><i>*</i>公司银行账号：</th>
          <td><input name="bank_account_number" type="text" class="w200" />
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>开户银行支行名称：</th>
          <td><input name="bank_name" type="text" class="w200" />
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>开户银行所在地：</th>
          <td><input id="bank_address" name="bank_address" type="hidden" />
            <span></span></td>
        </tr>
        <tr>
          <th><i>*</i>开户银行许可证电子版：</th>
          <td><input name="bank_licence_electronic" type="file" />
            <span class="block">请确保图片清晰，文字可辨并有清晰的红色公章。</span></td>
        </tr>
        <input id="is_settlement_account" name="is_settlement_account" type="hidden" value="1"/>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="20">&nbsp;</td>
        </tr>
      </tfoot>
    </table>
  </form>
  <div class="bottom"><a id="btn_apply_credentials_next" href="javascript:;" class="btn">下一步，提交店铺经营信息</a></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    var use_settlement_account = false;
    $("#bank_address").nc_region();
    $("#settlement_bank_address").nc_region();


    $('#form_credentials_info').validate({
        errorPlacement: function(error, element){
            element.nextAll('span').first().after(error);
        },
        rules : {
            bank_account_name: {
                required: true,
                maxlength: 50 
            },
            bank_account_number: {
                required: true,
                maxlength: 25
            },
            bank_name: {
                required: true,
                maxlength: 50 
            },
            bank_address: {
                required: true
            },
            bank_licence_electronic: {
                required: true
            }

        },
        messages : {
            bank_account_name: {
                required: '请填写银行开户名',
                maxlength: jQuery.validator.format("最多{0}个字")
            },
            bank_account_number: {
                required: '请填写公司银行账号',
                maxlength: jQuery.validator.format("最多{0}个字")
            },
            bank_name: {
                required: '请填写开户银行支行名称',
                maxlength: jQuery.validator.format("最多{0}个字")
            },
            bank_address: {
                required: '请选择开户银行所在地'
            },
            bank_licence_electronic: {
                required: '请选择上传开户银行许可证电子版文件'
            }
        }
    });

    $('#btn_apply_credentials_next').on('click', function() {
        if($('#form_credentials_info').valid()) {
            $('#form_credentials_info').submit();
        }
    });

});
</script>