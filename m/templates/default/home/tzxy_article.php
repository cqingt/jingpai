<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/css/component.css" />
 <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/tzxy/js/custom.js"></script>
 <header>
 <a href="<?php echo urlWap('tzxy','index'); ?>"><i class="fa fa-angle-left fa-lg"></i></a>
 <a><?php echo $output['tzxy_title'];?></a>
 <a id="hea-btn" href="javascript:;"><i class="fa fa-bars fa-lg"></i></a>
</header>

<div class="navhome navhome-two">
  <ul>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'19'));?>">最新动态</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'39'));?>">藏市热点</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'53'));?>">发行公告</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'20'));?>">行情快讯</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'40'));?>">专家观点</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'57'));?>">藏品知识</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'56'));?>">拍卖结果</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'42'));?>">藏品赏析</a></li>
	 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>'55'));?>">书法字画</a></li>
  </ul>
</div> 

<article class="demo">
 <!-- section s -->
 <section class="section">
	<h1><?php echo $output['article_detail']['article_title'];?></h1>
	<time><?php echo date('Y/m/d',$output['article_detail']['article_publish_time']);?><strong>出处：<a href="http://m.96567.com/scxy.html"><?php echo empty($output['article_detail']['article_author'])?$lang['cms_text_guest']:$output['article_detail']['article_author'];?></a></strong></time>
	<div class="word">
		<?php echo $output['article_detail']['article_content'];?>
	</div>
	<div class="two-dimension">
		 <img src="/templates/default/images/two-dimension.jpg" alt="">
	</div>
	<!--
	<?php if(!empty($output['article_detail']['article_keyword'])) { ?>
	<div class="keyword">关键字：
          <?php $article_keyword_array = explode(',', $output['article_detail']['article_keyword']);?>
          <?php foreach ($article_keyword_array as $value) {?>
			<a><?php echo $value;?></a>
		  <?php } ?>
		  
	</div>
		  <?php } ?>
		  
	-->
 </section>
 <!-- section e -->

<!--  <div class="article-comment">
	  <h2>热门<em>评论</em></h2>
	  <a href="<?php echo urlWap('tzxy','tzxy_comment_detail',array('aid'=>$output['article_obj_id']));?>">
		 <i class="fa fa-pencil-square-o fa-lg"></i>我来说两句
	  </a>
 </div>
 <div class="comment">
	  <ul>
	  <?php if(!empty($output['comment_list']) && is_array($output['comment_list'])){ ?>
	  <?php foreach($output['comment_list'] as $value){ ?>
		 <li>
			<div class="com-img">
				 <i><img src="<?php echo getMemberAvatar($value['member_avatar']);?>" alt="<?php echo $value['member_name'];?>"></i>
			</div>
			<div class="com-word">
				 <h4><?php echo $value['member_name'];?></h4>
				 <strong>收藏天下网友 <time>发表于<?php echo date('Y-m-d H:i:s',$value['comment_time']);?></time></strong>
				 <p><?php echo $value['comment_message'];?></p>
			</div>
		 </li>
		  <?php } ?>
		<?php } ?>
	  </ul>
	  <a class="functional-box" href="<?php echo urlWap('tzxy','tzxy_comment_detail',array('aid'=>$output['article_obj_id']));?>">查看全部<?php echo $output['article_detail']['article_comment_count']; ?>条评论</a>
 </div> -->

 <div class="home-list no-fi">
	  <h2>精彩<em>推荐</em></h2>
	  <?php if(!empty($output['article_commend_list']) && is_array($output['article_commend_list'])) {?>
	  <ul>
		<?php foreach($output['article_commend_list'] as $value) {?>
		 <li><a href="<?php echo urlWap('tzxy','tzxy_list',array('class_id'=>$value['class_id']));?>">[<?php echo $value['class_name'];?>]</a><a href="<?php echo urlWap('tzxy','tzxy_article',array('article_id'=>$value['article_id']));?>"><?php echo $value['article_title'];?></a></li>
		<?php } ?>
	  </ul>
	  <?php } ?>
 </div>

<!--<?php $getadvImg = getadvImg(1079);?>
 <div class="home-adimg">
	  <a href="<?php echo $getadvImg['Href']?>"><img src="<?php echo $getadvImg['Img']?>" alt=""></a>
 </div>-->
 <?php $getadvImg = getadvImg(1087);?>
 <div class="home-adimg">
	  <a href="<?php echo $getadvImg['Href']?>"><img src="<?php echo $getadvImg['Img']?>" alt=""></a>
 </div>

</article>
<!--
<?php
$imgUrl = getCMSArticleImageUrl($output['article_detail']['article_attachment_path'], $output['article_detail']['article_image'], 'list');
$array['P']['title'] = $output['article_detail']['article_title'];
$array['P']['imgUrl'] = $imgUrl;
$array['Y']['title'] = $output['article_detail']['article_title'];
$array['Y']['desc'] = html_substr_word($output['article_detail']['article_content'],60);
$array['Y']['imgUrl'] = $imgUrl;

echo weixinShare($array);

?>
-->