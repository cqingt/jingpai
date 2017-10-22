<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageLog
 * 
 * @功能：系统日志管理主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageLogo.class.php
 * 
 * @开发时间：2014-4-21 15:28:17
 * 
 * @系统日志管理
 * 
 */
set_time_limit(0);
if(file_exists('config/business_config/'.W_NUMBER.'.inc.php')){
	include('config/business_config/'.W_NUMBER.'.inc.php');
}
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
require_once(dirname(__FILE__)."/public/mobile.class.php");
require_once(dirname(__FILE__)."/public/writeLog.class.php");
require_once(dirname(__FILE__)."/../action/customer.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class manageLog extends manage{

	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * @ 默认主控类方法
	 */
	public function index(){
			
	}

	/**
	 * @ 数据分配日志管理
	 */
	public function dataLog(){
		$this->filename = 'dataLog.html';

		$url = 'index.php?m=manageLog&c=dataLog&p=manage';
		$where = $this->where;
		$page = new PageTurn($this->c,G('page',2,2),'data_log',$url,50,'L_Time DESC',$where);

		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr());
	}

	/**
	 * @ 短信发送日志管理
	 */
	public function smsLog(){
		$this->filename = 'smsLog.html';
		$type = G('type',2,2);
		$url = 'index.php?m=manageLog&c=smsLog&p=manage';
		if($type){
			$w = " AND L_Type='".$type."'";
		}
		$where = $this->where.$w;
		$page = new PageTurn($this->c,G('page',2,2),'sms_log',$url,50,'L_Time DESC',$where);
		
		$this->tpl('smsCateArr',writeLog::$smsStatusArr);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr());
		$this->tpl('type',$type);
	}


	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>