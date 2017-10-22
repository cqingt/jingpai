<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="blogs-home-first wrapper">
	<div class="con-l">
		<div class="course-nav-hd mtb-course">
			<h2><?php echo $output['artist_info']['A_Name'];?>简介</h2> 
			
		</div>		
		<div class="intro-boxes">
			<div class="appellation-con">

<?php if(!empty($output['artist_info']['array_zhicheng'])){?>
	<?php foreach ($output['artist_info']['array_zhicheng'] as $k => $v){?>

		<span><?php echo $v;?></span>

	<?php }?>
<?php }?>

			</div>
			<div class="individual-resume-con">
				<div class="ind-r-con">

					<?php echo html_entity_decode($output['artist_info']['A_MiaoShu']);?><a class="btn-more" href="">...更多</a>
					
				</div>
			</div>
		</div>		
	</div>
	<div class="con-r">
		<div class="course-nav-hd mtb-course">
			<h2>艺术家年表</h2> 
			<!-- <a class="btn-more" href="">更多</a> -->
		</div>				
		<ul class="chr-list">
						<?php echo html_entity_decode($output['artist_info']['A_ShenYa']);?>
		</ul>		
	</div>
</div>



<?php if(!empty($output['goods_list'])){?>

<div class="blogs-home-second">
	<div class="wrapper">
		<div class="course-nav-hd mtb-home">
			<h2>推荐作品</h2> 
			<a class="btn-more" href="<?php echo urlShop('artist_blog','zuoping',array('aid'=>$_GET['aid']));?>">更多</a>
		</div>		
		<ul class="works-list1">


<?php foreach($output['goods_list'] as $k => $v){?>
	

			<li <?php if($k < 1){echo 'style="margin: 0px;"';}?>>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<div class="worksimg">
						<img src="<?php echo cthumb($v['goods_image'],360);?>">
					</div>
					<h2><?php echo $v['goods_name'];?></h2>
					<h5><?php echo $output['artist_info']['A_Name'];?></h5>
					<h6><?php echo $output['artist_info']['array_zhicheng'][0];?></h6>
					<em><?php echo ncPriceFormatForList($v['goods_price']);?></em>
				</a>
			</li>

<?php }?>

			
		</ul>		
	</div>
</div>

<?php }?>



<?php if(!empty($output['zixun_info'])){?>

<div class="blogs-home-fourthly wrapper">
	<div class="course-nav-hd mtb-home">
		<h2>艺术资讯</h2> 
		<a class="btn-more" href="<?php echo urlShop('artist_blog','zixun',array('aid'=>$_GET['aid']));?>">更多</a>
	</div>		
    <ul class="consult home mt2">

<?php foreach($output['zixun_info'] as $k => $v){?>

    	<li>
    		<a href="/tzxy/article-<?php echo $v['article_id'];?>.html" target="_blank">
	    		<div class="con-l">
	    			<img src="<?php echo $v['N_Img_Url'];?>"/>
	    		</div>
	    		<div class="con-r">
	    			<h2 class="ui-nowrap"><?php echo $v['article_title'];?></h2>
	    			<h5><em><?php echo date("Y-m-d H:i:s",$v['article_publish_time']);?></em><strong></strong></h5>
	    			<p class="ui-nowrap-two"><?php echo $v['N_Content'];?></p>
	    			<h6>查看更多</h6>
	    		</div>
    		</a>
    	</li>

<?php }?>
   	
    </ul>	
</div>

<?php }?>




<?php if(!empty($output['artist_img_list'])){?>

<div class="blogs-home-fifth">
	<div class="wrapper">
		<div class="course-nav-hd mtb-home">
			<h2>艺术相册</h2> 
			<a class="btn-more" href="<?php echo urlShop('artist_blog','xiangce',array('aid'=>$_GET['aid']));?>">更多</a>
		</div>		
    <ul class="celebrity two mt">


<?php foreach($output['artist_img_list'] as $k => $v){?>

        <li>
          <a>
             <div class="celimg">
             	<img src="/<?php echo $v['I_ImgXC'];?>"/>
             </div>       
			<div class="suspend">
				<h2><?php echo $v['I_Name'];?></h2>
			</div>             
          </a>
        </li> 

<?php }?>
     
    </ul>
	</div>
</div>

<?php }?>