<?php
/**
 * 买家 我的拍卖惠订单
 * xin 20151029
 *
 * */


defined('InShopNC') or exit('Access Invalid!');

class lepai_orderControl extends BaseMemberControl {

    public function __construct() {
        parent::__construct();
        Language::read('member_member_index');
    }

    public function indexOp(){
        $this->my_paimaiOp();
    }

    /**
     * 买家我的订单，以总订单pay_sn来分组显示
     *
     */
    public function listOp() {
        $h_model = Model('lepai_home');
        $user_orders = $h_model->getLepaiOrder(array('buyer_id'=>$_SESSION['member_id']));
        foreach ($user_orders as $k => $v) {
            $user_orders[$k]['goods_info'] = $h_model->getGoodsInfoOne(array('G_Id'=>$v['lepai_goods_id']));
        }

        Tpl::output('user_orders',$user_orders);
        Tpl::output('show_page',$h_model->showpage());
        self::profile_menu('lepai_list');


        Tpl::output('html_title','我的拍卖惠'.' - '.C('site_name'));
        
        Tpl::showpage('lepai_order.index');
    }

    /*
     * 我的竞拍  xin 20160329
     */
    public function my_paimaiOp(){
        $model_lepai = Model('lepai_home');
        $where = " lepai_baoming.member_id= '".$_SESSION['member_id']."' ";
        if($_GET['state_type'] == 'state_new'){
            $where .= ' AND lepai_admin_theme.T_Ktime > '.TIMESTAMP.' AND lepai_admin_goods.G_Atype=3';
        }elseif($_GET['state_type'] == 'state_on'){
            $where .= ' AND lepai_admin_goods.G_EndTime > '.TIMESTAMP.' AND lepai_admin_theme.T_Ktime < '.TIMESTAMP.'  AND lepai_admin_goods.G_Atype=3';
        }elseif($_GET['state_type'] == 'state_end'){
            $where .= ' AND lepai_admin_goods.G_EndTime < '.TIMESTAMP.' AND lepai_admin_goods.G_Atype>5';
        }

        if($_GET['name'] != ''){
            $where .= " AND lepai_admin_goods.G_Name like '%".trim($_GET['name'])."%'";
        }

        $lepai_list = $model_lepai->table('lepai_baoming,lepai_admin_goods,lepai_admin_theme')->join('left,left')->on('lepai_baoming.auction_id=lepai_admin_goods.G_Id,lepai_admin_goods.G_Tid=lepai_admin_theme.T_Id')->where($where)->field('*')->page('10')->order('lepai_baoming.id desc')->select();


        Tpl::output('lepai_list',$lepai_list);
        Tpl::output('show_page',$model_lepai->showpage());

        self::profile_menu('lepai_my');
        Tpl::output('html_title','我的竞拍'.' - '.C('site_name'));
        Tpl::showpage('lepai_order.my');
    }

    /*
     * 我的保证金 xin 20160329
     */
    public function my_depositOp(){
        $model_lepai = Model('lepai_home');
        $where = 'lepai_baoming.member_id = '.$_SESSION['member_id'];
        $list = $model_lepai->table('lepai_baoming,lepai_admin_goods')->join('left')->on('lepai_baoming.auction_id=lepai_admin_goods.G_Id')->where($where)->field('*')->page('10')->order('lepai_baoming.id desc')->select();
        Tpl::output('list',$list);
        Tpl::output('show_page',$model_lepai->showpage());

        self::profile_menu('my_deposit');
        Tpl::output('html_title','我的保证金'.' - '.C('site_name'));
        Tpl::showpage('lepai_order.deposit');
    }

    /**
     * 订单详细
     *
     */
    public function show_orderOp() {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            //showMessage(Language::get('member_order_none_exist'),'','html','error');
        }
		$getLepaiOrderShow = Model('lepai_home');
        $OrderShow = $getLepaiOrderShow->getLepaiOrderShow(array('order_id'=>$order_id,'buyer_id'=>$_SESSION['member_id']),array('order_goods','store'));

        $express = rkcache('express',true);


        $OrderShow['express_info']['e_url'] = $express[$OrderShow['shipping_ecode']]['e_url'];
        $OrderShow['express_info']['e_name'] = $express[$OrderShow['shipping_ecode']]['e_name'];

		Tpl::output('order_info',$OrderShow);
        Tpl::showpage('lepai_order.show');
    }

    /*
     * 用户取消订单
     */
    public function order_cancelOp(){
        $h_model = Model('lepai_home');
        $order_id = intval($_GET['order_id']);
        $h_model->updateLepaiOrder(array('order_state'=>'0','cancel_time'=>time()),array('order_id'=>$order_id,'buyer_id'=>$_SESSION['member_id']));
        showMessage('订单取消成功！','index.php?act=lepai_order','html','succ');
    }

    /*
     * 用户确认收货
     */
    public function order_receiveOp(){
        $h_model = Model('lepai_home');
        $order_id = intval($_GET['order_id']);
        $h_model->updateLepaiOrder(array('order_state'=>'40','finnshed_time'=>time()),array('order_id'=>$order_id,'buyer_id'=>$_SESSION['member_id']));
        showMessage('操作成功！','index.php?act=lepai_order','html','succ');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string	$menu_type	导航类型
     * @param string 	$menu_key	当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_key='') {
        Language::read('member_layout');
        $menu_array = array(
            array('menu_key'=>'lepai_my','menu_name'=>'我的竞拍', 'menu_url'=>'index.php?act=lepai_order'),
            array('menu_key'=>'my_deposit','menu_name'=>'我的保证金', 'menu_url'=>'index.php?act=lepai_order&op=my_deposit'),
            array('menu_key'=>'lepai_list','menu_name'=>'我的获拍', 'menu_url'=>'index.php?act=lepai_order&op=list'),
        );
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }

}
