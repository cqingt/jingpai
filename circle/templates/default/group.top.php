
<div class="wrapper mt">
	<div class="path">
	<?php echo $lang['circle_current_location'].$lang['nc_colon'];?>
	<?php if(!empty($output['breadcrumd'])){?>
    <?php foreach ($output['breadcrumd'] as $val){?>
    <?php if($val['link'] != ''){?>
    <a href="<?php echo $val['link'];?>" style="color: #2D917A;text-decoration: underline;background:url(<?php echo CIRCLE_TEMPLATES_URL;?>/images/circle_pics.png) no-repeat right -286px;padding-right: 12px;"><?php echo $val['title'];?></a>
    <?php }else{echo $val['title'];}?>
    <?php }?>
  <?php }?>
	</div>
</div>

<div class="wrapper">
	<div class="card-top">
        <div class="card-head">
        	<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $output['c_id'];?>"><img src="<?php echo circleLogo($output['circle_info']['circle_id']);?>"/></a>
        </div>
        <div class="word">
        	<h2><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $output['c_id'];?>"><?php echo $output['circle_info']['circle_name'];?></a>

			 <?php switch ($output['identity']){
      	case 0:
      	case 5:
      		echo '<div ><a href="javascript:void(0);" nctype="apply" ><i class="apply"></i>'.$lang['circle_apply_to_join'].'</a></div>';
      		break;
      	case 1:
      		echo '<div ><a href="index.php?act=manage&c_id='.$output['circle_info']['circle_id'].'" ><i class="manage"></i>'.$lang['manage_circle'].'</a></div>';
      		if($output['circle_info']['new_verifycount'] != 0)
      			echo '<div class="pending"><a href="index.php?act=manage&op=applying&c_id='.$output['c_id'].'">'.$lang['circle_wait_verity_count'].'</a><em>('.$output['circle_info']['new_verifycount'].')</em></div>';
      		if($output['circle_info']['new_informcount'] != 0)
      			echo '<div class="pending"><a href="index.php?act=manage_inform&op=inform&c_id='.$output['c_id'].'">'.$lang['circle_new_inform'].'</a><em>('.$output['circle_info']['new_informcount'].')</em></div>';
      		if($output['circle_info']['new_mapplycount'] != 0)
      			echo '<div class="pending"><a href="index.php?act=manage_mapply&c_id='.$output['c_id'].'">'.$lang['circle_management_application'].'</a><em>('.$output['circle_info']['new_mapplycount'].')</em></div>';
      		break;
      	case 2:
      		echo '<div class="isok"><a href="index.php?act=manage&c_id='.$output['circle_info']['circle_id'].'" ><i class="manage"></i>'.$lang['manage_circle'].'</a><a href="javascript:void(0);" nctype="quitGroup" ><i class="quit"></i>'.$lang['circle_quit_group'].'</a></div>';
      		if($output['circle_info']['new_verifycount'] != 0)
      			echo '<div class="pending"><a href="index.php?act=manage&op=applying&c_id='.$output['c_id'].'">'.$lang['circle_wait_verity_count'].'</a><em>('.$output['circle_info']['new_verifycount'].')</em></div>';
      		if($output['circle_info']['new_informcount'] != 0)
      			echo '<div class="pending"><a href="index.php?act=manage_inform&op=inform&c_id='.$output['c_id'].'">'.$lang['circle_new_inform'].'</a><em>('.$output['circle_info']['new_informcount'].')</em></div>';

      		break;
      	case 4:
      		echo '<div ><a href="javascript:void(0);" >'.$lang['circle_applying_wait_verify'].'</a></div>';
      		break;
      	case 3:
      	case 6:
      		echo '<div ><a href="javascript:void(0);" nctype="quitGroup" ><i class="quit"></i>'.$lang['circle_quit_group'].'</a></div>';
      		break;
      }?>
</h2>
        	<h4><?php if($output['circle_info']['circle_desc'] != ''){ echo $output['circle_info']['circle_desc'];}else{ echo $lang['circle_desc_null_default'];}?></h4>

			<?php echo $lang['circle_manager'].$lang['nc_colon'];?><a style="color: #F60;" target="_blank" href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&op=theme&mid=<?php echo $output['creator']['member_id'];?>" nctype="mcard" data-param="{'id':<?php echo $output['creator']['member_id'];?>}"><i></i><?php echo $output['creator']['member_name'];?></a>

		<?php echo $lang['circle_administrate'].$lang['nc_colon'];?>
        <?php if(!empty($output['manager_list'])){foreach($output['manager_list'] as $val){?>
        <a target="_blank" href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>"  nctype="mcard" data-param="{'id':<?php echo $val['member_id'];?>}"><i></i><?php echo $val['member_name'];?></a>
        <?php }}else{echo $lang['circle_no_administrate'];}?>
        <?php if($output['circle_info']['mapply_open'] == 1 && $output['identity'] == 3 && $output['cm_info']['cm_level'] >= $output['circle_info']['mapply_ml']){?>
        <a href="javascript:void(0);" nctype="manageApply"><?php echo $lang['circle_apply_to_be_a_management'];?></a>
        <?php }?>


        	<p><?php echo $lang['circle_today'].$lang['nc_colon'];?><?php echo $output['todaythcount'];?><strong>|</strong><?php echo $lang['circle_theme'].$lang['nc_colon'];?><?php echo $output['circle_info']['circle_thcount'];?><strong>|</strong><?php echo $lang['circle_firend'].$lang['nc_colon'];?><?php echo $output['circle_info']['circle_mcount'];?></p>
        </div>
        <a class="btn-issue" href="index.php?act=theme&op=new_theme&c_id=<?php echo $output['c_id'];?>"><i></i><?php echo $lang['circle_new_theme'];?></a>
	</div>
</div>

<script type="text/javascript" src="<?php echo CIRCLE_RESOURCE_SITE_URL;?>/js/group.js" charset="utf-8"></script>
<script>
var c_id = <?php echo $output['c_id'];?>;
var identity = <?php echo $output['identity'];?>;
</script>
