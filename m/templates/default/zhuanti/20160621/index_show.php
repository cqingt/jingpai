
    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/css/new_file.css"/>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/jquery.min.js" type="text/javascript"></script>
     <!--jQuery动画暂停插件-->
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/jquery.pause.min.js"></script>
    <!--滚动效果js-->
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/weiboscroll.js"></script>
 

	<div class="photo-one">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_08.jpg"/>
		<a id="btn1" href="javascript:(0);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_09.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_10.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_11.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_12.jpg"/>	
	</div>
	<div class="photo-two">	
		<a class="btn3" href="javascript:(0);" lin_meony='10'><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_14.jpg"/></a>
		<a class="btn3" href="javascript:(0);" lin_meony='20'><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_15.jpg"/></a>
	</div>
	<div class="photo-two">
		
		<a class="btn3" href="javascript:(0);" lin_meony='50'><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_16.jpg"/></a>
		<a class="btn3" href="javascript:(0);" lin_meony='100'><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_17.jpg"/></a>
	</div>
	<div class="photo-one">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_19.jpg"/>
	</div>	
	<div class="photo-one">
		<?php if($output['push_openid']){?>
		<a id="btn2" href="javascript:(0);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_20.jpg"/></a>
		<?php }?>

		<a id="btn6" href="javascript:(0);"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_21.jpg"/></a>
	</div>	
	
		<div class="main-one">
			    <p class="the-clues">注：参加活动请点击【我要参加】按钮</p>
	    <p class="the-clues mb">活动数据才有效哦</p>
		<?php if($output['headimgurl']){ ?>
		<a class="head-portrait" href="javascript:(0);"><img src="<?php echo $output['headimgurl'];?>"/></a>
		<?php } ?>
		<?php if($output['nickname']){ ?>
		<p><?php echo $output['nickname'];?></p>
	
		<?php } ?>
		</div>
	
	<div class="boxes">
		<div class="photo-three">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_23.jpg"/>
			<h2>当前助力人数：<?php echo count($output['member_list']);?>人</h2>
		</div>		
		<div class="photo-four">
            <div class="art-record"  id="art-con">
