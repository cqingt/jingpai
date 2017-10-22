<?php
/**
 * crm 微信银联在线支付
 */
$payment_lang = dirname(__FILE__).'/languages/upop.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc']    = 'upop_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = 'SC CRM';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.96567.net';

    /* 版本号 */
    $modules[$i]['version'] = '1.0.0';

    /* 配置信息 */
    $modules[$i]['config'] = array(
		array('name' => 'upop_merAbbr', 'type' => 'text', 'value' => '商户名称'),
		array('name' => 'upop_evn', 'type' => 'select', 'value' => '0'),
		array('name' => 'upop_account_test', 'type' => 'text', 'value' => '105550149170027'),
		array('name' => 'upop_security_key_test', 'type' => 'text', 'value' => '88888888'),
        array('name' => 'upop_account_pm', 'type' => 'text', 'value' => ''),
		array('name' => 'upop_security_key_pm', 'type' => 'text', 'value' => ''),
        array('name' => 'upop_account', 'type' => 'text', 'value' => ''),
		array('name' => 'upop_security_key', 'type' => 'text', 'value' => ''),
    );

    return;
}

/**
 * 类
 */
class UPOP
{
    /**
     * 生成支付代码
     * @param   array   $order  订单信息
     * @param   array   $payment    支付方式信息
     */

    static $api_url = array(
        0  => array(
            'front_pay_url' => 'http://58.246.226.99/UpopWeb/api/Pay.action',
            'back_pay_url'  => 'http://58.246.226.99/UpopWeb/api/BSPay.action',
            'query_url'     => 'http://58.246.226.99/UpopWeb/api/Query.action',
        ),
        1  => array(
            'front_pay_url' => 'http://www.epay.lxdns.com/UpopWeb/api/Pay.action',
            'back_pay_url'  => 'http://www.epay.lxdns.com/UpopWeb/api/BSPay.action',
            'query_url'     => 'http://www.epay.lxdns.com/UpopWeb/api/Query.action',
        ),
        2  => array(
            'front_pay_url' => 'https://unionpaysecure.com/api/Pay.action',
            'back_pay_url'  => 'https://besvr.unionpaysecure.com/api/BSPay.action',
            'query_url'     => 'https://query.unionpaysecure.com/api/Query.action',
        ),
    );

