<?php defined('InShopNC') or exit('Access Invalid!');?>
<style type="text/css">
.public-top-layout, .head-app, .head-search-bar, .head-user-menu, .public-nav-layout, .nch-breadcrumb-layout, #faq {
	display: none !important;
}
.public-head-layout {
	margin: 10px auto -10px auto;
}
.wrapper {
	width: 1000px;
}
#footer {
	border-top: none!important;
	padding-top: 30px;
}
</style>
<div class="nc-login-layout">
  <div class="nc-login">
    <div class="nc-login-title">
      <h3><?php echo $lang['login_register_join_us'];?></h3>
    </div>
    <div class="nc-login-content">
      <form id="register_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php?act=login&op=usersave">
      <?php Security::getToken();?>
      <?php if($_GET['yuyue'] == 1){?>
      <input type="hidden" name="register_liayuan" value="yuyue">
      <?php }?>
        <dl>
          <dt><?php echo $lang['login_register_username'];?></dt>
          <dd style="min-height:54px;">
            <input type="text" id="user_name" name="user_name" class="text tip" title="<?php echo $lang['login_register_username_to_login'];?>" autofocus />
            <label></label>
          </dd>
        </dl>
        <dl>
          <dt><?php echo $lang['login_register_pwd'];?></dt>
          <dd style="min-height:54px;">
            <input type="password" id="password" name="password" class="text tip" title="<?php echo $lang['login_register_password_to_login'];?>" />
            <label></label>
          </dd>
        </dl>
        <dl>
          <dt><?php echo $lang['login_register_ensure_password'];?></dt>
          <dd style="min-height:54px;">
            <input type="password" id="password_confirm" name="password_confirm" class="text tip" title="<?php echo $lang['login_register_input_password_again'];?>"/>
            <label></label>
          </dd>
        </dl>
      <dl>
          <dt><?php echo $lang['login_register_mobile'];?></dt>
          <dd style="min-height:54px;">
              <input type="text" id="mobile" name="mobile" class="text tip" title="<?php echo $lang['login_register_input_valid_mobile'];?>" />
              <label></label>
          </dd>
      </dl>
      <!-- <dl>
          <dt></dt>
          <dd style="min-height:54px;">
              <input name="yzmobile" type="checkbox" id="yzmobile" style="float: left"/>
              <label for="yzmobile"><?php echo $lang['login_register_yzminfo'];?></label>
          </dd>
      </dl> -->

      <dl id="zy_mobile" style="display: none">
          <dt><?php echo $lang['login_register_yzmobile'];?></dt>
          <dd style="min-height:54px;">
              <input type="text" id="yzm" name="yzm" class="text tip" title="<?php echo $lang['login_register_yzmget'];?>" style="width: 100px"/>
              <a class="ncm-btn ml5" id="send_auth_code" href="javascript:void(0);"><span style="display:none" id="sending">正在</span><span class="send_success_tips" style="display: none;"><strong class="red mr5" id="show_times"></strong>秒后再次</span>获取短信验证码</a>
          </dd>
      </dl>
          <script>
              var ALLOW_SEND = true;
              $(function(){
                  function StepTimes() {
                      $num = parseInt($('#show_times').html());
                      $num = $num - 1;
                      $('#show_times').html($num);
                      if ($num <= 0) {
                          ALLOW_SEND = !ALLOW_SEND;
                          $('.send_success_tips').hide();
                      } else {
                          setTimeout(StepTimes,1000);
                      }
                  }
                  $('#send_auth_code').on('click',function(){
                      if ($('#mobile').val() == '') return false;
                      if (!ALLOW_SEND) return;
                      ALLOW_SEND = !ALLOW_SEND;
                      $('#sending').show();
                      $.getJSON('index.php?act=login&op=send_ajax_mobile',{mobile:$('#mobile').val()},function(data){
                          if (data.state == 'true') {
                              $('#sending').hide();
                              $('.send_success_tips').show();
                              $('#show_times').html(60);
                              setTimeout(StepTimes,1000);
                          } else {
                              ALLOW_SEND = !ALLOW_SEND;
                              $('#sending').hide();
                              $('.send_success_tips').hide();
                              showDialog(data.msg,'error','','','','','','','','',2);
                          }
                      });
                  });
              });
          </script>

        <?php if(C('captcha_status_register') == '1') { ?>
        <dl>
          <dt><?php echo $lang['login_register_code'];?></dt>
          <dd style="min-height:54px;">
            <input type="text" id="captcha" name="captcha" class="text w50 fl tip" maxlength="4" size="10" title="<?php echo $lang['login_register_input_code'];?>" />
            <img src="index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>" title="" name="codeimage" border="0" id="codeimage" class="fl ml5"/> <a href="javascript:void(0)" class="ml5" onclick="javascript:document.getElementById('codeimage').src='index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><?php echo $lang['login_register_click_to_change_code'];?></a>
            <label></label>
          </dd>
        </dl>
        <?php } ?>
        <dl>
          <dt>&nbsp;</dt>
          <dd>
            <input type="button" id="regbutton" value="<?php echo $lang['login_register_regist_now'];?>" class="submit" title="<?php echo $lang['login_register_regist_now'];?>" />
            <input name="agree" type="checkbox" class="vm ml10" id="clause" value="1" checked="checked" />
            <span for="clause" class="ml5"><?php echo $lang['login_register_agreed'];?><a href="<?php echo urlShop('document', 'index',array('code'=>'agreement'));?>" target="_blank" class="agreement" title="<?php echo $lang['login_register_agreed'];?>"><?php echo $lang['login_register_agreement'];?></a></span>
            <label></label>
          </dd>
        </dl>
        <input type="hidden" value="<?php echo $_GET['ref_url']?>" name="ref_url">
        <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
        <input type="hidden" name="form_submit" value="ok" />
         <input type="hidden" value="<?php echo $_GET['zmr']?>" name="zmr">
      </form>
      <div class="clear"></div>
    </div>
    <div class="nc-login-bottom"></div>
  </div>
  <div class="nc-login-left">
    <h3><?php echo $lang['login_register_after_regist'];?></h3>
    <ol>
      <li class="ico05"><i></i><?php echo $lang['login_register_buy_info'];?></li>
      <li class="ico01"><i></i><?php echo $lang['login_register_openstore_info'];?></li>
      <li class="ico03"><i></i><?php echo $lang['login_register_sns_info'];?></li>
      <li class="ico02"><i></i><?php echo $lang['login_register_collect_info'];?></li>
      <li class="ico06"><i></i><?php echo $lang['login_register_talk_info'];?></li>
      <li class="ico04"><i></i><?php echo $lang['login_register_honest_info'];?></li>
      <div class="clear"></div>
    </ol>
    <h3 class="mt20"><?php echo $lang['login_register_already_have_account'];?></h3>
    <div class="nc-login-now mt10"><span class="ml20"><?php echo $lang['login_register_login_now_1'];?><a href="index.php?act=login&ref_url=<?php echo urlencode($output['ref_url']); ?>" title="<?php echo $lang['login_register_login_now'];?>" class="register"><?php echo $lang['login_register_login_now_2'];?></a></span><span><?php echo $lang['login_register_login_now_3'];?><!--a class="forget" href="index.php?act=login&op=forget_password"><?php echo $lang['login_register_login_forget'];?></a--></span></div>
  </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script> 
