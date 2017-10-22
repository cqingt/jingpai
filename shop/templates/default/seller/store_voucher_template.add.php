<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
	<div class="ncsc-form-default">
	  <form id="add_form" method="post" enctype="multipart/form-data">
	  	<input type="hidden" id="act" name="act" value="store_voucher"/>
	  	<?php if ($output['type'] == 'add'){?>
	  	<input type="hidden" id="op" name="op" value="templateadd"/>
	  	<?php }else {?>
	  	<input type="hidden" id="op" name="op" value="templateedit"/>
	  	<input type="hidden" id="tid" name="tid" value="<?php echo $output['t_info']['voucher_t_id'];?>"/>
	  	<?php }?>
	  	<input type="hidden" id="form_submit" name="form_submit" value="ok"/>
	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_title'].$lang['nc_colon']; ?></dt>
	      <dd>
	        <input type="text" class="w300 text" maxlength="14" name="txt_template_title" value="<?php echo $output['t_info']['voucher_t_title'];?>">
	        <span></span>
	      </dd>
	    </dl>
	    <?php if ($output['isOwnShop']) { ?>


	    <!-- <dl>
	      <dt><i class="required">*</i>店铺分类</dt>
	      <dd>
	        <select name="sc_id">
	           <option value="0">店铺分类</option>
	           <?php foreach ($output['store_class'] as $k=>$v){?>
	           <option value="<?php echo $v['sc_id'];?>" <?php if ($output['t_info']['voucher_t_sc_id']==$v['sc_id']){ echo 'selected';}?>><?php echo $v['sc_name'];?></option>
	           <?php }?>
	        </select>
	        <span></span>
	      </dd>
	    </dl> -->



	    <?php } else {?>
	    <input type="hidden" name="sc_id" value="<?php echo $output['store_info']['sc_id'];?>"/>
	    <?php }?>
	    <dl>
	      <dt><em class="pngFix"></em><?php echo $lang['voucher_template_enddate'].$lang['nc_colon']; ?></dt>
	      <dd>
	      	<input type="text" class="text w150" id="txt_template_enddate" name="txt_template_enddate" value="" readonly><em class="add-on"><i class="icon-calendar"></i></em>
	        <span></span><p class="hint">
