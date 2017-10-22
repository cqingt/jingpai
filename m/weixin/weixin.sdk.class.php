<?php
/**
 * SW ΢��SDK�ӿ���
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������weixin
 * 
 * @���ܣ�΢�Žӿڲ�����
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�weixin.sdk.class.php
 * 
 * @����ʱ�䣺2014-2-28 23:00:00
 * wxa3c2d8e6cbb00de7
 * @΢��API��
 * c90a7bedba52f41e3e55a9bc85c13858
 */
class weixinSDK{
	public $openid;//΢���û�Ψһid

	protected $app_id = 'wx00d52d21505f383f';
	protected $appsecret = '1dad56778549190c2d1268caa9e2aa11';
	protected $token;
	private $opts = array('http'=>array('method'=>"GET",'timeout'=>3,));
	private $apiURL = 'https://api.weixin.qq.com/cgi-bin/';
	private $path = dirname(dirname(__FILE__)).'/wx/';
	
	public function __construct(){

					file_put_contents('weixin_sdk',$_SERVER['HTTP_REFERER'],FILE_APPEND);

		
		$this->path = dirname(__FILE__).'/../';
		file_put_contents('path.txt', $this->path);
		$token = @file_get_contents($this->path.'log/tuqtxs1392719300token');
		$token_time = @file_get_contents($this->path.'log/tuqtxs1392719300token_time');
		if(time()>$token_time){
			$this->getToken();
		}else{
			$this->token = $token;
		}
	}
	
	public function __get($name){
		return $this->$name;
	}

	/**
	 * @ ��ȡTokenֵ
	 */
	private function getToken(){
		$url = $this->apiURL.'token?grant_type=client_credential&appid='.$this->app_id.'&secret='.$this->appsecret;
		$jsonData = $this->httpGET($url);
		$object = json_decode($jsonData);
		$this->token = $object->access_token;

		//����token���ļ�
		if($this->token){
			@file_put_contents($this->path.'log/tuqtxs1392719300token',$this->token);
			@file_put_contents($this->path.'log/tuqtxs1392719300token_time',time()+600);
			
			if(file_exists($this->path.'log/'.date('Ymd'))){
				$num = file_get_contents($this->path.'log/'.date('Ymd'));
			}else{
				$num = 0;
			}
			@file_put_contents($this->path.'log/'.date('Ymd'),$num+1);
		}
		@file_put_contents($this->path.'log/tuqtxs1392719300token_log',$jsonData);
		//setcookie("sw_token", $this->token, time()+$object->expires_in);
	}

	/**
	 * @ ��΢���û�������Ϣ����
	 * @ $openID: ΢���û��ʺ�
	 * @ $content: ��������
	 * @ $type : �������� Ĭ��Ϊ�ı�ģʽ  
	 */
	public function sendMessage($openID,$content,$dataArr=array(),$type='text'){
		$api = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$this->token;
		$dataArr['touser'] = $openID;
		$dataArr['msgtype'] = $type;
		$dataArr[$type]['content'] = urlencode($content);
		$dataJSON =  urldecode(json_encode($dataArr));
		$returnJson = json_decode($this->httpPOST($api,$dataJSON),true);
	}

	/**
	 * @ ��ȡCodeֵ
	 */
	public function getCode($returnURL){
		$apiURL = "https://open.weixin.qq.com/connect/oauth2/authorize";
		$dataArr['appid'] = $this->app_id;
		$dataArr['redirect_uri'] = urlencode($returnURL);
		$dataArr['response_type'] = 'code';
		$dataArr['scope'] = 'snsapi_base';
		$dataArr['state'] = 'weixin';
		$url = $apiURL.'?'.$this->arrURL2str($dataArr).'#wechat_redirect';
		header("location:".$url);
	}

