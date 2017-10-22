<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>报名记录</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>报名记录</span></a></li>
        <li><a href="index.php?act=lepai&op=ChuJiaLog&goodsid=<?php echo $output['result']['G_Id'];?>" ><span>出价记录</span></a></li>
      </ul>
    </div>
  </div>




  <div class="fixed-empty"></div>
  <!--
  <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="ChuJiaLog">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <th><label for="search_store_name">用户名称</label></th>
        <td><input type="text" value="" name="search" id="search" class="txt"></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>
  -->





    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">会员名</th>
		  <th class="align-center">报名产品</th>
          <th class="align-center">保证金类型</th>
          <th class="align-center">保证金金额</th>
          <th class="align-center">保证金状态</th>
          <th class="align-center">报名时间</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['baoming_info']) && is_array($output['baoming_info'])) { ?>

        <?php foreach ($output['baoming_info'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['id'];?></td>
          <td class="align-center"><?php echo $v['member_name'];?></td>
		  <td class="align-center"><?php echo $output['result']['G_Name'];?></td>
          <td class="align-center"><?php if($v['type'] == 1){echo '现金';}else{echo "收藏币";}?></td>
          <td class="align-center"><?php echo $v['amount'];?></td>
          <td class="align-center"><?php if($v['is_return'] == 0){echo '未返还';}elseif($v['is_return'] == 1){echo "已返还";}else{ echo "已扣除";}?></td>
          <td class="align-center"><?php echo date("Y-m-d H:i:s",$v['bind_time']);?></td>
          
          </td>
        </tr>
        <tr style="display:none;">
          <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
	   <tfoot>
      <tr class="tfoot">
	  <td>&nbsp;</td>
        <td><a href="index.php?act=lepai&op=goods" class="btn"><span>返回</span></a></td>
      </tr>

    </tfoot>
    </table>
<tfoot>
        <tr class="tfoot">
          
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
  
</div>

