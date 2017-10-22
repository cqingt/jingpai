<?php defined('InShopNC') or exit('Access Invalid!');?>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>

<form method="post" id="order_form" name="order_form" action="index.php">
<div class="ncc-main">
  <div class="ncc-title">
    <h3><?php echo $lang['cart_index_ensure_info'];?>    <span style="font-size: 16px;">您需要在 <?php echo date('Y年m月d日 H点i分',($output['orderInfo']['add_time']+86400*3));?> 前下单并支付成功，超时订单自动取消！</span></h3>
    <h5>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
  </div>
    <?php include template('buy/buy_lepai_address');?>
    <!-- 收货地址ID -->
    <input value="<?php echo $output['address_info']['address_id'];?>" name="address_id" id="address_id" type="hidden">

    <div class="ncc-receipt-info" id="paymentCon">
        <div class="ncc-receipt-info-title">
            <h3>支付方式</h3>
            <!--
            <?php if (!$output['deny_edit_payment']) {?>
                <a href="javascript:void(0)" nc_type="buy_edit" id="edit_payment">[修改]</a>
            <?php }?>
            -->
        </div>
        <div class="ncc-candidate-items">
            <ul>
                <li>在线支付</li>
            </ul>
        </div>
    </div>
    <div class="ncc-receipt-info">
        <div class="ncc-receipt-info-title">
            <h3>拍卖惠商品清单</h3>
        </div>
        <table class="ncc-table-style">
            <thead>
            <tr>
                <th class="w20"></th>
                <th></th>
                <th>商品</th>
                <th class="w120">单价(元)</th>
                <th class="w120">数量</th>
                <th class="w120">小计(元)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th colspan="20"><strong>店铺：<a target="_blank" href="http://www.lpshopnc.com/shop/index.php?act=show_store&op=index&store_id=<?php echo $output['orderInfo']['store_id']?>"><?php echo $output['orderInfo']['store_name']?></a></strong>
                    <div class="store-sale">
                    </div></th>
            </tr>
            <tr id="cart_item_232" class="shop-list ">
                <td>&nbsp;</td>
                <td class="w60"><a href="<?php echo urlLepai('index','auction',array('id'=>$output['auction_info']['G_Id']));?>" target="_blank" class="ncc-goods-thumb"><img src="<?php echo BASE_SITE_URL.$output['auction_info']['G_MainImg'];?>" alt="<?php echo $output['auction_info']['G_Name']?>"></a></td>
                <td class="tl"><dl class="ncc-goods-info">
                        <dt><a href="<?php echo urlLepai('index','auction',array('id'=>$output['auction_info']['G_Id']));?>" target="_blank"><?php echo $output['auction_info']['G_Name']?></a></dt>
                        <dd> <span class="groupbuy">拍卖惠</span></dd>
                    </dl></td>
                <td class="w120"><em><?php echo $output['orderInfo']['goods_amount']?></em></td>
                <td class="w60">1</td>
                <td class="w120">          <em id="item232_subtotal" nc_type="eachGoodsTotal"><?php echo $output['orderInfo']['goods_amount']?></em>
                </td>
                <td></td>
            </tr>

            <!-- S bundling goods list -->
            <!-- E bundling goods list -->

            <!--<tr>
                <td class="w10"></td>
                <td class="tl" colspan="2">买家留言：
                    <textarea name="pay_message[1]" class="ncc-msg-textarea" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" maxlength="150"></textarea></td>
                <td class="tl" colspan="10"><div class="ncc-form-default"> </div></td>
            </tr>-->
            <tr>
                <td class="tr" colspan="20"><div class="ncc-store-account">
                        <dl class="freight">
                            <dt>运费：</dt>
                            <dd><em id="eachStoreFreight_1"><?php echo $output['orderInfo']['shipping_fee']?></em>元</dd>
                        </dl>


                        <!-- S voucher list -->


                        <!-- E voucher list -->

                        <dl class="total">
                            <dt>竞拍成交价：</dt>
                            <dd><em store_id="1" nc_type="eachStoreTotal"><?php echo $output['orderInfo']['goods_amount']?></em>元</dd>
                        </dl>
                    </div></td>
            </tr>

            <!-- S 预存款 & 充值卡 -->


    <?php if (!empty($output['available_pd_amount']) || !empty($output['available_rcb_amount'])) { ?>
      <tr id="pd_panel">
        <td class="pd-account" colspan="20"><div class="ncc-pd-account">

       <?php if (!empty($output['available_pd_amount'])) { ?>
            <div class="mt5 mb5">
              <label>
                <input type="checkbox" class="vm mr5" value="1" name="pd_pay">
                使用预存款（可用金额：<em><?php echo $output['available_pd_amount'];?></em><?php echo $lang['currency_zh'];?>）</label>
            </div>
      <?php } ?>

            <div id="pd_password" style="display: none">支付密码：
              <input type="password" class="text w120" value="" name="password" id="pay-password" maxlength="35" autocomplete="off">
              <input type="hidden" value="" name="password_callback" id="password_callback">
              <a class="ncc-btn-mini ncc-btn-orange" id="pd_pay_submit" href="javascript:void(0)">使用</a>
              <?php if (!$output['member_paypwd']) {?>
              还未设置支付密码，<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_security&op=auth&type=modify_paypwd" target="_blank">马上设置</a>
              <?php } ?>
            </div>
          </div></td>
      </tr>
      <?php } ?>


            <!-- E 预存款 -->

            <!-- S fcode -->
            <!-- E fcode -->

            </tbody>
            <tfoot>
            <tr>
                <td colspan="20"><div class="ncc-all-account">订单总金额：<em id="orderTotal"><?php echo $output['orderInfo']['order_amount']?></em>元 <?php if($output['orderInfo']['pd_amount'] > 0){?><span style="font-size:12px">（拍卖惠保证金可抵扣订单金额：<?php echo $output['orderInfo']['pd_amount'];?>元）</span><?php } ?></div></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <div class="ncc-bottom"> <a href="javascript:void(0)" id='submitOrder' class="ncc-btn ncc-btn-acidblue fr"><?php echo $lang['cart_index_submit_order'];?></a> </div>
    <script>
        function submitNext(){
            if (!SUBMIT_FORM) return;

            if ($('#address_id').val() == ''){
                showDialog('<?php echo $lang['cart_step1_please_set_address'];?>', 'error','','','','','','','','',2);
                return;
            }

            if (($('input[name="pd_pay"]').attr('checked') || $('input[name="rcb_pay"]').attr('checked')) && $('#password_callback').val() != '1') {
                showDialog('使用充值卡/预存款支付，需输入支付密码并使用  ', 'error','','','','','','','','',2);
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
    <input value="buy" type="hidden" name="act">
    <input value="lepaiOrderstep2" type="hidden" name="op">
    <input value="<?php echo $output['orderInfo']['order_sn']?>" type="hidden" name="order_sn">
    <!-- 来源于购物车标志 -->
    <input value="<?php echo $output['ifcart'];?>" type="hidden" name="ifcart">

    <!-- offline/online -->
    <input value="online" name="pay_name" id="pay_name" type="hidden">

    <!-- 是否保存增值税发票判断标志 -->
    <input value="<?php echo $output['vat_hash'];?>" name="vat_hash" type="hidden">

</div>
</form>
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





<?php if (!empty($output['available_pd_amount']) || !empty($output['available_rcb_amount'])) { ?>



function showPaySubmit() {
    if ($('input[name="pd_pay"]').attr('checked') || $('input[name="rcb_pay"]').attr('checked')) {
        $('#pay-password').val('');
        $('#password_callback').val('');
        $('#pd_password').show();
    } else {
        $('#pd_password').hide();
    }
}


$(function(){
    $('#pd_pay_submit').on('click',function(){
        if ($('#pay-password').val() == '') {
            showDialog('请输入支付密码', 'error','','','','','','','','',2);return false;
        }
        $('#password_callback').val('');
        $.get("index.php?act=buy&op=check_pd_pwd", {'password':$('#pay-password').val()}, function(data){
            if (data == '1') {
                $('#password_callback').val('1');
                $('#pd_password').hide();
            } else {
                $('#pay-password').val('');
                showDialog('支付密码码错误', 'error','','','','','','','','',2);
            }
        });
    });
});


/*冲值卡*/
<?php if (!empty($output['available_rcb_amount'])) { ?>
    $('input[name="rcb_pay"]').on('change',function(){
        showPaySubmit();
        if ($(this).attr('checked') && !$('input[name="pd_pay"]').attr('checked')) {
            if (<?php echo $output['available_rcb_amount']?> >= parseFloat($('#orderTotal').html())) {
                $('input[name="pd_pay"]').attr('checked',false).attr('disabled',true);
            }
        } else {
            $('input[name="pd_pay"]').attr('disabled',false);
        }
    });
<?php } ?>

/*余额*/
<?php if (!empty($output['available_pd_amount'])) { ?>
    $('input[name="pd_pay"]').on('change',function(){
        showPaySubmit();
        if ($(this).attr('checked') && !$('input[name="rcb_pay"]').attr('checked')) {
            if (<?php echo $output['available_pd_amount']?> >= parseFloat($('#orderTotal').html())) {
                $('input[name="rcb_pay"]').attr('checked',false).attr('disabled',true);
            }
        } else {
            $('input[name="rcb_pay"]').attr('disabled',false);
        }       
    });
<?php } ?>


<?php } ?>




</script> 
