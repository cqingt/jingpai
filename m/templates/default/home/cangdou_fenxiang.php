<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/has.css" />
<section>
 <div class="invite">
	<img src="<?php echo cthumb($output['goods']['goods_image'],360)?>" alt="<?php echo $output['goods']['goods_name']; ?>">
 </div>
 <div class="invite-content">
	<h4><?php echo $output['goods']['goods_name']; ?></h4>
	<h2>我邀请您低价超值购买</h2>
	<a class="btn-rom btnone" href="index.php?act=goods&goods_id=<?php echo intval($_GET['goods_id']);?>">立即参与</a>
	<h1><i class="fa fa-caret-right"></i>藏豆奖励规则</h1>
	<p>1、推荐者推荐一人购买后，可以本店售价的最低折扣价购买该产品；</p>
	<p>2、被推荐着购买时，也同样以本店售价的最低折扣价购买该产品。</p>
<p>&nbsp;&nbsp;</p>
 </div>
</section>