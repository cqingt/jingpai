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
		<link rel="stylesheet" href="<?php echo M_TMP_DEF_URL;?>/css/HHuploadify.css" />
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/total.js" ></script>
        <script src="<?php echo M_TMP_DEF_URL;?>/dist/idangerous.swiper.min.js"></script>
        <script type="text/javascript" src="<?php echo M_TMP_DEF_URL;?>/js/HHuploadify.js" ></script>
        
	</head>
	<body class="demo" id="top">
		  <header class="home-header">
		 	 <a onclick="history.back()"><i class="fa fa-angle-left fa-lg"></i></a>
		 	 <h1>上传照片</h1>
		 	 <div class="ui-fr-btn"></div>
		  </header>

		  <section class="ui-container">
		  	<div class="write-form j-write">
		  		<div class="write-text">
		  			<textarea id="photoDescTxt" placeholder="添加图片描述…" style="height: 30px;"></textarea>
		  		</div>
		  		<div class="J_photoPicker">
			        <div id="upload3"></div>
			        <script>

			            $('#upload3').HHuploadify({
			            	ime:true,
			                auto:true,
			                showUploadedBar: false, // 默认情况下，会显示进度条，如果想只显示百分比，则应该关掉
			                showUploadedPercent: true,
			                fileTypeExts:'*.jpg;*.png;*.gif',
			                showPreview: true,
			                fileSizeLimit:1024,
						    scriptData:{'category_id':$('#category_id').val()},
//							 formData:{'category_id':$('#category_id').val()},
			                uploader:'index.php?act=circle_sns_album&op=swfupload',
			                onUploadSuccess: function(file, data) {//上传每个完成事件
								if(data == 1){
									self.location='<?php echo M_CIRCLE;?>/index.php?act=circle_sns_album&op=index';
								}
						    }
						});

			        </script>
		  		</div>
				<div class="ui-btn-wrap tc mb">
					<button class="ui-btn ui-btn-danger">上传</button>
					<button class="ui-btn ui-btn-progress"><a href="javascript:jQuery('#upload3').uploadifyClearQueue()">取消</a></button>
				</div>
				
				<div class="write-option">
					<div class="write-field J_selectAlbumBtn ui-border-tb">    
						<span class="field-txt">上传到</span>    
						<div class="album-info j-album-info">
							<span class="album-cover" style="background: url(images/1120036787b213839al.jpg);")></span>
							<select name="category_id" id="category_id" class="select w80">
								<?php foreach ($output['ac_list'] as $v){?>
									<option value='<?php echo $v['ac_id']?>' class="w80"><?php echo $v['ac_name']?></option>
								<?php }?>
							</select>
						</div>  
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
