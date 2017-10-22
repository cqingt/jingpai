<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

  <title>送拍中心-入驻机构，账户管理</title>

  <!--common-->
  <link href="<?php echo LEPAI_CSS_URL;?>/css/admin/style.css" rel="stylesheet">
  <link href="<?php echo LEPAI_CSS_URL;?>/css/admin/common-admin.css" rel="stylesheet">


<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_SITE_URL;?>/data/resource/js/jquery-ui/jquery.ui.js"></script>

  <link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>




  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">






<!-- wrapper start-->
  <div class="wrapper">



       <div class="content boxes mtop25">
            <div class="title"><span >专场创建<a href="index.php?act=lepai&op=theme" style="float:right;">返回</a></span></div>
            <div class="article">
                 <form action="index.php?act=lepai&op=doAddTheme" method="POST">
                 <div class="overflow issue has-name">
                      <label>专场标题</label>
                      <input required="required" name="T_Title" type="text" class="overflow issue-input" value="" placeholder="请输入专场标题">
                 </div>
                 <div class="overflow issue has-name">
                      <label>拍品数量</label>
                      <input required="required" name="T_Max" type="text" class="overflow issue-input" value="" placeholder="请输入拍品数量">
                 </div>
                 <div class="issue has-number number-date">
                       <label>开始时间</label>
                       <input required="required" id="beginTime" name="T_Ktime" type="textarea" class="overflow issue-input" value="">
                       <span class=""><a href=""></a></span>
                       <span class="describe-red">请选择3天（72小时）之后的时间作为开始时间</span>
                 </div>
                 <div class="issue has-number number-date">
                       <label>结束时间</label>
                       <input required="required" id="endTime" name="T_Jtime" type="textarea" class="overflow issue-input" value="">
                       <span class=""><a href=""></a></span>
                       <span class="describe-red">拍卖专场最长时间不超过3天（72小时）</span>
                 </div>
                 <div class="overflow issue has-cover">
                       <label>banner图</label>
                       <strong>
                       尺寸：1440px*320px，小于80k，显示在拍卖专场顶部
                       </strong>
                      <div class="cover-banner" id="divimg1" style="background-size:570px 125px;width:570px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img3.jpg)">
                        <input required="required" onchange="uploadImg('imgPhonto','divimg1','T_Topimg');" type="file" id="imgPhonto" name="imgPhonto"  style="width:570px;height:200px;opacity: 0;"  />
                        <input type="hidden" id="T_Topimg" name="T_Topimg" value="">
                      </div>
                 </div>
                 <div class="overflow issue has-cover">
                       <label>首 焦 图</label>
                       <strong>
                       尺寸：474px*230px，小于50k，显示在拍卖专场列表页
                       </strong>
                      <div class="cover-banner" id="divimg2" style="background-size:300px 130px;width:300px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img3.jpg)">
                        <input required="required" onchange="uploadImg('imgPhonto1','divimg2','T_Bottonimg');" type="file" id="imgPhonto1" name="imgPhonto"  style="width:300px;height:130px;opacity: 0;"  />
                        <input type="hidden" id="T_Bottonimg" name="T_Bottonimg" value="">
                      </div>
                  </div>
                 <div class="overflow issue has-describe">
                       <label>专场描述</label>
                       <!-- <textarea required="required" name="T_Content" id="T_Content" cols="" rows="" placeholder="请输入专场的描述"></textarea> -->
                       <?php showEditor('T_Content','','100%','480px','visibility:hidden;',"true");?></td>

                 </div>
                 <div class="overflow issue-gobtn"><input type="submit" class="go-btn" value="确认提交"></div>
                 
                 </form>
            </div>
       </div>
  </div>


        <!-- wrapper end-->
<div id="datePlugin"></div>


<script>
  $(function(){
    $("input[name='T_Shenghe']").click(function(){
      var v = $(this).val();

      if(v == 2){
        $("#T_Lose").show();
      }else{
        $("#T_Lose").hide();
      }
    });

  })



  function uploadImg(pid,id,vid){
    var data = new FormData();
    $.each($('#' + pid )[0].files, function(i, file){
      data.append('imgPhonto', file);
    })
    $.ajax({
        url:"index.php?act=lepai&op=ajaxUpload",
        type:"POST",
        data:data,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
          var u = "<?php echo LEPAI_Images_URL;?>";
          alert(data);
          $("#" + id ).css("background-image","url(" + u + data +")");
          $("#" + vid ).val(data);
        }
    });

}

</script>

<script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/attribute.js"></script>

<script>
  $(document).ready(function(){
    $('#beginTime').datetimepicker({
        controlType: 'select'
    });

    $('#endTime').datetimepicker({
        controlType: 'select'
    });
  })
</script>

</body>
</html>