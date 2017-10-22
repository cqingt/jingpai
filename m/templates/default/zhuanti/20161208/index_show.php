<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/css/main.css"/>


<div class="ui-wrap">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_01.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_02.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_03.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_04.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_05.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_06.jpg" alt="" />
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_07.jpg" alt="" />
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_08.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42398.html"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42402.html"></a>
	</div>

	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_09.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41747.html"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_10.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_11.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41737.html"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41748.html"></a>
	</div>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_12.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41749.html"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=41750.html"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_13.jpg" alt="" />
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42423.html"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_14.jpg" alt="" /></a>
	<div class="ui-demo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_15.jpg" alt="" />
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42427.html"></a>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=42426.html"></a>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_16.jpg" alt="" />



<?php if($output['goods_list']['goods_list_1']){?>

	<div class="ui-box shop-four">
		<ul>
        <?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
					<?php if(in_array($v['goods_id'],array(42434,42437,42320))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<!-- <p>创作年代：2012年</p>
						<p>材质：布面油画</p> -->
						<h4>商城价：<?php $money = intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));echo ncPriceFormatForList($money);?></h4>
						<h5>国际售价：<?php echo ncPriceFormatForList($v['goods_marketprice']);?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
        <?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://m.96567.com/index.php?act=goods&op=goods_list&type=ShuHua&keyword=%E5%8D%A1%E7%93%A6%E5%B0%94%E4%B8%98%E5%85%8B"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_17.jpg" alt="" />

<?php }?>



<?php if($output['goods_list']['goods_list_2']){?>

	<div class="ui-box shop-four">
		<ul>
        <?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
					<?php if(in_array($v['goods_id'],array(41808,41813))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<!-- <p>创作年代：2012年</p>
						<p>材质：布面油画</p> -->
						<h4>商城价：<?php $money = intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));echo ncPriceFormatForList($money);?></h4>
						<h5>国际售价：<?php echo ncPriceFormatForList($v['goods_marketprice']);?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
        <?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://m.96567.com/index.php?act=goods&op=goods_list&type=ShuHua&keyword=%E4%BD%90%E5%B0%94%E7%A7%91"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_18.jpg" alt="" />

<?php }?>




<?php if($output['goods_list']['goods_list_3']){?>

	<div class="ui-box shop-four">
		<ul>
        <?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
					<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<!-- <p>创作年代：2012年</p>
						<p>材质：布面油画</p> -->
						<h4>商城价：<?php $money = intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));echo ncPriceFormatForList($money);?></h4>
						<h5>国际售价：<?php echo ncPriceFormatForList($v['goods_marketprice']);?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
        <?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://m.96567.com/index.php?act=goods&op=goods_list&type=ShuHua&keyword=%E7%B4%A2%E7%BD%97%E7%BB%B4"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_19.jpg" alt="" />
<?php }?>



<?php if($output['goods_list']['goods_list_4']){?>

	<div class="ui-box shop-four">
		<ul>
        <?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
					<?php if(in_array($v['goods_id'],array(42175))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<!-- <p>创作年代：2012年</p>
						<p>材质：布面油画</p> -->
						<h4>商城价：<?php $money = intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));echo ncPriceFormatForList($money);?></h4>
						<h5>国际售价：<?php echo ncPriceFormatForList($v['goods_marketprice']);?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
        <?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://m.96567.com/index.php?act=goods&op=goods_list&type=ShuHua&keyword=%E4%BA%9A%E5%8E%86%E5%B1%B1%E5%A4%A7"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_20.jpg" alt="" />
<?php }?>


<?php if($output['goods_list']['goods_list_5']){?>

	<div class="ui-box shop-four">
		<ul>
        <?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
					<?php if(in_array($v['goods_id'],array(41978,42003,42001,41987))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><i style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<!-- <p>创作年代：2012年</p>
						<p>材质：布面油画</p> -->
						<h4>商城价：<?php $money = intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));echo ncPriceFormatForList($money);?></h4>
						<h5>国际售价：<?php echo ncPriceFormatForList($v['goods_marketprice']);?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
        <?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://m.96567.com/index.php?act=goods&op=goods_list&type=ShuHua&keyword=%E6%AF%95%E6%96%AF%E5%BA%93%E8%AF%BA%E5%A4%AB"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<a href="#"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161208/images/Ukraine_last.jpg"/></a>

	<?php }?>

</div>


<?php

$array['P']['title'] = "乌克兰国际精品油画财富盛典震撼开启！品世界顶尖油画，藏无限财富臻宝";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161208/images/1208.jpg";
$array['Y']['title'] = "乌克兰国际精品油画财富盛典震撼开启！品世界顶尖油画，藏无限财富臻宝";
$array['Y']['desc'] = "财富契机，远低国际市场价入手高水准大师名画";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20161208/images/1208.jpg";

echo weixinShare($array);

?>