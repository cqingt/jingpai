<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/css/features.css">
<script>
var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
    var now_time = Date.parse(new Date()) / 1000;
    //alert(now_time);
    var Diffs = time -now_time;
    if(t == 2){
        var html = '距离结束：剩余';
    }else{
        var html = '距离开始：剩余';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;

    if(DifferHour > 0){
        html += "<strong>"+DifferHour+"</strong>时";
    }
    if(DifferMinute > 0){
        html += "<strong>"+DifferMinute+"</strong>分";
    }
    html += "<strong>"+Diffs+"</strong>秒";
    document.getElementById("leftTime"+key).innerHTML =html;
}
</script>
<div class="main banner">
     <ul id="ul_container">
         <li class="pic-five"  style="z-index: 3;"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/images/five.png" alt="" /></li> 
         <li class="pic-shop1" style="z-index: 2;"><img src="http://img.96567.com/ad/20151208/shop1.png" alt="" /></li>
         <li class="pic-shop2" style="z-index: 1;"><img src="http://img.96567.com/ad/20151208/shop2.png" alt="" /></li>
     </ul>
     <div class="part"></div>
</div>

<div class="main seckill">
     <div class="wrap">
          <div class="five-seckill"></div>
          <h6>12月12日至12月31日共计20天，每日巨献2款藏品，会员只需要花平时售价一半的价格，就能将它们带走。</h6>
          <h6>绝对的大力度只在此次年终大惠站可见！</h6>
          <div class="time">
               <i class="icon-time1"></i>
               <h2>10点档秒杀</h2>
          </div>
          <ul class="show-seckill">
		   <?php foreach($output['miaosha_list']['10'] as $k=>$v){ ?>
              <li>
                  <div class="show-seckill-img"><a href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['goods_image'];?>" alt="<?php echo $v['goods_name'];?>" width="200px" height="200px"></a></div>
                  <div class="show-seckill-word">
					   <?php if($v['end']=='1'){ ?>
							<span class="color4">该秒杀已结束</span>
					   <?php }elseif($v['end']=='2'){ ?>
							<span class="color3" id="leftTime<?php echo $v['miaosha_id'];?>">正在载入中...</span>
					   <?php }else{ ?>
						<span class="color4" id="leftTime<?php echo $v['miaosha_id'];?>">秒杀即将开始</span>
					   <?php } ?>
					   <script type="text/javascript">
							<?php if($v['end']=='2'){?>
							window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
							<?php }elseif($v['end']=='3'){ ?>
							window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
							<?php } ?>
						</script>
                       <h2><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></h2>
                       <p class="rmb1">￥<?php echo intval($v['miaosha_price']);?></p>
                       <p class="rmb2">参考价：<em><?php echo intval($v['goods_marketprice']);?></em>仅剩：<?php echo ($v['end']=='1')?'--':$v['shengyukucun'];?>件</p>
                  </div>
				  <?php if($v['end']=='1'){ ?>
					<a class="seckill-btn color4" href="<?php echo $v['goods_url'];?>" target="_blank">秒杀结束</a>
				  <?php }elseif($v['end']=='2'){ ?>
					<a class="seckill-btn color2" href="<?php echo $v['goods_url'];?>" target="_blank">立即秒杀</a>
				  <?php }else{ ?>
					 <a class="seckill-btn color1" href="<?php echo $v['goods_url'];?>" target="_blank">即将开始</a>
				  <?php } ?>
                  
              </li>
		   <?php } ?>
          </ul>
          <div class="time">
               <i class="icon-time1"></i>
               <h2>17点档秒杀</h2>
          </div>
          <ul class="show-seckill">
		  <?php foreach($output['miaosha_list']['17'] as $k=>$v){ ?>
              <li>
                  <div class="show-seckill-img"><a href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['goods_image'];?>" alt="<?php echo $v['goods_name'];?>" width="200px" height="200px"></a></div>
                  <div class="show-seckill-word">
                        <?php if($v['end']=='1'){ ?>
							<span class="color4">该秒杀已结束</span>
					   <?php }elseif($v['end']=='2'){ ?>
							<span class="color3" id="leftTime<?php echo $v['miaosha_id'];?>">正在载入中...</span>
					   <?php }else{ ?>
						<span class="color4" id="leftTime<?php echo $v['miaosha_id'];?>">秒杀即将开始</span>
					   <?php } ?>
					   <script type="text/javascript">
							<?php if($v['end']=='2'){?>
							window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
							<?php }elseif($v['end']=='3'){ ?>
							window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
							<?php } ?>
						</script>
                       <h2><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></h2>
                       <p class="rmb1">￥<?php echo intval($v['miaosha_price']);?></p>
                       <p class="rmb2">参考价：<em><?php echo intval($v['goods_marketprice']);?></em>仅剩：<?php echo ($v['end']=='1')?'--':$v['shengyukucun'];?>件</p>
                  </div>
                   <?php if($v['end']=='1'){ ?>
					<a class="seckill-btn color4" href="<?php echo $v['goods_url'];?>" target="_blank">秒杀结束</a>
				  <?php }elseif($v['end']=='2'){ ?>
					<a class="seckill-btn color2" href="<?php echo $v['goods_url'];?>" target="_blank">立即秒杀</a>
				  <?php }else{ ?>
					 <a class="seckill-btn color1" href="<?php echo $v['goods_url'];?>" target="_blank">即将开始</a>
				  <?php } ?>
              </li>
            <?php } ?>
          </ul>
     </div>
