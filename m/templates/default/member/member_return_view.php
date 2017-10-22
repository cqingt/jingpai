<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<!--2016/7/19-->
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />


<section class="ui-main-con">		 

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退货退款服务提示</div>
	<div class="ui-txt-muted mt">
		<div class="worldjs">1. 若提出申请后，商家拒绝退款或退货，可再次提交申请或选择<em>“商品投诉”</em>，请求商城客服人员介入。<br />2. 成功完成退款/退货；经过商城审核后，会将退款金额以<em>“预存款”</em>的形式返还到您的余额账户中（充值卡部分只能退回到充值卡余额）。</div>
	</div>
</div> 	

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退货退款编号：<?php echo $output['return']['refund_sn']; ?></div>
	<p class="ui-txt-muted mt">申请退款服务类型：<?php if($output['return']['refund_type'] == 1){echo '不退货仅退款';}else{echo '退货退款';} ?> </p>
</div>

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退货退款原因：<?php echo $output['return']['reason_info']; ?></div>
	<p class="ui-txt-muted mt">退款金额：¥<?php echo $output['return']['refund_amount']; ?> </p>
</div> 

<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">退货数量：<?php echo $output['return']['return_type']==2 ? $output['return']['goods_num']:'无'; ?></div>
	<p class="ui-txt-muted mt">退货退款说明：<?php echo $output['return']['buyer_message']; ?> </p>
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

<?php if($output['return']['seller_state'] == 2 && $output['return']['return_type'] == 2 && $output['return']['goods_state'] == 1 && $output['ship'] == 1) { ?>
		
<form id="post_form" method="post" action="index.php?act=member_refund&op=ship&return_id=<?php echo $output['return']['refund_id']; ?>" onsubmit="return tijiao();">
  <input type="hidden" name="form_submit" value="ok" />
  <h3>请填写退货发货信息</h3>
  <dl>
    <dt><?php echo '物流公司'.$lang['nc_colon'];?></dt>
    <dd>
      <select name="express_id" id="express_id">
        <option value="0">-请选择-</option>
        <?php if(!empty($output['express_list']) && is_array($output['express_list'])){?>
        <?php foreach($output['express_list'] as $key=> $val){?>
        <option value="<?php echo $val['id']; ?>"><?php echo $val['e_name']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </dd>
  </dl>
  <dl>
    <dt><i class="required">*</i><?php echo '物流单号'.$lang['nc_colon'];?></dt>
    <dd>
      <input type="text" class="text w150" id="invoice_no" name="invoice_no" value="" />
      <p class="hint"><!--发货 <?php echo $output['return_delay'];?> 天后，当商家选择未收到则要进行延迟时间操作；
        如果超过 <?php echo $output['return_confirm'];?> 天不处理按弃货处理，直接由管理员确认退款。
		
		请正确填写退货发货信息，<?php echo $output['return_confirm'];?> 天内未提交退货发货信息将视为放弃退货申请，系统将自动关闭退货申请。</p>-->
    </dd>
  </dl>
  <div class="bottom">
    <label class="submit-border">
      <input type="submit" class="submit" id="confirm_button" value="提交" />
    </label>
      <a href="javascript:history.go(-1);" class="ncm-btn ml10"><i class="icon-reply"></i>返回列表</a>
  </div>
</form>
<script type="text/javascript">
function tijiao(){
		var invoice_no = document.getElementById('invoice_no').value;
		var express_id = document.getElementById('express_id').value;
		if(express_id == 0){
			alert('请选择快递公司！');
			return false;
		}
		if(invoice_no == ''){
			alert('请填写发货单号！');
			return false;
		}
		return true;
	}
</script>
	<?php }?>



<div class="demo-item mb clearfix">
	<div class="demo-title ul-border-b">审核进度</div>
	<ul class="plan-list">
	
	<li>
		<p>商家退货退款处理：<?php echo $output['state_array'][$output['return']['seller_state']]; ?></p>
	</li>
	<?php if ($output['return']['seller_time'] > 0) { ?>
		<li>
			<p><?php echo @date('Y-m-d',$output['return']['seller_time']);?><time><?php echo @date('H:i:s',$output['return']['seller_time']);?></time></p>
			<p><?php echo $output['return']['seller_message']; ?></p>
			<p>经办：<?php echo $output['return']['store_name']; ?></p>
		</li>
	<?php } ?>

	
	<?php if ($output['return']['express_id'] > 0 && !empty($output['return']['invoice_no'])) { ?>
		<li>
			<p><?php echo @date('Y-m-d',$output['return']['ship_time']);?><time><?php echo @date('H:i:s',$output['return']['ship_time']);?></time></p>
			<p>物流信息：<?php echo $output['return_e_name'].' , '.$output['return']['invoice_no']; ?></p>
			<p><?php echo $output['return']['buyer_name']; ?></p>
		</li>
	<?php } ?>


	<?php if ($output['return']['seller_state'] == 2) { ?>
		<li>
			<p>平台确认：<?php echo $output['admin_array'][$output['return']['refund_state']]; ?> </p>
		</li>
	<?php } ?>
	<?php if ($output['return']['admin_time'] > 0) { ?>
		<li>
			<p><?php echo @date('Y-m-d',$output['return']['admin_time']);?><time><?php echo @date('H:i:s',$output['return']['admin_time']);?></time></p>
			<p><?php echo $output['return']['admin_message']; ?></p>
			<p>系统</p>
		</li>	
	<?php } ?>
	</ul>
</div> 

</section>



