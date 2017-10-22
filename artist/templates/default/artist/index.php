<?php defined('InShopNC') or exit('Access Invalid!');?>
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/slider.js"></script>

<div class="lunbotu">
<?php echo $output['web_html']['artist_index_pic'];?>


<div class="right-sidebar">
	<div class="policy">
      <h2 class="block">书画快讯<a class="more" href="/article_cate-9-1.html" target="_blank">更多&gt;</a></h2>
	  <?php if(!empty($output['GongGao'])){?>
        <ul>
			<?php foreach($output['GongGao'] as $key=>$ggao){ ?>
			<li><a href="<?php if($ggao['article_url']!='')echo $ggao['article_url'];else echo urlShop('article', 'show', array('article_id'=>$ggao['article_id']));?>" target="_blank"><?php echo $ggao['article_title'];?></a></li>
			<?php }?>
	     </ul>
		 <?php }?>
      </div>
	<?php if(!empty($output['miaosha_list'])){?>
    <div class="seckill">
         <h2 class="block">今日秒杀</h2>
        <div id="banner_tabs" class="flexslider">
            <ul class="slides">
                <?php foreach($output['miaosha_list'] as $key=>$miaosha){ ?>
                    <li>
                        <div class="secImg">
						    <?php if($miaosha['is_shipping'] == 1){?>
							<!--<div class="icon-by"></div>-->
							<?php } ?>
                            <a href="http://www.96567.com/miaosha/" target="_blank"><img src="<?php echo $miaosha['goods_image'];?>"></a>
                        </div>
                        <div class="sectext">
                            <a href="http://www.96567.com/miaosha/" target="_blank"><?php echo $miaosha['goods_name'];?></a>
                        </div>
                        <p class="gobuy"><i>¥</i><?php echo $miaosha['miaosha_price'];?></p>
                        <a class="gobtn block" href="http://www.96567.com/miaosha/" target="_blank">立即秒杀</a>
                    </li>
                <?php }?>
            </ul>
            <ul class="flex-direction-nav">
                <li><a class="flex-prev" href="javascript:;"></a></li>
                <li><a class="flex-next" href="javascript:;"></a></li>
            </ul>
        </div>
       
    </div>
      <?php } ?>


   </div>
</div>


<div class="art-works wrapper">
	<?php if(!empty($output['artist_push_list'])){?>

    <div class="yidam-lbbox">
		<div class="works-title">
			<h2 class="leadlb-right-title">艺术家</h2>
		</div>
		<div id="banner_tabs2" class="flexslider">
		    <ul class="slides">
		<?php foreach ($output['artist_push_list'] as $k => $v){?>
				<li>
					<div class="secImg">
						<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>$v['A_Id']));?>" target="_blank"><img src="/<?php echo $v['A_Img'];?>"></a>
					</div>
					<div class="sectext">
						<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>$v['A_Id']));?>" target="_blank"><?php echo $v['A_Name'];?></a>
					</div>
					<p><?php $A_ZhiCheng = @explode('|',$v['A_ZhiCheng']); echo $A_ZhiCheng[0]; ?></p>
				</li>
		<?php }?>
				
		    </ul>
		    <ul class="flex-direction-nav">
		        <li><a class="flex-prev" href="javascript:;"></a></li>
		        <li><a class="flex-next" href="javascript:;"></a></li>
		    </ul>
		</div>
    </div>
<?php } ?>

<?php echo $output['web_html']['artist_index_sale'];?>

</div>
<?php echo $output['web_html']['artist_index'];?>




<!--艺术家推荐-->
<?php echo $output['web_html']['artist_index_cany'];?>





<div class="art-ad wrapper">
<?php echo loadadv(1092);?>
</div>

