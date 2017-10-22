<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="course-nav-hd wrapper mtb-course">
	<h2>选画中心</h2>
</div>

<div class="course-nav-box wrapper m-b">


<!-- 固定goods一级分类 -->

	<?php if(!empty($output['yiShuClass'])){?>
		
		<div class="course-nav-row clearfix">
	    <span class="hd l">艺术分类：</span>
	    <div class="bd">

		        <ul>

<?php foreach ($output['yiShuClass'] as $k => $v) {?>
<li class="course-nav-item  <?php if($_GET['gc_parent_id'] == $v['gc_id']){echo ' on';}?>" id="attr_id_sel_<?php echo $v['gc_id'];?>"  onmouseover="selAttr(<?php echo $v['gc_id'];?>);">
    <a href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$v['gc_id'],'cate_id'=>$v['gc_id']));?>"><?php echo $v['gc_name'];?></a>
</li>
<?php }?>

		        </ul>

		    </div>
		</div>

	<?php }?>


<!-- goods二级分类 -->

	<?php if(!empty($output['yiShuClass'])){?>
		
		<?php foreach ($output['yiShuClass'] as $xia_k => $xia_v) {?>

			<?php if(!empty($xia_v['xiaji_class'])){?>


		<div <?php if($_GET['gc_parent_id'] != $xia_v['gc_id']){echo "style='display:none;'";}?> class="course-nav-row clearfix attr_id_mo" id="attr_id_<?php echo $xia_v['gc_id'];?>" >
	    <span class="hd l"><?php echo $xia_v['gc_name'];?>：</span>
	    <div class="bd">

		        <ul>
		        	

<?php foreach ($xia_v['xiaji_class'] as $k => $v) {?>

    <li class="course-nav-item <?php if($_GET['cate_id'] == $v['gc_id']){echo ' on';}?>">
        <a href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$v['gc_parent_id'],'cate_id'=>$v['gc_id'],'a_id'=>$_GET['a_id']));?>"><?php echo $v['gc_name'];?></a>
    </li>

<?php }?>

					
					
		        </ul>

		    </div>
		</div>

			<?php }?>

		<?php }?>

	<?php }?>





<!-- 分类属性 -->


	<?php if(!empty($output['attr_array'])){?>
			
		<?php foreach ($output['attr_array'] as $key => $value) {?>

			<div class="course-nav-row clearfix">
		    <span class="hd l"><?php echo $value['name'];?>：</span>
		    <div class="bd">
			        <ul>

<?php if(!empty($output['checked_attr'][$key])){?>

	<?php 

		$a_id = $_GET['a_id'];
		$_del_id = $output['checked_attr'][$key]['attr_value_id'];
		if(strstr($a_id,'_'.$_del_id)){
			$a_id = str_replace('_'.$_del_id, '', $a_id);
		}elseif(strstr($a_id,$_del_id.'_')){
			$a_id = str_replace($_del_id.'_', '', $a_id);
		}else{
			$a_id = str_replace($_del_id, '', $a_id);
		}

	?>

	<li class="course-nav-item ">

		<a class="category" href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$a_id,'order_key'=>$_GET['order_key'],'is_shop'=>$_GET['is_shop'],'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>"><i class="icon-close"></i><?php echo $output['checked_attr'][$key]['attr_value_name'];?></a>

	</li>

<?php }else{?>

						<?php foreach ($value['value'] as $k => $v) {?>
			            <li class="course-nav-item ">
			                <a href="<?php $_GET['a_id']?$attr_value_id = $_GET['a_id'].'_'.$v['attr_value_id']:$attr_value_id = $v['attr_value_id'];echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$attr_value_id));?>"><?php echo $v['attr_value_name'];?></a>
			            </li>
						<?php }?>

<?php }?>


			        </ul>
			    </div>
			</div>
			
		<?php }?>

	<?php }?>


<!-- 搜索 -->

	<form action="<?php echo urlShop('artist_new','searchShuHua');?>" method="get">

    <div class="course-tool-bar clearfix">

    	<input type="hidden" value="artist_new" id="artist_new" name="act">
    	<input type="hidden" value="searchshuhua" id="searchshuhua" name="op">
    	<input type="hidden" value="<?php echo $_GET['gc_parent_id'];?>" name="gc_parent_id">
    	<input type="hidden" value="<?php echo $_GET['cate_id'];?>" name="cate_id">
    	<input type="hidden" value="<?php echo $_GET['a_id'];?>" name="a_id">
    	<input type="hidden" value="<?php echo $_GET['order_key'];?>" name="order_key">
    	<input type="hidden" value="<?php echo $_GET['is_shop'];?>" name="is_shop">
 

    	<div class="tool-select">

			<div class="only">
				<input value='1' <?php if($_GET['key_type'] != 2 ){echo 'checked="checked"';}?>  type="radio" id="radio-2-1" name="key_type" class="regular-radio big-radio"><label for="radio-2-1"></label>
				<i>艺术家名</i>
			</div>
			<div class="only">
				<input value='2' <?php if($_GET['key_type'] == 2 ){echo 'checked="checked"';}?> type="radio" id="radio-2-2" name="key_type" class="regular-radio big-radio"><label for="radio-2-2"></label>
				<i>作品名</i>
			</div>  

    	</div>
    	<div class="tool-search">
			
				<input value="<?php echo $_GET['keyword'];?>" class="seek" type="text" name="keyword" id="keyword" placeholder="艺术家名">
				<i class="icon-key"></i>
				<input type="submit" value="搜索" id="button" class="input-submit btn-seek click_button">

        </div>    

    </div>

	</form>

