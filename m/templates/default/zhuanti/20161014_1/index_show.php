
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/new_file.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/colorA_22bdb49.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/bootstrap_ed29315.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/image_c703bce.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/form_c8501f2.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/phone_2e1dae4.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/css/default_cee4b40.css">
	<div class="rmb-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_08.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_09.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/htb_10.jpg"/>		
	</div>
    
    <div id="csrf"><input name="csrfmiddlewaretoken" value="1OPyzh4qKRqsEZyIlyUz9xryRcLniyuN" type="hidden"></div>
<div id="content">
<div class="piece image-con" style="padding-left: 0px; padding-right: 0px;" data-idx="0">
    <div class="image-box">
        <a target="_blank" class="image-link" href="javascript:void(0);">
            
            <img class="image-item" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/yue.jpg">
        </a>
        <span class="image-text"></span>
    </div>
</div>
    <a id="buy"></a>
    <div class="piece" data-idx="1">
        <div class="input-group-i"><span class="input-group-addon-i warn-star" id="label">收件人姓名</span>
		<input class="form-control form-input-i" name="name" id="name" placeholder="" type="text"></div><div class="input-group-i">
		<span class="input-group-addon-i warn-star" id="label">电话</span>
		<input class="form-control form-input-i" name="tel" placeholder="" id="tel" type="text"></div>

		<div class="input-group-i" style="margin-top: 5px;"><input name="button" class="btn-i" id="button" type="submit" value="提交" /></div>
    </div>
	<div class="rmb-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161014_1/images/bottombox.jpg"/>		
	</div>
    <div class="piece" data-idx="2">
        <div class="floor-space" style="height: 60px;"></div>
    </div>


</div>

    
	<div class="btn-play">
		<a href="tel:4008762770">电话咨询</a>
		<a href="#buy">立即订购</a>
	</div>

<script>
$("#button").bind("click", function() {
	$("#button").attr("disabled",true);
	var name = $.trim($("#name").val());
	var mob_phone = $.trim($("#tel").val());
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20161014_1&action=tijiao&tg_from=<?php echo $_GET['tg_from'];?>&ua=<?php echo $_GET['ua'];?>",
		data:{true_name:name,mob_phone:mob_phone},
		dataType:'json',
		success:function(result){
			if(!result.state){
				alert(result.msg);
				$("#button").attr("disabled",false);
			}else{
				alert(result.msg);
				window.location.href='http://m.96567.com/index.php?act=zhuanti&op=ad_20161014_1';
			}
		}
	}); 
});
</script>