<?php
if(file_exists('config/config.php')){
	include('config/config.php');
}else{
	echo '����վδ����!';
	exit;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/config/db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/config/function.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/model/Smarty/Smarty.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/core/sw.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/core/run.class.php');

$PATH=G('p',2,2) ? G('p',2,2) : 'main';//��ȡ�����������ļ���
define(DIRTEMP,'tpl');
define(AC_PATH,'lib/control/'.$PATH.'/');
define(DIR_MANAGE,'Template/manage/user/');
define(DIR_MAIN,'Template/tpl/wanfu/');
define(RWRITE,false);
define(ERROR_MESSAGE,"����ϵͳ�ѵ��ڣ�����ϵ����Ա����!");
?>