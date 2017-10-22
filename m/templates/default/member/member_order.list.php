<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<!-- 订单内容 -->

<div class="order-list-wp" id="order-list">

    <div class="order-list">
          


<?php if($output['order_group_list']){?>
<ul>
    
    <?php foreach($output['order_group_list']['order_group_list'] as $listk => $listv){?>

    <li class="<?php 
    if($listv['pay_amount']){echo 'green-order-skin';}else{echo 'gray-order-skin';}
    if($listk >= 1){echo ' mt10';}
    ?>">

    <div class="order-ltlt">
        <p>
            下单时间：<?php echo date('Y年m月d日 H:i',$listv['add_time']);?>
        </p>
    </div>
                


    <?php foreach($listv['order_list'] as $k => $v){?>
    <div class="order-lcnt">
        <div class="order-lcnt-shop">
            <p>店铺名称：<?php echo $v['store_name'];?></p>
            <p>订单编号：<?php echo $v['order_sn'];?></p>
        </div>




        <div class="order-shop-pd">

            <?php foreach($v['extend_order_goods'] as $goodsk => $goodsv){?>
                <?php if($goodsv['payment_code'] == 'bank'){ $can_bank = true;}?>
            
            <a class="order-ldetail clearfix <?php if($goodsk > 0){echo 'bd-t-de';}?>" href="<?php echo urlWap('goods','index',array('goods_id'=>$goodsv['goods_id']));?>">
                <span class="order-pdpic">
                    <img src="<?php echo $goodsv['goods_image_url'];?>">
                </span>
                <div class="order-pdinfor">
                    <p><?php echo $goodsv['goods_name'];?></p>
                    <p>
                        单价：<span class="clr-d94">￥<?php echo $goodsv['goods_price'];?></span>
                    </p>
                     <p>
                        商品数目：<?php echo $goodsv['goods_num'];?>
                    </p>
                </div>
            </a>

            <?php }?>
            
        </div>

        <div class="order-shop-total">
            <p><?php if($v['extend_order_common']['e_name']){ ?><span>物流信息：<?php echo $v['extend_order_common']['e_name'];?> 物流单号：<?php echo $v['shipping_code'];?></span><?php }?></p>运费：<span class="clr-d94">￥<?php echo $v['shipping_fee'];?></span></p>
            <p class="clr-c07">合计：￥<?php echo $v['order_amount'];?></p>
            <p class="mt5">
                <span class="<?php 
                    if($v['order_state'] == 20 || $v['order_state'] == 30 || $v['order_state'] == 40){
                        echo  'ot-finish';
                    }else if($v['order_state'] == 0) {
                        echo  "ot-cancel";
                    }else {
                        echo  "ot-nofinish";
                    }
                ?>"><?php echo $v['state_desc'];?></span>
            </p>
            <p class="mt5">

                <?php if($v['if_receive']){?>
                <a href="javascript:void(0)" order_id="<?php echo $v['order_id'];?>" id="sure_order" class="sure-order">确认收货</a>
                <?php }?>

                <?php if($v['if_cancel']){?>
                <a href="javascript:void(0)" order_id="<?php echo $v['order_id'];?>" class="cancel-order">取消订单</a>
                <?php }?>

				
                <a href="<?php echo urlWap('member_order','show_order',array('order_id'=>$v['order_id']));?>" class="sure-order" style="    background: #6cb248;">订单详情</a>

            </p>
        </div>

    </div>

    <?php }?>

        <?php if($can_bank && $listv['pay_amount'] && $listv['pay_amount']>0){?>
            <a class="l-btn-login check-payment" href="<?php echo urlWap('member_payment','payment_bank',array('pay_sn'=>$listv['pay_sn']));?>">银行转账支付（￥<?php echo $listv['pay_amount'];?>）</a>
        <?php }elseif($listv['pay_amount'] && $listv['pay_amount']>0 && count($output['order_group_list']['payment_list'])>0){ ?>

                <a class="l-btn-login check-payment" href="<?php echo urlWap('member_buy','pay',array('pay_sn'=>$listv['pay_sn']));?>">订单支付（￥<?php echo $listv['pay_amount'];?>）</a>

            <?php }?>
            
        </li>
    <?php }?>
</ul>


<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>


<?php echo $output['page'];?>


    
    </div>

</div>

<!-- 内容End -->


<script>
    $("#sure_order").click(function(){
        var orderid = $(this).attr('order_id');
        if(confirm("确定要执行此操作?")){
            var url = "<?php echo urlWap('member_order','order_receive',array('order_id'=>''))?>";
            window.location.href=url+orderid;
        }
    });

    $(".cancel-order").click(function(){
        var orderid = $(this).attr('order_id');
        if(confirm("确定要取消订单?")){
            var url = "<?php echo urlWap('member_order','order_cancel',array('order_id'=>''))?>";
            window.location.href=url+orderid;
        }

    });
</script>