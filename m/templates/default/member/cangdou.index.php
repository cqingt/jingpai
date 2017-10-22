<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/has.css" />
<ul class="voucher-tab">
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'index'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','index');?>">邀请好友</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_log'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_log');?>">藏豆明细</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_exchange'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_exchange');?>">藏豆兑换</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_tuijian'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_tuijian');?>">优惠购买</a> </li>
</ul>

<section>
		 <div class="invite">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/invite.jpg" alt="">
			<?php if(intval($output['member_info']['cangdou']) > 0 || intval($output['CountMember']) > 0){ ?>
			<p>当前可用藏豆：<?php echo $output['member_info']['cangdou']; ?></p>
			<p>邀请好友数量：<?php echo $output['CountMember']; ?></p>
			<?php } ?>
		 </div>
		 <div class="invite-content">
			<?php if(intval($output['member_info']['cangdou']) == 0 && intval($output['CountMember']) == 0){ ?>
			<h4>您还没有邀请到好友哟~</h4>
			<?php } ?>
			<a class="btn-rom btnone" href="javascript:void(0)">立即邀请</a>
			<h1><i class="fa fa-caret-right"></i>藏豆奖励规则</h1>
			<p>1、推荐者每推荐一位新会员注册，获得5藏豆，藏豆可以兑换实物奖品或现金券；</p>
			<p>2、被推荐者每次消费后，推荐者可获得消费总金额（不含快递、代收等费用）<em>千分之五</em>的藏豆做为购物奖励。</p>
			<h1><i class="fa fa-caret-right"></i>具体规则</h1>
			<p>1、会员A推荐一位新会员B注册并绑定手机后，会员A获得5藏豆；</p>
			<p>2、会员B推荐一位新会员C注册并绑定手机后，会员B获得5藏豆，会员A获得2藏豆；</p>
			<p>3、被推荐者C购物完成后，推荐人B可获得订单商品实际支付总金额（不含运费、优惠券、满减、手续费）的5‰的藏豆，推荐人A可获得3‰的藏豆；</p>
			<p>4、三级会员推荐机制：</p>
			<p>A、一级会员推荐二级会员，获得5藏豆；二级会员推荐三级会员，一级会员获得2藏豆，二级获得5藏豆。</p>
		 </div>
		 <div class="shot">
			<div class="popup">
			 <h2>
				<i class="fa fa-star"></i><i class="fa fa-star"></i>
				分享方式
				<i class="fa fa-star"></i><i class="fa fa-star"></i>
			 </h2>
			 <textarea name="" id="" cols="30" rows="5" class="copytext">
                http://m.96567.com/index.php?act=zhuanti&op=ad_20160314&ua=cangdou&zmr=<?php echo $_SESSION['member_id']; ?>您的好友推荐您注册收藏天下网，注册免费送抗战币，推荐注册送藏豆，藏豆免费兑礼品！
			 </textarea>	
			 <p>请复制上面链接到朋友那...</p>
			 <p>(点击上方链接，长按2-3秒，点击全选然后复制/拷贝)</p>
			 <a class="btn btn-close" href="javascript:void(0)">X</a>
			</div>
			<a class="btn-tier" href="javascript:void(0)"></a>
		 </div>
	  </section>
<script>
	  
$(".btnone").bind("click", function(event) { 
   $(".popup,.btn-tier").show(); 
});

$(".btn-tier,.btn-close").bind("click", function(event) { 
    $(".popup,.btn-tier").hide();
});

function copyUrl2() {
    var Url2=document.getElementById("biao1");
    Url2.select();  
    document.execCommand("Copy");  
    alert("已复制好，可贴粘。");
}
</script>