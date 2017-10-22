<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php if($output['YiShu']){ ?>
<?php require_once template('layout/common_artist_layout');?>
<?php }else{ ?>
<?php include template('layout/common_layout');?>
<?php include template('layout/cur_local');?>
<?php } ?>
<?php require_once($tpl_file);?>

<?php
    if(!$output['nofooter']){
        require_once template('footer');
    }
?>

</body>
</html>
