<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo LEPAI_CSS_URL;?>/css/auction.css" rel="stylesheet" type="text/css">

<?php include template('home/top_ad');?>

<style>

</style>
<div class='auction_center'>
    <?php if($output['pagename'] == 'more'){?>
    <!--auction_main2-->
    <div class="auction_main2 auction_zt_main" style="padding-bottom:30px;">
        <strong style="background:url(<?php echo LEPAI_CSS_URL;?>/images/auction_main2_strong_bg1.jpg) bottom no-repeat;">
            <div style="float:left;"><span style="color:#666;">往期</span>拍卖惠</div>
            <a href="<?php echo LEPAI_SITE_URL;?>" style="float:right;margin-right:15px;font-weight:normal;font-size:14px;display:block;line-height:50px;">返回拍卖惠首页</a>
        </strong>
        <ul>
            <?php foreach($output['lists'] as $k=>$v){ ?>
            <li class="auction_main2_ul_li_o">
                <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" alt="<?php echo $v['G_Name'];?>" title="<?php echo $v['G_Name'];?>" width="280" height="280"></a>
                <div class="auction_main2_box">
                    <div class="auction_main2_box_left">
                        <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><?php echo $v['G_Name'];?></a>
                        <?php if($v['G_Atype'] == 6){?>
                        <p>成交价<span>￥<?php echo intval($v['new_price']);?></span></p>
                        <!--<p>所属专场</p>-->
                        <p>
                            <?php echo '恭喜 <i style="color:#ff0000;">'.mb_substr($v['member_name'],0,2,'utf-8').'***</i> 竞拍成功';?>
                        </p>
                        <?php }else{ ?>
                            <p>结拍价<span>￥<?php echo intval($v['new_price']);?></span></p>
                            <p>
                                低于保留价流拍
                            </p>
                        <?php } ?>
                    </div>
                    <p class="auction_main2_box_right"><span><?php echo intval($v['pai_count']);?></span><br>次出价</p>
                </div>
                <img class="auction_zt_cj" src="<?php echo LEPAI_CSS_URL;?>/images/auction_btn1.png">
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="tc mt20 mb20">
        <div class="pagination"> <?php echo $output['show_page']; ?> </div>
    </div>
    <?php }elseif($output['pagename'] == 'auction_more'){?>
    <script src="<?php echo LEPAI_CSS_URL;?>/js/lepai_clock.js" type="text/javascript" ></script>
    <div class="auction_main2 auction_zt_main" style="padding-bottom:30px;">

        <div class="auction_main2">
            <strong><span>正在</span>进行
                <a href="<?php echo LEPAI_SITE_URL;?>" target="_blank" style="font-size:14px;float:right;margin:20px 15px 0 0;display:block;font-weight:normal;">返回拍卖惠首页</a>
            </strong>
        </div>
        <ul>
            <?php if(is_array($output['lists']) && !empty($output['lists'])){?>
            <?php foreach($output['lists'] as $k=>$v){ ?>
                <?php if($v['T_Ktime'] > TIMESTAMP){ continue;}?>
                <?php if($v['G_EndTime'] < TIMESTAMP){ continue;}?>
            <li class="auction_main2_ul_li">
                <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" alt="<?php echo $v['G_Name'];?>" width="280" height="280" title="<?php echo $v['G_Name'];?>"></a>
                <div class="auction_main2_box">
                    <div class="auction_main2_box_left">
                        <a href="auction-8641.html" target="_blank"><?php echo $v['G_Name'];?></a>
                        <p>当前价<span>￥<?php echo intval($v['new_price']);?></span></p>
                        <p class="leftTime" count_down="<?php echo $v['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</p>
                    </div>
                    <p class="auction_main2_box_right"><span><?php echo intval($v['pai_count']);?></span><br>次出价</p>
                </div>

            </li>
            <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <?php } ?>

    </div>

    <!--auction_main2 end-->
</div>