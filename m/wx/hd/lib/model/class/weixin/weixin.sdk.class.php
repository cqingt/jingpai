<?php
/**
 * SW 微信SDK接口类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：weixin
 * 
 * @功能：微信接口操作类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：weixin.sdk.class.php
 * 
 * @开发时间：2014-2-28 23:00:00
 * wxa3c2d8e6cbb00de7
 * @微信API类
 * c90a7bedba52f41e3e55a9bc85c13858
 */
class weixinSDK{
	public $openid;//微信用户唯一id

	private $app_id = 'wx00d52d21505f383f';
	private $appsecret = '1dad56778549190c2d1268caa9e2aa11';
	private $token;
	private $apiURL = 'https://api.weixin.qq.com/cgi-bin/';
	
	public function __construct(){
		$token = file_get_contents('token');
		$token_time = file_get_contents('token_time');
		if(time()>$token_time){
			$this->getToken();
		}else{
			$this->token = $token;
		}
	}

	private function __get($name){
		return $this->$name;
	}

	/**
	 * @ 获取Token值
	 */
	private function getToken(){
		$url = $this->apiURL.'token?grant_type=client_credential&appid='.$this->app_id.'&secret='.$this->appsecret;
		$jsonData = $this->httpGET($url);
		$object = json_decode($jsonData);
		$this->token = $object->access_token;

		//保存token到文件
		file_put_contents('token',$this->token);
		file_put_contents('token_time',time()+600);
		file_put_contents('token_log',$jsonData);
		//setcookie("sw_token", $this->token, time()+$object->expires_in);
	}

	/**
	 * @ 向微信用户发送消息方法
	 * @ $openID: 微信用户帐号
	 * @ $content: 发送内容
	 * @ $type : 发送类型 默认为文本模式  
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
	 * @ 获取Code值
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
	 * @ 获取用户openid
	 * @ $code:微信返回code值
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
	 * @ 通过openid获取用户基本信息
	 */
	public function getUserInfo($openid){
		$apiURL = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->token."&openid=".$openid."&lang=zh_CN";
		$jsonStr = $this->httpGET($apiURL);
		return json_decode($jsonStr,true);
	}

	/**
	 * @ 用户授权模式获取code值
	 */
	public function oauth($backURL){
		$apiURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->app_id."&redirect_uri=".urlencode($backURL)."&response_type=code&scope=snsapi_userinfo&state=sw#wechat_redirect";
		header("location:".$apiURL);
	}

	/**
	 * @ 用户授权模式获取access_token值
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
	 * @ 通过token获取jsapi
	 */
	public function getJsApi(){
		$ticket = file_get_contents('log/ticket');
		$ticket_time = file_get_contents('log/ticket_time');
		if(time()-$ticket_time>0 || !$ticket){
			$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->token.'&type=jsapi';
			$jsonStr = $this->httpGET($url);
			$arr = json_decode($jsonStr,true);
			$ticket = $arr['ticket'];

			//保存ticket到文件
			file_put_contents('log/ticket',$ticket);
			file_put_contents('log/ticket_time',time()+7200);
			file_put_contents('log/ticket_log',$jsonStr);
		}
		return $ticket;
	}

	/**
	 * @ 将数组整理成url字符数据
	 */
	private function arrURL2str($arr){
		if(!is_array($arr)){ return false;}
		foreach($arr as $k=>$v){
			$tempArr[] = $k.'='.$v;
		}
		return join('&',$tempArr);
	}

	/**
	 * @ GET模式发送接口数据
	 */
	private function httpGET($url){
		$output = file_get_contents($url);
		return $output;
	}

	/**
	 * @ POST模式发送接口数据
	 */
	private function httpPOST($url,$data){
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

	private function httpsPOST($url,$data){
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
		curl_setopt($ch, CURLOPT_POSTFIELDS, iconv('gb2312','utf-8',$data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if(curl_errno($ch)){ 
			return 'Errno'.curl_error($ch);      
		}  
		curl_close($ch);
		return $tmpInfo;	
	}

	private function httpsGET($url){
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
	 * @ POST创建微信菜单
	 */
	public function createMenu($data){
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->token;
		echo $this->httpsPOST($url,$data);
	}
}
?>