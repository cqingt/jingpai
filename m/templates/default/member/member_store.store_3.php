<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/demo.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/has.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/css/merchant.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhaoshang/fonts/font-awesome-4.3.0/css/font-awesome.min.css">

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>



<style>
#btn_add_category{
margin-top: 20px;
background: #d43c3b;
height: 40px;
color: #fff;
width: 100%;
outline: none;
border: 0;
border-radius: 4px;
}


#table_category{
width: 100%;
margin: 0 auto;
border: solid 1px #DDD;
}

</style>


<script type="text/javascript">

// var SITEURL = '<?php echo SHOP_SITE_URL;?>';

// $(document).ready(function(){

//     gcategoryInit("gcategory");


//     $('#btn_add_category').on('click', function() {
//         var tr_category = '<tr class="store-class-item">';
//         var category_id = '';
//         var category_name = '';
//         var class_count = 0;
//         var validation = true;
//         var i = 1;
//         $('#gcategory').find('select').each(function() {
//             if(parseInt($(this).val(), 10) > 0) {
//                 var name = $(this).find('option:selected').text();
//                 tr_category += '<td>';
//                 tr_category += name;
//                 if ($('#gcategory > select').size() == i) {
//                     //最后一级显示分佣比例
//                     tr_category += ' (分佣比例：' + $(this).find('option:selected').attr('data-explain') + '%)';
//                 }
//                 tr_category += '</td>';
//                 category_id += $(this).val() + ',';
//                 category_name += name + ',';
//                 class_count++;
//             } else {
//                 validation = false;
//             }
//             i++;
//         });
//         if(validation) {
//             for(class_count; class_count < 3; class_count++) {
//                 tr_category += '<td></td>';
//             }
//             tr_category += '<td><a nctype="btn_drop_category" href="javascript:;">删除</a></td>';
//             tr_category += '<input name="store_class_ids[]" type="hidden" value="' + category_id + '" />';
//             tr_category += '<input name="store_class_names[]" type="hidden" value="' + category_name + '" />';
//             tr_category += '</tr>';
//             $('#table_category').append(tr_category);
//             // $('#gcategory').hide();
//             // $('#btn_select_category').show();
//             select_store_class_count();
//         } else {
//             alert('请选择分类');
//         }
//     });


//     $('#table_category').on('click', '[nctype="btn_drop_category"]', function() {
//         $(this).parent('td').parent('tr').remove();
//         select_store_class_count();
//     });

//     // 统计已经选择的经营类目
//     function select_store_class_count() {
//         var store_class_count = $('#table_category').find('.store-class-item').length;
//         $('#store_class').val(store_class_count);
//     }


//     $('#sg_id').on('change', function() {
//         if($(this).val() > 0) {
//             $('#grade_explain').text($(this).find('option:selected').attr('data-explain'));
//             $('#sg_name').val($(this).find('option:selected').text());
//         } else {
//             $('#sg_name').val('');
//         }
//     });

//     $('#sc_id').on('change', function() {
//         if($(this).val() > 0) {
//             $('#sc_name').val($(this).find('option:selected').text());
//         } else {
//             $('#sc_name').val('');
//         }
//     });


// })
// </script>




<form id="login_form" action="<?php echo urlWap('member_store_joinin','store_3_save');?>" method="post">



<section>
    <div class="headline">
      <h1>店铺经营信息</h1>
      <h2 class="mt">注意事项：</h2>
      <p>店铺经营类目为商城商品分类，请根据实际运营情况添加一个或多个经营类目。</p>
    </div>
    
    <div class="merchant">

    <div class="form-team">
      <label for=""><em>*</em>商家账号：</label>
      <input class="same1" type="text" value="" id="seller_name" name="seller_name">
      <p class="hint">此帐号为日后登录并管理商家中心时使用</p>
      <p class="hint">注册后不可修改  请牢记</p>
    </div>  

    <div class="form-team">
      <label for=""><em>*</em>店铺名称：</label>
      <input class="same1" type="text" value="" name="store_name">
      <p class="hint">店铺名称注册后不可修改  请认真填写</p>
    </div> 

