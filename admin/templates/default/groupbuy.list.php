<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"/>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['groupbuy_index_manage'];?></h3>
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
    <input type="hidden" name="act" value="groupbuy">
    <input type="hidden" name="op" value="groupbuy_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="xianshi_name">团购名称</label></th>
          <td><input type="text" value="<?php echo $_GET['groupbuy_name'];?>" name="groupbuy_name" id="groupbuy_name" class="txt" style="width:100px;"></td>
          <th><label for="store_name"><?php echo $lang['store_name'];?></label></th>
          <td><input type="text" value="<?php echo $_GET['store_name'];?>" name="store_name" id="store_name" class="txt" style="width:100px;"></td>

          <td>检索时间<input type="text" id="sdate" name="sdate" class="txt date" value="<?php echo $_GET['sdate'];?>" >~<input type="text" id="edate" name="edate" class="txt date" value="<?php echo $_GET['edate'];?>" ></td>

          <th><label for="groupbuy_state">状态</label></th>
          <td>
              <select name="groupbuy_state" class="w90">
                  <?php if(is_array($output['groupbuy_state_array'])) { ?>
                  <?php foreach($output['groupbuy_state_array'] as $key=>$val) { ?>
                  <option value="<?php echo $key;?>" <?php if($key == $_GET['groupbuy_state']) { echo 'selected';}?>><?php echo $val;?></option>
                  <?php } ?>
                  <?php } ?>
              </select>
          </td>
          <th><label for="groupbuy_state">分类</label></th>
          <td>
              <select name="groupbuy1" id="groupbuy1">
                  <option value="0">请选择…</option>
                  <?php foreach($output['groupbuy1'] as $val) { ?>
                  <option value="<?php echo $val['class_id'];?>"><?php echo $val['class_name'];?></option>
                  <?php } ?>
              </select>
              <select name="groupbuy2" id="groupbuy2" style="display:none">
              </select>

          </td>
		  <th><label for="type_id">店铺类型</label></th>
		<td>
			<select name="type_id" id="type_id" class="querySelect"><option value="0">请选择...</option><option value="1" <?php if($_GET['type_id'] == 1) { echo 'selected';}?>>自运营店铺</option><option value="2" <?php if($_GET['type_id'] == 2) { echo 'selected';}?>>代运营店铺</option><option value="3" <?php if($_GET['type_id'] == 3) { echo 'selected';}?>>商家店铺</option></select>
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
            <li>管理员可以审核新的团购活动申请、取消进行中的团购活动或者删除团购活动</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="list_form" method="post">
    <input type="hidden" id="group_id" name="group_id"  />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th colspan="2"><?php echo $lang['groupbuy_index_name'];?></th>
          <th class="align-center" width="120"><?php echo $lang['groupbuy_index_start_time'];?></th>
          <th class="align-center" width="120"><?php echo $lang['groupbuy_index_end_time'];?></th>
          <th class="align-center" width="80"><?php echo $lang['groupbuy_index_click'];?></th>
          <th class="align-center" width="80">限购总数</th>
          <th class="align-center" width="80">已购买</th>
          <th class="align-center" width="80"><?php echo $lang['nc_recommend'];?></th>
          <th class="align-center" width="120"><?php echo $lang['groupbuy_index_state'];?></th>
          <th class="align-center" width="120">排序</th>
          <th class="align-center" width="120"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($output['groupbuy_list']) && is_array($output['groupbuy_list'])){ ?>
        <?php foreach($output['groupbuy_list'] as $k => $val){ ?>
        <tr class="hover">
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=show_groupbuy&op=groupbuy_detail&group_id=".$val['groupbuy_id'];?>"><img src="<?php echo cthumb($val['groupbuy_image1'], '60');?>" style=" max-width: 56px; max-height: 56px;"/></a></span></div></td>
          <td class="group"><p><a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=show_groupbuy&op=groupbuy_detail&group_id=".$val['groupbuy_id'];?>"><?php echo $val['groupbuy_name'];?></a></p>
            <p class="goods"><?php echo $lang['groupbuy_index_goods_name'];?>:<a target="_blank" href="<?php echo SHOP_SITE_URL."/index.php?act=goods&goods_id=".$val['goods_id'];?>" title="<?php echo $val['goods_name'];?>"><?php echo $val['goods_name'];?></a></p>
            <p class="store"><?php echo $lang['groupbuy_index_store_name'];?>:<a href="<?php echo urlShop('show_store','index', array('store_id'=>$val['store_id']));?>" title="<?php echo $val['store_name'];?>"><?php echo $val['store_name'];?></a>
<?php if (isset($output['flippedOwnShopIds'][$val['store_id']])) { ?>
            <span class="ownshop">[自营]</span>
<?php } ?>
            </p></td>
          <td  class="align-center nowarp"><?php echo $val['start_time_text'];?></td>
          <td  class="align-center nowarp"><?php echo $val['end_time_text'];?></td>
          <td class="align-center"><?php echo $val['views']; ?></td>
          <td class="align-center"><?php echo ($val['upper_limit'] == 0)?'不限':$val['upper_limit']; ?></td>
          <td class="align-center"><?php echo $val['buy_quantity']; ?></td>
          <td class="yes-onoff align-center"><?php if($val['recommended'] == '0'){ ?>
            <a href="JavaScript:void(0);" class=" disabled" ajax_branch='recommended' nc_type="inline_edit" fieldname="recommended" fieldid="<?php echo $val['groupbuy_id']?>" fieldvalue="0" title="<?php echo $lang['nc_editable'];?>"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif"></a>
            <?php }else { ?>
            <a href="JavaScript:void(0);" class=" enabled" ajax_branch='recommended' nc_type="inline_edit" fieldname="recommended" fieldid="<?php echo $val['groupbuy_id']?>" fieldvalue="1" title="<?php echo $lang['nc_editable'];?>"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif"></a>
            <?php } ?></td>
          <td class="align-center"><?php echo $val['groupbuy_state_text'];?></td>

<td class="align-center"><input type="text" onchange="paixu(<?php echo $val['groupbuy_id'];?>);" id="groupbuy_id_<?php echo $val['groupbuy_id'];?>" value="<?php echo $val['groupbuy_xu'];?>" style="width:40px;"></td>

        <td class="align-center">
            <a href="index.php?act=groupbuy&op=groupbuy_up&groupbuy_id=<?php echo $val['groupbuy_id'];?>">编辑</a>
            <?php if($val['reviewable']) { ?>
            <a nctype="btn_review_pass" data-groupbuy-id="<?php echo $val['groupbuy_id'];?>" href="javascript:;">通过</a>
            <a nctype="btn_review_fail" data-groupbuy-id="<?php echo $val['groupbuy_id'];?>" href="javascript:;">拒绝</a>
            <?php } ?>
            <?php if($val['state_flag'] == 'close' && $val['state'] == 20) { ?>
                <a href="<?php echo urlAdmin('groupbuy', 'groupbuy_unlock',array('groupbuy_id'=>$val['groupbuy_id']));?>">解锁商品</a>
            <?php } ?>
            <?php if($val['cancelable']) { ?>
            <a nctype="btn_cancel" data-groupbuy-id="<?php echo $val['groupbuy_id'];?>" href="javascript:;">取消</a>
            <?php } ?>
            <a nctype="btn_del" data-groupbuy-id="<?php echo $val['groupbuy_id'];?>" href="javascript:;">删除</a>
        </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="16"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['groupbuy_list']) && is_array($output['groupbuy_list'])){ ?>
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
    <input type="hidden" id="groupbuy_id" name="groupbuy_id">
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#sdate').datepicker({dateFormat: 'yy-mm-dd'});
        $('#edate').datepicker({dateFormat: 'yy-mm-dd'});


        $('[nctype="btn_review_pass"]').on('click', function() {
            if(confirm('确认通过该团购申请？')) {
                var action = '<?php echo urlAdmin('groupbuy', 'groupbuy_review_pass');?>';
                var groupbuy_id = $(this).attr('data-groupbuy-id');
                $('#op_form').attr('action', action);
                $('#groupbuy_id').val(groupbuy_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_review_fail"]').on('click', function() {
            if(confirm('确认拒绝该团购申请？')) {
                var action = '<?php echo urlAdmin('groupbuy', 'groupbuy_review_fail');?>';
                var groupbuy_id = $(this).attr('data-groupbuy-id');
                $('#op_form').attr('action', action);
                $('#groupbuy_id').val(groupbuy_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_cancel"]').on('click', function() {
            if(confirm('确认取消该团购活动？')) {
                var action = '<?php echo urlAdmin('groupbuy', 'groupbuy_cancel');?>';
                var groupbuy_id = $(this).attr('data-groupbuy-id');
                $('#op_form').attr('action', action);
                $('#groupbuy_id').val(groupbuy_id);
                $('#op_form').submit();
            }
        });

        $('[nctype="btn_del"]').on('click', function() {
            if(confirm('确认删除该团购活动？')) {
                var action = '<?php echo urlAdmin('groupbuy', 'groupbuy_del');?>';
                var groupbuy_id = $(this).attr('data-groupbuy-id');
                $('#op_form').attr('action', action);
                $('#groupbuy_id').val(groupbuy_id);
                $('#op_form').submit();
            }
        });

        // 选择不同的一级分类的时候
        $("#groupbuy1").change(function(){
            var groupbuy1 = $("#groupbuy1").val();
            if (groupbuy1 != 0) {
                $.ajax({
                   type: "POST",
                   url: "index.php?act=groupbuy&op=getGroupbuy2",
                   data: "groupbuy1="+groupbuy1,
                   success: function(msg){
                    
                     $("#groupbuy2").css("display", "");

                     $("#groupbuy2").empty();

                     $("#groupbuy2").append(msg);
                   }
                });
            } else {
                $("#groupbuy2").css("display", "none").empty();

            }
        });

        
    });


  function paixu(id){
    var xu = $("#groupbuy_id_" + id).val();
    $.ajax({
      type: "GET",
      cache: false,
      url : "index.php?act=groupbuy&op=ajax_groupbuy_xu",
      data: 'groupbuy_id=' + id + '&groupbuy_xu=' + xu,
      success : function(html){
        if(html == 'ok'){
          alert('成功修改排序为'+xu);
        }
      }
    })
  }


</script>
