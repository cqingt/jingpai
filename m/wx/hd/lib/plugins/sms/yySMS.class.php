<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������{[yySMS]}
 * 
 * @���ܣ�{[�����ͽӿ�]}
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�yySMS.class.php
 * 
 * @����ʱ�䣺2014-3-17 09:10:17
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