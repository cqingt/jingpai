<link rel="stylesheet" type="text/css" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161026/css/main.css"/>

<div class="img-photo1"></div>
<div class="img-photo2"></div>
<div class="img-photo3"></div>
<div class="img-photo4"></div>
<div class="img-photo5">
	<div class="m-wrap">
		<div class="msdemo">
			<div class="con">
				<h2><?php echo $output['t_1'];?></h2>
				<p><?php echo $output['t_2'];?></p>
			</div>
			<i></i>
		</div>
        <?php if($output['t_3']){?>
		<a class="btn-go2" href="javascript:void(0);" nctype="addblcart_hb"></a>
        <?php }else{?>
        <a class="btn-go1" href="javascript:void(0);" nctype="addblcart_false"></a>
        <?php }?>
	</div>
</div>
<div class="img-photo6"></div>
<div class="img-photo7">
	<div class="m-wrap">
		<a class="btn-db" href="javascript:void(0);" nctype="addblcart_submit" bl_id="24"></a>
	</div>
</div>


<div class="img-photo8">
	<div class="m-wrap">
		<ul class="photo-list">

<?php if(!empty($output['goods_list_bao'])){?>
    <?php foreach($output['goods_list_bao'] as $k => $v){?>
			<li>
                <?php if(!empty($v['_activity'])){?>
				<div class="icon-mark1">
					<p><?php echo $v['_activity'][0];?></p>
					<p><?php echo $v['_activity'][1];?></p>
				</div>
                <?php }?>

				<a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
    				<div class="img-box">
    					<img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>" title="<?php echo $v['goods_name'];?>"/>
    				</div>
    				<div class="txt-box">
    					<p><?php echo $v['goods_name'];?></p>
    					<span>
    						<strong><em>收藏价</em><i>¥</i><i><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></i></strong>
    						<i></i>
    					</span>
    				</div>
				</a>
			</li>
    <?php }?>
<?php }?>

		</ul>
	</div>
</div>


<div class="img-photo9">
	<div class="m-wrap">
		<a class="rulebtn"></a>
		<div class="rulebox">
			<h2>活动规则</h2>
			<p>1、订单支付完成后，返现将以现金券的方式发放至会员账号，请在 我的商城→我的优惠券 中查看。</p>
			<p>2、现金券可在收藏天下书画馆中使用，直抵现金，无购物金额限制。</p>
			<p>3、本活动最终解释权归收藏天下所有。</p> 
		</div>
		<script type="text/javascript">
			$(function(){
				$('.rulebtn').hover(function(){
					$('.rulebox').toggleClass('show').removeClass('show2');
				})
				$('.rulebtn').mouseleave(function(){
					$('.rulebox').toggleClass('show2');
				})
			})
		</script>
	</div>
</div>


<div class="img-photo10">
	<div class="m-wrap">
		<ul class="photo-list">


<?php if(!empty($output['goods_list_voucher'])){?>
    <?php foreach($output['goods_list_voucher'] as $k => $v){?>
			<li>
				<div class="icon-mark3">
					<p>返</p>
					<strong><?php echo $v['_voucher'][0];?>元</strong>
				</div>
                <a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>" title="<?php echo $v['goods_name'];?>" target="_blank">
    				<div class="img-box">
                        <img src="<?php echo cthumb($v['goods_image'],360);?>" alt="<?php echo $v['goods_name'];?>" title="<?php echo $v['goods_name'];?>"/>
    				</div>
    				<div class="txt-box">
                        <p><?php echo $v['goods_name'];?></p>
    					<span>
                            <strong><em>收藏价</em><i>¥</i><i><?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></i></strong>
    						<i></i>
    					</span>
    				</div>
				</a>
			</li>
    <?php }?>
<?php }?>

		</ul>
	</div>
</div>
<div class="img-photo11"></div>
<div class="img-photo12"></div>


<script>
    $(function(){

        $('a[nctype="addblcart_submit"]').click(function(){
            addblcart($(this).attr('bl_id'));
         });

        $('a[nctype="addblcart_hb"]').click(function(){
            addblcartHb();
         });

        $('a[nctype="addblcart_false"]').click(function(){
            var t = "<?php echo $output['t_2'];?>";
            alert(t);
         });

    });

    function addblcartHb(){

        <?php if ($_SESSION['is_login'] !== '1'){?>
           login_dialog();
        <?php } else {?>
            $.post("index.php?act=zhuanti&op=addGoods_1026",'',function(data){
                console.log(data);
                if(data.state){
                    alert(data.msg);
                }else{
                    alert(data.msg);
                }
            },'json');
        <?php } ?>
    }

    /* add one bundling to cart */ 
    function addblcart(bl_id)
    {
    	<?php if ($_SESSION['is_login'] !== '1'){?>
    	   login_dialog();
        <?php } else {?>
            var url = 'index.php?act=cart&op=add';
            $.getJSON(url, {'bl_id':bl_id}, function(data){
            	if(data != null){
            		if (data.state)
                    {
                        $('#bold_num').html(data.num);
                        $('#bold_mly').html(price_format(data.amount));
                        $('.ncs-cart-popup').fadeIn('fast');
                        // 头部加载购物车信息
                        load_cart_information();
						$("#rtoolbar_cartlist").load('index.php?act=cart&op=ajax_load&type=html');
						alert('操作成功，购物车中查看详情！');
                    }
                    else
                    {
                        showDialog(data.msg, 'error','','','','','','','','',2);
                    }
            	}
            });
        <?php } ?>
    }
    </script>