<script>
//注册表单提示
$('.tip').poshytip({
	className: 'tip-yellowsimple',
	showOn: 'focus',
	alignTo: 'target',
	alignX: 'center',
	alignY: 'top',
	offsetX: 0,
	offsetY: 5,
	allowTipHover: false
});

$(function(){$("#regbutton").click(function(){
    if($("#register_form").valid()){
		 var tprm = "userName="+$("#user_name").val();
		 __ozfac2(tprm,"#regSuccess");
		 setTimeout("",300);
		 $("#register_form").submit();
	}
	});
});

//注册表单验证
$(function(){
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[^:%,'\*\"\s\<\>\&]+$/i.test(value);
		}, "Letters only please"); 
		jQuery.validator.addMethod("lettersmin", function(value, element) {
			return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length>=3);
		}, "Letters min please"); 
		jQuery.validator.addMethod("lettersmax", function(value, element) {
			return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length<=15);
		}, "Letters max please");
        jQuery.validator.addMethod("mobile", function(value, element) {
            var length = value.length;
            var mobile = /^1[0-9]{10}$/;
            return this.optional(element) || (length == 11 && mobile.test(value));
        }, "<?php echo $lang['login_register_invalid_mobile'];?>");
    $("#register_form").validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd');
            error_td.find('label').hide();
			//if(error) alert($(".error").html());
            error_td.append(error);
        },
        onkeyup: false,
        rules : {
            user_name : {
                required : true,
                lettersmin : true,
                lettersmax : true,
                lettersonly : true,
                remote   : {
                    url :'index.php?act=login&op=check_member&column=ok',
                    type:'get',
                    data:{
                        user_name : function(){
                            return $('#user_name').val();
                        }
                    }
                }
            },
            password : {
                required : true,
                minlength: 6,
				maxlength: 20
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },

            mobile : {
                required : true,
                mobile : true,
                remote   : {
                    url : 'index.php?act=login&op=check_mobile',
                    type: 'get',
                    data:{
                        mobile : function(){
                            return $('#mobile').val();
                        }
                    }
                }
            },
			<?php if(C('captcha_status_register') == '1') { ?>
            captcha : {
                required : true,
                remote   : {
                    url : 'index.php?act=seccode&op=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    },
                    complete: function(data) {
                        if(data.responseText == 'false') {
                        	document.getElementById('codeimage').src='<?php echo SHOP_SITE_URL?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
                        }
                    }
                }
            },
			<?php } ?>
            agree : {
                required : true
            }
        },
        messages : {
            user_name : {
                required : '<?php echo $lang['login_register_input_username'];?>',
                lettersmin : '<?php echo $lang['login_register_username_range'];?>',
                lettersmax : '<?php echo $lang['login_register_username_range'];?>',
				lettersonly: '<?php echo $lang['login_register_username_lettersonly'];?>',
				remote	 : '<?php echo $lang['login_register_username_exists'];?>'
            },
            password  : {
                required : '<?php echo $lang['login_register_input_password'];?>',
                minlength: '<?php echo $lang['login_register_password_range'];?>',
				maxlength: '<?php echo $lang['login_register_password_range'];?>'
            },
            password_confirm : {
                required : '<?php echo $lang['login_register_input_password_again'];?>',
                equalTo  : '<?php echo $lang['login_register_password_not_same'];?>'
            },
            mobile : {
                required : '<?php echo $lang['login_register_input_mobile'];?>',
                mobile    : '<?php echo $lang['login_register_invalid_mobile'];?>',
                remote	 : '<?php echo $lang['login_register_mobile_exists'];?>'
            },
			<?php if(C('captcha_status_register') == '1') { ?>
            captcha : {
                required : '<?php echo $lang['login_register_input_text_in_image'];?>',
				remote	 : '<?php echo $lang['login_register_code_wrong'];?>'
            },
			<?php } ?>
            agree : {
                required : '<?php echo $lang['login_register_must_agree'];?>'
            }
        }
    });
    $("#yzmobile").change(function(){
        if($(this).is(':checked')){
            $("#yzm").rules("add", { required: true, messages: { required: "<?php echo $lang['login_register_yzmget'];?>"} });
            $('#zy_mobile').show();
        }else{
            $("#yzm").rules("remove");
            $('#zy_mobile').hide();
        }
    });
	
});
</script>