<!--            <p class="begin">活动马上开始</p>-->
					
				<?php if(!empty($output['member_list']) && is_array($output['member_list'])){?>
                <ul>
					<?php foreach($output['member_list'] as $k=>$v){?>
					   <li>
						  <h3>
							<div class="tx">

								<img src="<?php echo $v['headimgurl'];?>"/>
 
							</div>
						  </h3>
						  <h4><?php echo $v['member_name'];?></h4>
						  <!--<p>助力成功</p>-->
						  <h6><?php echo $v['contet'];?></h6>
					   </li>  
					<?php }?>
                </ul>
				
				<?php }else{ ?>
					<?php if($output['push_openid']){?>
						<p class="begin">暂时没有好友为TA助力</p>
					<?php }else{ ?>
						<p class="begin">暂时没有好友为您助力</p>
					<?php }?>
				<?php }?>
            </div>			
		</div>
	</div>
	
	
	<div class="popup">
	   <!-- 活动规则  btn1-->
	   <div id="rule" class="content">
         <a class="close" href="javascript:(0);" onclick="closeBg();"></a>
         <div class="rule tab-content">
              <h2>活动规则</h2>
              <p>1、点击“我要参加”分享活动，即可召唤好友助力领取话费</p>
              <p>2、前来助力的好友点击“给TA助力”，注册成功之后即可为好友助力</p>
              <p>3、邀请不同数量的好友助力，可以免费提取不等的话费：邀请 3个、5个、10个、15个好友助力，分别可以获得10元、20元、50元、100元的话费奖励；<strong>一旦点击了“提取”按钮，该用户发起的活动立即结束，在72小时内将收到我们为您充值的话费（上限100元）</strong></p>
              <p>4、	若在72小时内未收到话费，请前往“收藏天下”官方微信进行咨询，本活动最终解释权归“收藏天下”所有</p>
              <img class="img WeChat" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/WeChat.jpg"/>
              <p>温馨提示：“收藏天下”将持续举办各种趣味活动，为您发放话费和红包等福利，扫码关注，坐享其成，还有更多惊喜哦！</p>
              <img class="img mt" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/logo.jpg"/>
         </div>	
       </div>		
       
	   <!-- 用户点击提取话费（弹窗）  btn3-->
	   <div id="telephone" class="content">
         <a class="close" href="javascript:(0);" onclick="closeBg();"></a>
         <div class="telephone tab-content">
            <img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/top3.jpg"/>
            <span id="huafei">10元话费</span>
            <form action="">
				<input type="hidden" name="bnt_money" id="bnt_money" value=0>
	            <input class="message" type="tel" name="tel_mob" id="tel_mob" value="" placeholder="请输入手机号">
	            <div class="ui-select">
					
					<select name="YunYingShang" id='YunYingShang'>
					  <option value="">选择运营商</option>
					  <option value="移动">移动</option>
					  <option value="联通">联通</option>
					  <option value="电信">电信</option>
					</select>
					<select class="valid" name="prov" id="vprov">
						<option value="">选择地区</option>
					</select>
			    </div>	
	            <input class="ok mb" type="button" name="but_lingqu" id="but_lingqu" value="提交" />
            </form>
            <p><strong>温馨提示：</strong>完成此次话费提取之后，活动即结束，用户将无法继续参与活动。</p>
            <p>话费领取完成后将在72小时内进行派送，若72小时后未收到话费，请前往【收藏天下官方微信】咨询</p>
         </div>	
       </div>		
				       
				
	   <!-- 弹窗  登录与注册  btn2-->
	   <div id="dialog" class="content">
	     <a class="close" href="javascript:(0);" onclick="closeBg();"></a>
	         <img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/logo-top.jpg"/>
		     <div class="coat">
		         <div class="mt">
		         	<div class="">
			             <div class="tab-content">
				             <form id="register_form" method="post" action="">
							     <div class="row">
							         <label for="">用户名</label>
							         <input type="text" value="" id="user_name1" name="user_name1">		     	
							     </div>
							     <div class="row">
							         <label for="">设置密码</label>
							         <input type="password" value="" id="password1" name="password1">		     	
							     </div>
							     <div class="row">
							         <label for="">确认密码</label>
							         <input type="password" value="" id="password_confirm1" name="password_confirm1">		     	
							     </div>			
							     <div class="row">
							         <label for="">手机号</label>
							         <input type="tel" value="" id="mobile1" name="mobile1">		     	
							     </div>						     
							     <div class="row">
							         <label for="">验证码</label>
							         <input class="verify" type="tel" value="" name="captcha_code1" id="code1">	
							         <input class="submit" type="button" onclick="getPhoneYzm1();" name="getYzm1" id="getYzm1" value="获取验证码" />
							     </div>	
							     <input class="rio-button" type="button" id="member_reg1" value="立即注册">  
							     <!--注册完，要跳转到  2.html页面-->
							 </form>           
			             </div>	     		
		         	</div>
		         </div>	   
		    	     	
		     </div>
         </div>
         
         
	   <!-- 弹窗  登录与注册 我也参加2   btn4-->
	   <div id="dialog2" class="content">
	     <a class="close" href="javascript:(0);" onclick="closeBg();"></a>
		     <div class="coat">
		         <ul class="activity-nav investment_title">
		         	<li class="on">登录</li>
		         	<li>注册</li>
		         </ul>
		         <div class="investment_con">
		         	<div class="inv-demo">
		         		 <img class="img mb" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/word1.png"/>
			             <div class="tab-content">
				             <form id="register_form" method="post" action="">
							     <div class="row">
							         <label for="">账号</label>
							         <input type="text" value="" name="log_name" id="log_name">		     	
							     </div>
							     <div class="row">
							         <label for="">密码</label>
							         <input type="password" value="" name="log_password" id="log_password">		     	
							     </div>	   
							     <input class="rio-button" type="button" id="member_login" value="登录">    
							 </form>           
			             </div>	         		
		         	</div>
		         	<div class="inv-demo">
		         		<img class="img mb" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/word2.png"/>
			             <div class="tab-content">
				             <form id="register_form" method="post" action="">
							     <div class="row">
							         <label for="">用户名</label>
							         <input type="text" value="" id="user_name" name="user_name">		     	
							     </div>
							     <div class="row">
							         <label for="">设置密码</label>
							         <input type="password" value="" id="password" name="password">		     	
							     </div>
							     <div class="row">
							         <label for="">确认密码</label>
							         <input type="password" value="" id="password_confirm" name="password_confirm">		     	
							     </div>			
							     <div class="row">
							         <label for="">手机号</label>
							         <input type="tel" value="" id="mobile" name="mobile">		     	
							     </div>						     
							     <div class="row">
							         <label for="">验证码</label>
							         <input class="verify" type="tel" value="" name="captcha_code" id="code">	
							         <input class="submit" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码" />
							     </div>	
	   
							     <input class="rio-button" type="button" id="member_reg" value="立即注册">    
							 </form>           
			             </div>		
		         	</div>
		         </div>	   
		    	     	
		     </div>
         </div>         
         
 	   <!-- 还不是好友  btn5-->
	   <div id="share" class="content2">
         <div class="tab-content">
             <a class="" href="javascript:(0);" onclick="closeBg();"> <img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/share.png"/></a>
         </div>	
       </div>	        
 
 	   <!-- 还不是好友  btn6-->
	   <div id="query" class="content">
         <a class="close" href="javascript:(0);" onclick="closeBg();"></a>
         <div class="tab-content">
            <img class="img" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/query.jpg"/>
         </div>	
       </div>	
         
	</div>

	   <!-- 遮罩层 -->
	  <a id="fullbg" class="mask-layer" href="javascript:(0);" onclick="closeBg();"></a>
 
	 
