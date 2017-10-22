<?php
/**
 * 会员中心——地址管理
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_ressControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 地址列表
     */
    public function ress_listOp() {

        $model_address = Model('address');

        $address_list = $model_address->getAddressList(array('member_id'=>$_SESSION['member_id']));

        Tpl::output('address_list',$address_list);

        Tpl::output('html_title','地址列表 - 会员中心 - 收藏天下');

        Tpl::output('nav_title','地址列表');

        Tpl::showpage('member_ress.list');
    }

    /**
     * 地址详细信息
     */
    public function ress_infoOp() {
        if(chksubmit()){
        /*编辑保存*/

           $address_id = intval($_POST['address_id']);

            $model_address = Model('address');

            //验证地址是否为本人
            $address_info = $model_address->getOneAddress($address_id);

            if ($address_info['member_id'] != $_SESSION['member_id']) {

                showWapMessage('参数错误','','error');
            }

            $address_info = $this->_address_valid();

            $result = $model_address->editAddress($address_info, array('address_id' => $address_id));
            if($result) {

                showWapMessage('修改成功',urlWap('member_ress','ress_list'));

            } else {

                showWapMessage('保存失败','','error');

            }


        }else{
        /*详情*/
            $address_id = intval($_GET['address_id']);

            $model_address = Model('address');

            $condition = array();

            $condition['address_id'] = $address_id;

            $address_info = $model_address->getAddressInfo($condition);

            if(!empty($address_id) && $address_info['member_id'] == $_SESSION['member_id']) {

                /*省*/
                Tpl::output('prov',$this->area_listOp());

                Tpl::output('address_info',$address_info);

                Tpl::output('nav_title','编辑地址');
                Tpl::output('html_title','编辑地址 - '.C('site_name'));

                Tpl::showpage('member_ress.edit');

            } else {

                showWapMessage('地址不存在','','error');

            }
        }
    }


    /**
     * 添加地址
     */
    public function ress_addOp() {

        if(chksubmit()){

        $model_address = Model('address');

        $address_info = $this->_address_valid();

        $result = $model_address->addAddress($address_info);
        if($result) {
            showWapMessage('保存成功',urlWap('member_ress','ress_list'),'error');
        } else {
            showWapMessage('保存失败','','error');
        }


        }else{

        /*省*/
        Tpl::output('prov',$this->area_listOp());

            Tpl::output('nav_title','添加地址');
            Tpl::output('html_title','添加地址 - '.C('site_name'));

        Tpl::showpage('member_ress.add');

        }

    }

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

    /**
     * 删除地址
     */
    public function address_delOp() {
        $address_id = intval($_GET['address_id']);

        $model_address = Model('address');

        $condition = array();

        $condition['address_id'] = $address_id;

        $condition['member_id'] = $_SESSION['member_id'];

        $model_address->delAddress($condition);

        redirect(urlWap('member_ress','ress_list'));
    }


    /**
     * 验证地址数据
     */
    private function _address_valid() {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$_POST["true_name"],"require"=>"true","message"=>'姓名不能为空'),
            array("input"=>$_POST["area_info"],"require"=>"true","message"=>'地区不能为空'),
            array("input"=>$_POST["address"],"require"=>"true","message"=>'地址不能为空'),
            array("input"=>$_POST["mob_phone"],"require"=>"true","validator"=>"mobile","message"=>'手机格式不正确'),
            array("input"=>$_POST['tel_phone'].$_POST['mob_phone'],'require'=>'true','message'=>'联系方式不能为空')
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error,'','error');
        }

        $data = array();
        $data['member_id'] = $_SESSION['member_id'];
        $data['true_name'] = $_POST['true_name'];
        $data['area_id'] = intval($_POST['region'])?intval($_POST['region']):intval($_POST['area_id']);
        $data['city_id'] = intval($_POST['city'])?intval($_POST['city']):intval($_POST['city_id']);
        $data['area_info'] = $_POST['area_info'];
        $data['address'] = $_POST['address'];
        $data['tel_phone'] = $_POST['tel_phone'];
        $data['mob_phone'] = $_POST['mob_phone'];
        return $data;
    }


}
