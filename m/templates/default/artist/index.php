<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/lefttime4.js"></script>  

<!--Required libraries-->
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/hammer-v2.0.3.min.js" type="text/javascript"></script>

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/flickerplate.min.js" type="text/javascript"></script>
<section>
			<div class="device">
				<div class="swiper-container">
				  <div class="swiper-wrapper">
				  <?php foreach($output['adv_list'] as $k=>$v){ ?>
				    <div class="swiper-slide" onclick="window.location.href='<?php echo $v['data'];?>'"> <img src="<?php echo $v['image'];?>"> </div>
					<?php } ?>
				</div>
				<div class="pagination"></div>
				</div>
				  
				<script>
				  var mySwiper = new Swiper('.swiper-container',{
				pagination: '.pagination',
				    loop:true,
				    grabCursor: true,
				    calculateHeight: true,
				    autoplay: 4000,
					autoplayDisableOnInteraction : false
				  })
			    </script>
		  
			<div class="demo-item mod-entrance ui-border-b">
			    <div class="ui-row-flex ui-whitespace pb">
			        <div data-href="<?php echo urlWap('goods','goods_list',array('cate_id'=>182))?>" class="ui-col">
			        	<img class="icon" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/home-nav1.png">
			        	<p class="name">国画</p>
			        </div>
			        <div data-href="<?php echo urlWap('goods','goods_list',array('cate_id'=>332))?>" class="ui-col">
			        	<img class="icon" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/home-nav2.png">
			        	<p class="name">书法</p>
			        </div>

			        <div data-href="<?php echo urlWap('artist_new','list')?>" class="ui-col">
			        	<img class="icon" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/home-nav3.png">
			        	<p class="name">艺术家</p>
			        </div>

			        <div data-href="<?php echo urlWap('artist','FenLei');?>" class="ui-col">
			        	<img class="icon" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/home-nav4.png">
			        	<p class="name">选画中心</p>
			        </div>
			        <div data-href="<?php echo urlWap('lepai','index',array("type"=>"ShuHua"))?>" class="ui-col">
			        	<img class="icon" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/home-nav5.png">
			        	<p class="name">拍卖</p>
			        </div>
			    </div>
			</div>
<?php if($output['miaosha_list']){ ?>
<div class="demo-item pt ui-border-b">
<script>
var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
	
    var now_time = Date.parse(new Date()) / 1000;
    var Diffs = time -now_time;
    if(t == 2){
        var html = '距结束：剩余';
    }else{
        var html = '距开始：剩余';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;

    if(DifferHour > 0){
        html += DifferHour+"时";
    }
    if(DifferMinute > 0){
        html += DifferMinute+"分";
    }
    html += Diffs+"秒";
    document.getElementById("seckill_time").innerHTML =html;
}
</script>
				<div class="mod-box-header ui-whitespace">
					<h2>
						<i class="icon-one1"></i>
						<strong>掌上秒杀</strong>
						<time class="time-seckill" id="seckill_time">正在载入中...</time>
					</h2>
					<a href="<?php echo urlWap('miaosha','index_list',array("type"=>"ShuHua"));?>" class="more">更多></a>
			    </div>
			    <div class="demo-block">
				    <div class="swiper-seckill">
				        <div class="swiper-wrapper">
						<?php foreach($output['miaosha_list'] as $k=>$v){ ?>
						 <?php if($v['is_shipping'] == 1){?>
							<div class="icon-by"></div>
						 <?php } ?>
				            <div class="swiper-slide">
				            	<div class="ui-border-l">
					            	<div data-href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" class="rec-img">
					            		<i class="img" style="background: url(<?php echo $v['goods_image']; ?>);"></i>
					            	</div>
					            	<p class="cost">¥<?php echo $v['miaosha_price']; ?></p>
					            	<p class="op">¥<?php echo $v['goods_price']; ?></p>
				            	</div>
				            </div>
							<?php $i +=$v['end']; ?>
						<?php } ?>
						<script type="text/javascript">
							<?php if($i < 18 && $i > 6){?>
							window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
							<?php }elseif($i=='18'){ ?>
							window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
							<?php }else{ ?>
							document.getElementById("seckill_time").innerHTML ="秒杀已结束";
							<?php } ?>
							var swiper = new Swiper('.swiper-seckill', {
								pagination: '.swiper-pagination',
								slidesPerView: 3,
								paginationClickable: true,
								spaceBetween: 30,
								calculateHeight: true,
							
							});
						</script>
				        </div>
				    </div>
			    </div>
			   
			</div>
<?php } ?>

			<div class="demo-item">
				<div class="mod-box-header pt ui-border-t ui-whitespace">
					<h2><i class="icon-one2"></i><strong>艺术家推荐</strong></h2>
					<a class="more" href="<?php echo urlWap('artist_new','list');?>">更多></a>
			    </div>
		<?php if($output['artist_push_list']){ ?>
			    <div class="demo-block">
				    <div class="swiper-longhair">
				        <div class="swiper-wrapper">
						<?php foreach($output['artist_push_list'] as $k=>$v){ ?>
				            <div class="swiper-slide">
				            	<div data-href="<?php echo urlWap('artist_blog','index',array('aid'=>$v['A_Id']));?>" class="rec-img">
				            		<i class="img" style="background: url(http://www.96567.com/<?php echo $v['A_Img'];?>);"></i>
				            	</div>
				            	<p class="name"><?php echo $v['A_Name'];?></p>
				            </div>
<?php } ?>
				            
				        </div>
				    </div>
			    </div>

			    <script type="text/javascript">
				    var swiper = new Swiper('.swiper-longhair', {
				        pagination: '.swiper-pagination',
				        slidesPerView: 4,
				        paginationClickable: true,
				        spaceBetween: 30,
			            calculateHeight: true,
				    });
			    </script>
				<?php } ?>
			</div>


			<div class="main" id="main-container"></div>
			<script type="text/html" id="adv_list">

 
