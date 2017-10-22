<?php defined('InShopNC') or exit('Access Invalid!');?>

	<div class="works-title">
	<?php if (!empty($output['code_sale_list']['code_info']) && is_array($output['code_sale_list']['code_info'])) { 
                    $i = 0;
                    ?>
                 
		<ul class="leadnav handover_title">
		 <?php foreach ($output['code_sale_list']['code_info'] as $key => $val) { 
                    $i++;
                    ?>
			<li class="<?php echo $i==1 ? 'on':'';?>"><?php echo $val['recommend']['name'];?></li>
			<?php } ?>
		</ul>
		 <?php } ?>
	</div>
 <?php if (!empty($output['code_sale_list']['code_info']) && is_array($output['code_sale_list']['code_info'])) { 
                    $i = 0;
                    ?>
	<div class="handover_con">
	<?php foreach ($output['code_sale_list']['code_info'] as $key => $val) { 
                    $i++;
                    ?>
    <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
		<div class="demo">
			<ul class="works-list0">
			<?php foreach($val['goods_list'] as $k => $v){ ?>
				<li>
					<a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id'])); ?>" title="<?php echo $v['goods_name']; ?>">
						<div class="worksimg">
							<img src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>" alt="<?php echo $v['goods_name']; ?>"/>
						</div>
						<h6><?php echo $v['goods_name']; ?></h6>
						<!--
						<?php echo $lang['index_index_store_goods_price'].$lang['nc_colon'];?>
						--><em><?php if($v['goods_price'] < 1){echo '咨询客服';}else{echo '<i>'."¥".($v['goods_price']).'</i>';}?></em>
					</a>
				</li>			
				<?php } ?>

			</ul>
		</div>
		
	       <?php } ?>
  <?php } ?>
		
	</div>

  <?php } ?>