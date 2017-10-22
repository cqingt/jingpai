<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form id="add_form" action="index.php?act=store_miaosha&op=miaosha_save" method="post" enctype="multipart/form-data">
      <input id="goods_storage" name="goods_storage" type="hidden" value=""/>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['miaosha_goods'].$lang['nc_colon'];?></dt>
      <dd>
      <div nctype="miaosha_goods_info" class="selected-group-goods " style="display:none;">
      <div class="goods-thumb"><img id="miaosha_goods_image" src=""/></div>
          <div class="goods-name">
          <a nctype="miaosha_goods_href" id="miaosha_goods_name" href="" target="_blank"></a>
          </div>
          <div class="goods-price">商城价：￥<span nctype="miaosha_goods_price"></span></div>
          <div class="goods-price">库存：<span nctype="miaosha_goods_storage"></span>件</div>
      </div>
      <a href="javascript:void(0);" id="btn_show_search_goods" class="ncsc-btn ncsc-btn-acidblue">选择商品</a>
      <input id="miaosha_goods_id" name="miaosha_goods_id" type="hidden" value=""/>
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
        <p class="hint"><?php echo $lang['miaosha_goods_explain'];?></p>
        </dd>
    </dl>
    <dl nctype="miaosha_goods_info" style="display:none;">
      <dt><?php echo $lang['miaosha_index_store_price'].$lang['nc_colon'];?></dt>
      <dd> <?php echo $lang['currency'];?><span nctype="miaosha_goods_price"></span><input id="input_miaosha_goods_price" type="hidden"></dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['miaosha_price'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="miaosha_price" name="miaosha_price" type="text" value=""/><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
        <p class="hint"><?php echo $lang['miaosha_price_tip'];?></p>
      </dd>
    </dl>
      <dl>
          <dt><i class="required">*</i><?php echo $lang['group_cydate'].$lang['nc_colon'];?></dt>
          <dd>
              <select name="miaosha_date">
                  <?php foreach($output['miaosha_date'] as $k=>$v){?>
                      <option value="<?php echo $v;?>"><?php echo $v;?></option>
                  <?php }?>
              </select>
              <span></span>
              <p class="hint"><?php echo $lang['miaosha_huodong_explain'];?></p>
          </dd>
      </dl>
      <dl>
          <dt><i class="required">*</i><?php echo $lang['group_template'].$lang['nc_colon'];?></dt>
          <dd>
              <select name="miaosha_class">
                <?php foreach($output['miaosha_classes'] as $k=>$v){?>
                  <option value="<?php echo $v['class_id'];?>"><?php echo $v['class_name'].' (时间：'.$v['start_hour'].'点 - '.$v['end_hour'].'点)';?></option>
                <?php }?>
              </select>
              <span></span>
              <p class="hint"><?php echo $lang['miaosha_huodong_explain'];?></p>
          </dd>
      </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['max_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="max_quantity" name="max_quantity" type="text" value="0"/>
        <span></span>
        <p class="hint"><?php echo $lang['max_quantity_explain'];?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['sale_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="upper_limit" name="upper_limit" type="text" value="0"/>
        <span></span>
        <p class="hint"><?php echo $lang['sale_quantity_explain'];?></p>
      </dd>
    </dl>

	 <dl>
      <dt><i class="required">*</i>是否包邮<?php echo $lang['nc_colon'];?></dt>
      <dd>
        <input type="radio" name="is_shipping" id="is_shipping" checked="true" value="0">否
		&nbsp;&nbsp;
		<input type="radio" name="is_shipping" id="is_shipping" value="1">是
        <span></span>
        <p class="hint">是否包邮选择《是》则用户购买该秒杀产品免邮费</p>
      </dd>
    </dl>

    <div class="bottom"><label class="submit-border">
      <input type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>"></label>
    </div>
  </form>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('#btn_show_search_goods').on('click', function() {
        $('#div_search_goods').show();
    });

    $('#btn_hide_search_goods').on('click', function() {
        $('#div_search_goods').hide();
    });

    //搜索商品
    $('#btn_search_goods').on('click', function() {
        var url = "<?php echo urlShop('store_miaosha', 'search_goods');?>";
        url += '&' + $.param({goods_name: $('#search_goods_name').val()});
        $('#div_goods_search_result').load(url);
    });

    $('#div_goods_search_result').on('click', 'a.demo', function() {
        $('#div_goods_search_result').load($(this).attr('href'));
        return false;
    });

    //选择商品
    $('#div_goods_search_result').on('click', '[nctype="btn_add_miaosha_goods"]', function() {
        var goods_id = $(this).attr('data-goods-id');
        $.get('<?php echo urlShop('store_miaosha', 'miaosha_goods_info');?>', {goods_id: goods_id}, function(data) {
            if(data.result) {
                $('#miaosha_goods_id').val(data.goods_id);
                $('#goods_storage').val(data.goods_storage);
                $('[nctype="miaosha_goods_storage"]').text(data.goods_storage);
                $('#miaosha_goods_image').attr('src', data.goods_image);
                $('#miaosha_goods_name').text(data.goods_name);
                $('[nctype="miaosha_goods_price"]').text(data.goods_price);
                $('#input_miaosha_goods_price').val(data.goods_price);
                $('[nctype="miaosha_goods_href"]').attr('href', data.goods_href);
                $('[nctype="miaosha_goods_info"]').show();
                $('#div_search_goods').hide();
            } else {
                showError(data.message);
            }
        }, 'json');
    });

    jQuery.validator.methods.lessThanGoodsPrice= function(value, element) {
        var goods_price = $("#input_miaosha_goods_price").val();
        return Number(value) < Number(goods_price);
    };

    jQuery.validator.methods.lessThanGoodsStrage= function(value, element) {
        var goods_storage = $("#goods_storage").val();
        return Number(value) <= Number(goods_storage);
    };

    //选择的商品库存小于1
    jQuery.validator.methods.GoodsStrageLess1= function(value, element) {
        var goods_storage = $("#goods_storage").val();
        if(goods_storage < 1){
            return false;
        }else{
            return true;
        }
    };

    jQuery.validator.methods.checkMiaoshaGoods = function(value, element) {
        var miaosha_date = $("select[name='miaosha_date']").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'<?php echo urlShop('store_miaosha', 'check_miaosha_goods');?>',
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

    //页面输入内容验证
    $("#add_form").validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd').children('span');
            error_td.append(error);
        },
        onfocusout: false,
    	submitHandler:function(form){
    		ajaxpost('add_form', '', '', 'onerror');
    	},
        rules : {
            miaosha_goods_id: {
                required : true,
                checkMiaoshaGoods : true,
                GoodsStrageLess1 : true
            },
            miaosha_price: {
                required : true,
                number : true,
                lessThanGoodsPrice: true,
                min : 1,
                max : 1000000
            },
            max_quantity: {
                required : true,
                digits : true,
                lessThanGoodsStrage : true,
                min : 1
            },
            upper_limit: {
                required : true,
                digits : true
            }
        },
        messages : {
            miaosha_goods_id: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_goods_error'];?>',
                checkMiaoshaGoods : '<i class="icon-exclamation-sign"></i>此商品已报名：'+$("select[name='miaosha_date']").val()+'秒杀，不能重复添加',
                GoodsStrageLess1 : '秒杀商品的库存不能小于1件'
            },
            miaosha_price: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                lessThanGoodsPrice: '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_bigger1'];?>',
                min : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                max : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>'
            },
            max_quantity: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_error'];?>',
                lessThanGoodsStrage : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_bigger'];?>',
                min : '<i class="icon-exclamation-sign"></i>请输入正确的秒杀数量',
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i>不能为0'
            }
        }
    });

	$('#li_1').click(function(){
		$('#li_1').attr('class','active');
		$('#li_2').attr('class','');
		$('#demo').hide();
	});

	$('#goods_demo').click(function(){
		$('#li_1').attr('class','');
		$('#li_2').attr('class','active');
		$('#demo').show();
	});

	$('.des_demo').click(function(){
		if($('#des_demo').css('display') == 'none'){
            $('#des_demo').show();
        }else{
            $('#des_demo').hide();
        }
	});

    $('.des_demo').ajaxContent({
        event:'click', //mouseover
            loaderType:"img",
            loadingMsg:"<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif",
            target:'#des_demo'
    });
});

function insert_editor(file_path){
	KE.appendHtml('goods_body', '<img src="'+ file_path + '">');
}

</script>
