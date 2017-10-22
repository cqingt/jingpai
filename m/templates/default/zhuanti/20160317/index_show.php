<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160317/css/stay.css">

    <div class="banner">
         <div class="banner-cose"></div>
    </div>
    <div class="main">
         <div class="banner"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160317/images/banner.jpg" alt=""></div>
         <div class="cont">
              <div class="cont-l ">
                   <a class="stay-shop" ><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160317/images/s1.png" alt=""></a>
                   <a class="stay-btn jq-btn" href="#start-footer" onclick="tijiao(955);"></a>
                   <h1 class="cont-h1">第五套人民币小全套后五同号钞珍藏</h1>
                   <p class="words">1999年10月1日，在中华人民共和国建国50周年之际，中国人民银行开始陆续发行第五套人民币，共有1元、5元、10元、20元、50元、100元6种面额。<em></em>第五套人民币小全套后五同号钞珍藏甄选第五套人民币每种面值全新品相纸钞各一张，每种面值纸钞后五位号码相同。</p>
                   <ul>
                      <li>放眼国际立足中华，先进技术铸钱币精品！</li>
                      <li>中国特色文化展示，寓意吉祥钞到富贵！</li>
                      <li>装帧低奢易于珍藏，传承百年珍品！</li>
                   </ul>
              </div>
              <div class="suspend"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160317/images/suspend.jpg" alt=""></div>
              <div class="cont-r">
                   <a class="stay-shop" ><img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160317/images/s2.png" alt=""></a>
                   <a class="stay-btn jq-btn" href="#start-footer" onclick="tijiao(11735);"></a>
                   <h1 class="cont-h1">中国航天纪念钞</h1>
                   <p class="words">为纪念新中国成立以来在航天事业的蓬勃发展，中国人民银行定于2015年11月26日发行中国航天纪念钞一枚，面值100元，发行量3亿枚。</p>
                   <ul>
                      <li>中国的航天事业举世瞩目，发行意义重大！</li>
                      <li>航天题材藏品异军突起，市场表现惊艳！</li>
                      <li>国际大环境好，长期处于升值状态！</li>
                   </ul>
              </div>
         </div>
         <div class="star-footer">

              <div class="add-wrap">
                   <div class="dialog_body">
                   <h1 class="congratulation">第五套人民币小全套及中国航天纪念钞</h1>
                   <p class="congr-p">请正确填写收货信息静等收货</p>
                   <div class="eject_con address">
                    <div class="adds">
                        <span class="dialog_title_icon">收货信息</span>
                        <dl>
                          <dt><i class="required">*</i>收货人：</dt>
                          <dd>
                            <input type="text" class="text w100" name="true_name" id="true_name" value="">
                            <p class="hint">请填写您的真实姓名</p>
                          </dd>
                        </dl>
                        <dl>
                          <dt><i class="required">*</i>所在地区：</dt>
                          <dd>
                            <div>
						  <input type="hidden" value="" name="city_id" id="city_id">
						  <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
						  <input type="hidden" name="area_info" id="area_info" class="area_names"/>
								 <select class="valid" name="prov" id="vprov">
										<option value="">-请选择-</option>
									</select>
									<select class="valid" name="city" id="vcity">
										<option value="">-请选择-</option>
									</select>
							   
									<select class="valid" name="region" id="vregion">
										<option value="">-请选择-</option>
									</select>
							  </div>
                          </dd>
                        </dl>
                        <dl>
                          <dt><i class="required">*</i>街道地址：</dt>
                          <dd>
                            <input class="text w300 valid" type="text" name="address" id="address" value="">
                            <p class="hint">不必重复填写地区</p>
                          </dd>
                        </dl>
                        <dl>
                          <dt><i class="required">*</i>手机号码：</dt>
                          <dd>
                            <input type="tel" class="text w200 valid" name="mob_phone" id="mob_phone" value="">
                          </dd>
                        </dl>
                          <label class="submit-border">
						  <input type="hidden" value="" name="goods_id" id="goods_id">
                            <input type="submit" class="submit" id="btnLingQu" value="完成领取">
                          </label>
                          <p class="add-p">因藏品本身价值很高，快递费用20元需会员自理。</p>
                    </div>
                   </div>
              </div>
              <div style="clear:both; display:block;"></div>
              </div>

              <p>兑换规则：</p>
              <p>1、本次活动为新会员福利，仅限收藏天下“注册会员”级别会员参与；</p>
              <p>每位会员仅限参与一次活动（即限等值兑换中国航天纪念钞1及第五套人民币小全套后五同号钞珍藏一套，同一手机号、收货地址均视为同一会员）；</p>
              <p>2、因藏品价值很高，快递费用需会员自理；</p>
              <p>3、本活动最终解释权归收藏天下所有。</p>
              <a class="btn-footer jq-btn" id="start-footer" href="#start-footer" onclick="tijiao('955,11735');"></a>
              <strong>精彩收藏，<a href="http://www.96567.com/" target="_blank">由此开启>></a></strong>
         </div>
    </div>
    <script>
	//获取区域列表
        $.ajax({
            type:'post',
            url:"<?php echo urlWap('member_address','area_list')?>",
            data:'',
            dataType:'json',
            success:function(result){
                var data = result.datas;
                var prov_html = '';
                for(var i=0;i<data.area_list.length;i++){
                    prov_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                }
                $("select[name=prov]").append(prov_html);
            }
        });
	  $("select[name=prov]").change(function(){//选择省市
            var prov_id = $(this).val();
			if(prov_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=city]").html(region_html);
				return false;
				}
			
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:prov_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var city_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=city]").html(city_html);
                    $("select[name=region]").html('<option value="">-请选择-</option>');
                }
            });
        });

        $("select[name=city]").change(function(){//选择城市
            var city_id = $(this).val();
			if(city_id==''){
				var region_html = '<option value="">-请选择-</option>'; 
				$("select[name=region]").html(region_html);
				return false;
				}
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_address','area_list')?>",
                data:{area_id:city_id},
                dataType:'json',
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">-请选择-</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                }
            });
        });
		function tijiao(obj){
			$.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op=ad_20160317&action=is_login",
				data:{},
				dataType:'json',
				success:function(result){
					if(result.state){
						if(obj == '955'){
							$(".congratulation").html("您即将兑换：第五套人民币小全套"); 
							$("#goods_id").val("955"); 
						}else if(obj == '11735'){
							$(".congratulation").html("您即将兑换：中国航天纪念钞"); 
							$("#goods_id").val("11735"); 
						}else{
							$(".congratulation").html("您即将兑换：第五套人民币小全套及中国航天纪念钞"); 
							$("#goods_id").val("955,11735"); 
						}
						$(".add-wrap").show(); 
					}else{
						window.location.href="<?php echo urlWap('login','index')?>";
					}
				}
			}); 
		}

	$("#btnLingQu").bind("click", function() {
		var true_name = $.trim($("#true_name").val());
		var mob_phone = $.trim($("#mob_phone").val());
		var prov_index = $('select[name=prov]')[0].selectedIndex;
		var city_index = $('select[name=city]')[0].selectedIndex;
		var region_index = $('select[name=region]')[0].selectedIndex;
		var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
		var prov = $('select[name=prov]').val();
		var city_id = $('select[name=city]').val();
		var area_id = $('select[name=region]').val();
		var goods_id = $('#goods_id').val();
		var address = $.trim($("#address").val());
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160317&action=linqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov,goods_id:goods_id},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					if(result.msg == -1){
						window.location.href="<?php echo urlWap('login','index')?>";
					}else{
						alert(result.msg);
					}
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
	});
    </script>

<?php

$array['P']['title'] = "收藏天下等面值兑换惊喜来袭！";
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160317/images/300-300.jpg";
$array['Y']['title'] = "收藏天下等面值兑换惊喜来袭！";
$array['Y']['desc'] = "收藏天下等面值兑换惊喜来袭！中国航天纪念钞、第五套人民币后五同号钞等面值兑换，让你的钱瞬间升值！";
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL."/zhuanti/20160317/images/300-300.jpg";

echo weixinShare($array);

?>