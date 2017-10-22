<link rel="stylesheet" dtype="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/css/style.css">
<!-- Main area -->
<section class="section">
<div class="banner">
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/banner.jpg" alt="">
	 <a href="#duihuan" alt="我要兑换"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/one.jpg" alt="" /></a>
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/two.jpg" alt="" />
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/zero-1.jpg" alt="" />
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/zero-2.jpg" alt="" />
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160316/images/zero-3.jpg" alt="" />
</div>

<div class="tile-box">
	 <div class="wrap">
	 	  <div class="description">
	 	       <h1>一枚如此高逼格的纪念币之前只能在银行兑换且数量极少，一旦流入市场价格马上翻倍</h1>
	 	       <h2>今天，收藏天下如银行一般，<em>开放等值兑换</em></h2>
	 	       <p>与其寒冬银行外排队苦</p>
	 	       <p>不如稳坐家中点击兑换</p>
	 	  </div>
		  <a name="duihuan"></a> 
	 	  <div class="userinfo" <?php if($output['member_id'] > 0 && $output['is_lin'] != 1){ ?>style="display: none;"<?php } ?>>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="用户名：">用户名：</label><input type="text" id="name" value="" name="" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="密码：">密码：</label><input type="password" value="" id="password" name="" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="手机：">手机：</label><input type="tel" value="" id="mobile" name="" />
	 	  	   </div>
	 	  	   <a class="participation" href="javascipt:;">参与等值兑换</a>
	 	  </div>
	 </div>
</div>
<script>
    $(".participation").bind("click", function(event) {
		$(".participation").attr("disabled",true);
		var name = $('#name').val();
		var password = $('#password').val();
		var mobile = $('#mobile').val();
		var ua =  "<?php echo $_GET['ua'];?>";
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160316&action=yanzhengone",
			data:{user_name:name,password:password,mobile:mobile,ua:ua},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$(".userinfo").hide(); $(".add-wrap").show();
				}else{
					alert(result.error);
					$(".participation").attr("disabled",false);
				}
			}
		}); 
    });
</script>


<div class="add-wrap" <?php if($output['member_id'] > 0 && $output['is_lin'] != 1){ ?>style="display:block;"<?php } ?>>
     <div class="dialog_body">
	 <a name="soocangaddress" id="soocangaddress"></a> 
     <h1 class="congratulation">恭喜您注册成功√</h1>
     <p class="congr-p">请填写收货信息静等收取抗战胜利70周年纪念币</p>
     <div class="eject_con address">
      <div class="adds">
          <span class="dialog_title_icon">收货信息：</span>
          <dl>
            <dt><i class="required">*</i>收货人：</dt>
            <dd>
              <input type="text" class="text w100" name="true_name" id="true_name" value="">
              <p class="hint">请填写您的真实姓名</p>
            </dd>
          </dl>
          <dl>
            <dt><i class="required">*</i>所在地区：</dt>
            <dd>
              <div>
		  <input type="hidden" value="" name="city_id" id="city_id">
          <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
          <input type="hidden" name="area_info" id="area_info" class="area_names"/>
				 <select class="valid" name="prov" id="vprov">
						<option value="">-请选择-</option>
					</select>
					<select class="valid" name="city" id="vcity">
						<option value="">-请选择-</option>
					</select>
			   
					<select class="valid" name="region" id="vregion">
						<option value="">-请选择-</option>
					</select>
              </div>
            </dd>
          </dl>
          <dl>
            <dt><i class="required">*</i>街道地址：</dt>
            <dd>
              <input class="text w300 valid" type="text" name="address" id="address" value="">
              <p class="hint">不必重复填写地区</p>
            </dd>
          </dl>
          <dl>
            <dt><i class="required">*</i>手机号码：</dt>
            <dd>
              <input type="tel" class="text w200 valid" name="mob_phone" id="mob_phone" value="">
            </dd>
          </dl>
            <label class="submit-border">
              <input type="submit" class="submit" id="btnLingQu" value="完成领取">
            </label>
            <p class="add-p">因纪念币本身价值很高快递费用20元需会员自理</p>
      </div>
     </div>
</div>
<div style="clear:both; display:block;"></div>


</section>
<!-- Main area End -->

<script>
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
			url:"index.php?act=zhuanti&op=ad_20160316DuiHuan",
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
</script>
<?php

$array['P']['title'] = "100元普通纸币秒变升值纪念钞！航天钞等面值兑换啦，点击领取";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160316/images/weixinfen.jpg";
$array['Y']['title'] = "100元普通纸币秒变升值纪念钞！航天钞等面值兑换啦，点击领取";
$array['Y']['desc'] = "中国仅有的第四枚纪念钞，价值含量极高，不可多得的福利";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160316/images/weixinfen.jpg";

echo weixinShare($array);

?>