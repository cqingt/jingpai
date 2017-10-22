<div class="rightcircle-large">
		
		<div class="chitchat-box mb">
			<ul class="chitchat-nav">
				<li>圈子公告</li>
			</ul>
			<div class="chitchat-con">
				<ul class="title-list">
					<?php if($output['circle_info']['circle_notice'] != ''){ echo $output['circle_info']['circle_notice'];}else{?>
        <span class="no-notice"><i></i><?php echo $lang['circle_no_notice'];?></span>
        <?php }?>
				</ul>						
			</div>
		</div>
		
		<div class="chitchat-box mb">
			<ul class="chitchat-nav">
				<li>圈子信息</li>
			</ul>
			<div class="chitchat-con">
			    <ul class="introduce-list">
			    	<li><?php echo $lang['circle_belong_to_class'].$lang['nc_colon'];?><strong><?php if($output['class_info']['class_name'] != ''){ echo $output['class_info']['class_name'];}else{echo $lang['nc_default'];}?></strong></li>
			    	<li><?php echo $lang['circle_build_time'].$lang['nc_colon'];?><strong><?php echo @date('Y-m-d',$output['circle_info']['circle_addtime']);?></strong></li>
			    	<li><?php echo $lang['circle_friend_count'].$lang['nc_colon'];?><strong><?php echo $output['circle_info']['circle_mcount'];?> <?php echo $lang['circle_person'];?></strong></li>
			    	<li><?php echo $lang['circle_theme_amount'].$lang['nc_colon'];?><strong><?php echo $output['circle_info']['circle_thcount'];?> <?php echo $lang['circle_item'];?></strong></li>
			    	<li><?php echo $lang['circle_manager'].$lang['nc_colon'];?><strong><a target="_blank" href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&op=theme&mid=<?php echo $output['creator']['member_id'];?>"  title="<?php echo $output['creator']['member_name'];?>" target="_blank"><i class="icon-king"></i><?php echo $output['creator']['member_name'];?></strong></a></li>
			    	<li><?php echo $lang['circle_administrate'].$lang['nc_colon'];?>
					<?php if(!empty($output['manager_list'])){?>
					<?php foreach ($output['manager_list'] as $val){?>
						<a target="_blank" href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>" title="<?php echo $val['member_name'];?>" target="_blank"><i class="icon-king"></i><?php echo $val['member_name'];?></a>
					<?php }?>
					<?php }else{?>
						<strong><?php echo $lang['circle_is_null'];?></strong>
					<?php }?>
					
					</li>
			    </ul>
			</div>
		</div>
		
	</div>