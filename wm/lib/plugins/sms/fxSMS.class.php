<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：{[fxSMS]}
 * 
 * @功能：{[飞讯短信发送接口]}
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：fxSMS.class.php
 * 
 * @开发时间：2013-12-17 16:28:17
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
	 * @ 短信发送主方法
	 */
	public function f(){
		
	}
}
?>