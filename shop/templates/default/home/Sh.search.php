<?php $_GET['op'] = 'index' ; ?>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/js/owl.carousel.js"  charset="utf-8"></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/js/main.js"  charset="utf-8"></script>
<div class="course-nav-hd wrapper mtb-course">
	<h2>选画中心</h2>
</div>

<div class="course-nav-box wrapper m-b">
	<div class="course-nav-row clearfix">
	    <span class="hd l">艺术分类：</span>
	    <div class="bd">
	        <ul>
			<?php foreach ($output['yiShuClass'] as $val) {?>
	            <li class="course-nav-item<?php if ($val['gc_id'] == $_GET['cate_id'] || $output['CateArrData'][1] == $val['gc_id']) {?> on<?php } ?>" >
	                <a href="<?php echo urlShop('search', 'index', array('cate_id' => $val['gc_id'], 'keyword' => $_GET['keyword']));?>"><?php echo $val['gc_name']?></a>
	            </li>
			<?php }?>
	        </ul>
	    </div>
	</div>
	<?php if(!empty($output['yiShuClass'])){?>
		<?php foreach ($output['yiShuClass'] as $xia_k => $xia_v) {?>
		<?php if(!empty($xia_v['xiaji_class'])){?>
		<div <?php if($output['default_classid'] != $xia_v['gc_id'] && $output['CateArrData'][1] != $xia_v['gc_id']){echo "style='display:none;'";}?> class="course-nav-row clearfix attr_id_mo" id="attr_id_<?php echo $xia_v['gc_id'];?>" >
	    <span class="hd l"><?php echo $xia_v['gc_name'];?>：</span>
	    <div class="bd">
		        <ul>
				<?php foreach ($xia_v['xiaji_class'] as $k => $v) {?>
					<li class="course-nav-item <?php if($_GET['cate_id'] == $v['gc_id']){echo ' on';}?>">
						<a href="<?php echo urlShop('search', 'index', array('cate_id' => $v['gc_id'], 'keyword' => $_GET['keyword']));?>"><?php echo $v['gc_name'];?></a>
					</li>
				<?php } ?>
		        </ul>
		    </div>
		</div>
			<?php } ?>
		<?php } ?>

	<?php } ?>
<?php if(!isset($output['goods_class_array']['child']) && empty($output['goods_class_array']['child']) && !empty($output['goods_class_array'])){?>
<?php $dl=1;  //dl标记?>
<?php if((!empty($output['brand_array']) && is_array($output['brand_array'])) || (!empty($output['attr_array']) && is_array($output['attr_array']))){?>
	
  <?php if(!empty($output['attr_array']) && is_array($output['attr_array'])){?>
  <?php $j = 0;foreach ($output['attr_array'] as $key=>$val){$j++;?>

  
	
	<div class="course-nav-row clearfix">

	    <span class="hd l" style="width: 90px;"><?php echo $val['name'].$lang['nc_colon'];?></span>
	    <div class="bd">
	        <ul>
			<?php $i = 0;foreach ($val['value'] as $k=>$v){$i++;?>
	            <li class="course-nav-item <?php if($output['checked_attr'][$key]['attr_value_name'] == $v['attr_value_name']){?> on<?php }?>">
<?php 
		$tpl_params = explode('_', $_GET['a_id']);
		if (!empty($tpl_params)) {
			foreach ($tpl_params as $tk=>$tv) {
				if ($output['checked_attr'][$key]['attr_value_id'] == $tv) {
					unset($tpl_params[$tk]);
				}
			}
			$a_id = implode('_', $tpl_params);
		}else{
			$a_id = $_GET['a_id'];
		}
?>
	                <a <?php if ($output['checked_attr'][$key]['attr_value_id'] == $k) { ?> href="<?php echo removeParam(array('a_id' => $output['checked_attr'][$key]['attr_value_id']));?>" <?php }else{ ?>href="<?php $a_id = (($a_id != '' && $a_id != 0) ? $a_id.'_'.$k : $k ); echo replaceParam(array('a_id' => $a_id));?>"<?php } ?>><?php echo $v['attr_value_name'];?></a>
	            </li>
			<?php }?>
                
	        </ul>
	    </div>
	</div>	

	<?php $dl++;} ?>
	<?php }?>

    <?php }?>
    <?php }?>
	
    <div class="course-tool-bar clearfix">
		<form method="get" action="index.php">
		<input type="hidden" name="act" value="search">
		<input type="hidden" name="op" value="index">
		<input type="hidden" name="cate_id" value="<?php echo $_GET['cate_id'];?>">
    		<!--<div class="tool-select">
			
			<div class="only">
				<input checked="checked" type="radio" <?php if($_GET['radioType'] == 1 ){echo 'checked="checked"';}?> id="radio-2-1" name="radioType" class="regular-radio big-radio" value="1"><label for="radio-2-1"></label>
				<i>艺术家名</i>
			</div>
			<div class="only">
				<input type="radio" id="radio-2-2" <?php if($_GET['radioType'] == 2 ){echo 'checked="checked"';}?> value="2" name="radioType" class="regular-radio big-radio"><label for="radio-2-2"></label>
				<i>作品名</i>
			</div>  
			
    		</div>-->
			<div class="tool-search">
					<input class="seek" type="text" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="艺术家名">
					<i class="icon-key"></i>
					<input type="submit" value="搜索" id="button" class="input-submit btn-seek">
					
			</div>    
		</form>
    </div>
</div>

