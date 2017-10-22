<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：{[k780]}
 * 
 * @功能：{[780多功能数据查询接口类]}
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：k780.class.php
 * 
 * @开发时间：2014-1-6 17:07:17
 * 
 */
class k780{
	public $dataArr;
	private $appkey = '10003'; 
	private $secret = 'd1149a30182aa2088ef645309ea193bf';
	private $sign;

	public function __construct(){
		$this->sign = md5(md5($this->appkey).$this->secret);
	}

	/**
	 * @ 手机归属地查询
	 */
	public function getMobileArr($mobile){
		$url='http://api.k780.com:88/?app=phone.get&phone='.$mobile.'&appkey='.$this->appkey.'&sign='.$this->sign.'&format=json';
		$dataArr = $this->getHttp($url);
		$this->dataArr = $this->utf2gb2312($dataArr);//编码转换
	}

	/**
	 * @ IP归属地查询
	 */
	public function getIP(){

	}

	/**
	 * @ 身份证信息查询
	 */
	public function getIDinfo(){

	}

	/**
	 * @ 天气信息查询
	 */
	public function getWeather(){

	}

	/**
	 * @ 二维码生成
	 */
	public function getCodeInfo(){

	}

	/**
	 * @ 编码转换
	 */
	private function utf2gb2312($dataArr){
		if(!is_array($dataArr['result'])){ return $dataArr; }
		foreach($dataArr['result'] as $k=>$v){ $dataArr['result'][$k] = str_replace(',','',iconv('utf-8','gb2312',$v)); }
		return $dataArr;	
	}

	/**
	 * @ 连接模式
	 */
	private function getHttp($url){
		$json = file_get_contents($url);
		return json_decode($json,true);
	}
}
?>