<?php
/**
 * 入口
 */

/**************************防DDOS攻击*****************************
$headerArr = $_SERVER['HTTP_REFERER'];
if($_SERVER['HTTP_REFERER']){
    if(strpos($headerArr,'96567') || strpos($headerArr,'baidu')){
        $cachetime = file_get_contents('log/cacheTime');
        if(time() - $cachetime > 1800){
            $html = file_get_contents('http://www.96567.com');
            file_put_contents('caches/index.html',$html);
            file_put_contents('log/cacheTime',time());
        }
    }else{
        echo file_get_contents("caches/index.html");
        file_put_contents('log/header',print_r($_SERVER,true),FILE_APPEND);
        exit();
    }
}
 * /
/**************************防DDOS攻击******************************/

/*
 * 记录访问日志，DOS攻击开始检查日志
$time = date('Y-m-d H:i:s');
file_put_contents('log/fangwen111',print_r($time.' '.$_SERVER["REMOTE_ADDR"].' '.$_SERVER['HTTP_REFERER'].'===',true),FILE_APPEND);
 */

$site_url = strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/shop/index.php');
//@header('Location: '.$site_url);
include('lepai/index.php');

