<?php
/**
 * 满即送管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class promotion_mansongControl extends SystemControl{

    public function __construct(){
        parent::__construct();

        //读取语言包
        Language::read('member_layout,promotion_mansong');

        //检查审核功能是否开启
        if (intval($_GET['promotion_allow']) !== 1 && intval(C('promotion_allow')) !== 1){
 			$url = array(
				array(
					'url'=>'index.php?act=promotion_mansong&promotion_allow=1',
					'msg'=>Language::get('open'),
				),
				array(
					'url'=>'index.php?act=dashboard&op=welcome',
					'msg'=>Language::get('close'),
				),
			);
			showMessage(Language::get('promotion_unavailable'),$url,'html','succ',1,6000);
        }
    }

    /**
     * 默认Op
     */
    public function indexOp() {

		//自动开启满就送
		if (intval($_GET['promotion_allow']) === 1){
			$model_setting = Model('setting');
			$update_array = array();
			$update_array['promotion_allow'] = 1;
			$model_setting->updateSetting($update_array);
		}

        $this->mansong_listOp();
    }


    /**
     * 活动列表
     **/
    public function mansong_listOp() {
        $model_mansong = Model('p_mansong');

        $param = array();
        if(!empty($_GET['mansong_name'])) {
            $param['mansong_name'] = array('like', '%'.$_GET['mansong_name'].'%');
        }
        if(!empty($_GET['store_name'])) {
            $param['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        }
        if(!empty($_GET['state'])) {
            $param['state'] = $_GET['state'];
        }
        $mansong_list = $model_mansong->getMansongList($param, 10);
        Tpl::output('list', $mansong_list);
        Tpl::output('show_page', $model_mansong->showpage());
        Tpl::output('mansong_state_array', $model_mansong->getMansongStateArray());

        $this->show_menu('mansong_list');

        // 输出自营店铺IDS
        Tpl::output('flippedOwnShopIds', array_flip(model('store')->getOwnShopIds()));
        Tpl::showpage('promotion_mansong.list');
    }

    /**
     * 活动详细信息
     * temp
     **/
    public function mansong_detailOp() {
        $mansong_id = intval($_GET['mansong_id']);

        $model_mansong = Model('p_mansong');
        $model_mansong_rule = Model('p_mansong_rule');

        $mansong_info = $model_mansong->getMansongInfoByID($mansong_id);
        if(empty($mansong_info)) {
            showMessage(L('param_error'));
        }
        Tpl::output('mansong_info', $mansong_info);

        $param = array();
        $param['mansong_id'] = $mansong_id;
        $rule_list = $model_mansong_rule->getMansongRuleListByID($mansong_id);
        Tpl::output('list',$rule_list);

        $this->show_menu('mansong_detail');
        Tpl::showpage('promotion_mansong.detail');
    }

    /**
     * 满即送活动取消
     **/
    public function mansong_cancelOp() {
        $mansong_id = intval($_POST['mansong_id']);
        $model_mansong = Model('p_mansong');
        $result = $model_mansong->cancelMansong(array('mansong_id' => $mansong_id));
        if($result) {
            $this->log('取消满即送活动，活动编号'.$mansong_id);
            showMessage(Language::get('nc_common_op_succ'),'');
        } else {
            showMessage(Language::get('nc_common_op_fail'),'');
        }
    }

    /**
     * 满即送活动删除
     **/
    public function mansong_delOp() {
        $mansong_id = intval($_POST['mansong_id']);
        $model_mansong = Model('p_mansong');
        $result = $model_mansong->delMansong(array('mansong_id' => $mansong_id));
        if($result) {
            $this->log('删除满即送活动，活动编号'.$mansong_id);
            showMessage(Language::get('nc_common_op_succ'),'');
        } else {
            showMessage(Language::get('nc_common_op_fail'),'');
        }
    }

	/**
     * 添加平台满即送活动
     **/
    public function pingtai_mansongAddOp() {
        $start_time = time();
        Tpl::output('start_time',$start_time);
        Tpl::output('end_time',time()+86400);
		$this->show_menu('pingtai_mansongAdd');
        Tpl::showpage('promotion_mansong.add');
    }
	
	/**
     * 按店铺名字匹配店铺
     **/
	public function select_storeOp() {
		$store_name = $_POST['store_name'];
		$StoreList = Model('store')->getStoreList(array('store_name'=>array('like','%'.$store_name.'%')),null,'store_id desc','store_id,store_name');
		$str = '';
		if($StoreList){
			$str .= '<select name="store_id" id="store_id">';
			foreach($StoreList as $k=>$v){
				$str .= ' <option value="'.$v['store_id'].'" name="'.$v['store_name'].'">'.$v['store_name'].'</option>';
			}
			$str .= '</select>';
		}
		echo $str;
		exit;
	}
	
	/**
     * 根据店铺id查找分类
     **/
	public function select_classOp() {
		$store_id = $_POST['store_id'];
		$store_goods_class = Model('store_goods_class')->getShowTreeList($store_id);
		$str = '<select name="own_class" id="own_class">';
		if($store_goods_class){
			foreach($store_goods_class as $k=>$v){
				$str .= ' <option value="'.$v['stc_id'].'" name="'.$v['stc_name'].'">'.$v['stc_name'].'</option>';
				if(is_array($v['children']) && !empty($v['children'])){
                   foreach($v['children'] as $k1=>$v1){
						$str .= ' <option value="'.$v1['stc_id'].'" name="'.$v1['stc_name'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$v1['stc_name'].'</option>';
					}
				}
			}
		}
		$str .= '</select>&nbsp;&nbsp;<a onclick="add_gcid();" href="JavaScript:void(0);" class="ncsc-btn-mini ncsc-btn-green"><i class="icon-plus"></i>添加到可用分类</a>';
		echo $str;
		exit;
	}
	
	/**
     * 选择排除商品
     */
    public function mansong_add_goodsOp() {
        /**
         * 实例化模型
         */
        $model_goods =Model('goods');

        // where条件
        $where = array ();
        $where['store_id'] = $_GET['store_id'];
        $condition['goods_state'] = '1';
        $condition['goods_verify'] = '1';
        if (intval($_GET['stc_id']) > 0) {
            $where['goods_stcids'] = array('like', '%,' . intval($_GET['stc_id']) . ',%');
        }
        if (trim($_GET['keyword']) != '') {
            $where['goods_name'] = array('like', '%' . trim($_GET['keyword']) . '%');
        }
        $goods_list = $model_goods->getGoodsListForPromotion($where, '*', 8, 'bundling');
        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::output('store_promotion_mansong.goods_add', $goods_list);
        /**
         * 商品分类
         */
        $store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_GET['store_id'], 'stc_state' => '1'));
		Tpl::output('store_id',$_GET['store_id']);
        Tpl::output('store_goods_class', $store_goods_class);
        Tpl::showpage('store_promotion_mansong.add_goods', 'null_layout');
    }

	/**
     * 选择活动商品
     **/
    public function search_goodsOp() {
        $model_goods = Model('goods');
        $condition = array();
        $condition['store_id'] = $_GET['store_id'];
        $condition['goods_state'] = '1';
        $condition['goods_verify'] = '1';
        $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        $goods_list = $model_goods->getGeneralGoodsList($condition, '*', 8);

        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
		Tpl::output('store_id',$_GET['store_id']);
        Tpl::showpage('store_promotion_mansong.goods', 'null_layout');
    }

	/**
     * 保存添加的满就送活动
     **/
    public function mansong_saveOp() {
        $mansong_name = trim($_POST['mansong_name']);
        $start_time = strtotime($_POST['start_time']);
        $end_time = strtotime($_POST['end_time']);

        $model_mansong_quota = Model('p_mansong_quota');
        $model_mansong = Model('p_mansong');
        $model_mansong_rule = Model('p_mansong_rule');

        if($start_time >= $end_time) {
            showDialog("活动开始时间不能大于活动结束时间");
        }
        if(empty($mansong_name)) {
            showDialog("请输入活动名称");
        }

        $start_time_limit = $model_mansong->getMansongNewStartTime($_POST['store_id']);
        if(!empty($start_time_limit) && $start_time_limit > $start_time) {
            $start_time = $start_time_limit;
        }


        if(empty($_POST['mansong_rule'])) {
            showDialog('满即送规则不能为空');
        }


        //add 满送分类规则 xin 20151110
        $cate_rule = intval($_POST['cate_rule']);
        $diff_goods = '';
        if(is_array($_POST['goods_ids']) && !empty($_POST['goods_ids'])){
            foreach($_POST['goods_ids'] as $g_id){
                $diff_goods .= intval($g_id).',';
            }
            $diff_goods = substr($diff_goods,0,-1);
        }
        $store_cates = '';
        if(is_array($_POST['store_cates']) && !empty($_POST['store_cates'])){
            foreach($_POST['store_cates'] as $cates_id){
                $store_cates .= intval($cates_id).',';
            }
            $store_cates = substr($store_cates,0,-1);
        }
        //add end
		$StoreInfo = Model('store')->getStoreInfo($_POST['store_id']);
        $param = array();
        $param['mansong_name'] = $mansong_name;
        $param['start_time'] = $start_time;
        $param['end_time'] = $end_time;
        $param['store_id'] = $_POST['store_id'];
        $param['store_name'] = $StoreInfo['store_name'];
        $param['member_id'] = $StoreInfo['member_id'];
        $param['member_name'] = $StoreInfo['member_name'];
        $param['quota_id'] = $current_mansong_quota['quota_id'] ? $current_mansong_quota['quota_id'] : 0;
        $param['remark'] = trim($_POST['remark']);
        $param['cate_rule'] = $cate_rule;
        $param['store_cates'] = $store_cates;
        $param['diff_goods'] = $diff_goods;
        //add xin 20160112
        $param['mansong_type'] = (intval($_POST['mansong_type']) == 2)?'2':'1';
        //add end
        $mansong_id = $model_mansong->addMansong($param);
        if($mansong_id) {
            $mansong_rule_array = array();
            foreach ($_POST['mansong_rule'] as $value) {
                list($price, $discount, $goods_id) = explode(',', $value);
                $mansong_rule = array();
                $mansong_rule['mansong_id'] = $mansong_id;
                $mansong_rule['price'] = $price;
                $mansong_rule['discount'] = $discount;
                $mansong_rule['goods_id'] = $goods_id;
                $mansong_rule_array[] = $mansong_rule;
            }
            //生成规则
            $result = $model_mansong_rule->addMansongRuleArray($mansong_rule_array);
            showDialog("添加成功", "index.php?act=promotion_mansong&op=index", 'succ');
        } else {
            showDialog("添加失败");
        }
    }

    /**
     * 套餐管理
     **/
    public function mansong_quotaOp() {
        $model_mansong_quota = Model('p_mansong_quota');

        $param = array();
        if(!empty($_GET['store_name'])) {
            $param['store_name'] = array('like', '%'.$_GET['store_name'].'%');
        }
        $list = $model_mansong_quota->getMansongQuotaList($param, 10, 'quota_id desc');
        Tpl::output('list',$list);
        Tpl::output('show_page',$model_mansong_quota->showpage());

        $this->show_menu('mansong_quota');
        Tpl::showpage('promotion_mansong_quota.list');

    }

    /**
     * 设置
     **/
    public function mansong_settingOp() {

        $model_setting = Model('setting');
        $setting = $model_setting->GetListSetting();
        Tpl::output('setting',$setting);

        $this->show_menu('mansong_setting');
        Tpl::showpage('promotion_mansong.setting');
    }

    public function mansong_setting_saveOp() {

        $promotion_mansong_price = intval($_POST['promotion_mansong_price']);
        

        $model_setting = Model('setting');
        $update_array = array();
        $update_array['promotion_mansong_price'] = $promotion_mansong_price;

        $result = $model_setting->updateSetting($update_array);
        if ($result === true){
        	$this->log(L('nc_config,nc_promotion_mansong,mansong_price'));
            showMessage(Language::get('setting_save_success'),'');
        }else {
            showMessage(Language::get('setting_save_fail'),'');
        }
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
            'mansong_list'=>array('menu_type'=>'link','menu_name'=>Language::get('mansong_list'),'menu_url'=>urlAdmin('promotion_mansong', 'mansong_list')),
            'mansong_quota'=>array('menu_type'=>'link','menu_name'=>Language::get('mansong_quota'),'menu_url'=>urlAdmin('promotion_mansong', 'mansong_quota')),
            'mansong_detail'=>array('menu_type'=>'link','menu_name'=>Language::get('mansong_detail'),'menu_url'=>urlAdmin('promotion_mansong', 'mansong_detail')),
            'mansong_setting'=>array('menu_type'=>'link','menu_name'=>Language::get('mansong_setting'),'menu_url'=>urlAdmin('promotion_mansong', 'mansong_setting')),
			'pingtai_mansongAdd'=>array('menu_type'=>'link','menu_name'=>'添加平台满即送','menu_url'=>urlAdmin('promotion_mansong', 'pingtai_mansongAdd')),
        );
        if($menu_key != 'mansong_detail') unset($menu_array['mansong_detail']);
        $menu_array[$menu_key]['menu_type'] = 'text';
        Tpl::output('menu',$menu_array);
    }

}
