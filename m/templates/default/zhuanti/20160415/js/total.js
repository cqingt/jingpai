$("#btn-c").bind("click", function(event) { 
	$("#btn-c").attr("disabled",true);
	$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160415&action=caihongbao",
			data:{},
			dataType:'json',
			success:function(result){
				//检查用户是否登陆
				if(result == -1){
					//未登录弹出登陆注册框
					$(".btn-zz,.fadeInUp").show();  
				}else{
					$("#df_award-boxes").html(result.JiangHtml); 
					$("#chishu").html(result.JiHui+"次"); 
					$('#l_district').load('http://m.96567.com/index.php?act=zhuanti&op=ad_20160415&action=MyLotteryList');//加载获奖列表
					$(".btn-zz,.award").show(); 
				}
				$("#btn-c").attr("disabled",false);
			}
		});
});

//会员登陆
$("#btnOne").bind("click", function(event) {
	$("#btnOne").attr("disabled",true);
	var name = $('#user_name').val();
	var password = $('#password2').val();
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=login",
		data:{user_name:name,password:password},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="index.php?act=zhuanti&op=ad_20160415";
			}else{
				alert(result.error);
				$("#btnOne").attr("disabled",false);
			}
		}
	}); 
});
$(".btn-zz,.btn-close,.btn-rulebj").bind("click", function(event) { 
    $(".btn-zz,.award,.seventh,.fadeInUp,.shouhuoren,.isguanzhu,.ruleboxes,.btn-rulebj,#tishiyc").hide();
});

function df_aa(){
	$(".btn-zz,.bounce-two").hide();
}

$("#tishiyc").bind("click", function(event) { 
    alert('asdasd');
});
 
$(".btn-atv2").bind("click", function(event) { 
   $(".btn-zz,.fadeInUp").show(); 
});
$(".btn-close").bind("click", function(event) { 
    $(".btn-zz,.fadeInUp").hide();
});

$(".btn-rule").bind("click", function(event) { 
   $(".ruleboxes,.btn-rulebj").show(); 
});

$(".btn-seventh0").bind("click", function(event) { 
   $(".btn-zz,.seventh0").show(); 
});
$(".btn-seventh1").bind("click", function(event) { 
   $(".btn-zz,.seventh1").show(); 
});
$(".btn-seventh2").bind("click", function(event) { 
   $(".btn-zz,.seventh2").show(); 
});
$(".btn-seventh3").bind("click", function(event) { 
   $(".btn-zz,.seventh3").show(); 
});
$(".btn-seventh4").bind("click", function(event) { 
   $(".btn-zz,.seventh4").show(); 
});
$(".btn-seventh5").bind("click", function(event) { 
   $(".btn-zz,.seventh5").show(); 
});
$(".btn-seventh6").bind("click", function(event) { 
   $(".btn-zz,.seventh6").show(); 
});


$(".btn-close").bind("click", function(event) { 
    $(".btn-zz,.seventh").hide();
});


$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabCon).each(function(){
            $(this).children().eq(0).show();

        });
        $(tabTit).each(function(){
            $(this).children().eq(0).addClass(on);
        });
        $(tabTit).children().click(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
            $(tabCon).children().eq(index).show().siblings().hide();
        });
    }
    tabs(".handover_title","on",".handover_boxes");

})

$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabCon).each(function(){
            $(this).children().eq(0).show();

        });
        $(tabTit).each(function(){
            $(this).children().eq(0).addClass(on);
        });
        $(tabTit).children().click(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
            $(tabCon).children().eq(index).show().siblings().hide();
        });
    }
    tabs(".handover_title2","on",".handover_boxes2");

})
//会员注册
$("#TabBtnOne").bind("click", function(event) {
		$("#TabBtnOne").attr("disabled",true);
		var name = $('#name').val();
		var password = $('#password').val();
		var password1 = $('#password1').val();
		var mobile = $('#mobile').val();
		var code =  $('#code').val();
		var ua =  "";
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160415&action=yanzhengone",
			data:{user_name:name,password:password,password1:password1,mobile:mobile,code:code,ua:ua},
			dataType:'json',
			success:function(result){
				if(result.msg){
					//注册成功
					window.location.href="index.php?act=zhuanti&op=ad_20160415";
				}else{
					alert(result.error);
					$("#TabBtnOne").attr("disabled",false);
				}
			}
		}); 
    });


function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#name").val();
		if(name == ''){
            alert('用户名不能为空！');
            return false;
        }
        if(mobile == ''){
            alert('手机号不能为空！');
            return false;
        }

        var wait=60; 
        function time() { 
            var o = document.getElementById("getYzm");
           if (wait == 0) { 
                o.removeAttribute("disabled"); 
                o.value="重新发送"; 
                o.style.background = "#ffda31";
                o.style.color = "#ac4700";
                wait = 60; 
            } 
            else { 
                o.setAttribute("disabled", true); 
                o.value=wait+"秒"; 
                o.style.background = "#959595";
                o.style.color = "#fff";
                wait--; 
                setTimeout(function() { 
                time(o) 
                }, 
                1000) 
            } 
        } 

        $.ajax({
            type:'post',
            url:"http://m.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
            data:{mobile:mobile,name:name},
            dataType:'json',
            success:function(result){
                if(result == 1){
                    time();
                }else{
                  alert(result.error);
                }
            }
        });

}

//全部领取
function lingqu(){
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160415&action=is_lingqu",
		data:'',
		dataType:'json',
		success:function(result){
			if(result == 1){
				$(".btn-zz,.shouhuoren").show();
			}else if(result == -1){
				$(".btn-zz,.isguanzhu").show();
			}else if(result	== '您暂时没有奖品可领取~')
			{
				window.location.href="http://m.96567.com/index.php?act=member_order&op=order_list";
			}
		}
	});
	
}
$(".iconfont-androidcancel").bind("click", function(event) { 
    $(".btn-zz,.shouhuoren").hide();
});

$("#aisguanzhu").bind("click", function(event) { 
    $(".btn-zz,.isguanzhu").hide();
});

//获取区域列表
$.ajax({
	type:'post',
	url:"index.php?act=member_address&op=area_list",
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
                url:"index.php?act=member_address&op=area_list",
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
                url:"index.php?act=member_address&op=area_list",
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

	$("#btnLingQu").bind("click", function() {
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var prov_index = $('select[name=prov]')[0].selectedIndex;
		var city_index = $('select[name=city]')[0].selectedIndex;
		var region_index = $('select[name=region]')[0].selectedIndex;
		var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
		var prov = $('select[name=prov]').val();
		var city_id = $('select[name=city]').val();
		var area_id = $('select[name=region]').val();
		var address = $.trim($("#address").val());
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160415&action=Linqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
	});