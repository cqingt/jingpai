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
class weixinPAYBASE{
    public $openid;
    public $mch_id;
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
    public function __construct($openid = ''){
        $this->openid = $openid;
        $this->keyStr = WXN_KEY;
        //$this->value['notify_url'] = 'http://m.96567.com/weixin/pay/success.php';

        //$this->value['attach'] = 'test_pay';
        //$this->value['body'] = 'test';
        //$this->value['out_trade_no'] = date('YmdHis');
        //$this->value['total_fee'] = '1';


    }

    /**
     * @ 发送订单信息换取prepayID
     */
    function send_pay(){

        $this->value['appid'] = WXN_APPID;
        $this->value['openid'] = $this->openid;
        $this->value['spbill_create_ip'] = '123.56.146.201';
        $this->value['nonce_str'] = $this->createNoncestr();


        $this->value['mch_id'] = WXN_MCHID;
        $this->value['sign'] = $this->getSign($this->value);//生成签名

        $xml = $this->arrayToXml($this->value);
        $data = $this->httpsPOST($this->apiURL,$xml);
        $arr = $this->xmlToArray($data);

//        $arr['return_msg'] = iconv('utf-8','gbk',$arr['return_msg']);
//        $arr['err_code_des'] = iconv('utf-8','gbk',$arr['err_code_des']);
        //echo $arr['err_code_des'];
        if($arr['code_url'] != ""){
            return $arr;
        }
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
        $jsApiObj["appId"] = WXN_APPID;
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
        $returl_url = 'http://'.$_SERVER['HTTP_HOST'].'/wap/tmpl/member/order_list.html';
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
						 window.location.href='".$returl_url."';
                    }else{

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
    /*
        function arrayToXml($array, $xml = false){
            if($xml === false){
                $xml = new SimpleXMLElement('<root/>');
            }
            foreach($array as $key => $value){
                if(is_array($value)){
                    array2xml($value, $xml->addChild($key));
                }else{

    //$value=utf8_encode($value);

                    if (preg_match("/([x81-xfe][x40-xfe])/", $value, $match)) {
                        $value = iconv('gbk', 'utf-8', $value);
    //判断是否有汉字出现
                    }
                    $xml->addChild($key, $value);
                }
            }
            return $xml->asXML();
        }  */

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

    protected function httpsPOST($url,$data,$bianma=false){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        //$data = $bianma ? $data : iconv('gb2312','utf-8',$data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if(curl_errno($ch)){
            return 'Errno'.curl_error($ch);
        }
        curl_close($ch);
        return $tmpInfo;
    }

    /**
     * @ 生成签名
     */
    public function getSign($Obj){
        foreach ($Obj as $k => $v){ $value[$k] = $v; }

        $value = $this->parafilter($value);
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

    /**
     * 验证服务器通知 ->支付回调验签使用
     * @param array $data
     * @return array
     */
    public function notify_verify() {
        $post = $_POST;
        $sign = $_POST['sign'];
        $para = $this->parafilter($post);
        $para = $this->argsort($para);
        $signValue = $this->createlinkstring($para);
        $signValue = $signValue."&key=".$this->keyStr;
        $signValue = strtoupper(md5($signValue));
        if ( $sign == $signValue ){
            return true;
        }else{
            return false;
        }

    }

    /**
     * 除去数组中的空值和签名参数 ->支付回调验签使用
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    public	function parafilter($para) {
        $para_filter = array();
        foreach ($para as $key => $val ) {
            if($key == "sign_method" || $key == "sign" ||$val == "")continue;
            else	$para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序 ->支付回调验签使用
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    public function argsort($para) {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串 ->支付回调验签使用
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    public function createlinkstring($para) {
        $arg  = "";
        foreach ($para as $key => $val ) {
            $arg.=strtolower($key)."=".$val."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;

    }
}
?>