

<?php defined('InShopNC') or exit('Access Invalid!');?>



<?php //echo getChat($layout);?>


<!--首页底部保障开始-->
<?php require_once template('layout/index_ensure');?>
<!--首页底部保障结束-->
<div id="faq">
  <div class="faq-wrapper">
    <?php if(is_array($output['article_list']) && !empty($output['article_list'][0]['list'])){ ?><ul>
    <?php foreach ($output['article_list'] as $k=> $article_class){ ?>
    <?php if(!empty($article_class)){ ?>
   <li> <dl class="s<?php echo ''.$k+1;?>">
      <dt>
        <?php if(is_array($article_class['class'])) echo $article_class['class']['ac_name'];?>
      </dt>
      <?php if(is_array($article_class['list']) && !empty($article_class['list'])){ ?>
      <?php foreach ($article_class['list'] as $article){ ?>
      <dd><i></i><a href="<?php if($article['article_url'] != '')echo $article['article_url'];else echo urlShop('article', 'show',array('article_id'=> $article['article_id']));?>" title="<?php echo $article['article_title']; ?>"> <?php echo $article['article_title'];?> </a></dd>
      <?php }?>
      <?php }?>
    </dl></li>
    <?php }?>
    <?php }?>	    	
	</ul>	
<div class="help">
		<div class="w1190 clearfix">
    		<div class="contact f-l">
    			<div class="contact-border clearfix">
              <p>全国统一免费热线</p>
        			<span class="ic tel t20">
					<?php if($output['YiShu']){ //检查是否是艺术家官网页面 ?>
					400-08-96567
					<?php }else{ ?>
					<?php echo $GLOBALS['setting_config']['site_tel400']; ?>
					<?php } ?>
					</span>
    			</div>
    		</div>
		</div>
	</div>			
    <?php }?>
  </div>
</div>
<!--友情链接 begin-->
<?php if(is_array($output['$link_list']) && !empty($output['$link_list']) && $output['index_sign'] == 'index') { ?>
<div class="blogroll">
     <div class="wrapper">
          <h2><?php echo $lang['index_index_link'];?></h2>
          <div class="blo-box">
             <?php foreach($output['$link_list'] as $val) { ?>
               <span><a href="<?php echo $val['link_url']; ?>" target="_blank"><?php echo $val['link_title']; ?></a></span>
             <?php } ?>
          </div>
     </div>
</div>
<?php } ?>
<!--友情链接 end-->
<div id="footer" class="wrapper">
  <p><a href="<?php echo SHOP_SITE_URL;?>"><?php echo $lang['nc_index'];?></a>
    <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
    <?php foreach($output['nav_list'] as $nav){?>
    <?php if($nav['nav_location'] == '2'){?>
    | <a  <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php switch($nav['nav_type']){
    	case '0':echo $nav['nav_url'];break;
    	case '1':echo urlShop('search', 'index', array('cate_id'=>$nav['item_id']));break;
    	case '2':echo urlShop('article', 'article',array('ac_id'=>$nav['item_id']));break;
    	case '3':echo urlShop('activity', 'index',array('activity_id'=>$nav['item_id']));break;
    }?>"><?php echo $nav['nav_title'];?></a>
    <?php }?>
    <?php }?>
    <?php }?>
  </p>
  <?php echo $output['setting_config']['shopnc_version'];?> <?php echo $output['setting_config']['icp_number']; ?><br />北京市朝阳区十里河文化园A座三层 收藏天下<br />
  <?php echo html_entity_decode($output['setting_config']['statistics_code'],ENT_QUOTES); ?> 
  <div class="footerbox mt10">
            <a rel="nofollow"  href="http://www.96567.com/tzxy/templates/default/images/icpz.jpg" target="_blank"><img src="http://www.96567.com/tzxy/templates/default/images/footer1.jpg" alt=""></a>
            <a rel="nofollow" target="_blank"><script src="http://kxlogo.knet.cn/seallogo.dll?sn=e16101311010564863hxnr000000&size=0"></script></a>
            <a rel="nofollow" href="http://about.58.com/fqz/index.html" target="_blank"><img src="http://www.96567.com/tzxy/templates/default/images/footer3.jpg" alt=""></a>
           <a logo_size="124x47" logo_type="realname" href="http://www.anquan.org" ><script src="http://static.anquan.org/static/outer/js/aq_auth.js"></script></a>
  </div>

