<?php
header("Content-Type:text/html;charset=utf-8");

define(BASE_ROOT_PATH,dirname(dirname(__FILE__)));

require_once(dirname(__FILE__)."/config/common.php");

sw::run();
?>