<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������sms
 * 
 * @���ܣ������¼�������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�sms.class.php
 * 
 * @����ʱ�䣺2014-08-14 16:46:17
 * 
 * @�����¼�������
 * 
 */
require_once(dirname(__FILE__)."/../../plugins/sms/codeSMS.class.php");
class sms{
	public $sms;//���Ŷ�������
	private $mobile;//Ҫ���͵��ֻ�
	public function __construct(){
		//$this->check();
		$this->sms = new codeSMS;
		$this->mobile = G('mobile',3);
	}

	/**
	 * @ ������֤��
	 */	
	public function sendCode(){
		$this->sms->f($this->mobile,$this->createCode());
		echo $this->sms->status;
	}

	/**
	 * @ ������֤��
	 */
	private function createCode(){
		session_start();
		$code = rand(100000,999999);
		$_SESSION['sw_code'] = $code;
		$_SESSION['sw_codetime'] = time()+120;
		$content = "������֤����:".$code;
		return $content;
	}

	/**
	 * @ ��·�������
	 */
	private function check(){
		$from = $_SERVER['HTTP_REFERER'];
		if($from!=W_DOMAIN){
			echo 0;
			exit;
		}
	}
}

?>