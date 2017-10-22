
<?php require_once circle_template('group.top');?>


<div class="wrapper">
	<div class="topic-area mb">
		<ul class="topic-nav handover_title">
			<a href="index.php?act=group&c_id=<?php echo $output['c_id'];?>"><li><?php echo $lang['circle_theme'];?></li></a>
			<a href="index.php?act=group&op=group_member&c_id=<?php echo $output['c_id'];?>"><li><?php echo $lang['circle_firend'];?></li></a>
			<li class="on"><?php echo $lang['nc_goods'];?></li>
		</ul>
		
		 <?php if(!empty($output['goods_list'])){?>
      <ul class="share-goods-pinterest" id="groupPinterest">
      <?php foreach($output['goods_list'] as $val){?>
        <li class="item">
          <div class="share-goods-pic thumb"><a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$val['snsgoods_goodsid']));?>" target="_blank" title="<?php echo $val['snsgoods_goodsname'];?>"><img alt="<?php echo $val['snsgoods_goodsname'];?>" title="<?php echo $val['snsgoods_goodsname'];?>" src="<?php echo cthumb($val['snsgoods_goodsimage'], 240, $val['snsgoods_storeid']);?>"></a></div>
          <dl class="share-describe">
            <dt class="member-avatar-s"><img src="<?php echo getMemberAvatarForID($val['share_memberid']);?>" /></dt>
            <dd class="member-name">
              <h4><a href="javascript:void(0);"><?php echo $val['share_membername'];?></a></h4>
              <h5 class="share-date"><?php echo $lang['nc_at'];?><?php if($val['share_isshare'] == 1){?><em><?php echo @date('Y-m-d H:i', $val['share_addtime']);?></em><?php echo $lang['nc_show'];?><?php }else{?><em><?php echo @date('Y-m-d H:i', $val['share_likeaddtime']);?></em><?php echo $lang['nc_like'];?><?php }?></h5>
            </dd>
            <dd class="share-content"><i></i>
              <p><?php if($val['share_content'] != ''){echo $val['share_content'];}else{echo $lang['nc_share_default_content'];}?></p>
              <?php if(isset($output['pic_list'][$val['share_id']])){?>
              <ul class="ap-pics">
                <li class="case"></li>
                <?php foreach($output['pic_list'][$val['share_id']] as $v){?>
                <li><span class="thumb"><a href="JavaScript:void(0);"><img src="<?php echo showImgUrl($v);?>" class="t-img" /></a></span></li>
                <?php }?>
              </ul>
              <?php }?>
              <div class="clear">&nbsp;</div>
            </dd>
          </dl>
          <div class="share-ops"> <span class="ops-like" id="likestat_<?php echo $val['share_goodsid'];?>" title="<?php echo $lang['nc_like'];?>"> <a href="javascript:void(0);" nc_type="likebtn" data-param='{"gid":"<?php echo $val['share_goodsid'];?>"}' class="<?php echo $val['snsgoods_havelike']==1?'noaction':''; ?>"><i class="<?php echo $val['snsgoods_havelike']==1?'noaction':''; ?>"></i><?php echo $lang['nc_like'];?></a> <em nc_type="likecount_<?php echo $val['share_goodsid'];?>"><?php echo $val['snsgoods_likenum'];?></em> </span> <span class="ops-comment" title="<?php echo $lang['nc_comment'];?>"><a href="<?php echo SHOP_SITE_URL?>/index.php?act=member_snshome&op=goodsinfo&mid=<?php echo $val['share_memberid'];?>&id=<?php echo $val['share_id'];?>" target="_blank"><i></i></a><em><?php echo $val['share_commentcount'];?></em></span></div>
          <div class="clear"></div>
        </li>
      <?php }?>
      </ul>
      <div class="clear"></div>
		<div class="pagination mt-greatly">
	    	<?php echo $output['show_page'];?>
        </div>
<?php }else{?>
<div class="no-goods"><span><i></i><?php echo $lang['nc_share_goods_null'];?></span></div>
      <?php }?>
	</div>
	
	
<?php require_once circle_template('group.left');?>
</div>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js" type="text/javascript"></script> 
<script type="text/javascript">
$(function(){
	$("#groupPinterest").imagesLoaded( function(){
		$("#groupPinterest").masonry({
			itemSelector : '.item'
		});
	});

	//喜欢操作
	$("a[nc_type='likebtn']").live('click',function(){
		var obj = $(this);
		var data_str = $(this).attr('data-param');
        eval( "data_str = "+data_str);
        //ajaxget(SITEURL+'/index.php?act=member_snsindex&op=editlike&inajax=1&id='+data_str.gid);
        ajaxget(CIRCLE_SITE_URL+'/index.php?act=member_snsindex&op=editlike&inajax=1&id='+data_str.gid);
	});

//横高局中比例缩放隐藏显示图片
	$(".ap-pics .t-img").VMiddleImg({"width":30,"height":30});
	
});
</script> 
