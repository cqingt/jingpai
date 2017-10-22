  <link rel='stylesheet' href='<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/css/gift.css'>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/js/jquery.js"></script>

	
    <div class="present-content" id="investment">
      <!-- 杜飞1  这里增加了 CSS样式 handover_title -->
     <ul class="investment_title handover_title">
      <li class="on"><strong><a href="#investment">抢红包</a></strong></li>
      <li><strong><a href="#investment">真钞展示</a></strong></li>
      <li><strong><a href="#investment">我的财富</a></strong></li>
     </ul>
     <!-- 杜飞1  这里增加了 CSS样式 handover_boxes -->
     <div class="investment_boxes handover_boxes">
    
      <div class="district">
      <!-- home -->
        <div class="present">
          <div class="mammon">
            <a class="" id="btn-c" href="javascript:(0);">
            <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/Mammon.png" alt=""></a>
             <p class="btn-chai">您还有<em id="chishu"><?php echo $output['JiHui'];?>次</em>拆礼机会</p>
          </div>

          <a class="btn-rule" href="javascript:;">活动规则</a>
           <div class="bounce-rule" style="display:block;">
            
            <div class="ruleboxes ">
                <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel2"></i></a>
                <h1><i><i class="triangle-right"></i></i><span>活动规则</span><i><i class="triangle-left"></i></i></h1>
                <p class="p1">1、登录或注册收藏天下会员，即获1次机会打开钱包获取真钞。</p>
                <p class="p2">2、把活动分享到朋友圈2次，即获另外2次机会打开钱包获取真钞。</p>
                <p>真钞会存至“我的财富”。领取时请输入正确收货信息并下单完成领取。真钞将在活动结束后7个工作日内统一派送。</p>
                <p>优惠券将自动发放至收藏天下商城的个人中心。在下单付款前勾选使用。</p>
                <p>小编温馨提示：活动诚可贵，真钞价更高，稳赚不赔的好事，邮费需自理哦！（9.9元）</p>
            </div>

           </div>
          <a class="btn-rulebj" href=""><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/rulebj.png" alt=""></a>
           
           

           <div class="bounce bounce-two award ">
            <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel2"></i></a>
            <div class="award-boxes"  id="df_award-boxes">
              <!--<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/c1.png" alt="">-->
              <!-- <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/c2.png" alt=""> -->
              <!-- <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/c3.png" alt=""> -->
    
            </div>
           </div>
           <a class="btn-zz" href="javascript:(0);"></a>
         <!-- 杜飞2 登录与注册 S-->
               <div class="bounce mt fadeInUp">
                 <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel3"></i></a>
                  <span>为保证您的真钞领取顺利<br>请先登录/注册<br></span>
                 <ul class="tab-title handover_title2">
                  <li class="on2"><strong><a href="javascript:(0);">登录</a></strong></li>
                  <li><strong><a href="javascript:(0);">注册</a></strong></li>
                 </ul>
                
                 <div class="tab-form handover_boxes2">
                  <div class="investment_boxes">
                   <div class="forms" id="down">
                     
                     <div class="forms-line">
                       <label for="">用户名：</label>
                       <input type="text" name="user_name" id="user_name">
                     </div>
                     <div class="forms-line">
                       <label for="">密码：</label>
                       <input type="password" name="password2" id="password2">
                     </div>
                     <a class="tab-btn" id="btnOne" href="javascript:(0);">登录</a>
      
                   </div>
                  </div>

                  <div class="investment_boxes">
                   <div class="forms" id="down">

               <div class="forms-line">
                       <label for="">用户名：</label>
                       <input type="text" name="userName" id="name">
                     </div>
                     <div class="forms-line">
                       <label for="">密码：</label>
                       <input name="password" id="password" type="password">
                     </div>
                     <div class="forms-line">
                       <label for="">确认密码：</label>
                       <input type="password" name="passWord_enter" id="password1" >
                     </div>
                     <div class="forms-line">
                       <label for="">手机号码：</label>
                       <input name="mobile" id="mobile" type="tel">
                     </div>
                     <div class="forms-line">
                       <label for="">验证码：</label>
                       <input type="tel" name="captcha_code" id="code">
                  <input type="button" onclick="getPhoneYzm();" class="obtain" value="获取验证码" name="getYzm" id="getYzm">
                     </div>
                     <a class="tab-btn" href="javascript:(0);" id="TabBtnOne" href="javascript:(0);">注册</a>

                   </div>
                  </div>

                </div>
                 <!--杜飞2 登录与注册 A-->

          </div>
      <!-- home -->
         </div>
      </div>

      <div class="district">
       <div class="district-title "><i class="triangle-right"></i>点击图片可放大查看<i class="triangle-left"></i></div>
       <div class="picture">
        <a class="btn-seventh0" href="javascript:(0);">
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/picture/a0.jpg" alt="">
          <p>中国纪念钞大全 市场价值：¥12000</p>
        </a>
       </div>
       <ul>
         <li>
           <a class="btn-seventh1" href="javascript:(0);">
             <div class="picture">
              <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/picture/a1.jpg" alt="">
             </div>
             <p>壕！周边十国10张钞票</p>
           </a>
         </li>
         <li>
           <a class="btn-seventh2" href="javascript:(0);">
             <div class="picture">
              <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/picture/a2.jpg" alt="">
             </div>
             <p>10万面值“镇钱包”专用</p>
           </a>
         </li>
         <li>
           <a class="btn-seventh3" href="javascript:(0);">
             <div class="picture">
              <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/picture/a3.jpg" alt="">
             </div>
             <p>第三套人民币小全套10元代金券</p>
           </a>
         </li>
         <li>
           <a class="btn-seventh4" href="javascript:(0);">
             <div class="picture">
              <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/picture/a4.jpg" alt="">
             </div>
             <p>神秘百慕大“最美”竖版塑料钞</p>
           </a>
         </li>
       </ul>  

       <div class="bounce seventh seventh0">
        <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
        <div class="award-boxes">
         <div class="shop">
          <!-- 图片有1-7 -->
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/seventh0.jpg" alt="">
         </div>
         <h6>新中国成立后发行的4枚纪念钞大全</h6>
         <p>【藏品名称】中国纪念钞大全</p>
         <p>【发行单位】中国人民银行</p>
         <p>【市场参考价】¥12000</p>
         <strong>转发微信抢钱包，就有机会得到！</strong>
         <a>等你来领取！</a>
        </div>
       </div>

       <div class="bounce seventh seventh1">
        <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
        <div class="award-boxes">
         <div class="shop">
          <!-- 图片有1-7 -->
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/seventh1.jpg" alt="">
         </div>
         <h6>壕！周边十国10张钞票 </h6>
         <p>一次收获十个国家的10张钞票！</p>
         <p>也太过瘾了吧！</p>
         <p>如此财运！</p>
         <p>终究会落在谁身上？</p>
         <strong>快去抢钱包吧！</strong>
         <a>我们拭目以待！</a>
        </div>
       </div>

       <div class="bounce seventh seventh2">
        <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
        <div class="award-boxes">
         <div class="shop">
          <!-- 图片有1-7 -->
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/seventh2.jpg" alt="">
         </div>
         <h6>10万面值  “镇钱包”专用</h6>
         <p>你的钱包里，要有一张10万“镇宅”！</p>
         <p>每次打开钱包，财气满满扑面而来！</p>
         <p>全新未流通品相,如图显示！</p>
         <p>1993年绝版精美大面值！</p>
         <strong>我们就这样静静的躺在钱包里！</strong>
         <a>你一定要拥有！</a>
        </div>
       </div>

       <div class="bounce seventh seventh3">
        <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
        <div class="award-boxes">
         <div class="shop">
          <!-- 图片有1-7 -->
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/seventh3.jpg" alt="">
         </div>
         <h6>第三套人民币小全套（共9枚）</h6>
         <p>【藏品名称】第三套人民币小全套（共9枚）</p>
         <p>【发行单位】中国人民银行</p>
         <p>【停用时间】2000年7月7日</p>
         <strong>超值！限时特价198元！</strong>
         <strong>领券后再减10元！</strong>
         <a>等你来领取！</a>
        </div>
       </div>

       <div class="bounce seventh seventh4">
        <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
        <div class="award-boxes">
         <div class="shop">
          <!-- 图片有1-7 -->
          <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/seventh4.jpg" alt="">
         </div>
         <h6>神秘百慕大“最美”竖版塑料钞</h6>
         <p>最美竖版塑料钞！</p>
         <p>来自百慕大这个最神秘的地方！</p>
         <p>当地人把信仰寄托给海神和蓝鸟！</p>
         <p>创造了这张世上最美的钞票！</p>
         <strong>获取它！</strong>
         <a>这将是你与百慕大最近的距离</a>
        </div>
       </div>
       <a class="btn-zz" href="javascript:(0);"></a>
      </div>

      <div class="district" id="l_district">
		
	   <?php if($output['MyLotteryList']){ ?>
       <h2>小编温馨提示：</h2>
       <p>活动诚可贵，真钞价更高，(稳赚不赔的买卖) 邮费需自理哦！（9.9元）。现金钞票将在活动结束后7个工作日内完成派送，请保持电话畅通。</p>
       <ol class="register-box">
	   <?php foreach($output['MyLotteryList'] as $k=>$v){?>
	    <?php if($v['l_id'] < 4){?>
		<?php if($v['l_id'] == 3){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic03.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong class="strong1"><i></i>限时特价198元！下单再减10元！<a class="btn-atv2" href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16091">已发放</a></strong>
			   </div>
			 </li>
		  <div class="btn-all-box alltwo">
           <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16091">立即使用</a>
         </div>
			 <?php } ?>
			 <?php if($v['l_id'] == 2){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic02.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong><i></i>10万面值“镇钱包”专用<a class="btn-atv1" href="javascript:(0);"><?php if($v['is_fafang'] == 1){?>已领取<?php }else{ ?>未领取 <?php }?></a></strong>
			   </div>
			 </li>
       
			 <?php } ?>
			<?php if($v['l_id'] == 1){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic01.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong><i></i>壕！ 周边十国10张钞票<a class="btn-atv1" href="javascript:(0);"><?php if($v['is_fafang'] == 1){?>已领取<?php }else{ ?>未领取 <?php }?></a></strong>
			   </div>
			 </li>
			 <div class="btn-all-box">
			 <a href="javascript:(0);" onclick="lingqu();">领取现金</a>
			 <p>全部财富一起领取仅需支付一次运费哦</p>
		   </div>
			<?php } ?>
			 
		 <?php } ?>
		 <?php } ?>
		
			
       </ol>
	   <?php } else{ ?>
	   <h2>小编温馨提示：</h2>
	   <p>您还没有获得任何奖品，<strong></strong>快去点击拆红包吧！</p>
	   <?php } ?>


       <div class="bounce mt shouhuoren">
         <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
         <div class="forms" id="down">
			<div class="forms-line">
             <p class="linep">全部财富一起领取仅需支付一次运费(9.9元)<p>
           </div>
           <div class="forms-line">
             <label for="">收货人姓名</label>
             <input type="text" name="true_name" id="true_name">
           </div>
           <div class="forms-line">
             <label for="">手机号码</label>
             <input type="tel" name="mob_phone" id="mob_phone">
           </div>
		   <div class="forms-line">
             <label for="">所在地区</label>
               <input type="hidden" value="" name="city_id" id="city_id">
			   <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
               <input type="hidden" name="area_info" id="area_info" class="area_names"/>
				 <select class="valid" name="prov" id="vprov">
						<option value="">-请选择-</option>
					</select>
					<select class="valid" name="city" id="vcity">
						<option value="">-请选择-</option>
					</select>
			   
					<select class="valid" name="region" id="vregion">
						<option value="">-请选择-</option>
					</select>
           </div>
           <div class="forms-line">
             <label for="">详细地址</label>
             <textarea placeholder="" rows="2" name="address" id="address"></textarea>
           </div>
           <a href="javascript:(0);" id='btnLingQu'>领取</a>
         </div>
      </div>

      
      </div>


     <div class="bounce mt isguanzhu">
       <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel" id="aisguanzhu"></i></a>
       <div class="forms" id="down">
         <h5>扫码后可方便查询派送信息</h5>
         <img class="wechat" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/wechat.jpg" alt="">
       </div>
     </div>

     </div>
    </div>

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/js/total.js"></script>
<?php

$array['P']['title'] = "收藏天下五周年狂欢，抢现金100%必中！刚抢到10张钞票！时间有限，速来";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160415/images/100-100.jpg";
$array['Y']['title'] = "收藏天下5周年狂撒100万现金钞票";
$array['Y']['desc'] = "收藏天下五周年狂欢，抢现金100%必中！刚抢到10张钞票！时间有限，速来";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160415/images/100-100.jpg";

echo weixinShareHuiDiao($array);

?>