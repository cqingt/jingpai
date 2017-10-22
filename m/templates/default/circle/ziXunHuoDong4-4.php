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
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/HHuploadify.css">
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/HHuploadify.js"></script>
        
	</head>
	<body class="demo" id="top">
		  <header class="home-header">
			  <a data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['circle_info']['circle_id']?>"><i class="fa fa-angle-left fa-lg"></i><?php echo $output['circle_info']['circle_name']?></a>
			  <h1></h1>
		  </header>

		  <section class="ui-container">
		  	<div class="demo-item">
		  		<div class="demo-block">
					<ul class="ui-row-flex ui-whitespace ringbox">
						<li class="ui-col ui-col">
							<div class="ui-avatar-lg">
								<img src="http://a3.topitme.com/d/3e/4a/1104659916f404a3edl.jpg"/>
							</div>
							<div class="what-ring">
								<h5 class="ui-nowrap"><?php echo $output['circle_info']['circle_name'];?></h5>
								<h6>
									<a href="">圈主</a>
								</h6>
							</div>
						</li>
						<li class="ui-col ui-col">
							<p class="icon-manage">管理中心</p>
						</li>
					</ul>
		  		</div>
		  	</div>
		  	
		  	<div class="demo-tiem">
				<div class="ui-row-flex ui-whitespace manPilot">
					<div data-href="index.php?act=circle_manage&op=index&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">设置</div>
					<div data-href="index.php?act=circle_manage&op=member_manage&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">成员</div>
					<div data-href="index.php?act=circle_manage&op=applying&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">审核</div>
					<div data-href="index.php?act=circle_manage&op=class&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col active">分类</div>
					<div data-href="index.php?act=circle_manage_mapply&c_id=<?php echo $output['c_id'];?>" class="ui-col ui-col">申请管理</div>
				</div>
		  	</div>
		  	
			<div class="demo-bf pt">
				<div class="demo-block">
					<ul class="ui-row ui-member">
					    <li class="ui-col ui-col-33">名称</li>
					    <li class="ui-col ui-col-33">排序</li>
					    <li class="ui-col ui-col-33">操作</li>
					</ul>
					<?php foreach ($output['thclass_list'] as $val){?>
					<ul class="ui-row ui-member">
						<li class="ui-col ui-col-33"><?php echo $val['thclass_name'];?></li>
						<li class="ui-col ui-col-33"><?php echo $val['thclass_sort'];?></li>
						<li class="ui-col ui-col-33">
							<a href="index.php?act=circle_manage&op=class_edit&inajax=1&c_id=<?php echo $output['c_id'];?>&thc_id=<?php echo $val['thclass_id'];?>">编辑</a>
							<a href="index.php?act=circle_manage&op=class_del&inajax=1&c_id=<?php echo $output['c_id'];?>&thc_id=<?php echo $val['thclass_id'];?>">删除</a>
						</li>
					</ul>
					<?php }?>
					<ul class="ui-row ui-whitespace ui-dimtitle">
				    	<div class="ui-col ui-col-33">
							<label id="classifyAll" class="ui-checkbox">
							    <input type="checkbox">
							</label>
							<span id="txtAll">全选</span>
				    	</div>
				    	<div class="ui-col ui-col-33">
				    		<button class="btnd-delete">多选删除</button>
				    	</div>
				    	<div class="ui-col ui-col-33">
				    		<button class="btnd-addcf">添加分类</button>
				    	</div>
					</ul>
					
					<ul class="ui-whitespace ui-border-b ui-dim">
					</ul>
 
				</div>
			</div>
			<script type="text/javascript">
				$(function(){
					var CyAll = $('#classifyAll'),
					    iCk = $('.ui-dim'),
					    txtAll = $('#txtAll'),
					    BdEle = $('.btnd-delete'),
					    dimDele = $('.ui-dim .btn-delete'),
					    ulList = $('.ui-dim li'),
					    baf = $('.btnd-addcf'),
					    fenLeiName = $('.fenLeiName');
					    uDivFc = $('.ui-dimtitle>div:first-child');
					    Nr = 1;

							/* 全选 */
					    CyAll.click(function(){
						    iCk.find('input').each(function(){
						    	 if(this.checked = !this.checked){
						    	 	$(this).prop('checked',true)
						    	 	txtAll.html('取消');
						    	 } else {
						    	 	$(this).prop('checked',false)
						    	 	txtAll.html('全选');
						    	 }
						    })
					    })

							/* 删除所选分类 */
					    BdEle.click(function () {
					        iCk.find('li').each(function () {
					            if ($(this).find('input').prop("checked")) {
					                $(this).remove();
					                BdEle.css('background','#999')
					                txtAll.html('全选');
					                $('#classifyAll input').attr('checked',false);
					            }
					        })
					    })

							/* 添加分类 */
					    baf.on('click',function(){
					    	$('.ui-dim').append('<li class="ui-row ui-border-b"><div class="ui-col ui-col-33"><label class="ui-checkbox"><input type="checkbox"></label><input class="txtd" type="text" placeholder="分类名" disabled=""></div><div class="ui-col ui-col-33"><span class="flnumber">'+(Nr)+'</span></div><div class="ui-col ui-col-33"><button type="button" class="btn btn-compile" onclick="change(this)">修改</button><a class="btn-delete" href="javascript:void(0);"">删除</a></div></li>');
					        Nr++;	
						    var l = $(".ui-dim").find("li").length;
							if(l>=1){
							    $('.ui-dimtitle>div:first-child').show();
							} 
					    })

						/* 删除分类 */
						iCk.on('click','li .btn-delete',function () {
					        $(this).closest('li').remove();

						})

						/* 编辑分类 */
						iCk.on('click','li .btn-compile',function () {
							var inp = $(this).parents('li').find('input.txtd');
							inp.removeAttr('disabled');
							inp[0].focus();
							
							$('input.txtd').blur(function() {
							    $(this).attr('disabled',true);
							});	
					 })

				})
			
	
			</script>

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
