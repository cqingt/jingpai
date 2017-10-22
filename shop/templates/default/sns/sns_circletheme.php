<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="topic-area mb mt">
		<div class="picnav dfclearfix">
			<ul class="handover_title">
				<?php include template('layout/submenu'); ?>
			</ul>
		</div>		
		<div class="topic-con handover_con">
		  <?php if(!empty($output['theme_list'])){?>
			<div class="demo" style="display: block;">
				<ul class="sort-article-list two">
				<?php foreach ($output['theme_list'] as $val){?>
			
     
					<li>
							<div class="salimg">
								<img src="<?php echo getMemberAvatarForID($val['member_id']);?>" data-param="{'id':<?php echo $val['member_id'];?>}" nctype="mcard">
							</div>
					
						<div class="abstract-text">
							<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank"><h1><?php echo $val['theme_name'];?></h1></a>
							<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank">
								<p><?php echo removeUBBTag($val['theme_content']);?></p>
							</a>
						</div>
						
						<?php if(!empty($output['affix_list'][$val['theme_id']])){$array = array_slice($output['affix_list'][$val['theme_id']], 0, 3)?>
						<div class="have-picture mt">
          <?php foreach ($array as $v){?>
							<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank">
								<span><img src="<?php echo themeImageUrl($v['affix_filethumb']);?>"></span>							
							</a>
							
		 <?php }?>
						</div>		
          <?php }?>
						
						<div class="word">
							<div class="in-detail unlike">
								<p class="time">发布时间：<em><?php echo @date('Y-m-d', $val['theme_addtime']);?></em></p>
								<p><strong>来自社区：</strong>
								<?php if($val['lastspeak_name']){?><?php echo $lang['sns_lastspeak_time'].$lang['nc_colon'];?><em><?php echo @date('Y-m-d', $val['lastspeak_time'])?></em><?php }else{echo $lang['sns_reply_null'];}?>
<a  target="_blank" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>"><?php echo $val['circle_name'];?></a></p>
								<span><i class="icon-comment"></i><?php echo $val['theme_commentcount'];?></span>							
								<span><i class="icon-read"></i><?php echo $val['theme_browsecount'];?></span>		
							</div>
						</div>						
					</li>	
								<?php }?>		
				</ul>	
				<div class="pagination mt-greatly">
			  <?php echo $output['showpage'];?>
		        </div>	
<?php }else{?>
  <!-- 为空提示 START -->
<div class="sns-norecord"><i class="theme-ico pngFix"></i><span><?php echo $lang['sns_regrettably'];?><br />
<?php if ($output['relation'] == 3){echo $lang['sns_me']; }else {?>TA<?php }?><?php echo $lang['sns_not_yet'];?><a href="<?php echo CIRCLE_SITE_URL;?>" target="_blank"><?php echo $lang['sns_group'];?></a><?php echo $lang['sns_in_publish_theme'];?></span></div>
<?php }?>
			</div>	

		</div>

	</div>
	
  <?php include template('sns/sns_sidebar_visitor');?>

<script type="text/javascript">
$(function(){
	$(".theme-file .t-img").VMiddleImg({"width":100,"height":100});
});
</script>