</div>
<?php if (C('debug') == 1){?>
  <!-- footerbox -->

<div id="think_page_trace" class="trace">
  <fieldset id="querybox">
    <legend><?php echo $lang['nc_debug_trace_title'];?></legend>
    <div> <?php print_r(Tpl::showTrace());?> </div>
  </fieldset>
</div>
<?php }?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.cookie.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<!-- 对比 -->
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/compare.js"></script>
<script type="text/javascript">
$(function(){
	// Membership card
	$('[nctype="mcard"]').membershipCard({type:'shop'});
});
</script>
<!--百度电商订单监控代码 -->
<script language="javascript" type="text/javascript">
<?php if($output["buy_step"] == 'step4'){?>


  <?php foreach($output['order_list'] as $order_info) {?>

    var orderInfo = {
        "orderId": "<?php echo $order_info['order_sn']; ?>",
        "orderTotal": <?php echo $order_info['order_amount']; ?>,
        "item": []
    };

    <?php 
      foreach($order_info['extend_order_goods'] as $gk=>$goods){
    $goods_class = Model('goods_class')->getGoodsClassLineForTag($goods['gc_id']);
   ?>
    orderInfo.item.push({
        "skuId": "<?php echo $goods['goods_id']; ?>",
        "skuName": "<?php echo $goods['goods_name']; ?>",
        "category": "<?php echo $goods_class['gc_tag_name']?>",
        "Price": <?php echo $goods['goods_price']; ?>,
        "Quantity": <?php echo $goods['goods_num']; ?>
    });
    <?php } ?>
    _hmt.push(['_trackOrder', orderInfo]);
  <?php } ?>
<?php } ?>
</script>
<!--百度电商订单监控代码 end -->

<?php if($_SESSION['is_login'] == '1'  && !$_COOKIE['is_one_login']){
  $model = Model('member');
  $userinfo = $model->getMemberInfoByID($_SESSION['member_id']);
/*2015-11-26 Add is name lt 首次登陆记录cookie*/
  $endtiem = strtotime(date('Y-m-d').' 23:59:59')-time();//当天结束还剩多少秒
  if(!$_COOKIE['is_one_login']){
    setcookie('is_one_login',$_SESSION['member_id'],time()+$endtiem,'/');
  }
  /*End*/
?>


<a href="#" class="big-link-index" data-reveal-id="myModalindex" data-animation="fade">点我弹出</a>
<div id="myModalindex" class="reveal-modal">

          <!-- 样式一 Start -->
          <!-- <div id="style1">
              <div class="dialog-wechat">
                   <img src="dialog-wechat.jpg" alt="微信">
                   <p><strong>扫码关注，立送￥105</strong></p>
              </div>
              <div class="dialog-welcome">
                   <p class="mb20">欢迎您成为收藏天下的一员，您的账户尚未完成安全验证，现在就去验证<strong>手机、邮箱</strong>吧！完成还有奖励拿！！！ </p>
                   <a class="btn-left mr70" href="javascript:;">去验证</a>
                   <a class="close-reveal-modal btn-right" href="javascript:;">先逛逛</a>
              </div>
          </div> -->
          <!-- 样式一 End-->

          <!-- 样式二 Start -->
          <!-- <div id="style2">
              <div class="dialog-wechat">
                   <img src="dialog-wechat.jpg" alt="微信">
                   <p><strong>扫码关注，立送￥105</strong></p>
              </div>
              <div class="dialog-welcome">
                   <p>欢迎您成为收藏天下的一员，您尚未关注官方微信，扫描左侧二维码有惊喜哦~ </p>
                   <p><em>时间不多，勿失良机！</em></p>
                   <a class="close-reveal-modal btn-right mtl8-2" href="javascript:;">先逛逛</a>
              </div>
          </div> -->
          <!-- 样式二 End-->

          <!-- 样式三 Start -->
          <div id="style3">
              <h1>欢迎您成为收藏天下的一员，您的账户尚未完成安全验证，现在就去验证<strong><?php if($userinfo['member_mobile_bind'] != '1'){echo "  手机  ";}if($userinfo['member_email_bind'] != '1'){echo "  邮箱  ";}if($userinfo['is_open'] != '1'){echo "  微信  ";}?></strong>吧！完成还有奖励拿！！！</h1>
              <div class="dialog-btn">
                  <a class="btn-left" href="http://www.96567.com/index.php?act=member_security&op=index#password">去验证</a>
                  <a class="close-reveal-modal btn-right" href="javascript:;">先逛逛</a>
              </div>
          </div>
          <!-- 样式三 End-->


    <a class="close-reveal-modal close-style"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/xxx.png" alt="" /></a>
</div>


<?php if($userinfo['member_email_bind'] != '1' || $userinfo['member_mobile_bind'] != '1' || $userinfo['is_open'] != '1'){?>

<script>

  $(function(){
    $(".big-link-index").click();
  })

</script>


<?php }?>



<?php }?>


