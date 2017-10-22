<?php 
/**
 * 支付接口//zmr>v30
 * 
 *
 */
defined('InShopNC') or exit('Access Invalid!');

require_once("lib/alipay_submit.class.php");
class alipay {

	
	/**************************调用授权接口alipay.wap.trade.create.direct获取授权码token**************************/
		
	//返回格式
	private  $format = "";
	//必填，不需要修改
	
	//返回格式
	private $v = "";
	//必填，不需要修改
	
	//请求号
	private $req_id = "";
	//必填，须保证每次请求都是唯一
	
	//**req_data详细信息**
	
	//服务器异步通知页面路径
	private $notify_url = "";
	//需http://格式的完整路径，不允许加?id=123这类自定义参数
	
	//页面跳转同步通知页面路径
	private $call_back_url = "";
	//需http://格式的完整路径，不允许加?id=123这类自定义参数
	
	//卖家支付宝账户
	private $seller_email = "";
	//必填
	
	//商户订单号
	private $out_trade_no = "";
	//商户网站订单系统中唯一订单号，必填
	
	//订单名称
	private $subject = "";
	//必填
	
	//付款金额
	private $total_fee = "";
	//必填
	
	//请求业务参数详细
	private $req_data = "";
	//必填
	
	//配置
	private $alipay_config = array();
	
	/************************************************************/
	
