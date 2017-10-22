<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['vipsale_index_manage'];?></h3>
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
    <input type="hidden" name="act" value="vipsale">
    <input type="hidden" name="op" value="vipsale_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="xianshi_name">商品名称</label></th>
          <td><input type="text" value="<?php echo $_GET['search_goods_name'];?>" name="search_goods_name" id="search_goods_name" class="txt" style="width:100px;"></td>
          <th><label for="store_name"><?php echo $lang['store_name'];?></label></th>
          <td><input type="text" value="<?php echo $_GET['store_name'];?>" name="store_name" id="store_name" class="txt" style="width:100px;"></td>
          <th><label for="vipsale_state">状态</label></th>
          <td>
              <select name="vipsale_state" class="w90">
                  <?php if(is_array($output['vipsale_state_array'])) { ?>
                  <?php foreach($output['vipsale_state_array'] as $key=>$val) { ?>
                  <option value="<?php echo $key;?>" <?php if($key == $_GET['vipsale_state']) { echo 'selected';}?>><?php echo $val;?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
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
            <li>管理员可以审核新的会员特价活动申请、取消进行中的会员特价活动或者删除会员特价活动</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method="post">
    <input type="hidden" id="group_id" name="group_id"  />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th colspan="2"><?php echo $lang['goods_name'];?></th>
          <th class="align-center" width="120"><?php echo $lang['vipsale_index_start_time'];?></th>
          <th class="align-center" width="120"><?php echo $lang['vipsale_index_end_time'];?></th>
          <th class="align-center" width="120">会员级别限制</th>
            <th class="align-center" width="80"><?php echo $lang['vipsale_price'];?></th>
          <th class="align-center" width="80"><?php echo $lang['max_quantity'];?></th>
            <th class="align-center" width="80"><?php echo $lang['sale_quantity'];?></th>
          <th class="align-center" width="120"><?php echo $lang['vipsale_state_name'];?></th>
          <th class="align-center" width="120"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($output['vipsale_list']) && is_array($output['vipsale_list'])){ ?>
        <?php foreach($output['vipsale_list'] as $k => $val){ ?>
        <tr class="hover">
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=>$val['goods_id']));?>"><img src="<?php echo $val['goods_image'];?>" style=" max-width: 56px; max-height: 56px;"/></a></span></div></td>
          <td class="group"><p><a target="_blank" href="<?php echo urlShop('goods','index',array('id'=>$val['goods_id']));?>"><?php echo $val['vipsale_name'];?></a></p>
            <p class="goods"><?php echo $lang['vipsale_index_goods_name'];?>:<a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=goods&goods_id=".$val['goods_id'];?>" title="<?php echo $val['goods_name'];?>"><?php echo $val['goods_name'];?></a></p>
            <p class="store"><?php echo $lang['vipsale_index_store_name'];?>:<a href="<?php echo urlShop('show_store','index', array('store_id'=>$val['store_id']));?>" title="<?php echo $val['store_name'];?>"><?php echo $val['store_name'];?></a>
<?php if (isset($output['flippedOwnShopIds'][$val['store_id']])) { ?>
            <span class="ownshop">[自营]</span>
<?php } ?>
            </p></td>
          <td  class="align-center nowarp"><?php echo $val['start_time_text'];?></td>
          <td  class="align-center nowarp"><?php echo $val['end_time_text'];?></td>
          <td class="align-center"><?php echo $val['level_name'].'及以上级别'; ?></td>
          <td class="align-center"><?php echo $val['vipsale_price']; ?></td>
          <td class="align-center"><?php echo ($val['max_quantity'] == 0)?'不限':$val['max_quantity']; ?></td>
            <td class="align-center"><?php echo ($val['upper_limit'] == 0)?'不限':$val['upper_limit'];?></td>
          <td class="align-center"><?php echo $val['vipsale_state_text'];?></td>
        <td class="align-center">
            <?php if($val['end_time'] < TIMESTAMP && $val['state'] == '20'){?>
            <a nctype="btn_vipsale_edit" data-vipsale-id="<?php echo $val['vipsale_id'];?>" href="<?php echo urlAdmin('vipsale', 'vipsale_cancel',array('vipsale_id'=>$val['vipsale_id']));?>">解锁商品</a>
            <?php } ?>
            <a nctype="btn_vipsale_edit" data-vipsale-id="<?php echo $val['vipsale_id'];?>" href="<?php echo urlAdmin('vipsale', 'vipsale_edit',array('vipsale_id'=>$val['vipsale_id']));?>">编辑</a>
            <a nctype="btn_del" data-vipsale-id="<?php echo $val['vipsale_id'];?>" href="javascript:;">删除</a>
        </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="16"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['vipsale_list']) && is_array($output['vipsale_list'])){ ?>
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
    <input type="hidden" id="vipsale_id" name="vipsale_id">
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('[nctype="btn_review_fail"]').on('click', function() {
            if(confirm('确认拒绝该会员特价申请？')) {
                var action = '<?php echo urlAdmin('vipsale', 'vipsale_review_fail');?>';
                var vipsale_id = $(this).attr('data-vipsale-id');
                $('#op_form').attr('action', action);
                $('#vipsale_id').val(vipsale_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_cancel"]').on('click', function() {
            if(confirm('确认取消该会员特价活动？')) {
                var action = '<?php echo urlAdmin('vipsale', 'vipsale_cancel');?>';
                var vipsale_id = $(this).attr('data-vipsale-id');
                $('#op_form').attr('action', action);
                $('#vipsale_id').val(vipsale_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_del"]').on('click', function() {
            if(confirm('确认删除该会员特价活动？')) {
                var action = '<?php echo urlAdmin('vipsale', 'vipsale_del');?>';
                var vipsale_id = $(this).attr('data-vipsale-id');
                $('#op_form').attr('action', action);
                $('#vipsale_id').val(vipsale_id);
                $('#op_form').submit();
            }
        });
    });
</script>
