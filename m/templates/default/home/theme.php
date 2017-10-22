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
</style>
<a class="auction_phone_main1_a auction_phone_zc_a">
		<img src="<?php echo BASE_SITE_URL.$output['theme']['T_Bottonimg'];?>" alt="<?php echo $output['theme']['T_Title'];?>" title="<?php echo $output['theme']['T_Title'];?>">
		<strong><?php echo $output['theme']['T_Title'];?></strong>
		<p class="auction_phone_zc_a_p">
			<span>商品数量<i><?php echo $output['theme']['goods_count'];?></i></span>
			<?php if($output['theme']['T_Ktime'] > TIMESTAMP){ ?>
				<span><i><?php echo $output['theme']['T_Click'];?></i>次围观</span>
			<?php }else{ ?>
				<span><i><?php echo $output['theme']['chujia_count'];?></i>次出价</span>
			<?php } ?>
		</p>	
	</a>

<div class="auction_phone_main2">
     <ul class="auction_phone_main2_ul">
	 <?php if(is_array($output['auction_info']) && !empty($output['auction_info'])){?>
                <?php foreach($output['auction_info'] as $k=>$v){ ?>
		 <li class="auction_phone_main2_ul_li">
			 <a href="<?php echo urlWap('lepai','auction',array('id'=>$v['G_Id']));?>">
				<div class="auction_phone_main2_ul_li_left">
					<img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" alt="<?php echo $v['G_Name'];?>" title="<?php echo $v['G_Name'];?>">
				</div>
				<div class="auction_phone_main2_ul_li_right">
					<strong><?php echo $v['G_Name'];?></strong>
					<?php if($output['theme']['T_Ktime'] > TIMESTAMP){ ?>
                     <!-- 未开始 -->
						<div class="auction_phone_main_ul_li_right_mid">
						<p>起始价<span>￥<?php echo intval($v['G_Qipai']);?></span></p>
						<p><span><?php echo intval($v['G_Click']);?></span>次围观</p>
						</div>
						<div class="auction_phone_main3_ul_li_right_down">
							<?php echo date('m月d日 H:i',$output['theme']['T_Ktime'])?> 开拍
						</div>
					 <?php }else{ ?>
					<div class="auction_phone_main_ul_li_right_mid">
						<p>当前价<span>￥<?php echo intval($v['new_price']);?></span></p>
						<p><span><?php echo intval($v['pai_count']);?></span>次出价</p>
					</div>
					<div class="auction_phone_main_ul_li_right_down">
                        <?php if($v['G_EndTime'] - TIMESTAMP >=0){ ?>
                        <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/main_btn.jpg" alt="">
						<i class="leftTime" count_down="<?php echo $v['G_EndTime'] - TIMESTAMP?>" timestatus="2">正在载入中...</i>
                        <?php }else{ ?>
                        <div>拍卖结束</div>
                        <?php }?>
					</div>
					<?php } ?>
				</div>
			 </a>
		 </li>
			<?php } ?>
        <?php }?>
		
     </ul>
</div>


<?php 

$array['P']['title'] = "拍卖惠_".$output['theme']['T_Title']."开拍喽!!!!";
$array['P']['imgUrl'] = BASE_SITE_URL.$output['theme']['T_Bottonimg'];
$array['Y']['title'] = "拍卖惠_".$output['theme']['T_Title']."开拍喽!!!!";
$array['Y']['desc'] = "好货、尖货、捡漏尽在收藏天下_拍卖惠";
$array['Y']['imgUrl'] = BASE_SITE_URL.$output['theme']['T_Bottonimg'];

echo weixinShare($array);

?>