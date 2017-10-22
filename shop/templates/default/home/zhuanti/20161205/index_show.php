<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/css/main.css"/>


<div id="header" class="twelve01"></div>
<div class="twelve02">
	<div class="ui-wrap six">
		<a href="#tier1"></a>
		<a href="#tier2"></a>
		<a href="#tier3"></a>
		<a href="#tier4"></a>
		<a href="#tier5"></a>
		<a href="#tier6"></a>
	</div>
</div>
<div id="main">
<?php if($output['goods_list']['goods_list_1']){?>
<div class="louceng">
<div id="tier1" class="twelve03"></div>
<div class="twelve04">
	<div class="ui-wrap four">
		<?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
			<i class="icon-twelve"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/images/icon1.png"/></i>
			<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
			<h2><?php echo $v['goods_name'];?></h2>
			<div class="ui-txt">
				<span class="te1">
					<p>双12限时特惠</p>
					<strong><i>¥</i><?php echo intval($v['promotion_price'])?intval($v['promotion_price']):intval($v['goods_price']);?></strong>
				</span>
				<span class="te2">立即抢购</span>
			</div>
		</a>
		<?php }?>
	</div>
</div>
<?php }?>
<?php if($output['goods_list']['goods_list_2']){?>
</div>
<div class="louceng">
<div id="tier2" class="twelve05"></div>
<div class="twelve06">
	<div class="ui-wrap four">
		<?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
			<i class="icon-twelve"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/images/icon2.png"/></i>
			<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
			<h2><?php echo $v['goods_name'];?></h2>
			<div class="ui-txt">
				<span class="te1">
					<p>双12限时特惠</p>
					<strong><i>¥</i><?php echo intval($v['promotion_price'])?intval($v['promotion_price']):intval($v['goods_price']);?></strong>
				</span>
				<span class="te2">立即抢购</span>
			</div>
		</a>
		<?php }?>
	
	</div>
</div>
<?php }?>
<?php if($output['goods_list']['goods_list_3']){?>
</div>
<div class="louceng">
<div id="tier3" class="twelve07"></div>
<div class="twelve08">
	<div class="ui-wrap four">
		<?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
			<i class="icon-twelve"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/images/icon3.png"/></i>
			<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
			<h2><?php echo $v['goods_name'];?></h2>
			<div class="ui-txt">
				<span class="te1">
					<p>双12限时特惠</p>
					<strong><i>¥</i><?php echo intval($v['promotion_price'])?intval($v['promotion_price']):intval($v['goods_price']);?></strong>
				</span>
				<span class="te2">立即抢购</span>
			</div>
		</a>
		<?php }?>
		
	</div>
</div>
<?php }?>
<?php if($output['goods_list']['goods_list_4']){?>
</div>
<div class="louceng">
<div id="tier4" class="twelve09"></div>
<div class="twelve10">
	<div class="ui-wrap four">
		<?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
			<i class="icon-twelve"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/images/icon3.png"/></i>
			<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
			<h2><?php echo $v['goods_name'];?></h2>
			<div class="ui-txt">
				<span class="te1">
					<p>双12限时特惠</p>
					<strong><i>¥</i><?php echo intval($v['promotion_price'])?intval($v['promotion_price']):intval($v['goods_price']);?></strong>
				</span>
				<span class="te2">立即抢购</span>
			</div>
		</a>
		<?php }?>
	</div>
</div>
<?php }?>
<?php if($output['goods_list']['goods_list_5']){?>
</div>
<div class="louceng">
<div id="tier5" class="twelve11"></div>
<div class="twelve12">
	<div class="ui-wrap four">
		<?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
			<i class="icon-twelve"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/images/icon3.png"/></i>
			<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
			<h2><?php echo $v['goods_name'];?></h2>
			<div class="ui-txt">
				<span class="te1">
					<p>双12限时特惠</p>
					<strong><i>¥</i><?php echo intval($v['promotion_price'])?intval($v['promotion_price']):intval($v['goods_price']);?></strong>
				</span>
				<span class="te2">立即抢购</span>
			</div>
		</a>
		<?php }?>
		
	</div>
</div>
<?php }?>
<div class="twelve13"></div>
</div>
<div class="louceng">
<div id="tier6" class="twelve14"></div>
<div class="twelve15">
	<div class="ui-wrap one">
		<a href="http://www.96567.com/goods-16606.html" target="_blank"></a>
	</div>
</div>
<div class="twelve16">
	<div class="ui-wrap one">
		<a href="http://www.96567.com/goods-44353.html" target="_blank"></a>
	</div>
</div>
<div class="twelve17">
	<div class="ui-wrap one">
		<a href="http://www.96567.com/goods-31104.html" target="_blank"></a>
	</div>
</div>
<div class="twelve18">
	<div class="ui-wrap one">
		<a href="http://www.96567.com/goods-33595.html" target="_blank"></a>
	</div>
</div>
<div class="twelve19">
	<div class="ui-wrap one">
		<a href="http://www.96567.com/goods-38810.html" target="_blank"></a>
	</div>
</div>
<div class="twelve20">
	<div class="ui-wrap three1">
		<a href="http://www.96567.com/goods-41142.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-33594.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-36708.html" target="_blank"></a>
	</div>
</div>
<!-- <div class="twelve21">
	<div class="ui-wrap three1">
		<a href="http://www.96567.com/goods-40960.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-40968.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-41049.html" target="_blank"></a>
	</div>
</div> -->
<div class="twelve22">
	<div class="ui-wrap three2">
		<a href="http://www.96567.com/goods-26537.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-22370.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-32822.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-38811.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-33668.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-32994.html" target="_blank"></a>
	</div>
</div>
<div class="twelve23">
	<div class="ui-wrap three1">
		<a href="http://www.96567.com/goods-36754.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-36796.html" target="_blank"></a>
		<a href="http://www.96567.com/goods-36804.html" target="_blank"></a>
	</div>
</div>
<div class="twelve24">
	<div class="ui-wrap one">
		<a href="#"></a>
	</div>
</div>
</div>
</div>

<div id="LoutiNav" class="hilarity-nav">
	<a class="" href="javascript:;">送大金条</a>
	<a href="javascript:;" class="active">送核雕手串</a>
	<a href="javascript:;">送G20硬币册</a>
	<a href="javascript:;">送塑料钞大全</a>
	<a href="javascript:;">送生肖银砖</a>
	<a href="javascript:;">买一得三</a>
	<a class="last" href="#"></a>
</div>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161205/js/main.js"></script>