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

 
<input type="hidden" name="goods_id" id="goods_id" value="<?php echo $output['tgid'];?>">



     <!-- reveal-modal Start -->
     <div id="myModal" >
     <div class="content boxes">
          <div class="info mleft376">
               <h1>专场信息</h1>
               <ul>
                 <li class="li-info">开始时间</li>
                 <li class="li-info">结束时间</li>
                 <li>拍品数量</li>
                 <li class="li-info">操作</li>
               </ul>
          </div>
          <ul class="info-list">


<?php foreach($output['result_theme'] as $k=>$v){?>

<li>
  <div class="info-imag big-imag" ><a href=""><img src="<?php echo LEPAI_Images_URL.$v['T_Bottonimg'];?>" alt=""></a></div>
  <div class="info-boxes">
       <dl class="info-dl1 text-dl number-dd mtop16">
         <dt>
          <a href="">
            <?php echo $v['T_Title'];?>
          </a> 
         </dt>
         <dd class="tow-line"><?php echo date('Y-m-d h:i:s',$v['T_Ktime']);?></dd>
         <dd class="tow-line"><?php echo date('Y-m-d h:i:s',$v['T_Jtime']);?></dd>
         <dd><?php echo $v['T_Sum'];?>/<?php echo $v['T_Max'];?></dd>
       </dl>
       <div class="info-dl1 function mtop32 pleft16">
            <a class="give" href="Javascript:baoming(<?php echo $v['T_Id'];?>);">我要报名</a>
       </div>
  </div>
</li>

<?php }?>



          </ul>
          <div class="page_common mbottom68 mright26"><?php echo $output['page_theme'];?></div>
     </div>
            <a class="close-reveal-modal">&#215;</a>
     </div>
     <!-- reveal-modal End -->
     </body>
</html>

<script>
    function baoming(tid){
    var gid = $("#goods_id").val();
    if(confirm("确定要报名该专场吗？")){
      parent.location.href="index.php?act=adminGoods&op=doThemeGoods&themeid="+tid+"&goodsid="+gid;
    }
  }
</script>