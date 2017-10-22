<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/css/default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/css/component.css" />
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/js/tabulous.js"></script>
<script>
$(function(){
	$('.tabs').tabulous({
		effect: 'scale'
	});
});
</script>    

<?php 
if(!empty($_SESSION['is_login']) && (!empty($output['member_weixin_info']) || !empty($output['member_weixin_info']['dianzan']))){
	$array['P']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	$array['P']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_SESSION['openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_SESSION['openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['Y']['desc'] = '万人疯抢，一元一克【包邮】，再不帮忙抢就没了！！';
	$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	echo weixinShare($array,urlWap('zhuanti','ad_20160719'));
}elseif(!empty($_SESSION['is_login']) && !empty($output['member_weixin_info_push_this'])){
	$array['P']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	$array['P']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_SESSION['openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_SESSION['openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['Y']['desc'] = '万人疯抢，一元一克【包邮】，再不帮忙抢就没了！！';
	$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	echo weixinShare($array,urlWap('zhuanti','ad_20160719'));
}else{
	$array['P']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	$array['P']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_GET['push_openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['link'] = urlWap('zhuanti','ad_20160719',array('push_openid'=>$_GET['push_openid'],'ua'=>$_GET['ua']?$_GET['ua']:$_SESSION['zan_ua'])); //分享连接
	$array['Y']['title'] = '我在这里抢银条，打开链接，速来帮忙';
	$array['Y']['desc'] = '万人疯抢，一元一克【包邮】，再不帮忙抢就没了！！';
	$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160719/images/100x100.jpg";
	echo weixinShare($array);
}
?>


<?php if($output['member_this'] === true && empty($output['member_weixin_info'])){?>

<!--点进进入首页显示的主内容 S-->
<section class="banner">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_01.jpg"/>
	<img id="huodongguize"  src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_02.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_03.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_04.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_05.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_06.jpg"/>
</section>

<section class="praise-main">
	<img id="zan" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/home-love.jpg"/>
	<img id="yaoqing" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/home-yaoqing.jpg"/>
	<img id="linqu" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/home-lingqu.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_07.jpg"/>
</section>
<!--点进进入首页显示的主内容 A-->

<?php }?>


<?php if($output['member_push'] === true){?>

<!--给它点赞状态后的内容 S-->
<section class="banner" >
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a1.jpg"/>
	<img id="huodongguize" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a2.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a3.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a4.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a5.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_a6.jpg"/>
</section>

<section class="praise-main" >
	<img id="button_dianzan" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/a_give.jpg"/>
	<img id="yeyaoling" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/a_me.jpg"/>
	<!--进度条的背景盒子-->
	<div class="home-progress-bar">
		<!--进度条功能-->
		<article class="jdt-function">
			<div class="l">
				<span><img src="<?php echo urldecode($output['member_weixin_info_push']['W_Headimgurl']);?>"/></span>
				<p><?php echo $output['member_weixin_info_push']['W_Nickname'];?></p>
			</div>
			<div class="r">
				<h2>已获<?php echo $output['member_weixin_info_push']['dianzan'];?>个赞</h2>
				<div class="container">
				    <div class="bar">
				        <span class="bar-unfill">
				            <span class="bar-fill-stripes" style="width: <?php echo $output['member_weixin_info_push']['dianzan_'];?>%;"></span>
				        </span>
				     </div>
				</div>
				<p><?php echo $output['member_weixin_info_push']['dianzan'];?>个赞</p>
			</div>
		</article>
		<!--进度条功能-->
	</div>
	<!--进度条的背景盒子-->
</section>
<!--给它点赞状态内容 A-->

<?php }?>


<?php if($output['member_this'] === true && (!empty($output['member_weixin_info']['dianzan']) || !empty($output['member_weixin_info']))){?>

<!--好友状参与页 S-->
<section class="banner" >
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c1.jpg"/>
	<img id="huodongguize" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c2.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c3.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c4.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c5.jpg"/>
    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/banner_c6.jpg"/>
</section>

<section class="praise-main">
    <img id="user_zan" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/c_zan.jpg"/>
	<!--进度条的背景盒子-->
	<div class="progress-bar">
		<!--进度条功能-->
		<article class="jdt-function">
			<div class="l">
				<span><img src="<?php echo urldecode($output['member_weixin_info']['W_Headimgurl']);?>"/></span>
				<p><?php echo $output['member_weixin_info']['W_Nickname'];?></p>
			</div>
			<div class="r">
				<h2>已获<?php echo $output['member_weixin_info']['dianzan'];?>个赞</h2>
				<div class="container">
				    <div class="bar">
				        <span class="bar-unfill">
				            <span class="bar-fill-stripes" style="width: <?php echo $output['member_weixin_info']['dianzan_'];?>%;"></span>
				        </span>
				     </div>
				</div>
				<p><?php echo $output['member_weixin_info']['dianzan'];?>个赞</p>
			</div>
		</article>
		<!--进度条功能-->
	</div>
	<!--进度条的背景盒子-->
	<img id="user_yaoqing" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/c_yaoqing.jpg"/>
	<img id="user_linqu" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/c_lingqu.jpg"/>
</section>
<!--好友状参与页 A-->

<?php }?>




<!-- 弹窗区域  -->
<div class="md-modal md-effect-3 " id="modal-from">
    <div class="md-content coloured">
        <div class="demo clearfix">
             
	             <!--主内容区-->
             <div class="tc-con clearfix">


				<div class="sea-mew clearfix">
					<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/sea-mew.jpg"/>
				</div>		
				
				
				<!-- Demo start 0-->
				<div class="tabs" id="huodong_guize" style="display: none;">
                    <div class="rule-box">
                    	<h3>活动规则</h3>
                    	<p>1、活动参与用户需点击页面上的功能按钮，参与活动才有效</p>
                    	<p>2、受邀点赞用户需点击页面上方点赞按钮，获取的赞才有效</p>
                    	<p>3、获得5个点赞，即可以1元/克的超低价格购买银条。每位用户限购5克银条</p>
                    	<p>4、邮费由收藏天下承担，无需用户支付</p>
                    	<p>5、本活动最终解释权归“收藏天下”所有</p>
                    </div>
				</div>
				<!-- Demo end --> 					
				
				
<!-- Demo start 1-->
<div class="tabs" id="xiadan" style="display: none;">
	<div class="get-box">
		<h3>领取银条</h3>
          <span class="item">
          	<input type="text" name="true_name" id="true_name" value="" placeholder="收货人姓名" />
          </span>	

          <span class="item-select">
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
          </span>

          <span class="item">
          	<input type="number" name="mob_phone" id="mob_phone" pattern="[0-9]*" placeholder="收货人电话" />
          </span>	
          <span class="item">
          	<input type="text" name="address" id="address" value="" placeholder="详细地址" />
          </span>			                  
          <h6><em style="text-decoration:line-through">《好运投资银条》5g版  发行价45元/条</em></h6>
          <h6>5元/条（包邮）</h6>
          <button  type="button" class="tc-btn-vote mt"  id="btnLingQu">立即领取</button>    		
	</div>
</div>
<!-- Demo end --> 
							

				<!-- Demo start 2-->
				<div class="tabs" id="login_zc" style="display: none;">
					<img class="img mt" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/five.png"/>
					<h1 class="baozheng">为保证银条的准确派送</h1>
					<ul class="tabsnav tc-tabsnav">
						<li><a href="#tabs-1" title="" id="tabs-1-zhuce">注册</a></li>
						<li><a href="#tabs-2" title="">登录</a></li>
					</ul>
		
					<div id="tabs_container" style="height: 212px;" class="transition">

	<form id="form_zhuce" action="<?php echo urlWap('zhuanti','register_show');?>" method="post">
		<div class="demo formbox showscale " id="tabs-1">
          <!-- <span class="item">
          	<input type="text" name="zc_name" id="zc_name" value="" placeholder="请输入用户名" />
          </span>	
          <span class="item">
          	<input type="password" name="zc_pass" id="zc_pass" value="" placeholder="请输入密码" />
          </span>	
          <span class="item">
          	<input type="password" name="zc_rpass" id="zc_rpass" value="" placeholder="请在次输入密码" />
          </span>   -->
          <span class="item">
          	<input type="text" name="zc_phone" id="zc_phone" value="" placeholder="请输入手机号" />
          </span>   
          <span class="item-yz">
          	<input class="l" type="text" name="zc_yzm" id="zc_yzm" value="" placeholder="请输入验证码" />

          	<input class="r" id="getYzm" name="getYzm" type="button" onclick="getPhoneYzm();" value="点击获取验证码"/>
          </span>  
			 <?php Security::getToken();?>	
          <input type="hidden" name="form_submit" value="ok">
          <span class="item error-tips" ></span>
          <button class="tc-btn-vote mt" id="zhuce_go">立即注册</button>
		</div>
	</form>
	
	<form id="form_login" action="<?php echo urlWap('zhuanti','login_show');?>" method="post">
			<div class="demo formbox" id="tabs-2">
          <span class="item">
          	<input type="text" name="login_name" id="" value="" placeholder="请输入账号" />
          </span>	
          <span class="item">
          	<input type="password" name="login_pass" id="" value="" placeholder="请输入密码" />
          </span>
	
	
			<input type="hidden" name="form_submit" value="ok">

          <?php Security::getToken();?>	

           <span class="item error-tips" ></span>
          <button class="tc-btn-vote mt" >立即登录</button>   
	
	

		</div>

		
	</form>
		


					</div>
				</div>
				<!-- Demo end --> 





				
				<!-- Demo start 3-->
				<div class="tabs" id="dianzan" style="display: none;">
                    <div class="rule-box">
                    	<h1 class="baozheng mt">恭喜您，已经为好友点赞成功！</h1>
                    	<img class="img mt" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/succeed.jpg"/>
                    </div>
				</div>
				<!-- Demo end --> 								
            </div>
             
             <!--关闭按钮-->
            <button class="md-close close-one"><i class="icon-close"></i></button>
        </div>
    </div>
</div>




<!--独立分享的  弹窗区域  -->
<div class="md-modal md-effect-3" id="modal-share">
 <button class="md-close close-one"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/share.png"/></button>
</div>

<!-- 弹出层结束 End -->
<div class="md-overlay md-close"></div>	
<!-- 弹出层结束 End -->



<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/js/classie.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/js/modalEffects.js"></script>
<script>
	var polyfilter_scriptpath = "<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/js/";
</script>
 
	
	
	

<!--这些图片永恒不变-->

<section class="photo">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_01.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_02.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_03.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_04.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_05.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_06.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_07.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_08.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_09.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_10.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_11.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_12.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_13.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/photo_14.jpg"/>
</section>

<!-- 左下角领取银条按钮 -->
<!-- <div class="flotage"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160719/images/flotage.png" alt="" /></div> -->

<!--这些图片永恒不变-->


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
	
$(function(){


	var zan_count = "<?php echo $output['dianzan_max'];?>";

	<?php if(!empty($output['member_this']) && empty($output['member_weixin_info']['dianzan'])){?>

	$("#yaoqing,#linqu,#zan").click(function(){

		var is_login = "<?php echo $_SESSION['is_login'];?>";

		var member_weixin_info = "<?php echo $output['member_weixin_info'];?>";

		if(!!is_login){
			if(!!member_weixin_info){
				$("#modal-share").addClass('md-show');
			}else{
				window.location.href="<?php echo urlWap('zhuanti','get_weixin_info');?>";
			}
		}else{
			$("#modal-from").addClass('md-show');
			$("#login_zc").show();
			$("#tabs-1-zhuce").click();
		}
	})

	<?php }?>




	// 推荐页面
	<?php if(!empty($output['member_push'])){?>

	$("#yeyaoling").click(function(){

		var is_login = "<?php echo $_SESSION['is_login'];?>";

		var member_weixin_info_push_this = "<?php echo $output['member_weixin_info_push_this'];?>";

		// 是否登陆、如未登陆则登陆或者注册。
		// 是否有推荐人页面的当前进入人信息、如果没有则微信跳转获取信息。
		// 在登陆并且有信息的情况下跳转到个人活动分享首页。

		if(!!is_login){
			if(!!member_weixin_info_push_this){

				$("#modal-share").addClass('md-show');

				// window.location.href="<?php echo urlWap('zhuanti','ad_20160719');?>";
			}else{
				window.location.href="<?php echo urlWap('zhuanti','get_weixin_info');?>";
			}
		}else{
			$("#modal-from").addClass('md-show');
			$("#login_zc").show();
			$("#tabs-1-zhuce").click();
		}

	})

	<?php }?>



	// 登录
	$("#form_login").validate({

        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".error-tips").show());
        },
        rules: {
            login_name: "required",
            login_pass: "required",
            formhash: "required",
        },
        messages: {
            login_name: "用户名必填！",
            login_pass: "密码必填！",
            formhash: "数据错误！",
        }

    });


	// 注册
	$("#form_zhuce").validate({
        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".error-tips").show());
        },
        rules: {
            // zc_name: "required",
            // zc_pass: "required",
            // zc_rpass: "required",
            zc_phone: "required",
            zc_yzm: "required",
            formhash: "required"
        },
        messages: {
            // zc_name: "用户名必填！",
            // zc_pass: "密码必填！",
            // zc_rpass: "确认密码必填！",
            zc_phone: "手机号必填！",
            zc_yzm: "验证码必填！",
            formhash: "数据错误！"
        }

    });


    // 点赞
    $("#button_dianzan").click(function(){

    	var push_openid = "<?php echo $_GET['push_openid'];?>";

    	var is_login = "<?php echo $_SESSION['is_login'];?>";

		var member_weixin_info_push_this = "<?php echo $output['member_weixin_info_push_this'];?>";

		if(!!is_login){
			if(!!member_weixin_info_push_this){
		    	$.ajax({
			        url:"<?php echo urlWap('zhuanti','ad_20160719_dianzan');?>",
			        type:"POST",
			        data:{'push_openid':push_openid},
			        dateType:'json',
			        success:function(html){
						
			        	var ajaxobj = eval("("+html+")");  

			        	switch(ajaxobj.error){
			        		case 1:
			        			$("#modal-from").addClass('md-show');
								$("#dianzan").show();
			        			break;
			        		default:
			        			alert(ajaxobj.msg);
			        			break;
			        	}
			        }
				});
			}else{
				window.location.href="<?php echo urlWap('zhuanti','get_weixin_info',array('zan_url'=>urlencode(urlWap('zhuanti','ad_20160719',array('push_openid'=>$_GET['push_openid'])))));?>";
			}
		}else{
			$("#modal-from").addClass('md-show');
			$("#login_zc").show();
			$("#tabs-1-zhuce").click();
		}
    })
	

	
	// 活动规则
	$("#huodongguize").click(function(){
		$("#modal-from").addClass('md-show');
		$("#huodong_guize").show();

	})


	// 分享后邀请
	$("#user_yaoqing,#user_zan").click(function(){
		$("#modal-share").addClass('md-show');
	})

	// 分享后领取
	$("#user_linqu,.flotage").click(function(){
		if(zan_count >= '5'){
			$("#modal-from").addClass('md-show');
			$("#xiadan").show();
		}else{
			alert('集满5个赞后方可领取！');
		}
	})

	// 关闭所有弹出框
	$(".md-close").click(function(){
		$(".md-modal").removeClass('md-show');
		$(".tabs").hide();

	})



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


if(zan_count >= '5'){

// 领取
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

		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=dianZanLinQu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
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


}


})






function getPhoneYzm(){
        var mobile = $("#zc_phone").val();
		var name = $("#zc_name").val();

		if(name == ''){
            alert('用户名不能为空！');
            return false;
        }
        if(mobile == ''){
            alert('手机号不能为空！');
            return false;
        }

        if(mobile.length != '11'){
        	alert('手机号格式不正确！');
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
            data:{mobile:mobile,name:mobile},
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