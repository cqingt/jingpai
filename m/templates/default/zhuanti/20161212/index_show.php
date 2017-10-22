<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/css/main.css"/>

<div class="ui-wrap">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_01.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_02.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_03.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34089"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_04.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_05.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34086"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34067"></a>
	</div>

	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_06.jpg" alt="" />
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_07.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34080"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34082"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_08.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34071"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34057"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_09.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34073"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34076"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_10.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34047"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34078"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_11.jpg" alt="" />
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_12.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34084"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34021"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_13.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34062"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34030"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_14.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=37479"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34074"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_15.jpg" alt="" />
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_16.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34050"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34060"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_17.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34069"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34026"></a>
	</div>
	<a href="http://m.96567.com/index.php?act=member_store&op=store_info&store_id=720"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161212/images/treasure_18.jpg" alt="" /></a>
</div>

<?php 

$array['P']['title'] = '收藏天下新疆和田玉推荐，最美的相玉！增福添寿，平安招财！低至6折！全场包邮！';
$array['P']['imgUrl'] = '';
$array['P']['link'] = urlWap('zhuanti','ad_20161212',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['link'] = urlWap('zhuanti','ad_20161212',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['title'] = '收藏天下新疆和田玉推荐，最美的相玉！增福添寿，平安招财！低至6折！全场包邮！';
$array['Y']['desc'] = '收藏天下新疆和田玉推荐，最美的相玉！增福添寿，平安招财！低至6折！全场包邮！';
$array['Y']['imgUrl'] = '';
echo weixinShare($array);

?>