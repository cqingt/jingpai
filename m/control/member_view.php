<?php
/**
 * 会员中心——浏览历史
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_viewControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 我的商城
     */
    public function view_listOp() {

        $goods_id_str = str_replace('@',',',$_COOKIE['goods']);

        $model_goods = Model('goods');

        $field = 'goods_id,goods_name,goods_price,goods_image,store_id';

        $goods_list = $model_goods->getGoodsList(array('goods_id' => array('in', $goods_id_str)), $field);

        foreach ($goods_list as $key=>$value) {

            $goods_list[$key]['fav_id'] = $value['goods_id'];

            $goods_list[$key]['goods_image_url'] = cthumb($value['goods_image'], 240, $value['store_id']);

        }

        Tpl::output('goods_list',$goods_list);

        Tpl::output('page',$model_goods->showpage(88));

        Tpl::output('html_title','浏览历史 - 会员中心 - 收藏天下');

        Tpl::output('nav_title','浏览历史');

        Tpl::showpage('member_view.list');
    }


}
