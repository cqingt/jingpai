<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/css/main.css">

<div class="ui-wrap">
	<div class="ukraine01"></div>
	<div class="ukraine02"></div>
	<div class="ukraine03">
		<div class="ui-nav">
			<ul>
				<li><a href="#louceng1">
					<h2>安德烈-戚培根 </h2>
					<p>中央美院院长、人民画家</p>
				</a></li>
				<li><a href="#louceng2">
					<h2>安德烈-雅朗斯基</h2>
					<p>常务副院长、人民画家</p>
				</a></li>
				<li><a href="#louceng3">
					<h2>瓦西里-古林</h2>
					<p>人民画家</p>
				</a></li>
				<li><a href="#louceng4">
					<h2>阿斯塔普-卡瓦尔丘克 </h2>
					<p>副院长、功勋画家</p>
				</a></li>
				<li><a href="#louceng5">
					<h2>安纳托利-佐尔科</h2>
					<p>系主任、功勋画家</p>
				</a></li>
				<li><a href="#louceng6">
					<h2>奥列斯-瓦西里维齐-索罗维</h2>
					<p>功勋画家</p>
				</a></li>
				<li><a href="#louceng7">
					<h2>亚历山大-赫巴拉乔夫</h2>
					<p>优秀画家、独联体青年美协秘书长</p>
				</a></li>
				<li><a href="#louceng8">
					<h2>叶甫盖尼-毕斯库诺夫</h2>
					<p>乌克兰优秀中青画家</p>
				</a></li>
			</ul>
		</div>
	</div>
	<div class="ukraine04"></div>
	<div class="ukraine05"></div>
	<div class="ukraine06"></div>
	<div class="ukraine07"></div>
	<div id="louceng1" class="ukraine08"></div>
	<div class="ui-box">
		<div class="ukraine09 two">
			<a href="http://www.96567.com/goods-42398.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-42402.html" target="_blank"></a>
		</div>
	</div>
	<div id="louceng2" class="ukraine10"></div>
	<div class="ui-box">
		<div class="ukraine11 three">
			<a href="http://www.96567.com/goods-41750.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-41749.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-41748.html" target="_blank"></a>
		</div>
		<div class="ukraine12 two">
			<a href="http://www.96567.com/goods-41747.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-41737.html" target="_blank"></a>
		</div>
	</div>
	<div id="louceng3" class="ukraine13"></div>
	<div class="ui-box">
		<div class="ukraine14 three">
			<a href="http://www.96567.com/goods-42423.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-42427.html" target="_blank"></a>
			<a href="http://www.96567.com/goods-42426.html" target="_blank"></a>
		</div>
	</div>
	<div id="louceng4" class="ukraine15"></div>





<?php if($output['goods_list']['goods_list_1']){?>

	<div class="ui-box shop-four">
		<ul>
			<?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
			<li>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<?php if(in_array($v['goods_id'],array(42434,42437,42320))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<p></p>
						<h4>商城价：¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></h4>
						<h5>国际售价：¥<?php echo $v['goods_marketprice'];?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
			<?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchshuhua&gc_parent_id=&cate_id=&a_id=&order_key=&is_shop=&keyword=%E5%8D%A1%E7%93%A6%E5%B0%94%E4%B8%98%E5%85%8B
" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<div id="louceng5" class="ukraine16"></div>
<?php }?>


<?php if($output['goods_list']['goods_list_2']){?>
	<div class="ui-box shop-four">
		<ul>
			<?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
			<li>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<?php if(in_array($v['goods_id'],array(41808,41813))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<p></p>
						<h4>商城价：¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></h4>
						<h5>国际售价：¥<?php echo $v['goods_marketprice'];?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
			<?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchshuhua&gc_parent_id=&cate_id=&a_id=&order_key=&is_shop=&keyword=%E4%BD%90%E5%B0%94%E7%A7%91
" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<div id="louceng6" class="ukraine17"></div>
<?php }?>

<?php if($output['goods_list']['goods_list_3']){?>
	<div class="ui-box shop-three">
		<ul>
			<?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
			<li>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<p></p>
						<h4>商城价：¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></h4>
						<h5>国际售价：¥<?php echo $v['goods_marketprice'];?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
			<?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchshuhua&gc_parent_id=&cate_id=&a_id=&order_key=&is_shop=&keyword=%E7%B4%A2%E7%BD%97%E7%BB%B4
" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<div id="louceng7" class="ukraine18"></div>
<?php }?>


<?php if($output['goods_list']['goods_list_4']){?>
	<div class="ui-box shop-four">
		<ul>
			<?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
			<li>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<?php if(in_array($v['goods_id'],array(42175))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<p></p>
						<h4>商城价：¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></h4>
						<h5>国际售价：¥<?php echo $v['goods_marketprice'];?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
			<?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchshuhua&gc_parent_id=&cate_id=&a_id=&order_key=&is_shop=&keyword=%E4%BA%9A%E5%8E%86%E5%B1%B1%E5%A4%A7
" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<div id="louceng8" class="ukraine19"></div>
<?php }?>


<?php if($output['goods_list']['goods_list_5']){?>
	<div class="ui-box shop-four">
		<ul>
			<?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
			<li>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<?php if(in_array($v['goods_id'],array(41978,42003,42001,41987))){?>
					<i class="icon-yishou"></i>
					<?php }?>
					<div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
					<div class="con">
						<p><?php echo $v['goods_name'];?></p>
						<p></p>
						<h4>商城价：¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></h4>
						<h5>国际售价：¥<?php echo $v['goods_marketprice'];?></h5>
					</div>
					<span>点击购买<i>》</i></span>
				</a>
			</li>
			<?php }?>
		</ul>
		<div class="ukraine-look">
			<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchshuhua&gc_parent_id=&cate_id=&a_id=&order_key=&is_shop=&keyword=%E6%AF%95%E6%96%AF%E5%BA%93%E8%AF%BA%E5%A4%AB
" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161208/images/look.jpg"/></a>
		</div>
	</div>
	<div class="ui-box">
		<div class="ukraine20">
			<a href="#"></a>
		</div>
	</div>
<?php }?>

</div>