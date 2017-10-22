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

//文字集合弹窗
			$(function(){
				
				$("#btn1").click(function(){
					var txt=  "<p>1、该活动仅限活动期间新注册会员参与；</p><p>2、每位有效新用户均可领取福利一份，包括360元红包和外国真钞一枚；</p><p>3、新会员福利中的360元红包将以现金券方式发放，领取后自动汇至会员账户，外国真钞为实物福利，领取后将随其名下订单一同发放；</p><p>本活动最终解释权归搜藏天下所有。</p>";
					var option = {
						title: "注册送钱活动规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
				$("#btn2").click(function(){
					var txt=  "<p>1、活动期间，新老会员均可参与签到抽奖活动；</p><p>2、每位会员参与“每日签到”即可获得一次抽奖机会；</p><p>3、收藏天下特别准备了3款实物大奖，每日定量各放出10件，也就是说有30个中大奖的机会；</p><p>4、签到成功后，点击抽奖手柄，奖品开始转动，当3个框内均为同一奖品时，会员即获得该奖品；</p><p>5、会员中奖后请认真填写收货信息，如因会员信息录入问题产生的奖品错寄、未收到的情况，收藏天下视为奖品成功领取，不再补发。</p><p>6、中奖后会员可在抽奖区下方中奖公布处查看自己的中奖信息，因故中奖当时未完成信息填写的请致电客服处理。</p>";
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
					var txt=  "<p>1、惊爆价专区不限新老会员均可参与；</p><p>2、重要提示，惊爆价产品仅限自主下单的方式购买；</p><p>3、新会员须知，惊爆价产品可与9.9包邮产品同时下单；</p><p>4、活动期间，惊爆价产品如遇售空不再补仓，请会员随时留意库存变化；</p><p>5、惊爆价产品全部包邮，因此仅支持在线支付方式，一律不支持货到付款；</p><p>本活动最终解释权归搜藏天下所有。</p>";
					var option = {
						title: "全网最低价活动规则：",										
					}
					window.wxc.xcConfirm(txt, "custom", option);
				});
				
			});
			
//    独立弹窗
		  //显示灰色 遮罩层 
		  function showBg() { 
		  $("#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#dialog").show(); 
		  } 

		  function loginBg() { 
		  $("#fullbg").css({ 
		    display:"block" 
		  }); 
		  $("#login").show(); 
		  } 

		  //关闭灰色 遮罩 
		  function closeBg() { 
		    $("#fullbg,#dialog,#login").hide(); 
		  } 


