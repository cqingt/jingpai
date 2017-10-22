<?php defined('InShopNC') or exit('Access Invalid!');?>
<style type="text/css">
#recommend_gcategory select {
	float: left;
	width: 90px;
	margin-right: 3px;
	margin-left: 3px;
}
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['promotion_index_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=promotion&op=promotion"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=promotion&op=new"><span><?php echo $lang['nc_new'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_edit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="promotion_id" value="<?php echo $output['promotion']['p_id'];?>" />
    <table class="table tb-type2">
      <tbody>
            <tr class="noborder">
          <td colspan="2"><label class="validation" for="promotion_title"><?php echo $lang['promotion_category'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform" id="recommend_gcategory">
       		<input type="hidden" id="cate_id" name="cate_id" value="<?php echo $output['promotion']['cate_id'];?>" class="mls_id" />
		    <input type="hidden" id="cate_name" name="cate_name" value="<?php echo $output['promotion']['cate_name'];?>" class="mls_names" />
	        <select>
		          <option value="0">-<?php echo $lang['nc_please_choose'];?>-</option>
		          <?php if(!empty($output['goods_class']) && is_array($output['goods_class'])) { ?>
		          <?php foreach($output['goods_class'] as $k => $v) { ?>
		          <option value="<?php echo $v['gc_id'];?>"><?php echo $v['gc_name'];?></option>
		          <?php } ?>
		          <?php } ?>
	        </select>
          </td>
          <td class="vatop tips"><?php //echo $lang['promotion_new_title_tip'];?></td>
        </tr>
        <tr class="noborder">
          <td colspan="2"><label class="validation" for="promotion_title"><?php echo $lang['promotion_index_goods'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform">
          <input type="text" value="<?php echo $output['promotion']['goods_name'];?>" name="recommend_goods_name" id="recommend_goods_name" class="txt">
          <a href="JavaScript:void(0);" onclick="get_recommend_goods();" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a>          <input name="goods_id" type="hidden" id="goods_id" value="<?php echo $output['promotion']['goods_id'];?>" />
          <input name="goods_pic" type="hidden" id="goods_pic" value="<?php echo $output['promotion']['goods_pic'];?>" />
          <input name="goods_price" type="hidden" id="goods_price" value="<?php echo $output['promotion']['goods_price'];?>" />
          <input name="market_price" type="hidden" id="market_price" value="<?php echo $output['promotion']['market_price'];?>" />
          <div id="show_recommend_goods_list" style="width:48%"></div>
          </td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="promotion_title"><?php echo $lang['promotion_index_title'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="promotion_title" name="promotion_title" class="txt" value="<?php echo $output['promotion']['promotion_title'];?>"></td>
          <td class="vatop tips"></td>
          
        </tr>
        <tr style="display:none;">
          <td colspan="2" class="required"><label for="promotion_type"><?php echo $lang['promotion_index_type'];?>:</label></td>
        </tr>
        <tr class="noborder" style="display:none;">
          <td class="vatop rowform"><select name="promotion_type" id="promotion_type">
              <option value="1" <?php if($output['promotion']['promotion_type']=='1'){?>selected<?php }?>><?php echo $lang['promotion_index_goods'];?></option>
              <option value="2" <?php if($output['promotion']['promotion_type']=='2'){?>selected<?php }?>><?php echo $lang['promotion_index_group'];?></option>
            </select></td>
          <td class="vatop tips"><?php echo $lang['promotion_new_type_tip'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="promotion_start_date"><?php echo $lang['promotion_index_start'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="promotion_start_date" class="txt date" name="promotion_start_date" value="<?php echo date('Y-m-d',$output['promotion']['promotion_start_date']);?>"/></td>
          <td class="vatop tips"></td>
          
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="promotion_end_date"><?php echo $lang['promotion_index_end'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="promotion_end_date" class="txt date" name="promotion_end_date" value="<?php if(!empty($output['promotion']['promotion_end_date']))echo date('Y-m-d',$output['promotion']['promotion_end_date']);?>"/></td>
          <td class="vatop tips"></td>
          
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" for="promotion_sort"><?php echo $lang['nc_sort'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="promotion_sort" name="promotion_sort" class="txt" value="<?php if($output['promotion']['promotion_sort']==''){?>255<?php }elseif($output['promotion']['promotion_sort']=='0'){ echo '0';}else{ echo $output['promotion']['promotion_sort'];}?>"></td>
          <td class="vatop tips"><?php echo $lang['promotion_new_sort_tip1'];?></td>
        </tr>
         <tr>
          <td colspan="2" class="required"><label for="promotion_sort"><?php echo $lang['promotion_openstate'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <select name="promotion_state" id="promotion_state">
            <?php foreach($output['typeArr'] as $k=>$v){ ?>
              <option value="<?php echo $k;?>" <?php if($k==$output['promotion']['promotion_state']){?>selected="selected"<?php }?>><?php echo $v;?></option>
            <?php } ?>
          </select></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/jquery.ui.js";?>"></script> 
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/i18n/zh-CN.js";?>" charset="utf-8"></script> 
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#add_form").valid()){
     $("#add_form").submit();
	}
	});
});
$(document).ready(function(){
	$("#promotion_start_date").datepicker();
	$("#promotion_end_date").datepicker();
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
	        	promotion_title: {
	    		required : true
	    	},
	    	promotion_start_date: {
	    		required : true,
				date      : false
	    	},
	    	promotion_end_date: {
	    		required : true,
				date      : false
	    	},
	    	promotion_sort: {
	    		required : true,
	    		min:0,
	    		max:255
	    	}
        },
        messages : {
        	promotion_title: {
	    		required : '<?php echo $lang['promotion_new_title_null'];?>'
	    	},
	    	promotion_start_date: {
	    		required : '<?php echo $lang['promotion_new_startdate_null'];?>'
	    	},
	    	promotion_end_date: {
	    		required : '<?php echo $lang['promotion_new_enddate_null'];?>'
	    	},
	    	promotion_sort: {
	    		required : '<?php echo $lang['promotion_new_sort_null'];?>',
	    		min:'<?php echo $lang['promotion_new_sort_minerror'];?>',
	    		max:'<?php echo $lang['promotion_new_sort_maxerror'];?>'
	    	}
        }
	});
});

$(function(){
// 模拟活动页面横幅Banner上传input type='file'样式
	var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='' class='type-file-button' />"
    $(textButton).insertBefore("#promotion_banner");
    $("#promotion_banner").change(function(){
	$("#textfield1").val($("#promotion_banner").val());
    });
	gcategoryInit("recommend_gcategory");
});
</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/promotion.js"></script> 