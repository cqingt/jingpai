<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/flickerplate.css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_menu.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/index.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/lefttime4.js"></script>  

<!--Required libraries-->
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/modernizr-custom-v2.7.1.min.js" type="text/javascript"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/min/hammer-v2.0.3.min.js" type="text/javascript"></script>

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/flickerplate.min.js" type="text/javascript"></script>
	<style>
.list_tuangou2_img {
	position:relative;
}
.seckill-new-item {
	position:relative;
}
.icon-by {
	position: absolute;
	top:0;
	left:0;
	background:url(http://m.96567.com/templates/default/images/icon-Pinkage.png) no-repeat;
	background-size: 100%;
	width: 50px;
	height: 103px;
}
	</style>

	<!--Execute flickerplate-->
	<script>
	$(function(){
		$('.flicker-example').flickerplate(
		{
            auto_flick 				: true,
            auto_flick_delay 		: 8,
            flick_animation 		: 'transform-slide'
        });
	});
	</script>

<!-- Demo styles -->
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css"  type="text/css" rel="stylesheet">
<div style="height:46px;"></div>
<div class="m_w">
     <div class="m_header0505" id="m_top">
          <div class="m_header0505_left"><a href="###"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/logo.png"></a></div>
               <form id="searchForm" name="searchForm" method="get" action="">
                <input type="hidden" name="act" value="goods">
                <input type="hidden" name="op" value="goods_list">
                     <div class="m_header0505_midd">
                          <input name="keyword" id="keyword" type="text" required="" class="m_search" value="" onblur="if(this.value==''){this.value='请输入搜索关键字';}" onfocus="if(this.value=='请输入搜索关键字'){this.value='';}">

                          <span><a href="javascript:;" onclick="checkSearchForms();"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/seach_icon.png" width="90%"></a></span>
                     </div>
               </form>
			   <script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/adv.js"></script>
			   <script>
			   function checkSearchForms(){
				        if(document.getElementById('keyword').value == '请输入商品名称' || document.getElementById('keyword').value == ""){
				         alert('请输入商品名称');
				         return false;
				        }
				        document.getElementById('searchForm').submit();
			   }
			   </script>
			<?php if(intval($_SESSION['member_id']) <= 0) {?>
				<div class="m_header0505_right"><a href="<?php echo urlWap('login','index');?>">登录</a></div>
			<?php }else{ ?>
                <div class="m_header0505_right"><a href="<?php echo urlWap('member','home');?>"><i class="fa fa-user fa-2x"></i></a></div>
            <?php } ?>
     </div>
</div>

<div class="m_w">
	   <!--Basic example-->
	   <div class="flicker-example">
       <ul class="flicks">
		<?php foreach($output['adv_list'] as $k=>$v){ ?>
          <li>
             <a href="<?php echo $v['data'];?>"><img src="<?php echo $v['image'];?>" alt=""></a>
          </li>
		<?php } ?>
       </ul>
	   </div>
</div>

<div class="mss_vip_ul">
     <ul class="mss_vip_ulc">
<!--          <li>
            <a href="http://zu.96567.com/m/">
          	   <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav1.png"></span>
               <span>艺租</span>
            </a>
         </li> -->
         <li>
            <a href="http://m.96567.com/index.php?act=artist&op=index">
        	     <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav_sh.png"></span>
               <span>书画馆</span>
         </a>
         </li>
         <li>
            <a href="<?php echo urlWap('lepai','index')?>">
        	     <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav2.png"></span>
               <span>拍卖惠</span>
         </a>
         </li>
         <li>
            <a href="<?php echo urlWap('vip','index')?>">
        	     <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav3.png"></span>
               <span>俱乐部</span>
            </a>
         </li>
         <li>
            <a href="<?php echo urlWap('group_buy','index')?>">
        	     <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav4.png"></span>
               <span>藏品惠</span>
            </a>
         </li>
         <li>
            <a href="http://m.96567.com/scxy.html">
        	     <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav5.png"></span>
               <span>收藏学院</span>
            </a>
         </li>
         <!--<li>
            <a href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160405">
                 <span><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/index_nav6.png"></span>
               <span>商家入驻</span>
            </a>
         </li>-->
     </ul>
</div>

<div class="m_w">
<?php if($output['miaosha_list']){ ?>
<script>
var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
    var now_time = Date.parse(new Date()) / 1000;
    var Diffs = time -now_time;
    if(t == 2){
        var html = '<span class="seckill-time">距结束：剩余</span>';
    }else{
        var html = '<span class="seckill-time">距开始：剩余</span>';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;

    if(DifferHour > 0){
        html += "<span class='seckill-time'>"+DifferHour+"时</span>";
    }
    if(DifferMinute > 0){
        html += "<span class='seckill-time'>"+DifferMinute+"分</span>";
    }
    html += "<span class='seckill-time'>"+Diffs+"秒</span>";
    document.getElementById("seckill_time").innerHTML =html;
}
</script>
    <div class="floor seckill-floor">
    	 <div class="title-wrap">
    		 <span class="seckill-icon"></span>
             <h2 class="seckill-title">掌上秒杀</h2>
             <div class="seckill-timer" id="seckill_time">
				<span class='seckill-time'>正在载入中...</span>
             </div>
             <a href="http://m.96567.com/index.php?act=miaosha&op=index_list">点击更多</a>
         </div>
         <ul id="seckillul" class="seckill-new-list">
		<?php foreach($output['miaosha_list'] as $k=>$v){ ?>
    		 <li class="seckill-new-item">
    			 <div class="seckill-item-img">
				 <?php if($v['is_shipping'] == 1){?>
					<div class="icon-by"></div>
				 <?php } ?>
                      <a report-eventid="MHome_HandSeckill" report-eventparam="" page_name="index" href="<?php echo urlWap('miaosha','index_list');?>" class="seckill-link J_ping">
                         <img width="100%" src="<?php echo $v['goods_image']; ?>" border="0" class="seckill-photo">
                      </a>
    			 </div>
    			 <div class="seckill-item-price">
                      <span class="seckill-new-price">¥<?php echo $v['miaosha_price']; ?></span>
    				  <span class="seckill-original-price">¥<?php echo $v['goods_price']; ?></span>
    			 </div>
             </li>
			  <?php $i +=$v['end']; ?>
		<?php } ?>
			<script type="text/javascript">
				<?php if($i < 9 && $i > 3){?>
				window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
				<?php }elseif($i=='9'){ ?>
				window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
				<?php }else{ ?>
				document.getElementById("seckill_time").innerHTML ="<span class='seckill-time'>秒杀已结束</span>";
				<?php } ?>
			</script>
    	 </ul>
    </div>
<?php } ?>

    <div class="floor">
    		<?php $getadvImg = loadadv(1080,'array');?>

		<a href="<?php echo $getadvImg['adv_url']?>">
    	 	<img class="index-ad" src="<?php echo $getadvImg['adv_img']?>" alt="">
    	</a>
    </div>

    <div class="floor discount-floor">
         <h2 class="title">0元起拍</h2>
         <div class="discount">
		 <a href="<?php echo urlWap('lepai','index');?>">
              <div class="zreo-img">
                   <img src="<?php echo BASE_SITE_URL.$output['lepai_item']['G_MainImg'];?>" alt="<?php echo $output['lepai_item']['G_Name']; ?>">
              </div>
              <div class="zreo-text" style="width: 65%;color: #474747;">
                   <h5><?php echo $output['lepai_item']['G_Name']; ?></h5>
                   <p><em>当前价：<strong>￥<?php echo $output['lepai_item']['new_price']; ?></strong></em>已经有
				   <?php if($output['lepai_item']['T_Ktime'] > TIMESTAMP){ ?>
				    <strong> <?php echo $output['lepai_item']['T_Click'];?> </strong>次围观
				   <?php }else{ ?>
				   <strong> <?php echo $output['lepai_item']['chujia_count'];?> </strong>次出价
				   <?php } ?>
				   </p>
<script>
function lepaiclockdone(){
	setTimeout("lepaiclockdone()", 1000);
	$("#lepai_seckill_time").each(function(){
		var obj = $(this);
		var tms = obj.attr("count_down");
		var t = obj.attr("timestatus");
		if(t == 2){
			var html = '<span class="seckill-time">距结束：</span>';
		}else{
			var html = '<span class="seckill-time">距开始：</span>';
		}
		if (tms>0) {
			tms = parseInt(tms)-1;
			var days = Math.floor(tms / (1 * 60 * 60 * 24));
			var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
			var minutes = Math.floor(tms / (1 * 60)) % 60;
			var seconds = Math.floor(tms / 1) % 60;

			if(days > 0){
				html += "<span class='seckill-time'>"+days+"天</span>";
			}
			if(hours > 0){
				html += "<span class='seckill-time'>"+hours+"时</span>";
			}
			if(minutes > 0){
				html += "<span class='seckill-time'>"+minutes+"分</span>";
			}
			html += "<span class='seckill-time'>"+parseInt(seconds)+"秒</span>";
			obj.html(html);
			obj.attr("count_down",tms);
		}else{
			location.href = location.href;
		}
	});
}
lepaiclockdone();//启动倒计时
</script>
                   <div class="seckill-timer" id="lepai_seckill_time" count_down="<?php echo $output['lepai_item']['G_EndTime'] - TIMESTAMP;?>" <?php if($output['lepai_item']['T_Ktime'] > TIMESTAMP){ ?> timestatus="1"<?php }else{ ?>timestatus="2"<?php } ?>>
					<span class='seckill-time' >正在载入中...</span>
                   </div>
              </div>
			  </a>
         </div>                  
    </div>

<div class="main" id="main-container"></div>
<script type="text/html" id="adv_list">

 
</script>
</div>
<script type="text/html" id="home1">


</script>
<script type="text/html" id="home4">
	<div class="floor discount-floor">
	<% if (title) { %>
		<h2 class="title"><%= title %></h2>
	<% } %>
		 <div class="discount2">
             <a href="<%= rectangle1_url %>" class="discount-link half-floor J_ping">
                <img src="<%= rectangle1_image %>" alt="" width="100%" border="0" class="brand-photo">
             </a>

             <a href="<%= square_url %>" class="discount-link down-floor J_ping">
                <img src="<%= square_image %>" alt="" width="100%" border="0" class="brand-photo">
            </a>
			 <a href="<%= rectangle2_url %>" class="discount-link up-floor J_ping">
                <img src="<%= rectangle2_image %>" alt="" width="100%" border="0" class="brand-photo">
             </a>
        </div>
</div>
</script>
<script type="text/html" id="home3">
<div class="floor2">
	  <div class="nav_ad">
	  <% for (var i in item) { %>
		   <div class="tbl-type" style="width: 49%;display: inline-block;<% if(i > 1){ %> padding-top: 10px; <% } %>">
					<a href="<%= item[i].url %>">
					   <img src="<%= item[i].image %>" width="100%" border="0">
					 </a>
		   </div>
	  <% } %>
	  </div>
</div>
</script>
<script type="text/html" id="home2">

<div class="floor discount-floor">
	<% if (title) { %>
		<h2 class="title"><%= title %></h2>
	<% } %>
		 <div class="discount2">
             <a href="<%= rectangle1_url %>" class="discount-link up-floor J_ping">
                <img src="<%= rectangle1_image %>" alt="" width="100%" border="0" class="brand-photo">
             </a>
            
             <a href="<%= square_url %>" class="discount-link half-floor J_ping">
                <img src="<%= square_image %>" alt="" width="100%" border="0" class="brand-photo">
            </a>
			 <a href="<%= rectangle2_url %>" class="discount-link down-floor J_ping">
                <img src="<%= rectangle2_image %>" alt="" width="100%" border="0" class="brand-photo">
             </a>
        </div>
</div>
</script>
<script type="text/html" id="goods">
	 <div class="floor">
         <div class="index_block goods">
		 <% if (title) { %>
         <h2 class="title"><%= title %></h2>
		 <% } %>
             <div class="content">
				<% for (var i in item) { %>
                  <div class="goods-item">
                       <a href="index.php?act=goods&op=index&goods_id=<%= item[i].goods_id %>">
                          <div class="goods-item-pic"><img src="<%= item[i].goods_image %>" alt="<%= item[i].goods_name %>"></div>
                          <div class="goods-item-name"><%= item[i].goods_name %></div>
                          <div class="goods-item-price"><% if(item[i].goods_price  >= 1){ %>￥<%= item[i].promotion_price?item[i].promotion_price:item[i].goods_price %> <% }else{ %> 咨询客服 <% } %></div>
                       </a>
                  </div>
        
                  <% } %>
        
             </div>
         </div>
    </div>
</script>

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
        url:  "<?php echo urlWap('index','shopMtel');?>",
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

$array['P']['title'] = '收藏天下官方网站 中国收藏投资第一服务品牌';
$array['P']['imgUrl'] = 'http://m.96567.com/images/logo.png';
$array['Y']['title'] = '收藏天下官方网站 中国收藏投资第一服务品牌';
$array['Y']['desc'] = '买字画、邮币卡、文玩？上收藏天下！致力于大众正品收藏，中国收藏投资第一服务品牌！';
$array['Y']['imgUrl'] = 'http://m.96567.com/images/logo.png';

echo weixinShare($array);

?>