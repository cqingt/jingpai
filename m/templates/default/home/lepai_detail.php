<?php defined('InShopNC') or exit('Access Invalid!');?>
<style>
    .pddetail-cnt .fixed-tab-pannel img{width: 100%}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<div class="content">
    <div class="pddetail-cnt">
        <div class="pd-detail-tab">
            <ul class="product-infor">
                <li class="current">
                    <a href="javascript:history.back();">返回商品</a>
                </li>
            </ul>
            <div id="fixed-tab-pannel" style="padding-left: 5px;margin-top:30px;padding-right: 5px">
                <?php// print_r($output['goods_common_info']);die;?>
                <div class="fixed-tab-pannel"><?php echo $output['goods_common_info']['goods_body'];?></div>
            </div>
        </div>
    </div>
</div>
