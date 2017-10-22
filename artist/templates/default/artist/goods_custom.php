<?php defined('InShopNC') or exit('Access Invalid!');?>



<style>
	button{
		border:0px;
	}

	.form-group-error p,.form-group-error-2 p{
		margin-left: 95px;
	    font-size: 1.3em;
	    color: red;
	}

	#artist_name{
		margin-left: 10px;
	    line-height: 30px;
	    width:100px;
	    height: 32px;
	    font-size: 14px;
	    border: 1px #666 solid;
	}
</style>



<div class="wrapper">
	<ol class="art-breadcrumb">
		<li><a href="javascript:;">书画首页</a></li>
		<li class="active"><a href="javascript:;">私人定制</a></li>
	</ol>
</div>

<div class="customization wrapper">
	<ul class="cusnav handover_title">
		<li class="on">艺术家定制</li>
		<li>个性需求定制</li>
	</ul>
	<div class="handover_con">



<div class="demo">
	<div class="art-form">
	    <form id="form1" action="<?php echo urlArtist('artist_new','doArtistCustom');?>" method="post">
	    	
	     <h2>作品信息</h2>
	     <div class="form-group"> 
	      <label for="" class="control-label">艺术家：</label> 
	      <input class="form-control" name="Yname" id="custome_yname" value="" type="text">
	      <input class="matching" type="button" value="匹配相关" name="" onclick="pipei();"/>
	     </div>

	     <div class="form-group"> 
	      <label for="" class="control-label">类型：</label>
	      <ul class="a_now a_now_hua">
	        <li><a id="a_now_hua1" class="now" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('1,书法');">书法</a></li>
	        <li><a id="a_now_hua2" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('2,国画');">国画</a></li>
	        <li><a id="a_now_hua3" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('3,油画');">油画</a></li>
	        <li><a id="a_now_hua4" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('4,版画');">版画</a></li>
	      </ul>
	     </div>

	     <input type="hidden" id="now_hua" name="now_hua" value='1,书法'>
	
	     <div class="form-group"> 
	      <label for="" class="control-label">尺寸：</label> 
	      <ul class="a_now a_now_chi">
	        <li><a id="a_now1" class="now" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('1,3平尺以下');">3平尺以下</a></li>
	        <li><a id="a_now2" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('2,3平尺-10平尺');">3平尺-10平尺</a></li>
	        <li><a id="a_now3" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('3,10平尺-20平尺');">10平尺-20平尺</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('4,20平尺-30平尺');">20平尺-30平尺</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('5,30平尺以上');">30平尺以上</a></li>
	      </ul>
	     </div>

	     <input type="hidden" id="now_chi" name="now_chi" value='1,3平尺以下'>

	     <h2>定制人信息</h2>
	     <div class="form-group"> 
	      <label for="" class="control-label">定制人姓名：</label> 
	      <input class="form-control" name="Sname" value="" type="text"> 
	     </div>
	
	     <div class="form-group"> 
	      <label for="" class="control-label">定制人电话：</label> 
	      <input class="form-control" name="Sphone" value="" type="text"> 
	     </div>
	
	     <div class="form-group textarea"> 
	      <label for="" class="control-label">个性化需求：</label> 
	      <textarea name="Sremark" placeholder="请填写指定文章内容或其它需求" rows="5" class="form-control"></textarea>
	     </div>
	     
	     <div class="form-hot">
	     	<i class="icon-phone"></i><p>定制咨询热线:400-08-96567</p>
	     </div>
	
	     <div class="form-group"> 
	      <label for="" class="control-label">验<em>证</em>码：</label> 
	      <input class="form-control" name="captcha" type="text" value=""> 

	      <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />

	       <img src="/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=<?php echo getNchash();?>" name="imgyzm" border="0" id="imgyzm" class="fl ml5">
	       <a href="javascript:void(0)" onclick="javascript:document.getElementById('imgyzm').src='/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=<?php echo getNchash();?>&amp;t=' + Math.random();" class="ml5" >
	        看不清楚,换一张</a>

	     </div>
		
		<?php Security::getToken();?>
		<input type="hidden" name="form_submit" value="ok">
		<div  class="form-group-error"></div>
	    <button class="form-btn">提交</a>

	    </form>
	</div>			
</div>




