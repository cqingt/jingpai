<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['miaosha_index_manage'];?></h3>
      <ul class="tab-base">
        <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php  } }  ?>
      </ul>
      </ul>
    </div>
  </div>
  <!--  搜索 -->
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="act" value="miaosha">
    <input type="hidden" name="op" value="miaosha_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="xianshi_name">商品名称</label></th>
          <td><input type="text" value="<?php echo $_GET['search_goods_name'];?>" name="search_goods_name" id="search_goods_name" class="txt" style="width:100px;"></td>
          <th><label for="store_name"><?php echo $lang['store_name'];?></label></th>
          <td><input type="text" value="<?php echo $_GET['store_name'];?>" name="store_name" id="store_name" class="txt" style="width:100px;"></td>
          <th><label for="miaosha_state">状态</label></th>
          <td>
              <select name="miaosha_state" class="w90">
                  <?php if(is_array($output['miaosha_state_array'])) { ?>
                  <?php foreach($output['miaosha_state_array'] as $key=>$val) { ?>
                  <option value="<?php echo $key;?>" <?php if($key == $_GET['miaosha_state']) { echo 'selected';}?>><?php echo $val;?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
          </td>
          <th><label for="groupbuy_state">活动分类</label></th>
          <td>
              <select name="miaosha_class" id="miaosha_class">
                  <option value="0">请选择…</option>
                  <?php foreach($output['miaosha_class'] as $val) { ?>
                  <option value="<?php echo $val['class_id'];?>"><?php echo $val['class_name'];?></option>
                  <?php } ?>
              </select>
          </td>
		  <th><label>分类</label></th>
		<td id="searchgc_td"></td><input type="hidden" id="choose_gcid" name="choose_gcid" value="0"/>
		<th><label for="type_id">店铺类型</label></th>
		<td>
			<select name="type_id" id="type_id" class="querySelect"><option value="0">请选择...</option><option value="1" <?php if($_GET['type_id'] == 1) { echo 'selected';}?>>自运营店铺</option><option value="2" <?php if($_GET['type_id'] == 2) { echo 'selected';}?>>代运营店铺</option><option value="3" <?php if($_GET['type_id'] == 3) { echo 'selected';}?>>商家店铺</option></select>
		</td>


  <th>
    <label for="query_start_time"><?php echo $lang['order_time_from'];?></label>
  </th>

  <td>
      <input class="txt date" type="text" value="<?php echo $_GET['query_start_time'];?>" id="query_start_time" name="query_start_time">
      <label for="query_start_time">~</label>
      <input class="txt date" type="text" value="<?php echo $_GET['query_end_time'];?>" id="query_end_time" name="query_end_time"/>
  </td>

          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
      </tr>
  </tbody>
    </table>
  </form>
  <!--  说明 -->
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>管理员可以审核新的秒杀活动申请、取消进行中的秒杀活动或者删除秒杀活动</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method="post">
    <input type="hidden" id="group_id" name="group_id"  />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w48"><?php echo $lang['nc_sort'];?></th>
          <th colspan="2"><?php echo $lang['goods_name'];?></th>
          <th class="align-center" width="120"><?php echo $lang['miaosha_index_start_time'];?></th>
          <th class="align-center" width="120"><?php echo $lang['miaosha_index_end_time'];?></th>
            <th class="align-center" width="80"><?php echo $lang['miaosha_price'];?></th>
          <th class="align-center" width="80"><?php echo $lang['max_quantity'];?></th>
            <th class="align-center" width="80"><?php echo $lang['sale_quantity'];?></th>
          <th class="align-center" width="120"><?php echo $lang['miaosha_state_name'];?></th>
          <th class="align-center" width="120"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($output['miaosha_list']) && is_array($output['miaosha_list'])){ ?>
        <?php foreach($output['miaosha_list'] as $k => $val){ ?>
        <tr class="hover">
           <td class="sort"><span title="<?php echo $lang['nc_editable'];?>" ajax_branch='ajax_miaosha_sort' datatype="number" fieldid="<?php echo $val['miaosha_id'];?>" fieldname="m_sort" nc_type="inline_edit" class="editable"><?php echo $val['m_sort'];?></span></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=show_miaosha&op=miaosha_detail&group_id=".$val['miaosha_id'];?>"><img src="<?php echo $val['goods_image'];?>" style=" max-width: 56px; max-height: 56px;"/></a></span></div></td>
          <td class="group"><p><a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=show_miaosha&op=miaosha_detail&group_id=".$val['miaosha_id'];?>"><?php echo $val['miaosha_name'];?></a></p>
            <p class="goods"><?php echo $lang['miaosha_index_goods_name'];?>:<a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=goods&goods_id=".$val['goods_id'];?>" title="<?php echo $val['goods_name'];?>"><?php echo $val['goods_name'];?></a></p>
            <p class="store"><?php echo $lang['miaosha_index_store_name'];?>:<a href="<?php echo urlShop('show_store','index', array('store_id'=>$val['store_id']));?>" title="<?php echo $val['store_name'];?>"><?php echo $val['store_name'];?></a>
<?php if (isset($output['flippedOwnShopIds'][$val['store_id']])) { ?>
            <span class="ownshop">[自营]</span>
<?php } ?>
            </p></td>
          <td  class="align-center nowarp"><?php echo $val['start_time_text'];?></td>
          <td  class="align-center nowarp"><?php echo $val['end_time_text'];?></td>
          <td class="align-center"><?php echo $val['miaosha_price']; ?></td>
          <td class="align-center"><?php echo ($val['max_quantity'] == 0)?'不限':$val['max_quantity']; ?></td>
            <td class="align-center"><?php echo ($val['upper_limit'] == 0)?'不限':$val['upper_limit'];?></td>
          <td class="align-center"><?php echo $val['miaosha_state_text'];?></td>
        <td class="align-center">
            <?php if($val['end_time'] < TIMESTAMP && $val['state'] == '20'){?>
            <a nctype="btn_miaosha_edit" data-miaosha-id="<?php echo $val['miaosha_id'];?>" href="<?php echo urlAdmin('miaosha', 'miaosha_cancel',array('miaosha_id'=>$val['miaosha_id']));?>">解锁商品</a>
            <?php } ?>
            <a nctype="btn_miaosha_edit" data-miaosha-id="<?php echo $val['miaosha_id'];?>" href="<?php echo urlAdmin('miaosha', 'miaosha_edit',array('miaosha_id'=>$val['miaosha_id']));?>">编辑</a>
            <a nctype="btn_del" data-miaosha-id="<?php echo $val['miaosha_id'];?>" href="javascript:;">删除</a>
        </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="16"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['miaosha_list']) && is_array($output['miaosha_list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td colspan="16"><label>
            &nbsp;&nbsp;
            <div class="pagination"><?php echo $output['show_page'];?> </div></td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
<form id="op_form" action="" method="POST">
    <input type="hidden" id="miaosha_id" name="miaosha_id">
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript">
$(function(){
	//商品分类
	init_gcselect(<?php echo $output['gc_choose_json'];?>,<?php echo $output['gc_json']?>);

  $('#query_start_time').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_time').datepicker({dateFormat: 'yy-mm-dd'});

});
    $(document).ready(function() {

        $('[nctype="btn_review_fail"]').on('click', function() {
            if(confirm('确认拒绝该秒杀申请？')) {
                var action = '<?php echo urlAdmin('miaosha', 'miaosha_review_fail');?>';
                var miaosha_id = $(this).attr('data-miaosha-id');
                $('#op_form').attr('action', action);
                $('#miaosha_id').val(miaosha_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_cancel"]').on('click', function() {
            if(confirm('确认取消该秒杀活动？')) {
                var action = '<?php echo urlAdmin('miaosha', 'miaosha_cancel');?>';
                var miaosha_id = $(this).attr('data-miaosha-id');
                $('#op_form').attr('action', action);
                $('#miaosha_id').val(miaosha_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_del"]').on('click', function() {
            if(confirm('确认删除该秒杀活动？')) {
                var action = '<?php echo urlAdmin('miaosha', 'miaosha_del');?>';
                var miaosha_id = $(this).attr('data-miaosha-id');
                $('#op_form').attr('action', action);
                $('#miaosha_id').val(miaosha_id);
                $('#op_form').submit();
            }
        });
    });
</script>
