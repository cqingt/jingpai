<?php defined('InShopNC') or exit('Access Invalid!');?>
            <div class="blogs-title one">
            	<h2>作品推荐</h2>
            </div>
            
            <div class="demo-item">
				<ul class="home-shopboxes">
					<?php if(!empty($output['goods_list'])){?>
					<?php foreach ($output['goods_list'] as $k => $v){?>
						<li>
							<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
								<div class="photo">
									<i class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></i>
								</div>
								<h2 class="ui-nowrap-multi"><?php echo $v['goods_name'];?></h2>
								<p class="ui-border-t"><em><?php echo ($v['goods_price'] < 1)?"价格：咨询客服":'¥'.intval($v['goods_price'])?></em></p>
							</a>
						</li>
					<?php }}?>
				</ul>
			</div>
        </section>

<script type="text/javascript">
	//加载更多
	var load_flag=false;
	var page_num = <?php echo $output['page_num']?>;
	var p = 2;
	$(function(){

		$(window).scroll(function(){

			if(load_flag){

				return;

			}

			var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());

			if(totalheight>=$(document).height()){

				$("#loadmore").show();

				load_flag=true;

				loadMore();

			}

		});

	});

	function loadMore(){
		if( p <= page_num ) {
			$.ajax({
				type: 'GET',
				url: 'index.php?act=artist_blog&op=ajaxzuoping&aid=<?php echo $output['aid']?>',
				data: 'curpage=' + p,
				success: function (msg) {
					if (msg) {
						var arr = eval(msg);
						var len = arr.length;
						var str = '';
						for (var i = 0; i < len; i++) {
							str += '<li><a href="' + arr[i]["goods_url"] + '"><div class="photo"><i class="img" style="background: url(' + arr[i]['goods_image'] + ');"></i></div><h2 class="ui-nowrap-multi">' + arr[i]['goods_name'] + '</h2><p class="ui-border-t"><em>' + arr[i]['goods_price'] + '</em></p></a></li>';
						}
						$('.home-shopboxes > li').last().after(str);
						p = parseInt(p) + 1;
						load_flag = false;
					}
				}
			});
		}
	}
</script>