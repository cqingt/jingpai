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
  <form id="add_form" action="index.php?act=miaosha&op=miaosha_save" method="post" enctype="multipart/form-data">
      <input name="miaosha_id" id="miaosha_id" type="hidden" value="<?php echo $output['miaosha_info']['miaosha_id'];?>"/>
      <!--
    <dl>
      <dt><i class="required">*</i><?php echo $lang['group_name'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w400 text" name="miaosha_name" type="text" id="miaosha_name" value="<?php echo $output['miaosha_info']['miaosha_name'];?>" maxlength="30"  />
        <span></span>
        <p class="hint"><?php echo $lang['group_name_tip'];?></p>
      </dd>
    </dl>
    <dl>
      <dt>秒杀副标题<?php echo $lang['nc_colon'];?></dt>
      <dd>
        <input class="w400 text" name="remark" type="text" id="remark" value="<?php echo $output['miaosha_info']['remark'];?>" maxlength="30"  />
        <span></span>
        <p class="hint">秒杀活动副标题最多可输入30个字符</p>
      </dd>
    </dl>
    -->
    <dl>
      <dt><i class="required">*</i><?php echo $lang['start_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input id="start_time" name="start_time" type="text" class="text w130" value="<?php if($output['miaosha_info']['end_time']){ echo date('Y-m-d H:i', $output['miaosha_info']['start_time']);}?>"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint"><?php echo '秒杀开始时间';?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['end_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input id="end_time" name="end_time" type="text" class="text w130" value="<?php if($output['miaosha_info']['end_time']){ echo date('Y-m-d H:i', $output['miaosha_info']['end_time']);}?>"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint">
<?php if (!$output['isOwnShop']) { ?>
          <?php echo '秒杀结束时间';?>
          </p>
<?php } ?>

      </dd>
    </dl>
      <dl>
          <dt><i class="required">*</i><?php echo $lang['group_template'].$lang['nc_colon'];?></dt>
          <dd>
              <select name="miaosha_class">
                  <?php foreach($output['miaosha_class'] as $k=>$v){?>
                      <option value="<?php echo $v['class_id'];?>" <?php echo ($output['miaosha_info']['class_id'] == $v['class_id'])?'selected':'';?>><?php echo $v['class_name'].' (时间：'.$v['start_hour'].'点 - '.$v['end_hour'].'点)';?></option>
                  <?php }?>
              </select>
              <span></span>
              <p class="hint"><?php echo $lang['miaosha_huodong_explain'];?></p>
          </dd>
      </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['miaosha_goods'].$lang['nc_colon'];?></dt>
      <dd>
      <div nctype="miaosha_goods_info" class="selected-group-goods " style="">
      <div class="goods-thumb"><img id="miaosha_goods_image" src="<?php echo $output['goods_info']['goods_image'];?>"/></div>
          <div class="goods-name">
          <a nctype="miaosha_goods_href" id="miaosha_goods_name" href="<?php echo urlShop('goods','index',array('goods_id'=>$output['goods_info']['goods_id']));?>" target="_blank" title="<?php echo $output['goods_info']['goods_name'];?>"><?php echo $output['goods_info']['goods_name'];?></a>
          </div>
          <div class="goods-price">商城价：￥<span nctype="miaosha_goods_price"><?php echo $output['goods_info']['goods_price'];?></span></div>
      </div>
          <input id="input_miaosha_goods_price" name="input_miaosha_goods_price" type="hidden" value="<?php echo $output['goods_info']['goods_price'];?>"/>
      <input id="miaosha_goods_id" name="miaosha_goods_id" type="hidden" value="<?php echo $output['goods_info']['goods_id'];?>"/>
      <span></span>

        </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['miaosha_price'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="miaosha_price" name="miaosha_price" type="text" value="<?php echo $output['miaosha_info']['miaosha_price'];?>"/><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
        <p class="hint"><?php echo $lang['miaosha_price_tip'];?></p>
      </dd>
    </dl>
      <!--
    <dl>
      <dt><i class="required">*</i>秒杀活动图片<?php echo $lang['nc_colon'];?></dt>
      <dd>
      <div class="ncsc-upload-thumb miaosha-pic">
          <?php if($output['miaosha_info']['miaosha_imageurl'] != ''){ ?>
              <p><i class="icon-picture" style="display:none;"></i>
              <img nctype="img_miaosha_image" src="<?php echo $output['miaosha_info']['miaosha_imageurl'];?>" /></p>
          <?php }else{ ?>
              <p><i class="icon-picture"></i>
              <img nctype="img_miaosha_image" style="display:none;" src="" /></p>
          <?php }
          ?>

      </div>
        <input nctype="miaosha_image" name="miaosha_image" type="hidden" value="<?php echo $output['miaosha_info']['miaosha_image'];?>">
        <div class="ncsc-upload-btn">
            <a href="javascript:void(0);">
                <span>
                    <input type="file" hidefocus="true" size="1" class="input-file" name="miaosha_image" nctype="btn_upload_image"/>
                </span>
                <p><i class="icon-upload-alt"></i>图片上传</p>
            </a>
        </div>
        <span></span>
        <p class="hint"><?php echo $lang['group_pic_explain'];?></p>
        </dd>
    </dl>
    -->
      <!--
    <dl>
      <dt>秒杀推荐位图片<?php echo $lang['nc_colon'];?></dt>
      <dd>
      <div class="ncsc-upload-thumb miaosha-commend-pic">
          <?php if($output['miaosha_info']['miaosha_image1url'] != ''){ ?>
              <p><i class="icon-picture" style="display:none;"></i>
                  <img nctype="img_miaosha_image" src="<?php echo $output['miaosha_info']['miaosha_image1url'];?>" /></p>
          <?php }else{ ?>
              <p><i class="icon-picture"></i>
                  <img nctype="img_miaosha_image" style="display:none;" src="" /></p>
          <?php }
          ?>
      </div>
        <input nctype="miaosha_image" name="miaosha_image1" type="hidden" value="<?php echo $output['miaosha_info']['miaosha_image1'];?>">
        <span></span>
        <div class="ncsc-upload-btn">
            <a href="javascript:void(0);">
                <span>
                    <input type="file" hidefocus="true" size="1" class="input-file" name="miaosha_image" nctype="btn_upload_image"/>
                </span>
                <p><i class="icon-upload-alt"></i>图片上传</p>
            </a>
        </div>
        <p class="hint"><?php echo $lang['group_pic_explain2'];?></p>
        </dd>
    </dl>
    -->
      <!--
    <dl>
      <dt><?php echo $lang['miaosha_class'].$lang['nc_colon'];?></dt>
      <dd>
        <select id="class_id" name="class_id" class="w80">
          <option value="0"><?php echo $lang['text_no_limit']; ?></option>
            <?php
      if (is_array($output['miaosha_classes']['children'][0]) && !empty($output['miaosha_classes']['children'][0])) {
          foreach ($output['miaosha_classes']['children'][0] as $k => $v) {
              echo '<option value="' . $v . '"';
              if ($v == $output['miaosha_info']['class_id']) {
                  echo ' selected';
              }
              echo '>' . $output['miaosha_classes']['name'][$v] . '</option>';
          }
      }

            ?>
        </select>
        <select id="s_class_id" name="s_class_id" class="w80">
          <option value="0"><?php echo $lang['text_no_limit']; ?></option>
            <?php
                if($output['miaosha_classes']['children'][$output['miaosha_info']['class_id']] != ''){
                    foreach($output['miaosha_classes']['children'][$output['miaosha_info']['class_id']] as $k=>$v){
                        echo '<option value="'.$v.'"';
                        if($v == $output['miaosha_info']['s_class_id']){
                            echo ' selected';
                        }
                        echo '>'.$output['miaosha_classes']['name'][$v].'</option>';
                    }
                }
            ?>
        </select>
        <span></span>
        <p class="hint"><?php echo $lang['miaosha_class_tip'];?></p>
      </dd>
    </dl>
    -->
      <dl>
          <dt><i class="required">*</i><?php echo $lang['max_quantity'].$lang['nc_colon'];?></dt>
          <dd>
              <input class="w70 text" id="max_quantity" name="max_quantity" type="text" value="<?php echo $output['miaosha_info']['max_quantity'];?>"/>
              <span></span>
              <p class="hint"><?php echo $lang['max_quantity_explain'];?></p>
          </dd>
      </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['sale_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="upper_limit" name="upper_limit" type="text" value="<?php echo $output['miaosha_info']['upper_limit'];?>"/>
        <span></span>
        <p class="hint"><?php echo $lang['sale_quantity_explain'];?></p>
      </dd>
    </dl>
	<dl>
      <dt><i class="required">*</i>是否包邮<?php echo $lang['nc_colon'];?></dt>
      <dd>
        <input type="radio" name="is_shipping" id="is_shipping" <?php if($output['miaosha_info']['is_shipping'] == 0){?> checked="true" <?php } ?> value="0">否
		&nbsp;&nbsp;
		<input type="radio" name="is_shipping" id="is_shipping" <?php if($output['miaosha_info']['is_shipping'] == 1){ ?> checked="true" <?php } ?> value="1">是
        <span></span>
        <p class="hint">是否包邮选择《是》则用户购买该秒杀产品免邮费</p>
      </dd>
    </dl>
      <dl>
          <dt><?php echo $lang['miaosha_state_name'].$lang['nc_colon'];?></dt>
          <dd>
              <ul class="ncsc-form-radio-list">
                  <li>
                      <label>
                          <input name="state" value="10" <?php if ($output['miaosha_info']['state'] == 10) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['miaosha_state_verify'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="20" <?php if ($output['miaosha_info']['state'] == 20) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['miaosha_state_succ'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="30" <?php if ($output['miaosha_info']['state'] == 30) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['miaosha_state_false'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="31" <?php if ($output['miaosha_info']['state'] == 31) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['miaosha_state_close1'];?></label>
                  </li>
                  <li>
                      <label>
                          <input name="state" value="32" <?php if ($output['miaosha_info']['state'] == 32) { ?>checked="checked" <?php } ?> type="radio" />
                          <?php echo $lang['miaosha_state_close'];?></label>
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
            url: "<?php echo urlAdmin('miaosha', 'image_upload');?>",
            add: function(e, data) {
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="miaosha_image"]');
                $img = $parent.find('[nctype="img_miaosha_image"]');
                data.formData = {old_miaosha_image:$input.val()};
                $img.attr('src', SHOP_TEMPLATES_URL+'/images/loading.gif');
                data.submit();
            },
            done: function (e,data) {
                var result = data.result;
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="miaosha_image"]');
                $img = $parent.find('[nctype="img_miaosha_image"]');
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
        var goods_price = $("#input_miaosha_goods_price").val();
        return Number(value) < Number(goods_price);
    };

    jQuery.validator.methods.checkGroupbuyGoods = function(value, element) {
        var start_time = $("#start_time").val();
        var miaosha_id = $("#miaosha_id").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'<?php echo urlAdmin('miaosha', 'check_miaosha_goods');?>',
            async:false,
            data:{miaosha_id: miaosha_id,start_time: start_time, goods_id: value},
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
            miaosha_name: {
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
            miaosha_goods_id: {
                required : true,
                checkGroupbuyGoods: true
            },
            miaosha_price: {
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
            miaosha_image: {
                required : true
            }
        },
        messages : {
            miaosha_name: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_name_error'];?>'
            },
            start_time : {
                required : '<i class="icon-exclamation-sign"></i>秒杀开始时间不能为空',
            },
            end_time : {
                required : '<i class="icon-exclamation-sign"></i>秒杀结束时间不能为空',
<?php if (!$output['isOwnShop']) { ?>
<?php } ?>
                greaterThanStartDate : '<i class="icon-exclamation-sign"></i>结束时间必须大于开始时间'
            },
            miaosha_goods_id: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['group_goods_error'];?>',
                checkGroupbuyGoods: '该商品已经参加了同时段的活动'
            },
            miaosha_price: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                lessThanGoodsPrice: '<i class="icon-exclamation-sign"></i>秒杀价格必须小于商品价格',
                min : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>',
                max : '<i class="icon-exclamation-sign"></i><?php echo $lang['miaosha_price_error'];?>'
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['sale_quantity_error'];?>'
            },
            miaosha_image: {
                required : '<i class="icon-exclamation-sign"></i>秒杀图片不能为空'
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
})($.parseJSON('<?php echo json_encode($output['miaosha_classes']); ?>'));
</script>
