<?php
/**
 * 支付回调
 *
 *
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */


defined('InShopNC') or exit('Access Invalid!');

class paymentControl extends mobileHomeControl{


	public function __construct() {
		parent::__construct();
	}

    /**
     * 通知处理
     *
     */
    public function notifyOp(){
        switch ($_GET['payment_code']) {
            case 'alipay':
                $success = 'success'; $fail = 'fail'; break;
            case 'chinabank':
                $success = 'ok'; $fail = 'error'; break;
            case 'unionpay':
                $success = 'success'; $fail = 'error'; break;
            case 'wxpay':
                $success = 'success'; $fail = 'error'; break;
			case 'jdpay':
                $success = 'success'; $fail = 'error'; break;
            default:
                exit();
        }

        $order_type = $_POST['extra_common_param'];
        $out_trade_no = $_POST['out_trade_no'];
        $trade_no = $_POST['trade_no'];


        if($_GET['payment_code'] == 'unionpay'){
            $order_type = $_POST['reqReserved'];
            $out_trade_no = $_POST['orderId'];
            $trade_no = $_POST['queryId'];
        }

        if($_GET['payment_code'] == 'wxpay'){
            $order_type = $_POST['attach'];
            $out_trade_no = $_POST['out_trade_no'];
            $trade_no = $_POST['transaction_id'];
        }

        if($_GET['payment_code'] == 'alipay'){
            if($_GET['payment_code_app'] == 'alipay_app'){

                $order_type = $_POST['body'];
                $out_trade_no = $_POST['out_trade_no'];
                $trade_no = $_POST['trade_no'];

                file_put_contents('app_alipay_1.txt',print_r($order_type,true),FILE_APPEND);
                file_put_contents('app_alipay_2.txt',print_r($out_trade_no,true),FILE_APPEND);
                file_put_contents('app_alipay_3.txt',print_r($trade_no,true),FILE_APPEND);




            }else{
                $alipay_array = json_decode(json_encode(simplexml_load_string(html_entity_decode($_POST['notify_data']))),true);
                $alipay_order_type = explode('-',$alipay_array['out_trade_no']);
                $order_type = end($alipay_order_type);
                $out_trade_no = reset($alipay_order_type);
                $trade_no = $alipay_array['trade_no'];
            }
        }

        
        //参数判断
        if(!preg_match('/^\d{18}$/',$out_trade_no)) exit($fail);


        $model_pd = Model('predeposit');
        $logic_payment = Logic('payment');


        if ($order_type == 'real_order') {

            $result = $logic_payment->getRealOrderInfo($out_trade_no);
            if (intval($result['data']['api_pay_state'])) {
                exit($success);
            }
            $order_list = $result['data']['order_list'];

        } elseif ($order_type == 'vr_order'){

            $result = $logic_payment->getVrOrderInfo($out_trade_no);
            if ($result['data']['order_state'] != ORDER_STATE_NEW) {
                exit($success);
            }

        } elseif ($order_type == 'pd_order') {

            $result = $logic_payment->getPdOrderInfo($out_trade_no);

            if ($result['data']['pdr_payment_state'] == 1) {
                exit($success);
            }

            //add 乐拍订单  xin 20151026
        } elseif ($order_type == 'lepai_order') {

            $result = $logic_payment->getLepaiOrderInfo($out_trade_no);
            if ($result['data']['order_state'] == 20) {
                exit($success);
            }
            //add end
        } else {
            exit();
        }
        $order_pay_info = $result['data'];

        //取得支付方式
        $result = Model('mb_payment')->getMbPaymentOpenInfo(array('payment_code'=>$_GET['payment_code']));

        if (!$result['payment_state']) {
            exit($fail);
        }
        $payment_info = $result;

        $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$payment_info['payment_code'].DS.$payment_info['payment_code'].'.php';

        if(is_file($inc_file)) {
            require($inc_file);
        }

        //创建支付接口对象
        $payment_api	= new $payment_info['payment_code']($payment_info,$order_pay_info);
        //对进入的参数进行远程数据判断

        if($_GET['payment_code'] == 'alipay'){

            if($_GET['payment_code_app'] == 'alipay_app'){
                $verify = true;
            }else{
                $verify = $payment_api->_verify('notify',$payment_info['payment_config']);
            }
        }else{
            $verify = $payment_api->notify_verify();
        }


        if (!$verify) {
            exit($fail);
        }

        //购买商品
        if ($order_type == 'real_order') {
            $result = $logic_payment->updateRealOrder($out_trade_no, $payment_info['payment_code'], $order_list, $trade_no);
        } elseif($order_type == 'vr_order'){
            $result = $logic_payment->updateVrOrder($out_trade_no, $payment_info['payment_code'], $order_pay_info, $trade_no);
        } elseif ($order_type == 'pd_order') {
            $result = $logic_payment->updatePdOrder($out_trade_no,$trade_no,$payment_info,$order_pay_info);
        }
        //add 乐拍订单  xin 20151026
        elseif ($order_type == 'lepai_order') {
            $result = $logic_payment->updateLepaiOrder($out_trade_no,$payment_info['payment_code'],$order_pay_info,$trade_no);
        }
        //add end

        file_put_contents('payment_alipay.txt',print_r($payment_info,true),FILE_APPEND);

        file_put_contents('payment_alipay.txt',print_r($result,true),FILE_APPEND);


        exit($result['state'] ? $success : $fail);
    }

