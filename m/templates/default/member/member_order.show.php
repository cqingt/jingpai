<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<!--2016/7/19-->
 <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/dingdan.css" />

        
      	<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/bootstrap.js" ></script>

  <section class="ui-main-con">
	<div class="demo-item mb clearfix">
		<p class="demo-desc">订单号:<?php echo $output['order_info']['order_sn']; ?></p>
		 <?php if ($output['order_info']['order_state'] == ORDER_STATE_CANCEL) { ?>
				<p class="demo-state"><i class="icon-accomplish">交易关闭</i></p>
		 <?php } ?>

		 <?php if ($output['order_info']['order_state'] == ORDER_STATE_NEW) { ?>
				<p class="demo-state"><i class="icon-accomplish">订单已经提交，等待买家付款</i></p>
		 <?php } ?>

		  <?php if ($output['order_info']['order_state'] == ORDER_STATE_PAY) { ?>

				<p class="demo-state"><i class="icon-accomplish">  
			<?php if ($output['order_info']['payment_code'] == 'offline') { ?>
          订单已提交，等待卖家发货
          <?php } else { ?>
          已支付成功
          <?php } ?></i></p>
		 <?php } ?>

		 <?php if ($output['order_info']['order_state'] == ORDER_STATE_SEND) { ?>
			<p class="demo-state"><i class="icon-accomplish">商家已发货</i>
			<?php if ($output['order_info']['extend_order_common']['dlyo_pickup_code'] != '') { ?>
          ， 提货码：<?php echo $output['order_info']['extend_order_common']['dlyo_pickup_code'];?>
			<?php } ?>
			</p>
		 <?php } ?>

		 <?php if ($output['order_info']['order_state'] == ORDER_STATE_SUCCESS) { ?>
			<p class="demo-state"><i class="icon-accomplish">
			<?php if ($output['order_info']['evaluation_state'] == 1) { ?>
				评价完成。
			<?php } else { ?>
				已经收货。
			<?php } ?>
			</i></p>
		 <?php } ?>
	</div>
	
	<div class="demo-item mb clearfix">
		<p class="demo-desc"><i class="icon-people l"><?php echo $output['order_info']['extend_order_common']['reciver_name'];?></i></p>
		<p class="demo-state"><i class="icon-number l"><?php echo @$output['order_info']['extend_order_common']['reciver_info']['mob_phone'];?></i></p>
		<p class="ui-txt-muted mt-large"><?php echo @iconv("GB2312","UTF-8",$output['order_info']['extend_order_common']['reciver_info']['address']);?></p>
	</div> 
	
	<div class="demo-item no clearfix">
		<a href="index.php?act=member_store&op=store_info&store_id=<?php echo $output['order_info']['extend_store']['store_id'];?>" class="demo-desc arrows"><i class="icon-home l"><?php echo $output['order_info']['extend_store']['store_name']; ?></i></a>	  		
	</div> 	
	
	<div class="demo-item mb no-bt clearfix">
		<div class="demo-block">
			<ul class="ui-list ui-list-link">
			  <?php $i = 0;?>
				<?php foreach($output['order_info']['goods_list'] as $k => $goods) {?>
				<?php $i++;?>
				<li class="ul-border-b">
					<div class="ui-list-img">
						<img src="<?php echo $goods['image_60_url']; ?>" title="<?php echo $goods['goods_name']; ?>" alt="<?php echo $goods['goods_name']; ?>"/>
					</div>
					<div class="ui-list-info">
						<h4 class="ui-nowrap-multi"><?php echo $goods['goods_name']; ?></h4>
						<p class="demo-price-drift">¥<?php echo $goods['goods_price']; ?></p>
						<p class="demo-number">x<?php echo $goods['goods_num']; ?>
						<?php if (is_array($output['refund_all']) && !empty($output['refund_all']) && $output['refund_all']['admin_time'] > 0) {?>
					  <?php echo $goods['goods_pay_price'];?><span style="color: #eb4649;">退</span>
					  <?php } elseif ($goods['extend_refund']['admin_time'] > 0) { ?>
					  <?php echo $goods['extend_refund']['refund_amount'];?><span style="color: #eb4649;">退</span>
					  <?php } ?>
						</p>
					</div>
				</li>		
				<?php } ?>
			</ul>
			<a class="btn-service" href="javascript:void(0);" title="在线联系" <?php if(in_array($output['order_info']['extend_store']['store_id'], model('store')->getOwnShopIds())){?>onclick="NTKF.im_openInPageChat('sc_1000_9999')"
		<?php }else{ ?>onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($output['order_info']['extend_store']['store_id']);?>_9999')"
		<?php } ?>><i class="icon-service">联系客服</i></a>
		</div>			  		
	</div>
	<?php if($output['order_info']['payment_name']) { ?>
	<div class="demo-item no-bb clearfix">
		<p class="demo-desc color6">支付方式</p>
		<p class="demo-state"><?php echo $output['order_info']['payment_name']; ?></p>
	</div>
	<?php } ?>
	<?php if ($output['order_info']['shipping_code'] != '') { ?>
	<div class="demo-item mb clearfix">
		<p class="demo-desc color6">配送信息</p>
		<p class="demo-state"><?php echo $output['order_info']['express_info']['e_name']?>单号：<?php echo $output['order_info']['shipping_code'];?>。</p>
		<p class="ui-txt-muted mt-large">由商家选择合作的快递公司为您配送</p>
	</div>	
	<?php } ?>
	<div class="demo-item clearfix">
		<div class="demo-block clearfix mb ul-border-b">
			<span class="detail">
				<p>商品总额</p>
				<p>¥<?php echo $output['order_info']['goods_amount']; ?></p>
			</span>
			<?php if(!empty($output['order_info']['shipping_fee']) && $output['order_info']['shipping_fee'] != '0.00'){ ?>
				<span class="detail">
					<p>+运费</p>
					<p>¥<?php echo $output['order_info']['shipping_fee']; ?></p>
				</span>
			<?php }?>
			<?php if(!empty($output['order_info']['pay_fee']) && $output['order_info']['pay_fee'] > 0){ ?>
			<span class="detail">
				<p>+货到付款手续费</p>
				<p>¥<?php echo $output['order_info']['pay_fee']?></p>
			</span>			  	
			<?php }?>
			
			<?php if($output['order_info']['rcb_amount']>0){ ?>
			<span class="detail">
				<p>-充值卡已支付</p>
				<p>¥<?php echo $output['order_info']['rcb_amount']; ?></p>
			</span>			  	
			<?php }?>

			 <?php if($output['order_info']['pd_amount']>0){ ?>
			  <span class="detail">
				<p>-预存款已支付</p>
				<p>¥<?php echo $output['order_info']['rcb_amount']; ?></p>
			  </span>	
             <?php } ?>

			 <?php if($output['order_info']['money_paid']>0 && $output['order_info']['order_state'] == ORDER_STATE_NEW){ ?>
			  <span class="detail">
				<p>-已支付总金额</p>
				<p>¥<?php echo $output['order_info']['money_paid']+$output['order_info']['pd_amount']+$output['order_info']['rcb_amount']; ?></p>
			  </span>	
             <?php } ?>

		</div>
		<div class="demo-state">
			<p class="mb-small">实付款：<em class="large">¥<?php echo $output['order_info']['order_amount']; ?></em></p>
			<time class="small">下单时间：<?php echo date("Y-m-d H:i:s",$output['order_info']['add_time']); ?></time>
		</div>
	</div>			
	<?php if($output['order_info']['order_state'] < 40){ ?>
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"></h4>
		  </div>
		  <div class="modal-body">
				   点击继续申请，系统将自动为您的整张订单确认收货，否则请取消申请
		  </div>
		  <div class="modal-footer" style="padding: 9px;">
			<button type="button" class="btn btn-default" data-dismiss="modal">取消申请</button>
			<button type="button" class="btn btn-primary" id="JiXuTiJiao" JiXuUrl="index.php?act=member_refund&op=add_refund&order_id=<?php echo $output['order_info']['order_id']; ?>&goods_id=<?php echo $goods['rec_id']; ?>">继续申请</button>
		  </div>
		</div>
	  </div>
	</div>

	<?php }?>
  </section>
  

