<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>经验值管理</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=exppoints&op=index"><span>经验值明细</span></a></li>
        <li><a href="index.php?act=exppoints&op=expsetting"><span>规则设置</span></a></li>
		<li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="points_form" method="post" name="form1">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">会员名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="member_name" id="member_name" class="txt" onchange="javascript:checkmember();">
            <input type="hidden" name="member_id" id="member_id" value='0'/></td>
          <td class="vatop tips"><?php echo $lang['member_index_name']?></td>
        </tr>
        <tr id="tr_memberinfo">
          <td colspan="2" style="font-weight:bold;" id="td_memberinfo"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>增减类型:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><select id="operatetype" name="operatetype">
              <option value="1">增加</option>
              <option value="2">减少</option>
            </select></td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation">经验值:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="exppointsnum" name="exppointsnum" class="txt"></td>
          <td class="vatop tips"><?php echo $lang['member_index_email']?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label>描述:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><textarea name="exppointsdesc" rows="6" class="tarea"></textarea></td>
          <td class="vatop tips"><?php echo $lang['admin_points_pointsdesc_notice'];?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="JavaScript:void(0);" class="btn" onclick="document.form1.submit()"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
function checkmember(){
	var membername = $.trim($("#member_name").val());
	if(membername == ''){
		$("#member_id").val('0');
		alert("请输入会员名称");
		return false;
	}
	$.getJSON("index.php?act=exppoints&op=checkmember", {'name':membername}, function(data){
	        if (data)
	        {
		        $("#tr_memberinfo").show();
				var msg= "会员 "+ data.name + "当前经验值" + data.exppoints;
				$("#member_name").val(data.name);
				$("#member_id").val(data.id);
		        $("#td_memberinfo").text(msg);
	        }
	        else
	        {
	        	$("#member_name").val('');
	        	$("#member_id").val('0');
		        alert("会员不存在");
	        }
	});
}
$(function(){
	$("#tr_memberinfo").hide();
	
    $('#points_form').validate({
//        errorPlacement: function(error, element){
//            $(element).next('.field_notice').hide();
//            $(element).after(error);
//        },
        rules : {
        	member_name: {
				required : true
			},
			member_id: {
				required : true
            },
            pointsnum   : {
                required : true,
                min : 1
            }
        },
        messages : {
			member_name: {
				required : '请输入会员名'
			},
			member_id : {
				required : '请输入会员名'
            },
            pointsnum  : {
                required : '请填写经验值',
                min : '经验值必须大于0'
            }
        }
    });
});
</script>