<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：order
 * 
 * @功能：订单管理
 *
 * @开发人：盛威
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：order.class.php
 * 
 * @开发时间：2014-9-13 15:28:17
 * 
 * @订单管理
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class lt extends manage{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @ 订单列表
	 */
	public function index(){
		$file = file('order.txt');
		foreach($file as $v){
			$arr = explode(' ',$v);
			$mobile = trim(str_replace("\n","",$arr[2]));
			$dataArr['name'] = $arr[0];
			$dataArr['address'] = $arr[1];
			$this->c->table('jiang');
			$dataArr1 = $this->c->search("mobile='".$mobile."'");
			if(!empty($dataArr1)){
				$this->c->update($dataArr,"mobile='".$mobile."'");
				$dataArr2['name'] = $arr[0];
				$dataArr2['address'] = $arr[1];
				$dataArr2['uid'] = $dataArr1[0]['id'];
				$this->createOrder($dataArr2);
				$strID .= "\n".$dataArr2['uid'];
			}
		}
	}

	/**
	 * @ 创建订单
	 */
	private function createOrder($dataArr){
		$this->c->table('order');
		$num = $this->c->sumRows("uid='".$dataArr['uid']."'");
		if(!$num){
			$arr['uid'] = $dataArr['uid'];
			$arr['order_sn'] = date('YmdHis').rand(1000,9999);
			$arr['name'] = $dataArr['name'];
			$arr['province'] = 0;
			$arr['city'] = 0;
			$arr['address'] = $dataArr['address'];
			$arr['type'] = 1;
			$arr['express'] = '特快专递';
			$arr['express_sn'] = 1;
			$arr['status'] = 2;
			$arr['time'] = time();
			$this->c->insert($arr);
		}
	}
}
?>	