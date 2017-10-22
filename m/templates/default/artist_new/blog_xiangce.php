
            <div class="blogs-title one">
            	<h2>相册</h2>
            </div>

			<?php if(!empty($output['artist_img_list'])){?>
            <div class="demo-item">
				<ul class="blogs-album-art">
					<?php foreach($output['artist_img_list'] as $k => $v){?>
						<li class="ui-border">
							<div class="photo">
								<i class="img" style="background: url(<?php echo BASE_SITE_URL . '/' . $v['I_ImgXC'];?>);"></i>
							</div>
							<h2 class="ui-nowrap"><?php echo $v['I_Name'];?></h2>
						</li>
					<?php }?>
				</ul>
			</div>
			<?php }?>
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
				    if(p <= page_num) {
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?act=artist_blog&op=ajaxxiangce&aid=<?php echo $output['aid']?>',
                            data: 'curpage=' + p,
                            success: function (msg) {
                                if (msg) {
                                    var arr = eval(msg);
                                    var len = arr.length;
                                    var str = '';
                                    for (var i = 0; i < len; i++) {
                                        str += '<li class="ui-border"><div class="photo"><i class="img" style="background: url(<?php echo BASE_SITE_URL?>' + arr[i]['I_ImgXC'] + ');"></i></div><h2 class="ui-nowrap">' + arr[i]['I_Name'] + '</h2></li>';
                                    }
                                    $('.blogs-album-art > li').last().after(str);
                                    p = parseInt(p) + 1;
                                    load_flag = false;
                                }
                            }
                        });
                    }
				}
			</script>