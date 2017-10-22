<link rel="stylesheet" dtype="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160115/css/style.css">
<div class="banner">
	 <div class="wrap">
	 	  <img class="fadeInDown" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160115/images/banner.png" alt="" />
	 </div>
</div>

<div class="two-box">
	 <div class="wrap"><a href="#monkey">我要兑换</a></div>
</div>

<div class="three-box">
	 <div class="wrap"></div>
</div>

<div class="zero-1"></div>
<div class="zero-2"></div>
<div class="zero-3"></div>
<div class="zero-4"></div>

<div class="tile-box" id="monkey">
	 <div class="wrap">
	 	  <div class="description">
	 	       <p>一枚注定稳涨纪念币，一枚生肖家族的新生力量，</p>
	 	       <p>一枚更多人喜欢收藏的平价精品，之前只能在银行预约兑换，入手后价格立马翻倍</p>
	 	       <h2>这次，收藏天下开放等值兑换</h2>
	 	       <h4>立刻注册会员 即可拥有</h4>
	 	  </div>
	 	  <div class="userinfo">
	 	  	   <div class="hp-input">
	 	  	   	    <label for="用户名：">用户名：</label><input type="text" value="" name="user_name" id="user_name" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="密码：">密码：</label><input type="password" value="" name="password" id="password" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="确认密码：">确认密码：</label><input type="password" value="" name="password1" id="password1" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="手机：">手机：</label><input type="text" value="" name="mobile" id="mobile" />
	 	  	   </div>
	 	  	   <a class="participation" href="javascript:(0);" id="loginbtn">参与等值兑换</a>
	 	  </div>
	 </div>
</div>

<script>
	$(function(){
		$('#loginbtn').click(function(){
			var user_name = $("#user_name").val();
			var password = $("#password").val();
			var password1 = $("#password1").val();
			var mobile = $("#mobile").val();
			$.ajax({
				type:'post',
				url:"http://www.96567.com/shop/index.php?act=zhuanti&op=ad_20160115&action=zhu_ce",
				data:{user_name:user_name,password:password,password1:password1,mobile:mobile},
				dataType:'json',
				success:function(result){
					if(result.msg){
						alert(result.msg);
						window.location.reload();
					}else{
						alert(result.error);
					}
				}
			});
		});
	})

</script>
