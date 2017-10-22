<?php
@$config = include( '../data/config/config.ini.php' );

define('DB_HOST', $config['db']['1']['dbhost'].':'.$config['db']['1']['dbport']);
define('DB_USER', $config['db']['1']['dbuser']);
define('DB_PW', $config['db']['1']['dbpwd']);
define('DB_NAME', $config['db']['1']['dbname']);
define('DB_CHARSET',$config['db']['1']['dbcharset']);
define('DB_TABLEPRE', 'shop_ask_');
define('DB_TABLEPRE_SHOP', 'shop_');
define('DB_CONNECT', 0);
define('TIPASK_CHARSET', $config['db']['1']['dbcharset']);
define('ASK2_VERSION', '3.3');
define('ASK2_RELEASE', '20160911');
define('COOKIE_PRE','96BE_');
define( 'LANG_TYPE' , 'zh_cn' );//语言包类型
define( 'WEB_SETTING_LIST' , ASK2_ROOT.'/config/setting.config.php' );//首页栏目配置

define( 'BASE_SITE_URL' , 'http://localhost/paimai/' );//网站域名
define('SITE_HOME_URL',SITE_URL.'view/zui/');//前台网站
