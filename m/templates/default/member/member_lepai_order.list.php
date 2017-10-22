<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<!-- 订单内容 -->

<div class="order-list-wp" id="order-list">

    <div class="order-list">
          


<?php if($output['user_orders']){?>
<ul>
    
    <?php foreach($output['user_orders'] as $listk => $listv){?>

    <li class="<?php 
    if($listv['order_state'] == 10){echo 'green-order-skin';}else{echo 'gray-order-skin';}
    ?>">

    <div class="order-ltlt">
        <p>
            下单时间：<?php echo date('Y年m月d日 H:i',$listv['add_time']);?>
        </p>
    </div>
                


    <div class="order-lcnt">
        <div class="order-lcnt-shop">
            <p>订单编号：<?php echo $v['order_sn'];?></p>
        </div>




        <div class="order-shop-pd">

            
            <a class="order-ldetail clearfix <?php if($goodsk > 0){echo 'bd-t-de';}?>" href="<?php echo urlWap('lepai','auction',array('id'=>$listv['goods_info']['G_Id']));?>">
                <span class="order-pdpic">
                    <img src="<?php echo BASE_SITE_URL.$listv['goods_info']['G_MainImg'];?>">
                </span>
                <div class="order-pdinfor">
                    <p><?php echo $listv['goods_info']['G_Name'];?></p>
                    <p>
                        单价：<span class="clr-d94">￥<?php echo $listv['order_amount'];?></span>
                    </p>
                     <p>
                        商品数目：<?php echo 1;?>
                    </p>
                </div>
            </a>

            
        </div>

        <div class="order-shop-total">
            <p><?php if($v['e_name']){ ?><span style="padding-right: 70%;">物流信息：<?php echo $v['e_name'];?> 物流单号：<?php echo $v['shipping_code'];?></span><?php }?></p>
            <p class="clr-c07">合计：￥<?php echo $listv['order_amount'];?></p>
            <p class="mt5">
                <span class="<?php 
                    if($listv['order_state'] == 20 || $listv['order_state'] == 30 || $listv['order_state'] == 40){
                        echo  'ot-finish';
                    }else if($listv['order_state'] == 0) {
                        echo  "ot-cancel";
                    }else {
                        echo  "ot-nofinish";
                    }
                ?>"><?php 
                    if($listv['order_state'] == 0){
                        echo "已取消";
                    }
                    if($listv['order_state'] == 10){
                        echo "待付款";
                    }
                    if($listv['order_state'] == 20){
                        echo "待发货";
                    }
                    if($listv['order_state'] == 30){
                        echo "待收货";
                    }
                    if($listv['order_state'] == 40){
                        echo "交易完成";
                    }

                ?></span>
            </p>
            <p class="mt5">

                <?php if($listv['order_state'] == 10){?>
                <a href="<?php echo urlWap('member_buy','lepaiOrder',array('order_sn'=>$listv[order_sn]));?>"  class="sure-order">确认订单</a>
                <?php }?>
                
                <?php if($listv['order_state'] == 10){?>
                <a href="javascript:;" order_id="<?php echo $listv[order_id];?>"  class="cancel-order">取消订单</a>
                <?php }?>

                <?php if($listv['order_state'] == 30){?>
                <a href="javascript:;" order_id="<?php echo $listv[order_id];?>"  class="confirm-order">确认订单</a>
                <?php }?>

            </p>
        </div>

    </div>
    

            <?php if($listv['order_state'] == 10 && $listv['reciver_info'] && count($output['payment_list'])>0){?>
                <?php foreach($output['payment_list'] as $payk => $payv){?>
                <a class="l-btn-login check-payment" href="<?php echo urlWap('member_payment','lepai_order',array('pay_sn'=>$listv['pay_sn'],'payment_code'=>$payv['payment_code']));?>"><?php echo $payv['payment_name'];?>（￥<?php echo $listv['order_amount'];?>）</a><br>
                <?php }?>

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
    // $(".sure-order").click(function(){
    //     var orderid = $(this).attr('order_id');
    //     if(confirm("确定要执行此操作?")){
    //         var url = "<?php echo urlWap('member_buy','lepaiOrder',array('order_id'=>''))?>";
    //         window.location.href=url+orderid;
    //     }
    // });

    $(".cancel-order").click(function(){
        var orderid = $(this).attr('order_id');
        if(confirm("确定要取消订单?")){
            var url = "<?php echo urlWap('member_lepai','order_cancel',array('order_id'=>''))?>";
            window.location.href=url+orderid;
        }

    });

    $(".confirm-order").click(function(){
        var orderid = $(this).attr('order_id');
        if(confirm("确定要确认订单?")){
            var url = "<?php echo urlWap('member_lepai','order_confirm',array('order_id'=>''))?>";
            window.location.href=url+orderid;
        }

    });
</script>