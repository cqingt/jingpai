<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <!-- 页面导航 -->
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['miaosha_index_manage'];?></h3>
      <ul class="tab-base">
        <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php  } }  ?>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="<?php echo urlAdmin('miaosha', 'miaosha_setting_save');?>">
    <input type="hidden" id="submit_type" name="submit_type" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">秒杀价格:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="text" id="miaosha_price" name="miaosha_price" value="<?php echo $output['setting']['miaosha_price'];?>" class="txt">
            </td>
            <td class="vatop tips">秒杀套餐价格，单位为元，购买周期为月(30天)</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">秒杀审核期:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="text" id="miaosha_review_day" name="miaosha_review_day" value="<?php echo $output['setting']['miaosha_review_day'];?>" class="txt">
            </td>
            <td class="vatop tips">秒杀审核期(天)，平台预留的审核天数，卖家只能发布审核期天数以后的秒杀活动</td>
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
$(document).ready(function(){
    $("#submitBtn").click(function(){
        $("#add_form").submit();
    });
    //页面输入内容验证
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },

        rules : {
        	miaosha_price: {
                required : true,
                digits : true,
                min : 0
            }
        },
        messages : {
      		miaosha_price: {
       			required : '必填',
       			digits : '数字',
                min : '最小'
            }
        }
	});
});
//submit函数
function submit_form(submit_type){
	$('#submit_type').val(submit_type);
	$('#add_form').submit();
}
</script>
