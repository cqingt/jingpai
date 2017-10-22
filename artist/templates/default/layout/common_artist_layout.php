<?php defined('InShopNC') or exit('Access Invalid!');

$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";
if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
{
    global $config;
    if(!empty($config['m_site_url'])){
        $url = $config['m_site_url'];
        switch ($_GET['act']){
            case 'goods':
                $url .= '/index.php?act=goods&op=index&goods_id=' . $_GET['goods_id'];
                break;
            case 'artist_new':
                $url .= '/index.php?act=artist&op=FenLei';
                break;
            default:
                $url = 'noheader';
                break;
        }
        //判定是否首页
        if($_GET['act'] == 'index' && $_GET['op'] == 'index'){
            $url = $config['m_site_url']."/index.php?act=artist";
        }
    } else {
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		
    }
    if($url != 'noheader'){
        header('Location:' . $url);
        exit();
    }

    if (!empty($Loaction))
    {
        header("Location: $Loaction\n");
        exit;
    }
}
?>
<!doctype html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['html_title'];?></title>
<meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
<meta name="description" content="<?php echo $output['seo_description']; ?>" />
<?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
<style type="text/css">
body {
_behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
}
</style>
<link rel="shortcut icon" href="<?php echo BASE_SITE_URL;?>/favicon.ico" />
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_header.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_login.css" rel="stylesheet" type="text/css">
<!-- <link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" /> -->


<!-- 艺术家 -->

<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/art.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/basis.css" rel="stylesheet" type="text/css">

<!-- End -->



<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_PNG.js"></script>
<script>
DD_belatedPNG.fix('.pngFix');
</script>
<script>
// <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
try{
document.execCommand("BackgroundImageCache", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->
<script>
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
_oztime = (new Date()).getTime();
</script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>


<!-- 艺术家 -->

<script src="<?php echo SHOP_TEMPLATES_URL;?>/js/owl.carousel.js"  charset="utf-8"></script>
<script src="<?php echo SHOP_TEMPLATES_URL;?>/js/main.js"  charset="utf-8"></script>


<!-- End -->


</head>
<body>



<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>


<?php if($output['sou_top'] !== true){?>

<?php require_once template('artist/common_top');?>

<?php }else{?>

<?php require_once template('artist/common_blog_top');?>

<?php }?>