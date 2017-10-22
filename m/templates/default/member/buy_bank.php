<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">


<div class="cart-list-wp">
    <div id="cart-list-wp">
        <div class="no-record m10">
            <?php echo htmlspecialchars_decode($output['payment_bank']['bank_content']);?>
        </div>
    </div>
</div>
