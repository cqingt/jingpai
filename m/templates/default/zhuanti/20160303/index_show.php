
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160303/css/style.css">


<!-- Main area -->
<section class="section">

<div class="banner">
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160303/images/banner.jpg" alt="">

</div>

<div class="tile-box">
	 <div class="wrap">
	 	  <div class="description">
	 	       <h1>如此高逼格的纪念钞之前只能在银行兑换且数量极少，一旦流入市场价格马上翻倍</h1>
	 	       <h2>今天，收藏天下如银行一般，<em>开放等值兑换</em></h2>
	 	       <p>与其寒冬银行外排队苦</p>
	 	       <p>不如稳坐家中点击兑换</p>
	 	  </div>
	 	  <div class="userinfo" id="userinfo">
	 	  	   <div class="hp-input">
	 	  	   	    <label for="用户名：">用户名：</label><input type="text" value="" name="username" id="user_name" />
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="密码：">密码：</label><input type="password" value="" name="pwd" id="password"/>
	 	  	   </div>
	 	  	   <div class="hp-input">
	 	  	   	    <label for="手机：">手机：</label><input type="tel" value="" name="mobile" id="mobile"/>
	 	  	   </div>
			  <a class="participation" href="javascript:void(0)" id="loginbtn">参与等值兑换</a>
	 	  </div>
	 </div>
</div>
    <div style="margin-bottom: 50px"></div>
</section>
<script>
	$(function(){
		$('#loginbtn').click(function(){
			var user_name = $("#user_name").val();
			var password = $("#password").val();
			var mobile = $("#mobile").val();
			$.ajax({
				type:'post',
				url:"http://m.96567.com/index.php?act=zhuanti&op=ad_20160303&action=zhu_ce",
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
		});
	})

</script>