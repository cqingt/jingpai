

<div class="mt wrapper">
	<div class="circle-mainnav">
		<h2>全部圈子</h2>
		<ul>
			<li><i class="icon-mainnav1"></i><a href="index.php?act=search&op=group&class_id=2" target="_blank">书画艺术</a></li>
			<li><i class="icon-mainnav2"></i><a href="index.php?act=search&op=group&class_id=7" target="_blank">鉴定专区</a></li>
			<li><i class="icon-mainnav3"></i><a href="index.php?act=search&op=group&class_id=5" target="_blank">金银制品</a></li>
			<li><i class="icon-mainnav4"></i><a href="index.php?act=search&op=group&class_id=4" target="_blank">把玩手串</a></li>
			<li><i class="icon-mainnav5"></i><a href="index.php?act=search&op=group&class_id=3" target="_blank">翡翠玉器</a></li>
		</ul> 
	</div>
	<div class="main-cotent-area">
		<div class="lunbotu">
			<div class="yx-rotaion">
			
		<?php if(!empty($output['loginpic']) && is_array($output['loginpic'])){?>
				<script type="text/javascript" src="<?php echo CIRCLE_TEMPLATES_URL;?>/js/jquery.yx_rotaion.js"></script>
				<ul class="rotaion_list">
			<?php foreach($output['loginpic'] as $val){?>
					<li><a href="<?php if($val['url'] != ''){echo $val['url'];}else{echo 'javascript:void(0);';}?>" target="_blank" title="<?php echo $val['adv_title'];?>"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_CIRCLE.'/'.$val['pic'];?>" title="<?php echo $val['adv_title'];?>" alt="<?php echo $val['adv_title'];?>"></a></li>
					
			<?php }?>
				</ul>
				<script type="text/javascript">
				$(".yx-rotaion").yx_rotaion({title:true,auto:true});
				</script>
        <?php }?>
					
								
			</div>			
		</div>
		<div class="article-list">
		 <?php if(!empty($output['theme_list'])){?>
			<ul>
			<?php $i == 0; ?>
				<?php foreach ($output['theme_list'] as $k=>$val){?>
				<?php if($i==0){ ?>
				<li>
					<h2><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><?php echo $val['theme_name'];?></a></h2>
					<h4><a><?php echo $val['member_name'];?></a><a class="a2" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank"><strong>来自：</strong><?php echo $val['circle_name'];?></a></h4>
					<a class="text" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><?php echo $val['theme_content'];?>...详情></a>
				</li>
				<?php }else{ ?>
				<li><a class="ad" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><?php echo $val['theme_name'];?></a><em><?php echo $val['theme_browsecount'];?></em><i class="icon-eye"></i></li>
				<?php } ?>

				<?php $i++; ?>
				<?php }?>
			
			</ul>
			 <?php }?>
		</div>

<?php if($_SESSION['is_login'] == 0){?>

	<div class="personal-center">
			 <h2>个人中心</h2>
			 <div class="circle-my-info cmi">
			 	<a class="my-headimg" ><img src="<?php  echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON.DS.C('default_user_portrait');?>"/></a>
			 	<div class="info-detail">
		 
					 <p>您还没有登陆哦~</p>
                      
			 	</div>
			 </div>
				 

		<h6>推荐圈子</h6>
				 <ul class="entry-box">
					<li>
						<a href="index.php?act=search&op=group&class_id=7" target="_blank">
							<i class="icon-mecircle1"></i>
							<span>鉴定专区</span>
						</a>
					</li>
					<li>
						<a href="index.php?act=search&op=group&class_id=5" target="_blank">
							<i class="icon-mecircle2"></i>
							<span>金银制品</span>
						</a>
					</li>
					<li>
						<a href="index.php?act=search&op=group&class_id=3" target="_blank">
							<i class="icon-mecircle3"></i>
							<span>翡翠玉器</span>
						</a>
					</li>			 	
				 </ul>		
			 <a href="javascript:void(0);" nctype="create_circle" class="btn-establish nopl">登陆查看我的信息
</a>				 		 
		</div>

<?php }else{?>


		<div class="personal-center">
			 <h2>个人中心</h2>
			 <div class="circle-my-info">
			 	<a class="my-headimg" href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $_SESSION['member_id'];?>" title="<?php echo $lang['nc_edit_avatar'];?>"><img src="<?php  echo getMemberAvatarForID($_SESSION['member_id']);?>"/></a>
			 	<div class="info-detail">
			 		<div><a><?php echo $_SESSION['member_name'];?></a></div>
			 		<span><?php echo $lang['circle_welcome_back_to'].C('circle_name');?></span>
			 	</div>
			 </div>
			 <div class="entry-info">
			 <a target="_blank" href="index.php?act=p_center&op=my_group" class="url"><?php echo $lang['my_circle'];?></a> <a href="index.php?act=p_center" class="url"><?php echo $lang['my_theme'];?></a> <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=login&op=loginout" class="url"><?php echo $lang['nc_logout'];?></a>
			 </div>

		<h6>推荐圈子</h6>
		 <ul class="entry-box">
			<li>
				<a href="index.php?act=search&op=group&class_id=7" target="_blank">
					<i class="icon-mecircle1"></i>
					<span>鉴定专区</span>
				</a>
			</li>
			<li>
				<a href="index.php?act=search&op=group&class_id=5" target="_blank">
					<i class="icon-mecircle2"></i>
					<span>金银制品</span>
				</a>
			</li>
			<li>
				<a href="index.php?act=search&op=group&class_id=3" target="_blank">
					<i class="icon-mecircle3"></i>
					<span>翡翠玉器</span>
				</a>
			</li>			 	
		 </ul>
			 <a href="javascript:void(0);" nctype="create_circle" class="btn-establish"><i></i><?php echo $lang['circle_create_my_new_circle'];?></a>
		</div>


<?php }?>



	</div>


	
	<div class="second-box wrapper mt">

		<div class="community">
		
            <div class="headline"><h2>鉴定专区</h2><i></i></div>
			<ul class="hd-community">
			 <?php foreach ($output['HuoDong_List'] as $val){?>
				<li>
					<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank">
						<div class="com-img">
							<img src="<?php echo circleLogo($val['circle_id']);?>" />
						</div>
						<p><?php echo $val['circle_name'];?></p>
					</a>
				</li>
			<?php }?>			
			</ul>
			
		</div>

		<div class="hotspot">
			<div class="headline"><h2>近期热点</h2></div>
			<ul class="jq-hotspot">
			<?php foreach ($output['ReDian_list'] as $val){?>
				<li><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><?php echo $val['theme_name'];?></a></li>
			<?php }?>
			</ul>
		</div>
	</div>
