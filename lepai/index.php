<?php
/**
 * 商城板块初始化文件
 *
 *
 * *  */




define('APP_ID','shop');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/33hao.php')) exit('33hao.php isn\'t exists!');

define('LEPAI_SITE_URL', C('lepai_site_url'));


define('APP_SITE_URL',LEPAI_SITE_URL);
define('TPL_NAME',TPL_SHOP_NAME);
define('SHOP_RESOURCE_SITE_URL',LEPAI_SITE_URL.DS.'resource');
define('SHOP_TEMPLATES_URL',LEPAI_SITE_URL.'/templates/'.TPL_NAME);
define('BASE_TPL_PATH',BASE_PATH.'/templates/'.TPL_NAME);


//CSS路径
define('LEPAI_CSS_URL',LEPAI_SITE_URL.'/templates/'.TPL_NAME);
//JS路径
define('LEPAI_JS_URL',RESOURCE_SITE_URL);
//lepai图片
define('LEPAI_Images_URL',BASE_SITE_URL);


Base::run();
//记录推广参数
if($_GET['tg_from']){
	$_SESSION['tg_from'] = $_GET['tg_from'];
}
?>
