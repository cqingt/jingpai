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
  <section>
    <!-- left side start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="###"><img src="<?php echo LEPAI_CSS_URL;?>/images/admin/logo.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

             <!--sidebar nav start-->
             <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="menu-list <?php if(strtolower($_GET['act']) == strtolower('adminIndex')){echo 'nav-active';}?>"><a href="index.php?act=adminIndex&op=index"><i class="fa fa-user"></i><span>账户管理</span></a>
                </li>
                <li class="menu-list <?php if(strtolower($_GET['act']) == strtolower('adminGoods')){echo 'nav-active';}?>"><a href="index.php?act=adminGoods&op=index"><i class="fa fo-manage"></i><span>拍品管理</span></a>
                </li>
                <li class="menu-list <?php if(strtolower($_GET['act']) == strtolower('adminTheme')){echo 'nav-active';}?>"><a href="index.php?act=adminTheme&op=index"><i class="fa fs-manage"></i><span>专场管理</span></a>
                </li>
                <li class="menu-list <?php if(strtolower($_GET['act']) == strtolower('adminReport')){echo 'nav-active';}?>"><a href="index.php?act=adminReport&op=index"><i class="fa fa-apply"></i><span>送拍报名</span></a>
                </li>
                <li class="menu-list <?php if(strtolower($_GET['act']) == strtolower('adminOrder')){echo 'nav-active';}?>"><a href="index.php?act=adminOrder&op=index"><i class="fa ft-manage"></i><span>订单管理</span></a>
                </li>
                <li class="menu-last">
                    <a href="index.php">
                       <i class="fa fa-hammer"></i>
                       <span>进入拍卖惠</span>
                       <i><img src="<?php echo LEPAI_CSS_URL;?>/images/admin/luckyPai.png" alt=""></i>
                    </a>
                </li>
             </ul>
             <!--sidebar nav end-->

        </div>
    </div>
    <!-- left side end-->
    
    <!-- main content start-->
    <div class="main-content" >
        <!-- header section start-->
        <div class="header-section">
             <span class="menu-left">欢迎您！<span style="color:red;"><?php echo $_SESSION['member_name'];?></span></span>
             <span class="menu-right">客服热线：010-57468955</span>
        </div>
        <!-- header section end-->

<?php require_once($tpl_file);?>

    </div>
    <!-- main content end-->
</section>
<script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/attribute.js"></script>
</body>
</html>