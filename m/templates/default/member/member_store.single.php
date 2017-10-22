<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/js/total.js"></script>


  <section>


    <div class="headline">
      <h1>店铺资质信息</h1>
      <h2 class="mt">注意事项：</h2>
      <p>以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。</p>
    </div>

<form id="login_form" action="<?php echo urlWap('member_store_joinin','single_save');?>" method="post"  enctype="multipart/form-data" >

      <div class="merchant">

        <h3>店铺及联系人信息</h3>

        <div class="form-team">
          <label for=""><em>*</em>店铺名称：</label>
          <input class="same1" type="text" value="" name="company_name" id="company_name">
        </div>
        
        <div class="form-team">
          <label for=""><em>*</em>省:</label>

              <input id="company_address" name="company_address" type="hidden" value="">

              <select class="select-30"  id="prov_select" name="prov">
                <option value="">请选择...</option>

              <?php if($output['prov']){?>

                <?php foreach($output['prov']['area_list'] as $k => $v){?>
                    <option value="<?php echo $v['area_id'];?>"><?php echo $v['area_name'];?></option>
                <?php }?>

              <?php }?>   

              </select>

        </div>  


        <div class="form-team">
          <label for=""><em>*</em>市:</label>
          <select class="select-30" id="city_select" name="city">
            <option value="">请选择...</option>
          </select> 
        </div>


        <div class="form-team">
          <label for=""><em>*</em>区:</label>
          <select class="select-30" id="region_select" name="region">
            <option value="">请选择...</option>
          </select>
        </div>
        
        <div class="form-team">
          <label for=""><em>*</em>详细地址:</label>
          <input class="same1" type="text" value="" name="company_address_detail" id="company_address_detail">
        </div>
        
        <div class="form-team">
          <label for=""><em>*</em>联系人姓名:</label>
          <input class="same1" type="text" value="" name="contacts_name" id="contacts_name">
        </div>

        <div class="form-team">
          <label for=""><em>*</em>联系人电话:</label>
          <input class="same1" type="text" value="" name="contacts_phone" id="contacts_phone">
        </div> 

        <div class="form-team">
          <label for=""><em>*</em>电子邮箱:</label>
          <input class="same1" type="text" value="" name="contacts_email" id="contacts_email">
        </div>

      </div>



      <div class="merchant">
        <h3>身份证信息</h3>


        <div class="form-team">
          <label for=""><em>*</em>姓名:</label>
          <input class="same1" type="text" value="" name="business_sphere" id="business_sphere">
        </div>
        

        <div class="form-team">
          <label for=""><em>*</em>身份证号：</label>
          <input class="same1" type="text" value="" name="business_licence_number" id="business_licence_number">
        </div>              
        

        <div class="form-team">
          <label for=""><em>*</em>身份证扫描件：</label>
          <input class="same1 image" type="file" value="" name="business_licence_number_electronic" id="business_licence_number_electronic"/>
          <p class="hint">请确保图片清晰，身份证上文字可辨</p>
          <p class="hint">（清晰照片也可使用）</p>
        </div> 

        <div class="error-tips mt10"></div>

        <div class="submit">
          <input class="btn-next" type="submit" value="下一步">
        </div>  

        <?php Security::getToken();?>
        <input type="hidden" name="form_submit" value='ok'>
    </div>   

</form>

  </section>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>

    $(function(){
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^([\u4E00-\u9FA5|a-zA-Z])+$/i.test(value);
			
		}, ""); 
        $("#login_form").validate({

            errorElement: "p",

            errorPlacement: function(error, element){



            error.appendTo($(".error-tips").show());

            },

            rules: {
				company_name: {
					required: true,
					maxlength: 50,
					lettersonly: true,
					remote : '<?php echo urlWap('member_store_joinin','checkname');?>'
				},
                prov: "required",
                city: "required",
                region: "required",
                company_address_detail: "required",
                contacts_name: "required",
                contacts_phone: "required",
                contacts_email: "required",
                business_sphere: "required",
                business_licence_number: "required"
            },

            messages: {
                company_name: {
					required: '请填写店铺名称！',
					maxlength: '最多50个字！',
					lettersonly: '店铺名称只能为汉字或者字母！',
					remote : '店铺名称已存在，请更换！'
				},
                prov: "省必填！",
                city: "市必填！",
                region: "区必填！",
                company_address_detail: "详细地址必填！",
                contacts_name: "联系人必填！",
                contacts_phone: "联系人电话必填！",
                contacts_email: "电子邮箱必填！",
                business_sphere: "身份证姓名必填！",
                business_licence_number: "身份证号必填！"
            }

        });


        $("select[name=prov]").change(function(){
            
            var prov_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_ress','area_list');?>",
                data:{area_id:prov_id},
                dataType:'json',    
                success:function(result){

                    var data = result.datas;
                    var city_html = '<option value="">请选择...</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        city_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=city]").html(city_html);
                    $("select[name=region]").html('<option value="">请选择...</option>');
                    area_info_js();
                }
            });
        });



        $("select[name=city]").change(function(){
            var city_id = $(this).val();
            $.ajax({
                type:'post',
                url:"<?php echo urlWap('member_ress','area_list');?>",
                data:{area_id:city_id},
                dataType:'json',    
                success:function(result){
                    var data = result.datas;
                    var region_html = '<option value="">请选择...</option>';
                    for(var i=0;i<data.area_list.length;i++){
                        region_html+='<option value="'+data.area_list[i].area_id+'">'+data.area_list[i].area_name+'</option>';
                    }
                    $("select[name=region]").html(region_html);
                    area_info_js();
                }
            });
        });



        $("select[name=region]").change(function(){
            area_info_js();
        });


    })



    function area_info_js(){
        var prov_index = $('select[name=prov]')[0].selectedIndex;
        var city_index = $('select[name=city]')[0].selectedIndex;
        var region_index = $('select[name=region]')[0].selectedIndex;   
        var area_info = $('select[name=prov]')[0].options[prov_index].innerHTML+' '+$('select[name=city]')[0].options[city_index].innerHTML+' '+$('select[name=region]')[0].options[region_index].innerHTML;
        $("input[name=company_address]").val(area_info);
    }


</script>
