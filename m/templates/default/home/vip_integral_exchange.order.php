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
                <div class="value fleft" id="true_name"><?php echo $output['address_info']['0']['true_name']?></div>
            </li>
            <li class="clearfix">
                <span class="key fleft">详细地址：</span>
                <div class="value fleft" id="address"><?php echo $output['address_info']['0']['area_info'].' '.$output['address_info']['0']['address']?></div>
            </li>
            <li class="clearfix">
                <span class="key fleft">联系电话：</span>
                <div class="value fleft" id="mob_phone"><?php echo $output['address_info']['0']['mob_phone']?></div>
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


    <style>
        .huodong { color: #FFF; background-color: #FD6760; padding: 1px 4px;}
    </style>

<div class="buys1-cnt">
        <h3 class="clearfix">兑换商品信息<!--  <span class="btn-s btn-prink-s fright" onclick="javascript:history.go(-1);">去购物车</span> --> </h3>
        <ul class="buys-ytable mt10" id="goodslist_before">
            <li>
                <div class="buys1-pdlist">
                    <div class="clearfix">
                        <a class="img-wp" href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$output['pointprod_arr']['pointprod_list']['0']['pgoods_id']))?>"><img src="<?php echo $output['pointprod_arr']['pointprod_list']['0']['pgoods_image'];?>"></a>
                        <div class="buys1-pdlcnt">
                            <p>
                                <a class="buys1-pdlc-name" href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$output['pointprod_arr']['pointprod_list']['0']['pgoods_id']))?>"><?php echo $output['pointprod_arr']['pointprod_list']['0']['pgoods_name'];?></a>
                            </p>
                            <p>
                                积分：<?php echo $output['pointprod_arr']['pointprod_list']['0']['pgoods_points'];?>
                            </p>
                            <p>
                                数量：1
                            </p>
                        </div>
                    </div>
                </div>
                <div class="shop-total">
                    <p>
                        所需总积分：<span id="store3"><?php echo $output['pointprod_arr']['pointprod_list']['0']['pgoods_points'];?></span>
                    </p>

                </div>
            </li>


            <li>
                <a href="javascript:void(0);" class="post-order" id="buy_step2">确定兑换</a>
            </li>
        </ul>
    </div>

<!-- total -->


<div id="footer"></div>

<form id="form1" action="<?php echo urlWap('vip','integral_add_order');?>" method="POST">
<input type="hidden" name="address_id" value="<?php echo $output['address_info']['0']['address_id'];?>">

<input type="hidden" name="pgid" value="<?php echo $output['pointprod_arr']['pointprod_list']['0']['pgoods_id'];?>">

</form>
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

            $("input[name=address_id]").val(address_id);
            $('#address').html($('.address_id_'+address_id).html());
            $('#true_name').html($('.true_name_'+address_id).html());
            $('#mob_phone').html($('.mob_phone_'+address_id).html());


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




        $('#buy_step2').click(function(){//提交订单step2
 
            $("#form1").submit();


        });

    });
</script>