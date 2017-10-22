<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<form action="<?php echo urlWap('member_ress','ress_info');?>" method="POST" id="login_form">
<div class="address-opera">
        <div class="address-ocnt">

            <input type="hidden" name="address" value='<?php echo $output['address_info']['address']?>'>
            
            <div class="address-octlt">收货人信息</div>
            <p>姓名：<span class="opera-tips">(*必填)</span></p>
            <p>
                <input type="text" class="input-30" id="true_name" name="true_name" value="<?php echo $output['address_info']['true_name']?>"/>
            </p>
            <p>手机号码：<span class="opera-tips">(*必填)</span></p>
            <p>
                <input type="text" class="input-30" id="mob_phone" name="mob_phone" value="<?php echo $output['address_info']['mob_phone']?>"/>
            </p>
            <p>电话号码：</p>
            <p>
                <input type="text" class="input-30" name="tel_phone" value="<?php echo $output['address_info']['tel_phone']?>"/>
            </p>
            <div class="address-octlt">地址信息</div>
            <p><span id="detailaddr" class="mr5"><?php echo $output['address_info']['area_info']?></span></p>
            <p class="detail-d-addr"><?php echo $output['address_info']['address']?></p>
            <p><a href="javascript:;" class="btn-s btn-prink-s" id="editaddress">编辑</a><input type="hidden" name="modifyaddr" value="1"></p>
            <div id="area" style="display:none;">
                <p>省份：<span class="opera-tips">(*必填)</span></p>
                <div class="new-select-wp" id="prov">
                    <select class="select-30" id="prov_select" name="prov">
                        <option value="">请选择...</option>
                        <?php if($output['prov']){?>

                        <?php foreach($output['prov']['area_list'] as $k => $v){?>
                            <option value="<?php echo $v['area_id'];?>"><?php echo $v['area_name'];?></option>
                        <?php }?>

                        <?php }?>
                    </select>   
                </div>
                <p>城市：<span class="opera-tips">(*必填)</span></p>
                <div class="new-select-wp" id="city">
                    <select class="select-30" id="city_select" name="city">
                        <option value="">请选择...</option>
                    </select>               
                </div>
                <p>区县：<span class="opera-tips">(*必填)</span></p>
                <div class="new-select-wp" id="region">
                    <select class="select-30" id="region_select" name="region">
                        <option value="">请选择...</option>
                    </select>
                </div>
                <p>街道：<span class="opera-tips">(*必填)</span></p>
                <p>
                    <input type="text" class="input-30" id="address" name="address">
                </p>
            </div>
        </div>
        <input type="hidden" name="area_id" value='<?php echo $output['address_info']['area_id']?>'>
        <input type="hidden" name="city_id" value='<?php echo $output['address_info']['city_id']?>'>
        
        <input type="hidden" name="address_id" value='<?php echo $output['address_info']['address_id']?>'>
        <div class="error-tips"></div>
        <input type="hidden" name="area_info" value='<?php echo $output['address_info']['area_info']?>'>
        <input type="hidden" name="form_submit" value='ok'>
        <input type="submit" class="add_address mt10" value="保存地址">
    </div>
</form>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
    $(function(){
        $('#editaddress').click(function() {
            if ($('input[name=modifyaddr]').val() == '1') {
                $('input[name=modifyaddr]').val(2);
                $('#area').show();
            } else {
                $('input[name=modifyaddr]').val(1);
                $('#area').hide();
            }
        });



        if ($('input[name=modifyaddr]').val() == '2') {


            $("#login_form").validate({
                errorElement: "p",
                errorPlacement: function(error, element){
                error.appendTo($(".error-tips").show());
                },
                rules: {
                    true_name: "required",
                    mob_phone: "required",
                    prov: "required",
                    city: "required",
                    region: "required",
                    address: "required"
                },
                messages: {
                    true_name: "姓名必填！",
                    mob_phone: "手机号必填！",
                    prov: "省份必填！",
                    city: "城市必填！",
                    region: "区县必填！",
                    address: "街道必填！"
                }
            });
                
        }else{

            $("#login_form").validate({
                errorElement: "p",
                errorPlacement: function(error, element){
                error.appendTo($(".error-tips").show());
                },
                rules: {
                    true_name: "required",
                    mob_phone: "required"
                },
                messages: {
                    true_name: "姓名必填！",
                    mob_phone: "手机号必填！"
                }
            });

        }

        


        $("select[name=prov]").change(function(){
            
            var prov_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_ress','area_list');?>",
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
                    area_info_js();
                }
            });
        });



        $("select[name=city]").change(function(){
            var city_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_ress','area_list');?>",
                data:{area_id:city_id},
                dataType:'json',    
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">请选择...</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                    area_info_js();
                }
            });
        });

        $("select[name=region]").change(function(){
            area_info_js();
        });


    })

    function area_info_js(){
        var prov_index = $('select[name=prov]')[0].selectedIndex;
        var city_index = $('select[name=city]')[0].selectedIndex;
        var region_index = $('select[name=region]')[0].selectedIndex;   
        var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;

        $("input[name=area_info]").val(area_info);
    }
</script>
