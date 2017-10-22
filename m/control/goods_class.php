<?php
/**
 * 商品分类
 *
 *
 *
 * by 33hao.com 好商城V3 运营版
 */

defined('InShopNC') or exit('Access Invalid!');
class goods_classControl extends mobileHomeControl{

	public function __construct() {
        parent::__construct();
    }

	public function indexOp() {
        if(!empty($_GET['gc_id']) && intval($_GET['gc_id']) > 0) {
            $this->_get_class_list($_GET['gc_id']);
        } else {
            $this->_get_root_class();
        }
        Tpl::output('nav_title','商品分类');
        Tpl::output('html_title','商品分类 - '.C('site_name'));
        Tpl::output('seo_keywords','收藏,收藏品,人民币收藏,钱币收藏,纪念钞收藏,邮票收藏,金银币收藏,金银条收藏,书法字画,瓷器紫砂,玉器,珠宝');
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息。');

        Tpl::showpage('goods_class');
	}

    /**
     * 返回一级分类列表
     */
    private function _get_root_class() {
        $goods_class_array = Model('goods_class')->get_all_category();

        Tpl::output('goods_class_array',$goods_class_array);
    }

    /**
     * 根据分类编号返回下级分类列表
     */
    private function _get_class_list($gc_id) {
        $goods_class_array = Model('goods_class')->getGoodsClassForCacheModel();

        $goods_class = $goods_class_array[$gc_id];

        if(empty($goods_class['child'])) {
            //无下级分类返回0
            output_data(array('class_list' => '0'));
        } else {
            //返回下级分类列表
            $class_list = array();
            $child_class_string = $goods_class_array[$gc_id]['child'];
            $child_class_array = explode(',', $child_class_string);
            foreach ($child_class_array as $child_class) {
                $class_item = array();
                $class_item['gc_id'] .= $goods_class_array[$child_class]['gc_id'];
                $class_item['gc_name'] .= $goods_class_array[$child_class]['gc_name'];
                $class_list[] = $class_item;
            }
            //output_data(array('class_list' => $class_list));
        }
    }
}
