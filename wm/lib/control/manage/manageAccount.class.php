<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageAccount
 * 
 * @功能：账户管理主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageAccount.class.php
 * 
 * @开发时间：2013-12-24 16:28:17
 * 
 * @账户管理
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/manageMenu.class.php");
require_once(dirname(__FILE__)."/manageSystem.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
require_once(dirname(__FILE__)."/public/orderButton.class.php");
class manageAccount extends manage{
	private $postionLevel;//职位级别

	public function __construct(){
		parent::__construct();
		$this->c->table('adminuser');
		$this->Number = $this->Number ? $this->Number : G('number',3,2);
		$this->filename = 'account.html';
	}

	
	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->getAccountList();			
	}

	/**
	 * @ 加载账户列表
	 */
	private function getAccountList(){
		$w = $this->createAccountWhere();
		$url = 'index.php?m=manageAccount&p=manage'.$w[1];
		$where = 'a.U_ID = b.U_ID AND '.$this->where.$w[0];

		$uidStr = join(',',$this->getLowerUserID());
		$where.=" AND a.U_ID IN(".$uidStr.") AND (SELECT P_Level FROM sw_post WHERE P_ID=b.U_Post)>'".$this->postionLevel."'";//按照级别筛选显示账户
		$fields = 'a.U_ID,a.U_UserName,a.U_Status,a.U_RegTime,b.U_Name,b.U_Mobile,b.U_Isallot,b.U_Callback,(SELECT D_Name FROM sw_department WHERE D_ID=b.U_DepID) AS DepName,(SELECT D_Name FROM sw_department WHERE D_ID=b.U_Team) AS TeamName,(SELECT P_Name FROM sw_post WHERE P_ID=b.U_Post) AS PostName';

		$this->c = new mysqlAction(config::$dbArr);
		$page = new PageTurn($this->c,G('page',2,2),'adminuser a,user_info b',$url,20,'a.U_Status ASC,b.U_DepID,b.U_Team DESC',$where,$fields);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->tpl('postlevel',$this->postionLevel);
	}

	/**
	 * @ 帐号搜索创建
	 */
	private function createAccountWhere(){
		$a = G('a',2);
		if($a != 'search'){ return array(); }
		$key = G('key',2);
		$depID = G('depID',2,2);
		$teamID = G('teamID',2,2);
		$postID = G('postID',2,2);
		$u[] = 'a=search';

		if($key){//按照账户，姓名，手机搜索
			$w[] = "(a.U_UserName='".$key."' OR b.U_Name LIKE '%".$key."%' OR b.U_Mobile='".$key."')";
			$u[] = "key=".$key;
		}
		if($depID){//按照部门搜索
			$w[] = "b.U_DepID='".$depID."'";
			$u[] = "depID=".$depID;
		}
		if($teamID){//按照小组搜索
			$w[] = "b.U_Team='".$teamID."'";
			$u[] = "teamID=".$teamID;
		}
		if($postID){//按照职位搜索
			$w[] = "b.U_Post='".$postID."'";
			$u[] = "postID=".$postID;
		}
		if(count($w)){ $where = ' AND '.join(' AND ',$w); }
		if(count($u)){ $url = '&'.join('&',$u); }
		
		$this->tpl('depID',$depID);
		$this->tpl('teamID',$teamID);

		return Array($where,$url);
	}

	/**
	 * @ 账户编辑信息展示
	 */
	public function popEditAccount(){
		$uid = G('uid',2,2);
		$fields = "U_ID,U_DepID,U_Team,U_Img,U_Post,U_Name,U_Mobile,U_Isallot,(SELECT U_Max FROM sw_adminuser WHERE U_ID='".$uid."') as U_Max,(SELECT U_UserName FROM sw_adminuser WHERE U_ID='".$uid."') as UserName,U_OrderButton";
		$this->c->table('user_info');
		$dataArr = $this->c->search("U_ID='".$uid."' AND ".$this->where,'','',$fields);
		$dataArr[0]['U_Img'] = str_replace('clerkImg/','clerkImg_small/small_',$dataArr[0]['U_Img']);
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl('buttonArr',json_decode($dataArr[0]['U_OrderButton'],true));
		$this->tpl('orderButtonArr',$this->getOrderButton(orderButton::$orderActionArr));
		$this->filename = 'pop/popEditAccount.html';
	}

	/**
	 * @ 按照级别权限显示订单处理按钮
	 */
	private function getOrderButton($arr1){
		$buttonArr = $this->c->search("U_ID='".$this->UID."' AND ".$this->where,'','','U_OrderButton');
		$arr = json_decode($buttonArr[0]['U_OrderButton'],true);
		if(is_array($arr) && count($arr)){
			foreach($arr as $k=>$v){
				if($v){
					foreach($v as $k1=>$v1){
						$temp[$k][$v1] = $arr1[$k][$v1];
					}
				}
			}
		}else{
			$temp = orderButton::$orderActionArr;
		}
		return $temp;
	}

	/**
	 * @ 还原账户密码
	 */
	public function reduction(){
		$uid = intval(G('uid',3));
		$userArr['U_Pass'] = md5('96567');
		$this->c->update($userArr,"U_ID='".$uid."' AND U_".$this->where);
		show('还原成功!密码：（96567）');
	}

	/**
	 * @ 暂停分配数据
	 */
	public function stopAllot(){
		$uid = intval(G('uid',3));
		$U_Isallot = G('U_Isallot',3);
		$userArr['U_Isallot'] = $U_Isallot;
		$this->c->table('user_info');
		$this->c->update($userArr,"U_ID='".$uid."' AND ".$this->where);
		if($U_Isallot == 0){
			$str = '恢复分配数据成功!';
		}elseif($U_Isallot == 1){
			$str = '暂停分配数据成功!';
		}
		show($str);
	}
	
	/**
	 * @ 暂停回收数据
	 */
	public function stopCallback(){
		$uid = intval(G('uid',3));
		$U_Callback = G('U_Callback',3);
		$userArr['U_Callback'] = $U_Callback;
		$this->c->table('user_info');
		$this->c->update($userArr,"U_ID='".$uid."' AND ".$this->where);
		if($U_Callback == 0){
			$str = '恢复回收数据成功!';
		}elseif($U_Callback == 1){
			$str = '暂停回收数据成功!';
		}
		show($str);
	}

	/**
	 * @ 账户信息更新
	 */
	public function updateAccount(){
		$uid = G('uid',1,2);
		$dataArr['U_Max'] = G('U_Max',1,2);
		if(G('U_UserName')){ $dataArr['U_UserName'] = G('U_UserName'); }
		$this->c->update($dataArr,"U_ID='".$uid."' AND U_".$this->where);
		$userArr['U_DepID'] = G('DepID',1,2);
		$userArr['U_Team'] = G('Team',1,2);
		$userArr['U_Post'] = G('Postion',1,2);
		$userArr['U_Name'] = G('U_Name');
		$userArr['U_Mobile'] = G('U_Mobile');
		$userArr['U_Isallot'] = G('U_Isallot',1,2);
		$userArr['U_Img'] = $this->uploadClerkImg();
		$userArr['U_OrderButton'] = orderButton::getButtonIDArr();
		$this->c->table('user_info');
		$this->c->update($userArr,"U_ID='".$uid."' AND ".$this->where);
		show('信息更新成功!');
	}

	/**
	 * @ 添加账户
	 */
	public function showAddAccount(){
		$menuArr =$this->getMenuArr();
		$this->tpl('menuArr',$menuArr);
		$this->filename="pop/popAddAccount.html";
	}

	/**
	 * @ 执行账户添加操作
	 */
	public function addAccount(){
		$dataArr['U_Number'] = $userArr['Number'] = $this->Number;
		$dataArr['U_UserName'] = G('U_UserName');
		$dataArr['U_Pass'] = md5(G('U_Pass'));
		$dataArr['U_RegTime'] = time();
		$dataArr['U_Level'] = join(',',G('Menu'));
		$dataArr['U_Max'] = G('U_Max',1,2);
		$dataArr['U_NavList'] = manageSystem::levelToStr(G('MenuID'));
		$userArr['U_Isallot'] = G('U_Isallot',1,2);
		$userArr['U_Img'] = $this->uploadClerkImg();

		$this->c->insert($dataArr);
		
		/*写入会员资料信息*/
		$this->c->table('user_info');
		$userArr['U_ID'] = $this->c->insertID();
		$userArr['U_DepID'] = G('DepID',1,2);
		$userArr['U_Team'] = G('Team',1,2);
		$userArr['U_Post'] = G('Postion',1,2);
		$userArr['U_Name'] = G('U_Name');
		$userArr['U_Mobile'] = G('U_Mobile');
		$userArr['U_Time'] = time();
		$this->c->insert($userArr);

		show('账户开设成功!','index.php?m=manageAccount&p=manage');
	}

	/**
	 * @ 账户菜单编辑
	 */
	public function popAccountEditMenu(){
		$uid = G('uid',2,2);
		$this->c->table('adminuser');
		$dataArr = $this->c->search("U_ID='".$uid."' AND U_".$this->where,'','',"U_ID,U_UserName,U_Level,U_NavList");
		$arr = json_decode($dataArr[0]['U_NavList'],true);
		$idArr = array_keys($arr);//获取该账户拥有的菜单功能
		$menuArr =$this->getMenuArr();//读取全部菜单
		
		$this->tpl('menuArr',$menuArr);
		$this->tpl('menuLevelArr',explode(',',$dataArr[0]['U_Level']));
		$this->tpl('idArr',$idArr);
		$this->tpl('dataArr',$dataArr[0]);

		$this->filename='pop/popEditAccountMenu.html';	
	}

	/**
	 * @ 账户菜单更新
	 */
	public function updateAccountMenu(){
		$uid = G('uid',1,2);
		$dataArr['U_Level'] = join(',',G('Menu'));
		$dataArr['U_NavList'] = manageSystem::levelToStr(G('MenuID'));
		$this->c->update($dataArr,"U_ID='".$uid."' AND U_".$this->where);
		show('权限菜单编辑成功!');
	}

	/**
	 * @ 删除账户
	 */
	public function delAccount(){
		$uid = G('uid',2,2);
		$this->c->table('customer');
		$num = $this->c->sumRows("B_UserID='".$uid."' AND B_isDel=0 AND ".$this->where);
		if($num){
			show('当前账户下存在数据无法删除!');
		}else{
			$this->c->table('adminuser');
			$this->c->del('U_ID',$uid,'U_'.$this->where);

			$this->c->table('user_info');
			$this->c->del('U_ID',$uid,$this->where);
			show('账户删除成功!');
		}
	}

	/**
	 * @ 显示账户弹窗搜索界面
	 */
	public function popSearchAccount(){
		$a = G('a');
		if($a == 'search'){
			$key = G('key');
			$type = G('type',1,2);
			switch($type){
				case 1:
					$where = "b.U_Name LIKE '".$key."%'";
					break;
				case 2:
					$where = "b.U_Mobile='".$key."'";
					break;
				case 3:
					$where = "a.U_UserName='".$key."'";
					break;
			}
			if(!$key){ $where = "1=1"; }
			$where.=" AND a.U_ID=b.U_ID AND b.".$this->where;
			$uidStr = join(',',$this->getLowerUserID());
			$where.=" AND a.U_ID IN(".$uidStr.")";

			$fields = 'a.U_ID,b.Number,a.U_UserName,b.U_Name,b.U_Mobile,(SELECT D_Name FROM sw_department WHERE D_ID=b.U_DepID) AS DepName,(SELECT D_Name FROM sw_department WHERE D_ID=b.U_Team) AS TeamName,(SELECT P_Name FROM sw_post WHERE P_ID=b.U_Post) AS PostName';

			$this->c = new mysqlAction(config::$dbArr,'adminuser a,user_info b');
			$dataArr = $this->c->search($where,'','',$fields);
			$this->tpl('dataArr',$dataArr);
		}
		$this->filename = 'pop/popSearchAccount.html';
	}

	/**
	 * @ 暂停账户
	 */
	public function stopAccount(){
		$uid = G('uid',2,2);
		$this->c->update(array('U_Status'=>1),"U_ID='".$uid."'");
		show('操作成功!');
	}

	/**
	 * @ 恢复账户
	 */
	public function startAccount(){
		$uid = G('uid',2,2);
		$this->c->execute("UPDATE sw_adminuser SET U_Status=0 WHERE U_ID='".$uid."'");
		show('操作成功!');
	}

	/**
	 * @ 上传业务员照片
	 */
	private function uploadClerkImg(){
		//照片上传
		$imgArr = G('U_Img',4);
		if($imgArr['name']){
			$folder = 'static/upload/images/'.$this->FolderName.'/clerkImg';
			$up = new upload($imgArr,$folder);
			$up->small_width = 90;
			$up->small_height = 100;
			return $up->upimg();
		}
	}

	private function getLowerUserID(){
		$user = new user($this->UID);
		$uidArr = $user->getSubUserID();
		
		//获取当前账号级别
		if($this->Level==1){
			$this->postionLevel = 0;
		}else{
			$pArr = $user->getUserInfo("(SELECT P_Level FROM sw_post WHERE P_ID=U_Post) as Level");	
			$this->postionLevel = $pArr['Level'];
		}
		return $uidArr;
	}

	/**
	 * @ 加载菜单
	 */
	private function getMenuArr(){
		if($this->NavList==1){
			$menuArr = manageMenu::getMenuArr($this->c);
		}else{
			$idArr = array_keys(json_decode($this->NavList,true));
			$menuArr = manageMenu::getMenuSelect($this->c,$idArr);
		}
		return $menuArr;
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>