<script type="text/javascript">
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
				prov_html+='<option value="'+data.area_list[i].area_name+'">'+data.area_list[i].area_name+'</option>';
			}
			$("select[name=prov]").append(prov_html);
		}
	});
	     //活动规则
	     $('#btn1').click(function(){
	     	rule();
	     })	    
	 
	     //登录与注册
	     $('#btn2').click(function(){
			alert("第一波话费已被抢光，敬情关注后期活动");
			window.location.href="http://m.96567.com";
			return false;
	     	showBg();
	     })
	     
	     //活动规则
	     $('#btn3,.btn3').click(function(){
			var value = $(this).attr("lin_meony");
			$('#huafei').html(value+"元话费"); 
			$('#bnt_money').val(value);
			$.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
				data:{btn:1,val:value},
				dataType:'json',
				success:function(result){
					if(result == -1){
						showBg2(); //未登录
					}else if(result.state){
	     				telephone();
					}else{
						alert(result.msg);
					}
				}
			});
			
	     })	    
	     
	     //登录与注册 上面带图片
	     $('#btn4').click(function(){
	     	showBg2();
	     })	    	 	     

	     //分享
	     $('#btn5').click(function(){
	     	share();
	     })	    
	    
	     $('#btn6').click(function(){
			//检查用户是否关注微信公众号
			$.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
				data:{btn:6},
				dataType:'json',
				success:function(result){
					if(result == -2){
						alert("第一波话费已被抢光，敬情关注后期活动");
						window.location.href="http://m.96567.com";
						return false;
					}else if(result == -1){
						showBg2(); //未登录
					}else if(result == 1){
						share(); //已关注
					}else if(result == 2){
						query(); //为关注
					}else{
						alert(result);
					}
				}
			});
	     })	    	 	     


	     function showBg() { 
		  $("#dialog,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#dialog,#fullbg").show(); 
		  } 
	     function showBg2 () { 
		  $("#dialog2,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#dialog2,#fullbg").show(); 
		  } 
		  
		  
	     function rule() { 
		  $("#rule,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#rule,#fullbg").show(); 
		  } 		  

	     function telephone() { 
		  $("#telephone,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#telephone,#fullbg").show(); 
		  } 

	     function share() { 
		  $("#share,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#share,#fullbg").show(); 
		  } 
		  
	     function query() { 
		  $("#query,#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#query,#fullbg").show(); 
		  } 		  
		  
		  
		  //关闭灰色 遮罩 
		  function closeBg() { 
		    $("#dialog,#dialog2,#fullbg,#rule,#telephone,#share,#query").hide(); 
		  } 

$("#but_lingqu").bind("click", function() {
		var val = $('#bnt_money').val(); 
		var tel_mob = $('#tel_mob').val();
		var YunYingShang = $('#YunYingShang').val();
		var prov = $('#vprov').val();
		if(!valid_shouji(tel_mob)){
			alert('请输入正确的手机号码');
			return false;
		}
		if(YunYingShang == '' || prov == ''){
			alert("运营商或地区为必选项");
			return false;
		}
		$("#but_lingqu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
			data:{btn:3,val:val,tel_mob:tel_mob,YunYingShang:YunYingShang,prov:prov},
			dataType:'json',
			success:function(result){
				if(result.state){
					alert('恭喜您领取成功');
					window.location.href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160621";
				}else{
					alert(result.msg);
					$("#but_lingqu").attr("disabled",false);
				}
			}
		}); 
});

function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}


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
				window.location.href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160621";
			}else{
				alert(result.error);
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
	var code = $.trim($("#code").val());
	var ua = "<?php echo $_GET['ua']?>";
	$("#member_reg").attr("disabled",true);
	var no_push = 1;
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
		data:{btn:2,user_name:user_name,password:password,password1:password_confirm,mobile:mobile,code:code,ua:ua,no_push:no_push},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160621";
			}else{
				alert(result.msg);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});

$("#member_reg1").bind("click", function() {
	var user_name = $.trim($("#user_name1").val());
	var password = $.trim($("#password1").val());
	var password_confirm = $.trim($("#password_confirm1").val());
	var mobile = $.trim($("#mobile1").val());
	var code = $.trim($("#code1").val());
	var ua = "<?php echo $_GET['ua']?>";
	
	$("#member_reg1").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
		data:{btn:2,user_name:user_name,password:password,password1:password_confirm,mobile:mobile,code:code,ua:ua},
		dataType:'json',
		success:function(result){
			if(result.state){
				window.location.href="index.php?act=zhuanti&op=ad_20160621&action=liu_yan";
			}else{
				alert(result.msg);
				$("#member_reg1").attr("disabled",false);
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
            url:"http://m.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
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

function getPhoneYzm1(){
        var mobile = $("#mobile1").val();
		var name = $("#user_name1").val();
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
            var o = document.getElementById("getYzm1");
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
            url:"http://m.96567.com/index.php?act=zhuanti&op=getPhoneYzm",
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

<?php 

$array['P']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160621/images/weixin.png';
$array['Y']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
$array['Y']['desc'] = '桃花潭水深千尺，不及好友动手指';
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160621/images/weixin.png';

echo weixinShare($array);

?>