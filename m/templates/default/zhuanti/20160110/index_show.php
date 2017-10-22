<script type="text/javascript">
$(function(){
  $(".list_lh").myScroll({
	speed:40, //数值越大，速度越慢
	rowHeight:68 //li的高度
  });
});
</script>

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/css/features.css">
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/css/dowebok.css">
<script src="http://resource.96567.com/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/js/announcement.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/js/jquery.reveal.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/js/scroll.js"></script>
<script>
function fun2(l_id)
{		
		var l_id = l_id;
		var name=$("#name").val();
		var tel=$("#tel").val();
		if(l_id == 0 || l_id == ''){
			alert("系统繁忙请稍后提交");
			return false;
		}
		if(name==""){
			alert("请输入姓名");
			$("#name").focus();
			return false;
		}
		if(tel==""){
			alert("请输入电话");
			$("#tel").focus();
			return false;
		}
		if (!valid_shouji(tel))
		{
			alert("请输入正确的电话");
			$("#tel").focus();
			return false;
		}
		$.post("index.php?act=zhuanti&op=ad_20160110&action=post_ajax",{"name":name,"mobile":tel,"l_id":l_id},function(result){
			if(result==-3){
					alert("系统繁忙请稍后提交!");
					return false;
			}
			if(result == -1){//未登录跳转到登录页面
						window.location.href="index.php?act=login&op=index";
						return false; 
					}
			if(result==-2){
					alert("您已经提交过了");
					$("#tel").focus();
					return false;
			}

			if(result==1){
					alert("您已成功领取，请等待客服与您联系确认！");	
					window.open ("index.php?act=zhuanti&op=ad_20160110&t="+new Date().getTime()+"", "_top" );
					return false;
			}
		});
}
function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
 	return patten.test(shouji);
}
</script>
<div class="main banner">
     <div class="banner-main"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/banner.png" alt=""></div>
     <div class="banner-bottom"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/abstract.png" alt=""></div>
     <div class="abstract"></div>
</div>
<div class="main feedback">
     <div class="wrap">
          <div class="fee-happy">
               <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/happy.jpg" alt="">
          </div>
          <a class="look-over look-one button-wapasha button-inverted" href="#" data-reveal-id="myModal" data-animation="fade">查看活动规则</a>

          <div id="myModal" class="fea-reveal-modal regulation1">
                <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/regulation1.png" alt="">
                <a class="close-reveal-modal"></a>
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
          <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/js/jquery.rotate.min.js"></script>
          <script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/js/jquery.platebtn.js"></script>
          <!-- 抽奖 E-->

          <div class="announcement">
               <ul class="announcement-title">
                  <li class="on">中奖公告</li>
                  <li>我的中奖纪录</li>
               </ul>
               <div class="announcement-con">
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
                    <div class="announcement-con-list">
                         <ul class="annBoxes">
                              <!-- <li>无中奖纪录</li> -->
							   <?php if($output['MyLotteryList']){?>
						  <?php foreach ($output['MyLotteryList'] as $v){?>
                              <li>
                                 <p class="ann-time"><?php echo date("Y-m-d H:i",$v['add_time']);?></p>
                                 <P class="ann-word-f"><?php echo $v['l_name'];?></P>
								 <?php if($v['is_fafang'] == 0){
								?>
							<div id="myModal-no-<?php echo $v['id'];?>" class="fea-reveal-modal regulation2">
                              <div class="get-boxes">
                                   <div class="myitem">
                                        <input type="text" name="name" id="name" placeholder="请输入名字">
                                   </div>
                                   <div class="myitem">
                                        <input type="tel" name="tel" id="tel" placeholder="请输入手机号">
                                   </div>
                                   <div class="myitem"><a class="getbtn" href="javascript:;" onClick="fun2(<?php echo $v['id'];?>)">提交</a></div>
                              </div>
                              <a class="close-reveal-modal getxx"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/close.png" alt=""></a>
                         </div>
                                <p class="ann-name-f"><a href="javascript:;" data-reveal-id="myModal-no-<?php echo $v['id'];?>" data-animation="fade">未领取</a></p>
								<?php
								}
								else{
								?>
								<?php if($v['order_sn']){
								?>
                                <p class="ann-name-f">已发放</p> 
								<?php
								}
								else{
								?>
								<p class="ann-name-f">已领取</p> 
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

          <div class="zero-title">
               <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/zero.jpg" alt="">
          </div>
          <a class="look-over look-two button-wapasha button-inverted" href="#" data-reveal-id="myModal2" data-animation="fade">查看活动规则</a>

          <div id="myModal2" class="fea-reveal-modal regulation1">
                <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/regulation2.png" alt="">
                <a class="close-reveal-modal"></a>
          </div>

          <div class="show-boxes">
               <a href="http://www.96567.com/goods-14164.html"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/shop1.jpg" alt=""></a>
               <a href="http://www.96567.com/goods-14335.html#id=indexlh">
                  <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/shop2.jpg" alt="">
               </a>
               <a href="http://www.96567.com/goods-4000.html"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/shop3.jpg" alt=""></a>
               <a class="merchant" href="http://www.96567.com/"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160110/images/closing.jpg" alt=""></a>
          </div>

     </div>
</div>