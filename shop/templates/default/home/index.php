<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home_index.js" charset="utf-8"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ie6.js" charset="utf-8"></script>
<![endif]-->
<script type="text/javascript">
var uid = window.location.href.split("#V3");
var  fragment = uid[1];
if(fragment){
	if (fragment.indexOf("V3") == 0) {document.cookie='uid=0';}
else {document.cookie='uid='+uid[1];}
	}

</script>
<style type="text/css">
.category { display: block !important; }
</style>
<div class="clear"></div>

<!-- HomeFocusLayout Begin-->
<div class="home-focus-layout"> <?php echo $output['web_html']['index_pic'];?>
  <div class="right-sidebar">
  <!--
    <div class="policy">
      <ul>
        <li class="b1">七天包退</li>
        <li class="b2">正品保障</li>
        <li class="b3">闪电发货</li>
      </ul>
    </div>
	-->

	<div class="policy">
      <h2 class="block">收藏快讯<a class="more" href="/article_cate-1-1.html" target="_blank">更多></a></h2>
	  <?php if(!empty($output['GongGao'])){?>
      <ul>
		<?php foreach($output['GongGao'] as $key=>$ggao){ ?>
        <li><a href="<?php if($ggao['article_url']!='')echo $ggao['article_url'];else echo urlShop('article', 'show', array('article_id'=>$ggao['article_id']));?>" target="_blank"><?php echo $ggao['article_title'];?></a></li>
		<?php }?>
      </ul>
	<?php }?>
    </div>

      <?php if(!empty($output['miaosha_list'])){?>
    <div class="seckill">
         <h2 class="block">今日秒杀</h2>
        <div id="banner_tabs" class="flexslider">
            <ul class="slides">
                <?php foreach($output['miaosha_list'] as $key=>$miaosha){ ?>
                    <li>
                        <div class="secImg">
						    <?php if($miaosha['is_shipping'] == 1){?>
							<!--<div class="icon-by"></div>-->
							<?php } ?>
                            <a href="miaosha/" target="_blank"><img src="<?php echo $miaosha['goods_image'];?>"></a>
                        </div>
                        <div class="sectext">
                            <a href="miaosha/" target="_blank"><?php echo $miaosha['goods_name'];?></a>
                        </div>
                        <p class="gobuy"><i>¥</i><?php echo $miaosha['miaosha_price'];?></p>
                        <a class="gobtn block" href="miaosha/" target="_blank">立即秒杀</a>
                    </li>
                <?php }?>
            </ul>
            <ul class="flex-direction-nav">
                <li><a class="flex-prev" href="javascript:;"></a></li>
                <li><a class="flex-next" href="javascript:;"></a></li>
            </ul>
        </div>
        <script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/slider.js"></script>
        <script type="text/javascript">
            $(function() {
                var bannerSlider = new Slider($('#banner_tabs'), {
                    time: 5000,
                    delay: 400,
                    event: 'hover',
                    auto: true,
                    mode: 'fade',
                    controller: $('#bannerCtrl'),
                    activeControllerCls: 'active'
                });
                $('#banner_tabs .flex-prev').click(function() {
                    bannerSlider.prev()
                });
                $('#banner_tabs .flex-next').click(function() {
                    bannerSlider.next()
                });
            })
        </script>
    </div>
      <?php } ?>
  </div>
</div>
<!--HomeFocusLayout End-->

