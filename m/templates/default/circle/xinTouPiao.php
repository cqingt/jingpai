<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $lang['circle_shoucang'];?></title>
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
	<a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
	<h1><?php echo $output['circle_info']['circle_name'];?></h1>
	<div class="ui-fr-btn"></div>
</header>

<section class="ui-container">
	<ul class="new-nav-ht">
		<li data-href="index.php?act=circle_theme&op=new_theme&c_id=<?php echo $output['c_id'];?>"><?php echo $lang['circle_new_theme'];?></li>
		<li class="active" data-href="javascript:void(0);"><?php echo $lang['circle_new_poll'];?></li>
	</ul>
	<div class="demo-item">
		<div class="demo-block">
			<div class="ui-form">
				<form action="index.php?act=circle_theme?op=save_theme&c_id=<?php echo $output['c_id'];?>">
					<input type="hidden" id="c_id" value="<?php echo $output['circle_info']['circle_id'];?>">
					<?php echo $output['circle_info']['theme_id'];?>
					<div class="ui-form-item">
						<label><?php echo $lang['nc_title'];?>：</label>
						<input class="inputxt" id="title" type="text" placeholder="">
						</a>
					</div>
					<div class="ui-label-box">
						<label><?php echo $lang['circle_poll_options']	;?>：<strong><?php echo $lang['circle_poll_patterns'];?></strong></label>
						<input class="inputxt2" type="number" name="days"><?php echo $lang['nc_day'];?>
						</a>
					</div>
					<div class="ui-form-item-txt">
						<h5><?php echo $lang['circle_poll_options_max'];?></h5>
					</div>
					<div class="ui-label-box">
						<label><?php echo $lang['circle_poll_patterns'];?>：</label>
						<div class="ui-form">
							<form action="#">
								<div class="ui-form-item-radio fl mr">
									<label class="ui-radio" for="radio">
										<input type="radio" checked="" name="multiple" value="0">
									</label>
									<p><?php echo $lang['circle_poll_radio'];?></p>
								</div>
								<div class="ui-form-item-radio">
									<label class="ui-radio" for="radio">
										<input type="radio" name="multiple" value="1">
									</label>
									<p><?php echo $lang['circle_poll_chexkbox'];?></p>
								</div>
							</form>
						</div>
						</a>
					</div>
					<div class="demo-select">
						<div class="demo-co">
							<div class="co">
								<input class="uiiInput" name="uiiInput[]" type="text" placeholder="请输入">
							</div>
						</div>
						<div class="ui-add">+<?php echo $lang['circle_add_new'];?></div>
					</div>
					<div class="ui-form-item-textarea">
						<label><?php echo $lang['content'];?>：</label>
						<textarea class="inputxt" name="" id="themecontent" rows="" cols=""></textarea>
						</a>
					</div>
					<div class="ui-btn-wrap">
						<input type="submit" class="ui-btn-danger" value="<?php echo $lang['nc_release_op'];?>">
					</div>
				</form>
			</div>
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
	$('.ui-btn-danger').click(function(){
		var name = $('#title').val();
		var days = $('.inputxt2').val();
		var c_id = $('#c_id').val();
		var polloption = "";
		$(".uiiInput").each(function(){
			polloption += $(this).val() + "-";
		});
		var themecontent = $('#themecontent').val();

		var multiple = $('input[name="multiple"]:checked').val();
//		alert(multiple);
		$.ajax({
			url:"<?php echo M_CIRCLE;?>/index.php?act=circle_theme&op=theme_poll&sp=1&c_id="+c_id,
			type:"POST",
			data:{'name':name,'themecontent':themecontent,'days':days,'polloption':polloption,'c_id':c_id,'multiple':multiple},
			success:function(data)
			{
				if(data){
					window.location.href='<?php echo M_CIRCLE;?>/index.php?act=circle_theme&op=poll_detail&c_id='+c_id+'&t_id='+data;
				}
			}
		});
	})
</script>
