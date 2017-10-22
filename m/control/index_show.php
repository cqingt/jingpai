	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/parallax.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/parallax-animation.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/demo.css" />
	
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/frozen.css">
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/js/zepto.min.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/js/frozen.js"></script>
<?php
	$titlearray = array(
		0=>'现在的你可以化身竞猜帝免费领取超级大奖啦！',
		1=>'喂！都把门开开！都看看我是谁家的大奖！？',
		2=>'宝宝找不到家了！3.大奖落谁家？奥运竞猜进行时，你还不行动吗？',
		3=>'只要三分钟，答题还能赢大奖？别说我没告诉你！',
		4=>'奥运竞猜大礼包，你准备好领走了吗？',
		5=>'【免费赢大奖】里约奥运知多少？不知道还不能猜嘛？',
	);
	$array['P']['title'] = $titlearray[rand(0,5)];
	$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160729/img/home-t2.png";
	$array['P']['link'] = urlWap('zhuanti','ad_20160729'); //分享连接
	$array['Y']['link'] = urlWap('zhuanti','ad_20160729'); //分享连接
	$array['Y']['title'] = $titlearray[rand(0,5)];
	$array['Y']['desc'] = '里约奥运竞猜活动';
	$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160729/img/home-t2.png";
	echo weixinShare($array);
?>
	<style>
	/* custom */
	section[data-id="1"] {
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home.jpg) no-repeat center top;
		background-size: 100%;
	}
	.box1 {
		width: 100%;
		height: 200px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-t1.png) no-repeat center top;
		background-size: 100%;
		position: absolute;
		left: 0px; top: 10px;
	}
	.box2 {
		width: 100%;
		height: 400px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-t2.png) no-repeat center top;
		background-size: 100%;
		position: absolute;
		left: 0px; top: 5%;
	}
	.box3 {
		width: 100%;
		height: 100px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-t3.png) no-repeat center top;
		background-size: 100%;		
		position: absolute;
		left: 0px; top: 43%;
	}
	.box4 {
		width: 100%;
		height: 200px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-t4.png) no-repeat center top;
		background-size: 100%;		
		position: absolute;
		left: 0px; top: 54%;
	}
	.box5 {
		width: 100%;
		height: 200px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-btn.png) no-repeat center top;
		background-size: 100%;		
		position: absolute;
		left: 0px; top: 84%;
	}	
	.box6 {
		width: 100%;
		height: 200px;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/home-footer.png) no-repeat center top;
		background-size: 100%;		
		position: absolute;
		left: 0px; top: 95.5%;
	}	

	</style>



<div class="wrapper">
    <div class="pages">
        <section class="page">
            <div class="box1" id="btnRule" data-animation="fadeInToBottom"></div>
            <div class="box2" data-animation="fadeInToTop" data-delay="500"></div>
            <div class="box3" data-animation="fadeInToLeft" data-delay="800"></div>
            <div class="box4" data-animation="fadeInToRight" data-delay="1000"></div>
            <div data-href="<?php echo urlWap('zhuanti','ad_20160729',array('action'=>'on','num'=>'1'));?>" class="box5" data-animation="fadeInToLeft" data-delay="1400"></div>
            <div class="box6" data-animation="fadeInToTop" data-delay="1800"></div>
        </section>  
    </div>
</div>

<section id="dialog">
	<div class="demo-item">
		<div class="demo-block">
			<div class="ui-dialog">
			    <div class="ui-dialog-cnt">
                    <i class="ui-dialog-close" data-role="button"></i>
			        <div class="ui-dialog-bd">
			           <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/rule.png"/>
			        </div>
			    </div>        
			</div>
 
			
		</div>
    	<script class="demo-script">


        </script>
	</div>
</section>


<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/js/parallax.js"></script>
<script>
	//下一题
	function XiaYiTi(TiId){
		<?php if($output['DaTiCount'] > 0){ ?>
				alert("您已经参与过答题了！");
				return false;
		<?php } ?>
		$.ajax({
			        url:"<?php echo urlWap('zhuanti','ad_20160729',array('action'=>'on'));?>",
			        type:"POST",
			        data:{num:TiId},
			        dateType:'json',
			        success:function(html){
						if(html == -2){
							alert("您已经参与过答题了！");
							return false;
						}
						if(html == -1){
							location.href = "<?php echo urlWap('zhuanti','ad_20160729',array('action'=>'ending'));?>";
						}else{
							$(".wrapper").html(html);
						}
			        }
			});
	}
	function dati(daan){
		  $('.answer-list li').parent().children().siblings().removeClass("active"); 
		  $("#Ti_"+daan).addClass("active"); 
		  var NumberQuestions = $("#NumberQuestions").val(); 
		  $.ajax({
				url:"<?php echo urlWap('zhuanti','ad_20160729',array('action'=>'getDaTi'));?>",
				type:"POST",
				data:{daan:daan,NumberQuestions:NumberQuestions},
				dateType:'json',
				success:function(html){
					$(".wrapper").html(html);
				}
		  });
	}

	$('.pages').parallax({
		direction: 'vertical', 	// horizontal (水平翻页)
		swipeAnim: 'default', 	// cover (切换效果)
		drag:      true,		// 是否允许拖拽 (若 false 则只有在 touchend 之后才会翻页)
		loading:   true,		// 有无加载页
		indicator: false,		// 有无指示点
		arrow:     false,		// 有无指示箭头
		onchange: function(index, element, direction) {
		},
		orientationchange: function(orientation) {
		}
	});
	
//	代替a标签
	$('.page div').click(function() {
		if($(this).data('href')) {
			<?php if($output['DaTiCount'] > 0){ ?>
				alert("您已经参与过答题了！");
				return false;
			<?php } ?>
			$.ajax({
			        url:$(this).data('href'),
			        type:"POST",
			        data:{num:1},
			        dateType:'json',
			        success:function(html){
						if(html == -2){
							alert("您已经参与过答题了！");
							return false;
						}
						if(html == -1){
							location.href = "<?php echo urlWap('zhuanti','ad_20160729',array('action'=>'ending'));?>";
						}else{
							$(".wrapper").html(html);
						}
			        }
				});
		}
	});
	$('.ui-header .ui-btn').click(function() {
		location.href = "<?php echo urlWap('zhuanti','ad_20160729');?>";
	});
	
	
	$("#btnRule").click(function(){
	    var dia2=$(".ui-dialog").dialog("show");
	    dia2.on("dialog:action",function(e){
	        console.log(e.index)
	    });
	})
	$(".ui-dialog-close").click(function(){
	    var dia2=$(".ui-dialog").dialog("hide");
	    dia2.on("dialog:action",function(e){
	        console.log(e.index)
	    });
	})

</script>