</div>
 
<div class="thirdly-box wrapper mt">
	<div class="expressage">
		<div class="headline"><h2>资讯快递</h2><i></i></div>
	  <?php if(!empty($output['ZhiXun_list'])){?>
		<ul class="zx-expressage">
		
		</ul>
		<?php }?>
		<div class="to-load-more">
			<a href="javascript:;" onclick="loadMore();">加载更多</a>
		</div>
	</div>
	<div class="rightcircle">
		
		<div class="headline"><h2>热门圈子</h2></div>
		<?php if ($output['circle_list']){ ?>
		<ul class="rm-circle mb">
		<?php foreach ($output['circle_list'] as $k=>$val){ ?>
			<li>
			   <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" target="_blank">
			      <div class="icon2-mecircle<?php echo $val['i'];?>"></div> 
			      <div class="word">
			      	<h2><em><?php echo $val['i'];?></em><?php echo $val['circle_name'];?></h2>
			      	<h6>用户数：<?php echo $val['circle_mcount'];?></h6>
			      </div>
			   </a>			   
			</li>
		<?php } ?>
			
		</ul>
		<?php } ?>
		
		<div class="headline"><h2>明星圈主</h2></div>
		  <?php if(!empty($output['member_list'])){?>
		<ul class="star-host mb">
		    <?php foreach ($output['member_list'] as $val){?>
			<li>
				<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=sns_circle&mid=<?php echo $val['member_id'];?>" target="_blank">
					<div class="starimg">
						<img src="<?php echo getMemberAvatarForID($val['member_id']);?>"/>
					</div>
					<p><?php echo $val['member_name'];?></p>
				</a>
			</li>
			 <?php }?>
			<?php }?>
		</ul>
		
		<div class="headline"><h2>随便看看</h2></div>

	<?php if(!empty($output['new_themelist'])){?>
    
   
		<ul class="casual-look mb">
			<?php foreach ($output['new_themelist'] as $val){?>
			<li>
				<?php if($val['affix']){ ?>
				<div class="lookingbox">
				<a class="lookimg" href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank" title="<?php echo $val['theme_name'];?>"><img src="<?php echo $val['affix'];?>"/></a></div>
				<?php } ?>


				<div class="word">
					<p><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>" target="_blank"><?php echo $val['theme_name'];?></a></p>
					<h4>来自：<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>" title="<?php echo $lang['circle_theme_come_from'].$lang['nc_colon'].$val['circle_name'];?>" target="_blank"><?php echo $val['circle_name'];?></a></h4>
				</div>
			</li>
			
    <?php }?>
			 
		</ul>
		<?php }?>
	</div>
</div>


<script>
loadMore();	
var j = 2;
function loadMore(){
	$.ajax({
		type: "GET", cache: false,
		url : "index.php?act=index&op=ajax_page",
		data: 'curpage=' + j,
		beforeSend:function(XMLHttpRequest){
			$(".to-load-more").show();
			$(".to-load-more").html('<a href="javascript:;">正在载入</a>');
 		},
		success : function(html){
			$('.zx-expressage').append(html);
			if(html.length>30){
				$(".to-load-more").html('<a href="javascript:;" onclick="loadMore();">加载更多</a>');
			}else{
				$(".to-load-more").html('<a href="javascript:;">没有更多了</a>');
			}
		}
	});
	j++;
}

</script>