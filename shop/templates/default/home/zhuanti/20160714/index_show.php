
	<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160714/css/new_file.css"/>
		<div class="photo1"></div>
		<div class="photo2"></div>
		<div class="photo3"></div>
		<div class="photo4"></div>
		<div class="photo5"></div>
		<div class="photo6">
			<div class="bar-wrap">
				<a class="btn" href="http://www.96567.com/index.php?act=cangdou" target="_blank">查看我的专属链接>></a>
			</div>
		</div>
		<div class="photo7"></div>
		<div class="photo8"></div>
		<div class="photo9"></div>
		<div class="photo10"></div>
		<div class="photo11"></div>
		<div class="photo12"></div>
		<div class="photo13"></div>
		<div class="photo14"></div>
		<div class="photo15"></div>
		<div class="photo16">
			<div class="bar-wrap">
				<a class="btn mt7" href="http://www.96567.com/index.php?act=cangdou" target="_blank">获取我的专属链接>></a>
			</div>			
		</div>
		<div class="photo17"></div>
		<div class="photo18"></div>
		<div class="photo19">
			<div class="bar-wrap">
				<ul class="cd-shop">
				<?php foreach($output['result_list'] as $k=>$v){?>
					<li>
						<a class="img" href="http://www.96567.com/index.php?act=cangdou&op=cangdou_exchange" target="_blank"><img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>"/></a>
						<a class="word" ><?php echo $v['goods_name'];?></a>
					</li>
				<?php } ?>
							
				</ul>
				<a class="btn mt13" href="http://www.96567.com/index.php?act=cangdou&op=cangdou_exchange" target="_blank">查看更多免费好礼>></a>
			</div>
		</div>
		<div class="photo20"></div>
		<div class="photo21"></div>
		<div class="photo22"></div>
	    <div class="photo23">
			<div class="bar-wrap">
				<a class="btn mt7" href="http://www.96567.com/index.php?act=cangdou&op=cangdou_tuijian" target="_blank">获取我的优惠链接>></a>
			</div>		    	
	    </div>
	    <div class="photo24"></div>
	    
