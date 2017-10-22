<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">


<div class="cart-list-wp">
    <div id="cart-list-wp">
        <?php if(!empty($output['cart_list'])){ ?>
        <ul class="cart-list">
            <?php foreach ($output['cart_list'] as $k=>$cart) { ?>
                <li class="cart-list-item">
                    <div class="cart-shop-name">
                        店铺名称：<?php echo $cart['store_name']?>
                    </div>
                    <div class="cart-litem-wp clearfix">
                        <a class="cart-litemw-imgwp" href="<?php echo urlWap('goods','index',array('goods_id'=>$cart['goods_id']))?>">
                            <img src="<?php echo $cart['goods_image_url']?>">
                        </a>
                        <div class="cart-litemw-cnt" cart_id="<?php echo $cart['cart_id']?>">
                            <a class="cart-litemwc-pdname" href="<?php echo urlWap('goods','index',array('goods_id'=>$cart['goods_id']))?>">
                                <?php echo $cart['goods_name']?>
                            </a>
                           
							 <?php if (!empty($cart['xianshi_info'])) {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">满<strong><?php echo $cart['xianshi_info']['lower_limit'];?></strong>件，单价直降<em>￥<?php echo $cart['xianshi_info']['down_price']; ?></em></span></p>
                                <?php }?>
                                <?php if ($cart['ifgroupbuy']) {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">藏品惠</span></p>
                                <?php }?>
                            <!-- add 秒杀模块 xin -->
                            <?php if ($cart['ifmiaosha']) {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">秒杀</span></p>
                            <?php }?>
                            <!-- add 会员特价模块 xin -->
                            <?php if ($cart['ifvipsale']) {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">会员特价</span></p>
                            <?php }?>
                            <!-- add end -->
                            <!-- add 满即送 xin -->
                            <?php if ($cart['manjisong']) {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">满即送活动商品</span></p>
                            <?php }?>
                            <!-- add end -->
                            <?php if ($cart['bl_id'] != '0') {?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">优惠套装，单套直降<em>￥<?php echo $cart['down_price']; ?></em></span></p>
                            <?php if (!empty($cart['bl_goods_list'])) { ?>
                                <?php foreach ($cart['bl_goods_list'] as $goods_info) { ?>
                            <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">套装商品</span>
                                    <a href="<?php echo urlWap('goods','index',array('goods_id'=>$goods_info['bl_goods_id']));?>" title="套装：<?php echo $goods_info['goods_name']; ?>"><img src="<?php echo cthumb($goods_info['goods_image'],60,$store_id);?>" height="20px"/><?php echo $goods_info['goods_name']?> </a>
                                <?php } ?>
                            <?php }?>
                             <?php  } ?>
                            </p>
                            <?php if (!empty($cart['gift_list'])) { ?>
                                <p><span style="color: #FFF;background-color: #FD6760;padding: 1px 4px;">赠</span>
                                        <?php foreach ($cart['gift_list'] as $goods_info) { ?>
                                            <a href="<?php echo urlWap('goods','index',array('goods_id'=>$goods_info['gift_goodsid']));?>" title="赠品：<?php echo $goods_info['gift_goodsname']; ?> * <?php echo $goods_info['gift_amount'] * $cart['goods_num']; ?>"><img src="<?php echo cthumb($goods_info['gift_goodsimage'],60,$store_id);?>" height="20px"/> * <?php echo $goods_info['gift_amount'] * $cart['goods_num']; ?></a>
                                        <?php } ?>
                                </p>
                            <?php  } ?>
							
							 <p class="mt5">
                                商品单价：￥<?php echo $cart['goods_price']?>
                            </p>
                            <p class="mt5">
                                商品总价：￥<span class="goods-total-price"><?php echo $cart['goods_sum']?></span>
                            </p>
                            <p class="cart-litemwc-pdcount clearfix mt5">
                                        <span class="minus-wp fleft">
                                            <span class="i-minus"></span>
                                        </span>
                                <input type="text" class="buy-num buynum fleft" value="<?php echo $cart['goods_num']?>">
                                        <span class="add-wp fleft">
                                            <span class="i-add"></span>
                                        </span>
                            </p>
                        </div>
                    </div>
                            <span class="cart-list-del" cart_id="<?php echo $cart['cart_id']?>">
                                <span class="i-del"></span>
                            </span>
                </li>
            <?php } ?>


            <li class="cart-list-oitem mt10">
                商品总金额：<span class="clr-d94 total_price">￥<?php echo $output['sum']?></span>
            </li>
            <li>
                <a href="javascript:void(0)" class="goto-settlement mt10">去结算</a>
            </li>
            <li>
                <a href="<?php echo urlWap('goods','goods_list')?>" class="goto-shopping mt10">去逛逛</a>
            </li>
        </ul>
        <?php }else{ ?>
        <div class="no-record m10">
            暂无记录
        </div>
        <?php } ?>
    </div>
</div>
<script>
    $(function (){
        $(".cart-list-del").click(function(){
            var cart_id = $(this).attr("cart_id");
            $.ajax({
                url:"<?php echo urlWap('member_cart','cart_del')?>",
                type:"post",
                data:{cart_id:cart_id},
                dataType:"json",
                success:function (res){
                    if(!res.datas.error && res.datas == "1"){
                        alert("删除商品成功");
                        location.reload();
                    }else{
                        alert(res.datas.error);
                    }
                }
            });
        });
        $(".add-wp").click(function(){
            editQuantity(this,"add");
        });
        $(".minus-wp").click(function(){
            editQuantity(this,"minus");
        });
        $(".goto-settlement").click(function(){
            //购物车ID
            var cartIdArr = [];
            var cartIdEl = $(".cart-litemw-cnt");
            for(var i = 0;i<cartIdEl.length;i++){
                var cartId = $(cartIdEl[i]).attr("cart_id");
                var cartNum = parseInt($(cartIdEl[i]).find(".buy-num").val());
                var cartIdNum = cartId+"|"+cartNum;
                cartIdArr.push(cartIdNum);
            }
            var cart_id = cartIdArr.toString();
            location.href = "<?php echo urlWap('member_buy','buy_step1',array('ifcart'=>'1'))?>&cart_id=" + cart_id;
        });
        function editQuantity(self,type){
            var sPrents = $(self).parents(".cart-litemw-cnt")
            var cart_id = sPrents.attr("cart_id");
            var numInput = sPrents.find(".buy-num");
            var buynum = parseInt(numInput.val());
            var quantity = 1;
            if(type == "add"){
                quantity = parseInt(buynum+1);
                //
            }else {
                if(buynum >1){
                    quantity = parseInt(buynum-1);
                }else {
                    alert("购买数目必须大于1");
                    return;
                }
            }
            $.ajax({
                url:"<?php echo urlWap('member_cart','cart_edit_quantity')?>",
                type:"post",
                data:{cart_id:cart_id,quantity:quantity},
                dataType:"json",
                success:function (res){
                    if(!res.datas.error){
                        numInput.val(quantity);
                        sPrents.find(".goods-total-price").html(res.datas.total_price);
                        var goodsTotal = $(".goods-total-price");
                        var totalPrice = parseFloat("0.00");
                        for(var i = 0;i<goodsTotal.length;i++){
                            totalPrice += parseFloat($(goodsTotal[i]).html());
                        }
                        $(".total_price").html("￥"+totalPrice.toFixed(2));
                    }else{
                        alert(res.datas.error);
                    }
                }
            });
        }

    })

</script>