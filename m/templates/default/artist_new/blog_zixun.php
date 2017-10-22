
            <div class="blogs-title one">
            	<h2>资讯</h2>
            </div>
            
            <div class="blogs-artinfo">
				<ul class="ui-list ui-border-b">
					<?php if(!empty($output['zixun_info'])){?>
					<?php foreach ($output['zixun_info'] as $k => $v){?>
				    <li class="ui-border-t">
						<div class="ui-list-img" data-href="<?php echo urlWap('artist_new','artist_default',array('article_id'=>$v['article_id']))?>">
							<span style="background-image:url(<?php echo $v['N_Img_Url'];?>)"></span>
						</div>
						<div class="ui-list-info">
							<h4 class="ui-nowrap-multi"><?php echo $v['article_title'];?></h4>
							<p class="ui-nowrap"><strong>作者：<?php echo $v['article_author']?></strong><time><?php echo date("Y-m-d",$v['article_publish_time']);?></time></p>
						</div>
				    </li>
					<?php }?>
					<?php }?>
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
							url: 'index.php?act=artist_blog&op=ajaxzixun&aid=<?php echo $output['aid']?>',
							data: 'curpage=' + p,
							success: function (msg) {
								if (msg) {
									var arr = eval(msg);
									var len = arr.length;
									var str = '';
									for (var i = 0; i < len; i++) {
										str += '<li class="ui-border-t" data-href="'+arr[i]['url']+'"><div class="ui-list-img"><span style="background-image:url('+arr[i]['N_Img_Url']+')"></span></div><div class="ui-list-info"><h4 class="ui-nowrap-multi">'+arr[i]['article_title']+'</h4><p class="ui-nowrap"><strong>作者：'+arr[i]['article_author']+'</strong><time>'+arr[i]['article_publish_time']+'</time></p></div></li>';
									}
									$('.ui-border-b > li').last().after(str);
									p = parseInt(p) + 1;
									load_flag = false;
								}
							}
						});
					}
				}
			</script>