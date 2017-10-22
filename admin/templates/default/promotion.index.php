<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['promotion_index_manage'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=promotion&op=new" ><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="act" value="promotion">
    <input type="hidden" name="op" value="promotion">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="searchtitle"><?php echo $lang['promotion_index_title']; ?></label></th>
          <td><input type="text" name="searchtitle" id="searchtitle" class="txt" value='<?php echo $_GET['searchtitle'];?>'></td>
          <th colspan="1"><label for="searchstartdate">
            <input name="searchstate" type="hidden" id="searchstate" value="1" />
          <?php echo $lang['promotion_index_periodofvalidity']; ?></label></th>
          <td>
            <input type="text" name="searchstartdate" id="searchstartdate" class="txt date" readonly='' value='<?php echo $_GET['searchstartdate'];?>'>~<input type="text" name="searchenddate" id="searchenddate" class="txt date" readonly='' value='<?php echo $_GET['searchenddate'];?>'></td>
          <th colspan="1"><label for="searchstartdate"><?php echo $lang['promotion_weizhi']; ?></label></th>
          <td>
          <select name="promotion_state" id="promotion_state">
            <?php foreach($output['typeArr'] as $k=>$v){ ?>
              <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php } ?>
          </select>
          </td>
          <th><label for="groupbuy_state">分类</label></th>
          <td>
              <select name="promotion1" id="promotion1">
                  <option value="0">请选择…</option>
                  <?php foreach($output['promotion1'] as $val) { ?>
                  <option value="<?php echo $val['gc_id'];?>"><?php echo $val['gc_name'];?></option>
                  <?php } ?>
              </select>
              <select name="promotion2" id="promotion2" style="display:none">
              </select>
              <select name="promotion3" id="promotion3" style="display:none">
              </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
  <form id="listform" action="index.php" method='post'>
    <input type="hidden" name="act" value="promotion" />
    <input type="hidden" id="listop" name="op" value="del" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">&nbsp;</th>
          <th class="w48 "><?php echo $lang['nc_sort'];?></th>
          <th class="w270"><?php echo $lang['promotion_index_title'];?></th>
          <th class="align-center"><?php echo $lang['promotion_weizhi'];?></th>
          <th class="align-center"><?php echo $lang['promotion_index_start'];?></th>
          <th class="align-center"><?php echo $lang['promotion_index_end'];?></th>
          <th class="align-center"><?php echo $lang['promotion_cate_name'];?></th>
          <th class="w150 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody id="treet1">
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <?php foreach($output['list'] as $k => $v){ ?>
        <tr class="hover edit row">
          <td><input type="checkbox" name='promotion_id[]' value="<?php echo $v['p_id'];?>" class="checkitem"></td>
          <td class="sort"><span class=" editable" title="<?php echo $lang['nc_editable'];?>" required="1" fieldid="<?php echo $v['promotion_id'];?>" ajax_branch='promotion_sort' fieldname="promotion_sort" nc_type="inline_edit" ><?php echo $v['promotion_sort'];?></span></td>
          <td class="name"><span class=" editable" title="<?php echo $lang['nc_editable'];?>" required="1" fieldid="<?php echo $v['promotion_id'];?>" ajax_branch='promotion_title' fieldname="promotion_title" nc_type="inline_edit" ><?php echo $v['promotion_title'];?></span></td>
          <td class="nowrap align-center"><?php echo $output['typeArr'][$v['promotion_state']];?></td>
          <td class="nowrap align-center"><?php echo @date('Y-m-d',$v['promotion_start_date']);?></td>
          <td class="align-center"><?php echo @date('Y-m-d',$v['promotion_end_date']);?></td>
          <td class="align-center">
        <?php
      if($v['promotion_state']){
        echo "全品类"; 
      }else{
        echo str_replace(' ','>',$v['cate_name']);
      }
      ?>
          </td>
          <td class="align-center">
            <a href="index.php?act=promotion&op=edit&promotion_id=<?php echo $v['p_id'];?>"><?php echo $lang['nc_edit'];?></a>&nbsp;|&nbsp;
            <a href="javascript:void(0)" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){location.href='index.php?act=promotion&op=del&promotion_id=<?php echo $v['p_id'];?>';}"><?php echo $lang['nc_del'];?></a>
          </td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="9"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom" name="chkVal"></td>
          <td colspan="15"><label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="submit_form('del');"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"> <?php echo $output['show_page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/jquery.ui.js";?>"></script> 
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/i18n/zh-CN.js";?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.goods_class.js" charset="utf-8"></script>
<script type="text/javascript">
$("#searchstartdate").datepicker({dateFormat: 'yy-mm-dd'});
$("#searchenddate").datepicker({dateFormat: 'yy-mm-dd'});
function submit_form(op){
  if(op=='del'){
    if(!confirm('<?php echo $lang['nc_ensure_del'];?>')){
      return false;
    }
  }
  $('#listop').val(op);
  $('#listform').submit();
}
$(document).ready(function() {
        // 选择不同的一级分类的时候
        $("#promotion1").change(function(){
            var promotion1 = $("#promotion1").val();
            if (promotion1 > 0) {
                $.ajax({
                   type: "POST",
                   url: "index.php?act=promotion&op=getPromotion2",
                   data: "promotion1="+promotion1,
                   success: function(msg){
                    
                     $("#promotion2").css("display", "");
                     $("#promotion3").css("display", "none");
                     $("#promotion2").empty();
                     $("#promotion3").empty();
                     $("#promotion2").append(msg);
                   }
                });
            } else {
                $("#promotion2").css("display", "none").empty();
                $("#promotion3").css("display", "none").empty();
            }
        });

        // 选择不同的二级分类的时候
        $("#promotion2").change(function(){
            var promotion2 = $("#promotion2").val();
            if(promotion2 > 0){
              $.ajax({
                 type: "POST",
                 url: "index.php?act=promotion&op=getPromotion3",
                 data: "promotion2="+promotion2,
                 success: function(msg){
                   $("#promotion3").css("display", "");
                   $("#promotion3").empty();
                   $("#promotion3").append(msg);
                 }
              });
            }else{
              $("#promotion3").css("display", "none").empty();
            }
        });
    });
</script>