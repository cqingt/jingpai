<?php defined('InShopNC') or exit('Access Invalid!');?>
<style type="text/css">
h3.dialog_head { margin: 0 !important;}
.dialog_content { padding: 0 15px 15px !important; overflow: hidden;}
</style>


<div class="page"> 
  <!-- 页面导航 -->
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $output['item_title'];?></h3>
      <ul class="tab-base">
        <?php   foreach($output['menu'] as $menu) {  if($menu['menu_key'] == $output['menu_key']) { ?>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php  } }  ?>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <!-- 帮助 -->
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
            <li>点击右侧组件的<strong>“添加”</strong>按钮，增加对应类型版块到页面，其中<strong>“广告条版块”</strong>只能添加一个。</li>
            <li>鼠标触及左侧页面对应版块，出现操作类链接，可以对该区域块进行<strong>“移动”、“启用/禁用”、“编辑”、“删除”</strong>操作。</li>
            <li>新增加的版块内容默认为<strong>“禁用”</strong>状态，编辑内容并<strong>“启用”</strong>该块后将在手机端即时显示。</li>
          </ul></td>
      </tr>
    </tbody>
  </table>


<?php if($_GET['op'] == 'special_edit'){ ?>
 <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=mb_special&op=BaoCunBeiJin">
    <input name="special_id" type="hidden" value="<?php echo $output['special_id'];?>" />
    <table class="table tb-type2">
      <tbody>
      
        <tr class="space">
          <th colspan="2">专题页面背景设置</th>
        </tr>
        <tr>
          <td colspan="2" class="required">专题页面背景设置</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input class="txt" name="special_background_color" type="color" value="<?php if(!empty($output['special_detail'])) echo $output['special_detail']['special_background_color'];?>" /></td>
          <td class="vatop tips"><span class="vatop rowform">背景色即专题页面CSS属性中"body{ background-color}"值，作为专业页面整体背景色使用，设置请使用十六进制形式(#XXXXXX)，默认留空为白色背景。</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">背景图选择</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
		  
			<span class="type-file-show"> <a href="<?php if(!empty($output['special_detail']['special_background'])){ echo getCMSSpecialImageUrl($output['special_detail']['special_background']);} else {echo ADMIN_TEMPLATES_URL . '/images/preview.png';}?>" nctype="nyroModal"><img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png"></a>
            </span> 
			
			<span class="type-file-box">
            <input name="special_background" type="file" class="type-file-file" id="special_background" size="30" hidefocus="true" nctype="cms_image">
            <input name="old_special_background" type="hidden" value="<?php echo $output['special_detail']['special_background'];?>" />
            </span>
			
			</td>
          <td class="vatop tips"><span class="vatop rowform">背景图即专题页面CSS属性中"body{ background-image}"值，选择本地图片上传作为页面整体背景。</span></td>
        </tr>
        <tr>
          <td colspan="2" class="required">背景图填充方式</td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
				<label class="mr10">
                  <input name="special_repeat" type="radio" value="no-repeat" <?php if($output['special_detail']['special_repeat'] == 'no-repeat') echo 'checked';?> />不重复</label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat" <?php if($output['special_detail']['special_repeat'] == 'repeat') echo 'checked';?>/>
             平铺</label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat-x" <?php if($output['special_detail']['special_repeat'] == 'repeat-x') echo 'checked';?>/>
              x轴平铺</label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat-y" <?php if($output['special_detail']['special_repeat'] == 'repeat-y') echo 'checked';?>/>
              y轴平铺</label></td>
          <td class="vatop tips"><span class="vatop rowform">背景图填充方式即专题页面CSS属"body{ background-repeat}"值，选择不重复(no-repeat)|平铺(repeat)|x轴平铺(repeat-x)|y轴平铺(repeat-y)为背景图的填充方式。</span></td>
        </tr>
       
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="btn_draft"><span>保存信息</span></a></td>
        </tr>
    </table>
  </form>

<?php } ?>




  <!-- 列表 -->
  <div class="mb-special-layout">
    <div class="mb-item-box">
      <div id="item_list" class="item-list">
        <?php if(!empty($output['list']) && is_array($output['list'])) {?>
        <?php foreach($output['list'] as $key => $value) {?>
        <div nctype="special_item" class="special-item <?php echo $value['item_type'];?> <?php echo $value['usable_class'];?>" data-item-id="<?php echo $value['item_id'];?>">
          <div class="item_type"><?php echo $output['module_list'][$value['item_type']]['desc'];?></div>
          <?php $item_data = $value['item_data'];?>
          <?php $item_edit_flag = false;?>
          <div id="item_edit_content">
            <?php require('mb_special_item.module_' . $value['item_type'] . '.php');?>
          </div>
          <div class="handle"><a nctype="btn_move_up" href="javascript:;"><i class="icon-arrow-up"></i>上移</a> <a nctype="btn_move_down" href="javascript:;"><i class="icon-arrow-down"></i>下移</a> <a nctype="btn_usable" data-item-id="<?php echo $value['item_id'];?>" href="javascript:;"><i class="icon-off"></i><?php echo $value['usable_text'];?></a> <a nctype="btn_edit_item" data-item-id="<?php echo $value['item_id'];?>" href="javascript:;"><i class="icon-edit"></i>编辑</a> <a nctype="btn_del_item" data-item-id="<?php echo $value['item_id'];?>" href="javascript:;"><i class="icon-trash"></i>删除</a></div>
          </td>
        </div>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
    <div class="module-list">
      <?php if(!empty($output['module_list']) && is_array($output['module_list'])){ ?>
      <?php foreach($output['module_list'] as $key => $value){ ?>
      <div class="module_<?php echo $key;?>"> <span><?php echo $value['desc'];?></span> <a nctype="btn_add_item" class="add" href="javascript:;" data-module-type="<?php echo $value['name'];?>">添加</a> </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.min.js" charset="utf-8"></script> 
<!-- 页面模块模板 --> 
<script id="item_template" type="text/html">
</script> 
<script type="text/javascript">
    var special_id = <?php echo $output['special_id'];?>;
    var url_item_add = "<?php echo urlAdmin('mb_special', 'special_item_add');?>";
    var url_item_del = "<?php echo urlAdmin('mb_special', 'special_item_del');?>";
    var url_item_edit = "<?php echo urlAdmin('mb_special', 'special_item_edit');?>";
    $(document).ready(function(){
		//保存背景颜色设置
		$('#btn_draft').on('click', function() {
			$("#add_form").submit();
        });
        //添加模块
        $('[nctype="btn_add_item"]').on('click', function() {
            var data = {
                special_id: special_id,
                item_type: $(this).attr('data-module-type')
            };
            $.post(url_item_add, data, function(data) {
                if(typeof data.error === 'undefined') {
                    location.reload();
                } else {
                    showError(data.error);
                }
            }, "json");
        });

        //删除模块
        $('#item_list').on('click', '[nctype="btn_del_item"]', function() {
            if(!confirm('确认删除？')) {
                return false;
            }
            var $this = $(this);
            var item_id = $this.attr('data-item-id');
            $.post(url_item_del, {item_id: item_id, special_id: special_id} , function(data) {
                if(typeof data.error === 'undefined') {
                    $this.parents('.special-item').remove();
                } else {
                    showError(data.error);
                }
            }, "json");
        });

        //编辑模块
        $('#item_list').on('click', '[nctype="btn_edit_item"]', function() {
            var item_id = $(this).attr('data-item-id');
            go(url_item_edit + '&item_id=' + item_id);
        });

        //上移
        $('#item_list').on('click', '[nctype="btn_move_up"]', function() {
            var $current = $(this).parents('[nctype="special_item"]');
            $prev = $current.prev('[nctype="special_item"]');
            if($prev.length > 0) {
                $prev.before($current);
                update_item_sort();
            } else {
                showError('已经是第一个了');
            }
        });

        //下移
        $('#item_list').on('click', '[nctype="btn_move_down"]', function() {
            var $current = $(this).parents('[nctype="special_item"]');
            $next = $current.next('[nctype="special_item"]');
            if($next.length > 0) {
                $next.after($current);
                update_item_sort();
            } else {
                showError('已经是最后一个了');
            }
        });

        var update_item_sort = function() {
            var item_id_string = '';
            $item_list = $('#item_list').find('[nctype="special_item"]');
            $item_list.each(function(index, item) {
                item_id_string += $(item).attr('data-item-id') + ',';
            });
            $.post("index.php?act=mb_special&op=update_item_sort", {special_id: special_id, item_id_string: item_id_string}, function(data) {
                if(typeof data.error != 'undefined') {
                    showError(data.message);
                }
            }, 'json');
        };

        //启用/禁用控制
        $('#item_list').on('click', '[nctype="btn_usable"]', function() {
            var $current = $(this).parents('[nctype="special_item"]');
            var item_id = $current.attr('data-item-id');
            var usable = '';
            if($current.hasClass('usable')) {
                $current.removeClass('usable');
                $current.addClass('unusable');
                usable = 'unusable';
                $(this).html('<i class="icon-off"></i>启用');
            } else {
                $current.removeClass('unusable');
                $current.addClass('usable');
                usable = 'usable';
                $(this).html('<i class="icon-off"></i>禁用');
            }

            $.post("index.php?act=mb_special&op=update_item_usable", {item_id: item_id, usable: usable, special_id: special_id}, function(data) {
                if(typeof data.error != 'undefined') {
                    showError(data.message);
                }
            }, 'json');
        });

    });
</script> 

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/cms/cms_special.js" charset="utf-8"></script>
