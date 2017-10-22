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
<div class="rule">
  <h1>优惠购买规则</h1>
  <p>1、好友通过分享邀请可直接以最低折扣价购买该商品</p>
  <p>2、通过商品分享按钮将商品分享给好友，好友下单购买后，即可以最低折扣价购买该商品</p>
</div>

<div class="cash-list">
<?php if(!empty($output['result_list'])){ ?>
 <ul>
 <?php foreach($output['result_list'] as $k=>$v){?>
	<li>
	
	  <div class="cashimg">
	  <?php if(intval($v['number']-$v['buy_quantity']) <= 0) {
				?>
				<div class="icon-sold"></div>
				<?php
				}
				?>
		<a href="http://m.96567.com/index.php?act=goods&goods_id=<?php echo $v['goods_id'];?>"><img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>"></a>
	  </div>
	  <div class="cashword">
		<h2><a style="color: #666;" href="http://m.96567.com/index.php?act=goods&goods_id=<?php echo $v['goods_id'];?>"><?php echo $v['goods_name'];?></a></h2>
		<p class="p1">价格：<em>¥<?php echo $v['goods_price'];?></em></p>
		<p class="p3">折后价：¥<?php echo $v['price'];?></p>
	  </div>
	  <div class="btn-box">
		<?php if(intval($v['number']-$v['buy_quantity']) <= 0) {?>
			<a href="javascript:(0);" style='background: #bfbfbf;'>立即分享</a>
		<?php
			}else{
		?>
			<a href="javascript:(0);" style='background: #6fb44a;' onclick="on_btnone(<?php echo $k;?>);">立即分享</a>
		<?php } ?>

		<?php if(Model('pushuser_gift')->getYouHuiByGoodsID($v['goods_id'])){?>
			<a href="http://m.96567.com/index.php?act=goods&goods_id=<?php echo $v['goods_id'];?>">下单购买</a>
		<?php }else{?>
			<a href="javascript:(0);" style="background: #bfbfbf;">下单购买</a>
		<?php } ?>
		
	  </div>
	   <div class="shot">
<div class="popup" id="popup<?php echo $k;?>">
 <h2>
	<i class="fa fa-star"></i><i class="fa fa-star"></i>
	分享方式
	<i class="fa fa-star"></i><i class="fa fa-star"></i>
 </h2>
<textarea name="" id="" cols="30" rows="5" class="copytext"  id="biao<?php echo $k;?>" >
http://m.96567.com/index.php?act=goods&op=cangdou_fenxiang&goods_id=<?php echo $v['goods_id'];?>&zmr=<?php echo $_SESSION['member_id']; ?>精美产品，最低五折，享不完的折扣，快来参与吧！
</textarea>
<p>请复制上面链接到朋友那...</p>
<p>(点击上方链接，长按2-3秒，点击全选然后复制/拷贝)</p>
 <a class="btn btn-close" href="javascript:;" onclick="btn_close(<?php echo $k;?>);">x</a>
</div>
<a class="btn-tier" id="btn_tier<?php echo $k;?>" href="javascript:;" onclick="btn_close(<?php echo $k;?>);"></a>
</div>
	</li>
	<?php } ?>
 </ul>


 <?php }?>
 <!--
 <a class="functional-box" href=""><i class="fa fa-spinner fa-spin"></i>正在载入</a>
 -->
</div>
</section>

<script>
function on_btnone(k){
	$("#popup"+k+",#btn_tier"+k).show(); 
}

function btn_close(k){
	$("#popup"+k+",#btn_tier"+k).hide();
}

function copyUrl2(k) {
    var Url2=document.getElementById("biao"+k);
    Url2.select();  
    document.execCommand("Copy");  
    alert("已复制好，可贴粘。");
}
</script>