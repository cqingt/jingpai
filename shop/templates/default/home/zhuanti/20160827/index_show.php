	<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/css/new_file.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/css/component.css" />
	<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
 	<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/js/tabulous.js" ></script>
 	<script>
	$(function(){
		$('.tabs').tabulous({
			effect: 'scale'
		});
	});
	</script>  
	<div class="photo1"></div>
	<div class="photo2"></div>
	<div class="photo3"></div>
	<div class="demo-wrap">
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_05.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_07.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_08.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_09.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_10.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_11.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_12.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_13.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_14.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_15.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_16.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_17.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_18.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_19.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_20.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_21.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_22.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_23.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_24.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_25.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_26.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_27.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_28.jpg" alt="" />
		<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/images/photo_29.jpg" alt="" />
	</div>
    <div class="photo4"></div>
     <!-- 带md 的都是弹窗需要调用的东西 其它是我自己添加的 -->
     <!-- 弹窗的调用方法   class 和  data-modal 必须都要存在 -->
	 <!-- class="md-trigger" data-modal="modal-from1" -->

	<div class="btn-play md-trigger" data-modal="modal-from1"></div>
	
	<!-- 弹出层 Start -->
	<!-- md-effect-11 这个11你可以从1到19改变，它是CSS3动画，样式控制在component.css -->
	<div class="md-modal md-effect-11" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="">
	             
					<!-- Demo start 1-->
					<div class="tabs formbox" id='c1'>
						<ul class="tabsnav">
							<li><a href="#tabs-1" title="">注册</a></li>
						</ul>
						<div class="demo showscale" id="tabs-1">
		                  <span class="item">
		                  	<input type="text" id="user_name" name="user_name" value="" placeholder="请输入用户名" />
		                  </span>	
		                  <span class="item">
		                  	<input type="text" id="mobile" name="mobile" value="" placeholder="请输入手机号" />
		                  </span>   
		                  <span class="item-yz">
		                  	<input class="l" type="text" name="captcha_code" id="code" value="" placeholder="请输入验证码" />
		                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="点击获取验证码"/>
		                  </span>  
		                  <button class="tc-btn-vote mt" id="member_reg">立即领取</button>
		                  <p class="ts">我们郑重承诺：严格保护用户个人信息，绝不外泄</p>
						</div>
					</div>
					<!-- Demo end --> 

					<!-- Demo start 2-->
	     			<div class="demo formbox" id="c2" style="display: none;">
	     			  <h3>领取《中国纸币》</h3>
	                  <span class="item">
	                  	<input type="text" name="true_name" id="true_name" value="" placeholder="请输入收货人姓名" />
	                  </span>  
	                  <span class="item">
	                  	<input type="number" name="mob_phone" id="mob_phone" value="" placeholder="请输入收货人电话" />
	                  </span>  
	                  <span class="item-select" id="region">
	                    <select id='prov'></select>
						<input type="hidden" value="" name="city_id" id="city_id">
						<input type="hidden" name="area_id" id="area_id" class="area_ids"/>
						<input type="hidden" name="area_info" id="area_info" class="area_names"/>	                  	
	                  </span>
	                  <span class="item">
	                  	<input type="text" name="address" id="address" value="" placeholder="请输入详细地址" />
	                  </span>  	                  
	                  <p class="postage">由于图书贵重，邮费需自理哦（9.9元）</p>
	                  <button class="tc-btn-vote mt" id="btnLingQu">免费领取</button>
	                  <p class="what">为什么要收<em>运费</em>？</p>
	                  <p class="word">为高效的将银条送达客户手中，我们选择“顺丰、中通”等高质量快递公司，由于赠送数量大，赠品价格高昂，我们无法面向全国会员免邮。<em>但是，图书的价值要远远超越运费，请您放心领取。</em></p>
					</div>
					<!-- Demo end -->  
 
					<!-- Demo start 3-->
	     			<div class="demo formbox" id="c3" style="display: none;">
	                  <h1 class="yes">恭喜您注册成功</h1>
	                  <span class="celebrate">
	                  	<p>恭喜您成为收藏天下会员！</p>
	                  	<p>会员账号：<span id='user_namedf'>XXXXX</span></p>
	                  	<p>会员密码：<span id='pas_worddf'>XXXXX</span></p>
	                  	<strong>请登录官网及时修改密码</strong>
	                  	<strong>更多惊喜尽在<a href="http://www.96567.com/">96567.com</a></strong>
	                  </span>
	                  <button class="tc-btn-vote mt" id="member_df_login">确认</button>
					</div>
					<!-- Demo end -->  
 
 
                </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>

	        </div>
	    </div>
	</div>
	 
	 <!-- 这是遮罩 -->
	<div class="md-overlay"></div>	
	<!-- 弹出层 End -->
	

 

	<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/js/classie.js"></script>
	<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/js/modalEffects.js"></script>
	<script>
		var polyfilter_scriptpath = '<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160827/js/';
		
		$(document).ready(function(){
			regionInit("region");
		   
		});
		$(function() { 

			$(window).scroll(function() {       //页面滚动显示元素。
				if($(window).scrollTop()>=50){
					$(".btn-play").css('display','block'); 
				}else{
					$(".btn-play").css('display','none'); 
			}
			}); 
		}); 
	
	$("#member_df_login").bind("click", function() {
		$("#c3").hide();
		$("#c2").show();
	});

	$("#member_reg").bind("click", function() {
		var user_name = $.trim($("#user_name").val());
		var mobile = $.trim($("#mobile").val());
		var ua = "<?php echo $_GET['ua']?>";
		var code =  $('#code').val();
		$("#member_reg").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160827&action=regs",
			data:{user_name:user_name,mobile:mobile,ua:ua,code:code},
			dataType:'json',
			success:function(result){
				if(result.state){
					 $("#c1").hide();
					 $("#c3").show();
					 $("#user_namedf").html(result.username);
					 $("#pas_worddf").html(result.password);
					
				}else{
					alert(result.msg);
					$("#member_reg").attr("disabled",false);
				}
			}
		}); 
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
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160827&action=lingqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
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
            url:"index.php?act=zhuanti&op=getPhoneYzm",
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