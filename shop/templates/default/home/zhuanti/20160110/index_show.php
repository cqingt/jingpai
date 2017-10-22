
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/css/features.css">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/css/dowebok.css">
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/js/announcement.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/js/jquery.reveal.js"></script>

  <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/js/scroll.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/zDrag.js"></script>
<script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20151111/js/zDialog.js"></script>
<script type="text/javascript">
    $(function(){
      $(".list_lh").myScroll({
        speed:40, //数值越大，速度越慢
        rowHeight:68 //li的高度
      });
    });
	function open16(val)
	{
		var diag = new Dialog();
		diag.AutoClose=false;
		diag.ShowCloseButton=false;
		diag.URL = "<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/t2.html#l_id="+val;
		diag.Height = 240;
		diag.show();
	}
</script>
    <!--[if lte IE 8]><script>window.location.href='http://cdn.dmeng.net/upgrade-your-browser.html?referrer='+location.href;</script><![endif]-->
<div class="main banner">
     <div class="banner-main"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/banner.png" alt=""></div>
     <div class="abstract"></div>
</div>
<div class="main feedback">
     <div class="wrap">
          <div class="fee-happy"></div>
          <a class="look-over look-one button-wapasha button-inverted" href="#" data-reveal-id="myModal" data-animation="fade">查看活动规则</a>

          <div id="myModal" class="fea-reveal-modal regulation1">
                <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/regulation1.png" alt="">
                <a href="javascript:;" class="close-reveal-modal">X</a>
          </div>
          
          <!-- 抽奖 S-->
          <div id="dowebok">
            <div class="plate">
              <a id="plateBtn" href="javascript:" title="开始抽奖">开始抽奖</a>
            </div>

            <div id="result">
              <p id="resultTxt"></p>
              <a id="resultBtn" href="javascript:" title="关闭">关闭</a>
            </div>

          </div>
          <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/js/jquery.rotate.min.js"></script>
          <script type="text/javascript" src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/js/jquery.platebtn.js"></script>
          <!-- 抽奖 E-->

          <div class="announcement">
               <ul class="announcement-title">
                  <li class="on">中奖公告</li>
                  <li>我的中奖纪录</li>
               </ul>
               <div class="announcement-con" id="wrap">
                    <div class="announcement-con-list list_lh">
                         <ul class="annBoxes">
							<?php if($output['SuoYouLotteryList']){?>
							<?php foreach ($output['SuoYouLotteryList'] as $v){?>
                            <li>
                               <p class="ann-time"><?php echo date("Y-m-d H:i",$v['add_time']);?></p>
                               <p class="ann-name"><?php echo  substr($v['member_name'],0,3).'***';?></p>
                               <P class="ann-word"><?php echo $v['l_name'];?></P>
                            </li>
							<?php } ?>
							<?php }else{ ?>
							<li>
								无中奖信息
							</li>
							<?php } ?>
                           
                         </ul>
                    </div>
                    <div class="announcement-con-list" >
                         <ul class="annBoxes">
						 <?php if($output['MyLotteryList']){?>
						  <?php foreach ($output['MyLotteryList'] as $v){?>
                             <li>
							   <p class="ann-time"><?php echo date("Y-m-d H:i",$v['add_time']);?></p>
							   <p class="ann-name-f"><?php echo $v['l_name'];?></p>
							   <!--已发放/已领取/未领取 -->
								<?php if($v['is_fafang'] == 0){
								?>
                                <p class="ann-word-f"><a href="javascript:;" onclick="open16(<?php echo $v['id'];?>)">未领取</a></p> 
								<?php
								}
								else{
								?>
								<?php if($v['order_sn']){
								?>
                                <p class="ann-word-f">已发放</p> 
								<?php
								}
								else{
								?>
								<p class="ann-word-f">已领取</p> 
								<?php
								} ?>
								<?php
								} ?>
						     </li>
							<?php } ?>
							<?php }else{ ?>
							<li>
								无中奖信息
							</li>
							<?php } ?>
                         </ul>
                    </div>
               </div>
          </div>

          <div class="zero-title"></div>
          <a class="look-over look-two button-wapasha button-inverted" href="#" data-reveal-id="myModal2" data-animation="fade">查看活动规则</a>

          <div id="myModal2" class="fea-reveal-modal regulation1">
                <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/regulation2.png" alt="">
                <a class="close-reveal-modal">X</a>
          </div>

          <div class="show-boxes">
               <a href="http://www.96567.com/goods-14164.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/shop1.jpg" alt=""></a>
               <a href="http://www.96567.com/goods-14335.html#id=indexlh" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/shop2.jpg" alt=""></a>
               <a href="http://www.96567.com/goods-4000.html" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/shop3.jpg" alt=""></a>
			   <!--
               <a class="merchant" href="" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/merchant.jpg" alt=""></a>
			   -->
               <a class="merchant" href="http://www.96567.com/" target="_blank"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20160110/images/closing.jpg" alt=""></a>
          </div>

     </div>
</div>