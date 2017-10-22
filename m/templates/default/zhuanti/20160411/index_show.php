
<link rel='stylesheet' href='<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160411/css/gift.css'>
<div class="present">
  <p>在您选择下塌重庆万达艾美酒店之时</p>
  <p>我们特别为您送上一份最真挚的祝“福”</p>
  <p class="p1">并请您把这份满满的祝“福”带回给家人。</p>
  <div class="form"><label for="">姓名：</label><input id='name' type="text" value="" placeholder="Your Name"></div>
  <div class="form"><label for="">手机：</label><input id='mobile' type="tel" value="" placeholder="Your mobile phone number"></div>
  <a href="javascript:(0);" id="btnOne" class="btn-form">立即领取</a>

  <script>
    $("#btnOne").bind("click", function(event) {
		$("#btnOne").attr("disabled",true);
		var name = $('#name').val();
		var mobile = $('#mobile').val();
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160411&action=zuce",
			data:{user_name:name,mobile:mobile},
			dataType:'json',
			success:function(result){
				if(result.msg){
					$(".btn-tier,.space-layer").show(); 
					  $(".btn-tier,.btn-close").bind("click", function(event) { 
						$(".btn-tier,.space-layer").hide();
					});
				}else{
					alert(result.error);
					$("#btnOne").attr("disabled",false);
				}
			}
		}); 
    });
</script>
  <h4>领取地址：酒店大堂收藏天下精品店</h4>
  <h5>（每位客人只能领取一份哟，数量有限，送完为止）</h5>
  <h1>连海明书法“福”字图</h1>
  <div class="soleimg">
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160411/images/1.jpg" alt="">
  </div>
  <p class="last"><strong>连海明</strong>字善之.啄文堂主人，河北邯郸人.现居北京。自幼酷爱书法，初学颜柳，后入当代欧楷大家田英章先生门下研习欧楷兼学行草。现为中国书法家协会考级中心教师，中国硬笔书法家协会会员，中国美术家画院副院长。</p>
</div>

<!-- 弹出层 -->
<div class="space">
  <a class="btn-tier" href="javascript:;"></a>
  <div class="space-layer">
    <a class="btn-close" href="javascript:;"><i class="iconfont-androidcancel"></i></a>
    <h2>您已领取成功</h2>
    <h4>请凭姓名或手机号码到店内领取</h4>
  </div>
</div>
<script>

</script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160411/js/total.js"></script>
<?php

$array['P']['title'] = "接福啦！中国书协名家亲手写的“福”字，免费领取！速来！";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160411/images/1.jpg";
$array['Y']['title'] = "接福啦！中国书协名家亲手写的“福”字，免费领取！速来！";
$array['Y']['desc'] = "太难得的福气，绝对不能错过!";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160411/images/1.jpg";

echo weixinShare($array);

?>