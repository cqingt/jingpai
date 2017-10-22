<?php
/**
 * 订单管理界面
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class adminOrderControl extends AdminControl{
	/*订单管理默认界面*/
	public function indexOp(){
		$express = rkcache('express',true);
		/*拼装搜索WHERE条件*/
		$search = trim($_GET['search']);		//产品名
		$s_one = trim($_GET['s_one']);			//产品分类
		$s_two = trim($_GET['s_two']);			//产品状态
		$where = $this->orderwhere($search,$s_one,$s_two);
		$array['where'] = array("store_member_id='".$_SESSION['member_id']."' ".$where,true);
		$model = Model('lepai_admin_order');
		$result = $model->selOrder($array);
		Tpl::output('result',$result);
		Tpl::output('express',$express);
		Tpl::output('page',$model->showpage(2));
		Tpl::showpage('order_index');
	}

	/*订单详情*/
	public function order_infoOp(){
		$express = rkcache('express',true);
		$id = trim($_GET['orderid']);
		$model = Model('lepai_admin_order');
		$array['where'] = array("order_id='".$id."'",true);
		$result = $model->selOrder($array);

		//收货地址
		$area_info = unserialize($result[0]['reciver_info']);
		//快递公司
		$kuaidi = $model->kuaidi($result[0]['shipping_ecode']);
		Tpl::output('result',$result[0]);
		Tpl::output('kuaidi',$kuaidi);
		Tpl::output('area_info',$area_info);
		Tpl::output('express',$express);
		Tpl::showpage('order_info');
	}

	/*订单发货*/
	public function orderPushOp(){
		$id = trim($_POST['order_id']);
		$array['order_state'] = '30';
		$array['shipping_ecode'] = $_POST['kuaidi'];
		$array['shipping_code'] = $_POST['order_sn'];
		$array['shipping_time'] = time();
		$model = Model('lepai_admin_order');
		if($model->orderPush($id,$array)){
			showMessage('操作成功');
		}else{
			showMessage('操作失败');
		}
	}







/**

*/


	/*搜索条件*/
	private function orderwhere($search,$selOne,$selTwo){

		if(empty($selOne))$selOne='1';
		if($search){
			switch ($selOne) {
			case '1':	//已送拍、审核中
				$where .= " AND order_sn LIKE '%".$search."%'";
				break;
			case '2':	//送拍审核未通过
				$where .= " AND G_Name LIKE '%".$search."%'";
				break;
			}
		}

		switch ($selTwo) {
			case '1':	//未付款
				$where .= " AND order_state = 10 ";
				break;
			case '2':	//已付款
				$where .= " AND order_state = 20 ";
				break;
			case '3':	//已发货
				$where .= " AND order_state = 30 ";
				break;
			case '4':	//已收货
				$where .= " AND order_state = 40 ";
				break;
			case '5':	//已取消
				$where .= " AND order_state = '0' ";
				break;
		}
		return $where;
	}
	
	
}
