<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<div class="breadcrumb"><span class="icon-home"></span><span><a href="<?php echo SHOP_SITE_URL;?>">首页</a></span> <span class="arrow">></span> <span>商家入驻申请</span> </div>


<style type="text/css">
.reveal-modal-bg { position: fixed; height: 100%; width: 100%; z-index: 100; display: none; top: 0; left: 0; background:rgba(255, 255, 255, 0.4) }
.reveal-modal { visibility: hidden; top: 150px; left: 50%; margin-left: -300px; width: 520px; position: absolute; z-index: 101; padding: 30px 40px 34px;}   
.reveal-modal .close-reveal-modal { font-size: 22px; line-height: 0.5; position: absolute; top: 8px; right: 11px; color: #333; text-shadow: 0 -1px 1px rbga(0,0,0,.4); font-weight: bold; cursor: pointer;} 
.loadbox {
  position: fixed;
  top: 40%;
  left: 47%;
  line-height: 30px;
  display:inline-block;*display:inline; *zoom:1;
  margin: 0 auto;
  background: url(img/load.gif) no-repeat left center;
  padding-left: 30px;
  font-size: 14px;
  color: #000;
  font-family: "microsoft yahei";
}

</style>






<script>
  
(function($) {

/*---------------------------
 Defaults for Reveal
----------------------------*/
   
/*---------------------------
 Listener for data-reveal-id attributes
----------------------------*/

  $('a[data-reveal-id]').live('click', function(e) {
    e.preventDefault();
    var modalLocation = $(this).attr('data-reveal-id');
    $('#'+modalLocation).reveal($(this).data());
  });

/*---------------------------
 Extend and Execute
----------------------------*/

    $.fn.reveal = function(options) {
        
        
        var defaults = {  
        animation: 'fadeAndPop', //fade, fadeAndPop, none
        animationspeed: 300, //how fast animtions are
        closeonbackgroundclick: false, //if you click background will modal close?
        dismissmodalclass: 'close-reveal-modal' //the class of a button or element that will close an open modal
      }; 
      
        //Extend dem' options
        var options = $.extend({}, defaults, options); 
  
        return this.each(function() {
        
/*---------------------------
 Global Variables
----------------------------*/
          var modal = $(this),
            topMeasure  = parseInt(modal.css('top')),
        topOffset = modal.height() + topMeasure,
              locked = false,
        modalBG = $('.reveal-modal-bg');

/*---------------------------
 Create Modal BG
----------------------------*/
      if(modalBG.length == 0) {
        modalBG = $('<div class="reveal-modal-bg" />').insertAfter(modal);
      }       
     
/*---------------------------
 Open & Close Animations
----------------------------*/
      //Entrance Animations
      modal.bind('reveal:open', function () {
        modalBG.unbind('click.modalEvent');
        $('.' + options.dismissmodalclass).unbind('click.modalEvent');
        if(!locked) {
          lockModal();
          if(options.animation == "fadeAndPop") {
            modal.css({'top': $(document).scrollTop()-topOffset, 'opacity' : 0, 'visibility' : 'visible'});
            modalBG.fadeIn(options.animationspeed/2);
            modal.delay(options.animationspeed/2).animate({
              "top": $(document).scrollTop()+topMeasure + 'px',
              "opacity" : 1
            }, options.animationspeed,unlockModal());         
          }
          if(options.animation == "fade") {
            modal.css({'opacity' : 0, 'visibility' : 'visible', 'top': $(document).scrollTop()+topMeasure});
            modalBG.fadeIn(options.animationspeed/2);
            modal.delay(options.animationspeed/2).animate({
              "opacity" : 1
            }, options.animationspeed,unlockModal());         
          } 
          if(options.animation == "none") {
            modal.css({'visibility' : 'visible', 'top':$(document).scrollTop()+topMeasure});
            modalBG.css({"display":"block"}); 
            unlockModal()       
          }
        }
        modal.unbind('reveal:open');
      });   

      //Closing Animation
      modal.bind('reveal:close', function () {
        if(!locked) {
          lockModal();
          if(options.animation == "fadeAndPop") {
            modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
            modal.animate({
              "top":  $(document).scrollTop()-topOffset + 'px',
              "opacity" : 0
            }, options.animationspeed/2, function() {
              modal.css({'top':topMeasure, 'opacity' : 1, 'visibility' : 'hidden'});
              unlockModal();
            });         
          }   
          if(options.animation == "fade") {
            modalBG.delay(options.animationspeed).fadeOut(options.animationspeed);
            modal.animate({
              "opacity" : 0
            }, options.animationspeed, function() {
              modal.css({'opacity' : 1, 'visibility' : 'hidden', 'top' : topMeasure});
              unlockModal();
            });         
          }   
          if(options.animation == "none") {
            modal.css({'visibility' : 'hidden', 'top' : topMeasure});
            modalBG.css({'display' : 'none'});  
          }   
        }
        modal.unbind('reveal:close');
      });     
    
/*---------------------------
 Open and add Closing Listeners
----------------------------*/
          //Open Modal Immediately
      modal.trigger('reveal:open')
      
      //Close Modal Listeners
      var closeButton = $('.' + options.dismissmodalclass).bind('click.modalEvent', function () {
        modal.trigger('reveal:close')
      });
      
      if(options.closeonbackgroundclick) {
        modalBG.css({"cursor":"pointer"})
        modalBG.bind('click.modalEvent', function () {
          modal.trigger('reveal:close')
        });
      }
      $('body').keyup(function(e) {
            if(e.which===27){ modal.trigger('reveal:close'); } // 27 is the keycode for the Escape key
      });
      
      
/*---------------------------
 Animations Locks
----------------------------*/
      function unlockModal() { 
        locked = false;
      }
      function lockModal() {
        locked = true;
      } 
      
        });//each call
    }//orbit plugin call
})(jQuery);
        



</script>





<a href="#" style="display:none;" class="big-link" data-reveal-id="myModal" data-animation="fade">点我弹出</a>


<div id="myModal" class="reveal-modal">
      <div class="setting"></div>
    <div class="loadbox">数据处理中...</div>
</div>





<div class="main">
  <div class="sidebar">
    <div class="title">
      <h3>商家入驻申请</h3>
    </div>
    <div class="content">
                  <!--<dl show_id="99">
        <dt onclick="show_list('99');" style="cursor: pointer;"> <i class="hide"></i>入驻流程</dt>
        <dd style="display:none;">
          <ul>
                                    <li> <i></i>
                            <a href="index.php?act=show_help&op=index&t_id=99&help_id=101" target="_blank">签署入驻协议</a>
                          </li>
                        <li> <i></i>
                            <a href="index.php?act=show_help&op=index&t_id=99&help_id=102" target="_blank">商家信息提交</a>
                          </li>
                        <li> <i></i>
                            <a href="index.php?act=show_help&op=index&t_id=99&help_id=103" target="_blank">平台审核资质</a>
                          </li>
                        <li> <i></i>
                            <a href="index.php?act=show_help&op=index&t_id=99&help_id=104" target="_blank">商家缴纳费用</a>
                          </li>
                        <li> <i></i>
                            <a href="index.php?act=show_help&op=index&t_id=99&help_id=105" target="_blank">店铺开通</a>
                          </li>
                                  </ul>
        </dd>
      </dl>-->
                  <dl>
        <dt class="<?php echo $output['sub_step'] == 'step0' ? 'current' : '';?>"> <i class="hide"></i>签订入驻协议</dt>
      </dl>
      <dl show_id="0">
        <dt onclick="show_list('0');" style="cursor: pointer;"> <i class="show"></i>提交申请</dt>
        <dd>
          <ul>
            <li class="<?php echo $output['sub_step'] == 'step1' ? 'current' : '';?>"><i></i>店铺资质信息</li>
            <li class="<?php echo $output['sub_step'] == 'step2' ? 'current' : '';?>"><i></i>财务资质信息</li>
            <li class="<?php echo $output['sub_step'] == 'step3' ? 'current' : '';?>"><i></i>店铺经营信息</li>
          </ul>
        </dd>
      </dl>
      <dl>
        <dt class="<?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"> <i class="hide"></i>合同签订及缴费</dt>
      </dl>
      <dl>
        <dt> <i class="hide"></i>店铺开通</dt>
      </dl>
    </div>
    <div class="title">
      <h3>平台联系方式</h3>
    </div>
    <div class="content">
      <ul>
                <li>电话：<?php echo C('site_phone');?></li>
                <li>邮箱：<?php echo C('site_email');?></li>
      </ul> 
    </div>
  </div>
  <div class="right-layout">
    <div class="joinin-step">
      <ul>
        <li class="step1 <?php echo $output['sub_step'] >= 'step0' ? 'current' : '';?><?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"><span>签订入驻协议</span></li>
        <li class="<?php echo $output['sub_step'] >= 'step1' ? 'current' : '';?><?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"><span>店铺资质信息</span></li>
        <li class="<?php echo $output['sub_step'] >= 'step2' ? 'current' : '';?><?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"><span>财务资质信息</span></li>
        <li class="<?php echo $output['sub_step'] >= 'step3' ? 'current' : '';?><?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"><span>店铺经营信息</span></li>
        <li class="<?php echo $output['sub_step'] >= 'step4' ? 'current' : '';?><?php echo $output['sub_step'] == 'pay' ? 'current' : '';?>"><span>合同签订及缴费</span></li>
        <li class="step6"><span>店铺开通</span></li>
      </ul>
    </div>
    <div class="joinin-concrete">
      
<!-- 协议 -->
<?php require('store_joinin_c2c_apply.'.$output['sub_step'].'.php'); ?>
   </div>
  </div>
</div>