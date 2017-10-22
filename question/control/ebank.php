<?php

!defined('IN_ASK2') && exit('Access Denied');

class ebankcontrol extends base {

	var $whitelist='';
    function ebankcontrol(& $get, & $post) {
        parent::__construct($get, $post);
        $this->whitelist="aliapytransfer";
        $this->load('ebank');
    }

    /* 支付宝回调 */

    function onaliapyback() {
        if (!$this->setting['recharge_open']) {
            $this->message("财富充值服务已关闭，如有问题，请联系管理员!", "STOP");
        }
     
        if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
        	   
            $credit2 = $_GET['total_fee'] * $this->setting['recharge_rate'];
          if(!isset($_SESSION)){ session_start(); }
         if(isset($_SESSION['type'])){
         	 $type=json_decode($_SESSION['type'],true);
         	          $content=$type['content'];
         	           $touid=$type['touid'];
        	    	 $this->credit($this->user['uid'], 0, $credit2, 0, $content);
        	    	   $this->db->query("INSERT INTO " . DB_TABLEPRE . "userbank(fromuid,touid,operation,money,time) VALUES ({$this->user['uid']},$touid,'$content',{$_GET['total_fee']},{$this->time}) ");
        	    	 $this->message("打赏成功",  $_SESSION['backurl']);
        	    }else{
        	    	 $this->credit($this->user['uid'], 0, $credit2, 0, "支付宝充值");
        	    	 $this->message("充值成功", "user/score");
        	    }
        	    
        	    
           
            
        } else {
            $this->message("服务器繁忙，请稍后再试!", 'STOP');
        }
    }

    /* 支付宝转账 */

    function onaliapytransfer() {
    	
        if (isset($this->post['submit'])) {
            $recharge_money = intval($this->post['money']);
                $apikey = $this->post['apikey'];
        if(!isset($_SESSION)){ session_start(); }
      
     
       
      
       
          //  if (!$this->user['uid']) {
             //   $this->message("您无权执行该操作!", "STOP");
             //   exit;
            //}
            if (!$this->setting['recharge_open']) {
                $this->message("财富充值服务已关闭，如有问题，请联系管理员!", "STOP");
            }
            if ($recharge_money <= 0 || $recharge_money > 20000) {
                $this->message("输入充值金额不正确!充值金额必须为整数，且单次充值不超过20000元!", "STOP");
                exit;
            }
         
        
      
         if(isset($_SESSION['type'])){
         	//$this->user['ebanktype']='dashang';
         	//$this->user['backurl']=$_SERVER["HTTP_REFERER"];
         	
        	  $type=json_decode($_SESSION['type'],true);
        	   $_ENV['ebank']->aliapytransfer($recharge_money,$type['content']);
        }else{
        	//$this->user['ebanktype']='chongzhi';
        	
        	 $_ENV['ebank']->aliapytransfer($recharge_money);
        }
        
           
        }
       
    }

}

?>