<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageVipCount
 * 
 * @功能：会员发布产品统计
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageVipCount.class.php
 * 
 * @开发时间：2014-12-9 15:28:17
 * 
 * @会员发布产品统计
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class manageVipCount extends manage{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @ 统计列表
	 */
	public function index(){
		$this->getVipCountlist();
		$this->filename = 'VipCount_list.html';	
	}

	/**
	 * @ 获取统计列表
	 */
	private function getVipCountlist(){
		$url = 'index.php?m=manageVipCount&p=manage';
		$where = "1=1";
		$fields = "U_UserName,U_Time,(select count(*) from sw_products where P_UID = U_ID) as num";
		$page = new PageTurn($this->c,G('page',2,2),'user',$url,20,'(select count(*) from sw_products where P_UID = U_ID) desc',$where,$fields);
		$dataArr = $page->dataArr;
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}

	
	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}

	
}
?>	