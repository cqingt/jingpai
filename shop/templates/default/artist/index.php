<?php defined('InShopNC') or exit('Access Invalid!');?>

<!-- 首页轮播 -->

<div class="lunbotu">
  <ul class="lunbotu_box">


<?php if(!empty($output['artist_index_adv_list'])){?>
  <?php foreach ($output['artist_index_adv_list'][0]['code_info'] as $k => $v){?>
	
<li><a href="<?php echo $v['pic_url'];?>" target="_blank" style="background:url(<?php echo UPLOAD_SITE_URL."/".$v['pic_img'];?>) center top no-repeat"></a></li>

  <?php }?>
<?php }?>


  </ul>
</div>
<script type="text/javascript">
	$(function(){
	
	    $(".lunbotu").lunbotu({
	
	    });
	
	})
</script>




<?php if(!empty($output['artist_push_list'])){?>


<div class="art-home-headline wrapper m-t4">
	<h2><strong>艺术家推荐</strong><em>ARTISTS</em></h2>
	<a href="<?php echo urlShop('artist_new','searchArtist');?>" target="_blank">更多</a>
</div>

<div class="owl2">
	<div class="wrapper">
		<div id="owl-demo2" class="owl-carousel artists-carousel">

<?php foreach ($output['artist_push_list'] as $k => $v){?>

<div class="item"><img class="lazyOwl" data-src="/<?php echo $v['A_Img'];?>" alt="">
	<a href="<?php echo urlShop('artist_blog','index',array('aid'=>$v['A_Id']));?>" class="message" target="_blank">
		<h2><?php echo $v['A_Name'];?></h2>
		<p><?php echo $v['A_MiaoShu'];?></p>
		<span><i></i><i></i><i></i></span>
	</a>
</div>

<?php }?>


		</div>		
	</div>

	<script>
	$(function(){
		$('#owl-demo2').owlCarousel({
			items: 5,
			lazyLoad: true,
			navigation: true,
			navigationText: ["",""]
		});
	});
	</script>
</div>

<?php }?>



<?php if(!empty($output['web_list'])){?>
  <?php foreach ($output['web_list'] as $k => $v){?>
	
	<?php if($v['web_sort'] <= 1){?>

      <?php echo $v['web_html'];?>

    <?php break;}?>
  <?php }?>
<?php }?>



<div class="art-ad wrapper">
	<?php echo loadadv(1091);?>
</div>


<!-- 作品内容 -->


<?php if(!empty($output['web_list'])){?>
  <?php foreach ($output['web_list'] as $k => $v){?>
	
	<?php if($v['web_sort'] > 1){?>

      <?php echo $v['web_html'];?>

      <?php }?>
  <?php }?>
<?php }?>



<!-- 底部艺术资讯 -->


<div class="art-ad wrapper">
	<?php echo loadadv(1092);?>
</div>




<div class="art-homebelow-title wrapper">
	<h2>艺术资讯</h2>
</div>

<div class="art-information wrapper mb4">
	<div class="demo">
		<h2>
			<strong>艺术交流</strong>
			<em>Art Exchange</em>
		</h2>
		<div class="boxes one">
			<ul class="exchange">


<?php if(!empty($output['artist_zixun_list'])){?>
  <?php foreach ($output['artist_zixun_list'] as $k => $v){?>
	
	<li><a href="/tzxy/article-<?php echo $v['article_id'];?>.html" target="_blank"><?php echo $v['article_title'];?></a></li>

  <?php }?>
<?php }?>
				


			</ul>
		</div>
	</div>


	<div class="demo">
		<h2>
			<strong>艺术生活</strong>
			<em>Art of life</em>
		</h2>
		<div class="boxes two">
			<div id="turn" class="turn">
				<div class="turn-loading"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/loading_comment.gif" /></div>
				<ul class="turn-pic">


    <?php foreach($output['artist_img_list'] as $k => $v){?>

		<li><a href="<?php echo urlShop('artist_blog','xiangce',array('aid'=>$_GET['I_ArtistId']));?>"><img src="/<?php echo $v['I_ImgXC'];?>" title="<?php echo $v['I_Name'];?>" /></a></li>

    <?php }?>

			    </ul>
			</div>
            <script src="<?php echo SHOP_TEMPLATES_URL;?>/js/owl.turn.js"></script>				
		</div>		
	</div>



	<div class="demo">
		<h2>
			<strong>关于我们</strong>
			<em>About us</em>
		</h2>
		<div class="boxes three">
            <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/footerwechat.jpg"/>
            <p>扫码关注</p>
            <p>了解更多收藏资讯</p>
		</div>		
	</div>	
</div>

