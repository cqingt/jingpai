<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<div class="address-list" id="address_list">

<?php if($output['address_list']){?>
    <ul>
        <?php foreach($output['address_list'] as $k => $v){?>
        <li>
            <p class="madr-tlt clearfix">
                <span class="madrt-name"><?php echo $v['true_name'];?></span>
                <span class="madrt-phone"><?php echo $v['mob_phone'];?></span>
                <span class="madrt-type fright"></span>
            </p>
            <div class="madr-cnt">
                <p><?php echo $v['area_info'];?>&nbsp;<?php echo $v['address'];?></p>
                <p class="madrc-opera">
                    <a href="<?php echo urlWap('member_ress','ress_info',array('address_id'=>$v['address_id']));?>">编辑</a>&nbsp;|
                    <a href="<?php echo urlWap('member_ress','address_del',array('address_id'=>$v['address_id']));?>" class="deladdress">删除</a>
                </p>
            </div>
        </li>
        <?php }?>
    </ul>
<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>
    
    <a class="add_address mt10" href="<?php echo urlWap('member_ress','ress_add')?>">添加新地址</a>

</div>