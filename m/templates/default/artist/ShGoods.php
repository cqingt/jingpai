<header class="ui-header ui-header-positive">
	<i class="ui-icon-return" onclick="history.back()"></i>
	<div class="ui-in in-two">
		<div class="tabs">
			<a href="#" class="active" GoodsQueHuan='1'>商品</a>
			<a href="#GoodsContent" GoodsQueHuan='2'>详情</a> 
			<a href="#PingLunYeMmian" GoodsQueHuan='3'>评论</a>
		</div>
	</div>
	<div class="ui-header-right">
		<a class="icon-navtc" href="javascript:void(0);" title="菜单"></a>
	</div>
</header>
		
<section>
	
	<div class="footerNav nofixed">
		<div class="ui-row-flex ui-border-b">
			<div data-href="<?php echo urlWap('index','index');?>" class="ui-col ui-col">
				<i class="icon-home-nav1"></i>
				<p>商城首页</p>
			</div>
			<div data-href="<?php echo urlWap('artist','FenLei');?>" class="ui-col ui-col">
				<i class="icon-home-nav2"></i>
				<p>选画中心</p>
			</div>
			<div class="ui-col ui-col" data-href="<?php echo urlWap('member_cart','cart_list')?>">
				<i class="icon-home-nav3"></i>
				<p>购物车</p>
			</div>
			<div class="ui-col ui-col" data-href="<?php echo urlWap('member','home');?>">
				<i class="icon-home-nav4"></i>
				<p>个人中心</p>
			</div>
		</div>
	</div>
	
  <div class="swiper-container swiper-age">
	<div class="swiper-scrollbar"></div>
	<div class="swiper-wrapper">
	  <div class="swiper-slide">
		<div class="content-slide">
			<!--商品 A-->
			<div class="demo-uishop">
				 <?php if (!empty($output['goods_images'])) {?>
				<div class="swiper-container-v">
					<div class="swiper-wrapper">
						<?php foreach($output['goods_images'] as $k=>$v){?>
						<div class="swiper-slide">
							<img src="<?php echo cthumb($v['goods_image'],360)?>"/>
						</div>
						<?php }?>
					</div>
					<div class="pagination-v"></div>
				</div>
				<script type="text/javascript">
				   var swiperV = new Swiper('.swiper-container-v', {
						pagination: '.pagination-v',
						paginationClickable: true,
						spaceBetween: 50,
						calculateHeight: true,
						autoplay: 6000,
						autoplayDisableOnInteraction : false,
					});
					
					
				</script>
				<?php }?>
				
				<div class="uishop-rmb">
				<?php if (isset($output['goods']['promotion_price']) && !empty($output['goods']['promotion_price'])) {?>
                    <em>
                        <?php if (isset($output['goods']['title']) && $output['goods']['title'] != '') {?>
                            <strong style="font-size: 16px;padding:0 4px; margin-right:5px; border:1px solid #ff6b6b;color: red;"><?php echo $output['goods']['title'];?></strong>
                        <?php }?>
                        <?php echo '¥'.$output['goods']['promotion_price'];?></em>
                <?php } else {?>
				
                    <em><?php echo ($output['goods']['goods_price'] < 1)?"价格：咨询客服":('¥'.$output['goods']['goods_price']);?></em>
                <?php } ?>
				</div>
				<?php if($output['goods']['goods_price'] > 0){ ?>
				<div class="uishop-input">
					<ul class="ui-row">
						<li class="ui-col ui-col-67">
							<input class="usi" type="number" id="Mobile" value="<?php echo $output['member_mobile'] == 0 ? '' : $output['member_mobile'];?>" pattern="[0-9]*" placeholder="输入手机号"/>
						</li>
						<li class="ui-col ui-col-33">
							<button class="btn-buuton btn-buuton-tc" onclick="YiJia();" id="barClose">我要议价</button>
						</li>
					</ul>
				</div>
				<?php } ?>
				<div class="uishop-title">
					<p class="ui-nowrap-multi"><?php echo $output['goods']['goods_name']; ?></p>
				</div>
				 <ul class="mss_vip_ul">
	<?php if ($output['goods']['promotion_type']) {?>
        <li class="mss_vip_sale">
            <p style="width:16%; overflow:hidden; display:block; float:left; margin-left:2%;">促销：</p>
            <style>
                #mss_vip_sale_p a{display:block;overflow:hidden; width:100%; margin-bottom:10px; font-family:"microsoft yahei"; font-size:14px; color:#ff6b6b;}
                #mss_vip_sale_p a span{padding:0 4px; margin-right:5px; border:1px solid #ff6b6b;}
            </style>
            <p style="width:80%; float:left; display:block; overflow:hidden;" id="mss_vip_sale_p">
                <!-- S 限时折扣 -->
                <?php if ($output['goods']['promotion_type'] == 'xianshi') {?>
                    <a><span>限时折扣</span>原售价<?php echo intval($output['goods']['goods_price']);?>元，直降<?php echo intval($output['goods']['down_price']);?>元<?php echo sprintf('，还剩%s件',$output['goods']['goods_storage']);?></a>
                <?php }?>
                <!-- S 藏品惠-->
                <?php if ($output['goods']['promotion_type'] == 'groupbuy') {?>
                <?php if ($output['goods']['upper_limit']) {?>
                        <a><span>藏品惠</span>该商品已享受藏品惠活动价</a>
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
                    <a><span>会员特价</span><?php echo '¥'.intval($output['goods']['vipsale_info']['vipsale_price']).'（'.$output['goods']['vipsale_info']['level_name'].'及以上级别专享）';?></a>
                <?php }?>
                <!-- E 会员特价 -->
                <!-- S 满即送 -->
                <?php if (isset($output['mansong_info']) && !empty($output['mansong_info'])) {?>
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
                <?php }?>
                <!-- E 满即送 -->
            </p>

            <!-- S 会员特价   xin  20151130 -->
            <?php if (is_array($output['goods']['vipsale_info']) && !empty($output['goods']['vipsale_info'])) {?>
            <p style="width:16%; overflow:hidden; display:block; float:left; margin-left:2%;">会员特价：</p>
            <p style="width:80%; float:left; display:block; overflow:hidden;" id="mss_vip_sale_p">
                <a><?php echo '¥'.intval($output['goods']['vipsale_info']['vipsale_price']).'（'.$output['goods']['vipsale_info']['level_name'].'及以上级别专享）';?></a>
            </p>
            <?php }?>
            <!-- E 会员特价 -->
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
    </ul>
			</div>
			
			<div class="ui-btn-wrap uishop-btn">
				<button class="ui-btn" onclick="window.location.href='<?php echo urlWap('artist','index');?>'">收藏天下书画馆</button>
				<button class="ui-btn" onclick="window.location.href='<?php echo urlWap('index','index');?>'">收藏天下商城</button>
			</div>
			<!--商品  E-->
			<!--详情 A-->
			<div class="con-particulars" id="GoodsContent"></div>
			<!--详情 E-->
		</div>
	  </div>
	  <div class="swiper-slide">
		<div class="content-slide">
			<!--评论 A-->
			<div class="demo-block" id="PingLunYeMmian" style="display:none;">
				
				
			</div>
			<!--评论 E-->
		</div>
	  </div>
	</div>
  </div>
<!--   <script>
  $(function(){
	var tabsSwiper = new Swiper('.swiper-age',{
		speed:500,
		onSwiperCreated:function(){
			var H=$(".content-slide").eq(0).height();
			$(".swiper-wrapper").css('height', H+'px');
			$(".swiper-slide").css('height', H+'px');
		},
		onSlideChangeStart: function() {
			var H = $(".content-slide").eq(tabsSwiper.activeIndex).height();
			$(".tabs .active").removeClass('active');
			$(".tabs a").eq(tabsSwiper.activeIndex).addClass('active');
			$(".swiper-slide").css('height', H + 'px');
			$(".swiper-wrapper").css('height', H + 'px');
		},
	});
	  $(".tabs a").on('touchstart mousedown',function(e){
		e.preventDefault()
		$(".tabs .active").removeClass('active')
		$(this).addClass('active')
		tabsSwiper.swipeTo( $(this).index() )
	  })
	  $(".tabs a").click(function(e){
		e.preventDefault()
	  })
  })

  </script>
  
 -->
	
	<div class="demo-block">
		<div class="ui-dialog">
			<div class="ui-dialog-cnt">
				<header class="ui-dialog-hd">
					<i class="ui-dialog-close"></i>
				</header>
				<div class="ui-dialog-bd">
					<input class="import-phone" type="number" id="MobilePhone" pattern="[0-9]*" value="<?php echo $output['member_mobile'] == 0 ? '' : $output['member_mobile'];?>" placeholder="输入手机号"/>
					<button class="import-phone-btn" onclick="YiJia();" id="barClose">确认</button>
				</div>
				<div id="isWeixXin" class="ui-dialog-bd">
					<img src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/images/WeChat.jpg"/>
					<h5 class="wechat-txt">长按指纹， 识别二维码， 一键关注</h5>
				</div>
			</div>        
		</div>
	
		
	</div>
			
  
</section>


<!--footer nav S -->
<div class="emptyBox"></div>
<footer class="footerNav">
	<div class="ui-row">
		<div data-href="<?php echo urlWap('artist','index');?>" class="ui-col ui-col-20">
			<i class="icon-home-nav1"></i>
			<p>首页</p>
		</div>
		<div class="ui-col ui-col-20" onclick="NTKF.im_openInPageChat('sc_1022_9999');">
			<i class="icon-home-nav5"></i>
			<p>在线客服</p>
		</div>
		<div data-href="tel:4000896567" class="ui-col ui-col-20">
			<i class="icon-home-nav6"></i>
			<p>电话咨询</p>
		</div>
		<div class="ui-col ui-col-40">
			<div class="buy-box">
			<?php if($output['goods']['goods_storage'] > 0 && $output['goods']['goods_price'] > 0){ ?>
				  <button class="btn-buy" id="add-to-buy">立即购买</button>
			<?php }elseif($output['goods']['goods_storage'] > 0 && $output['goods']['goods_price'] <= 0 ){?>
				<button class="btn-buy" id="XunJia">我要询价</button>
			<?php }else{?>
				

				<?php if (($output['goods']['goods_price'] <= 1 || $output['goods']['goods_storage'] <= 0) && $output['goods']['is_appoint'] == 1) {?>
				
				<button class="btn-buy" data-href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods']['goods_id'],'type'=>2));?>">立即预约</button>
                
            <?php }elseif($output['goods']['goods_state'] == 0 || $output['goods']['goods_storage'] <= 0){?>
			

				<button class="btn-buy" data-href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods']['goods_id']));?>">到货通知</button>
            <?php }else{?>
				<button class="btn-buy">库存不足</button>
            <?php }?>

			<?php } ?>
			</div>
		</div>
	</div>
</footer>
<!--footer nav E -->
<input type="hidden" value="1" id="number">
<script>


$(".tabs a").click(function(){
		$(".tabs a").removeClass("active");
        $(this).addClass("active");
		var type=$(this).attr("GoodsQueHuan");
		if(type == 1 || type == 2){
			$(".demo-uishop").show();
			$(".ui-btn-wrap").show();
			$("#GoodsContent").show();
			$("#PingLunYeMmian").hide();
		}else if(type == 3){
			$(".demo-uishop").hide();
			$(".ui-btn-wrap").hide();
			$("#GoodsContent").hide();
			$("#PingLunYeMmian").show();
		}
})

function pinglun(type,obj){
	$.ajax({
		url:"<?php echo urlWap('goods','ShGoodsComments',array(goods_id=>$output['goods']['goods_id']))?>&type="+type,
		data:{},
		type:"post",
		success:function (result){
			$("#PingLunYeMmian").html(result);
		}
	})
}

function YiJia(){
	<?php if($output['goods']['goods_price'] > 0){ ?>
		var YjPhone = $('#Mobile').val();
		var YjContents = "来至手机站的议价";
	<?php }else{ ?>
		var YjPhone = $('#MobilePhone').val();
		var YjContents = "来至手机站的询价";
	<?php }?>
	if(!valid_shouji(YjPhone)){
		alert('请输入正确的手机号');
		return false;
	}
	$("#barClose").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"<?php echo urlWap('goods','YiJiaAdd')?>",
		data:{YjContents:YjContents,YjPhone:YjPhone,goods_id:"<?php echo $output['goods']['goods_id']; ?>",goods_name:"<?php echo $output['goods']['goods_name']; ?>",store_id:"<?php echo $output['store_info']['store_id'];?>"},
		dataType:'json',
		success:function(result){
			if(result.msg){
				alert("提交成功");
				<?php if($output['goods']['goods_price'] > 0){ ?>
					$('#Mobile').val('');
				<?php }else{ ?>
					$(".ui-dialog").removeClass("show");
				<?php }?>
			}else{
				alert(result.error);
			}
			$("#barClose").attr("disabled",false);
		}
	}); 

}
function valid_shouji(shouji) {
	var patten = new RegExp(/^0?1[34578]\d{9}$/);
	return patten.test(shouji);
}

    $(function(){
		//返回获取商品详情信息
		$.ajax({
			url:"<?php echo urlWap('goods','ShGoodsBody',array(goods_id=>$output['goods']['goods_id']))?>",
			data:{},
			type:"post",
			success:function (result){
				$("#GoodsContent").html(result)
			}
		})
		
		$.ajax({
			url:"<?php echo urlWap('goods','ShGoodsComments',array(goods_id=>$output['goods']['goods_id']))?>",
			data:{},
			type:"post",
			success:function (result){
				$("#PingLunYeMmian").html(result);
			}
		})
			
		

$("#add-to-buy").click(function (){
<?php if ($_SESSION['is_login'] !== '1'){?>
	location.href="<?php echo urlWap('login','index')?>";
<?php }else{?>
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

		$('#XunJia').click(function(){
				$(".ui-dialog").toggleClass("show");
			    var ua = navigator.userAgent.toLowerCase();
			    if(ua.match(/MicroMessenger/i)=="micromessenger") {
					<?php if(@intval($_SESSION['member_id']) > 0){?>
					 $.ajax({
						type:'post',
						url:"index.php?act=goods&op=YiJiaAdd",
						data:{YjPhone:"<?php echo $output['member_mobile'];?>",goods_id:"<?php echo $output['goods']['goods_id'];?>",goods_name:"<?php echo $output['goods']['goods_name']; ?>",store_id:"<?php echo $output['goods']['store_id']; ?>"},
						dataType:'json',
						success:function(result){
						}
					  }); 
				   <?php } ?>
			        $('#isWeixXin').css('display','block');
			    } else {
			        return false;
			    }
		});
		$('.ui-dialog-close').click(function(){
				$(".ui-dialog").removeClass("show");
		});
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