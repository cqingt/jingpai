<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="ncc-main">
  <div class="ncc-title">
    <h3><?php echo $lang['cart_index_payment'];?></h3>
    <h5>订单详情内容可通过查看<a href="index.php?act=member_order" target="_blank">我的订单</a>进行核对处理。</h5>
  </div>
  <form action="index.php?act=payment&op=real_order" method="POST" id="buy_form">
    <input type="hidden" name="pay_sn" value="<?php echo $output['pay_info']['pay_sn'];?>">
    <input type="hidden" id="payment_code" name="payment_code" value="">
      <input type="hidden" id="bank_code" name="bank_code" value="">
    <div class="ncc-receipt-info">
      <div class="ncc-receipt-info-title">
        <h3><?php echo $output['order_remind'];?>
          <?php if ($output['pay_amount_online'] > 0) {?>
          需支付金额：<strong>￥<?php echo $output['pay_amount_online'];?></strong>
          <?php } ?>
          </h3>
      </div>
      <table class="ncc-table-style">
        <thead>
          <tr>
            <th class="w50"></th>
            <th class="w200 tl">订单号</th>
            <th class="tl w150">支付方式</th>
            <th class="tl">金额</th>
            <th class="w150">物流</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($output['order_list'])>1) {?>
          <tr>
            <th colspan="20">由于您的商品由不同商家发出，此单将分为<?php echo count($output['order_list']);?>个不同子订单配送！</th>
          </tr>
          <?php }?>
          <?php foreach ($output['order_list'] as $key => $order) {?>
          <tr>
            <td></td>
            <td class="tl"><?php echo $order['order_sn']; ?></td>
            <td class="tl"><?php echo $order['payment_state'];?></td>
            <td class="tl">￥<?php echo $order['order_amount'];?></td>
            <td>快递</td>
          </tr>
          <?php  }?>
        </tbody>
      </table>
    </div>
      <?php if($output['show_payment_code'] == 'bank'){ ?>
      <div class="ncc-receipt-info">
          <div class="ncc-receipt-info-title">
              <h3>银行转账汇款</h3>
          </div>
          <?php
            if($output['payment_bank']['payment_config'] != ''){
                $bank_payment_config = unserialize($output['payment_bank']['payment_config']);
                $html_contents =  htmlspecialchars_decode($bank_payment_config['bank_content']);
                echo str_replace('{unioncode}',$output['order_list'][0]['huikuan_code'],$html_contents);
            }
          ?>
      </div>
      <?php }else{ ?>
    <div class="ncc-receipt-info">
      <?php if (!isset($output['payment_list'])) {?>
      <?php }else if (empty($output['payment_list'])){?>
      <div class="nopay"><?php echo $lang['cart_step2_paymentnull_1']; ?> <a href="index.php?act=member_message&op=sendmsg&member_id=<?php echo $output['order']['seller_id'];?>"><?php echo $lang['cart_step2_paymentnull_2'];?></a> <?php echo $lang['cart_step2_paymentnull_3'];?></div>
      <?php } else {?>

          <?php
          if($output['payment_list']['unionpay']['payment_config'] != ''){
              $unionpay_conf = unserialize($output['payment_list']['unionpay']['payment_config']);
              if($unionpay_conf['bank_state']){
                  $banklist = include(BASE_PATH.'/api/payment/unionpay/banklist.php');
                  ksort($banklist);
                  ?>
                  <style>

                  </style>
                  <div class="ncc-receipt-info-title">
                      <h3>支付银行</h3>
                  </div>
                    <ul class="ncc-bank-list">
                  <?php foreach($banklist as $k=>$v) {
                      if($v['open']){ ?>
                        <li payment_code="unionpay" bank_code="<?php echo $v['code']; ?>">
                            <label for="pay_<?php echo $v['code']; ?>">
                                <i></i>
                                <div class="logo" for="pay_<?php echo $v['code']; ?>"> <img src="<?php echo APP_SITE_URL.$v['img'];?>" /> </div>
                            </label>
                        </li>
                  <?php } } ?>
                    </ul>
                  <?php
              }
          }
              if($output['payment_list']['chinabank']['payment_config'] != ''){
                  $chinabanklist = include(BASE_PATH.'/api/payment/chinabank/banklist.php');
                  ksort($chinabanklist);
                  ?>
                  <style>

                  </style>
                  <div class="ncc-receipt-info-title">
                      <h3>支付银行</h3>
                  </div>
                  <ul class="ncc-bank-list">
                      <?php foreach($chinabanklist as $k=>$v) {
                          if($v['open']){ ?>
                              <li payment_code="chinabank" bank_code="<?php echo $v['code']; ?>">
                                  <label for="pay_<?php echo $v['code']; ?>">
                                      <i></i>
                                      <div class="logo" for="pay_<?php echo $v['code']; ?>"> <img src="<?php echo APP_SITE_URL.$v['img'];?>" /> </div>
                                  </label>
                              </li>
                          <?php } } ?>
                  </ul>
              <?php
              }
          ?>
      <div class="ncc-receipt-info-title">
          <h3>支付平台</h3>
      </div>
      <ul class="ncc-payment-list">
        <?php foreach($output['payment_list'] as $val) { ?>
        <li payment_code="<?php echo $val['payment_code']; ?>">
          <label for="pay_<?php echo $val['payment_code']; ?>">
          <i></i>
          <div class="logo" for="pay_<?php echo $val['payment_id']; ?>"> <img src="<?php echo SHOP_TEMPLATES_URL?>/images/payment/<?php echo $val['payment_code']; ?>_logo.gif" /> </div>
          </label>
        </li>
        <?php } ?>
      </ul>
      <?php } ?>
    </div>
    <?php if ($output['pay_amount_online'] > 0) {?>
    <div class="ncc-bottom tc mb50"><a href="javascript:void(0);" id="next_button" class="ncc-btn ncc-btn-green"><i class="icon-shield"></i>确认提交支付</a></div>
    <?php }?>
      <?php }?>
  </form>
</div>
<script type="text/javascript">
$(function(){
    $('.ncc-payment-list > li').on('click',function(){
    	$('.ncc-payment-list > li').removeClass('using');
        $('.ncc-bank-list > li').removeClass('using');
        $(this).addClass('using');
        $('#payment_code').val($(this).attr('payment_code'));
    });
    $('.ncc-bank-list > li').on('click',function(){
        $('.ncc-bank-list > li').removeClass('using');
        $('.ncc-payment-list > li').removeClass('using');
        $(this).addClass('using');
        $('#payment_code').val($(this).attr('payment_code'));
        $('#bank_code').val($(this).attr('bank_code'));
    });
    $('#next_button').on('click',function(){
        if ($('#payment_code').val() == '') {
        	showDialog('请选择支付方式', 'error','','','','','','','','',2);return false;
        }
        $('#buy_form').submit();
    });
});
</script>