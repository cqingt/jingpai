
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/css/style.css">

<!-- Main area -->
<section class="section">

    <div class="banner">
        <div class="banner"></div>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/banner.jpg" alt="">
        <a href="#btn"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero0.jpg" alt="" /></a>
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero1.jpg" alt="" />
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero2.jpg" alt="" />
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero3.jpg" alt="" />
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero4.jpg" alt="" />
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero5.jpg" alt="" />
        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160115/images/zero6.jpg" alt="" />
    </div>

    <div class="tile-box" id="btn">
        <div class="userinfo">
            <div class="hp-input">
                <label for="用户名：">用户名：</label><input type="text" value="" name="user_name" id="user_name" />
            </div>
            <div class="hp-input">
                <label for="密码：">密码：</label><input type="password" value="" name="password" id="password" />
            </div>
            <!--
            <div class="hp-input">
                <label for="密码：">确认密码：</label><input type="password" value="" name="" />
            </div>
            -->
            <div class="hp-input">
                <label for="手机：">手机：</label><input type="tel" value="" name="mobile" id="mobile"/>
            </div>
            <a class="participation" href="javascript:void(0)" id="loginbtn">参与等值兑换</a>
        </div>
    </div>

</section>

<script>
    $(function(){
        $('#loginbtn').click(function(){
            var user_name = $("#user_name").val();
            var password = $("#password").val();
            var mobile = $("#mobile").val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('zhuanti','ad_20160115',array('action'=>'zhu_ce'))?>",
                data:{user_name:user_name,password:password,mobile:mobile},
                dataType:'json',
                success:function(result){
                    if(result.msg){
                        alert(result.msg);
                    }else{
                        alert(result.error);
                    }
                }
            });
            //document.getElementById("reg_add").submit();
        });
    })

</script>
<?php

$array['P']['title'] = '2016年猴年生肖纪念币等值兑换 - 收藏天下';
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160115/images/hjnb.jpg';
$array['Y']['title'] = '2016年猴年生肖纪念币等值兑换 - 收藏天下';
$array['Y']['desc'] = '买字画、邮币卡、文玩？上收藏天下！致力于大众正品收藏，中国收藏投资第一服务品牌！';
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160115/images/hjnb.jpg';

echo weixinShare($array);

?>
<!-- Main area End -->
