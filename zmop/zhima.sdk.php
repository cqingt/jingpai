<?php
require_once(dirname(__FILE__).'/zmop/ZmopClient.php');
require_once(dirname(__FILE__).'/zmop/request/ZhimaAuthInfoAuthorizeRequest.php');
require_once(dirname(__FILE__).'/zmop/request/ZhimaCreditScoreGetRequest.php');
class zhima {
    public $ordersn; //��ѯ��ˮ����

    protected $gatewayUrl = "https://zmopenapi.zmxy.com.cn/openapi.do"; //֥���������ص�ַ
    protected $privateKeyFile = "/home/rsa_key/rsa_private_key.pem"; //�̻�˽Կ�ļ�
    protected $zmPublicKeyFile = "/home/rsa_key/zhima_public_key.pem"; //֥�鹫Կ�ļ�
    protected $charset = "UTF-8"; //���ݱ����ʽ
    protected $appId = "1000740"; //֥�������̻���appId
    protected $version = "2";
    protected $channel = "apppc"; //api:�̻���̨���� apppc:�̻�pc���� appsdk:�̻��ƶ�sdk����

    private $certNo;
    private $name;
    private $platform = 'test';

    public function __construct(){

    }

    /**
     * @���������Ȩ����
     */
    public function CreateAuthFreezeLink(){
        if($this->certNo && $this->name) {
            $client = new ZmopClient($this->gatewayUrl, $this->appId, $this->charset, $this->privateKeyFile, $this->zmPublicKeyFile);
            $request = new ZhimaAuthInfoAuthorizeRequest();
            $request->setScene($this->platform);
            // ��Ȩ��Դ��������Ϊapppc
            $request->setChannel($this->channel);
            // ��Ȩ���� 1�������ֻ��Ž�����Ȩ 2���������֤+����������Ȩ
            $request->setIdentityType($this->version);
            // ������Ȩҵ�����֤���ţ�������֤��
            $request->setIdentityParam('{"certNo":"'.$this->certNo.'","certType":"IDENTITY_CARD", "name":"'.$this->name.'"}');
            // ����ҵ�������չ����
            //$request->setBizParams('{"auth_code":"M_APPPC_CERT","state":"xxx"}');
            return $client->generatePageRedirectInvokeUrl($request);
        }else{
            $this->ShowErrMes("�������֤�Ų���Ϊ��....");
        }
    }

    /**
     * @�������֤��������
     */
    public function SetCertNo($certNo, $name){
        if($certNo && $name){
            $this->certNo = $certNo;
            $this->name = $name;
        }else{
            $this->ShowErrMes("�������֤�Ų���Ϊ��....");
        }
    }

    /**
     * @���ݽ��ܲ���
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
     * @ͨ��openid��ȡ֥�����÷�ֵ
     */
    public function GetZhimaScore($openid){
        $this->ordersn = $this->CreateNo();
        $client = new ZmopClient($this->gatewayUrl,$this->appId,$this->charset,$this->privateKeyFile,$this->zmPublicKeyFile);
        $request = new ZhimaCreditScoreGetRequest();
        $request->setChannel($this->channel);
        $request->setPlatform($this->platform);
        $request->setTransactionId($this->ordersn);// ��Ҫ���� ��ˮ����
        $request->setProductCode("w1010100100000000001");// ��Ҫ���� ��Ʒid��
        $request->setOpenId($openid);// ��Ҫ����
        $response = $client->execute($request);
        echo json_encode($response);
    }

    /**
     * @���ɶ�����
     */
    private function CreateNo(){
        return date("YmdHIs").rand(10000,99999).'0000000'.rand(100000,999999);
    }

    /**
     * @������Ϣ���
     */
    private function ShowErrMes($message){
        echo $message;
        exit();
    }
}