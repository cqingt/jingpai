<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title><?php echo $output['html_title'];?></title>
		 <?php
            if($output['seo_keywords'] == '' || $output['seo_keywords'] == '收藏天下,'){
                $output['seo_keywords'] = '收藏天下,收藏,收藏品,人民币收藏,钱币收藏,纪念钞收藏,邮票收藏,金银币收藏,金银条收藏,书法字画,瓷器紫砂,玉器,珠宝';
            }
        if($output['description'] == '' || $output['description'] == '收藏天下,'){
            $output['description'] = '收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息。';
        }
        ?>
        <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
        <meta name="description" content="<?php echo $output['seo_description']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist/css/frozen.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist/css/navigation.css"/>
		<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist/dist/idangerous.swiper.css" />
		<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist/css/main.css">
		<?php if(!$output['ZhuanTiAdName']){ ?>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-1.9.js"></script>
		<?php } ?>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/dist/idangerous.swiper.js" ></script>
		<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/artist/js/main.js" ></script>
		<script>
		_oztime = (new Date()).getTime();
		</script>
	</head>

<body>
<?php if(!$output['no_header']){ ?>
	<?php if($output['IsIndex']){ ?>
	<header class="ui-header ui-header-positive">
		<!--<i class="ui-icon-return" onclick="history.back()"></i>-->
		<div class="ui-header-left">
			<i class="icon-logo">书画馆</i>
		</div>
		<div class="ui-in">
			<div class="ui-searchbar-wrap">
				
						<div class="ui-searchbar ui-border-radius">
						<form id="searchForm" name="searchForm" method="get" action="">
						<input type="hidden" name="act" value="goods">
						<input type="hidden" name="op" value="goods_list">
						<input type="hidden" name="type" value="ShuHua">
							<a href="javascript:;" onclick="checkSearchForms();"><i class="ui-icon-search"></i></a>
							
							<div class="ui-searchbar-input"><input value="" id="keyword" name="keyword"  type="text"  autocapitalize="off" onblur="if(this.value==''){this.value='请输入搜索关键字';}" onfocus="if(this.value=='请输入搜索关键字'){this.value='';}"></div>
							<i class="ui-icon-close"></i>
							
				</form>
						</div>
			</div>

			 <script>
			   function checkSearchForms(){
				        if(document.getElementById('keyword').value == '请输入商品名称' || document.getElementById('keyword').value == ""){
				         return false;
				        }
				        document.getElementById('searchForm').submit();
			   }
			   </script>
			<script type="text/javascript">
				$('.ui-searchbar').click(function(){
					$('.ui-searchbar-wrap').addClass('focus');
					$('.ui-searchbar-input input').focus();
				});
				$('.ui-searchbar-cancel').click(function(){
					$('.ui-searchbar-wrap').removeClass('focus');
				});
			</script>
		</div>
		
		<?php if(intval($_SESSION['member_id']) <= 0) {?>
				<div class="ui-header-right">
					<button onclick="window.location.href='<?php echo urlWap('login','index');?>'">登录</button>
				</div>
			<?php }else{ ?>
			
            <?php } ?>
	</header>
	<?php }else{ ?>
		<header class="ui-header ui-header-positive">
			<i class="ui-icon-return" onclick="history.back()"></i>
			<?php if($output['ShuaHuaTiTle']){?>
			<div class="ui-in in-two">
				<div class="tabs">
					<a href="javascript:void(0);" class="active">商品</a>
					<a href="javascript:void(0);">详情</a> 
					<a href="javascript:void(0);">评论</a>
				</div>
			</div>
			<?php }else{ ?>

			<div class="ui-in in-two">
		    	<h2><?php echo $output['ShuaHuaTiTle'];?></h2>
		    </div>
			<?php } ?>

			<div class="ui-header-right">
				<a class="icon-navtc" href="javascript:void(0);" title="菜单"></a>
			</div>
		</header>
				
		<section>
			
			<div class="footerNav nofixed">
				<div class="ui-row-flex ui-border-b">
					<div data-href="<?php echo urlWap('index','index');?>" class="ui-col ui-col">
						<i class="icon-home-nav1"></i>
						<p>商城首页</p>
					</div>
					<div data-href="<?php echo urlWap('artist','FenLei');?>" class="ui-col ui-col">
						<i class="icon-home-nav2"></i>
						<p>选画中心</p>
					</div>
					<div class="ui-col ui-col" data-href="<?php echo urlWap('member_cart','cart_list')?>">
						<i class="icon-home-nav3"></i>
						<p>购物车</p>
					</div>
					<div class="ui-col ui-col" data-href="<?php echo urlWap('member','home');?>">
						<i class="icon-home-nav4"></i>
						<p>个人中心</p>
					</div>
				</div>
			</div>
			</section>
			<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/navigation.css">
			<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
	<?php } ?>

	<?php } ?>