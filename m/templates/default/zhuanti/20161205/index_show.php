
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161205/css/main.css"/>
<div class="ui-wrap">
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_01.jpg" alt="" />
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_02.jpg" alt="" />

	<?php if($output['goods_list']['goods_list_1']){?>
	<img id="lc1" src="http://img.96567.com/images/shuangshier201605app/twelve_03.jpg" alt="" />
	<div class="circulation">
		<div class="shoplist">
		<?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<i class="icon-twelve1"></i>
				<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],240);?>);"></i></div>
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
	<img id="lc2" src="http://img.96567.com/images/shuangshier201605app/shoplist1.jpg"/>
	<div class="circulation">
		<div class="shoplist">
			<?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<i class="icon-twelve2"></i>
				<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],240);?>);"></i></div>
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
	<img id="lc3" src="http://img.96567.com/images/shuangshier201605app/shoplist2.jpg"/>
	<div class="circulation">
		<div class="shoplist">
			<?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<i class="icon-twelve3"></i>
				<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],240);?>);"></i></div>
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
	<img id="lc4" src="http://img.96567.com/images/shuangshier201605app/shoplist3.jpg"/>
	<div class="circulation">
		<div class="shoplist">

		<?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<i class="icon-twelve3"></i>
				<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],240);?>);"></i></div>
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
	<img id="lc5" src="http://img.96567.com/images/shuangshier201605app/shoplist4.jpg"/>
	<div class="circulation">
		<div class="shoplist">
			<?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<i class="icon-twelve3"></i>
				<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],240);?>);"></i></div>
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
	<img id="lc6" src="http://img.96567.com/images/shuangshier201605app/twelve_28.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16606"><img src="http://img.96567.com/images/shuangshier201605app/twelve_29.jpg" alt="" /></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=44353"><img src="http://img.96567.com/images/shuangshier201605app/twelve_30.jpg" alt="" /></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=31104"><img src="http://img.96567.com/images/shuangshier201605app/twelve_31.jpg" alt="" /></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=33595"><img src="http://img.96567.com/images/shuangshier201605app/twelve_32.jpg" alt="" /></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=38225"><img src="http://img.96567.com/images/shuangshier201605app/twelve_32-1.jpg" alt="" /></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=38810"><img src="http://img.96567.com/images/shuangshier201605app/twelve_33.jpg" alt="" /></a>
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_34.jpg" alt="" />
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_35.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41142"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=33594"></a>
	</div>
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_36.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=36708"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=36754"></a>
	</div>
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_37.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=36796"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=36804"></a>
	</div>
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_38.jpg" alt="" />
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_39.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=44700"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=40968"></a>
	</div>
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_40.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41049"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41005"></a>
	</div>
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_41.jpg" alt="" />
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_42.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=26537"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=22370"></a>
	</div>
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_43.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=32822"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=38811"></a>
	</div>
	<div class="ui-demo">
	    <img src="http://img.96567.com/images/shuangshier201605app/twelve_44.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=33668"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=32994"></a>
	</div>
	<img src="http://img.96567.com/images/shuangshier201605app/twelve_45.jpg" alt="" />
	
	<div class="navigationFixed">
		<img src="http://img.96567.com/images/shuangshier201605app/twelve_46.jpg" alt="" />
		<a href="#lc1"></a>
		<a href="#lc2"></a>
		<a href="#lc3"></a>
		<a href="#lc4"></a>
		<a href="#lc5"></a>
		<a href="#lc6"></a>
	</div>
</div>
<?php
$array['P']['title'] = "收藏天下双12，全场买一送一！上不封顶！正品收藏，入手即赚";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161205/images/1212.jpg";
$array['Y']['title'] = "收藏天下双12，全场买一送一！上不封顶！正品收藏，入手即赚";
$array['Y']['desc'] = "仅此一次，限时抢购，买多少送多少";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161205/images/1212.jpg";
echo weixinShare($array);
?>