    /**
     * 支付接口返回
     *
     */
    public function returnOp(){
        $order_type = $_GET['extra_common_param'];

        //银联支付获取ordertype方式不同
        if($_GET['payment_code'] == 'unionpay'){
            $order_type = $_POST['reqReserved'];
        }

        // 阿里支付
        if($_GET['payment_code'] == 'alipay'){
            $alipay_order_type = explode('-',$_GET['out_trade_no']);
            $order_type = end($alipay_order_type);
        }


        if ($order_type == 'real_order') {
            $act = 'member_order';
        } elseif($order_type == 'vr_order') {
            $act = 'member_vr_order';
        } elseif($order_type == 'pd_order') {
            $act = 'predeposit';
            //add 乐拍订单 xin 20151026
        }elseif($order_type == 'lepai_order'){
            $act = 'lepai_order';
            //add end
        } else {
            exit();
        }
        $out_trade_no = $_GET['out_trade_no'];
        $trade_no = $_GET['trade_no'];
        $url = urlWap('member','home');

        // 阿里支付
        if($_GET['payment_code'] == 'alipay'){
            $alipay_order_type = explode('-',$_GET['out_trade_no']);
            $out_trade_no = reset($alipay_order_type);
        }

        //银联支付获取$out_trade_no，$trade_no方式不同
        if($_GET['payment_code'] == 'unionpay'){
            $out_trade_no = $_POST['orderId'];
            $trade_no = $_POST['queryId'];
        }

        //对外部交易编号进行非空判断
        if(!preg_match('/^\d{18}$/',$out_trade_no)) {
            showWapMessage('参数错误',$url,'error');
        }
        $logic_payment = Logic('payment');

        if ($order_type == 'real_order') {

            $result = $logic_payment->getRealOrderInfo($out_trade_no);
            if(!$result['payment_state']) {
                showWapMessage($result['msg'], $url, 'error');
            }
            if ($result['data']['api_pay_state']) {
                $payment_state = 'success';
            }
            $order_list = $result['data']['order_list'];

        }elseif ($order_type == 'vr_order') {

            $result = $logic_payment->getVrOrderInfo($out_trade_no);
            if(!$result['state']) {
                showWapMessage($result['msg'], $url, 'error');
            }
            if ($result['data']['order_state'] != ORDER_STATE_NEW) {
                $payment_state = 'success';
            }

        } elseif ($order_type == 'pd_order') {

            $result = $logic_payment->getPdOrderInfo($out_trade_no);
            if(!$result['state']) {
                showWapMessage($result['msg'], $url, 'error');
            }
            if ($result['data']['pdr_payment_state'] == 1) {
                $payment_state = 'success';
            }
        }
        //add 乐拍订单  xin 20151026
        elseif ($order_type == 'lepai_order') {

            $result = $logic_payment->getLepaiOrderInfo($out_trade_no);
            if ($result['data']['order_state'] == ORDER_STATE_PAY) {
                $payment_state = 'success';
            }

        }
        //add end


        $order_pay_info = $result['data'];
        $api_pay_amount = $result['data']['api_pay_amount'];

        if ($payment_state != 'success') {
            //取得支付方式
			
            $result = Model('mb_payment')->getMbPaymentOpenInfo(array('payment_code'=>$_GET['payment_code']));
			
            if (!$result['payment_state']) {
                exit("nopay");
            }
			
            $payment_info = $result;
            $inc_file = BASE_PATH.DS.'api'.DS.'payment'.DS.$payment_info['payment_code'].DS.$payment_info['payment_code'].'.php';

		
            if(is_file($inc_file)) {
                require($inc_file);
            }
            //创建支付接口对象
            $payment_api	= new $payment_info['payment_code']($payment_info,$order_pay_info);

            //返回参数判断
            $verify = $payment_api->return_verify();
	
            if(!$verify) {
                showWapMessage('支付数据验证失败',$url,'error');
            }

            //取得支付结果
            $pay_result	= $payment_api->getPayResult($_GET);
            if (!$pay_result) {
                showWapMessage('非常抱歉，您的订单支付没有成功，请稍后尝试',$url,'error');
            }

            //更改订单支付状态
            if ($order_type == 'real_order') {
                $result = $logic_payment->updateRealOrder($out_trade_no, $payment_info['payment_code'], $order_list, $trade_no);
            } else if($order_type == 'vr_order') {
                $result = $logic_payment->updateVrOrder($out_trade_no, $payment_info['payment_code'], $order_pay_info, $trade_no);
            } else if ($order_type == 'pd_order') {
                $result = $logic_payment->updatePdOrder($out_trade_no, $trade_no, $payment_info, $order_pay_info);
            }
            //add 乐拍订单  xin 20151026
            elseif ($order_type == 'lepai_order') {
                $result = $logic_payment->updateLepaiOrder($out_trade_no,$payment_info['payment_code'],$order_pay_info,$trade_no);
            }
            //add end
            if (!$result['state']) {
                showWapMessage('支付状态更新失败',$url,'error');
            }
        }

        //支付成功后跳转
        if ($order_type == 'real_order') {
            $pay_ok_url = urlWap('member_buy','pay_ok',array('pay_sn'=>$out_trade_no,'order_amount'=>ncPriceFormat($api_pay_amount)));
        } elseif ($order_type == 'vr_order') {
            $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy_virtual&op=pay_ok&order_sn='.$out_trade_no.'&order_id='.$order_pay_info['order_id'].'&order_amount='.ncPriceFormat($api_pay_amount);
        } elseif ($order_type == 'pd_order') {
            $pay_ok_url = urlWap('member','home');
        }
        //add 乐拍订单  xin 20151026
        elseif ($order_type == 'lepai_order') {
            $pay_ok_url = urlWap('lepai_order','order_list');
        }

        //add end
        if ($payment_info['payment_code'] == 'tenpay') {
            showMessage('',$pay_ok_url,'tenpay');
        } else {
            redirect($pay_ok_url);
        }
    }

}
