<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������{[k780]}
 * 
 * @���ܣ�{[780�๦�����ݲ�ѯ�ӿ���]}
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�k780.class.php
 * 
 * @����ʱ�䣺2014-1-6 17:07:17
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
	 * @ �ֻ������ز�ѯ
	 */
	public function getMobileArr($mobile){
		$url='http://api.k780.com:88/?app=phone.get&phone='.$mobile.'&appkey='.$this->appkey.'&sign='.$this->sign.'&format=json';
		$dataArr = $this->getHttp($url);
		$this->dataArr = $this->utf2gb2312($dataArr);//����ת��
	}

	/**
	 * @ IP�����ز�ѯ
	 */
	public function getIP(){

	}

	/**
	 * @ ���֤��Ϣ��ѯ
	 */
	public function getIDinfo(){

	}

	/**
	 * @ ������Ϣ��ѯ
	 */
	public function getWeather(){

	}

	/**
	 * @ ��ά������
	 */
	public function getCodeInfo(){

	}

	/**
	 * @ ����ת��
	 */
	private function utf2gb2312($dataArr){
		if(!is_array($dataArr['result'])){ return $dataArr; }
		foreach($dataArr['result'] as $k=>$v){ $dataArr['result'][$k] = str_replace(',','',iconv('utf-8','gb2312',$v)); }
		return $dataArr;	
	}

	/**
	 * @ ����ģʽ
	 */
	private function getHttp($url){
		$json = file_get_contents($url);
		return json_decode($json,true);
	}
}
?>