<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php if(!empty($output['article_list'])){?>
<?php foreach ($output['article_list'] as $k=>$v){?>
<!---
<?php if(!empty($v['article_image'])) { ?>
		 <li>
		 <a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>" style="color: #656467;">
			<div class="eye-img">
				 <img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="">
			</div>
			
			<div class="eye-word">
				 <p><?php echo $v['article_title'];?></a></p>
				 <strong><i class="fa fa-eye fa-lg"></i><?php echo $v['article_click'];?></strong>
			</div>
			
			</a>
		 </li>
<?php }else{ ?>

<?php }?>
---->
<li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>" style="color: #656467;"><?php echo $v['article_title']?></a></li>
<?php }?>
<?php }?>