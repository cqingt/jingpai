
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/css/demo.css" />
<script src="http://resource.96567.com/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/js/jquery.reveal.js"></script>

<body>



<?php if(empty($output['hong_info'])){?>
	
    <div class="wrap">
    	 <div class="banner"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/banner.jpg" alt=""></div>
    	 <div class="content">
    	      <div class="first">
    	      	   <div class="one"><input id="hong_kl" type="text" value="" name="kl" placeholder="请输入红包口令"></div>
    	      	   <div class="two"><a href="###"><i class="icon-get"></i></a></div>
    	      </div>
              <!-- <p class="note">温馨提示：因微信数据问题，如领取红包时提示“数据异常”，请再次点击“领取红包”即可领取红包！</p> -->
    	      <!-- <p class="note">·注册成为收藏天下会员即可获得红包口令</p> -->
              <!-- <p class="note ptwo">·使用红包口令可领取1-50元随机金额微信现金红包（微信红包将通过收藏天下微信公共号发放，请确认您是否关注）</p> -->


<a  class="icon-command" >活动结束</a>

    	      <!-- <div class="finger"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/finger.png" alt=""></div> -->
         </div>
    </div>


<?php }else{?>


    <div class="wrap">
    	 <div class="banner"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/banner.jpg" alt=""></div>
    	 <div class="content">
			<div class="dough">
				<h2>恭喜您</h2>
				<h4>抢到了收藏天下的现金红包</h4>
                <p class="fly">让红包飞一会~</p>
                <p class="btn-word">请返回公众号查看领取</p>
			</div>
    	      <div class="finger"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/finger.png" alt=""></div>
         </div>
    </div>

<?php }?>




   <div id="myModal-login" class="reveal-modal myModal-login">
		<div class="login">
			 <div class="hp-input mt20">
			 	  <label>用户名：</label>
			 	  <div class="hp-case">
			 	  	   <input  onchange="testName();" type="text" value="" name="user_name" id="user_name"> 
			 	  </div>
			 </div>
			 <div class="hp-input">
			 	  <label>密码：</label>
			 	  <div class="hp-case">
			 	  	   <input type="password" value="" name="password" id="password"> 
			 	  </div>
			 </div>
			 <div class="hp-input">
			 	  <label>确认密码：</label>
			 	  <div class="hp-case">
			 	  	   <input type="password" value="" name="upassword" id="upassword"> 
			 	  </div>
			 </div>
			 <div class="hp-input">
			 	  <label>手机：</label>
			 	  <div class="hp-case">
			 	  	   <input  onchange="testPhone();" type="tel" value="" name="mobile" id="mobile"> 
			 	  </div>
			 </div>

             <div class="hp-input gain">
                  <label>验证码：</label>
                  <div class="hp-case">
                        <input type="tel" value="" name="Yzm" id="Yzm">  
                  </div>
                  <input type="button" onclick="getPhoneYzm();" class="btn-gain" value="获取验证码" name="getYzm" id="getYzm">  
             </div>
 


             <a class="icon-command" id="loginbtn">注册并获取红包口令</a>
		</div>
		<a class="close-reveal-modal">&#215;</a>
   </div>





<a style="display: none;" id="login_succeed" class="icon-command" data-reveal-id="myModal-succeed" data-animation="fade"></a>

   <div id="myModal-succeed" class="reveal-modal myModal-succeed">
		<div class="succeed">

<?php if(!empty($output['user_info'])){?>
    <h2><span id="user_name_kl"><?php echo $output['user_info']['K_MemberName'];?></span>，注册成功！</h2>
	<h4>红包口令：<span id="user_kl"><?php echo $output['user_info']['K_KouLing'];?></span></h4>
<?php }else{?>
	<h2><span id="user_name_kl">丁莉</span>，注册成功！</h2>
	<h4>红包口令：<span id="user_kl">WDFFR12345</span></h4>
<?php }?>

			 <div class="moe"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/moe.png" alt=""></div>
             <a class="icon-command" onclick="redColse();">领取红包</a>
		</div>
		<!-- <a class="close-reveal-modal">&#215;</a> -->
   </div>



   <!-- <div id="myModal-share" class="reveal-modal myModal-share">
        <div class="share">
        	 <a href="###" class="close-reveal-modal"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/weixin/images/friend.png" alt=""></a>
        </div>
   </div> -->




</body>


<script>
    $(function(){
        $('#loginbtn').click(function(){
            var user_name = $("#user_name").val();
            var password = $("#password").val();
            var upassword = $("#upassword").val();
            var mobile = $("#mobile").val();
            var Yzm = $("#Yzm").val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('zhuanti','doRegister')?>",
                data:{user_name:user_name,password:password,upassword:upassword,mobile:mobile,Yzm:Yzm},
                dataType:'json',
                success:function(result){
                    if(result.msg){
                        $(".close-reveal-modal").click();//关闭注册
                        $("#login_hong").attr("data-reveal-id","myModal-succeed");
                        $("#user_name_kl").text(result.K_MemberName);
                        $("#user_kl").text(result.K_KouLing);
                		$("#login_succeed").click();//弹出口令
                    }else{
                        alert(result.error);
                    }
                }
            });
        });



$('.icon-get').click(function(){
	var hong_kl = $("#hong_kl").val();
	$.ajax({
        type:'post',
        url:"<?php echo urlWap('zhuanti','shouHongbao')?>",
        data:{kl:hong_kl},
        dataType:'json',
        success:function(result){
            if(result){
                $.each(result, function(name, value) {
                    if(value == '领取成功'){

        window.location.href="<?php echo urlWap('zhuanti','getHongbao')?>";

                    }else{
alert(value);
                    }
                	
				});
            }else{
                alert(result.error);
            }
        }
    });


});







    })

    function redColse(){
    	window.location.href="<?php echo urlWap('zhuanti','getHongbao')?>";
    }



    function getPhoneYzm(){
        var mobile = $("#mobile").val();

        if(mobile == ''){
            alert('手机号不能为空！');
            return false;
        }

        var wait=60; 
        function time() { 
            var o = document.getElementById("getYzm");
           if (wait == 0) { 
                o.removeAttribute("disabled"); 
                o.value="获取验证码"; 
                o.style.background = "#ffda31";
                o.style.color = "#ac4700";
                wait = 60; 
            } 
            else { 
                o.setAttribute("disabled", true); 
                o.value=wait+"秒后重新发送"; 
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
            url:"<?php echo urlWap('zhuanti','getPhoneYzm')?>",
            data:{mobile:mobile},
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



    function testName(){

      var user_name = $("#user_name").val();

      $.ajax({
        type:'post',
        url:"<?php echo urlWap('zhuanti','testName')?>",
        data:{user_name:user_name},
        dataType:'json',
        success:function(result){
          if(result){
             var list_form = '<p style="color: #fff;" id="name_error"> * 当前帐号已注册！</p>' ;
            $("#user_name").parent().append(list_form);
          }else{
            $("#name_error").remove();
          }
          
        }
      });
    }


    function testPhone(){
      var mobile = $("#mobile").val();

      $.ajax({
        type:'post',
        url:"<?php echo urlWap('zhuanti','testPhone')?>",
        data:{mobile:mobile},
        dataType:'json',
        success:function(result){
          if(result){
            var list_form = '<p style="color: #fff;"  id="phone_error"> * 当前手机号已注册！</p>' ;
            $("#mobile").parent().append(list_form);
          }else{
            $("#phone_error").remove();
          }

        }
      });
    }


</script>