<?php
/**
 * SW ΢��SDK�ӿ���
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������weixinPAY
 * 
 * @���ܣ�΢��֧��������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�weixin.sdk.class.php
 * 
 * @����ʱ�䣺2014-2-28 23:00:00
 * 
 * @΢��PAY��
 * 
 */
class weixinPAY extends weixinSDK{
	public $openid;
	//public $mch_id = '1226270402';
	public $value;//�������������Ϊ��������
	public $keyStr;
	public $order_id;
	
	private $prepay_id;
	private $apiURL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

	/**
	 * @ ���ö�������
	 * @ appid:΢��id
	 * @ attach:֧������
	 * @ body:��������
	 * @ mch_id:�̻�ID
	 * @ nonce_str:����ַ�����������32λ
	 * @ notify_url:����΢��֧���첽֪ͨ�ص���ַ
	 * @ openid:�û�openid
	 * @ out_trade_no:������
	 * @ spbill_create_ip:����ip
	 * @ total_fee:�������
	 * @ trade_type:֧������,ȡֵ���£�JSAPI��NATIVE��APP
	 * @ sign:ǩ���ܳף���������
	 */
	public function __construct($openid){
		$this->openid = $openid;
		$this->value['appid'] = $this->app_id;
		$this->value['openid'] = $this->openid;
		$this->value['spbill_create_ip'] = '123.57.49.61';
		$this->value['nonce_str'] = $this->createNoncestr();
		$this->value['trade_type'] = 'JSAPI';
		
		/*
		$this->value['mch_id'] = $this->mch_id;
		$this->value['notify_url'] = 'http://m.96567.com/weixin/pay/success.php';

		$this->value['attach'] = 'test_pay';
		$this->value['body'] = 'test';
		$this->value['out_trade_no'] = date('YmdHis');
		$this->value['total_fee'] = 100;
		*/
		
	}

	/**
	 * @ ���Ͷ�����Ϣ��ȡprepayID
	 */
	function send_pay(){
		$this->value['total_fee'] = $this->value['total_fee']*100;//������ɷ�
		$this->value['sign'] = $this->getSign($this->value);//����ǩ��
		$xml = $this->arrayToXml($this->value);
		$data = $this->httpsPOST($this->apiURL,$xml);
		$arr = $this->xmlToArray($data);
		$arr['return_msg'] = iconv('utf-8','gbk',$arr['return_msg']);
		$arr['err_code_des'] = iconv('utf-8','gbk',$arr['err_code_des']);
		//echo $arr['err_code_des'];
		//var_dump($arr);
		$this->prepay_id = $arr['prepay_id'];
		//echo $this->prepay_id;
		//exit;
	}

	/**
	 * @ ����jsapi�Ĳ���
	 */
	public function getParameters($type=0){
	    $timeStamp = time();
	    $jsApiObj["timeStamp"] = "$timeStamp";
		$jsApiObj["appId"] = $this->app_id;
	    $jsApiObj["nonceStr"] = $this->createNoncestr();
		$jsApiObj["package"] = "prepay_id=".$this->prepay_id;
	    $jsApiObj["signType"] = "MD5";
	    $jsApiObj["paySign"] = $this->getSign($jsApiObj);
		if($type){
			return json_encode($jsApiObj);
		}else{
			return $jsApiObj;
		}
	}
	
	public function cretaePayJs(){
		
		$jsPayApiArr = $this->getParameters(1);
		$jsStr = "<script type=\"text/javascript\">
		//����΢��JS api ֧��
		function jsApiCall(){
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				".$jsPayApiArr.",
				function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=='get_brand_wcpay_request:ok'){
						 alert('֧���ɹ�');
						 window.location.href='http://m.96567.com/user.php?act=order_detail&order_id=".$this->order_id."';
                    }else{
						// window.location.href='http://m.96567.com/respond.php?code=weixin&v=on';
					}
				}
			);
		}

		function callpay(){
			if (typeof WeixinJSBridge == \"undefined\"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
		</script>";
		return $jsStr;
	}

	/**
	 * @ arrayתxml
	 */
	function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
			if(is_numeric($val)){
				$xml.="<".$key.">".$val."</".$key.">"; 
			}else{
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">"; 
			}
        }	
        $xml.="</xml>";
        return $xml; 
    }

	/**
	 * @ ��xmlתΪarray
	 */
	public function xmlToArray($xml){		
        //��XMLתΪarray        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);		
		return $array_data;
	}

	/**
	 * @ ����ǩ��
	 */
	public function getSign($Obj){
		foreach ($Obj as $k => $v){ $value[$k] = $v; }
		//ǩ������һ�����ֵ����������
		$String = $this->formatBizQueryParaMap($value, false);
		$String = $String."&key=".$this->keyStr;
		$String = md5($String);
		$result_ = strtoupper($String);
		return $result_;
	}

	/**
	 * @ ��ʽ��������ǩ��������Ҫʹ��
	 */
	function formatBizQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
		    if($urlencode){ $v = urlencode($v); }
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0){
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}

	/**
	 *  @ �����������
	 */
	function setParameter($parameter, $parameterValue){
		$this->value[trim($parameter)] = trim($parameterValue);
	}

	/**
	 * @ ��������ַ�����������32λ
	 */
	public function createNoncestr($length = 32) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ($i = 0; $i < $length; $i++ ){  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str;
	}
}
?>