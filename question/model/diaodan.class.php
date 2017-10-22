<?php

!defined('IN_TIPASK') && exit('Access Denied');
 
class diaodanmodel {

    var $db;
    var $base;

var $statustable = array(
        'all' => ' AND zhuangtai!=-1',
        '0' => ' AND zhuangtai="未处理"',
        '1' => ' AND zhuangtai !="未处理" AND shi>=0 AND caozuoriqi="',
       
    );
    function diaodanmodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }
      
    /* 根据aid获取一个答案的内容，暂时无用 */

    function get($id) {
        return $this->db->fetch_first("SELECT * FROM " . DB_TABLEPRE . "diaodan WHERE id='$id'");
    }
    
    
    function get_list($start = 0, $limit = 5){
    	 $diaodanlist = array();
    	   $sql = 'SELECT * FROM `' . DB_TABLEPRE . 'diaodan`';
    	    $sql .= ' ORDER BY `id` DESC LIMIT ' . $start . ',' . $limit;
    	    
    	   $query = $this->db->query($sql);
        
        while ($diaodan = $this->db->fetch_array($query)) {
           
            $diaodanlist[] = $diaodan;
        }
        return $diaodanlist;
    }
 /* 根据uid获取掉单的列表，用于在用户中心，我的回答显示 */

    function list_by_uid($uid, $status, $start = 0, $limit = 5) {
        $diaodanlist = array();
       
        $sql = 'SELECT * FROM `' . DB_TABLEPRE . 'diaodan` WHERE `caozuoren`=' . $uid;
        if($status==1){
        	date_default_timezone_set ("Asia/Chongqing");
  $a=date("Y");
  $b=date("m");
  $c=date("d");
    $caozuoriqi=$a.'-'.$b.'-'.$c;
        	 $sql .=$this->statustable[$status].$caozuoriqi. '" ORDER BY `id` DESC LIMIT ' . $start . ',' . $limit;;
        }else{
        	 $sql .=$this->statustable[$status] . ' ORDER BY `id` DESC LIMIT ' . $start . ',' . $limit;
        }
     
       
        $query = $this->db->query($sql);
        
        while ($diaodan = $this->db->fetch_array($query)) {
           
            $diaodanlist[] = $diaodan;
        }
        return $diaodanlist;
    }
    
 function list_by_status($status, $start = 0, $limit = 5) {
        $diaodanlist = array();
       
        $sql = 'SELECT * FROM `' . DB_TABLEPRE . 'diaodan` WHERE 1=1 ';
        $status=0;
  $sql .=$this->statustable[$status] . ' ORDER BY `id` DESC LIMIT ' . $start . ',' . $limit;

        $query = $this->db->query($sql);
        
        while ($diaodan = $this->db->fetch_array($query)) {
           
            $diaodanlist[] = $diaodan;
        }
        return $diaodanlist;
    }
    function updatediaodan($zhuangtai,$beizhu,$id,$uid){
    	$sql='update '.DB_TABLEPRE."diaodan set chulirenid=$uid".", zhuangtai='".$zhuangtai."', beizhu='".$beizhu."' where id=".$id;
    	
    	$this->db->query($sql);
    }
    /* 添加用户，本函数需要返回uid */

    function add($huiyuanzhanghao,$leixing,$shijian,$jine,$zhuanzhangpingtai,$caozuowangzhi,$cunkuanfangshi,$dingdanhao,$zhuangtai,$beizhu,$caozuoren,$shi,$fen,$miao,$caozuoriqi,$shanghumingchen,$cunkuangjietu) {
      $sql="INSERT INTO " . DB_TABLEPRE . "diaodan(huiyuanzhanghao,leixing,shijian,jine,zhuanzhangpingtai,caozuowangzhi,cunkuanfangshi,dingdanhao,zhuangtai,beizhu,caozuoren,shi,fen,miao,caozuoriqi,shanghumingchen,cunkuangjietu) values ('$huiyuanzhanghao','$leixing','$shijian','$jine','$zhuanzhangpingtai','$caozuowangzhi','$cunkuanfangshi','$dingdanhao','$zhuangtai','$beizhu','$caozuoren','$shi','$fen','$miao','$caozuoriqi','$shanghumingchen','$cunkuangjietu')";
     
    	$this->db->query($sql);
            $id = $this->db->insert_id();
        return $id;
    }
    
    function list_by_cunkuan() {
        $list = array();
       
        $sql = 'SELECT * FROM `' . DB_TABLEPRE . 'diaodancunkuan';
      
       
        $query = $this->db->query($sql);
        
        while ($li = $this->db->fetch_array($query)) {
          
            $list[] = $li;
        }
        return $list;
    }
 function list_by_pingtai() {
        $list = array();
       
        $sql = 'SELECT * FROM `' . DB_TABLEPRE . 'diaodanpingtai';
      
       
        $query = $this->db->query($sql);
        
        while ($li = $this->db->fetch_array($query)) {
          
            $list[] = $li;
        }
        return $list;
    }
    
}