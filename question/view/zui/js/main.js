
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
    tabs(".investment_title","on",".investment_con");

})
$(function(){
	var $suList = $('.su-list'),
	    $suTc = $('.su-tc');
	    $suList.find('li').on('hover',function(){
			$(this).each(function(){
			    $suTc.eq($(this).index()).toggleClass('show');
			  });
	    })
})
