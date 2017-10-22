<?php
$array['P']['title'] = "【收藏天下·里约奥运惠】特价奥运藏品限时抢购，银条、纪念钞说送就送！";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160801/images/100x100.jpg';
$array['Y']['title'] = "【收藏天下·里约奥运惠】特价奥运藏品限时抢购，银条、纪念钞说送就送！";
$array['Y']['desc'] = "为中国队加油！";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160801/images/100x100.jpg';
echo weixinShare($array);
?>	 
		<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/css/new_file.css"/>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/js/jquery-1.8.2.min.js" ></script>
	    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/js/awardRotate.js"></script>    
	    <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/js/reveal.js"></script>
	    <script type="text/javascript">
	       
	        function rnd(n, m) {
	            return Math.floor(Math.random() * (m - n + 1) + n)
	        }
	        
			function login_dialog(){
				window.location.href="http://m.96567.com/index.php?act=login&op=index";
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

		<div class="banner">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner1.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner2.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner3.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner4.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner5.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner6.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner7.jpg"/>
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/banner8.jpg"/>
		</div>
		
        <div class="lottery-box">
		    <div class="turntable-bg">
		    	<img class="award" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/award.jpg"/>
		        <div class="pointer" onclick="choujiang();"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/pointer.png" alt="pointer" /></div>
		        <div class="rotate"><img id="rotate" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/turntable2.png" alt="turntable" /></div>
		    </div>
		    
		    <div class="rule-title">活动规则</div>
		    <div class="tc-rule">
		    	为支持中国代表团在里约奥运辉煌夺冠，8月1日——8月21日0:00，在此期间购物产生的订单（注：是已付款订单），用户均可凭订单号参与抽奖，奖品丰厚!实物奖品需用户下单领取，代金券奖品将发放至“我的优惠券”，请在会员中心查找。
		    	<p>·如已参与抽奖订单发生退款退货，则需将所中奖品一同退回，否则将在退款中扣除奖品相应费用</p>
		    	<p>·本活动最终解释权归收藏天下所有</p>
		    </div>
		    <script type="text/javascript">
				$(function(){
					$(".rule-title").click(function(){
					  $(".tc-rule").show();
					});
					
					$(".tc-rule").click(function(){
					  $(".tc-rule").hide();
					});
				})
				 
		    </script>		    
		    
		</div>
	 
        <div class="lottery-box">
        	<img class="award2" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/award.jpg"/>
		    <div class="demo-order">
		    	<input class="input" type="text" value="" placeholder="请输入订单号" name="order_sn" id="order_sn" />
		    	<input class="btn-button" type="button" value="抽奖" name="" id="" onclick="choujiang();"/>
		    </div>    
		    <a class="btn-look" <?php if ($_SESSION['is_login'] !== '1'){?>href="javascript:login_dialog();"<?php }else{ ?>  data-reveal-id="myModal" data-animation="fade"<?php }?>>
		    	查看我的奖品
		    </a>		    
        </div>	 
        
	    <!--tcc-->
		<div id="myModal" class="reveal-modalzt">
			<img class="tcbox" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/tcbox.png" alt="" />
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
			  <a class="close-reveal-modal close-style"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/xxx.png" alt="" /></a>
			  
				<div id="myModali" class="reveal-modalzt">
					<input type="hidden" name="goods_id" id="goods_id" value='0'>
					<input type="hidden" name="l_id" id="l_id" value='0'>
					<img class="tcbox" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/tcbox.png" alt="" />
				          <div class="con">
				           	 <div class="con-title">领取奖品</div>
				           	 <form action="">
					           	 <div class="form-box">
						           	 <div class="item">
						           	 	<input type="text" value="" name="true_name" id="true_name" placeholder="姓名"/>
						           	 </div>
						           	 <div class="item">
						           	 	<input type="tel" value="" name="mob_phone" id="mob_phone" placeholder="手机号"/>
						           	 </div>		           	 
						             <div class="item">
									  <input type="hidden" value="" name="city_id" id="city_id">
									  <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
									  <input type="hidden" name="area_info" id="area_info" class="area_names"/>
						                 <select class="valid" name="prov" id="vprov">
											<option value="">-请选择-</option>
										</select>
										<select class="valid" name="city" id="vcity">
											<option value="">-请选择-</option>
										</select>
								   
										<select class="valid" name="region" id="vregion">
											<option value="">-请选择-</option>
										</select>			                
						             </div>
		                             <div class="item">
		                             	<input type="text" value="" name="address" id="address" placeholder="详细地址"/>
		                             </div>
		                             <a class="btn-button" href="javascript:;" id="btnLingQu" >领取</a>
	                            </div>
	                        </form>
				          </div>
				          <a class="close-reveal-modal close-style"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/xxx.png" alt="" /></a>
				</div>				  
			  
			  
		</div>	
		<!--tcc-->		
		
	    <!--GD-->
		<div class="gdbox">
			<img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/award3-1.jpg"/>
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
			<img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/award3-3.jpg"/>
		</div>			    
	    <!--GD-->		        
	    <div class="photo">
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s1.jpg"/>
	    	<a href="javascript:void(0);" nctype="addblcart_submit" bl_id="16"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s2.jpg"/></a>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s3.jpg"/>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s4.jpg"/>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s5.jpg"/>
	    	<a href="javascript:void(0);" nctype="addblcart_submit" bl_id="15"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s6.jpg"/></a>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s7.jpg"/>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/s8.jpg"/>
	    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/p1.jpg"/>
	    </div>	    
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
				var url = 'index.php?act=member_cart&op=cart_add';
				$.getJSON(url, {'bl_id':bl_id}, function(data){
					if(data != null){
						if (data.datas.error)
						{
							alert(data.datas.error);
						}
						else
						{
							window.location.href="index.php?act=member_cart&op=cart_list";
						}
					}
				});
			<?php } ?>
		}
		</script>
		<div class="olympic-phone">
			<div class="demo">
				<div id="demoHere" class="flexsliderzt">
					<ul class="slides">
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w1.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w2.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w3.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w4.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w5.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w6.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w7.jpg" alt="" /></div></li>
						<li><div class="img"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/w8.jpg" alt="" /></div></li>
					</ul>
				</div>		
			</div>
		</div>
		
		<div class="photo">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/p3.jpg"/>
		</div>	    
	    
		<div class="olympic-footer">
		    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/images/olympic-footer.jpg"/>
		</div>	    
		
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/js/gd.js" ></script>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160801/js/slider.js"></script> 
		<script type="text/javascript">
		$(function(){
		
			$('#demoHere').flexsliderzt({
				animation: "slide",
				direction:"horizontal",
				easing:"swing"
			});
			
		});

		//获取区域列表
        $.ajax({
            type:'post',
            url:"<?php echo urlWap('zhuanti','area_list')?>",
            data:'',
            dataType:'json',
            success:function(result){
                var data = result.datas;
                var prov_html = '';
                for(var i=0;i<data.area_list.length;i++){
                    prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                }
                $("select[name=prov]").append(prov_html);
            }
        });
	  $("select[name=prov]").change(function(){//选择省市
            var prov_id = $(this).val();
			if(prov_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=city]").html(region_html);
				return false;
				}
			
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('zhuanti','area_list')?>",
                data:{area_id:prov_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var city_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=city]").html(city_html);
                    $("select[name=region]").html('<option value="">-请选择-</option>');
                }
            });
        });

        $("select[name=city]").change(function(){//选择城市
            var city_id = $(this).val();
			if(city_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=region]").html(region_html);
				return false;
				}
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('zhuanti','area_list')?>",
                data:{area_id:city_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                }
            });
        });

		$("#btnLingQu").bind("click", function() {
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var prov_index = $('select[name=prov]')[0].selectedIndex;
		var city_index = $('select[name=city]')[0].selectedIndex;
		var region_index = $('select[name=region]')[0].selectedIndex;
		var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
		var prov = $('select[name=prov]').val();
		var city_id = $('select[name=city]').val();
		var area_id = $('select[name=region]').val();
		var address = $.trim($("#address").val());

		var goods_id = $('#goods_id').val();
		var lid = $('#l_id').val();
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"http://m.96567.com/index.php?act=zhuanti&op=ad_20160801&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goods_id:goods_id,lid:lid},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
	});
		</script>	
