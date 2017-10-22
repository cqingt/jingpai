<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/css/main.css">



<div class="photo_01" id="pHeader"></div>
<div class="photo_02"></div>
<div class="photo_03"></div>
<div class="photo_04" id="f1">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_01.jpg"/>
	</div>
</div>
<div class="photo_05">
	<div class="m-wrap demo-man">
		<ul class="ui-shopssss">
			<li>
				<i class="icon-ico ico11"></i>
				<a href="http://www.96567.com/goods-36521.html" target="_blank">
				    <div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/images/pic_01.jpg"/></div>
				    <h2>五大名窑品茗杯套装</h2>
				    <div class="boxes">
				    	<span>
				    		<p>惊爆价</p>
				    		<strong>49.9</strong>
				    	</span>
				    	<i class="icon-ico ico4"></i>
				    </div>
				</a>
			</li>
			<li>
				<i class="icon-ico ico12"></i>
				<a href="http://www.96567.com/goods-17163.html" target="_blank">
				    <div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/images/pic_02.jpg"/></div>
				    <h2>冰裂紫砂茶具套装</h2>
				    <div class="boxes">
				    	<span>
				    		<p>惊爆价</p>
				    		<strong>19.9</strong>
				    	</span>
				    	<i class="icon-ico ico4"></i>
				    </div>
				</a>
			</li>
			<li>
				<a href="http://www.96567.com/goods-34192.html" target="_blank">
				    <div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/images/pic_04.jpg"/></div>
				    <h2>天然玉化砗磲手串</h2>
				    <div class="boxes">
				    	<span>
				    		<p>惊爆价</p>
				    		<strong>19</strong>
				    	</span>
				    	<i class="icon-ico ico4"></i>
				    </div>
				</a>
			</li>
			<li>
				<i class="icon-ico ico13"></i>
				<a href="http://www.96567.com/goods-27276.html" target="_blank">
				    <div class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/images/pic_03.jpg"/></div>
				    <h2>天然黑石手链</h2>
				    <div class="boxes">
				    	<span>
				    		<p>惊爆价</p>
				    		<strong>39</strong>
				    	</span>
				    	<i class="icon-ico ico4"></i>
				    </div>
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="photo_06"></div>
<div class="photo_07" id="f2">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_02.jpg"/>
		<a class="hover-activ"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161101/images/btn-activity.jpg"/></a>
		<div class="activity-box">
			<p>1、购买【全额返现】活动区商品，且订单完成付款或确认收货即可活动商品全额返现；</p>
			<p>2、返现将以优惠券的方式发放至会员账号，请在 <strong>我的商城→我的优惠券→店铺优惠券</strong> 中查看；</p>
			<p>3、优惠券仅可在收藏天下书画馆中使用，直抵现金；</p>
			<p>本活动最终解释权归收藏天下所有。</p>
		</div>
	</div>
</div>

