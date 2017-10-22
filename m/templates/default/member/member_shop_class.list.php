<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">


<div class="content">
	<div class="categroy-cnt" id="categroy-cnt">

		<ul class="categroy-list">
	
	<?php if($output['shop_class']){?>
		<?php foreach($output['shop_class'] as $k => $v){?>
		<li class="category-item">
			<a href="<?php echo urlWap('member_store','index',array('sc_id'=>$v['sc_id']));?>" class="category-item-a">
				<div class="ci-fcategory-name"><?php echo $v['sc_name'];?></div>
				<div class="ci-fcategory-text"></div>
				<span class="grayrightarrow"></span>
			</a>
		</li>
		<?php }?>
	<?php }?>

		
		<li class="category-item">
			<a class="category-item-a" href="<?php echo urlWap('member_store','index',array('sc_id'=>''));?>">
				<div class="ci-fcategory-name" style="color:red">显示所有店铺</div>
				<div class="ci-fcategory-text"></div>
				<span class="grayrightarrow"></span>
			</a>
		</li>
		
	</ul>

	</div>
</div>