<?php
/**
 * SW session控制类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：session
 * 
 * @功能：session控制类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：session.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @session检测类
 * 
 */
session_start();
class session{
	public $db;//数据库操作对象
	private $weixin;//微信处理类属性
	public function __construct(){	
		$this->weixin = new weixinAPI;
	}

	public static function sessionRun($c){
		//$session = new session;
	}
}

?>