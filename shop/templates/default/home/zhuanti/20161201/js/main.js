$(function(){
   var oNav = $('#LoutiNav');//导航壳
   var aNav = oNav.find('a');//导航
   var aDiv = $('#main .louceng');//楼层
	//回到顶部
	$(window).scroll(function(){
		 var winH = $(window).height();//可视窗口高度
		 var iTop = $(window).scrollTop();//鼠标滚动的距离
		 
		 if(iTop>=$('#header').height()){
		 	oNav.fadeIn();
		 //鼠标滑动式改变	
		 aDiv.each(function(){
		 	if(winH+iTop - $(this).offset().top>winH/2){
		 		aNav.removeClass('active');
		 		aNav.eq($(this).index()).addClass('active');
		 	}
		 })
		 }else{
		 	oNav.fadeOut();
		 }
	})
	//点击回到当前楼层
	aNav.click(function(){
		var t = aDiv.eq($(this).index()).offset().top+80;
		$('body,html').animate({"scrollTop":t},500);
		$(this).addClass('active').siblings().removeClass('active');
	});


})
