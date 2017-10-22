<?php
/**
 * 支付入口
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class paymentControl extends BaseHomeControl{

    public function __construct() {
        //向前兼容
        $_GET['extra_common_param'] = str_replace(array('predeposit','product_buy'),array('pd_order','real_order'),$_GET['extra_common_param']);
        $_POST['extra_common_param'] = str_replace(array('predeposit','product_buy'),array('pd_order','real_order'),$_POST['extra_common_param']);
    }

	/**
	 * 实物商品订单
	 */
	public function real_orderOp(){
	    $pay_sn = $_POST['pay_sn'];
		$payment_code = $_POST['payment_code'];
        $url = 'index.php?act=member_order';

        if(!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage('参数错误','','html','error');
        }

        $logic_payment = Logic('payment');
        $result = $logic_payment->getPaymentInfo($payment_code);
		if(!$result['state']) {
			showMessage($result['msg'], $url, 'html', 'error');
		}
        $payment_info = $result['data'];

        //计算所需支付金额等支付单信息
        $result = $logic_payment->getRealOrderInfo($pay_sn, $_SESSION['member_id']);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }

        if ($result['data']['api_pay_state'] || empty($result['data']['api_pay_amount'])) {
            showMessage('该订单不需要支付', $url, 'html', 'error');
        }

        //转到第三方API支付
        $this->_api_pay($result['data'], $payment_info);
	}

	/**
	 * 虚拟商品购买
	 */
	public function vr_orderOp(){
	    $order_sn = $_POST['order_sn'];
	    $payment_code = $_POST['payment_code'];
	    $url = 'index.php?act=member_vr_order';

	    if(!preg_match('/^\d{18}$/',$order_sn)){
            showMessage('参数错误','','html','error');
        }

        $logic_payment = Logic('payment');
        $result = $logic_payment->getPaymentInfo($payment_code);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];

        //计算所需支付金额等支付单信息
        $result = $logic_payment->getVrOrderInfo($order_sn, $_SESSION['member_id']);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }

        if ($result['data']['order_state'] != ORDER_STATE_NEW || empty($result['data']['api_pay_amount'])) {
            showMessage('该订单不需要支付', $url, 'html', 'error');
        }

        //转到第三方API支付
        $this->_api_pay($result['data'], $payment_info);
	}

	/**
	 * 预存款充值
	 */
	public function pd_orderOp(){
	    $pdr_sn = $_POST['pdr_sn'];
	    $payment_code = $_POST['payment_code'];
	    $url = 'index.php?act=predeposit';

	    if(!preg_match('/^\d{18}$/',$pdr_sn)){
	        showMessage('参数错误',$url,'html','error');
	    }

	    $logic_payment = Logic('payment');
	    $result = $logic_payment->getPaymentInfo($payment_code);
	    if(!$result['state']) {
	        showMessage($result['msg'], $url, 'html', 'error');
	    }
	    $payment_info = $result['data'];

        $result = $logic_payment->getPdOrderInfo($pdr_sn,$_SESSION['member_id']);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        if ($result['data']['pdr_payment_state'] || empty($result['data']['api_pay_amount'])) {
            showMessage('该充值单不需要支付', $url, 'html', 'error');
        }

	    //转到第三方API支付
	    $this->_api_pay($result['data'], $payment_info);
	}

	/**
	 * 第三方在线支付接口
	 *
	 */
	private function _api_pay($order_info, $payment_info) {
    	$payment_api = new $payment_info['payment_code']($payment_info,$order_info);
    	if($payment_info['payment_code'] == 'chinabank' || $payment_info['payment_code'] == 'unionpay') {
    		$payment_api->submit();
    	} elseif($payment_info['payment_code'] == 'wxpay') {
            Tpl::setDir('buy');
            Tpl::setLayout('buy_layout');
            Language::read('common,home_layout,home_cart_index');
            Tpl::output('buy_step','step3');
            Tpl::output('order_type',$order_info['order_type']);
            Tpl::output('args','pay_sn='.$order_info['pay_sn'].'&order_type='.$order_info['order_type']);
            if (array_key_exists('order_list', $order_info)) {
                Tpl::output('order_list',$order_info['order_list']);
            }
            Tpl::output('api_pay_amount',$order_info['api_pay_amount']);
            Tpl::output('pay_url',$payment_api->get_payurl());
            //支付成功后跳转
            if ($order_info['order_type'] == 'real_order') {
                $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy&op=pay_ok&pay_sn='.$order_info['pay_sn'].'&pay_amount='.ncPriceFormat($order_info['api_pay_amount']);
            } elseif ($order_info['order_type'] == 'vr_order') {
                $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy_virtual&op=pay_ok&order_sn='.$order_info['pay_sn'].'&order_id='.$order_info['order_id'].'&order_amount='.ncPriceFormat($order_info['api_pay_amount']);
            } elseif ($order_info['order_type'] == 'pd_order') {
                $pay_ok_url = SHOP_SITE_URL.'/index.php?act=predeposit';
            }
            elseif ($order_info['order_type'] == 'lepai_order') {
                $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy&op=lepai_pay_ok&pay_sn='.$order_info['pay_sn'].'&pay_amount='.ncPriceFormat($order_info['api_pay_amount']);
            }
            Tpl::output('pay_ok_url', $pay_ok_url);
            //获取导航
            Tpl::output('nav_list', rkcache('nav',true));
            Tpl::showpage('payment.wxpay');
        }else{
    		@header("Location: ".$payment_api->get_payurl());
    	}
    	exit();
	}

	/**
	 * 通知处理(支付宝异步通知和网银在线自动对账)
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

        //add 拍卖惠订单  xin 20151026
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
		$result = $logic_payment->getPaymentInfo($_GET['payment_code']);
		if (!$result['state']) {
		    exit($fail);
		}
		$payment_info = $result['data'];

		//创建支付接口对象
		$payment_api	= new $payment_info['payment_code']($payment_info,$order_pay_info);

		//对进入的参数进行远程数据判断
		$verify = $payment_api->notify_verify();

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
        //add 拍卖惠订单  xin 20151026
        elseif ($order_type == 'lepai_order') {
            $result = $logic_payment->updateLepaiOrder($out_trade_no,$payment_info['payment_code'],$order_pay_info,$trade_no);
        }
        //add end

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

		if ($order_type == 'real_order') {
		    $act = 'member_order';
		} elseif($order_type == 'vr_order') {
			$act = 'member_vr_order';
		} elseif($order_type == 'pd_order') {
            $act = 'predeposit';
        //add 拍卖惠订单 xin 20151026
        }elseif($order_type == 'lepai_order'){
            $act = 'lepai_order';
        //add end
		} else {
		    exit();
		}

		$out_trade_no = $_GET['out_trade_no'];
		$trade_no = $_GET['trade_no'];
		$url = SHOP_SITE_URL.'/index.php?act='.$act;

        //银联支付获取$out_trade_no，$trade_no方式不同
        if($_GET['payment_code'] == 'unionpay'){
            $out_trade_no = $_POST['orderId'];
            $trade_no = $_POST['queryId'];
        }

		//对外部交易编号进行非空判断
		if(!preg_match('/^\d{18}$/',$out_trade_no)) {
		    showMessage('参数错误',$url,'','html','error');
		}

		$logic_payment = Logic('payment');

		if ($order_type == 'real_order') {

		    $result = $logic_payment->getRealOrderInfo($out_trade_no);
		    if(!$result['state']) {
		        showMessage($result['msg'], $url, 'html', 'error');
		    }
		    if ($result['data']['api_pay_state']) {
		        $payment_state = 'success';
		    }
		    $order_list = $result['data']['order_list'];

	    }elseif ($order_type == 'vr_order') {

	        $result = $logic_payment->getVrOrderInfo($out_trade_no);
	        if(!$result['state']) {
	            showMessage($result['msg'], $url, 'html', 'error');
	        }
	        if ($result['data']['order_state'] != ORDER_STATE_NEW) {
	            $payment_state = 'success';
	        }

		} elseif ($order_type == 'pd_order') {

		    $result = $logic_payment->getPdOrderInfo($out_trade_no);
		    if(!$result['state']) {
		        showMessage($result['msg'], $url, 'html', 'error');
		    }
		    if ($result['data']['pdr_payment_state'] == 1) {
		        $payment_state = 'success';
		    }
		}
        //add 拍卖惠订单  xin 20151026
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
		    $result = $logic_payment->getPaymentInfo($_GET['payment_code']);
		    if (!$result['state']) {
		        showMessage($result['msg'],$url,'html','error');
		    }
		    $payment_info = $result['data'];

		    //创建支付接口对象
		    $payment_api	= new $payment_info['payment_code']($payment_info,$order_pay_info);

		    //返回参数判断
		    $verify = $payment_api->return_verify();
		    if(!$verify) {
		        showMessage('支付数据验证失败',$url,'html','error');
		    }

		    //取得支付结果
		    $pay_result	= $payment_api->getPayResult($_GET);
		    if (!$pay_result) {
		        showMessage('非常抱歉，您的订单支付没有成功，请稍后尝试',$url,'html','error');
		    }

            //更改订单支付状态
		    if ($order_type == 'real_order') {
		        $result = $logic_payment->updateRealOrder($out_trade_no, $payment_info['payment_code'], $order_list, $trade_no);
		    } else if($order_type == 'vr_order') {
		        $result = $logic_payment->updateVrOrder($out_trade_no, $payment_info['payment_code'], $order_pay_info, $trade_no);
		    } else if ($order_type == 'pd_order') {
		        $result = $logic_payment->updatePdOrder($out_trade_no, $trade_no, $payment_info, $order_pay_info);
		    }
            //add 拍卖惠订单  xin 20151026
            elseif ($order_type == 'lepai_order') {
                $result = $logic_payment->updateLepaiOrder($out_trade_no,$payment_info['payment_code'],$order_pay_info,$trade_no);
            }
            //add end
		    if (!$result['state']) {
		        showMessage('支付状态更新失败',$url,'html','error');
		    }
		}

		//支付成功后跳转
		if ($order_type == 'real_order') {
		    $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy&op=pay_ok&pay_sn='.$out_trade_no.'&pay_amount='.ncPriceFormat($api_pay_amount);
		} elseif ($order_type == 'vr_order') {
		    $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy_virtual&op=pay_ok&order_sn='.$out_trade_no.'&order_id='.$order_pay_info['order_id'].'&order_amount='.ncPriceFormat($api_pay_amount);
		} elseif ($order_type == 'pd_order') {
		    $pay_ok_url = SHOP_SITE_URL.'/index.php?act=predeposit';
		}
        //add 拍卖惠订单  xin 20151026
        elseif ($order_type == 'lepai_order') {
            $pay_ok_url = SHOP_SITE_URL.'/index.php?act=buy&op=lepai_pay_ok&pay_sn='.$out_trade_no.'&pay_amount='.ncPriceFormat($api_pay_amount);
        }
        //add end
        if ($payment_info['payment_code'] == 'tenpay') {
            showMessage('',$pay_ok_url,'tenpay');
        } else {
            redirect($pay_ok_url);
        }
	}

    //add 拍卖惠 xin 20151024
    /**
     * 拍卖惠订单
     */
    public function lepai_orderOp(){

        $h_model = Model('lepai_home');

        $pay_sn = $_POST['pay_sn'];
        $payment_code = $_POST['payment_code'];
        $url = 'index.php?act=lepai_order';

        if(!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage('参数错误',urlShop('lepai_order','index'),'html','error');
        }

        $orderInfo = $h_model->getLepaiOrderOne(array('pay_sn'=>$pay_sn));

        if($orderInfo['order_id'] < 1){
            showMessage('未找到需要支付的订单',urlShop('lepai_order','index'),'html','error');
        }

        if($orderInfo['order_state'] !=  10){
            showMessage('订单支付状态错误!',urlShop('lepai_order','index'),'html','error');
        }

        $logic_payment = Logic('payment');
        $result = $logic_payment->getPaymentInfo($payment_code);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];

        $order_info = array();
        $order_info['pay_sn'] = $orderInfo['pay_sn'];
        $order_info['subject'] = '拍卖惠订单_'.$orderInfo['pay_sn'];
        $order_info['order_type'] = 'lepai_order';
        $order_info['api_pay_amount'] = $orderInfo['order_amount'] - $orderInfo['rcb_amount'] - $orderInfo['pd_amount'];

        //转到第三方API支付
        $this->_api_pay($order_info, $payment_info);
    }

    //add 微信扫码支付ajax查询订单状态 xin 20151120
    public function wx_query_stateOp() {

        $out_trade_no = $_GET['pay_sn'];
        $order_type = $_GET['order_type'];
        $logic_payment = Logic('payment');
        if(!preg_match('/^\d{18}$/',$out_trade_no)){
            exit('0');
        }
        if ($order_type == 'real_order') {

            $result = $logic_payment->getRealOrderInfo($out_trade_no);
            if (intval($result['data']['api_pay_state'])) {
                exit('1');
            }
            $order_list = $result['data']['order_list'];

        } elseif ($order_type == 'vr_order'){

            $result = $logic_payment->getVrOrderInfo($out_trade_no);
            if ($result['data']['order_state'] != 10) {
                exit('1');
            }

        } elseif ($order_type == 'pd_order') {

            $result = $logic_payment->getPdOrderInfo($out_trade_no);
            if ($result['data']['pdr_payment_state'] == 1) {
                exit('1');
            }

            //add 拍卖惠订单  xin 20151026
        } elseif ($order_type == 'lepai_order') {

            $result = $logic_payment->getLepaiOrderInfo($out_trade_no);
            if ($result['data']['order_state'] == 20) {
                exit('1');
            }
            //add end
        } else {
            exit();
        }
    }
    //add end
}