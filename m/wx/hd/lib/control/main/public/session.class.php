<?php
/**
 * SW session������
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������session
 * 
 * @���ܣ�session������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�session.class.php
 * 
 * @����ʱ�䣺2014-8-13 15:44:00
 * 
 * @session�����
 * 
 */
session_start();
class session{
	public $db;//���ݿ��������
	private $weixin;//΢�Ŵ���������
	public function __construct(){	
		$this->weixin = new weixinAPI;
	}

	public static function sessionRun($c){
		//$session = new session;
	}
}

?>