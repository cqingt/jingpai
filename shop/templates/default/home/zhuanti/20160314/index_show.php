<link href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160314/css/index.css" rel="stylesheet">
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<div class="header">
     <div class="banner">
          <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160314/images/banner.png" alt="">
     </div>
</div>

<div class="register-box" <?php if($output['member_id'] > 0 && $output['is_lin'] != 1){ ?>style="display: none;"<?php } ?>>
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
            <input class="text" name="password" id="password" type="password">
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
            <input class="text" value="" name="mobile" id="mobile" type="text">
            <!-- <p>提示</p> -->
        </dd>    
    </dl> 
    <dl class="clearfix">
        <dt>验证码：</dt>
        <dd class="verification">
            <input class="text tip" name="captcha_code" id="code" type="text">
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
		var ua =  '<?php echo $_GET["ua"];?>';
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160314&action=yanzhengone",
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
              <div id="region">
                <select style="" class="valid" id='prov'>
                       
                </select>
				<input type="hidden" value="" name="city_id" id="city_id">
			    <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
			    <input type="hidden" name="area_info" id="area_info" class="area_names"/>
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
            <p class="add-p">“因纪念币本身价值很高，快递费用7元需会员自理”</p>
      </div>
     </div>
</div>
<div style="clear:both; display:block;"></div>
</div>



<div class="synopsis">
     <div class="syn-text">
         <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160314/images/rmb.jpg" alt="">
         <p> 70年前，在世界反法西斯战争的东方主战场上，中华民族夺取了抗日战
            争的完全胜利，而先辈们曾为此付出了巨大的牺牲。</p>
         <p>70年后，为庆祝伟大的中国人民抗日战争暨世界反法西斯战争胜利70周年这一伟大的盛事，铭记历史、缅怀先烈、珍视和平，中国人民银行决定自2015年8月20日起陆续发行中国人民抗日战争暨世界反法西斯战争胜利70周年纪念币一套。本次的赠品正是其中的镍包钢纪念币。</p>
     </div>
</div>

<div class="get">
     <div class="getbox">
          <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160314/images/get.jpg" alt="">
          <p>1、本活动仅限首次注册“收藏天下”的新会员参与，每位会员可免费领取抗战胜利70周年普通纪念币1枚；</p>
          <p>2、注册成功后会员自助填写收货地址，享0元购抗战币；</p>
          <p>3、每位新会员仅限参与一次活动，同一手机号、收货地址均视为同一用户；</p>
          <p>4、因纪念币本身价值很高，快递费用需会员自理；</p>
          <p>5、本活动最终解释权归收藏天下所有。</p>
     </div>
     <a class="btn" href="http://www.96567.com"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160314/images/btn.jpg" alt=""></a>
</div>


<script>
	$("#btnLingQu").bind("click", function() {
		$('#city_id').val($('#region').find('select').eq(1).val());
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var area_info = $.trim($("#area_info").val());
		var city_id = $.trim($("#city_id").val());
		var area_id = $.trim($("#area_id").val());
		var address = $.trim($("#address").val());
		var prov = $.trim($("#prov").val());
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=LingQu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://www.96567.com/shop/index.php?act=buy&op=pay&pay_sn="+result.pay_sn;
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
            url:"http://www.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
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

$(document).ready(function(){
	regionInit("region");
   
});

</script>