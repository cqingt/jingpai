<?php if(!$output['no_member_footer_soo']){ ?>

 

<?php }?>

<script>
$(function(){
	$('.stamp_content p img').parent().remove();
})
</script>
<?php defined('InShopNC') or exit('Access Invalid!');?>

<?php require_once template('copyright');?>
<?php if($output["seller_page"] != '1'){?>
<!--小能客户代码 -->
<script language="javascript" type="text/javascript">
<?php if($output["buy_step"] == 'step1'){?>
<?php $i=0;$is_zuihou=0; ?>
NTKF_PARAM = {
	siteid:'sc_1000',
	settingid:'sc_1000_9999',
	uid:"<?php echo $_SESSION['member_id'];?>",
	uname:"<?php echo $_SESSION['member_name'];?>",
	userlevel:"<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>",
    ntalkerparam:{
		'cartprice': "<?php echo $output['sum']?>",
		'items': [
			 <?php $i++; if($i == count($output['store_cart_list'])){ $is_zuihou=1; } ?>
			 <?php foreach($output['cart_list'] as $cart_k=>$cart_info) {?>
					{
					'id': "<?php echo $cart_info['goods_id']; ?>",
					'sellerid': "<?php if(!in_array($cart_info['store_id'], model('store')->getOwnShopIds())){?>sc_<?php echo 1000+intval($cart_info['store_id']);?><?php } ?>",
					'count': "<?php echo $cart_info['goods_num']; ?>",
					'name': "<?php echo $cart_info['goods_name']; ?>",
					'imageurl': "<?php echo thumb($cart_info,240);?>",
					'url': "<?php echo urlShop('goods','index',array('goods_id'=>$cart_info['goods_id']));?>",
					'siteprice':"<?php echo $cart_info['goods_price']; ?>"
					}<?php if($cart_k+1 != count($cart_list) || $is_zuihou==0){ ?>,<?php } ?>
			<?php } ?>

						]
    }
}
<?php }elseif($output["buy_step"] == 'step2'){?>
<?php $i=0;$is_zuihou=0; ?>
NTKF_PARAM = {
	siteid:'sc_1000',
	settingid:'sc_1000_9999',
	uid:"<?php echo $_SESSION['member_id'];?>",
	uname:"<?php echo $_SESSION['member_name'];?>",
	userlevel:"<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>",
	orderprice: '<?php echo $totalprice;?>',
    ntalkerparam:{
		'items': [
			<?php foreach($output['store_cart_list'] as $store_id => $cart_list) {?>
			<?php $i++; if($i == count($output['store_cart_list'])){ $is_zuihou=1; } ?>
			 <?php foreach($cart_list as $cart_info) {?>
					{
					'id': "<?php echo $cart_info['goods_id']; ?>",
					'sellerid': '<?php if(!in_array($store_id, model("store")->getOwnShopIds())){?>sc_<?php echo 1000+intval($store_id);?><?php } ?>',
					'count': "<?php echo $cart_info['goods_num']; ?>",
					'name': "<?php echo $cart_info['goods_name']; ?>",
					'imageurl': "<?php echo thumb($cart_info,240);?>",
					'url': "<?php echo urlShop('goods','index',array('goods_id'=>$cart_info['goods_id']));?>",
					'siteprice':"<?php echo $cart_info['goods_price']; ?>"
					}<?php if($cart_k+1 != count($cart_list) || $is_zuihou==0){ ?>,<?php } ?>
			<?php } ?>
		<?php } ?>
	  ]
    }
}
<?php }elseif($output["buy_step"] == 'step4'){?>
NTKF_PARAM = {
	siteid:'sc_1000',
	settingid:'sc_1000_9999',
	uid:"<?php echo $_SESSION['member_id'];?>",
	uname:"<?php echo $_SESSION['member_name'];?>",
	userlevel:"<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>",
	orderid:"<?php echo $output['order_sn']; ?>"
}
<?php }
else {
?>
<?php  $by2str =  ',';  ?>
<?php if (count($output['order_list'])>0) { foreach($output['order_list'] as $key => $order) { $orderid .= $order['order_sn'].$by2str; $orderprice .=  $order['order_amount'].$by2str;} } ?>
NTKF_PARAM = {
		siteid:'sc_1000',
<?php if($output['opAction']){ ?>
		sellerid:"sc_1000",<?php } ?>
		settingid:'sc_1000_9999',
		uid:"<?php echo $_SESSION['member_id'];?>",
		uname:"<?php echo $_SESSION['member_name'];?>",
		userlevel:"<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>"<?php if (count($output['order_list'])>0) {?>,
		orderid:"<?php echo substr($orderid, 0, -1);?>",
		orderprice:'<?php echo substr($orderprice, 0, -1);?>'<?php }?><?php if($output['goods']){ ?>,
		ntalkerparam:{
	        item: 
	        {
					'id': "<?php echo $output['goods']['goods_id']; ?>",
                    'name': "<?php echo $output['goods']['goods_name']; ?>",
                    'imageurl': "<?php echo cthumb($output['goods']['goods_image'],240)?>",
                    'url': "<?php echo urlShop('goods', 'index', array('goods_id'=>$output['goods']['goods_id']));?>",
                    'siteprice':"<?php echo ($output['goods']['goods_price'] < 1)?'咨询客服':($output['goods']['goods_price']);?>"
	    	}
        }
	<?php } ?>
}
<?php } ?>
</script>
<script type="text/javascript" src="http://dl.ntalker.com/js/b2b/ntkfstat.js?siteid=sc_1000" charset="utf-8"></script>
<!--小能客户代码 end -->
<?php } ?>

