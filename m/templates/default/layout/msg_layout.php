<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php require_once template('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css"> -->
<style>
.hint {
    text-align: center;
    margin: 20px 0;
}
.hint p {
    font-weight: bold;
    font-size: 14px;
    line-height: 22px;
}
.hint a {
    display: block;
    font-size: 16px;
    line-height: 22px;
}
.error{
	color:red;
}
.succ{
	color:rgb(0, 110, 1);
}
</style>


<div class="hint">
      <?php if($output['msg_type'] == 'error'){ ?>
		<p class="error"><?php require_once($tpl_file);?></p>
      <?php }else { ?>
		<p class="succ"><?php require_once($tpl_file);?></p>
      <?php } ?>
</div>







<script type="text/javascript">
<?php if (!empty($output['url'])){
?>
	window.setTimeout("javascript:location.href='<?php echo $output['url'];?>'", <?php echo $time;?>);
<?php
}else{
?>
	window.setTimeout("javascript:history.back()", <?php echo $time;?>);
<?php
}?>
</script>


<?php
require_once template('footer');
?>
