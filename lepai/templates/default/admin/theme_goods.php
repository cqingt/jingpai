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
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/jquery-1.6.min.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/jquery.reveal.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/zDrag.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/zDialog.js"></script>



  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

    <!-- reveal-modal2 Start -->
     <div id="myModal2" >
     <div class="content boxes">
          <div class="info info-flet">
               <h1>拍品信息</h1>
               <ul>
                 <li class="li-info">起拍价</li>
                 <li class="li-info">加价幅度</li>
                 <li class="li-info">保证金</li>
                 <li>保留价</li>
                 <li class="li-info">操作</li>
               </ul>
          </div>
          <ul class="info-list">
            <input type="hidden" name="tid" id="goods_id" value="<?php echo $output['tgid'];?>">


              <?php foreach($output['result_g'] as $k=>$v){?>

               <li>
                  <div class="info-imag small-imag" ><a href=""><img src="<?php echo LEPAI_Images_URL.$v['G_MainImg'];?>" alt=""></a></div>
                  <div class="info-boxes">
                       <dl class="info-dl1 text-dl number-dd mtop25">
                         <dt>
                          <a href="">
                            <?php echo $v['G_Name'];?>
                          </a> 
                         </dt>
                         <dd>￥<?php echo $v['G_Qipai'];?></dd>
                         <dd>￥<?php echo $v['G_IncMoney'];?></dd>
                         <dd>￥<?php echo $v['G_BaoZhenMoney'];?></dd>
                         <dd>￥<?php echo $v['G_BaoliuMoney'];?></dd>
                       </dl>
                       <div class="info-dl1 function mtop42 pleft16"> 
                            <a class="give" href="javascript:baoming(<?php echo $v['G_Id'];?>);">我要送拍</a>
                       </div>
                  </div>
               </li>
<?php }?>


          </ul>
          <div class="page_common mbottom68 mright26">
                  <?php echo $output['page_g'];?>
          </div>
     </div>
            <a class="close-reveal-modal">&#215;</a>
     </div>
     <!-- reveal-modal End -->
     </body>
</html>

<script>
    function baoming(gid){
    var tid = $("#goods_id").val();
    if(confirm("确定要报名该专场吗？")){
      window.location.href="index.php?act=adminGoods&y=u&op=doThemeGoods&themeid="+tid+"&goodsid="+gid;
    }
  }
</script>