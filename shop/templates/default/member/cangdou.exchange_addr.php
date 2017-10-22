<?php defined('InShopNC') or exit('Access Invalid!');?>
<dl>
    <dt><i class="required">*</i>收货人：</dt>
    <dd>
        <input type="text" class="text w100" name="true_name" value="">
        <p class="hint">请填写您的真实姓名</p>
    </dd>
</dl>
<dl>
    <dt><i class="required">*</i>所在地区：</dt>
    <dd>
        <div id="region">
            <input type="hidden" value="" name="city_id" id="city_id">
            <input type="hidden" name="area_id" id="area_id" value="" class="area_ids" />
            <input type="hidden" name="area_info" id="area_info" value="" class="area_names" />
            <select>
            </select>
        </div>
    </dd>
</dl>
<dl>
    <dt><i class="required">*</i>街道地址：</dt>
    <dd>
        <input class="text w300" type="text" name="address" value="">
        <p class="hint">不必重复填写地区</p>
    </dd>
</dl>
<dl>
    <dt><i class="required">*</i>手机号码：</dt>
    <dd>
        <input type="text" class="text w200" name="mob_phone" value="">
        <p class="hint">请填写手机号码</p>
    </dd>
</dl>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function(){
        regionInit("region");
        $('#address_form').validate({
            submitHandler:function(form){
                form.submit();
            },
            errorLabelContainer: $('#warning'),
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if(errors)
                {
                    $('#warning').show();
                }
                else
                {
                    $('#warning').hide();
                }
            },
            rules : {
                true_name : {
                    required : true
                },
                area_id : {
                    required : true,
                    min   : 1,
                    checkarea : true
                },
                address : {
                    required : true
                },
                mob_phone : {
                    required : true,
                    minlength : 11,
                    maxlength : 11,
                    digits : true
                }
            },
            messages : {
                true_name : {
                    required : '请填写收货人姓名'
                },
                area_id : {
                    required : '请选择所在地区',
                    min  : '请选择所在地区',
                    checkarea  : '请选择所在地区'
                },
                address : {
                    required : '请填写详细地址'
                },
                mob_phone : {
                    required : '请填写手机号码',
                    minlength: '错误的手机号码',
                    maxlength: '错误的手机号码',
                    digits : '错误的手机号码'
                }
            }
        });
    });
</script>