<div class="home-sale-layout wrapper">
  <div class="left-layout"> <?php echo $output['web_html']['index_sale'];?> </div>
  <?php if(!empty($output['lepai_item']) && is_array($output['lepai_item'])) { ?>
  <div class="right-sidebar">
    <div class="title">
      <h3>拍卖惠</h3>
    </div>
    <div id="saleDiscount" class="sale-discount">
      <ul>
        <?php foreach($output['lepai_item'] as $val) { ?>
        <li>
          <dl>
            <dt class="goods-name"><?php echo $val['G_Name']; ?></dt>
            <dd class="goods-thumb"><a href="<?php echo urlLepai('index','auction',array('id'=> $val['G_Id']));?>" target="_blank"> <img src="<?php echo BASE_SITE_URL.$val['G_MainImg'];?>" width="130" height="130" alt="<?php echo $val['G_Name']; ?>"></a></dd>
            <dd class="goods-price">当前价：<?php echo $val['new_price']; ?></dd>
            <!--<dd class="goods-price-discount"><em><?php echo $val['xianshi_discount']; ?></em></dd>-->
            <dd class="time-remain" count_down="<?php echo $val['G_EndTime']-TIMESTAMP;?>"><i></i><em time_id="d">0</em><?php echo $lang['text_tian'];?><em time_id="h">0</em><?php echo $lang['text_hour'];?> <em time_id="m">0</em><?php echo $lang['text_minute'];?><em time_id="s">0</em><?php echo $lang['text_second'];?> </dd>
            <dd class="goods-buy-btn"></dd>
          </dl>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php } ?>
</div>
<!--值得参与开始-->
<?php echo $output['web_html']['index_cany'];?>
<!--值得参与结束-->

<!-- 首页顶部1楼上方广告 -->
<div class="wrapper">
    <div class="mt20"><?php echo loadadv(1051);?></div>
</div>
<!--StandardLayout Begin--> 
<?php echo $output['web_html']['index'];?> 
<!--StandardLayout End-->

<!-- 首页中部收藏社区上方广告 -->
<div class="wrapper">
  <div class="mt20"><?php echo loadadv(1052);?></div>
</div>


<div class="homebbs-box wrapper">
    <div class="homebbs-title">收藏社区</div>
    <div class="homebbs-main">
         <div class="everyone">
              <div class="homebbs-headline headline1 mb20">大家说</div>







<div class="main_i_lb1">

  <div class="main_i_lb1a slider2">
<?php
if(!empty($output['shoucang'])){
?>
<?php foreach($output['shoucang'] as $k => $v){?>

<div class="slide">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
          <td class="home-tdimg">
              <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">
                  <img src="<?php echo cthumb($v['goods_image']);?>">
              </a>
          </td>
          <td class="home-tdtext">
              <div class="a1">
                  <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank" title="<?php echo $v['goods_name'];?>"><?php echo $v['goods_name'];?>
                  </a>
              </div>
              <div class="a2">收藏价：<span>￥<?php if($v['goods_price'] < 1){echo '咨询客服';}else{echo $v['goods_price'];}?></span></div>
              <div class="a3">藏友关注度：<span><?php echo $v['goods_click'];?></span></div>
              <div class="a4">
                   <p>评价星级：</p>
                   <span>
                       <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xing_x.png">
                       <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xing_x.png">
                       <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xing_x.png">
                       <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xing_x.png">
                       <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xing_x.png">
                   </span>
              </div>
          </td>
      </tr>
      </tbody>
  </table>
  <div class="gd_pj">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>

<?php foreach($v['G_Ping'] as $kk=>$vv){?>
          <tr>
              <td><p><?php echo $vv['geval_content'];?></p></td>
          </tr>
<?php }?>

          <tr>
              <td>
                  <a class="view-all" href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" target="_blank">[查看全部评价]</a>
              </td>
          </tr>
          </tbody>
       </table>
  </div>
</div>

<?php 
	}
}
?>





  </div>
  <script src="http://www.96567.com/shop/resource/js/jquery.bxslider.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        $('.slider2').bxSlider({
          slideWidth: 300, 
          auto: true,
          autoControls: false,
          minSlides: 2,
          maxSlides: 2,
          slideMargin: 10

        });
      });
  </script>
