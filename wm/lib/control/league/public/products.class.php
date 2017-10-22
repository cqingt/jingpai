<?php
/**
 * SW 产品类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：products
 * 
 * @功能：消息记录类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：products.class.php
 * 
 * @开发时间：2014-09-03 16:44:00
 * 
 * @产品处理类
 * 
 */
class products extends base{
	public function __construct(){
		parent::__construct();
		$this->c->table('products');
	}

	/**
	 * @ 加载产品详细数据
	 * @ $pid:指定的产品ID
	 */
	public function getGoodsInfo($pid){
		$dataArr = $this->c->search("P_ID='".$pid."'");
		return $dataArr[0];
	}

	/**
	 * @ 更改指定产品订单状态
	 * @ $pid:指定的产品ID
	 */
	public function updateGoodsStatus($pid,$val){
		if($pid && $val){
			$this->c->execute("UPDATE sw_products SET P_Status='".intval($val)."' WHERE P_ID='".$pid."'");
		}
	}

}

?>