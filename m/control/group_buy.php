<?php
/**
 * 团购手机版
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class group_buyControl extends mobileHomeControl {

    public function __construct() {
        parent::__construct();
        //读取语言包
        Language::read('member_groupbuy,home_cart_index');
        //检查团购功能是否开启
        if (intval(C('groupbuy_allow')) !== 1){
            showMessage(Language::get('groupbuy_unavailable'),urlShop(),'','error');
        }
    }

    /**
     * 团购列表
     */
    public function indexOp()
    {
        $this->_show_groupbuy_list('getGroupbuyOnlineList');
    }

   

    /**
     * 获取团购列表
     **/
    private function _show_groupbuy_list($function_name) {
        $model_groupbuy = Model('groupbuy');

        $condition = array(
            'is_vr' => 0,
        );
        $order = '';

        // 分类筛选条件
        if (($class_id = (int) $_GET['class']) > 0) {
            $condition['class_id'] = $class_id;

            if (($s_class_id = (int) $_GET['s_class']) > 0)
                $condition['s_class_id'] = $s_class_id;
        }

        // 价格区间筛选条件
        if (($price_id = intval($_GET['groupbuy_price'])) > 0
            && isset($this->groupbuy_price[$price_id])) {
            $p = $this->groupbuy_price[$price_id];
            $condition['groupbuy_price'] = array('between', array($p['range_start'], $p['range_end']));
        }

        // 排序
        $groupbuy_order_key = trim($_GET['groupbuy_order_key']);
        $groupbuy_order = $_GET['groupbuy_order'] == '2'?'desc':'asc';
        if(!empty($groupbuy_order_key)) {
            switch ($groupbuy_order_key) {
                case '1':
                    $order = 'groupbuy_price '.$groupbuy_order;
                    break;
                case '2':
                    $order = 'groupbuy_rebate '.$groupbuy_order;
                    break;
                case '3':
                    $order = 'buyer_count '.$groupbuy_order;
                    break;
            }
        }

        $groupbuy_list = $model_groupbuy->$function_name($condition, null,  'groupbuy_xu ASC , start_time ASC ,  state asc');
        Tpl::output('groupbuy_list', $groupbuy_list);
        Tpl::output('show_page', $model_groupbuy->showpage(5));


        Model('seo')->type('group')->show();

        /*加载SEO*/
        Tpl::output('nav_title','藏品惠');
        /*Tpl::output('html_title','藏品惠 - '.C('site_name'));
        Tpl::output('seo_keywords','收藏天下,收藏品团购,限时抢购,书画团购,钱币团购,邮票团购');
        Tpl::output('seo_description','收藏天下藏品惠频道为您提供书画、人民币、邮票、钱币等收藏品的团购特惠，让您在低价中收藏到最好品相的收藏品，收藏天下团购，低价超值。');*/
        Model('seo')->type('group')->show();


        Tpl::output('groupbuyMenuIsVr', 0);
        Tpl::showpage('groupbuy_list');
    }

    /**
     * 团购详细信息
     **/
    public function groupbuy_detailOp() {
        $group_id = intval($_GET['group_id']);

        $model_groupbuy = Model('groupbuy');
        $model_store = Model('store');

        //获取团购详细信息
        $groupbuy_info = $model_groupbuy->getGroupbuyInfoByID($group_id);
        if(empty($groupbuy_info)) {
            showMessage(Language::get('param_error'),urlShop('show_groupbuy', 'index'),'','error');
        }
        Tpl::output('groupbuy_info',$groupbuy_info);

        Tpl::output('groupbuyMenuIsVr', (bool) $groupbuy_info['is_vr']);

        if ($groupbuy_info['is_vr']) {
            $goods_info = Model('goods')->getGoodsInfoByID($groupbuy_info['goods_id']);
            $buy_limit = max(0, (int) $goods_info['virtual_limit']);
            $upper_limit = max(0, (int) $groupbuy_info['upper_limit']);
            if ($buy_limit < 1 || ($buy_limit > 0 && $upper_limit > 0 && $buy_limit > $upper_limit)) {
                $buy_limit = $upper_limit;
            }

            Tpl::output('goods_info', $goods_info);
            Tpl::output('buy_limit', $buy_limit);
        } else {
            Tpl::output('buy_limit', $groupbuy_info['upper_limit']);
        }

        // 输出店铺信息
        $store_info = $model_store->getStoreInfoByID($groupbuy_info['store_id']);
        Tpl::output('store_info', $store_info);

        // 浏览数加1
        $update_array = array();
        $update_array['views'] = array('exp', 'views+1');
        $model_groupbuy->editGroupbuy($update_array, array('groupbuy_id'=>$group_id));


        //获取店铺推荐商品
        $commended_groupbuy_list = $model_groupbuy->getGroupbuyCommendedList(8);
        Tpl::output('commended_groupbuy_list', $commended_groupbuy_list);

        // 好评率
        $model_evaluate = Model('evaluate_goods');
        $evaluate_info = $model_evaluate->getEvaluateGoodsInfoByCommonidID($groupbuy_info['goods_commonid']);
        Tpl::output('evaluate_info', $evaluate_info);

        Model('seo')->type('group_content')->param(array('name'=>$groupbuy_info['groupbuy_name']))->show();

        loadfunc('search');
        Tpl::showpage('groupbuy_detail');
    }

    /**
     * 购买记录
     */
    public function groupbuy_orderOp() {
        $group_id = intval($_GET['group_id']);
        if ($group_id > 0) {
            if (!$_GET['is_vr']) {
                //获取购买记录
                $model_order = Model('order');
                $condition = array();
                $condition['goods_type'] = 2;
                $condition['promotions_id'] = $group_id;
                $order_goods_list = $model_order->getOrderGoodsList($condition, '*', 0 , 10);
                Tpl::output('order_goods_list', $order_goods_list);
                Tpl::output('show_page', $model_order->showpage());
                if (!empty($order_goods_list)) {
                    $orderid_array = array();
                    foreach ($order_goods_list as $value) {
                        $orderid_array[] = $value['order_id'];
                    }
                    $order_list = $model_order->getNormalOrderList(array('order_id' => array('in', $orderid_array)), '', 'order_id,buyer_name,add_time');
                    $order_list = array_under_reset($order_list, 'order_id');
                    Tpl::output('order_list', $order_list);
                }
            } else {
                $model_order = Model('vr_order');
                $condition = array();
                $condition['order_promotion_type'] = 1;
                $condition['promotions_id'] = $group_id;
                $order_goods_list = $model_order->getOrderAndOrderGoodsSalesRecordList($condition, '*', 10);
                Tpl::output('order_goods_list', $order_goods_list);
                Tpl::output('show_page', $model_order->showpage());
            }
        }
        Tpl::showpage('groupbuy_order', 'null_layout');
    }

    /**
     * 商品评价
     */
    public function groupbuy_evaluateOp() {
        $goods_commonid = intval($_GET['commonid']);
        if ($goods_commonid > 0) {
            $condition = array();
            $condition['goods_commonid'] = $goods_commonid;
            $goods_list = Model('goods')->getGoodsList($condition, 'goods_id');
            if (!empty($goods_list)) {
                $goodsid_array = array();
                foreach ($goods_list as $value) {
                    $goodsid_array[] = $value['goods_id'];
                }
                $model_evaluate = Model('evaluate_goods');
                $where = array();
                $where['geval_goodsid'] = array('in', $goodsid_array);
                $evaluate_list = $model_evaluate->getEvaluateGoodsList($where, 10);
                Tpl::output('goodsevallist',$evaluate_list);
                Tpl::output('show_page',$model_evaluate->showpage());
            }
        }
        Tpl::showpage('groupbuy_evaluate', 'null_layout');
    }
}
