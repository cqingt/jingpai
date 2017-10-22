
<link rel="stylesheet" dtype="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/weixin/css/lol.css">
<section class="lol-section">
	<div class="banner wrap">
		 <div class="inside"></div> 
	</div>
	<div class="lol-title"></div>
	<div class="balloon" id="balloon"></div>

	<div class="content">
		 <div class="main">



<?php if(empty($output['user_info'])){?>

<div class="formInfo">


<a class="lol-submit" >红包发放完毕！</a>
              </div>
		 	  <!-- 注册 -->
              <!-- <div class="formInfo">
                    <dl class="clearfix">
                        <dt>用户名：</dt>
                        <dd>
                            <input onchange="testName();" class="text" name="user_name" id="user_name" type="text">
                        </dd>    
                    </dl>
                    <dl class="clearfix">
                        <dt>密码：</dt>
                        <dd>
                            <input class="text" name="password" id="password" type="password">
                        </dd>    
                    </dl> 
                    <dl class="clearfix">
                        <dt>确认密码：</dt>
                        <dd>
                            <input class="text" name="upassword" id="upassword" type="password">
                        </dd>    
                    </dl>
                    <dl class="clearfix">
                        <dt>手机：</dt>
                        <dd>
                            <input onchange="testPhone();" class="text" value="" name="mobile" id="mobile" type="text">
                        </dd>    
                    </dl> 
                    <dl class="clearfix">
                        <dt>验证码：</dt>
                        <dd class="verification">
                            <input class="text tip" name="Yzm" id="Yzm" type="text">
                            <input type="button" onclick="getPhoneYzm();" class="btn-code" value="获取验证码" name="getYzm" id="getYzm">
                        </dd>
                    </dl> 
                    <a href="###" class="lol-submit" id="lol-submit">注册获取红包口令</a>
              </div> -->
              <!-- 注册成功 -->

<?php }else{?>


              <div class="succeed">
              	   <h2><i class="icon-yes"></i>恭喜您（<?php echo $output['user_info']['K_MemberName'];?>）注册成功!</h2>
              	   <p>您的红包口令是：<?php echo $output['user_info']['K_KouLing'];?></p>
              </div>

              <p class="lol-go">快用微信扫一扫，领取现金红包！</p>
              <div class="lol-WeChat">
              	   <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/weixin/images/WeChat.jpg" alt="">
              </div>
<?php }?>

		 </div>
	</div>

</section>
<script>

  $(function(){
      $('#lol-submit').click(function(){
          var user_name = $("#user_name").val();
          var password = $("#password").val();
          var upassword = $("#upassword").val();
          var mobile = $("#mobile").val();
          var Yzm = $("#Yzm").val();
          $.ajax({
              type:'post',
              url:"<?php echo urlShop('zhuanti','doRegister')?>",
              data:{user_name:user_name,password:password,upassword:upassword,mobile:mobile,Yzm:Yzm},
              dataType:'json',
              success:function(result){
                  if(result.msg){
                      window.location.href="http://www.96567.com/index.php?act=zhuanti&op=weixinUrl";
                  }else{
                      alert(result.error);
                  }
              }
          });
      });






  });


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
            url:"<?php echo urlShop('zhuanti','getPhoneYzm')?>",
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
        url:"<?php echo urlShop('zhuanti','testName')?>",
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
        url:"<?php echo urlShop('zhuanti','testPhone')?>",
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