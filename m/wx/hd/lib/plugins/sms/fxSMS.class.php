<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������{[fxSMS]}
 * 
 * @���ܣ�{[��Ѷ���ŷ��ͽӿ�]}
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�fxSMS.class.php
 * 
 * @����ʱ�䣺2013-12-17 16:28:17
 * 
 */
require_once(dirname(__FILE__)."/../../model/interface/manage.class.php");
class fxSMS implements smsInterface{

	public function __construct($mobile,$content,$number){
		$this->mobile = $mobile;
		$this->content = $content;
		$this->number = $number;
	}

	/**
	 * @ ���ŷ���������
	 */
	public function f(){
		
	}
}
?>