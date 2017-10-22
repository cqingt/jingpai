<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />	

<section class="ui-main-con">
	 <form id="post_form1" enctype="multipart/form-data" method="post" action="index.php?act=member_refund&op=add_refund_all&order_id=<?php echo $output['order']['order_id']; ?>&goods_id=<?php echo $output['goods']['rec_id']; ?>">
          <input type="hidden" name="form_submit" value="ok" />
	<div class="demo-item mb clearfix">
		<div class="demo-title nomb">服务类型</div>
		<div class="ui-txt-muted btn-select">
			<a class="active"><i>退款</i></a>
		</div>
		<p class="rmb"><strong class="color5">*退款金额￥<?php echo ncPriceFormat($output['order']['order_amount']); ?></strong></p>
	</div> 	
	
	<div class="demo-item mb clearfix">
		<div class="demo-title nomb">温馨提示：</div>
		<div class="ui-txt-muted btn-select">
        <p>1. 若您对订单进行支付后想取消购买且与商家达成一致退款，请填写<em>“订单退款”</em>内容并提交。</p>
        <p>2. 成功完成退款/退货；经过商城审核后，会将退款金额以<em>“预存款”</em>的形式返还到您的余额账户中（充值卡部分只能退回到充值卡余额）。</p>
		</div>

		
	</div> 
	
	
	<div class="demo-item mb clearfix">
		<div class="demo-title nomb">问题描述</div>
		<div class="ui-txt-muted ncs-figure-textarea">
			 <textarea name="buyer_message" id="buyer_message" rows="" cols="" placeholder="请您在此描述详细问题"></textarea>
		</div>
	</div> 				  	
	
	<div class="demo-item mb clearfix">
		<div class="demo-title nomb">上传凭证：</div>
		<div class="ui-txt-muted">
			 <p>
                <input name="refund_pic1" type="file" />
				</p>
              <p>
                <input name="refund_pic2" type="file" />
				</p>
              <p>
                <input name="refund_pic3" type="file" />
			</p> 
		</div>

	</div> 		
	<div class="demo-block tc">
		<input class="btn-submit" type="submit" value="确认提交"  onclick="return tijiao_return();"/>
		 <a href="javascript:history.go(-1);" class="ncm-btn ml10">取消并返回</a>
	</div>
	</form>
  </section>

<script type="text/javascript">
function tijiao_return(){
		var buyer_message = $('#buyer_message').val();
		if(buyer_message == ''){
			alert("请填写退款说明");
			return false;
		}
}
</script>