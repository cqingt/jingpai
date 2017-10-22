<?php
/**
 * 店铺管理界面
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');

class store_dengjiControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 登记列表
	 */
	public function indexOp(){

		$model = Model('store_dengji');

		if(trim($_GET['mobile']) != ''){
			$condition['mobile']	= array('like', '%'.$_GET['mobile'].'%');
			Tpl::output('mobile',$_GET['mobile']);
		}
        /*时间排序*/
        if($_GET['search_begin_time'] && !$_GET['search_end_time']){
            $condition['addtime'] = array('gt',strtotime($_GET['search_begin_time']));
        }elseif(!$_GET['search_begin_time'] && $_GET['search_end_time']){
            $condition['addtime'] = array('lt',strtotime($_GET['search_end_time']));
        }elseif($_GET['search_begin_time'] && $_GET['search_end_time']){
            $condition['addtime'] = array(array('gt',strtotime($_GET['search_begin_time'])),array('lt',strtotime($_GET['search_end_time'])),'and');
        }

        Tpl::output('search_begin_time',trim($_GET['search_begin_time']));
        Tpl::output('search_end_time',trim($_GET['search_end_time']));


		//店铺列表
		$list = $model->getDengjiList($condition);

		Tpl::output('list',$list);
		Tpl::output('page',$model->showpage('2'));
		Tpl::showpage('store.dengji');
	}

}
