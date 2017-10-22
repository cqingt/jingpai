<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="wrapper">
	<div class="topic-area mb mt">
		<div class="search-seek-out">
			<?php echo $lang['circle_to_search'];?>"<em><?php echo $output['count'];?></em>"<?php echo $lang['circle_item'];?><?php if($_GET['keyword'] !=''){?><?php echo $lang['circle_yu'];?>"<strong><?php echo $_GET['keyword'];?></strong>"<?php echo $lang['circle_relevant'];?><?php }?><?php echo $lang['circle_result'];?>
		</div>
		
			<?php if(!empty($output['theme_list'])){?>
		<div class="topic-con">
			<div class="demo">
				<ul class="sort-article-list">
				
      <?php foreach($output['theme_list'] as $val){?>

					<li>
						<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>" target="_blank">
							<div class="salimg">
								<img src="<?php echo getMemberAvatarForID($val['member_id']);?>"/>
							</div>
						</a>
						<div class="word">
							<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank"><h1><?php echo $val['theme_name'];?></h1></a>
							<div class="in-detail unlike">
								<p><strong>话题作者：</strong><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>" target="_blank"><?php echo $val['member_name'];?></a></p>
								<p class="time">发布时间：<em><?php echo @date('Y-m-d', $val['theme_addtime']);?></em></p>
								<p><strong>来自社区：</strong><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><?php echo $val['circle_name'];?></a></p>
								<span><i class="icon-comment"></i><?php echo $val['theme_browsecount'];?></span>							
								<span><i class="icon-read"></i><?php echo $val['theme_commentcount'];?></span>		
							</div>
						</div>
						
						<div class="abstract-text">
							<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank">
								<p><?php echo replaceUBBTag($val['theme_content'], 0);?> <span style="color: red;">查看全部</span></p>
							</a>
						</div>
					</li>	
      <?php }?>
		
				</ul>		
				
			</div>	
		</div>
		<div class="pagination mt-greatly">
	    	<ul>
	    		<?php echo $output['show_page'];?>
	        </ul>
        </div>
		<?php }else{?>
    <div class="no-theme"><span> <i></i><?php echo $lang['circle_result_null'];?></span></div>
    <?php }?>
	</div>
	
	
	<div class="rightcircle-large mt">
		  <?php require_once circle_template('index.themetop');?>
		
	</div>
</div>






  