<?php if($output['goods_list']['goods_list_1']){?>
<div class="photo_08">
	<div class="m-wrap">
		<ul class="ui-shopssss">
		<?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
			<li>
				<i class="icon-ico ico10"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>双11狂欢价</p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico4"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>

<div class="photo_09"></div>
<div class="photo_10" id="f3">
	<div class="m-wrap">
		<a href="http://www.96567.com/goods-35289.html#fu" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_03.jpg"/></a>
	</div>
</div>

<?php if($output['goods_list']['goods_list_2']){?>
<div class="photo_11" id="f5">
	<div class="demo-first first1 m-wrap">
		<img class="picture-img" src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_04.jpg"/>
		<div class="ui-emphasis">
			<a href="http://www.96567.com/goods-35361.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544832450459_1280.jpg"/></a>
			<a href="http://www.96567.com/goods-12351.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544844662927_1280.jpg"/></a>
		</div>
		<ul class="ui-shop">
		<?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
			<li>
				<i class="icon-ico ico2"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>双11狂欢价</p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico1"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>


<?php if($output['goods_list']['goods_list_3']){?>
<div class="photo_12">
	<div class="demo-first first2 m-wrap">
		<img class="picture-img" src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_07.jpg"/>
		<div class="ui-emphasis">
			<a href="http://www.96567.com/goods-845.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544533727640_1280.jpg"/></a>
			<a href="http://www.96567.com/goods-35303.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544950490169_1280.jpg"/></a>
		</div>
		<ul class="ui-shop">
		<?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
			<li>
				<i class="icon-ico ico2"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>双11狂欢价</p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico1"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>


<?php if($output['goods_list']['goods_list_4']){?>
<div class="photo_13" id="f6">
	<div class="demo-first first3 m-wrap">
		<img class="picture-img" src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_10.jpg"/>
		<div class="ui-emphasis">
			<a href="http://www.96567.com/goods-27686.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544866238339_1280.jpg"/></a>
			<a href="http://www.96567.com/goods-16435.html" target="_blank"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544625520810_1280.jpg"/></a>
		</div>
		<ul class="ui-shop">
		<?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
			<li>
				<i class="icon-ico ico2"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>双11狂欢价</p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico1"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>

<div class="photo_14"></div>
<div id="f7"></div>
<div class="photo_15" id="f4">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_13.jpg"/>
	</div>
</div>


<?php if($output['goods_list']['goods_list_5']){?>
<div class="photo_16">
	<div class="m-wrap">

		<ul class="ui-shops">
		<?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
			<?php if($k > 1){break;}?>
			<li>
				<i class="icon-ico ico5"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong><em>折后价：¥</em><em><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></em></strong>
				    	</span>
				    	<i class="icon-ico ico3"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>

		<ul class="ui-shopss">
		<?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
			<?php if($k < 2){continue;}?>
			<li>
				<i class="icon-ico ico6"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico8"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>


<div class="photo_17">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_14.jpg"/>
	</div>
</div>

<?php if($output['goods_list']['goods_list_6']){?>
<div class="photo_18">
	<div class="m-wrap">
		<ul class="ui-shops">
		<?php foreach($output['goods_list']['goods_list_6'] as $k => $v){?>
			<?php if($k > 1){break;}?>
			<li>
				<i class="icon-ico ico5"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong><em>折后价：¥</em><em><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></em></strong>
				    	</span>
				    	<i class="icon-ico ico3"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>

		<ul class="ui-shopss">
		<?php foreach($output['goods_list']['goods_list_6'] as $k => $v){?>
			<?php if($k < 2){continue;}?>
			<li>
				<i class="icon-ico ico6"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico8"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>

<div class="photo_19">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_15.jpg"/>
	</div>
</div>

<?php if($output['goods_list']['goods_list_7']){?>
<div class="photo_20">
	<div class="m-wrap">
		<ul class="ui-shops">
		<?php foreach($output['goods_list']['goods_list_7'] as $k => $v){?>
			<?php if($k > 1){break;}?>
			<li>
				<i class="icon-ico ico5"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong><em>折后价：¥</em><em><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></em></strong>
				    	</span>
				    	<i class="icon-ico ico3"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>

		<ul class="ui-shopss">
		<?php foreach($output['goods_list']['goods_list_7'] as $k => $v){?>
			<?php if($k < 2){continue;}?>
			<li>
				<i class="icon-ico ico6"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico8"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>

<div class="photo_21">
	<div class="m-wrap">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101web/picture_16.jpg"/>
	</div>
</div>

<?php if($output['goods_list']['goods_list_8']){?>
<div class="photo_22">
	<div class="m-wrap">
		<ul class="ui-shops">
		<?php foreach($output['goods_list']['goods_list_8'] as $k => $v){?>
			<?php if($k > 1){break;}?>
			<li>
				<i class="icon-ico ico5"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong><em>折后价：¥</em><em><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></em></strong>
				    	</span>
				    	<i class="icon-ico ico3"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>

		<ul class="ui-shopss">
		<?php foreach($output['goods_list']['goods_list_8'] as $k => $v){?>
			<?php if($k < 2){continue;}?>
			<li>
				<i class="icon-ico ico6"></i>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
				    <div class="img"><img src="<?php echo cthumb($v['goods_image'],360);?>" title="<?php echo $v['goods_name'];?>"/></div>
				    <h2><?php echo $v['goods_name'];?></h2>
				    <div class="boxes">
				    	<span>
				    		<p>原价<?php echo $v['goods_price'];?></p>
				    		<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
				    	</span>
				    	<i class="icon-ico ico8"></i>
				    </div>
				</a>
			</li>
		<?php }?>
		</ul>
	</div>
</div>
<?php }?>

<div class="photo_23">
	<div class="m-wrap">
		<a href="#"></a>
	</div>
</div>

<div id="LoutiNav" class="navboth">
	<a href="#f1"></a>
	<a href="#f2"></a>
	<a href="#f3"></a>
	<a href="#f4"></a>
	<a href="#f5"></a>
	<a href="#f6"></a>
	<a href="#f7"></a>
	<a class="last" href="#"></a>
</div>
<script type="text/javascript">
$(function(){
   var oNav = $('#LoutiNav');
       hAct = $('.hover-activ');
       aBox = $('.activity-box');
	//回到顶部
	$(window).scroll(function(){
		 var winH = $(window).height();
		 var iTop = $(window).scrollTop();
		 if(iTop>=$('#pHeader').height()){
		 	oNav.fadeIn();
		 	oTop.fadeIn();
		 }else{
		 	oNav.fadeOut();
		 	oTop.fadeOut();
		 }
	})
	hAct.hover(function(){
		aBox.toggleClass('show');
	})
})
</script>