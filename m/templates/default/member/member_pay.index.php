<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<style>
/*---余额管理---*/
.yue_menu{height:43px; line-height:40px; background:url(../../images/menu_bg1.jpg) repeat-x; font-family:"Microsoft YaHei"; font-size:15px;}
.yue_menu span{ width:33%; height:40px; line-height:40px; display:block; float:left; text-align:center; color:#333; cursor:pointer;}
.yue_menu a:hover{ width:33%; height:43px; display:block; float:left; color:#e33a3d;}
.yue_menu span.hover{ width:33%; height:43px; display:block; float:left; background:#e33a3d; color:#fff;}

.chongzhi_box1{height:36px; line-height:36px; font-family:'Microsoft YaHei'; font-size:14px; color:#333;}
.chongzhi_box1 span{font-size:12px; color:#68a51a; padding-left:5px;}

.chongzhi_box2{border:1px solid #cbcbcb; border-left:none; border-right:none; height:40px; line-height:40px;}
.chongzhi_box2 span.font1{width:30%; border-right:1px solid #cbcbcb; height:40px; line-height:40px; text-align:center; display:block; float:left;}
.chongzhi_box2 span.font2{width:65%; height:40px; line-height:40px; display:block; float:left; padding-left:10px; color:#68a51a; font-size:15px;}
.chongzhi_box3{color:#333; line-height:46px; height:46px; padding-left:20px;}

.chongzhi_je{ overflow:hidden;}
.chongzhi_je a{width:30%; height:40px; border:1px solid #d9d8d7; line-height:40px; text-align:center; color:#333; font-size:15px; text-decoration:none; border-radius:3px; display:block; float:left; margin-bottom:10px;}
.chongzhi_je a.hover{border-bottom:4px solid #ff6600; background-color:#fff3dc; height:37px;}

.cz_input{border:0px; background:#fff; width:100%; height:100%; color:#66a61a;}

.zhifu_box{border:1px solid #cbcbcb; border-radius:3px; margin-bottom: 10px;}
.zhifu_box dl.dl11{background:url(../../images/zfb.jpg) no-repeat left center; padding-left:70px; height:60px;}
.zhifu_box dl.dl22{background:url(../../images/yl.jpg) no-repeat left center; padding-left:70px; height:60px;}
.zhifu_box dl{height:60px;}
.zhifu_box dl dd{float:left; font-size:15px; font-weight:700; color:#333; line-height:20px; padding-top:12px;}
.zhifu_box dl dd p{color:#999; font-size:12px;}
.zhifu_box dl dt{float:right; padding-top:18px; padding-right:10px;}

.chongzhi_float{background:#7f7f7f; height:48px; width:100%; color:#fff; line-height:48px; filter:alpha(opacity=70);  -moz-opacity:0.7;  -khtml-opacity: 0.7;   opacity: 0.7; position:absolute; z-index:100; bottom:0px;}
.chongzhi_float2{height:48px; color:#fff; padding:0px 20px; width:90%; line-height:48px; position:absolute; z-index:1000; bottom:0px;}
.chongzhi_float2 span{color:#ffa400; padding:3px; font-size:16px; font-weight:700;}
.chongzhi_float2 a{width:104px; height:40px; background-color:#ffa200; border-radius:5px; text-align:center; line-height:40px; color:#fff; display:block; float:right; margin-top:4px; text-decoration:none; font-size:18px;}

.chongzhi_float_box{width:100%; position:fixed;right:0px;bottom:0px;z-index:100;_position:absolute;_bottom:auto;_top:expression(eval(document.documentElement.scrollTop+document.documentElement.clientHeight-0-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||100)));}
.ffbox {
    width: 70px;
    height: 60px;
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    float: left;
    margin-top: 5px;
}
</style>






<div style=" line-height:36px; font-size:14px; padding-left:20px; color:#333;">
    您的账户余额：<a href="###" style=" color:#e33a3d; text-decoration:none;"><?php echo $output['member_info']['available_predeposit']?>元</a>
</div>



<div id="con_one_1" style="width:96%; margin:0px auto; padding:0px;">
    <div class="chongzhi_box1">选择充值金额</div>
    
    <div class="chongzhi_je">
         <a href="javascript:setTabMoney(1);" id="two1" class="hover">300</a>
         <a href="javascript:setTabMoney(2);" id="two2" style="margin:0px 4%;" class="">500</a>
         <a href="javascript:setTabMoney(3);" id="two3" class="">1000</a>
         <a href="javascript:setTabMoney(4);" id="two4" class="">3000</a>
         <a href="javascript:setTabMoney(5);" id="two5" style="margin:0px 4%;" class="">5000</a>
         <a href="javascript:setTabMoney(6);" id="two6" class="">10000</a>
    </div>
    
    <div class="chongzhi_box2" id="con_two_1">
         <span class="font1">充值金额</span>
         <span class="font2"><input type="text" class="cz_input" id="money" value="300" style="height:38px; line-height:38px; background:none;" onkeyup="setTabMoney1(this.value);" onKeyPress="if (event.keyCode!=46 && (event.keyCode<48 || event.keyCode>57)) event.returnValue=false"></span>
    </div>

    <div class="chongzhi_box3">请选择支付方式</div>


    
    <div id="pay-list">

<?php if($output['app_'] === true){ ?>


    <div class="zhifu_box" onclick="XuanZhei(1);">
        <dl>
            <div class="ffbox">
                <span class="edge"></span>
                <img src="http://m.96567.com/templates/default/images/alipay.jpg" alt="">
            </div>
            <dd>支付宝<p>使用储蓄卡或者信用卡支付</p></dd>
            <dt><input name="zf" type="radio" id="radio1" value="1"></dt>
        </dl>
    </div>

<!-- <div class="zhifu_box" onclick="XuanZhei(2);">
    <dl>
        <div class="ffbox">
            <span class="edge"></span>
            <img src="http://m.96567.com/templates/default/images/wxpay.jpg" alt="">
        </div>
        <dd>微信支付<p>使用储蓄卡或者信用卡支付</p></dd>
        <dt><input name="zf" type="radio" id="radio2" value="2"></dt>
    </dl>
</div> -->
<?php }elseif($output['app_android'] === true){?>

    <?php if(!empty($_SESSION['openid'])){?>
        <?php foreach($output['pay_list'] as $k => $v){?>

            <div class="zhifu_box" onclick="XuanZhei(<?php echo $v['payment_id'];?>);">
                <dl>
                <div class="ffbox"><span class="edge"></span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/<?php echo $v['payment_code'];?>.jpg" alt=""></div>
                <dd><?php echo $v['payment_name'];?><p>使用储蓄卡或者信用卡支付</p></dd>
                <dt><input name="zf" type="radio" id="radio<?php echo $v['payment_id'];?>" value="<?php echo $v['payment_id'];?>"></dt>
                </dl>
            </div>
        <?php }?>
    <?php }else{?>
        <div class="zhifu_box" onclick="XuanZhei(1);">
            <dl>
                <div class="ffbox">
                    <span class="edge"></span>
                    <img src="http://m.96567.com/templates/default/images/alipay.jpg" alt="">
                </div>
                <dd>支付宝<p>使用储蓄卡或者信用卡支付</p></dd>
                <dt><input name="zf" type="radio" id="radio1" value="1"></dt>
            </dl>
        </div>
    <?php }?>

<?php }else{?>

    <?php if($output['pay_list']){?>
        <?php foreach($output['pay_list'] as $k => $v){?>

            <div class="zhifu_box" onclick="XuanZhei(<?php echo $v['payment_id'];?>);">
                <dl>
                <div class="ffbox"><span class="edge"></span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/<?php echo $v['payment_code'];?>.jpg" alt=""></div>
                <dd><?php echo $v['payment_name'];?><p>使用储蓄卡或者信用卡支付</p></dd>
                <dt><input name="zf" type="radio" id="radio<?php echo $v['payment_id'];?>" value="<?php echo $v['payment_id'];?>"></dt>
                </dl>
            </div>
        <?php }?>

    <?php }else{?>
    <div class="no-record">暂无支付方式</div>
    <?php }?>

<?php }?>


    </div>


<div class="chongzhi_float_box" id="float">
<div class="chongzhi_float2">需支付金额：
    <span id="price">300</span>元
    <a href="javascript:tijiao();">确认并支付</a>
</div>
<div class="chongzhi_float"></div>
</div>


<script>
function XuanZhei(pid){
		$("#radio"+pid).prop("checked",true);
}
function tijiao(){
    var amount = document.getElementById("money").value;
    var chkObjs = document.getElementsByName("zf");
    var zhifu = 0;
    var i=0;
    for(i=0;i<chkObjs.length;i++){
        if(chkObjs[i].checked){
            zhifu = chkObjs[i].value;
            break;
        }
    }
    
    if (zhifu == 0)
    {
        alert('请选择支付方式!');
        return false;
    }


    if (amount == 0)
    {
        alert('请选择冲值金额!');
        return false;
    }

    <?php if($output['app_'] !== true){ ?>

    var url = "<?php echo urlWap('member_pay','addZhiFu');?>";

    <?php }else{?>

    var url = "<?php echo urlWap('member_pay','addAppPay');?>";

    <?php }?>



    window.location.href= url + '&amount=' + amount + '&p_id=' + zhifu;

}




function setTabMoney(id){
    $('.chongzhi_je a').each(function(i,obj) {
        $(obj).removeClass('hover');
    });
    $('.chongzhi_je #two' + id).addClass('hover');
    var price = $('.chongzhi_je #two' + id).text();
    $('#money').val(price);
    $('#price').text(price);
}


function setTabMoney1(price){
    $('#price').text(price);
}
</script>



</div>