</div>

<div class="main part-two"></div>

<div class="main collection">
     <div class="wrap">
          <span class="four-text"></span>
          <p class="support">为回馈广大用户对收藏天下的支持，即日起至2015年12月31日，多款新热藏品特价开售</p>
          <h2>下单立减，最高减免10000元</h2>
          <div class="col-title">
               <i class="icon-down"></i>
               <h3>[<em>书画</em>]</h3>
          </div>
          <div class="product-show">
               <a class="pro1 mr20" href="http://www.96567.com/category-79-0-0-0-0-0-0-0-0.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/images/2.jpg" alt=""></a>
               <ul class="pro2">
			   <?php foreach ($output['shuhua_goods_list'] as $k=>$v){?>
                   <li <?php if($k == 0 || $k == 3){ ?>class="le-none"<?php } ?>>
                      <a class="pro-img" href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['image_url'];?>" alt="<?php echo $v['goods_name'];?>"></a>
                      <p><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></p>
                      <strong><em>￥</em><?php echo intval($v['xianshi_price']);?></strong>
                      <a class="pro-btn" href="<?php echo $v['goods_url'];?>" target="_blank">立即购买</a>
                   </li>
				<?php } ?>
               </ul>
          </div>
          <div class="col-title">
               <i class="icon-down"></i>
               <h3>[<em>文玩</em>]</h3>
          </div>
          <div class="product-show">
               <ul class="pro2 mr20">
                   <?php foreach ($output['qiabi_goods_list'] as $k=>$v){?>
                   <li <?php if($k == 0 || $k == 3){ ?>class="le-none"<?php } ?>>
                      <a class="pro-img" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($v['goods_image'], 240, $v['store_id']);?>" alt="<?php echo $v['goods_name'];?>"></a>
                      <p><a href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><?php echo $v['goods_name'];?></a></p>
                      <strong><em>￥</em><?php echo intval($v['goods_price']);?></strong>
                      <a class="pro-btn" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank">立即购买</a>
                   </li>
				  <?php } ?>
               </ul>
               <a class="pro1" href="http://www.96567.com/index.php?act=show_store&op=index&store_id=10" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/images/5.jpg" alt=""></a>
          </div>
          <div class="col-title">
               <i class="icon-down"></i>
               <h3>[<em>钱币</em>]</h3>
          </div>
          <div class="product-show">
               <a class="pro1 mr20" href="http://www.96567.com/category-1-0-0-0-0-0-0-0-0.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/images/6.jpg" alt=""></a>
               <ul class="pro2">
                   <?php foreach ($output['wenwan_goods_list'] as $k=>$v){?>
                   <li <?php if($k == 0 || $k == 3){ ?>class="le-none"<?php } ?>>
                      <a class="pro-img" href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['image_url'];?>" alt="<?php echo $v['goods_name'];?>"></a>
                      <p><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></p>
                      <strong><em>￥</em><?php echo intval($v['xianshi_price']);?></strong>
                      <a class="pro-btn" href="<?php echo $v['goods_url'];?>" target="_blank">立即购买</a>
                   </li>
				  <?php } ?>
               </ul>
          </div>
     </div>
</div>

<div class="main wave"></div>

<div class="main footer">
     <div class="wrap">
          <h2>你以为双12的惊喜仅限于此吗？</h2>
          <h3>No！现在再去分会场逛逛吧，还有<strong>更多惊喜</strong>哦~</h3>
          <div class="gogo">
               <div class="go go-left">
                    <a class="a" href="index.php?act=zhuanti&op=ad_20151212_2" target="_blank">
                       <h2>新人特别惠</h2>
                       <p>活动期间注册新会员送积分、送现金，一人仅此一次哦~</p>  
                       <a class="icon-angle" href="index.php?act=zhuanti&op=ad_20151212_2" target="_blank">GO</a>
                    </a>
               </div>
               <div class="go go-right">
                    <a class="a" href="index.php?act=zhuanti&op=ad_20151212_3" target="_blank">
                       <h2>满赠专场</h2>
                       <p>活动期间单笔订单满额就送免费大礼，快去看看呐~</p>  
                       <a class="icon-angle" href="index.php?act=zhuanti&op=ad_20151212_3" target="_blank">GO</a>
                    </a>
               </div>
          </div>
     </div>
</div>

<div class="navigation">  
     <a href="index.php?act=zhuanti&op=ad_20151212_2" target="_blank"></a>
     <a href="index.php?act=zhuanti&op=ad_20151212_3" target="_blank"></a>
</div>

<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-1/js/container.js"></script>
