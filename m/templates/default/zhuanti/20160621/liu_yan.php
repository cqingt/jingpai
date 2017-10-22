    <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/css/new_file.css"/>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/jquery.min.js" type="text/javascript"></script>
     <!--jQuery动画暂停插件-->
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/jquery.pause.min.js"></script>
    <!--滚动效果js-->
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/js/weiboscroll.js"></script>
 
    <div class="photo-one">
    	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/top1.jpg"/>
    </div>
	<div class="boxes">
		<div class="photo-three">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/photo_23-2.jpg"/>
			<h2>快快留言告诉他（可不选）</h2>
		</div>		
		<div class="photo-four">
            <div class="art-record"  id="art-con">
                <ul>
                   <li>
                      <span>朋友一生一起走</span>
                   </li>    
                   <li>
                      <span>友谊万岁</span>
                   </li>    
                   <li>
                      <span>友谊的小船扬帆起航</span>
                   </li>    
                   <li>
                      <span>哥们就是这么仗义</span>
                   </li> 
                   <li>
                      <span>姐妹就是这么贴心</span>
                   </li>                                                                                            
                </ul>
            </div>			
		</div>
		<input class="message" type="text" name="contents" id="contents" value="" placeholder="输入留言"/>
		<div class="photo-two">
			<a href="javascript:(0);" id="sub_btn"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/btn1.jpg"/></a>
			<a href="index.php?act=zhuanti&op=ad_20160621"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/btn2.jpg"/></a>
		</div>
		<div class="photo-one mt">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160621/images/logo.jpg"/>
		</div>
	</div>
<script>
  $(".art-record li span").click(function(){
	var res =  $(this).html();
	$("#contents").val(res);
	
});
$("#sub_btn").bind("click", function() {
	var contents = $.trim($("#contents").val());
	$("#sub_btn").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160621&action=btn_ajax",
		data:{contents:contents,btn:7},
		dataType:'json',
		success:function(result){
			if(result.state){
				alert("留言成功");
				window.location.href="index.php?act=zhuanti&op=ad_20160621";
			}else{
				alert(result.msg);
				$("#sub_btn").attr("disabled",false);
			}
		}
	}); 
});

</script>