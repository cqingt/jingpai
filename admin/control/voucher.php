<?php
/**
 * 代金券管理
 ***/

defined('InShopNC') or exit('Access Invalid!');
class voucherControl extends SystemControl{
    const SECONDS_OF_30DAY = 2592000;
    private $applystate_arr;
    private $quotastate_arr;
    private $templatestate_arr;

	public function __construct(){
		parent::__construct();
		Language::read('voucher');
		if (C('voucher_allow') != 1 || C('points_isuse')!=1){
			showMessage(Language::get('admin_voucher_unavailable'),'index.php?act=operation&op=point','html','succ',1,4000);
		}
		$this->applystate_arr = array('new'=>array(1,Language::get('admin_voucher_applystate_new')),'verify'=>array(2,Language::get('admin_voucher_applystate_verify')),'cancel'=>array(3,Language::get('admin_voucher_applystate_cancel')));
		$this->quotastate_arr = array('activity'=>array(1,Language::get('admin_voucher_quotastate_activity')),'cancel'=>array(2,Language::get('admin_voucher_quotastate_cancel')),'expire'=>array(3,Language::get('admin_voucher_quotastate_expire')));
		//代金券模板状态
		$this->templatestate_arr = array('usable'=>array(1,Language::get('admin_voucher_templatestate_usable')),'disabled'=>array(2,Language::get('admin_voucher_templatestate_disabled')));
		Tpl::output('applystate_arr',$this->applystate_arr);
		Tpl::output('quotastate_arr',$this->quotastate_arr);
		Tpl::output('templatestate_arr',$this->templatestate_arr);
	}

    /*
	 * 默认操作列出代金券
	 */
	public function indexOp(){
        $this->templatelistOp();
    }

