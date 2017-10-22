

    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/css/demo.css" />
	<section class="photo">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_08.jpg"/>
		<a href="http://m.96567.com/index.php?act=cangdou"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_09.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_10.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_11.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_12.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_13.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_14.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_15.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_16.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_17.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_18.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_19.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_20.jpg"/>
		<a href="http://m.96567.com/index.php?act=cangdou"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_21.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_22.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_23.jpg"/>
		
		<div class="shoplist">
			<ul class="cd-shop">
				<?php foreach($output['result_list'] as $k=>$v){?>
					<li>
						<a class="img" href="http://m.96567.com/index.php?act=cangdou&op=cangdou_exchange" ><img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>"/></a>
						<a class="word" ><?php echo $v['goods_name'];?></a>
					</li>
				<?php } ?>
			

					
			</ul>
		</div>
		
		<a href="http://m.96567.com/index.php?act=cangdou&op=cangdou_exchange"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_25.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_26.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_27.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_28.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_29.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_30.jpg"/>
		<a href="http://m.96567.com/index.php?act=cangdou&op=cangdou_tuijian"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_31.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_32.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160714/images/photo_33.jpg"/>
	</section>
