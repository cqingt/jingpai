<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="course-nav-hd wrapper mtb-course">
	<h2>艺术相册</h2> 
</div>

<?php if(!empty($output['artist_img_list'])){?>

<div class="wrapper m-t">
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