</script>
<script type="text/html" id="home1">
			<a class="demo-ad ui-border-t" href="<%= data %>"><img src="<%= image %>"/></a>
	</script>		
			<div class="demo-aura">
				<script type="text/html" id="home2">
				<% if (title) { %>
				 <h2 class="home-title"><%= title %></h2>
				 <% } %>
				 <div class="ui-aura-imgbox">
				 	<div class="box fl">
				 		<a href="<%= square_url %>" class="ui-border-r"><img src="<%= square_image %>"/></a>
				 	</div>
				 	<div class="boxes fl">
						<a href="<%= rectangle1_url %>" class="ui-border-b"><img src="<%= rectangle1_image %>"/></a>
				 		<a href="<%= rectangle2_url %>"><img src="<%= rectangle2_image %>"/></a>
				 	</div>
			     </div>
				</script>
			<script type="text/html" id="home4">
				<% if (title) { %>
					<h2 class="home-title"><%= title %></h2>
				<% } %>
				 <div class="ui-aura-imgbox">
				 	<div class="boxes fl">
				 		<a href="<%= rectangle1_url %>" class="ui-border-b"><img src="<%= rectangle1_image %>"/></a>
				 		<a href="<%= rectangle1_url %>"><img src="<%= rectangle2_image %>"/></a>
				 	</div>
				 	<div class="box fl">
				 		<a href="<%= square_url %>" class="ui-border-l"><img src="<%= square_image %>"/></a>
				 	</div>
			     </div>
				 </script>
			</div>
			<script type="text/html" id="home3">
			<div class="home-say">
			<% for (var i in item) { %>
				<a class="saybox" href="<%= item[i].url %>"><img src="<%= item[i].image %>"/></a>
				<% } %>
				
			</div>
			</script>
			<script type="text/html" id="goods">
			<div class="home-guess-title">
			<% if (title) { %>
				<h2><i class="g1"></i><%= title %><i class="g2"></i></h2>
			<% } %>
				<span></span>
			</div>
			
			<div class="demo-item">
				<ul class="home-shopboxes">
				<% for (var i in item) { %>
					<li>
					<a href="index.php?act=goods&op=index&goods_id=<%= item[i].goods_id %>">
						<div class="photo">
							<i class="img" style="background: url(<%= item[i].goods_image %>);"></i>
						</div>
						<h2 class="ui-nowrap-multi"><%= item[i].goods_name %></h2>
						<p class="ui-border-t"><% if(item[i].goods_price  >= 1){ %>¥<%= item[i].promotion_price?item[i].promotion_price:item[i].goods_price %> <% }else{ %> 咨询客服 <% } %></p>
						</a>
					</li>
					<% } %>
				</ul>
			</div>
			</script>

		</section>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/template.js"></script>


<script>
function buildUrl(type, data) {
	var WapSiteUrl = '';
    switch (type) {
        case 'keyword':
            return WapSiteUrl + 'product_list.php?keyword=' + encodeURIComponent(data);
        case 'goods':
            return WapSiteUrl + 'index.php?act=goods&op=index&goods_id=' + data;
        case 'url':
            return data;
    }
    return WapSiteUrl;
}
$(function() {
    $.ajax({
        url:  "<?php echo urlWap('artist','shopMtel');?>",
        type: 'get',
        dataType: 'json',
        success: function(result) {
            var data = result.datas;
            var html = '';
            $.each(data, function(k, v) {
                $.each(v, function(kk, vv) {
                    switch (kk) {
                        case 'adv_list':
                        case 'home3':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                            });
                            break;

                        case 'home1':
                            vv.url = buildUrl(vv.type, vv.data);
                            break;

                        case 'home2':
                        case 'home4':
                            vv.square_url = buildUrl(vv.square_type, vv.square_data);
                            vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                            vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                            break;
                    }
                    html += template.render(kk, vv);
                    return false;
                });
            });
           $("#main-container").html(html);

            $('.adv_list').each(function() {
                if ($(this).find('.item').length < 2) {
                    return;
                }

                Swipe(this, {
                    startSlide: 2,
                    speed: 400,
                    auto: 3000,
                    continuous: true,
                    disableScroll: false,
                    stopPropagation: false,
                    callback: function(index, elem) {},
                    transitionEnd: function(index, elem) {}
                });
            });

        }
    });


});


</script>
<?php 

$array['P']['title'] = "国画收藏_书法收藏_书画收藏_书法字画拍卖_收藏天下书画馆";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/artist/images/weixin.jpg";
$array['Y']['title'] = "国画收藏_书法收藏_书画收藏_书法字画拍卖_收藏天下书画馆";
$array['Y']['desc'] = "收藏天下书画馆为您提供收藏价值极高的国画,书法,书画,版画等珍稀藏品!并有书法字画拍卖中心,为您拍卖各类图画书法等各类收藏品!";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/artist/images/weixin.jpg";

echo weixinShare($array);

?>