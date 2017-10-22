<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/css/new_file.css"/>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/js/new_file.js" ></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/js/xcConfirm.js"></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/js/jq_scroll.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		$("#scrollDiv-one1").Scroll({line:1,speed:500,timer:3000});
        $("#scrollDiv-one2").Scroll({line:1,speed:500,timer:3000});
		$("#scrollDiv-two").Scroll({line:1,speed:500,timer:3000,up:"but_up",down:"but_down"});
});

var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
    var now_time = Date.parse(new Date()) / 1000;
    //alert(now_time);
    var Diffs = time -now_time;				
    if(t == 2){
        var html = '<p>距结束</p>';
    }else{
        var html = '<p>距开始</p>';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;
	html += '<p>剩余';
    if(DifferHour > 0){
        html += DifferHour+"时";
    }
    if(DifferMinute > 0){
        html += DifferMinute+"分";
    }
    html += Diffs+"秒";
	html += '</p>';
    document.getElementById("leftTime"+key).innerHTML =html;
}
</script>

		<div class="banner">
			<div class="banner-01"></div>
			<div class="banner-02"></div>
			<div class="banner-03"></div>
			<div class="banner-04"></div>
			<div class="banner-05"></div>
		</div>
		
		<div class="navigation">
			<div class="nav w">
			    <a class="nav-01" href="#nav1"></a>
			    <a class="nav-02" href="#nav2"></a>
			    <a class="nav-03" href="#nav3"></a>
			    <a class="nav-04" href="#nav4"></a>
			    <a class="nav-05" href="#nav5"></a>
			    <a class="nav-06" href="#nav6"></a>
	    	</div>		
		</div>
		
		<div class="send-money" id="nav1">
			<div class="moneybox w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/money.jpg"/></div>
			    <h2 class="headline-h2">360元红包和10万面额外国真钞大放送</h2>
			    <a class="btn-eye" href="javascript:;" id="btn1">查看活动规则</a>
			    <div class="coupon">
			    	<div class="coupon1">
			    		
					<a href="javascript:void(0);" onclick="lingqu(1);"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/Coupon_01.jpg"/></a>
					<a href="javascript:void(0);" onclick="lingqu(2);"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/Coupon_03.jpg"/></a>
	
				</div> 
			    <div class="coupon1">
			    	<a href="javascript:void(0);" onclick="lingqu(3);"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/Coupon_02.jpg"/></a>
			    	<a href="javascript:void(0);" onclick="lingqu(4);"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/Coupon_04.jpg"/></a>
			  </div> 
			    	<div class="coupon2">
			    		<a href="javascript:void(0);" onclick="lingqu(5);"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/Coupon_05.jpg"/></a>
			    	</div> 			    	
			    </div>
			    <div class="coupon-bottom"></div>
			    <a class="btn-coupon " href="javascript:void(0);" onclick="lingqu(6);"></a>
			</div>
		</div>

		<div class="free-postage inter-cut" id="nav3">
			<div class="w">
			   <a href="http://www.96567.com/goods-15597.html#id=indexlh" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/inter-cut.jpg"></a>
			</div>			
		</div>

        <!-- 抽奖 s -->
		<div class="lucky-draw" id="nav2">
			<div class="w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/lucky-draw.jpg"/></div>
			    <h2 class="headline-h2">每日30件豪礼 掐指一算无敌幸运星就是你</h2>
			    <a class="btn-eye" href="javascript:;" id="btn2">查看活动规则</a>
			    
			    <!-- 奖 s -->
				<div class="main2">
					<div class="container">
						<div class="num num1">
							<div class="num-con num-con1">
								<div class="num-img"></div>
								<div class="num-img"></div>
							</div>
						</div>
						<div class="num num2">
							<div class="num-con num-con2">
								<div class="num-img"></div>
								<div class="num-img"></div>
							</div>
						</div>
						<div class="num num3">
							<div class="num-con num-con3">
								<div class="num-img"></div>
								<div class="num-img"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="main3">
					<div class="container">
						<div class="main3-btn">
						
						<?php if($output['is_qian_dao'] == 1){ ?>
							<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/go2.jpg" id="main3-btn-type" qian-dao-caou-jiang="2"></div>
						<?php }else{ ?>
							<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/go1.jpg" id="main3-btn-type" qian-dao-caou-jiang="1"></div>
						<?php } ?>
					</div>
				</div>			    
			    <!-- 奖 a -->
			    
			    <!-- 滚动切换 s -->
			    <ul class="award-nav investment_title">
			    
				<li class="on">中奖公告</li>
			    	<?php if(intval($_SESSION['member_id'] > 0)) {?><li>我的中奖纪录</li>
<?php }?>	  
					</ul>
			    <div class="award-word investment_con">
			    	
				<div id="scrollDiv-one1" class="word">
			    	
				<ul>
			    
				<?php if($output['SuoYouLotteryList']){?>
				<?php foreach ($output['SuoYouLotteryList'] as $v){?>
				<li>
				   <p class="p1"><?php echo date("Y-m-d H:i",$v['add_time']);?></p>
				   <p class="p2"><?php echo  substr($v['member_name'],0,3).'***';?></p>
				   <P class="p3"><?php if($v['l_id'] == 3){ echo '未中奖';}else{ echo $v['l_name'];}?></P>
				</li>
				<?php } ?>
				<?php }else{ ?>
				<li>
					无中奖信息
				</li>
				<?php } ?>
				    			
			    		</ul>
			    	</div>
			    	<div id="scrollDiv-one2" class="word">
			    		
					<ul>

					 <?php if($output['MyLotteryList']){?>
						  <?php foreach ($output['MyLotteryList'] as $v){?>
                             <li>
							   <p class="p1"><?php echo date("Y-m-d H:i",$v['add_time']);?></p>
							   <p class="p2"><?php if($v['l_id'] == 3){ echo '未中奖';}else{ echo $v['l_name'];}?></p>
							   <!--已发放/已领取/未领取 -->
								<?php if($v['is_fafang'] == 0){
								?>
                                <p class="p3"><a href="javascript:;" onclick="open16(<?php echo $v['id'];?>,<?php echo $v['l_id'];?>)">未领取</a></p> 
								<?php
								}
								else{
								?>
								<?php if($v['order_sn']){
								?>
                                <p class="p3">已发放</p> 
								<?php
								}
								else{
								?>
								<p class="p3">已领取</p> 
								<?php
								} ?>
								<?php
								} ?>
						     </li>
							<?php } ?>
							<?php }else{ ?>
							<li>
								无中奖信息
							</li>
							<?php } ?>
			    					
			    		</ul>			    		
			    	
						</div>
			    
						</div>
			    
			    <!-- 滚动切换 a -->
			    
			</div>
		</div>
		<!-- 抽奖 a -->
		<script type="text/javascript">
		
			
			$(".main3-btn").click(function () {
				var type = $('#main3-btn-type').attr('qian-dao-caou-jiang');
				if(type == 1){ //签到
					$.ajax({
						type:'post',
						url:"index.php?act=zhuanti&op=ad_20160518&action=QianDao",
						data:{},
						dataType:'json',
						success:function(result){
							 if(result.msg == -1){//未登录
								loginBg();
								return false;
							  }else if(result.state){
								var txt=  "<p>"+result.msg+"</p>";
								var option = {
									title: "提示信息：",										
								}
								window.wxc.xcConfirm(txt, "custom", option);
								$(".main3-btn").html('<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/go2.jpg" id="main3-btn-type" qian-dao-caou-jiang="2">');
							  }else{
								var txt=  "<p>"+result.msg+"</p>";
								var option = {
									title: "提示信息：",										
								}
								window.wxc.xcConfirm(txt, "custom", option);
							  }
							
						}
					}); 
				}else if(type == 2){ //抽奖
					if(!flag){
						flag=true;
						reset();
						setTimeout(function () {
							flag=false;
							if(index==2){
								$(".fix,.pop-form").show();
							}else{
								$(".fix,.pop").show();
								$(".pop-text span").text(""+String(4-TextNum1)+(8-TextNum2))
							}					
							showBg(); //中奖弹窗			
						},4000);
						index++;
					}
				}
			
			});
	
			var flag=false;
			var index=0;
			var TextNum1
			var TextNum2
			var TextNum3
	
		function letGo(rid){
			if(rid == 0){
				TextNum1=0
				TextNum2=4
				TextNum3=2
			}else if(rid == 1){
				TextNum1=1
				TextNum2=3
				TextNum3=0
			}else if(rid == 2){
				TextNum1=2
				TextNum2=1
				TextNum3=6
			}else{
				TextNum1=0
				TextNum2=3
				TextNum3=6	
			}
	
			var num1=[-549,-668,-786,-904][TextNum1];//在这里随机
			var num2=[-1377,-1495,-1614,-430,-549,-668,-786,-904][TextNum2];
			var num3=[-1377,-1495,-1614,-430,-549,-668,-786,-904][TextNum3];
			$(".num-con1").animate({"top":-1140},1000,"linear", function () {
				$(this).css("top",0).animate({"top":num1},1000,"linear");
			});
			$(".num-con2").animate({"top":-1140},1000,"linear", function () {
				$(this).css("top",0).animate({"top":num2},1800,"linear");
			});
			$(".num-con3").animate({"top":-1140},1000,"linear", function () {
				$(this).css("top",0).animate({"top":num3},1300,"linear");
			});
	
		}
	
		function reset(){
			$(".num-con1,.num-con2,.num-con3").css({"top":-430});
		}			
		
		</script>
		
		
		<div class="free-postage" id="nav3">
			
			<div class="w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/free-postage.jpg"/></div>
			    <h2 class="headline-h2">纪念钞9.9包邮到家  迎接新会员不玩虚的</h2>
			    <a class="btn-eye eye-red" href="javascript:;" id="btn4">查看活动规则</a>
			    <a class="free-postage-add" href="javascript:;" onclick="btn_9_9();"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/free-postage-add.jpg"/></a>
			</div>			
		</div>
		
		<div class="value-for-money" id="nav4">
			<div class="w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/value-for-money.jpg"/></div>
			    <h2 class="headline-h2">每日8款  捡漏儿就现在</h2>		
			    
			    <div class="everyday">
			    	
			    	<!--装饰品 s-->
			    	<div class="line2"></div>
			    	<div class="line3"></div>
			    	<!--装饰品 a-->

			    	
			    	<!-- day1 day2 day3 是三种状态的切换 -->

					<?php
					   $H = date("H",time());
					   if($H >= 0 && $H < 17){
							$H=10; //十点档秒杀
					   }else{
							$H=17; //十七点档秒杀
					   }
					?>
					
					<?php foreach($output['miaosha_list'][$H] as $k=>$v){ ?>
						<div <?php if($v['end']=='1'){ ?> class="day day1" <?php }elseif($v['end']=='2'){ ?>  class="day day2" <?php }else{ ?> class="day day3" <?php } ?>>

						   <?php if($v['end']=='1'){ ?>
								<div class="time-limit">
									<p>该秒杀已经结束</p>
								</div>
						   <?php }elseif($v['end']=='2'){ ?>
								<div class="time-limit" id="leftTime<?php echo $v['miaosha_id'];?>">
									<p>距结束</p>
									<p>剩余0时0分0秒</p>
								</div>
						   <?php }else{ ?>
							<div class="time-limit" id="leftTime<?php echo $v['miaosha_id'];?>">
								<p>距开始</p>
								<p>剩余0时0分0秒</p>
							</div>
						   <?php } ?>
							<script type="text/javascript">
								<?php if($v['end']=='2'){?>
								window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
								<?php }elseif($v['end']=='3'){ ?>
								window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
								<?php } ?>
							</script>

							<div class="seckill">
			    			
							<div class="seckill-img">
			    				
								<a  href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['goods_image'];?>" alt="<?php echo $v['goods_name'];?>" />
	
								</a>
							</div>
								<h2><?php echo $v['goods_name'];?></h2>
								<p>秒杀价<em>¥</em><em><?php echo intval($v['miaosha_price']);?></em></p>
								<strong>原价：<?php echo $v['goods_price'];?></strong>
								<?php if($v['end']=='1'){ ?>								
								<a class="btn-sec" href="<?php echo $v['goods_url'];?>" target="_blank">该秒杀已结束</a>
							   <?php }elseif($v['end']=='2'){ ?>
									<a class="btn-sec" href="<?php echo $v['goods_url'];?>" target="_blank">立即秒杀</a>
							   <?php }else{ ?>
									<a class="btn-sec" href="<?php echo $v['goods_url'];?>" target="_blank">即将开始</a>
							   <?php } ?>
									    		
							</div>
		
							
						</div>
					<?php } ?>
			    		</div>
			    
			</div>
		</div>
		
		<div class="lowest-price"  id="nav5">
			<div class="w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/lowest-price.jpg"/></div>
			    <h2 class="headline-h2">惊爆价 <strong>同品相价不同</strong> 买贵了白送</h2>
			    <a class="btn-eye" href="javascript:;" id="btn5">查看活动规则</a>
			    <div class="word-add"></div>
			    
			    <div class="lp-ad">
			    	<a href="http://www.96567.com/goods-17163.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/lp-ad1.jpg"/></a>
			    	<a href="http://www.96567.com/goods-16091.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/lp-ad2.jpg"/></a>
			    </div>
			    
			    <ul class="shop-list">
			    	
				<?php foreach($output['goods_list'] as $k=>$v){ ?>
				<li>
			    		<a href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank">
				    		<div class="shopimg">
				    			<img src="<?php echo cthumb($v['goods_image'], 240, $v['store_id']);?>" alt="<?php echo $v['goods_name'];?>"/>
				    		</div>
				    		<span>积<?php echo intval($v['goods_promotion_price'])*3;?>分</span>
				    		<h2><?php echo $v['goods_name'];?></h2>
			    		</a>
			    		<p>惊爆价<em> ¥</em><em><?php if(intval($v['goods_promotion_price']) > 0){ echo intval($v['goods_promotion_price']); }else{ echo intval($v['goods_price']); }?></em><a href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank">购买</a></p>
			    	</li>
				<?php } ?>
	
			    </ul>
			</div>			
		</div>
		
		<div class="free-postage priority-have"  id="nav6">
			<div class="w">
			    <div class="headline"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160518/images/have.jpg"/></div>
			    <h2 class="headline-h2">填写10字以上五星好评 返现金5元</h2>
			    <p class="eye">PS.仅限5月18日至28日的五星好评有返现哦，活动结束3个工作日内到账！</p>
			     
				<div class="rio-comment">
					<div id="scrollDiv-two">
					<ul>
			<?php if(!empty($output['goodsevallist']) && is_array($output['goodsevallist'])){?>
            <?php foreach($output['goodsevallist'] as $k=>$v){?>
						<li>
							<div class="commentimg">
								<img src="<?php echo getMemberAvatarForID($v['geval_frommemberid']);?>" >
							</div>
							<div class="alllist">
								<p>
									<strong class="name">
					<?php if($v['geval_isanonymous'] == 1){?>
                  <?php echo str_cut($v['geval_frommembername'],2).'***';?>
                  <?php }else{?>
                      <?php echo str_cut($v['geval_frommembername'],2).'***';?>
                  <?php }?></strong>
									<em class="time">[<?php echo @date('Y-m-d',$v['geval_addtime']);?>]</em>
									<strong class="object">评论对象：<a href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['geval_goodsid']));?>" target="_blank"><?php echo $v['geval_goodsname'];?></a></strong>
								</p>
								<p>用户评论：
								 <span class="raty" data-score="<?php echo $v['geval_scores'];?>">
								 	
								 </span>
								</p>
								<p class="last">
								  <span>
								  	评论详情：
								  </span>
								 <span class="remark">
								 	<?php echo $v['geval_content'];?>
								 </span>
								</p>
							</div>
						</li>
						<?php }?>
						<?php }?>			
					</ul>
					</div>
					    <a class="btn-comment" <?php if(time() < '1463500800'){ echo 'href="javascript:;" onclick="tishi();"';}else{ ?>href="http://www.96567.com/index.php?act=member_order&recycle=&state_type=state_success"  target="_blank"<?php }?> >我要评论</a>
					
