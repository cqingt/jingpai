<?php defined('InShopNC') or exit('Access Invalid!');?>

<!-- 店铺信息 -->

<div id="apply_store_info" class="apply-store-info">
  <div class="alert">
    <h4>注意事项：</h4>
    店铺经营类目为商城商品分类，请根据实际运营情况添加一个或多个经营类目。</div>
  <form id="form_store_info" action="index.php?act=store_joinin&op=step4" method="post" >
    <table border="0" cellpadding="0" cellspacing="0" class="all">
      <thead>
        <tr>
          <th colspan="20">店铺经营信息</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="w150"><i>*</i>商家账号：</th>
          <td><input id="seller_name" name="seller_name" type="text" class="w200"/>
            <span></span>
            <p class="emphasis">此账号为日后登录并管理商家中心时使用，注册后不可修改，请牢记。</p></td>
        </tr>
        <tr>
          <th class="w150"><i>*</i>店铺名称：</th>
          <td><input name="store_name" type="text" class="w200"/>
            <span></span>
            <p class="emphasis">店铺名称注册后不可修改，请认真填写。</p></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="20">&nbsp;</td>
        </tr>
      </tfoot>
    </table>
  </form>
  <div class="bottom"><a id="btn_apply_store_next" href="javascript:;" class="btn">提交申请</a>
  </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
<script type="text/javascript">
$(document).ready(function(){
	//gcategoryInit("gcategory");

    jQuery.validator.addMethod("seller_name_exist", function(value, element, params) { 
        var result = true;
        $.ajax({  
            type:"GET",  
            url:'<?php echo urlShop('store_joinin', 'check_seller_name_exist');?>',  
            async:false,  
            data:{seller_name: $('#seller_name').val()},  
            success: function(data){  
                if(data == 'true') {
                    $.validator.messages.seller_name_exist = "卖家账号已存在";
                    result = false;
                }
            }  
        });  
        return result;
    }, '');
	jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^([\u4E00-\u9FA5|a-zA-Z])+$/i.test(value);
			
	}, ""); 
	jQuery.validator.addMethod("seller_name_lettersonly", function(value, element) {
			return this.optional(element) || /^([\u4E00-\u9FA5|a-zA-Z|0-9])+$/i.test(value);
			
	}, "");
    $('#form_store_info').validate({
        errorPlacement: function(error, element){
            element.nextAll('span').first().after(error);
        },
        rules : {
            seller_name: {
                required: true,
                maxlength: 50,
				seller_name_lettersonly: true,
                seller_name_exist: true
            },
            store_name: {
                required: true,
                maxlength: 50,
				lettersonly: true,
                remote : '<?php echo urlShop('store_joinin', 'checkname');?>'
            }
        },
        messages : {
            seller_name: {
                required: '请填写卖家用户名',
                maxlength: jQuery.validator.format("最多{0}个字"),
				seller_name_lettersonly: '商家账号只能为汉字、字母或数字'
            },
            store_name: {
                required: '请填写店铺名称',
                maxlength: jQuery.validator.format("最多{0}个字"),
				lettersonly: '店铺名称只能为汉字或者字母',
                remote : '店铺名称已存在，请更换！'
            }
        }
    });

    $('#btn_select_category').on('click', function() {
        $('#gcategory').show();
        $('#btn_select_category').hide();
        $('#gcategory_class1').val(0).nextAll("select").remove();
    });

    $('#btn_add_category').on('click', function() {
        var tr_category = '<tr class="store-class-item">';
        var category_id = '';
        var category_name = '';
        var class_count = 0;
        var validation = true;
        var i = 1;
        $('#gcategory').find('select').each(function() {
            if(parseInt($(this).val(), 10) > 0) {
                var name = $(this).find('option:selected').text();
                tr_category += '<td>';
                tr_category += name;
                if ($('#gcategory > select').size() == i) {
                    //最后一级显示分佣比例
                    tr_category += ' (分佣比例：' + $(this).find('option:selected').attr('data-explain') + '%)';
                }
                tr_category += '</td>';
                category_id += $(this).val() + ',';
                category_name += name + ',';
                class_count++;
            } else {
                validation = false;
            }
            i++;
        });
        if(validation) {
            for(; class_count < 3; class_count++) {
                tr_category += '<td></td>';
            }
            tr_category += '<td><a nctype="btn_drop_category" href="javascript:;">删除</a></td>';
            tr_category += '<input name="store_class_ids[]" type="hidden" value="' + category_id + '" />';
            tr_category += '<input name="store_class_names[]" type="hidden" value="' + category_name + '" />';
            tr_category += '</tr>';
            $('#table_category').append(tr_category);
            $('#gcategory').hide();
            $('#btn_select_category').show();
            select_store_class_count();
        } else {
            showError('请选择分类');
        }
    });

    $('#table_category').on('click', '[nctype="btn_drop_category"]', function() {
        $(this).parent('td').parent('tr').remove();
        select_store_class_count();
    });

    // 统计已经选择的经营类目
    function select_store_class_count() {
        var store_class_count = $('#table_category').find('.store-class-item').length;
        $('#store_class').val(store_class_count);
    }

    $('#btn_cancel_category').on('click', function() {
        $('#gcategory').hide();
        $('#btn_select_category').show();
    });

    $('#btn_apply_store_next').on('click', function() {
        $('#form_store_info').submit();
    });
});
</script> 
