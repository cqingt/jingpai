<?php

!defined('IN_ASK2') && exit('Access Denied');

class chatcontrol extends base {

    function chatcontrol(& $get, & $post) {
        $this->base($get,$post);
       
    }
        function ondefault() {
        	$user=$this->user;
        	$setting=$this->setting;
        	 $navtitle ="ask2问答系统站内互动在线聊天";
          include template('chat');
        }
    
    
}