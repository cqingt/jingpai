<?php

/* the ask2 entrance */

error_reporting(0);
$mtime = explode(' ', microtime());
$starttime = $mtime[1] + $mtime[0];
define('IN_ASK2', TRUE);
define('ASK2_ROOT', dirname(__FILE__));
function ismobile() {
    $is_mobile = false;
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}
//if(ismobile()){
//if($_SERVER['HTTP_HOST']!='m.ask2.cn'){
//	$url ='http://m.ask2.cn'.$_SERVER['REQUEST_URI'];
//Header("Location:$url"); 
//}
//}
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, -9));

include ASK2_ROOT . '/model/sowenda.class.php';
include ASK2_ROOT . '/language/language.class.php';
include ASK2_ROOT.'/model/common.class.php';
$sowenda = new sowenda();
$sowenda->run();
?>