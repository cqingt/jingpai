<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include template('layout/submenu');?>

  <?php if($output['storeOneInfo']['store_is_appkey'] < 11){?>


  <a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" onclick="go('index.php?act=store_api&op=api_add');" title="API申请">API申请</a> </div>

    <?php }?>


<table class="ncsc-default-table">
  <thead>
    <tr>
      <th class="w100">AppId</th>
      <th class="w200">AppKey</th>
      <th class="w100">申请时间</th>
    </tr>
  </thead>


  <tbody>
    <?php if(!empty($output['storeAppKeyInfo']) && is_array($output['storeAppKeyInfo'])){?>

    <tr class="bd-line">
      <td ><?php echo $output['storeAppKeyInfo']['K_AppId'];?></td>
      <td><?php echo $output['storeAppKeyInfo']['K_Key'];?></td>
      <td><?php echo date('Y-m-d H:i:s',$output['storeAppKeyInfo']['K_Time']);?></td>
    </tr>

    <?php }elseif($output['storeOneInfo']['store_is_appkey'] == 11){?>
    
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span>申请审核中</span></div></td>
    </tr>


    <?php }else{?>

    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>

    <?php }?>
  </tbody>


  <tfoot>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
  </tfoot>


</table>

