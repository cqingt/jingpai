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

<div class="page" style="margin-bottom:40px;">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['groupbuy_index_manage'];?></h3>
	  <?php if($output['menu']){ ?>
      <ul class="tab-base">
        <?php foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php  } }  ?>
      </ul>
		<?php } ?>
    </div>
  </div>
</div>

<div class="ncsc-form-default">
  <?php if($output['update']){?>
  <form id="add_form" action="index.php?act=groupbuy&op=groupbuy_up" method="post" enctype="multipart/form-data">
    <input type="hidden" name="submit_form" value="ok">
    <input type="hidden" name="groupbuy_id" value="<?php echo $_GET['groupbuy_id'];?>">
  <?php }else{?>
    <form id="add_form" action="index.php?act=groupbuy&op=groupbuy_save" method="post" enctype="multipart/form-data">
  <?php }?>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['group_name'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w400 text" name="groupbuy_name" type="text" id="groupbuy_name" value="<?php echo $output[
        'groupbuy_info']['groupbuy_name'];?>" maxlength="30"  />
        <span></span>
        <p class="hint"><?php echo $lang['group_name_tip'];?></p>
      </dd>
    </dl>
    <dl>
      <dt>藏品惠副标题<?php echo $lang['nc_colon'];?></dt>
      <dd>
        <input class="w400 text" name="remark" type="text" id="remark" value="<?php echo $output[
        'groupbuy_info']['remark'];?>" maxlength="30"  />
        <span></span>
        <p class="hint">藏品惠活动副标题最多可输入30个字符</p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['start_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input  value="<?php echo date("Y-m-d H:i:s",$output[
        'groupbuy_info']['start_time']);?>" id="start_time" name="start_time" type="text" class="text w130" /><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint"><?php echo '藏品惠开始时间不能小于'.date('Y-m-d H:i', $output['groupbuy_start_time']);?></p>
      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['end_time'];?><?php echo $lang['nc_colon'];?></dt>
      <dd>
          <input value="<?php echo date("Y-m-d H:i:s",$output[
        'groupbuy_info']['end_time']);?>" id="end_time" name="end_time" type="text" class="text w130"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>
          <p class="hint">
<?php if (!$output['isOwnShop']) { ?>
          <?php echo '藏品惠开始时间不能大于'.date('Y-m-d H:i', $output['current_groupbuy_quota']['end_time']);?>
          </p>
<?php } ?>

      </dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo '团购商品'.$lang['nc_colon'];?></dt>
      <dd>

<?php if($output['groupbuy_info']){?>
  <div nctype="groupbuy_goods_info" class="selected-group-goods ">
    <div class="goods-thumb"><img id="groupbuy_goods_image" src="<?php echo cthumb($output['groupbuy_info']['goods_img']['goods_image']);?>"/>
    </div>
    <div class="goods-name">
      <a nctype="groupbuy_goods_href" id="groupbuy_goods_name" href="<?php echo $output[
        'groupbuy_info']['goods_url'];?>" target="_blank"><?php echo $output[
        'groupbuy_info']['goods_name'];?></a>
    </div>
    <div class="goods-price">商城价：￥<span nctype="groupbuy_goods_price"><?php echo $output[
        'groupbuy_info']['goods_price'];?></span>
    </div>
  </div>
