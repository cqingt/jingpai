<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form id="add_form" action="index.php?act=store_vipsale&op=vipsale_save" method="post" enctype="multipart/form-data">
      <input id="goods_storage" name="goods_storage" type="hidden" value=""/>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['vipsale_goods'].$lang['nc_colon'];?></dt>
      <dd>
      <div nctype="vipsale_goods_info" class="selected-group-goods " style="display:none;">
      <div class="goods-thumb"><img id="vipsale_goods_image" src=""/></div>
          <div class="goods-name">
          <a nctype="vipsale_goods_href" id="vipsale_goods_name" href="" target="_blank"></a>
          </div>
          <div class="goods-price">商城价：￥<span nctype="vipsale_goods_price"></span></div>
          <div class="goods-price">库存：<span nctype="vipsale_goods_storage"></span>件</div>
      </div>
      <a href="javascript:void(0);" id="btn_show_search_goods" class="ncsc-btn ncsc-btn-acidblue">选择商品</a>
      <input id="vipsale_goods_id" name="vipsale_goods_id" type="hidden" value=""/>
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
                        <p class="hint">不输入名称直接搜索将显示店内所有普通商品，活动商品不能参加。</p>
                    </td>
                </tr>
            </table>
            <div id="div_goods_search_result" class="search-result" style="width:739px;"></div>
            <a id="btn_hide_search_goods" class="close" href="javascript:void(0);">X</a>
        </div>
        <p class="hint"><?php echo $lang['vipsale_goods_explain'];?></p>
        </dd>
    </dl>
    <dl nctype="vipsale_goods_info" style="display:none;">
      <dt><?php echo $lang['vipsale_index_store_price'].$lang['nc_colon'];?></dt>
      <dd> <?php echo $lang['currency'];?><span nctype="vipsale_goods_price"></span><input id="input_vipsale_goods_price" type="hidden"></dd>
    </dl>
      <dl>
          <dt><i class="required">*</i>会员等级</dt>
          <dd>
              <select name="level">
                  <?php foreach($output['member_grade'] as $k=>$v){?>
                      <option value="<?php echo $v['level'];?>"><?php echo $v['level_name'];?></option>
                  <?php }?>
              </select>
              <span></span>
              <p class="hint">只有此等级及以上等级的会员可享受此特价</p>
          </dd>
      </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['vipsale_price'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="vipsale_price" name="vipsale_price" type="text" value=""/><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
        <p class="hint"><?php echo $lang['vipsale_price_tip'];?></p>
      </dd>
    </dl>

      <dl>
          <dt><i class="required">*</i><?php echo $lang['start_time'];?><?php echo $lang['nc_colon'];?></dt>
          <dd>
              <input id="start_time" name="start_time" type="text" class="text w130" /><em class="add-on"><i class="icon-calendar"></i></em><span></span>
              <p class="hint"><?php echo '开始时间不能小于'.date('Y-m-d H:i', $output['start_review_time']);?></p>
          </dd>
      </dl>
      <dl>
          <dt><i class="required">*</i><?php echo $lang['end_time'];?><?php echo $lang['nc_colon'];?></dt>
          <dd>
              <input id="end_time" name="end_time" type="text" class="text w130"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
              <p class="hint">
                  <?php if (!$output['isOwnShop']) { ?>
                  <?php echo '结束时间不能大于'.date('Y-m-d H:i', $output['current_vipsale_quota']['end_time']);?>
              </p>
              <?php } ?>

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
    $('#start_time').datetimepicker({
        controlType: 'select'
    });

    $('#end_time').datetimepicker({
        controlType: 'select'
    });

    $('#btn_show_search_goods').on('click', function() {
        $('#div_search_goods').show();
    });

    $('#btn_hide_search_goods').on('click', function() {
        $('#div_search_goods').hide();
    });

    //搜索商品
    $('#btn_search_goods').on('click', function() {
        var url = "<?php echo urlShop('store_vipsale', 'search_goods');?>";
        url += '&' + $.param({goods_name: $('#search_goods_name').val()});
        $('#div_goods_search_result').load(url);
    });

    $('#div_goods_search_result').on('click', 'a.demo', function() {
        $('#div_goods_search_result').load($(this).attr('href'));
        return false;
    });

    //选择商品
    $('#div_goods_search_result').on('click', '[nctype="btn_add_vipsale_goods"]', function() {
        var goods_id = $(this).attr('data-goods-id');
        $.get('<?php echo urlShop('store_vipsale', 'vipsale_goods_info');?>', {goods_id: goods_id}, function(data) {
            if(data.result) {
                $('#vipsale_goods_id').val(data.goods_id);
                $('#goods_storage').val(data.goods_storage);
                $('[nctype="vipsale_goods_storage"]').text(data.goods_storage);
                $('#vipsale_goods_image').attr('src', data.goods_image);
                $('[nctype="vipsale_goods_price"]').text(data.goods_price);
                $('#input_vipsale_goods_price').val(data.goods_price);
                $('[nctype="vipsale_goods_href"]').attr('href', data.goods_href);
                $('[nctype="vipsale_goods_info"]').show();
                $('#div_search_goods').hide();
            } else {
                showError(data.message);
            }
        }, 'json');
    });

    jQuery.validator.methods.lessThanGoodsPrice= function(value, element) {
        var goods_price = $("#input_vipsale_goods_price").val();
        return Number(value) < Number(goods_price);
    };

    jQuery.validator.methods.lessThanGoodsStrage= function(value, element) {
        var goods_storage = $("#goods_storage").val();
        return Number(value) <= Number(goods_storage);
    };

    jQuery.validator.methods.greaterThanDate = function(value, element, param) {
        var date1 = new Date(Date.parse(param.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };

    jQuery.validator.methods.lessThanDate = function(value, element, param) {
        var date1 = new Date(Date.parse(param.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 > date2;
    };

    jQuery.validator.methods.greaterThanStartDate = function(value, element) {
        var start_date = $("#start_time").val();
        var date1 = new Date(Date.parse(start_date.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
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

    jQuery.validator.methods.checkVipsaleGoods = function(value, element) {
        var vipsale_date = $("select[name='vipsale_date']").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'<?php echo urlShop('store_vipsale', 'check_vipsale_goods');?>',
            async:false,
            data:{vipsale_date: vipsale_date, goods_id: value},
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
            vipsale_goods_id: {
                required : true,
                checkVipsaleGoods : true,
                GoodsStrageLess1 : true
            },
            vipsale_price: {
                required : true,
                number : true,
                digits : true,
                lessThanGoodsPrice: true,
                min : 1,
                max : 1000000
            },
            start_time : {
                required : true,
                greaterThanDate : '<?php echo date('Y-m-d H:i',$output['start_review_time']);?>'
            },
            end_time : {
                required : true,
                <?php if (!$output['isOwnShop']) { ?>
                lessThanDate : '<?php echo date('Y-m-d H:i',$output['current_vipsale_quota']['end_time']);?>',
                <?php } ?>
                greaterThanStartDate : true
            },
            max_quantity: {
                required : true,
                digits : true,
                lessThanGoodsStrage : true
            },
            upper_limit: {
                required : true,
                digits : true
            }
        },
        messages : {
            vipsale_goods_id: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_goods_error'];?>',
                checkVipsaleGoods : '<i class="icon-exclamation-sign"></i>此商品已报名：'+$("select[name='vipsale_date']").val()+'会员特价，不能重复添加',
                GoodsStrageLess1 : '会员特价商品的库存不能小于1件'
            },
            vipsale_price: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                digits:'<i class="icon-exclamation-sign"></i>会员特价价格必须是整数',
                lessThanGoodsPrice: '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_bigger1'];?>',
                min : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                max : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>'
            },
            start_time : {
                required : '<i class="icon-exclamation-sign"></i>开始时间不能为空',
                greaterThanDate : '<i class="icon-exclamation-sign"></i><?php echo sprintf('开始时间必须大于{0}',date('Y-m-d H:i',$output['vipsale_start_time']));?>'
            },
            end_time : {
                required : '<i class="icon-exclamation-sign"></i>结束时间不能为空',
                <?php if (!$output['isOwnShop']) { ?>
                lessThanDate : '<i class="icon-exclamation-sign"></i><?php echo sprintf('结束时间必须小于{0}',date('Y-m-d H:i',$output['current_vipsale_quota']['end_time']));?>',
                <?php } ?>
                greaterThanStartDate : '<i class="icon-exclamation-sign"></i>结束时间必须大于开始时间'
            },
            max_quantity: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_error'];?>',
                lessThanGoodsStrage : '<i class="icon-exclamation-sign"></i><?php echo $lang['max_quantity_bigger'];?>'
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>'
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
