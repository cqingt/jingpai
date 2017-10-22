<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="course-nav-hd wrapper mtb-course">
	<h2>艺术资讯</h2> 
</div>


<div class="wrapper m-t">
    <ul class="consult">

<?php if(!empty($output['zixun_info'])){?>
	<?php foreach ($output['zixun_info'] as $k => $v){?>

<li>
	<a href="/tzxy/article-<?php echo $v['article_id'];?>.html" target="_blank">
		<div class="con-l">
			<img src="<?php echo $v['N_Img_Url'];?>"/>
		</div>
		<div class="con-r">
			<h2 class="ui-nowrap"><?php echo $v['article_title'];?></h2>
			<h5><em><?php echo date("Y-m-d H:i:s",$v['article_publish_time']);?></em><strong></strong></h5>
			<p class="ui-nowrap-multi"><?php echo $v['N_Content'];?></p>
			<h6>查看更多</h6>
		</div>
	</a>
</li>

   	<?php }?>
<?php }?>

    </ul>
    
    <div class="pagination ptb16">
    	<?php echo $output['show_page'];?>
    </div>
</div>
