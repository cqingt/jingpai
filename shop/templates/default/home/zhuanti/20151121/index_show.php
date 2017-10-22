<link href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151121/css/style.css" rel="stylesheet" type="text/css" />
<div class="zs_content">
<ul>
<li class="li01"></li>
<li class="li02"></li>
<li class="li03"></li>
<li class="li04"></li>
<li class="li06"></li>
<li class="li08"></li>
<li class="li09"></li>
<li class="li10"></li>
<li class="li11"></li>
<li class="li12"></li>
<li class="li13"></li>
<li class="li14"></li>
<li class="li15"></li>
<li class="li16"></li>
<li class="li17"></li>
<li class="li18"></li>
<li class="li19"></li>
<li class="li20"></li>
<li class="li21"></li>
<li class="li22"></li>
<li class="li23"></li>
<li class="li24"></li>
<li class="li25"></li>
<li class="li26"></li>
<li class="li27"></li>
<li class="li28"></li>
<li class="li29"></li>
<li class="li30"></li>
<li class="li31"></li>
<li class="li32"></li>
<li class="li33"></li>
<li class="li34"></li>
<li class="li35"></li>
<li class="li36"></li>
<li class="li37"></li>
<li class="li38"></li>
<li class="li39"></li>
<li class="li40"></li>
<li class="li41"></li>
<li class="li42"></li>
<li class="li43"></li>
<li class="li44"></li>
<li class="li45"></li>
<li class="li46"></li>
<li class="li47"></li>
<li class="li48"></li>
<li class="li49"></li>
<li class="li50"></li>
<li class="li51"></li>
<li class="li52"></li>
</ul>
</div>
<div class="message">
<h1 class="title">如果您对该项目感兴趣，请留言</h1>
<ul>
<li><span>姓名：</span><span><input name="name" id="name" type="text" class="span_input"  /></span><span>* 您的真实姓名</span></li>
<li><span>手机：</span><span><input name="tel" id="tel" type="text" class="span_input" /></span><span>* 请填写您的手机号</span></li>
<li><span>地址：</span><span><input name="address" id="address" type="text" class="span_input" /></span></li>
<li><span>留言：</span><span><textarea name="contet" id="contet" cols="" rows="" class="span_textarea"></textarea></span></li>
<li><span><input name="" type="button" value="提交留言" class="span_button" onclick="check_form();"/></span></li>
</ul>
</div>
<script>
function check_form(){
	var name=$("#name").val();
	var tel=$("#tel").val();
	if(name==""){
		alert("请输入真实姓名");
		$("#name").focus();
		return false;
	}
	if (!valid_shouji(tel))
	{
		alert("请输入正确的电话");
		$("#tel").focus();
		return false;
	}
	$.ajax({ 
		type: 'POST', 
		url: 'index.php?act=zhuanti&op=ad_20151121&action=post',
        data: {name:name, mobile:tel, address:$("#address").val(), contet:$("#contet").val()},
		dataType: 'json', 
		cache: false, 
		error: function(){ 
			if(confirm("连接中断，请刷新后重试。"))
			 {
				 window.location.href="index.php?act=zhuanti&op=ad_20151121";
			 }
			 else
			 {
				  return false;
			 }
			return false; 
		}, 
		success:function(json){ 
			var error = json.error; //错误
			if(error == -1){
				$("#name").focus();
				alert('您已经提交过了！');
				return false; 
			}else{
				window.location.href="index.php?act=zhuanti&op=ad_20151121";
				alert('提交成功！');
			}
		} 
	});
}
function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}
</script>