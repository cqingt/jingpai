<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/has.css" />
<ul class="voucher-tab">
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'index'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','index');?>">邀请好友</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_log'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_log');?>">藏豆明细</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_exchange'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_exchange');?>">藏豆兑换</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_tuijian'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_tuijian');?>">优惠购买</a> </li>
</ul>

<form method="post" action="index.php?act=cangdou&op=exchange_on" id="addr_form">

<section>
<input type="hidden" name="form_submit" value="ok">
<input type="hidden" name="gift_id" value="<?php echo intval($_GET['gift_id']);?>">

		  	 <div class="panel-form">
		  	 	<h1>收货人信息</h1>
				<?php if(!empty($output['address_list'])){ ?>
		  	 	<div class="form-group">
		  	 		<select name="addr" style="" class="valid1">
                        <option value="0">从已有收货地址中选择</option>
						<?php foreach($output['address_list'] as $k=>$v){?>
                        <option value="<?php echo $v['address_id']?>"">收货人：<?php echo $v['true_name']?>（<?php echo $v['mob_phone']?>）<?php echo $v['area_info'].$v['address']?></option>
						<?php } ?>
                    </select>
                    <i class="fa fa-angle-down fa-lg"></i>
		  	 	</div>
				<?php } ?>
				<span id="new_addr">
		  			<div class="form-group">
									<label for="">收货人姓名：</label>
									<input type="text" value="" name="true_name" id="true_name">
								</div>
								<div class="form-group number">
									<label for="">手机号：</label>
									<input type="tel" value="" name="mob_phone" id="mob_phone">
								</div>

								<div class="form-group sole">
								  <label for="">省份：</label>
								   <input type="hidden" value="" name="city_id" id="city_id">
								   <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
								  <input type="hidden" name="area_info" id="area_info" class="area_names"/>
									<select class="valid" name="prov" id="vprov">
										<option value="">-请选择-</option>
									</select>
									
								  <i class="fa fa-angle-down fa-lg"></i>
								</div>

								<div class="form-group sole">
									<label for="">城市：</label>
									<select class="valid" name="city" id="vcity">
										<option value="">-请选择-</option>
									</select>
									<i class="fa fa-angle-down fa-lg"></i>
								</div>

								<div class="form-group sole">
									<label for="">区县：</label>
									<select class="valid" name="region" id="vregion">
										<option value="">-请选择-</option>
									</select>
									<i class="fa fa-angle-down fa-lg"></i>
								</div>

								<div class="form-group">
									<textarea placeholder="请输入您的详细地址" rows="2" id="address" name="address"></textarea>
								</div>
								<div class="error-tips"></div>
				</span>
		  	 </div>
             <div class="panel-form">
             	<h1>兑换商品信息</h1>
             	<div class="rank">
             		<ul>
             			<li>
             				<div class="rankimg">
             					<img src="<?php echo cthumb($output['gift_info']['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>">
             				</div>
             				<div class="rankword">
             					<h2><?php echo $output['gift_info']['goods_name'];?></h2>
             					<p><strong>藏豆：<?php echo $output['gift_info']['use_cangdou'];?></strong><em>x1</em></p>
             				</div>
             			</li>
             		</ul>
             	</div>
             </div>

		  	 <div class="p-lf">
             <a class="btn-rom btntwo" href="javascript:;" onclick="submit_duihuan();">确定兑换</a>
             </div>
		  </section>
	 </form>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(document).ready(function(){
	$('#addr_form').validate({
		errorElement: "p",
		errorPlacement: function(error, element){
		error.appendTo($(".error-tips").show());
		},
        rules : {
            true_name : {required : true},
			prov : {required : true},
			city : {required : true},
			region : {required : true},
            address : {required : true},
            mob_phone : {required : checkPhone,minlength : 11,maxlength : 11,digits : true}
        },
        messages : {
            true_name : {required : '请填写收货人姓名！'},
			prov : {required : '省份必填！'},
			city : {required : '城市必填！'},
			region : {required : '区县必填！'},
            address : {
                required : '请填写收货人详细地址!'
            },
            mob_phone : {
                required : '手机号码或固定电话请至少填写一个!',
                minlength: '手机号码只能是11位!',
				maxlength: '手机号码只能是11位!',
                digits : '手机号码只能是11位!'
            }
        },
        groups : {
            phone:'mob_phone'
        }
    });

});

function checkPhone(){
    return ($('input[name="mob_phone"]').val() == '');
}
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
	  $("select[name=prov]").change(function(){//选择省市
            var prov_id = $(this).val();
			if(prov_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=city]").html(region_html);
				return false;
				}
			
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:prov_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var city_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=city]").html(city_html);
                    $("select[name=region]").html('<option value="">-请选择-</option>');
                }
            });
        });

        $("select[name=city]").change(function(){//选择城市
            var city_id = $(this).val();
			if(city_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=region]").html(region_html);
				return false;
				}
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:city_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                }
            });
        });
function submit_duihuan(){
	$('#addr_form').submit();
}
$(function(){
	 function addAddr(){
		 $.ajax({
            type:'post',
            url:"index.php?act=cangdou&op=add_address",
            data:{},
            dataType:'html',
            success:function(result){
			   $('#new_addr').html(result);
            }
        });
    }
    $("select[name=addr]").change(function(){
        if($(this).val() == 0){
			addAddr();
        }else{
            $('#new_addr').html('');
        }
    })

});

   
</script>