    function get_code($order, $payment)
    {
		// 初始化变量
		$upop_evn		= 2;		// 环境
		$lib_path		=  dirname(__FILE__).'/upop/';
		
		// 包含库接口文件
		include_once($lib_path . 'quickpay_service.php');

		if (!class_exists('quickpay_conf') || !class_exists('quickpay_service'))
			return '缺少支付方式文件。';

		
		// 商户名称
		quickpay_conf::$pay_params['merAbbr']		= $payment['upop_merAbbr'];

        foreach (UPOP::$api_url[$upop_evn] as $key => $value)
        {
            quickpay_conf::$$key = $value;
        }

		if ($upop_evn == '2') // 生产环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account'];
		}
		else if ($upop_evn == '1') // PM环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key_pm'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account_pm'];
		}
		else if ($upop_evn == '0') // 开发联调环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key_test'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account_test'];
		}

		mt_srand(quickpay_service::make_seed());

		$param = array();

		$param['transType']             = quickpay_conf::CONSUME;  // 交易类型，CONSUME or PRE_AUTH
		$param['orderAmount']           = $order['order_amount'] * 100;  // 交易金额 转化为分
		$param['orderNumber']           = $order['order_sn'] . '-' . $this->_formatSN($order['log_id']);		   // 订单号，必须唯一
		$param['orderTime']             = date('YmdHis');		   // 交易时间, YYYYmmhhddHHMMSS
		$param['orderCurrency']         = quickpay_conf::CURRENCY_CNY;  //交易币种，CURRENCY_CNY=>人民币

		$param['customerIp']            = $_SERVER['REMOTE_ADDR'];  // 用户IP
		$param['frontEndUrl']           = 'http://m.soocang.com/lib/control/main/respond.class.php?code='.basename(__FILE__, ".php").'';   // 前台回调URL
		$param['backEndUrl']            = 'http://m.soocang.com/lib/control/main/respond.class.php?code='.basename(__FILE__, ".php").'';    // 后台回调URL

		/* 可填空字段
		   $param['commodityUrl']          = "http://www.example.com/product?name=商品";  //商品URL
		   $param['commodityName']         = '商品名称';   //商品名称
		   $param['commodityUnitPrice']    = 11000;        //商品单价
		   $param['commodityQuantity']     = 1;            //商品数量
		*/
		

		//$button = "<input type='submit' value='" . $GLOBALS['_LANG']['upop_button'] . "' />";
		
        //$button = '<div style="text-align:center"><input style="padding-left:10px; padding-right:10px; height:26px; line-height:26px; border-radius:3px; background-color:#e4393c; color:#fff;border:0px; border:none; cursor:pointer;" type="submit"  value="' .$GLOBALS['_LANG']['upop_button']. '" /></div>';
		
		$pay_service = new quickpay_service($param, quickpay_conf::FRONT_PAY);
		$html = $pay_service->create_html($button);

        return $html;
    }

    /**
     * 响应操作
     */
    function respond()
    {
		require_once(dirname(__FILE__)."/../../control/main/public/pay.class.php");
		$pay    = new pay();
        $payment        = $pay->get_payment('upop');

		// 初始化变量
		$upop_evn		= $payment['upop_evn'];		// 环境
		
		$lib_path		=  dirname(__FILE__).'/upop/';

		// 包含库接口文件
		include_once($lib_path . 'quickpay_service.php');

		if (!class_exists('quickpay_conf') || !class_exists('quickpay_service'))
			return false;

		// 商户名称
		quickpay_conf::$pay_params['merAbbr']		= $payment['upop_merAbbr'];

        foreach (UPOP::$api_url[$upop_evn] as $key => $value)
        {
            quickpay_conf::$$key = $value;
        }

		if ($upop_evn == '2') // 生产环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account'];
		}
		else if ($upop_evn == '1') // PM环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key_pm'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account_pm'];
		}
		else if ($upop_evn == '0') // 开发联调环境
		{
			quickpay_conf::$security_key			= $payment['upop_security_key_test'];
			quickpay_conf::$pay_params['merId']		= $payment['upop_account_test'];
		}

		try {
			$response = new quickpay_service($_POST, quickpay_conf::RESPONSE);
			if ($response->get('respCode') != quickpay_service::RESP_SUCCESS) 
			{
				$err = sprintf("Error: %d => %s", $response->get('respCode'), $response->get('respMsg'));
				throw new Exception($err);
			}

			$arr_ret = $response->get_args();
			
			if(!strpos($arr_ret['orderNumber'], '-')) return false;
			$order_sn_arr = explode('-', $arr_ret['orderNumber']);
			
			$order_sn		= $order_sn_arr[0];
		
			
			
			$pay_id = intval($order_sn_arr['1']);
				
			
	
			$payment_amount = (int)$arr_ret['settleAmount'];
		
			if (quickpay_conf::$pay_params['merId'] != $arr_ret['merId'])
			{
				return false;
			}

			// 检查价格是否一致。
			//$sql = "SELECT p.order_amount FROM " . $GLOBALS['ecs']->table('pay_log') . " AS p LEFT JOIN " . $GLOBALS['ecs']->table('order_info') . " AS o ON p.order_id = o.order_id WHERE o.order_sn = '"
//			. $order_sn . "'";
//			$order_amount = $GLOBALS['db']->getOne($sql) * 100;
//			write_log_upop('订单号'.$order_sn."第二步 时间：".time()."\n");
//			if ($order_amount != $payment_amount)
//			{
//				return false;
//			}

			// 如果未支付成功。
			if ($arr_ret['respCode'] != '00')
			{
				return false;
			}

			// 完成订单。
			$pay->order_paid($pay_id);
			//告诉用户交易完成
			return true;
        
		}
		catch(Exception $exp) 
		{
			return false;
		}
    }


	/**
	* 格式订单号
	*/
	function _formatSN($sn)
	{
		return str_repeat('0', 9 - strlen($sn)) . $sn;
	}
}



function write_log_upop($content){
		$fp=fopen(dirname(__FILE__)."/upoplog/".date('Y-m-d').".log","a+");//fopen()的其它开关请参看相关函数
		$str=$content."\n";
		fputs($fp,$str);
		fclose($fp);	
}
?>
