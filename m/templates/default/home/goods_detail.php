<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">

<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-1.9.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>
<script>
    function add(){
        var oDiv1=document.getElementById('number');
        oDiv1.value=oDiv1.value*1+1;
    }
    function suba(){
        var oDiv1=document.getElementById('number');
        oDiv1.value=oDiv1.value*1-1;
    }

    var setAmount={
		min:1,
		<?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
			max:'<?php echo $output['goods']['tuijian_limit'];?>',
		<?php }else{ ?>
			<?php if (!empty($output['goods']['upper_limit'])) {?>
			max = '<?php echo $output['goods']['upper_limit'];?>',
			<?php }else{ ?>
			max:'<?php echo $output['goods']['goods_storage']; ?>',
			<?php } ?>
		<?php } ?>
        reg:function(x){
            return new RegExp("^[1-9]\\d*$").test(x);
        },
        amount:function(obj,mode){
            var x=$(obj).val();
            if (this.reg(x)){
                if (mode){
                    x++;
                }else{
                    x--;
                }
            }else{
                alert("请输入正确的数量！");
                $(obj).val(1);
                $(obj).focus();
            }
            return x;
        },
        reduce:function(obj){
            var x=this.amount(obj,false);
            if (x>=this.min){
                $(obj).val(x);
            }else{
                alert("商品数量最少为"+this.min);
                $(obj).val(1);
                $(obj).focus();
            }
        },
        add:function(obj){
            var x=this.amount(obj,true);
            if (x<=this.max){
                $(obj).val(x);
            }else{
                alert("商品数量最多为"+this.max);
                $(obj).val(this.max);
                $(obj).focus();
            }
        },
        modify:function(obj){
            var x=$(obj).val();
            if (x<this.min||x>this.max||!this.reg(x)){
                alert("请输入正确的数量！");
                $(obj).val(1);
                $(obj).focus();
            }
        }
    }
    $(function(){
        $("#number").val(1);
    });


</script>

