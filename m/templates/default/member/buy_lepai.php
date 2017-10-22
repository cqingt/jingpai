	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<script>
var SITEURL = 'http://m.96567.com/';
</script>

	 <div style="height: 50px;padding: 15px 0;border: solid #F7F7F7;border-width: 1px 0 0;padding: 10px 10px 0px 10px;">
			<h3 style='font: lighter 24px/30px arial,"microsoft yahei";color: #555;'><span style="font-size: 14px;">您需要在 <?php echo date('Y年m月d日 H点i分',($output['orderInfo']['add_time']+86400*3));?> 前下单并支付成功。<br />超时订单自动取消！</span></h3>
			<h5 style='font: 12px/20px arial,"microsoft yahei";color: #AAA;'>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
	</div>
    <div class="buy_step1" style="padding-top: 40px;">
       <div class="buys1-cnt buys1-address-cnt">
			
		   <?php include template('member/buy_lepai_address');?>
			
        </div>
		
		<form method="post" id="order_form" name="order_form" action="index.php">
		<!-- 收货地址ID -->
		<input value="<?php echo $output['address_info']['address_id'];?>" name="address_id" id="address_id" type="hidden">
        <div class="buys1-cnt">
           <h3 class="clearfix">支付方式</h3>
           <ul class="buys-ycnt">
                <li class="clearfix buys-yc-type">
                    <label id="online">
                        <input type="radio" name="buy-type" class="mr5" checked value="online" id="buy-type-online">在线支付
                    </label>
                </li>
           </ul>
        </div>
       <div class="buys1-cnt">
           <h3 class="clearfix">商品清单<!--  <span class="btn-s btn-prink-s fright" onclick="javascript:history.go(-1);">去购物车</span> --> </h3>
           <ul class="buys-ytable mt10" id="goodslist_before">
		   <li><p class="buys-yt-tlt">店铺名称：<?php echo $output['orderInfo']['store_name'] == '' ? '收藏天下自营' : $output['orderInfo']['store_name']; ?></p><div class="buys1-pdlist">
		   <div class="clearfix">
		   <a class="img-wp" href="<?php echo urlWap('lepai','auction',array('id'=>$output['auction_info']['G_Id']));?>"><img src="<?php echo BASE_SITE_URL.$output['auction_info']['G_MainImg'];?>"></a><div class="buys1-pdlcnt"><p><a class="buys1-pdlc-name" href="<?php echo urlWap('lepai','auction',array('id'=>$output['auction_info']['G_Id']));?>"><?php echo $output['auction_info']['G_Name']?></a></p><p>单价(元)：￥<?php echo $output['orderInfo']['goods_amount']?></p><p>数量：1</p></div></div></div><div class="shop-total"><p>运费：￥<span id="store3">0</span></p><p class="clr-c07">竞拍成交价：￥<span id="st3" store_price="60" class="store_total"><?php echo $output['orderInfo']['goods_amount']?></span></p>
		   
		   </div>
		   
		   </li>

               <li class="bd-t-cc">
                   <div class="buys-order-total">
                       订单总金额：￥<span id="orderTotal"><?php echo $output['orderInfo']['order_amount']?></span>
					   <?php if($output['orderInfo']['pd_amount'] > 0){?>
                       <span id="online-total-wrapper">（拍卖惠保证金可抵扣订单金额：￥<span id="online-total"><?php echo $output['orderInfo']['pd_amount'];?></span>）</span>
					   <?php } ?>
                   </div>
               </li>
               <li>
                   <a href="javascript:void(0);" class="post-order" id='submitOrder' >提交订单</a>
               </li>
			    <script>
					function submitNext(){
						if (!SUBMIT_FORM) return;

						if ($('#address_id').val() == ''){
							showDialog('<?php echo $lang['cart_step1_please_set_address'];?>', 'error','','','','','','','','',2);
							return;
						}

						SUBMIT_FORM = false;

						$('#order_form').submit();
					}
					$(function(){
						$(document).keydown(function(e) {
							if (e.keyCode == 13) {
								submitNext();
								return false;
							}
						});
						$('#submitOrder').on('click',function(){submitNext()});
						calcOrder();
					});
				</script>
			<input value="member_buy" type="hidden" name="act">
			<input value="lepaiOrderstep2" type="hidden" name="op">
			<input value="<?php echo $output['orderInfo']['order_sn']?>" type="hidden" name="order_sn">
			<!-- 来源于购物车标志 -->
			<input value="<?php echo $output['ifcart'];?>" type="hidden" name="ifcart">
			<!-- offline/online -->
			<input value="online" name="pay_name" id="pay_name" type="hidden">
			<!-- 是否保存增值税发票判断标志 -->
			<input value="<?php echo $output['vat_hash'];?>" name="vat_hash" type="hidden">
           </ul>
       </div>
		</form>
    </div>
<script type="text/javascript">
var SUBMIT_FORM = true;
//计算总运费和每个店铺小计
function calcOrder() {

}
$(function(){
    $.ajaxSetup({
        async : false
    });



});
function disableOtherEdit(showText){
	$('a[nc_type="buy_edit"]').each(function(){
	    if ($(this).css('display') != 'none'){
			$(this).after('<font color="#B0B0B0">' + showText + '</font>');
		    $(this).hide();
	    }
	});
	disableSubmitOrder();
}
function ableOtherEdit(){
	$('a[nc_type="buy_edit"]').show().next('font').remove();
	ableSubmitOrder();

}
function ableSubmitOrder(){
	$('#submitOrder').on('click',function(){submitNext()}).css('cursor','').addClass('ncc-btn-acidblue');
}
function disableSubmitOrder(){
	$('#submitOrder').unbind('click').css('cursor','not-allowed').removeClass('ncc-btn-acidblue');
}
</script>