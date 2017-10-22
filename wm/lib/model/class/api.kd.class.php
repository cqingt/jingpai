<?php
/**
 * 快递100 API类
 * @author 实惠女人网    by 叶木盛
 * @link  http://www.shihui.cn
 * @version 2012-06-07
 */
class KaidiApi{
	private $key='988300fecc481025';//API KEY 快递100申请获得 ，申请地址：http://www.kuaidi100.com/openapi/


	/**
	 * 加载物流数据
	 * @param string $wldh  物流单号
	 * @param string $wlgs_dm 物流公司代码
	 * @param string $valicode 验证码   部分物流公司需要验证码
	 */
	public function loadWL($wldh,$wlgs_dm,$valicode=''){
		$key=$this->key;
		if(!$valicode){
			//是否需要输入验证码，
			if($this->needValicode($wlgs_dm)){
				return array('message'=>'必须输入验证码','status'=>408);
			}
		}
		$url="http://api.kuaidi100.com/api?id={$key}&com={$wlgs_dm}&nu={$wldh}&valicode={$valicode}&show=0&muti=0";
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_HEADER,0);
		if($valicode){
		  	curl_setopt($curl,CURLOPT_COOKIE,"JSESSIONID={$_COOKIE['wl_JSESSIONID']}");
		 }
		 curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
		 curl_setopt ($curl, CURLOPT_TIMEOUT,5);
		 $result = curl_exec($curl);
		 curl_close ($curl);
		$result=json_decode($result,true);

		if(!empty($result) && $result['status']==1){

		}elseif($result['status']==408 || $result['status']==4){
			//如果验证码错误，要求重新输入
			return array('message'=>'验证码错误，请重新输入！','status'=>408);
		}

		//$result不是数组，说明有异常
		if(!is_array($result)) $result=array();
		if(empty($result)) return array('message'=>'无数据返回，可能原因：网络异常 或 单号没录入！','status'=>0);
		else return $result;
	}
	
	/**
	 * 判断物流公司是否需要输入验证码
	 * @param string $wlgs_dm 物流公司代码
	 */
	public function needValicode($wlgs_dm){
		//定义必须输入验证码的快递公司代码
		$need=array('nanjing','ems','shentong','shunfeng','xingchengjibian','youzhengguonei');
		if(in_array($wlgs_dm,$need)){
			return true;
		}
		return false;
	}
	/**
	 * 加载验证码
	 */
	public function loadValicode($wlgs_dm){
		$url='http://api.kuaidi100.com/verifyCode?id='.$this->key.'&com='.$wlgs_dm;
		$img=file_get_contents($url);
		//获取快递100响应头的session_id，用于需要验证码时，保持与快递100的session_id一致
		foreach($http_response_header as $val){
			if(strpos($val,'Set-Cookie')!==false){
				$a=explode(';',$val);
				$b=explode('=',$a[0]);
				setcookie('wl_JSESSIONID',trim($b[1]),time()+3600);
				break;
			}
		}
		return $img;
	}
	
}
?>