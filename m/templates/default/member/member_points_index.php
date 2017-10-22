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

    <ul class="tabnav investment_title">

    <li><a href="<?php echo urlWap('member_points','index',array('type'=>1));?>">积分明细</a></li>

    <li><a href="<?php echo urlWap('member_points','index',array('type'=>2));?>">兑换记录</a></li>

    </ul>

    <div class="tabboxes investment_con">

<?php if($output['type'] == 1){?>

        <div class="on" class="box">
            <div class="ui-hint">
                <h2>积分获得规则：</h2>
                <p>成功注册会员：增加0积分；会员每天登录：增加0积分；评价完成订单：增加0积分。</p>
                <p>购物并付款成功后将获得订单总价100%（最高限额不超过9999999）积分。</p>
                <p>如订单发生退款、退货等问题时，积分将不予退还。</p>
            </div>

  <?php if(!empty($output['list'])){?>

    <?php foreach ($output['list'] as $k => $v){?>

            <div class="ui-text">
                <p>积分总数：<em><?php echo $output['member_info']['member_points'];?></em></p>
                <p>添加时间：<?php echo date('Y-m-d H:i:s',$v['pl_addtime']);?></p>
                <p>积分变更：<?php echo $v['pl_points'];?></p>
                <!-- <p>状态：      已完成</p> -->
                <p>描述：      <?php echo $v['pl_desc'];?></p>
            </div>

    <?php }?>
  <?php }?>

        </div>

<?php }?>

<?php if($output['type'] == 2){?>

        <div class="box">
            <div class="ui-hint">
                <h2>温馨提示：</h2>
                <p>您兑换的礼品将于礼品兑换订单生成后7个工作日内安排发货，具体发货进度您可通过兑换订单详情查看。</p>
            </div>

  <?php if(!empty($output['list'])){?>
    <?php foreach ($output['list'] as $k => $v){?>

            <div class="ui-text">
                <p>礼品信息：<?php echo $v['prodlist']['0']['point_goodsname'];?></p>
                <p>积分：<?php echo $v['point_allpoint']; ?></p>
                <p>数量：<?php echo $v['prodlist']['0']['point_goodsnum'];?></p>
                <p>合计(积分)：<?php echo $v['point_allpoint']; ?></p>
                <p>交易状态：<?php echo $v['point_orderstatetext']; ?></p>
                <!-- <p>交易操作:</p> -->
            </div>

    <?php }?>
  <?php }?>

        </div>

<?php }?>


<?php echo $output['show_page'];?>


    </div>


</section>