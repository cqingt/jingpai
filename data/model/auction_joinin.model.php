<?php
/**
 * 拍卖获取卖家店铺信息模型
 *
 */
defined('InShopNC') or exit('Access Invalid!');
class auction_joininModel extends Model{
    public function __construct() {
        parent::__construct('store_joinin');
    }

	/**
     * 读取指定店铺详情信息
	 * @param array $condition 查询条件
	 *
	 */
	public function getStoreJoinin($condition,$field="*") {
        $store_info = $this->field($field)->where($condition)->find();
        return $store_info;
    }


	/*
	 * 增加
	 * @param array $param
	 * @return bool
     *
	 */
    public function addAuction($param){
        $result = $this->table("lepai_audit")->insert($param);
       
    }

}