    /**
     * 代金券设置
     */
    public function settingOp(){
    	$setting_model = Model('setting');
    	if (chksubmit()){
    		$obj_validate = new Validate();
			$validate_arr[] = array('input'=>$_POST['promotion_voucher_price'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_setting_price_error'));
			$validate_arr[] = array('input'=>$_POST['promotion_voucher_storetimes_limit'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_setting_storetimes_error'));
			$validate_arr[] = array('input'=>$_POST['promotion_voucher_buyertimes_limit'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_setting_buyertimes_error'));

			$obj_validate->validateparam = $validate_arr;
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage(Language::get('error').$error,'','','error');
			}
    		//每月代金劵软件服务单价
	    	$promotion_voucher_price = intval($_POST['promotion_voucher_price']);
	        if($promotion_voucher_price < 0) {
	            $promotion_voucher_price = 0;
	        }
	        //每月店铺可以发布的代金劵数量
	        $promotion_voucher_storetimes_limit = intval($_POST['promotion_voucher_storetimes_limit']);
	        if($promotion_voucher_storetimes_limit <= 0) {
	            $promotion_voucher_storetimes_limit = 20;
	        }
	        //买家可以领取的代金劵总数
	        $promotion_voucher_buyertimes_limit = intval($_POST['promotion_voucher_buyertimes_limit']);
	        if($promotion_voucher_buyertimes_limit <= 0) {
	            $promotion_voucher_buyertimes_limit = 5;
	        }
	        $update_array = array();
	        $update_array['promotion_voucher_price'] = $promotion_voucher_price;
	        $update_array['promotion_voucher_storetimes_limit'] = $promotion_voucher_storetimes_limit;
	        $update_array['promotion_voucher_buyertimes_limit'] = $promotion_voucher_buyertimes_limit;
	        $result = $setting_model->updateSetting($update_array);
	        if ($result){
	        	$this->log(L('admin_voucher_setting,nc_voucher_price_manage'));
	            showMessage(Language::get('nc_common_save_succ'),'');
	        }else {
	            showMessage(Language::get('nc_common_save_fail'),'');
	        }
    	} else {
    		$setting = $setting_model->GetListSetting();
    		$this->show_menu('voucher','setting');
	        Tpl::output('setting',$setting);
	        Tpl::showpage('voucher.setting');
    	}
    }

	/*
	 * 代金券面额列表
	 */
	public function pricelistOp(){
		//获得代金券金额列表
		$model = Model();
		$voucherprice_list = $model->table('voucher_price')->order('voucher_price asc')->page(10)->select();
		Tpl::output('list', $voucherprice_list) ;
		Tpl::output('show_page',$model->showpage(2));
		$this->show_menu('voucher','pricelist');
		Tpl::showpage('voucher.pricelist');
	}

    /*
	 * 添加代金券面额页面
	 */
	public function priceaddOp(){
		if (chksubmit()){
			$obj_validate = new Validate();
			$validate_arr[] = array('input'=>$_POST['voucher_price'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_price_error'));
			$validate_arr[] = array('input'=>$_POST['voucher_price_describe'],'require'=>'true','message'=>Language::get('admin_voucher_price_describe_error'));
			$validate_arr[] = array('input'=>$_POST['voucher_points'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_price_points_error'));
			$obj_validate->validateparam = $validate_arr;
			$error = $obj_validate->validate();
			//验证面额是否存在
			$voucher_price = intval($_POST['voucher_price']);
			$voucher_points = intval($_POST['voucher_points']);
			$model = Model();
			$voucherprice_info = $model->table('voucher_price')->where(array('voucher_price'=>$voucher_price))->find();
	        if(!empty($voucherprice_info)) {
	            $error .= Language::get('admin_voucher_price_exist');
	        }
	        if ($error != ''){
	            showMessage($error);
	        }
	        else {
	            //保存
	            $insert_arr = array(
					'voucher_price_describe'=>trim($_POST['voucher_price_describe']),
					'voucher_price'=>$voucher_price,
					'voucher_defaultpoints'=>$voucher_points,
				);
	            $rs = $model->table('voucher_price')->insert($insert_arr);
	            if ($rs){
	            	$this->log(L('nc_add,admin_voucher_priceadd').'['.$_POST['voucher_price'].']');
	            	showMessage(Language::get('nc_common_save_succ'),'index.php?act=voucher&op=pricelist');
	            }else {
	            	showMessage(Language::get('nc_common_save_fail'),'index.php?act=voucher&op=priceadd');
	            }
	        }
		}else {
			$this->show_menu('voucher','priceadd');
			Tpl::showpage('voucher.priceadd') ;
		}
    }

    /*
	 * 编辑代金券面额
	 */
    public function priceeditOp(){
    	$id = intval($_GET['priceid']);
    	if ($id <= 0){
    		$id = intval($_POST['priceid']);
    	}
    	if ($id <= 0){
    		showMessage(Language::get('param_error'),'index.php?act=voucher&op=pricelist');
    	}
    	$model = Model();
    	if (chksubmit()){
    		$obj_validate = new Validate();
			$validate_arr[] = array('input'=>$_POST['voucher_price'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_price_error'));
			$validate_arr[] = array('input'=>$_POST['voucher_price_describe'],'require'=>'true','message'=>Language::get('admin_voucher_price_describe_error'));
			$validate_arr[] = array('input'=>$_POST['voucher_points'],'require'=>'true','validator'=>'IntegerPositive','message'=>Language::get('admin_voucher_price_points_error'));
			$obj_validate->validateparam = $validate_arr;
			$error = $obj_validate->validate();
			//验证面额是否存在
    		$voucher_price = intval($_POST['voucher_price']);
			$voucher_points = intval($_POST['voucher_points']);
			$voucherprice_info = $model->table('voucher_price')->where(array('voucher_price'=>$voucher_price,'voucher_price_id'=>array('neq',$id)))->find();
	        if(!empty($voucherprice_info)) {
	        	$error .= Language::get('admin_voucher_price_exist');
	        }
			if ($error != ''){
				showMessage($error,'','','error');
			}else {
				$update_arr = array();
	    		$update_arr['voucher_price_describe'] = trim($_POST['voucher_price_describe']);
	    		$update_arr['voucher_price'] = $voucher_price;
	    		$update_arr['voucher_defaultpoints'] = $voucher_points;
	    		$rs = $model->table('voucher_price')->where(array('voucher_price_id'=>$id))->update($update_arr);
	    		if ($rs){
	    			$this->log(L('nc_edit,admin_voucher_priceadd').'['.$_POST['voucher_price'].']');
	    			showMessage(Language::get('nc_common_save_succ'),'index.php?act=voucher&op=pricelist');
	    		}else {
	    			showMessage(Language::get('nc_common_save_fail'),'index.php?act=voucher&op=pricelist');
	    		}
			}
    	}else {
    		$voucherprice_info = $model->table('voucher_price')->where(array('voucher_price_id'=>$id))->find();
    		if (empty($voucherprice_info)){
    			showMessage(Language::get('param_error'),'index.php?act=voucher&op=pricelist');
    		}
    		Tpl::output('info',$voucherprice_info);
    		$this->show_menu('priceedit','priceedit');
    		Tpl::showpage('voucher.priceadd');
    	}
    }

    /*
	 * 删除代金券面额
	 */
    public function pricedropOp(){
        $voucher_price_id = trim($_POST['voucher_price_id']);
        if(empty($voucher_price_id)) {
            showMessage(Language::get('param_error'),'index.php?act=voucher&op=pricelist');
        }
        $model = Model();
        $rs = $model->table('voucher_price')->where(array('voucher_price_id'=>array('in',$voucher_price_id)))->delete();
        if ($rs){
        	$this->log(L('nc_del,admin_voucher_priceadd').'[ID:'.$voucher_price_id.']');
        	showMessage(Language::get('nc_common_del_succ'),'index.php?act=voucher&op=pricelist');
        }else{
        	showMessage(Language::get('nc_common_del_fail'),'index.php?act=voucher&op=pricelist');
        }
    }

	/**
     * 套餐管理
     **/
    public function quotalistOp(){
        $model = Model();
        //更新过期套餐的状态
        $time = time();
        $model->table('voucher_quota')->where(array('quota_endtime'=>array('lt',$time),'quota_state'=>"{$this->quotastate_arr['activity'][0]}"))->update(array('quota_state'=>$this->quotastate_arr['expire'][0]));

        $param = array();
        if(trim($_GET['store_name'])){
        	$param['quota_storename'] = array('like',"%{$_GET['store_name']}%");
        }
        $state = intval($_GET['state']);
    	if($state){
        	$param['quota_state'] = $state;
        }
        $list = $model->table('voucher_quota')->where($param)->order('quota_id desc')->page(10)->select();
        Tpl::output('show_page',$model->showpage(2));
        $this->show_menu('voucher','quotalist');
        Tpl::output('list',$list);
        Tpl::showpage('voucher.quotalist');
    }

    /**
     * 代金券列表
     */
    public function templatelistOp(){
        $model = Model();
        $param = array();
        if(trim($_GET['store_name'])){
        	$param['voucher_t_storename'] = array('like',"%{$_GET['store_name']}%");
        }
    	if(trim($_GET['sdate']) && trim($_GET['edate'])){
    		$sdate = strtotime($_GET['sdate']);
    		$edate = strtotime($_GET['edate']);
        	$param['voucher_t_add_date'] = array('between',"$sdate,$edate");
        }elseif (trim($_GET['sdate'])){
        	$sdate = strtotime($_GET['sdate']);
        	$param['voucher_t_add_date'] = array('egt',$sdate);
        }elseif (trim($_GET['edate'])){
        	$edate = strtotime($_GET['edate']);
        	$param['voucher_t_add_date'] = array('elt',$edate);
        }
        $state = intval($_GET['state']);
    	if($state){
        	$param['voucher_t_state'] = $state;
        }
        if($_GET['recommend'] === '1'){
            $param['voucher_t_recommend'] = 1;
        } elseif ($_GET['recommend'] === '0'){
            $param['voucher_t_recommend'] = 0;
        }
        $list = $model->table('voucher_template')->where($param)->order('voucher_t_state asc,voucher_t_id desc')->page(10)->select();
        Tpl::output('show_page',$model->showpage(2));
        $this->show_menu('voucher','templatelist');
        Tpl::output('list',$list);

        // 输出自营店铺IDS
        Tpl::output('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        Tpl::showpage('voucher.templatelist');
    }

    /*
	 * 代金券模版编辑
	 */
    public function templateeditOp(){
    	$t_id = intval($_GET['tid']);
    	if ($t_id <= 0){
    		$t_id = intval($_POST['tid']);
    	}
    	if ($t_id <= 0){
    		showMessage(Language::get('param_error'),'index.php?act=voucher&op=templatelist','','error');
    	}
        $model = Model('voucher');
        //查询模板信息
        $param = array();
        $param['voucher_t_id'] = $t_id;
        $t_info = $model->table('voucher_template')->where($param)->find();

        /*2015-12-07 Add is name lt 统计代金卷数量*/
        $t_info['voucher_t_giveout'] = $model->table('voucher')->where("voucher_t_id=$t_id")->count();
        $t_info['voucher_t_used'] = $model->table('voucher')->where("voucher_t_id=$t_id AND voucher_state=2")->count();
        /*End*/

        if (empty($t_info)){
        	showMessage(Language::get('param_error'),'index.php?act=voucher&op=templatelist','html','error');
        }
        if(chksubmit()){
        	$points = intval($_POST['points']);
        	if ($points < 0){
        		showMessage(Language::get('admin_voucher_template_points_error'),'','html','error');
        	}
	       	$update_arr = array();
	       	$update_arr['voucher_t_points'] = $points;
	       	$update_arr['voucher_t_state'] = intval($_POST['tstate']) == $this->templatestate_arr['usable'][0]?$this->templatestate_arr['usable'][0]:$this->templatestate_arr['disabled'][0];
	       	$update_arr['voucher_t_recommend'] = intval($_POST['recommend'])==1?1:0;
	       	$rs = $model->table('voucher_template')->where(array('voucher_t_id'=>$t_info['voucher_t_id']))->update($update_arr);
	       	if($rs){
	       		$this->log(L('nc_edit,nc_voucher_price_manage,admin_voucher_styletemplate').'[ID:'.$t_id.']');
	       		showMessage(Language::get('nc_common_save_succ'),'index.php?act=voucher&op=templatelist','succ');
	       	}else{
	       		showMessage(Language::get('nc_common_save_fail'),'index.php?act=voucher&op=templatelist','error');
	       	}
        }else{
            //查询店铺分类
		    $store_class = rkcache('store_class', true);
		    TPL::output('store_class',$store_class);

	        if (!$t_info['voucher_t_customimg'] || !file_exists(BASE_UPLOAD_PATH.DS.ATTACH_VOUCHER.DS.$t_info['voucher_t_store_id'].DS.$t_info['voucher_t_customimg'])){
	        	$t_info['voucher_t_customimg'] = '';
	        }else{
	        	$t_info['voucher_t_customimg'] = UPLOAD_SITE_URL.DS.ATTACH_VOUCHER.DS.$t_info['voucher_t_store_id'].DS.$t_info['voucher_t_customimg'];
	        }
	        TPL::output('t_info',$t_info);
	        $this->show_menu('templateedit','templateedit');
	        Tpl::showpage('voucher.templateedit');
        }
    }

    /**
     * ajax操作
     */
    public function ajaxOp(){
        $model_voucher = Model('voucher');
        switch ($_GET['branch']){
        	case 'voucher_t_recommend':
        	    $model_voucher->editVoucherTemplate(array('voucher_t_id' => intval($_GET['id'])), array($_GET['column'] => intval($_GET['value'])));
        	    $logtext = '';
        	    if (intval($_GET['value']) == 1){//推荐代金券
        	        $logtext = '推荐代金券';
        	    } else {
        	        $logtext = '取消推荐代金券';
        	    }
        	    $this->log($logtext.'[ID:'.intval($_GET['id']).']',1);
        	    echo 'true';exit;
        	    break;

        	case 'voucher_t_show':
        	    $model_voucher->editVoucherTemplate(array('voucher_t_id' => intval($_GET['id'])), array($_GET['column'] => intval($_GET['value'])));
        	    $logtext = '';
        	    if (intval($_GET['value']) == 1){//推荐代金券
        	        $logtext = '俱乐部显示';
        	    } else {
        	        $logtext = '取消俱乐部显示';
        	    }
        	    $this->log($logtext.'[ID:'.intval($_GET['id']).']',1);
        	    echo 'true';exit;
        	    break;

        }
    }

    /*
     * 平台优惠券管理
     */
    public function shop_voucher_listOp(){
		$model = Model();
		 $param = array();
        if(trim($_GET['store_name'])){
        	$param['voucher_t_store_name'] = array('like',"%{$_GET['store_name']}%");
        }
    	if(trim($_GET['sdate']) && trim($_GET['edate'])){
    		$sdate = strtotime($_GET['sdate']);
    		$edate = strtotime($_GET['edate']);
        	$param['voucher_t_add_date'] = array('between',"$sdate,$edate");
        }elseif (trim($_GET['sdate'])){
        	$sdate = strtotime($_GET['sdate']);
        	$param['voucher_t_add_date'] = array('egt',$sdate);
        }elseif (trim($_GET['edate'])){
        	$edate = strtotime($_GET['edate']);
        	$param['voucher_t_add_date'] = array('elt',$edate);
        }
        $state = intval($_GET['state']);
    	if($state){
        	$param['voucher_t_state'] = $state;
        }
	    $list = $model->table('store_voucher_template')->where($param)->order('voucher_t_state asc,voucher_t_id desc')->page(10)->select();
        foreach($list as $k=>$v){
            //已发放数量
            $list[$k]['send_num'] = $model->table('store_voucher')->where(array('voucher_t_id'=>$v['voucher_t_id']))->count();
            $list[$k]['use_num'] = $model->table('store_voucher')->where(array('voucher_t_id'=>$v['voucher_t_id'],'voucher_state'=>'2'))->count();
        }
        Tpl::output('show_page',$model->showpage(2));
        $this->show_menu('voucher','templatelist');
        Tpl::output('list',$list);
        $this->show_menu('voucher','shop_voucher');
        Tpl::showpage('shop_voucher.list');
    }

    //新增平台优惠券
    public function shop_voucher_addOp(){
		$store = Model('store');
		TPL::output('store_list',$store->getStoreOnlineList());
		TPL::output('menu_key',"insert_store_voucher");
        Tpl::showpage('shop_voucher.add');
    }
	 //编辑平台优惠劵
	public function storetemplateeditOp(){
		$store = Model('store');
		TPL::output('store_list',$store->getStoreOnlineList());
		$model = Model();
		$param['voucher_t_id'] = intval($_GET['tid']);
	    $voucher_info = $model->table('store_voucher_template')->where($param)->find();;
		Tpl::output('info',$voucher_info);
		TPL::output('menu_key',"edit_store_voucher");
        Tpl::showpage('shop_voucher.add');
    }
	//执行平台优惠劵编辑操作
    public function edit_store_voucherOp(){
		$tid = intval($_POST['tid']);
		//可用店铺id
		$store_name = '';
		if($_POST['store_id'] == 0){
			if($_POST['store']){
				$store = Model('store');
				$where['store_id'] = array('in',$_POST['store']);
				$store_list = $store->getStoreOnlineList($where);
				$store_name = array();
				if($store_list){
					foreach($store_list as $k=>$v){
							$store_name[] = $v['store_name'];
					}
				}
				$store_id = implode(',',$_POST['store']);
				$store_name = implode(',',$store_name);
			}else{
				$store_id = 0;
			}
		}else{
			$store_id = 0;
		}
		
		$admin_info = $this->systemLogin();
		 //保存
		$insert_arr = array(
			'voucher_t_title'=>trim($_POST['voucher_name']), //优惠劵名称 
			'voucher_t_desc'=>trim($_POST['voucher_desc']),
			'voucher_t_start_date'=>strtotime($_POST['voucher_start_date']), //优惠劵使用开始时间
			'voucher_t_end_date'=>strtotime($_POST['voucher_end_date']),	//优惠劵使用结束时间
			'voucher_t_price'=>intval($_POST['voucher_price']), //优惠劵面值金额
			'voucher_t_limit'=>intval($_POST['voucher_amount']), //优惠劵订单限额
			'voucher_t_store_id'=> $store_id,//可用店铺 0 代表通用
			'voucher_t_store_name'=> $store_name,//可用店铺名称
			'voucher_t_creator_name'=> $admin_info['name'],//添加人名称
			'voucher_t_state'=> 1,//状态
			'voucher_t_total'=> intval($_POST['voucher_total']),//可发放的优惠劵总数
			'voucher_t_add_date'=> time(),//创建时间	
			'voucher_t_eachlimit'=> intval($_POST['voucher_eachlimit']),//每人限领
		);
		if($_FILES['waybill_image']){
			//上传图片
			$upload	= new UploadFile();
			$upload->set('default_dir', ATTACH_WAYBILL);
			$upload->set('allow_type', array('jpg','jpeg','png'));
			$result = $upload->upfile('waybill_image');
			if($result) {
				$img = $upload->file_name;
			}
			$insert_arr['voucher_t_customimg'] = $img;
		}
		$model = Model();
	    $rs = $model->table('store_voucher_template')->where(array('voucher_t_id'=>$tid))->update($insert_arr);
		
		if ($rs){
			showMessage('编辑成功','index.php?act=voucher&op=shop_voucher_list');
		}else {
			showMessage('编辑失败','index.php?act=voucher&op=storetemplateedit&tid='.$tid);
		}

	}

	 //执行平台优惠劵插入操作
    public function insert_store_voucherOp(){
		//可用店铺id
		$store_name = '';
		if($_POST['store_id'] == 0){
			if($_POST['store']){
				$store = Model('store');
				$where['store_id'] = array('in',$_POST['store']);
				$store_list = $store->getStoreOnlineList($where);
				$store_name = array();
				if($store_list){
					foreach($store_list as $k=>$v){
							$store_name[] = $v['store_name'];
					}
				}
				$store_id = implode(',',$_POST['store']);
				$store_name = implode(',',$store_name);
			}else{
				$store_id = 0;
			}
		}else{
			$store_id = 0;
		}
		if($_FILES['waybill_image']){
			//上传图片
			$upload	= new UploadFile();
			$upload->set('default_dir', ATTACH_WAYBILL);
			$upload->set('allow_type', array('jpg','jpeg','png'));
			$result = $upload->upfile('waybill_image');
			if($result) {
				$img = $upload->file_name;
			}
		}else{
			$img = '';
		}
		$admin_info = $this->systemLogin();
		 //保存
		$insert_arr = array(
			'voucher_t_title'=>trim($_POST['voucher_name']), //优惠劵名称 
			'voucher_t_desc'=>trim($_POST['voucher_desc']),
			'voucher_t_start_date'=>strtotime($_POST['voucher_start_date']), //优惠劵使用开始时间
			'voucher_t_end_date'=>strtotime($_POST['voucher_end_date']),	//优惠劵使用结束时间
			'voucher_t_price'=>intval($_POST['voucher_price']), //优惠劵面值金额
			'voucher_t_limit'=>intval($_POST['voucher_amount']), //优惠劵订单限额
			'voucher_t_store_id'=> $store_id,//可用店铺 0 代表通用
			'voucher_t_store_name'=> $store_name,//可用店铺名称
			'voucher_t_creator_name'=> $admin_info['name'],//添加人名称
			'voucher_t_state'=> 1,//状态
			'voucher_t_total'=> intval($_POST['voucher_total']),//可发放的优惠劵总数
			'voucher_t_add_date'=> time(),//创建时间	
			'voucher_t_eachlimit'=> intval($_POST['voucher_eachlimit']),//每人限领
			'voucher_t_customimg'=> $img,//优惠劵图片
		);
		$model = Model();
	    $rs = $model->table('store_voucher_template')->insert($insert_arr);
		
		if ($rs){
			showMessage('插入成功','index.php?act=voucher&op=shop_voucher_list');
		}else {
			showMessage('插入失败','index.php?act=voucher&op=shop_voucher_add');
		}
		
    }

	/**
     * 页面内导航菜单
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    private function show_menu($menu_type,$menu_key='') {
    	$menu_array		= array();
		switch ($menu_type) {
			case 'voucher':
				$menu_array = array(
				3=>array('menu_key'=>'templatelist','menu_name'=>Language::get('admin_voucher_template_manage'), 'menu_url'=>'index.php?act=voucher&op=templatelist'),
				2=>array('menu_key'=>'quotalist','menu_name'=>Language::get('admin_voucher_quota_manage'), 'menu_url'=>'index.php?act=voucher&op=quotalist'),
				5=>array('menu_key'=>'pricelist','menu_name'=>Language::get('admin_voucher_pricemanage'), 'menu_url'=>'index.php?act=voucher&op=pricelist'),
				6=>array('menu_key'=>'priceadd','menu_name'=>Language::get('admin_voucher_priceadd'), 'menu_url'=>'index.php?act=voucher&op=priceadd'),
				4=>array('menu_key'=>'setting','menu_name'=>Language::get('admin_voucher_setting'),	'menu_url'=>'index.php?act=voucher&op=setting'),
                7=>array('menu_key'=>'shop_voucher','menu_name'=>'平台级优惠券管理',	'menu_url'=>'index.php?act=voucher&op=shop_voucher_list'),

                );
				break;
			case 'priceedit':
				$menu_array = array(
				1=>array('menu_key'=>'setting','menu_name'=>Language::get('admin_voucher_setting'),	'menu_url'=>'index.php?act=voucher&op=setting'),
				2=>array('menu_key'=>'pricelist','menu_name'=>Language::get('admin_voucher_pricemanage'), 'menu_url'=>'index.php?act=voucher&op=pricelist'),
				3=>array('menu_key'=>'priceedit','menu_name'=>Language::get('admin_voucher_priceedit'), 'menu_url'=>'')
				);
				break;
			case 'templateedit':
				$menu_array = array(
				1=>array('menu_key'=>'templatelist','menu_name'=>Language::get('admin_voucher_template_manage'), 'menu_url'=>'index.php?act=voucher&op=templatelist'),
				2=>array('menu_key'=>'templateedit','menu_name'=>Language::get('admin_voucher_template_edit'), 'menu_url'=>'')
				);
				break;
		}
        Tpl::output('menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
