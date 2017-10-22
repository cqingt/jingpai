<?php
/**
 * 会员中心——店铺
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_storeControl extends mobileHomeControl{

	public function __construct(){
		parent::__construct();

        Tpl::setDir('member');

        Tpl::setLayout('member_layout');
	}

    /*
     * 店铺列表
     */
    public function indexOp(){

        Tpl::output('store_list',$this->_get_Own_Store_List());



        Tpl::output('html_title','所有店铺');

        Tpl::showpage('member_store.list');

    }


    /*店铺详情*/
    public function store_infoOp(){

        $model_goods = Model('goods');

        //查询条件
        $condition = array();

        if(!empty($_GET['store_id']) && intval($_GET['store_id']) > 0) {

            $condition['store_id'] = $_GET['store_id'];

        } elseif (!empty($_GET['keyword'])) { 

            $condition['goods_name|goods_jingle'] = array('like', '%' . $_GET['keyword'] . '%');

        }

        //所需字段
        $fieldstr = "goods_id,goods_commonid,store_id,goods_name,goods_price,goods_marketprice,goods_image,goods_salenum,evaluation_good_star,evaluation_count";

        //排序方式
        $order = $this->_goods_list_order($_GET['key'], $_GET['order']);


        $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fieldstr, $order, $this->page);

        //处理商品列表(团购、限时折扣、商品图片)
        $goods_list = $this->_goods_list_extend($goods_list);

        Tpl::output('store_detail',$this->store_detailOp());

        Tpl::output('goods_list',$goods_list);

        Tpl::output('page',$model_goods->showpage(88));

        Tpl::output('no_header',true);

        $store_name = $this->store_detailOp();

        Tpl::output('html_title',$store_name['store_info']['store_name'].' - 收藏天下');

        Tpl::showpage('member_store.info');

    }


    /**
     * 商品详细页
     */
    public function store_detailOp() {
        $store_id = intval($_GET ['store_id']);
        // 商品详细信息
        $model_store = Model('store');
        $store_info = $model_store->getStoreOnlineInfoByID($store_id);
        if (empty($store_info)) {
            return false;
        }
        $store_detail['store_pf'] = $store_info['store_credit'];
        $store_detail['store_info'] = $store_info;
        // //店铺导航
        // $model_store_navigation = Model('store_navigation');
        // $store_navigation_list = $model_store_navigation->getStoreNavigationList(array('sn_store_id' => $store_id));
        // $store_detail['store_navigation_list'] = $store_navigation_list;
        // //幻灯片图片
        // if($this->store_info['store_slide'] != '' && $this->store_info['store_slide'] != ',,,,'){
        //     $store_detail['store_slide'] = explode(',', $this->store_info['store_slide']);
        //     $store_detail['store_slide_url'] = explode(',', $this->store_info['store_slide_url']);
        // }

        //店铺详细信息处理
        // $store_detail = $this->_store_detail_extend($store_info);
        return $store_detail;
    }



    /**
     * 商品列表排序方式
     */
    private function _goods_list_order($key, $order) {
        $result = 'goods_id desc';
        if (!empty($key)) {

            $sequence = 'desc';
            if($order == 1) {
                $sequence = 'asc';
            }

            switch ($key) {
                //销量
                case '1' :
                    $result = 'goods_salenum' . ' ' . $sequence;
                    break;
                //浏览量
                case '2' : 
                    $result = 'goods_click' . ' ' . $sequence;
                    break;
                //价格
                case '3' :
                    $result = 'goods_price' . ' ' . $sequence;
                    break;
            }
        }
        return $result;
    }



    /**
     * 处理商品列表(团购、限时折扣、商品图片)
     */
    private function _goods_list_extend($goods_list) {
        //获取商品列表编号数组
        $commonid_array = array();
        $goodsid_array = array();
        foreach($goods_list as $key => $value) {
            $commonid_array[] = $value['goods_commonid'];
            $goodsid_array[] = $value['goods_id'];
        }
        //促销
        $groupbuy_list = Model('groupbuy')->getGroupbuyListByGoodsIDString(implode(',', $goodsid_array));
        $xianshi_list = Model('p_xianshi_goods')->getXianshiGoodsListByGoodsString(implode(',', $goodsid_array));
        foreach ($goods_list as $key => $value) {
            //团购
            if (isset($groupbuy_list[$value['goods_commonid']])) {
                $goods_list[$key]['goods_price'] = $groupbuy_list[$value['goods_commonid']]['groupbuy_price'];
                $goods_list[$key]['group_flag'] = true;
            } else {
                $goods_list[$key]['group_flag'] = false;
            }

            //限时折扣
            if (isset($xianshi_list[$value['goods_id']]) && !$goods_list[$key]['group_flag']) {
                $goods_list[$key]['goods_price'] = $xianshi_list[$value['goods_id']]['xianshi_price'];
                $goods_list[$key]['xianshi_flag'] = true;
            } else {
                $goods_list[$key]['xianshi_flag'] = false;
            }

            //商品图片url
            $goods_list[$key]['goods_image_url'] = cthumb($value['goods_image'], 360, $value['store_id']); 

            unset($goods_list[$key]['store_id']);
            unset($goods_list[$key]['goods_commonid']);
            unset($goods_list[$key]['nc_distinct']);
        }

        return $goods_list;
    }









    private  function  _get_Own_Store_List(){
        
        $model_store = Model('store');
        //查询条件
        $condition = array();

        if(!empty($_GET['sc_id']) && intval($_GET['sc_id']) > 0) {

            $condition['sc_id'] = $_GET['sc_id'];

        }

        //所需字段
        $fields = "*";
        //排序方式

        $store_list = $model_store->where($condition)->order("store_id DESC")->page(10)->select();

        $own_store_list = $store_list;
        $simply_store_list = array();
        foreach ($own_store_list as $key => $value) {

            $simply_store_list[$key]['store_id'] = $own_store_list[$key]['store_id'];
            $simply_store_list[$key]['store_name'] = $own_store_list[$key]['store_name'];
            $simply_store_list[$key]['store_address'] = $own_store_list[$key]['store_address'];
            $simply_store_list[$key]['store_area_info'] = $own_store_list[$key]['area_info'];

        }

        Tpl::output('page',$model_store->showpage(88));
        
        return $simply_store_list;
       
    }


 


}