<div class="art-information wrapper">
	<div class="demo">
		<h2>
			<strong>收藏问答</strong>
		</h2>
		<div class="boxes one">
		<?php if(!empty($output['artist_zixun_list'])){?>
			<ul class="exchange">
			
  <?php foreach ($output['artist_zixun_list'] as $k => $v){?>
	
				<li><a href="/tzxy/article-<?php echo $v['article_id'];?>.html" target="_blank"><?php echo $v['article_title'];?></a></li>

	
  <?php }?>
			</ul>
			
<?php }?>
		</div>
	</div>
	<div class="demo">
		<h2>
			<strong class="m-l">收藏资讯</strong>
		</h2>
		
		<div class="boxes two">
			<ul class="live-nav handover_title">
				<li class="on">行情资讯</li>
				<li>热点关注</li>
				<li>藏品知识</li>
			</ul>
			<div class="live-con handover_con">
				<div class="demo">
					<ul class="exchange">
					  <?php if(!empty($output['hqkx'])){?>
                          <?php foreach ($output['hqkx'] as $k=>$v){?>
						  <?php if($k < 5){?>
						<?php if($k==0){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
							<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                                <?php }?>
                            <?php }?>
					</ul>
					<ul class="exchange">
					<?php if(!empty($output['hqkx'])){?>
                                <?php foreach ($output['hqkx'] as $k=>$v){?>
								<?php if($k > 4){?>
                                    <?php if($k==5){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
							<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                                <?php }?>
                            <?php }?>
					</ul>					
				</div>
				<div class="demo">
					<ul class="exchange">
					 <?php if(!empty($output['rdgz'])){?>
                                <?php foreach ($output['rdgz'] as $k=>$v){?>
								 <?php if($k < 5){?>
                                    <?php if($k==0){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
							<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                          <?php }?>
                       <?php }?>
					</ul>
					<ul class="exchange">
					 <?php if(!empty($output['rdgz'])){?>
                                <?php foreach ($output['rdgz'] as $k=>$v){?>
								 <?php if($k >= 5){?>
                                    <?php if($k==5){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
								<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                          <?php }?>
                       <?php }?>
					</ul>	
				</div>
				<div class="demo">
					<ul class="exchange">
						 <?php if(!empty($output['mrbj'])){?>
                                <?php foreach ($output['mrbj'] as $k=>$v){?>
								 <?php if($k < 5){?>
                                    <?php if($k==0){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
								<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                          <?php }?>
                       <?php }?>
					</ul>
					<ul class="exchange">
						 <?php if(!empty($output['mrbj'])){?>
                           <?php foreach ($output['mrbj'] as $k=>$v){?>
							<?php if($k >= 5){?>
                              <?php if($k==5){?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank">
							<div class="img"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title'];?>" /></div>
								<h4><?php echo $v['article_title']?></h4>
							<h5><?php echo html_substr_word($v['article_content'],50).'...';?></h5>
						</a></li>
						<?php }else{?>
						<li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
						<?php }?>
						<?php }?>
                          <?php }?>
                       <?php }?>
					</ul>	
				</div>
			</div>
		</div>	
		
	</div>
	<div class="demo">
		<h2>
			<strong class="m-l">关于我们</strong>
		</h2>
		<div class="boxes three">
            <span><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/footerwechat.jpg"/></span>
            <p>扫码关注</p>
            <p>了解更多收藏资讯</p>
		</div>		
	</div>	
</div>


<script type="text/javascript">
 $(function() {
        var bannerSlider = new Slider($('#banner_tabs'), {
            time: 4000,
            delay: 400,
            event: 'hover',
            auto: true,
            mode: 'fade',
            controller: $('#bannerCtrl'),
            activeControllerCls: 'active'
        });
        $('#banner_tabs .flex-prev').click(function() {
            bannerSlider.prev()
        });
        $('#banner_tabs .flex-next').click(function() {
            bannerSlider.next()
        });
    })
    $(function() {
        var bannerSlider = new Slider($('#banner_tabs2'), {
            time: 7000,
            delay: 400,
            event: 'hover',
            auto: true,
            mode: 'fade',
            controller: $('#bannerCtrl2'),
            activeControllerCls: 'active'
        });
        $('#banner_tabs2 .flex-prev').click(function() {
            bannerSlider.prev()
        });
        $('#banner_tabs2 .flex-next').click(function() {
            bannerSlider.next()
        });
    })
$(function(){

    $(".lunbotu").lunbotu({

    });

})
</script>