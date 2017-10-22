<?php defined('InShopNC') or exit('Access Invalid!');?>


<div class="course-nav-hd wrapper mtb-course">
	<h2>艺术作品</h2>
	<div class="sortbox">
	   <a href="<?php echo urlShop('artist_blog','zuoping',array('aid'=>$_GET['aid'],'order_key'=>0,'keyword'=>$_GET['keyword']));?>">默认排序<i class="icon-arrows"></i></a>
	   <a href="<?php echo urlShop('artist_blog','zuoping',array('aid'=>$_GET['aid'],'order_key'=>1,'keyword'=>$_GET['keyword']));?>">销量<i class="icon-arrows"></i></a>
	   <a href="<?php echo urlShop('artist_blog','zuoping',array('aid'=>$_GET['aid'],'order_key'=>2,'keyword'=>$_GET['keyword']));?>">人气<i class="icon-arrows"></i></a>
	   <a href="<?php echo urlShop('artist_blog','zuoping',array('aid'=>$_GET['aid'],'order_key'=>3,'keyword'=>$_GET['keyword']));?>">价格<i class="icon-arrows"></i></a>	   
	</div>
	<h5>共46副作品</h5>
	<div class="tool-search fr">
		<form action="<?php echo urlShop('artist_blog','zuoping');?>">

      <input type="hidden" name="act" value="artist_blog">
      <input type="hidden" name="op" value="zuoping">
      <input type="hidden" name="aid" value="<?php echo $_GET['aid'];?>">
      <input type="hidden" name="order_key" value="<?php echo $_GET['order_key'];?>">

			<input class="seek" type="text" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="作品名称">
			<i class="icon-key" style="right: 47px;"></i>
			<input type="submit" value="搜索" id="button" class="input-submit btn-seek">
		</form>	
   </div>  
</div>


<div class="wrapper">
    <ul class="celebrity-show two">

      <?php if(!empty($output['goods_list'])){?>
        <?php foreach ($output['goods_list'] as $k => $v){?>

          <li>
            <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
               <div class="celimg">
               	<img src="<?php echo cthumb($v['goods_image'],360);?>"/>
               </div>
            </a>
               <h2><?php echo $v['goods_name'];?></h2>
            <p>¥<?php echo $v['goods_price'];?></p>
            <a href="<?php echo urlShop('artist_blog','liuyan',array('aid'=>$_GET['aid']));?>"><i class="btn icon-chat"></i></a>
          </li>   

        <?php }?>
      <?php }?>

    </ul>
    
    <div class="pagination ptb16">
      <?php echo $output['show_page'];?>
    </div>


</div>
