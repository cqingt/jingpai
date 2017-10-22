<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<!-- 订单内容 -->

<div class="order-list-wp" id="order-list">

    <div class="order-list">
          


<?php if($output['order_list']){?>
<ul>
    
    <?php foreach($output['order_list'] as $listk => $listv){?>

    <li class="<?php 
    if($listv['point_orderstate'] == 10){echo 'green-order-skin';}else{echo 'gray-order-skin';}
    ?>">

    <div class="order-ltlt">
        <p>
            下单时间：<?php echo date('Y年m月d日 H:i',$listv['point_addtime']);?>
        </p>
    </div>
                


    <div class="order-lcnt">
        <div class="order-lcnt-shop">
            <p>订单编号：<?php echo $listv['point_ordersn'];?></p>
        </div>


<?php foreach($listv['prodlist'] as $gk => $gv){?>

        <div class="order-shop-pd">

            
            <a class="order-ldetail clearfix <?php if($gk > 0){echo 'bd-t-de';}?>" href="<?php echo urlWap('vip','integral_goods',array('goods_id'=>$gv['point_goodsid']));?>">
                <span class="order-pdpic">
                    <img src="<?php echo $gv['point_goodsimage'];?>">
                </span>
                <div class="order-pdinfor">
                    <p><?php echo $gv['point_goodsname'];?></p>
                    <p>
                        兑换积分：<span class="clr-d94"><?php echo $gv['point_goodspoints'];?></span>
                    </p>
                     <p>
                        商品数目：<?php echo 1;?>
                    </p>
                </div>
            </a>

            
        </div>

<?php }?>


        <div class="order-shop-total">
            <p>兑换总积分：<span class="clr-d94">￥<?php echo $listv['point_allpoint'];?></span></p>
            <p class="mt5">
                <span class="<?php 
                    if($listv['point_orderstate'] == 20 || $listv['point_orderstate'] == 30 || $listv['point_orderstate'] == 40){
                        echo  'ot-finish';
                    }else if($listv['point_orderstate'] == 0) {
                        echo  "ot-cancel";
                    }else {
                        echo  "ot-nofinish";
                    }
                ?>"><?php 
                    if($listv['point_orderstate'] == 2){
                        echo "已取消";
                    }
                    if($listv['point_orderstate'] == 20){
                        echo "待发货";
                    }
                    if($listv['point_orderstate'] == 30){
                        echo "已发货";
                    }
                    if($listv['point_orderstate'] == 40){
                        echo "已收货";
                    }
                    if($listv['point_orderstate'] == 50){
                        echo "交易完成";
                    }

                ?></span>
            </p>

            <p class="mt5">
                <!--
                <?php if($listv['point_orderstate'] != 2){?>
                <a href="<?php echo urlWap('member_integral','del_order',array('order_id'=>$listv['point_orderid']));?>"  class="cancel-order">取消订单</a>
                <?php }?>
				-->

            </p>

        </div>

    </div>
    


            
        </li>
    <?php }?>
</ul>


<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>


<?php echo $output['show_page'];?>


    
    </div>

</div>

<!-- 内容End -->


<script>
    $(".sure-order").click(function(){
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