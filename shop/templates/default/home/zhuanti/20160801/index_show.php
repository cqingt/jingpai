<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/css/new_file.css"/>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>

<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/js/awardRotate.js"></script>    
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/js/reveal.js"></script>
	    <script type="text/javascript">
	        function rnd(n, m) {
	            return Math.floor(Math.random() * (m - n + 1) + n)
	        }

			function choujiang(){
				
				<?php if ($_SESSION['is_login'] !== '1'){?>
					login_dialog();
					return false;
				<?php } ?>
				var order_sn = $('#order_sn').val();
				if(order_sn == ''){
					alert('请输入订单号');
					return false;
				}

				var bRotate = false;
				var rotateFn = function (awards, angles, txt) {
	                bRotate = !bRotate;
	                $('#rotate').stopRotate();
	                $('#rotate').rotate({
	                    angle: 0,
	                    animateTo: angles + 1800,
	                    duration: 3000,
	                    callback: function () {
	                        alert(txt);
	                        bRotate = !bRotate;
	                    }
	                })
	            };
				
				if (bRotate)
					return;
				$.ajax({
					type:'post',
			        url:"index.php?act=zhuanti&op=ad_20160801&action=Cj",
			        data:{order_sn:order_sn},
			        dateType:'json',
			        success:function(html){
						 result=eval("("+html+")");
						if(result == -1){
							login_dialog();
						}else if(result.error){
							alert(result.error);
						}else{
							rotateFn(result.r_id, result.angles, result.msg);
							console.log(item);
						}
			        }
				});
			}
	        
	        
	        //GunDong
			$(function(){
				$(".list_lh").myScroll({
					speed:40, //数值越大，速度越慢
					rowHeight:68 //li的高度
				});
			});	        
	    </script>	    
		<div class="banner1">
			<div class="demo-wrap">
				<div class="count-down">
					<h2>距里约2016年</h2>
					<h4>奥运会闭幕还有</h4>
					<div class="colockbox" id="demo01">
						<span class="time day">00</span><span class="t">天</span>
						<span class="time hour">00</span><span class="t">时</span>
						<span class="time minute">00</span><span class="t">分</span>
						<span class="time second">00</span><span class="t">秒</span>
					</div>
				</div>
			</div>
		</div>
		<div class="banner2"></div>
		<div class="banner3"></div>
		<div id="n1" class="banner4"></div>
		
		<div class="photo1"></div>
		<div class="photo2"></div>
		<div class="photo3"></div>
		<div class="photo4"></div>
		<div id="n2" class="photo5"></div>	
		
        <div class="lottery-box photo5-1">
        	<div class="demo-wrap">
        		<!--CJ-->
			    <div class="turntable-bg">
			        <div class="pointer" onclick="choujiang();"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/pointer.png" alt="pointer" /></div>
			        <div class="rotate"><img id="rotate" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/turntable2.png" alt="turntable" /></div>
			    </div>
			    <!--CJ-->
			    
			    <div class="rule-title">活动规则</div>
			    <div class="tc-rule">
			    	为支持中国代表团在里约奥运辉煌夺冠，8月1日——8月21日0:00，在此期间购物产生的订单（注：是已付款订单），用户均可凭订单号参与抽奖，奖品丰厚!实物奖品需用户下单领取，代金券奖品将发放至“我的优惠券”，请在会员中心查找。
			    	<p>·如已参与抽奖订单发生退款退货，则需将所中奖品一同退回，否则将在退款中扣除奖品相应费用</p>
			    	<p>·本活动最终解释权归收藏天下所有</p>
			    </div>
			    <script type="text/javascript">
					$(function(){
						$(document).ready(function() {
						  $('.rule-title').hover(function(){
						      $('.tc-rule').show();
						  }, function(){
						      $('.tc-rule').hide();
						  });
						  
						   $('.tc-rule').hover(function(){
						      $(this).show();
						  }, function(){
						      $(this).hide();
						  });
						});
					})
					 
			    </script>
			    
			    <!--GD-->
				<div class="gdbox">
					<div class="bcon">
						<div class="list_lh">
							<ul>
								<?php foreach($output['MemberLotteryList'] as $k=>$v){?>
								<li>
									<p><strong><?php echo $v['member_name'];?></strong><em><?php echo $v['l_name'];?></em></p>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>			    
			    <!--GD-->
			    
			    <div class="demo-order">
			    	<input class="input" type="text" value="" placeholder="请输入订单号" name="order_sn" id="order_sn" />
			    	<input class="btn-button" type="button" value="抽奖" name="" id="" onclick="choujiang();"/>
			    </div>
			   
			    <a class="btn-look" <?php if ($_SESSION['is_login'] !== '1'){?>href="javascript:login_dialog();"<?php }else{ ?>  data-reveal-id="myModal" data-animation="fade"<?php }?>>
			    	查看我的奖品
			    </a>
			   							    
        	</div>
        </div>

		
		<div id="n3" class="photo5-2"></div>
		<div class="photo6">
			<div class="demo-wrap">
				<a class="btn1" href="javascript:void(0);" nctype="addblcart_submit" bl_id="16"></a>
				<a class="btn2" href="javascript:void(0);" nctype="addblcart_submit" bl_id="15"></a>
			</div>
		</div>	
		<div id="n4" class="photo11"></div>		
		<script>
		$(function(){
                $('a[nctype="addblcart_submit"]').click(function(){
                    addblcart($(this).attr('bl_id'));
                 });	
         });
	   /* add one bundling to cart */ 
		function addblcart(bl_id)
		{
			<?php if ($_SESSION['is_login'] !== '1'){?>
			   login_dialog();
			<?php } else {?>
				var url = 'index.php?act=cart&op=add';
				$.getJSON(url, {'bl_id':bl_id}, function(data){
					if(data != null){
						if (data.state)
						{
							window.location.href="index.php?act=cart";
						}
						else
						{
							showDialog(data.msg, 'error','','','','','','','','',2);
						}
					}
				});
			<?php } ?>
		}
		</script>
	    <!--tcc-->
		<div id="myModal" class="reveal-modalay">
		          <div class="con">
		               <div class="con-title">我的奖品</div>
		               <ul class="con-list">
					   
						<?php foreach($output['My_MemberLotteryList'] as $k=>$v){?>
						<li>
							<p class="name"><?php echo $v['l_name'];?></p>
							<p class="time"><?php echo date('Y-m-d H:i:s',$v['add_time']);?></p>
							<?php if($v['is_fafang'] == 1){ ?>
								<a class="btn2">已领取</a>
							<?php }else{ ?>
								<a class="btn1" href="javascript:;" goods-id="<?php echo $v['goods_id'];?>"  data-reveal-id="myModali" data-animation="fade" L-ID="<?php echo $v['id'];?>">领取</a>
							<?php }?>
						</li>
						<?php } ?>
								               	
					   </ul>
		          </div>
				   
			  <a class="close-reveal-modalay close-style"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/xxx.png" alt="" /></a>

			  	<div id="myModali" class="reveal-modalay">
						<input type="hidden" name="goods_id" id="goods_id" value='0'>
						<input type="hidden" name="l_id" id="l_id" value='0'>
				          <div class="con">
				           	 <div class="con-title">领取奖品</div>
					           	 <div class="form-box">
						           	 <div class="item">
						           	 	<label for="">姓名：</label>
						           	 	<input type="text" value="" name="true_name" id="true_name"/>
						           	 </div>
						           	 <div class="item">
						           	 	<label for="">手机号：</label>
						           	 	<input type="text" value="" name="mob_phone" id="mob_phone"/>
						           	 </div>		           	 
						             <div class="item">
						             	<label for="">地址：</label>
										  <div id="region">
									  <select style="" id='prov'></select>
										<input type="hidden" value="" name="city_id" id="city_id">
										<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
										<input type="hidden" name="area_info" id="area_info" class="area_names"/>
									 </div>   
						               			                
						             </div>
		                             <div class="item">
		                             	<label for="">详细地址：</label>
		                             	<input type="text" value="" name="address" id="address" />
		                             </div>
		                             <a class="btn-button" id="btnLingQu" href="javascript:;">领取</a>
	                            </div>
				          </div>
				          <a class="close-reveal-modalay close-style"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/xxx.png" alt="" /></a>
				</div>	
		</div>	
		<!--tcc-->		
		
		
		<div class="olympic-phone photo12">
			<div class="demo-wrap">
				<div id="demoHere" class="flexsliderzt">
					<ul class="slides">
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w1.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w2.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w3.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w4.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w5.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w6.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w7.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/w8.jpg" alt="" /></div></li>
					</ul>
				</div>								
				<div class="wechat">
					<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/wechat.jpg"/>
				</div>
			</div>
		</div>
		
		<div class="olympic-footer">
		    <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/images/olympic-footer.jpg"/>
		</div>
		
		<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/js/time.js" ></script>
		<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160801/js/slider.js"></script> 
		<script type="text/javascript">
		<?php if(time() <= 1470438000){ ?>
		$(function(){
				countDown("2016/8/6 07:00:00","#demo01 .day","#demo01 .hour","#demo01 .minute","#demo01 .second");
		});
		<?php }else{ ?>
		$(function(){
				countDown("2016/8/22 07:00:00","#demo01 .day","#demo01 .hour","#demo01 .minute","#demo01 .second");
		});
		<?php } ?>
		$(function(){
		$(document).ready(function(){
				regionInit("region");
			});
			$('#demoHere').flexsliderzt({
				animation: "slide",
				direction:"horizontal",
				easing:"swing"
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
				var lid = $('#l_id').val();
				$("#btnLingQu").attr("disabled",true);
				$.ajax({
					type:'post',
					url:"index.php?act=zhuanti&op=ad_20160801&action=lingqu",
					data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goods_id:goods_id,lid:lid},
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
			
		});
		</script>	