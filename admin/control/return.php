<?php
/**
 * 退货管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class returnControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		$model_refund = Model('refund_return');
		$model_refund->getRefundStateArray();
	}

	/**
	 * 待处理列表
	 */
	public function return_manageOp() {
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['refund_state'] = '2';//状态:1为处理中,2为待管理员处理,3为已完成

		$keyword_type = array('order_sn','refund_sn','store_name','buyer_name','goods_name');
		if (trim($_GET['key']) != '' && in_array($_GET['type'],$keyword_type)) {
			$type = $_GET['type'];
			$condition[$type] = array('like','%'.$_GET['key'].'%');
		}
		if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != '') {
			$add_time_from = strtotime(trim($_GET['add_time_from']));
			$add_time_to = strtotime(trim($_GET['add_time_to']));
			if ($add_time_from !== false || $add_time_to !== false) {
				$condition['add_time'] = array('time',array($add_time_from,$add_time_to));
			}
		}

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$where = "(is_own_shop = 1 or store_id = 22)"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//第三方订单查询
		if($_GET['is_short'] == 2) {
			$where = "is_own_shop = 0 AND store_id <> 22  AND store_is_shuhua_ <> 1"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

        //代运营
		if($_GET['is_short'] == 3) {
			$where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		$return_list = $model_refund->getReturnList($condition,10);

		Tpl::output('return_list',$return_list);
		Tpl::output('show_page',$model_refund->showpage());
		Tpl::showpage('return_manage.list');
	}

	/**
	 * 所有记录
	 */
	public function return_allOp() {
		$model_refund = Model('refund_return');
		$condition = array();

		$keyword_type = array('order_sn','refund_sn','store_name','buyer_name','goods_name');
		if (trim($_GET['key']) != '' && in_array($_GET['type'],$keyword_type)) {
			$type = $_GET['type'];
			$condition[$type] = array('like','%'.$_GET['key'].'%');
		}
		if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != '') {
			$add_time_from = strtotime(trim($_GET['add_time_from']));
			$add_time_to = strtotime(trim($_GET['add_time_to']));
			if ($add_time_from !== false || $add_time_to !== false) {
				$condition['add_time'] = array('time',array($add_time_from,$add_time_to));
			}
		}

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$where = "(is_own_shop = 1 or store_id = 22)"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//第三方订单查询
		if($_GET['is_short'] == 2) {
			$where = "is_own_shop = 0 AND store_id <> 22  AND store_is_shuhua_ <> 1"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

        //代运营
		if($_GET['is_short'] == 3) {
			$where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		$return_list = $model_refund->getReturnList($condition,10);
		Tpl::output('return_list',$return_list);
		Tpl::output('show_page',$model_refund->showpage());
		Tpl::showpage('return_all.list');
	}

	
	/**
	 * 退货单拒绝自营客服审核列表
	 */
	public function ziying_return_allOp() {
		$model_refund = Model('refund_return');
		$condition = array();

		$keyword_type = array('order_sn','refund_sn','store_name','buyer_name','goods_name');
		if (trim($_GET['key']) != '' && in_array($_GET['type'],$keyword_type)) {
			$type = $_GET['type'];
			$condition[$type] = array('like','%'.$_GET['key'].'%');
		}
		if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != '') {
			$add_time_from = strtotime(trim($_GET['add_time_from']));
			$add_time_to = strtotime(trim($_GET['add_time_to']));
			if ($add_time_from !== false || $add_time_to !== false) {
				$condition['add_time'] = array('time',array($add_time_from,$add_time_to));
			}
		}
		$condition['seller_state'] = 1;
		$condition['crm_state'] = 0;
		$return_list = $model_refund->getReturnList($condition,10);
		Tpl::output('return_list',$return_list);
		Tpl::output('show_page',$model_refund->showpage());
		Tpl::showpage('ziying_return_all.list');
	}

	/**
	 * 退货处理页
	 *
	 */
	public function editOp() {
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		if (chksubmit()) {
			if ($return['refund_state'] != '2') {//检查状态,防止页面刷新不及时造成数据错误
				showMessage(Language::get('nc_common_save_fail'));
			}
			$order_id = $return['order_id'];
			$refund_array = array();
			$refund_array['admin_time'] = time();
			$refund_array['refund_state'] = '3';//状态:1为处理中,2为待管理员处理,3为已完成
			$refund_array['admin_message'] = $_POST['admin_message'];
			$state = $model_refund->editOrderRefund($return);
			if ($state) {
			    $model_refund->editRefundReturn($condition, $refund_array);
			    $this->log('退货确认，退货编号'.$return['refund_sn']);

			    // 发送买家消息
                $param = array();
                $param['code'] = 'refund_return_notice';
                $param['member_id'] = $return['buyer_id'];
                $param['param'] = array(
                    'refund_url' => urlShop('member_return', 'view', array('return_id' => $return['refund_id'])),
                    'refund_sn' => $return['refund_sn']
                );
                QueueClient::push('sendMemberMsg', $param);

				showMessage(Language::get('nc_common_save_succ'),'index.php?act=return&op=return_manage');
			} else {
				showMessage(Language::get('nc_common_save_fail'));
			}
		}
		Tpl::output('return',$return);
		$info['buyer'] = array();
	    if(!empty($return['pic_info'])) {
	        $info = unserialize($return['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		Tpl::showpage('return.edit');
	}

	/**
	 * 退货记录查看页
	 *
	 */
	public function viewOp() {
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		$express = Model('express')->getExpressInfo($return['express_id']);
		$return['express_name'] = $express['e_name'];
		Tpl::output('return',$return);
		$info['buyer'] = array();
	    if(!empty($return['pic_info'])) {
	        $info = unserialize($return['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		Tpl::showpage('return.view');
	}
	
	/**
	 * 退货记录查看页
	 *
	 */
	public function ziying_viewOp() {
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		if (chksubmit()) {
			if ($return['seller_state'] != '1') {//检查状态,防止页面刷新不及时造成数据错误
				showMessage(Language::get('nc_common_save_fail'));
			}
			$order_id = $return['order_id'];
			$refund_array = array();
			$refund_array['seller_time'] = time();
			$refund_array['seller_state'] = '3';//状态:1为处理中,2为待管理员处理,3为已完成
			$refund_array['seller_message'] = $_POST['admin_message'];
			$model_refund->editRefundReturn($condition, $refund_array);
			$model_refund->addReturnLog($_POST['admin_message'],$this->getAdminInfo()['name'],$condition['refund_id'],'客服审核');
			showMessage("提交成功",'index.php?act=return&op=ziying_return_all');
		
		}
		Tpl::output('return',$return);
		$info['buyer'] = array();
	    if(!empty($return['pic_info'])) {
	        $info = unserialize($return['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		Tpl::showpage('return.ziying_view');
	}
	
}
