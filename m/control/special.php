<?php
/**
 * 专题
 *      
 */
defined('InShopNC') or exit('Access Invalid!');
class specialControl extends mobileHomeControl{

    public function __construct() {
        parent::__construct();
    }

    public function indexOp() {
		$special_id = intval($_GET['special_id']);
		if($special_id <= 0){
			showMessage("参数错误！");
		}
        $model_mb_special = Model('mb_special'); 
        $data = $model_mb_special->getMbSpecialItemUsableListByID($special_id);
        Tpl::output('list', $data);
		Tpl::showpage('mb_special');
    }


}
