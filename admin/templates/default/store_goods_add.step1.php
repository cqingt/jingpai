<?php defined('InShopNC') or exit('Access Invalid!');?>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script>
    var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_RESOURCE_SITE_URL = '<?php echo BASE_SITE_URL;?>/shop/resource';var SHOP_TEMPLATES_URL = '<?php echo BASE_SITE_URL;?>/shop/templates/default';
    var STORE_ID = '<?php echo $output['store_id'];?>';
</script>

<link href="<?php echo BASE_SITE_URL;?>/shop/templates/default/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_SITE_URL;?>/shop/templates/default/css/seller_center.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_SITE_URL;?>/shop/resource/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
<link rel="stylesheet" href="http://www.ncb2b2c.com/shop/resource/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->

<!-- S setp -->

<!--S 分类选择区域-->
<div class="wrapper_search">
  <div class="wp_sort">
    <div id="dataLoading" class="wp_data_loading">
      <div class="data_loading"><?php echo $lang['store_goods_step1_loading'];?></div>
    </div>
    <div class="sort_selector">
      <div class="sort_title"><?php echo $lang['store_goods_step1_choose_common_category'];?>
        <div class="text" id="commSelect">
            <div><?php echo $lang['store_goods_step1_please_select'];?></div>
            <div class="select_list" id="commListArea">
              <ul>
                <?php if(is_array($output['staple_array']) && !empty($output['staple_array'])) {?>
                <?php foreach ($output['staple_array'] as $val) {?>
                <li  data-param="{stapleid:<?php echo $val['staple_id']?>}"><span nctype="staple_name"><?php echo $val['staple_name']?></span><a href="JavaScript:void(0);" nctype="del-comm-cate" title="<?php echo $lang['nc_delete'];?>">X</a></li>
                <?php }?>
                <?php }?>
                <li id="select_list_no" <?php if (!empty($output['staple_array'])) {?>style="display: none;"<?php }?>><span class="title"><?php echo $lang['store_goods_step1_no_common_category'];?></span></li>
              </ul>
            </div>
        </div>
        <i class="icon-angle-down"></i>
      </div>
    </div>
    <div id="class_div" class="wp_sort_block">
      <div class="sort_list">
        <div class="wp_category_list">
          <div id="class_div_1" class="category_list">
            <ul>
              <?php if(isset($output['goods_class']) && !empty($output['goods_class']) ) {?>
              <?php foreach ($output['goods_class'] as $val) {?>
              <li class="" nctype="selClass" data-param="{gcid:<?php echo $val['gc_id'];?>,deep:1,tid:<?php echo $val['type_id'];?>}"> <a class="" href="javascript:void(0)"><i class="icon-double-angle-right"></i><?php echo $val['gc_name'];?></a></li>
              <?php }?>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
      <div class="sort_list">
        <div class="wp_category_list blank">
          <div id="class_div_2" class="category_list">
            <ul>
            </ul>
          </div>
        </div>
      </div>
      <div class="sort_list sort_list_last">
        <div class="wp_category_list blank">
          <div id="class_div_3" class="category_list">
            <ul>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="alert">
    <dl class="hover_tips_cont">
      <dt id="commodityspan"><span style="color:#F00;"><?php echo $lang['store_goods_step1_please_choose_category'];?></span></dt>
      <dt id="commoditydt" style="display: none;" class="current_sort"><?php echo $lang['store_goods_step1_current_choose_category'];?><?php echo $lang['nc_colon'];?></dt>
      <dd id="commoditydd"></dd>
    </dl>
  </div>
  <div class="wp_confirm">
    <form method="get">
      <?php if ($output['edit_goods_sign']) {?>
      <input type="hidden" name="act" value="goods_edit" />
      <input type="hidden" name="op" value="edit_goods" />
      <input type="hidden" name="commonid" value="<?php echo $output['commonid'];?>" />
      <input type="hidden" name="ref_url" value="<?php echo $_GET['ref_url'];?>" />
      <?php } else {?>
      <input type="hidden" name="act" value="store_goods_add" />
      <input type="hidden" name="op" value="add_step_two" />
      <?php }?>
      <input type="hidden" name="class_id" id="class_id" value="" />
      <input type="hidden" name="t_id" id="t_id" value="" />
      <div class="bottom tc">
      <label class="submit-border"><input disabled="disabled" nctype="buttonNextStep" value="下一步，填写商品信息" type="submit" class="submit"style=" width: 200px;" /></label>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script> 
<script src="<?php echo BASE_SITE_URL;?>/shop/resource/js/store_goods_add.adminstep1.js"></script>
<script>
SEARCHKEY = '<?php echo $lang['store_goods_step1_search_input_text'];?>';
RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
</script>

