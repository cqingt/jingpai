<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-2/css/features.css">
<script>
$(function(){
	$('#loginbtn').click(function(){
		$("#loginbtn").attr("disabled",true);
		var name = $('#name').val();
		var password = $('#password').val();
		var password1 = $('#password1').val();
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20151212_2&action=yanzhengone",
			data:{user_name:name,password:password,password1:password1},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$("#one").css('display','none'); 
					$("#two").css('display','block'); 
					$('#nametwo').val(name);
					$('#namethree').val(name);
				}else{
					alert(result.error);
					$("#loginbtn").attr("disabled",false);
				}
			}
		});
	});
	$('#loginbtn_two').click(function(){
		$("#loginbtn_two").attr("disabled",true);
		var tel = $('#tel').val();
		var code =  $('#code').val();
		if (!valid_shouji(tel))
		{
			alert("请输入正确的手机号");
			$("#tel").focus();
			return false;
		}
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20151212_2&action=yanzhengtwo",
			data:{tel:tel,code:code},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$("#two").css('display','none'); 
					$("#three").css('display','block');
				}else{
					alert(result.error);
					$("#loginbtn_two").attr("disabled",false);
				}
			}
		});
	});

	$('#loginbtn_three').click(function(){
		$("#loginbtn_three").attr("disabled",true);
		var email = $('#email').val();
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20151212_2&action=loginbtn_three",
			data:{email:email},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$("#three").css('display','none'); 
					$("#four").css('display','block');
				}else{
					alert(result.error);
					$("#loginbtn_three").attr("disabled",false);
				}
			}
		});
	});

	$('#YZ_email').click(function(){
		$("#YZ_email").attr("disabled",true);
		var email = $('#email').val();
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20151212_2&action=yz_email",
			data:{email:email},
			dataType:'json',
			success:function(result){
				if(result.msg){
					alert("验证邮件已经发送至您的邮箱，请于24小时内登录邮箱并完成验证！");
				}else{
					alert(result.error);
					$("#YZ_email").attr("disabled",false);
				}
			}
		});
	});
})


function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}

var clock=60;
function fun(){ 
	if (clock==0) 
	{
		$("#HuoQu").html("<a href='javascript:;' onclick='check_form();'>获取验证码</a>");
	} 
	else { 
		clock=clock-1;
		$("#HuoQu").html("<a href='javascript:;'>还有"+clock+"秒再次发送</a>");
		setTimeout("fun()",1000);
	}

}

function check_form(){
	var tel=$("#tel").val();
	if (!valid_shouji(tel))
	{
		alert("请输入正确的电话");
		$("#tel").focus();
		return false;
	}
	$("#HuoQu").html("<a href='javascript:;'>正在获取</a>");
	$.post("index.php?act=zhuanti&op=ad_20151212_2&action=telmode",{"tel":tel},function(result){
		if(result == -1){
			alert("请输入正确的电话");
			$("#tel").focus();
			$("#HuoQu").html("<a href='javascript:;' onclick='check_form();'>获取验证码</a>");
			return false;
		}
		if(result == -2){
			alert("该手机号已存在，请重新输入！");
			$("#tel").focus();
			$("#HuoQu").html("<a href='javascript:;' onclick='check_form();'>获取验证码</a>");
			return false;
		}
		if(result==1){
			$("#tel").attr("disabled",true);
			$("#HuoQu").html("<a href='javascript:;'>手机验证短信已发出</a>");
			alert("您的验证短信已经发送");
			$("#code").focus();
			clock=60
			fun();
		}

	});

}
</script>
<div class="main banner">
     <div class="banner-top"></div>
     <div class="banner-main"></div>
</div>

<div class="main content">
     <div class="wrap">
          <h1>[<em>新人独享礼</em>]</h1>
          <p class="p-one">2015.12.12——2015.12.31</p>
          <p class="p-one">成功注册的新会员均可领取内含1600积分及200元现金券的<新人独享礼>有券下单更实惠</p>
		 
			  <!-- one Start-->
			  <div class="ue-boxes" id="one" <?php if($output['ZhuanTi_Reg']['username']){?>style="display: none;"<?php } else{ ?>style="display: block;"<?php } ?>>
				   <ul class="ue-list">
					   <li class="changing"><i class="icon-circle1"></i>快捷注册</li>
					   <li>验证手机</li>
					   <li>验证邮箱</li>
					   <li>成功领取</li>
				   </ul>
				   <div class="ue-form form1">
						<h2>快捷注册</h2>
						<div class="form">
							  <div class="line">
								   <label for="user">用户名</label>
								   <input id="name" type="text" name="name"  required="required">
							  </div>
							  <div class="line">
								   <label for="password1">密码</label>
								   <input type="password"  name="password" id="password" required="required">
							  </div>
							  <div class="line">
								   <label for="password2">确认密码</label>
								   <input type="password" name="password1" id="password1" required="required">
							  </div>
							  <input type="button" class="abtn" id="loginbtn" value="即刻注册">
						 </div>
				   </div>
			  </div>
          <!-- one End-->
       <!--two  Start-->
