<?php
/**
 * 商城板块初始化文件
 *
 *
 * *  */
define('APP_ID','artist');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/33hao.php')) exit('33hao.php isn\'t exists!');


// 扩展函数
if (!@include(BASE_PATH.'/framework/function/function.php')){
    exit('function.php isn\'t exists!');
}


define('APP_SITE_URL',SHOP_SITE_URL);
define('TPL_NAME',TPL_SHOP_NAME);
define('SHOP_RESOURCE_SITE_URL',SHOP_SITE_URL.DS.'resource');
define('SHOP_TEMPLATES_URL',SHOP_SITE_URL.'/templates/'.TPL_NAME);
define('BASE_TPL_PATH',BASE_PATH.'/templates/'.TPL_NAME);


define('BASE_PATH_URL',strtolower('http://'.$_SERVER['HTTP_HOST'].'/artist'));


Base::run();
//记录推广参数
if($_GET['tg_from']){
	$_SESSION['tg_from'] = $_GET['tg_from'];
}
?>
