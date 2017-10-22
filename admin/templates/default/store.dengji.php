<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>入驻登记</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>入驻登记</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch" id="formSearch">
    <input type="hidden" value="store_dengji" name="act">
    <input type="hidden" value="index" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <td>手机号：<input type="text" value="<?php echo $output['mobile'];?>" name="mobile" class="txt"></td>

          <td>开始时间：<input style="width:100px;" type="text" value="<?php echo $output['search_begin_time'];?>" name="search_begin_time" id="search_begin_time" class="txt">结束时间：<input style="width:100px;" type="text" value="<?php echo $output['search_end_time'];?>" name="search_end_time" id="search_end_time" class="txt"></td>


          <td><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
           </td>
        </tr>
      </tbody>
    </table>
  </form>

    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
            <th class="align-center">登记时间</th>
            <th class="align-center">姓名</th>
            <th class="align-center">手机号</th>
        </tr>
      <tbody>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $k => $v){ ?>
        <tr class="hover member">
            <td class="align-center"><?php echo date('Y-m-d H:i',$v['addtime']); ?></td>
            <td class="align-center"><?php echo $v['name']; ?></td>
            <td class="align-center"><?php echo $v['mobile']; ?></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="11"><?php echo $lang['nc_no_record']?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot class="tfoot">
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <tr>
          <td colspan="3">
           <div class="pagination"><?php echo $output['page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
</div>
<script>
$(function(){
    $('#ncsubmit').click(function(){
    	$('#formSearch').submit();
    });	
});
</script>


<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />

<script>
$(function(){
     $('#search_begin_time').datetimepicker({
        controlType: 'select'
    });
      $('#search_end_time').datetimepicker({
        controlType: 'select'
    });
      });
</script>
