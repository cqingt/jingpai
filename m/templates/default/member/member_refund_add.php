<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />	
<section class="ui-main-con">		 
		  	<!--
		  	<div class="demo-item mb clearfix">
				<div class="demo-block">
				    <ul class="ui-list ui-list-link no-list">				    	
				        <li class="ul-border-b">
				            <div class="ui-list-img">
				                <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/1.jpg"/>
				            </div>
				            <div class="ui-list-info">
				                <h4 class="ui-nowrap-multi">北京朝阳区左安路1号十里河文化园A座三层收藏天下某某部门</h4>
				                <p class="demo-price-drift">¥60090.00</p>
				                <p class="demo-number">x1</p>
				            </div>
				        </li>					    		        
				    </ul>
				</div>			  		
		  	</div>	
			-->
			

		  	<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">服务类型</div>
		  		<div class="ui-txt-muted btn-select">
		  			<a class="active" data-option="2" href="javascript:;"><i>退货退款</i></a>
		  			<a href="javascript:;" data-option="1"><i>仅退款</i></a>
		  		</div>
		  	</div>
			<div id="saleRefund" show_id="1" style="display: none;">
			<form id="post_form1" enctype="multipart/form-data" method="post" action="index.php?act=member_refund&op=add_refund&order_id=<?php echo $output['order']['order_id']; ?>&goods_id=<?php echo $output['goods']['rec_id']; ?>">
			<input type="hidden" name="form_submit" value="ok" />
			<input type="hidden" name="refund_type" value="1" />
				<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">退款原因</div>
		  		<div class="ui-txt-muted btn-select">
						<select class="select w150" name="reason_id">
							<option value="">请选择退款原因</option>
							<?php if (is_array($output['reason_list']) && !empty($output['reason_list'])) { ?>
							<?php foreach ($output['reason_list'] as $key => $val) { ?>
							<option value="<?php echo $val['reason_id'];?>"><?php echo $val['reason_info'];?></option>
							<?php } ?>
							<?php } ?>
							<option value="0">其他</option>
						  </select>
					</div>
				</div>

				<div class="demo-item mb clearfix">
					<div class="demo-title nomb">需要退款金额</div>
					<div class="ui-txt-muted ncs-figure-input">
						<i><input type="text" name="refund_amount" value="<?php echo $output['goods']['goods_pay_price']; ?>" id="refund_amount" style="width: 65px;"/></i>元
					</div>
					<p class="ncs-figure-hint" title="可退金额由系统根据订单商品实际成交额和已退款金额自动计算得出">您最多可退<?php echo $output['goods']['goods_pay_price']; ?>元</p>
				</div> 		
				
	
				
				<div class="demo-item mb clearfix">
					<div class="demo-title nomb">退款说明</div>
					<div class="ui-txt-muted ncs-figure-textarea">
						 <textarea name="buyer_message" rows="" cols="" placeholder="请您在此描述详细问题"></textarea>
					</div>
				</div> 				  	
				
				<div class="demo-item mb clearfix">
					<div class="demo-title nomb">上传凭证</div>
					<div class="ui-txt-muted">
						 <p>
							<input name="refund_pic1" type="file" />
							<span class="error"></span> 
							</p>
						  <p>
							<input name="refund_pic2" type="file" />
							<span class="error"></span> 
							</p>
						  <p>
							<input name="refund_pic3" type="file" />
							<span class="error"></span> 
							</p>	   
					</div>

				</div> 		
				<div class="demo-block tc">
					<input class="btn-submit" type="submit" value="提交" />
				</div>
			</form>
			</div>
		  	
			<div id="saleRefundReturn" show_id="2">
		   <form id="post_form2" method="post" enctype="multipart/form-data" action="index.php?act=member_refund&op=add_refund&order_id=<?php echo $output['order']['order_id']; ?>&goods_id=<?php echo $output['goods']['rec_id']; ?>">
          <input type="hidden" name="form_submit" value="ok" />
          <input type="hidden" name="refund_type" value="2" />
			<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">退货退款原因</div>
		  		<div class="ui-txt-muted btn-select">
		  			<select class="select w150" name="reason_id">
						<option value="">请选择退货退款原因</option>
						<?php if (is_array($output['reason_list']) && !empty($output['reason_list'])) { ?>
						<?php foreach ($output['reason_list'] as $key => $val) { ?>
						<option value="<?php echo $val['reason_id'];?>"><?php echo $val['reason_info'];?></option>
						<?php } ?>
						<?php } ?>
						<option value="0">其他</option>
					  </select>
		  		</div>
		  	</div>

		  	<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">退款金额</div>
		  		<div class="ui-txt-muted ncs-figure-input">
		  			<i><input type="text" name="refund_amount" value="<?php echo $output['goods']['goods_pay_price']; ?>" id="refund_amount" style="width: 65px;"/></i>元
		  		</div>
		  		<p class="ncs-figure-hint" title="可退金额由系统根据订单商品实际成交额和已退款金额自动计算得出。">您最多可退<?php echo $output['goods']['goods_pay_price']; ?>元</p>
		  	</div> 		
			
			<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">退货数量</div>
		  		<div class="ui-txt-muted ncs-figure-input">
		  			<i><input type="text" name="goods_num" value="<?php echo $output['goods']['goods_num']; ?>"/></i>
		  		</div>
		  	</div> 
		  	
		  	<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">问题描述</div>
		  		<div class="ui-txt-muted ncs-figure-textarea">
		  			 <textarea name="buyer_message" rows="" cols="" placeholder="请您在此描述详细问题"></textarea>
		  		</div>
		  	</div> 				  	
		  	
		  	<div class="demo-item mb clearfix">
		  		<div class="demo-title nomb">上传凭证</div>
		  		<div class="ui-txt-muted">
					 <p>
						<input name="refund_pic1" type="file" />
						<span class="error"></span> 
						</p>
					  <p>
						<input name="refund_pic2" type="file" />
						<span class="error"></span> 
						</p>
					  <p>
						<input name="refund_pic3" type="file" />
						<span class="error"></span> 
						</p>	   
		  		</div>

		  	</div> 		
		  	<div class="demo-block tc">
		  		<input class="btn-submit" type="submit" value="提交" />
		  	</div>
			</form>
			</div>
			<span class="error"></span>
