<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161210/css/main.css"/>

<div android:name=".filing.MainActivity" android:windowSoftInputMode="adjustResize|stateHidden" id="Ukraine" class="Ukraine" <?php if($output['lingqu']){?>style="display: none;"<?php }?>>
	<img class="login-title" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161210/images/login-titile.png"/>
	<div class="login-form">
		<form id="form1" action="<?php echo urlWap('zhuanti','ad_20161210',array('ua'=>$_GET['ua']?$_GET['ua']:'m','action'=>'lingqu'));?>" method="post">
			<div class="item">
				<label for=""></label>
      			<input type="text" name="true_name" id="true_name" value="" placeholder="请输入姓名：" />
			</div>
			<div class="item">
				<label for=""></label>
      			<input type="tel" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入电话：" />
			</div>
			<div class="items">
				<label for=""></label>
				<input placeholder="输入验证码" class="captcha" type="number" pattern="[0-9]*" name="code" id="code" value="" />
			    <input class="btn-captcha" onclick="getPhoneYzm();" type="button" name="getYzm" id="getYzm" value="获取验证码" />
			</div>

			<?php Security::getToken();?>
			<input type="hidden" name="form_submit" value="ok">	

      		<span class="item error-tips" ></span>

			<div class="item">
				<button class="go">提交</button>
			</div>
		</form>
	</div>
</div>

<div android:name=".filing.MainActivity" android:windowSoftInputMode="adjustResize|stateHidden" class="Ukraine" <?php if(!$output['lingqu']){?>style="display: none;"<?php }?>>
	<img class="login-title" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161210/images/succeed.png"/>
</div>



<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(document).ready(function(){

    var inputTextBox = document.getElementById('Ukraine');
    setInterval(function(){
    inputTextBox.scrollIntoView(false);
    },200)

	// 登录
	$("#form1").validate({
		errorElement: "span",
		// debug:true,
	    errorPlacement: function(error, element){
	    	error.appendTo($(".error-tips").show());
	    },
	    rules: {
	        true_name: "required",
	        mob_phone: "required",
	        code: "required"
	    },
	    messages: {
	        true_name: "用户姓名不能为空！",
	        mob_phone: "手机号不能为空！",
	        code: "验证码不能为空！"
	    }

	});


})



function getPhoneYzm(){
    var mobile = $("#mob_phone").val();
	var name = $("#mob_phone").val();
	
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
        url:"http://m.96567.com/index.php?act=zhuanti&op=pushPhoneYzm",
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

$array['P']['title'] = '乌克兰中央美院大师油画精品展电子登记簿';
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161210/images/1210.jpg";
$array['P']['link'] = urlWap('zhuanti','ad_20161210',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['link'] = urlWap('zhuanti','ad_20161210',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['title'] = '乌克兰中央美院大师油画精品展电子登记簿';
$array['Y']['desc'] = '乌克兰中央美院大师油画精品展电子登记簿';
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161210/images/1210.jpg";
echo weixinShare($array);

?>