<div class="demo">
	<div class="art-form mt">
	    <form id="form2" action="<?php echo urlArtist('artist_new','doUserCustom');?>" method="post">
	    	
	     <div class="form-group"> 
	      <label for="" class="control-label">类型：</label>
	      <ul class="a_now a_now_hua">
	        <li><a id="a_now1" class="now" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('1,书法');">书法</a></li>
	        <li><a id="a_now2" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('2,国画');">国画</a></li>
	        <li><a id="a_now3" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('3,油画');">油画</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_hua li a').removeClass();$(this).addClass('now');$('#now_hua').val('4,版画');">版画</a></li>
	      </ul>
	     </div>

	     <input type="hidden" id="now_hua" name="now_hua" value='1,书法'>
	
	     <div class="form-group"> 
	      <label for="" class="control-label">尺寸：</label> 
	      <ul class="a_now a_now_chi">
	        <li><a id="a_now1" class="now" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('1,3平尺以下');">3平尺以下</a></li>
	        <li><a id="a_now2" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('2,3平尺-10平尺');">3平尺-10平尺</a></li>
	        <li><a id="a_now3" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('3,10平尺-20平尺');">10平尺-20平尺</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('4,20平尺-30平尺');">20平尺-30平尺</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_chi li a').removeClass();$(this).addClass('now');$('#now_chi').val('5,30平尺以上');">30平尺以上</a></li>
	      </ul>
	     </div>

	     <input type="hidden" id="now_chi" name="now_chi" value='1,3平尺以下'> 
	     
	     <div class="form-group"> 
	      <label for="" class="control-label">价格：</label> 
	      <ul class="a_now a_now_money">
	        <li><a id="a_now1" class="now" href="javascript:;" onclick="$('.a_now_money li a').removeClass();$(this).addClass('now');$('#now_money').val('1,3000元以下');">3000元以下</a></li>
	        <li><a id="a_now2" href="javascript:;" onclick="$('.a_now_money li a').removeClass();$(this).addClass('now');$('#now_money').val('2,3000-8000元');">3000-8000元</a></li>
	        <li><a id="a_now3" href="javascript:;" onclick="$('.a_now_money li a').removeClass();$(this).addClass('now');$('#now_money').val('3,8000-20000元');">8000-20000元</a></li>
	        <li><a id="a_now4" href="javascript:;" onclick="$('.a_now_money li a').removeClass();$(this).addClass('now');$('#now_money').val('4,20000元以上');">20000元以上</a></li>
	      </ul>
	     </div>			

	     <input type="hidden" id="now_money" name="now_money" value='1,3000元以下'>     

	     <div class="form-group"> 
	      <label for="" class="control-label">定制人姓名：</label> 
	      <input class="form-control" name="Sname" value="" type="text"> 
	     </div>
	
	     <div class="form-group"> 
	      <label for="" class="control-label">定制人电话：</label> 
	      <input class="form-control" name="Sphone" value="" type="text"> 
	     </div>
	
	     <div class="form-group textarea"> 
	      <label for="" class="control-label">个性化需求：</label> 
	      <textarea name="Sremark" placeholder="请填写指定文章内容或其它需求" rows="5" class="form-control"></textarea>
	     </div>
	     			     
	     <div class="form-hot">
	     	<i class="icon-phone"></i><p>定制咨询热线:400-08-96567</p>
	     </div>			     
	
	     <div class="form-group"> 
	      <label for="" class="control-label">验<em>证</em>码：</label> 
	      <input class="form-control" name="captcha" type="text" value=""> 

	      <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />

	       <img src="/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=<?php echo getNchash();?>" name="imgyzm_" border="0" id="imgyzm_" class="fl ml5">
	       <a href="javascript:void(0)" onclick="javascript:document.getElementById('imgyzm_').src='/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=<?php echo getNchash();?>&amp;t=' + Math.random();" class="ml5" >
	        看不清楚,换一张</a>

	     </div>
	
	
		     <?php Security::getToken();?>
			<input type="hidden" name="form_submit" value="ok">

			<div  class="form-group-error-2"></div>

		    <button class="form-btn">提交</a>
	    </form>
	</div>			
</div>



	</div>
</div>


<script>
	

$(function(){

    $("#form1").validate({
        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".form-group-error").show());
        },
        rules: {  //验证字段
            Yname: "required",
            now_hua: "required",
            now_chi: "required",
            Sname: "required",
            Sphone: "required",
            Sremark: "required",
            captcha: "required"
        },
        messages: {  //返回错误信息
            Yname: "艺术家名称不能为空！",
            now_hua: "定制类型不能为空！",
            now_chi: "定制尺寸不能为空！",
            Sname: "定制人姓名不能为空！",
            Sphone: "定制人电话不能为空！",
            Sremark: "个性化需求不能为空！",
            captcha: "验证码不能为空！"
        }
    });


    $("#form2").validate({
        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".form-group-error-2").show());
        },
        rules: {  //验证字段
            now_money: "required",
            now_hua: "required",
            now_chi: "required",
            Sname: "required",
            Sphone: "required",
            Sremark: "required",
            captcha: "required"
        },
        messages: {  //返回错误信息
            now_money: "定制价格不能为空！",
            now_hua: "定制类型不能为空！",
            now_chi: "定制尺寸不能为空！",
            Sname: "定制人姓名不能为空！",
            Sphone: "定制人电话不能为空！",
            Sremark: "个性化需求不能为空！",
            captcha: "验证码不能为空！"
        }
    });


})


function pipei(){
	var yname = $("#custome_yname").val();

	$.post("/artist/index.php?act=artist_new&op=pipeiArtist",{'yname':yname},function(data){

		if(data.A_Class){
			$('.a_now_hua li a').removeClass();
			$("#a_now_hua" + data.A_Class).click();
		}else{
			alert('无相关匹配数据');
		}

    },'json');

}


</script>