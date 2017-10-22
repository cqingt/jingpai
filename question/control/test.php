<?php
!defined('IN_ASK2') && exit('Access Denied');
class testcontrol extends base {

    function __construct(& $get, & $post) {
        parent::__construct($get, $post);
        $this->base($get,$post);
        $this->load('test');
    }
    
    function ondefault() {
    	
    	$testname="这是测试数据";
    	 exit($testname);
    }
    function ontest1(){
        $loglist = $_ENV['test']->get();
        echo $loglist;
    }
    
}