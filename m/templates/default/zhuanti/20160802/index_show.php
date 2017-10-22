<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/css/new_file.css"/>


<div class="banner">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo1.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo2.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo3.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo4.jpg"/>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo5.jpg"/>
</div>
		
<?php if(!empty($output['goods_list'])){?>
<div class="demo-wrap">
	<div class="shop-box">
		<ul>

			<?php foreach ($output['goods_list'] as $k => $v){?>

			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" >
					<div class="img">
						<img src="<?php echo cthumb($v['goods_image'],360);?>"/>
					</div>
					<h2><?php echo $v['goods_name'];?></h2>
					<div class="demo-text"><i>¥</i><?php echo intval($v['goods_promotion_price'])?intval($v['goods_promotion_price']):intval($v['goods_price']);?><em>.00</em></div>
				</a>
			</li>

			<?php }?>
	
		</ul>
	</div>
</div>
<?php }?>




<div class="photo7">
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo6.jpg"/>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=22652" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo7.jpg"/></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=20905" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo8.jpg"/></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=22422" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo9.jpg"/></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=23563" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo10.jpg"/></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=23678" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo11.jpg"/></a>
	<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=23856" target=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo12.jpg"/></a>
	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/photo13.jpg"/>
</div>

		
	 

<?php if(!empty($output['store_goods_list'])){?>

<?php foreach ($output['store_goods_list'] as $k => $v){?>	
<div class="demo-wrap">
	<div class="shop-box boxes">
		<ul>



			<li>
				<a href="<?php echo urlWap('show_store','index',array('store_id'=>$v['store_info']['store_id']));?>">
					<div class="demo-home-img">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/<?php echo $v['store_info']['store_id'];?>.jpg"/>
					</div>
				</a>
			</li>


<?php if(!empty($v['goods_info'])){?>

<?php foreach ($v['goods_info'] as $goods){?>
			<li>
				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$goods['goods_id']));?>" >
					<div class="img">
						<img src="<?php echo cthumb($goods['goods_image'],360);?>"/>
					</div>
					<h2><?php echo $goods['goods_name'];?></h2>
					<div class="demo-text"><i>¥</i><?php echo intval($goods['goods_promotion_price'])?intval($goods['goods_promotion_price']):intval($goods['goods_price']);?><em>.00</em></div>
					<div class="demo-xsms"></div>
				</a>
			</li>		
<?php }?>

<?php }?>

		</ul>
	</div>
</div>	
	

<?php }?>

<?php }?>



		
	
<div class="photo">
	<a href="#"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160802/images/demo-top.jpg"/></a>
</div>