<!--					<div class="scroltit"><div class="updown" id="but_down">向上</div><div class="updown" id="but_up">向下</div></div>-->
				</div>	
				
				<a class="btn-top" href="#"></a>
			
			</div>			
		</div>		
		
		
		
		
		<div class="popup">
		   <!-- 弹窗 -->
		   <div id="dialog" class="content">
		     <input type="hidden" name="type" id="type" value="0">
			  <input type="hidden" name="lid" id="lid" value="0">
		     <a class="close" href="javascript:;" onclick="closeBg();"></a>
		     <h2 id="J_name">恭喜您抽中****1件</h2>
		     <h4 id="TiShiXinXi">请认真填写收货信息，以确保奖品能准确的寄到您的手中。</h4>
		     <div class="row">
		         
				 <label for="">姓名</label>
		         <input type="text" name="true_name" id="true_name" value="">		     	
		  
			 </div>
		     <div class="row">
		         <label for="">手机</label>
		         <input type="text" value="" name="mob_phone" id="mob_phone">		     	
		     </div>
		     <div class="row">		     
			     <label for="">省市</label>
			     <div class="select" id="region">
			      <select style="" class="valid" id='prov'>
					</select>
					<input type="hidden" value="" name="city_id" id="city_id">
					<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
					<input type="hidden" name="area_info" id="area_info" class="area_names"/>
			     </div>
		     </div>
		     <div class="row">
		         <label for="">街道</label>
		         <input type="text" name="address" id="address" value="">		     	
		     </div>
		     <h5 id="df_yuan">生成订单后您需要支付的金额为：0元</h5>
		     <input class="rio-button" type="button" id="btnLingQu" value="提交订单">  
		   </div>
