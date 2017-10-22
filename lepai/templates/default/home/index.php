<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo LEPAI_CSS_URL;?>/css/auction.css" rel="stylesheet" type="text/css">
<script src="<?php echo LEPAI_CSS_URL;?>/js/lepai_clock.js" type="text/javascript" ></script>

<?php include template('home/top_ad');?>

<div class='auction_center'>
    <!--auction_main1-->
    <div class='auction_main1'>
        <div class='auction_main1_left'>
            <img src="<?php echo LEPAI_CSS_URL;?>/images/main_bg1.jpg" alt="" />
            <ul>
                <?php foreach($output['theme'] as $k=>$v){ ?>
                    <li class='auction_main2_ul_li'>
                        <a target="_blank" href="<?php echo urlLepai('index','theme',array('tid'=>$v['T_Id']));?>">
                            <img src="<?php echo BASE_SITE_URL.$v['T_Bottonimg'];?>" alt="<?php echo $v['T_Title'];?>" />
                            <p><?php echo $v['T_Title'];?></p>
                            <p id='auction_main1_left_p2'>共<span><?php echo $v['goods_count'];?></span>件品  <span><?php echo $v['T_Click'];?></span>人围观</p>
                            <!-- 未开始 -->
                            <?php if($v['T_Ktime'] > TIMESTAMP){ ?>
                                <p id='auction_main1_left_p1_b' class="leftTime" count_down="<?php echo $v['T_Ktime'] - TIMESTAMP;?>" timestatus="1">正在载入中...</p>
                                <p id='auction_main1_left_p' style="background: #196554;"><span><?php echo $v['T_Click'];?></span><br>人围观</p>
                            <?php }else{ ?>
                                <!-- 已开始 -->
                                <p id='auction_main1_left_p1' class="leftTime" count_down="<?php echo $v['T_Jtime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</p>
                                <p id='auction_main1_left_p'><span><?php echo $v['chujia_count'];?></span><br>次出价</p>
                            <?php } ?>

                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class='auction_main1_right' style="width: 282px">
            <img class='auction_main1_right_img' src="<?php echo LEPAI_CSS_URL;?>/images/main_bg2.jpg" alt="" />
            <ul>
                <?php foreach($output['remen_arr'] as $k=>$v){ ?>
                    <li class='auction_main2_ul_li'><a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank">
                            <img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" width="89" height="89" alt="<?php echo $v['G_Name'];?>"/>
                            <p><?php echo $v['G_Name'];?></p>
                            <p>当前价：<span>￥<?php echo intval($v['new_price']);?></span></p>
                            <p><?php if($v['pai_count'] >0){?><img src="<?php echo LEPAI_CSS_URL;?>/images/anction_main1_left_btn.jpg" alt="" /><?php echo $v['pai_count'].'次出价';}else{ ?><?php echo $v['G_Click'].'人关注';}?></p>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>

    <!--auction_main2-->
    <div class='auction_main2'>
      <?php if(is_array($output['kaishi_arr']) && !empty($output['kaishi_arr'])){?>
          <strong>
              <div style="float:left;"><span>正在</span>进行</div>
              <a href="<?php echo urlLepai('index','auction_more');?>" target="_blank" style="display:block;float:right;margin:20px 15px 0 0;font-size:14px;">查看全部商品</a>
          </strong>
        <ul>
            <?php foreach($output['kaishi_arr'] as $k=>$v){ ?>
                <li class='auction_main2_ul_li'>
                    <a target="_blank" href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" width="280" height="280" alt="<?php echo $v['G_Name'];?>"/></a>
                    <div class='auction_main2_box'>
                        <div class='auction_main2_box_left'>
                            <a target="_blank" href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><?php echo $v['G_Name'];?></a>
                            <p>当前价<span>￥<?php echo intval($v['new_price']);?></span></p>
                            <p class="leftTime" count_down="<?php echo $v['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</p>
                        </div>
                        <p class='auction_main2_box_right'><span><?php echo $v['pai_count'];?></span><br>次出价</p>
                    </div>
                </li>
            <?php } ?>
        </ul>
      <?php } ?>
    </div>
    <!--auction_main2 end-->

    <!--auction_main3-->
    <div class='auction_main3 auction_main2' style="padding-bottom:20px;">
        <?php if(is_array($output['weikaishi_arr']) && !empty($output['weikaishi_arr'])){?>
        <div class='auction_main3_title'>
            <strong><span>即将</span>开始</strong>
            <a href="<?php echo urlLepai('index','more');?>" target="_blank">查看往期拍卖</a>
        </div>
        <ul>
            <?php foreach($output['weikaishi_arr'] as $k=>$v){ ?>
            <li class='auction_main2_ul_li'>
                <a target="_blank" href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" width="280" height="280" alt="<?php echo $v['G_Name'];?>" /></a>
                <div class='auction_main2_box'>
                    <div class='auction_main2_box_left'>
                        <a target="_blank" href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><?php echo $v['G_Name'];?></a>
                        <p>起拍价<span>￥<?php echo intval($v['new_price']);?></span></p>
                        <p style="font-size: 14px;font-family: '宋体';color: #196554;"><?php echo date('m月d日 H:i',$v['T_Ktime'])?> 开拍</p>
                    </div>
                    <p class='auction_main2_box_right'><span><?php echo $v['G_Click'];?></span><br>次围观</p>
                </div>
            </li>
            <?php } ?>

        </ul>
       <?php } ?>
    </div>
    <!--auction_main3 end-->
</div>
