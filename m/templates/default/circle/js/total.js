 $(function(){

//tab切换
        function tabs(tabTit,on,tabCon){
            $(tabCon).each(function(){
                $(this).children().eq(0).show();

            });
            $(tabTit).each(function(){
                $(this).children().eq(0).addClass(on);
            });
            $(tabTit).children().hover(function(){
                $(this).addClass(on).siblings().removeClass(on);
                var index = $(tabTit).children().index(this);
                $(tabCon).children().eq(index).show().siblings().hide();
            });
        }
        tabs(".investment_title","active",".investment_con");

    })

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
//	判断input是否为空
	var IconClose = $('.ui-icon-close');

	$(IconClose).on('click',function(){
		 $(".uiInput").val("");
         $('.dis-btn').attr('disabled',true);
         $('.uiInput').focus();
         $(IconClose).hide();
	})
	
	$('.uiInput').on('keyup', function(){
	    var v=$('input').val();
	    if(!v){
	      $('.dis-btn').attr('disabled', true) 
	      $(IconClose).hide();
	    }
	    else{
	      $('.dis-btn').attr('disabled', false)
	      $(IconClose).show();
	      
	    }
	});
})

$(function(){
//	性别
	$(".gender").change(function(){
		var getSelectVal = $(".gender option:selected").text();
		$("span.xb").text(getSelectVal);
	})

//喜欢
	$('.icon-like').on('click',function(){
		$(this).toggleClass('active');
	})
	
	
})

$(function(){
	var UiAdd = $('.ui-add');
	
	UiAdd.on('click',function(){
		if($('.co').length<20){
           $(".demo-co").append('<div class="co"><input class="uiiInput" type="text" placeholder="请输入"></div>');
		}
		else {
			alert('最多可添加20个');
		}
	})
})

$(function(){
	  var tabsSwiper = new Swiper('.swiper-container',{
	    speed:500,
	    onSlideChangeStart: function(){
	      $(".tabs .active").removeClass('active')
	      $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active')  
	    }
	  })
	  $(".tabs a").on('touchstart mousedown',function(e){
	    e.preventDefault()
	    $(".tabs .active").removeClass('active')
	    $(this).addClass('active')
	    tabsSwiper.swipeTo( $(this).index() )
	  })
	  $(".tabs a").click(function(e){
	    e.preventDefault()
	  })
})

 