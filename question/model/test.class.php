<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/31
 * Time: 16:45
 */
!defined('IN_ASK2') && exit('Access Denied');
class testmodel
{
    var $db;
    var $base;
    function testmodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }

    function get()
    {
        $table = array(
            ['table1'=>'user','table2'=>'admin','join'=>'uid','join_type' => 'left join'],
            ['table1'=>'user','table2'=>'asson','join'=>'uid','join_type' => 'left join']
        );
        $sql = common::selectSql($table,array('id=1','uid=1'));
        return $sql;
    }
}