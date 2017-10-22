<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php if($output['MyLotteryList']){ ?>
       <p class="last">  
       您的现金钞票将在活动结束后7个工作日内完成发货，届时将由收藏天下客服与您联系核实收货信息，请保持电话畅通。</p>
       <h2>小编温馨提示：</h2>
       <p>活动诚可贵，真钞价更高，<strong>(稳赚不赔的买卖)</strong> 邮费需自理哦！（9.9元）</p>
       <ol class="register-box">
	    <?php foreach($output['MyLotteryList'] as $k=>$v){?>
	    <?php if($v['l_id'] < 4){?>
		<?php if($v['l_id'] == 3){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic03.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong><i></i>限时特价198元，下单再减10元<a class="btn-atv2" href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16091">已发放</a></strong>
			   </div>
			 </li>
		  <div class="btn-all-box alltwo">
           <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16091">立即使用</a>
         </div>
			 <?php } ?>
			 <?php if($v['l_id'] == 2){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic02.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong><i></i>10万面值“镇钱包”专用<a class="btn-atv1" href="javascript:(0);"><?php if($v['is_fafang'] == 1){?>已领取<?php }else{ ?>未领取 <?php }?></a></strong>
			   </div>
			 </li>
       
			 <?php } ?>
			<?php if($v['l_id'] == 1){?>
			 <li>
			   <div class="picture">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160415/images/pic01.jpg" alt="">
			   </div>
			   <div class="words">
				 <strong><i></i>壕！ 周边十国10张钞票<a class="btn-atv1" href="javascript:(0);"><?php if($v['is_fafang'] == 1){?>已领取<?php }else{ ?>未领取 <?php }?></a></strong>
			   </div>
			 </li>
			 <div class="btn-all-box">
			 <a href="javascript:(0);" onclick="lingqu();">领取现金</a>
			 <p>全部财富一起领取仅需支付一次运费哦</p>
		   </div>
			<?php } ?>
			 
		 <?php } ?>
		 <?php } ?>
       </ol>
	   <?php } else{ ?>
	   <h2>小编温馨提示：</h2>
	   <p>您还没有获得任何奖品，<strong></strong>快去点击拆红包吧！</p>
	   <?php } ?>


	   <div class="bounce mt shouhuoren">
         <a class="btn-close" href="javascript:(0);"><i class="iconfont-androidcancel"></i></a>
         <div class="forms" id="down">
		 <div class="forms-line">
             <p class="linep">全部财富一起领取仅需支付一次运费(9.9元)<p>
           </div>
           <div class="forms-line">
             <label for="">收货人姓名</label>
             <input type="text" name="true_name" id="true_name">
           </div>
           <div class="forms-line">
             <label for="">手机号码</label>
             <input type="tel" name="mob_phone" id="mob_phone">
           </div>
		   <div class="forms-line">
             <label for="">所在地区</label>
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
           <div class="forms-line">
             <label for="">详细地址</label>
             <textarea placeholder="" rows="2" name="address" id="address"></textarea>
           </div>
           <a href="javascript:(0);" id='btnLingQu'>领取</a>
         </div>
      </div>
<script>

$(".iconfont-androidcancel").bind("click", function(event) { 
    $(".btn-zz,.shouhuoren").hide();
});

//获取区域列表
$.ajax({
	type:'post',
	url:"index.php?act=member_address&op=area_list",
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
                url:"index.php?act=member_address&op=area_list",
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
                url:"index.php?act=member_address&op=area_list",
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
		var address = $.trim($("#address").val());
		$("#btnLingQu").attr("disabled",true);
		$.ajax({
			type:'post',
			url:"index.php?act=zhuanti&op=ad_20160415&action=Linqu",
			data:{city_id:city_id,area_id:area_id,area_info:area_info,true_name:true_name,address:address,mob_phone:mob_phone,prov:prov},
			dataType:'json',
			success:function(result){
				if(result.state){
					window.location.href="http://m.96567.com/index.php?act=member_buy&op=pay&pay_sn="+result.pay_sn;
				}else{
					alert(result.msg);
					$("#btnLingQu").attr("disabled",false);
				}
			}
		}); 
	});
</script>