</div>










        </div>
        <div class="college">
            <div class="homebbs-headline headline2 mb20">收藏资讯</div>
            <div class="investment_f">
                <ul class="investment_title">
                    <li class="on">行情资讯</li>
                    <li>热点关注</li>
                    <li>藏品知识</li>
                </ul>
                <div class="investment_con">
                    <div class="investment_con_list">
                        <ul>
                            <?php if(!empty($output['hqkx'])){?>
                                <?php foreach ($output['hqkx'] as $k=>$v){?>
                                    <?php if($k==0){?>
                                        <li>
                                            <h1><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></h1>
                                            <span><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo html_substr_word($v['article_content'],50).'...';?></a></span>
                                        </li>
                                    <?php }else{?>
                                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="investment_con_list">
                        <ul>
                            <?php if(!empty($output['rdgz'])){?>
                                <?php foreach ($output['rdgz'] as $k=>$v){?>
                                    <?php if($k==0){?>
                                        <li>
                                            <h1><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></h1>
                                            <span><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo html_substr_word($v['article_content'],50).'...';?></a></span>
                                        </li>
                                    <?php }else{?>
                                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="investment_con_list">
                        <ul>
                            <?php if(!empty($output['mrbj'])){?>
                                <?php foreach ($output['mrbj'] as $k=>$v){?>
                                    <?php if($k==0){?>
                                        <li>
                                            <h1><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></h1>
                                            <span><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo html_substr_word($v['article_content'],50).'...';?></a></span>
                                        </li>
                                    <?php }else{?>
                                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                    <?php }?>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="aboutus">
            <div class="homebbs-headline headline2 mb20">关于我们</div>
            <div class="about-us">
                <img src="/shop/templates/default/images/WeChat.jpg" alt="">
                <h4>扫描关注收藏天下</h4>
                <a href="http://weibo.com/socang567" target="_blank">
                    <img src="/shop/templates/default/images/sina.jpg" alt="">
                    <p>新浪</p>
                </a>
                <a href="http://t.qq.com/soucangtianxia88" target="_blank">
                    <img src="/shop/templates/default/images/tx.jpg" alt="">
                    <p>腾讯</p>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        /*tab标签切换*/
        function tabs(tabTit,on,tabCon){
            $(tabCon).each(function(){
                $(this).children().eq(0).show();

            });
            $(tabTit).each(function(){
                $(this).children().eq(0).addClass(on);
            });
            $(tabTit).children().hover(function(){
                $(this).addClass(on).siblings().removeClass(on);
                var index = $(tabTit).children().index(this);
                $(tabCon).children().eq(index).show().siblings().hide();
            });
        }
        tabs(".investment_title","on",".investment_con");

    })
</script>

<!--link Begin-->
<!--<div class="full_module wrapper">
  <h2><b><?php echo $lang['index_index_link'];?></b></h2>
  <div class="piclink">
    <?php if(is_array($output['$link_list']) && !empty($output['$link_list'])) {
		  	foreach($output['$link_list'] as $val) {
		  		if($val['link_pic'] != ''){
		  ?>
    <span><a href="<?php echo $val['link_url']; ?>" target="_blank"><img src="<?php echo $val['link_pic']; ?>" title="<?php echo $val['link_title']; ?>" alt="<?php echo $val['link_title']; ?>" width="88" height="31" ></a></span>
    <?php
		  		}
		 	}
		 }
		 ?>
    <div class="clear"></div>
  </div>
  <div class="textlink">
    <?php 
		  if(is_array($output['$link_list']) && !empty($output['$link_list'])) {
		  	foreach($output['$link_list'] as $val) {
		  		if($val['link_pic'] == ''){
		  ?>
    <span><a href="<?php echo $val['link_url']; ?>" target="_blank" title="<?php echo $val['link_title']; ?>"><?php echo str_cut($val['link_title'],16);?></a></span>
    <?php
		  		}
		 	}
		 }
		 ?>
    <div class="clear"></div>
  </div>
</div>-->
<!--link end-->
<div class="footer-line"></div>
<!--首页底部保障开始-->
<?php require_once template('layout/index_ensure');?>
<!--首页底部保障结束-->
<!--StandardLayout Begin-->
<div class="nav_Sidebar">
<a class="nav_Sidebar_1" href="javascript:;" ></a>
<a class="nav_Sidebar_2" href="javascript:;" ></a>
<a class="nav_Sidebar_3" href="javascript:;" ></a>
<a class="nav_Sidebar_4" href="javascript:;" ></a>
<a class="nav_Sidebar_5" href="javascript:;" ></a>
<a class="nav_Sidebar_6" href="javascript:;" ></a> 
<a class="nav_Sidebar_7" href="javascript:;" ></a>
<a class="nav_Sidebar_8" href="javascript:;" ></a>
</div>
<!--StandardLayout End-->