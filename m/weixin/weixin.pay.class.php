<?php
/**
 * SW 微信SDK接口类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：weixinPAY
 * 
 * @功能：微信支付操作类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：weixin.sdk.class.php
 * 
 * @开发时间：2014-2-28 23:00:00
 * 
 * @微信PAY类
 * 
 */
class weixinPAY extends weixinSDK{
	public $openid;
	//public $mch_id = '1226270402';
	public $value;//请求参数，类型为关联数组
	public $keyStr;
	public $order_id;
	
	private $prepay_id;
	private $apiURL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

	/**
	 * @ 设置订单参数
	 * @ appid:微信id
	 * @ attach:支付标题
	 * @ body:订单名称
	 * @ mch_id:商户ID
	 * @ nonce_str:随机字符串，不长于32位
	 * @ notify_url:接收微信支付异步通知回调地址
	 * @ openid:用户openid
	 * @ out_trade_no:订单号
	 * @ spbill_create_ip:发送ip
	 * @ total_fee:订单金额
	 * @ trade_type:支付类型,取值如下：JSAPI，NATIVE，APP
	 * @ sign:签名密匙，计算所得
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
	 * @ 发送订单信息换取prepayID
	 */
	function send_pay(){
		$this->value['total_fee'] = $this->value['total_fee']*100;//将金额换算成分
		$this->value['sign'] = $this->getSign($this->value);//生成签名
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
	 * @ 设置jsapi的参数
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
		//调用微信JS api 支付
		function jsApiCall(){
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				".$jsPayApiArr.",
				function(res){
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=='get_brand_wcpay_request:ok'){
						 alert('支付成功');
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
	 * @ array转xml
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
	 * @ 将xml转为array
	 */
	public function xmlToArray($xml){		
        //将XML转为array        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);		
		return $array_data;
	}

	/**
	 * @ 生成签名
	 */
	public function getSign($Obj){
		foreach ($Obj as $k => $v){ $value[$k] = $v; }
		//签名步骤一：按字典序排序参数
		$String = $this->formatBizQueryParaMap($value, false);
		$String = $String."&key=".$this->keyStr;
		$String = md5($String);
		$result_ = strtoupper($String);
		return $result_;
	}

	/**
	 * @ 格式化参数，签名过程需要使用
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
	 *  @ 设置请求参数
	 */
	function setParameter($parameter, $parameterValue){
		$this->value[trim($parameter)] = trim($parameterValue);
	}

	/**
	 * @ 产生随机字符串，不长于32位
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