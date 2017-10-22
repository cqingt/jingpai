<?php defined('InShopNC') or exit('Access Invalid!');?>
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/component.css" />
	<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/flickerplate.css">


<!--Required libraries-->
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/hammer-v2.0.3.min.js" type="text/javascript"></script>

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/flickerplate.min.js" type="text/javascript"></script>
	
	<!--Execute flickerplate-->
	<script>
	$(function(){
		$('.flicker-example').flickerplate(
		{
            auto_flick 				: true,
            auto_flick_delay 		: 8,
            flick_animation 		: 'transform-slide'
        });
	});
	</script>
	</script>
	<!-- flickerplate e-->
  <header class="home-header">
<!-- 		 	 <a href=""><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <a>收藏学院·文章分类</a>
		 	 <a href=""><i class="fa fa-bars fa-lg"></i></a> -->

		 	 <a href="<?php echo urlWap('tzxy','index'); ?>"><i class="icon-logo"></i>收藏学院</a>
		 	 <a></a>
		 	 <a href="<?php echo urlWap('index','index'); ?>"><i class="icon-mall"></i><em>商城</em></a>
		  </header>

		  <article class="demo">
		  	 <div class="navhome">
		  	 	  <ul>
		  	 	  	 <li class="on"><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'19'));?>">最新动态</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'39'));?>">藏市热点</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'53'));?>">发行公告</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'20'));?>">行情快讯</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'40'));?>">专家观点</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'57'));?>">藏品知识</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'56'));?>">拍卖结果</a></li>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'42'));?>">藏品赏析</a></li>
					 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'55'));?>">书法字画</a></li>
		  	 	  </ul>
		  	 	  <a class="angle-down" href="javascript:;"><i class="fa fa-angle-down fa-lg"></i></a>
		  	 </div> 

			 <!-- Shuffling figure  js-min -->
			 <div class="flicker-example">
			      <ul>
				  <?php if(!empty($output['lbtw'])){?>
                        <?php foreach ($output['lbtw'] as $k=>$v){?>
			        <li>
			            <a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></a>
			        </li>
					<?php }?>
                    <?php }?>
			      </ul>
			 </div>

		  	 <div class="home-article mb14">
		  	 	  <ul>
				  <?php if(!empty($output['tjwz'])){?>
                        <?php foreach ($output['tjwz'] as $k=>$v){?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title'];?></h1>
			  	 	  	   <p><?php echo html_substr_word($v['article_content'],100).'...';?></p>
		  	 	  	 	</a>
		  	 	  	 </li>

				 <?php }?>
                <?php }?>
		  	 	  	 
		  	 	  </ul>
		  	 </div>

		  	 <div class="home-list mb14">
		  	 	  <h2>最新<em>动态</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'19'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['zxdt'])){?>
                     <?php foreach ($output['zxdt'] as $k=>$v){?>
						<?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
								<?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
								<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
                     <?php }?>
		  	 	  	 
		  	 	  </ul>
		  	 </div>

		  	 <div class="home-list">
		  	 	  <h2>藏市<em>热点</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'39'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['csrd'])){?>
                        <?php foreach ($output['csrd'] as $k=>$v){?>
						<?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
                   <?php }?>
		  	 	  	
		  	 	  </ul>
		  	 </div>
            <?php $getadvImg = getadvImg(1083);?>
             <div class="home-adimg no-mb">
             	  <a href="<?php echo $getadvImg['Href']?>"><img src="<?php echo $getadvImg['Img']?>" alt=""></a>
             </div>
           
		  	 <div class="home-list mb14">
		  	 	  <h2>发行<em>公告</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'53'));?>">更多></a></h2>
		  	 	  <ul>
				   <?php if(!empty($output['fxgg'])){?>
                    <?php foreach ($output['fxgg'] as $k=>$v){?>
					<?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
						   <?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
                <?php }?>
		  	 	  </ul>
		  	 </div>

		  	 <div class="home-list mb14">
		  	 	  <h2>行情<em>快讯</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'20'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['hqkx'])){?>
				   <?php foreach ($output['hqkx'] as $k=>$v){?>
				   <?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					  <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					<?php }?>
					<?php }?>
                <?php }?>
		  	 	  </ul>
		  	 </div>
			 <!--
		  	 <div class="home-list">
		  	 	  <h2>投资<em>分析</em><a href="">更多></a></h2>
		  	 	  <ul>
		  	 	  	 <li>
		  	 	  	 	<a href="">
			  	 	  	   <h1>航天纪念币钞价格已经翻了一番</h1>
			  	 	  	   <div class="home-imagetext">
                                <div class="homeimage"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/images/1.jpg" alt=""></div>
			  	 	  	 	    <p class="hometext">自11月26日中国人民银行发行航天纪念币钞以来，一直备受市民的热烈追捧，中国银行甘肃分行的网点天天排长队等待兑换。但一些...</p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  	 <li><a href="">航天纪念币钞价格已经翻了一番</a></li>
		  	 	  </ul>
		  	 </div>
			 -->
			<?php $getadvImg = getadvImg(1084);?>
             <div class="home-adimg">
             	  <a href="<?php echo $getadvImg['Href']?>"><img src="<?php echo $getadvImg['Img']?>" alt=""></a>
             </div>

		  	 <div class="home-list mb14">
		  	 	  <h2>专家<em>观点</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'40'));?>">更多></a></h2>
		  	 	  <ul>
				   <?php if(!empty($output['zjgd'])){?>
				   <?php foreach ($output['zjgd'] as $k=>$v){?>
				   <?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
					 <?php }?>
		  	 	  </ul>
		  	 </div>

		  	 <div class="home-list mb14">
		  	 	  <h2>藏品<em>知识</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'57'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['scfg'])){?>
                     <?php foreach ($output['scfg'] as $k=>$v){?>
					 <?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					<?php }?>
                   <?php }?>
		  	 	  </ul>
		  	 </div>

		  	 <div class="home-list">
		  	 	  <h2>拍卖<em>结果</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'56'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['hqkx'])){?>
				   <?php foreach ($output['pmjg'] as $k=>$v){?>
				   <?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
					<?php }?>
		  	 	  	 
		  	 	  </ul>
		  	 </div>
			<?php $getadvImg = getadvImg(1085);?>
             <div class="home-adimg">
				  <a href="<?php echo $getadvImg['Href']?>"><img src="<?php echo $getadvImg['Img']?>" alt=""></a>
             </div>

		  	 <div class="home-list mb14 no-pa">
		  	 	  <h2>藏品<em>赏析</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'42'));?>">更多></a></h2>
                  <ol>
				  <?php if(!empty($output['cpsx'])){?>
                    <?php foreach ($output['cpsx'] as $k=>$v){?>
                  	<li>
						<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
                  		<div class="product-map"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" alt="<?php echo $v['article_title']?>"></div>
                  		<p><?php echo $v['article_title']?></p>
						</a>
                  	</li>
					<?php }?>
                <?php }?>

                  </ol>
		  	 </div>

		  	 <div class="home-list">
		  	 	  <h2>书法<em>字画</em><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'55'));?>">更多></a></h2>
		  	 	  <ul>
				  <?php if(!empty($output['sfzh'])){?>
                       <?php foreach ($output['sfzh'] as $k=>$v){?>
					   <?php if($k == 0){ ?>
		  	 	  	 <li>
		  	 	  	 	<a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>">
			  	 	  	   <h1><?php echo $v['article_title']?></h1>
			  	 	  	   <div class="home-imagetext">
						   <?php if($v['article_image']){ ?>
                                <div class="homeimage"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>"></div>
							<?php } ?>
			  	 	  	 	    <p class="hometext"><?php echo html_substr_word($v['article_content'],100).'...';?></p>
			  	 	  	   </div>
		  	 	  	 	</a>
		  	 	  	 </li>
					 <?php }else{ ?>
		  	 	  	 <li><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a></li>
					 <?php }?>
					 <?php }?>
                    <?php }?>
		  	 	  </ul>
		  	 </div>
<?php

$array['P']['title'] = '收藏天下投资学院，为藏友提供最新收藏品投资动态、投资行情、投资新闻';
$array['P']['imgUrl'] = 'http://m.96567.com/images/logo.png';
$array['Y']['title'] = '收藏天下投资学院，为藏友提供最新收藏品投资动态、投资行情、投资新闻';
$array['Y']['desc'] = $output['seo_description'];
$array['Y']['imgUrl'] = 'http://m.96567.com/images/logo.png';

echo weixinShare($array);

?>