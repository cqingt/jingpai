<?php
/**
 * 会员中心——充值
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_payControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 充值页面
     */
    public function indexOp() {

        Tpl::output('pay_list',$this->payListOp());

        Tpl::output('no_footer',true);

        Tpl::output('html_title','账户充值 - 会员中心 - 收藏天下');

        Tpl::showpage('member_pay.index');
    }


    /**
     * 获取可用的支付列表
     */
    private function payListOp(){

        $model_mb_payment = Model('mb_payment');

        $condition['payment_state'] = '1';

        $payment_list = $model_mb_payment->getMbPaymentOpenList($condition);

        return $payment_list;

    }



    /**
     * 提交支付
     */
    public function addZhiFuOp(){

        $p_id = intval($_GET['p_id']); //支付方式id

        $pdr_amount = abs(floatval($_GET['amount']));//充值金额

        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$p_id,"require"=>"true","message"=>'支付方式不能为空'),
            array("input"=>$pdr_amount,"require"=>"true","message"=>'充值金额不能为空'),
            array("input"=>$pdr_amount,"require"=>"true","operator"=>"!=","to"=>"0","message"=>'充值金额必须大于0')
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error,'','error');
        }

        $model_mb_payment = Model('mb_payment');

        $condition = array();

        $condition['payment_id'] = $p_id;

        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);

        if(!$mb_payment_info) {

            showWapMessage('系统不支持选定的支付方式','','error');

        }


        $model_pdr = Model('predeposit');
        $data = array();
        $data['pdr_sn'] = $pay_sn = $model_pdr->makeSn();
        $data['pdr_member_id'] = $_SESSION['member_id'];
        $data['pdr_member_name'] = $_SESSION['member_name'];
        $data['pdr_amount'] = $pdr_amount;
        $data['pdr_add_time'] = TIMESTAMP;

        $insert = $model_pdr->addPdRecharge($data);
        
        if ($insert) {
            //转向到商城支付页面
            $order_info = array();
            $order_info['subject'] = '预存款充值_'.$data['pdr_sn'];
            $order_info['order_type'] = 'pd_order';
            $order_info['pay_sn'] = $data['pdr_sn'];
            $order_info['api_pay_amount'] = $data['pdr_amount'];

            $pay_url = urlWap('member_payment','pd_order',array('pdr_sn'=>$order_info['pay_sn'],'payment_code'=>$mb_payment_info['payment_code']));
            header("location:$pay_url");
            // $this->_api_pay($order_info, $mb_payment_info);
        }

    }

    /**
     * App - 支付
     */
    public function addAppPayOp(){

        $p_id = intval($_GET['p_id']); //支付方式id

        $pdr_amount = abs(floatval($_GET['amount']));//充值金额

        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$p_id,"require"=>"true","message"=>'支付方式不能为空'),
            array("input"=>$pdr_amount,"require"=>"true","message"=>'充值金额不能为空'),
            array("input"=>$pdr_amount,"require"=>"true","operator"=>"!=","to"=>"0","message"=>'充值金额必须大于0')
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showWapMessage($error,'','error');
        }

        $model_mb_payment = Model('mb_payment');

        $condition = array();

        $condition['payment_id'] = $p_id;

        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);

        if(!$mb_payment_info) {

            showWapMessage('系统不支持选定的支付方式','','error');

        }


        $model_pdr = Model('predeposit');
        $data = array();
        $data['pdr_sn'] = $pay_sn = $model_pdr->makeSn();
        $data['pdr_member_id'] = $_SESSION['member_id'];
        $data['pdr_member_name'] = $_SESSION['member_name'];
        $data['pdr_amount'] = $pdr_amount;
        $data['pdr_add_time'] = TIMESTAMP;

        $insert = $model_pdr->addPdRecharge($data);

        if ($insert) {
            //转向到商城支付页面
            $order_info = array();
            $order_info['subject'] = '预存款充值_'.$data['pdr_sn'];
            $order_info['order_type'] = 'pd_order';
            $order_info['pay_sn'] = $data['pdr_sn'];
            $order_info['api_pay_amount'] = $data['pdr_amount'];

            if($p_id == 1){
                $app_pay_param['subject'] = '收藏天下-充值';
                $app_pay_param['body'] = 'pd_order';
                $app_pay_param['out_trade_no'] = $data['pdr_sn'];
                $app_pay_param['total_amount'] = $data['pdr_amount'];
                $app_pay_param['notify_url'] = 'http://m.96567.com/api/payment/alipay/notify_app_url.php';
                $app_pay_param['call_back_url'] = 'http://m.96567.com/index.php?act=member&op=home';
                $app_pay_param['sign'] = md5($app_pay_param['body'].$app_pay_param['out_trade_no'].$app_pay_param['total_amount'].'soucang96567appkey');
            }elseif($p_id == 2){
                $app_pay_param['nonce_str'] = md5($data['pdr_sn']);
                $app_pay_param['body'] = 'pd_order';
                $app_pay_param['out_trade_no'] = $data['pdr_sn'];
                $app_pay_param['total_fee'] = $data['pdr_amount'];
                $app_pay_param['notify_url'] = 'http://m.96567.com/api/payment/wxpay/weixin.pay.class.php';
            }

            Tpl::output('html_title','支付页面');
            Tpl::output('order_info',$order_info);
            Tpl::output('app_pay_param',$app_pay_param);
            Tpl::output('p_id',$p_id);
            Tpl::output('no_member_footer',true);
            Tpl::output('no_member_footer_soo',true);
            Tpl::showpage('app_wx_pay');
        }else{
            $appPayUrl = urlWap('member_pay','index');
            showWapMessage('支付信息错误！',$appPayUrl,'error');
        }
    }

    /**
     * 第三方在线支付接口
     *
     */
    private function _api_pay($order_pay_info, $mb_payment_info) {
        $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$mb_payment_info['payment_code'].DS.$mb_payment_info['payment_code'].'.php';

        if(!is_file($inc_file)){
            showWapMessage('支付接口不存在','','error');
        }
        require($inc_file);
        if($mb_payment_info['payment_code'] == 'unionpay'){
            $payment_api = new $mb_payment_info['payment_code']($mb_payment_info,$order_pay_info);
            $return = $payment_api->submit();
        }elseif($mb_payment_info['payment_code'] == 'wxpay'){
            $payment_api = new $mb_payment_info['payment_code']($mb_payment_info,$order_pay_info);
            $return = $payment_api->submit();
            Tpl::output('jsapi', $return);
            Tpl::showpage('wx_pay');
            exit;
        }else{
            $param = array();
            $param = $mb_payment_info['payment_config'];
            $param['order_sn'] = $order_pay_info['pay_sn'];
            $param['order_amount'] = $order_pay_info['api_pay_amount'];
            $param['order_type'] = ($order_pay_info['order_type'] == 'real_order' ? 'r' : 'v');
            $payment_api = new $this->payment_code();
            $return = $payment_api->submit($param);
        }

        echo $return;
        exit;
    }







}
