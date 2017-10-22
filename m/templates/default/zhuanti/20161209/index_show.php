<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/css/main.css"/>

<div class="ui-wrap">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_01.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_02.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42589"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_03.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_04.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=31709"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=28377"></a>
	</div>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=20486"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_05.jpg" alt="" /></a>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_06.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=17084"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_07.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_08.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=12951"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=11720"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_09.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=13012"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_10.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_11.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=10081"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=9197"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_12.jpg" alt="" />
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_13.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=10083"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=30053"></a>
	</div>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42591"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_14.jpg" alt="" /></a>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_15.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42601"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_16.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_17.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42595"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42616"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_18.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=4587"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_19.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_20.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=8617"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=7998"></a>
	</div>
	<a href="#"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_21.jpg" alt="" /></a>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161209/images/painting_22.jpg" alt="" />
</div>

<?php 

$array['P']['title'] = '茶里乾坤，禅中意境。品茶之余，聊人生';
$array['P']['imgUrl'] = '';
$array['P']['link'] = urlWap('zhuanti','ad_20161209',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['link'] = urlWap('zhuanti','ad_20161209',array('ua'=>$_GET['ua']?$_GET['ua']:$output['this_laiyuan'])); //分享连接
$array['Y']['title'] = '茶里乾坤，禅中意境。品茶之余，聊人生';
$array['Y']['desc'] = '禅茶一味品人生百态，慢聊生活谈人世轮回';
$array['Y']['imgUrl'] = '';
echo weixinShare($array);

?>