<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php

require_once template('header');

require_once($tpl_file);
?>

<?php if(!$output['no_member_footer']){ ?>

<div class="footer-top">
    <div class="footer-tleft">
        <a class="btn mr5" href="<?php echo urlWap('member','home');?>">个人中心</a>
        <a class="btn mr5" id="logoutbtn" href="<?php echo urlWap('login','login_out');?>">注销</a>
    </div>
    <a href="javascript:void(0);" class="gotop">
        <p>返回顶部</p>
        <span class="gotop-icon"></span>
    </a>
</div>

<?php }?>


<script>
    $(".gotop").click(function (){
        $(window).scrollTop(0);
    });
</script>

<?php
require_once template('footer');
?>

