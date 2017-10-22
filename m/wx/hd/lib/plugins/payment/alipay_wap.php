<?php

/**
 * ΢�� ֧�����ֻ�֧�����
 
 */
$payment_lang = dirname(__FILE__).'/languages/alipay_wap.php';

if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* ģ��Ļ�����Ϣ */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* ���� */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* ������Ӧ�������� */
    $modules[$i]['desc']    = 'alipay_wap_desc';

    /* �Ƿ�֧�ֻ������� */
    $modules[$i]['is_cod']  = '0';

    /* �Ƿ�֧������֧�� */
    $modules[$i]['is_online']  = '1';

    /* ���� */
    $modules[$i]['author']  = 'SC CRM';

    /* ��ַ */
    $modules[$i]['website'] = 'http://www.96567.cn';

    /* �汾�� */
    $modules[$i]['version'] = '1.0.0';

    /* ������Ϣ */
    $modules[$i]['config']  = array(
        array('name' => 'alipay_account',           'type' => 'text',   'value' => ''),
        array('name' => 'alipay_key',               'type' => 'text',   'value' => ''),
        array('name' => 'alipay_partner',           'type' => 'text',   'value' => ''),
    );

    return;
}

/**
 * ��
 */
class alipay_wap
{

    /**
     * ���캯��
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function alipay_wap()
    {
		
	   
    }

    function __construct()
    {
        $this->alipay_wap();
    }

    /**
     * ����֧������
     * @param   array   $order      ������Ϣ
     * @param   array   $payment    ֧����ʽ��Ϣ
     */
    function get_code($order, $payment)
    {
	//	print_r($payment );
        $charset = 'gbk';
		$charset = 'utf-8';
        $gateway = 'http://wappaygw.alipay.com/service/rest.htm?';

        /************************���ܿ�ʼ**************************/
		
        //����ҵ������
        $req_data = '<direct_trade_create_req>'
                . '<subject>'. $order['order_sn'] .'</subject>'
                . '<out_trade_no>'. $order['order_sn'] . '_' . $order['log_id'] .'</out_trade_no>'
                . '<total_fee>'. $order['order_amount'] .'</total_fee>'
                . '<seller_account_name>'. $payment['alipay_account'] .'</seller_account_name>'
                . '<call_back_url>http://w.96567.com/lib/control/main/respond.class.php?code='.basename(__FILE__, ".php").'</call_back_url>'
                //. '<notify_url>'. return_url(basename(__FILE__, '.php')) .'</notify_url>'
                //. '<out_user>'. $order['consignee'] .'</out_user>'
                //. '<merchant_url>'. $GLOBALS['ecs']->url() .'</merchant_url>'
                //. '<pay_expire>3600</pay_expire>'
                . '</direct_trade_create_req>';

        $parameter = array(
            'service'           => 'alipay.wap.trade.create.direct', //�ӿ�����
            'format'            => 'xml', //���������ʽ
            'v'                 => '2.0', //�ӿڰ汾��
            'partner'           => $payment['alipay_partner'], //���������ID
            'req_id'            => date('Ymdhis').rand(1000,9999), //����ţ�Ψһ
            'sec_id'            => 'MD5', //ǩ����ʽ
            'req_data'          => $req_data, //����ҵ������
            "_input_charset"	=> $charset
        );

        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            //$param .= "$key=" .urlencode($val). "&";
			$param .= "$key=" .$val. "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];

        /************************���ָܷ�**************************/
        //������Ȩ�ӿ�
        $result = $this->post($gateway, $param . '&sign='.md5($sign));
        $result = urldecode($result); //URLת��
        $result_array = explode('&', $result); //���� & ���Ų��
        //�ع�����
        $new_result_array = $temp_item = array();
        if(is_array($result_array)){
            foreach ($result_array as $vo){
                $temp_item = explode('=', $vo, 2); //���� & ���Ų��
                $new_result_array[$temp_item[0]] = $temp_item[1];
            }
        }
        /************************���ָܷ�**************************/
        
        $xml = simplexml_load_string($new_result_array['res_data']);
        $request_token = (array)$xml->request_token;
        //�����׽ӿ�
        $parameter = array(
            'service'           => 'alipay.wap.auth.authAndExecute', //�ӿ�����
            'format'            => 'xml', //���������ʽ
            'v'                 => $new_result_array['v'], //�ӿڰ汾��
            'partner'           => $new_result_array['partner'], //���������ID
            'sec_id'            => $new_result_array['sec_id'],
            'req_data'          => '<auth_and_execute_req><request_token>'. $request_token[0] .'</request_token></auth_and_execute_req>',
            'request_token'     => $request_token[0],
            '_input_charset'    => $charset
        );

        ksort($parameter);
        reset($parameter);

        $param = '';
        $sign  = '';

        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }

        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        /************************����֧������**************************/
        
        //$button = '<div style="text-align:center"><input type="button" onclick="window.open(\''.$gateway.$param. '&sign='.md5($sign).'\')" value="' .$GLOBALS['_LANG']['pay_button']. '" /></div>';
		$button = '<script>window.location.href="'.$gateway.$param. '&sign='.md5($sign).'"</script>';
        return $button;
    }

    /**
     * ��Ӧ����
     */
    function respond()
    {
		require_once(dirname(__FILE__)."/../../control/main/public/pay.class.php");
		$pay    = new pay();
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
        $payment  = $pay->get_payment($_GET['code']);
      
        $order_sn = explode('_', $_GET['out_trade_no']);
        $order_sn = $order_sn[1];
		
        /* �������ǩ���Ƿ���ȷ */
        ksort($_GET);
        reset($_GET);
		
//        $sign = '';
//        foreach ($_GET AS $key=>$val)
//        {
//            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
//            {
//                $sign .= "$key=$val&";
//            }
//        }
//
//
//        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
//        if (md5($sign) != $_GET['sign'])
//        {
//			
//            return false;
//        }

        if ($_GET['result'] == 'success')
        {
            /* �ı䶩��״̬ */
            $pay->order_paid($order_sn);

            return true;
        }
        else
        {
            return false;
        }
    }

    function post($url, $curlPost) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }

}

?>