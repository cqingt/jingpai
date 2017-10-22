<?php
/**
 * 商户中心-满就送
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class store_promotion_mansongControl extends BaseSellerControl {

    public function __construct() {

        parent::__construct() ;

        Language::read('member_layout,promotion_mansong');

        //检查满就送是否开启
        if (intval(C('promotion_allow')) !== 1) {
            showMessage(Language::get('promotion_unavailable'),'index.php?act=seller_center','','error');
        }

    }

    public function indexOp() {
        $this->mansong_listOp();
    }

    /**
     * 发布的满就送活动列表
     **/
    public function mansong_listOp() {

        $model_mansong_quota = Model('p_mansong_quota');
        $model_mansong = Model('p_mansong');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            $current_mansong_quota = $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
            Tpl::output('current_mansong_quota', $current_mansong_quota);
        }

        $condition = array();
        $condition['store_id'] = $_SESSION['store_id'];
        if(!empty($_GET['mansong_name'])) {
            $condition['mansong_name'] = array('like', '%'.$_GET['mansong_name'].'%');
        }
        if(!empty($_GET['state'])) {
            $condition['state'] = intval($_GET['state']);
        }
        $mansong_list = $model_mansong->getMansongList($condition, 10, 'state desc, end_time desc');
        Tpl::output('list', $mansong_list);
        Tpl::output('show_page',$model_mansong->showpage());
        Tpl::output('mansong_state_array', $model_mansong->getMansongStateArray());

        self::profile_menu('mansong_list');
        Tpl::showpage('store_promotion_mansong.list');
    }

    /**
     * 添加满就送活动
     **/
    public function mansong_addOp() {
        $model_mansong_quota = Model('p_mansong_quota');
        $model_mansong = Model('p_mansong');

        $start_time = $model_mansong->getMansongNewStartTime($_SESSION['store_id']);

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            //检查当前套餐是否可用
            $current_mansong_quota = $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
            if(empty($current_mansong_quota)) {
                showMessage(Language::get('mansong_quota_current_error'),'','','error');
            }

            if(empty($start_time)) {
                $start_time = $current_mansong_quota['start_time'];
            }
            $end_time = $current_mansong_quota['end_time'];
        }

        if (empty($start_time) || $start_time < time())
            $start_time = time();

        Tpl::output('start_time',$start_time);
        Tpl::output('end_time',$end_time);

        $store_goods_class = Model('store_goods_class')->getShowTreeList($_SESSION['store_id']);

        Tpl::output('show_own_class',$store_goods_class);

        //输出导航
        self::profile_menu('mansong_add');
        Tpl::showpage('store_promotion_mansong.add');
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
            showDialog(Language::get('greater_than_start_time'));
        }
        if(empty($mansong_name)) {
            showDialog(Language::get('mansong_name_error'));
        }

        $start_time_limit = $model_mansong->getMansongNewStartTime($_SESSION['store_id']);
        if(!empty($start_time_limit) && $start_time_limit > $start_time) {
            $start_time = $start_time_limit;
        }

        if (!checkPlatformStore()) {
            //检查当前套餐是否可用
            $current_mansong_quota = $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
            if(empty($current_mansong_quota)) {
                showDialog(Language::get('mansong_quota_current_error'),'reload','error');
            }

            //验证输入
            $quota_start_time = intval($current_mansong_quota['start_time']);
            $quota_end_time = intval($current_mansong_quota['end_time']);

            if($start_time < $quota_start_time) {
                showDialog(sprintf(Language::get('mansong_add_start_time_explain'),date('Y-m-d',$current_mansong_quota['start_time'])));
            }
            if($end_time > $quota_end_time) {
                showDialog(sprintf(Language::get('mansong_add_end_time_explain'),date('Y-m-d',$current_mansong_quota['end_time'])));
            }
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

        $param = array();
        $param['mansong_name'] = $mansong_name;
        $param['start_time'] = $start_time;
        $param['end_time'] = $end_time;
        $param['store_id'] = $_SESSION['store_id'];
        $param['store_name'] = $_SESSION['store_name'];
        $param['member_id'] = $_SESSION['member_id'];
        $param['member_name'] = $_SESSION['member_name'];
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

            $this->recordSellerLog('添加满即送活动，活动名称：'.$mansong_name);

            // 自动发布动态
            // mansong_name,start_time,end_time,store_id
            $data_array = array();
            $data_array['mansong_name'] = $param['mansong_name'];
            $data_array['start_time']   = $param['start_time'];
            $data_array['end_time']     = $param['end_time'];
            $data_array['store_id']     = $_SESSION['store_id'];
            $this->storeAutoShare($data_array, 'mansong');

            showDialog(Language::get('mansong_add_success'), urlShop('store_promotion_mansong', 'mansong_list'), 'succ');
        } else {
            showDialog(Language::get('mansong_add_fail'));
        }
    }

    /**
     * 修改的满就送活动
     **/
    public function mansong_updateOp() {
        $mansong_id = intval($_GET['mansong_id']);

        $model_mansong = Model('p_mansong');
        $model_mansong_rule = Model('p_mansong_rule');
        $model_mansong_quota = Model('p_mansong_quota');

        if (checkPlatformStore()) {
            Tpl::output('isOwnShop', true);
        } else {
            //检查当前套餐是否可用
            $current_mansong_quota = $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
            if(empty($current_mansong_quota)) {
                showMessage(Language::get('mansong_quota_current_error'),'','','error');
            }

            $end_time = $current_mansong_quota['end_time'];
        }

        Tpl::output('end_time',$end_time);

        $mansong_info = $model_mansong->getMansongInfoByID($mansong_id, $_SESSION['store_id']);
        if(empty($mansong_info)) {
            showDialog(L('param_error'));
        }

        if(chksubmit()){
            if($mansong_info['end_time'] < TIMESTAMP){
                showDialog('已结束满即送活动无法修改');
            }
            $mansong_name = trim($_POST['mansong_name']);
            $start_time = strtotime($_POST['start_time']);
            $end_time = strtotime($_POST['end_time']);

            $model_mansong_quota = Model('p_mansong_quota');
            $model_mansong = Model('p_mansong');
            $model_mansong_rule = Model('p_mansong_rule');

            if($start_time >= $end_time) {
                showDialog(Language::get('greater_than_start_time'));
            }
            if(empty($mansong_name)) {
                showDialog(Language::get('mansong_name_error'));
            }


            if (!checkPlatformStore()) {
                //检查当前套餐是否可用
                $current_mansong_quota = $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
                if(empty($current_mansong_quota)) {
                    showDialog(Language::get('mansong_quota_current_error'),'reload','error');
                }

                //验证输入
                $quota_start_time = intval($current_mansong_quota['start_time']);
                $quota_end_time = intval($current_mansong_quota['end_time']);

                if($start_time < $quota_start_time) {
                    showDialog(sprintf(Language::get('mansong_add_start_time_explain'),date('Y-m-d',$current_mansong_quota['start_time'])));
                }
                if($end_time > $quota_end_time) {
                    showDialog(sprintf(Language::get('mansong_add_end_time_explain'),date('Y-m-d',$current_mansong_quota['end_time'])));
                }
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

            $param = array();
            $param['mansong_name'] = $mansong_name;
            $param['start_time'] = $start_time;
            $param['end_time'] = $end_time;
            $param['remark'] = trim($_POST['remark']);
            $param['cate_rule'] = $cate_rule;
            $param['store_cates'] = $store_cates;
            $param['diff_goods'] = $diff_goods;
            //add xin 20160112
            $param['mansong_type'] = (intval($_POST['mansong_type']) == 2)?'2':'1';
            //add end

            $mansong_res = $model_mansong->editMansong($param,array('mansong_id'=>$mansong_id,'store_id'=>$_SESSION['store_id']));
            if($mansong_res) {
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
                //删除原有规则
                Model('p_mansong_rule')->delMansongRule(array('mansong_id'=>$mansong_id));
                //生成规则
                $result = $model_mansong_rule->addMansongRuleArray($mansong_rule_array);

                $this->recordSellerLog('修改满即送活动，活动名称：'.$mansong_name);

                // 自动发布动态
                // mansong_name,start_time,end_time,store_id
                $data_array = array();
                $data_array['mansong_name'] = $param['mansong_name'];
                $data_array['start_time']   = $param['start_time'];
                $data_array['end_time']     = $param['end_time'];
                $data_array['store_id']     = $_SESSION['store_id'];
                $this->storeAutoShare($data_array, 'mansong');

                showDialog('满即送修改成功', urlShop('store_promotion_mansong', 'mansong_list'), 'succ');
            } else {
                showDialog('满即送修改失败');
            }
            exit;
        }

        Tpl::output('mansong_info', $mansong_info);
        if($mansong_info['diff_goods'] != ''){
            $goodsid_array = $mansong_info['diff_goods'];
            $b_goods_list = Model('goods')->getGoodsList(array('goods_id' => array('in', $goodsid_array)), 'goods_id,goods_price,goods_image,goods_name');
            Tpl::output('b_goods_list',$b_goods_list);
        }

        $param = array();
        $param['mansong_id'] = $mansong_id;
        $rule_list = $model_mansong_rule->getMansongRuleListByID($mansong_id);

        $store_goods_class = Model('store_goods_class')->getShowTreeList($_SESSION['store_id']);
        if(!empty($mansong_info['store_cates']) && !empty($store_goods_class)){
            $cates_des = array();
            foreach($store_goods_class as $k=>$v){
                $cates_des[$v['stc_id']]['id'] = $v['stc_id'];
                $cates_des[$v['stc_id']]['desc'] = $v['stc_name'];
                if(is_array($v['children'])){
                    foreach($v['children'] as $key=>$val){
                        $cates_des[$val['stc_id']]['id'] = $val['stc_id'];
                        $cates_des[$val['stc_id']]['desc'] = $v['stc_name'].' > '.$val['stc_name'];
                    }
                }
            }
            $store_cate_arr = explode(',',$mansong_info['store_cates']);
            Tpl::output('store_cate_arr',$store_cate_arr);
            Tpl::output('cates_des',$cates_des);
        }
        Tpl::output('show_own_class',$store_goods_class);


        Tpl::output('rule_list',$rule_list);
        self::profile_menu('mansong_update');
        Tpl::showpage('store_promotion_mansong.update');
    }

    /**
     * 满就送活动详细信息
     **/
    public function mansong_detailOp() {
        $mansong_id = intval($_GET['mansong_id']);

        $model_mansong = Model('p_mansong');
        $model_mansong_rule = Model('p_mansong_rule');

        $mansong_info = $model_mansong->getMansongInfoByID($mansong_id, $_SESSION['store_id']);
        if(empty($mansong_info)) {
            showDialog(L('param_error'));
        }
        Tpl::output('mansong_info', $mansong_info);

        $param = array();
        $param['mansong_id'] = $mansong_id;
        $rule_list = $model_mansong_rule->getMansongRuleListByID($mansong_id);
        Tpl::output('list',$rule_list);

        //输出导航
        self::profile_menu('mansong_detail');
        Tpl::showpage('store_promotion_mansong.detail');
    }

    /**
     * 满就送活动删除
     **/
    public function mansong_delOp() {
        $mansong_id = intval($_POST['mansong_id']);

        $model_mansong = Model('p_mansong');

        $mansong_info = $model_mansong->getMansongInfoByID($mansong_id, $_SESSION['store_id']);
        if(empty($mansong_info)) {
            showDialog(L('param_error'));
        }

        $condition = array();
        $condition['mansong_id'] = $mansong_id;
        $result = $model_mansong->delMansong($condition);

        if($result) {
            $this->recordSellerLog('删除满即送活动，活动名称：'.$mansong_rule['mansong_name']);
            showDialog(L('nc_common_op_succ'), urlShop('store_promotion_mansong', 'mansong_list'), 'succ');
        } else {
            showDialog(L('nc_common_op_fail'));
        }
    }

    /**
     * 满就送套餐购买
     **/
    public function mansong_quota_addOp() {
        self::profile_menu('mansong_quota_add');
        Tpl::showpage('store_promotion_mansong_quota.add');
    }

    /**
     * 满就送套餐购买保存
     **/
    public function mansong_quota_add_saveOp() {
        $mansong_quota_quantity = intval($_POST['mansong_quota_quantity']);

        if($mansong_quota_quantity <= 0 || $mansong_quota_quantity > 12) {
            showDialog(Language::get('mansong_quota_quantity_error'));
        }

        //获取当前价格
        $current_price = intval(C('promotion_mansong_price'));

        //获取该用户已有套餐
        $model_mansong_quota = Model('p_mansong_quota');
        $current_mansong_quota= $model_mansong_quota->getMansongQuotaCurrent($_SESSION['store_id']);
        $add_time = 86400 * 30 * $mansong_quota_quantity;
        if(empty($current_mansong_quota)) {
            //生成套餐
            $param = array();
            $param['member_id'] = $_SESSION['member_id'];
            $param['member_name'] = $_SESSION['member_name'];
            $param['store_id'] = $_SESSION['store_id'];
            $param['store_name'] = $_SESSION['store_name'];
            $param['start_time'] = TIMESTAMP;
            $param['end_time'] = TIMESTAMP + $add_time;
            $model_mansong_quota->addMansongQuota($param);
        } else {
            $param = array();
            $param['end_time'] = array('exp', 'end_time + ' . $add_time);
            $model_mansong_quota->editMansongQuota($param, array('quota_id' => $current_mansong_quota['quota_id']));
        }

        //记录店铺费用
        $this->recordStoreCost($current_price * $mansong_quota_quantity, '购买满即送');

        $this->recordSellerLog('购买'.$mansong_quota_quantity.'份满即送套餐，单价'.$current_price.$lang['nc_yuan']);

        showDialog(Language::get('mansong_quota_add_success'), urlShop('store_promotion_mansong', 'mansong_list'), 'succ');
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
        $goods_list = $model_goods->getGeneralGoodsList($condition, '*', 8);

        Tpl::output('goods_list', $goods_list);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::showpage('store_promotion_mansong.goods', 'null_layout');
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
        $where['store_id'] = $_SESSION['store_id'];
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
        $store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_SESSION['store_id'], 'stc_state' => '1'));
        Tpl::output('store_goods_class', $store_goods_class);

        Tpl::showpage('store_promotion_mansong.add_goods', 'null_layout');
    }


    /**
     * 用户中心右边，小导航
     *
     * @param string	$menu_type	导航类型
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    private function profile_menu($menu_key='') {
        $menu_array = array(
            1=>array('menu_key'=>'mansong_list','menu_name'=>Language::get('promotion_active_list'),'menu_url'=>urlShop('store_promotion_mansong', 'mansong_list')),
        );
        switch ($menu_key){
        	case 'mansong_add':
                $menu_array[] = array('menu_key'=>'mansong_add','menu_name'=>Language::get('promotion_join_active'),'menu_url'=>urlShop('store_promotion_mansong', 'mansong_add'));
        		break;
            case 'mansong_update':
                $menu_array[] = array('menu_key'=>'mansong_update','menu_name'=>'活动修改','menu_url'=>urlShop('store_promotion_mansong', 'mansong_update'));
                break;
        	case 'mansong_quota_add':
                $menu_array[] = array('menu_key'=>'mansong_quota_add','menu_name'=>Language::get('promotion_buy_product'),'menu_url'=>urlShop('store_promotion_mansong', 'mansong_quota_add'));
        		break;
        	case 'mansong_detail':
                $menu_array[] = array('menu_key'=>'mansong_detail','menu_name'=>Language::get('mansong_active_content'),'menu_url'=>urlShop('store_promotion_mansong', 'mansong_detail', array('mansong_id' => $_GET['mansong_id'])));
        		break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }

}
