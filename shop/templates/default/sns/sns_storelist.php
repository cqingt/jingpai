<?php defined('InShopNC') or exit('Access Invalid!');?>

<style type="text/css">
.jcarousel-container { width: 700px; margin: 10px 0;}
.jcarousel-container .goods-pic { width: 175px; height: 175px;}
.jcarousel-container .goods-pic a { line-height: 0; background-color: #FFF; text-align: center; vertical-align: middle; display: table-cell; *display: block; width: 175px; height: 175px; overflow: hidden;}
.jcarousel-container .goods-pic a img { max-width: 175px; max-height: 175px; margin-top:expression(175-this.height/2); *margin-top:expression(87-this.height/2)/*IE6,7*/;
}
.share-content #mycarousel-g li { width: auto !important;}
</style>
<link rel="stylesheet" href="http://www.96567.com/circle/templates/default/css/owl.theme.css">
<link rel="stylesheet" href="http://www.96567.com/circle/templates/default/js/main.js">
<div class="wrapper dfclearfix mtb">
	<div class="picture-content dfclearfix">
		<div class="picnav dfclearfix">
			<ul class="handover_title">
				<li class="on">分享的店铺</li>
			</ul>
			 <?php if($output['relation'] == '3'){?>
	<span>
				<a class="btn-sharebaby" href="javascript:void(0);" id="snssharestore">分享店铺</a>
			</span>		
    <?php }?>
				
		</div>
		
		<div class="handover_con">
		 <!-- 店铺列表 -->

<div class="demo" id="shoplist-module">
 <?php if(!empty($output['storelist'])){?>

      <?php foreach($output['storelist'] as $k=>$v){?>
				<!--一家-->
				<div class="share-shop-boxes clearfix mt-small" id="recordone_<?php echo $v['share_id']; ?>">
					<div class="who clearfix">
					<a href="javascript:void(0)"></a>
						<h4><?php echo $v['share_membername'];?></h4>
						<h6><em><?php echo @date('Y-m-d', $v['share_addtime']);?></em><em><?php echo @date('H:i:s', $v['share_addtime']);?></em></h6>
						<span><i>“</i><strong><?php echo $v['share_content'] != ''?$v['share_content']:$lang['sns_shared_the_shop'];?></strong><em>”</em></span>
					</div>

			<?php if ($output['relation'] == 3){?>
            
            <div class="set-btn fr" nc_type="privacydiv"><a href="javascript:void(0)" nc_type="formprivacybtn"><i></i><?php echo $lang['sns_setting'];?></a>
            <ul class="set-menu" nc_type="privacytab" style="display: none;">
              <li nc_type="privacyoption" data-param='{"sid":"<?php echo $v['share_id'];?>","v":"0","op":"store"}'><span class="<?php echo $v['share_privacy']==0?'selected':'';?>"><?php echo $lang['sns_open'];?></span></li>
              <li nc_type="privacyoption" data-param='{"sid":"<?php echo $v['share_id'];?>","v":"1","op":"store"}'><span class="<?php echo $v['share_privacy']==1?'selected':'';?>"><?php echo $lang['sns_friend'];?></span></li>
              <li nc_type="privacyoption" data-param='{"sid":"<?php echo $v['share_id'];?>","v":"2","op":"store"}'><span class="<?php echo $v['share_privacy']==2?'selected':'';?>"><?php echo $lang['sns_privacy'];?></span></li>
              <li nc_type="storedelbtn" data-param='{"sid":"<?php echo $v['share_id'];?>"}'><span class="del"><a href="javascript:void(0);"><?php echo $lang['nc_delete'];?></a></span></li>
            </ul></div>
			<?php }?>
					<div class="share-baby clearfix">
						<h2><a title="<?php echo $v['store_name'];?>" href="<?php echo urlShop('show_store', 'index', array('store_id'=>$v['store_id']));?>" target="_blank"><i class="icon-house"></i><?php echo $v['store_name'];?></a></h2>
						<div class="l">
							<div class="row">
								<div class="large-12">
					<?php if (!empty($v['goods'])){?>

									<div class="owl-carousel">


 <?php foreach((array)$v['goods'] as $g_k=>$g_v){?>

			  <div class="article">
				<a href="<?php echo $g_v['goodsurl'];?>" target="_blank">
				<div class="img">
					<img src="<?php echo thumb($g_v, 240);?>" alt="<?php echo $g_v['goods_name'];?>"/>
				</div>
				<p><?php echo $g_v['goods_name'];?></p>
				<em>¥<?php echo $g_v['goods_price'];?></em>
				</a>
			</div>	
 <?php }?>
										

																		
									</div>
<?php }?>	
								</div>
							</div>
						</div>
						
						<div class="r">
							<div class="gs">
								<a href="">
									<div class="ti"><?php echo $v['goods_count'];?></div>
									<div class="all">所有宝贝</div>
								</a>
								<a href="">
									<div class="ti"><?php echo $v['store_collect'];?></div>
									<div class="all">收藏人气</div>
								</a>								
							</div>
							<div class="gsbtnbox">
								<a class="btn-g" href="<?php echo urlShop('show_store', 'index', array('store_id'=>$v['store_id']));?>">逛逛店铺</a>
								<a class="btn-s" href="javascript:collect_store('<?php echo $v['store_id'];?>','count','store_collect')">收藏店铺</a>
							</div>
						</div>
					</div>					
				</div>					
				<!--一家-->
				


<?php }?>
	
				<div class="pagination mt-greatly">
				<?php echo $output['show_page']; ?>
				</div>					
				
<?php } else{?>
    <?php if ($output['relation'] == 3){?>
    <div class="sns-norecord"><i class="store-ico pngFix"></i><span><?php echo $lang['sns_sharestore_nohave_self_1'];?><a href="index.php?act=member_favorites&op=fslist" target="_blank"><?php echo $lang['sns_sharestore_nohave_self_2'];?></a><?php echo $lang['sns_sharestore_nohave_self_3'];?></span></div>
    <?php }else {?>
    <div class="sns-norecord"><i class="store-ico pngFix"></i><span><?php echo $lang['sns_sharestore_nohave_1'];?>
      </span></div>
    <?php }?>
 <?php }?>

</div>

</div>

<script type="text/javascript">
$(function(){
  	//删除分享的店铺
	$("[nc_type='storedelbtn']").live('click',function(){
		var data_str = $(this).attr('data-param');
        eval( "data_str = "+data_str);
        showDialog('<?php echo $lang['nc_common_op_confirm'];?>','confirm', '', function(){
        	ajax_get_confirm('','index.php?act=member_snsindex&op=delstore&id='+data_str.sid);
			return false;
		});
	});

	//显示分享店铺页面
	$('#snssharestore').click(function(){
	    ajax_form("sharestore", '<?php echo $lang['sns_sharestore'];?>', '<?php echo SHOP_SITE_URL.DS;?>index.php?act=member_snsindex&op=sharestore', 480);
	    return false;
	});
});
</script>

<script src="http://www.shopnc.com/circle/templates/default/js/owl.carousel.js"></script>
<script>
jQuery(document).ready(function($) {

	$('.owl-carousel').owlCarousel({
		items:1,
		loop:false,
		nav:true,
		margin:13,
		info: getInfo,
		responsive:{
			600:{
				items:3
			},			
			960:{
				items:5,
				center:true
			},
			1200:{
				items:6,
				center:false
			}
		}
	});

	function getInfo(i){
		var owlInfo = i,prop,value,name;

		for(prop in owlInfo){
			if(owlInfo.hasOwnProperty(prop)){
				value = owlInfo[prop];
				name = prop;
				$('.'+name).text(value);
			}
		}
	}
});
</script>
