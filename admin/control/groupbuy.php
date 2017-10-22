<?php
/**
 * 团购管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class groupbuyControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('groupbuy');

		//如果是执行开启团购操作，直接返回
		if ($_GET['groupbuy_open'] == 1) return true;

        //检查团购功能是否开启
        if (C('groupbuy_allow') != 1){
 			$url = array(
 				array(
					'url'=>'index.php?act=dashboard&op=welcome',
					'msg'=>Language::get('close'),
				),
				array(
					'url'=>'index.php?act=groupbuy&op=groupbuy_template_list&groupbuy_open=1',
					'msg'=>Language::get('open'),
				),
			);
			showMessage(Language::get('admin_groupbuy_unavailable'),$url,'html','succ',1,6000);
        }
    }

    public function indexOp() {
        $this->groupbuy_listOp();
    }


    public function ajax_groupbuy_xuOp(){

        $groupbuy_id = intval(trim($_GET['groupbuy_id']));
        $groupbuy_xu = intval(trim($_GET['groupbuy_xu']));

        if($groupbuy_id && $groupbuy_xu){
            $where['groupbuy_id'] = $groupbuy_id;
            $update['groupbuy_xu'] = $groupbuy_xu;
            if(Model('groupbuy')->where($where)->update($update)){
                echo 'ok';
            }
        }
    }

    /**
     * 进行中团购列表，只可推荐
     *
     */
    public function groupbuy_listOp(){
        $model_groupbuy = Model('groupbuy');

        $condition = array();
        if(!empty($_GET['groupbuy_name'])) {
            $condition['groupbuy_name'] = array('like', '%'.$_GET['groupbuy_name'].'%');
        }
        if(!empty($_GET['store_name'])) {
            $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        }
        if(!empty($_GET['groupbuy_state'])) {
            $condition['state'] = $_GET['groupbuy_state'];
        }
        if(intval($_GET['groupbuy2']) > 0) {
            $condition['class_id'] = $_GET['groupbuy2'];
        }elseif(intval($_GET['groupbuy1']) > 0){
            $condition['class_id'] = $_GET['groupbuy1'];
        }

		//自营店铺订单查询
		if($_GET['type_id'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//代运营店铺
		if($_GET['type_id'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['type_id'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

        /* 2016-06-23 Add is name lt 王 时间检索功能*/

        $sdate = strtotime($_GET['sdate']);
        $edate = strtotime($_GET['edate']);

        if($sdate && $edate){

            $modelSql = new ModelSql;

            $modelSqlWhere = $modelSql->getWhere($condition);

            $sqlWhere = "(  ((`start_time` <= $sdate) AND (`end_time` >= $edate)) OR ((`start_time` < $sdate) AND (`end_time` > $sdate) AND (`end_time` < $edate)) OR ((`start_time` > $sdate) AND (`start_time` <= $edate) AND (`start_time` > $edate)) OR ((`start_time` > $sdate) AND (`end_time` < $edate))  )";
        
            $condition = $modelSqlWhere?$modelSqlWhere.' AND  '.$sqlWhere:$sqlWhere;

        }elseif($sdate && empty($edate)){

            $condition['start_time'] = array('egt',$sdate);

        }elseif(empty($sdate) && $edate){

            $condition['start_time'] = array('elt',$edate);
            $condition['end_time'] = array('egt',$edate);

        }

        /* End */

        $groupbuy_list = $model_groupbuy->getGroupbuyExtendList($condition, 10);

        Tpl::output('groupbuy_list',$groupbuy_list);
        Tpl::output('show_page',$model_groupbuy->showpage());
        Tpl::output('groupbuy_state_array', $model_groupbuy->getGroupbuyStateArray());

        $this->show_menu('groupbuy_list');
        $this->getGroupbuy1($id=0);

        // 输出自营店铺IDS
        Tpl::output('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        Tpl::showpage('groupbuy.list');
    }

	/**
     * 团购添加页面
     **/
    public function groupbuy_addOp() {
		$groupbuy_info['start_time'] = TIMESTAMP + intval(C('groupbuy_review_day')) * 86400;
		$groupbuy_info['end_time'] = $groupbuy_info['start_time'] + 86400;
        // 根据后台设置的审核期重新设置藏品惠开始时间
        Tpl::output('groupbuy_start_time', TIMESTAMP + intval(C('groupbuy_review_day')) * 86400);
		 Tpl::output('isOwnShop', true);
		Tpl::output('groupbuy_info',$groupbuy_info );

        Tpl::output('groupbuy_classes', Model('groupbuy')->getGroupbuyClasses());
		$this->show_menu('groupbuy_add');
		Tpl::showpage('groupbuy.up');
	}

	/**
     * 藏品惠保存
     **/
    public function groupbuy_saveOp() {
        //获取提交的数据
        $goods_id = intval($_POST['groupbuy_goods_id']);
        if($goods_id<=0) {
            showDialog("请选择团购商品");
        }

        $model_groupbuy = Model('groupbuy');
        $model_goods = Model('goods');
        $model_groupbuy_quota = Model('groupbuy_quota');

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_id,goods_commonid,goods_name,goods_price,store_id,virtual_limit,store_name,goods_image');
        if(empty($goods_info)) {
            showDialog("请选择团购商品");
        }

        if($goods_info['sku_lock'] == 1) {
            showDialog('此商品已经参加其他未结束活动','index.php?act=groupbuy');
        }

        $param = array();
        $param['groupbuy_name'] = $_POST['groupbuy_name'];
        $param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['start_time']);
        $param['end_time'] = strtotime($_POST['end_time']);
        $param['groupbuy_price'] = intval($_POST['groupbuy_price']);
        $param['groupbuy_rebate'] = ncPriceFormat(floatval($_POST['groupbuy_price'])/floatval($goods_info['goods_price'])*10);
        $param['groupbuy_image'] = $goods_info['goods_image'];
        $param['groupbuy_image1'] = $goods_info['goods_image'];
        $param['virtual_quantity'] = intval($_POST['virtual_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        $param['groupbuy_intro'] = $_POST['groupbuy_intro'];
        $param['class_id'] = intval($_POST['class_id']);
        $param['goods_id'] = $goods_info['goods_id'];
        $param['goods_commonid'] = $goods_info['goods_commonid'];
        $param['goods_name'] = $goods_info['goods_name'];
        $param['goods_price'] = $goods_info['goods_price'];
        $param['store_id'] = $goods_info['store_id'];
        $param['store_name'] = $goods_info['store_name'];
        //保存
        $result = $model_groupbuy->addGroupbuy($param);
        if($result) {
			$this->log('发布藏品惠活动，藏品惠名称：'.$param['groupbuy_name'].'，商品名称：'.$param['goods_name'],null);
            showDialog('添加成功','index.php?act=groupbuy','succ');
        }else {
            showDialog('添加失败','index.php?act=groupbuy&op=groupbuy_add');
        }
    }

	 public function groupbuy_goods_infoOp() {
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

    public function check_groupbuy_goodsOp() {
        $start_time = strtotime($_GET['start_time']);
        $goods_id = $_GET['goods_id'];

        $model_groupbuy = Model('groupbuy');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['end_time'] = array('gt', $start_time);
        $condition['goods_id'] = $goods_id;
        $groupbuy_list = $model_groupbuy->getGroupbuyAvailableList($condition);
        if(!empty($groupbuy_list)) {
            $data['result'] = false;
            echo json_encode($data);die;
        }

        echo json_encode($data);die;
    }

    /**
     * 上传图片
     **/
    public function image_uploadOp() {
        if(!empty($_POST['old_groupbuy_image'])) {
            $this->_image_del($_POST['old_groupbuy_image']);
        }
        $this->_image_upload('groupbuy_image');
    }

    private function _image_upload($file) {
        $data = array();
        $data['result'] = true;
        if(!empty($_FILES[$file]['name'])) {
            $upload	= new UploadFile();
            $uploaddir = ATTACH_PATH.DS.'groupbuy'.DS.$_SESSION['store_id'].DS;
            $upload->set('default_dir', $uploaddir);
            $upload->set('thumb_width',	'480,296,168');
            $upload->set('thumb_height', '480,296,168');
            $upload->set('thumb_ext', '_max,_mid,_small');
            $upload->set('fprefix', $_SESSION['store_id']);
            $result = $upload->upfile($file);
            if($result) {
                $data['file_name'] = $upload->file_name;
                $data['origin_file_name'] = $_FILES[$file]['name'];
                $data['file_url'] = gthumb($upload->file_name, 'mid');
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
        $image_path = BASE_UPLOAD_PATH.DS.ATTACH_GROUPBUY.DS.$store_id.DS;
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
        $condition['goods_state'] = '1';
        $condition['goods_verify'] = '1';
        $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        $goods_list =$model_goods->getGoodsList($condition, '*','','','', 8);
        //add end
        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('store_groupbuy.goods', 'null_layout');
    }
	
    /**
     * 编辑团购页面
     **/
    public function groupbuy_upOp() {

        $groupbuy_id = intval($_GET['groupbuy_id']?$_GET['groupbuy_id']:$_POST['groupbuy_id']);

        if($_POST['submit_form'] == 'ok'){

            $groupbuy_array['groupbuy_name'] = $_POST['groupbuy_name'];
            $groupbuy_array['remark'] = $_POST['remark'];
            $groupbuy_array['start_time'] = strtotime($_POST['start_time']);
            $groupbuy_array['end_time'] = strtotime($_POST['end_time']);
            $groupbuy_array['groupbuy_price'] = $_POST['groupbuy_price'];
            $groupbuy_array['upper_limit'] = $_POST['upper_limit'];
            // $groupbuy_array['state'] = '10';
            
            Model('groupbuy')->where(array('groupbuy_id'=>$groupbuy_id))->update($groupbuy_array);

            showMessage('操作成功','index.php?act=groupbuy&op=groupbuy_list');

        }else{

        $groupbuy_info = Model('groupbuy')->getGroupbuyInfoByID($groupbuy_id);

        $groupbuy_info['goods_img'] = Model('goods')->getGoodsInfoByID($groupbuy_info['goods_id']);

        // var_dump($groupbuy_info);
        Tpl::output('isOwnShop', true);

        Tpl::output('groupbuy_start_time', TIMESTAMP + intval(C('groupbuy_review_day')) * 86400);

        Tpl::output('groupbuy_classes', Model('groupbuy')->getGroupbuyClasses());

        Tpl::output('groupbuy_info',$groupbuy_info);

        Tpl::output('update',true);

        Tpl::showpage('groupbuy.up');

        }

    }


    /**
     * 审核通过
     */
    public function groupbuy_review_passOp(){
        $groupbuy_id = intval($_POST['groupbuy_id']);

        $model_groupbuy = Model('groupbuy');
        $result = $model_groupbuy->reviewPassGroupbuy($groupbuy_id);
        if($result) {
        	$this->log('通过团购活动申请，团购编号'.$groupbuy_id,null);
            // 添加队列
            $groupbuy_info = $model_groupbuy->getGroupbuyInfo(array('groupbuy_id' => $groupbuy_id));
            $this->addcron(array('exetime' => $groupbuy_info['start_time'], 'exeid' => $groupbuy_info['goods_commonid'], 'type' => 5));
            $this->addcron(array('exetime' => $groupbuy_info['end_time'], 'exeid' => $groupbuy_info['goods_commonid'], 'type' => 6));
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 审核失败
     */
    public function groupbuy_review_failOp(){
        $groupbuy_id = intval($_POST['groupbuy_id']);

        $model_groupbuy = Model('groupbuy');
        $result = $model_groupbuy->reviewFailGroupbuy($groupbuy_id);
        if($result) {
        	$this->log('拒绝团购活动申请，团购编号'.$groupbuy_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 取消
     */
    public function groupbuy_cancelOp() {
        $groupbuy_id = intval($_POST['groupbuy_id']);

        $model_groupbuy = Model('groupbuy');
        $result = $model_groupbuy->cancelGroupbuy($groupbuy_id);
        if($result) {
        	$this->log('取消团购活动，团购编号'.$groupbuy_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 解锁商品 add xin 20151116
     */
    public function groupbuy_unlockOp() {
        $groupbuy_id = intval($_GET['groupbuy_id']);

        $model_groupbuy = Model('groupbuy');
        $result = $model_groupbuy->closeGroupbuy($groupbuy_id);

        if($result) {
            $this->log('结束团购商品解锁，团购编号'.$groupbuy_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 删除
     */
    public function groupbuy_delOp(){
        $groupbuy_id = intval($_POST['groupbuy_id']);

        $model_groupbuy = Model('groupbuy');
        $result = $model_groupbuy->delGroupbuy(array('groupbuy_id' => $groupbuy_id));
        if($result) {
        	$this->log('删除团购活动，团购编号'.$groupbuy_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * ajax修改团购信息
     */
    public function ajaxOp(){

        $result = true;
        $update_array = array();
        $where_array = array();

        switch ($_GET['branch']){
        case 'class_sort':
            $model= Model('groupbuy_class');
            $update_array['sort'] = $_GET['value'];
            $where_array['class_id'] = $_GET['id'];
            $result = $model->update($update_array,$where_array);
            // 删除团购分类缓存
            Model('groupbuy')->dropCachedData('groupbuy_classes');
            break;
        case 'class_name':
            $model= Model('groupbuy_class');
            $update_array['class_name'] = $_GET['value'];
            $where_array['class_id'] = $_GET['id'];
            $result = $model->update($update_array,$where_array);
            // 删除团购分类缓存
            Model('groupbuy')->dropCachedData('groupbuy_classes');
            $this->log(L('groupbuy_class_edit_success').'[ID:'.$_GET['id'].']', null);
            break;
         case 'recommended':
            $model= Model('groupbuy');
            $update_array['recommended'] = $_GET['value'];
            $where_array['groupbuy_id'] = $_GET['id'];
            $result = $model->editGroupbuy($update_array, $where_array);
            break;
        }
        if($result) {
            echo 'true';exit;
        }
        else {
            echo 'false';exit;
        }

    }

    /**
     * 套餐管理
     **/
    public function groupbuy_quotaOp() {
        $model_groupbuy_quota = Model('groupbuy_quota');

        $condition = array();
        $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        $list = $model_groupbuy_quota->getGroupbuyQuotaList($condition, 10, 'end_time desc');
        Tpl::output('list',$list);
        Tpl::output('show_page',$model_groupbuy_quota->showpage());

        $this->show_menu('groupbuy_quota');
        Tpl::showpage('groupbuy_quota.list');
    }

    /**
     * 团购类别列表
     */
    public function class_listOp() {

        $model_groupbuy_class = Model('groupbuy_class');
        $param = array();
        $param['order'] = 'sort asc';
        $groupbuy_class_list = $model_groupbuy_class->getTreeList($param);

        $this->show_menu('class_list');
        Tpl::output('list',$groupbuy_class_list);
        Tpl::showpage('groupbuy_class.list');
    }

    /**
     * 添加团购分类页面
     */
    public function class_addOp() {

        $model_groupbuy_class = Model('groupbuy_class');
        $param = array();
        $param['order'] = 'sort asc';
        $param['class_parent_id'] = 0;
        $groupbuy_class_list = $model_groupbuy_class->getList($param);
        Tpl::output('list',$groupbuy_class_list);

        $this->show_menu('class_add');
        Tpl::output('parent_id',$_GET['parent_id']);
        Tpl::showpage('groupbuy_class.add');

    }

    /**
     * 保存添加的团购类别
     */
    public function class_saveOp() {

        $class_id = intval($_POST['class_id']);
        $param = array();
        $param['class_name'] = trim($_POST['input_class_name']);
        if(empty($param['class_name'])) {
            showMessage(Language::get('class_name_error'),'');
        }
        $param['sort'] = intval($_POST['input_sort']);
        $param['class_parent_id'] = intval($_POST['input_parent_id']);

        $model_groupbuy_class = Model('groupbuy_class');

        // 删除团购分类缓存
        Model('groupbuy')->dropCachedData('groupbuy_classes');

        if(empty($class_id)) {
            //新增
            if($model_groupbuy_class->save($param)) {
            	$this->log(L('groupbuy_class_add_success').'[ID:'.$class_id.']', null);
                showMessage(Language::get('groupbuy_class_add_success'),'index.php?act=groupbuy&op=class_list');
            }
            else {
                showMessage(Language::get('groupbuy_class_add_fail'),'index.php?act=groupbuy&op=class_list');
            }
        }
        else {
            //编辑
            if($model_groupbuy_class->update($param,array('class_id'=>$class_id))) {
            	$this->log(L('groupbuy_class_edit_success').'[ID:'.$class_id.']', null);
                showMessage(Language::get('groupbuy_class_edit_success'),'index.php?act=groupbuy&op=class_list');
            }
            else {
                showMessage(Language::get('groupbuy_class_edit_fail'),'index.php?act=groupbuy&op=class_list');
            }
        }

    }

    /**
     * 删除团购类别
     */
    public function class_dropOp() {

        $class_id = trim($_POST['class_id']);
        if(empty($class_id)) {
            showMessage(Language::get('param_error'),'');
        }

        $model_groupbuy_class = Model('groupbuy_class');
        //获得所有下级类别编号
        $all_class_id = $model_groupbuy_class->getAllClassId(explode(',',$class_id));
        $param = array();
        $param['in_class_id'] = implode(',',$all_class_id);
        if($model_groupbuy_class->drop($param)) {
            // 删除团购分类缓存
            Model('groupbuy')->dropCachedData('groupbuy_classes');

        	$this->log(L('groupbuy_class_drop_success').'[ID:'.$param['in_class_id'].']',null);
            showMessage(Language::get('groupbuy_class_drop_success'),'');
        }
        else {
            showMessage(Language::get('groupbuy_class_drop_fail'),'');
        }

    }

    /**
     * 团购价格区间列表
     */
    public function price_listOp() {

        $model= Model('groupbuy_price_range');
        $groupbuy_price_list = $model->getList();
        Tpl::output('list',$groupbuy_price_list);

        $this->show_menu('price_list');
        Tpl::showpage('groupbuy_price.list');
    }

    /**
     * 添加团购价格区间页面
     */
    public function price_addOp() {

        $this->show_menu('price_add');
        Tpl::showpage('groupbuy_price.add');

    }

    /**
     * 编辑团购价格区间页面
     */
    public function price_editOp() {

        $range_id = intval($_GET['range_id']);
        if(empty($range_id)) {
            showMessage(Language::get('param_error'),'');
        }

        $model = Model('groupbuy_price_range');

        $price_info = $model->getOne($range_id);
        if(empty($price_info)) {
            showMessage(Language::get('param_error'),'');
        }
        Tpl::output('price_info',$price_info);

        $this->show_menu('price_edit');
        Tpl::showpage('groupbuy_price.add');

    }

    /**
     * 保存添加的团购价格区间
     */
    public function price_saveOp() {

        $range_id = intval($_POST['range_id']);
        $param = array();
        $param['range_name'] = trim($_POST['range_name']);
        if(empty($param['range_name'])) {
            showMessage(Language::get('range_name_error'),'');
        }
        $param['range_start'] = intval($_POST['range_start']);
        $param['range_end'] = intval($_POST['range_end']);

        $model = Model('groupbuy_price_range');

        if(empty($range_id)) {
            //新增
            if($model->save($param)) {
            	dkcache('groupbuy_price');
            	$this->log(L('groupbuy_price_range_add_success').'['.$_POST['range_name'].']',null);
                showMessage(Language::get('groupbuy_price_range_add_success'),'index.php?act=groupbuy&op=price_list');
            }
            else {
                showMessage(Language::get('groupbuy_price_range_add_fail'),'index.php?act=groupbuy&op=price_list');
            }
        }
        else {
            //编辑
            if($model->update($param,array('range_id'=>$range_id))) {
            	dkcache('groupbuy_price');
            	$this->log(L('groupbuy_price_range_edit_success').'['.$_POST['range_name'].']',null);
                showMessage(Language::get('groupbuy_price_range_edit_success'),'index.php?act=groupbuy&op=price_list');
            }
            else {
                showMessage(Language::get('groupbuy_price_range_edit_fail'),'index.php?act=groupbuy&op=price_list');
            }
        }

    }

    /**
     * 删除团购价格区间
     */
    public function price_dropOp() {

        $range_id = trim($_POST['range_id']);
        if(empty($range_id)) {
            showMessage(Language::get('param_error'),'');
        }

        $model = Model('groupbuy_price_range');
        $param = array();
        $param['in_range_id'] = "'".implode("','", explode(',', $range_id))."'";
        if($model->drop($param)) {
        	dkcache('groupbuy_price');
        	$this->log(L('groupbuy_price_range_drop_success').'[ID:'.$range_id.']',null);
            showMessage(Language::get('groupbuy_price_range_drop_success'),'');
        }
        else {
            showMessage(Language::get('groupbuy_price_range_drop_fail'),'');
        }
    }

    /**
     * 设置
     **/
    public function groupbuy_settingOp() {

        $model_setting = Model('setting');
        $setting = $model_setting->GetListSetting();
        Tpl::output('setting',$setting);

        $this->show_menu('groupbuy_setting');
        Tpl::showpage('groupbuy.setting');
    }

    public function groupbuy_setting_saveOp() {
        $groupbuy_price = intval($_POST['groupbuy_price']);
        if($groupbuy_price < 0) {
            $groupbuy_price = 0;
        }

        $groupbuy_review_day = intval($_POST['groupbuy_review_day']);
        if($groupbuy_review_day< 0) {
            $groupbuy_review_day = 0;
        }

        $model_setting = Model('setting');
        $update_array = array();
        $update_array['groupbuy_price'] = $groupbuy_price;
        $update_array['groupbuy_review_day'] = $groupbuy_review_day;
        $result = $model_setting->updateSetting($update_array);
        if ($result){
            $this->log('修改团购套餐价格为'.$groupbuy_price.'元');
            showMessage(Language::get('nc_common_op_succ'),'');
        }else {
            showMessage(Language::get('nc_common_op_fail'),'');
        }
    }

    /**
     * 幻灯片设置
     */
    public function sliderOp()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $update = array();
            if (!empty($_FILES['live_pic1']['name'])) {
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_LIVE);
                $result = $upload->upfile('live_pic1');
                if ($result) {
                    $update['live_pic1'] = $upload->file_name;
                }else {
                    showMessage($upload->error, '', '', 'error');
                }
            }

            if (!empty($_POST['live_link1'])) {
                $update['live_link1'] = $_POST['live_link1'];
            }

            if (!empty($_FILES['live_pic2']['name'])) {
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_LIVE);
                $result = $upload->upfile('live_pic2');
                if ($result) {
                    $update['live_pic2'] = $upload->file_name;
                } else {
                    showMessage($upload->error, '', '', 'error');
                }
            }

            if (!empty($_POST['live_link2'])) {
                $update['live_link2'] = $_POST['live_link2'];
            }

            if (!empty($_FILES['live_pic3']['name'])) {
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_LIVE);
                $result = $upload->upfile('live_pic3');
                if ($result) {
                    $update['live_pic3'] = $upload->file_name;
                } else {
                    showMessage($upload->error, '', '', 'error');
                }
            }

            if (!empty($_POST['live_link3'])) {
                $update['live_link3'] = $_POST['live_link3'];
            }

            if (!empty($_FILES['live_pic4']['name'])) {
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_LIVE);
                $result = $upload->upfile('live_pic4');
                if ($result) {
                    $update['live_pic4'] = $upload->file_name;
                } else {
                    showMessage($upload->error, '', '', 'error');
                }
            }

            if (!empty($_POST['live_link4'])) {
                $update['live_link4'] = $_POST['live_link4'];
            }

            $list_setting = $model_setting->getListSetting();
            $result = $model_setting->updateSetting($update);
            if ($result) {
                if($list_setting['live_pic1'] != '' && isset($update['live_pic1'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_LIVE.DS.$list_setting['live_pic1']);
                }

                if($list_setting['live_pic2'] != '' && isset($update['live_pic2'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_LIVE.DS.$list_setting['live_pic2']);
                }

                if($list_setting['live_pic3'] != '' && isset($update['live_pic3'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_LIVE.DS.$list_setting['live_pic3']);
                }

                if($list_setting['live_pic4'] != '' && isset($update['live_pic4'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_LIVE.DS.$list_setting['live_pic4']);
                }

                dkcache('setting');
                $this->log('修改团购幻灯片设置', 1);
                showMessage('编辑成功', '', '', 'succ');
            } else {
                showMessage('编辑失败', '', '', 'error');
            }
        }

        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting', $list_setting);

        $this->show_menu('slider');
        Tpl::showpage('groupbuy.slider');
    }

    /**
     * 幻灯片清空
     */
    public function slider_clearOp()
    {
        $model_setting = Model('setting');
        $update = array();
        $update['live_pic1'] = '';
        $update['live_link1'] = '';
        $update['live_pic2'] = '';
        $update['live_link2'] = '';
        $update['live_pic3'] = '';
        $update['live_link3'] = '';
        $update['live_pic4'] = '';
        $update['live_link4'] = '';
        $res = $model_setting->updateSetting($update);
        if ($res) {
            dkcache('setting');
            $this->log('清空团购幻灯片设置', 1);
            echo json_encode(array('result'=>'true'));
        } else {
            echo json_encode(array('result'=>'false'));
        }
        exit;
    }






    /**
     * 新增幻灯片管理
     *
     */
    public function focus_editOp() {

        Language::read('web_config,recommend');
        
        $model_web_config = Model('web_config');
        $web_id = '212';
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));

        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                $images_result[] = $val;
                Tpl::output('code_'.$var_name,$val);
            }
        }

        $screen_adv_list = $model_web_config->getAdvList("screen");//焦点大图广告数据

        $this->show_menu('focus_edit');
        Tpl::output('screen_adv_list',$screen_adv_list);
        Tpl::showpage('groupbuy_focus.edit');
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
            'groupbuy_list'=>array('menu_type'=>'link','menu_name'=>'藏品惠活动','menu_url'=>'index.php?act=groupbuy&op=groupbuy_list'),
			'groupbuy_add'=>array('menu_type'=>'link','menu_name'=>'新增','menu_url'=>'index.php?act=groupbuy&op=groupbuy_add'),
            'groupbuy_quota'=>array('menu_type'=>'link','menu_name'=>'套餐管理','menu_url'=>'index.php?act=groupbuy&op=groupbuy_quota'),
            'class_list'=>array('menu_type'=>'link','menu_name'=>Language::get('groupbuy_class_list'),'menu_url'=>'index.php?act=groupbuy&op=class_list'),
            'class_add'=>array('menu_type'=>'link','menu_name'=>Language::get('groupbuy_class_add'),'menu_url'=>'index.php?act=groupbuy&op=class_add'),
            'price_list'=>array('menu_type'=>'link','menu_name'=>Language::get('groupbuy_price_list'),'menu_url'=>'index.php?act=groupbuy&op=price_list'),
            'price_add'=>array('menu_type'=>'link','menu_name'=>Language::get('groupbuy_price_add'),'menu_url'=>'index.php?act=groupbuy&op=price_add'),
            'price_edit'=>array('menu_type'=>'link','menu_name'=>Language::get('groupbuy_price_edit'),'menu_url'=>'index.php?act=groupbuy&op=price_edit'),
            'groupbuy_setting'=>array('menu_type'=>'link','menu_name'=>'设置','menu_url'=>urlAdmin('groupbuy', 'groupbuy_setting')),
            'slider'=>array('menu_type'=>'link','menu_name'=>'幻灯片管理','menu_url'=>urlAdmin('groupbuy', 'slider')),
            'focus_edit'=>array('menu_type'=>'link','menu_name'=>'幻灯片','menu_url'=>urlAdmin('groupbuy', 'focus_edit')),

        );
        switch ($menu_key) {
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
        }
        $menu_array[$menu_key]['menu_type'] = 'text';
        Tpl::output('menu',$menu_array);
    }
    
    /**
     * 藏品惠分类检索  王  20160622
     *
     */
    public function getGroupbuy1($id=0){
        $groupbuy1 = Model()->query("SELECT * FROM `shop_groupbuy_class` where class_parent_id = '{$id}'");
        Tpl::output('groupbuy1',$groupbuy1);
    }

    public function getGroupbuy2Op($id=0){
        $id = isset($_POST['groupbuy1']) ? $_POST['groupbuy1'] : '0';
        $str = '<option value=0>请选择</option>';
        if ($id != 0) {
            $groupbuy1 = Model()->query("SELECT * FROM `shop_groupbuy_class` where class_parent_id = '{$id}'");
            if($groupbuy1){
                foreach($groupbuy1 as $val) {
                    $str .= '<option value='.$val['class_id'].'>'.$val['class_name'].'</option>';
                }
            }
        }
        echo $str;
        exit;
    }
}