</div>




<div class="course-nav-hd wrapper mtb-course">
	<h2>默认排序</h2>
	<div class="sortbox">
	   <a href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>1,'is_shop'=>$_GET['is_shop'],'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>">销量<i class="icon-arrows"></i></a>
	   <a href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>2,'is_shop'=>$_GET['is_shop'],'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>">人气<i class="icon-arrows"></i></a>
	   <a href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>3,'is_shop'=>$_GET['is_shop'],'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>">价格<i class="icon-arrows"></i></a>
	   <a><input type="checkbox" name="" id="ptai" <?php if($_GET['is_shop'] == 1){echo 'checked=\'checked\'';}?>/><label for="ptai">平台自营</label></a>
	</div>
	<h5>共<?php echo $output['totalNum'];?>副作品</h5>
</div>



<!-- goods 信息 -->


<div class="wrapper">
    <div class="celebrity-show">

	<?php if(!empty($output['goods_list'])){?>
		
		<?php foreach ($output['goods_list'] as $k => $v) {?>

		<div class="product-display">

			<div class="tb-booth tb-pic">
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>"  target="_blank"><img src="<?php echo cthumb($v['goods_image'],360)?>" alt="<?php echo $v['goods_name'];?>" rel="<?php echo cthumb($v['goods_image'],360)?>" class="jqzoom" /></a>
			</div>

			<ul class="tb-thumb">
				<!-- <li class="tb-selected"><div class="tb-pic tb-s40"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>"><img src="<?php echo cthumb($v['goods_image'],60)?>" mid="<?php echo cthumb($v['goods_image'],60)?>"></a></div></li> -->
				
				<?php if(!empty($v['image'])){?>
		
					<?php foreach ($v['image'] as $ik => $iv) {?>

<li><div class="tb-pic tb-s40"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($iv['goods_image'],60)?>" mid="<?php echo cthumb($iv['goods_image'],360)?>"></a></div></li>

					<?php }?>

				<?php }else{?>
<li><div class="tb-pic tb-s40"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($v['goods_image'],60)?>" mid="<?php echo cthumb($v['goods_image'],360)?>"></a></div></li>

				<?php }?>

			</ul>

			<h2><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>"  target="_blank"><?php echo $v['goods_name_highlight'];?></a></h2>
			<p>¥<?php echo $v['goods_price'];?></p>

			<?php if(!empty($v['artist_id'])){?>
			<a href="<?php echo urlShop('artist_blog','liuyan',array('aid'=>$v['artist_id']));?>"><i class="btn icon-chat"></i></a>
			<?php }else{?>
			<!-- <i class="btn icon-chat"></i> -->
			<?php }?>
		</div>  

		<?php }?>

	<?php }?>

    </div>
    
	


	<!-- 分页 -->

    <div class="pagination ptb16">
    	<?php echo $output['show_page'];?>
    </div>

</div>




<script>
	
	$(function(){

		var che;

		// 自营平台

		$("#ptai").click(function(){

			che = $(this).is(':checked');

			if(che === true){
				window.location.href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>$_GET['order_key'],'is_shop'=>1,'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>";
			}else{
				window.location.href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>$_GET['order_key'],'is_shop'=>0,'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>";
			}

		});

		var key_type;
		var keyword;

		// 搜索
		$("#click_button").click(function(){
			key_type = $("#radio-2-1").is(':checked')?1:2;
			keyword = $("#keyword").val();

			if(key_type && keyword){

			window.location.href="<?php echo urlShop('artist_new','searchShuHua',array('gc_parent_id'=>$_GET['gc_parent_id'],'cate_id'=>$_GET['cate_id'],'a_id'=>$_GET['a_id'],'order_key'=>$_GET['order_key'],'is_shop'=>0,'key_type'=>$_GET['key_type'],'keyword'=>$_GET['keyword']));?>";

			}

		})



	})


	function selAttr(id){

		var gc_parent_id = "<?php echo $_GET['gc_parent_id'];?>";

		$(".attr_id_mo").hide();

		$("#attr_id_" + id).show();

		if(!!gc_parent_id == true){
			$("#attr_id_sel_" + id).mouseout(function(){
				$(".attr_id_mo").hide();
				$("#attr_id_" + gc_parent_id).show();
			});
		}
		
	}


</script>