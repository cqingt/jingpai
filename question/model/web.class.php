<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/31
 * Time: 16:45
 */
!defined('IN_ASK2') && exit('Access Denied');
class webmodel
{
    var $db;
    var $base;
    private $table='web';
    function webmodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }

    /**
     * 获取首页板块列表
     * @return array
     */
    function get()
    {
        $sql = Common::selectSql( $this -> table , '' , array('web_id','web_name','web_sort','web_num','web_show','web_list_type','web_site') , 'web_sort');
        $query = $this -> db -> query($sql);
        $web_list = array();
        while ($category = $this->db->fetch_array($query)) {
            $web_list[] = $category;
        }
        return $web_list;
    }

    /**
     * 修改板块信息
     * @param $data
     * @param $id
     * @return int
     */
    function update($data , $id)
    {
        $sql = Common::updateSql( $this -> table , $data , 'web_id = '.$id );
        $re = $this -> db -> query($sql);
        if( $re )
        {
            $this->base->cache->remove('webconfiglist');
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * 删除板块
     * @param $id
     * @return int
     */
    function delete($id)
    {
        $sql = Common::deleteSql( $this -> table , 'web_id='.$id );
        $re = $this -> db -> query($sql);
        if( $re )
        {
            $this->base->cache->remove('webconfiglist');
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * 添加板块
     * @param $data
     * @return int
     */
    function add($data)
    {
        $sql = Common::insertSql( $this -> table , $data );
        $re = $this -> db -> query($sql);
        if($re)
        {
            $id = $this->db->insert_id();
            $this->base->cache->remove('webconfiglist');
            return $id;
        }
        else
        {
            return 0;
        }
    }

    /**
     * 获取显示板块信息列表
     * @return array
     */
    function getShow()
    {
        $sql = Common::selectSql( $this -> table , 'web_show=1' , array('web_id','web_name','web_sort','web_num','web_show','web_list_type','web_site') , 'web_sort');
        $query = $this -> db -> query($sql);
        $web_list = array();
        while ($category = $this->db->fetch_array($query)) {
            $web_list[] = $category;
        }
        return $web_list;
    }

    /**
     * 获取首页板块数据
     * @param $table
     * @param $order_field
     * @param $status
     * @param $limit
     * @param $field
     * @return array
     */
    function getIndexData( $table , $order_field , $where , $limit , $field)
    {
        $order = $order_field.' desc';
        $sql = Common::selectSql( $table , $where , $field , $order , $limit );
        $query = $this -> db -> query($sql);
        $web_list = array();
        while ($category = $this->db->fetch_array($query)) {
            $category['format_time'] = tdate($category['time']);
            $web_list[] = $category;
        }
        return $web_list;
    }

    /**
     * 获取推荐用户数据
     * @return array
     */
    function getRecommendList()
    {
        $table = 'user';
        $field = array('uid','followers','member_id');
        $order = 'followers';
        $sql = Common::selectSql( $table , '' , $field , $order , 3 );
        $query = $this -> db -> query($sql);
        $web_list = array();
        while ($category = $this->db->fetch_array($query)) {
            $category['username'] = $this -> getmembername($category['member_id']);
            $category['user_category'] = $this -> getUserCategory($category['uid']);
            $category['user_attention'] = $this -> getUserAttention($category['uid']);
            $category['avatar'] = get_avatar_dir($category['uid']);
            $web_list[] = $category;
        }
        return $web_list;
    }

    /**
     * 根据商城用户ID获取商城用户名称
     * @param $mid
     * @return mixed
     */
    function getmembername($mid)
    {
        $username = $this->db->fetch_first("SELECT member_name FROM " . DB_TABLEPRE_SHOP . "member WHERE member_id='$mid'");
        return $username['member_name'];
    }

    /**
     * 获取用户擅长
     * @param $uid
     * @return string
     */
    function getUserCategory($uid)
    {
        $table = array(['table1'=>'user_category','table2'=>'category','join'=>'cid,id','join_type'=>'LEFT JOIN']);
        $field = array('name');
        $sql = Common::selectSql( $table , 'uid='.$uid , $field );
        $query = $this -> db -> query($sql);
        $str = '';
        while ($category = $this->db->fetch_array($query)) {
            $str.= $category['name'].',';
        }
        $str = substr($str , 0 , -1);
        return $str;
    }

    /**
     * 获取用户关注
     * @param $uid
     * @return string
     */
    function getUserAttention($uid)
    {
        $table = 'user_attention';
        $field = array('uid');
        $sql = Common::selectSql( $table , 'followerid='.$uid ,$field );
        $query = $this -> db -> query($sql);
        $attention = array();
        while ($category = $this->db->fetch_array($query)) {
            $category['avatar'] = get_avatar_dir($category['uid']);
            $attention[] = $category;
        }
        return $attention;
    }
}