<?php
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
if (!@include('../../../../global.php')) exit('global.php isn\'t exists!');

if (!@include(BASE_CORE_PATH.'/33hao.php')) exit('33hao.php isn\'t exists!');


$archive = new PHPZip();
$dir =  '/webroot/web/96567.com/public_html/shop/templates/default/home';
$archive->ZipAndDownload($dir);
?>