<?php
/**
 * 秒杀管理
 * author:xin
 * date:2015.9.17
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class miaoshaControl extends SystemControl{

    public function __construct(){
        parent::__construct();
        Language::read('miaosha');

		//如果是执行开启抢购操作，直接返回
		if ($_GET['miaosha_open'] == 1) return true;

        //检查抢购功能是否开启
        if (C('miaosha_allow') != 1){
 			$url = array(
 				array(
					'url'=>'index.php?act=dashboard&op=welcome',
					'msg'=>Language::get('close'),
				),
				array(
					'url'=>'index.php?act=miaosha&op=miaosha_template_list&miaosha_open=1',
					'msg'=>Language::get('open'),
				),
			);
			showMessage(Language::get('admin_miaosha_unavailable'),$url,'html','succ',1,6000);
        }
    }

    public function indexOp() {
        $this->miaosha_listOp();
    }

    /**
     * 进行中秒杀列表，只可推荐
     *
     */
    public function miaosha_listOp(){
		 /**
         * 处理商品分类
         */
        $choose_gcid = ($t = intval($_REQUEST['choose_gcid']))>0?$t:0;
        $gccache_arr = Model('goods_class')->getGoodsclassCache($choose_gcid,3);
	    Tpl::output('gc_json',json_encode($gccache_arr['showclass']));
		Tpl::output('gc_choose_json',json_encode($gccache_arr['choose_gcid']));
		
        $model_miaosha = Model('miaosha');
        $condition = array();
        if(!empty($_GET['search_goods_name'])) {
            $condition['goods_name'] = array('like', '%'.$_GET['search_goods_name'].'%');
        }
        if(!empty($_GET['store_name'])) {
            $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        }
        if(!empty($_GET['miaosha_state'])) {
            $condition['state'] = $_GET['miaosha_state'];
        }
        if(intval($_GET['miaosha_class']) > 0){
            $condition['class_id'] = $_GET['miaosha_class'];
        }

        if($_GET['query_start_time'] && $_GET['query_end_time']){
            $beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
            $engTime = strtotime($_GET['query_end_time'].' 23:59:59');
            $condition['start_time'] = array('gt',$beginTime);
            $condition['end_time'] = array('lt',$engTime);
        }



		if ($choose_gcid > 0){
		    // $where['gc_id_'.($gccache_arr['showclass'][$choose_gcid]['depth'])] = $choose_gcid;

            // 类目
            if($_GET['search_gc']['0'] && $_GET['search_gc']['1'] && $_GET['search_gc']['2']){
                $where['gc_id_1'] = intval($_GET['search_gc']['0']);
                $where['gc_id_2'] = intval($_GET['search_gc']['1']);
                $where['gc_id_3'] = intval($_GET['search_gc']['2']);
            }elseif($_GET['search_gc']['0'] && $_GET['search_gc']['1'] && !$_GET['search_gc']['2']){
                $where['gc_id_1'] = intval($_GET['search_gc']['0']);
                $where['gc_id_2'] = intval($_GET['search_gc']['1']);
            }elseif($_GET['search_gc']['0'] && !$_GET['search_gc']['1'] && !$_GET['search_gc']['2']){
                $where['gc_id_1'] = intval($_GET['search_gc']['0']);
            }

			$goods_list = Model()->table('goods_common')->where($where)->limit(999999)->select();

			if($goods_list){
				$goods_idArr = array();
				foreach($goods_list as $k=>$v){
					$goods_idArr[] = $v['goods_commonid'];
				}
				$condition['goods_commonid'] = array('in',$goods_idArr);
			}else{
				$condition['goods_commonid'] = array('in',0);
			}
		}



		//自营店铺订单查询
		if($_GET['type_id'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','10000');
			
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
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','10000');
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
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
        $miaosha_list = $model_miaosha->getMiaoshaExtendList($condition, 10,'state asc,start_time desc,miaosha_id desc');
        Tpl::output('miaosha_list',$miaosha_list);
        Tpl::output('show_page',$model_miaosha->showpage());
        Tpl::output('miaosha_state_array', $model_miaosha->getMiaoshaStateArray());

        $this->show_menu('miaosha_list');
        $miaosha_class = Model()->query("SELECT * FROM `shop_miaosha_class`");
        Tpl::output('miaosha_class',$miaosha_class);

        // 输出自营店铺IDS
        Tpl::output('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));

        Tpl::showpage('miaosha.list');
    }
    /**
     * 编辑秒杀产品
     *
     */
    public function miaosha_editOp(){
        $miaosha_id = $_GET['miaosha_id'];
        $model_miaosha = Model('miaosha');
        $miaosha_info = $model_miaosha->getMiaoshaInfoByID($miaosha_id);

        $goods_info = Model('goods')->getGoodsInfoByID($miaosha_info['goods_id']);
        $goods_info['goods_image'] = thumb($goods_info, 240);
        if(!is_array($miaosha_info)){
            showMessage(L('miaosha_fail_errormsg'), '');
        }
        if($miaosha_info['miaosha_image'] != ''){
            list($base_name, $ext) = explode('.', $miaosha_info['miaosha_image']);
            $miaosha_info['miaosha_imageurl'] = UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.'miaosha'.DS.$base_name.'_mid'.'.'.$ext;
        }
        if($miaosha_info['miaosha_image1'] != ''){
            list($base_name, $ext) = explode('.', $miaosha_info['miaosha_image1']);
            $miaosha_info['miaosha_image1url'] = UPLOAD_SITE_URL.DS.ATTACH_PATH.DS.'miaosha'.DS.$base_name.'_mid'.'.'.$ext;
        }

        Tpl::output('miaosha_info',$miaosha_info);
        Tpl::output('goods_info',$goods_info);
        Tpl::output('miaosha_class', Model('miaosha_class')->getList(array('order'=>'start_hour asc,sort asc')));
        Tpl::output('miaosha_classes', $model_miaosha->getMiaoshaClasses());
        $this->show_menu('miaosha_edit');
        Tpl::showpage('miaosha.edit');
    }

    /**
     * 编辑秒杀产品
     *
     */
    public function miaosha_saveOp(){

        //获取提交的数据
        $miaosha_id = intval($_POST['miaosha_id']);
        if(empty($miaosha_id)) {
            showMessage(L('miaosha_fail_errormsg'));
        }
        $model_miaosha = Model('miaosha');
        $goods_info = $model_miaosha->getMiaoshaInfoByID($miaosha_id);

        // 更新分类信息
        $where = array('miaosha_id' => $miaosha_id);
        $param = array();
        //$param['miaosha_name'] = $_POST['miaosha_name'];
        //$param['remark'] = $_POST['remark'];
        $param['start_time'] = strtotime($_POST['start_time']);
        $param['end_time'] = strtotime($_POST['end_time']);
        $param['miaosha_price'] = floatval($_POST['miaosha_price']);
        $param['miaosha_rebate'] = ncPriceFormat(floatval($_POST['miaosha_price'])/floatval($goods_info['goods_price'])*10);
        //$param['miaosha_image'] = $_POST['miaosha_image'];
        //$param['miaosha_image1'] = $_POST['miaosha_image1'];
        $param['max_quantity'] = intval($_POST['max_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        $param['class_id'] = intval($_POST['miaosha_class']);
        //$param['s_class_id'] = intval($_POST['s_class_id']);
        $param['state'] = intval($_POST['state']);
		$param['is_shipping'] = intval($_POST['is_shipping']); //是否包邮
        $result = $model_miaosha->updateMiaoshaGoods($param, $where);
        if ($result === true){
            if($param['state'] != '20' && $param['state'] != '10'){ //不是秒杀状态，解锁商品
                $model_miaosha->unLockMiaosha($miaosha_id);
            }else{
                $model_miaosha->LockMiaosha($miaosha_id);
            }
            showMessage(L('miaosha_verify_success'),urlAdmin('miaosha','miaosha_template_list'));
        }else {
            showMessage(L('miaosha_verify_fail'));
        }
    }

    /**
     * 判断同一时间是否有相同秒杀产品存在
     *
     */
    public function check_miaosha_goodsOp() {
        $start_time = strtotime($_GET['start_time']);
        $goods_id = $_GET['goods_id'];
        $miaosha_id = $_GET['miaosha_id'];

        $model_miaosha = Model('miaosha');

        $data = array();
        $data['result'] = true;

        //检查商品是否已经参加同时段活动
        $condition = array();
        $condition['miaosha_id'] = array('neq', $miaosha_id);
        $condition['end_time'] = array('gt', $start_time);
        $condition['goods_id'] = $goods_id;
        $miaosha_list = $model_miaosha->getMiaoshaAvailableList($condition);
        if(!empty($miaosha_list)) {
            $data['result'] = false;
            echo json_encode($data);die;
        }

        echo json_encode($data);die;
    }

    /**
     * 审核通过
     */
    public function miaosha_review_passOp(){
        $miaosha_id = intval($_POST['miaosha_id']);

        $model_miaosha = Model('miaosha');
        $result = $model_miaosha->reviewPassMiaosha($miaosha_id);
        if($result) {
        	$this->log('通过秒杀活动申请，秒杀编号'.$miaosha_id,null);
            // 添加队列
            $miaosha_info = $model_miaosha->getMiaoshaInfo(array('miaosha_id' => $miaosha_id));
            $this->addcron(array('exetime' => $miaosha_info['start_time'], 'exeid' => $miaosha_info['goods_commonid'], 'type' => 5));
            $this->addcron(array('exetime' => $miaosha_info['end_time'], 'exeid' => $miaosha_info['goods_commonid'], 'type' => 6));
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 审核失败
     */
    public function miaosha_review_failOp(){
        $miaosha_id = intval($_POST['miaosha_id']);

        $model_miaosha = Model('miaosha');
        $result = $model_miaosha->reviewFailMiaosha($miaosha_id);
        if($result) {
        	$this->log('拒绝秒杀活动申请，秒杀编号'.$miaosha_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 结束并解锁商品
     */
    public function miaosha_cancelOp() {
        $miaosha_id = intval($_GET['miaosha_id']);

        $model_miaosha = Model('miaosha');
        $result = $model_miaosha->cancelMiaosha($miaosha_id);
        if($result) {
        	$this->log('结束秒杀活动，解锁商品，秒杀编号'.$miaosha_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

    /**
     * 删除
     */
    public function miaosha_delOp(){
        $miaosha_id = intval($_POST['miaosha_id']);

        $model_miaosha = Model('miaosha');
        $result = $model_miaosha->delMiaosha(array('miaosha_id' => $miaosha_id));
        if($result) {
        	$this->log('删除秒杀活动，秒杀编号'.$miaosha_id,null);
            showMessage(L('nc_common_op_succ'), '');
        } else {
            showMessage(L('nc_common_op_fail'), '');
        }
    }

	/**
     * 新增秒杀活动
     **/
	public function miaosha_addOp() {

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
		$this->show_menu('miaosha_add');
		Tpl::showpage('miaosha_add');
	}
	 /**
     * 秒杀保存
     **/
    public function miaosha_insertOp() {
        //获取提交的数据
        $goods_id = intval($_POST['goods_id']);
        if(empty($goods_id)) {
            showDialog("请收缩并选择产品");
        }
        $model_miaosha = Model('miaosha');
        $model_goods = Model('goods');
        $model_miaosha_quota = Model('miaosha_quota');

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_id,goods_commonid,goods_name,goods_price,store_id,store_name,virtual_limit');
        if(empty($goods_info)) {
            showDialog("请收缩并选择产品");
        }
        if($goods_info['sku_lock'] == 1) {
            showDialog('此商品已经参加其他未结束活动','index.php?act=miaosha&op=miaosha_add');
        }
        //获取用户选择的秒杀活动
        $miaosha_class = Model('miaosha_class')->getOne(intval($_POST['miaosha_class']));

        $param = array();
        $param['start_time'] = strtotime($_POST['miaosha_date']) + $miaosha_class['start_hour']*3600;
        $param['end_time'] = strtotime($_POST['miaosha_date']) + $miaosha_class['end_hour']*3600;
        $param['miaosha_price'] = intval($_POST['miaosha_price']);
        $param['miaosha_rebate'] = ncPriceFormat(floatval($_POST['miaosha_price'])/floatval($goods_info['goods_price'])*10);
        $param['max_quantity'] = intval($_POST['max_quantity']);
        $param['upper_limit'] = intval($_POST['upper_limit']);
        $param['class_id'] = intval($_POST['miaosha_class']); //活动编号
        $param['goods_id'] = $goods_info['goods_id'];
        $param['goods_commonid'] = $goods_info['goods_commonid'];
        $param['goods_name'] = $goods_info['goods_name'];
        $param['goods_price'] = $goods_info['goods_price'];
        $param['store_id'] = $goods_info['store_id'];
        $param['store_name'] = $goods_info['store_name'];
		$param['is_shipping'] = intval($_POST['is_shipping']); //是否包邮
        //保存
        $result = $model_miaosha->addMiaosha($param);
        if($result) {
			$this->log('提交秒杀商品，商品名称：'.$param['goods_name'].';秒杀价：'.$param['miaosha_price'], null);
            showDialog("添加成功",'index.php?act=miaosha&op=miaosha_list','succ');
        }else {
            showDialog("添加失败",'index.php?act=miaosha&op=miaosha_add');
        }
    }
	public function check_miaosha_goods1Op() {
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
	 * 商品推荐
	 */
	public function recommend_listOp() {
		$model_web_config = Model('web_config');
		$condition = array();
		$gc_id = intval($_GET['id']);
		if ($gc_id > 0) {
			$condition['gc_id'] = $gc_id;
		}
		$goods_name = trim($_GET['goods_name']);
		if (!empty($goods_name)) {
			$condition['goods_name'] = array('like','%'.$goods_name.'%');
		}
		$goods_list = $model_web_config->getGoodsList($condition,'goods_id desc',6);


		Tpl::output('show_page',$model_web_config->showpage(2));
		Tpl::output('goods_list',$goods_list);
		Tpl::showpage('web_goods.list','null_layout');
	}

    /**
     * 套餐管理
     **/
    public function miaosha_quotaOp() {
        $model_miaosha_quota = Model('miaosha_quota');

        $condition = array();
        $condition['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        $list = $model_miaosha_quota->getmiaoshaQuotaList($condition, 10, 'end_time desc');
        Tpl::output('list',$list);
        Tpl::output('show_page',$model_miaosha_quota->showpage());

        $this->show_menu('miaosha_quota');
        Tpl::showpage('miaosha_quota.list');
    }

    /**
     * 抢购类别列表
     */
    public function class_listOp() {

        $model_miaosha_class = Model('miaosha_class');
        $param = array();
        $param['order'] = 'start_hour asc,sort asc';
        $miaosha_class_list = $model_miaosha_class->getList($param);

        $this->show_menu('class_list');
        Tpl::output('list',$miaosha_class_list);
        Tpl::showpage('miaosha_class.list');
    }

    /**
     * 添加秒杀分类页面
     */
    public function class_addOp() {
        $hour = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
        Tpl::output('hour',$hour);

        $this->show_menu('class_add');
        Tpl::showpage('miaosha_class.add');

    }

    public function class_editOp(){
        if($_GET['class_id'] < 1){
            showMessage(L('class_fail_errormsg'));
        }
        $huodong = Model("miaosha_class")->getOne($_GET['class_id']);

        $hour = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23');
        Tpl::output('hour',$hour);

        Tpl::output('class_info',$huodong);
        $this->show_menu('class_add');
        Tpl::showpage('miaosha_class.add');
    }

    /**
     * 保存添加的秒杀类别
     */
    public function class_saveOp() {

        $param = array();
        $param['class_name'] = trim($_POST['input_class_name']);
        if(empty($param['class_name'])) {
            showMessage(Language::get('class_name_error'),'');
        }
        $param['start_hour'] = intval($_POST['start_hour']);
        $param['end_hour'] = intval($_POST['end_hour']);

        $model_miaosha_class = Model('miaosha_class');

        // 删除秒杀分类缓存
        Model('miaosha')->dropCachedData('miaosha_classes');

        //新增
        if(intval($_POST['class_id']) > 0){
            $model_miaosha_class->update($param,array('class_id'=>$_POST['class_id']));
            showMessage(Language::get('miaosha_class_edit_success'),'index.php?act=miaosha&op=class_list');
        }else{
            if($model_miaosha_class->save($param)) {
                $this->log(L('miaosha_class_add_success').'[名称:'.$param['class_name'].']', null);
                showMessage(Language::get('miaosha_class_add_success'),'index.php?act=miaosha&op=class_list');
            }
            else {
                showMessage(Language::get('miaosha_class_add_fail'),'index.php?act=miaosha&op=class_list');
            }
        }



    }

    /**
     * 删除秒杀类别
     */
    public function class_dropOp() {

        $class_id = trim($_POST['class_id']);
        if(empty($class_id)) {
            showMessage(Language::get('param_error'),'');
        }

        $model_miaosha_class = Model('miaosha_class');
        $param = array();
        $param['class_id'] = $class_id;
        if($model_miaosha_class->drop($param)) {
            // 删除抢购分类缓存
            Model('miaosha')->dropCachedData('miaosha_classes');

        	$this->log(L('miaosha_class_drop_success').'[ID:'.$class_id.']',null);
            showMessage(Language::get('miaosha_class_drop_success'),'');
        }
        else {
            showMessage(Language::get('miaosha_class_drop_fail'),'');
        }

    }

    /**
     * 设置
     **/
    public function miaosha_settingOp() {

        $model_setting = Model('setting');
        $setting = $model_setting->GetListSetting();
        Tpl::output('setting',$setting);

        $this->show_menu('miaosha_setting');
        Tpl::showpage('miaosha.setting');
    }

    public function miaosha_setting_saveOp() {
        $miaosha_price = intval($_POST['miaosha_price']);
        if($miaosha_price < 0) {
            $miaosha_price = 0;
        }
        $miaosha_review_day = intval($_POST['miaosha_review_day']);
        if($miaosha_review_day < 0) {
            $miaosha_review_day = 0;
        }

        $model_setting = Model('setting');
        $update_array = array();
        $update_array['miaosha_price'] = $miaosha_price;
        $update_array['miaosha_review_day'] = $miaosha_review_day;
        //$update_array['miaosha_review_day'] = $miaosha_review_day;
        $result = $model_setting->updateSetting($update_array);
        if ($result){
            $this->log('修改秒杀套餐价格为'.$miaosha_price.'元,修改秒杀秒杀审核期为'.$miaosha_review_day.'天');
            showMessage(Language::get('nc_common_op_succ'),'');
        }else {
            showMessage(Language::get('nc_common_op_fail'),'');
        }
    }

    /**
     * 上传图片
     **/
    public function image_uploadOp() {
        if(!empty($_POST['old_miaosha_image'])) {
            $this->_image_del($_POST['old_miaosha_image']);
        }
        $this->_image_upload('miaosha_image');
    }

    private function _image_upload($file) {
        $data = array();
        $data['result'] = true;
        $date = date("Ym");
        if(!empty($_FILES[$file]['name'])) {
            $upload	= new UploadFile();
            $uploaddir = ATTACH_PATH.DS.'miaosha'.DS.$date.DS;
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
            'miaosha_list'=>array('menu_type'=>'link','menu_name'=>'秒杀活动','menu_url'=>'index.php?act=miaosha&op=miaosha_list'),
			'miaosha_add'=>array('menu_type'=>'link','menu_name'=>'新增秒杀','menu_url'=>'index.php?act=miaosha&op=miaosha_add'),
            'miaosha_quota'=>array('menu_type'=>'link','menu_name'=>'套餐管理','menu_url'=>'index.php?act=miaosha&op=miaosha_quota'),
            'class_list'=>array('menu_type'=>'link','menu_name'=>'秒杀活动分类','menu_url'=>'index.php?act=miaosha&op=class_list'),
            'class_add'=>array('menu_type'=>'link','menu_name'=>'活动分类添加','menu_url'=>'index.php?act=miaosha&op=class_add'),
            /*
            'price_list'=>array('menu_type'=>'link','menu_name'=>Language::get('miaosha_price_list'),'menu_url'=>'index.php?act=miaosha&op=price_list'),

            'price_add'=>array('menu_type'=>'link','menu_name'=>Language::get('miaosha_price_add'),'menu_url'=>'index.php?act=miaosha&op=price_add'),
            'price_edit'=>array('menu_type'=>'link','menu_name'=>Language::get('miaosha_price_edit'),'menu_url'=>'index.php?act=miaosha&op=price_edit'),
            */
            'miaosha_setting'=>array('menu_type'=>'link','menu_name'=>'设置','menu_url'=>urlAdmin('miaosha', 'miaosha_setting')),
            /*
        'slider'=>array('menu_type'=>'link','menu_name'=>'幻灯片管理','menu_url'=>urlAdmin('miaosha', 'slider')),
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

    /**
     * ajax操作
     */
    public function ajaxOp(){
        switch ($_GET['branch']){
            /**
             * 分类：验证是否有重复的名称
             */
            case 'ajax_miaosha_sort':
                $miaosha_id = intval($_GET['id']);

                $model_miaosha = Model('miaosha');
                $goods_info = $model_miaosha->getMiaoshaInfoByID($miaosha_id);
                if(empty($goods_info)) {
                    echo 'false';exit;
                }
                $model_miaosha->editMiaosha(array('m_sort'=>intval($_GET['value'])),array('miaosha_id'=>$miaosha_id));
                echo 'true';exit;

                break;
        }
    }
}
