<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">


<div class="content">
    <div class="categroy-cnt" id="categroy-cnt">

<?php if($output['store_list']){?>
    <ul class="categroy-list">
        
        <?php foreach($output['store_list'] as $k => $v){?>
        <li class="category-item">
            <a href="<?php echo urlWap('member_store','store_info',array('store_id'=>$v['store_id']));?>" class="category-item-a">
                <div class="ci-fcategory-name"><?php echo $v['store_name'];?></div>
                <div class="ci-fcategory-text"><?php echo $v['store_address'];?></div>
                <span class="grayrightarrow"></span>
            </a>
        </li>
        <?php }?>

    </ul>

<?php echo $output['page'];?>

<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>
    </div>
    

            
            
</div>