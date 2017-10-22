<link type="text/css" rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/css/style.css"/>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/sweetalert.min.js"></script>
<script language="javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/common.js"></script>

<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/zDrag.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/zDialog.js"></script>
<script type="text/javascript">
function open17(val)
{
	$.ajax({ 
		type: 'POST', 
		url: 'index.php?act=zhuanti&op=ad_20151111&action=youhui_ajax', 
		dataType: 'json', 
		cache: false, 
		error: function(){ 
			if(confirm("连接中断，请刷新后重试。"))
			 {
				 window.location.href="index.php?act=zhuanti&op=ad_20151111";
			 }
			 else
			 {
				  return false;
			 }
			return false; 
		}, 
		success:function(json){ 
			var error = json.error; //错误
			if(error == -1){//未登录跳转到登录页面
				window.location.href="index.php?act=login&op=index";
				return false; 
			}else if(error == -2){//已经领取过了
				alert('您已领取过，不可重复领取！');
				return false; 
			}else if(error == -3){//活动时间结束
				alert('活动已结束');
				return false; 
			}else{
				var diag = new Dialog();
				diag.AutoClose=2;
				diag.ShowCloseButton=false;
				diag.URL = "<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/t1.html";
				diag.Height = 96;
				diag.show();
			}
		} 
	}); 
	
}
	function open16(val)
	{
		var diag = new Dialog();
		diag.AutoClose=false;
		diag.ShowCloseButton=false;
		diag.URL = "<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/t2.html#l_id="+val;
		diag.Height = 240;
		diag.show();
	}
</script>

<div class="hdWrap rec">
     <a href="#floor1"></a>
     <a href="#floor2"></a>
     <a href="#floor3"></a>
</div>
<div class="oneWrap rec" id="floor1"></div>

<div class="couponWrap rec">
	 <div class="wrap immpo">
	 	  <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/coupon.jpg" alt="">
		  <a class="immediately" href="http://1.96567.com/" target="_blank"></a>
	 </div>
</div>

<div class="keyWrap rec">
	 <div class="wrap">
	 	  <a href="javascript:;" onclick="open17(1)">一键领取1111元大礼包</a>
	 </div>
</div>

<div class="threeWrap rec" id="floor2"></div>

<div class="awardWrap rec">
	 <div class="wrap">
	 	  <div class="Winning-box">
		       <ul class="investment_title">
		           <li class="on">中奖名单</li>
		           <li>我的中奖纪录</li>
		       </ul>
		       <div class="investment_con">
			        <div class="investment_con_list">
                         <div class="award-title">
                         	  <p class="p1">会员名</p>
                         	  <p class="p2">中奖时间</p>
                         	  <p class="p3">奖项</p>
                         </div>
						 <div class="slide_module" id="miaovSlide">
						      <div id="gun">
							       <ul>
									<?php foreach ($output['SuoYouLotteryList'] as $v){?>
                                     <li>
                                     	<p class="p1"><?php echo $v['member_name'];?></p>
                                     	<p class="p2"><?php echo date("Y-m-d",$v['add_time']);?></p>
                                     	<p class="p3"><?php echo $v['l_name'];?></p>
                                     </li>
                                    <?php }?>
							       </ul>
						      </div>
						 </div>
			        </div>
			        <div class="investment_con_list">
                         <div class="award-title inv-title">
                         	  <p class="p1">中奖时间</p>
                         	  <p class="p2">奖项</p>
                         	   <p class="p3">状态</p> 
                         </div>
			             <ul class="winning-record">
						 <?php foreach ($output['MyLotteryList'] as $v){?>
			             	 <li>
			             	 	<p class="p1"><?php echo date("Y-m-d",$v['add_time']);?></p>
                                <p class="p2"><?php echo $v['l_name'];?></p>
                                <!--已发放/已领取/未领取 -->
								<?php if($v['is_fafang'] == 0){
								?>
                                <p class="p3"><a href="javascript:;" onclick="open16(<?php echo $v['id'];?>)">未领取</a></p> 
								<?php
								}
								else{
								?>
								<?php if($v['order_sn']){
								?>
                                <p class="p3"><a>已发放</a></p> 
								<?php
								}
								else{
								?>
								<p class="p3"><a>已领取</a></p> 
								<?php
								} ?>
								<?php
								} ?>
			             	 </li>
							 <?php }?>
			             </ul>
			        </div>
		       </div>
	      </div>
		  <!-- Gun Dong Start -->
		  <script type="text/javascript">
			    window.onload = function () {
			    	var oId =document.getElementById('gun')
			        var oUl = oId.getElementsByTagName('ul')[0];
			        var liArr = oUl.getElementsByTagName('li');
			        var speed = -1;
			        oUl.innerHTML += oUl.innerHTML;
			        var ulHeigth = oUl.offsetHeight;
			        setInterval(function () {
			            if (oUl.offsetTop < -ulHeigth / 2)
			                oUl.style.top = '0px';
			            else if (oUl.offsetTop > 0)
			                oUl.style.top = -ulHeigth / 2 + 'px';
			            oUl.style.top = oUl.offsetTop + speed+'px';
			        }, 30);
			    }
		  </script>
		  <!-- Gun Dong End -->

	 	  <div class="Lottery-box">
	 	  	   <!-- 抽奖 Start  -->
			   <div class="cjym_conter">
			      <div class="cjym_left">
			          <!--转盘开始--> 
			            <div class="cjzy_zhuanpan">
						<style type="text/css">
						    .demo{ position:relative;}
						    #disk{ width:507px; margin-right: 25px; height:508px; float: right;}
						    #start{width:165px; height:auto; position:absolute; top:94px; right:196px;}
						    #start img{cursor:pointer; width:100%;}
						</style>
			            <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/jQueryRotate.2.2.js"></script>
			            <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/jquery.easing.min.js"></script>
			            <script type="text/javascript">
		
			function lottery(){
			$.ajax({ 
				type: 'POST', 
				url: 'index.php?act=zhuanti&op=ad_20151111&action=lottery_ajax', 
				dataType: 'json', 
				cache: false, 
				error: function(){ 
					if(confirm("连接中断，请刷新后重试。"))
					 {
						 window.location.href="index.php?act=zhuanti&op=ad_20151111";
					 }
					 else
					 {
						  return false;
					 }
					return false; 
				}, 
				success:function(json){ 
					var a = json.angle; //角度 
					var p = json.prize; //奖项 
					var error = json.error; //错误
					if(error == -1){//未登录跳转到登录页面
						window.location.href="index.php?act=login&op=index";
						return false; 
					}else if(error == -2){
						alert("您尚未获得抽奖次数，明天再来或者去下单吧");
						return false;
					}else if(error == -3){
						alert("您的抽奖次数已用完，明天再来或者去下单吧")
						return false;
					}else if(error == -4){
						alert("对不起，活动已结束。")
						return false;
					}else{
						$("#startbtn").unbind('click').css("cursor","default"); 
						$("#startbtn").rotate({ 
							duration:3000, //转动时间 
							angle: 0, 
							animateTo:3600+a, //转动角度 
							easing: $.easing.easeOutSine, 
							callback: function(){
								if(confirm(p+'\n还要再来一次吗？'))
								 {
									lottery();
								 }
								 else
								 {
									  return false;
								 }
							} 
						});
					}
				} 
			}); 
			} 
			</script>

						 <div class="demo">
								<div id="disk" style="background:url(<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/circle.png); background-repeat:no-repeat;"></div>
								<div id="start" style="background:url(<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/start_font.png); background-repeat:no-repeat;"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/start_bg.png" id="startbtn" onclick="lottery()"></div>
						  </div>
						</div>    
			         </div>
			     </div>      
			   </div>
	 	  	   <!-- 抽奖 End  -->
	 	  </div>
	 </div>
