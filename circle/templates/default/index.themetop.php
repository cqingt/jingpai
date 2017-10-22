<?php defined('InShopNC') or exit('Access Invalid!');?>
<style>
.handover_con .demo {
	display: none;
}
</style>
 <script src="<?php echo CIRCLE_TEMPLATES_URL;?>/js/main.js"></script>
<div class="chitchat-box mb">
			<ul class="chitchat-nav handover_title">
				<li class="on"><?php echo $lang['circle_new_theme_two'];?></li>
				<li><?php echo $lang['circle_hot_theme'];?></li>
				<li><?php echo $lang['circle_hot_reply'];?></li>
			</ul>
			<div class="chitchat-con handover_con">
				<div class="demo">
				<?php if(!empty($output['new_themelist'])){?>
					<ul class="title-list">
					 <?php foreach ($output['new_themelist'] as $val){?>
						<li><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><?php echo $val['theme_name'];?></a></li>
						<?php }?>
					</ul>	
					<?php }?>
				</div>
				<div class="demo">
				<?php if(!empty($output['hot_themelist'])){?>
					<ul class="title-list">
					    <?php foreach ($output['hot_themelist'] as $val){?>
						<li><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" title="<?php echo $val['theme_name'];?>" target="_blank"><?php echo $val['theme_name'];?></a></li>
						<?php }?>
					</ul>
					<?php }?>
				</div>
				<div class="demo">
				    <?php if(!empty($output['reply_themelist'])){?>
					<ul class="title-list">
					<?php foreach ($output['reply_themelist'] as $val){?>
						<li><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>"  title="<?php echo $lang['circle_theme_come_from'].$lang['nc_colon'].$val['theme_name'];?>" target="_blank"><?php echo $val['theme_name'];?></a></li>
					<?php }?>
					</ul>	
					<?php }?>
				</div>					
			</div>
		</div>	
