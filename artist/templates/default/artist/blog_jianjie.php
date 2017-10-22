<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="course-nav-hd wrapper mtb-course">
	<h2><?php echo $output['artist_info']['A_Name'];?>简介</h2> 
</div>

<div class="intro-boxes wrapper">
	<div class="appellation-con">

<?php if(!empty($output['artist_info']['array_zhicheng'])){?>
	<?php foreach ($output['artist_info']['array_zhicheng'] as $k => $v){?>

		<span><?php echo $v;?></span>

	<?php }?>
<?php }?>

	</div>
	<div class="individual-resume-con">
		<div class="ind-l-img">
			<img src="/<?php echo $output['artist_info']['A_Img'];?>"/>
		</div>
		<div class="ind-r-con">
			<?php echo html_entity_decode($output['artist_info']['A_MiaoShu']);?>
		</div>
	</div>
</div>

<div class="course-nav-hd wrapper mtb-chr">
	<h2>艺术家年表</h2> 
</div>

<div class="chronology-con wrapper">

	
	<div class="chr-l">
		<ul class="chr-list">
			<?php echo html_entity_decode($output['artist_info']['A_ShenYa']);?>
		</ul>
	</div>



<?php if(!empty($output['artist_img_list'])){?>


<div class="chr-r">
		<div id="turn" class="turn two">
			<div class="turn-loading"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/loading_comment.gif" /></div>
			<ul class="turn-pic">
<?php foreach($output['artist_img_list'] as $k => $v){?>
		        <li><a href="<?php echo urlArtist('artist_blog','xiangce',array('aid'=>$_GET['aid']));?>"><img src="/<?php echo $v['I_ImgXC'];?>" title="<?php echo $v['I_Name'];?>" /></a></li>
<?php }?>
		    </ul>
		</div>
       
	</div>

        <script src="<?php echo SHOP_TEMPLATES_URL;?>/js/owl.turn.js"></script>	
		<script type="text/javascript">
		$(function(){

			$("#temp").Slide({
				effect : "scroolLoop",
				autoPlay:false,
	 
				timer : 3000,
				steps:2
			});
		 
		});
		</script>       

<?php }?>



</div>