	public function submit($param){


		if($_SESSION['app_']){
			return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>支付宝即时到账交易接口接口</title>
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        			<meta name="apple-mobile-web-app-capable" content="yes">
        			<meta name="apple-mobile-web-app-status-bar-style" content="black">
        			<meta name="format-detection" content="telephone=no">

				</head>
				<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/reset.css">
				<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/font-awesome.min.css">
				<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/main.css">
				<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/member.css">

				<body>
				<div align="center" style="margin: 100px 0">
    				<button id="pay" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="payAli()" >立即支付</button>
				</div>
				<script>
					function getAppPayParam(state){
						if(state === 1){
							var subject = "收藏天下-订单支付";
							var body = \''.$param['order_type'].'\';
							var out_trade_no = \''.$param['order_sn'].'\';
							var total_amount = \''.$param['order_amount'].'\';
							var notify_url = "http://m.96567.com/api/payment/alipay/notify_app_url.php";
							var call_back_url = "http://m.96567.com/index.php?act=member_order&op=order_list";
							var sign = \''.md5($param['order_type'].$param['order_sn'].$param['order_amount'].'soucang96567appkey').'\';
							var param = {"notify_url":notify_url,"body":body,"subject":subject,"out_trade_no":out_trade_no,"total_amount":total_amount,"sign":sign,"call_back_url":call_back_url};
							return param;
						}
						return;
					}
				</script>
				</body>
				</html>';
		}

		$this->format	= 'xml';
		$this->v		= '2.0';
		$this->req_id	= date('Ymdhis');
		$this->notify_url		= 'http://m.96567.com/api/payment/alipay/notify_url.php';
		$this->call_back_url	= 'http://m.96567.com/api/payment/alipay/call_back_url.php';
		$this->seller_email		= $param['alipay_account'];
		//v3-b10
		$this->out_trade_no		= $param['order_sn'].'-'.$param['order_type'];
		$this->subject			= $param['order_sn'];
		$this->total_fee		= $param['order_amount'];
		$this->alipay_config 	= array(
			'partner' => $param['alipay_partner'],
			'key' => $param['alipay_key'],
			'private_key_path' => 'key/rsa_private_key.pem',
			'ali_public_key_path' => 'key/alipay_public_key.pem',
			'sign_type' => 'MD5',
			'input_charset' => 'utf-8',
			'cacert' => getcwd().'\\cacert.pem',
			'transport' => 'http'
		);

		//请求业务参数详细
		$req_data			= '<direct_trade_create_req><notify_url>' . $this->notify_url . '</notify_url><call_back_url>' . $this->call_back_url . '</call_back_url><seller_account_name>' . $this->seller_email . '</seller_account_name><out_trade_no>' . $this->out_trade_no . '</out_trade_no><subject>' . $this->subject . '</subject><total_fee>' . $this->total_fee . '</total_fee></direct_trade_create_req>';
		//必填
		
		//构造要请求的参数数组，无需改动
		$para_token = array(
				"service" => "alipay.wap.trade.create.direct",
				"partner" => trim($this->alipay_config['partner']),
				"sec_id" => trim($this->alipay_config['sign_type']),
				"format"	=> $this->format,
				"v"	=> $this->v,
				"req_id"	=> $this->req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
		);
		
		//建立请求
		$alipaySubmit = new AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestHttp($para_token);
		
		//URLDECODE返回的信息
		$html_text = urldecode($html_text);
		
		//解析远程模拟提交后返回的信息
		$para_html_text = $alipaySubmit->parseResponse($html_text);
		
		//获取request_token
		$request_token = $para_html_text['request_token'];
		
		
		/**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/
		
		//业务详细
		$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
		//必填
		
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.wap.auth.authAndExecute",
				"partner" => trim($this->alipay_config['partner']),
				"sec_id" => trim($this->alipay_config['sign_type']),
				"format"	=> $this->format,
				"v"	=> $this->v,
				"req_id"	=> $this->req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
		);
		
		//建立请求
		$alipaySubmit = new AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '正在跳转支付页面...');
		// return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		// 		<html>
		// 		<head>
		// 			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		// 			<title>支付宝即时到账交易接口接口</title>
		// 		</head>'.$html_text.'
		// 		</body>
		// 		</html>';

		return '<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>支付成功 - 收藏天下</title>
        <meta name="keywords" content="收藏天下" />
        <meta name="description" content="收藏天下" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
    </head>


<body>

<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/navigation.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/reset.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/main.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/navigation.css">
<header id="header">
    <div class="header-wrap">
        <h2>订单支付</h2>
    </div>
</header>

<!--2016 1114 S-->
<link rel="stylesheet" href="http://m.96567.com/templates/default/css/pay.css" />
<div class="pay-success">
	<h2 class="title"><i></i><strong>正在打开支付页面……</strong></h2>
	<p class="txt">待支付金额：<strong>￥'.$this->total_fee.'</strong></p>
	<p class="txt">订单编号：'.$this->subject.'</p>
	<div class="pay-bottom">
		<p>无法跳转到支付页面？</p>
		<a class="pay-btn-put" href="http://m.96567.com/index.php?act=member_order&op=order_list">重新提交订单</a>
		<a href="http://m.96567.com">返回商城首页</a>
	</div>
</div>
<!--2016 1114 A-->
<div class="clearfix tab-line nav">
    <div class="tab-line-item" style="width:25%;">
        <a href="http://m.96567.com"><i class="fa fa-home"></i><br>首页</a>
    </div>
    <div class="tab-line-item tab-categroy" style="width:25%;">
        <a href="http://m.96567.com/index.php?act=goods_class&op=index"><i class="fa fa-th-list"></i><br>分类</a>
    </div>
    <div class="tab-line-item" style="width:25%;position: relative;">
        <a href="http://m.96567.com/index.php?act=member_cart&op=cart_list"><i class="fa fa-shopping-cart"></i><br>购物车</a>
    </div>
    <div class="tab-line-item" style="width:25%;">
        <a href="http://m.96567.com/index.php?act=member&op=home"><i class="fa fa-user"></i><br>个人中心</a>
    </div>
</div>
<div style="display:none;">'.$html_text.'</div>
</body>
</html>';
	}

    /**
     * 获取return信息
     */
    public function getReturnInfo($payment_config) {
        $verify = $this->_verify('return', $payment_config);

        if($verify) {
            return array(
                //商户订单号
                'out_trade_no' => $_GET['out_trade_no'],
                //支付宝交易号
                'trade_no' => $_GET['trade_no'],
            );
        }

        return false;
    }

    /**
     * 获取notify信息
     */
    public function getNotifyInfo($payment_config) {
        $verify = $this->_verify('notify', $payment_config);

        if($verify) {
            $notify_data = $_POST['notify_data'];
            //解析notify_data
            //注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
            $doc = new DOMDocument();
            $doc->loadXML($notify_data);

            if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
                //商户订单号
                $out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
                //支付宝交易号
                $trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
                //交易状态
                $trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;

                if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                    return array(
                        //商户订单号
                        'out_trade_no' => $out_trade_no,
                        //支付宝交易号
                        'trade_no' => $trade_no,
                    );
                }
            }
        }

        return false;
    }

    /**
     * 验证返回信息
     */
    public function _verify($type, $payment_config) {

        if(empty($payment_config)) {
            return false;
        }

		$alipay_config = array(
			'partner' => $payment_config['alipay_partner'],
			'key' => $payment_config['alipay_key'],
			'private_key_path' => 'key/rsa_private_key.pem',
			'ali_public_key_path' => 'key/alipay_public_key.pem',
			'sign_type' => 'MD5',
			'input_charset' => 'utf-8',
			'cacert' => getcwd().'\\cacert.pem',
			'transport' => 'http'
		);

        require_once(BASE_PATH.DS.'api/payment/alipay/lib/alipay_notify.class.php');


		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);

        switch ($type) {
            case 'notify':
                $verify_result = $alipayNotify->verifyNotify();
                break;
            case 'return':
                $verify_result = $alipayNotify->verifyReturn();
                break;
            default:
                $verify_result = false;
                break;
        }

        return $verify_result;
    }

}
