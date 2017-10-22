<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">



<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/lepai_admin/date.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/lepai_admin/iscroll.js"></script>


<style>
.page {display: none;position: absolute;top: 0;left: 0;bottom: 0;right: 0;width: 100%;height: 100%;overflow: hidden;}
#datescroll div{float: left;margin-left: 10%;margin-top: 15px;padding-right: 22px;}
#datescroll_datetime div{float: left;margin-left: 10%;padding-right: 22px;}
#yearwrapper{position: absolute;left: 0;top:45px;bottom: 60px;width:80%;}
#monthwrapper{position: absolute;left: 26%;top:45px;bottom: 60px;width:80%;}
#daywrapper{position: absolute;left: 50%;top:45px;bottom: 60px;width:80%;}
#Hourwrapper{position: absolute;left: 0;top:195px;bottom: 68px;width:80%;}
#Minutewrapper{position: absolute;left: 26%;top:195px;bottom: 68px;width:80%;}
#Secondwrapper{position: absolute;left: 50%;top:195px;bottom: 68px;width:80%;}
#Hourwrapper ul li{color: #898989;font-size: 12px;}
#Minutewrapper ul li{color: #898989;font-size: 12px;}
#Secondwrapper ul li{color: #898989;font-size: 12px;}
#yearwrapper ul li{color: #898989;font-size: 12px;}
#monthwrapper ul li{color: #898989;font-size: 12px;}
#daywrapper ul li{color: #898989;font-size: 12px;}
#markyear{position:relative; margin-left: 76px;top:-2px;}
#markmonth{position:relative; margin-left: 40px;top:-2px;}
#markday{position:relative; margin-left: 42px;top:-2px;}
#markhour{position:relative; margin-left: 62px;top:-2px;}
#markminut{position:relative; margin-left: 58px;top:-2px;}
#marksecond{position:relative; margin-left: 68px;top:-2px;}
#dateheader{width: 100%;height: 50px;background: #79C12F;text-align: center;color: #fff;line-height: 50px;font-size: 20px;}
#setcancle ul{text-align: center;line-height: 30px; margin:1px auto;font-size: 20px;}
#setcancle ul li{border-radius:3px;float: left;width: 40%;height: 30px;list-style-type: none;font-family:'microsoft yahei';font-size:16px;}
#dateconfirm{position: absolute;background:#79C12F;left:20px;color:#fff;}
#datecancle{position: absolute;background:  #dcdddd;right:20px;width: 40%;color:#666;}
#dateshadow{display: none;position: absolute;width: 100%;top:0;left:0;background: #000; filter:alpha(Opacity=50);-moz-opacity:0.5;opacity: 0.5;}
#datePage{margin-top: 900px; font-size: 22px; border-radius: 3px; position:absolute;top:110px;MARGIN-RIGHT: auto;vertical-align:middle;
MARGIN-LEFT: auto;width: 80%;;height: 240px;background: #FFFFFF;z-index:9999999;}
#datetitle{width: 100%;height:50px;background: #79C12F;text-align: center;color: #fff;line-height: 50px;font-size: 20px;font-family:'microsoft yahei';}
#datetitle h1{font-weight:normal;}
#datemark{font-size: 18px;left:5%;width: 90%;height: 20px;position:absolute;top:108px;background:#eee;border:1px solid #eee;}
#timemark{font-size: 18px;left:5%;width: 90%;height: 20px;position:absolute;top:242px;background:#eee;border:1px solid #eee;}
#datescroll{background: #F8F8F8;width:94%; margin:10px 3%;border: 1px solid #E0E0E0;border-radius: 4px;height: 120px;text-align: center;line-height: 40px;}
#datescroll_datetime{display: none;background:#F8F8F8;width:94%; margin:10px 3%;margin-top: 10px;border: 1px solid #E0E0E0;border-radius: 4px;height: 120px;text-align: center;line-height: 40px;}
#yearwrapper ul,#monthwrapper ul,#daywrapper ul{width:40%;}
#Hourwrapper ul,#Minutewrapper ul,#Secondwrapper ul{width:40%;}
#dateFooter{width:100%;background: #fff;height: 50px;bottom: 0px;position: absolute;}
</style>

<!-- 默认城市联动 -->
<script>
  var SITEURL = '<?php echo BASE_SITE_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<!-- End -->



<form id="form_company_info" action="<?php echo urlWap('member_store_joinin','store_save');?>" method="post" enctype="multipart/form-data" >