</div>

<div class="forWrap rec"></div>

<div class="shopWrap rec">
	 <div class="wrap">
          <ul>
          	 <li>
          	 	<a class="a1" href="http://www.96567.com/goods-11146.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/20151111a1.jpg" alt=""></a>
          	 	<a class="a2" href="http://www.96567.com/goods-11146.html" target="_blank">
          	 	   中国美术家协会理事 吴冠中版画《小双燕》
          	 	</a>
          	 	<p><i>¥</i>3280.00</p>
          	 </li>
          	 <li>
          	 	<a class="a1" href="http://www.96567.com/goods-9123.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/20151111a2.jpg" alt=""></a>
          	 	<a class="a2" href="http://www.96567.com/goods-9123.html" target="_blank">
          	 	   官春英工笔精品《花间记》团面
          	 	</a>
          	 	<p><i>¥</i>1980.00</p>
          	 </li>
          	 <li>
          	 	<a class="a1" href="http://www.96567.com/goods-8146.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/20151111a3.jpg" alt=""></a>
          	 	<a class="a2" href="http://www.96567.com/goods-8146.html" target="_blank">
          	 	   中国书协会员 郭友华《般若波罗蜜多心经》
          	 	</a>
          	 	<p><i>¥</i>3500.00</p>
          	 </li>
          	 <li>
          	 	<a class="a1" href="http://www.96567.com/goods-10733.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/20151111a4.jpg" alt=""></a>
          	 	<a class="a2" href="http://www.96567.com/goods-10733.html" target="_blank">
          	 	   中国人民抗日战争暨世界反法西斯战争胜利70周年普通纪念币 单枚
          	 	</a>
          	 	<p><i>¥</i>8.00</p>
          	 </li>
          </ul>
	 </div>
</div>

<div class="fiveWrap rec" id="floor3"></div>

<div class="sixWrap rec">
	 <div class="wrap">
	 	  <ul class="exempt">
			<?php foreach ($output['goods_list'] as $v){?>
	 	  	  <li>
	 	  	 	 <a class="shop-img" href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['image_url'];?>" alt=""></a>
	 	  	 	 <div class="exe-box">
	 	  	 	 	  <h1><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['xianshi_name'];?></a></h1>
	 	  	 	 	  <h4><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></h4>
                      <div class="p-rmb">
                      	   <p class="r1"><i>原价¥</i><?php echo intval($v['goods_price']);?></p>
	 	  	 	 	       <p class="r2"><i>限时¥</i><?php echo intval($v['xianshi_price']);?></p>
                      </div>
	 	  	 	 	  <a class="me-exempt" href="<?php echo $v['goods_url'];?>" target="_blank">立刻抢购</a>
	 	  	 	 </div>
	 	  	  </li>
	 	  	  <?php }?>
	 	  </ul>




          <div class="wrap footer">
          	   <a href="index.php " target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/images/look.jpg" alt=""></a>
          </div>
	 </div>
</div>