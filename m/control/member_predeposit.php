<?php
/**
 * 会员中心 —— 账户余额
 *
***/


defined('InShopNC') or exit('Access Invalid!');

class member_predepositControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}


    /*拍卖惠首页*/

    public function indexOp(){

        switch (intval($_GET['type'])) {
            case '1':
                $this->balance();
                Tpl::output('type',1);
                break;
            case '2':
                $this->chongzhi();
                Tpl::output('type',2);
                break;
            case '3':
                $this->tixian();
                Tpl::output('type',3);
                break;
            default:
                $this->balance();
                Tpl::output('type',1);
                break;
        }

        Tpl::output('html_title','账户余额');

        Tpl::showpage('member_predeposit_index');
    }


    /*帐户余额*/
    private function balance(){

        $model_pd = Model('predeposit');

        $condition = array();
        $condition['lg_member_id'] = $_SESSION['member_id'];
        $list = $model_pd->getPdLogList($condition,10,'*','lg_id desc');
        
        Tpl::output('show_page',$model_pd->showpage(88));
        Tpl::output('list',$list);
    }

    /*充值明细*/
    private function chongzhi(){
        $condition = array();
        $condition['pdr_member_id'] = $_SESSION['member_id'];

        $model_pd = Model('predeposit');
        $list = $model_pd->getPdRechargeList($condition,10,'*','pdr_id desc');

        Tpl::output('list',$list);
        Tpl::output('show_page',$model_pd->showpage(88));

    }

    /*提现明细*/
    private function tixian(){
        $condition = array();
        $condition['pdc_member_id'] =  $_SESSION['member_id'];

        $model_pd = Model('predeposit');
        $cash_list = $model_pd->getPdCashList($condition,10,'*','pdc_id desc');

        Tpl::output('list',$cash_list);
        Tpl::output('show_page',$model_pd->showpage(88));
    }


    public function recharge_delOp(){
        $pdr_id = intval($_GET["id"]);
        if ($pdr_id <= 0){
            showWapMessage('数据异常！','','error');
        }

        $model_pd = Model('predeposit');
        $condition = array();
        $condition['pdr_member_id'] = $_SESSION['member_id'];
        $condition['pdr_id'] = $pdr_id;
        $condition['pdr_payment_state'] = 0;
        $result = $model_pd->delPdRecharge($condition);
        if ($result){
            showWapMessage('操作成功！','','succ');
        }else {
            showWapMessage('操作失败！','','error');
        }
        
    }



    /*提现申请*/
    public function tixianOp(){

        if(chksubmit(true)){

            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
                array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
            );

            $error = $obj_validate->validate();
            if ($error != ''){
                showWapMessage($error,'','error');
                exit();
            }


            $member_info = $this->getMemberAndGradeInfo(true);

            $_POST["mobile"] = $member_info['member_mobile'];

            if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $member_info['member_mobile'])){
                showWapMessage('验证码不正确或已过期！','','error');
                exit();
            }


            $_SESSION['m_tixian_true'] = true;

            $url = urlWap('member_predeposit','tixian_info');

            redirect($url);

        }

        $_SESSION['m_tixian_true'] = false;
        $_SESSION['push_phone_yzm'] = '';

        Tpl::output('html_title','申请提现');
        Tpl::showpage('member_predeposit_tixian');
    }

    /*确认提现 - 并且提交提现信息*/
    public function tixian_infoOp(){

        if($_SESSION['m_tixian_true'] != true){
            showWapMessage('未通过手机验证码认证！','index.php?act=member_predeposit&op=index','error');
        }

        if (chksubmit(true)){
            $obj_validate = new Validate();
            $pdc_amount = abs(floatval($_POST['pdc_amount']));
            $validate_arr[] = array("input"=>$pdc_amount, "require"=>"true",'validator'=>'Compare','operator'=>'>=',"to"=>'0.01',"message"=>'提现金额不能为空！');
            $validate_arr[] = array("input"=>$_POST["pdc_bank_name"], "require"=>"true","message"=>'收款银行不能为空！');
            $validate_arr[] = array("input"=>$_POST["pdc_bank_no"], "require"=>"true","message"=>'收款帐号不能为空！');
            $validate_arr[] = array("input"=>$_POST["pdc_bank_user"], "require"=>"true","message"=>'开户人姓名不能为空！');
            $validate_arr[] = array("input"=>$_POST["password"], "require"=>"true","message"=>'请输入支付密码！');
            $obj_validate->validateparam = $validate_arr;
            $error = $obj_validate->validate();
            if ($error != ''){
                showWapMessage($error,'','error');
            }

            $model_pd = Model('predeposit');
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
            //验证支付密码
            if (md5($_POST['password']) != $member_info['member_paypwd']) {
                showWapMessage('支付密码错误','','error');
            }
            //验证金额是否足够
            if (floatval($member_info['available_predeposit']) < $pdc_amount){
                showWapMessage('金额不足以提现！','index.php?act=member_predeposit&op=index','error');
            }
            try {
                $model_pd->beginTransaction();
                $pdc_sn = $model_pd->makeSn();
                $data = array();
                $data['pdc_sn'] = $pdc_sn;
                $data['pdc_member_id'] = $_SESSION['member_id'];
                $data['pdc_member_name'] = $_SESSION['member_name'];
                $data['pdc_amount'] = $pdc_amount;
                $data['pdc_bank_name'] = $_POST['pdc_bank_name'];
                $data['pdc_bank_no'] = $_POST['pdc_bank_no'];
                $data['pdc_bank_user'] = $_POST['pdc_bank_user'];
                $data['pdc_add_time'] = TIMESTAMP;
                $data['pdc_payment_state'] = 0;
                $insert = $model_pd->addPdCash($data);
                if (!$insert) {
                    throw new Exception('操作失败！');
                }
                //冻结可用预存款
                $data = array();
                $data['member_id'] = $member_info['member_id'];
                $data['member_name'] = $member_info['member_name'];
                $data['amount'] = $pdc_amount;
                $data['order_sn'] = $pdc_sn;
                $model_pd->changePd('cash_apply',$data);
                $model_pd->commit();
                $_SESSION['m_tixian_true'] = false;
                $_SESSION['push_phone_yzm'] = '';
                showWapMessage('提现成功！','index.php?act=member_predeposit&op=index','succ');
            } catch (Exception $e) {
                $model_pd->rollback();
                showWapMessage($e->getMessage(),'index.php?act=member_predeposit&op=index','error');
            }
        }

        Tpl::showpage('member_predeposit_tixianinfo');

    }


     /* 获取手机验证码One*/
    public function getOnePhoneYzmOp(){

        $member_info = $this->getMemberAndGradeInfo(true);

        $_POST["mobile"] = $member_info['member_mobile'];

        if(empty($_POST["mobile"])){
            exit;
        }

        if(strlen($_POST['mobile']) != 11){
            $result['state'] = false;
            $result['msg'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
        }

        if(!preg_match("/1\d{10}$/",$_POST['mobile'])){
            $result['state'] = false;
            $result['msg'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
        }

        if($_SESSION['push_yzm']+60 > time()){
            $result['state'] = false;
            $result['msg'] = '刚已获取过验证码、请稍候再获取！';
            echo json_encode($result);
            exit();
        }


        $sms = new Sms();

        $_SESSION['push_phone_yzm'] = mt_rand('1111','9999');

        $_SESSION['push_phone'] = $_POST["mobile"];

        $result = $sms->send($_POST["mobile"],$_SESSION['push_phone_yzm']);

        echo json_encode($result);

        $_SESSION['push_yzm'] = time();

        exit();
    }

}