<div class="error-tips"></div>
</section>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>

<script>

$(document).ready(function(){
	 $('#post_form2').validate({
		errorPlacement: function(error, element){
			error.appendTo($(".error-tips").show());
        },
        rules : {
            reason_id : {
                required   : true
            },
            refund_amount : {
                required   : true,
                number   : true,
                min:0.01,
                max:<?php echo $output['goods']['goods_pay_price']; ?>
            },
            goods_num : {
                required   : true,
                digits   : true,
                min:1,
                max:<?php echo $output['goods']['goods_num']; ?>
            },
            buyer_message : {
                required   : true
            },
            refund_pic1 : {
                accept : 'jpg|jpeg|gif|png'
            },
            refund_pic2 : {
                accept : 'jpg|jpeg|gif|png'
            },
            refund_pic3 : {
                accept : 'jpg|jpeg|gif|png'
            }
        },
        messages : {
            reason_id  : {
                required  : '<i class="icon-exclamation-sign"></i><?php echo '请选择退货退款原因';?>'
            },
            refund_amount  : {
                required  : '<i class="icon-exclamation-sign"></i><?php echo $lang['refund_pay_refund'];?> <?php echo $output['goods']['goods_pay_price']; ?>',
                number   : '<i class="icon-exclamation-sign"></i><?php echo $lang['refund_pay_refund'];?> <?php echo $output['goods']['goods_pay_price']; ?>',
                min   : '<i class="icon-exclamation-sign"></i><?php echo $lang['refund_pay_min'];?> 0.01',
	            max   : '<i class="icon-exclamation-sign"></i><?php echo $lang['refund_pay_refund'];?> <?php echo $output['goods']['goods_pay_price']; ?>'
            },
            goods_num  : {
                required  : '<i class="icon-exclamation-sign"></i><?php echo $lang['return_add_return'];?> <?php echo $output['goods']['goods_num']; ?>',
                digits   : '<i class="icon-exclamation-sign"></i><?php echo $lang['return_add_return'];?> <?php echo $output['goods']['goods_num']; ?>',
                min   : '<i class="icon-exclamation-sign"></i><?php echo $lang['return_number_min'];?> 1',
	            max   : '<i class="icon-exclamation-sign"></i><?php echo $lang['return_number_max'];?> <?php echo $output['goods']['goods_num']; ?>'
            },
            buyer_message  : {
                required   : '<i class="icon-exclamation-sign"></i>请填写退货退款说明'
            },
            refund_pic1: {
                accept : '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
            },
            refund_pic2: {
                accept : '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
            },
            refund_pic3: {
                accept : '<i class="icon-exclamation-sign"></i>图片必须是jpg/jpeg/gif/png格式'
            }
        }
    });

});

$('a[data-option]').click(function(){
		var d_op = $(this).attr('data-option');
		$(this).addClass('active').siblings('a').removeClass('active');
		if(d_op == 1){
			$("#saleRefund").show();
			$("#saleRefundReturn").hide();
		}
		if(d_op == 2){
			$("#saleRefund").hide();
			$("#saleRefundReturn").show();
		}
	});
</script>