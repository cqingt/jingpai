<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo LEPAI_CSS_URL;?>/css/auction.css" rel="stylesheet" type="text/css">
<script src="<?php echo LEPAI_CSS_URL;?>/js/lepai_clock.js" type="text/javascript" ></script>

<!--auction_top_img-->
<div class="auction_top_img" style="text-align: center;"><img src="<?php echo BASE_SITE_URL.$output['theme']['T_Topimg'];?>" alt="<?php echo $v['T_Title'];?>" title="<?php echo $v['T_Title'];?>"></div>


<div class='auction_center'>
    <!--auction_main2-->
    <div class='auction_main2 auction_zt_main' style="padding-bottom:30px;">
        <strong>
            <?php if($output['theme']['T_Ktime'] > TIMESTAMP){ ?>
                <span style="color:#196554;">即将</span>开始
            <?php }else{ ?>
            <?php echo ($output['theme']['T_Jtime'] < TIMESTAMP)?'已结束':'<span>正在</span>进行';?>
            <?php } ?>
        </strong>
        <ul>
            <?php if(is_array($output['auction_info']) && !empty($output['auction_info'])){?>
                <?php foreach($output['auction_info'] as $k=>$v){ ?>
                    <li class='auction_main2_ul_li_o'>
                        <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" width="280" height="280" alt="<?php echo $v['G_Name'];?>" /></a>
                        <div class='auction_main2_box'>
                            <div class='auction_main2_box_left'>
                                <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>"><?php echo $v['G_Name'];?></a>

                                <?php if($v['G_EndTime'] < TIMESTAMP){?>
                                    <!-- 已结束 -->
                                    <p>当前价<span style="color: #d62628">￥<?php echo intval($v['new_price']);?></span></p>
                                    <p><?php echo ($v['G_Atype'] == 6)?'恭喜 <i style="color:#ff0000;">'.mb_substr($v['member_name'],0,2,'utf-8').'***'.'</i> 竞拍成功':'低于保留价流拍';?></p>
                                    </div>
                                    <p class='auction_main2_box_right'><span><?php echo intval($v['pai_count']);?></span><br>次出价</p>
                                <?php }else{ ?>

                                    <?php if($output['theme']['T_Ktime'] > TIMESTAMP){ ?>
                                        <!-- 未开始 -->
                                        <p>起始价<span>￥<?php echo intval($v['G_Qipai']);?></span></p>
                                        <p style="font-size: 14px;font-family: '宋体';color: #196554;"><?php echo date('m月d日 H:i',$output['theme']['T_Ktime'])?> 开拍</p>
                                        </div>
                                        <p class='auction_main2_box_right' style="background:#196554;"><span><?php echo intval($v['G_Click']);?></span><br>次围观</p>
                                    <?php }else{ ?>
                                        <!-- 已开始 -->
                                        <p>当前价<span style="color: #d62628">￥<?php echo intval($v['new_price']);?></span></p>
                                        <p class="leftTime" count_down="<?php echo $v['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</p>
                                        </div>
                                        <p class='auction_main2_box_right' style="background:#a20000"><span><?php echo intval($v['pai_count']);?></span><br>次出价</p>
                                    <?php } ?>

                                <?php } ?>

                        </div>
                        <?php if($v['G_EndTime'] < TIMESTAMP){?>
                            <img class='auction_zt_cj' src="<?php echo LEPAI_CSS_URL;?>/images/auction_btn1.png">
                        <?php } ?>
                    </li>
                <?php } ?>
            <?php }?>
        </ul>
    </div>

    <!--auction_main2 end-->
</div>