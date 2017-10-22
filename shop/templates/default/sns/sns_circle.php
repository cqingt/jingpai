<?php defined('InShopNC') or exit('Access Invalid!');?>


<div class="topic-area mb mt">
		<div class="picnav clearfix">
			<ul class="handover_title">
				<?php include template('layout/submenu'); ?>
			</ul>	
		</div>		
		<div class="topic-con handover_con">
			 <?php if(!empty($output['circle_list'])){?>
	        <div class="demo">
				<ul class="community-powered-search mt">
				<?php foreach($output['circle_list'] as $val){?>
					<li style="margin-right: 126px;">
						<a class="cpsimg" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><img src="<?php echo circleLogo($val['circle_id']);?>"></a>
						<div class="word">
							<h2><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><?php echo $val['circle_name'];?></a></h2>
							<h5>创建于：<?php echo @date('Y-m-d', $val['circle_addtime']);?></h5>
							<h6><strong>用户数：<?php echo $val['circle_mcount'];?></strong><strong>主题数：<?php echo $val['circle_thcount'];?></strong></h6>
							<a class="text" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank">
								<p><?php echo $val['circle_desc'];?></p>
								
							</a>
							<!--
						<?php if(!in_array($val['identity'], array(1,2,3,4))){?>
							<a class="btn-join" href="javascript:void(0);" dwnctype="apply" c_id="<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a>
						<?php }else{ ?>
							<a class="btn-join" href="javascript:void(0);" nctype="quitGroup" c_id="<?php echo $val['circle_id'];?>">退出</a>
						<?php } ?>
-->
							<a class="btn-look" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>">查看圈子</a>
						</div>
					</li>
					<?php }?>
				</ul>
				
	        </div>
  <?php }else{?>
  <!-- 为空提示 START -->
  <div class="sns-norecord"><i class="circle-ico pngFix"></i><span><?php echo $lang['sns_regrettably'];?><br />
    <?php if ($output['relation'] == 3){echo $lang['sns_me']; }else {?>TA<?php }?><?php echo $lang['sns_not_yet'];?><a href="<?php echo CIRCLE_SITE_URL;?>" target="_blank"><?php echo $lang['sns_join_group'];?></a><?php echo $lang['sns_oh'];?></span></div>
  <?php }?>
  <!-- 为空提示 END --> 

		</div>

	</div>


  <?php include template('sns/sns_sidebar_visitor');?>


<script type="text/javascript">
// 申请加入
	$('a[dwnctype="apply"]').click(function(){
		var c_id = $(this).attr("c_id");
		if(_ISLOGIN == 0){
			login_dialog();
		}else{
			CUR_DIALOG = ajax_form('apply_join','申请加入','index.php?act=group&op=apply&c_id='+c_id,520,1);
		}
	});
	// 退出圈子
	$('a[nctype="quitGroup"]').click(function(){
		var c_id = $(this).attr("c_id");
		showDialog('确定要退出圈子吗？', 'confirm', '', function(){
			var _uri = CIRCLE_SITE_URL+"/index.php?act=group&op=quit&c_id="+c_id;
			ajaxget(_uri);
		});
	});
</script>
