<?php defined('InShopNC') or exit('Access Invalid!');?>

<script>
    var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_RESOURCE_SITE_URL = '<?php echo BASE_SITE_URL;?>/shop/resource';var SHOP_TEMPLATES_URL = '<?php echo BASE_SITE_URL;?>/shop/templates/default';
</script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/waypoints.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/common.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/member.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>

<link href="<?php echo BASE_SITE_URL;?>/shop/templates/default/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_SITE_URL;?>/shop/templates/default/css/seller_center.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_SITE_URL;?>/shop/resource/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<div class="ncsc-form-default">
  <form id="add_form" action="index.php?act=vipsale&op=vipsale_save" method="post" enctype="multipart/form-data">
      <input name="vipsale_id" id="vipsale_id" type="hidden" value="<?php echo $output['vipsale_info']['vipsale_id'];?>"/>
      <dl>
          <dt><i class="required">*</i><?php echo $lang['vipsale_goods'].$lang['nc_colon'];?></dt>
          <dd>
              <div nctype="vipsale_goods_info" class="selected-group-goods " style="">
                  <div class="goods-thumb"><img id="vipsale_goods_image" src="<?php echo $output['goods_info']['goods_image'];?>"/></div>
                  <div class="goods-name">
                      <a nctype="vipsale_goods_href" id="vipsale_goods_name" href="<?php echo urlShop('goods','index',array('goods_id'=>$output['goods_info']['goods_id']));?>" target="_blank" title="<?php echo $output['goods_info']['goods_name'];?>"><?php echo $output['goods_info']['goods_name'];?></a>
                  </div>
                  <div class="goods-price">商城价：￥<span nctype="vipsale_goods_price"><?php echo $output['goods_info']['goods_price'];?></span></div>
              </div>
              <input id="input_vipsale_goods_price" name="input_vipsale_goods_price" type="hidden" value="<?php echo $output['goods_info']['goods_price'];?>"/>
              <input id="vipsale_goods_id" name="vipsale_goods_id" type="hidden" value="<?php echo $output['goods_info']['goods_id'];?>"/>
              <span></span>

          </dd>
      </dl>
    <dl>
        <dl>
            <dt><i class="required">*</i>会员等级</dt>
            <dd>
                <select name="level">
                    <?php foreach($output['member_grade'] as $k=>$v){?>
                        <option value="<?php echo $v['level'];?>" <?php echo ($v['level'] == $output['vipsale_info']['level'])?'selected':'';?>><?php echo $v['level_name'];?></option>
                    <?php }?>
                </select>
                <span></span>
                <p class="hint">只有此等级及以上等级的会员可享受此特价</p>
            </dd>
        </dl>
        <dl>
            <dt><i class="required">*</i><?php echo $lang['vipsale_price'].$lang['nc_colon'];?></dt>
            <dd>
                <input class="w70 text" id="vipsale_price" name="vipsale_price" type="text" value="<?php echo $output['vipsale_info']['vipsale_price'];?>"/><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
                <p class="hint"><?php echo $lang['vipsale_price_tip'];?></p>
            </dd>
        </dl>
        <dl>
      <dt><i class="required">*</i><?php echo $lang['start_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input id="start_time" name="start_time" type="text" class="text w130" value="<?php if($output['vipsale_info']['end_time']){ echo date('Y-m-d H:i', $output['vipsale_info']['start_time']);}?>"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint"><?php echo '会员特价开始时间';?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['end_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input id="end_time" name="end_time" type="text" class="text w130" value="<?php if($output['vipsale_info']['end_time']){ echo date('Y-m-d H:i', $output['vipsale_info']['end_time']);}?>"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint">
<?php if (!$output['isOwnShop']) { ?>
          <?php echo '会员特价结束时间';?>
          </p>
<?php } ?>

      </dd>
    </dl>


      <dl>
          <dt><i class="required">*</i><?php echo $lang['max_quantity'].$lang['nc_colon'];?></dt>
          <dd>
              <input class="w70 text" id="max_quantity" name="max_quantity" type="text" value="<?php echo $output['vipsale_info']['max_quantity'];?>"/>
              <span></span>
              <p class="hint"><?php echo $lang['max_quantity_explain'];?></p>
          </dd>
      </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['sale_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="upper_limit" name="upper_limit" type="text" value="<?php echo $output['vipsale_info']['upper_limit'];?>"/>
        <span></span>
        <p class="hint"><?php echo $lang['sale_quantity_explain'];?></p>
      </dd>
    </dl>
      <dl>
          <dt><?php echo $lang['vipsale_state_name'].$lang['nc_colon'];?></dt>
          <dd>
              <ul class="ncsc-form-radio-list">
                  <li>
                      <label>
                          <input name="state" value="10" <?php if ($output['vipsale_info']['state'] == 10) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['vipsale_state_verify'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="20" <?php if ($output['vipsale_info']['state'] == 20) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['vipsale_state_succ'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="30" <?php if ($output['vipsale_info']['state'] == 30) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['vipsale_state_false'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="31" <?php if ($output['vipsale_info']['state'] == 31) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['vipsale_state_close1'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="32" <?php if ($output['vipsale_info']['state'] == 32) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['vipsale_state_close'];?></label>
                  </li>


              </ul>
              <p class="hint"><?php echo $lang['store_goods_index_recommend_tip'];?></p>
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



    //图片上传
    $('[nctype="btn_upload_image"]').fileupload({
        dataType: 'json',
            url: "<?php echo urlAdmin('vipsale', 'image_upload');?>",
            add: function(e, data) {
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="vipsale_image"]');
                $img = $parent.find('[nctype="img_vipsale_image"]');
                data.formData = {old_vipsale_image:$input.val()};
                $img.attr('src', SHOP_TEMPLATES_URL+'/images/loading.gif');
                data.submit();
            },
            done: function (e,data) {
                var result = data.result;
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="vipsale_image"]');
                $img = $parent.find('[nctype="img_vipsale_image"]');
                if(result.result) {
                    $img.prev('i').hide();
                    $img.attr('src', result.file_url);
                    $img.show();
                    $input.val(result.file_name);
                } else {
                    showError(data.message);
                }
            }
    });


    jQuery.validator.methods.greaterThanStartDate = function(value, element) {
        var start_date = $("#start_time").val();
        var date1 = new Date(Date.parse(start_date.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };

    jQuery.validator.methods.lessThanGoodsPrice= function(value, element) {
        var goods_price = $("#input_vipsale_goods_price").val();
        return Number(value) < Number(goods_price);
    };

    jQuery.validator.methods.checkGroupbuyGoods = function(value, element) {
        var start_time = $("#start_time").val();
        var vipsale_id = $("#vipsale_id").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'<?php echo urlAdmin('vipsale', 'check_vipsale_goods');?>',
            async:false,
            data:{vipsale_id: vipsale_id,start_time: start_time, goods_id: value},
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

        rules : {
            vipsale_name: {
                required : true
            },
            start_time : {
                required : true,
            },
            end_time : {
                required : true,
<?php if (!$output['isOwnShop']) { ?>
<?php } ?>
                greaterThanStartDate : true
            },
            vipsale_goods_id: {
                required : true,
                checkGroupbuyGoods: true
            },
            vipsale_price: {
                required : true,
                number : true,
                lessThanGoodsPrice: true,
                min : 0.01,
                max : 1000000
            },
            upper_limit: {
                required : true,
                digits : true
            },
            vipsale_image: {
                required : true
            }
        },
        messages : {
            vipsale_name: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_name_error'];?>'
            },
            start_time : {
                required : '<i class="icon-exclamation-sign"></i>会员特价开始时间不能为空'
            },
            end_time : {
                required : '<i class="icon-exclamation-sign"></i>会员特价结束时间不能为空',
<?php if (!$output['isOwnShop']) { ?>
<?php } ?>
                greaterThanStartDate : '<i class="icon-exclamation-sign"></i>结束时间必须大于开始时间'
            },
            vipsale_goods_id: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_goods_error'];?>',
                checkGroupbuyGoods: '该商品已经参加了同时段的活动'
            },
            vipsale_price: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                lessThanGoodsPrice: '<i class="icon-exclamation-sign"></i>会员特价价格必须小于商品价格',
                min : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>',
                max : '<i class="icon-exclamation-sign"></i><?php echo $lang['vipsale_price_error'];?>'
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>'
            },
            vipsale_image: {
                required : '<i class="icon-exclamation-sign"></i>会员特价图片不能为空'
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
            loadingMsg:SHOP_TEMPLATES_URL + '/images/loading.gif',
            target:'#des_demo'
    });
});

function insert_editor(file_path){
	KE.appendHtml('goods_body', '<img src="'+ file_path + '">');
}

(function(data) {
    var s = '<option value="0"><?php echo $lang['text_no_limit']; ?></option>';
    if (typeof data.children != 'undefined') {
        if (data.children[0]) {
            $.each(data.children[0], function(k, v) {
                s += '<option value="'+v+'">'+data['name'][v]+'</option>';
            });
        }
    }
    $('#class_id').change(function() {
        var ss = '<option value="0"><?php echo $lang['text_no_limit']; ?></option>';
        var v = this.value;
        if (parseInt(v) && data.children[v]) {
            $.each(data.children[v], function(kk, vv) {
                ss += '<option value="'+vv+'">'+data['name'][vv]+'</option>';
            });
        }
        $('#s_class_id').html(ss);
    });
})($.parseJSON('<?php echo json_encode($output['vipsale_classes']); ?>'));
</script>
