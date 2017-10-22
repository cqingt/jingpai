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
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>秒杀活动列表</li>
          </ul></td>
      </tr>
    </tbody>
  </table>

  <form id="list_form" method='post'>
    <input id="class_id" name="class_id" type="hidden" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="align-center">活动名称</th>
          <th class="align-center">活动开始小时</th>
          <th class="align-center">活动结束小时</th>
          <th class="align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
          <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
              <?php foreach($output['list'] as $val){ ?>
                  <tr class="thead">

                  <td><?php echo $val['class_name'];?></td>
                  <td><?php echo $val['start_hour'];?></td>
                  <td><?php echo $val['end_hour'];?></td>
                  <td><a nctype="btn_miaosha_edit"  href="<?php echo urlAdmin('miaosha', 'class_edit',array('class_id'=>$val['class_id']));?>">编辑</a>
                      <a nctype="btn_del"  href="javascript:submit_delete(<?php echo $val['class_id'];?>);">删除</a></td>
                  </tr>

              <?php } ?>
          <?php }else { ?>
      <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
      </tr>
      <?php } ?>

        <tr><td colspan="20"><a class="btn-add marginleft" href="<?php echo urlAdmin('miaosha', 'class_add');?>"><?php echo $lang['miaosha_hodong_add'];?></a></td></tr>
      </tbody>

    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".two").hide();
        $(".node_parent").click(function(){
            var node_id = $(this).attr('node_id');
            var state = $(this).attr('state');
            if(state == 'close') {
                $("."+node_id).show();
                $(this).attr('state','open');
                $(this).attr('src',"<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-collapsable.gif");
            }
            else {
                $("."+node_id).hide();
                $(this).attr('state','close');
                $(this).attr('src',"<?php echo ADMIN_TEMPLATES_URL;?>/images/tv-expandable.gif");
            }
        });
    });
function submit_delete_batch(){
    /* 获取选中的项 */
    var items = '';
    $('.checkitem:checked').each(function(){
        items += this.value + ',';
    });
    if(items != '') {
        items = items.substr(0, (items.length - 1));
        submit_delete(items);
    }
    else {
        alert('<?php echo $lang['nc_please_select_item'];?>');
    }
}
function submit_delete(id){
    if(confirm('<?php echo $lang['nc_ensure_del'];?>')) {
        $('#list_form').attr('method','post');
        $('#list_form').attr('action','index.php?act=miaosha&op=class_drop');
        $('#class_id').val(id);
        $('#list_form').submit();
    }
}

</script>
