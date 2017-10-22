<?php
/**
 * 会员中心——店铺分类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_shop_classControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /*
     * 首页显示
     */
    public function indexOp(){

        Tpl::output('shop_class',$this->_get_shop_class_List());

        Tpl::output('html_title','店铺分类');

        Tpl::showpage('member_shop_class.list');

    }


    private  function  _get_shop_class_List(){

        //获取自营店列表
        $model_store_class = Model("store_class");
    //如果只想显示自营店铺，把下面的//去掉即可
        //$condition = array(
         //   'is_own_shop' => 1,
        //);

        $lst = $model_store_class->getStoreClassList($condition);
        $new_lst = array();
        foreach ($lst as $key => $value) {

            $new_lst[$key]['sc_id'] = $lst[$key]['sc_id'];
            $new_lst[$key]['sc_name'] = $lst[$key]['sc_name'];
            $new_lst[$key]['sc_bail'] = $lst[$key]['sc_bail'];
            $new_lst[$key]['sc_sort'] = $lst[$key]['sc_sort'];

        }

        return $new_lst;
    }


}
