<?php defined('InShopNC') or exit('Access Invalid!');?>

<ul class="buys1-hide-list buys-ycnt">
  <?php foreach((array)$output['address_list'] as $k=>$val){ ?>
  <li class="current existent-address">
	<label>
    <input address="<?php echo intval($val['dlyp_id']) ? '[自提服务站] ' : '';?><?php echo $val['area_info'].'&nbsp;'.$val['address']; ?>" true_name="<?php echo $val['true_name'];?>" id="addr_<?php echo $val['address_id']; ?>" nc_type="addr" type="radio" class="address-radio" city_id="<?php echo $val['city_id']?>" area_id=<?php echo $val['area_id'];?> name="addr" value="<?php echo $val['address_id']; ?>" phone="<?php echo $val['mob_phone'] ? $val['mob_phone'] : $val['tel_phone'];?>" <?php echo $val['is_default'] == '1' ? 'checked' : null; ?> />
	<span class="mr5 rdo-span"><span class="true_name_40797"><?php echo $val['true_name'];?></span> <span class="address_id_<?php echo $val['address_id']?>"><?php echo $val['area_info']; ?>&nbsp;<?php echo $val['address']; ?></span> <span class="mob_phone_<?php echo $val['address_id']?>"><?php echo $val['mob_phone'] ? $val['mob_phone'] : $val['tel_phone'];?></span></span>
	<a class="del-address" href="javascript:void(0);" onclick="delAddr(<?php echo $val['address_id']?>);">[删除]</a>
	</label>
	
   </li>
  <?php } ?>
  <li>
  <label class="new-address clr-d94"><input value="0" class="address-radio" nc_type="addr" id="add_addr" type="radio" name="addr">使用新地址</label>
    <?php if (C('delivery_isuse')) { ?>
    &nbsp;<label><a class="del" href="<?php echo urlShop('member_address','address');?>" target="_blank">使用自提服务站 </a></label>
    <?php } ?>
  </li>
  <div id="add_addr_box"><!-- 存放新增地址表单 --></div>
   <li class="invoice_opeara">
		<a href="javascript:void(0);" id="hide_addr_list" class="btn-prink save-address">保存地址信息</a>
	</li>
</ul>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>

<script type="text/javascript">
function delAddr(id){
    $('#addr_list').load(SITEURL+'/index.php?act=member_buy&op=load_addr&id='+id);
}
$(function(){
    function addAddr() {
        $('#add_addr_box').load(SITEURL+'/index.php?act=member_buy&op=add_addr');
    }
    $('input[nc_type="addr"]').on('click',function(){
        if ($(this).val() == '0') {
            $('.address_item').removeClass('ncc-selected-item');
            $('#add_addr_box').load(SITEURL+'/index.php?act=member_buy&op=add_addr');
        } else {
            $('.address_item').removeClass('ncc-selected-item');
            $(this).parent().addClass('ncc-selected-item');
            $('#add_addr_box').html('');
        }
    });
    $('#hide_addr_list').on('click',function(){
        if ($('input[nc_type="addr"]:checked').val() == '0'){
            submitAddAddr();
        } else {
            if ($('input[nc_type="addr"]:checked').size() == 0) {
                return false;
            }
            var city_id = $('input[name="addr"]:checked').attr('city_id');
            var area_id = $('input[name="addr"]:checked').attr('area_id');
            var addr_id = $('input[name="addr"]:checked').val();
            var true_name = $('input[name="addr"]:checked').attr('true_name');
            var address = $('input[name="addr"]:checked').attr('address');
            var phone = $('input[name="addr"]:checked').attr('phone');
            showShippingPrice(city_id,area_id);
            hideAddrList(addr_id,true_name,address,phone);
        }
    });
    if ($('input[nc_type="addr"]').size() == 1){
        $('#add_addr').attr('checked',true);
        addAddr();
    }
});
</script>