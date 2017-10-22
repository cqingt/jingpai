<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">

<div class="buy_step1">


    <div class="buys1-cnt buys1-address-cnt">
        <h3 class="clearfix">收货人信息 <span class="btn-s btn-prink-s fright buys1-edit-address buys1-edit-btn">修改</span></h3>
        <ul class="buys-ycnt buys1-hide-detail">
            <li class="clearfix">
                <span class="key fleft">姓名：</span>
                <div class="value fleft" id="true_name"><?php echo $output['address_info']['true_name']?></div>
            </li>
            <li class="clearfix">
                <span class="key fleft">详细地址：</span>
                <div class="value fleft" id="address"><?php echo $output['address_info']['area_info'].$output['address_info']['address']?></div>
            </li>
            <li class="clearfix">
                <span class="key fleft">联系电话：</span>
                <div class="value fleft" id="mob_phone"><?php echo $output['address_info']['mob_phone']?></div>
            </li>
        </ul>
        <ul class="buys1-hide-list buys-ycnt hide">
            <li id="addresslist">
                 <label class="new-address clr-d94">
                    <input type="radio" name="address" value="0" class="address-radio" id="new-address-button" />
                    使用新的地址信息
                </label>
                <div class="invoice-addcnt" id="new-address-wrapper" style="display:none;">
                    <div class="iadd-title">
                        收货人信息：
                    </div>
                    <div>
                        <p class="iadd-ip">姓名：<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <input type="text" class="n-input h22 wp100" name="true_name" id="vtrue_name"/>
                        </p>
                        <p class="iadd-ip"> 手机号码:<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <input type="text" class="n-input h22 wp100" name="mob_phone" id="vmob_phone"/>
                        </p>
                        <p class="iadd-ip"> 电话号码:</p>
                        <p class="iadd-ip">
                            <input type="text" class="n-input h22 wp100" name="tel_phone" id="vtel_phone"/>
                        </p>
                    </div>
                    <div class="iadd-title"> 地址信息：</div>
                    <div>
                        <p class="iadd-ip">省份：<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <select class="select-30" name="prov" id="vprov">
                                <option value="">请选择...</option>
                            </select>
                        </p>
                        <p class="iadd-ip">城市：<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <select class="select-30" name="city" id="vcity">
                                <option value="">请选择...</option>
                            </select>
                        </p>
                        <p class="iadd-ip"> 区县：<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <select class="select-30" name="region" id="vregion">
                                <option value="">请选择...</option>
                            </select>
                        </p>
                        <p class="iadd-ip"> 街道：<span class="opera-tips">(*必填)</span></p>
                        <p class="iadd-ip">
                            <input type="text" class="n-input h22 wp100" name="vaddress" id="vaddress">
                        </p>
                    </div>
                </div>
                <div class="error-tips"></div>
            </li>
            <li class="invoice_opeara">
                <a href="javascript:void(0);" class="btn-prink save-address">保存地址信息</a>
            </li>
        </ul>
    </div>
    <div class="buys1-cnt">
        <h3 class="clearfix">支付方式</h3>
        <ul class="buys-ycnt">
            <li class="clearfix buys-yc-type">
                <label id="online">
                    <input type="radio" name="buy-type" class="mr5" value="online" checked="checked">在线支付
                </label>
 <?php if($output['store_count'] == 0 ){ ?>
                <label class="mt5" id="online">
                    <input type="radio" name="buy-type" class="mr5" value="bank">银行转账
                </label>
 <?php } ?>
                <?php if($output['ifshow_offpay']){ ?>
                <label class="mt5" id="offline">
                    <input type="radio" name="buy-type" class="mr5" value="offline" >货到付款
                </label>
                <?php } ?>
            </li>
        </ul>
    </div>
    <div class="buys1-cnt buys1-invoice-cnt" style="display: none">
        <h3 class="clearfix">发票信息 <span class="btn-s btn-prink-s buys1-edit-invoice buys1-edit-btn fright">修改</span></h3>
        <ul class="buys-ycnt buys1-hide-detail">
            <li class="clearfix">
                <div class="value fleft" id="inv_content"><?php echo $output['inv_info']['content'];?></div>
            </li>
        </ul>
        <ul class="buys1-hide-list buys-ycnt hide">
            <li id="invoice_add">
                <label class="new-invoice clr-d94">
                    <input type="radio" name="invoice" value="0" class="inv-radio"/>
                    使用新的发票信息
                </label>
                <div class="invoice-addcnt">
                    <div class="iadd-title">发票抬头：</div>
                    <div class="iadd-item">
                        <label>
                            <input type="radio" checked="checked" name="inv_title_select" class="mr5" value="person" >个人
                        </label>
                        <label class="mt5">
                            <input type="radio" name="inv_title_select" class="mr5 inv-tlt-sle" value="company">
                            <span class="mr5">企业</span>
                            <input type="text" class="input-30 head-invoice" name="inv_title">
                        </label>
                    </div>
                    <div class="iadd-title">
                        发票内容：
                    </div>
                    <p class="iadd-cnt">
                        <select class="select-30" id="inc_content" name='inv_content'>
                            <?php foreach($output['invoice_content_list'] as $k=>$v){ ?>
                                <option value="<?php echo $v?>"><?php echo $v?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
            </li>
            <li class="invoice_opeara">
                <a href="javascript:void(0);" class="btn-prink save-invoice">保存发票信息</a>
                <a href="javascript:void(0);" class="btn-white no-invoice">不需要发票</a>
            </li>
        </ul>
    </div>
    <style>
        .huodong { color: #FFF; background-color: #FD6760; padding: 1px 4px;}
    </style>
    <div class="buys1-cnt">
        <h3 class="clearfix">商品清单<!--  <span class="btn-s btn-prink-s fright" onclick="javascript:history.go(-1);">去购物车</span> --> </h3>
        <ul class="buys-ytable mt10" id="goodslist_before">
            <?php
            $i = 1;
            $totalprice = 0;
            foreach($output['store_cart_list'] as $store_id=>$cart_list){ ?>
                <?php echo ($i==1)?'<li>':'<li class="bd-t-cc">';$i++;?>
                <p class="buys-yt-tlt">
                    店铺名称：<?php echo $cart_list[0]['store_name']; ?><span data-store_id="<?php echo $store_id;?>" class="store-cod-supported">
					<?php if($output['ifshow_offpay']){ ?>（支持货到付款）<?php } else{  ?><!--（不支持货到付款）--><?php } ?>
                </p>
                <?php
                $j=1;
                foreach($cart_list as $k=>$goods){ ?>
                    <?php echo ($j==1)?'<div class="buys1-pdlist">':'<div class="buys1-pdlist bd-t-de">';$j++;?>
                    <div class="clearfix">
                        <a class="img-wp" href="<?php echo urlWap('goods','index',array('goods_id'=>$goods['goods_id']))?>"><img src="<?php echo $goods['goods_image_url']?>"></a>
                        <div class="buys1-pdlcnt">
                            <p>
                                <a class="buys1-pdlc-name" href="<?php echo urlWap('goods','index',array('goods_id'=>$goods['goods_id']))?>"><?php echo $goods['goods_name']?></a>
                            </p>

                                <?php if (!empty($goods['xianshi_info'])) {?>
                            <p><span class="huodong">满<strong><?php echo $goods['xianshi_info']['lower_limit'];?></strong>件，单价直降<em>￥<?php echo $goods['xianshi_info']['down_price']; ?></em></span></p>
                                <?php }?>
                                <?php if ($goods['ifgroupbuy']) {?>
                            <p><span class="huodong">藏品惠</span></p>
                                <?php }?>
                            <!-- add 秒杀模块 xin -->
                            <?php if ($goods['ifmiaosha']) {?>
                            <p><span class="huodong">秒杀</span></p>
                            <?php }?>
                            <!-- add 会员特价模块 xin -->
                            <?php if ($goods['ifvipsale']) {?>
                            <p><span class="huodong">会员特价</span></p>
                            <?php }?>
                            <!-- add end -->
                            <!-- add 满即送 xin -->
                            <?php if ($goods['manjisong']) {?>
                            <p><span class="huodong">满即送活动商品</span></p>
                            <?php }?>
                            <!-- add end -->
                            <?php if ($goods['bl_id'] != '0') {?>
                            <p><span class="huodong">优惠套装，单套直降<em>￥<?php echo $goods['down_price']; ?></em></span></p>
                            <?php if (!empty($goods['bl_goods_list'])) { ?>
                                <?php foreach ($goods['bl_goods_list'] as $goods_info) { ?>
                            <p><span class="huodong">套装商品</span>
                                    <a href="<?php echo urlWap('goods','index',array('goods_id'=>$goods_info['bl_goods_id']));?>" title="套装：<?php echo $goods_info['goods_name']; ?>"><img src="<?php echo cthumb($goods_info['goods_image'],60,$store_id);?>" height="20px"/><?php echo $goods_info['goods_name']?> </a>
                                <?php } ?>
                            <?php }?>
                             <?php  } ?>
                            </p>
                            <?php if (!empty($goods['gift_list'])) { ?>
                                <p><span class="huodong">赠</span>
                                        <?php foreach ($goods['gift_list'] as $goods_info) { ?>
                                            <a href="<?php echo urlWap('goods','index',array('goods_id'=>$goods_info['gift_goodsid']));?>" title="赠品：<?php echo $goods_info['gift_goodsname']; ?> * <?php echo $goods_info['gift_amount'] * $goods['goods_num']; ?>"><img src="<?php echo cthumb($goods_info['gift_goodsimage'],60,$store_id);?>" height="20px"/> * <?php echo $goods_info['gift_amount'] * $goods['goods_num']; ?></a>
                                        <?php } ?>
                                </p>
                            <?php  } ?>
                            <p>
                                单价：￥<?php echo $goods['goods_price']?>
                            </p>
                            <p>
                                数量：<?php echo $goods['goods_num']?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!-- 满即送商品 -->
                <?php if(!empty($output['store_premiums_list'][$store_id])){?>
                    <?php foreach($output['store_premiums_list'][$store_id] as $k=>$zengpin){ ?>
                <div class="buys1-pdlist bd-t-de">
                    <div class="clearfix">
                        <a class="img-wp" href="<?php echo urlWap('goods','index',array('goods_id'=>$zengpin['goods_id']))?>"><img src="<?php echo $zengpin['goods_image_url']?>"></a>
                        <div class="buys1-pdlcnt">
                            <p>
                                <a class="buys1-pdlc-name" href="<?php echo urlWap('goods','index',array('goods_id'=>$zengpin['goods_id']))?>"><?php echo $zengpin['goods_name']?></a>
                            </p>
                            <p><span class="huodong">满即送赠品</span></p>
                            <p></p>
                            <p>数量：<?php echo $zengpin['goods_num']?></p>
                        </div>
                    </div>
                </div>
                    <?php } ?>
                <?php } ?>

                <div class="shop-total">
                    <p>
                        <?php if (!empty($output['cancel_calc_sid_list'][$store_id])) {?>
                            <em><?php echo '(店铺活动:'.$output['cancel_calc_sid_list'][$store_id]['desc'].')';?>
                        <?php } ?><span id="storeYunFei<?php echo $store_id;?>"></span><span id="store<?php echo $store_id;?>"></span>
                    </p>
                    <p class="huodaofu hide">
                        <span <?php echo ($output['offpay_store'][$store_id] == 1)?'':'class="hide"';?>>
                        货到付款手续费：￥<span id="sxf<?php echo $store_id;?>" pay_fee="<?php echo $output['pay_fee'][$store_id];?>"><?php echo number_format($output['pay_fee'][$store_id],2);?></span>
                        </span>
                    </p>
                    <?php if (!empty($output['store_mansong_rule_list'][$store_id])) {
                        $rule = $output['store_mansong_rule_list'][$store_id];
                        ?>
                    <p>
                        满即送-<?php echo $rule['desc'];?>
                        :
                        <?php if(!empty($rule['discount'])) { ?>
                            -<?php echo $rule['discount'];?>
                        <?php } ?>
                    </p>
                    <?php } ?>

                    <?php if (!empty($output['store_voucher_list'][$store_id]) && is_array($output['store_voucher_list'][$store_id])) {?>
                    <p>
                        <select name="voucher" store_id="<?php echo $store_id;?>">
                            <option value="0">选择店铺优惠券</option>
                            <?php foreach ($output['store_voucher_list'][$store_id] as $voucher) {?>
                            <option value="<?php echo $voucher['voucher_t_id'];?>|<?php echo $store_id;?>|<?php echo $voucher['voucher_price'];?>"><?php echo $voucher['voucher_title']?></option>
                            <?php } ?>
                        </select>
                        :￥-<span id="sv<?php echo $store_id;?>">0.00</span>
                    </p>
                    <?php } ?>
                    <p class="clr-c07">
                        <?php $shop_conunt = $output['store_goods_total'][$store_id] - $output['store_mansong_rule_list'][$store_id]['discount']?>
                        本店合计：￥<span id="st<?php echo $store_id;?>" store_price="<?php echo $shop_conunt;?>" class="store_total"><?php $totalprice+=$shop_conunt;echo $shop_conunt;?></span>
                    </p>
                </div>
            </li>
            <?php } ?>

    <!-- 平台优惠券 -->
    <?php if (!empty($output['pingtai_voucher_list']) && is_array($output['pingtai_voucher_list'])) {?>
            <li id="pingtai_voucher">
                <div class="pre-deposit-wp">
                    <p class="clearfix">
                        <label>
                            <select nctype="voucher_pingtai" name="voucher_pingtai">
                                <option value="0|0|0.00">选择平台优惠券</option>
                                <?php foreach ($output['pingtai_voucher_list'] as $voucher) {?>
                                    <option value="<?php echo $voucher['voucher_id'];?>|<?php echo $voucher['voucher_t_id'];?>|<?php echo $voucher['voucher_price'];?>"><?php echo $voucher['voucher_title'];?></option>
                                <?php } ?>
                            </select>
                        </label>
                        ：￥<span id="PingtaiVoucher">0.00</span>
                    </p>
                    <p class="clearfix">注：平台优惠券与店铺优惠券不可以同时使用！</p>

                </div>
            </li>
    <?php } ?>

            <li id="deposit">
                <div class="pre-deposit-wp hide">
                    <p class="clearfix hide" id="wrapper-usercbpay">
                        <label>
                            <input type="checkbox" class="mr5" id="usercbpay" />使用充值卡支付
                        </label>
                        (充值卡余额为<span class="pre-doposit-money clr-d94">￥<span id="available_rc_balance"><?php echo $output['available_rcb_amount']?></span></span>)
                    </p>
                    <p class="clearfix hide" id="wrapper-usepdpy">
                        <label>
                            <input type="checkbox" class="mr5" id="usepdpy" />使用预存款支付
                        </label>
                        (可用金额为<span class="pre-doposit-money clr-d94">￥<span id="available_predeposit"><?php echo $output['available_pd_amount']?></span></span>)
                    </p>

                    <div id="pd" class="hide">
                        <p class="clearfix">
                            支付密码：<input type="password" class="mr5 h22" name="loginpassword" id="loginpassword" />
                        </p>
                        <p class="password_error_tip" style="display:none;color:red;"></p>
                        <p>
                            <span class="btn-s btn-yello-s" id="pguse">使用</span>
                        </p>
                    </div>
                </div>
            </li>

        </ul>
    </div>
<!-- total -->
<div class="total-boxes">
    <div class="total">订单总金额：￥<span id="total_price"><?php echo $totalprice;?></span></div>
    <div class="total-ok"><a href="javascript:void(0);" id="buy_step2">提交订单</a></div>
</div>

<div id="footer"></div>
<input type="hidden" name="address_id" value="<?php echo $output['address_info']['address_id'];?>">
<input type="hidden" name="area_id" value="<?php echo $output['address_info']['area_id'];?>">
<input type="hidden" name="city_id" value="<?php echo $output['address_info']['city_id'];?>">
<input type="hidden" name="freight_hash" value="<?php echo $output['freight_hash'];?>">
<input type="hidden" name="vat_hash" value="<?php echo $output['vat_hash'];?>">
<input type="hidden" name="allow_offpay" value="<?php echo $output['ifshow_offpay'];?>">
<input type="hidden" name="offpay_hash">
<input type="hidden" name="offpay_hash_batch">
<input type="hidden" name="invoice_id" value="<?php echo $output['inv_info']['inv_id'];?>">
<input type="hidden" name="passwd_verify" value="0">
<input type="hidden" name="total_price" value="<?php echo $totalprice;?>">
<input type="hidden" name="available_rc_balance" value="<?php echo $output['available_rcb_amount']?>">
<input type="hidden" name="available_predeposit" value="<?php echo $output['available_pd_amount']?>">
<script>
    $(function() {
        var ifcart = '<?php echo $output['ifcart'];?>';
        var cart_id = '<?php echo $output['cart_id'];?>';

        <?php if(empty($output['address_info']) || !is_array($output['address_info'])){ ?>
        var thisPrarent = $(".buys1-address-cnt");
        hideDetail(thisPrarent);
        <?php } ?>

        <?php if(!empty($output['available_rcb_amount']) && $output['available_rcb_amount'] >0){ ?>
            $('.pre-deposit-wp').show();
            $('#wrapper-usercbpay').show();
        <?php } ?>

        <?php if(!empty($output['available_pd_amount']) && $output['available_pd_amount'] >0){ ?>
            $('.pre-deposit-wp').show();
            $('#wrapper-usepdpy').show();
        <?php } ?>


        function showDetial(parent){
            $(parent).find(".buys1-edit-btn").show();
            $(parent).find(".buys1-hide-list").addClass("hide");
            $(parent).find(".buys1-hide-detail").removeClass("hide");
        }
        function hideDetail(parent){
            $(parent).find(".buys1-edit-btn").hide();
            $(parent).find(".buys1-hide-list").removeClass("hide");
            $(parent).find(".buys1-hide-detail").addClass("hide");
        }

        var area_id = $('input[name=area_id]').val();
        var city_id = $('input[name=city_id]').val();
        var freight_hash = $('input[name=freight_hash]').val();

        $.ajax({//保存地址
            type:'post',
            url:"<?php echo urlWap('member_buy','change_address')?>",
            data:{area_id:area_id,city_id:city_id,freight_hash:freight_hash},
            dataType:'json',
            success:function(result){
                if(result.datas.state == 'success'){
                    $.each(result.datas.content,function(k,v){
                        v = pf(v);
						$('#storeYunFei'+k).html("运费：￥");
                        $('#store'+k).html(p2f(v));
                    });

                    $('input[name=offpay_hash]').val(result.datas.offpay_hash);
                    $('input[name=offpay_hash_batch]').val(result.datas.offpay_hash_batch);

                    count_amount();//计算总金额
                    //$('input[name=total_price]').val(total_price);

                    //cod.stateUpdateded(result.datas.allow_offpay, result.datas.allow_offpay_batch);

                    //$('input[name=allow_offpay]').val(result.datas.allow_offpay);
                    //$('input[name=offpay_hash]').val(result.datas.offpay_hash);
                    //$('input[name=offpay_hash_batch]').val(result.datas.offpay_hash_batch);
                }
            }
        });

        //获取区域列表
        $.ajax({
            type:'post',
            url:"<?php echo urlWap('member_address','area_list')?>",
            data:'',
            dataType:'json',
            success:function(result){
                var data = result.datas;
                var prov_html = '';
                for(var i=0;i<data.area_list.length;i++){
                    prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                }
                $("select[name=prov]").append(prov_html);
            }
        });

        var pf = function(f) {
            return parseFloat(f) || 0;
        };

        var p2f = function(f) {
            return (parseFloat(f) || 0).toFixed(2);
        };

        var isEmpty = function(o) {
            var b = true;
            $.each(o, function(k, v) {
                b = false;
                return false;
            });
            return b;
        }

        $('#usepdpy,#usercbpay').click(function(){//验证密码切换
            if($('#usepdpy').is(':checked') || $('#usercbpay').is(':checked')){
                $('#pd').show();
            }else{
                $('#pd').hide();
            }
        });


        // 点击使用新地址才显示新地址编辑框
        $('#new-address-button').click(function() {
            $('#new-address-wrapper').show();
        });

        //修改收获地址
        $(".buys1-edit-address").click(function(){
            var self = this;
            $.ajax({
                url:"<?php echo urlWap('member_address','address_list')?>",
                type:'post',
                data:'',
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var html = '';
                    for(var i=0;i<data.address_list.length;i++){
                        html+='<li class="current existent-address">'
                        +'<label>'
                        +'<input type="radio" name="address" class="rdo address-radio" value="'+data.address_list[i].address_id+'" city_id="'+data.address_list[i].city_id+'" area_id="'+data.address_list[i].area_id+'" />'
                        +'<span class="mr5 rdo-span"><span class="true_name_'+data.address_list[i].address_id+'">'+data.address_list[i].true_name+'</span> <span class="address_id_'+data.address_list[i].address_id+'">'+data.address_list[i].area_info+' '+data.address_list[i].address+'</span> <span class="mob_phone_'+data.address_list[i].address_id+'">'+data.address_list[i].mob_phone+'</span></span>'
                        +'</label>'
                        +'<a class="del-address" href="javascript:void(0);" address_id="'+data.address_list[i].address_id+'">[删除]</a>'
                        +'</li>';
                    }
                    $('li.existent-address').remove();
                    $('#addresslist').before(html);

                    // 点击已有地址 隐藏新地址输入框
                    $('li.existent-address input').click(function() {
                        $('#new-address-wrapper').hide();
                    });

                    $('.del-address').click(function(){
                        var $this = $(this);
                        var address_id = $(this).attr('address_id');
                        $.ajax({
                            type:'post',
                            url:"<?php echo urlWap('member_address','address_del')?>",
                            data:{address_id:address_id},
                            dataType:'json',
                            success:function(result){
                                $this.parent('li').remove();
                            }
                        });
                    });

                    $('input[name=address]').click(function() {
                        var city_id = $(this).attr('city_id');
                        var area_id = $(this).attr('area_id');

                        $('input[name=city_id]').val(city_id);
                        $('input[name=area_id]').val(area_id);
                    });
                }
            });
            var thisPrarent = $(this).parents(".buys1-address-cnt");
            hideDetail(thisPrarent);
        });


        $("select[name=prov]").change(function(){//选择省市
            var prov_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:prov_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var city_html = '<option value="">请选择...</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=city]").html(city_html);
                    $("select[name=region]").html('<option value="">请选择...</option>');
                }
            });
        });

        $("select[name=city]").change(function(){//选择城市
            var city_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:city_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">请选择...</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                }
            });
        });

        $(".save-address").click(function (){//更换收获地址
            var self = this;
            //获取address_id
            var addressRadio = $('.address-radio');
            var address_id;
            for(var i =0;i<addressRadio.length;i++){
                if(addressRadio[i].checked){
                    address_id = addressRadio[i].value;
                }
            }

            if(address_id>0){//变更地址
                var area_id = $("input[name=area_id]").val();
                var city_id = $("input[name=city_id]").val();
                var freight_hash = $("input[name=freight_hash]").val();
                $.ajax({
                    type:'post',
                    url:"<?php echo urlWap('member_buy','change_address')?>",
                    data:{area_id:area_id,city_id:city_id,freight_hash:freight_hash},
                    dataType:'json',
                    success:function(result){
                        var data = result.datas;
                        var sp_s_total = 0;
                        $.each(data.content,function(k,v){
                            v = pf(v);
							$('#storeYunFei'+k).html("运费：￥");
                            $('#store'+k).html(p2f(v));
                        });

                        $("input[name=address_id]").val(address_id);
                        $('#address').html($('.address_id_'+address_id).html());
                        $('#true_name').html($('.true_name_'+address_id).html());
                        $('#mob_phone').html($('.mob_phone_'+address_id).html());

                        $('input[name=offpay_hash]').val(data.offpay_hash);
                        $('input[name=offpay_hash_batch]').val(data.offpay_hash_batch);

                        count_amount();//计算总金额
                        return false;
                    }
                });
            }else{//保存地址
                    var index = $('select[name=prov]')[0].selectedIndex;
                    var aa = $('select[name=prov]')[0].options[index].innerHTML;


                    var true_name = $('input[name=true_name]').val();
                    var mob_phone = $('input[name=mob_phone]').val();
                    var tel_phone = $('input[name=tel_phone]').val();
                    var city_id = $('select[name=city]').val();
                    var area_id = $('select[name=region]').val();
                    var address = $('input[name=vaddress]').val();
                if(true_name == ''){
                    alert('姓名必填');
                    return false;
                }
                if(mob_phone == ''){
                    alert('手机号码必填');
                    return false;
                }
                if(area_id == ''){
                    alert('请选择省市区');
                    return false;
                }
                if(address == ''){
                    alert('街道地址必填');
                    return false;
                }

                    var prov_index = $('select[name=prov]')[0].selectedIndex;
                    var city_index = $('select[name=city]')[0].selectedIndex;
                    var region_index = $('select[name=region]')[0].selectedIndex;
                    var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;

                    //ajax 提交收货地址
                    $.ajax({
                        type:'post',
                        url:"<?php echo urlWap('member_address','address_add')?>",
                        data:{true_name:true_name,mob_phone:mob_phone,tel_phone:tel_phone,city_id:city_id,area_id:area_id,address:address,area_info:area_info},
                        dataType:'json',
                        success:function(result){
                            if(result){
                                $.ajax({//获取收货地址信息
                                    type:'post',
                                    url:"<?php echo urlWap('member_address','address_info')?>",
                                    data:{address_id:result.datas.address_id},
                                    dataType:'json',
                                    success:function(result1){
                                        var data1 = result1.datas;
                                        $('#true_name').html(data1.address_info.true_name);
                                        $('#address').html(data1.address_info.area_info+' '+data1.address_info.address);
                                        $('#mob_phone').html(data1.address_info.mob_phone);

                                        $('input[name=address_id]').val(data1.address_info.address_id);
                                        $('input[name=area_id]').val(data1.address_info.area_id);
                                        $('input[name=city_id]').val(data1.address_info.city_id);

                                        var area_id = data1.address_info.area_id;
                                        var city_id = data1.address_info.city_id;
                                        var freight_hash = $('input[name=freight_hash]').val();

                                        $.ajax({//保存收货地址
                                            type:'post',
                                            url:"<?php echo urlWap('member_buy','change_address')?>",
                                            data:{area_id:area_id,city_id:city_id,freight_hash:freight_hash},
                                            dataType:'json',
                                            success:function(result){
                                                var data = result.datas;
                                                var sp_s_total = 0;
                                                $.each(result.datas.content,function(k,v){
                                                    v = pf(v);
													$('#storeYunFei'+k).html("运费：￥");
                                                    $('#store'+k).html(p2f(v));
                                                });

                                                $('input[name=offpay_hash]').val(data.offpay_hash);
                                                $('input[name=offpay_hash_batch]').val(data.offpay_hash_batch);

                                                count_amount();
                                                //cod.stateUpdateded(data.allow_offpay, data.allow_offpay_batch);

                                                //$('input[name=allow_offpay]').val(data.allow_offpay);


                                                return false;
                                            }
                                        });
                                    }
                                });
                            }
                        }
                    });
            }

            var thisPrarent = $(this).parents(".buys1-address-cnt");
            showDetial(thisPrarent);
        });



        $('select[name=voucher]').change(function(){//选择代金券
            var store_id = $(this).attr('store_id');
            var varr = $(this).val();
            if(varr == 0){
                var store_price = 0;
            }else{
                var store_price = pf(varr.split('|')[2]);
            }
            $("#sv"+store_id).html(p2f(store_price));


            var vouchereachTotal = 0;
            $('.store-cod-supported').each(function() {
                var k = $(this).attr('data-store_id');//获取店铺id
                vouchereachTotal += pf($('#sv'+k).html()); //优惠券

            });

            if(vouchereachTotal != 0){
                $('select[name="voucher_pingtai"]').attr('disabled','disabled');
            }else{
                $('select[name="voucher_pingtai"]').removeAttr('disabled');
            }

            count_amount();
        });

        $('select[name="voucher_pingtai"]').on('change',function(){
                var items = $(this).val().split('|');
                $('#PingtaiVoucher').html('-'+p2f(items[2],2));
                if(p2f(items[2],2) != 0){
                    $('select[name="voucher"]').attr('disabled','disabled');
                }else{
                    $('select[name="voucher"]').removeAttr('disabled');
                }

            count_amount();
        });

        //点击修改发票
        $(".buys1-edit-invoice").click(function(){
            var self = this;

            var thisPrarent = $(this).parents(".buys1-invoice-cnt");
            hideDetail(thisPrarent);
        });

        //保存发票信息
        $(".save-invoice").click(function (){
            var self = this;
            //获取address_id
            var invRadio = $('.inv-radio');
            var inv_id;
            for(var i =0;i<invRadio.length;i++){
                if(invRadio[i].checked){
                    inv_id = invRadio[i].value;
                }
            }

            if(inv_id>0){//选择发票信息
                var inv_info = $('#inv_'+inv_id).html();
                $('#inv_content').html(inv_info);//发票信息
                $("input[name=invoice_id]").val(inv_id);
            }else{//添加发票信息
                var invtRadio = $('input[name=inv_title_select]');
                var inv_title_select;
                for(var i =0;i<invtRadio.length;i++){
                    if(invtRadio[i].checked){
                        inv_title_select = invtRadio[i].value;
                    }
                }

                var inv_content = $('select[name=inv_content]').val();
                if(inv_title_select == 'company'){
                    var inv_title = $("input[name=inv_title]").val();
                    var data = {inv_title_select:inv_title_select,inv_title:inv_title,inv_content:inv_content};
                    var html = '公司  ';
                }else{
                    var data = {inv_title_select:inv_title_select,inv_content:inv_content};
                    var html = '个人  ';
                }
                $.ajax({
                    type:'post',
                    url:"<?php echo urlWap('member_invoice','invoice_add')?>",
                    data:data,
                    dataType:'json',
                    success:function(result){
                        if(result.datas.inv_id>0){
                            var html1 = '<li>'
                                +'<label>'
                                +'<input type="radio" name="invoice" class="rdo inv-radio" checked="checked" value="'+result.datas.inv_id+'"/>'
                                +'<span class="mr5 rdo-span" id="inv_'+result.datas.inv_id+'">'+html+'&nbsp;&nbsp;'+inv_content+'</span>'
                                +'</label>'
                                +'<a class="del-invoice" href="javascript:void(0);" inv_id="'+result.datas.inv_id+'">[删除]</a>'
                                +'</li>';

                            $('#invoice_add').before(html1);
                            $('#inv_content').html(html+inv_content);//发票信息
                            $('input[name=invoice_id]').val(result.datas.inv_id);


                            $('.del-invoice').click(function(){
                                var $this = $(this);
                                var inv_id = $(this).attr('inv_id');
                                $.ajax({
                                    type:'post',
                                    url:"<?php echo urlWap('member_invoice','invoice_del')?>",
                                    data:{inv_id:inv_id},
                                    success:function(result){
                                        if(result){
                                            $this.parent('li').remove();
                                        }
                                        return false;
                                    }
                                });
                            });
                        }
                    }
                });

            }

            var thisPrarent = $(this).parents(".buys1-invoice-cnt");
            showDetial(thisPrarent);
        });

        //点击不需要发票
        $(".no-invoice").click(function (){
            $('#inv_content').html("不需要发票");
            $('input[name=invoice_id]').val('');
            var thisPrarent = $(this).parents(".buys1-invoice-cnt");
            showDetial(thisPrarent);
        });

        //修改支付方式
        $("input[name='buy-type']").click(function(){
            if($(this).val() == 'offline'){
                $('.huodaofu').show();
            }else{
                $('.huodaofu').hide();
            }
            count_amount();
        });


        //统计总金额
        var count_amount = function(){
            var type = $("input[name='buy-type']:checked").val();
            var sp_s_total = 0;
            $('.store-cod-supported').each(function() {
                var k = $(this).attr('data-store_id');//获取店铺id
                var sp_toal = pf($('#st'+k).attr('store_price'));//店铺商品价格
                var sp_store = pf($('#store'+k).html());//店铺运费
                if(type == 'offline'){
                    var payfee = pf($('#sxf'+k).attr('pay_fee'));
                }else{
                    var payfee = 0;
                }
                var sv = pf($('#sv'+k).html()); //优惠券

                var store_total = p2f(sp_toal + sp_store + payfee - sv);
                sp_s_total += pf(store_total);
                $('#st'+k).html(pf(store_total));
            });
            var total_price = sp_s_total;

            total_price += pf($('#PingtaiVoucher').html());

            $('#total_price').html(p2f(total_price));
        }

        $('#pguse').click(function(){//验证密码
            var loginpassword = $("input[name=loginpassword]").val();
            if(loginpassword == ''){
                $('.password_error_tip').show();
                $('.password_error_tip').html('支付密码不能为空');
                return false;
            }
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_buy','check_password')?>",
                data:{password:loginpassword},
                dataType:'json',
                success:function(result){
                    if(result.datas == 1){
                        $('input[name=passwd_verify]').val('1');
                        $('#pd').hide();
                    }else{
                        $('#pd').show();
                        $('.password_error_tip').show();
                        $('.password_error_tip').html(result.datas.error);
                    }
                }
            });
        });

        $('#buy_step2').click(function(){//提交订单step2
            var data = {};

            if(ifcart == 1){//购物车订单
                data.ifcart = ifcart;
            }
            data.cart_id = cart_id;

            var address_id = $('input[name=address_id]').val();
            if(address_id < 1){
                alert('请选择收货地址');return false;
            }
            data.address_id = address_id;

            var vat_hash = $('input[name=vat_hash]').val();
            data.vat_hash = vat_hash;

            var offpay_hash = $('input[name=offpay_hash]').val();
            data.offpay_hash = offpay_hash;

            var offpay_hash_batch = $('input[name=offpay_hash_batch]').val();
            data.offpay_hash_batch = offpay_hash_batch;

            //获取address_id
            var payRadio = $('input[name=buy-type]');
            var pay_name;
            for(var i =0;i<payRadio.length;i++){
                if(payRadio[i].checked){
                    pay_name = payRadio[i].value;
                }
            }
            data.pay_name = pay_name;

            var invoice_id = $('input[name=invoice_id]').val();
            data.invoice_id = invoice_id;

            /*
             var voucher = new Array();
             $("select[name=voucher]").each(function(){
             var store_id = $(this).attr('store_id');
             voucher[store_id] = $(this).val();
             });
             data.voucher = voucher;
             */

            var voucher = [];
            $("select[name=voucher]").each(function() {
                var v = $(this).val();
                if (v) {
                    voucher.push(v);
                }
                // console.log(v);
            });
            data.voucher = voucher.join(',');
            // console.log(data.voucher);return;

            var voucher_pingtai = $('select[name=voucher_pingtai]').val();
            data.voucher_pingtai = voucher_pingtai;

            data.rcb_pay = 0;
            var available_rc_balance = parseInt($('input[name=available_rc_balance]').val());
            if (available_rc_balance > 0 && $('#usercbpay').prop('checked')) { // 使用充值卡
                var passwd_verify = parseInt($('input[name=passwd_verify]').val());
                if (passwd_verify != 1) { // 验证密码失败
                    return false;
                }
                data.rcb_pay = 1;
                data.password = $('input[name=loginpassword]').val();
            }

            var available_predeposit = parseInt($('input[name=available_predeposit]').val());
            if(available_predeposit>0){
                if($('#usepdpy').prop('checked')){//使用预存款
                    var passwd_verify = parseInt($('input[name=passwd_verify]').val());
                    if(passwd_verify != 1){//验证密码失败
                        return false;
                    }

                    var pd_pay = 1;
                    data.pd_pay = pd_pay;
                    var passwd = $('input[name=loginpassword]').val();
                    data.password = passwd;
                }else{
                    var pd_pay = 0;
                    data.pd_pay = pd_pay;
                }
            }else{
                var pd_pay = 0;
                data.pd_pay = pd_pay;
            }


            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_buy','buy_step2')?>",
                data:data,
                dataType:'json',
                success:function(result){

                    //return false;
                    //if(result.datas.error != ''){
                    //return false;
                    //}

                    if (result.datas.error) {
                        alert(result.datas.error);
                        return false;
                    }

                    if(result.datas.pay_sn != ''){
                        location.href = "<?php echo urlWap('member_buy','pay',array('pay_sn'=>''))?>" + result.datas.pay_sn;
                    }
                    return false;
                }
            });
        });

    });
</script>