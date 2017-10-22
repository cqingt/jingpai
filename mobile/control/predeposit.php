<?php
/**
 * 充值管理
 ***/

//use Shopnc\Tpl;
defined('InShopNC') or exit('Access Invalid!');

class predepositControl extends mobileMemberControl {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 获取可用的支付列表
	 */
	public function PayListOp(){
		$model_mb_payment = Model('mb_payment');
        $payment_list = $model_mb_payment->getMbPaymentOpenList(array('payment_id'=>'3'));
        output_data(array('payment_list' => $payment_list));
	}

	/**
	 * 提交支付
	 */
	public function addZhiFuOp(){
		$p_id = intval($_GET['p_id']); //支付方式id
		$pdr_amount = abs(floatval($_GET['amount']));//充值金额
		
		if($pdr_amount <= 0) {
		    output_error('充值金额必须大于0');
		}
		$model_mb_payment = Model('mb_payment');
		$condition = array();
        $condition['payment_id'] = $p_id;
        $mb_payment_info = $model_mb_payment->getMbPaymentOpenInfo($condition);
        if(!$mb_payment_info) {
            output_error('系统不支持选定的支付方式');
        }
		$model_pdr = Model('predeposit');
        $data = array();
        $data['pdr_sn'] = $pay_sn = $model_pdr->makeSn();
        $data['pdr_member_id'] = $this->member_info['member_id'];
        $data['pdr_member_name'] = $this->member_info['member_name'];
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
            $this->_api_pay($order_info, $mb_payment_info);
        }
	}


	/**
	 * 第三方在线支付接口
	 *
	 */
	private function _api_pay($order_pay_info, $mb_payment_info) {
        $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$mb_payment_info['payment_code'].DS.$mb_payment_info['payment_code'].'.php';
    	if(!is_file($inc_file)){
            output_error('支付接口不存在');
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