<div style='width:100%;overflow:hidden;background:#fff;'>
    <div class="auction_phone_product_start_banner">
        <ul id="slider">
            <?php if (!empty($output['goods_images'])) {?>
                <?php foreach($output['goods_images'] as $k=>$v){?>
            <li style="display:block">
                <img src="<?php echo cthumb($v['goods_image'],360)?>" alt="" jqimg="<?php echo cthumb($v['goods_image'],360)?>"  width="320" height="320"/></a>
            </li>
                <?php }?>
            <?php }?>
        </ul>
        <div id="pagenavi">
            <?php if (!empty($output['goods_images'])) {?>
                <?php for($i=1;$i<=count($output['goods_images']);$i++){?>
                    <a href="javascript:void(0);" class=""><?php echo $i;?></a>
                <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var active=0,
        as=document.getElementById('pagenavi').getElementsByTagName('a');

    for(var i=0;i<as.length;i++){
        (function(){
            var j=i;
            as[i].onclick=function(){
                t2.slide(j);
                return false;
            }
        })();
    }
    var t1=new TouchScroll({id:'wrapper','width':5,'opacity':0.7,color:'#555',minLength:20});
    $('#pagenavi a:first').addClass('active');
    var t2=new TouchSlider({id:'slider', speed:600, timeout:6000, before:function(index){
        as[active].className='';
        active=index;
        as[active].className='active';
    }});
</script>
<script type="text/javascript">
    function margin_type(type){
        if(type == 1){
            $("#margin_xianjin").css({border:"1px solid #a20000"});
            $("#margin_scb").css({border:"1px solid #ccc"});
            // $("#margin_xianjin").addClass('auction_phone_product_start_status_margin_right_active');
            // $("#margin_scb").removeClass('auction_phone_product_start_status_margin_right_active');
            document.getElementById("margintype").value = 1;
        }
        if(type == 2){
            $("#margin_scb").css({border:"1px solid #a20000"});
            $("#margin_xianjin").css({border:"1px solid #ccc"});
            // $("#margin_xianjin").removeClass('auction_phone_product_start_status_margin_right_active');
            // $("#margin_scb").addClass('auction_phone_product_start_status_margin_right_active');
            document.getElementById("margintype").value = 2;
        }
    }
</script>

<div class="mss_vip_center">
    <header>
        <div class="mss_vip_cc">
            <div class="mss_vip_hp">
                <?php if (isset($output['goods']['promotion_price']) && !empty($output['goods']['promotion_price'])) {?>
                    <p>
                        <?php if (isset($output['goods']['title']) && $output['goods']['title'] != '') {?>
                            <span style="font-size: 16px;padding:0 4px; margin-right:5px; border:1px solid #ff6b6b;"><?php echo $output['goods']['title'];?></span>
                        <?php }?>
                        <?php echo '￥'.$output['goods']['promotion_price'];?></p>
                <?php } else {?>
                    <p><?php echo ($output['goods']['goods_price'] < 1)?"咨询客服":('￥'.$output['goods']['goods_price']);?></p>
                <?php }?>

            </div>
            <div class="mss_vip_title">
                <div class="mss_vip_tit">
                    <strong><?php echo $output['goods']['goods_name']; ?>
                        <!--<a href="javascript:collect(9481)"><img src="themes/96567goods/images/mss_header_dott.jpg" /></a>
                        <a href="javascript:checkLogin(9481)">
                            <img id="guanzhu" src="<?php echo MOBILE_TEMPLATES_URL;?>/images/icon_star_1.gif">
                        </a>-->
                    </strong>
                </div>
                <p class="mss_vip_hp2"><?php echo $output['goods']['goods_jingle']; ?></p>
            </div>
        </div>
    </header>
    <ul class="mss_vip_ul">
	<?php if ($output['goods']['promotion_type'] || $output['goods']['have_gift'] == 'gift') {?>
        <li class="mss_vip_sale">
            <p style="width:16%; overflow:hidden; display:block; float:left; margin-left:2%;">促销：</p>
            <style>
                #mss_vip_sale_p a{display:block;overflow:hidden; width:100%; margin-bottom:10px; font-family:"microsoft yahei"; font-size:14px; color:#ff6b6b;}
                #mss_vip_sale_p a span{padding:0 4px; margin-right:5px; border:1px solid #ff6b6b;}
            </style>
            <p style="float:left; display:block; overflow:hidden;" id="mss_vip_sale_p">
                <!-- S 限时折扣 -->
                <?php if ($output['goods']['promotion_type'] == 'xianshi') {?>
                    <a><span>限时折扣</span>原售价<?php echo intval($output['goods']['goods_price']);?>元，直降<?php echo intval($output['goods']['down_price']);?>元<?php echo sprintf('，还剩%s件',$output['goods']['goods_storage']);?></a>
                <?php }?>
                <!-- S 藏品惠-->
                <?php if ($output['goods']['promotion_type'] == 'groupbuy') {?>
                <?php if ($output['goods']['upper_limit']) {?>
                        <a style="color: #fd5d5d;"><span>藏品惠</span><div class="yicanyu" style="line-height: 43px;font-size: 14px;">该商品已享受藏品惠活动价</div></a>
                <?php } ?>
                <?php }?>
                <!-- M 秒杀 -->
                <?php if ($output['goods']['promotion_type'] == 'miaosha') {?>
                <?php if ($output['goods']['upper_limit']) {?>
                        <a><span>秒杀</span><?php echo sprintf('每人限购%s件',$output['goods']['upper_limit']).sprintf('，秒杀还剩%s件',$output['goods']['goods_storage']);?></a>
                    <?php } ?>
                <?php }?>
                <!-- S 赠品 -->
                <?php if ($output['goods']['have_gift'] == 'gift') {?>
                <?php if (!empty($output['gift_array'])) {?>
                <?php foreach ($output['gift_array'] as $val){?>
                <a><span>赠品</span>买就赠 <?php echo $val['gift_goodsname']?> x <?php echo $val['gift_amount'];?></a>
                <?php }?>
                <?php }?>
                <?php }?>
				
				<!-- S 推荐优惠 -->
				<?php if ($output['goods']['promotion_type'] == 'tuijianyouhui') {?>
				  <a><span>推荐优惠</span>
				  <?php if ($output['goods']['tuijian_limit']) {?>
                  <em><?php echo sprintf('每人限购%s件',$output['goods']['tuijian_limit']).sprintf('，优惠还剩%s件',$output['goods']['tuijian_storage']);?><br />超过<?php echo $output['goods']['tuijian_limit'];?>件或者推荐条件未达成前，下单以商品原价计算</em>

				  
				  <?php } ?>
				  </a>
				<?php }?>
                <!-- S 会员特价   xin  20151130 -->
                <?php if (is_array($output['goods']['vipsale_info']) && !empty($output['goods']['vipsale_info'])) {?>
                    <a><span>会员特价</span><?php echo '￥'.intval($output['goods']['vipsale_info']['vipsale_price']).'（'.$output['goods']['vipsale_info']['level_name'].'及以上级别专享）';?></a>
                <?php }?>
                <!-- E 会员特价 -->
                
            </p>

            <!-- S 会员特价   xin  20151130 -->
            <?php if (is_array($output['goods']['vipsale_info']) && !empty($output['goods']['vipsale_info'])) {?>
            <p style="width:16%; overflow:hidden; display:block; float:left; margin-left:2%;">会员特价：</p>
            <p style="width:80%; float:left; display:block; overflow:hidden;" id="mss_vip_sale_p">
                <a><?php echo '￥'.intval($output['goods']['vipsale_info']['vipsale_price']).'（'.$output['goods']['vipsale_info']['level_name'].'及以上级别专享）';?></a>
            </p>
            <?php }?>
            <!-- E 会员特价 -->
        </li>
		<?php }?>


		<?php if (isset($output['mansong_info']) && !empty($output['mansong_info'])) {?>
        <li class="mss_vip_sale">
            <p style="width:16%; overflow:hidden; display:block; float:left; margin-left:2%;">促销：</p>
            <style>
                #mss_vip_sale_p a{display:block;overflow:hidden; width:100%; margin-bottom:10px; font-family:"microsoft yahei"; font-size:14px; color:#ff6b6b;}
                #mss_vip_sale_p a span{padding:0 4px; margin-right:5px; border:1px solid #ff6b6b;}

            </style>
            <p style="width:80%; float:left; display:block; overflow:hidden;" id="mss_vip_sale_p">
                <!-- S 满即送 -->
                    <?php foreach($output['mansong_info']['rules'] as $rule) { ?>
                        <a><span>满就送</span>单笔订单<?php echo ($output['mansong_info']['mansong_type'] ==2 )?'每':'';?>满<?php echo intval($rule['price']);?>元
                        <?php if(!empty($rule['discount'])) { ?>
                            ，立减<?php echo intval($rule['discount']);?>元
                        <?php } ?>
                        <?php if(!empty($rule['goods_id'])) { ?>
                            ，送礼品<img src="<?php echo cthumb($rule['goods_image'], 60);?>" alt="<?php echo $rule['mansong_goods_name'];?>" style="max-width: 28px;max-height:28px;" onclick="location.href='<?php echo urlWap('goods','index',array('goods_id'=>$rule['goods_id']))?>'">
                        <?php } ?>
                        </a>
                    <?php } ?>
                <!-- E 满即送 -->
            </p>

            
        </li>
		<?php }?>




        <?php if(!empty($output['GetGoodsLink'])){?>
        <li>
            <div class="mss_vip_number">
                <p id="mss_vip_numberp">规格：</p>

                <dd class="plus_btn" style="">
                    <ul nctyle="ul_sign">
                        <?php foreach($output['GetGoodsLink'] as $val){?>
                            <?php foreach($val['goods_list'] as $gl){?>
                                <?php if(isset($gl['goods_id'])) {?>
                        <li class="sp-img"><a href="<?php if ($gl['goods_id'] != $output['goods']['goods_id']) {echo urlWap('goods', 'index', array('goods_id' => $gl['goods_id']));}?>" <?php if ($gl['goods_id'] == $output['goods']['goods_id']) {echo 'class="hovered"';}?> title="<?php echo $val['title'][$gl['goods_id']];?>"><img src="<?php echo cthumb($gl['goods_image'], 60, $_SESSION['store_id']);?>"><?php echo $val['title'][$gl['goods_id']];?><i></i></a></li>
                                <?php }?>
                            <?php }?>
                        <?php }?>

                    </ul>
                </dd>
            </div>
        </li>
        <?php }?>
		
        <!-- S 商品规格值-->
      <?php if (is_array($output['goods']['spec_name'])) { ?>
        <?php foreach ($output['goods']['spec_name'] as $key => $val) {?>

<?php if((is_array($output['goods']['spec_value'][$key]) and !empty($output['goods']['spec_value'][$key]))){?>

	<li>
            <div class="mss_vip_number">
                <p id="mss_vip_numberp"><?php echo $val;?><?php echo $lang['nc_colon'];?></p>

                <dd class="plus_btn" style="">
                   <?php if (is_array($output['goods']['spec_value'][$key]) and !empty($output['goods']['spec_value'][$key])) {?>
						<ul nctyle="ul_sign">
						  <?php foreach($output['goods']['spec_value'][$key] as $k => $v) {?>
						  <?php if( $key == 1 ){?>
						  <!-- 图片类型规格-->
						  <li class="sp-img"><a href="javascript:void(0);" class="<?php if (isset($output['goods']['goods_spec'][$k])) {echo 'hovered';}?>" data-param="{valid:<?php echo $k;?>}" title="<?php echo $v;?>"><img src="<?php echo $output['spec_image'][$k];?>"/><?php echo $v;?><i></i></a></li>
						  <?php }else{?>
						  <!-- 文字类型规格-->
						  <li class="sp-img"><a href="javascript:void(0)" class="<?php if (isset($output['goods']['goods_spec'][$k])) { echo 'hovered';} ?>" data-param="{valid:<?php echo $k;?>}"><?php echo $v;?><i></i></a></li>
						  <?php }?>
						  <?php }?>
						</ul>
						<?php }?>
                </dd>
            </div>
        </li>

        
<?php }?>

        <?php }?>
        <?php }?>
        <!-- E 商品规格值-->


        <li>
            <div class="mss_vip_number">
                <p id="mss_vip_numberp">数量：</p>

                <?php if($output['goods']['goods_storage'] > 0){ ?>
                    <p class="plus_btn">
                        <a class="jian mss_border" onclick="setAmount.reduce('#number');" href="javascript:void(0)">-</a>
                        <input class="mss_border mss_num" type="text" value="1" id="number">
                        <a class="jia mss_border" clstag="shangpin|keycount|product|pcountadd" onclick="setAmount.add('#number');" href="javascript:void(0)">+</a>
                    </p>
                    <p class="plus_btn-three color-2"><?php echo ($output['goods']['goods_storage'] >= 10)?'(库存充足)':'(库存紧张)';?></p>
                <?php }else{?>
                    <p class="plus_btn-three color-1">(商品当前库存不足)</p>
                <?php }?>
                <!--<dl class="mss_vip_choose">
                    <dd><a class='jian' onclick="setAmount.reduce('#number');" href="javascript:void(0)">-</a></dd>
                    <dd><input type="text" value="1" id="number" /></dd>
                    <dd><a class='jia' clstag='shangpin|keycount|product|pcountadd' onclick="setAmount.add('#number');" href="javascript:void(0)">+</a></dd>
                </dl>-->
            </div>
        </li>
<!--         <li><a class="mss_vip_a" href="<?php echo urlWap('goods','goods_body',array('goods_id'=>$output['goods']['goods_id']));?>"><span>商品详情</span><span>&gt;</span></a></li>
        <li>
            <a class="mss_vip_a" href="<?php echo urlWap('goods','comments',array('goods_id'=>$output['goods']['goods_id']));?>">
                <span>商品评价</span>
        	          <span style="color:#ccc; font-size:10px;">
        	    	        <?php echo $output['goods']['evaluation_count']?>人评价 <?php echo round(($output['goods']['evaluation_good_star'] / 5 * 100),2)?>%好评
        	    	        <i style=" font-size:1.6em; color:#666;">&gt;</i>
        	          </span>
            </a>
        </li> -->
        <li><a class="mss_vip_a" href="<?php echo urlWap('goods','consult',array('goods_id'=>$output['goods']['goods_id']));?>"><span>购买咨询（<?php echo $output['consult_count']?>）</span><span>&gt;</span></a></li>
    </ul>
</div>

<div class="shop-part bdr-tb" id="jshopkefu">
        <div class="shop-row1">
	          <span class="shop-row">
	            <span class="shop-icon"></span>
	            <span class="shop-name"> <?php echo $output['store_info']['store_name']?></span>
	            <span style="visibility:hidden;"></span>            
	          </span>
        </div>
    <div class="shop-understand">
        <a href="<?php echo urlWap('member_store','store_info',array('store_id'=>$output['store_info']['store_id']))?>">进入店铺</a>
    </div>
</div>


<a name="MiaoContent"></a>
<div class="content"> 
    <div class="pddetail-cnt">
        <div class="pd-detail-tab">
            <div id="fixed-tab-pannel" style="padding-left: 5px;padding-right: 5px">
                <div class="fixed-tab-pannel"><?php echo $output['goods_common_info']['goods_body'];?></div>
            </div>
        </div>
    </div>
</div>

<?php $getadvImg = getadvImg(1081);
if($getadvImg['is_use']){
    ?>
    <div style="width:100%; padding-top: 10px;">
        <?php $getadvImg = loadadv(1081,'array');?>
        <a href="<?php echo $getadvImg['adv_url']?>">
            <img class="index-ad" src="<?php echo $getadvImg['adv_img']?>" alt="">
        </a>
    </div>
<?php }
$getadvImg = getadvImg(1082);
if($getadvImg['is_use']){
    ?>
    <div style="width:100%; padding-top: 10px; margin-bottom: 30px;">
        <?php $getadvImg = loadadv(1082,'array');?>
        <a href="<?php echo $getadvImg['adv_url']?>">
            <img class="index-ad" src="<?php echo $getadvImg['adv_img']?>" alt="">
        </a>
    </div>
<?php } ?>

<style>
    .m_w {
        margin: 0 auto;
        display: inline-block;
        text-align: center;
    }
    .m_xbj0505{margin-bottom:52px;}
    .m_bottom{width:100%; height:52px;background:#333; position:fixed; bottom:0; z-index:99999; min-width:320px; max-width:640px;}
    .m_bottom ul li{float:left; width:16%; height:42px;  padding:5px 0; text-align:center; font-size:12px; line-height:21px;}
    .m_bottom ul li img{width:19px; height:19px;}
    .m_bottom ul li a{color:#b0b0b0;}
    .m_bottom ul li.hover a{color:#ef4f4f;}
    .jrgwc{width:26%; text-align:center;  background-color:#FD5D5D; height:52px; display:block; float:right;}
    .botton_jrgwc{text-align:center;color:#fff; font-size:15px; font-family:"Microsoft YaHei"; line-height:52px; height:52px; border-radius:0;}
    .bkground9 {
        background-color: #999;
    }
    .jrgwc.go {
         background-color:#f67f00; 
    }
    .shop-number {
        position: relative;
    }
    .shop-number i {
        position: absolute;
        top: 0px;
        text-align: center;
        right: 0;
        border-radius: 50%;
        color: #fff;
        background: #FD5D5D;
        padding: 0 2px;
        display: block;
    }
    .demo-header {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
    }
</style>
<div class="m_w">
    <div class="m_bottom">
        <ul>
            <li>
                <a href="<?php echo M_SITE_URL;?>" <?php if($output['app_'] === true){?>onclick="appGoHome()"<?php }?> >
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/home_icon.png" width="19">
                    <br>首页
                </a>
            </li>
            <li class="hover">
                <a href="javascript:(0);" <?php if($output['store_info']['is_own_shop'] == 1){?> 
            		onclick="NTKF.im_openInPageChat('sc_1000_9999')"
            	<?php }else{ ?>
            		onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($output['store_info']['store_id']);?>_9999')"
            	<?php }?>
                >
                <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/kf_red_icon.png" width="19">
                <br>客服</a>
            </li>
            <li><a href="<?php echo urlWap('member_cart','cart_list')?>" <?php if($output['app_'] === true){?>onclick="appShopCar()"<?php }?> >
                    <!-- <i>18</i> -->
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/gwc_icon.png" width="19">
                    <br>购物车</a>
            </li>
            <script>
            $(function(){
                $('.demo-fixed').closest('.header-wrap').addClass('demo-header');
            })
            </script>



            <?php if($output['goods']['goods_storage'] > 0 && $output['goods']['goods_price'] >= 1){ ?>

                <span class="jrgwc">
                    <input name="" type="button" value="立即购买" class="botton_jrgwc" id="add-to-buy" <?php if($output['app_'] === true){?>onclick="appJustBuy()"<?php }?> >
                </span>

                <span class="jrgwc go">
                    <input name="" type="button" value="加入购物车" class="botton_jrgwc" id="add-to-cart" <?php if($output['app_'] === true){?>onclick="appAddShopCar()"<?php }?> >
                </span>
                


            <?php }elseif($output['goods']['goods_storage'] > 0 && $output['goods']['goods_price'] < 1){?>
                <span class="jrgwc bkground9">
                    <input name="" type="button" value="加入购物车" class="botton_jrgwc" <?php if($output['app_'] === true){?>onclick="appAddShopCar()"<?php }?> >
                </span>
            <?php }else{?>




            <?php if (($output['goods']['goods_price'] <= 1 || $output['goods']['goods_storage'] <= 0) && $output['goods']['is_appoint'] == 1) {?>

                <span class="jrgwc">
                    <a href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods']['goods_id'],'type'=>2));?>"  class="botton_jrgwc" >立即预约</a>
                </span>
                
            <?php }elseif($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0){?>

                <span class="jrgwc">
                    <a href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods']['goods_id']));?>"  class="botton_jrgwc" >到货通知</a>
                </span>


            <?php }else{?>

                <span class="jrgwc bkground9">
                    <input name="" type="button" value="库存不足" class="botton_jrgwc" disabled>
                </span>

            <?php }?>


                


            <?php }?>

        </ul>
    </div>
</div>


<script>
    $(function(){
        $("#add-to-cart").click(function (){

            var quantity = parseInt($("#number").val());
            var goods_id = "<?php echo $output['goods']['goods_id'];?>";
            $.ajax({
                url:"<?php echo urlWap('member_cart','cart_add')?>",
                data:{goods_id:goods_id,quantity:quantity},
                type:"post",
                success:function (result){
                    var rData = $.parseJSON(result);
                    if(!rData.datas.error){
                        if (confirm("添加购物车成功,现在去结算吗？"))
                        {   
                            <?php if($output['app_'] !== true){ ?>

                            location.href="<?php echo urlWap('member_cart','cart_list')?>";

                            <?php }else{?>
                                addShopCarOK();
                            <?php }?>
                        }
                    }else{
                        alert(rData.datas.error);
                    }
                }
            })
        })


        $("#add-to-buy").click(function (){
<?php if ($_SESSION['is_login'] != '1'){?>
	location.href="<?php echo urlWap('login','index')?>";
<?php }else{?>

    <?php file_put_contents('app_login_.txt',print_r($_SESSION,true),FILE_APPEND);?>

            var quantity = parseInt($("#number").val());
			if (!quantity) {
				return;
			}
			<?php if ($_SESSION['store_id'] == $output['goods']['store_id']) { ?>
			alert('不能购买自己店铺的商品');return;
			<?php } ?>
            var goods_id = "<?php echo $output['goods']['goods_id'];?>";
            $.ajax({
                url:"<?php echo urlWap('member_cart','cart_add')?>",
                data:{goods_id:goods_id,quantity:quantity},
                type:"post",
                success:function (result){
                    var rData = $.parseJSON(result);
                    if(!rData.datas.error){
						 location.href = "<?php echo urlWap('member_buy','buy_step1',array('ifcart'=>'1'))?>&cart_id=" + rData.datas.cat_id;
                    }else{
                        alert(rData.datas.error);
                    }
                }
            })
<?php }?>
        })


    })
</script>

<?php 

$array['P']['title'] = $output['goods']['goods_name'];
$array['P']['imgUrl'] = cthumb($output['goods_images']['0']['goods_image'],60);
$array['Y']['title'] = $output['goods']['goods_name'];
$array['Y']['desc'] = $output['goods']['goods_description'];
$array['Y']['imgUrl'] = cthumb($output['goods_images']['0']['goods_image'],60);

echo weixinShare($array);

?>

<?php if($output['goods']['goods_state'] != 10 && $output['goods']['goods_verify'] == 1){?>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<?php } ?>

<script>
$(document).ready(function(){
          $(document).scroll(function() {
            if($(document).scrollTop()>=$(document).height()-$(window).height()){
               //  self.location='index.php?act=goods&op=goods_body&goods_id=<?php echo $_GET['goods_id']?>'
            }
          });
});
</script>