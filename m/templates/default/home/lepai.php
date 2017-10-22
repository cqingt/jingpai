<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/lepai_clock.js" type="text/javascript" ></script>
    <style>
        .auction_phone_main2_ul_li_left img {
            width: 105px;
            height: 105px;
        }
        .header-back, .i-main-opera{
            display: none;
        }
    </style>
<div class="auction_phone_main1">
	 <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/title_img0.jpg" alt="">
	
	<?php foreach($output['theme'] as $k=>$v){ ?>
	 <a class="auction_phone_main1_a" href="<?php echo urlWap('lepai','theme',array('tid'=>$v['T_Id']));?>">
		<img src="<?php echo BASE_SITE_URL.$v['T_Bottonimg'];?>" title="<?php echo $v['T_Title'];?>" alt="<?php echo $v['T_Title'];?>" >
		<strong><?php echo $v['T_Title'];?></strong>
		<p class="auction_phone_main1_p1"><span><?php echo $v['chujia_count'];?></span>次出价<span><?php echo $v['T_Click'];?></span>次围观</p>
        <?php if($v['T_Ktime'] > TIMESTAMP){ ?>
			<!-- 未开始 -->
			<p class="auction_phone_main1_p2" style="background:#196554;"><?php echo date("m月d日 H:i",$v['T_Ktime']); ?> 开始</p>
		<?php }else{ ?>
			<!-- 已开始 -->
			<p class="auction_phone_main1_p2"><?php echo date("m月d日 H:i",$v['T_Jtime']); ?> 结束</p>
		<?php } ?>
		
	 </a>
	<?php } ?>
</div>

<?php if(is_array($output['kaishi_arr']) && !empty($output['kaishi_arr'])){?>

<div class="auction_phone_main2">
	 <div class="auction_phone_main2_title">
		  <strong><span>正在</span>进行</strong>
	 </div>
     <ul class="auction_phone_main2_ul">
	 <?php foreach($output['kaishi_arr'] as $k=>$v){ ?>
			 <li class="auction_phone_main2_ul_li">
				 <a href="<?php echo urlWap('lepai','auction',array('id'=>$v['G_Id']));?>">
					<div class="auction_phone_main2_ul_li_left">
						<img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" alt="<?php echo $v['G_Name'];?>" title="<?php echo $v['G_Name'];?>">
					</div>
					<div class="auction_phone_main2_ul_li_right">
						<strong><?php echo $v['G_Name'];?></strong>
						<div class="auction_phone_main_ul_li_right_mid">
							<p>当前价<span>￥<?php echo intval($v['new_price']);?></span></p>
							<p><span><?php echo $v['pai_count'];?></span>次出价</p>
						</div>
						<div class="auction_phone_main_ul_li_right_down">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/main_btn.jpg" alt="">
							<i class="leftTime" count_down="<?php echo $v['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</i>
						</div>
					</div>
				 </a>
			 </li>
		<?php } ?>
		 
     </ul>
	 
</div>
	 <?php }else{ ?>
	 <?php if(is_array($output['weikaishi_arr']) && !empty($output['weikaishi_arr'])){?>
	 <div class='auction_phone_main3'>
		<div class='auction_phone_main3_title'>
			<strong><span>即将</span>开始</strong>
		</div>
		<ul class='auction_phone_main3_ul'>
		<?php foreach($output['weikaishi_arr'] as $k=>$v){ ?>
			<li class="auction_phone_main3_ul_li"><a href="<?php echo urlWap('lepai','auction',array('id'=>$v['G_Id']));?>">
				<div class='auction_phone_main3_ul_li_left'>
					<img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" alt="<?php echo $v['G_Name'];?>" title="<?php echo $v['G_Name'];?>"/>
				</div>
				<div class='auction_phone_main3_ul_li_right'>
					<strong><?php echo $v['G_Name'];?></strong>
					<div class="auction_phone_main3_ul_li_right_mid">
						<p>起拍价<span>￥<?php echo intval($v['new_price']);?></span></p>
						<p><span><?php echo $v['G_Click'];?></span>次围观</p>
					</div>
					<div class="auction_phone_main3_ul_li_right_down">
						<?php echo date('m月d日 H:i',$v['T_Ktime'])?> 开拍
					</div>
				</div>
			</a></li>
			<?php } ?>
			
		</ul>
	</div>

	 <?php	
		}
	 }
	 ?>

<?php

$array['P']['title'] = "好货捡漏_就上拍卖惠！";
$array['P']['imgUrl'] = 'http://m.96567.com/images/logo.png';
$array['Y']['title'] = "好货捡漏_就上拍卖惠！";
$array['Y']['desc'] = "好货、尖货、捡漏尽在收藏天下_拍卖惠";
$array['Y']['imgUrl'] = 'http://m.96567.com/images/logo.png';

echo weixinShare($array);

?>