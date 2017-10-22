<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160802/css/new_file.css"/>




<div class="photo1"></div>
<div class="photo2"></div>
<div class="photo3"></div>
<div class="photo4"></div>
<div class="photo5"></div>


<?php if(!empty($output['goods_list'])){?>
<div class="photo6">
	<div class="demo-wrap">
		<div class="shop-box">
			<ul>
				<?php foreach ($output['goods_list'] as $k => $v){?>
				<li>
					<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
					<div class="img">
						<img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>"/>
					</div>
					<h2><?php echo $v['goods_name'];?></h2>
					<div class="demo-text"><i>¥</i><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?><em>.00</em></div>
					</a>
				</li>
				<?php }?>
						
			</ul>
		</div>
	</div>
</div>
<?php }?>


<div class="photo7"></div>
<div class="photo8"></div>

<div class="photo9">
	<a href="http://www.96567.com/goods-22652.html" target="_blank"></a>
</div>
<div class="photo10">
	<a href="http://www.96567.com/goods-20905.html" target="_blank"></a>
</div>
<div class="photo11">
	<a href="http://www.96567.com/goods-22424.html" target="_blank"></a>
</div>
<div class="photo12">
	<a href="http://www.96567.com/goods-23563.html" target="_blank"></a>
</div>
<div class="photo13">
	<a href="http://www.96567.com/goods-23678.html" target="_blank"></a>
</div>
<div class="photo14">
	<a href="http://www.96567.com/goods-23856.html" target="_blank"></a>
</div>
<div class="photo15"></div>




<?php if(!empty($output['store_goods_list'])){?>

<?php foreach ($output['store_goods_list'] as $k => $v){?>

<div class="photo16">
	<div class="demo-wrap">
		<div class="shop-box">
			<ul>
				<li>
					<a href="<?php echo urlShop('show_store','index',array('store_id'=>$v['store_info']['store_id']));?>" target="_blank">
						<div class="demo-home-img">
							<img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160802/images/<?php echo $v['store_info']['store_id'];?>.jpg" alt="<?php echo $v['store_info']['store_name'];?>"/>
						</div>
						<!-- <div class="demo-home-db">
							<h3><?php echo $v['store_info']['store_name'];?></h3>
							<h4>全场88折</h4>
							<span>进店抢购></span>
						</div> -->
					</a>
				</li>

<?php if(!empty($v['goods_info'])){?>

<?php foreach ($v['goods_info'] as $goods){?>

				<li>
					<a href="<?php echo urlShop('goods','index',array('goods_id'=>$goods['goods_id']));?>" target="_blank">
						<div class="img">
							<img src="<?php echo cthumb($goods['goods_image'],360);?>" alt="<?php echo $goods['goods_name'];?>"/>
						</div>
						<h2><?php echo $goods['goods_name'];?></h2>
						<div class="demo-text"><i>¥</i><?php echo intval($goods['tuangou_money'])?intval($goods['tuangou_money']):(intval($goods['xianshi_money'])?intval($goods['xianshi_money']):intval($goods['goods_price']));?><em>.00</em></div>
						<div class="demo-xsms"></div>
					</a>
				</li>	

<?php }?>

<?php }?>
						
			</ul>
		</div>
	</div>
</div>		
		
<?php }?>

<?php }?>

<div class="photo16">
	<div class="demo-wrap">
	    <a href="http://www.96567.com/miaosha/#qx" target="_blank">
	    <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160802/images/qixims.jpg"/></a>
	</div>
</div>

<div class="photo20">
	<a href="#"></a>
</div>