<!--站点统计代码-->
<script type="text/javascript">

<?php if($_GET['act'] == 'goods'){ ?>
	_ozprm="id=<?php echo $output['goods']['goods_id']; ?>&cid=<?php echo $output['goods']['gc_id']; ?>&bid=<?php echo $output['goods']['brand_id']; ?>";
<?php } ?>

<?php if($_GET['act'] == 'search' && $_GET['keyword']){ ?>
	_ozprm="keyword=<?php echo $_GET['keyword']; ?>";
<?php } ?>

try{
	var _ozuid;
	var _user='<?php echo $_SESSION['member_name'];?>';//需传值，用户登陆后的用户id，如果没有登录传空值，即_user=’’;
	var _domain=document.domain.match(/\.[a-zA-Z0-9.-]+/);
	if($.cookie("ozuid") &&(_user==''|| null==_user)){  //cookie有值，但是用户尚未登录 ;那么取cookie值
		_ozuid=$.cookie("ozuid");
	}else if($.cookie("ozuid") &&(null!= _user)){ //cookie有值，但是用户已登录 ;那么更新cookie值，再取cookie值
		$.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain});
		_ozuid=$.cookie("ozuid");
	}else if(!$.cookie("ozuid") &&(_user==''|| null==_user)){//cookie无值，用户也未登录，不能记录会员行为
	    //无动作
	}else if(!$.cookie("ozuid") &&(null!= _user)){
		$.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain}); //cookie无值，但是用户已登录 ;那么存储cookie值，再取cookie值
		_ozuid=$.cookie("ozuid");
	}
}catch(e){
}

</script>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/o_code.js"></script>

<script>
<?php if($_GET['act'] == 'search' && $_GET['keyword'] == ''){ ?>
	var tprm="cate_id=<?php echo $_GET['cate_id'];?>&b_id=<?php echo $_GET['b_id'];?>&a_id=<?php echo $_GET['a_id'];?>&key=<?php echo $_GET['key'];?>&order=<?php echo $_GET['order'];?>&type=<?php echo $_GET['type'];?>&gift=<?php echo $_GET['gift'];?>&area_id=<?php echo $_GET['area_id'];?>&curpage=<?php echo $_GET['curpage'];?>";
  __ozfac2(tprm,"#categoryPage");
  setTimeout("",300);  
<?php } ?>
<?php if($output["buy_step"] == 'step3' || $output['buy_step'] == 'step4'){ ?>
	<?php if (count($output['order_list'])>0) { 
		foreach($output['order_list'] as $key => $order) { 
			if($order['extend_order_goods']){
				foreach($order['extend_order_goods'] as $ogkey=>$ogval){
				?>
				var skulist = '';
				skulist += "<?php echo $ogval['goods_id'];?>,<?php echo $ogval['goods_price'];?>,<?php echo $ogval['goods_num'];?>,,,,,,,;";
			<?php
			}
			}
		?>
		var tprm="orderid=<?php echo $order['order_sn'];?>&ordertotal=<?php echo $order['order_amount'];?>&storeid=<?php echo $order['store_id'];?>&skulist="+skulist;
		__ozfac2(tprm,"#orderPage");
		setTimeout("",300);  
	<?php
		}
	 }
	?>
<?php } ?>
</script>