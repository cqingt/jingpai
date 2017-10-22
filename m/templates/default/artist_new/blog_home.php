
	        <div class="blogs-intro-con">
	        	<h1><?php echo $output['artist_info']['A_Name'];?>简介</h1>
	        	<div class="content"  style="text-indent:25px;">
					<?php echo html_entity_decode($output['artist_info']['A_MiaoShu']);?>
                </div>
                <div class="switch unfold ui-border-t">展开全部</div>
            </div>

			<?php if(!empty($output['goods_list'])){?>
            <div class="blogs-title pb">
            	<h2>作品推荐</h2>
            	<a class="ui-icon-arrow" href="<?php echo urlWap('artist_blog','zuoping',array('aid'=>$_GET['aid']));?>">更多</a>
            </div>
            
            <div class="demo-item">
				<ul class="home-shopboxes">
					<?php foreach($output['goods_list'] as $key => $val){?>
						<li>
							<a href="<?php echo urlWap('goods','index',array('goods_id'=>$val['goods_id']));?>" target="_blank">
								<div class="photo">
									<i class="img" style="background: url(<?php echo cthumb($val['goods_image'],360);?>);"></i>
								</div>
								<h2 class="ui-nowrap-multi"><?php echo $val['goods_name'];?></h2>
								<p class="ui-border-t"><em><?php echo ($val['goods_price'] < 1)?"价格：咨询客服":'¥'.intval($val['goods_price'])?></em></p>
							</a>
						</li>
					<?php }?>
				</ul>
			</div>
			<?php }?>


			<?php if(!empty($output['zixun_info'])){?>
			<div class="blogs-title mt-10">
            	<h2>艺术资讯</h2>
            	<a class="ui-icon-arrow" href="<?php echo urlWap('artist_blog','zixun',array('aid'=>$_GET['aid']));?>">更多</a>
            </div>
            
            <div class="blogs-artinfo">
				<ul class="ui-list ui-border-b">
					<?php foreach($output['zixun_info'] as $k => $v){?>
						<li class="ui-border-t" data-href="<?php echo urlWap('artist_new','artist_default',array('article_id'=>$v['article_id']))?>">
							<div class="ui-list-img">
								<span style="background-image:url(<?php echo $v['N_Img_Url'];?>)"></span>
							</div>
							<div class="ui-list-info">
								<h4 class="ui-nowrap-multi"><?php echo $v['article_title'];?></h4>
								<p class="ui-nowrap"><strong>作者：<?php echo $v['article_author']?></strong><time><?php echo date("Y-m-d",$v['article_publish_time']);?></time></p>
							</div>
						</li>
					<?php }?>
				</ul>
            </div>
			<?php }?>

			<?php if(!empty($output['artist_img_list'])){?>
            <div class="blogs-title pb">
            	<h2>艺术相册</h2>
            	<a class="ui-icon-arrow" href="<?php echo urlWap('artist_blog','xiangce',array('aid'=>$_GET['aid']));?>">更多</a>
            </div>
            
            <div class="demo-item">
				<ul class="blogs-album-art">
					<?php foreach($output['artist_img_list'] as $k => $v){?>
					<li class="ui-border">
						<div class="photo">
							<i class="img" style="background: url(<?php echo BASE_SITE_URL . '/'.$v['I_ImgXC'];?>);"></i>
						</div>
						<h2 class="ui-nowrap"><?php echo $v['I_Name'];?></h2>
					</li>
					<?php }?>
				</ul>
			</div>
			<?php }?>
        </section>