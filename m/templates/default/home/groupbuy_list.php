<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<style>
.leftTime strong {
	font-weight: bold;
}
</style>
<?php if (!empty($output['groupbuy_list']) && is_array($output['groupbuy_list'])) { ?>
<?php foreach ($output['groupbuy_list'] as $k=>$groupbuy) { ?>

<div class="list_tuangou">
	 <div class="list_tuangou_bt">
		  <a title="<?php echo $groupbuy['groupbuy_name'];?>" href="<?php echo urlWap('goods','index',array('goods_id'=>$groupbuy['goods_id']));?>"><?php echo $groupbuy['groupbuy_name'];?></a>
	 </div>
	 <div class="list_tuangou2">
		 <div class="list_tuangou2_img gou2-img">
			 <a title="<?php echo $groupbuy['groupbuy_name'];?>" href="<?php echo urlWap('goods','index',array('goods_id'=>$groupbuy['goods_id']));?>">
			    <img src="<?php echo cthumb($groupbuy['groupbuy_image1'],'360');?>">
			 </a>
		 </div>
		 <?php list($integer_part, $decimal_part) = explode('.', $groupbuy['groupbuy_price']);?>
		 <div class="list_tuangou22">
		      <div class="lin_hg">藏品惠价：
		      	   <span class="a1"><a href="<?php echo urlWap('goods','index',array('goods_id'=>$groupbuy['goods_id']));?>" style="color:#C00;">￥<?php echo $integer_part;?>.<?php echo $decimal_part;?></a></span>
		      </div>
		      <div class="lin_hg">商城价：<span class="a2">￥<?php echo $lang['currency'].$groupbuy['goods_price'];?></span></div>
			  <div class="leftTime"  count_down="<?php echo $groupbuy['count_down'];?>">
			 	 正在载入中...
			  </div>

			  

		      <div class="lin_hg">
		 	  <span class="a4"><a href="<?php echo urlWap('goods','index',array('goods_id'=>$groupbuy['goods_id']));?>"  class="input">立即抢</a></span>
		 	  <span class="a5">已团<span><?php echo $groupbuy['buy_quantity']+$groupbuy['virtual_quantity'];?></span>件</span>
		      </div>
		 </div>
	 </div>
</div>

<?php } ?>
<script>
function lepaiclockdone(){
	setTimeout("lepaiclockdone()", 1000);
	$(".leftTime").each(function(){
		var obj = $(this);
		var tms = obj.attr("count_down");
		var html = '距结束：';
		if (tms>0) {
			tms = parseInt(tms)-1;
			var days = Math.floor(tms / (1 * 60 * 60 * 24));
			var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
			var minutes = Math.floor(tms / (1 * 60)) % 60;
			var seconds = Math.floor(tms / 1) % 60;

			if(days > 0){
				html += "<strong><strong>"+days+"</strong>天</strong>";
			}
			if(hours > 0){
				html += "<strong><strong>"+hours+"</strong>时</strong>";
			}
			if(minutes > 0){
				html += "<strong><strong>"+minutes+"</strong>分</strong>";
			}
			html += "<strong><strong>"+parseInt(seconds)+"</strong>秒</strong>";
			obj.html(html);
			obj.attr("count_down",tms);
		}else{
			location.href = location.href;
		}
	});
}
lepaiclockdone();//启动倒计时
</script>
<?php } else { ?>
<div class="list_tuangou"><?php echo $lang['no_groupbuy_info'];?></div>
<?php } ?>


<?php 

$array['P']['title'] = $output['groupbuy_list']['0']['groupbuy_name'];
$array['P']['imgUrl'] = gthumb($output['groupbuy_list']['0']['groupbuy_image'],60);
$array['Y']['title'] = $output['groupbuy_list']['0']['groupbuy_name'];
$array['Y']['desc'] = $output['groupbuy_list']['0']['groupbuy_name'];
$array['Y']['imgUrl'] = gthumb($output['groupbuy_list']['0']['groupbuy_image'],60);

echo weixinShare($array);

?>