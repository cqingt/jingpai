<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-1.9.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchScroll.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/touchslider.dev.js"></script>
<?php if($output['status'] == 1){?>
<style>
.auction_phone_product_nostart_top{
	width: 100%;
	position: fixed; 
	left: 0;
	top: 0;
	background: url(<?php echo MOBILE_TEMPLATES_URL;?>/images/auction_phone_bg1.png) center repeat;
	overflow: hidden;
	text-align: center;
	padding: 10px 0;
	font-size: 1em;
	color: #fff;
	font-family: '黑体';
	z-index:10000;
}
</style>
<!-- 即将开始 -->
<span class="auction_phone_product_nostart_top" id='leftTime' count_down="<?php echo $output['goods']['T_Ktime'] - TIMESTAMP;?>" timestatus="1">正在载入中...</span>
<?php }elseif($output['status'] == 2){ ?>
<!-- 正在进行 -->
<span class="auction_phone_zc_top hide" id='leftTime' count_down="<?php echo $output['goods']['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</span>
<?php }else {?>
<p class="auction_phone_zc_top hide">已结束</p>
<?php } ?>
<script type="text/javascript">
<?php if($output['status'] == 1){?>
$(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()>50){
			$('.auction_phone_product_nostart_top').show();
			
		}else{
			$('.auction_phone_product_nostart_top').hide();
		}
	})
})
<?php }else {?>
$(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()>50){
			$('.auction_phone_zc_top').show();
		}else{
			$('.auction_phone_zc_top').hide();
		}
	})
})
		
<?php } ?>
//倒计时
function auctionlockdone(){
	setTimeout("auctionlockdone()", 1000);
	$("#leftTime").each(function(){
		var obj = $(this);
		var tms = obj.attr("count_down");
		var t = obj.attr("timestatus");
		if(t == 2){
			var html = '距 结 束 ';
		}else{
			var html = '距 开 始 ';
		}
		if (tms>0) {
			tms = parseInt(tms)-1;
			var days = Math.floor(tms / (1 * 60 * 60 * 24));
			var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
			var minutes = Math.floor(tms / (1 * 60)) % 60;
			var seconds = Math.floor(tms / 1) % 60;

			if(days > 0){
				html += "<span>"+days+"</span>天";
			}
			if(hours > 0){
				html += "<span>"+hours+"</span>时";
			}
			if(minutes > 0){
				html += "<span>"+minutes+"</span>分";
			}
			html += "<span>"+parseInt(seconds)+"</span>秒";
			obj.html(html);
			obj.attr("count_down",tms);
		}else{
			location.href = location.href;
		}
	});
}
auctionlockdone();//启动倒计时
</script>
<div style='width:100%;overflow:hidden;background:#fff;'>
	 <div class="auction_phone_product_start_banner">
		  <ul id="slider">
		  <?php if(!empty($output['goods']['imgs'])){ ?>
            <?php foreach($output['goods']['imgs'] as $k=>$imgs){?>
			  <li style="display:block">
			  	  <img src="<?php echo BASE_SITE_URL.$imgs['IM_Img'];?>" alt="<?php echo $output['goods']['G_Name'];?>" title="<?php echo $output['goods']['G_Name'];?>" width="320" height="320"/></a>
			  </li>
			  <?php } ?>
           <?php }?>
		  </ul>
	      <div id="pagenavi">
			 <?php if(!empty($output['goods']['imgs'])){ ?>
				<?php foreach($output['goods']['imgs'] as $ks=>$imgsq){?>
			   <a href="javascript:void(0);" <?php if(intval($ks+1) == 1){ ?>class="active"<?php } ?>><?php echo intval($ks+1); ?></a>
			  <?php } ?>
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
			 document.getElementById("margintype").value = 1;
		}
		if(type == 2){
			$("#margin_scb").css({border:"1px solid #a20000"});
			$("#margin_xianjin").css({border:"1px solid #ccc"});
			document.getElementById("margintype").value = 2;
		}
	}
</script>
<div class="auction_phone_product_start_info">
	 <strong><?php echo $output['goods']['G_Name'];?></strong>
		 <p class="auction_phone_product_start_info_p1">
			当前价:
			<span>￥<?php echo intval($output['now_price']);?></span></p>
		 <p class="auction_phone_product_start_info_p2">
		 	<i><?php echo $output['goods']['pai_count']; ?>次出价</i>
		 	<i><?php echo $output['goods']['G_Click'];?>次围观</i>
			

			<i><a href="javascript:void(0);" onclick="NTKF.im_openInPageChat('sc_1000_1461061274365')" id="rtoolbar_cart" style="float: right;">拍卖小秘书</a></i>
		 </p>