<div id="login" class="content only-login" >
		     <a class="close" href="javascript:;" onclick="closeBg();"></a>
		     <ul class="login-and-register df_investment_title">
                 <li class="on">登录</li>
                 <li>注册</li>
		     </ul>
             <div class="df_investment_con">
	             <div class="tab-content">
				     <div class="row">
				         <label for="">账号</label>
				         <input type="text" value="" name="log_name" id="log_name">		     	
				     </div>
				     <div class="row">
				         <label for="">密码</label>
				         <input type="password" value="" name="log_password" id="log_password">		     	
				     </div>
				     <input class="rio-button" type="button"  id="member_login" value="登录">
	             </div>		     
	             <div class="tab-content">
						<div class="">     
						      <dl>
						          <label>用户名</label>
						          <dd style="min-height:54px;">
						            <input id="user_name" name="user_name" class="text tip valid" title="3-15位字符，可由中文、英文、数字组成" autofocus="" type="text">
					 
						          </dd>
						        </dl>
						        <dl>
						          <label>设置密码</label>
						          <dd style="min-height:54px;">
						            <input id="password" name="password" class="text tip valid" title="6-20位字符，可由英文、数字及标点符号组成" type="password">
						   
						          </dd>
						        </dl>
						        <dl>
						          <label>确认密码</label>
						          <dd style="min-height:54px;">
						            <input id="password_confirm" name="password_confirm" class="text tip" title="请再次输入您的密码" type="password">
					 
						          </dd>
						        </dl>
						      <dl>
						          <label>手机</label>
						          <dd style="min-height:54px;">
						              <input id="mobile" name="mobile" class="text tip" title="请输入常用的手机号，将用来找回密码、接受订单通知等" type="text">
				 
						          </dd>
						      </dl>
							  <dl>
								  <label>验证码</label>
								  <dd>
									  <input name="captcha_code" id="code" type="text" style="width:80px;">
									  <input class="verify" type="button" value="获取验证码" onclick="getPhoneYzm();" name="getYzm" id="getYzm">
								  </dd>
								</dl>
                              <input id="member_reg" value="立即注册" class="submit rio-button" title="立即注册" type="button">
						    </div>              
	             </div>
             </div>
		   </div>
		   <!-- 遮罩层 -->
		  <a id="fullbg" class="mask-layer" href="javascript:;" ></a>
