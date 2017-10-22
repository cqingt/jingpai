/**
 * Created by Administrator on 2016/6/17.
 */
var popusertimer = null;
var query = '?';
function bytes(str) {
    var len = 0;
    for (var i = 0; i < str.length; i++) {
        if (str.charCodeAt(i) > 127) {
            len++;
        }
        len++;
    }
    return len;
}
function login(){
	
	
	var url=g_site_url+"index.php?user/ajaxpoplogin";
	var myModalTrigger = new $.zui.ModalTrigger({url:url});
	myModalTrigger.show();
}
$(".tag_ul li").click(function(){
	$(".tag_ul li").removeClass("i_s_current");
			$(this).addClass("i_s_current");
			$(".i_s_text1").html($(this).html());
			 var taginfo= $(this).html();
			 var val=$("#search-kw").val();
			 if(val.length>0){
				 search_word(taginfo,val);
			 }
		    	
})
//Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
function OnInput (event) {
	 var taginfo= $(".i_s_text1").html();
	   var val=event.target.value;
	   search_word(taginfo,val);
}
// Internet Explorer
function OnPropChanged (event) {
    if (event.propertyName.toLowerCase () == "value") {
    	var val=event.srcElement.value;
    	 var taginfo= $(".i_s_text1").html();
    	search_word(taginfo,val);
    }
}
function search_word(taginfo,val){
	
	   var tagid=0; //0表示全部 
	   var s_val=2;
	   switch(taginfo){
	   case '全部':
		   tagid=0;
		   break;
	   case '问题':
		   tagid=1;
		   break;
	   case '文章':
		   tagid=2;
		   break;
	   case '标签':
		   s_val=1;
		   tagid=3;
		   break;
	   case '用户':
		   s_val=1;
		   tagid=4;
		   break;
	   }
	 
	 
	    
	    
	    if(val.length>=s_val){
			$(".search-list").removeClass("hide");
			$(".search-list").html("");
		    $.ajax({
		        type: "POST",
		        async: true,
		      
		      
		        data:{'word':val,'tagid':tagid},
		        url:g_site_url + "index.php?question/searchkey",
		        success: function(msg) {
		        	
		        	msg=msg.replace("&lt;em&gt;",'');
		        	msg=msg.replace("&lt;/em&gt;",'');
		        	msg=msg.replace("<font color=red>",'');
		        	msg=msg.replace("</font>",'');
		            
		        	$(".search-list").html(msg);
		    
		         
		        }
		    });
		}else{
			$(".search-list").addClass("hide");
			$(".search-list").html("");
		}
}
load_message_sowenda();
function load_message_sowenda() {
	
    if (g_uid == 0) {
        return false;
    }
    $.ajax({
        type: "POST",
        async: false,
        cache: false,
        url:g_site_url + "index.php?user/ajaxloadmessage",
        success: function(msg) {
        	//var msg=eval('({'+msg+'})');
        //	console.log(msg);
        
        	var msg_count=parseInt(msg.msg_personal)+parseInt(msg.msg_system);
	    	
	    	$(".msg-count").html(msg_count);
	
        }
    });
   
}
$(".sliderNav_list li").hover(function(){
    $(".sliderNav_list li .nav_footer").hide();
    $(this).find(".nav_footer").show();
},function(){

});
/*删除回答*/
function delete_answer(aid, qid) {
    if (confirm('确定删除问题？该操作不可返回！') === true) {
        document.location.href = g_site_url + '' + query + 'question/deleteanswer/' + aid + '/' + qid + g_suffix;
    }
}
/*关注问题*/
function attentto_question(qid) {
    if (g_uid == 0) {
        login();
    }
    $.post(g_site_url + "index.php?question/attentto", {qid: qid}, function(msg) {
        if (msg == 'ok') {
            if ($("#attenttoquestion").hasClass("button_attention")) {
                $("#attenttoquestion").removeClass("button_attention");
                $("#attenttoquestion").addClass("button_followed");
                $("#attenttoquestion").html(' <i class="icon icon-heart text-success">取消关注');
            } else {
                $("#attenttoquestion").removeClass("button_followed");
                $("#attenttoquestion").addClass("button_attention");
                $("#attenttoquestion").html(' <i class="icon icon-heart text-success">关注');
            }
        }
    });
}
/*关注用户*/
function attentto_user(uid) {
    if (g_uid == 0) {
        login();
    }
    $.post(g_site_url + "index.php?user/attentto", {uid: uid}, function(msg) {
        if (msg == 'ok') {
            if ($("#attenttouser_"+uid).hasClass("button_attention")) {
                $("#attenttouser_"+uid).removeClass("button_attention");
                $("#attenttouser_"+uid).addClass("button_followed");
                $("#attenttouser_"+uid).val("取消关注");
                $("#attenttouser_"+uid).html('<i class="icon icon-heart"></i>取消关注');
            } else {
                $("#attenttouser_"+uid).removeClass("button_followed");
                $("#attenttouser_"+uid).addClass("button_attention");
                $("#attenttouser_"+uid).val("关注");
                $("#attenttouser_"+uid).html('<i class="icon icon-heart"></i>关注');
            }
        }
    });
}

