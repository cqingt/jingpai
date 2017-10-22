
$('document').ready(function() {
	// 设置这些div为JavaScipt浏览器显示
	$('.gallery_data').css('display','block');
	$('.gallery_preview').css('display','block');
	$('.gallery_caption').css('display','block');

	// 捕捉缩略图链接
	$('.gallery_thumbnails a').click(function(e){
		// 禁用标准链接行为
		e.preventDefault();

		// 基于链接的缩略图设置变量
		var photo_caption = $(this).attr('title');
		var photo_fullsize = $(this).attr('href');
		var photo_classify= $(this).data('classify');
		var photo_img= $('gallery_thumbnails a img').attr('src');

		
		var photo_preview = photo_fullsize.replace("_fullsize", "_preview");

		var $card = $(this).parents('.card');
		// 淡出预览,预加载新形象,淡化预览  imgpreload

		$card.find('.gallery_caption').slideUp(500);
		$card.find('.gallery_preview').fadeOut(500, function(){
			$card.find('.gallery_preload_area').html('<img src="'+photo_preview+'" />');
			$card.find('.gallery_preload_area').find('img').imgpreload(function(){
				$card.find('.gallery_preview').html('<a class="overlayLink" title="'+photo_caption+'" data-classify="'+photo_classify+'" href="'+photo_fullsize+'" style="background-image:url('+photo_preview+');"></a>');
				$card.find('.gallery_preview').fadeIn(500);
			$card.find('.gallery_caption').html('<a class="name" href="'+photo_fullsize+'">'+photo_caption+'</a><p class="field">'+photo_classify+'</p>');
				$card.find('.gallery_caption').slideDown(500);
				updateThumbnails();
			});

		});
	    $(this).addClass('active').siblings().removeClass('active');
	});

	// 设置第一个预览图像
	var $card = $('.ui-demo .card');
	$('.ui-demo .card').each(function () {
		var self = $(this),
				$a1 = self.find('.gallery_thumbnails a').eq(0);
				$href = self.find('.gallery_thumbnails a img').eq(0)
				self.find('.gallery_preview').html('<a class="overlayLink" title="'+$a1.attr('title')+'" data-classify="'+$a1.data().classify+'" href="'+$a1.attr('href')+'" style="background-image:url('+$href.attr('src')+');"></a>');
				self.find('.gallery_caption').html('<a class="name" href="'+$a1.attr('href')+'">'+$a1.attr('title')+'</a><p class="field">'+$a1.data().classify+'</p>');
	})

});



function updateThumbnails(){
	$('.gallery_thumbnails a').each(function(index){

		if ( $('.gallery_preview a').data('href') == $(this).attr('href') ){
			$(this).addClass('selected');
			$(this).children().fadeTo(250, .4);
		}else {
			$(this).removeClass('selected');
			$(this).children().css('opacity', '1');
		}
	});

}
