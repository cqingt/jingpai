<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <form method="post" name="ChuLiform1" id="ChuLiform1" action="<?php echo urlAdmin('yijia', 'ChuLiYiJia');?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" value="<?php echo $output["id"];?>" name="id">
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="close_reason">输入处理意见:</label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><textarea rows="6" class="tarea" cols="60" name="state_contents" id="state_contents"></textarea></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="javascript:void(0);" class="btn" nctype="btn_submit"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script>
var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
$(function(){
    $('a[nctype="btn_submit"]').click(function(){
		var state_contents = $('#state_contents').val();
		if(state_contents == ''){
			alert('请输入处理意见');
		}else{
			ajaxpost('ChuLiform1', '', '', 'onerror');
		}
    });
});

</script>