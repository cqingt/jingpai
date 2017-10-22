<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <form method="post" name="form1" id="form1" action="<?php echo urlAdmin('goods', 'goods_leimu');?>">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" value="<?php echo $output["commonids"];?>" name="commonids">
    <table class="table tb-type2 nobdb">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="close_reason">选择商品要调整的新类目:</label></td>
        </tr>
        <tr>
          <td id="search_class_td"></td>
		  <input type="hidden" id="choose_classid" name="choose_classid" value="0"/>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="javascript:void(0);" class="btn" nctype="btn_submit"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script>
var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
$(function(){
	//商品分类
	init_class_select(<?php echo $output['gc_choose_json'];?>,<?php echo $output['gc_json']?>);
	
    $('a[nctype="btn_submit"]').click(function(){
        ajaxpost('form1', '', '', 'onerror');
    });
});

//显示一级分类下拉框
function show_class_1(depth,gc_json){
	var html = '<select name="search_class[]" id="search_class_0" nc_type="search_class" class="querySelect">';;
	html += ('<option value="0">请选择...</option>');
	if(gc_json){
		for(var i in gc_json){
			if(gc_json[i].depth == 1){
				html += ('<option value="'+gc_json[i].gc_id+'">'+gc_json[i].gc_name+'</option>');
			}
		}
	}
	html += '</select>';
	$("#search_class_td").html(html);
}
//显示子分类下拉框
function show_class_2(chooseid,gc_json){
	if(gc_json && chooseid > 0){
		var childid = gc_json[chooseid].child;
		if(childid){
			var html = '<select name="search_class[]" id="search_class_'+gc_json[chooseid].depth+'" nc_type="search_class" class="querySelect">';;
			html += ('<option value="0">请选择...</option>');
			var childid_arr = childid.split(",");
			if(childid_arr){
				for(var i in childid_arr){
					html += ('<option value="'+gc_json[childid_arr[i]].gc_id+'">'+gc_json[childid_arr[i]].gc_name+'</option>');
				}
			}
			html += '</select>';
			$("#search_class_td").append(html);
		}
	}
}
//初始化商品分类select
//chooseid_arr为已选gc_id的json数组
function init_class_select(chooseid_json,gc_json){
	show_class_1(1,gc_json);
	if(chooseid_json){
		for(var i in chooseid_json){
			show_class_2(chooseid_json[i],gc_json);
			$('#search_class_'+i).val(chooseid_json[i]);
			$('#choose_classid').val(chooseid_json[i]);
		}
	}
	//商品分类select绑定事件
	$("[nc_type='search_class']").live('change',function(){
        $(this).nextAll("[nc_type='search_class']").remove();
        var chooseid = $(this).val();
		if(chooseid > 0){
			$("#choose_classid").val(chooseid);
			show_class_2(chooseid,gc_json);
		} else {
			chooseid = $(this).prev().val();
			$("#choose_classid").val(chooseid);
		}
    });
}
</script>