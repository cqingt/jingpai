<?php
/**
 * 商家中心拍卖管理
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class store_paimaiControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();

        //读取语言包
        Language::read('member_paimai');
        //检查拍卖功能是否开启
        if (intval(C('paimai_allow')) !== 1){
            showMessage(Language::get('paimai_unavailable'),'index.php?act=seller_center','','error');
        }
    }
    /**
     * 默认显示抢购列表
     **/
    public function indexOp() {
        $this->paimai_listOp();
    }

    /**
     * 抢购套餐购买
     **/
    public function paimai_quota_addOp() {
        //输出导航
        self::profile_menu('paimai_quota_add');
        Tpl::showpage('store_paimai_quota.add');
    }

    /**
     * 抢购套餐购买保存
     **/
    public function paimai_quota_add_saveOp() {
        $paimai_quota_quantity = intval($_POST['paimai_quota_quantity']);
        if($paimai_quota_quantity <= 0) {
            showDialog('购买数量不能为空');
        }

        $model_paimai_quota = Model('paimai_quota');

        //获取当前价格
        $current_price = intval(C('paimai_price'));

        //获取该用户已有套餐
        $current_paimai_quota= $model_paimai_quota->getPaimaiQuotaCurrent($_SESSION['store_id']);
        $add_time = 86400 * 30 * $paimai_quota_quantity;
        if(empty($current_paimai_quota)) {
            //生成套餐
            $param = array();
            $param['member_id'] = $_SESSION['member_id'];
            $param['member_name'] = $_SESSION['member_name'];
            $param['store_id'] = $_SESSION['store_id'];
            $param['store_name'] = $_SESSION['store_name'];
            $param['start_time'] = TIMESTAMP;
            $param['end_time'] = TIMESTAMP + $add_time;
            $model_paimai_quota->addPaimaiQuota($param);
        } else {
            $param = array();
            $param['end_time'] = array('exp', 'end_time + ' . $add_time);
            $model_paimai_quota->editPaimaiQuota($param, array('quota_id' => $current_paimai_quota['quota_id']));
        }

        //记录店铺费用
        $this->recordStoreCost($current_price * $paimai_quota_quantity, '购买拍卖');

        $this->recordSellerLog('购买'.$paimai_quota_quantity.'份拍卖套餐，单价'.$current_price.L('nc_yuan'));

        showDialog(Language::get('paimai_quota_add_success'), urlShop('store_paimai', 'paimai_list'), 'succ');
    }

    /**
     * 抢购列表
     **/
    public function paimai_listOp() {
        $model_paimai = Model('paimai');
        $model_paimai_quota = Model('paimai_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_paimai_quota = $model_paimai_quota->getPaimaiQuotaCurrent($_SESSION['store_id']);
            Tpl::output('current_paimai_quota', $current_paimai_quota);
        }

        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        if(!empty($_GET['paimai_state'])) {
            $condition['state'] = $_GET['paimai_state'];
        }
        $condition['paimai_name'] = array('like', '%'.$_GET['paimai_name'].'%');

        if (strlen($paimai_vr = trim($_GET['paimai_vr']))) {
            $condition['is_vr'] = $paimai_vr ? 1 : 0;
            Tpl::output('paimai_vr', $paimai_vr);
        }
        $paimai_list = $model_paimai->getPaimaiExtendList($condition, 10);
        Tpl::output('group',$paimai_list);
        Tpl::output('show_page',$model_paimai->showpage());
        Tpl::output('paimai_state_array', $model_paimai->getPaimaiStateArray());

        self::profile_menu('paimai_list');
        Tpl::showpage('store_paimai.list');
    }

    /**
     * 添加抢购页面
     **/
    public function paimai_addOp() {
        $model_paimai_quota = Model('paimai_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_paimai_quota = $model_paimai_quota->getPaimaiQuotaCurrent($_SESSION['store_id']);
            if(empty($current_paimai_quota)) {
                showMessage('当前没有可用套餐，请先购买套餐',urlShop('store_paimai', 'paimai_quota_add'),'','error');
            }
            Tpl::output('current_paimai_quota', $current_paimai_quota);
        }

        // 根据后台设置的审核期重新设置拍卖开始时间
        Tpl::output('paimai_start_time', TIMESTAMP + intval(C('paimai_review_day')) * 86400);

        Tpl::output('paimai_classes', Model('paimai')->getPaimaiClasses());

        self::profile_menu('paimai_add');
        Tpl::showpage('store_paimai.add');

    }

    /**
     * 抢购保存
     **/
    public function paimai_saveOp() {
        //获取提交的数据
        $goods_id = intval($_POST['paimai_goods_id']);
        if(empty($goods_id)) {
            showDialog(Language::get('param_error'));
        }

        $model_paimai = Model('paimai');
        $model_goods = Model('goods');
        $model_paimai_quota = Model('paimai_quota');

        if (!checkPlatformStore()) {
            // 检查套餐
            $current_paimai_quota = $model_paimai_quota->getPaimaiQuotaCurrent($_SESSION['store_id']);
            if(empty($current_paimai_quota)) {
                showDialog('当前没有可用套餐，请先购买套餐',urlShop('store_paimai', 'paimai_quota_add'),'error');
            }
        }

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_id,goods_commonid,goods_name,goods_price,store_id,virtual_limit');
        if(empty($goods_info) || $goods_info['store_id'] != $_SESSION['store_id']) {
            showDialog(Language::get('param_error'));
        }

        $param = array();
        $param['paimai_name'] = $_POST['paimai_name'];
        $param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['start_time']);
        $param['end_time'] = strtotime($_POST['end_time']);
        $param['paimai_price'] = floatval($_POST['paimai_price']);
        $param['paimai_rebate'] = ncPriceFormat(floatval($_POST['paimai_price'])/floatval($goods_info['goods_price'])*10);
        $param['paimai_image'] = $_POST['paimai_image'];
        $param['paimai_image1'] = $_POST['paimai_image1'];
        $param['virtual_quantity'] = intval($_POST['virtual_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        $param['paimai_intro'] = $_POST['paimai_intro'];
        $param['class_id'] = intval($_POST['class_id']);
        $param['goods_id'] = $goods_info['goods_id'];
        $param['goods_commonid'] = $goods_info['goods_commonid'];
        $param['goods_name'] = $goods_info['goods_name'];
        $param['goods_price'] = $goods_info['goods_price'];
        $param['store_id'] = $_SESSION['store_id'];
        $param['store_name'] = $_SESSION['store_name'];

        //保存
        $result = $model_paimai->addPaimai($param);
        if($result) {
            // 自动发布动态
            // group_id,group_name,goods_id,goods_price,paimai_price,group_pic,rebate,start_time,end_time
            $data_array = array();
            $data_array['group_id']			= $result;
            $data_array['group_name']		= $param['group_name'];
            $data_array['goods_id']			= $param['goods_id'];
            $data_array['goods_price']		= $param['goods_price'];
            $data_array['paimai_price']	= $param['paimai_price'];
            $data_array['group_pic']		= $param['paimai_image1'];
            $data_array['rebate']			= $param['paimai_rebate'];
            $data_array['start_time']		= $param['start_time'];
            $data_array['end_time']			= $param['end_time'];
            $this->storeAutoShare($data_array, 'paimai');

            $this->recordSellerLog('发布拍卖活动，拍卖名称：'.$param['paimai_name'].'，商品名称：'.$param['goods_name']);
            showDialog(Language::get('paimai_add_success'),'index.php?act=store_paimai','succ');
        }else {
            showDialog(Language::get('paimai_add_fail'),'index.php?act=store_paimai');
        }
    }

    public function paimai_goods_infoOp() {
        $goods_commonid = intval($_GET['goods_commonid']);

        $data = array();
        $data['result'] = true;

        $model_goods = Model('goods');

        $condition = array();
        $condition['goods_commonid'] = $goods_commonid;
        $goods_list = $model_goods->getGoodsOnlineList($condition);

        if(empty($goods_list)) {
            $data['result'] = false;
            $data['message'] = L('param_error');
            echo json_encode($data);die;
        }

        $goods_info = $goods_list[0];
        $data['goods_id'] = $goods_info['goods_id'];
        $data['goods_name'] = $goods_info['goods_name'];
        $data['goods_price'] = $goods_info['goods_price'];
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

    public function check_paimai_goodsOp() {
        $start_time = strtotime($_GET['start_time']);
        $goods_id = $_GET['goods_id'];

        $model_paimai = Model('paimai');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['end_time'] = array('gt', $start_time);
        $condition['goods_id'] = $goods_id;
        $paimai_list = $model_paimai->getPaimaiAvailableList($condition);
        if(!empty($paimai_list)) {
            $data['result'] = false;
            echo json_encode($data);die;
        }

        echo json_encode($data);die;
    }

    /**
     * 上传图片
     **/
    public function image_uploadOp() {
        if(!empty($_POST['old_paimai_image'])) {
            $this->_image_del($_POST['old_paimai_image']);
        }
        $this->_image_upload('paimai_image');
    }

    private function _image_upload($file) {
        $data = array();
        $data['result'] = true;
        if(!empty($_FILES[$file]['name'])) {
            $upload	= new UploadFile();
            $uploaddir = ATTACH_PATH.DS.'paimai'.DS.$_SESSION['store_id'].DS;
            $upload->set('default_dir', $uploaddir);
            $upload->set('thumb_width',	'480,296,168');
            $upload->set('thumb_height', '480,296,168');
            $upload->set('thumb_ext', '_max,_mid,_small');
            $upload->set('fprefix', $_SESSION['store_id']);
            $result = $upload->upfile($file);
            if($result) {
                $data['file_name'] = $upload->file_name;
                $data['origin_file_name'] = $_FILES[$file]['name'];
                $data['file_url'] = pthumb($upload->file_name, 'mid');
            } else {
                $data['result'] = false;
                $data['message'] = $upload->error;
            }
        } else {
            $data['result'] = false;
        }
        echo json_encode($data);die;
    }

    /**
     * 图片删除
     */
    private function _image_del($image_name) {
        list($base_name, $ext) = explode(".", $image_name);
        $base_name = str_replace('/', '', $base_name);
        $base_name = str_replace('.', '', $base_name);
        list($store_id) = explode('_', $base_name);
        $image_path = BASE_UPLOAD_PATH.DS.ATTACH_PAIMAI.DS.$store_id.DS;
        $image = $image_path.$base_name.'.'.$ext;
        $image_small = $image_path.$base_name.'_small.'.$ext;
        $image_mid = $image_path.$base_name.'_mid.'.$ext;
        $image_max = $image_path.$base_name.'_max.'.$ext;
        @unlink($image);
        @unlink($image_small);
        @unlink($image_mid);
        @unlink($image_max);
    }

    /**
     * 选择活动商品
     **/
    public function search_goodsOp() {
        $model_goods = Model('goods');
        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        $goods_list = $model_goods->getGoodsCommonListForPromotion($condition, '*', 8, 'paimai');

        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('store_paimai.goods', 'null_layout');
    }

    /**
     * 添加虚拟抢购页面
     */
    public function paimai_add_vrOp()
    {
        $model_paimai_quota = Model('paimai_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_paimai_quota = $model_paimai_quota->getPaimaiQuotaCurrent($_SESSION['store_id']);
            if(empty($current_paimai_quota)) {
                showMessage('当前没有可用套餐，请先购买套餐', urlShop('store_paimai', 'paimai_quota_add'), '', 'error');
            }
            Tpl::output('current_paimai_quota', $current_paimai_quota);
        }

        // 根据后台设置的审核期重新设置抢购开始时间
        Tpl::output('paimai_start_time', TIMESTAMP + intval(C('paimai_review_day')) * 86400);

        // 虚拟抢购分类
        // Tpl::output('paimai_vr_classes', Model('paimai')->getpaimaiVrClasses());
        $model_vr_paimai_class = Model('vr_paimai_class');
        $classlist = $model_vr_paimai_class->getVrPaimaiClassList(array('parent_class_id'=>0));
        Tpl::output('classlist', $classlist);

        // 虚拟区域分类
        // Tpl::output('paimai_vr_cities', Model('paimai')->getpaimaiVrCities());
        $model_vr_paimai_area = Model('vr_paimai_area');
        $arealist = $model_vr_paimai_area->getVrPaimaiAreaList(array('parent_area_id'=>0,'hot_city'=>1),'','100');
        Tpl::output('arealist', $arealist);

        self::profile_menu('paimai_add_vr');
        Tpl::showpage('store_paimai.add_vr');
    }

    public function ajax_vr_classOp()
    {
        $class_id = intval($_GET['class_id']);
        if (empty($class_id)) {
            exit('false');
        }

        $condition = array();
        $condition['parent_class_id'] = $class_id;

        $model_vr_paimai_class = Model('vr_paimai_class');
        $class_list = $model_vr_paimai_class->getVrPaimaiClassList($condition);

        if (!empty($class_list)) {
            echo json_encode($class_list);
        } else {
            echo 'false';
        }

        exit;
    }

    public function ajax_vr_areaOp()
    {
        $area_id = intval($_GET['area_id']);
        if (empty($area_id)) {
            exit('false');
        }

        $condition = array();
        $condition['parent_area_id'] = $area_id;

        $model_vr_paimai_area = Model('vr_paimai_area');
        $area_list = $model_vr_paimai_area->getVrPaimaiAreaList($condition);

        if (!empty($area_list)) {
            echo json_encode($area_list);
        } else {
            echo 'false';
        }

        exit;
    }

    /**
     * 选择活动虚拟商品
     */
    public function search_vr_goodsOp()
    {
        $model_goods = Model('goods');
        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        $goods_list = $model_goods->getGoodsCommonListForVrPromotion($condition, '*', 8);

        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('store_paimai.goods', 'null_layout');
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
            1=>array('menu_key'=>'paimai_list','menu_name'=>L('nc_member_path_paimai_list'),'menu_url'=>urlShop('store_paimai', 'paimai_list'))
        );
        switch ($menu_key){
			case 'paimai_add':
				$menu_array[] = array('menu_key'=>'paimai_add','menu_name'=>L('nc_member_path_new_paimai'),'menu_url'=>'index.php?act=store_paimai&op=paimai_add');
				break;
			case 'paimai_add_vr':
				$menu_array[] = array('menu_key'=>'paimai_add_vr','menu_name'=>'新增虚拟拍卖','menu_url'=>'index.php?act=store_paimai&op=paimai_add_vr');
				break;
			case 'paimai_quota_add':
				$menu_array[] = array('menu_key'=>'paimai_quota_add','menu_name'=>'购买套餐','menu_url'=>urlShop('store_paimai', 'paimai_quota_add'));
				break;
			case 'paimai_edit':
				$menu_array[] = array('menu_key'=>'paimai_edit','menu_name'=>L('nc_member_path_edit_paimai'),'menu_url'=>'index.php?act=store_paimai');
				break;
			case 'cancel':
				$menu_array[] = array('menu_key'=>'paimai_cancel','menu_name'=>L('nc_member_path_cancel_paimai'));
				break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
