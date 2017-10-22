<?php
/**
 * 议价管理
 ***/

defined('InShopNC') or exit('Access Invalid!');

class yijiaControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 议价管理
	 */
	public function yijiaOp(){
		$model = Model('yijia');
		$condition = array();
		$name = $_GET['name'];
		$store_name = $_GET['store_name'];
		$store_type = intval($_GET['store_type']);
		if($name){
			$condition['name'] = $name;
		}
		if($store_name){
			$condition['store_name'] = $store_name;
		}
		if($store_type > 0){
			$condition['store_type'] = $store_type;
		}
		$result = $model->getYiJiaList($condition, '*','id desc', $page = 15);
		Tpl::output('page',$model->showpage(2));
        Tpl::output('yijia_list',$result);
		Tpl::showpage('yijia.index');
	}

	/**
	 * 议价处理
	 */
	public function ChuLiYiJiaOp(){
		if (chksubmit()) {
			$id = intval($_POST['id']);
			$state_contents = $_POST['state_contents'];
			if($id <= 0){
				showDialog('参数错误', 'reload');
			}
			$update = array();
			$update['state_contents'] = $state_contents;
			$update['state_time'] = time();
			$update['state'] = 1;
			$condition = array();
			$condition['id'] = $id;
			$model = Model('yijia');
			$result = $model->YiJiaUpdate($update,$condition);
			showDialog('操作成功', 'reload', 'succ');
		}
		Tpl::output('id', intval($_GET['id']));
		Tpl::showpage('yijia.ChuLi', 'null_layout');
	}
	
}
