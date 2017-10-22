<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php
if (!empty($output['code_recommend_list']) && is_array($output['code_recommend_list'])) {
$val = $output['code_recommend_list']['code_info'][1];
?>
<div class="art-works wrapper">
    
    <div class="art-title"><span>艺术家推荐</span></div>
 
    <div class="art-box-rec">
		<ul class="collect-list">	
			<li>
				<a href="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>" alt="<?php echo $val['pic_list']['11']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['11']['pic_name'];?></h2>
					<!--
					<em>中国美协协会艺术家</em>
					-->
				</div>
			</li>
			<li>
				<a href="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>" alt="<?php echo $val['pic_list']['12']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['12']['pic_name'];?></h2>
				</div>
			</li>
			<li>
				<a href="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>" alt="<?php echo $val['pic_list']['21']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['21']['pic_name'];?></h2>
				</div>
			</li>
			<li>
				<a href="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>" alt="<?php echo $val['pic_list']['31']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['31']['pic_name'];?></h2>
				</div>
			</li>

			<li>
				<a href="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>" alt="<?php echo $val['pic_list']['32']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['32']['pic_name'];?></h2>
				</div>
			</li>

			<li>
				<a href="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>" alt="<?php echo $val['pic_list']['14']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['14']['pic_name'];?></h2>
				</div>
			</li>

			<li>
				<a href="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>" alt="<?php echo $val['pic_list']['24']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['24']['pic_name'];?></h2>
				</div>
			</li>

			
			<li>
				<a href="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>" alt="<?php echo $val['pic_list']['34']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['34']['pic_name'];?></h2>
				</div>
			</li>

			<li>
				<a href="<?php echo $val['pic_list']['33']['pic_url'];?>" title="<?php echo $val['pic_list']['33']['pic_name'];?>" target="_balnk">
					<img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];?>" alt="<?php echo $val['pic_list']['33']['pic_name'];?>"/>
				</a>
				<div class="suspend0">
					<div class="bj"></div>
					<h2><?php echo $val['pic_list']['33']['pic_name'];?></h2>
				</div>
			</li>
			
		</ul>
    </div>
 
 
</div>
<?php
}
?>