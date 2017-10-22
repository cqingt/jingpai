<?php
/**
 * 系统设置内容
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class store_dengjiModel extends Model{
	public function __construct(){
		parent::__construct('store_dengji');
	}

    public function getDengjiList($condition, $page = null, $order = 'id desc', $field = '*', $limit = 0) {
        return $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    public function getDengjiInfo($condition) {
        return $this->where($condition)->find();
    }

    public function addDengji($param){
        return $this->insert($param);
    }

}