<?php if($output['order_info']['payment_code'] == 'bank'){ $can_bank = true;}?>

<?php $output['order_info']['pay_amount'] = $output['order_info']['order_amount'] - $output['order_info']['rcb_amount'] - $output['order_info']['pd_amount'];?>


<?php if ($output['order_info']['order_state'] == ORDER_STATE_NEW) { ?>
<div class="footer-dingdan" style="z-index: 1;">
	 <nav>
	 <?php if($can_bank && $output['order_info']['pay_amount'] && $output['order_info']['pay_amount']>0){?>
            <a href="<?php echo urlWap('member_payment','payment_bank',array('pay_sn'=>$output['order_info']['pay_sn']));?>">银行转账支付（￥<?php echo $output['order_info']['pay_amount'];?>）</a>
        <?php }elseif($output['order_info']['pay_amount'] && $output['order_info']['pay_amount']>0){ ?>

		<a href="<?php echo urlWap('member_buy','pay',array('pay_sn'=>$output['order_info']['pay_sn']));?>">去支付</a>

        <?php }?>
		<a href="javascript:void(0)" order_id="<?php echo $output['order_info']['order_id'];?>" id="cancel">取消订单</a>
	 </nav>
</div>
<?php } ?>


<?php if ($output['order_info']['order_state'] > ORDER_STATE_NEW) { ?>
  <div class="footer-dingdan" style="z-index: 1;">
	 <nav>
		<a href="http://m.96567.com">再次购买</a>
		<!--<a href="">满意度评价</a>-->
		<?php if ($output['order_info']['if_lock']) { ?>
         <a >退款退货中</a>
        <?php } ?>
		<?php if ($output['order_info']['if_refund_cancel']){ ?>
		<a href="index.php?act=member_refund&op=add_refund_all&order_id=<?php echo $output['order_info']['order_id']; ?>">订单退款</a>
		<?php } ?>
		<?php if ($goods['refund'] == 1){?>
			<?php if($output['order_info']['order_state'] < 40){ ?>
				<a href="javascript:;" data-toggle="modal" data-target="#myModal">退款/退货</a>
			<?php }else{ ?>
				<a href="index.php?act=member_refund&op=add_refund&order_id=<?php echo $output['order_info']['order_id']; ?>&goods_id=<?php echo $goods['rec_id']; ?>">退款/退货</a>
			<?php } ?>
		<?php } ?>
	 </nav>
  </div>
  <?php } ?>


<script>
$("#JiXuTiJiao").click(function(){
  var value = $(this).attr("JiXuUrl");
  window.location.href=value;
});
    $("#cancel").click(function(){
        var orderid = $(this).attr('order_id');
        if(confirm("确定要取消订单?")){
            var url = "<?php echo urlWap('member_order','order_cancel',array('order_id'=>''))?>";
            window.location.href=url+orderid;
        }

    });
</script>