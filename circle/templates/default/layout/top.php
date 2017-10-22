<?php defined('InShopNC') or exit('Access Invalid!');?>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="global-nav">
 <div class="global wrapper">
  <div class="glo-entry">
   <?php if($_SESSION['is_login'] == '1'){?>
      <?php echo $lang['nc_hello'];?><span><a href="<?php echo urlShop('member', 'home');?>"><?php echo str_cut($_SESSION['member_name'],20);?></a></span><?php echo $lang['nc_comma'],$lang['welcome_to_site'];?>
      <a href="http://www.96567.com"  title="<?php echo $lang['homepage'];?>" alt="<?php echo $lang['homepage'];?>"><span><?php echo $output['setting_config']['site_name']; ?></span></a>
      <span>[<a href="<?php echo urlShop('login','logout');?>"><?php echo $lang['nc_logout'];?></a>]</span>
    <?php }else{?>
      <?php echo $lang['nc_hello'].$lang['nc_comma'].$lang['welcome_to_site'];?>
      <a href="http://www.96567.com" title="<?php echo $lang['homepage'];?>" alt="<?php echo $lang['homepage'];?>"><?php echo $output['setting_config']['site_name']; ?></a>
       <span>[<a href="<?php echo urlShop('login');?>"><?php echo $lang['nc_login'];?></a>]</span>
        <span>[<a href="<?php echo urlShop('login','register');?>"><?php echo $lang['nc_register'];?></a>]</span>
    <?php }?>

  </div>
  <a class="glo-home" href="http://www.96567.com">收藏天下首页</a>
  <div class="glo-menu"> 
  <dl>
        <dt><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=show_joinin&op=index" title="免费开店">免费开店</a><i></i></dt>
        <dd>
          <ul>
		    <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=show_joinin&op=index" title="招商入驻">招商入驻</a></li>
            <li><a rel="nofollow" href="<?php echo urlShop('seller_login','show_login');?>" target="_blank" title="登录商家管理中心">商家登录</a></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order">我的订单</a><i></i></dt>
        <dd>
          <ul>
            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_new">待付款订单</a></li>
            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_send">待确认收货</a></li>
            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_order&state_type=state_noeval">待评价交易</a></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist"><?php echo $lang['nc_favorites'];?></a><i></i></dt>
        <dd>
          <ul>
            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist">商品收藏</a></li>
            <li><a rel="nofollow" href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fslist">店铺收藏</a></li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt>客户服务<i></i></dt>
        <dd>
          <ul>
            <li><a rel="nofollow" href="<?php echo urlShop('article', 'article', array('ac_id' => 2));?>">帮助中心</a></li>
            <li><a rel="nofollow" href="<?php echo urlShop('article', 'article', array('ac_id' => 5));?>">售后服务</a></li>
            <li><a rel="nofollow" href="<?php echo urlShop('article', 'article', array('ac_id' => 6));?>">客服中心</a></li>
          </ul>
        </dd>
      </dl>
      <?php
      if(!empty($output['nav_list']) && is_array($output['nav_list'])){
	      foreach($output['nav_list'] as $nav){
	      if($nav['nav_location']<1){
	      	$output['nav_list_top'][] = $nav;
	      }
	      }
      }
      if(!empty($output['nav_list_top']) && is_array($output['nav_list_top'])){
      	?>
      <dl>
        <dt>站点导航<i></i></dt>
        <dd>
          <ul>
            <?php foreach($output['nav_list_top'] as $nav){?>
            <li><a rel="nofollow"
        <?php
        if($nav['nav_new_open']) {
            echo ' target="_blank"';
        }
        echo ' href="';
        switch($nav['nav_type']) {
        	case '0':echo $nav['nav_url'];break;
        	case '1':echo urlShop('search', 'index', array('cate_id'=>$nav['item_id']));break;
        	case '2':echo urlShop('article', 'article', array('ac_id'=>$nav['item_id']));break;
        	case '3':echo urlShop('activity', 'index', array('activity_id'=>$nav['item_id']));break;
        }
        echo '"';
        ?>><?php echo $nav['nav_title'];?></a></li>
            <?php }?>
          </ul>
        </dd>
      </dl>
      <?php }?>
	  <dl class="wechat">
        <dt>关注我们<i></i></dt>
        <dd>
          <p>扫描二维码</p>
   			<p>关注商城微信号</p>
          <img src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.$GLOBALS['setting_config']['site_logowx']; ?>" > </dd>
        </dl>


	
  </div> 
 </div>
</div>

<script type="text/javascript">
$(function(){
	$(".quick-menu dl").hover(function() {
		$(this).addClass("hover");
	},
	function() {
		$(this).removeClass("hover");
	});

});
</script>
<div class="circle-header">
	<div class="wrapper">
		<div class="collection-logo">
		<a href="<?php echo CIRCLE_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_CIRCLE.'/'.C('circle_logo');?>"/></a>
		</div>
		<div class="search-panel mf110">
			<form id="form_search" method="get" action="<?php echo CIRCLE_SITE_URL;?>/index.php">
			<input type="hidden" name="act" value="search" />
			<div class="search-input-wrap">
				  <input id="keyword" name="keyword" type="text" class="input-search" value="<?php echo isset($_GET['keyword'])?$_GET['keyword']:'';?>" maxlength="60" x-webkit-speech="" lang="zh-CN" onwebkitspeechchange="foo()" x-webkit-grammar="builtin:search" />

				<input type="submit" id="" value="<?php echo $lang['nc_search_nbsp'];?>" class="input-submit">
			</div>			
			<div class="tool-select">
			
				<div class="only">

					<input type="radio" id="radio-2-1" name="op" checked="checked" value="theme" class="regular-radio big-radio" ischeck="true" <?php if($_GET['op']=='theme' || !isset($_GET['op'])){?>checked="checked"<?php }?>><label for="radio-2-1"></label>
					<i><?php echo $lang['search_theme'];?></i>
				</div>
				<div class="only">
				<input type="radio" id="radio-2-2" name="op" value="group" class="regular-radio big-radio" ischeck="true" <?php if($_GET['op']=='group'){?>checked="checked"<?php }?>><label for="radio-2-2"></label>
					<i><?php echo $lang['search_circle'];?></i>
				</div>  			
			</div>	
			</form>
		</div>
		<div class="my-navigation">
			<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=search&op=group" class="discover"><?php echo $lang['nc_find_fascinating'];?></a>
		
		
			<div class="hui-select">
			  <?php if($_SESSION['is_login']){?>
					<div class="head-portrait">
						<?php if ($output['super']) {?><i title="超级管理员"></i><?php }?>
						<img src="<?php  echo getMemberAvatarForID($_SESSION['member_id']);?>" />
					</div>
					<p><?php echo $lang['my_circle'];?></p>
				

				 <i class="icon-hui"></i>
				<div class="no-cercle my-group">
							<span class="hidden" nctype="span-mygroup">
          </span>
				</div>			

				 <?php }else{?>
				 <div class="head-portrait">
						<?php if ($output['super']) {?><i title="超级管理员"></i><?php }?>
						<img src="<?php  echo getMemberAvatarForID($_SESSION['member_id']);?>" />
					</div>
				 <a href="Javascript:void(0)" nctype="login"><?php echo $lang['nc_login'];?></a> | <a href="<?php echo SHOP_SITE_URL.'/';?>index.php?act=login&op=register"><?php echo $lang['nc_register'];?></a>
				
			<?php }?>
			</div>

		</div>	
	</div>
</div>