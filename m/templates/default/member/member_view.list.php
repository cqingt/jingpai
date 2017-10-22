<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<div class="views-list">

<?php if($output['goods_list']){?>
    <ul id="viewlist">
    <?php foreach($output['goods_list'] as $k => $v){?>
        <li>
            <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" class="mf-item clearfix">
                <span class="mf-pic">
                    <img src="<?php echo $v['goods_image_url'];?>">
                </span>
                <div class="mf-infor">
                    <p class="mf-pd-name"><?php echo $v['goods_name'];?></p>
                    <p class="mf-pd-price"><?php if($v['promotion_price'] > 0){ ?>￥<?php echo $v['promotion_price'];?><?php }else{ ?>￥<?php echo $v['goods_price'];?><?php } ?></p>
                </div>
            </a>
        </li>
    <?php }?>
    </ul>

<?php echo $output['page'];?>

<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>
</div>