<?php
/**
 * 招商入驻选择
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_store_joininControl extends mobileMemberControl{

    private $xieyi_type;    //   个人  OR   企业

	public function __construct(){
		parent::__construct();
        $this->xieyi_type = trim($_GET['type'])?trim($_GET['type']):'';
	}

    /**
     * 招商入驻选择
     */
    public function indexOp() {

        Tpl::output('html_title','招商入驻');

        $model_store_joinin = Model('store_joinin');

        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_SESSION['member_id']));

        if(!empty($joinin_detail)){

            switch (intval($joinin_detail['joinin_state'])) {
                case STORE_JOIN_STATE_NEW:
                    Tpl::output('store_success','入驻申请已经提交，请等待管理员审核');
                    Tpl::showpage('member_store.success');
                    break;
                case STORE_JOIN_STATE_PAY:
                    Tpl::output('store_success','已经提交，请等待管理员核对后为您开通店铺');
                    Tpl::showpage('member_store.success');
                    break;
                case STORE_JOIN_STATE_VERIFY_SUCCESS:
                    Tpl::output('store_success','审核成功，请等待管理员为您开通店铺');
                    Tpl::showpage('member_store.success');
                    break;
                case STORE_JOIN_STATE_VERIFY_FAIL:
                    Tpl::output('store_success','审核失败');
                    Tpl::showpage('member_store.success');
                    break;
                case STORE_JOIN_STATE_PAY_FAIL:
                    Tpl::output('store_success','付款审核失败:'.$joinin_detail['joinin_message']);
                    Tpl::showpage('member_store.success');
                    break;
                case STORE_JOIN_STATE_FINAL:
                    Tpl::output('store_success','店铺开通成功');
                    Tpl::showpage('member_store.success');
                    break;

                default:

                    Tpl::showpage('member_store.xieyi');
                    break;
            }

        }else{

            Tpl::showpage('member_store.xieyi');
        }
    }


    /**
     * 第一步、店铺、联系人信息
     *
     */
    public function singleOp() {

        //第一步、店铺、联系人信息

        //第二步、财务信息

        //第三步、店铺经营信息

        Tpl::output('html_title','个人入驻');

        /*省*/

        Tpl::output('prov',$this->area_listOp());

        Tpl::showpage('member_store.single');

    }

    /**
     * 第一步数据验证、保存
     *
     */
    public function single_saveOp() {

        $result = chksubmit(true,false,'num');

        if($result === true){

            $param = array();
            $param['member_name'] = $_SESSION['member_name'];   
            $param['company_name'] = $_POST['company_name'];
            $param['company_address'] = $_POST['company_address'];
            $param['company_address_detail'] = $_POST['company_address_detail'];
            $param['contacts_name'] = $_POST['contacts_name'];
            $param['contacts_phone'] = $_POST['contacts_phone'];
            $param['contacts_email'] = $_POST['contacts_email'];
            $param['business_licence_number'] = $_POST['business_licence_number'];
            $param['business_sphere'] = $_POST['business_sphere'];
            $param['business_licence_number_electronic'] = $this->upload_image('business_licence_number_electronic');

            $this->step2_save_valid($param);

            $model_store_joinin = Model('store_joinin');

            $joinin_info = $model_store_joinin->getOne(array('member_id' => $_SESSION['member_id']));

            if(empty($joinin_info)) {

                $param['member_id'] = $_SESSION['member_id'];   
                $param['add_time'] = time(); 
                $model_store_joinin->save($param);

                redirect(urlWap('member_store_joinin','single_2'));

            } else {

                $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

                redirect(urlWap('member_store_joinin','single_2'));
            }

        }else{
            showWapMessage('数据异常！重新提交');
        }
    }


    /**
     * 个人入驻 - 第二步、财务信息
     */
    public function single_2Op(){

        Tpl::output('html_title','个人入驻-财务资质信息');

        Tpl::showpage('member_store.single_2');
    }


    /**
     * 个人入驻 - 第二步、数据验证、保存
     */
    public function single_2_saveOp(){

        $result = chksubmit(true,false,'num');

        if($result === true){
            $param = array();
            $param['bank_account_name'] = $_POST['bank_account_name'];
            $param['bank_account_number'] = $_POST['bank_account_number'];
            $param['bank_name'] = $_POST['bank_name'];
            $param['bank_code'] = '1';//$_POST['bank_code'];
            $param['bank_address'] = $_POST['bank_address'];

            $param['is_settlement_account'] = 1;
            $param['settlement_bank_account_name'] = $_POST['bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['bank_account_number'];
            $param['settlement_bank_name'] = $_POST['bank_name'];
            $param['settlement_bank_code'] = '1';//$_POST['bank_code'];
            $param['settlement_bank_address'] = $_POST['bank_address'];
            $param['tax_registration_certificate'] = '';//$_POST['tax_registration_certificate'];
            $param['taxpayer_id'] = '';//$_POST['taxpayer_id'];
            $param['tax_registration_certificate_electronic'] = '';//$this->upload_image('tax_registration_certificate_electronic');

            $this->step3_save_valid($param);

            $model_store_joinin = Model('store_joinin');
            $res = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

            if($res){
                redirect(urlWap('member_store_joinin','single_3'));
            }else{
                redirect(urlWap('member_store_joinin','single_2'));
            }

        }else{
            showWapMessage('数据异常！重新提交');
        }
    }





    /**
     * 个人入驻 - 第三步、店铺经营信息
     */
    public function single_3Op(){


        // //商品分类
        // $gc = Model('goods_class');
        // $gc_list    = $gc->getGoodsClassListByParentId(0);
        // Tpl::output('gc_list',$gc_list);


        // //店铺等级
        // $grade_list = rkcache('store_grade',true);


        // //附加功能
        // if(!empty($grade_list) && is_array($grade_list)){
        //     foreach($grade_list as $key=>$grade){
        //         $sg_function = explode('|',$grade['sg_function']);
        //         if (!empty($sg_function[0]) && is_array($sg_function)){
        //             foreach ($sg_function as $key1=>$value){
        //                 if ($value == 'editor_multimedia'){
        //                     $grade_list[$key]['function_str'] .= '富文本编辑器';
        //                 }
        //             }
        //         }else {
        //             $grade_list[$key]['function_str'] = '无';
        //         }
        //     }
        // }
        // Tpl::output('grade_list', $grade_list);



        //  //店铺分类
        // $model_store = Model('store_class');
        // $store_class = $model_store->getStoreClassList(array(),'',false);
        // Tpl::output('store_class', $store_class);


        Tpl::output('html_title','个人入驻-财务资质信息');
        Tpl::showpage('member_store.single_3');
    }

    /**
     * 个人入驻 - 第三步、数据验证、保存
     */
    public function single_3_saveOp(){

        $result = chksubmit(true,false,'num');

        if($result === true){

            // $store_class_ids = array();
            // $store_class_names = array();

            // if(!empty($_POST['store_class_ids'])) {
            //     foreach ($_POST['store_class_ids'] as $value) {
            //         $store_class_ids[] = $value;
            //     }
            // }

            // if(!empty($_POST['store_class_names'])) {
            //     foreach ($_POST['store_class_names'] as $value) {
            //         $store_class_names[] = $value;
            //     }
            // }

            $param = array();
            $param['seller_name'] = $_POST['seller_name'];
            $param['store_name'] = $_POST['store_name'];
            // $param['store_class_ids'] = serialize($store_class_ids);
            // $param['store_class_names'] = serialize($store_class_names);
            // $param['sg_name'] = $_POST['sg_name'];
            // $param['sg_id'] = $_POST['sg_id'];
            // $param['sc_name'] = $_POST['sc_name'];
            // $param['sc_id'] = $_POST['sc_id'];
            $param['joinin_state'] = STORE_JOIN_STATE_NEW;

            $this->step4_save_valid($param);

            $model_store_joinin = Model('store_joinin');
            $res = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

            if($res){
                redirect(urlWap('member_store_joinin','index'));
            }else{
                redirect(urlWap('member_store_joinin','single_3'));
            }

        }else{

            showWapMessage('数据异常！重新提交','','error');

        }
    }










    /**
     * 商家入驻
     */
    public function storeOp() {

        Tpl::output('html_title','商家入驻');


        Tpl::showpage('member_store.store');
    }


    /**
     * 商家入驻     第一步数据验证、保存
     *
     */
    public function store_saveOp() {

        $result = chksubmit(true,false,'num');

        if($result === true){

            $param = array();
            $param['member_name'] = $_SESSION['member_name'];
            $param['company_name'] = $_POST['company_name'];
            $param['company_province_id'] = intval($_POST['province_id']);
            $param['company_address'] = $_POST['company_address'];
            $param['company_address_detail'] = $_POST['company_address_detail'];
            $param['company_phone'] = $_POST['company_phone'];
            // $param['company_employee_count'] = intval($_POST['company_employee_count']);
            $param['company_registered_capital'] = intval($_POST['company_registered_capital']);
            $param['contacts_name'] = $_POST['contacts_name'];
            $param['contacts_phone'] = $_POST['contacts_phone'];
            $param['contacts_email'] = $_POST['contacts_email'];
            $param['business_licence_number'] = $_POST['business_licence_number'];
            $param['business_licence_address'] = $_POST['business_licence_address'];
            $param['business_licence_start'] = $_POST['business_licence_start'];
            $param['business_licence_end'] = $_POST['business_licence_end'];
            $param['business_sphere'] = $_POST['business_sphere'];
            $param['business_licence_number_electronic'] = $this->upload_image('business_licence_number_electronic');
            $param['organization_code'] = '';
            $param['business_legal_person_img'] = $this->upload_image('business_legal_person_img');
            $param['organization_code_electronic'] = '';
            $param['general_taxpayer'] = $this->upload_image('general_taxpayer');

            $this->step2_save_valid_store($param);

            $model_store_joinin = Model('store_joinin');
            $joinin_info = $model_store_joinin->getOne(array('member_id' => $_SESSION['member_id']));
            if(empty($joinin_info)) {
                $param['member_id'] = $_SESSION['member_id'];
                $param['add_time'] = time(); 

                $res = $model_store_joinin->save($param);
            } else {
                $res = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));
            }

            if($res){
                redirect(urlWap('member_store_joinin','store_2'));
            }else{
                redirect(urlWap('member_store_joinin','store'));
            }

        }else{
            showWapMessage('数据异常！重新提交','','error');
        }
    }



    /**
     * 商家入驻 - 第二步、财务信息
     */
    public function store_2Op(){

        Tpl::output('html_title','商家入驻-财务资质信息');

        Tpl::showpage('member_store.store_2');
    }

    /**
     * 商家入驻 - 第二步、数据验证、保存
     */
    public function store_2_saveOp(){

        $result = chksubmit(true,false,'num');

        if($result === true){

            $param = array();
            $param['bank_account_name'] = $_POST['bank_account_name'];
            $param['bank_account_number'] = $_POST['bank_account_number'];
            $param['bank_name'] = $_POST['bank_name'];
            $param['bank_code'] = '1';//$_POST['bank_code'];
            $param['bank_address'] = $_POST['bank_address'];
            $param['bank_licence_electronic'] = $this->upload_image('bank_licence_electronic');


            $param['is_settlement_account'] = 1;
            $param['settlement_bank_account_name'] = $_POST['bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['bank_account_number'];
            $param['settlement_bank_name'] = $_POST['bank_name'];
            $param['settlement_bank_code'] = '1';//$_POST['bank_code'];
            $param['settlement_bank_address'] = $_POST['bank_address'];

            $param['tax_registration_certificate'] = '';//$_POST['tax_registration_certificate'];
            $param['taxpayer_id'] = '';//$_POST['taxpayer_id'];
            $param['tax_registration_certificate_electronic'] = '';//$this->upload_image('tax_registration_certificate_electronic');


            $this->step3_save_valid_store($param);

            $model_store_joinin = Model('store_joinin');

            $res = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

            if($res){
                redirect(urlWap('member_store_joinin','store_3'));
            }else{
                redirect(urlWap('member_store_joinin','store_2'));
            }

        }else{
            showWapMessage('数据异常！重新提交','','error');
        }
        
    }


    /**
     * 商家入驻 - 第三步、店铺经营信息
     */
    public function store_3Op(){

        //商品分类
        // $gc = Model('goods_class');
        // $gc_list    = $gc->getGoodsClassListByParentId(0);
        // Tpl::output('gc_list',$gc_list);

        // //店铺等级
        // $grade_list = rkcache('store_grade',true);
        // //附加功能
        // if(!empty($grade_list) && is_array($grade_list)){
        //     foreach($grade_list as $key=>$grade){
        //         $sg_function = explode('|',$grade['sg_function']);
        //         if (!empty($sg_function[0]) && is_array($sg_function)){
        //             foreach ($sg_function as $key1=>$value){
        //                 if ($value == 'editor_multimedia'){
        //                     $grade_list[$key]['function_str'] .= '富文本编辑器';
        //                 }
        //             }
        //         }else {
        //             $grade_list[$key]['function_str'] = '无';
        //         }
        //     }
        // }
        // Tpl::output('grade_list', $grade_list);

        // //店铺分类
        // $model_store = Model('store_class');
        // $store_class = $model_store->getStoreClassList(array(),'',false);
        // Tpl::output('store_class', $store_class);

        Tpl::output('html_title','商家入驻-店铺经营信息');

        Tpl::showpage('member_store.store_3');
    }

    /**
     * 商家入驻 - 第三步、数据验证、保存
     */
    public function store_3_saveOp(){

        $result = chksubmit(true,false,'num');

        if($result === true){
            // $store_class_ids = array();
            // $store_class_names = array();
            // if(!empty($_POST['store_class_ids'])) {
            //     foreach ($_POST['store_class_ids'] as $value) {
            //         $store_class_ids[] = $value;
            //     }
            // }
            // if(!empty($_POST['store_class_names'])) {
            //     foreach ($_POST['store_class_names'] as $value) {
            //         $store_class_names[] = $value;
            //     }
            // }
            // //取最小级分类最新分佣比例
            // $sc_ids = array();
            // foreach ($store_class_ids as $v) {
            //     $v = explode(',',trim($v,','));
            //     if (!empty($v) && is_array($v)) {
            //         $sc_ids[] = end($v);
            //     }
            // }
            // if (!empty($sc_ids)) {
            //     $store_class_commis_rates = array();
            //     $goods_class_list = Model('goods_class')->getGoodsClassListByIds($sc_ids);
            //     if (!empty($goods_class_list) && is_array($goods_class_list)) {
            //         $sc_ids = array();
            //         foreach ($goods_class_list as $v) {
            //             $store_class_commis_rates[] = $v['commis_rate'];
            //         }
            //     }
            // }
            $param = array();
            $param['seller_name'] = $_POST['seller_name'];
            $param['store_name'] = $_POST['store_name'];
            // $param['store_class_ids'] = serialize($store_class_ids);
            // $param['store_class_names'] = serialize($store_class_names);
            // $param['joinin_year'] = intval($_POST['joinin_year']);
            $param['joinin_state'] = STORE_JOIN_STATE_NEW;
            // $param['store_class_commis_rates'] = implode(',', $store_class_commis_rates);

            //取店铺等级信息
            // $grade_list = rkcache('store_grade',true);
            // if (!empty($grade_list[$_POST['sg_id']])) {
            //     $param['sg_id'] = $_POST['sg_id'];
            //     $param['sg_name'] = $grade_list[$_POST['sg_id']]['sg_name'];
            //     $param['sg_info'] = serialize(array('sg_price' => $grade_list[$_POST['sg_id']]['sg_price']));
            // }

            // //取最新店铺分类信息
            // $store_class_info = Model('store_class')->getStoreClassInfo(array('sc_id'=>intval($_POST['sc_id'])));
            // if ($store_class_info) {
            //     $param['sc_id'] = $store_class_info['sc_id'];
            //     $param['sc_name'] = $store_class_info['sc_name'];
            //     $param['sc_bail'] = $store_class_info['sc_bail'];
            // }

            // //店铺应付款
            // $param['paying_amount'] = floatval($grade_list[$_POST['sg_id']]['sg_price'])*$param['joinin_year']+floatval($param['sc_bail']);

            $this->step4_save_valid_store($param);

            $model_store_joinin = Model('store_joinin');
            $res = $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

            if($res){
                redirect(urlWap('member_store_joinin','index'));
            }else{
                redirect(urlWap('member_store_joinin','store_3'));
            }

        }else{

            showWapMessage('数据异常！重新提交','','error');

        }
            
    }








/**





*/


    /**
     * 地区列表
     */
    public function area_listOp() {
        $area_id = intval($_POST['area_id']);

        $model_area = Model('area');

        $condition = array();
        if($area_id > 0) {
            $condition['area_parent_id'] = $area_id;
        } else {
            $condition['area_deep'] = 1;
        }
        $area_list = $model_area->getAreaList($condition, 'area_id,area_name');

        
        if($area_id > 0) {
            output_data(array('area_list' => $area_list));
        } else {
            return array('area_list' => $area_list);
        }
    }


    /* 个人入驻、第一步数据验证 */

    private function step2_save_valid($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['company_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"店铺名称不能为空且必须小于50个字"),
            array("input"=>$param['company_address'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"所在地不能为空且必须小于50个字"),
            array("input"=>$param['company_address_detail'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"详细地址不能为空且必须小于50个字"),
            array("input"=>$param['contacts_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人姓名不能为空且必须小于20个字"),
            array("input"=>$param['contacts_phone'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人电话不能为空"),
            array("input"=>$param['contacts_email'], "require"=>"true","validator"=>"email","message"=>"电子邮箱不能为空"),
            array("input"=>$param['business_licence_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"身份证号不能为空且必须小于20个字"),
            array("input"=>$param['business_sphere'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"500","message"=>"姓名不能为空且必须小于50个字"),
            array("input"=>$param['business_licence_number_electronic'], "require"=>"true","message"=>"身份证扫描件不能为空"),
        );
        $error = $obj_validate->validate();

        if ($error != ''){
            showWapMessage($error);
        }

    }


    /* 个人入驻、第二步数据验证 */

    private function step3_save_valid($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['bank_account_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"银行开户名不能为空且必须小于50个字"),
            array("input"=>$param['bank_account_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"25","message"=>"银行账号不能为空且必须小于25个字"),
            array("input"=>$param['bank_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"开户银行支行名称不能为空且必须小于50个字"),
            //array("input"=>$param['bank_code'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"支行联行号不能为空且必须小于20个字"),
            array("input"=>$param['bank_address'], "require"=>"true","开户行所在地不能为空"),
            array("input"=>$param['settlement_bank_account_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"银行开户名不能为空且必须小于50个字"),
            array("input"=>$param['settlement_bank_account_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"25","message"=>"银行账号不能为空且必须小于25个字"),
            array("input"=>$param['settlement_bank_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"开户银行支行名称不能为空且必须小于50个字"),
            //array("input"=>$param['settlement_bank_code'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"支行联行号不能为空且必须小于20个字"),
            array("input"=>$param['settlement_bank_address'], "require"=>"true","开户行所在地不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error);
        }
    }

    /* 个人入驻、第三步数据验证 */

    private function step4_save_valid($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['store_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"店铺名称不能为空且必须小于50个字"),
            // array("input"=>$param['sg_id'], "require"=>"true","message"=>"店铺等级不能为空"),
            // array("input"=>$param['sc_id'], "require"=>"true","message"=>"店铺分类不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error);
        }
    }


    /* 商家入驻、第一步数据验证 */

    private function step2_save_valid_store($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['company_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"公司名称不能为空且必须小于50个字"),
            array("input"=>$param['company_address'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"公司地址不能为空且必须小于50个字"),
            array("input"=>$param['company_address_detail'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"公司详细地址不能为空且必须小于50个字"),
            array("input"=>$param['company_phone'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"公司电话不能为空"),
            // array("input"=>$input['company_employee_count'], "require"=>"true","validator"=>"Number","员工总数不能为空且必须是数字"),
            array("input"=>$input['company_registered_capital'], "require"=>"true","validator"=>"Number","注册资金不能为空且必须是数字"),
            array("input"=>$param['contacts_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人姓名不能为空且必须小于20个字"),
            array("input"=>$param['contacts_phone'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人电话不能为空"),
            array("input"=>$param['contacts_email'], "require"=>"true","validator"=>"email","message"=>"电子邮箱不能为空"),
            array("input"=>$param['business_licence_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"营业执照号不能为空且必须小于20个字"),
            array("input"=>$param['business_licence_address'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"营业执照所在地不能为空且必须小于50个字"),
            array("input"=>$param['business_licence_start'], "require"=>"true","message"=>"营业执照有效期不能为空"),
            array("input"=>$param['business_licence_end'], "require"=>"true","message"=>"营业执照有效期不能为空"),
            array("input"=>$param['business_sphere'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"500","message"=>"法定经营范围不能为空且必须小于50个字"),
            array("input"=>$param['business_licence_number_electronic'], "require"=>"true","message"=>"营业执照电子版不能为空"),
            // array("input"=>$param['organization_code'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"组织机构代码不能为空且必须小于20个字"),
            array("input"=>$param['business_legal_person_img'], "require"=>"true","message"=>"法人身份证不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error);
        }
    }


    /* 商家入驻、第二步数据验证 */

    private function step3_save_valid_store($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['bank_account_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"银行开户名不能为空且必须小于50个字"),
            array("input"=>$param['bank_account_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"25","message"=>"银行账号不能为空且必须小于25个字"),
            array("input"=>$param['bank_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"开户银行支行名称不能为空且必须小于50个字"),
            //array("input"=>$param['bank_code'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"支行联行号不能为空且必须小于20个字"),
            array("input"=>$param['bank_address'], "require"=>"true","开户行所在地不能为空"),
            array("input"=>$param['bank_licence_electronic'], "require"=>"true","开户银行许可证电子版不能为空"),
            array("input"=>$param['settlement_bank_account_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"银行开户名不能为空且必须小于50个字"),
            array("input"=>$param['settlement_bank_account_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"25","message"=>"银行账号不能为空且必须小于25个字"),
            array("input"=>$param['settlement_bank_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"开户银行支行名称不能为空且必须小于50个字"),
            //array("input"=>$param['settlement_bank_code'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"支行联行号不能为空且必须小于20个字"),
            array("input"=>$param['settlement_bank_address'], "require"=>"true","开户行所在地不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error);
        }
    }


    /* 商家入驻、第三步数据验证 */

    private function step4_save_valid_store($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$param['store_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"店铺名称不能为空且必须小于50个字"),
            // array("input"=>$param['sg_id'], "require"=>"true","message"=>"店铺等级不能为空"),
            // array("input"=>$param['sc_id'], "require"=>"true","message"=>"店铺分类不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error);
        }
    }




    /*  上传图片  */

    private function upload_image($file) {
        $pic_name = '';
        $upload = new UploadFile();
        $uploaddir = ATTACH_PATH.DS.'store_joinin'.DS;
        $upload->set('default_dir',$uploaddir);
        $upload->set('allow_type',array('jpg','jpeg','gif','png'));
        if (!empty($_FILES[$file]['name'])){
            $result = $upload->upfile($file);
            if ($result){
                $pic_name = $upload->file_name;
                $upload->file_name = '';
            }
        }
        return $pic_name;
    }


	/**
	 * 检查店铺名称是否存在
	 *
	 * @param
	 * @return
	 */
	public function checknameOp() {
		/**
		 * 实例化卖家模型
		 */
		$model_store	= Model('store');
		$store_name = $_GET['company_name'];
		$store_info = $model_store->getStoreInfo(array('store_name'=>$store_name));
		if(!empty($store_info['store_name']) && $store_info['member_id'] != $_SESSION['member_id']) {
			echo 'false';
		} else {
			echo 'true';
		}
	}


}