<?php defined('InShopNC') or exit('Access Invalid!');?>
<style>
/* 促销活动-限时折扣-选择商品 */
.div-goods-select-box { position: relative; z-index: 1; zoom: 1;}
.div-goods-select { background-color: #FFF; margin-bottom: 20px; border: solid 1px #E6E6E6; position: relative; z-index: 1; zoom: 1;}
.div-goods-select .close,
.div-goods-select-box .close { font: lighter 18px/18px Verdana; color: #E6E6E6; background-color: #FFF; text-align: center; display: block; width: 20px; height: 20px; border: 1px solid #E6E6E6; border-radius: 22px; position: absolute; z-index: 1; top: -11px; right: -11px; cursor: pointer;}
.div-goods-select .search-result { width: 949px; margin: 0 auto; overflow: hidden;}
.div-goods-select .search-result .goods-list { font-size: 0; *word-spacing: -1px/*IE6、7*/; width: 950px; border: solid #E6E6E6; border-width: 0 0 1px 0; margin-right: -1px; }
.div-goods-select .search-result .goods-list li { font: 12px/32px arial,"宋体"; vertical-align: top; letter-spacing: normal; word-spacing: normal; display: inline-block; *display: inline/*IE7*/; width: 149px; padding: 10px 20px; margin: 0 0 -1px 0; border-style: solid; border-color: #E6E6E6; border-width: 0 1px 1px 0; overflow: hidden; zoom: 1;}
.div-goods-select .search-result .goods-thumb { line-height: 0; background-color: #FFF; text-align: center; vertical-align: middle; display: table-cell; *display: block; width: 140px; height: 140px; padding: 4px; overflow: hidden;}
.div-goods-select .search-result .goods-thumb img { max-width: 140px; max-height: 140px; margin-top:expression(140-this.height/2); *margin-top:expression(70-this.height/2)/*IE6,7*/;}
.div-goods-select .search-result .goods-info { border: none;}
.div-goods-select .search-result .goods-info dt { text-align: left; width: auto; display: block; line-height: 16px; height: 32px; padding: 0; overflow: hidden;}
.div-goods-select .search-result .goods-info dd { line-height: 20px; height: auto !important; padding: 5px 0;}
.div-goods-select .norecord { font-size: 12px; color: #AAA; text-align: center; display: block; padding: 40px 0;}
.dialog_content .selected-goods-info { width: 94%; margin: 10px auto; overflow: hidden;}
.dialog_content .selected-goods-info .goods-thumb { line-height: 0; background-color: #FFF; text-align: center; vertical-align: middle; display: table-cell; *display: block; width: 118px; height: 118px; float: left; padding: 0; border: solid 1px #E6E6E6; overflow: hidden;}
.dialog_content .selected-goods-info .goods-thumb img { max-width: 118px; max-height: 118px; margin-top:expression(118-this.height/2); *margin-top:expression(59-this.height/2)/*IE6,7*/;}

.selected-goods-info .goods-info { float: right; width: 280px; }
.selected-goods-info .goods-info dt { line-height: 20px !important; font-weight: 600; height: 40px !important; overflow: hidden;}
.selected-goods-info .goods-info dd { line-height: 30px !important; height: 30px !important; display: block; padding: 5px 0; border-top: dotted 1px #F7F7F7; }

/*满送活动规则*/
.ncsc-mansong-error span { font-size: 12px; color: #F00; margin-bottom: 5px;}
.ncsc-mansong-error i { margin-right: 4px;}
.selected-mansong-goods { background-color: #FFF; width: 162px; padding: 9px; border: solid 1px #E6E6E6; box-shadow: 2px 2px 0 rgba(153,153,153,0.1); margin-top: 10px;}
.selected-mansong-goods .goods-thumb { line-height: 0; background-color: #FFF; text-align: center; vertical-align: middle; display: table-cell; *display: block; width: 160px; height: 160px; border: solid 1px #F5F5F5; overflow: hidden;}
.selected-mansong-goods .goods-thumb img { max-width: 160px; max-height: 160px; margin-top:expression(160-this.height/2); *margin-top:expression(80-this.height/2)/*IE6,7*/;}
.ncsc-mansong-rule span { *line-height: normal !important; *height: auto !important; *margin-top: 0 !important; *zoom:0 !important;}
.ncsc-mansong-rule .gift { clear: both;}
.ncsc-mansong-rule-list {}
.ncsc-mansong-rule-list li { color: #3A87AD; filter:progid:DXImageTransform.Microsoft.gradient(enabled='true',startColorstr='#3FD9EDF7', endColorstr='#3FD9EDF7');background:rgba(217,237,247,0.25); border: dashed 1px #BCE8F1; padding: 4px 9px; margin-bottom: 10px;}

.ncsc-mansong-rule-list li strong { color: #F30; font-weight: 600;}
.ncsc-mansong-rule-list li .goods-thumb { vertical-align: middle; display: inline-block; width: 32px; height: 32px; border: solid 1px #BCE8F1; margin-left: 2px;}
.ncsc-mansong-rule-list li .goods-thumb img { max-width: 32px; max-height: 32px;}
.ncsc-mansong-rule-list li .ncsc-btn-mini { float: right; display: inline-block; margin-top: 5px;}
</style>
<div class="page">
  <!-- 页面导航 -->
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['promotion_mansong'];?></h3>
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
  <div class="fixed-empty"></div>

  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=promotion_mansong&op=mansong_save">
    <input type="hidden" id="submit_type" name="submit_type" />
    <table class="table tb-type2">
      <tbody>

        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation">活动名称:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="text" id="mansong_name" name="mansong_name" value="<?php echo $output['mansong']['mansong_name'];?>" class="txt">
				<span class="error-message"></span>
            </td>
            <td class="vatop tips">活动名称最多为25个字符</td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">开始时间:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="text" id="start_time" name="start_time" value="<?php echo $output['mansong']['start_time'] == '' ? '' : date('Y-m-d H:i',$output['mansong']['start_time']);?>" class="txt" readonly="readonly">
				<span class="error-message"></span>
            </td>
            <td class="vatop tips">开始时间不能为空且不能早于<?php echo date('Y-m-d H:i',$output['start_time']);?></td>
        </tr>
		

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">结束时间:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <input type="text" id="end_time" name="end_time" value="<?php echo $output['mansong']['end_time'] == '' ? '' : date('Y-m-d H:i',$output['mansong']['end_time']);?>" class="txt" readonly="readonly">
				<span class="error-message"></span>
            </td>
            <td class="vatop tips">结束时间不能为空且不能晚于<?php echo date('Y-m-d H:i',$output['end_time']);?></td>
        </tr>
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">活动方式：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                 <select name="mansong_type" id="mansong_type">
					  <option value="1" <?php if($output['mansong']['mansong_type'] == 1){ ?>selected<?php } ?>>普通满即送（可多个规则叠加）</option>
					  <option value="2" <?php if($output['mansong']['mansong_type'] == 2){ ?>selected<?php } ?>>每满N元送（只能添加一个规则）</option>
				  </select>
            </td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">优惠店铺：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
				<input type="text" id="store_name" name="store_name" value="<?php echo $output['mansong']['store_name'];?>" class="txt" style="width: 245px;">
				&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn-search " title="查询">&nbsp;</a>
				<span class="error-message"></span>
            </td>
			<td class="vatop tips" id="storeArr"></td>
        </tr>

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">优惠范围：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                  <select name="cate_rule" id="cate_rule">
					  <option value="1" <?php if($output['mansong']['cate_rule'] == 1){ ?>selected<?php } ?>>全部店铺分类商品参加</option>
					  <option value="2" <?php if($output['mansong']['cate_rule'] == 2){ ?>selected<?php } ?>>按店铺分类选择参加</option>
					  <option value="3" <?php if($output['mansong']['cate_rule'] == 3){ ?>selected<?php } ?>>按商品选择参加</option>
				  </select>
            </td>
        </tr>

		<tr class="noborder" id="category_tree" style="display:none">
            <td class="vatop rowform" style="width: 80px;"><label class="validation">选择分类：</label></td>  
			<td class="vatop tips" id="goods_class"></td>
		</tr>

		<tr class="noborder" id="store_cates_list">
		</tr>
		

		<tr class="noborder" id="diff_goods">
			<td class="vatop rowform" style="width: 80px;"><label class="validation" id="gname_title">排除商品：</label></td>
			<td class="vatop">
					<table class="ncsc-default-table mb15">
                  <thead>
                  <tr>
                      <th class="tl" colspan="2" id="gname_title">商品名称（排除商品不参加该促销活动）</th>
                      <th class="w90"><?php echo $lang['nc_common_button_operate'];?></th>
                  </tr>
                  </thead>
                  <tbody nctype="bundling_data"  class="bd-line tip">
                  <?php if(!empty($output['b_goods_list'])){?>
                      <?php foreach($output['b_goods_list'] as $val){?>
                          <?php if (isset($output['goods_list'][$val['goods_id']])) {?>
                              <tr id="bundling_tr_<?php echo $val['goods_id']?>" class="off-shelf">
                                  <input type="hidden" value="<?php echo $val['bl_goods_id'];?>" name="goods[<?php echo $val['goods_id'];?>][bundling_goods_id]" />
                                  <input type="hidden" value="<?php echo $val['goods_id'];?>" name="goods_ids[]" nctype="goods_id">
                                  <td class="w50"><div class="shelf-state"><div class="pic-thumb"><img src="<?php echo cthumb($output['goods_list'][$val['goods_id']]['goods_image'], 60, $_SESSION['store_id']);?>" ncname="<?php echo $output['goods_list'][$val['goods_id']]['goods_image'];?>" nctype="bundling_data_img">
                                          </div></div>
                                  </td>
                                  <td class="tl"><dl class="goods-name">
                                          <dt style="width: 300px;"><?php echo $output['goods_list'][$val['goods_id']]['goods_name'];?></dt>
                                      </dl></td>
                                  <td class="nscs-table-handle w90"><span><a onclick="bundling_operate_delete($('#bundling_tr_<?php echo $val['goods_id']?>'), <?php echo $val['goods_id']?>)" href="JavaScript:void(0);" class="btn-orange"><i class="icon-ban-circle"></i>
                                              <p>移除</p>
                                          </a></span></td>
                              </tr>
                          <?php }?>
                      <?php }?>
                  <?php }?>
                  </tbody>
              </table>
              <a id="bundling_add_goods" href="JavaScript:void(0);" class="ncsc-btn ncsc-btn-acidblue">添加排除商品</a>
              <div class="div-goods-select-box">
                  <div id="bundling_add_goods_ajaxContent"></div>
                  <a id="bundling_add_goods_delete" class="close" href="javascript:void(0);" style="display: none; right: -10px;">X</a></div>
			</td>
		</tr>
		
	
		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">满即送规则：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
				<input type="hidden" id="mansong_rule_count" name="rule_count">
				<ul id="mansong_rule_list" class="ncsc-mansong-rule-list">
				</ul>
				<a href="javascript:void(0);" id="btn_add_rule" class="ncsc-btn ncsc-btn-acidblue"><i class="icon-plus-sign"></i>添加规则</a>
            </td>
			<td class="vatop tips">
					<div id="div_add_rule" style="display:none;">
        <div class="ncsc-mansong-error"><span id="mansong_price_error" style="display:none;"><i class="icon-exclamation-sign"></i>规则金额不能为空且必须为数字</span><span id="mansong_discount_error" style="display:none;"><i class="icon-exclamation-sign"></i>满减金额必须小于规则金额</span></div>
        <div class="ncsc-mansong-rule">
        <span>单笔订单满&nbsp;<input id="mansong_price" type="text" class="text w50"><em class="add-on"><i class="icon-renminbi"></i></em>，</span>
        <span>立减现金&nbsp;<input id="mansong_discount" type="text" class="text w50"><em class="add-on"><i class="icon-renminbi"></i></em>，</span>
        <span>送礼品&nbsp;<a href="javascript:void(0);" id="btn_show_search_goods" class="ncsc-btn"><i class="icon-gift"></i>选择礼品</a></span> <div id="mansong_goods_item" class="gift"></div>

        <div id="div_search_goods" class="div-goods-select mt10" style="display: none;">
                    <table class="search-form">
                        <tr>
                            <th class="w150">
                                <strong>第一步：搜索店内商品</strong>
                            </th>
                            <td class="w160">
                                <input id="search_goods_name" type="text w150" class="text" name="goods_name" value=""/>
                            </td>
                            <td class="w70 tc">
                                <a href="javascript:void(0);" id="btn_search_goods" class="ncsc-btn"/><i class="icon-search"></i><?php echo $lang['nc_search'];?></a>
                            </td>
                            <td class="w10"></td>
                            <td>
                                <p class="hint">不输入名称直接搜索将显示店内所有出售中的商品</p>
                            </td>
                        </tr>
                    </table>
                    <a id="btn_hide_search_goods" class="close" href="javascript:void(0);">X</a>
                    <div id="div_goods_search_result" class="search-result" style="width:739px;"></div>
                </div>
            </div>
            <div id="mansong_rule_error" style="display:none;">请至少选择一种促销方式</div>
            <div class="mt10">
            <a href="javascript:void(0);" id="btn_save_rule" class="ncsc-btn ncsc-btn-acidblue"><i class="icon-ok-circle"></i>确定规则设置</a>
            <a href="javascript:void(0);" id="btn_cancel_add_rule" class="ncsc-btn ncsc-btn-orange"><i class="icon-ban-circle"></i>取消</a></div>
        </div>
        <span class="error-message"></span>
        <p class="hint" style="margin-top: 10px;">设置当单笔订单满足金额时（必填选项），减免金额（选填）或赠送的礼品（选填）；留空为不做减免金额或赠送礼品处理。<br/>系统最多支持设置五组等级规则。</p>
			</td>
        </tr>
		

		<tr class="noborder">
          <td colspan="2" class="required"><label class="validation">备注：</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
				<textarea name="remark" rows="3" id="remark" maxlength="100"></textarea>
            </td>
			<td class="vatop tips">活动备注最多为100个字符</td>
        </tr>

      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15">
		  <input id="submit_button" type="submit" value="<?php echo $lang['nc_submit'];?>"  class="submitBtn">
		  </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script id="mansong_rule_template" type="text/html">
<li nctype="mansong_rule_item">
<span>单笔订单满<strong><%=price%></strong>元， </span>
<span>立减现金<strong><%=discount%></strong>元， </span>
<%if(goods_id>0){%>
<span>送礼品 <%==goods%></span>
<%}%>
<input type="hidden" name="mansong_rule[]" value="<%=price%>,<%=discount%>,<%=goods_id%>">
<a nctype="btn_del_mansong_rule" href="javascript:void(0);" class="ncsc-btn-mini ncsc-btn-red"><i class="icon-trash"></i>删除</a>
</li>
</script>
<script id="mansong_goods_template" type="text/html">
    <div nctype="mansong_goods" class="selected-mansong-goods">
    <a href="<%=goods_url%>" title="<%=goods_name%>" class="goods-thumb" target="_blank">
        <img src="<%=goods_image_url%>"/>
    </a>
    <input nctype="mansong_goods_id" type="hidden" value="<%=goods_id%>">
    </div><a nctype="btn_del_mansong_goods" href="javascript:void(0);" class="ncsc-btn-mini ncsc-btn-red"><i class="icon-trash"></i>删除已选择的礼品</a>
</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />


<script>
var SHOP_TEMPLATES_URL = "http://www.96567.com/shop/templates/default";
$("#start_time").datepicker({dateFormat: 'yy-mm-dd'});
$("#end_time").datepicker({dateFormat: 'yy-mm-dd'});

  // 限时添加规则窗口
$('#btn_add_rule').on('click', function() {
	$('#mansong_price').val('');
	$('#mansong_discount').val('');
	$('#mansong_goods_item').html('');
	$('#mansong_price_error').hide();
	$('#mansong_rule_error').hide();
	$('#div_add_rule').show();
	$('#btn_add_rule').hide();
});
 // 规则保存
$('#btn_save_rule').on('click', function() {
	var mansong = {};
	mansong.price = Number($('#mansong_price').val());
	if(isNaN(mansong.price) || mansong.price <= 0) {
		$('#mansong_price_error').show();
		return false;
	} else {
		$('#mansong_price_error').hide();
	}
	mansong.discount = Number($('#mansong_discount').val());
	if(isNaN(mansong.discount) || mansong.discount < 0 || mansong.discount > mansong.price) {
		$('#mansong_discount_error').show();
		return false;
	} else {
		$('#mansong_discount_error').hide();
	}
	mansong.goods = $('#mansong_goods_item').find('[nctype="mansong_goods"]').html();
	mansong.goods_id = Number($('#mansong_goods_item').find('[nctype="mansong_goods_id"]').val());
	if(isNaN(mansong.goods_id)) {
		mansong.goods_id = 0;
	}
	if(mansong.discount == 0 && mansong.goods_id == 0) {
		$('#mansong_rule_error').show();
		return false;
	} else {
		$('#mansong_rule_error').hide();
	}
	var mansong_rule_item = template.render('mansong_rule_template', mansong);
	$('#mansong_rule_list').append(mansong_rule_item);
	close_div_add_rule();
});

// 删除已添加的规则
$('#mansong_rule_list').on('click', '[nctype="btn_del_mansong_rule"]', function() {
	$(this).parents('[nctype="mansong_rule_item"]').remove();
	close_div_add_rule();
});

// 取消添加规则
$('#btn_cancel_add_rule').on('click', function() {
	close_div_add_rule();
});

  // 关闭规则添加窗口
function close_div_add_rule() {
	var rule_count = $('#mansong_rule_list').find('[nctype="mansong_rule_item"]').length;
	if( rule_count >= 5) {
		$('#btn_add_rule').hide();
	} else {
		$('#btn_add_rule').show();
	}
	$('#div_add_rule').hide();
	$('#mansong_rule_count').val(rule_count);
}

// 限时商品选择窗口
$('#btn_show_search_goods').on('click', function() {
	$('#div_search_goods').show();
});

  // 搜索商品
    $('#btn_search_goods').on('click', function() {
		var store_id = $("#store_id").val();
		if(store_id == undefined){
			alert("请先搜索店铺");
			return false;
		}
        var url = "index.php?act=promotion_mansong&op=search_goods";
        url += '&' + $.param({goods_name: $('#search_goods_name').val()});
		url += '&store_id=' + store_id;
        $('#div_goods_search_result').load(url);
    });

    // 搜索商品翻页
    $('#div_goods_search_result').on('click', 'a.demo', function() {
        $('#div_goods_search_result').load($(this).attr('href'));
        return false;
    });

    // 关闭商品选择窗口
    $('#btn_hide_search_goods').on('click', function() {
        $('#div_search_goods').hide();
    });

    // 选择商品
    $('#div_goods_search_result').on('click', '[nctype="btn_add_mansong_goods"]', function() {
        var goods = {};
        goods.goods_id = $(this).attr('data-goods-id');
        goods.goods_name = $(this).attr('data-goods-name');
        goods.goods_image_url = $(this).attr('data-goods-image-url');
        goods.goods_url = $(this).attr('data-goods-url');
        var mansong_goods_item = template.render('mansong_goods_template', goods);
        $('#mansong_goods_item').html(mansong_goods_item);
        $('#div_search_goods').hide();
    });

    // 删除以选的商品
    $('#mansong_goods_item').on('click', '[nctype="btn_del_mansong_goods"]', function() {
        $('#mansong_goods_item').html('');
    });

$("#cate_rule").change(function(){
	var store_id = $("#store_id").val();
	if(store_id == undefined){
		alert("请先搜索店铺");
		return false;
	}
	var rule_id = $(this).val();
	if(rule_id == 1){
		$("#category_tree").css('display','none');
		$("#diff_goods").children("dt").html("排除商品");
		$("#gname_title").html("商品名称（排除商品不参加该促销活动）");
		$("#bundling_add_goods").html("添加排除商品")
	}else if(rule_id == 2){
		
		$.ajax({
			type:'post',
			url:"index.php?act=promotion_mansong&op=select_class",
			data:{store_id:store_id},
			dataType:'html',
			success:function(res){
				$("#goods_class").html(res);
			}
		});
		$("#category_tree").css('display','block');
		$("#diff_goods").children("dt").html("排除商品");
		$("#gname_title").html("商品名称（排除商品不参加该促销活动）");
		$("#bundling_add_goods").html("添加排除商品")
	}else if(rule_id == 3){
		$("#category_tree").css('display','none');
		$("#diff_goods").children("dt").html("可用商品");
		$("#gname_title").html("商品名称（只有可用商品参加该促销活动）");
		$("#bundling_add_goods").html("添加可用商品");
	}
});

$(".btn-search").bind("click", function() {
	var store_name = $("#store_name").val();
	$.ajax({
		type:'post',
		url:"index.php?act=promotion_mansong&op=select_store",
		data:{store_name:store_name},
		dataType:'html',
		success:function(res){
			$("#storeArr").html(res);
			$("#bundling_add_goods_ajaxContent").html('');
		}
	}); 

})


$('#bundling_add_goods_delete').click(function(){
	$(this).hide();
	$('#bundling_add_goods_ajaxContent').html('');
	$('#bundling_add_goods').show();
});

function add_gcid(){
	var onselect = $("#own_class").find("option:selected");
	var sel_title = onselect.attr('name');
	var sel_id = onselect.val();
	$("#store_cates_list").append('<tr style="display: table-row;" id="cates_tr_'+sel_id+'"><input type="hidden" name="store_cates[]" value="'+sel_id+'"><td class="tl" colspan="2"><dl class="goods-name" style="width: 160px;"><dt style="width: 300px;">'+sel_title+'</dt></dl></td><td class="nscs-table-handle w90"><span><a href="javascript:void(0);" onclick="cates_operate_delete($(\'#cates_tr_'+sel_id+'\'), '+sel_id+')" class="btn-orange"><i class="icon-ban-circle"></i><p>移除</p></a></span></td></tr>');

	return false;
}

$("#bundling_add_goods").bind("click", function() {

	var store_id = $("#store_id").val();
	if(store_id == undefined){
		alert("请先搜索店铺");
		return false;
	}
	$.ajax({
		type:'post',
		url:"index.php?act=promotion_mansong&op=mansong_add_goods&store_id="+store_id,
		data:{},
		dataType:'html',
		success:function(res){
			$("#bundling_add_goods_ajaxContent").html(res);
		}
	}); 

})

/* 删除商品 */
function bundling_operate_delete(o, id){
    o.remove();
    $('li[nctype="'+id+'"]').children(':last').html('<a href="JavaScript:void(0);" onclick="bundling_goods_add($(this))" class="ncsc-btn-mini ncsc-btn-green"><i class="icon-plus"></i>选中商品</a>');
}

/* 删除分类 */
function cates_operate_delete(o, id){
    o.remove();
}


//页面输入内容验证
$("#add_form").validate({
	errorPlacement: function(error, element){
		var error_td = element.parent('td').children('span.error-message');
		error_td.append(error);
	},
	onfocusout: false,
	submitHandler:function(form){
		ajaxpost('add_form', '', '', 'onerror');
	},
	rules : {
		mansong_name : {
			required : true
		},
		start_time : {
			required : true,
			greaterThanDate : '<?php echo date('Y-m-d H:i',$output['start_time']);?>'
		},
		end_time : {
			required : true,
			lessThanDate : '<?php echo date('Y-m-d H:i',$output['end_time']);?>',
			greaterThanStartDate : true
		},
		store_id : {
			required : true,
		},
		rule_count: {
			required: true,
			min: 1
		}
	},
	messages : {
		mansong_name : {
			required : '请输入活动名称'
		},
		start_time : {
			required : '<?php echo "开始时间不能为空且不能早于".date('Y-m-d H:i',$output['start_time']);?>',
			greaterThanDate : '<?php echo "开始时间不能为空且不能早于".date('Y-m-d H:i',$output['start_time']);?>'
		},
		end_time : {
			required : '结束时间不能为空且不能晚于<?php echo date('Y-m-d H:i',$output['end_time']);?>',
			lessThanDate : '结束时间不能为空且不能晚于<?php echo date('Y-m-d H:i',$output['end_time']);?>',
			greaterThanStartDate : '结束时间选择错误'
		},
		store_id : {
			required : '请搜索并选择店铺'
		},
		rule_count: {
			required: '请至少添加一条规则并确定',
			min: '请至少添加一条规则并确定'
		}
	}
});
</script>
