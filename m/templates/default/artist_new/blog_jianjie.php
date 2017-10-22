<?php defined('InShopNC') or exit('Access Invalid!');?>
	<div class="blogs-intro-con">
		<h1><?php echo $output['artist_info']['A_Name'];?>简介</h1>
		<div class="txtcon" style="text-indent:25px;">
			<?php echo html_entity_decode($output['artist_info']['A_MiaoShu']);?>
	   </div>
		<h1>履历</h1>
		<div class="txtcon">
			<?php echo html_entity_decode($output['artist_info']['A_ShenYa']);?>
		</div>
	</div>
</section>