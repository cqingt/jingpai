

<?php require_once circle_template('group.top');?>


<div class="wrapper">
	<div class="topic-area mb">
		<ul class="topic-nav handover_title">
			<li class="on">话题</li>
			<a href="index.php?act=group&op=group_member&c_id=<?php echo $output['c_id'];?>"><li><?php echo $lang['circle_firend'];?></li></a>
			<a href="index.php?act=group&op=group_goods&c_id=<?php echo $output['c_id'];?>"><li><?php echo $lang['nc_goods'];?></li></a>
		</ul>
		<div class="topic-con handover_con">
			<div class="demo">
				<div class="sort-box">
					<h2>排序：</h2>
					<a <?php if($_GET['order'] == ''){ ?> class="on" <?php }?> href="index.php?act=group&c_id=<?php echo $output['c_id'];?>">默认</a>

					<a <?php if($_GET['order'] == 'lastspeak_time'){ ?> class="on" <?php }?> href="index.php?act=group&c_id=<?php echo $output['c_id'];?>&order=lastspeak_time&desc=<?php if($_GET['desc'] == 'desc' && $_GET['order'] == 'lastspeak_time'){ echo 'asc';}else{ echo 'desc';}?>">最后回复</a>
					<a <?php if($_GET['order'] == 'theme_commentcount'){ ?> class="on" <?php }?> href="index.php?act=group&c_id=<?php echo $output['c_id'];?>&order=theme_commentcount&desc=<?php if($_GET['desc'] == 'desc' && $_GET['order'] == 'theme_commentcount'){ echo 'asc';}else{ echo 'desc';}?>">最热</a>
					<a <?php if($_GET['order'] == 'theme_id'){ ?> class="on" <?php }?> href="index.php?act=group&c_id=<?php echo $output['c_id'];?>&order=theme_id&desc=<?php if($_GET['desc'] == 'desc' && $_GET['order'] == 'theme_id'){ echo 'asc';}else{ echo 'desc';}?>">最新</a>
				</div>
				 <?php if(!empty($output['theme_list'])){?>
				<ul class="sort-article-list">
				<?php foreach($output['theme_list'] as $val){?>
					<li>

							<div class="salimg">
								<img src="<?php echo getMemberAvatarForID($val['member_id']);?>">
							</div>
						<div class="word">
							<h1>

			<?php if($val['is_stick'] == 1){
            	echo '<strong class="stick">置顶</strong>';
            }elseif($val['is_digest'] == 1){
            	echo '<strong class="stick">精</strong>';
            }elseif($val['is_shut'] == 1){
            	echo '<strong class="stick">关闭</strong>';
            }elseif($val['theme_special']==1){
				echo '<strong class="stick">投票</strong>';
            }?>
			<?php if($output['m_readperm'] >= $val['theme_readperm']){?>
              <a target="_blank" href="index.php?act=theme&op=theme_detail&c_id=<?php echo $output['c_id'];?>&t_id=<?php echo $val['theme_id'];?>"><?php echo $val['theme_name'];if($val['theme_readperm'] > 0){ echo '<font>'.L('nc_brackets1,circle_read_permissions').'lv'.$val['theme_readperm'].L('nc_brackets2').'</font>';}?></a>
              <?php }else{?>
              <a href="javascript:void(0);" onclick="showError('<?php echo L('circle_permission_denied');?>');"><?php echo $val['theme_name'];if($val['theme_readperm'] > 0){ echo '<font>'.L('nc_brackets1,circle_read_permissions').'lv'.$val['theme_readperm'].L('nc_brackets2').'</font>';}?></a>
              <?php }?></h1>
							<div class="in-detail">
								<p>
								<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>" target="_blank" title="<?php echo $val['member_name'];?>"><?php echo $val['member_name'];?></a>
								</p>
								<p class="time"><i class="icon-time"></i><?php echo @date('Y-m-d', $val['theme_addtime']);?></p>
								<?php if($val['lastspeak_name']){ ?>
								<p>
								<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['lastspeak_id'];?>" target="_blank" title="<?php echo $val['lastspeak_name'];?>"><?php echo $val['lastspeak_name'];?></a>
								</p>
								<p title="<?php echo $lang['circle_lastspeak_time'];?>"><?php echo @date('Y-m-d', $val['lastspeak_time']);?></p>
								<?php }?>
								<span><i class="icon-comment"></i><?php echo $val['theme_commentcount'];?></span>
								<span><i class="icon-read"></i><?php echo $val['theme_browsecount'];?></span>
							</div>
						</div>
 <?php if($output['m_readperm'] >= $val['theme_readperm']){?>
              <?php if(isset($output['affix_list'][$val['theme_id']])){?>
						<div class="have-picture">
							<a target="_blank" href="index.php?act=theme&op=theme_detail&c_id=<?php echo $output['c_id'];?>&t_id=<?php echo $val['theme_id'];?>">
							<?php $array = array_slice($output['affix_list'][$val['theme_id']], 0, 3);foreach($array as $v){ ?>
								<span><img src="<?php echo themeImageUrl($v['affix_filethumb']);?>"/></span>
							<?php }?>
							</a>
						</div>
					</li>
<?php }?>
<?php }?>
<?php }?>

				</ul>
				<?php }else{?>
				  <?php if($_GET['cream'] == 1){echo $lang['circle_no_digest'];}else{echo $lang['circle_no_theme'];}?>
				<?php }?>
			</div>
			</div>
		<div class="pagination mt-greatly">
	    	<?php echo $output['show_page'];?>
        </div>
	</div>


<?php require_once circle_template('group.left');?>
</div>
