<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<div align="center" style="margin: 100px 0">
	<?php if($output['p_id'] == 1){?>
    	<button id="pay" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="payAli()" >立即支付</button>
    <?php }elseif($output['p_id'] == 2){?>
        <button id="pay" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="payWeixin()" >立即支付</button>
    <?php }?>
</div>


<script>

	function getAppPayParam(state){
		if(state === 1){
			var subject = "<?php echo $output['app_pay_param']['subject'];?>";
			var body = "<?php echo $output['app_pay_param']['body'];?>";
			var out_trade_no = "<?php echo $output['app_pay_param']['out_trade_no'];?>";
			var total_amount = "<?php echo $output['app_pay_param']['total_amount'];?>";
			var notify_url = "<?php echo $output['app_pay_param']['notify_url'];?>";
			var call_back_url = "<?php echo $output['app_pay_param']['call_back_url'];?>";
			var sign = "<?php echo $output['app_pay_param']['sign'];?>";

			var param = {"notify_url":notify_url,"body":body,"subject":subject,"out_trade_no":out_trade_no,"total_amount":total_amount,"sign":sign,"call_back_url":call_back_url};

			return param;
		}

		if(state === 2){
			var nonce_str = "<?php echo $output['app_pay_param']['nonce_str'];?>";
			var body = "<?php echo $output['app_pay_param']['body'];?>";
			var out_trade_no = "<?php echo $output['app_pay_param']['out_trade_no'];?>";
			var total_fee = "<?php echo $output['app_pay_param']['total_fee'];?>";
			var notify_url = "<?php echo $output['app_pay_param']['notify_url'];?>";
			var param = {"nonce_str":nonce_str,"body":body,"out_trade_no":out_trade_no,"total_fee":total_fee,"notify_url":notify_url};

			return param;
		}
		return;
	}
</script>