<?php if ($output['isOwnShop']) { ?>
            留空则默认30天之后到期
<?php } else { ?>
            <?php echo $lang['voucher_template_enddate_tip'];?><?php echo @date('Y-m-d',$output['quotainfo']['quota_starttime']);?> ~ <?php echo @date('Y-m-d',$output['quotainfo']['quota_endtime']);?>
<?php } ?>
            </p>
	      </dd>
	    </dl>
	    <dl>
	      <dt><?php echo $lang['voucher_template_price'].$lang['nc_colon']; ?></dt>
	      <dd>
	        <select id="select_template_price" name="select_template_price" class="w80 vt">
	          <?php if(!empty($output['pricelist'])) { ?>
	          	<?php foreach($output['pricelist'] as $voucher_price) {?>
	          	<option value="<?php echo $voucher_price['voucher_price'];?>" <?php echo $output['t_info']['voucher_t_price'] == $voucher_price['voucher_price']?'selected':'';?>><?php echo $voucher_price['voucher_price'];?></option>
	          <?php } } ?>
	        </select><em class="add-on"><i class="icon-renminbi"></i></em>
	        <span></span>
	      </dd>
	    </dl>
	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_total'].$lang['nc_colon']; ?></dt>
	      <dd>
	        <input type="text" class="w70 text" name="txt_template_total" value="<?php echo $output['t_info']['voucher_t_total']; ?>">
	        <span></span>
	      </dd>
	    </dl>
	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_eachlimit'].$lang['nc_colon']; ?></dt>
	      <dd>
	      	<select name="eachlimit" class="w80">
	      		<option value="0"><?php echo $lang['voucher_template_eachlimit_item'];?></option>
	      		<?php for($i=1;$i<=intval(C('promotion_voucher_buyertimes_limit'));$i++){?>
	      		<option value="<?php echo $i;?>" <?php echo $output['t_info']['voucher_t_eachlimit'] == $i?'selected':'';?>><?php echo $i;?><?php echo $lang['voucher_template_eachlimit_unit'];?></option>
	      		<?php }?>
	        </select>
	      </dd>
	    </dl>
	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_orderpricelimit'].$lang['nc_colon']; ?></dt>
	      <dd>
	        <input type="text" name="txt_template_limit" class="text w70" value="<?php echo $output['t_info']['voucher_t_limit'];?>"><em class="add-on"><i class="icon-renminbi"></i></em>
	        <span></span>
	      </dd>
	    </dl>


























    <dl>
      <dt><i class="required">*</i>优惠范围：</dt>
      <dd> <span class="mr50">
      <select name="cate_rule" class="valid" id="cate_rule">
          <option value="1" <?php if($output['t_info']['voucher_t_cate_rule'] == 1){echo "selected='selected'";}?>>全部店铺分类商品参加</option>
          <option value="2" <?php if($output['t_info']['voucher_t_cate_rule'] == 2){echo "selected='selected'";}?>>按店铺分类选择参加</option>
          <option value="3" <?php if($output['t_info']['voucher_t_cate_rule'] == 3){echo "selected='selected'";}?>>按商品选择参加</option>
      </select>
      </span> </dd>
    </dl>


      <dl id="category_tree" style="display: <?php if($output['t_info']['voucher_t_cate_rule'] == 2){echo "block";}else{echo "none";}?>">
          <dt><i class="required">*</i>可用店铺分类：</dt>
          <dd>
              <table class="ncsc-default-table mb15">
                  <thead id="store_cates_list">
                  <tr>
                      <th class="tl" colspan="2" id="gname_title1">可用店铺分类（只有在可用店铺分类下的商品参加该促销活动）</th>
                      <th class="w90"><?php echo $lang['nc_common_button_operate'];?></th>
                  </tr>
                  </thead>
                  <tbody nctype="bundling_data1"  class="bd-line tip s_store_class">
                  <?php if(!empty($output['f_store_class'])){?>
                      <?php foreach($output['f_store_class'] as $v){?>
 
<tr style="display: table-row;" id="cates_tr_<?php echo $v['stc_id']?>">
  <input type="hidden" name="store_cates[]" value="<?php echo $v['stc_id']?>">
  <td class="tl" colspan="2">
    <dl class="goods-name">
      <dt style="width: 300px;"><?php echo $v['stc_name']?></dt>
    </dl>
  </td>
  <td class="nscs-table-handle w90">
    <span>
      <a href="javascript:void(0);" onclick="cates_operate_delete($('#cates_tr_<?php echo $v['stc_id']?>'), <?php echo $v['stc_id']?>)" class="btn-orange">
        <i class="icon-ban-circle"></i>
        <p>移除</p>
      </a>
    </span>
  </td>
</tr>
                        
                      <?php }?>
                  <?php }?>
                  </tbody>
              </table>
              <span class="mr50">
      <select name="own_class" class="valid" id="own_class">
          <?php if(is_array($output['show_own_class']) && !empty($output['show_own_class'])){ ?>
          <?php foreach($output['show_own_class'] as $k=>$v){?>
              <option value="<?php echo $v['stc_id']?>" name="<?php echo $v['stc_name']?>"><?php echo $v['stc_name']?></option>
               <?php if(is_array($v['children']) && !empty($v['children'])){ ?>
                   <?php foreach($v['children'] as $k1=>$v1){?>
                      <option value="<?php echo $v1['stc_id']?>" name="<?php echo $v['stc_name'].' > '.$v1['stc_name']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v1['stc_name']?></option>
                  <?php }?>
              <?php } ?>
          <?php }?>
          <?php }?>
      </select>&nbsp;&nbsp;<a id="add_gcid" href="JavaScript:void(0);" class="ncsc-btn-mini ncsc-btn-green"><i class="icon-plus"></i>添加到可用分类</a>
      </span></dd>
      </dl>




      <dl id="diff_goods">
          <dt>排除商品</dt>
          <dd>
              <table class="ncsc-default-table mb15">
                  <thead>
                  <tr>
                      <th class="tl" colspan="2" id="gname_title">商品名称（排除商品不参加该促销活动）</th>
                      <th class="w90"><?php echo $lang['nc_common_button_operate'];?></th>
                  </tr>
                  </thead>
                  <tbody nctype="bundling_data"  class="bd-line tip s_store_goods">
  <?php if(!empty($output['s_store_goods'])){?>
      <?php foreach($output['s_store_goods'] as $v){?>
<tr id="bundling_tr_<?php echo $v['goods_id']?>" style="display: <?php if($output['s_store_goods']){echo "table-row";}else{echo "none";}?>;">
  <input type="hidden" nctype="goods_id" name="goods_ids[]" value="<?php echo $v['goods_id']?>">
  <td class="w50 ">
    <div class="pic-thumb">
      <img nctype="bundling_data_img" ncname="<?php echo $v['goods_image'];?>" src="<?php echo cthumb($v['goods_image']);?>" onload="javascript:DrawImage(this,60,60)" width="60" height="60">
    </div>
  </td>
  <td class="tl"><dl class="goods-name"><dt style="width: 300px;"><?php echo $v['goods_name']?></dt></dl>
  </td>
  <td class="nscs-table-handle w90"><span><a href="javascript:void(0);" onclick="bundling_operate_delete($('#bundling_tr_<?php echo $v['goods_id']?>'), <?php echo $v['goods_id']?>)" class="btn-orange"><i class="icon-ban-circle"></i><p>移除</p></a></span>
  </td>
</tr>
      <?php }?>
  <?php }?>
                  </tbody>
              </table>
              <a id="bundling_add_goods" href="index.php?act=store_voucher&op=mansong_add_goods" class="ncsc-btn ncsc-btn-acidblue">添加排除商品</a>
              <div class="div-goods-select-box">
                  <div id="bundling_add_goods_ajaxContent"></div>
                  <a id="bundling_add_goods_delete" class="close" href="javascript:void(0);" style="display: none; right: -10px;">X</a></div>
          </dd>
      </dl>
































	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_describe'].$lang['nc_colon']; ?></dt>
	      <dd>
	        <textarea  name="txt_template_describe" class="textarea w400 h600"><?php echo $output['t_info']['voucher_t_desc'];?></textarea>
	        <span></span>
	      </dd>
	    </dl>
	    <dl>
	      <dt><i class="required">*</i><?php echo $lang['voucher_template_image'].$lang['nc_colon']; ?></dt>
	      <dd>
          <div id="customimg_preview" class="ncsc-upload-thumb voucher-pic"><p><?php if ($output['t_info']['voucher_t_customimg']){?>
      			<img src="<?php echo $output['t_info']['voucher_t_customimg'];?>"/>
      			<?php }else {?>
      			<i class="icon-picture"></i>
      			<?php }?></p>
      		</div>
            <div class="ncsc-upload-btn"><a href="javascript:void(0);"><span>
          <input type="file" hidefocus="true" size="1" class="input-file" name="customimg" id="customimg" nc_type="customimg"/>
          </span>
          <p><i class="icon-upload-alt"></i>图片上传</p>
          </a> </div>
          <p class="hint"><?php echo $lang['voucher_template_image_tip'];?></p>
	      </dd>
	      </dl>
	      <?php if ($output['type'] == 'edit'){?>
	      <dl>
	      	<dt><em class="pngFix"></em><?php echo $lang['nc_status'].$lang['nc_colon']; ?></dt>
	      	<dd>
	      		<input type="radio" value="<?php echo $output['templatestate_arr']['usable'][0];?>" name="tstate" <?php echo $output['t_info']['voucher_t_state'] == $output['templatestate_arr']['usable'][0]?'checked':'';?>> <?php echo $output['templatestate_arr']['usable'][1];?>
	      		<input type="radio" value="<?php echo $output['templatestate_arr']['disabled'][0];?>" name="tstate" <?php echo $output['t_info']['voucher_t_state'] == $output['templatestate_arr']['disabled'][0]?'checked':'';?>> <?php echo $output['templatestate_arr']['disabled'][1];?>
	      	</dd>
	    </dl>
	    <?php }?>
	    <div class="bottom">
	      <label class="submit-border"><input id='btn_add' type="submit" class="submit" value="<?php echo $lang['nc_submit'];?>" /></label>
	      </div>
	  </form>
	</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/template.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />

