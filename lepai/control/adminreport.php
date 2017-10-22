<?php
/**
 * 默认展示页面、用户管理、数据
 *
 *
 **by 多用户商城 www.abc.com 多用户商城 运营版*/


defined('InShopNC') or exit('Access Invalid!');
class adminReportControl extends AdminControl{
	public function indexOp(){
		/*查出专场信息*/
		$model_theme = Model('lepai_admin_theme');
		$array['where'] = array("T_Shenghe = '1' AND T_Tisheng = '1' AND T_Iswin = '0'",true);
		$result_theme = $model_theme->sel($array);
		Tpl::output('result_theme',$result_theme);
		Tpl::output('page_theme',$model_theme->showpage(2));
		Tpl::showpage('report_index');
	}



	/*添加拍品*/
	public function add_goodsOp(){
		Tpl::setLayout('kong_layout');
		$id = trim($_GET['themeid']);
		/*实例拍品数据表*/
		$model_g = Model('lepai_admin_goods');
		$result_g = $model_g->selGoods(''," AND G_Isdel<>1  AND (G_Atype = '0' OR G_Atype='2') ");
		Tpl::output('result_g',$result_g);
		Tpl::output('tgid',$id);
		Tpl::output('page_g',$model_g->showpage(2));
		Tpl::showpage('report_goods');
	}

	
	
}
