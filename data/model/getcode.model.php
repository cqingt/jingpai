<?php
/**
 * 业务员绑定 openid
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');

class getcodeModel extends Model{
    public function __construct(){
        parent::__construct('openid');
    }
	
	/**
     * 检查openid 是否绑定过
     *
     */
	public function selectOpenid($condition,$field='*') {
        return $this->table('openid')->field($field)->where($condition)->find();
    }

    /**
     * 新增绑定数据
     *
     */
    public function addOpenid($insert) {
        $result = $this->table('openid')->insert($insert);
        return $result;
    }

}
