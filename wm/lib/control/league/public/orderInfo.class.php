<?php
/**
 * SW 订单类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：orderInfo
 * 
 * @功能：订单类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：orderInfo.class.php
 * 
 * @开发时间：2014-09-05 17:04:00
 * 
 * @订单类
 * 
 */
class orderInfo extends base{
	public function __construct(){
		parent::__construct();
		$this->c->table('order');
	}

	/**
	 * @ 加载指定id订单数据
	 * @ $oid:指定的产品ID
	 */
	public function getOrderInfo($oid,$fields='*'){
		$dataArr = $this->c->search("O_ID='".$oid."'",'','',$fields);
		return $dataArr[0];
	}
}

?>