<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<!--2016/7/19-->
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />


<section class="ui-main-con">		 

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退款服务提示</div>
	<div class="ui-txt-muted mt">
		<div class="worldjs">1. 若提出申请后，商家拒绝退款或退货，可再次提交申请或选择<em>“商品投诉”</em>，请求商城客服人员介入。<br />2. 成功完成退款/退货；经过商城审核后，会将退款金额以<em>“预存款”</em>的形式返还到您的余额账户中（充值卡部分只能退回到充值卡余额）。</div>
	</div>
</div> 	

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退款单号：<?php echo $output['refund']['refund_sn']; ?></div>
	<p class="ui-txt-muted mt">退款原因：<?php echo $output['refund']['reason_info']; ?> </p>
</div>

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退款金额：¥<?php echo $output['refund']['refund_amount']; ?></div>
	<p class="ui-txt-muted mt">退款说明：<?php echo $output['refund']['buyer_message']; ?> </p>
</div> 

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">上传凭证</div>
	<div class="ui-txt-muted mt">
		<div class="worldjs">
			<?php if (is_array($output['pic_list']) && !empty($output['pic_list'])) { ?>
              <?php foreach ($output['pic_list'] as $key => $val) { ?>
              <?php if(!empty($val)){ ?>
				<img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_PATH.'/refund/'.$val;?>" style="max-height:60px;max-width: 60px;">
              <?php } ?>
              <?php } ?>
           <?php } ?>
		</div>
	</div>
</div> 	
	  	



<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">审核进度</div>
	<ul class="plan-list">
	
	<li>
		<p>商家退款处理：<?php echo $output['state_array'][$output['refund']['seller_state']]; ?></p>
	</li>
	<?php if ($output['refund']['seller_time'] > 0) { ?>
		<li>
			<p><?php echo @date('Y-m-d',$output['refund']['seller_time']);?><time><?php echo @date('H:i:s',$output['refund']['seller_time']);?></time></p>
			<p><?php echo $output['refund']['seller_message']; ?></p>
			<p>经办：<?php echo $output['refund']['store_name']; ?></p>
		</li>
	<?php } ?>
	<?php if ($output['refund']['seller_state'] == 2) { ?>
		<li>
			<p>平台确认：<?php echo $output['admin_array'][$output['refund']['refund_state']]; ?></p>
		</li>
	<?php } ?>
	<?php if ($output['refund']['admin_time'] > 0) { ?>
		<li>
			<p><?php echo @date('Y-m-d',$output['refund']['admin_time']);?><time><?php echo @date('H:i:s',$output['refund']['admin_time']);?></time></p>
			<p><?php echo $output['refund']['admin_message']; ?></p>
			<p>系统</p>
		</li>	
	<?php } ?>
	</ul>
</div> 

</section>
		  

