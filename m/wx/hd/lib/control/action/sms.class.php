<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：sms
 * 
 * @功能：短信事件处理类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：sms.class.php
 * 
 * @开发时间：2014-08-14 16:46:17
 * 
 * @短信事件处理类
 * 
 */
require_once(dirname(__FILE__)."/../../plugins/sms/codeSMS.class.php");
class sms{
	public $sms;//短信对象属性
	private $mobile;//要发送的手机
	public function __construct(){
		//$this->check();
		$this->sms = new codeSMS;
		$this->mobile = G('mobile',3);
	}

	/**
	 * @ 发送验证码
	 */	
	public function sendCode(){
		$this->sms->f($this->mobile,$this->createCode());
		echo $this->sms->status;
	}

	/**
	 * @ 生成验证码
	 */
	private function createCode(){
		session_start();
		$code = rand(100000,999999);
		$_SESSION['sw_code'] = $code;
		$_SESSION['sw_codetime'] = time()+120;
		$content = "您的验证码是:".$code;
		return $content;
	}

	/**
	 * @ 来路域名检测
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