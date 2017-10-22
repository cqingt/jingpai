<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php require CMS_BASE_TPL_PATH.'/layout/top.php';?>
<?php require CMS_BASE_TPL_PATH.'/layout/nav.php';?>
<div class="pt20">
    <?php require_once($tpl_file);?>
</div>

<?php require BASE_ROOT_PATH."/shop/templates/default/footer.php";?>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
