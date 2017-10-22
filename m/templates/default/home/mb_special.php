<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/flickerplate.css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_menu.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/index.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/photo.css">

<section>
	<?php foreach($output['list'] as $k=>$v){ ?>
		<?php if($v['adv_list']){ ?>
			<div class="photo-banner">
				<?php foreach($v['adv_list']['item'] as $adk=>$adv){ ?>
				<a href="<?php echo $adv['data'];?>"><img src="<?php echo $adv['image'];?>"/></a>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if($v['home1']){ ?>
			<div class="photo-title">
				<span><i><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/icon-bolang.jpg"/></i></span>
				<span><h2><?php echo $v['home1']['title'];?></h2></span>
				<span><i><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/icon-bolang.jpg"/></i></span>
			</div>
			<div class="photo-banner">
				<a href="<?php echo $v['home1']['data'];?>"><img src="<?php echo $v['home1']['image'];?>"/></a>
			</div>	
		<?php } ?>
		
		<?php if($v['home2']){ ?>
			<div class="photo-title">
				<span class="sl"><h2><?php echo $v['home2']['title'];?></h2></span>
				<span class="straight-line"></span>
			</div>
			
			<div class="photo-shop-three1">
				<div class="l">
					<a href="<?php echo $v['home2']['square_data'];?>"><img src="<?php echo $v['home2']['square_image'];?>"/></a>
				</div>
				<div class="r">
					<a href="<?php echo $v['home2']['rectangle1_data'];?>"><img src="<?php echo $v['home2']['rectangle1_image'];?>"/></a>
					<a href="<?php echo $v['home2']['rectangle2_data'];?>"><img src="<?php echo $v['home2']['rectangle2_image'];?>"/></a>
				</div>
			</div>
		<?php } ?>
		
		<?php if($v['home3']){ ?>
			<div class="photo-title">
				<span class="sl"><h2><?php echo $v['home3']['title'];?></h2></span>
				<span class="straight-line"></span>
			</div>
			
			<div class="photo-shop-two">
				<?php foreach($v['home3']['item'] as $k3=>$v3){ ?>
					<a href="<?php echo $v3['data'];?>"><img src="<?php echo $v3['image'];?>"/></a>
				<?php } ?>
			</div>	
		<?php } ?>
		<?php if($v['home4']){ ?>
			<div class="photo-title">
				<span class="sl"><h2><?php echo $v['home4']['title'];?></h2></span>
				<span class="straight-line"></span>
			</div>
			
			<div class="photo-shop-three2">
				<div class="l">
					<a href="<?php echo $v['home4']['rectangle1_data'];?>"><img src="<?php echo $v['home4']['rectangle1_image'];?>"/></a>
					<a href="<?php echo $v['home4']['rectangle2_data'];?>"><img src="<?php echo $v['home4']['rectangle2_image'];?>"/></a>
				</div>    	
				<div class="r">
					<a href="<?php echo $v['home4']['square_data'];?>"><img src="<?php echo $v['home4']['square_image'];?>"/></a>
				</div>
			</div>    
		<?php } ?>

		<?php if($v['goods']){ ?>
			 <div class="index_block goods photo-list">
				 <h2 class="title"><?php echo $v['goods']['title'];?></h2>
				 <div class="content">

					<?php foreach($v['goods']['item'] as $gk=>$gv){ ?>
					  <div class="goods-item">
						   <a href="index.php?act=goods&op=index&goods_id=<?php echo $gv['goods_id'];?>">
							  <div class="goods-item-pic"><img src="<?php echo $gv['goods_image'];?>" alt="<?php echo $gv['goods_name'];?>"></div>
							  <div class="goods-item-name"><?php echo $gv['goods_name'];?></div>
							  <div class="goods-item-price"><?php if($gv['promotion_price'] > 0){ echo '￥'.$gv['promotion_price'];?><?php }else{ ?><?php echo ($gv['goods_price'] < 1)?"咨询客服":'￥'.intval($gv['goods_price']); ?><?php }?> </div>
						   </a>
					  </div>
					<?php } ?>
					  
					  
				 </div>
			 </div>
		<?php } ?>

	<?php } ?>
 
</section>
