<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161026/css/new_file.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161026/css/component.css" />


<div class="silver-bar">
	<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_01.jpg" alt="" />
	<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_02.jpg" alt="" />
	<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_03.jpg" alt="" />
	<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_04.jpg" alt="" />
	
	<div class="ss-five">
		<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_05.jpg" alt="" />
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
			<a class="btn-db" href="javascript:void(0);" nctype="addblcart_submit" bl_id="24">

		<img  src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_06.gif" alt="" /></a>
	<div class="htbox ss7">
        <ul class="shopbox">	

<?php if(!empty($output['goods_list_bao'])){?>
    <?php foreach($output['goods_list_bao'] as $k => $v){?>
		<li>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></p></div>
				<p class="text"><?php echo $v['goods_name'];?></p>
				<p class="rmb">
					<i>收藏价</i>
					<em>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?>.00</em>
				</p>
				<strong><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/photobtn.png"/></strong>
			</a>
		</li>	
    <?php }?>
<?php }?>

		</ul>
	</div>

	<a class="md-trigger" data-modal="modal-from2"><img  src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_08.jpg" alt="" /></a>


	<div class="htbox ss9">
        <ul class="shopbox">	


<?php if(!empty($output['goods_list_voucher'])){?>
    <?php foreach($output['goods_list_voucher'] as $k => $v){?>
			<li>
			<a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
				<div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>);"></p></div>
				<p class="text"><?php echo $v['goods_name'];?></p>
				<p class="rmb">
					<i>收藏价</i>
					<em>¥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?>.00</em>
				</p>
				<strong><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/photobtn.png"/></strong>
			</a>
		</li>	
    <?php }?>
<?php }?>

		</ul>
	</div>
	<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_10.jpg" alt="" />
    <img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_11.jpg" alt="" />
    <img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161026app/ss_12.jpg" alt="" />


</div>

<div class="md-modal md-effect-11" id="modal-from2">
    <div class="md-content coloured">
        <div class="demo clearfix">
				<!-- Demo start 2-->
     			<div class="demo formbox" id="c2">
     			  <h3>活动规则</h3>
                  <p>1、订单支付完成后，返现将以现金券的方式发放至会员账号，请在 我的商城→我的优惠券 中查看。</p>
                  <p>2、现金券可在收藏天下书画馆中使用，直抵现金，无购物金额限制。</p>
                  <p>3、本活动最终解释权归收藏天下所有。</p>
				</div>
				<!-- Demo end -->  
            </div>
             
             <!--关闭按钮-->
            <button class="md-close close-one"><i class="icon-close"></i></button>

        </div>
    </div>
</div>

 
 <!-- 这是遮罩 -->
<div class="md-overlay"></div>	
<!-- 弹出层 End -->




<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161026/js/classie.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161026/js/modalEffects.js"></script>
<script>
	var polyfilter_scriptpath = '/js/';
</script>

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
            window.location.href="http://m.96567.com/index.php?act=login&op=index";
        <?php } else {?>
            $.post("index.php?act=zhuanti&op=addGoods_1026",'',function(data){
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
    	    location.href="http://m.96567.com/index.php?act=login&op=index";
        <?php } else {?>
            $.ajax({
                url:"index.php?act=member_cart&op=cart_add",
                data:{'bl_id':bl_id},
                type:"get",
                success:function (result){
                                    console.log(result);

                    var rData = $.parseJSON(result);
                    if(!rData.datas.error){
                        if (confirm("添加购物车成功,现在去结算吗？"))
                        {
                            location.href="http://m.96567.com/index.php?act=member_cart&op=cart_list";
                        }
                    }else{
                        alert(rData.datas.error);
                    }
                }
            })

        <?php } ?>
    }
    </script>


