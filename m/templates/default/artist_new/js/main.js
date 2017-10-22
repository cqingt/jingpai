//a标签
$(function(){
	$('*').click(function() {
		if($(this).data('href')) {
			location.href = $(this).data('href');
		}
	});
	$('.ui-header .ui-btn').click(function() {
		location.href = 'index.html';
	});
})

//导航的点击显示
$(function(){
	$('.ui-header-right .icon-navtc').click(function(){
		$('div.footerNav').toggleClass('shop');
		$("body>section").toggleClass('mtage');
	});
})

// 商品详情页 变色
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

// layer 弹窗	        
$(function(){
    //点赞
    $('#intPraise').on('click', function(){
    	var aid = $(this).attr('aid');
		$.ajax({
			url:"index.php?act=artist_blog&op=isZan_Cang",
			type:"POST",
			data:{aid:aid,type:'zan'},
			cache:false,
			dateType:'json',
			success:function(data){
				switch(data)
				{
					case '1':
						layer.msg('点赞+1');
						var num = $('#intPraise > em').html();
						$('#intPraise > em').html(parseInt(num)+1);
						$(this).addClass('active');
						break;
					case '11':
						layer.msg('未登录、请在登录状态下操作！');
						window.location.href="http://m.96567.com/index.php?act=login&op=index";
						break;
					case '22':
						layer.msg('操作失败、请重新操作！');
						break;
					case '33':
						layer.msg('您已点过赞！');
						break;
					case '44':
						layer.msg('请稍后操作！');
						break;
				}
			}
		});
    })
    
	//弹出一个收藏成功的提示
	$('#intCollect').on('click', function(){
		var aid = $(this).attr('aid');
		$.ajax({
			url:"index.php?act=artist_blog&op=isZan_Cang",
			type:"POST",
			data:{aid:aid,type:'cang'},
			cache:false,
			dateType:'json',
			success:function(data){
				switch(data)
				{
					case '1':
						layer.msg('收藏成功', {icon: 6});
						$(this).addClass('active');
						break;
					case '11':
						layer.msg('未登录、请在登录状态下操作！', {icon: 6});
						window.location.href="http://m.96567.com/index.php?act=login&op=index";
						break;
					case '22':
						layer.msg('操作失败、请重新操作！', {icon: 6});
						break;
					case '33':
						layer.msg('您已收藏！', {icon: 6});
						break;
					case '44':
						layer.msg('请稍后操作！', {icon: 6});
						break;
				}
			}
		});
	})
})

//博客的文字展开
$(function(){
var cur_status = "less";
$.extend({
	show_more_init:function(){
	  //alert("show_more_init!");
		var charNumbers=$(".content").html().length;//总字数
		var limit=100;//显示字数
		if(charNumbers>limit)
		{
		var orgText=$(".content").html();//原始文本
		var orgHeight=$(".content").height();//原始高度
		var showText=orgText.substring(0,limit);//最终显示的文本
		$(".content").html(showText);
		var contentHeight=$(".content").height();//截取内容后的高度
		$(".switch").click(
			function() {
				if(cur_status == "less"){
					$(".content").height(contentHeight).html(orgText).animate({ height:orgHeight}, { duration: "slow" });
					$(this).addClass("pack").removeClass("unfold").html("收起");
					cur_status = "more";
				}else{
					$(".content").height(orgHeight).html(showText).animate({ height:contentHeight}, { duration: "fast" });
					$(this).addClass("unfold").removeClass("pack").html("展开全部");
					cur_status = "less";
				}
			}
		);
		}
		else
		{
			$(".switch").hide();
		}
	}
	});
	$(document).ready(function(){
	$.show_more_init();
});
})

//侧栏
jQuery(document).ready(function($){
	var $lateral_menu_trigger = $('#cd-menu-trigger'),
		$content_wrapper = $('.cd-main-content'),
		$navigation = $('header');

	$lateral_menu_trigger.on('click', function(event){
		event.preventDefault();
		
		$lateral_menu_trigger.toggleClass('is-clicked');
		$navigation.toggleClass('lateral-menu-is-open');
		$content_wrapper.toggleClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			
			$('body').toggleClass('overflow-hidden');
		});
		$('#cd-lateral-nav').toggleClass('lateral-menu-is-open');
		
		if($('html').hasClass('no-csstransitions')) {
			$('body').toggleClass('overflow-hidden');
		}
	});

	$content_wrapper.on('click', function(event){
		if( !$(event.target).is('#cd-menu-trigger, #cd-menu-trigger span') ) {
			$lateral_menu_trigger.removeClass('is-clicked');
			$navigation.removeClass('lateral-menu-is-open');
			$content_wrapper.removeClass('lateral-menu-is-open').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
			$('#cd-lateral-nav').removeClass('lateral-menu-is-open');
			if($('html').hasClass('no-csstransitions')) {
				$('body').removeClass('overflow-hidden');
			}

		}
	});

	$('.item-has-children').children('a').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('submenu-open').next('.sub-menu').slideToggle(200).end().parent('.item-has-children').siblings('.item-has-children').children('a').removeClass('submenu-open').next('.sub-menu').slideUp(200);
	});
});