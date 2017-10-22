<link rel='stylesheet' href='<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160429/css/rio.css'>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160429/js/jquery.js"></script>
<div class="rio-photo">
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_01.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_02.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_03.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_04.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_05.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_06.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_07.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_08.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_09.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_10.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_11.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_12.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_13.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_14.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_15.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_16.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_17.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_18.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_19.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_20.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_21.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_22.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_23.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_24.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_25.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_26.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_27.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_28.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_29.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_30.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_31.jpg" />
  <img src="http://sctx.oss-cn-beijing.aliyuncs.com/m/images/rio_32.jpg" />
</div>

<div class="btn-rio">
  <a href="tel://4000196567">电话咨询</a>
  <a href="javascript:showBg();">立即订购</a>
</div>

<!-- 弹窗盒子 -->
<div class="popup">
   <!-- 弹窗 -->
   <div id="dialog" class="content">
     <a class="close" href="javascript:;" onclick="closeBg();"></a>
     <img class="rioimg-top" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160429/images/riotab_top.jpg"/>
     <img class="rioimg-up" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160429/images/rio_up.jpg"/>
     <input type="text" value="" placeholder="请输入姓名" name="true_name" id="true_name">
     <input type="tel" value="" placeholder="请输入手机号" name="mob_phone" id="mob_phone">
     <div class="select"></div>
     <input class="rio-button" type="button" id="btnLingQu" value="提交"/>  
   </div>
   <!-- 遮罩层 -->
  <a id="fullbg" class="mask-layer" href="javascript:;" onclick="closeBg();"></a>
</div>

<script> 
$("#btnLingQu").bind("click", function() {
    var true_name = $.trim($("#true_name").val());
    var mob_phone = $.trim($("#mob_phone").val());
    var ua = "<?php echo $_GET['ua'];?>";
    $("#btnLingQu").attr("disabled",true);
    $.ajax({
      type:'post',
      url:"index.php?act=zhuanti&op=ad_20160429&action=Linqu",
      data:{true_name:true_name,mob_phone:mob_phone,ua:ua},
      dataType:'json',
      success:function(result){
		  if(result.state){
			alert(result.state);
			window.location.reload();
		  }else{
			alert(result.msg);
		  }
          $("#btnLingQu").attr("disabled",false);
      }
    }); 
  });
  //显示灰色 遮罩层 
  function showBg() { 
  var bh = $("body").height(); 
  var bw = $("body").width(); 
  $("#fullbg").css({ 
    height:bh, 
    width:bw, 
    display:"block" 
  }); 
  $("#dialog").show(); 
  } 
  //关闭灰色 遮罩 
  function closeBg() { 
    $("#fullbg,#dialog").hide(); 
  } 
</script>
<script src="http://s95.cnzz.com/stat.php?id=1258873362&web_id=1258873362" language="JavaScript"></script>

<?php

$array['P']['title'] = "里约奥运纪念币火爆预售    十万人掀起抢订狂潮";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160429/images/1weixin.jpg";
$array['Y']['title'] = "里约奥运纪念币火爆预售    十万人掀起抢订狂潮";
$array['Y']['desc'] = "错过了600倍涨幅的08奥运纪念钞，就不要再错过这次抄底机会!";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160429/images/1weixin.jpg";

echo weixinShare($array);

?>
</body>
</html>