<div class="blog-content">
     <h2><?php echo $output['article_detail']['article_title'];?></h2>
     <div class="bc-title">
	     <span>作者：<?php echo $output['article_detail']['article_author']?></span>
	     <span><?php echo date('Y-m-d',$output['article_detail']['article_publish_time']);?></span>
     </div>
     <div class="blog-con">
         <?php echo $output['article_detail']['article_content'];?>
     </div>
</div>