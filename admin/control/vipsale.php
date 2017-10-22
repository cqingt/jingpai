<?php
/**
 * 会员特价管理
 * author:xin
 * date:2015.11.30
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class vipsaleControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('vipsale');

		//如果是执行开启抢购操作，直接返回
		if ($_GET['vipsale_open'] == 1) return true;

        //检查抢购功能是否开启
        if (C('vipsale_allow') != 1){
 			$url = array(
 				array(
					'url'=>'index.php?act=dashboard&op=welcome',
					'msg'=>Language::get('close'),
				),
				array(
					'url'=>'index.php?act=vipsale&op=vipsale_template_list&vipsale_open=1',
					'msg'=>Language::get('open'),
				),
			);
			showMessage(Language::get('admin_vipsale_unavailable'),$url,'html','succ',1,6000);
        }
    }

    public function indexOp() {
        $this->vipsale_listOp();
    }

    /**
     * 进行中会员特价列表，只可推荐
     *
     */
    public function vipsale_listOp(){
        $model_vipsale = Model('vipsale');

        $condition = array();
        if(!empty($_GET['search_goods_name'])) {
            $condition['goods_name'] = array('like', '%'.$_GET['search_goods_name'].'%');
        }
        if(!empty($_GET['store_name'])) {
            $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        }
        if(!empty($_GET['vipsale_state'])) {
            $condition['state'] = $_GET['vipsale_state'];
        }
        $vipsale_list = $model_vipsale->getVipsaleExtendList($condition, 10,'state asc,start_time desc,vipsale_id desc');
        Tpl::output('vipsale_list',$vipsale_list);
        Tpl::output('show_page',$model_vipsale->showpage());
        Tpl::output('vipsale_state_array', $model_vipsale->getVipsaleStateArray());

        $this->show_menu('vipsale_list');

        // 输出自营店铺IDS
        Tpl::output('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        Tpl::showpage('vipsale.list');
    }
    /**
     * 编辑会员特价产品
     *
     */
    public function vipsale_editOp(){
        $vipsale_id = $_GET['vipsale_id'];
        $model_vipsale = Model('vipsale');
        $vipsale_info = $model_vipsale->getVipsaleInfoByID($vipsale_id);

        $goods_info = Model('goods')->getGoodsInfoByID($vipsale_info['goods_id']);
        $goods_info['goods_image'] = thumb($goods_info, 240);
        if(!is_array($vipsale_info)){
            showMessage(L('vipsale_fail_errormsg'), '');
        }
        if($vipsale_info['vipsale_image'] != ''){
            list($base_name, $ext) = explode('.', $vipsale_info['vipsale_image']);
            $vipsale_info['vipsale_imageurl'] = UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.'vipsale'.DS.$base_name.'_mid'.'.'.$ext;
        }
        if($vipsale_info['vipsale_image1'] != ''){
            list($base_name, $ext) = explode('.', $vipsale_info['vipsale_image1']);
            $vipsale_info['vipsale_image1url'] = UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.'vipsale'.DS.$base_name.'_mid'.'.'.$ext;
        }

        $member_grade = unserialize(C('member_grade'));

        Tpl::output('member_grade', $member_grade);

        Tpl::output('vipsale_info',$vipsale_info);
        Tpl::output('goods_info',$goods_info);
        $this->show_menu('vipsale_edit');
        Tpl::showpage('vipsale.edit');
    }

    /**
     * 编辑会员特价产品
     *
     */
    public function vipsale_saveOp(){

        //获取提交的数据
        $vipsale_id = intval($_POST['vipsale_id']);
        if(empty($vipsale_id)) {
            showMessage(L('vipsale_fail_errormsg'));
        }
        $model_vipsale = Model('vipsale');
        $goods_info = $model_vipsale->getVipsaleInfoByID($vipsale_id);

        // 更新分类信息
        $where = array('vipsale_id' => $vipsale_id);
        $param = array();
        //$param['vipsale_name'] = $_POST['vipsale_name'];
        //$param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['start_time']);
        $param['end_time'] = strtotime($_POST['end_time']);
        $param['vipsale_price'] = floatval($_POST['vipsale_price']);
        $param['level'] = intval($_POST['level']);
        $member_grade = unserialize(C('member_grade'));
        $param['level_name'] = $member_grade[$_POST['level']]['level_name'];        //$param['vipsale_image'] = $_POST['vipsale_image'];
        //$param['vipsale_image1'] = $_POST['vipsale_image1'];
        $param['max_quantity'] = intval($_POST['max_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        //$param['s_class_id'] = intval($_POST['s_class_id']);
        $param['state'] = intval($_POST['state']);

        $result = $model_vipsale->updateVipsaleGoods($param, $where);
        if ($result === true){
            if($param['state'] != '20' && $param['state'] != '10'){ //不是会员特价状态，解锁商品
                $model_vipsale->unLockVipsale($vipsale_id);
            }else{
                $model_vipsale->LockVipsale($vipsale_id);
            }
            showMessage(L('vipsale_verify_success'),urlAdmin('vipsale','vipsale_template_list'));
        }else {
            showMessage(L('vipsale_verify_fail'));
        }
    }

    /**
     * 判断同一时间是否有相同会员特价产品存在
     *
     */
    public function check_vipsale_goodsOp() {
        $start_time = strtotime($_GET['start_time']);
        $goods_id = $_GET['goods_id'];
        $vipsale_id = $_GET['vipsale_id'];

        $model_vipsale = Model('vipsale');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['vipsale_id'] = array('neq', $vipsale_id);
        $condition['end_time'] = array('gt', $start_time);
        $condition['goods_id'] = $goods_id;
        $vipsale_list = $model_vipsale->getVipsaleAvailableList($condition);
        if(!empty($vipsale_list)) {
            $data['result'] = false;
            echo json_encode($data);die;
        }

        echo json_encode($data);die;
    }

    /**
     * 审核通过
     */
    public function vipsale_review_passOp(){
        $vipsale_id = intval($_POST['vipsale_id']);

        $model_vipsale = Model('vipsale');
        $result = $model_vipsale->reviewPassVipsale($vipsale_id);
        if($result) {
        	$this->log('通过会员特价活动申请，会员特价编号'.$vipsale_id,null);
            // 添加队列
            $vipsale_info = $model_vipsale->getVipsaleInfo(array('vipsale_id' => $vipsale_id));
            $this->addcron(array('exetime' => $vipsale_info['start_time'], 'exeid' => $vipsale_info['goods_commonid'], 'type' => 5));
            $this->addcron(array('exetime' => $vipsale_info['end_time'], 'exeid' => $vipsale_info['goods_commonid'], 'type' => 6));
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 审核失败
     */
    public function vipsale_review_failOp(){
        $vipsale_id = intval($_POST['vipsale_id']);

        $model_vipsale = Model('vipsale');
        $result = $model_vipsale->reviewFailVipsale($vipsale_id);
        if($result) {
        	$this->log('拒绝会员特价活动申请，会员特价编号'.$vipsale_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 结束并解锁商品
     */
    public function vipsale_cancelOp() {
        $vipsale_id = intval($_GET['vipsale_id']);

        $model_vipsale = Model('vipsale');
        $result = $model_vipsale->cancelVipsale($vipsale_id);
        if($result) {
        	$this->log('结束会员特价活动，解锁商品，会员特价编号'.$vipsale_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 删除
     */
    public function vipsale_delOp(){
        $vipsale_id = intval($_POST['vipsale_id']);

        $model_vipsale = Model('vipsale');
        $result = $model_vipsale->delVipsale(array('vipsale_id' => $vipsale_id));
        if($result) {
        	$this->log('删除会员特价活动，会员特价编号'.$vipsale_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }


    /**
     * 套餐管理
     **/
    public function vipsale_quotaOp() {
        $model_vipsale_quota = Model('vipsale_quota');

        $condition = array();
        $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        $list = $model_vipsale_quota->getvipsaleQuotaList($condition, 10, 'end_time desc');
        Tpl::output('list',$list);
        Tpl::output('show_page',$model_vipsale_quota->showpage());

        $this->show_menu('vipsale_quota');
        Tpl::showpage('vipsale_quota.list');
    }

    /**
     * 抢购类别列表
     */
    public function class_listOp() {

        $model_vipsale_class = Model('vipsale_class');
        $param = array();
        $param['order'] = 'start_hour asc,sort asc';
        $vipsale_class_list = $model_vipsale_class->getList($param);

        $this->show_menu('class_list');
        Tpl::output('list',$vipsale_class_list);
        Tpl::showpage('vipsale_class.list');
    }

    /**
     * 添加会员特价分类页面
     */
    public function class_addOp() {
        $hour = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
        Tpl::output('hour',$hour);

        $this->show_menu('class_add');
        Tpl::showpage('vipsale_class.add');

    }

    public function class_editOp(){
        if($_GET['class_id'] < 1){
            showMessage(L('class_fail_errormsg'));
        }
        $huodong = Model("vipsale_class")->getOne($_GET['class_id']);

        $hour = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
        Tpl::output('hour',$hour);

        Tpl::output('class_info',$huodong);
        $this->show_menu('class_add');
        Tpl::showpage('vipsale_class.add');
    }

    /**
     * 保存添加的会员特价类别
     */
    public function class_saveOp() {

        $param = array();
        $param['class_name'] = trim($_POST['input_class_name']);
        if(empty($param['class_name'])) {
            showMessage(Language::get('class_name_error'),'');
        }
        $param['start_hour'] = intval($_POST['start_hour']);
        $param['end_hour'] = intval($_POST['end_hour']);

        $model_vipsale_class = Model('vipsale_class');

        // 删除会员特价分类缓存
        Model('vipsale')->dropCachedData('vipsale_classes');

        //新增
        if(intval($_POST['class_id']) > 0){
            $model_vipsale_class->update($param,array('class_id'=>$_POST['class_id']));
            showMessage(Language::get('vipsale_class_edit_success'),'index.php?act=vipsale&op=class_list');
        }else{
            if($model_vipsale_class->save($param)) {
                $this->log(L('vipsale_class_add_success').'[名称:'.$param['class_name'].']', null);
                showMessage(Language::get('vipsale_class_add_success'),'index.php?act=vipsale&op=class_list');
            }
            else {
                showMessage(Language::get('vipsale_class_add_fail'),'index.php?act=vipsale&op=class_list');
            }
        }



    }

    /**
     * 删除会员特价类别
     */
    public function class_dropOp() {

        $class_id = trim($_POST['class_id']);
        if(empty($class_id)) {
            showMessage(Language::get('param_error'),'');
        }

        $model_vipsale_class = Model('vipsale_class');
        $param = array();
        $param['class_id'] = $class_id;
        if($model_vipsale_class->drop($param)) {
            // 删除抢购分类缓存
            Model('vipsale')->dropCachedData('vipsale_classes');

        	$this->log(L('vipsale_class_drop_success').'[ID:'.$class_id.']',null);
            showMessage(Language::get('vipsale_class_drop_success'),'');
        }
        else {
            showMessage(Language::get('vipsale_class_drop_fail'),'');
        }

    }

    /**
     * 设置
     **/
    public function vipsale_settingOp() {

        $model_setting = Model('setting');
        $setting = $model_setting->GetListSetting();
        Tpl::output('setting',$setting);

        $this->show_menu('vipsale_setting');
        Tpl::showpage('vipsale.setting');
    }

    public function vipsale_setting_saveOp() {
        $vipsale_price = intval($_POST['vipsale_price']);
        if($vipsale_price < 0) {
            $vipsale_price = 0;
        }
        $vipsale_review_day = intval($_POST['vipsale_review_day']);
        if($vipsale_review_day < 0) {
            $vipsale_review_day = 0;
        }

        $model_setting = Model('setting');
        $update_array = array();
        $update_array['vipsale_price'] = $vipsale_price;
        $update_array['vipsale_review_day'] = $vipsale_review_day;
        //$update_array['vipsale_review_day'] = $vipsale_review_day;
        $result = $model_setting->updateSetting($update_array);
        if ($result){
            $this->log('修改会员特价套餐价格为'.$vipsale_price.'元,修改会员特价会员特价审核期为'.$vipsale_review_day.'天');
            showMessage(Language::get('nc_common_op_succ'),'');
        }else {
            showMessage(Language::get('nc_common_op_fail'),'');
        }
    }

    /**
     * 上传图片
     **/
    public function image_uploadOp() {
        if(!empty($_POST['old_vipsale_image'])) {
            $this->_image_del($_POST['old_vipsale_image']);
        }
        $this->_image_upload('vipsale_image');
    }

    private function _image_upload($file) {
        $data = array();
        $data['result'] = true;
        $date = date("Ym");
        if(!empty($_FILES[$file]['name'])) {
            $upload	= new UploadFile();
            $uploaddir = ATTACH_PATH.DS.'vipsale'.DS.$date.DS;
            $upload->set('default_dir', $uploaddir);
            $upload->set('thumb_width',	'480,296,168');
            $upload->set('thumb_height', '480,296,168');
            $upload->set('thumb_ext', '_max,_mid,_small');
            //$upload->set('fprefix', $_SESSION['store_id']);
            $result = $upload->upfile($file);
            if($result) {
                list($base_name, $ext) = explode('.', $upload->file_name);
                $data['file_name'] = $date.DS.$upload->file_name;
                $data['origin_file_name'] = $_FILES[$file]['name'];
                $data['file_url'] = UPLOAD_SITE_URL.DS.$uploaddir.$base_name.'_mid'.'.'.$ext;
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
        $image_path = BASE_UPLOAD_PATH.DS.ATTACH_GROUPBUY.DS.date("Ym").DS;
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
     * 页面内导航菜单
     *
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    private function show_menu($menu_key) {
        $menu_array = array(
            'vipsale_list'=>array('menu_type'=>'link','menu_name'=>'会员特价活动','menu_url'=>'index.php?act=vipsale&op=vipsale_list'),
            'vipsale_quota'=>array('menu_type'=>'link','menu_name'=>'套餐管理','menu_url'=>'index.php?act=vipsale&op=vipsale_quota'),
            'vipsale_setting'=>array('menu_type'=>'link','menu_name'=>'设置','menu_url'=>urlAdmin('vipsale', 'vipsale_setting')),
            /*
        'slider'=>array('menu_type'=>'link','menu_name'=>'幻灯片管理','menu_url'=>urlAdmin('vipsale', 'slider')),
        */
        );
/*        switch ($menu_key) {
            case 'class_add':
                unset($menu_array['price_add']);
                unset($menu_array['price_edit']);
                break;
            case 'price_add':
                unset($menu_array['class_add']);
                unset($menu_array['price_edit']);
                break;
            case 'price_edit':
                unset($menu_array['class_add']);
                unset($menu_array['price_add']);
                break;
            default:
                unset($menu_array['class_add']);
                unset($menu_array['price_add']);
                unset($menu_array['price_edit']);
                break;
        }*/
        $menu_array[$menu_key]['menu_type'] = 'text';
        Tpl::output('menu',$menu_array);
    }
}
