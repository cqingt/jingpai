<?php
/**
 * 商家中心秒杀管理
 * author:xin
 * date:2015.09.17
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class store_miaoshaControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();

        //读取语言包
        Language::read('member_miaosha');
        //检查抢购功能是否开启
        if (intval(C('miaosha_allow')) !== 1){
            showMessage(Language::get('miaosha_unavailable'),'index.php?act=seller_center','','error');
        }
    }
    /**
     * 默认显示抢购列表
     **/
    public function indexOp() {
        $this->miaosha_listOp();
    }

    /**
     * 抢购套餐购买
     **/
    public function miaosha_quota_addOp() {
        //输出导航
        self::profile_menu('miaosha_quota_add');
        Tpl::showpage('store_miaosha_quota.add');
    }

    /**
     * 抢购套餐购买保存
     **/
    public function miaosha_quota_add_saveOp() {
        $miaosha_quota_quantity = intval($_POST['miaosha_quota_quantity']);
        if($miaosha_quota_quantity <= 0) {
            showDialog('购买数量不能为空');
        }

        $model_miaosha_quota = Model('miaosha_quota');

        //获取当前价格
        $current_price = C('miaosha_price');

        //获取该用户已有套餐
        $current_miaosha_quota= $model_miaosha_quota->getMiaoshaQuotaCurrent($_SESSION['store_id']);
        $add_time = 86400 * 30 * $miaosha_quota_quantity;
        if(empty($current_miaosha_quota)) {
            //生成套餐
            $param = array();
            $param['member_id'] = $_SESSION['member_id'];
            $param['member_name'] = $_SESSION['member_name'];
            $param['store_id'] = $_SESSION['store_id'];
            $param['store_name'] = $_SESSION['store_name'];
            $param['start_time'] = TIMESTAMP;
            $param['end_time'] = TIMESTAMP + $add_time;
            $model_miaosha_quota->addMiaoshaQuota($param);
        } else {
            $param = array();
            $param['end_time'] = array('exp', 'end_time + ' . $add_time);
            $model_miaosha_quota->editMiaoshaQuota($param, array('quota_id' => $current_miaosha_quota['quota_id']));
        }

        //记录店铺费用
        $this->recordStoreCost($current_price * $miaosha_quota_quantity, '购买秒杀');

        $this->recordSellerLog('购买'.$miaosha_quota_quantity.'份秒杀套餐，单价'.$current_price.L('nc_yuan'));

        showDialog(Language::get('miaosha_quota_add_success'), urlShop('store_miaosha', 'miaosha_list'), 'succ');
    }

    /**
     * 秒杀列表
     **/
    public function miaosha_listOp() {
        $model_miaosha = Model('miaosha');
        $model_miaosha_quota = Model('miaosha_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_miaosha_quota = $model_miaosha_quota->getMiaoshaQuotaCurrent($_SESSION['store_id']);
            Tpl::output('current_miaosha_quota', $current_miaosha_quota);
        }

        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        if(!empty($_GET['miaosha_state'])) {
            $condition['state'] = $_GET['miaosha_state'];
        }
        $condition['goods_name'] = array('like', '%'.$_GET['search_goods_name'].'%');

        /*if (strlen($miaosha_vr = trim($_GET['miaosha_vr']))) {
            $condition['is_vr'] = $miaosha_vr ? 1 : 0;
            Tpl::output('miaosha_vr', $miaosha_vr);
        }*/
        $miaosha_list = $model_miaosha->getMiaoshaExtendList($condition, 10);


        Tpl::output('miaosha',$miaosha_list);
        Tpl::output('show_page',$model_miaosha->showpage());
        Tpl::output('miaosha_state_array', $model_miaosha->getMiaoshaStateArray());

        self::profile_menu('miaosha_list');
        Tpl::showpage('store_miaosha.list');
    }

    /**
     * 添加秒杀页面
     **/
    public function miaosha_addOp() {

        $model_miaosha_quota = Model('miaosha_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_miaosha_quota = $model_miaosha_quota->getMiaoshaQuotaCurrent($_SESSION['store_id']);
            if(empty($current_miaosha_quota)) {
                showMessage('当前没有可用套餐，请先购买套餐',urlShop('store_miaosha', 'miaosha_quota_add'),'','error');
            }
            Tpl::output('current_miaosha_quota', $current_miaosha_quota);
        }


        $model_miaosha_class = Model('miaosha_class');
        $param = array();
        $param['order'] = 'start_hour asc,sort asc';
        $miaosha_class_list = $model_miaosha_class->getList($param);

        // 根据后台设置的审核期重新设置抢购开始时间
        $miaosha_review_day = intval(C('miaosha_review_day'));

        $huodongdate = array();

        for($i=$miaosha_review_day;$i<$miaosha_review_day+20;$i++){
            $huodongdate[] = date('Y-m-d',strtotime("+".$i." days"));
        }

        Tpl::output('miaosha_date', $huodongdate);
        Tpl::output('miaosha_classes', $miaosha_class_list);

        self::profile_menu('miaosha_add');
        Tpl::showpage('store_miaosha.add');

    }

    /**
     * 秒杀保存
     **/
    public function miaosha_saveOp() {

        //获取提交的数据
        $goods_id = intval($_POST['miaosha_goods_id']);
        if(empty($goods_id)) {
            showDialog(Language::get('param_error'));
        }

        $model_miaosha = Model('miaosha');
        $model_goods = Model('goods');
        $model_miaosha_quota = Model('miaosha_quota');


        if (!checkPlatformStore()) {
            // 检查套餐
            $current_miaosha_quota = $model_miaosha_quota->getMiaoshaQuotaCurrent($_SESSION['store_id']);
            if(empty($current_miaosha_quota)) {
                showDialog('当前没有可用套餐，请先购买套餐',urlShop('store_miaosha', 'miaosha_quota_add'),'error');
            }
        }

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_id,goods_commonid,goods_name,goods_price,store_id,virtual_limit');
        if(empty($goods_info) || $goods_info['store_id'] != $_SESSION['store_id']) {
            showDialog(Language::get('param_error'));
        }
        if($goods_info['sku_lock'] == 1) {
            showDialog('此商品已经参加其他未结束活动','index.php?act=store_miaosha');
        }
        //获取用户选择的秒杀活动
        $miaosha_class = Model('miaosha_class')->getOne(intval($_POST['miaosha_class']));

        $param = array();
        //$param['miaosha_name'] = $_POST['miaosha_name'];
        //$param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['miaosha_date']) + $miaosha_class['start_hour']*3600;
        $param['end_time'] = strtotime($_POST['miaosha_date']) + $miaosha_class['end_hour']*3600;
        $param['miaosha_price'] = $_POST['miaosha_price'];
        $param['miaosha_rebate'] = ncPriceFormat(floatval($_POST['miaosha_price'])/floatval($goods_info['goods_price'])*10);
        //$param['miaosha_image'] = $_POST['miaosha_image'];
        //$param['miaosha_image1'] = $_POST['miaosha_image1'];
        $param['max_quantity'] = intval($_POST['max_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        //$param['miaosha_intro'] = $_POST['miaosha_intro'];
        $param['class_id'] = intval($_POST['miaosha_class']); //活动编号
        $param['goods_id'] = $goods_info['goods_id'];
        $param['goods_commonid'] = $goods_info['goods_commonid'];
        $param['goods_name'] = $goods_info['goods_name'];
        $param['goods_price'] = $goods_info['goods_price'];
        $param['store_id'] = $_SESSION['store_id'];
        $param['store_name'] = $_SESSION['store_name'];
		$param['is_shipping'] = intval($_POST['is_shipping']); //是否包邮

        //保存
        $result = $model_miaosha->addMiaosha($param);
        if($result) {
            // 自动发布动态
            // group_id,group_name,goods_id,goods_price,miaosha_price,group_pic,rebate,start_time,end_time
            $data_array = array();
            $data_array['group_id']			= $result;
            $data_array['goods_name']		= $param['goods_name'];
            $data_array['goods_id']			= $param['goods_id'];
            $data_array['goods_price']		= $param['goods_price'];
            $data_array['miaosha_price']	= $param['miaosha_price'];
            $data_array['max_quantity']		= $param['max_quantity'];
            $data_array['upper_limit']			= $param['upper_limit'];
            $data_array['store_id']		= $param['store_id'];
            $data_array['store_name']			= $param['store_name'];
            $this->storeAutoShare($data_array, 'miaosha');

            $this->recordSellerLog('提交秒杀商品，商品名称：'.$param['goods_name'].';秒杀价：'.$param['miaosha_price']);
            showDialog(Language::get('miaosha_add_success'),'index.php?act=store_miaosha','succ');
        }else {
            showDialog(Language::get('miaosha_add_fail'),'index.php?act=store_miaosha');
        }
    }

    public function miaosha_goods_infoOp() {
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

        if ($goods_info['is_virtual']) {
            $data['is_virtual'] = 1;
            $data['virtual_indate'] = $goods_info['virtual_indate'];
            $data['virtual_indate_str'] = date('Y-m-d H:i', $goods_info['virtual_indate']);
            $data['virtual_limit'] = $goods_info['virtual_limit'];
        }

        echo json_encode($data);die;
    }

    public function check_miaosha_goodsOp() {
        $miaosha_date = strtotime($_GET['miaosha_date']);
        $goods_id = intval($_GET['goods_id']);

        $model_miaosha = Model('miaosha');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['start_time'] = array('gt', $miaosha_date);
        $condition['end_time'] = array('lt', $miaosha_date + 86400);
        $condition['state'] = array(array('eq', '10'),array('eq', '20'),'or');
        $condition['goods_id'] = $goods_id;
        $miaosha_list = $model_miaosha->getMiaoshaAvailableList($condition);
        if(!empty($miaosha_list)) {
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
        Tpl::showpage('store_miaosha.goods', 'null_layout');
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
            1=>array('menu_key'=>'miaosha_list','menu_name'=>L('nc_member_path_miaosha_list'),'menu_url'=>urlShop('store_miaosha', 'miaosha_list'))
        );
        switch ($menu_key){
        case 'miaosha_add':
            $menu_array[] = array('menu_key'=>'miaosha_add','menu_name'=>L('nc_member_path_new_miaosha'),'menu_url'=>'index.php?act=store_miaosha&op=miaosha_add');
            break;
        case 'miaosha_quota_add':
            $menu_array[] = array('menu_key'=>'miaosha_quota_add','menu_name'=>L('nc_member_path_bundling_quota_add'),'menu_url'=>urlShop('store_miaosha', 'miaosha_quota_add'));
            break;
        case 'miaosha_edit':
            $menu_array[] = array('menu_key'=>'miaosha_edit','menu_name'=>L('nc_member_path_edit_miaosha'),'menu_url'=>'index.php?act=store_miaosha');
            break;
        case 'cancel':
            $menu_array[] = array('menu_key'=>'miaosha_cancel','menu_name'=>L('nc_member_path_cancel_miaosha'));
            break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
