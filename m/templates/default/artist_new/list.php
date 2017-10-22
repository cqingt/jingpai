<section>
		<main class="cd-main-content">
		<div class="demo-find">
			<div class="ui-row">
				<div class="ui-col ui-col-67 ui-border-radius">
					<div class="ui-searchbar">
						<form action="index.php" method="get" name="search">
						<a href="javascript:document.search.submit()"><i class="ui-icon-search"></i></a>
						<div class="ui-searchbar-input"><input value="<?php echo $_GET['keyword']?>" type="text" placeholder="艺术家名" autocapitalize="off" name="keyword"></div>
						<input type="hidden" value="artist_new" name="act">
						<input type="hidden" value="list" name="op">
						<input type="hidden" value="<?php echo $_GET['class'];?>" name="class">
						<input type="hidden" value="<?php echo $_GET['address'];?>" name="address">
						<input type="hidden" value="<?php echo $_GET['zhiwei'];?>" name="zhiwei">
						</form>
					</div>
				</div>
				<div class="ui-col ui-col-33">
					<p id="cd-menu-trigger">筛选</p>
				</div>
			</div>
		</div>
		 <div class="demo-writer">
			<ul class="blogs-album-art">
				<?php foreach( $output['artist_list'] as $key => $val ){?>
					<li class="ui-border">
						<a href="<?php echo urlWap('artist_blog','index',array('aid'=>$val['A_Id']))?>">
							<div class="photo">
								<i class="img" style="background: url(<?php echo BASE_SITE_URL.'/'.$val['A_Img'];?>);"></i>
							</div>
							<h1 class="ui-nowrap"><?php echo $val['A_Name']?></h1>
							<h2 class="ui-nowrap"><?php echo $val['A_ZhiCheng']?></h2>
						</a>
					</li>
				<?php }?>
			</ul>
		</div>
		</main>
		<nav id="cd-lateral-nav">
			<ul class="cd-navigation">
				<li class="item-has-children">
					<a class="submenu-open" href="#">艺术分类</a>
					<ul class="sub-menu" style="display: block;">
						<?php foreach($output['yishuClass'] as $key => $val){?>
						<li><a <?php if($key == $_GET['class']){?>style="color:red;"<?php }?> href="index.php?act=artist_new&amp;op=list&amp;class=<?php echo $key?>&amp;address=<?php echo $_GET['address']?>&amp;zhiwei=<?php echo $_GET['zhiwei']?>keyword=<?php echo $_GET['keyword'];?>"><?php echo $val;?></a></li>
						<?php }?>
					</ul>
				</li> <!-- item-has-children -->
	
				<li class="item-has-children">
					<a href="#">地区名家</a>
					<ul class="sub-menu">
						<?php foreach($output['address'] as $key => $val){?>
						<li><a <?php if($val['area_id'] == $_GET['address']){?>style="color:red;"<?php }?> href="index.php?act=artist_new&amp;op=list&amp;class=<?php echo $_GET['class']?>&amp;address=<?php echo $val['area_id']?>&amp;zhiwei=<?php echo $_GET['zhiwei']?>keyword=<?php echo $_GET['keyword'];?>"><?php echo $val['area_name'];?></a></li>
						<?php }?>
					</ul>
				</li> <!-- item-has-children -->
	
				<li class="item-has-children">
					<a href="#">职位</a>
					<ul class="sub-menu">
						<?php foreach($output['zhiwei'] as $key => $val){?>
						<li><a <?php if($val['P_Id'] == $_GET['zhiwei']){?>style="color:red;"<?php }?> href="index.php?act=artist_new&amp;op=list&amp;class=<?php echo $_GET['class']?>&amp;address=<?php echo $_GET['address']?>&amp;zhiwei=<?php echo $val['P_Id']?>keyword=<?php echo $_GET['keyword'];?>"><?php echo $val['P_Name'];?></a></li>
						<?php }?>
					</ul>
				</li> <!-- item-has-children -->
			</ul> <!-- cd-navigation -->
		</nav>
	</section>
<script type="text/javascript">
	//加载更多
	var load_flag=false;
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
		var y_class = $("input[name='class']").val();
		var address = $("input[name='address']").val();
		var zhiwei = $("input[name='zhiwei']").val();
		$.ajax({
			type: 'GET',
			url: 'index.php?act=artist_new&op=list_ajax',
			data: 'class='+y_class+'&address='+address+'&zhiwei='+zhiwei+'&page='+p,
			success: function(msg){
				if(msg){
					var arr = eval(msg);
					var len = arr.length;
					var str = '';
					for(var i = 0 ; i < len ; i ++){
						str+= '<li class="ui-border"><a href="index.php?act=artist_blog&amp;op=index&amp;aid=' + arr[i]['A_Id'] + '"><div class="photo"><i class="img" style="background: url(<?php echo BASE_SITE_URL;?>/' + arr[i]['A_Img'] + ');"></i></div><h1 class="ui-nowrap">' + arr[i]['A_Name'] + '</h1><h2 class="ui-nowrap">' + arr[i]['A_ZhiCheng'] + '</h2></a></li>';
					}
					$('.blogs-album-art > li').last().after(str);
					p = parseInt(p) + 1;
					load_flag = false;
				}
			}
		});
	}
</script>