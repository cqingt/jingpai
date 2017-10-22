<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160820/css/new_file.css"/>

<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160820/js/jq_scroll.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	        $("#scrollDiv-one").Scroll({line:1,speed:500,timer:2000});
	});
	$(document).ready(function(){
	        $("#scrollDiv-two").Scroll({line:1,speed:500,timer:3000,up:"but_up",down:"but_down"});
	});
</script>


<div class="photo1"></div>
<div class="photo2"></div>
<div class="photo3"></div>
<div class="photo4"></div>
<div class="photo5"></div>
<div class="photo6"></div>
<div class="photo7"></div>
<div class="photo8"></div>
<div class="photo9"></div>
<div class="photo10"></div>
<div class="photo11"></div>
<div class="photo12"></div>
<div class="photo13"></div>
<div class="photo14"></div>
<div class="photo15"></div>
<div class="photo16"></div>
<div class="photo17"></div>
<div class="photo18"></div>
<div class="photo19"></div>
<div class="photo20"></div>


<div class="content" id="box1">
	
	<div class="main">
		
		<div class="form-input">

			<form id="form1" action="<?php echo urlShop('zhuanti','ad_20160820',array('ua'=>$_GET['ua']?$_GET['ua']:'pc'));?>" method="post">
			<img class="img" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160820/images/blank.jpg"/>
			<div class="in">
				<input type="" name="true_name" id="" value="" placeholder="请输入姓名"/>
			</div>
			<div class="in">
				<input type="" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" value="" placeholder="请输入手机号"/>
			</div>


		    <div class="item-yz">
		      	<input class="l" type="tel" name="yzm" id="yzm" value=""  maxlength='4' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请填写验证码" />
		      	<input class="r" type="button" id='push_yzm' value="发送验证码"/>
		    </div>  


			<div class="in">
				<input type="" name="goods_sum" id="" maxlength='3' onkeyup="value=value.replace(/[^\d]/g,'')" value="" placeholder="请输入订购数量"/>
			</div>
			<div class="in">
				<input type="" name="address" id="" value="" placeholder="请输入收货地址"/>
			</div>
			<h2 class="mf">（免快递费）</h2>
			<p class="last">我们郑重承诺：严格保护用户个人信息，绝不外泄</p>

			
	 		<?php Security::getToken();?>
	 		<input type="hidden" name="form_submit" value="ok">

			<button class="btn-okey"><!--提交--></button>
			</form>

		</div>


		<div class="roll-list">
			<div class="scrollDiv-top" id="scrollDiv-one">
				<ul class="line">

<?php if($output['order_list']){?>

	<?php foreach ($output['order_list'] as $k => $v) {?>
		<li>
			<p><strong><?php echo $v['buyer_name'];?></strong><?php echo $v['goods_name'];?></p>
			<p><em><?php echo date('Ymd',$v['payment_time']);?></em><span>已发货</span></p>
		</li>
	<?php }?>
<?php }?>

				</ul>
			</div>
		</div>
	</div>
	
</div>

<div class="photo21"></div>

<div class="footer">
	<div class="footer-con">
		<a href="#box1"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160820/images/footer.jpg"/></a>
	</div>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>

$(function(){
	// 登录
	$("#form1").validate({
	    errorElement: "p",
	    errorPlacement: function(error, element){
	    // error.appendTo($("#form1").show());
	    },
	    rules: {
	        true_name: "required",
	        mob_phone: "required",
	        goods_sum: "required",
	        yzm: "required",
	        address: "required"
	    },
	    messages: {
	        true_name: "用户姓名不能为空！",
	        mob_phone: "手机号不能为空！",
	        goods_sum: "订购数量不能为空！",
	        yzm: "验证码不能为空",
	        address: "详细地址不能为空！"
	    }
	});



	$("#push_yzm").click(function(){
		var mob_phone = $("#mob_phone").val();

		if(!!mob_phone === false){
			alert('手机号码不能为空');
			return false;
		}

		$.post("index.php?act=zhuanti&op=getOnePhoneYzm",{'mobile':mob_phone},function(data){

			if(data.state){
				alert(data.msg);
			}else if(data === true){
				alert('发送成功！');
			}

    },'json');


	})


})
</script>