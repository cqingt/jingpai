<?php defined('InShopNC') or exit('Access Invalid!');?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
		<script>
		_oztime = (new Date()).getTime();
		</script>
    </head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/navigation.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<?php if(!$output['ZhuanTiAdName']){ ?>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-1.9.js"></script>
<?php } ?>
<?php if(!$output['no_header']){ ?>
<header id="header">

    <div class="header-wrap">

<?php if($output['app_'] !== true){ ?>

        <a 

        <?php if($output['FH_Index'] == 'index'){?>
          href="http://m.96567.com/" 
        <?php }else{ ?>
          href="javascript:history.back();"
        <?php }?>


           class="header-back">
            <i class="fa fa-angle-left fa-2x"></i>
        </a>

<?php }else{ ?>
<a class="header-back" onclick="appHeaderBack()"><i class="fa fa-angle-left fa-2x"></i></a>
<?php } ?>


        <h2><?php echo $output['nav_title'];?></h2>
        
<?php if($output['app_'] !== true){ ?>

        <a href="javascript:void(0)" id="btn-opera" class="i-main-opera">
            <i class="fa fa-bars fa-lg"></i>
        </a>

<?php }else{$_SESSION['is_login'] = 1;file_put_contents('app_session.txt',print_r($_SESSION,true),FILE_APPEND);}?>


    </div>

    <div class="main-opera-pannel">
        <div class="main-op-table main-op-warp">
            <a href="<?php echo urlWap('artist','index');?>" class="quarter">
                <i class="fa fa-home fa-2x"></i>
                <p>首页</p>
            </a>
            <a href="<?php echo urlWap('artist','FenLei');?>" class="quarter">
                <i class="fa fa-list-ul fa-2x"></i>
                <p>选画中心</p>
            </a>
            <a href="<?php echo urlWap('member_cart','cart_list')?>" class="quarter"><i class="fa fa-shopping-cart fa-2x"></i><p>购物车</p></a>
            <a href="<?php echo urlWap('member','home');?>" class="quarter"><i class="fa fa-user fa-2x"></i><p>我的商城</p></a>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
                $("#btn-opera").click(function(event) {
                    $(".main-opera-pannel").toggle();
                });
            });
    </script>
</header>
<?php } ?>