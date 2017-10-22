<?php
/**
 * 议价模型
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class yijiaModel extends Model {

    public function __construct() {
        parent::__construct('goods_yijia');
    }

    /**
     * 商品议价列表
     *
     */
    public function getYiJiaList($condition, $field = '*', $order = 'id asc', $page = 0) {
		$yijia_list = $this->table('goods_yijia')->field($field)->where($condition)->order($order)->page($page)->select();
		return $yijia_list;
    }
	/**
     * 获取单条议价信息
     *
     */
    public function getGoodsInfo($condition, $field = '*') {
        return $this->table('goods_yijia')->field($field)->where($condition)->find();
    }

	/**
     * 插入商品议价
     */
	public function YiJiaInsert($insert){
		$result = $this->table('goods_yijia')->insert($insert);
		return $result;
	}

	/**
     * 更新商品议价
     */
	public function YiJiaUpdate($update, $condition){
		$result = $this->table('goods_yijia')->where($condition)->update($update);
        return $result;
	}
}
