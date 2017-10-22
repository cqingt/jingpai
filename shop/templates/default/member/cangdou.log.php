<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>

  <form method="get" action="index.php">
    <table class="ncm-search-table">
      <input type="hidden" name="act" value="cangdou" />
        <input type="hidden" name="op" value="cangdou_log" />
      <tr><td>&nbsp;</td>
        <td class="w300">添加时间：<input type="text" id="stime" name="stime" class="text w70" value="<?php echo $_GET['stime'];?>"><label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;<input type="text" id="etime" name="etime" class="text w70" value="<?php echo $_GET['etime'];?>"><label class="add-on"><i class="icon-calendar"></i></label></td>

        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w200">日期</th>
        <th class="w150">收入/支出</th>
        <!-- <th class="w300">类型</th> -->
        <th class="tl">描述</th>
      </tr>
    </thead>
    <tbody>
      <?php  if (count($output['list'])>0) { ?>
      <?php foreach($output['list'] as $val) { ?>
      <tr class="bd-line">
        <td class="goods-time"><?php echo @date('Y-m-d H:i',$val['C_Time']);?></td>
        <td class="goods-price"><?php echo ($val['C_CangDou'] > 0 ? '+' : '').$val['C_CangDou']; ?></td>
        <!-- <td><?php 
	              	switch ($val['C_DouType']){
	              		case 'douone':
	              			echo '下级会员注册';
	              			break;
	              		case 'doutwo':
	              			echo '二级下级会员注册';
	              			break;
	              		case 'orderone':
	              			echo '下级会员订单完成';
	              			break;
	              		case 'ordertwo':
	              			echo '二级下级会员订单完成';
	              			break;
                        case 'duihuan':
                            echo '藏豆兑换礼品';
                            break;
	              	}
	              ?></td> -->
        <td class="tl">

  <?php 
                  switch ($val['C_Remark']){
                    case '一级分销':
                      echo '邀请好友奖励';
                      break;
                    case '二级分销':
                      echo '邀请好友奖励';
                      break;
                    case '订单完成一级分销':
                      echo '好友购物奖励';
                      break;
                    case '订单完成二级分销':
                      echo '好友购物奖励';
                      break;
                    default:
                      echo $val['C_Remark'];
                    break;
                  }
                ?>

        </td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record']; ?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php  if (count($output['list'])>0) { ?>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script> 
<script language="javascript">
$(function(){
	$('#stime').datepicker({dateFormat: 'yy-mm-dd'});
	$('#etime').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>