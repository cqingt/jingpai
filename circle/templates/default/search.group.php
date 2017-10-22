<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="wrapper">
	<div class="topic-area mtb">
		<div class="search-seek-out">
		<?php echo $lang['circle_to_search'];?>"<em><?php echo $output['count'];?></em>"<?php echo $lang['circle_item'];?><?php if($_GET['keyword'] != ''){?><?php echo $lang['circle_yu'];?>"<strong><?php echo $_GET['keyword'];?></strong>"<?php echo $lang['circle_relevant'];?><?php }elseif($_GET['class_name'] != ''){?><?php echo $lang['circle_yu'];?>"<em><?php echo $_GET['class_name'];?></em>"<?php echo $lang['circle_class_relavant']; }?><?php echo $lang['circle_result'];?>

			
		</div>
		
  <?php if(!empty($output['circle_list'])){?>
		<div class="topic-con">
		
			<ul class="community-powered-search">
			<?php foreach($output['circle_list'] as $val){?>
	<li>

			
					<a class="cpsimg" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><img src="<?php echo circleLogo($val['circle_id']);?>"/></a>
					<div class="word">
						<h2><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><?php echo $val['circle_name']?></a></h2>
						<h5>创建于：<?php echo @date('Y-m-d', $val['circle_addtime'])?></h5>
						<h6><strong>用户数：<?php echo $val['circle_mcount'];?></strong><strong>主题数：<?php echo $val['circle_thcount'];?></strong></h6>
						<a class="text" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank">
							<p><?php echo $val['circle_desc'];?></p>
						</a>
						
						<?php if(!in_array($val['identity'], array(1,2,3,4))){?>
							<a class="btn-join" href="javascript:void(0);" dwnctype="apply" c_id="<?php echo $val['circle_id'];?>"><i>+</i>加入圈子</a>
						<?php }else{ ?>
							<a class="btn-join" href="javascript:void(0);" nctype="quitGroup" c_id="<?php echo $val['circle_id'];?>">退出</a>
						<?php } ?>
						<a class="btn-look" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>">查看圈子</a>
					</div>
				</li>

			<?php }?>
			</ul>

		</div>
		<div class="pagination mt-greatly">
	    	<ul>
				<?php echo $output['show_page'];?>
	        </ul>
        </div>

		<?php }else{?>
    <div class="no-theme">
      <i></i>
      <span><?php echo $lang['circle_result_null'].L('nc_comma,circle_go');?><a href="<?php echo CIRCLE_SITE_URL;?>"><?php echo L('circle_home_page_around');?></a></span>
      <br>
      <span><?php echo $lang['circle_search_null_msg'];?><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=index&op=add_group&kw=<?php echo $_GET['keyword'];?>"><?php echo $lang['circle_instantly_create'];?></a></span>
    </div>
    <div></div>
    <?php }?>
	</div>
	
<div class="rightcircle-large mt">
 <?php require_once circle_template('index.themetop');?>
</div>

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