</div>
<script>
$(document).ready(function(){
	regionInit("region");
   
});
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script> 
<script type="text/javascript">
function tishi(){
	alert("点评有礼活动于5月18日0点开启，敬请期待！");
}
$(document).ready(function(){
   $('.raty').raty({
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
        readOnly: true,
        score: function() {
          return $(this).attr('data-score');
        }
    });

   $('a[nctype="nyroModal"]').nyroModal();
});


$("#btnLingQu").bind("click", function() {
	 $('#city_id').val($('#region').find('select').eq(1).val());
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var area_info = $.trim($("#area_info").val());
		var city_id = $.trim($("#city_id").val());
		var area_id = $.trim($("#area_id").val());
		var address = $.trim($("#address").val());
		var prov = $.trim($("#prov").val());
		var goods_id = $('#goods_id').val();
		var type = $('#type').val();
		var lid = $('#lid').val();
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160518&action=linqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goods_id:goods_id,type:type,lid:lid},
			dataType:'json',
			success:function(result){
				if(result.state){
					//alert('领取成功');
					//$("#btnLingQu").attr("disabled",false);
					window.location.href="http://www.96567.com/shop/index.php?act=buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					var txt=  "<p>"+result.msg+"</p>";
					var option = {
						title: "提示信息：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
});
$("#member_login").bind("click", function() {
	var user_name = $.trim($("#log_name").val());
	var password = $.trim($("#log_password").val());
	$("#member_login").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=login",
		data:{user_name:user_name,password:password},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="http://www.96567.com/index.php?act=zhuanti&op=ad_20160518";
			}else{
				var txt=  "<p>"+result.error+"</p>";
				var option = {
					title: "提示信息：",										
				}
				window.wxc.xcConfirm(txt, "custom", option);
				$("#member_login").attr("disabled",false);
			}
		}
	}); 
});

$("#member_reg").bind("click", function() {
	var user_name = $.trim($("#user_name").val());
	var password = $.trim($("#password").val());
	var password_confirm = $.trim($("#password_confirm").val());
	var mobile = $.trim($("#mobile").val());
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160518&action=regs",
		data:{user_name:user_name,password:password,password1:password_confirm,mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="http://www.96567.com/index.php?act=zhuanti&op=ad_20160518";
			}else{
				var txt=  "<p>"+result.msg+"</p>";
				var option = {
					title: "提示信息：",										
				}
				window.wxc.xcConfirm(txt, "custom", option);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});

 function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#user_name").val();
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
</script>