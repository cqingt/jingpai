<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
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
  <form id="add_form" method="post" action="index.php?act=miaosha&op=class_save">
    <input name="class_id" type="hidden" value="<?php echo $output['class_info']['class_id'];?>" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="input_class_name" class="validation"><?php echo $lang['miaosha_class_name'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo $output['class_info']['class_name'];?>" name="input_class_name" id="input_class_name" class="txt"></td>
          <td class="vatop tips"><?php echo $lang['miaosha_class_list'];?></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="start_hour"><?php echo $lang['miaosha_start_time'];?>:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select name="start_hour" id="start_hour">
                    <?php foreach($output['hour'] as $val){ ?>
                        <option <?php if($output['class_info']['start_hour'] == $val){ ?>selected='selected'<?php } ?> value="<?php echo $val;?>"><?php echo $val;?></option>
                    <?php } ?>
                </select></td>
            <td class="vatop tips"><?php echo $lang['miaosha_start_time_tip'];?></td>
        </tr>
        <tr>
            <td colspan="2" class="required"><label for="end_hour"><?php echo $lang['miaosha_end_time'];?>:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select name="end_hour" id="end_hour">
                    <?php foreach($output['hour'] as $val){ ?>
                        <option <?php if($output['class_info']['end_hour'] == $val){ ?>selected='selected'<?php } ?> value="<?php echo $val;?>"><?php echo $val;?></option>
                    <?php } ?>
                </select></td>
            <td class="vatop tips"><?php echo $lang['miaosha_end_time_tip'];?></td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label><?php echo $lang['nc_sort'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="<?php echo empty($output['class_info'])?'0':$output['class_info']['sort'];?>" name="input_sort" id="input_sort" class="txt"></td>
          <td class="vatop tips"><?php echo $lang['addhuodong_sort_tip'];?></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a id="submit" href="JavaScript:void(0);" class="btn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#submit").click(function(){
        $("#add_form").submit();
    });
    jQuery.validator.methods.maxhour= function(value, element) {
        var start_hour = $("#start_hour").val();
        return Number(value) > Number(start_hour);
    };
	$('#add_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            input_class_name : {
                required : true
            },
            input_sort : {
                number   : true
            },
            end_hour:{
                maxhour : true
            }
        },
        messages : {
            input_class_name: {
                required : '<?php echo $lang['class_name_error'];?>'
            },
            input_sort: {
                number   : '<?php echo $lang['sort_error'];?>'
            },
            end_hour:{
                maxhour   : '<?php echo $lang['maxhour_error'];?>'
            }
        }
    });
});
</script>
