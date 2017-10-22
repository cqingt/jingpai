<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<ul class="voucher-tab">
  <li> <a <?php if(!$_GET['voucher_state']){echo 'class="current"';}?> href="<?php echo urlWap('member_voucher','voucher_list');?>">未使用</a> </li>
  <li> <a <?php if($_GET['voucher_state'] == 2){echo 'class="current"';}?> href="<?php echo urlWap('member_voucher','voucher_list',array('voucher_state'=>2));?>">已使用</a> </li>
  <li> <a <?php if($_GET['voucher_state'] == 3){echo 'class="current"';}?> href="<?php echo urlWap('member_voucher','voucher_list',array('voucher_state'=>3));?>">已过期</a> </li>
</ul>


<div class="voucher-list-wp" id="voucher-list">

    <div class="voucher-list">

<?php if($output['voucher_list']){?>
    <?php foreach($output['voucher_list'] as $k => $v){?>
    <div class="voucher-item">
        <div class="voucher-img-wrapper">
            <img alt="" src="<?php echo $v['voucher_t_customimg'];?>">
        </div>
        <dl class="voucher-info"><dt class="voucher-title"><?php echo $v['voucher_title'];?></dt>
        <dd>
            <span class="voucher-money">￥<?php echo $v['voucher_price'];?></span>
            <?php if($v['voucher_limit']){?>
            （购物满<?php echo $v['voucher_limit'];?>元可用）
            <?php }?>
        </dd>
        <dd>店铺：<?php echo $v['store_name'];?></dd>
        <dd>有效期至：<?php echo date('Y年m月d日',$v['voucher_end_date']);?></dd>
        </dl>
    </div>
    <?php }?>


<?php echo $output['page']?>

<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>

    </div>
</div>