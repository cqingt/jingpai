<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>出价记录</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=lepai&op=BaoMingLog&goodsid=<?php echo $output['result']['G_Id'];?>" ><span>报名记录</span></a></li>
        <li><a  href="JavaScript:void(0);" class="current"><span>出价记录</span></a></li>
      </ul>
    </div>
  </div>




  <div class="fixed-empty"></div>
  

    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">会员名</th>
		  <th class="align-center">报名产品</th>
          <th class="align-center">出价金额</th>
          <th class="align-center">是否委托</th>
          <th class="align-center">出价时间</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['chujialog']) && is_array($output['chujialog'])) { ?>

        <?php foreach ($output['chujialog'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php echo $v['id'];?></td>
          <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php echo $v['member_name'];?></td>
		  <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php echo $output['result']['G_Name'];?></td>
		  <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php echo $v['price'];?></td>
          <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php if($v['weituo'] == 1){echo '是';}else{echo "否";}?></td>

          <td class="align-center" <?php if($k==0){ ?>style="color: red;"<?php }?>><?php echo date("Y-m-d H:i:s",$v['add_time']);?></td>
          
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

