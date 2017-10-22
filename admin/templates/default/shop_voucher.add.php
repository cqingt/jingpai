<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>新增平台优惠券</h3>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=voucher&op=<?php echo $output['menu_key']; ?>">
  <input type="hidden" name="tid" value="<?php echo $output['info']['voucher_t_id'];?>">
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">优惠券名称：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input type="text" id="voucher_name" name="voucher_name" class="txt" value="<?php echo $output['info']['voucher_t_title'];?>"></td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="validation">有效期：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input type="text" id="voucher_start_date" name="voucher_start_date" class="txt" value="<?php echo $output['info']['voucher_t_start_date'] != '' ? date("Y-m-d",$output['info']['voucher_t_start_date']) : date("Y-m-d",time());?>" style="width:100px"> 至 <input type="text" id="voucher_end_date" name="voucher_end_date" class="txt" value="<?php echo $output['info']['voucher_t_end_date'] != '' ? date("Y-m-d",$output['info']['voucher_t_end_date']) : date("Y-m-d",time());?>" style="width:100px"></td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="validation">面额：</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="voucher_price" name="voucher_price" class="txt" value="<?php echo $output['info']['voucher_t_price'];?>">元</td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="validation">可发放总数：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input type="text" id="voucher_total" name="voucher_total" class="txt" value="<?php echo $output['info']['voucher_t_total'];?>"></td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="validation">每人限领：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input type="text" id="voucher_eachlimit" name="voucher_eachlimit" class="txt" value="<?php echo $output['info']['voucher_t_eachlimit'];?>"></td>
            <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
            <td colspan="2" class="required"><label class="validation">消费金额：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><input type="text" id="voucher_amount" name="voucher_amount" class="txt" value="<?php echo $output['info']['voucher_t_limit'];?>">元</td>
            <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">优惠券描述：</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="voucher_desc" rows="6" class="tarea" id="voucher_desc"><?php echo $output['info']['voucher_t_desc'];?></textarea></td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">优惠券图片：</label></td>
        </tr>
		 <tr class="noborder">
          <td class="vatop rowform">
                        <span class="type-file-show">
                            <?php if($output['info']['voucher_t_customimg']) { ?>
                            <img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png">
                            <div class="type-file-preview"><img width="500" src="<?php echo UPLOAD_SITE_URL.'/shop/waybill'.DS.$output['info']['voucher_t_customimg'];?>"></div>
                            <?php } ?>
                        </span>
                        <span class="type-file-box">
                            <input type='text' name='waybill_image_name' id='waybill_image_name' class='type-file-text' />
                            <input type='button' name='button' id='button1' value='' class='type-file-button' />
                            <input name="waybill_image" type="file" class="type-file-file" id="waybill_image" size="30" hidefocus="true" nc_type="change_seller_center_logo">
                        </span>
             </td>
          <td class="vatop tips"></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">可用店铺：</label></td>
        </tr>

		<tr class="noborder" style="background: rgb(255, 255, 255);">
          <td class="vatop rowform onoff"><label for="store_state1" class="cb-enable<?php if($output['info']['voucher_t_store_id'] == 0){?> selected<?php }?>"><span>全部店铺</span></label>
            <label for="store_state0" class="cb-disable<?php if($output['info']['voucher_t_store_id'] != 0){?> selected<?php }?>"><span>部分店铺</span></label>
            <input id="store_state1" name="store_id" <?php if($output['info']['voucher_t_store_id'] == 0){?> checked="checked"<?php }?> onclick="$('#tr_store_close_info').hide();" value="1" type="radio">
            <input id="store_state0" <?php if($output['info']['voucher_t_store_id'] != 0){?>checked="checked"<?php }?> name="store_id" onclick="$('#tr_store_close_info').show();" value="0" type="radio"></td>
          <td class="vatop tips"></td>
        </tr>
		<tr class="noborder" id="tr_store_close_info" <?php if($output['info']['voucher_t_store_id'] == 0){?>style="display:none;"<?php }?> >
          <td class="vatop rowform">
		  <?php 
				if($output['info']['voucher_t_store_id']){
					$voucher_t_store_id = explode(',',$output['info']['voucher_t_store_id']);
					$disarray = array();
					foreach($voucher_t_store_id as $v){
						$disarray[$v] = '1';
					}
				}
		  ?>
		  <?php foreach($output['store_list'] as $sk=>$sv){ ?>
		  <input type="checkbox" name="store[]" value="<?php echo $sv['store_id'];?>" <?php if($disarray[$sv['store_id']]){ ?>checked<?php } ?>><?php echo $sv['store_name'];?>
		  <?php } ?>
		  </td>
          <td class="vatop tips"></td>
        </tr>



      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){
	$("#waybill_image").change(function(){
		$("#waybill_image_name").val($(this).val());
	});
    $('#voucher_start_date').datepicker();
    $('#voucher_end_date').datepicker();

    $("#submitBtn").click(function(){
		$("#add_form").submit();
	});
	//页面输入内容验证
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },

        rules : {
        	voucher_name: {
                required : true,
                maxlength : 50
        	},
			voucher_start_date: {
                required : true
        	},
			voucher_end_date: {
                required : true
        	},
        	voucher_price: {
                required : true,
                digits : true,
                min : 1
            },
			voucher_total: {
               required : true,
               digits : true,
               min : 1
        	},
			voucher_eachlimit: {
               required : true,
               digits : true,
               min : 1
        	},
			voucher_amount: {
                required : true,
                digits : true,
                min : 1
            },
            voucher_desc: {
                required : true
            }
//				,
//            waybill_image: {
//                <?php if(!$output['info']['voucher_t_customimg']) { ?>
//                required : true,
//                <?php } ?>
//                accept: "jpg|jpeg|png"
//            }
        },
        messages : {
      		voucher_name: {
       			required : '优惠劵名称不能为空',
       			maxlength : '优惠劵最多可以输入50个字'
	    	},
			voucher_start_date: {
       			required : '有效开始日期不能为空'
	    	},
			voucher_end_date: {
       			required : '有效结束日期不能为空'
	    	},
	    	voucher_price: {
                required : '<?php echo $lang['admin_voucher_price_error'];?>',
                digits : '<?php echo $lang['admin_voucher_price_error'];?>',
                min : '<?php echo $lang['admin_voucher_price_error'];?>'
		    },
			voucher_total: {
                required : '可发总数不能为空',
                digits : '可发总数必须为数字',
                min : '可发总数不能小于1'
        	},
			voucher_eachlimit: {
                required : '每人限领不能为空',
                digits : '每人限领必须为数字',
                min : '每人限领不能小于1'
        	},
			voucher_amount: {
                required : '消费金额不能为空',
                digits : '消费金额必须为数字',
                min : '消费金额不能小于1'
            },
		    voucher_desc: {
                required : '优惠券描述不能为空'
            }
//			,
//            waybill_image: {
//                <?php if(!$output['info']['voucher_t_customimg']) { ?>
//                required : '图片不能为空',
//                <?php } ?>
//                accept: '图片类型不正确' 
//            }
        }
	});
});
</script>

<script type="text/javascript" src="http://resource.96567.com/js/jquery-ui/jquery.ui.js"></script>
<script src="http://resource.96567.com/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://resource.96567.com/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
