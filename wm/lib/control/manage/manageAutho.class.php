<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageAutho
 * 
 * @功能：账户管理主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageAutho.class.php
 * 
 * @开发时间：2014-08-26 15:28:17
 * 
 * @认证信息管理
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class manageAutho extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('user_info');
		$this->filename = 'userRZ.html';
	}

	
	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->getUserAuthoList();			
	}

	/**
	 * @ 加载会员认证信息列表
	 */
	private function getUserAuthoList(){
		$w = $this->createSearch();
		$url = "index.php?m=manageAutho&p=manage".$w[1];
		$where = "a.U_ID=b.U_ID".$w[0];
		$fileds = 'a.U_ID,a.U_UserName,a.U_Balance,a.U_Credit,a.U_Integral,a.U_OpenID,a.U_isRZ,a.U_Time as RegTime,b.U_Type,b.U_Status,b.U_Time';
		$page = new PageTurn($this->c,G('page',2,2),'user a,user_info b',$url,20,'b.U_Status ASC,b.U_Time DESC',$where);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}

	/**
	 * @ 创建认证信息搜索条件
	 */
	private function createSearch(){
		$a = G('a',2);
		if(!$a == 'search'){ return array(); }
		$key = G('key',2);
		if($key){
			$w[] = "(a.U_UserName='".$key."' OR b.U_Mobile='".$key."' OR b.U_Name='".$key."')";
			$u[] = 'key='.$key;
		}

		$rzType = G('rzType',2,2);
		if($rzType){
			$w[] = "b.U_Type='".$rzType."'";
			$u[] = 'rzType='.$rzType;
		}
		if(count($w)){
			$where = ' AND '.join(' AND ',$w);
			$url = '&'.join('&',$u);
		}
		return Array($where,$url);
	}

	/**
	 * @ 显示认证信息
	 */
	public function popViewAutho(){
		$uid = G('uid',2,2);
		$dataArr = $this->c->search("U_ID='".$uid."'");
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/popViewAutho.html';
	}

	/**
	 * @ 执行认证审核操作
	 */
	public function authoAction(){
		$uid = G('uid',1,2);
		$status = G('status',1,2);
		if($status){
			$content = G('U_Remark');
			$this->c->update(Array('U_Remark'=>$content,'U_Status'=>1,'U_rzTime'=>time()),"U_ID='".$uid."'");
			$this->c->table('user');
			$this->c->execute("UPDATE sw_user SET U_isRZ=1 WHERE U_ID='".$uid."'");
		}else{
			$this->c->del('U_ID',$uid);
			$this->c->table('user');
			$this->c->execute("UPDATE sw_user SET U_isRZ=0 WHERE U_ID='".$uid."'");
		}
		show('操作成功!');
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>