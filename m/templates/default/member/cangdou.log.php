<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/has.css" />
<ul class="voucher-tab">
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'index'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','index');?>">邀请好友</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_log'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_log');?>">藏豆明细</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_exchange'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_exchange');?>">藏豆兑换</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_tuijian'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_tuijian');?>">优惠购买</a> </li>
</ul>

 <section>
		<div class="detail">
		
		<?php  if (count($output['list'])>0) { ?>
		   <dl>
			<?php foreach($output['list'] as $val) { ?>
			 <dd>
				<h2><?php echo @date('Y-m-d',$val['C_Time']);?>
				<p><?php echo $val['C_Remark'];?></p></h2>
				<strong><?php echo ($val['C_CangDou'] > 0 ? '收入' : '').str_replace('-','支出',$val['C_CangDou']); ?>藏豆</strong>
			 </dd>

		<?php } ?>
		   </dl>
      <?php } else { ?>
		<dl>
			 <dd>
				<h2><strong></strong><?php echo $lang['no_record']; ?></h2>
				<strong></strong>
			 </dd>
		</dl>
	  <?php } ?>
		</div>
	  </section>