<section>
  <div class="headline">
    <h1>公司资质信息</h1>
    <h2 class="mt">注意事项：</h2>
    <p>以下所需要上传的电子版资质文件仅支持JPG\GIF\PNG格式图片，大小请控制在1M之内。</p>
  </div>
      


  <div class="merchant">
        <h3>公司及联系人信息</h3>
      <div class="form-team">
        <label for=""><em>*</em>公司名称：</label>
        <input class="same1" type="text" value="" name="company_name" >
      </div>
      
      <div class="form-team">
        <label for=""><em>*</em>公司所在地：</label>
        <input id="company_address" name="company_address" type="hidden" value=""/>
      </div>  
      
      <div class="form-team">
        <label for=""><em>*</em>公司详细地址：</label>
        <input class="same1" type="text" value="" name="company_address_detail">
      </div>
      
      <div class="form-team">
        <label for=""><em>*</em>公司电话：</label>
        <input class="same1" type="text" value="" name="company_phone">
      </div>

      <!-- <div class="form-team">
        <label for=""><em>*</em>员工总数：</label>
        <input class="same1" type="text" value="" name="company_employee_count">
      </div> -->

      <div class="form-team">
        <label for=""><em>*</em>注册资金(万元)：</label>
        <input class="same1" type="text" value=""  name="company_registered_capital">
      </div> 

      <div class="form-team">
        <label for=""><em>*</em>联系人姓名：</label>
        <input class="same1" type="text" value="" name="contacts_name">
      </div>
      
      <div class="form-team">
        <label for=""><em>*</em>联系人电话：</label>
        <input class="same1" type="text" value="" name="contacts_phone">
      </div>            

      <div class="form-team">
        <label for=""><em>*</em>电子邮箱：</label>
        <input class="same1" type="text" value="" name="contacts_email">
      </div>
  </div>



  <div class="merchant">
        <h3>营业执照信息（副本）</h3>


      <div class="form-team">
        <label for=""><em>*</em>营业执照号：</label>
        <input class="same1" type="text" value="" name="business_licence_number">
      </div>
      
      <div class="form-team">
        <label for=""><em>*</em>营业执照所在地:：</label>
        <input id="business_licence_address" name="business_licence_address" type="hidden" />
      </div>  
      
      <div class="form-team">
        <label for=""><em>*</em>营业执照有效期:：</label>
        <input class="same1" type="text" value="" id="business_licence_start" name="business_licence_start">
        <input class="same1" type="text" value="" id="business_licence_end" name="business_licence_end">
                  
      </div>
      
      <div class="form-team">
        <label for=""><em>*</em>法定经营范围:</label>
        <textarea name="business_sphere" rows="" cols=""></textarea>
      </div>


      <div class="form-team">
        <label for=""><em>*</em>企业法人身份证：</label>
        <input class="same1 image" type="file" value="" name="business_legal_person_img"/>
        <p class="hint">请确保图片清晰。</p>
      </div>  
                 
      <div class="form-team">
        <label for=""><em>*</em>营业执照电子版：</label>
        <input class="same1 image" type="file" value="" name="business_licence_number_electronic"/>
        <p class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
      </div>
  </div>   






    

        




  <div class="merchant">
        <h3>一般纳税人证明</h3>
        <h4>注：所属企业具有一般纳税人证明时，此项为必填。</h4>
    <div class="form-team">
      <label for=""><em>*</em>一般纳税人证明：</label>
      <input class="same1 image" type="file" value=""  name="general_taxpayer" />
      <p class="hint">请确保图片清晰，文字可辨并有清晰的红色公章。</p>
    </div> 

<div id="datePlugin"></div>

  <div class="error-tips mt10"></div>

    <?php Security::getToken();?>
    <input type="hidden" name="form_submit" value='ok'>


    <div class="submit">
      <input class="btn-next" id="btn_apply_company_next" type="button" value="下一步">
    </div>   


  </div>

</section>

</form>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){


  $('#business_licence_start').date({theme:"time"});
  $('#business_licence_end').date({theme:"time"});



  $('#company_address').nc_region();
  $('#business_licence_address').nc_region();


  $('#form_company_info').validate({
        errorElement: "p",
        errorPlacement: function(error, element){
        error.appendTo($(".error-tips").show());
        },
        rules : {
            company_name: {
                  required: true,
              },
              company_address: {
                  required: true,
              },
              company_address_detail: {
                  required: true,
              },
              company_phone: {
                  required: true,
              },
              // company_employee_count: {
              //     required: true,
              // },
              company_registered_capital: {
                  required: true,
              },
              contacts_name: {
                  required: true,
              },
              contacts_phone: {
                  required: true,
              },
              contacts_email: {
                  required: true,
              },
              business_licence_number: {
                  required: true,
              },
              business_licence_address: {
                  required: true,
              },
              business_licence_start: {
                  required: true
              },
              business_licence_end: {
                  required: true
              },
              business_sphere: {
                  required: true,
              },
              business_licence_number_electronic: {
                  required: true
              },
              organization_code: {
                  required: true,
              },
              business_legal_person_img: {
                  required: true
              }

        },
        messages : {
            company_name: {
                  required: '请输入公司名称',
              },
              company_address: {
                  required: '请选择区域地址',
              },
              company_address_detail: {
                  required: '请输入公司详细地址',
              },
              company_phone: {
                  required: '请输入公司电话',
              },
              // company_employee_count: {
              //     required: '请输入员工总数',
              // },
              company_registered_capital: {
                  required: '请输入注册资金',
              },
              contacts_name: {
                  required: '请输入联系人姓名',
              },
              contacts_phone: {
                  required: '请输入联系人电话',
              },
              contacts_email: {
                  required: '请输入常用邮箱地址',
              },
              business_licence_number: {
                  required: '请输入营业执照号',
              },
              business_licence_address: {
                  required: '请选择营业执照所在地',
              },
              business_licence_start: {
                  required: '请选择生效日期'
              },
              business_licence_end: {
                  required: '请选择结束日期'
              },
              business_sphere: {
                  required: '请填写营业执照法定经营范围',
              },
              business_licence_number_electronic: {
                  required: '请选择上传营业执照电子版文件'
              },
              organization_code: {
                  required: '请填写组织机构代码',
              },
              business_legal_person_img: {
                  required: '请选择上传法人身份证'
              }
        }
    });



  $('#btn_apply_company_next').on('click', function() {
    if($('#form_company_info').valid()) {
      $('#company_address').next().attr('name','province_id');
        $('#form_company_info').submit();
    }
  });



})


</script>