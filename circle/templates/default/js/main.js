
//tab
$(function(){
    function tabs(tabTit,on,tabCon){
        $(tabCon).each(function(){
            $(this).children().eq(0).show();

        });
        $(tabTit).each(function(){
            $(this).children().eq(0).addClass(on);
        });
        $(tabTit).children().click(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
            $(tabCon).children().eq(index).show().siblings().hide();
        });
    }
    tabs(".handover_title","on",".handover_con");

})
 
//边距 
$(function(){
	$('.community-powered-search li:nth-child(2n+1)').css('margin-right','126px');
	$('.like-list li:nth-child(4n+1)').css('margin-left','0');
	$('.visitor-list li:nth-child(3n+1)').css('margin-left','0');
})
	

//修复checkbox的状态切换和动态取值的问题
//为checkbox新增一个isCheck属性来替换checked属性的不兼容性
$(function(){
    $(".regular-radio").click(function(){
        if($(this).attr("isCheck") == "true") {
            $(this).removeAttr("isCheck");       
        } else {
            $(this).attr("isCheck", "true");
        }
    })
        function getValues()
        {
            var list="";
            $(".ckbox").each(function(){
                if($(this).attr("isCheck") == "true"){
                     list += $(this).val() + ",";
                }
            })
            alert(list);       
        }
})
$(function(){
        var mst;
        $(".avatar").hover(function(){
        	alert(1);
        	curItem = $(this);
            mst = setTimeout(function(){
                curItem.find(".popup_avatar").fadeIn();    
                mst = null;
            });    
            },function(){
                if(mst!=null)clearTimeout(mst);
                curItem.find(".popup_avatar").fadeOut();               
            });   
})




$(function(){
    $(".face.one,.close.one").click(function(){ $(".SmohanFaceBox.con").toggle(); });
     $(".face.two,.close.two").click(function(){ $(".SmohanFaceBox.two").toggle(); });
     
     $(".SmohanFaceBox.con").mouseleave(function(){ $(".SmohanFaceBox.con").toggle(); });  
       $(".SmohanFaceBox.two").mouseleave(function(){ $(".SmohanFaceBox.two").toggle(); });  
})


$(document).ready(function(){
    //限制字符个数
    $('.abstract-text p').each(function(){
        var maxwidth=130;
        if($(this).text().length>maxwidth){
            $(this).text($(this).text().substring(0,maxwidth));
            $(this).html($(this).html()+'<span style="color: red;">查看全部</span>');
        }
    });
});