<?php }else{?>
  <div nctype="groupbuy_goods_info" class="selected-group-goods " style="display:none;">
    <div class="goods-thumb"><img id="groupbuy_goods_image" src=""/>
    </div>
    <div class="goods-name">
      <a nctype="groupbuy_goods_href" id="groupbuy_goods_name" href="" target="_blank"></a>
    </div>
    <div class="goods-price">商城价：￥<span nctype="groupbuy_goods_price"></span>
    </div>
  </div>
<?php }?>
      


      <a href="javascript:void(0);" id="btn_show_search_goods" class="ncsc-btn ncsc-btn-acidblue">选择商品</a>
      <input id="groupbuy_goods_id" name="groupbuy_goods_id" type="hidden" value="<?php echo $output[
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
        </dd>
    </dl>
    <dl nctype="groupbuy_goods_info" style="display:none;">
      <dt><?php echo '价格'.$lang['nc_colon'];?></dt>
      <dd> <?php echo $lang['currency'];?><span nctype="groupbuy_goods_price"></span><input id="input_groupbuy_goods_price" type="hidden" value="<?php echo intval($output['groupbuy_info']['goods_price']);?>"></dd>
    </dl>
    <dl>
      <dt><i class="required">*</i><?php echo $lang['groupbuy_price'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="groupbuy_price" name="groupbuy_price" type="text" value="<?php echo intval($output['groupbuy_info']['groupbuy_price']);?>"/><em class="add-on"><i class="icon-renminbi"></i></em> <span></span>
        <p class="hint"><?php echo $lang['groupbuy_price_tip'];?></p>
      </dd>
    </dl>
<!--     <dl>
      <dt><i class="required">*</i>藏品惠活动图片<?php echo $lang['nc_colon'];?></dt>
      <dd>
      <div class="ncsc-upload-thumb groupbuy-pic">
          <p><i class="icon-picture" <?php if($output['groupbuy_info']['groupbuy_image']){echo "style='display:none;'";}?>></i>
          <img nctype="img_groupbuy_image" <?php if(!$output['groupbuy_info']['groupbuy_image']){echo "style='display:none;'";}?> src="<?php echo gthumb($output['groupbuy_info']['groupbuy_image'],'max');?>"/></p>
      </div>
        <input nctype="groupbuy_image" name="groupbuy_image" type="hidden" value="<?php echo $output['groupbuy_info']['groupbuy_image'];?>">
        <div class="ncsc-upload-btn">
            <a href="javascript:void(0);">
                <span>
                    <input type="file" hidefocus="true" size="1" class="input-file" name="groupbuy_image" nctype="btn_upload_image"/>
                </span>
                <p><i class="icon-upload-alt"></i>图片上传</p>
            </a>
        </div>
        <span></span>
        <p class="hint"><?php echo $lang['group_pic_explain'];?></p>
        </dd>
    </dl>
    <dl>
      <dt>藏品惠推荐位图片<?php echo $lang['nc_colon'];?></dt>
      <dd>
      <div class="ncsc-upload-thumb groupbuy-commend-pic">
          <p><i class="icon-picture" <?php if($output['groupbuy_info']['groupbuy_image']){echo "style='display:none;'";}?>></i>
          <img nctype="img_groupbuy_image"  <?php if(!$output['groupbuy_info']['groupbuy_image']){echo "style='display:none;'";}?> src="<?php echo gthumb($output['groupbuy_info']['groupbuy_image1'],'max');?>"/></p>
      </div>
        <input nctype="groupbuy_image" name="groupbuy_image1" type="hidden" value="<?php echo $output['groupbuy_info']['groupbuy_image1'];?>">
        <span></span>
        <div class="ncsc-upload-btn">
            <a href="javascript:void(0);">
                <span>
                    <input type="file" hidefocus="true" size="1" class="input-file" name="groupbuy_image" nctype="btn_upload_image"/>
                </span>
                <p><i class="icon-upload-alt"></i>图片上传</p>
            </a>
        </div>
        <p class="hint"><?php echo $lang['group_pic_explain2'];?></p>
        </dd>
    </dl>
 -->
    
    <dl>
      <dt><?php echo '团购类别'.$lang['nc_colon'];?></dt>
      <dd>
        <select id="class_id" name="class_id" class="w80">
          <option value="0">不限</option>
        </select>
        <select id="s_class_id" name="s_class_id" class="w80">
          <option value="0">不限</option>
        </select>
        <span></span>
        <p class="hint"><?php echo $lang['groupbuy_class_tip'];?></p>
      </dd>
    </dl>
      <!-- -->
    <dl>
      <dt><?php echo $lang['virtual_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="virtual_quantity" name="virtual_quantity" type="text" value="0"/>
        <span></span>
        <p class="hint"><?php echo $lang['virtual_quantity_explain'];?></p>
      </dd>
    </dl>
   
    <dl>
      <dt><?php echo $lang['sale_quantity'].$lang['nc_colon'];?></dt>
      <dd>
        <input class="w70 text" id="upper_limit" name="upper_limit" type="text" value="<?php echo $output['groupbuy_info']['upper_limit'];?>"/>
        <span></span>
        <p class="hint">藏品惠商品限制总数，不限数量请填 "0" 以商品库存数为准</p>
      </dd>
    </dl>
      <!---->
    <dl>
      <dt><?php echo $lang['group_intro'].$lang['nc_colon'];?></dt>
      <dd>
        <?php showEditor('groupbuy_intro','','740px','360px','','false',false);?>
        <p class="hr8"><a class="des_demo ncsc-btn" href="index.php?act=store_album&op=pic_list&item=groupbuy"><i class="icon-picture"></i><?php echo $lang['store_goods_album_insert_users_photo'];?></a></p>
        <p id="des_demo" style="display:none;"></p>
          <p class="hint">本抢介绍内容为空会自动调用团购商品详情信息，如填写内容则不会调用商品详情</p>
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
                $('#groupbuy_goods_id').val(data.goods_id);
                $('#groupbuy_goods_image').attr('src', data.goods_image);
                $('#groupbuy_goods_name').text(data.goods_name);
                $('[nctype="groupbuy_goods_price"]').text(data.goods_price);
                $('#input_groupbuy_goods_price').val(data.goods_price);
                $('[nctype="groupbuy_goods_href"]').attr('href', data.goods_href);
                $('[nctype="groupbuy_goods_info"]').show();
                $('#div_search_goods').hide();
            } else {
                showError(data.message);
            }
        }, 'json');
    });

    //图片上传
    $('[nctype="btn_upload_image"]').fileupload({
        dataType: 'json',
            url: "index.php?act=groupbuy&op=image_upload",
            add: function(e, data) {
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="groupbuy_image"]');
                $img = $parent.find('[nctype="img_groupbuy_image"]');
                data.formData = {old_groupbuy_image:$input.val()};
                $img.attr('src', "<?php echo SHOP_TEMPLATES_URL.'/images/loading.gif';?>");
                data.submit();
            },
            done: function (e,data) {
                var result = data.result;
                $parent = $(this).parents('dd');
                $input = $parent.find('[nctype="groupbuy_image"]');
                $img = $parent.find('[nctype="img_groupbuy_image"]');
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

    jQuery.validator.methods.lessThanGoodsPrice= function(value, element) {
        var goods_price = $("#input_groupbuy_goods_price").val();
        return Number(value) < Number(goods_price);
    };

    jQuery.validator.methods.checkGroupbuyGoods = function(value, element) {
        var start_time = $("#start_time").val();
        var result = true;
        $.ajax({
            type:"GET",
            url:'index.php?act=groupbuy&op=check_groupbuy_goods',
            async:false,
            data:{start_time: start_time, goods_id: value},
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
<?php if(!$output['update']){?>
//    	submitHandler:function(form){
//    		ajaxpost('add_form', '', '', 'onerror');
//    	},
<?php }?>
        rules : {
            groupbuy_name: {
                required : true
            },
            start_time : {
                required : true,
                greaterThanDate : '<?php echo date('Y-m-d H:i',$output['groupbuy_start_time']);?>'
            },
            end_time : {
                required : true,
<?php if (!$output['isOwnShop']) { ?>
                lessThanDate : '<?php echo date('Y-m-d H:i',$output['current_groupbuy_quota']['end_time']);?>',
<?php } ?>
                greaterThanStartDate : true
            },
            groupbuy_goods_id: {
                required : true,
                <?php if(!$output['update']){?>

                checkGroupbuyGoods: true
                <?php }?>
            },
            groupbuy_price: {
                required : true,
                number : true,
                digits:true,
                lessThanGoodsPrice: true,
                min : 1,
                max : 1000000
            },
            virtual_quantity: {
                required : true,
                digits : true
            },
            upper_limit: {
                required : true,
                digits : true
            },
            // groupbuy_image: {
            //     required : true
            // }
        },
        messages : {
            groupbuy_name: {
                required : '<i class="icon-exclamation-sign"></i>请输入藏品惠名称'
            },
            start_time : {
                required : '<i class="icon-exclamation-sign"></i>藏品惠开始时间不能为空',
                greaterThanDate : '<i class="icon-exclamation-sign"></i><?php echo sprintf('藏品惠开始时间必须大于{0}',date('Y-m-d H:i',$output['current_groupbuy_quota']['start_time']));?>'
            },
            end_time : {
                required : '<i class="icon-exclamation-sign"></i>藏品惠结束时间不能为空',
<?php if (!$output['isOwnShop']) { ?>
                lessThanDate : '<i class="icon-exclamation-sign"></i><?php echo sprintf('藏品惠结束时间必须小于{0}',date('Y-m-d H:i',$output['current_groupbuy_quota']['end_time']));?>',
<?php } ?>
                greaterThanStartDate : '<i class="icon-exclamation-sign"></i>结束时间必须大于开始时间'
            },
            groupbuy_goods_id: {
                required : '<i class="icon-exclamation-sign"></i>请选择藏品惠产品',
				<?php if(!$output['update']){?>
                checkGroupbuyGoods: '该商品已经参加了同时段的活动'
				<?php }?>
            },
            groupbuy_price: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['groupbuy_price_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['groupbuy_price_error'];?>',
                digits:'<i class="icon-exclamation-sign"></i>藏品惠价格必须是整数',
                lessThanGoodsPrice: '<i class="icon-exclamation-sign"></i>藏品惠价格必须小于商品价格',
                min : '<i class="icon-exclamation-sign"></i><?php echo $lang['groupbuy_price_error'];?>',
                max : '<i class="icon-exclamation-sign"></i><?php echo $lang['groupbuy_price_error'];?>'
            },
            virtual_quantity: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['virtual_quantity_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['virtual_quantity_error'];?>'
            },
            upper_limit: {
                required : '<i class="icon-exclamation-sign"></i>请正确的填写限购数量',
                digits : '<i class="icon-exclamation-sign"></i>请正确的填写限购数量'
            },
            // groupbuy_image: {
            //     required : '<i class="icon-exclamation-sign"></i>藏品惠图片不能为空'
            // }
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

(function(data) {
    var class_id = "<?php echo $output['groupbuy_info']['class_id']; ?>";
    var s = '<option value="0">不限</option>';
    if (typeof data.children != 'undefined') {
        if (data.children[0]) {
            $.each(data.children[0], function(k, v) {
                if(v == class_id){var sel = "selected='selected'";}else{var sel='';}
                s += '<option value="'+v+'" '+ sel +' >'+data['name'][v]+'</option>';
            });
        }
    }
    $('#class_id').html(s).change(function() {
        var ss = '<option value="0">不限</option>';
        var v = this.value;
        if (parseInt(v) && data.children[v]) {
            $.each(data.children[v], function(kk, vv) {
                ss += '<option value="'+vv+'">'+data['name'][vv]+'</option>';
            });
        }
        $('#s_class_id').html(ss);
    });
})($.parseJSON('<?php echo json_encode($output['groupbuy_classes']); ?>'));
</script>
