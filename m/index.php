<?php
/**
 * 手机接口初始化文件
 *
 *
 * by 33hao.com 好商城V3 运营版
 */

define('APP_ID','mobile');
define('IGNORE_EXCEPTION', true);
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));

if (!@include(dirname(dirname(__FILE__)).'/global.php')) exit('global.php isn\'t exists!');
if (!@include(BASE_CORE_PATH.'/33hao.php')) exit('33hao.php isn\'t exists!');

if (!@include(BASE_PATH.'/config/config.ini.php')){
    exit('config.ini.php isn\'t exists!');
}

define('M_SITE_URL', 'http://localhost/paimai/m');
//define('MOBILE_TEMPLATES_URL',MOBILE_SITE_URL.'/templates/');
define('MOBILE_TEMPLATES_URL',M_SITE_URL.'/templates/default');


define('BASE_SITE_URL', 'http://localhost/paimai/');

//框架扩展
require(BASE_PATH.'/framework/function/function.php');
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');

Base::run();
//记录推广参数
if($_GET['tg_from']){
	$_SESSION['tg_from'] = $_GET['tg_from'];
}