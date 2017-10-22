<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo BASE_SITE_URL;?>/shop/templates/default/css/seller_center.css" rel="stylesheet" type="text/css">
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
  <div class="fixed-empty"></div>
  <form id="add_form" enctype="multipart/form-data" method="post" action="index.php?act=miaosha&op=miaosha_insert">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2"><label class="validation" for="goods_id">秒杀产品:</label></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="vatop rowform">
		   <div nctype="groupbuy_goods_info" class="selected-group-goods " style="display:none;">
			<div class="goods-thumb"><img id="groupbuy_goods_image" src=""/>
			</div>
			<div class="goods-name">
			  <a nctype="groupbuy_goods_href" id="groupbuy_goods_name" href="" target="_blank"></a>
			</div>
			<div class="goods-price">商城价：￥<span nctype="groupbuy_goods_price"></span>
			</div>
		  </div>

		<a href="javascript:void(0);" id="btn_show_search_goods" class="ncsc-btn ncsc-btn-acidblue">选择商品</a>
      <input id="goods_id" name="goods_id" type="hidden" value="<?php echo $output[
        'groupbuy_info']['goods_id'];?>"/>
      <span></span>
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
                      <a href="javascript:void(0);" id="btn_search_goods" class="ncsc-btn"/><i class="icon-search"></i><?php echo $lang['nc_search'];?></a></td>
                    <td class="w10"></td>
                    <td>
                        <p class="hint">不输入名称直接搜索将显示店内所有普通商品，特殊商品不能参加。</p>
                    </td>
                </tr>
            </table>
            <div id="div_goods_search_result" class="search-result" style="width:739px;"></div>
            <a id="btn_hide_search_goods" class="close" href="javascript:void(0);">X</a>
        </div>
        <p class="hint"><?php echo $lang['groupbuy_goods_explain'];?></p>

          </td>
        </tr>

		<tr class="noborder">
          <td colspan="2"><label class="validation" for="miaosha_price">秒杀价格:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" id="miaosha_price" name="miaosha_price" class="txt"></td>
          <td class="vatop tips">秒杀价格为该商品参加活动时的促销价格，必须是1~1000000之间的数字(单位：元)，秒杀价格应包含邮费，秒杀商品系统默认不收取邮费</td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label class="validation" >参与日期:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
		   <select name="miaosha_date">
                  <?php foreach($output['miaosha_date'] as $k=>$v){?>
                      <option value="<?php echo $v;?>"><?php echo $v;?></option>
                  <?php }?>
              </select>
		  </td>
          <td class="vatop tips"></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation" >秒杀活动:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			<select name="miaosha_class">
                <?php foreach($output['miaosha_classes'] as $k=>$v){?>
                  <option value="<?php echo $v['class_id'];?>"><?php echo $v['class_name'].' (时间：'.$v['start_hour'].'点 - '.$v['end_hour'].'点)';?></option>
                <?php }?>
            </select>
		  </td>
          <td class="vatop tips"></td>
        </tr>

		
        <tr>
          <td colspan="2" class="required"><label class="validation"  for="max_quantity">秒杀数量:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
			 <input type="text" id="max_quantity" name="max_quantity" class="w70 text" class="txt" value="0">
		  </td>
          <td class="vatop tips">当秒杀商品数量达到此数量秒杀结束，(秒杀限制数量不能为0)</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label for="upper_limit">每人限购:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform onoff">
            <input class="w70 text" id="upper_limit" name="upper_limit" type="text" class="txt" value="0"/>
			</td>
			<td class="vatop tips">每个买家ID单次下单可购买的最大数量，不限数量请填 "0"</td>
        </tr>
	

		 <tr>
          <td colspan="2" class="required"><label for="is_shipping">是否包邮:</label></td>
        </tr>
        <tr class="noborder" style="background: rgb(255, 255, 255);">
          <td class="vatop rowform">
             <input type="radio" name="is_shipping" id="is_shipping" checked="true" value="0">否
			&nbsp;&nbsp;
			<input type="radio" name="is_shipping" id="is_shipping" value="1">是
			</td>
			<td class="vatop tips">是否包邮选择《是》则用户购买该秒杀产品免邮费</td>
        </tr>
		 </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
$('#btn_show_search_goods').on('click', function() {
        $('#div_search_goods').show();
    });

