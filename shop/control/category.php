<?php
/**
 * 前台分类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class categoryControl extends BaseHomeControl {
	/**
	 * 分类列表
	 */
	public function indexOp(){
		Language::read('home_category_index');
		$lang	= Language::getLangContent();
		//导航
		$nav_link = array(
			'0'=>array('title'=>$lang['homepage'],'link'=>SHOP_SITE_URL),
			'1'=>array('title'=>$lang['category_index_goods_class'])
		);
		Tpl::output('nav_link_list',$nav_link);

		Tpl::output('html_title',Language::get('category_index_goods_class').' - '.C('site_name'));
		Tpl::showpage('category');
	}
}
