<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161017/css/main.css"/>
		<div class="img-aer1"></div>
		<div class="img-aer2"></div>
		<div class="img-aer3"></div>
		<div class="img-aer4"></div>
		<div class="img-aer5"></div>
		<div class="img-aer6"></div>
		<div class="img-aer7"></div>
	    <div class="img-aer8"></div>
	    <div class="img-aer9">
	    	<a class="aer-shop" href="http://www.96567.com/goods-15161.html" target="_blank"></a>
	    </div>
	    <div class="img-aer10"></div>
	    <div class="img-aer11">
	    	<a class="aer-shop" href="http://www.96567.com/goods-16963.html" target="_blank"></a>
	    </div>
	    <div class="img-aer12"></div>
	    <div class="img-aer13"></div>
	    
	    <div class="img-aer14">
	    	<div class="m-wrap">
	    		<ul class="aer-list">



<?php if(!empty($output['goods_list'])){?>
	<?php foreach ($output['goods_list'] as $k => $v){?>
	<li>
		<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
			<div class="img-box">
				<img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>"/>
			</div>
			<div class="txt-box">
				<p><?php echo $v['goods_name'];?></p>
				<span>
					<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?><em>.00</em></strong>
					<i></i>
				</span>
			</div>
		</a>
	</li>
	<?php }?>
<?php }?>



	    		</ul>
	    	</div>
	    </div>
	    <div class="img-aer15">
 
	    		<a class="aertop" href="#"></a>
 
	    </div>
	    <div class="img-aer16"></div>