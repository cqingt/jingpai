
//tab
$(function(){
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
    tabs(".handover_title","on",".handover_con");

})

//边距 
$(function(){
	$('.collect-list').find("li:lt(6)").addClass('small');
	$('.collect-list li:last-child').addClass('last');
	$('.works-list1 li:nth-child(5n+1)').css('margin','0')
	$('.consult.home li:nth-child(2n+1)').css('margin','0')
	$('.product-display:nth-child(5n+1)').css('margin-left','0')
})

//批量管理以及删除功能
$(function(){
        ; +function ($) {
            var $operation = $('.art-batch'),
                $ulList = $('.ul-list-batch'),
                $i = $ulList.find('i');
                $span = $ulList.find('span');

            $span.click(function(){  
               $(this).closest('li').remove();
            }) 

            $('#batchManage').on('click', function () {
                var self = $(this),
                    val = self.data('value');
                if (~~val) {
                    self.text('取消管理').data('value', '0');
                    $span.remove();
                } else {
                    self.text('批量管理').data('value', '1');
                }
                $operation.toggle();
                $i.toggle();
            })
            $('#allCheck').on('click', function () {
                var _this=$(this),
                    val = ~~_this.data('value');
                if (val) {
                    $i.removeClass('del-yes')
                    _this.data('value', 0)
                } else {
                    $i.addClass('del-yes');
                    _this.data('value', 1)
                }
            })
            $i.on('click', function () {
                $(this).toggleClass('del-yes')
            })
            $('#delete').on('click', function () {
                $i.each(function () {
                    if ($(this).hasClass('del-yes')) {
                        $(this).parent().remove();
                    }
                })
            })
        }(jQuery); 	
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


//产品轮播
$(function () {
    var $tbThumb = $('.tb-thumb');
    $('.tb-thumb').on('mouseover', 'a', function () {
        var self = $(this),
            $jqzoom = self.parents('.tb-thumb').prev().find('.jqzoom');
        self.parents("li").addClass("tb-selected").siblings().removeClass("tb-selected");
        $jqzoom.attr({
            'src': self.find("img").attr("mid"),
            'rel': self.find("img").attr("big")
        })
    })
});

//内页导航显示与隐藏

$(function() {
    $("#navinside").mouseover(function(){
      if($("#secnav").css("display")=="none"){
        $("#secnav").show();
      }else{
        clearTimeout(time);
        time=setTimeout(function(){
          $("#secnav").hide();
        },1000)
      }
    });
    $("#navinside").mouseleave(function(){
      if($("#secnav").css("display")=="block"){
        time=setTimeout(function(){
          $("#secnav").hide();
        },100)
      }else{
        clearTimeout(time);
        $("#secnav").show();
      }
    });
    $("#secnav").mouseover(function(){
        clearTimeout(time);
    });
    $("#secnav").mouseleave(function(){
        $("#secnav").hide();
    });
  
});

//lunbotu
;(function($){
    
    $.fn.lunbotu=function(options){
        
        // var defaults={

        // }
    
        // //通过覆盖来传参数
        // var options=$.extend(defaults,options);
        
        return this.each(function(){

            var _lunbotu=jQuery('.lunbotu');

            var _box=jQuery('.lunbotu_box');

            var _this=jQuery(this); // 

            var lunbotuHei=_box.height();

            var Over='mouseover';

            var Out='mouseout';

            var Click='click';

            var Li="li";

            var _cirBox='.cir_box';

            var cirOn='cir_on';

            var _cirOn='.cir_on';

            var cirlen=_box.children(Li).length; //圆点的数量  图片的数量

            var lunbotuTime=4000; //轮播时间

            var switchTime=400;//图片切换时间

            cir();

            Btn();

        //根据图片的数量来生成圆点

            function cir(){

                _lunbotu.append('<ul class="cir_box"></ul>');

                var cir_box=jQuery('.cir_box');

                for(var i=0; i<cirlen;i++){

                    cir_box.append('<li style="" value="'+i+'"></li>');
                }

                var cir_dss=cir_box.width();

                cir_box.css({

                    left:'50%',

                    marginLeft:-cir_dss/2,

                    bottom:'20px' 

                });

                cir_box.children(Li).eq(0).addClass(cirOn);

            }

        //生成左右按钮

            function Btn(){

                _lunbotu.append('<div class="lunbotu_btn"></div>');

                var _btn=jQuery('.lunbotu_btn');

                _btn.append('<div class="left_btn"><</div><div class="right_btn">></div>');

                var leftBtn=jQuery('.left_btn');

                var rightBtn=jQuery('.right_btn');

            //点击左面按钮

                leftBtn.bind(Click,function(){

                var cir_box=jQuery(_cirBox);

                var onLen=jQuery(_cirOn).val(); 

                _box.children(Li).eq(onLen).stop(false,false).animate({

                    opacity:0

                },switchTime);

                if(onLen==0){

                    onLen=cirlen;

                }

                _box.children(Li).eq(onLen-1).stop(false,false).animate({

                    opacity:1

                 },switchTime);
                
                cir_box.children(Li).eq(onLen-1).addClass(cirOn).siblings().removeClass(cirOn);

                })

            //点击右面按钮

                rightBtn.bind(Click,function(){

                var cir_box=jQuery(_cirBox);

                var onLen=jQuery(_cirOn).val(); 

                _box.children(Li).eq(onLen).stop(false,false).animate({

                    opacity:0

                },switchTime);

                if(onLen==cirlen-1){

                        onLen=-1;

                    }

                _box.children(Li).eq(onLen+1).stop(false,false).animate({

                    opacity:1

                 },switchTime);
                
                cir_box.children(Li).eq(onLen+1).addClass(cirOn).siblings().removeClass(cirOn);

                })
            }

        //定时器

             int=setInterval(clock,lunbotuTime);

             function clock(){

                var cir_box=jQuery(_cirBox);

                var onLen=jQuery(_cirOn).val(); 

                _box.children(Li).eq(onLen).stop(false,false).animate({

                    opacity:0

                },switchTime);

                if(onLen==cirlen-1){

                        onLen=-1;

                    }

                _box.children(Li).eq(onLen+1).stop(false,false).animate({

                    opacity:1

                 },switchTime);
                
                cir_box.children(Li).eq(onLen+1).addClass(cirOn).siblings().removeClass(cirOn);
                
             }

        // 鼠标在图片上 关闭定时器
            
            _lunbotu.bind(Over,function(){

                clearTimeout(int);

            });

            _lunbotu.bind(Out,function(){

                int=setInterval(clock,lunbotuTime);

            });

        //鼠标划过圆点 切换图片

            jQuery(_cirBox).children(Li).bind(Over,function(){

                var inde = jQuery(this).index();

                jQuery(this).addClass(cirOn).siblings().removeClass(cirOn);

                _box.children(Li).stop(false,false).animate({

                    opacity:0

                },switchTime);

                _box.children(Li).eq(inde).stop(false,false).animate({

                    opacity:1

                },switchTime);

            });


        });

    }
    
})(jQuery);