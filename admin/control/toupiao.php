<?php
/**
 * 投票管理
 ***/

defined('InShopNC') or exit('Access Invalid!');
class toupiaoControl extends SystemControl{
    public function __construct() {
        parent::__construct ();
        /*加载字符集*/
        Language::read('goods');
        /*添加作者页面语言包*/
		//rec_position
        Language::read('trade');


    }

    /**
     * 投票
     */
    public function indexOp() {
		$model = Model('zhuanti');
		$condition['is_rev'] = array('egt','1');
		$result = $model->getTouPiaoList($condition,'*','100','vote_num desc,id desc');
	    Tpl::output('page',$model->showpage(2));
        Tpl::output('result_list',$result);
        Tpl::showpage('toupiao.index');
    }

	/**
     * 投票申请列表
     */
    public function shenqing_listOp() {
		$model = Model('zhuanti');
		$condition['is_rev'] = '0';
		$result = $model->getTouPiaoList($condition,'*','100','vote_num desc,id desc');
	    Tpl::output('page',$model->showpage(2));
        Tpl::output('result_list',$result);
        Tpl::showpage('toupiao.shenqing_list');
    }
	
	/**
     * 编辑投票信息
     */
	public function end_toupiaoOp() {
		$id = intval($_GET['id']);
		$model = Model('zhuanti');
		$condition['id'] = $id;
		$result = $model->getTouPiaoList($condition,'*','','','1');
		
		Tpl::output('dataArr',$result[0]);
		Tpl::showpage('toupiao.end_toupiao');
	}
	
	/**
     * 执行编辑投票信息
     */
	 public function up_toupiaoOp() {
		$insert_array = array();
		$insert_array['title']    = $_POST['title']; //藏品title
		$insert_array['years']   = trim($_POST['years']); //作品年代
		$insert_array['data_time']   = trim($_POST['data_time']);//入手时间
		$insert_array['price']   = trim($_POST['price']);//入手价格
		$insert_array['contents']   = trim($_POST['contents']);//藏品描述
		$insert_array['is_rev']   = intval($_POST['is_rev']); //审核状态 0 未审核 1 已审核 2 拒绝审核
		$insert_array['vote_num']   = intval($_POST['vote_num']); // 投票数量默认为0
		$insert_array['update_time'] = time();
		$res = Model('zhuanti')->updetaTouPiao($insert_array,array('id'=>intval($_POST['id'])));
		showMessage("编辑成功");
		
	}
	/**
     * 执行删除
     */
	 public function toupiao_delOp() {
		Model('zhuanti')->delTouPiao(array('id'=>intval($_POST['id'])));
		showMessage("操作成功");
	 }
	
}