<!--     <div class="form-team">
        <label for=""><em>*</em>店铺等级:</label>
        <select  name="sg_id" id="sg_id" onchange="store_lv($(this).val());">
          <option value="0">-请选择-</option>
          <?php if(!empty($output['grade_list']) && is_array($output['grade_list'])){ ?>
          <?php foreach($output['grade_list'] as $k => $v){ ?>
          <?php $goods_limit = empty($v['sg_goods_limit'])?'不限':$v['sg_goods_limit'];?>
          <?php $explain = '商品数：'.$goods_limit.' 模板数：'.$v['sg_template_number'].' 收费标准：'.$v['sg_price'].'元/年  附加功能：'.$v['function_str'];?>
          <option  id="lv_<?php echo $v['sg_id'];?>" value="<?php echo $v['sg_id'];?>" data-explain="<?php echo $explain;?>"><?php echo $v['sg_name'];?></option>
          <?php } ?>
          <?php } ?>                
        </select>
        
  <input id="sg_name" name="sg_name" type="hidden" />

        <p class="hint sg_id_lv"></p>

    </div> 


    <div class="form-team">
        <label for=""><em>*</em>开店时长：</label>
        <select name="joinin_year" id="joinin_year">
          <option value="1">1 年</option>
          <option value="2">2 年</option>
        </select>
        
    </div>


    <div class="form-team">
        <label for=""><em>*</em>店铺分类:</label>
        <select name="sc_id" id="sc_id">
          <option value="0">-请选择-</option>
          <?php if(!empty($output['store_class']) && is_array($output['store_class'])){ ?>
          <?php foreach($output['store_class'] as $k => $v){ ?>
          <option value="<?php echo $v['sc_id'];?>"><?php echo $v['sc_name'];?> (保证金：<?php echo $v['sc_bail'];?> 元)</option>
          <?php } ?>
          <?php } ?>                
        </select>

<input id="sc_name" name="sc_name" type="hidden" />

        <p class="hint">请根据您所经营的内容认真选择店铺分类，注册后商家不可自行修改</p>
    </div> 

  

  <div class="form-team" id="gcategory">

        <label for=""><em>*</em>添加经营类目:</label>

        <select id="gcategory_class1">
          <option value="0">请选择</option>
          <?php if(!empty($output['gc_list']) && is_array($output['gc_list']) ) {?>
          <?php foreach ($output['gc_list'] as $gc) {?>
          <option value="<?php echo $gc['gc_id'];?>" data-explain="<?php echo $gc['commis_rate'];?>"><?php echo $gc['gc_name'];?></option>
          <?php }?>
          <?php }?>
        </select>
  
        <input class="btn-next"  id="btn_add_category" type="button" value="确认">

  <input id="store_class" name="store_class" type="hidden" />


  </div>

 


 <div class="form-team">

  <table border="0" cellpadding="0" cellspacing="0" id="table_category" class="type">
    <thead>
      <tr>
        <th>一级类目</th>
        <th>二级类目</th>
        <th>三级类目</th>
        <th>操作</th>
      </tr>
    </thead>
  </table>
</div> -->

    <div class="error-tips mt10"></div>
    
    <?php Security::getToken();?>
    <input type="hidden" name="form_submit" value='ok'>

    <div class="submit">
      <input class="btn-next" type="submit" value="提交申请">
    </div>
    </div>
            
</section>

</form>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script>
$(function(){
  $("#login_form").validate({
      errorElement: "p",
      errorPlacement: function(error, element){
      error.appendTo($(".error-tips").show());
      },

      rules: {
          seller_name: {
                required: true,
            },
            store_name: {
                required: true,
            },
            // sg_name: {
            //     required: true
            // },
            // sc_name: {
            //     required: true
            // },
            // store_class: {
            //     required: true,
            //     min: 1
            // }
      },

      messages: {
          seller_name: {
                required: '请填写卖家用户名',
            },
            store_name: {
                required: '请填写店铺名称',
            },
            // sg_name: {
            //     required: '请选择店铺等级'
            // },
            // sc_name: {
            //     required: '请选择店铺分类'
            // },
            // store_class: {
            //     required: '请选择经营类目',
            //     min: '请选择经营类目'
            // }
      }

  });

})


</script>




<script>

  function store_lv(id){
    var v = $("#lv_" + id).attr("data-explain");
    if(!!v){
      $(".sg_id_lv").text(v);
    }else{
      $(".sg_id_lv").text('');
    }
  }

</script>