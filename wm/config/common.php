<?php
if(file_exists('config/config.php')){
	include('config/config.php');
}else{
	echo '该网站未启用!';
	exit;
}



// $host = $_SERVER["HTTP_HOST"];
// if(strpos('http://'.$host,'m.')){
// 	$Cval = 'main';
// 	$Tval = 'show';
// }else{
// 	$Cval = 'pc';
// 	$Tval = 'pcShow';
// }

$Cval = 'manage';
$Tval = 'manage';


require_once($_SERVER['DOCUMENT_ROOT'].'/wm'.'/config/db.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/wm'.'/config/function.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/wm'.'/lib/model/Smarty/Smarty.class.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/wm'.'/lib/core/sw.class.php');

require_once($_SERVER['DOCUMENT_ROOT'].'/wm'.'/lib/core/run.class.php');


$PATH=G('p',2,2) ? G('p',2,2) : $Cval;//获取控制器加载文件夹
define(C_PATH,$PATH);
define(DIRTEMP,'tpl');
define(AC_PATH,'lib/control/'.C_PATH.'/');
define(DIR_MANAGE,'Template/manage/user/');
define(DIR_MAIN,'Template/tpl/'.$Tval.'/');
define(RWRITE,false);
define(ERROR_MESSAGE,"您的系统已到期，请联系管理员续费!");



?>