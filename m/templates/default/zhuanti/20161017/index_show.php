<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/css/new_file.css"/>


  	<div class="silver-bar">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_04.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_06.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_07.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_08.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_09.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_10.jpg"/>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=15161"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_11.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_12.jpg"/>
		<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16963"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_13.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_14.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_15.jpg"/>
		<div class="stamp-shop2">
    		<ul class="stamp-list">


<?php if(!empty($output['goods_list'])){?>
	<?php foreach ($output['goods_list'] as $k => $v){?>
    			<li>
    				<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
	    				<div class="img-box">
	    					
                            <img src="<?php echo cthumb($v['goods_image'],360);?>" />
	    				</div>
	    				<div class="txt-box">
	    					<p><?php echo $v['goods_name'];?></p>
	    					<span>
	    						<strong>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?><em>.00</em></strong>
	    						<i>立即购买</i>
	    					</span>
	    				</div>
    				</a>
    			</li>
	<?php }?>
<?php }?>


    		</ul>
		</div>
		<a href="#"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_17.jpg"/></a>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161017/images/yp_18.jpg"/>
		
	</div>




<?php

$array['P']['title'] = "收藏天下热烈恭贺“神十一”发射成功！";
$array['P']['imgUrl'] = "";
$array['Y']['title'] = "收藏天下热烈恭贺“神十一”发射成功！";
$array['Y']['desc'] = "收藏天下热烈恭贺“神十一”发射成功！!";
$array['Y']['imgUrl'] = "";

echo weixinShare($array);

?>