<div class="course-nav-hd wrapper mtb-course">
	<div class="sortbox">
	   <strong class="sx">筛选：</strong>

	   <a class="noborder" <?php if($_GET['key'] == '1'){ ?>class="selected"<?php } ?> href="<?php echo dropParam(array('order', 'key'));?>">默认</a>

	   <a <?php if($_GET['key'] == '1'){ ?>class="selected"<?php } ?> href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '1') ? replaceParam(array('key' => '1', 'order' => '1')) : replaceParam(array('key' => '1', 'order' => '2')); ?>" <?php if($_GET['key'] == '1'){ ?>class="<?php echo $_GET['order'] == 1 ? 'asc' : 'desc';?>"<?php } ?> title="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '1') ? $lang['goods_class_index_sold_asc'] : $lang['goods_class_index_sold_desc']; ?>"><?php echo $lang['goods_class_index_sold'];?><i class="icon-arrows"></i></a>

	   <a <?php if($_GET['key'] == '2'){?>class="selected"<?php }?> href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '2') ? replaceParam(array('key' => '2', 'order' => '1')):replaceParam(array('key' => '2', 'order' => '2')); ?>" <?php if($_GET['key'] == '2'){?>class="<?php echo $_GET['order'] == 1 ? 'asc' : 'desc';?>"<?php }?> title="<?php  echo ($_GET['order'] == '2' && $_GET['key'] == '2')?$lang['goods_class_index_click_asc']:$lang['goods_class_index_click_desc']; ?>"><?php echo $lang['goods_class_index_click']?><i class="icon-arrows"></i></a>

	   <a <?php if($_GET['key'] == '3'){?>class="selected"<?php }?> href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '3') ? replaceParam(array('key' => '3', 'order' => '1')):replaceParam(array('key' => '3', 'order' => '2')); ?>" <?php if($_GET['key'] == '3'){?>class="<?php echo $_GET['order'] == 1 ? 'asc' : 'desc';?>"<?php }?> title="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '3')?$lang['goods_class_index_price_asc']:$lang['goods_class_index_price_desc']; ?>"><?php echo $lang['goods_class_index_price'];?><i class="icon-arrows"></i></a>
<!--

	   <a href="JavaScript:void(0);"><input type="checkbox" name="" id="ptai"  <?php if ($_GET['type'] == 1) {?>checked<?php }?> /><label for="ptai">平台自营</label></a>
-->
	</div>
	<h5>共<?php echo intval($output['TotalNum']);?>副作品</h5>
</div>


<div class="wrapper">
    <div class="celebrity-show">

		<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
		<?php foreach($output['goods_list'] as $value){?>
		<div class="product-display">
			<div class="tb-booth tb-pic">
				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>" target="_blank" title="<?php echo $value['goods_name'];?>"><img src="<?php echo thumb($value, 240);?>" title="<?php echo $value['goods_name'];?>" alt="<?php echo $value['goods_name'];?>" rel="<?php echo thumb($value, 240);?>" class="jqzoom" /></a>
			</div>
			<ul class="tb-thumb">
			<?php if(!empty($value['image'])) {?>
              <?php $i=0;foreach ($value['image'] as $val) {$i++?>
				<li <?php if($i == 1){ ?>class="tb-selected"<?php } ?>><div class="tb-pic tb-s40"><a href="javascript:void(0);"><img src="<?php echo thumb($val, 60);?>" mid="<?php echo thumb($val, 240);?>"></a></div></li>
				<?php }?>
				<?php } else {?>
				<li class="tb-selected"><div class="tb-pic tb-s40"><a href="javascript:void(0);"><img src="<?php echo thumb($value, 60);?>" mid="<?php echo thumb($value, 240);?>"></a></div></li>
			<?php }?>
				
			</ul>
			<h2><a href="<?php echo urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>" target="_blank" title="<?php echo $value['goods_name'];?>"><?php echo $value['goods_name'];?></a></h2>
			<?php if(intval($value['promotion_price']) > 0){ ?><p title="<?php echo $lang['goods_class_index_promotion_goods_price'].$lang['nc_colon'].$lang['currency'].$value['promotion_price'];?>"><?php echo ncPriceFormatForList($value['promotion_price']);?></p><?php }else{ ?> 
		  <?php if(intval($value['goods_price']) < 1){ ?><p>我要询价</p><?php }else{ ?><p title="<?php echo $lang['goods_class_index_store_goods_price'].$lang['nc_colon'].$lang['currency'].$value['goods_price'];?>"><?php echo ncPriceFormatForList($value['goods_price']);?></p><?php if(intval(C('show_goods_marketprice'))){?><p title="市场价：<?php echo $lang['currency'].$value['goods_marketprice'];?>"><?php echo ncPriceFormatForList($value['goods_marketprice']);?></p><?php }?><?php } ?> <?php } ?>
			<i class="btn icon-chat" href="JavaScript:void(0);" title="在线联系" onclick="NTKF.im_openInPageChat('sc_1022_9999')"></i>
		</div>  
		<?php } ?>
		<?php }else{ ?>
		<div style="color: #AAA;padding: 100px 0;text-align: center;font-size: 35px;"><i></i>没有找到符合条件的商品</div>
		<?php } ?>
    </div>
    
    <div class="pagination ptb16">
	<?php echo $output['show_page']; ?>
    	
    </div>
</div>

<script>
$(function(){
		$("#ptai").click(function(){
			che = $(this).is(':checked');
			if(che === true){
				window.location.href="<?php echo replaceParam(array('type' => '1')); ?>";
			}else{
				window.location.href="<?php echo dropParam(array('type')); ?>";
			}

		});
});
</script>