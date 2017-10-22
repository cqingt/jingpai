<?php
/**
 * 商家中心一元夺宝管理
 * author:xin
 * date:2015.10.15
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class store_duobaoControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();
        $this->ToApi = new ToApi();

    }
    /**
     * 默认显示抢购列表
     **/
    public function indexOp() {
        $this->duobao_listOp();
    }

    /**
     * 商家夺宝商品列表
     **/
    public function duobao_listOp() {
        $size = '10';//每页显示数量
        $pagenum = (intval($_GET['curpage'] < 1))?'1':intval($_GET['curpage']);
        $item_list = $this->ToApi->get_duobao_item(3,$size,$pagenum);

        Tpl::output('item_list',$item_list['message']);
        if($item_list['message']['code'] == 1){
            $pages = new Page();
            $pages->set('each_num',$size);
            $pages->set('total_num',$item_list['message']['total']);
            $pages->set('now_page',$pagenum);
            Tpl::output('show_page', $pages->show());
        }

        self::profile_menu('duobao_list');
        Tpl::showpage('store_duobao.list');
    }

    /**
     * 商家夺宝订单列表
     **/
    public function duobao_orderOp() {
        $size = '10';//每页显示数量
        $pagenum = (intval($_GET['curpage'] < 1))?'1':intval($_GET['curpage']);
        $item_list = $this->ToApi->get_duobao_order(3,$size,$pagenum);

        Tpl::output('item_list',$item_list['message']);
        if($item_list['message']['code'] == 1){
            $pages = new Page();
            $pages->set('each_num',$size);
            $pages->set('total_num',$item_list['message']['total']);
            $pages->set('now_page',$pagenum);
            Tpl::output('show_page', $pages->show());
        }

        self::profile_menu('duobao_order');
        Tpl::showpage('store_duobao.order');
    }

    /**
     * 商家夺宝订单列表
     **/
    public function ajax_fahuoOp() {
        $gid = $_POST['gid'];//夺宝商品ID
        $company = $_POST['company'];
        $company_code = $_POST['company_code'];
        $return = $this->ToApi->duobao_fahuo(3,$gid,$company,$company_code);

        if($return['res'] == 'succ'){
            echo $return['message'];//1为发货成功，2为重复发货
            exit();
        }else{
             exit('3');
        }

    }

    /**
     * 用户中心右边，小导航
     *
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    private function profile_menu($menu_key='') {
        $menu_array	= array(
            1=>array('menu_key'=>'duobao_list','menu_name'=>'夺宝商品列表','menu_url'=>urlShop('store_duobao', 'duobao_list')),
            2=>array('menu_key'=>'duobao_order','menu_name'=>'夺宝订单列表','menu_url'=>urlShop('store_duobao', 'duobao_order'))
        );
        switch ($menu_key){
        case 'miaosha_add':
            $menu_array[] = array('menu_key'=>'duobao_order','menu_name'=>'夺宝订单列表','menu_url'=>urlShop('store_duobao', 'duobao_order'));
            break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
