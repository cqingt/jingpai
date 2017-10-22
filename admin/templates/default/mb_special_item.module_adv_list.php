<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php if($item_edit_flag) { ?>
<table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"> <div class="title nomargin">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span> </div>
        </th>
      </tr>
      <tr>
        <td><ul>
            <li>点击添加新的广告条按钮可以添加新的广告条</li>
            <li>鼠标移动到已有的广告条上点击出现的删除按钮可以删除对应的广告条</li>
            <li>操作完成后点击保存编辑按钮进行保存</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
<div class="index_block adv_list">
    <?php if($item_edit_flag) { ?>
  <h3>广告条版块</h3>
  <?php } ?>
  <div nctype="item_content" class="content" id="upload_screen_form">
    <?php if($item_edit_flag) { ?>
    <h5>内容：</h5>
    <?php } ?>


	
<?php if(!empty($item_data['item']) && is_array($item_data['item'])) { $i=0;?>
	<ul>
    <?php foreach($item_data['item'] as $item_key => $item_value) {?>
   
    <li nctype="item_image" class="item" screen_id="<?php echo $i++;?>" title="可上下拖拽更改显示顺序"> 
	
	<img nctype="image" src="<?php echo getMbSpecialImageUrl($item_value['image']);?>" alt="">
      <?php if($item_edit_flag) { ?>
      <input nctype="image_name" name="item_data[item][<?php echo $item_key;?>][image]" type="hidden" value="<?php echo $item_value['image'];?>">
      <input nctype="image_type" name="item_data[item][<?php echo $item_key;?>][type]" type="hidden" value="<?php echo $item_value['type'];?>">
      <input nctype="image_data" name="item_data[item][<?php echo $item_key;?>][data]" type="hidden" value="<?php echo $item_value['data'];?>">
	  <a nctype="btn_edit_item_image"  href="javascript:;" style="right: 64px;"><i class="icon-edit"></i>编辑</a>
	   &nbsp;&nbsp;
      <a nctype="btn_del_item_image" href="javascript:;"><i class="icon-trash"></i>删除</a>
	 
      <?php } ?>
    </li>
    <?php } ?>
	</ul>
    <?php } ?>



  </div>
  <?php if($item_edit_flag) { ?>
  <a nctype="btn_add_item_image" class="btn-add" data-desc="640*240" href="javascript:;">添加新的广告条</a>
  <?php } ?>
</div>
<script>
var SHOP_SITE_URL = "<?php echo SHOP_SITE_URL; ?>";
var UPLOAD_SITE_URL = "<?php echo UPLOAD_SITE_URL; ?>";
var ATTACH_ADV = "<?php echo ATTACH_ADV; ?>";
var screen_adv_list = new Array();//焦点大图广告数据
var screen_adv_append = '';
var focus_adv_list = new Array();//三张联动区广告数据
var focus_adv_append = '';
var adv_info = new Array();
var ap_id = 0;
</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/colorpicker/evol.colorpicker.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/web_config/web_focus.js"></script>