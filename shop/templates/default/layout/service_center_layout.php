<?php defined('InShopNC') or exit('Access Invalid!');?>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
    <title><?php echo $output['html_title'];?>&nbsp;&nbsp;&nbsp;&nbsp;服务中心</title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
    <?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/servicecenter/css/basis.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/servicecenter/css/main.css" rel="stylesheet" type="text/css">
    <script src="http://resource.96567.com/js/jquery.js"></script>
    <script src="<?php echo SHOP_TEMPLATES_URL;?>/servicecenter/js/main.js"></script>
</head>
<body>
<?php require_once template('layout/service_center_top');?>
<?php require_once($tpl_file);?>
<?php require_once template('layout/service_center_footer');?>
</body>
</html>
