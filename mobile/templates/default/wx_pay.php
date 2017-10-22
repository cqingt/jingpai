<?php defined('InShopNC') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>收藏天下 微信支付</title>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL; ?>/wap/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL; ?>/wap/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL; ?>/wap/css/index.css">
</head>
<body>

<div class="main" id="main-container">
    <button onclick='javascript:callpay();'>点击微信支付</button>
</div>
<?php echo $output['jsapi'];?>
<script type="text/javascript">
    callpay()
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/mobile/swipe.js" charset="utf-8"></script>


</body>
</html>
