$(function(){
//a标签
	$('*').click(function() {
		if($(this).data('href')) {
			location.href = $(this).data('href');
		}
	});
	$('.ui-header .ui-btn').click(function() {
		location.href = 'index.html';
	});
})


$(function(){
	$('.ui-header-right .icon-navtc').click(function(){
		$('div.footerNav').toggleClass('shop');
		$(".swiper-age").toggleClass('mtage');
	});
})


$(function(){
    $(window).scroll(function(){
    	var PLY = $('#PingLunYeMmian');
        if($(window).scrollTop()>250){
            $('.tabs a:nth-child(2)').addClass('active').prev().removeClass();
        }else{
            $('.tabs a:nth-child(1)').addClass('active').next().removeClass();
        }
        if (PLY.css("display")=='block'){
        	$('.tabs a:nth-child(1),.tabs a:nth-child(2)').removeClass();
        }
    })

})