<!-- --><div class="ue-boxes" id="two" <?php if(!$output['ZhuanTi_Reg']['mobile'] && $output['ZhuanTi_Reg']['username']){?>style="display: block;"<?php } else{ ?>style="display: none;"<?php } ?>>
               <ul class="ue-list">
                   <li class="changing">快捷注册</li>
                   <li class="changing"><i class="icon-circle1"></i>验证手机</li>
                   <li>验证邮箱</li>
                   <li>成功领取</li>
               </ul>
               <div class="ue-form form3">
                    <h2>验证手机再领1000积分+100元现金券</h2>
                    <div class="form">
                          <div class="line">
                               <label for="user">用户名</label>
                               <input id="nametwo" type="text" value="<?php echo $output['ZhuanTi_Reg']['username']; ?>" name="name" required="required" readonly="true">
                          </div>
                          <div class="line location">
                               <label for="tel1">手机号</label>
                               <input id="tel" type="tel" value="<?php echo $output['ZhuanTi_Reg']['tel']; ?>" name="tel" required="required">
							   <div  id='HuoQu' class="verify"><a href="javascript:;" onclick="check_form();">获取验证码</a></div>
                          </div>
                          <div class="line">
                               <label for="tel2">验证码</label>
                               <input id="code" type="tel" value="" name="code" required="required">
                          </div>
                          <input type="button" class="abtn" id="loginbtn_two" value="立刻验证">
                    </div>
               </div>
          </div>
          <!-- two End-->
          <!-- three Start-->
<!--  -->  <div class="ue-boxes" id="three" <?php if($output['ZhuanTi_Reg']['member_email_bind'] != 1 && $output['ZhuanTi_Reg']['username'] && $output['ZhuanTi_Reg']['mobile']){?>style="display: block;"<?php } else{ ?>style="display: none;"<?php } ?>>
               <ul class="ue-list">
                   <li class="changing">快捷注册</li>
                   <li class="changing">验证手机</li>
                   <li class="changing"><i class="icon-circle1"></i>验证邮箱</li>
                   <li>成功领取</li>
               </ul>
               <div class="ue-form form2">
                    <h2>验证邮箱，领600积分+100元现金券</h2>
                    <div class="form">
                          <div class="line">
                               <label for="user">用户名</label>
                               <input id="namethree" type="text" value="<?php echo $output['ZhuanTi_Reg']['username']; ?>" name="name" required="required" readonly="true">
                          </div>
                          <div class="line location">
                               <label for="email">邮箱</label>
                               <input id="email" type="email" value="" name="email" required="required">
							   <div class="verify"><a id='YZ_email' href="javascript:;">获取邮箱验证</a></div>
                          </div>
						  <input type="button" class="abtn" id="loginbtn_three" value="立刻验证">
                    </div>
               </div>
          </div>
          <!-- three End-->
          <!-- four Start-->
<!-- -->      <div class="ue-boxes" id="four" <?php if($output['ZhuanTi_Reg']['username'] && $output['ZhuanTi_Reg']['mobile'] && $output['ZhuanTi_Reg']['email'] && $output['ZhuanTi_Reg']['member_email_bind'] == 1){?>style="display: block;"<?php } else{ ?>style="display: none;"<?php } ?>>
               <ul class="ue-list">
                   <li class="changing">快捷注册</li>
                   <li class="changing">验证手机</li>
                   <li class="changing">验证邮箱</li>
                   <li class="changing"><i class="icon-circle1"></i>成功领取</li>
               </ul>
               <div class="ue-form form4">
                    <h2>您已成功领取1600积分+200元现金券</h2>
                    <div class="form">
                           <h3>您已成功验证手机号和邮箱，积分、现金券及时到帐</h3>
                           <h4>立刻去下单享受优惠吧~</h4>
                           <a class="a-abtn" href="http://www.96567.com/shop/index.php?act=zhuanti&op=ad_20151212_1" target="_blank">立刻下单</a>
                    </div>
               </div>
          </div>
          <!-- four End-->
          <div class="text">
               <p>领完奖励去看看收藏天下为您网罗了哪些<strong><i class="icon-circle1 circle1"></i>精品收藏</strong>吧！</p>
               <p>我们是您互联网上最贴心的收藏顾问</p>
               <p>有更多的<em><i class="icon-circle1 circle2"></i>惊喜</em>等您发现~</p>
          </div>

     </div>
</div>

<div class="main yellow">
     <div class="wrap">
          <h2>[ <em>精品推荐</em> ]</h2>
          <ul class="product-show">
			<?php foreach($output['goods_list'] as $k=>$v){ ?>
              <li>
                  <a class="show1" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($v['goods_image'], 240, $v['store_id']);?>" alt="<?php echo $v['goods_name'];?>"></a>
                  <a class="show2" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><?php echo $v['goods_name'];?></a>
                  <p><em>¥</em><?php echo $v['goods_price'];?></p>
                  <a class="go-btn" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank">立即购买</a>
              </li>
			<?php } ?>
          </ul>
          <a class="more-btn" href="http://www.96567.com" target="_blank">更多藏品>></a>
     </div>
</div>

<div class="navigation">  
     <a href="index.php?act=zhuanti&op=ad_20151212_1" target="_blank"></a>
     <a href="index.php?act=zhuanti&op=ad_20151212_3" target="_blank"></a>
</div>

<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-2/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-2/js/container.js"></script>
