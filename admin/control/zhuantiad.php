<?php
/**
 * 专题管理
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class zhuantiadControl extends SystemControl{
    public function __construct() {
        parent::__construct();
    }

    /**
     *专题管理列表
     */
    public function indexOp() {
		$zhuanti_list = Model('zhuanti')->getZhuanTiList(array(),'*','15');
		Tpl::output('zt_list',$zhuanti_list);
		Tpl::output('show_page',Model('zhuanti')->showpage());
        Tpl::showpage('zhuanti.index');
    }

	/**
     *添加
     */
    public function addOp() {
		//新建处理
		if($_POST['form_submit'] == 'ok'){
			$dataArr = array();
			$d_id = intval($_POST['d_id']);
			$dataArr['zhuanti_title'] = $_POST['zhuanti_title'];
			$dataArr['zhuanti_mulu'] = $_POST['zhuanti_mulu'];
			$dataArr['start_date'] = @strtotime($_POST['start_date']);
			$dataArr['end_date'] = @strtotime($_POST['end_date']);
			$dataArr['zhuanti_link'] = $_POST['zhuanti_link'];
			if($d_id > 0){
				Model('zhuanti')->up_zhuanti($dataArr,array('id'=>$d_id));
			}else{
				$dataArr['add_time'] = time();
				Model('zhuanti')->add_zhuanti($dataArr);
			}
			showMessage("操作成功",'index.php?act=zhuantiad&op=index');
		}else{
			$d_id = intval($_GET['d_id']);
			if($d_id > 0){
				$zhuantiInfo = Model('zhuanti')->getZhuanTiInfo(array('id'=>$d_id));
				$zhuantiInfo['start_date'] = @date('Y-m-d',$zhuantiInfo['start_date']);
				$zhuantiInfo['end_date'] = @date('Y-m-d',$zhuantiInfo['end_date']);
			}
			Tpl::output('d_id',$d_id);
			Tpl::output('zhuantiInfo',$zhuantiInfo);
			Tpl::showpage('zhuanti.add');
		}
    }
	
	/**
     *删除
     */
    public function delOp() {
		$id = intval($_GET['d_id']);
		Model('zhuanti')->DelZhuanTi(array('id'=>$id));
		showMessage("操作成功",'index.php?act=zhuantiad&op=index');
	}
	
	
}