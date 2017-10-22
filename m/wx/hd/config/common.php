<?php
if(file_exists('config/config.php')){
	include('config/config.php');
}else{
	echo '该网站未启用!';
	exit;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/config/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/config/function.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/model/Smarty/Smarty.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/core/sw.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/core/run.class.php');

$PATH=G('p',2,2) ? G('p',2,2) : 'main';//获取控制器加载文件夹
define(DIRTEMP,'tpl');
define(AC_PATH,'lib/control/'.$PATH.'/');
define(DIR_MANAGE,'Template/manage/user/');
define(DIR_MAIN,'Template/tpl/wanfu/');
define(RWRITE,false);
define(ERROR_MESSAGE,"您的系统已到期，请联系管理员续费!");
?>