<?php if(!$output['no_footer']){ ?>

<?php if($output['app_'] !== true){ ?>
<div class="clearfix tab-line nav">
    <div class="tab-line-item" style="width:25%;">
        <a href="<?php echo M_SITE_URL?>"><i class="fa fa-home"></i><br>商城首页</a>
    </div>
    <div class="tab-line-item tab-categroy" style="width:25%;">
        <a href="<?php echo urlWap('artist','FenLei');?>"><i class="fa fa-th-list"></i><br>选画中心</a>
    </div>
    <div class="tab-line-item" style="width:25%;position: relative;">
        <a href="<?php echo urlWap('member_cart','cart_list')?>"><i class="fa fa-shopping-cart"></i><br>购物车</a>
    </div>
    <div class="tab-line-item" style="width:25%;">
        <a href="<?php echo urlWap('member','home');?>"><i class="fa fa-user"></i><br>个人中心</a>
    </div>
</div>
<?php } ?>

<?php } ?>

<div style="display:none;">

<!-- CNZZ -->
<script>
	(function() {
  var hm = document.createElement("script");
  hm.src = "http://s22.cnzz.com/stat.php?id=4528288&web_id=4528288";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?4990e66d06ee96054218c1b03d13daa7";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<script  type="text/javascript">
  var _sogou_sa_q = _sogou_sa_q || [];
  _sogou_sa_q.push(['_sid', '318839-327313']);
 (function() {
    var _sogou_sa_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
    var _sogou_sa_src=_sogou_sa_protocol+"hermes.sogou.com/sa.js%3Fsid%3D318839-327313";
    document.write(unescape("%3Cscript src='" + _sogou_sa_src + "' type='text/javascript'%3E%3C/script%3E"));
    })();
</script>
<script type="text/javascript" src="http://s.union.360.cn/2780.js"></script>

</div> 


<?php 

        $http = strtolower($_SERVER['HTTP_HOST']);
        $act = strtolower($_GET['act']);
        if($http == 'ads.82698.com' && $act == 'zhuanti'){

$html = <<<BODY
    <div style="display:none;"><script type="text/javascript" src="http://mo.fx91.cn/api.aspx?api=aa&bhid=1"></script></div>
BODY;
            echo $html;

        }


?>


<!--站点统计代码-->
<script type="text/javascript">

<?php if($_GET['act'] == 'goods' && $_GET['op'] != 'goods_list'){ ?>
	_ozprm="id=<?php echo $output['goods']['goods_id']; ?>&cid=<?php echo $output['goods']['gc_id']; ?>&bid=<?php echo $output['goods']['brand_id']; ?>";
<?php } ?>

<?php if($_GET['act'] == 'goods' && $_GET['op'] == 'goods_list' && $_GET['keyword']){ ?>
	_ozprm="keyword=<?php echo $_GET['keyword']; ?>";
<?php } ?>

try{
	var _ozuid;
	var _user='<?php echo $_SESSION['member_name'];?>';//需传值，用户登陆后的用户id，如果没有登录传空值，即_user=’’;
	var _domain=document.domain.match(/\.[a-zA-Z0-9.-]+/);
	if($.cookie("ozuid") &&(_user==''|| null==_user)){  //cookie有值，但是用户尚未登录 ;那么取cookie值
		_ozuid=$.cookie("ozuid");
	}else if($.cookie("ozuid") &&(null!= _user)){ //cookie有值，但是用户已登录 ;那么更新cookie值，再取cookie值
		$.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain});
		_ozuid=$.cookie("ozuid");
	}else if(!$.cookie("ozuid") &&(_user==''|| null==_user)){//cookie无值，用户也未登录，不能记录会员行为
	    //无动作
	}else if(!$.cookie("ozuid") &&(null!= _user)){
		$.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain}); //cookie无值，但是用户已登录 ;那么存储cookie值，再取cookie值
		_ozuid=$.cookie("ozuid");
	}
}catch(e){
}

</script>

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
		var tprm="orderid=<?php echo $order['order_sn'];?>&orderTotal=<?php echo $order['order_amount'];?>&storeid=<?php echo $order['store_id'];?>&skulist="+skulist;
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