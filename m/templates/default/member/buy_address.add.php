<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="invoice-addcnt" id="new-address-wrapper" >
<form method="POST" id="addr_form" action="index.php">
<input type="hidden" value="member_buy" name="act">
<input type="hidden" value="add_addr" name="op">
<input type="hidden" name="form_submit" value="ok"/>
<div class="iadd-title">
	收货人信息：
</div>
<div>
	<p class="iadd-ip">姓名：<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip">
		<input type="text" class="n-input h22 wp100" name="true_name" id="true_name"/>
	</p>
	<p class="iadd-ip"> 手机号码:<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip">
		<input type="text" class="n-input h22 wp100" name="mob_phone" id="mob_phone" pattern="[0-9]*"/>
	</p>
	<p class="iadd-ip"> 电话号码:</p>
	<p class="iadd-ip">
		<input type="tel" class="n-input h22 wp100" name="tel_phone" id="tel_phone"/>
	</p>
</div>
<div class="iadd-title"> 地址信息：</div>
          <input type="hidden" value="" name="city_id" id="city_id">
          <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
          <input type="hidden" name="area_info" id="area_info" class="area_names"/>
<div>
	<p class="iadd-ip">省份：<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip" id="region">
		<select class="select-30" name="prov" id="prov" onchange="regionInit('city',this.value);">
			<option value=''>-请选择-</option>
		</select>
	</p>
	<p class="iadd-ip">城市：<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip" id="city">
		<select class="select-30" name="city" id="vcity" onchange="regionInit('dis',this.value);">
			<option value=''>-请选择-</option>
		</select>
	</p>
	<p class="iadd-ip"> 区县：<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip" id="dis">
		<select class="select-30" name="region" id="vregion">
			<option value=''>-请选择-</option>
		</select>
	</p>
	<p class="iadd-ip"> 街道：<span class="opera-tips">(*必填)</span></p>
	<p class="iadd-ip">
		<input type="text" class="n-input h22 wp100" name="address" id="address">
	</p>
</div>
<div class="error-tips"></div>
</form>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	regionInit("region",0);


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
            mob_phone : {required : checkPhone,minlength : 11,maxlength : 11,digits : true},
            tel_phone : {required : checkPhone,minlength : 6,maxlength : 20}
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
            },
            tel_phone : {
                required : '手机号码或固定电话请至少填写一个!',
                minlength: '',
				maxlength: ''
            }
        },
        groups : {
            phone:'mob_phone tel_phone'
        }
    });

});

function checkPhone(){
    return ($('input[name="mob_phone"]').val() == '' && $('input[name="tel_phone"]').val() == '');
}

/* 地区选择函数 */
function regionInit(divId,area_id){
	getArea(function(){
		if(typeof(nc_a[area_id]) == 'object' && nc_a[area_id].length > 0){//数组存在
			var area_select = $("#" + divId + " > select");//选择要初始化的对象
			areaInit(area_select,area_id);
		}
		$("#" + divId + " > select").change(regionChange); // select的onchange事件
		$("#" + divId + " > input:button[class='edit_region']").click(regionEdit); // 编辑按钮的onclick事件
	});
}

function areaInit(area_select,area_id){//初始化地区
	getArea(function(){
		if(typeof(area_select) == 'object' && nc_a[area_id].length > 0){
			var areas = new Array();
			areas = nc_a[area_id];
			var str = "<option value=''>-请选择-</option>";
			for (i = 0; i <areas.length; i++){
				str += "<option value='" + areas[i][0] + "'>" + areas[i][1] + "</option>";
			}
			$(area_select).html(str);
		}
	});
}

function getArea(callback){
	if(typeof(nc_a) == 'undefined'){//加载地区数据
		var area_scripts_src = '';
		area_scripts_src = $("script[src*='jquery.validation.min.js']").attr("src");//取JS目录的地址
		area_scripts_src = area_scripts_src.replace('jquery.validation.min.js', 'area_array.js');
		$.getScript(area_scripts_src,function(){
				callback();
				return true;
		});
	} else {
		callback();
	}
}

if(typeof(regionChange) != 'function'){//检测是否已经被定义过，防止重写
	function regionChange(){
	    // 计算当前选中到id和拼起来的name
	    var selects = $(this).siblings("select").andSelf();
	    var id = '';
	    var names = new Array();
	    for (i = 0; i < selects.length; i++){
	        sel = selects[i];
	        if (sel.value > 0){
	            id = sel.value;
	            name = sel.options[sel.selectedIndex].text;
	            names.push(name);
	        }
	    }
	    $(".area_ids").val(id);
	    $(".area_name").val(name);
	    $(".area_names").val(names.join("\t"));
	}
}
function regionEdit()
{
    $(this).siblings("select").show();
    $(this).siblings("span").andSelf().hide();
}
function submitAddAddr(){
	if ($('#addr_form').valid()){
        $('#buy_city_id').val($('#region').find('select').eq(1).val());
        $('#city_id').val($('#region').find('select').eq(1).val());
        var datas=$('#addr_form').serialize();
        $.post('index.php',datas,function(data){
            if (data.state){
                var true_name = $.trim($("#true_name").val());
                var tel_phone = $.trim($("#tel_phone").val());
                var mob_phone = $.trim($("#mob_phone").val());
            	var area_info = $.trim($("#area_info").val());
            	var address = $.trim($("#address").val());
            	showShippingPrice($('#city_id').val(),$('#area_id').val());
            	hideAddrList(data.addr_id,true_name,area_info+'&nbsp;&nbsp;'+address,(mob_phone != '' ? mob_phone : tel_phone));
            }else{
                alert(data.msg);
            }
        },'json');
    }else{
        return false;
    }
}

$(function (){
	
})
</script>