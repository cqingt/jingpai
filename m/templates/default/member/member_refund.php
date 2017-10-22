<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<!--2016/7/19-->
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />
<?php if (is_array($output['refund_list']) && !empty($output['refund_list'])) { ?>
<section class="ui-main-con">
      <?php foreach ($output['refund_list'] as $key => $val) { ?>
		  	<div class="demo-item mb clearfix">
		  		<div class="demo-title ul-border-b">服务单号：<?php echo $val['refund_sn']; ?>
				 <?php if ($val['refund_type'] == 1) { ?>
				<a class="btn-jindu r" href="index.php?act=member_refund&op=view&refund_id=<?php echo $val['refund_id']; ?>">进度查询</a>
				<?php } ?>
				<?php if ($val['refund_type'] == 2) { ?>
				<a class="btn-jindu r" href="index.php?act=member_refund&op=return_view&return_id=<?php echo $val['refund_id']; ?>">进度查询</a>
				<?php } ?>
				</div>
		  		<div class="ui-txt-muted mt">

				  <?php if ($val['goods_id'] > 0) { ?>
					<p class="ui-txt-muted color0"><a href="index.php?act=goods&op=index&goods_id=<?php echo $val['goods_id'];?>" style="color: #333;"><?php echo $val['goods_name']; ?></a><br /><a href="index.php?act=member_order&op=show_order&order_id=<?php echo $val['order_id']; ?>" style="color: #333;"><?php echo $val['order_sn'];?></a></p>
				<?php } else { ?>
		  			<p class="ui-txt-muted color0"><?php echo $val['goods_name']; ?><?php echo $lang['refund_order_ordersn'].$lang['nc_colon'];?><br /><a href="index.php?act=member_order&op=show_order&order_id=<?php echo $val['order_id']; ?>" style="color: #333;"><?php echo $val['order_sn'];?></a></p>
				<?php } ?>


		  			<p>状态：<strong class="color5"><?php echo $output['state_array'][$val['seller_state']]; ?></strong></p>
		  			<p>申请时间：<?php echo @date("Y-m-d",$val['add_time']);?><time><?php echo @date("H:i:s",$val['add_time']);?></time></p>
		  		</div>
		  	</div>
	<?php } ?>
</section>
	<?php } else { ?>
	<div class="mb clearfix" style="text-align: center;padding-top: 50px;padding-bottom: 50px;">
		<span>暂无符合条件的数据记录</span>
		</div>
	<?php } ?>
	
		  
