<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="art-works wrapper">
	<div class="works-title">
	<?php if ($output['code_tit']['code_info']['type'] == 'txt') { ?>
		<h2 title="<?php echo $output['code_tit']['code_info']['title'];?>"><?php echo $output['code_tit']['code_info']['title'];?></h2>
		<?php }else { ?>
		<h2><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_tit']['code_info']['pic'];?>"/></h2>
	<?php } ?>
		<ul class="handover_title">
			 <?php if (!empty($output['code_recommend_list']['code_info']) && is_array($output['code_recommend_list']['code_info'])) {
                    $i = 0;
                    ?>
                  <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) {
                    $i++;
                    ?>

			<li class="<?php echo $i==1 ? 'on':'';?>"><?php echo $val['recommend']['name'];?></li>
			<?php } ?>
           <?php } ?>
		</ul>
	</div>
	
	<div class="thebox">
		<div class="yidam-navbox">
		  <?php
    if($output['code_category_list']['code_html']){
		echo $output['code_category_list']['code_html'];
	}else{
	?>
			<ul class="ulnav">
				<?php if (is_array($output['code_category_list']['code_info']['goods_class']) && !empty($output['code_category_list']['code_info']['goods_class'])) { ?>
		             <?php foreach ($output['code_category_list']['code_info']['goods_class'] as $k => $v) { ?>
					<li><a href="<?php echo urlShop('search','index',array('cate_id'=> $v['gc_id']));?>" title="<?php echo $v['gc_name'];?>" target="_blank"><?php echo $v['gc_name'];?></a></li>
				 <?php } ?>
              <?php } ?>
			</ul>
			<?php } ?>

<?php if(!empty($output['code_act']['code_info']['pic'])) { ?>
			<a class="firstshop" href="<?php echo $output['code_act']['code_info']['url'];?>" title="<?php echo $output['code_act']['code_info']['title'];?>" target="_blank">
			<!--
				<p><strong>杨总胜</strong>《人生易老》8平尺</p>
			-->
				<div><img src="<?php  echo UPLOAD_SITE_URL.'/'.$output['code_act']['code_info']['pic'];?>" alt="<?php echo $output['code_act']['code_info']['title']; ?>"></div>
			</a>
<?php } ?>
		</div>
		
		<div class="works-con handover_con">
		<?php if (!empty($output['code_recommend_list']['code_info']) && is_array($output['code_recommend_list']['code_info'])) {
                    $i = 0;
                    ?>
        <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) {
                    $i++;
                    ?>
				<?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
				
				<div class="demo">
				<ul class="works-list1">
				<?php foreach($val['goods_list'] as $k => $v){ ?>
					<li>
						<a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=> $v['goods_id'])); ?>" title="<?php echo $v['goods_name']; ?>">
							<div class="worksimg">
								<img src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>" alt="<?php echo $v['goods_name']; ?>" />
							</div>
							<h6><?php echo $v['goods_name']; ?></h6>
							<em><?php echo "¥".($v['goods_price']); ?></em>
						</a>
					</li>	
					<?php } ?>
					
				</ul>
			</div>

				 <?php } elseif (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
			<div class="demo">
				<ul class="collect-list">					
					<li>
						<a href="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>" alt="<?php echo $val['pic_list']['12']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['12']['pic_name'];?></h2>
							
							<em><?php echo $val['pic_list']['12']['pic_price'] == ''? '' : "¥".($val['pic_list']['12']['pic_price']);?></em>
						</div>
					</li>
					<li class="large">
						<a href="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>" alt="<?php echo $val['pic_list']['11']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['11']['pic_name'];?></h2>
							<em><?php echo $val['pic_list']['11']['pic_price'] == ''? '' : "¥".($val['pic_list']['11']['pic_price']);?></em>
						</div>	
					</li>
					<li class="small">
						<a href="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>" alt="<?php echo $val['pic_list']['21']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['21']['pic_name'];?></h2>
							<em><?php echo $val['pic_list']['21']['pic_price'] == ''? '' :  "¥".($val['pic_list']['21']['pic_price']);?></em>
						</div>				
					</li>
					<li>
						<a href="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>" alt="<?php echo $val['pic_list']['24']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['24']['pic_name']; ?></h2>
							<em><?php echo $val['pic_list']['24']['pic_price'] == '' ? '' : "¥".($val['pic_list']['24']['pic_price']);?></em>
						</div>		
					</li>	
					<li>
						<a href="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>" alt="<?php echo $val['pic_list']['14']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['14']['pic_name'];?></h2>
							<em><?php  echo $val['pic_list']['14']['pic_price'] == ''? '' : "¥".($val['pic_list']['14']['pic_price']);?></em>
						</div>		
					</li>
					<li class="finally">
						<a href="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>" alt="<?php echo $val['pic_list']['32']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['32']['pic_name'];?></h2>
							<em><?php echo $val['pic_list']['32']['pic_price'] == ''? '' : "¥".($val['pic_list']['32']['pic_price']);?></em>
						</div>		
					</li>
					<li>
						<a href="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" target="_blank">
							<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>" alt="<?php echo $val['pic_list']['31']['pic_name'];?>">
						</a>
						<div class="suspend">
							<h2><?php echo $val['pic_list']['31']['pic_name'];?></h2>
							<em><?php echo $val['pic_list']['31']['pic_price'] == ''? '' : "¥".($val['pic_list']['31']['pic_price']);?></em>
						</div>	
					</li>			
				</ul>
			</div>
			<?php } ?>
		<?php } ?>
       <?php } ?>
			
		</div>
	</div>
</div>
