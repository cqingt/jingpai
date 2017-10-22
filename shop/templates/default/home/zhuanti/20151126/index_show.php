<link rel="stylesheet" dtype="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151126/css/style.css">
<div class="banner">
	 <div class="wrap">
	 	  <img class="fadeInDown" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151126/images/banner.png" alt="" />
	 </div>
</div>

<div class="two-box">
	 <div class="wrap"><a href="#userinfo"  title="中国航天纪念币">我要兑换</a></div>
</div>

<div class="three-box">
	 <div class="wrap"></div>
</div>

<div class="zero-1"></div>
<div class="zero-2"></div>
<div class="zero-3"></div>

<div class="tile-box">
	 <div class="wrap">
	 	  <div class="description" >
	 	       <h1>一枚如此高逼格的纪念钞之前只能在银行兑换且数量极少，一旦流入市场价格马上翻倍</h1>
	 	       <h2>今天，收藏天下如银行一般，<em>开放等值兑换</em></h2>
	 	       <p>与其寒冬银行外排队苦</p>
	 	       <p>不如稳坐家中点击兑换</p>
	 	  </div>
		  <form id="reg_add" method="post" action="http://www.96567.com/shop/index.php?act=zhuanti&op=ad_20151126">
	 	  <div class="userinfo"  id="userinfo">
	 	  	   <div class="hp-input">
	 	  	   	    <label for="用户名：">用户名：</label><input type="text" name="user_name" id="user_name" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="密码：">密码：</label><input type="password" name="password" id="password" />
	 	  	   </div>
			   <!--
			   <div class="hp-input">
	 	  	   	    <label for="确认密码：">确认密码：</label><input type="text" value="" name="password_confirm" id="password_confirm"/>
	 	  	   </div>
			   -->
	 	  	   <div class="hp-input">
	 	  	   	    <label for="手机：">手机：</label><input type="text" name="mobile" id="mobile" />
	 	  	   </div>
	 	  	   <a class="participation" href="javascript:void(0)" id="loginbtn">参与等值兑换</a>
	 	  </div>
		  </form>
	 </div>
</div>
<script>
	$(function(){
		$('#loginbtn').click(function(){
			var user_name = $("#user_name").val();
			var password = $("#password").val();
			var mobile = $("#mobile").val();
			$.ajax({
				type:'post',
				url:"http://www.96567.com/shop/index.php?act=zhuanti&op=ad_20151126&action=zhu_ce",
				data:{user_name:user_name,password:password,mobile:mobile},
				dataType:'json',
				success:function(result){
					if(result.msg){
						alert(result.msg);
					}else{
						alert(result.error);
					}
				}
			});
			//document.getElementById("reg_add").submit();
		});
	})

</script>