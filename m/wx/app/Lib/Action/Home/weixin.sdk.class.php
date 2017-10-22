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
 * 
 * @微信SDK
 * 
 */
class weixin{
	public $openid;//微信用户唯一id

	private $app_id = 'wx00d52d21505f383f';
	private $appsecret = '1dad56778549190c2d1268caa9e2aa11';
	private $token;
	private $apiURL = 'https://api.weixin.qq.com/cgi-bin/';
	
	public function __construct(){
		$this->getToken();
	}

	/**
	 * @ 获取Token值
	 */
	private function getToken(){
		$url = $this->apiURL.'token?grant_type=client_credential&appid='.$this->app_id.'&secret='.$this->appsecret;
		$jsonData = $this->httpGET($url);
		$object = json_decode($jsonData);
		$this->token = $object->access_token;
		setcookie("sw_token", $this->token, time()+$object->expires_in);
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
		file_put_contents('token.txt',$api.$dataJSON);
		$returnJson = json_decode($this->httpPOST($api,$dataJSON),true);
		print_r($returnJson);
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
		echo $this->openid;
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
		file_put_contents('back.txt',$result);
		return $result;  
	}
}
?>