<script>
//判断是否显示预览模块
<?php if (!empty($output['t_info']['voucher_t_customimg'])){?>
$('#customimg_preview').show();
<?php }?>
var year = <?php echo date('Y',$output['quotainfo']['quota_endtime']);?>;
var month = <?php echo intval(date('m',$output['quotainfo']['quota_endtime']));?>;
var day = <?php echo intval(date('d',$output['quotainfo']['quota_endtime']));?>;

$(document).ready(function(){

    /* ajax添加商品  */
    $('#bundling_add_goods').ajaxContent({
        event:'click', //mouseover
        loaderType:"img",
        loadingMsg:SHOP_TEMPLATES_URL+"/images/loading.gif",
        target:'#bundling_add_goods_ajaxContent'
    }).click(function(){
        $(this).hide();
        $('#bundling_add_goods_delete').show();
    });

    $('#bundling_add_goods_delete').click(function(){
        $(this).hide();
        $('#bundling_add_goods_ajaxContent').html('');
        $('#bundling_add_goods').show();
    });




    //日期控件
    // $('#txt_template_enddate').datepicker();
     $('#txt_template_enddate').datetimepicker({
        controlType: 'select'
    });
    
    var currDate = new Date();
    var date = currDate.getDate();
    date = date + 1;
    currDate.setDate(date);
    
    $('#txt_template_enddate').datepicker( "option", "minDate", currDate);
<?php if (!$output['isOwnShop']) { ?>
    $('#txt_template_enddate').datepicker( "option", "maxDate", new Date(year,month-1,day));
<?php } ?>


    $('#txt_template_enddate').val("<?php echo $output['t_info']['voucher_t_end_date']?@date('Y-m-d H:i:s',$output['t_info']['voucher_t_end_date']):'';?>");
    $('#customimg').change(function(){
		var src = getFullPath($(this)[0]);
		if(navigator.userAgent.indexOf("Firefox")>0){
			$('#customimg_preview').show();
			$('#customimg_preview').children('p').html('<img src="'+src+'">');
		}
	});













    //表单验证
    $('#add_form').validate({
        errorPlacement: function(error, element){
	    	var error_td = element.parent('dd').children('span');
			error_td.append(error);
	    },
        rules : {
            txt_template_title: {
                required : true,
                rangelength:[0,100]
            },
            txt_template_total: {
                required : true,
                digits : true
            },
            txt_template_limit: {
                required : true,
                number : true
            },
            txt_template_describe: {
                required : true
            }
        },
        messages : {
            txt_template_title: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_title_error'];?>',
                rangelength : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_title_error'];?>'
            },
            txt_template_total: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_total_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_total_error'];?>'
            },
            txt_template_limit: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_limit_error'];?>',
                number : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_limit_error'];?>'
            },
            txt_template_describe: {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['voucher_template_describe_error'];?>'
            }
        }
    });



















    $("#cate_rule").change(function(){
        var rule_id = $(this).val();
        if(rule_id == 1){
            $("#category_tree").css('display','none');
            $("#diff_goods").children("dt").html("排除商品");
            $("#gname_title").html("商品名称（排除商品不参加该促销活动）");
            $("#bundling_add_goods").html("添加排除商品")
            $(".s_store_class").remove();
        }else if(rule_id == 2){
            $("#category_tree").css('display','block');
            $("#diff_goods").children("dt").html("排除商品");
            $("#gname_title").html("商品名称（排除商品不参加该促销活动）");
            $("#bundling_add_goods").html("添加排除商品")
            $(".s_store_goods").remove();
        }else if(rule_id == 3){
            $("#category_tree").css('display','none');
            $("#diff_goods").children("dt").html("可用商品");
            $("#gname_title").html("商品名称（只有可用商品参加该促销活动）");
            $("#bundling_add_goods").html("添加可用商品");
            $(".s_store_class").remove();
        }
    });

    $("#add_gcid").click(function(){
        var onselect = $("#own_class").find("option:selected");
        var sel_title = onselect.attr('name');
        var sel_id = onselect.val();
        $("#store_cates_list").append('<tr style="display: table-row;" id="cates_tr_'+sel_id+'"><input type="hidden" name="store_cates[]" value="'+sel_id+'"><td class="tl" colspan="2"><dl class="goods-name"><dt style="width: 300px;">'+sel_title+'</dt></dl></td><td class="nscs-table-handle w90"><span><a href="javascript:void(0);" onclick="cates_operate_delete($(\'#cates_tr_'+sel_id+'\'), '+sel_id+')" class="btn-orange"><i class="icon-ban-circle"></i><p>移除</p></a></span></td></tr>');

        return false;
    });





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
        if( rule_count >= 3) {
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
        var url = "<?php echo urlShop('store_promotion_mansong', 'search_goods');?>";
        url += '&' + $.param({goods_name: $('#search_goods_name').val()});
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


});



/* 删除商品 */
function bundling_operate_delete(o, id){
    o.remove();
    $('li[nctype="'+id+'"]').children(':last').html('<a href="JavaScript:void(0);" onclick="bundling_goods_add($(this))" class="ncsc-btn-mini ncsc-btn-green"><i class="icon-plus"></i>选中商品</a>');
}

/* 删除分类 */
function cates_operate_delete(o, id){
    o.remove();
}








</script>