	/**
	 * @ ��ȡ�û�openid
	 * @ $code:΢�ŷ���codeֵ
	 */
	public function getOpenID($code){
		$apiURL = 'https://api.weixin.qq.com/sns/oauth2/access_token';
		$dataArr['appid'] = $this->app_id;
		$dataArr['secret'] = $this->appsecret;
		$dataArr['code'] = $code;
		$dataArr['grant_type'] = 'authorization_code';
		$url = $apiURL.'?'.$this->arrURL2str($dataArr);
		$jsonStr = $this->httpGET($url);
		$returnJson = json_decode($jsonStr,true);
		$this->openid = trim($returnJson['openid']);
	}

	/**
	 * @ ͨ��openid��ȡ�û�������Ϣ
	 */
	public function getUserInfo($openid){
		$apiURL = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->token."&openid=".$openid."&lang=zh_CN";	
		$jsonStr = $this->httpGET($apiURL);
		return json_decode($jsonStr,true);
	}

	/**
	 * @ �û���Ȩģʽ��ȡcodeֵ
	 */
	public function oauth($backURL){
		$apiURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->app_id."&redirect_uri=".urlencode($backURL)."&response_type=code&scope=snsapi_userinfo&state=sw#wechat_redirect";
		header("location:".$apiURL);
	}

	/**
	 * @ �û���Ȩģʽ��ȡaccess_tokenֵ
	 */
	private function getOauthToken($code){
		$apiURL = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->app_id."&secret=".$this->appsecret."&code=".$code."&grant_type=authorization_code";
		$jsonData = $this->httpGET($apiURL);
		$object = json_decode($jsonData);
		return $object;
	}

	public function getOauthUserInfo($code){
		$obj = $this->getOauthToken($code);
		$apiURL = "https://api.weixin.qq.com/sns/userinfo?access_token=".$obj->access_token."&openid=".$obj->openid."&lang=zh_CN";
		$jsonStr = $this->httpGET($apiURL);
		return json_decode($jsonStr,true);
	}

	/**
	 * @ ͨ��token��ȡjsapi
	 */
	public function getJsApi(){
		$ticket = file_get_contents('log/ticket');
		$ticket_time = file_get_contents('log/ticket_time');
		if(time()-$ticket_time>0 || !$ticket){
			$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->token.'&type=jsapi';
			$jsonStr = $this->httpGET($url);
			$arr = json_decode($jsonStr,true);
			$ticket = $arr['ticket'];

			//����ticket���ļ�
			file_put_contents('log/ticket',$ticket);
			file_put_contents('log/ticket_time',time()+7200);
			file_put_contents('log/ticket_log',$jsonStr);
		}
		return $ticket;
	}

	/**
	 * @ �����������url�ַ�����
	 */
	private function arrURL2str($arr){
		if(!is_array($arr)){ return false;}
		foreach($arr as $k=>$v){
			$tempArr[] = $k.'='.$v;
		}
		return join('&',$tempArr);
	}

	/**
	 * @ GETģʽ���ͽӿ�����
	 */
	protected function httpGET($url){
		$output = file_get_contents($url);
		return $output;
	}

	/**
	 * @ POSTģʽ���ͽӿ�����
	 */
	protected function httpPOST($url,$data){
		$curl = curl_init();      
		curl_setopt($curl, CURLOPT_URL, $url);       
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);      
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);      
		curl_setopt($curl, CURLOPT_POST, 1);      
		curl_setopt($curl, CURLOPT_POSTFIELDS, iconv('gb2312','utf-8',$data));      
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec($curl); 
		if (curl_errno($curl)) { 
			return 'Errno'.curl_error($curl);      
		}      
		curl_close($curl); 
		return $result;  
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
		$data = $bianma ? $data : iconv('gb2312','utf-8',$data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if(curl_errno($ch)){ 
			return 'Errno'.curl_error($ch);      
		}  
		curl_close($ch);
		return $tmpInfo;	
	}

	protected function httpsGET($url){
		$ch = curl_init();
		//$header = "Accept-Charset: gbk";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if(curl_errno($ch)){ 
			return 'Errno'.curl_error($ch);      
		}  
		curl_close($ch);
		return $tmpInfo;	
	}


	/**
	 * @ POST����΢�Ų˵�
	 */
	public function createMenu($data){
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->token;
		echo $this->httpsPOST($url,$data);
	}
}
?>