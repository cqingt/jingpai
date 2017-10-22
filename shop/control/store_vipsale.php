<?php
/**
 * 商家中心会员特价
 * author:xin
 * date:2015.11.27
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class store_vipsaleControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();

        //读取语言包
        Language::read('member_vipsale');
        //检查抢购功能是否开启
        if (intval(C('vipsale_allow')) !== 1){
            showMessage(Language::get('vipsale_unavailable'),'index.php?act=seller_center','','error');
        }
    }
    /**
     * 默认显示抢购列表
     **/
    public function indexOp() {
        $this->vipsale_listOp();
    }

    /**
     * 抢购套餐购买
     **/
    public function vipsale_quota_addOp() {
        //输出导航
        self::profile_menu('vipsale_quota_add');
        Tpl::showpage('store_vipsale_quota.add');
    }

    /**
     * 抢购套餐购买保存
     **/
    public function vipsale_quota_add_saveOp() {
        $vipsale_quota_quantity = intval($_POST['vipsale_quota_quantity']);
        if($vipsale_quota_quantity <= 0) {
            showDialog('购买数量不能为空');
        }

        $model_vipsale_quota = Model('vipsale_quota');

        //获取当前价格
        $current_price = intval(C('vipsale_price'));

        //获取该用户已有套餐
        $current_vipsale_quota= $model_vipsale_quota->getVipsaleQuotaCurrent($_SESSION['store_id']);
        $add_time = 86400 * 30 * $vipsale_quota_quantity;
        if(empty($current_vipsale_quota)) {
            //生成套餐
            $param = array();
            $param['member_id'] = $_SESSION['member_id'];
            $param['member_name'] = $_SESSION['member_name'];
            $param['store_id'] = $_SESSION['store_id'];
            $param['store_name'] = $_SESSION['store_name'];
            $param['start_time'] = TIMESTAMP;
            $param['end_time'] = TIMESTAMP + $add_time;
            $model_vipsale_quota->addVipsaleQuota($param);
        } else {
            $param = array();
            $param['end_time'] = array('exp', 'end_time + ' . $add_time);
            $model_vipsale_quota->editVipsaleQuota($param, array('quota_id' => $current_vipsale_quota['quota_id']));
        }

        //记录店铺费用
        $this->recordStoreCost($current_price * $vipsale_quota_quantity, '购买会员特价');

        $this->recordSellerLog('购买'.$vipsale_quota_quantity.'份会员特价套餐，单价'.$current_price.L('nc_yuan'));

        showDialog(Language::get('vipsale_quota_add_success'), urlShop('store_vipsale', 'vipsale_list'), 'succ');
    }

    /**
     * 会员特价列表
     **/
    public function vipsale_listOp() {
        $model_vipsale = Model('vipsale');
        $model_vipsale_quota = Model('vipsale_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_vipsale_quota = $model_vipsale_quota->getVipsaleQuotaCurrent($_SESSION['store_id']);
            Tpl::output('current_vipsale_quota', $current_vipsale_quota);
        }

        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        if(!empty($_GET['vipsale_state'])) {
            $condition['state'] = $_GET['vipsale_state'];
        }
        $condition['goods_name'] = array('like', '%'.$_GET['search_goods_name'].'%');

        /*if (strlen($vipsale_vr = trim($_GET['vipsale_vr']))) {
            $condition['is_vr'] = $vipsale_vr ? 1 : 0;
            Tpl::output('vipsale_vr', $vipsale_vr);
        }*/
        $vipsale_list = $model_vipsale->getVipsaleExtendList($condition, 10);


        Tpl::output('vipsale',$vipsale_list);
        Tpl::output('show_page',$model_vipsale->showpage());
        Tpl::output('vipsale_state_array', $model_vipsale->getVipsaleStateArray());

        self::profile_menu('vipsale_list');
        Tpl::showpage('store_vipsale.list');
    }

    /**
     * 添加会员特价页面
     **/
    public function vipsale_addOp() {

        $model_vipsale_quota = Model('vipsale_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_vipsale_quota = $model_vipsale_quota->getVipsaleQuotaCurrent($_SESSION['store_id']);
            if(empty($current_vipsale_quota)) {
                showMessage('当前没有可用套餐，请先购买套餐',urlShop('store_vipsale', 'vipsale_quota_add'),'','error');
            }
            Tpl::output('current_vipsale_quota', $current_vipsale_quota);
        }

        $vipsale_review_day = C('vipsale_review_day');
        Tpl::output('start_review_time', TIMESTAMP+$vipsale_review_day*86400);
        $member_grade = unserialize(C('member_grade'));

        Tpl::output('member_grade', $member_grade);

        self::profile_menu('vipsale_add');
        Tpl::showpage('store_vipsale.add');

    }

    /**
     * 会员特价保存
     **/
    public function vipsale_saveOp() {

        //获取提交的数据
        $goods_id = intval($_POST['vipsale_goods_id']);
        if(empty($goods_id)) {
            showDialog(Language::get('param_error'));
        }

        $model_vipsale = Model('vipsale');
        $model_goods = Model('goods');
        $model_vipsale_quota = Model('vipsale_quota');


        if (!checkPlatformStore()) {
            // 检查套餐
            $current_vipsale_quota = $model_vipsale_quota->getVipsaleQuotaCurrent($_SESSION['store_id']);
            if(empty($current_vipsale_quota)) {
                showDialog('当前没有可用套餐，请先购买套餐',urlShop('store_vipsale', 'vipsale_quota_add'),'error');
            }
        }

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_id,goods_commonid,goods_name,goods_price,store_id,virtual_limit');
        if(empty($goods_info) || $goods_info['store_id'] != $_SESSION['store_id']) {
            showDialog(Language::get('param_error'));
        }
        if($goods_info['sku_lock'] == 1) {
            showDialog('此商品已经参加其他未结束活动');
        }
        //获取用户选择的会员特价活动

        $param = array();
        //$param['vipsale_name'] = $_POST['vipsale_name'];
        //$param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['start_time']);
        $param['end_time'] = strtotime($_POST['end_time']);
        $param['vipsale_price'] = intval($_POST['vipsale_price']);
        $param['level'] = intval($_POST['level']);
        $member_grade = unserialize(C('member_grade'));
        $param['level_name'] = $member_grade[$_POST['level']]['level_name'];
        //$param['vipsale_image1'] = $_POST['vipsale_image1'];
        $param['max_quantity'] = intval($_POST['max_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        //$param['vipsale_intro'] = $_POST['vipsale_intro'];
        $param['goods_id'] = $goods_info['goods_id'];
        $param['goods_commonid'] = $goods_info['goods_commonid'];
        $param['goods_name'] = $goods_info['goods_name'];
        $param['goods_price'] = $goods_info['goods_price'];
        $param['store_id'] = $_SESSION['store_id'];
        $param['store_name'] = $_SESSION['store_name'];


        //保存
        $result = $model_vipsale->addVipsale($param);
        if($result) {
            // 自动发布动态
            // group_id,group_name,goods_id,goods_price,vipsale_price,group_pic,rebate,start_time,end_time
            $data_array = array();
            $data_array['group_id']			= $result;
            $data_array['goods_name']		= $param['goods_name'];
            $data_array['goods_id']			= $param['goods_id'];
            $data_array['goods_price']		= $param['goods_price'];
            $data_array['vipsale_price']	= $param['vipsale_price'];
            $data_array['max_quantity']		= $param['max_quantity'];
            $data_array['upper_limit']			= $param['upper_limit'];
            $data_array['store_id']		= $param['store_id'];
            $data_array['store_name']			= $param['store_name'];
            $this->storeAutoShare($data_array, 'vipsale');

            $this->recordSellerLog('提交会员特价商品，商品名称：'.$param['goods_name'].';会员特价：'.$param['vipsale_price']);
            showDialog(Language::get('vipsale_add_success'),'index.php?act=store_vipsale','succ');
        }else {
            showDialog(Language::get('vipsale_add_fail'),'index.php?act=store_vipsale');
        }
    }

    public function vipsale_goods_infoOp() {
        $goods_id = intval($_GET['goods_id']);

        $data = array();
        $data['result'] = true;

        $model_goods = Model('goods');

        $goods_list = $model_goods->getGoodsInfoByID($goods_id);

        if(empty($goods_list)) {
            $data['result'] = false;
            $data['message'] = L('param_error');
            echo json_encode($data);die;
        }

        $goods_info = $goods_list;
        if($goods_info['sku_lock'] == 1) {
            $data['result'] = false;
            $data['message'] = '此商品已经参加其他未结束活动！';
            echo json_encode($data);die;
        }
        $data['goods_id'] = $goods_info['goods_id'];
        $data['goods_name'] = $goods_info['goods_name'];
        $data['goods_price'] = $goods_info['goods_price'];
        $data['goods_storage'] = $goods_info['goods_storage'];
        $data['goods_image'] = thumb($goods_info, 240);
        $data['goods_href'] = urlShop('goods', 'index', array('goods_id' => $goods_info['goods_id']));


        echo json_encode($data);die;
    }

    public function check_vipsale_goodsOp() {
        $vipsale_date = strtotime($_GET['vipsale_date']);
        $goods_id = intval($_GET['goods_id']);

        $model_vipsale = Model('vipsale');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['start_time'] = array('gt', $vipsale_date);
        $condition['end_time'] = array('lt', $vipsale_date + 86400);
        $condition['state'] = array(array('eq', '10'),array('eq', '20'),'or');
        $condition['goods_id'] = $goods_id;
        $vipsale_list = $model_vipsale->getVipsaleAvailableList($condition);
        if(!empty($vipsale_list)) {
            $data['result'] = false;
            echo json_encode($data);die;
        }

        echo json_encode($data);die;
    }



    /**
     * 选择活动商品
     **/
    public function search_goodsOp() {
        $model_goods = Model('goods');
        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        $condition['goods_state'] = '1';
        $condition['goods_verify'] = '1';
        $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');

        $goods_list =$model_goods->getGoodsList($condition, '*','','','', 8);


        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('store_vipsale.goods', 'null_layout');
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
            1=>array('menu_key'=>'vipsale_list','menu_name'=>L('nc_member_path_vipsale_list'),'menu_url'=>urlShop('store_vipsale', 'vipsale_list'))
        );
        switch ($menu_key){
        case 'vipsale_add':
            $menu_array[] = array('menu_key'=>'vipsale_add','menu_name'=>L('nc_member_path_new_vipsale'),'menu_url'=>'index.php?act=store_vipsale&op=vipsale_add');
            break;
        case 'vipsale_quota_add':
            $menu_array[] = array('menu_key'=>'vipsale_quota_add','menu_name'=>L('nc_member_path_bundling_quota_add'),'menu_url'=>urlShop('store_vipsale', 'vipsale_quota_add'));
            break;
        case 'vipsale_edit':
            $menu_array[] = array('menu_key'=>'vipsale_edit','menu_name'=>L('nc_member_path_edit_vipsale'),'menu_url'=>'index.php?act=store_vipsale');
            break;
        case 'cancel':
            $menu_array[] = array('menu_key'=>'vipsale_cancel','menu_name'=>L('nc_member_path_cancel_vipsale'));
            break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
