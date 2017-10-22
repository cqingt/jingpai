function get_input(n,id,k,v) {//生成隐藏域代码
	return '<input type="hidden" name="'+n+'['+id+']['+k+']" value="'+v+'">';
}
function get_recommend_goods() {//查询商品
	var gc_id = 0;
	$('#recommend_gcategory > select').each(function() {
		if ($(this).val()>0) gc_id = $(this).val();
	});
	var goods_name = $.trim($('#recommend_goods_name').val());
	if (gc_id>0 || goods_name!='') {
		$("#show_recommend_goods_list").load('index.php?act=web_api&op=recommend_list&'+$.param({'id':gc_id,'goods_name':goods_name }));
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