//分类选择
$("#category1").change(function() {
    fillcategory(category2, $("#category1 option:selected").val(), "category2");
    $("#jiantou1").show();
    $("#category2").show();
});
$("#category2").change(function() {
    fillcategory(category3, $("#category2 option:selected").val(), "category3");
    $("#jiantou2").show();
    $("#category3").show();
});
$(".wgt-zhima .card").hover(function(){

    $(this).find(".animate-text").slideUp();
    $(this).find(".animate").css({"height":"102px","width":"102px"});
    $(this).find(".bottom").animate({height:"196px"});
    $(this).find(".name").css({"font-size":"18px"});
    $(this).find(".info").slideUp();
    $(this).find(".h-section").css({"height":"40px","opacity":"1"});

    $(this).find(".people").css({"visibility":"visible","opacity":"1"});
},function(){
    $(this).find(".animate-text").slideDown();
    $(this).find(".info").slideDown();
    $(this).find(".animate").css({"height":"118px","width":"118px"});
    $(this).find(".bottom").animate({height:"111px"});
    $(this).find(".name").css({"font-size":"14px"});
    $(this).find(".h-section").css({"height":"0px","opacity":"0"});
    $(this).find(".people").css({"visibility":"hidden","opacity":"0"});
});
//usercard弹出层
function pop_user_on(popobj, uid, type) {
    var myalign = "left-27 bottom-30";
    if (type == 'text') {
        myalign = "left-21 bottom-10";
    } else if (type == 'image_active') {
        myalign = "left-40 bottom-43";
    } else if (type == 'image_follow') {
        myalign = "left-10 bottom-20";
    }
 
    if (popusertimer) {
        clearTimeout(popusertimer);
    }
  
    popusertimer = setTimeout(function() {
        $("#usercard").show();
    
    }, 300);
    $("#usercard").load(g_site_url + "index.php" + query + "user/ajaxuserinfo/" + uid,function(data){
    	$(this).html(data);
         var offset=$(popobj).offset();
    
    	$(this).css({"position":"absolute","left":offset.left+37,"top":offset.top});
    	
    	
    });
}
function pop_user_out() {
    if (popusertimer) {
        clearTimeout(popusertimer);
    }
    popusertimer = setTimeout(function() {
        $("#usercard").hide();
       var userinfo=' <div class="usercard_in clearfix"><div class="loading"><img src="./css/default/loading.gif" />&nbsp;加载中...</div></div>';
       $("#usercard").html(userinfo);
    }, 300);
}
//usercard关闭
$("#usercard").hover(function() {
    if (popusertimer) {
        clearTimeout(popusertimer);
    }
    $("#usercard").show();
}, function() {
    if (popusertimer) {
        clearTimeout(popusertimer);
    }
    popusertimer = setTimeout(function() {
        $("#usercard").hide();
    }, 300);
});
//登陆退出
$("#loginout").click(function(){

	  
    $.ajax({
        //提交数据的类型 POST GET
        type:"GET",
        //提交的网址
        url:"/?api_user/loginoutapi",
        //提交的数据
       
        //返回数据的格式
        datatype: "text",//"xml", "html", "script", "json", "jsonp", "text".

        //成功返回之后调用的函数
        success:function(data){
          

            if(data=='loginout_ok'){
                window.location.href=g_site_url;
            }
        }   ,
       
        //调用出错执行的函数
        error: function(){
            //请求出错处理
        }
    });
});

function checkall(checkname) {
    var chkall = $("#chkall:checked").val();
    if (chkall && (chkall === 'chkall')) {
        $("input[name^='" + checkname + "']").each(function() {
            $(this).prop("checked", "checked");
        });
    } else {
        $("input[name^='" + checkname + "']").each(function() {
            $(this).removeProp("checked");
        });
    }
}
//问题分类选择函数
function initcategory(category1) {
    var selectedcid1 = $("#selectcid1").val();
    $("#category1").html('');
    for (var i = 0; i < category1.length; i++) {
        var selected = '';
        if (selectedcid1 === category1[i][0]) {
            selected = ' selected';
        }
        $("#category1").append("<option value='" + category1[i][0] + "' " + selected + ">" + category1[i][1] + "</option>");
    }

}
function fillcategory(category2, value1, cateid) {
    var optionhtml = '<option value="0">不选择</option>';
    var selectedcid = 0;
    if (cateid === "category2") {
        selectedcid = $("#selectcid2").val();
    } else if (cateid === "category3") {
        selectedcid = $("#selectcid3").val();
    }
    $("#" + cateid).html("");
    for (var i = 0; i < category2.length; i++) {
        if (value1 === category2[i][0]) {
            var selected = '';
            if (selectedcid === category2[i][1]) {
                selected = ' selected';
                $("#" + cateid).show();
            }
            optionhtml += "<option value='" + category2[i][1] + "' " + selected + ">" + category2[i][2] + "</option>";
        }
    }
    $("#" + cateid).html(optionhtml);
}
//验证码
function updatecode() {
  var img = g_site_url + "index.php" + query + "user/code/" + Math.random();
  $('#verifycode').attr("src", img);
}

//验证码检测
function check_code() {
  var code = $.trim($('#code').val());
  if ($.trim(code) == '') {
      $('#codetip').html("验证码错误").removeClass("hide");
     
      return false;
  }
  $.ajax({
      type: "GET",
      async: false,
      cache: false,
      url: g_site_url + "index.php" + query + "user/ajaxcode/" + code,
      success: function(flag) {
          if (1 == flag) {
              $('#codetip').html("<span><i class='icon icon-check-board text-danger'></i>验证码正确</span>").removeClass("hide");
             
              return true;
          } else {
              $('#codetip').html("验证码错误").removeClass("hide");
             
              return false;
          }

      }
  });
}
$(".expert-panel .user-info").hover(function(){
	$(this).find("img").css("filter","50");
	$(this).find("img").css("opacity","0.5");
	$(this).find(".btnask").show();
},function(){
	$(this).find("img").css("filter","100");
	$(this).find("img").css("opacity","1");
	$(this).find(".btnask").hide();
});