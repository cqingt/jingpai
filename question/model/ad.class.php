<?php

!defined('IN_ASK2') && exit('Access Denied');
class admodel {

    var $db;
    var $base;

    function admodel(&$base) {
        $this->base = $base;
        $this->db = $base->db;
    }
    /**
     * 更改轮播图及活动专题
     * @param $data
     * @return mixed
     */
    function insert_shuffling($data)
    {
        $sql = Common::insertSql( 'shuffling' , $data );
        $re = $this -> db -> query($sql);
        return $re;
    }

    /**
     * 获取轮播图及活动专题记录
     * @return array
     */
    function select_shuffling()
    {
        $sql = "SELECT `id`,`url`,`title` ,`time`,`src`,`type` FROM ".DB_TABLEPRE."shuffling ORDER BY `id` desc";
        $query = $this->db->query($sql);
        $new_list = array();
        while( $list = $this->db->fetch_array($query) ){
            $list['time'] = tdate($list['time']);
            $new_list[] = $list;
        }
        return $new_list;
    }

	/**
     * 批量删除
     * @param $data
     * @return mixed
     */
	function delete_all($id)
	{
		$sql = "DELETE FROM ".DB_TABLEPRE."shuffling WHERE `id` in (".$id.")";
		$re = $this->db->query($sql);
		return $re;
	}

	function getOne($id)
	{
		$sql = "SELECT `url` , `src` , `type` , `title` FROM " . DB_TABLEPRE ."shuffling WHERE `id`=".$id;
		$arr = $this -> db -> fetch_first($sql);
		return $arr;
	}

	function edit($data)
	{
		$id = $data['id'];
		unset($data['id']);
		$sql = "UPDATE " . DB_TABLEPRE . "shuffling SET ";
		foreach($data as $key => $val){
			$sql.= "`$key`='$val',";
		}
		$sql = substr($sql , 0 , -1);
		$sql.= " WHERE `id`=$id";
		$re = $this -> db -> query($sql);
		return $re;
	}
}

?>
