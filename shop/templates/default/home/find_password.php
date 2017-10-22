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
  <div class="left-pic"> <img src="<?php echo $output['lpic'];?>"  border="0"> </div>
  <div class="nc-login">
    <div class="nc-login-title">
      <h3><?php echo $lang['login_index_find_password'];?></h3>
    </div>
    <div class="nc-login-content" id="demo-form-site">
      <form action="index.php?act=login&op=find_password" method="POST" id="find_password_form">
        <?php Security::getToken();?>
        <input type="hidden" name="form_submit" value="ok" />
        <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
        <dl>
          <dt>用户名：</dt>
          <dd style="min-height:54px;">
            <input type="text" class="text" name="username"/>
            <label></label>
          </dd>
        </dl>
        <dl>
          <dt>手机号：</dt>
          <dd style="min-height:54px;">
            <input type="text" class="text" name="mobile"/>
            <label></label>
          </dd>
        </dl>
        <dl>
          <dt><?php echo $lang['login_register_code'];?></dt>
          <dd style="min-height:54px;">
            <input type="text" name="captcha" class="text w50 fl" id="captcha" maxlength="4" size="10" />
            <img src="index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>" title="<?php echo $lang['login_index_change_checkcode'];?>" name="codeimage" border="0" id="codeimage" class="fl ml5"> <a href="javascript:void(0);" class="ml5" onclick="javascript:document.getElementById('codeimage').src='index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><?php echo $lang['login_password_change_code']; ?></a>
            <label></label>
          </dd>
        </dl>
        <dl class="mb30">
          <dt></dt>
          <dd>
            <input type="button" class="submit" value="重置密码" name="Submit" id="Submit">
          </dd>
        </dl>
        <input type="hidden" value="<?php echo $output['ref_url']?>" name="ref_url">
      </form>
    </div>
    <div class="nc-login-bottom"></div>
  </div>
</div>
<script type="text/javascript">
$(function(){
    $('#Submit').click(function(){
        if($("#find_password_form").valid()){
        	ajaxpost('find_password_form', '', '', 'onerror');
        } else{
        	document.getElementById('codeimage').src='<?php echo SHOP_SITE_URL?>/index.php?act=seccode&op=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
        }
    });
    jQuery.validator.addMethod("isMobile", function(value, element) {
        var length = value.length;
        return this.optional(element) || (length == 11 && /^((1[3-9][0-9])+\d{8})$/.test(value));
    }, "请正确填写您的手机号码。");
    $('#find_password_form').validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd');
            error_td.find('label').hide();
            error_td.append(error);
        },
        rules : {
            username : {
                required : true
            },
            mobile : {
                required : true,
                isMobile : true
            },
            captcha : {
                required : true,
                minlength: 4,
                remote   : {
                    url : 'index.php?act=seccode&op=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    }
                }
            } 
        },
        messages : {
            username : {
                required : '<?php echo $lang['login_usersave_login_usersave_username_isnull'];?>'
            },
            mobile  : {
                required : '手机号必填',
                isMobile : '请输入正确的手机号'
            },
            captcha : {
                required : '<?php echo $lang['login_usersave_code_isnull']	;?>',
                minlength : '<?php echo $lang['login_usersave_wrong_code'];?>',
                remote   : '<?php echo $lang['login_usersave_wrong_code'];?>'
            }
        }
    });
});
</script> 
