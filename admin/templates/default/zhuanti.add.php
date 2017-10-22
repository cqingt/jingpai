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
      <h3>专题管理</h3>
       <ul class="tab-base">
        <li><a href="<?php echo urlAdmin('zhuantiad', 'index');?>"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="<?php echo urlAdmin('zhuantiad', 'add');?>" class="current"><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
	<input type="hidden" id="d_id" name="d_id" value="<?php echo $output['d_id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2"><label class="validation" for="zhuanti_title">标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="zhuanti_title" name="zhuanti_title" class="txt" value="<?php echo $output['zhuantiInfo']['zhuanti_title'];?>"></td>
          <td class="vatop tips"></td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label class="validation"  for="zhuanti_mulu">目录:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="zhuanti_mulu" name="zhuanti_mulu" class="txt" value="<?php echo $output['zhuantiInfo']['zhuanti_mulu'];?>"></td>
          <td class="vatop tips">例如20161111</td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label class="validation" >开始时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="start_date" name="start_date" class="txt date" value="<?php echo $output['zhuantiInfo']['start_date'];?>" /></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" >结束时间:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="end_date" name="end_date" class="txt date" value="<?php echo $output['zhuantiInfo']['end_date'];?>"/></td>
          <td class="vatop tips"></td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label for="zhuanti_link">连接:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="zhuanti_link" name="zhuanti_link" class="txt" value="<?php echo $output['zhuantiInfo']['zhuanti_link'];?>"></td>
          <td class="vatop tips">提示请以http://开头</td>
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
	$("#start_date").datepicker({dateFormat: 'yy-mm-dd'});
	$("#end_date").datepicker({dateFormat: 'yy-mm-dd'});
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
        	zhuanti_title: {
        		required : true
        	},
			zhuanti_mulu: {
        		required : true
        	},
        	start_date: {
        		required : true,
				date      : false
        	},
        	end_date: {
        		required : true,
				date      : false
        	},
        	zhuanti_link: {
        		required : true,
        	}
        },
        messages : {
        	zhuanti_title: {
        		required : '标题不能为空'
        	},
			zhuanti_mulu: {
        		required : '目录不能为空'
        	},
        	start_date: {
        		required : '请选择开始时间'
        	},
        	end_date: {
        		required : '请选择结束时间'
        	},
        	zhuanti_link: {
				required : '请填写专题连接'
        	}
        }
	});
});

</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/promotion.js"></script> 

