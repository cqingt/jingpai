<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/navigation.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />

<!-- add -->
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/paimaihui_pm.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo_pm.css" />
<!-- add end -->


<section>

  <ul class="mebzj investment_title">

    <li><a href="<?php echo urlWap('member_predeposit','index',array('type'=>1));?>">账户余额</a></li>

    <li><a href="<?php echo urlWap('member_predeposit','index',array('type'=>2));?>">充值明细</a></li>

    <li><a href="<?php echo urlWap('member_predeposit','index',array('type'=>3));?>">提现明细</a></li>

  </ul>  


  <div class="investment_con mb">

<?php if($output['type'] == 1){?>
    <div class="box">

      <div class="demo-btnword">
        <p>可用金额：<em class="h"><?php echo $output['member_info']['available_predeposit'];?></em>元</p>
        <div class="ui-wrap-btn">
          <a class="btn btn-orange" href="<?php echo urlWap('member_pay','index');?>">在线充值</a>
          <a class="btn btn-green" href="<?php echo urlWap('member_predeposit','tixian');?>">申请提现</a>
        </div>
        <p>冻结金额：<em class="l"><?php echo $output['member_info']['freeze_predeposit'];?></em>元</p>
      </div>
  <?php if(!empty($output['list'])){?>

    <?php foreach ($output['list'] as $k => $v){?>
      <div class="demo-item">
        <div class="ui-text">
          <p>创建时间：<?php echo date('Y-m-d H:i:s',$v['lg_add_time']);?></p>
          <p>收入：<?php echo ($v['lg_av_amount']>1)?'+'.$v['lg_av_amount']:'';?></p>
          <p>支出：<?php echo ($v['lg_av_amount']<1)?$v['lg_av_amount']:'';?></p>
          <p>冻结：<?php echo $v['lg_freeze_amount'];?></p>
          <p>变更说明：<?php echo $v['lg_desc'];?></p>
          <!-- <p>活动编号：50</p> -->
        </div>
      </div>
    <?php }?>
  <?php }?>

    </div>
<?php }?>


<?php if($output['type'] == 2){?>
    <div class="box">
      <div class="demo-btnword">
        <p class="mt14">可用金额：<em class="h"><?php echo $output['member_info']['available_predeposit'];?></em>元<a class="btn fd btn-orange" href="<?php echo urlWap('member_pay','index');?>">在线充值</a></p>
        <p class="mt14">冻结金额：<em class="l"><?php echo $output['member_info']['freeze_predeposit'];?></em>元</p>
      </div>

  <?php if(!empty($output['list'])){?>
    <?php foreach ($output['list'] as $k => $v){?>

      <div class="demo-item">
        <div class="ui-text">
          <p>充值单号：<?php echo $v['pdr_sn'];?></p>
          <p>创建时间：<?php echo date('Y-m-d H:i:s',$v['pdr_add_time']);?></p>
          <p>支付方式：<?php echo orderPaymentName($v['pdr_payment_code']);?></p>
          <p>充值金额：+680.00</p>
          <p>状  态：  <?php echo ($v['pdr_payment_state'] == 1)?'已支付':'未支付';?></p>
        </div>
        <?php if($v['pdr_payment_state'] < 1){?>
        <div class="ui-bottom-btn">
          <a class="btn btn-ot" href="<?php echo urlWap('member_predeposit','recharge_del',array('id'=>$v['pdr_id']));?>">删除</a>
          <a class="btn btn-red" href="<?php echo urlWap('member_payment','pd_order',array('pdr_sn'=>$v['pdr_sn'],'payment_code'=>$v['pdr_payment_code']));?>">支付</a>
        </div>
        <?php }?>

      </div>

    <?php }?>
  <?php }?>


    </div>
<?php }?>


<?php if($output['type'] == 3){?>

    <div class="box">
      <div class="demo-btnword">
        <p class="mt14">可用金额：<em class="h"><?php echo $output['member_info']['available_predeposit'];?></em>元<a class="btn fd btn-orange" href="<?php echo urlWap('member_pay','index');?>">在线充值</a></p>
        <p class="mt14">冻结金额：<em class="l"><?php echo $output['member_info']['freeze_predeposit'];?></em>元</p>
      </div>
  <?php if(!empty($output['list'])){?>

    <?php foreach ($output['list'] as $k => $v){?>

      <div class="demo-item">
        <div class="ui-text">
          <p>申请单号：     <?php echo $v['pdc_sn'];?></p>
          <p>申请时间：     <?php echo date('Y-m-d H:i:s',$v['pdc_add_time']);?></p>
          <p>提现金额(元)：<?php echo $v['pdc_amount'];?></p>
          <p>状态：：         <?php echo $v['pdc_payment_state']?'已完成':未完成;?></p>
        </div>
      </div>

    <?php }?>
  <?php }?>

          
    </div>

<?php }?>

      <?php echo $output['show_page'];?>

  </div>

</section>