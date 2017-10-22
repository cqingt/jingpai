<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="format-detection" content="telephone=no">
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
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/HHuploadify.css" />
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/HHuploadify.js" ></script>

        <!--mobiscroll -->
	    <script src="<?php echo M_TMP_DEF_URL;?>/mobiscroll/js/mobiscroll_002.js" type="text/javascript"></script>
	    <link href="<?php echo M_TMP_DEF_URL;?>/mobiscroll/css/mobiscroll.css" rel="stylesheet" type="text/css">
	    <script src="<?php echo M_TMP_DEF_URL;?>/mobiscroll/js/mobiscroll.js" type="text/javascript"></script>
	    <script src="<?php echo M_TMP_DEF_URL;?>/mobiscroll/js/data.js" type="text/javascript"></script>
        
	</head>
	<body class="demo" id="top">
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>个人资料</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">

			<div class="demo-item mtb">
			    <div class="demo-block">
			        <ul class="ui-list ui-list-one ui-list-link ui-border-tb">
<!--			            <li data-href="index.php?act=circle_member_information&op=updaname" class="ui-border-t">-->
			            <li data-href="#" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">用户名称:&nbsp;&nbsp;&nbsp;<input type="text" id="uname" value="<?php echo $output['member_info']['member_name']; ?>"></h4>
			                    <div class="ui-txt-info">未设置</div>
			                </div>
			            </li>
			            <li data-href="index.php?act=circle_member_information&op=bindemail" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">邮箱</h4>
			                    <div class="ui-txt-info">未设置</div>
			                </div>
			            </li>
			            <li data-href="" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">真实姓名&nbsp;&nbsp;&nbsp;<input type="text" id="truename" value="<?php echo $output['member_info']['member_truename']; ?>"></h4>
			                    <div class="ui-txt-info">未设置</div>
			                </div>
			            </li>
			            <li class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">性别</h4>
			                    <div class="ui-txt-info">
			                    	<span class="xb">保密</span>
			                    </div>
			                    <div class="ui-txt-info">
									<select class="gender" name="gender">
									        <option value="0"> 保密 </option>
									        <option value="1"> 男 </option>
									        <option value="2"> 女 </option>
									</select>
			                    </div>

			                </div>
			            </li>
			            <li data-href="" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">生日</h4>
			                    <span class="cc"><input name="appDate" id="appDate"  type="text" value="<?php echo $output['member_info']['member_birthday']; ?>"></span>
			                </div>
			            </li>
			            <li data-href="" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">所在地区</h4>
						        <!--选择地区-->
						        <section class="express-area">
						            <a id="expressArea" href="javascript:void(0)">
						                <dl>
						                    <dd class="shengshi">省 > 市 > 区/县</dd>
						                </dl>
						            </a>
						        </section>
						        <!--选择地区弹层-->
						        <section id="areaLayer" class="express-area-box">
						            <header>
						                <h3>选择地区</h3>
						                <a id="backUp" class="back" href="javascript:void(0)" title="返回"></a>
						                <a id="closeArea" class="close" href="javascript:void(0)" title="关闭"></a>
						            </header>
						            <article id="areaBox">
						                <ul id="areaList" class="area-list"></ul>
						            </article>
						        </section>
						        <!--遮罩层-->
						        <div id="areaMask" class="mask"></div>
						        <script src="<?php echo M_TMP_DEF_URL;?>/js/jquery.area.js"></script>
			                </div>
			            </li>
			            <li data-href="#" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">QQ&nbsp;&nbsp;&nbsp;<input type="text" id="qq" value="<?php echo $output['member_info']['member_qq']; ?>"></h4>
			                    <div class="ui-txt-info">未设置</div>
			                </div>
			            </li>
			            <li data-href="#" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">阿里旺旺&nbsp;&nbsp;&nbsp;<input type="text" id="ww" value="<?php echo $output['member_info']['member_ww'];?>"></h4>
			                    <div class="ui-txt-info">未设置</div>
			                </div>
			            </li>
			            <li data-href="" class="ui-border-t">
			                <div class="ui-list-info">
			                    <h4 class="ui-nowrap">头像
			                       <div class="head-portrait">头像默认尺寸为120x120像素<br/></div>
			                    </h4>
			                    <div class="ui-txt-info">
			                    	<div class="hpimg"><div id="upload"></div></div>
			                    </div>
			                </div>
					        <script>
					            $('#upload').HHuploadify({
					                auto:true,
					                showUploadedBar: false, // 默认情况下，会显示进度条，如果想只显示百分比，则应该关掉
					                showUploadedPercent: true,
					                fileTypeExts:'*.jpg;*.png;*.gif',
					                single : true,
					                showPreview: true,
					                fileSizeLimit:1024,
					                uploader:'index.php?act=circle_member_information&op=upload'
					            });
					        </script>
			            </li>
			            
			        </ul>
<!--					<div class="ui-btn-wrap">-->
<!--					<button class="dis-btn ui-btn-lg ui-btn-danger" id="button" disabled="">-->
<!--						保存-->
<!--					</button>-->
<!--					</div>-->
					<button id="button" class="dis-btn ui-btn-lg ui-btn-danger" >保存</button>
			    </div>
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

<script>
	$('#button').click(function(){
		var uname= $('#uname').val();
		var truename= $('#truename').val();
		var gender= $('.gender').val();
		var appDate= $('#appDate').val();
		var qq= $('#qq').val();
		var ww= $('#ww').val();
		var shengshi = $('.shengshi').html();
//		alert(uname);
		$.ajax({
			type: "post",
			url: "index.php?act=circle_member_information&op=upda",
			data: {uname:uname,truename:truename,gender:gender,appDate:appDate,qq:qq,ww:ww},
			dataType: "json",
			success: function (data) {
				if(data == 1){
					window.location.href='index.php?act=circle_sns_circle&mid=<?php echo $_SESSION['member_id']?>';
				}
			}
		});
	});


</script>
