

<script>
$(function(){
	$('.stamp_content p img').parent().remove();
})
</script>
<?php defined('InShopNC') or exit('Access Invalid!');?>

<?php require_once template('copyright');?>


<?php if(!$output['no_footer']){ ?>

<?php if(!$output['no_member_footer_soo']){ ?>

 

<?php }?>

<?php if($output['app_'] !== true){ ?>
<div class="emptyBox" style="overflow: hidden; height: 40px;"></div>
<div class="clearfix tab-line nav">
    <div class="tab-line-item" style="width:50%;">
        <a href="<?php echo M_SITE_URL?>"><i class="fa fa-home"></i><br>首页</a>
    </div>
    <!--<div class="tab-line-item tab-categroy" style="width:25%;">
        <a href="<?php /*echo urlWap('goods_class','index')*/?>"><i class="fa fa-th-list"></i><br>分类2</a>
    </div>
    <div class="tab-line-item" style="width:25%;position: relative;">
        <a href="<?php /*echo urlWap('member_cart','cart_list')*/?>"><i class="fa fa-shopping-cart"></i><br>购物车</a>
    </div>-->
    <div class="tab-line-item" style="width:50%;">
        <a href="<?php echo urlWap('member','home');?>"><i class="fa fa-user"></i><br>个人中心</a>
    </div>
</div>
<?php } ?>

<?php } ?>










<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/mo_code.js"></script>
<script>
<?php if($_GET['act'] == 'goods' && $_GET['op'] == 'goods_list' && $_GET['keyword'] == ''){ ?>
	var tprm="cate_id=<?php echo $_GET['cate_id'];?>&b_id=<?php echo $_GET['b_id'];?>&a_id=<?php echo $_GET['a_id'];?>&key=<?php echo $_GET['key'];?>&order=<?php echo $_GET['order'];?>&type=<?php echo $_GET['type'];?>&gift=<?php echo $_GET['gift'];?>&area_id=<?php echo $_GET['area_id'];?>&curpage=<?php echo $_GET['curpage'];?>";
  __ozfac2(tprm,"#categoryPage");
  setTimeout("",300);  
<?php } ?>
<?php if($output["buy_step"] == 'step3' || $output['buy_step'] == 'step4'){ ?>
	<?php if (count($output['order_list'])>0) { 
		foreach($output['order_list'] as $key => $order) { 
			if($order['extend_order_goods']){
				foreach($order['extend_order_goods'] as $ogkey=>$ogval){
				?>
				var skulist = '';
				skulist += "<?php echo $ogval['goods_id'];?>,<?php echo $ogval['goods_price'];?>,<?php echo $ogval['goods_num'];?>,,,,,,,;";
			<?php
			}
			}
		?>
		var tprm="orderid=<?php echo $order['order_sn'];?>&ordertotal=<?php echo $order['order_amount'];?>&storeid=<?php echo $order['store_id'];?>&skulist="+skulist;
		__ozfac2(tprm,"#orderPage");
		setTimeout("",300);  
	<?php
		}
	 }
	?>
<?php } ?>
</script>
</body>
</html>