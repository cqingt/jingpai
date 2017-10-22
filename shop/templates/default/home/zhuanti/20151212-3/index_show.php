<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/css/features.css">
<div class="main banner">
     <div class="banner-top"></div>
     <div class="banner-main"></div>
</div>

<div class="main fea-title">
     <div class="wrap">
          <p>双11好多优惠没抢到！别担心，双12优惠更多，惊喜重重</p>
          <p>为回馈广大会员的支持，收藏天下特为您准备重磅大礼</p>
          <h2>超低门槛  下单有礼啦</h2>
     </div>
</div>

<div class="main ladder">
     <div class="wrap">
          <ul>
             <li>
                <h1 class="location-top"><i>01</i></h1>
                <a href="http://www.96567.com/goods-10733.html" target="_blank" class="lad-img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/images/1.jpg" alt=""></a>
                <div class="lad-text">
                     <h2><a href="http://www.96567.com/goods-10733.html" target="_blank">抗战胜利70周年普通纪念币</a></h2>
                     <p><a href="http://www.96567.com/goods-10733.html" target="_blank">为纪念70年前中华民族先辈们为抗日战争胜利做出的伟大牺牲，教导后辈铭记历史、缅怀先烈、珍视和平，中国人民银行发行中国人民抗日战争暨世界反法西斯战争胜利70周年纪念币一套。</a></p>
                     <div class="free-box">
                          <h3>免费送1枚</h3>
                          <p>单笔订单满180元</p>
                     </div>
                </div>
             </li>

             <li>
                <h1 class="location-top"><i>02</i></h1>
                <a href="http://www.96567.com/goods-3918.html" target="_blank" class="lad-img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/images/2.jpg" alt=""></a>
                <div class="lad-text">
                     <h2><a href="http://www.96567.com/goods-3918.html" target="_blank">吉庆佳节元宵钞单枚</a></h2>
                     <p><a href="http://www.96567.com/goods-3918.html" target="_blank">我国首枚吉庆佳节元宵纪念钞，由香港上海汇丰银行限量发行，以“元宵节猜灯谜”为主题，面值50元可流通。纪念钞画面处处洋溢着浓浓的节日气氛，喜庆合乐，人文气息浓厚，是不可多得的收藏佳品。</a></p>
                     <div class="free-box">
                          <h3>免费送1枚</h3>
                          <p>单笔订单满980元</p>
                     </div>
                </div>
             </li>

             <li>
                <h1 class="location-top"><i>03</i></h1>
                <a href="http://www.96567.com/goods-8325.html" target="_blank" class="lad-img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/images/3.jpg" alt=""></a>
                <div class="lad-text">
                     <h2><a href="http://www.96567.com/goods-8325.html" target="_blank">第三轮生肖单枚大全邮折</a></h2>
                     <p><a href="http://www.96567.com/goods-8325.html" target="_blank">自1980年第一枚生肖猴票开始，中国邮政已完成发行三轮完整生肖邮票，每一轮都受到市场的热捧。这本邮折收录了工艺最精美，技艺最先进的第三轮生肖全套，是真正的升值潜力股。
                        </a>
                     </p>
                     <div class="free-box">
                          <h3>免费送1套</h3>
                          <p>单笔订单满1980元</p>
                     </div>
                </div>
             </li>

             <li>
                <h1 class="location-top"><i>04</i></h1>
                <a href="http://www.96567.com/goods-4000.html" target="_blank" class="lad-img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/images/4.jpg" alt=""></a>
                <div class="lad-text">
                     <h2><a href="http://www.96567.com/goods-4000.html" target="_blank">《东方巨人— —毛泽东 》</a></h2>
                     <p><a href="http://www.96567.com/goods-4000.html" target="_blank">这套大全套是迄今为止内容最全、数量最多、构思最奇的毛泽东诗词邮票大系列。是一部传世千秋的诗词书法恢弘巨献，一次伟人思想在邮票上的大汇集，数量之丰富，震撼人心。单笔订单满4980元，免费送1套。
                        </a>
                     </p>
                     <div class="free-box">
                          <h3>免费送1套</h3>
                          <p>单笔订单满4980元</p>
                     </div>
                </div>
             </li>
          </ul>
     </div>
</div>
 

<div class="main yellow">
     <div class="wrap">
          <div class="attention">
               <h2>注意事项：</h2>
               <p>1、本场满赠活动考量金额为订单所购原价藏品总金额为标准，有购买立减单品的订单需扣除减免藏品金额进行评档；</p>
               <p>2、会员下单，礼品自动添加无需重复操作；</p>
               <p>3、如享有赠品的订单产生退货行为，需将赠品一同退回，否则退款将扣除礼品费用；</p>
               <p>4、赠品数量有限，赠完即止；</p>
               <p>5、本活动最终解释权归收藏天下所有。</p>
          </div>
          <ul class="product-show">
              <?php foreach($output['goods_list'] as $k=>$v){ ?>
              <li>
                  <a class="show1" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><img src="<?php echo cthumb($v['goods_image'], 240, $v['store_id']);?>" alt="<?php echo $v['goods_name'];?>"></a>
                  <a class="show2" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank"><?php echo $v['goods_name'];?></a>
                  <p><em>¥</em><?php echo $v['goods_price'];?></p>
                  <a class="go-btn" href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" target="_blank">立即购买</a>
              </li>
			<?php } ?>
          </ul>
          <a class="more-btn" href="http://www.96567.com/" target="_blank">更多藏品>></a>
          <p class="p1">我们是您互联网上最贴心的收藏顾问</p>
          <a class="more-btn2" href="http://www.96567.com/" target="_blank">访问更多发现更多</a>
     </div>
</div>

<div class="navigation">  
     <a href="index.php?act=zhuanti&op=ad_20151212_1" target="_blank"></a>
     <a href="index.php?act=zhuanti&op=ad_20151212_2" target="_blank"></a>
</div>

<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151212-3/js/container.js"></script>
