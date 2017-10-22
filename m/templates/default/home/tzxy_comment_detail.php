
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/component.css" />

<script type="text/javascript">
$(document).ready(function(){
    $("#btn_comment_submit").click(function(){
        if($("#input_comment_message").val() != '') {
        $.post("<?php echo urlWap('tzxy','comment_save');?>", $("#add_form").serialize(),function(data){
                if(data.result == 'true') {
                    $("#input_comment_message").val("");
					window.location.reload();
                } else {
					if(data.message == -1){
						window.location.href="<?php echo urlWap('login','index');?>";
					}else{
						alert(data.message);
					}

                }
            }, "json");
        }else{
			alert("请输入评论类容");
		}
    });


});
var j = 1;
$(function(){
	loadMore();	
})
$(window).scroll(function(){
	if($(document).height() - $(this).scrollTop() - $(this).height()<100) loadMore();
});
</script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/custom.js"></script>
<header>
 <a href="<?php echo urlWap('tzxy','index'); ?>"><i class="fa fa-angle-left fa-lg"></i></a>
 <a><?php echo $output['tzxy_title'];?></a>
 <a id="hea-btn" href="javascript:;"><i class="fa fa-bars fa-lg"></i></a>
</header>

<div class="navhome navhome-two">
  <ul>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'19'));?>">最新动态</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'39'));?>">藏市热点</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'53'));?>">发行公告</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'20'));?>">行情快讯</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'40'));?>">专家观点</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'57'));?>">藏品知识</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'56'));?>">拍卖结果</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'42'));?>">藏品赏析</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'55'));?>">书法字画</a></li>
  </ul>
</div> 
		  <article>
		  	  
		  	 <div class="comment mt14">
			 <form id="add_form" action="" class="article-comment-form">
				  <input id="input_comment_object_id" name="comment_object_id" type="hidden" value="<?php echo $output['detail_object_id'];?>" />
		  	 	  <textarea placeholder="我来说两句..." id="input_comment_message" name="comment_message"></textarea>
		  	 	  <a class="submit"  id="btn_comment_submit" href="javascript:(0);">提交</a>
			</form>
		  	 	  <ul id='lmlm_pic'>
		  	 	  </ul>
		  	 	  <span  id='loadingsave'><a class="functional-box"><i class="fa fa-spinner fa-spin"></i>正在载入</a></span>
		  	 </div>
</article>
<script>
function loadMore(){
	$.ajax({
		type: "GET", cache: false,
		url : "<?php echo urlWap('tzxy','AJAX_comment_list',array('aid'=>$output[detail_object_id]));?>",
		data: 'curpage=' + j,
		beforeSend:function(XMLHttpRequest){
			$("#loadingsave").show();
			$("#loadingsave").html("<a class='functional-box' href=''><i class='fa fa-spinner fa-spin'></i>正在载入</a>");
 		},
		success : function(html){
			if(html.length < 30 || <?php echo $output['page_count']+1; ?> < j){
				$("#loadingsave").html('<a class="functional-box">没有更多了</a>');
			}else{
				$('#lmlm_pic').append(html);
				$("#loadingsave").html('<a class="functional-box">向下拉加载数据</a>');
			}
		}
	});
	j++;
}
</script>