</div>
<div class="auction_phone_product_start_status">
<?php if(!empty($output['weituoInfo'])){ ?>
		<script>
			function weituochujia(){
				$('.auction_phone_product_start_status_bid').hide();
				$('.auction_entrust').show();
			}
			function quxiaoweituo(){
				$('.auction_phone_product_start_status_bid').show();
				$('.auction_entrust').hide();
			}
		</script>	
		<!--修改委托-->
		<div class="auction_entrust hide">
			<div class='auction_entrust_main'>
				<div class='auction_entrust_main_top'>
					<p>当前委托</p>
					<input class='auction_entrust_main_input1' type="text" value='<?php echo intval($output['weituoInfo']['weituo_price']);?>'  id='client_prices' />
				</div>
				<div class="auction_entrust_main_down">
					<input class='auction_entrust_main_input2' type="submit" onclick="client(0);" value='修改' id="clients" />
					<input class='auction_entrust_main_input3' type="submit" onclick="quxiaoweituo();" value='取消' />
				</div>
			</div>
		</div>
		<!--修改委托 end-->
<?php }else{ ?>
<script>
	function weituochujia(){
		$('.auction_phone_product_start_status_bid').hide();
		$('.auction_phone_product_start_status_entrust').show();
	}
	function quxiaoweituo(){
		$('.auction_phone_product_start_status_bid').show();
		$('.auction_phone_product_start_status_entrust').hide();
	}
 </script>
<div class="auction_phone_product_start_status_entrust hide">
	  <p><span>委托出价</span><input type="text" value="0" id="client_prices"></p>
	  <div style="width:68%;margin:10px auto 10px;overflow:hidden;">
	  <button style="float:left;" onclick="client(0);" id="clients">立即委托</button>
	  <button style="float:right;background:#ccc;border:2px solid #ccc;" onclick="quxiaoweituo();">取消委托</button>
	  </div>
</div>
<?php } ?>
<?php if($output['status'] == 1){?>
	<!-- 即将开始 -->
	<?php if($output['baoming_status']){ ?>
	<div class='auction_phone_product_start_status_bid'>
		<p class="auction_phone_product_start_status_bid_p">您已报名参加，请等待开始。</p> 
		<p class='auction_phone_product_start_status_bid_p'>没时间一直跟进出价，赶快用<span onclick='weituochujia();'>委托出价</span></p>
	</div>
	<?php }else{ ?>
		<!--缴纳保证金-->
		<div class='auction_phone_product_start_status_margin '>
			<?php if(intval($output['goods']['G_BaoZhenMoney']) > 0){?>
			<div style="overflow:hidden;">
			<div class='auction_phone_product_start_status_margin_left'>
				缴纳保证金
			</div>
			<div class='auction_phone_product_start_status_margin_right'>
				<a style="border:1px solid #a20000;" class='auction_phone_product_start_status_margin_right_active' onclick="margin_type(1);" id='margin_xianjin'>￥<?php echo intval($output['goods']['G_BaoZhenMoney']);?></a>
				<a onclick="margin_type(2);" id='margin_scb'><?php echo intval($output['goods']['G_BaoZhenMoney']*100);?>收藏币</a>
				<input name="margintype" id="margintype" type="hidden" value="1" />
			</div>
			</div>
			<?php } ?>
			<button class='auction_phone_product_start_status_margin_button' id="bid" onclick="return checkform()"><?php echo (intval($output['goods']['G_BaoZhenMoney']) > 0)?'报名缴纳保证金':'我要报名'?></button>
		</div>
		<!--缴纳保证金 end-->
	<?php } ?>
<?php }elseif($output['status'] == 2){ ?>
	<!-- 正在进行 -->
<?php if($output['baoming_status']){ ?>
	
	 <style>
	.j_box{ float:left;width: 58%; height:44px;overflow: hidden;border: 2px solid #b2b2b2; font-size:18px; background-color:#fff;}
	.j_left{ float:left; width:20%; text-align:center;line-height:44px; cursor:pointer; font-size:24px; border-right:2px solid #b2b2b2; }
	.j_input{ float:left; width:57%; text-align:center; line-height:44px; border:0; color:#d62628; font-size:20px;}
	.j_right{ float:right; width:20%; text-align:center;line-height:44px; cursor:pointer; border-left:2px solid #b2b2b2;}
	</style>
	<!--立即出价-->
	<div class='auction_phone_product_start_status_bid'>
		<div class='j_box'>
			<a class='j_left' onclick="setAmount.reduce('#price');">-</a>
			<input class='j_input' type='text' id="price" name="price" value="">
			<a class='j_right' onclick="setAmount.add('#price');">+</a>
		</div>
		<script>
			$('#price').val(parseInt(parseInt("<?php echo intval($output['now_price']);?>")+parseInt("<?php echo intval($output['goods']['G_IncMoney']);?>")));
		</script>
		<a class='auction_phone_product_start_status_bid_a' id="bid" onclick="return postform()">立即出价</a>
		<p class='auction_phone_product_start_status_bid_p'>没时间一直跟进出价，赶快用<span onclick='weituochujia();'>委托出价</span></p>
	</div>
	<!--立即出价 end-->
<?php }else{ ?>
 <div class="auction_phone_product_start_status_margin ">
		  <div style="overflow:hidden;">
		       <div class="auction_phone_product_start_status_margin_left">
			        缴纳保证金
		       </div>
		       <div class="auction_phone_product_start_status_margin_right">
					<a style="border:1px solid #a20000;" class="auction_phone_product_start_status_margin_right_active" onclick="margin_type(1);" id="margin_xianjin">￥<?php echo intval($output['goods']['G_BaoZhenMoney']);?></a>
					<a onclick="margin_type(2);" id="margin_scb"><?php echo intval($output['goods']['G_BaoZhenMoney']*100);?>收藏币</a>
					<input name="margintype" id="margintype" type="hidden" value="1">
		       </div>				
		  </div>
		  <input name="margintype" id="margintype" type="hidden" value="1" />
		  <button class="auction_phone_product_start_status_margin_button" id="bid" onclick="return checkform()">
		  <?php echo (intval($output['goods']['G_BaoZhenMoney']) > 0)?'报名缴纳保证金':'我要报名'?>
		  </button>
</div>
<?php } ?>
<?php }else{ ?>
	<!-- 已结束 -->
	<?php if($output['pai_status']['status'] == 2){ ?>
		拍卖结束，未成功竞拍！
	<?php }else{ ?>
		<p style="font-size:24px;color:#d48123;">恭喜 <i style="font-size:24px;color:#d48123;"><?php echo mb_substr($output['pai_status']['member_name'],0,2,'utf-8').'***';?></i> 竞拍成功</p>
	<?php } ?>
<?php } ?>

</div>
<div class="auction_phone_product_start_info1">
	 <p style="width:100%;"><span>保证金：</span>￥<?php echo intval($output['goods']['G_BaoZhenMoney']);?>/<?php echo intval($output['goods']['G_BaoZhenMoney']*100);?>收藏币</p>
	 <p><span>加价幅度：</span>￥<?php echo intval($output['goods']['G_IncMoney']);?></p>
	 <p><span>保留价：</span><?php echo ($output['goods']['G_BaoliuMoney'] >0)?'有':'无';?></p>
</div>

<div class="auction_phone_product_start_main">
	 <a>出价记录（ <i><?php echo $output['goods']['pai_count'];?></i> ）<!--<span>全部  &gt</span>--></a>
	 <?php if($output['logres']){?>
	 <ul class="auction_phone_product_start_main_ul">
		 <li>
			<p>参与人</p>
			<p>出价</p>
			<p>出价时间</p>
		 </li>
             <?php foreach($output['logres'] as $k=>$v){ ?>
			 <?php $memberinfo = Model('member')->getMemberInfoByID($v['member_id']); ?>
			 <li>
				<p><?php echo mb_substr($memberinfo['member_name'],0,2,'utf-8')."***"; ?></p>
				<p>￥<?php echo intval($v['price']); ?></p>
				<p><?php echo date('m/d H:i:s',$v['add_time']); ?> </p>
			 </li>
			<?php } ?>
	 </ul>
	 <?php } ?>	
	 <a style="margin:15px auto;border-bottom:1px solid #e1e1e1;" href="<?php echo urlWap('lepai','lepai_detail',array('G_Id'=>$output['goods']['G_Id']));?>">
	 	查看商品详情<span>&gt;</span>
	 </a>
	 <a href="<?php echo urlWap('lepai','theme',array('tid'=>$output['goods']['T_Id'])); ?>">同场其他商品<span>&gt;</span></a>
	 <a href="<?php echo urlWap('lepai','process'); ?>">保证金须知<span>&gt;</span> </a>
</div>

<script>
 var setAmount={
        min:parseInt(<?php echo intval($output['now_price']);?>)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>),
        max:9999,
        reg:function(x){
            return new RegExp("^[1-9]\\d*$").test(x);
        },
        amount:function(obj,mode){
            var x=$(obj).val();
            if (this.reg(x)){
                if (mode){
                    x=parseInt(x)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>);
                }else{
                    x=parseInt(x)-parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>);
                }
            }else{
                alert("请输入正确的价格！");
                $(obj).val(this.min);
                $(obj).focus();
            }
            return x;
        },
        reduce:function(obj){
            var x=this.amount(obj,false);
            if (x>=this.min){
                $(obj).val(x);
            }else{
                alert("拍品价格不得低于"+this.min);
                $(obj).val(this.min);
                $(obj).focus();
            }
        },
        add:function(obj){
            var x=this.amount(obj,true);
            $(obj).val(x);

        },
        modify:function(obj){
            var x=$(obj).val();
            if (x<this.min||x>this.max||!this.reg(x)){
                alert("请输入正确的价格！");
                $(obj).val(this.min);
                $(obj).focus();
            }
        }
}
function checkform(){
        document.getElementById("bid").disabled = true;
        $.post("<?php echo urlWap('lepai','ajaxbaoming')?>",{"id":<?php echo $output['goods']['G_Id'];?>,"type": $('#margintype').val()},function(result){
            if(result==-1){
                document.getElementById("bid").disabled = false;
				window.location.href="<?php echo urlWap('login','index');?>";
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==2){
                alert("您已经缴纳过了");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==3){
                alert("该拍卖活动已经结束");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==4){
                if(confirm("您的余额不足以缴纳保证金，点击“确定”将立即跳转到充值界面")==true){location.href="<?php echo urlShop('predeposit','recharge_add');?>"};
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==6){
                alert("您的收藏币不足以缴纳保证金，请返回页面选择现金支付");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==5){
                alert("您已经成功缴纳保证金");
                location.href=location.href;
                return false;
            }
            if(result==8){
                alert("您已经成功报名");
                location.href=location.href;
                return false;
            }
            if(result==7){
                alert("您已经报名过了");
                location.href=location.href;
                return false;
            }
        });
        return false;
    }
 function postform(){
        document.getElementById("bid").disabled = true;
        $.post("<?php echo urlWap('lepai','ajaxchujia')?>",{"id":<?php echo $output['goods']['G_Id'];?>,"price": $('#price').val()},function(result){
            if(result==-1){
                document.getElementById("bid").disabled = false;
				window.location.href="<?php echo urlWap('login','index');?>";
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==5){
                alert("该拍卖活动不再有效时间内");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==2){
                alert("请输入正确的价格");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==3){
                alert("您的出价不能低于当前最低出价");
                location.href=location.href;
                return false;
            }
            if(result==4){
                alert("您已经是这个商品的最高出价人了，请等待活动结束或其它竞拍者出价！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==7){
                alert("您已出价成功，请不要重复提交");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==0){
                alert("成功出价");
                location.href=location.href;
                return false;
            }

        })
        return false;

    }

function client(client_id){
        document.getElementById("clients").disabled = true;
        var client_prices = document.getElementById("client_prices").value;
        $.post("<?php echo urlWap('lepai','ajaxweituo')?>",{"client_prices":client_prices,"id":<?php echo $output['goods']['G_Id'];?>},function(result){
            if(result==-1){
                document.getElementById("clients").disabled = false;
                login_dialog();
                return false;
            }
            if(result==-3){
                alert("该拍卖活动已经结束");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==2){
                alert("您的委托价不能小于下一次出价的价格"+parseInt(parseInt(<?php echo intval($output['now_price']);?>)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>)));
                document.getElementById("clients").disabled = false;
                return false;
            }

            if(result==3){
                alert("对不起，只能委托出价一次");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==4){
                alert("对不起，修改的委托价格不能小于上一次委托的价格");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==5){
                alert("该拍卖活动不再有效时间内");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==0){
                alert("委托成功");
                location.href=location.href;
                return false;
            }
        })
        return false;
}

</script>
<?php

$array['P']['title'] = "拍卖惠_".$output['goods']['G_Name'];
$array['P']['imgUrl'] = BASE_SITE_URL.$output['goods']['imgs'][0]['IM_Img'];
$array['Y']['title'] = "拍卖惠_".$output['goods']['G_Name'];
$array['Y']['desc'] = "好货、尖货、捡漏尽在收藏天下_拍卖惠";
$array['Y']['imgUrl'] = BASE_SITE_URL.$output['goods']['imgs'][0]['IM_Img'];

echo weixinShare($array);

?>