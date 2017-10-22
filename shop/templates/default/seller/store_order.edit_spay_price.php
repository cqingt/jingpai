<div class="eject_con">
<div id="warning"></div>
<?php if ($output['order_info']) {?>

  <form id="changeform" method="post" action="index.php?act=store_order&op=change_state&state_type=spay_price&order_id=<?php echo $output['order_info']['order_id']; ?>">
    <input type="hidden" name="form_submit" value="ok" />
    <dl>
      <dt><?php echo $lang['store_order_buyer_with'].$lang['nc_colon'];?></dt>
      <dd><?php echo $output['order_info']['buyer_name']; ?></dd>
    </dl>
    <dl>
      <dt><?php echo $lang['store_order_sn'].$lang['nc_colon'];?></dt>
      <dd><span class="num"><?php echo $output['order_info']['order_sn']; ?></span></dd>
    </dl>
	<!--
    <dl>
      <dt><?php echo '修改价格'.$lang['nc_colon'];?></dt>
      <dd>
        <input type="text" class="text" id="goods_amount" name="goods_amount" value="<?php echo $output['order_info']['goods_amount']; ?>"/>
      </dd>
    </dl>
	-->
	<?php foreach($output['order_info']['extend_order_goods'] as $k=>$v) {?>
		
		<dl>
		  <dt style="height: 20px;" title="<?php echo $v['goods_name'];?>"><!--<img src="http://images.96567.com/upload/shop/common/default_goods_image_60.gif" onmouseover="toolTip('<img src=http://images.96567.com/upload/shop/common/default_goods_image_240.gif>')" onmouseout="toolTip()">--><?php echo $v['goods_name'];?></dt>
		  <dd>
		  数量：
			<?php echo $v['goods_num'];?>
		  实际成交价：
		  <?php if($v['goods_type'] == 1){ ?>
				<input type="text" class="text" id="goods_pay_price" name="goods_pay_price[<?php echo $v['rec_id']?>]" value="<?php echo $v['goods_pay_price'];?>"/>
			<?php }else{ ?>
				<input type="hidden" name="goods_pay_price[<?php echo $v['rec_id']?>]" value="<?php echo $v['goods_pay_price'];?>">
				<?php echo $v['goods_pay_price'];?>
			<?php } ?>
		  </dd>
		</dl>
		
	<?php } ?>
	<br />
	<span style="padding-left: 132px;color: red;">提示:已参加促销活动的产品不能进行修改</span>
    <dl class="bottom">
      <dt>&nbsp;</dt>
      <dd>
        <input type="submit" class="submit" id="confirm_button" value="<?php echo $lang['nc_ok'];?>" />
      </dd>
    </dl>
  </form>
<?php } else { ?>
<p style="line-height:80px;text-align:center">该订单并不存在，请检查参数是否正确!</p>
<?php } ?>
</div>
<script type="text/javascript">
$(function(){
    $('#changeform').validate({
    	errorLabelContainer: $('#warning'),
        invalidHandler: function(form, validator) {
           var errors = validator.numberOfInvalids();
           if(errors){ $('#warning').show();}else{ $('#warning').hide(); }
        },
     	submitHandler:function(form){
    		ajaxpost('changeform', '', '', 'onerror'); 
    	},    
	    rules : {
        	order_amount : {
	            required : true,
	            number : true
	        }
	    },
	    messages : {
	    	order_amount : {
	    		required : '<?php echo $lang['store_order_modify_price_gpriceerror'];?>',
            	number : '<?php echo $lang['store_order_modify_price_gpriceerror'];?>'
	        }
	    }
	});
});
</script>