$('#btn_hide_search_goods').on('click', function() {
	$('#div_search_goods').hide();
});
 //搜索商品
    $('#btn_search_goods').on('click', function() {
        var url = "index.php?act=groupbuy&op=search_goods";
        url += '&' + $.param({goods_name: $('#search_goods_name').val()});
        $('#div_goods_search_result').load(url);
    });

    $('#div_goods_search_result').on('click', 'a.demo', function() {
        $('#div_goods_search_result').load($(this).attr('href'));
        return false;
    });

    //选择商品
    $('#div_goods_search_result').on('click', '[nctype="btn_add_groupbuy_goods"]', function() {
        var goods_id = $(this).attr('data-goods-id');
        $.get('index.php?act=groupbuy&op=groupbuy_goods_info', {goods_id: goods_id}, function(data) {
            if(data.result) {
                $('#goods_id').val(data.goods_id);
                $('#groupbuy_goods_image').attr('src', data.goods_image);
                $('#groupbuy_goods_name').text(data.goods_name);
                $('[nctype="groupbuy_goods_price"]').text(data.goods_price);
                $('[nctype="groupbuy_goods_href"]').attr('href', data.goods_href);
                $('[nctype="groupbuy_goods_info"]').show();
                $('#div_search_goods').hide();
            } else {
                showError(data.message);
            }
        }, 'json');
    });

//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
		if($("#add_form").valid()){
			$("#add_form").submit();
		}
	});
});
$(document).ready(function(){
    jQuery.validator.methods.checkMiaoshaGoods = function(value, element) {
        var miaosha_date = $("select[name='miaosha_date']").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'index.php?act=miaosha&op=check_miaosha_goods1',
            async:false,
            data:{miaosha_date: miaosha_date, goods_id: value},
            dataType: 'json',
            success: function(data){
                if(!data.result) {
                    result = false;
                }
            }
        });
        return result;
    };
	$("#add_form").validate({
		errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
          rules : {
            goods_id: {
                required : true,
                checkMiaoshaGoods : true,
				min : 1
            },
            miaosha_price: {
                required : true,
                number : true,
                digits : true,
                min : 1,
                max : 1000000
            },
            max_quantity: {
                required : true,
                digits : true,
                min : 1
            },
            upper_limit: {
                required : true,
                digits : true,
                min : 1
            }
        },
        messages : {
            goods_id: {
                required : '<i class="icon-exclamation-sign"></i>请选择秒杀产品',
                checkMiaoshaGoods : '<i class="icon-exclamation-sign"></i>此商品已报名：'+$("select[name='miaosha_date']").val()+'秒杀，不能重复添加',
                min : '<i class="icon-exclamation-sign"></i>请搜索并选择秒杀商品'
            },
            miaosha_price: {
                required : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀价格',
                number : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀价格',
                digits:'<i class="icon-exclamation-sign"></i>秒杀价格必须是整数',
                min : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀价格',
                max : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀价格'
            },
            max_quantity: {
                required : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀数量',
                digits : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀数量',
                min : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀数量',
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i>请正确的输入限购数量',
                digits : '<i class="icon-exclamation-sign"></i>不能为0',
				min : '<i class="icon-exclamation-sign"></i>请正确的输入限购数量',
            }
        }
	});
});


</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script>
function get_recommend_goods() {//查询商品
	var gc_id = 0;
	$('#recommend_gcategory > select').each(function() {
		if ($(this).val()>0) gc_id = $(this).val();
	});
	var goods_name = $.trim($('#recommend_goods_name').val());
	if (gc_id>0 || goods_name!='') {
		$("#show_recommend_goods_list").load('index.php?act=miaosha&op=recommend_list&'+$.param({'id':gc_id,'goods_name':goods_name }));
	}
}
function select_recommend_goods(goods_id) {//商品选择
	var goods = $("#show_recommend_goods_list img[goods_id='"+goods_id+"']");
	var text_append = '';
	var goods_pic = goods.attr("src");
	var goods_name = goods.attr("title");
	var goods_price = goods.attr("goods_price");
	var market_price = goods.attr("market_price");
	$('#recommend_goods_name').val(goods_name);
	$('#goods_id').val(goods_id);
	$('#goods_pic').val(goods_pic);
	$('#goods_price').val(goods_price);
	$('#market_price').val(market_price);
}
function get_input(n,id,k,v) {//生成隐藏域代码
	return '<input type="hidden" name="'+n+'['+id+']['+k+']" value="'+v+'">';
}
//图片上传
function update_pic(id,pic) {//更新图片
	if (id=='tit') {
	    var tit_floor = $.trim($('#tit_floor').val());
	    var tit_title = $.trim($('#tit_title').val());
	    var get_type = $("#upload_tit_form input:checked").val();
	    $("#left_tit dd").hide();
	    $("#left_tit dd.tit-"+get_type).show();
	    if (get_type=='txt') {
		    $("#picture_floor").html('<span>'+tit_floor+'</span><h2>'+tit_title+'</h2>');
		}
	}
	var obj = $("#picture_"+id);
	obj.html('<img src="'+UPLOAD_SITE_URL+'/'+pic+'" />');
	DialogManager.close("upload_"+id);
}
</script>