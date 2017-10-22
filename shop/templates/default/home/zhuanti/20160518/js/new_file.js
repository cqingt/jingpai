/*tab标签切换*/
  $(function(){
        function tabs(tabTit,on,tabCon){
            $(tabCon).each(function(){
                $(this).children().eq(0).show();

            });
            $(tabTit).each(function(){
                $(this).children().eq(0).addClass(on);
            });
            $(tabTit).children().click(function(){
                $(this).addClass(on).siblings().removeClass(on);
                var index = $(tabTit).children().index(this);
                $(tabCon).children().eq(index).show().siblings().hide();
            });
        }
        tabs(".investment_title","on",".investment_con");

    })

$(function(){
        function tabs(tabTit,on,tabCon){
            $(tabCon).each(function(){
                $(this).children().eq(0).show();

            });
            $(tabTit).each(function(){
                $(this).children().eq(0).addClass(on);
            });
            $(tabTit).children().click(function(){
                $(this).addClass(on).siblings().removeClass(on);
                var index = $(tabTit).children().index(this);
                $(tabCon).children().eq(index).show().siblings().hide();
            });
        }
        tabs(".df_investment_title","on",".df_investment_con");

    })

//文字集合弹窗
			$(function(){
				
				$("#btn1").click(function(){
					var txt=  "<p>1、参与对象：活动期间新注册会员；</p><p>2、每位有效新会员均可领取福利一份，包括360元优惠券和面值10万元外国真钞一枚；</p><p>3、360元优惠券领取后将立即发放至会员账户，面值10万元外国真钞为实物福利，填写收货信息后72小时内安排发放；</p><p>本活动最终解释权归搜藏天下所有。</p>";
					var option = {
						title: "注册送钱活动规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
				$("#btn2").click(function(){
					var txt=  "<p>1、活动时间：2016年5月18日至2016年5月28日；</p><p>2、活动期间，新老会员均可参与签到抽奖活动；</p><p>3、每位会员完成“每日签到”即可获得一次抽奖机会（限每天一次），签到成功后点击抽奖按钮，奖品开始转动，当3个框内均为同一奖品时，会员即获得该奖品；</p><p>4、收藏天下特别准备3款实物大奖，每款奖品每日各10件，即每天可产生30个中奖的机会；</p><p>5、会员中奖后请如实填写收货信息，如因会员收货信息错误造成的奖品错寄、未收到的情况，收藏天下不再补发。</p><p>本活动最终解释权归收藏天下所有。</p>";
					var option = {
						title: "抽奖规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
				$("#btn4").click(function(){
					var txt=  "<p>1、9.9包邮特惠仅限首次注册收藏天下的新会员参与；</p><p>2、9.9包邮活动每位新会员仅限参与一次，重复下单无效；</p><p>3、因9.9包邮产品性质特殊，所以该系列订单仅支持在线支付，不接受货到付款。</p><p>本活动最终解释权归搜藏天下所有。</p>";
					var option = {
						title: "包邮产品抢购规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
				$("#btn5").click(function(){
					var txt=  "<p>1、惊爆价专区不限新老会员均可参与；</p><p>2、活动期间，购买惊爆价专区商品满299元即赠周边十国钞一套；</p><p>3、活动期间，购物并确认收货完成订单即可获得商品金额3倍积分（已订单确认收货时间为准）；</p><p>4、惊爆价产品全部包邮，因此仅支持在线支付方式，一律不支持货到付款；</p><p>5、活动期间，惊爆价产品如遇售空不再补仓，请会员随时留意库存变化；</p><p>本活动最终解释权归搜藏天下所有。</p>";
					var option = {
						title: "全网最低价活动规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
			});
			
//    独立弹窗
//显示灰色 遮罩层 
 function loginBg() { 
	$("#fullbg").css({ 
		display:"block" 
	}); 
	$("#login").show(); 
} 
function open16(id,r_id){
	if(r_id == 0){
		var type = 3;
	 }else if(r_id == 1){
		var type = 4;
	 }else if(r_id == 2){
		var type = 5;
	 }
	$("#J_name").html('');
    $("#type").val(type);
    $("#lid").val(id);
    $("#TiShiXinXi").html('请认真填写收货信息，以确保奖品能准确的寄到您的手中。');
	$("#df_yuan").html('生成订单后您需要支付的金额为：0元');
	var bh = $("body").height(); 
	var bw = $("body").width(); 
	$("#fullbg").css({ 
	height:bh, 
	width:bw, 
	display:"block" 
	}); 
	$("#dialog").show(); 
}
function showBg() { 

	$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160518&action=CouJiang",
			data:{},
			dataType:'json',
			success:function(result){
				 if(result.msg == -1){//未登录
					loginBg();
					return false;
				  }else if(result.state){
					 letGo(result.r_id);
					 if(result.r_id == 3){
						var txt=  "<p>"+result.msg+"</p>";
						var option = {
							title: "提示信息：",										
						}
						window.wxc.xcConfirm(txt, "custom", option);
						$("#btnLingQu").attr("disabled",false);
					 }else{
						 if(result.r_id == 0){
							var type = 3;
						 }else if(result.r_id == 1){
							var type = 4;
						 }else if(result.r_id == 2){
							var type = 5;
						 }
						 
						 $("#J_name").html('恭喜您抽中'+result.msg+'1件');
						 $("#type").val(type);
						 $("#lid").val(result.lid);
						 $("#TiShiXinXi").html('请认真填写收货信息，以确保奖品能准确的寄到您的手中。');
						 $("#df_yuan").html('生成订单后您需要支付的金额为：0元');
							var bh = $("body").height(); 
							var bw = $("body").width(); 
							$("#fullbg").css({ 
							height:bh, 
							width:bw, 
							display:"block" 
							}); 
							$("#dialog").show(); 
					 }
				  }else{
					var txt=  "<p>"+result.msg+"</p>";
					var option = {
						title: "提示信息：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
					$("#btnLingQu").attr("disabled",false);
				  }
				
			}
		}); 
} 

//关闭灰色 遮罩 
function closeBg() { 
	$("#fullbg,#dialog,#login").hide(); 
} 

//领取代金卷
function lingqu(val){
	var bh = $("body").height(); 
	var bw = $("body").width(); 
	$("#fullbg").css({ 
		height:bh, 
		width:bw, 
		display:"block" 
	}); 
	$.ajax({
      type:'post',
      url:"index.php?act=zhuanti&op=ad_20160518&action=lingqu&val="+val,
      data:{},
      dataType:'json',
      success:function(result){
		  if(result.msg == -1){//未登录
			loginBg();
			return false;
		  }else if(result.msg == -2){
			var txt=  "<p>对不起，您已经领取过了。</p>";
			var option = {
				title: "提示信息：",										
			}
			window.wxc.xcConfirm(txt, "custom", option);
		  }else if(result.msg == 1 && val < 5){
			var txt=  "<p>恭喜您，领取成功！</p><p>现金券已发放至您个人账户</p>";
			var option = {
				title: "提示信息：",										
			}
			window.wxc.xcConfirm(txt, "custom", option);
		  }else if(result.msg == -5){
			var txt=  "<p>对不起，您不符合领取资格！</p>";
			var option = {
				title: "提示信息：",										
			}
			window.wxc.xcConfirm(txt, "custom", option);
		  }else if(val == 5){
			 $("#J_name").html('');
			 $("#type").val('1');
			 $("#TiShiXinXi").html('请如实填写收货信息领取面值10万元外国钞！');
			 $("#df_yuan").html('生成订单后您需要支付的金额为：0元');
			 $("#dialog").show();
		  }else if(val == 6){
			if(result.msg == -3){
				var txt =  "<p>恭喜您，领取成功！</p><p>现金券已发放至您个人账户</p>";
				var option = {
					title: "提示信息：",										
			    }
			    window.wxc.xcConfirm(txt, "custom", option);
			}else{
				$("#J_name").html('');
				$("#type").val('1');
				$("#TiShiXinXi").html('360元优惠券已发放至您的会员账户<br />请如实填写收货信息领取面值10万元外国钞！');
				$("#df_yuan").html('生成订单后您需要支付的金额为：0元');
				$("#dialog").show();
			}
		  }
		 
		if(result.msg == -2 || result.msg == -5 || result.msg == -3 || val < 5){
			closeBg();
		}
		  
       }
    });
}

//9.9领取香港塑料钞
function btn_9_9(){
	$.ajax({
      type:'post',
      url:"index.php?act=zhuanti&op=ad_20160518&action=Xiang_GangChao",
      data:{},
      dataType:'json',
      success:function(result){
		  if(result.msg == -1){//未登录
			loginBg();
			return false;
		  }else if(result.state){
			var bh = $("body").height(); 
			var bw = $("body").width(); 
			$("#fullbg").css({ 
				height:bh, 
				width:bw, 
				display:"block" 
			}); 
			$("#J_name").html('');
			$("#type").val('2');
			$("#TiShiXinXi").html('请认真填收货信息等待收取香港塑料钞');
			$("#df_yuan").html('生成订单后您需要支付的金额为：9.9元');
			$("#dialog").show();
		  } else{
			var txt=  "<p>"+result.msg+"</p>";
			var option = {
				title: "提示信息：",										
			}
			window.wxc.xcConfirm(txt, "custom", option);
			$("#btnLingQu").attr("disabled",false);
		  }
	}
	});
}