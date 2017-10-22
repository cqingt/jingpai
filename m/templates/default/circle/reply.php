<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
		<title>收藏天下圈子</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/tzxy/css/normalize.css" />


        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/member.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/navigation.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/main.css" />
        <link rel="stylesheet" href="http://m.96567.com/templates/default/css/new_page.css" />
        <script type="text/javascript" src="http://m.96567.com/templates/default/js/jquery-1.9.js"></script>
        
		<!-- New -->
		<link rel="stylesheet" type="text/css" href="<?php echo M_TMP_DEF_URL;?>/css/circle.css"/>
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.css">
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/frozen.css" />
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>

	</head>
	<body class="demo" id="top">
		  <header class="home-header">
		 	 <a data-href="index.php?act=circle_theme&op=theme_detail&c_id=<?php echo $output['c_id']?>&t_id=<?php echo $output['t_id'];?>"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>回复</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">

			<div class="demo-item mtb">
			    <div class="demo-block">
					<div class="ui-form ui-border-t">
					    <form action="index.php?act=circle_theme&op=save_reply&c_id=<?php echo $output['c_id']?>&t_id=<?php echo $output['t_id'];?>" method="post">
					        <div class="ui-form-item ui-form-item-pure ui-border-b">
					            <input class="uiInput" type="text" name="replycontent" placeholder="文明用语,杜绝网络暴力，谢谢">
					            <a href="#" class="ui-icon-close"></a>
					        </div>
					</div>
			    </div>
				<div class="ui-btn-wrap">
					<input type="submit" value="发表" class="dis-btn ui-btn-lg ui-btn-danger">
				</div>
				</form>
			</div>
		 </section>
		  
          <div class="log-in-navigation">
			  <?php if($_SESSION['member_id']){?>
				  <a class="" href="index.php?act=login&op=login_out">退出</a>
			  <?php }else{?>
				  <a class="" href="http://m.96567.com/index.php?act=login&op=index">登录</a>
				  <a class="" href="http://m.96567.com/index.php?act=login&op=register">注册</a>
			  <?php }?>
	  	 	  <a class="back-to-top" href="#top">返回顶部<i class="icon-arrow-up"></i></a>
	  	  </div>
          <div class="copyright">

		  </div>
		  <?php require_once('footer.php');?>
	</body>
</html>

<!--<script>-->
<!--    $('#button').click(function(){-->
<!--        var apply_reason = $('.uiInput').val();-->
<!--//        alert(apply_reason);-->
<!--        $.ajax({-->
<!--            url:"index.php?act=circle_group&op=manage_applyinfo",-->
<!--            type:"POST",-->
<!--            data:{'apply_reason':apply_reason},-->
<!--            beforeSend: function(){-->
<!--                alert("this before send");-->
<!--            },-->
<!--            success:function(data)-->
<!--            {-->
<!--                alert(data+"123");-->
<!--            }-->
<!--        });-->
<!---->
<!--    })-->
<!--</script>-->
