<link href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/css/index.css" rel="stylesheet">

<div class="header">
     <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/images/header.jpg" alt="">
</div>

<div class="register-box" <?php if($output['member_id'] > 0 && $output['is_lin'] != 1){ ?>style="display: none;"<?php } ?>>
<h2>"立即注册</h2>
<h4>领取价值23元的抗战70周年纪念币"</h4>
<div class="formInfo">
    <dl class="clearfix">
        <dt>用户名：</dt>
        <dd>
            <input class="text" name="userName" id="name" type="text">
            <!-- <p>提示</p> -->
        </dd>    
    </dl>
    <dl class="clearfix">
        <dt>密码：</dt>
        <dd>
            <input class="text" name="passWord" id="password" type="password">
            <!-- <p>提示</p> -->
        </dd>    
    </dl> 
    <dl class="clearfix">
        <dt>确认密码：</dt>
        <dd>
            <input class="text" name="passWord_enter" id="password1" type="password">
            <!-- <p>提示</p> -->
        </dd>    
    </dl>
    <dl class="clearfix">
        <dt>手机：</dt>
        <dd>
            <input class="text" value="" name="mobile" id="mobile" type="tel">
            <!-- <p>提示</p> -->
        </dd>    
    </dl> 
    <dl class="clearfix">
        <dt>验证码：</dt>
        <dd class="verification">
            <input class="text tip" name="captcha_code" id="code" type="tel">
            <input type="button" onclick="getPhoneYzm();" class="btn-code" value="获取验证码" name="getYzm" id="getYzm">
        </dd>    
    </dl> 
    <a href="javascript:(0);" id="btnOne" class="lol-submit">立刻领取</a>
</div>
</div>

<script>
    $("#btnOne").bind("click", function(event) {
		$("#btnOne").attr("disabled",true);
		var name = $('#name').val();
		var password = $('#password').val();
		var password1 = $('#password1').val();
		var mobile = $('#mobile').val();
		var code =  $('#code').val();
		var ua =  "<?php echo $_GET['ua'];?>";
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160920&action=yanzhengone",
			data:{user_name:name,password:password,password1:password1,mobile:mobile,code:code,ua:ua},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$(".register-box").hide(); $(".add-wrap").show();
				}else{
					alert(result.error);
					$("#btnOne").attr("disabled",false);
				}
			}
		}); 
    });
</script>

<div class="add-wrap" <?php if($output['member_id'] > 0 && $output['is_lin'] != 1){ ?>style="display:block;"<?php } ?>>
     <div class="dialog_body">
     <h1 class="congratulation">恭喜您注册成功</h1>
     <p class="congr-p">请填写收货信息静等收取抗战胜利70周年纪念币</p>
     <div class="eject_con address">
      <div class="adds">
      
          <span class="dialog_title_icon">收货信息</span>
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
            <p class="add-p">因纪念币本身价值很高快递费用7元需会员自理</p>
        
      </div>
     </div>
</div>
<div style="clear:both; display:block;"></div>
</div>

<div class="synopsis">
     <div class="syn-text">
         <h2>《 抗战胜利70周年纪念币简介 》</h2>
         <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/images/rmb.jpg" alt="">
         <p> 70年前，在世界反法西斯战争的东方主战场上，中华民族夺取了抗日战
            争的完全胜利，而先辈们曾为此付出了巨大的牺牲。</p>
         <p>70年后，为庆祝伟大的中国人民抗日战争暨世界反法西斯战争胜利70周年这一伟大的盛事，铭记历史、缅怀先烈、珍视和平，中国人民银行决定自2015年8月20日起陆续发行中国人民抗日战争暨世界反法西斯战争胜利70周年纪念币一套。本次的赠品正是其中的镍包钢纪念币。</p>
     </div>
</div>

<div class="get">
     <div class="getbox">
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/images/get.jpg" alt="">
          <p>1、本活动仅限首次注册“收藏天下”的新会员参与，每位会员可免费领取抗战胜利70周年普通纪念币1枚；</p>
          <p>2、注册成功后会员自助填写收货地址，享0元购抗战币；</p>
          <p>3、每位新会员仅限参与一次活动，同一手机号、收货地址均视为同一用户；</p>
          <p>4、因纪念币本身价值很高，快递费用需会员自理；</p>
          <p>5、本活动最终解释权归收藏天下所有。</p>
          <p>6、添加客服微信号：junjun6795882，领取红包（需向客服发送注册名和手机号）！快递费：12元。</p>
     </div>
     <a class="btn" href="http://m.96567.com"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/images/btn.jpg" alt=""></a>
     
     <img style="width:100%" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160920/images/dibu_02.jpg" alt="">
</div>

<script>
		//获取区域列表
        $.ajax({
            type:'post',
            url:"<?php echo urlWap('zhuanti','area_list')?>",
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
                url:"<?php echo urlWap('zhuanti','area_list')?>",
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
                url:"<?php echo urlWap('zhuanti','area_list')?>",
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
			url:"http://m.96567.com/index.php?act=zhuanti&op=ad_20160920&action=lingqu",
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

$array['P']['title'] = "抗战胜利70周年纪念币免费领取";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160920/images/weixinfen.jpg";
$array['Y']['title'] = "抗战胜利70周年纪念币免费领取";
$array['Y']['desc'] = "收藏天下注册免费送抗战胜利70周年币一套，名额有限，速来！";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160920/images/weixinfen.jpg";

echo weixinShare($array);

?>