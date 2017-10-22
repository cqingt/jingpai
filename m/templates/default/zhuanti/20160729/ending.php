	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/parallax.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/parallax-animation.css" />
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/demo.css" />
	
	<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/css/frozen.css">
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/js/zepto.min.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/js/frozen.js"></script>

	<style>
	/* custom */
	section[data-id="1"] {
		background:#191919 url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/ending-top.jpg) no-repeat center top;
		background-size: 100%;
		z-index: 4;
	}
	.box1 {
		width: 100%;
		height: 100%;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/ending-bottom.png) no-repeat center bottom;
		background-size: 100%;
		position: absolute;
		left: 0px; bottom: 0;
	}
	.box2 {
		width: 100%;
		color: #f8ed00;
		width: 100%;
		font-size: 24px;
		text-align: center;
		background-size: 100%;
		line-height: 26px;
		margin-top: 15%;
	}
	.box3 {
		width: 100%;
		text-align: center;
		color: #37fff8;
		font-size: 70px;
		line-height: 72px;
		margin-top: 5%;
		font-weight: bold;
		background-size: 100%;		
	}
	.box4 {
		width: 100%;
		text-align: center;
		color: #37fff8;
		background-size: 100%;	
		line-height: 52px;	
		font-size: 50px;
		margin-top: 2%;
	}
	.box5 {
		width: 100%;
		margin-top: 6%;
		background-size: 100%;		
		text-align: center;
		color: #c7f2ff;
		font-size: 16px;
	}	
	.box5 p strong {
		font-size: 20px;
	}
	.box6 {
		width: 100%;
		height: 100%;
		margin-top: 10%;
		background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/btn-zhuanfa.png) no-repeat center top;
		background-size: 100%;		
	}	

	</style>
<?php
	$titlearray = array(
		0=>'现在的你可以化身竞猜帝免费领取超级大奖啦！',
		1=>'喂！都把门开开！都看看我是谁家的大奖！？',
		2=>'宝宝找不到家了！3.大奖落谁家？奥运竞猜进行时，你还不行动吗？',
		3=>'只要三分钟，答题还能赢大奖？别说我没告诉你！',
		4=>'奥运竞猜大礼包，你准备好领走了吗？',
		5=>'【免费赢大奖】里约奥运知多少？不知道还不能猜嘛？',
	);
	$array['P']['title'] = '我是第'.$output['count'].'位为中国奥运健儿加油的人，邀你一起为祖国加油！';
	$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160729/img/100-100.jpg";
	$array['P']['link'] = urlWap('zhuanti','ad_20160729'); //分享连接
	$array['Y']['link'] = urlWap('zhuanti','ad_20160729'); //分享连接
	$array['Y']['title'] = '我是第'.$output['count'].'位为中国奥运健儿加油的人，邀你一起为祖国加油！';
	$array['Y']['desc'] = '爱祖国，爱奥运！';
	$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160729/img/100-100.jpg";
	echo weixinShareHuiDiao($array,urlWap('zhuanti','ad_20160719'),'ad_20160729');
?>

<div class="wrapper">
    <div class="pages">
        <section class="page">
            <div class="box1"></div>
            <div class="box2" data-animation="fadeInToTop" data-delay="500">
            	我是第<?php echo $output['count'];?>位
            </div>
            <div class="box3" data-animation="fadeInToLeft" data-delay="800">
            	预言帝
            </div>
            <div class="box4" data-animation="fadeInToRight" data-delay="1000">
            	句句灵验
            </div>
            <div data-href="" class="box5" data-animation="fadeInToLeft" data-delay="1400">
            	<p>转发朋友圈，告诉全世界！</p>
            	<p>知道我大中国有多<strong>硬</strong>吗！？</p>
            </div>
            <div class="box6" id="btnZhuan" data-animation="fadeInToTop" data-delay="1800"></div>
        </section>  
    </div>
</div>

<section id="dialog">
	<div class="demo-item">
		<div class="demo-block">
			<div class="ui-dialog">
			    <div class="ui-dialog-cnt cntt">
			        <div class="ui-dialog-bd">
			          <i class="dl-dialog-close" data-role="button"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/share.png"/></i>
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
			location.href = $(this).data('href');
		}
	});
	$('.ui-header .ui-btn').click(function() {
		location.href = "<?php echo urlWap('zhuanti','ad_20160729');?>";
	});
	
	
	$("#btnZhuan").click(function(){
	    var dia2=$(".ui-dialog").dialog("show");
	    dia2.on("dialog:action",function(e){
	        console.log(e.index)
	    });
	})
	$(".ui-dialog-close,.dl-dialog-close").click(function(){
	    var dia2=$(".ui-dialog").dialog("hide");
	    dia2.on("dialog:action",function(e){
	        console.log(e.index)
	    });
	})

</script>
