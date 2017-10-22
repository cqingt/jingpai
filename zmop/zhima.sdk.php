<?php
require_once(dirname(__FILE__).'/zmop/ZmopClient.php');
require_once(dirname(__FILE__).'/zmop/request/ZhimaAuthInfoAuthorizeRequest.php');
require_once(dirname(__FILE__).'/zmop/request/ZhimaCreditScoreGetRequest.php');
class zhima {
    public $ordersn; //查询流水单号

    protected $gatewayUrl = "https://zmopenapi.zmxy.com.cn/openapi.do"; //芝麻信用网关地址
    protected $privateKeyFile = "/home/rsa_key/rsa_private_key.pem"; //商户私钥文件
    protected $zmPublicKeyFile = "/home/rsa_key/zhima_public_key.pem"; //芝麻公钥文件
    protected $charset = "UTF-8"; //数据编码格式
    protected $appId = "1000740"; //芝麻分配给商户的appId
    protected $version = "2";
    protected $channel = "apppc"; //api:商户后台调用 apppc:商户pc调用 appsdk:商户移动sdk调用

    private $certNo;
    private $name;
    private $platform = 'test';

    public function __construct(){

    }

    /**
     * @创建身份授权连接
     */
    public function CreateAuthFreezeLink(){
        if($this->certNo && $this->name) {
            $client = new ZmopClient($this->gatewayUrl, $this->appId, $this->charset, $this->privateKeyFile, $this->zmPublicKeyFile);
            $request = new ZhimaAuthInfoAuthorizeRequest();
            $request->setScene($this->platform);
            // 授权来源渠道设置为apppc
            $request->setChannel($this->channel);
            // 授权类型 1：按照手机号进行授权 2：按照身份证+姓名进行授权
            $request->setIdentityType($this->version);
            // 构造授权业务入参证件号，姓名，证件
            $request->setIdentityParam('{"certNo":"'.$this->certNo.'","certType":"IDENTITY_CARD", "name":"'.$this->name.'"}');
            // 构造业务入参扩展参数
            //$request->setBizParams('{"auth_code":"M_APPPC_CERT","state":"xxx"}');
            return $client->generatePageRedirectInvokeUrl($request);
        }else{
            $this->ShowErrMes("姓名身份证号不能为空....");
        }
    }

    /**
     * @设置身份证号与姓名
     */
    public function SetCertNo($certNo, $name){
        if($certNo && $name){
            $this->certNo = $certNo;
            $this->name = $name;
        }else{
            $this->ShowErrMes("姓名身份证号不能为空....");
        }
    }

    /**
     * @内容解密操作
     */
    public function Decryption(){
        $params = $_GET['params'];
        $sign = $_GET['sign'];
        $decryptedParam = RSAUtil::rsaDecrypt($params, $this->privateKeyFile);
        $dataArr = explode("&",$decryptedParam);
        if(!empty($dataArr)){
            foreach($dataArr as $k=>$v){
                $arr = explode("=",$v);
                $tempArr[$arr[0]] = $arr[1];
            }
            return $tempArr;
        }else{
            return array();
        }

    }

    /**
     * @通过openid换取芝麻信用分值
     */
    public function GetZhimaScore($openid){
        $this->ordersn = $this->CreateNo();
        $client = new ZmopClient($this->gatewayUrl,$this->appId,$this->charset,$this->privateKeyFile,$this->zmPublicKeyFile);
        $request = new ZhimaCreditScoreGetRequest();
        $request->setChannel($this->channel);
        $request->setPlatform($this->platform);
        $request->setTransactionId($this->ordersn);// 必要参数 流水单号
        $request->setProductCode("w1010100100000000001");// 必要参数 产品id号
        $request->setOpenId($openid);// 必要参数
        $response = $client->execute($request);
        echo json_encode($response);
    }

    /**
     * @生成订单号
     */
    private function CreateNo(){
        return date("YmdHIs").rand(10000,99999).'0000000'.rand(100000,999999);
    }

    /**
     * @错误信息输出
     */
    private function ShowErrMes($message){
        echo $message;
        exit();
    }
}