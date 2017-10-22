<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="blogs-home-first wrapper">
	<div class="con-l">
		<div class="course-nav-hd mtb-course">
			<h2><?php echo $output['artist_info']['A_Name'];?>简介</h2> 
			<a class="btn-more" href="index.php?act=artist_blog&op=jianjie&aid=<?php echo $output['artist_info']['A_Id'];?>">更多></a>
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

					<?php echo html_entity_decode($output['artist_info']['A_MiaoShu']);?>
					
				</div>
				
			</div>
		</div>		
	</div>
	<div class="con-r">
		<div class="course-nav-hd mtb-course">
			<h2>艺术家年表</h2> 
			<a class="btn-more" href="index.php?act=artist_blog&op=jianjie&aid=<?php echo $output['artist_info']['A_Id'];?>">更多></a>
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
			<a class="btn-more" href="<?php echo urlArtist('artist_blog','zuoping',array('aid'=>$_GET['aid']));?>">更多></a>
		</div>		
		<ul class="works-list2">


<?php foreach($output['goods_list'] as $k => $v){?>
	

			<li <?php if($k < 1){echo 'style="margin: 0px;"';}?>>
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
					<div class="worksimg">
						<img src="<?php echo cthumb($v['goods_image'],360);?>">
					</div>
					<h6><?php echo $v['goods_name'];?></h6>
					<!--
					<h5><?php echo $output['artist_info']['A_Name'];?></h5>
					<h6><?php echo $output['artist_info']['array_zhicheng'][0];?></h6>
					-->
						<strong>
					<?php if(intval($v['promotion_price']) > 0){ ?>
							<?php echo ncPriceFormatForList($v['promotion_price']);?>
					<?php }else{ ?> 
						<?php if($v['goods_price'] > 0){ ?>
							<?php echo ncPriceFormatForList($v['goods_price']);?>
						<?php }else{ ?>
							价格：咨询客服
						<?php } ?>
						</strong>
					<?php } ?>			</a>
					<i class="icon-chat" onclick="NTKF.im_openInPageChat('sc_1022_9999')"
></i>

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
		<a class="btn-more" href="<?php echo urlArtist('artist_blog','zixun',array('aid'=>$_GET['aid']));?>">更多></a>
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
	    			<h5><em><?php echo date("Y-m-d",$v['article_publish_time']);?></em><strong></strong></h5>
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


<div class="course-nav-hd wrapper mtb-course">
	<h2>艺术相册</h2> 
</div>

<div class="wrapper mt10">
    <ul class="celebrity two">

    <?php foreach($output['artist_img_list'] as $k => $v){?>

        <li>
          <a>
             <div class="celimg">
             	<img src="/<?php echo $v['I_ImgXC'];?>"/>
             </div>
             <h2 class="ui-nowrap"><?php echo $v['I_Name'];?></h2>
          </a>
        </li>  

    <?php }?>

    </ul>
    
    <div class="pagination ptb16">
    	<?php echo $output['show_page'];?>
    </div>
</div>

<?php }?>