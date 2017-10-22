<?php
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/menu.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
class manageIndex extends manage{
	private $menuLevel;//横向导航菜单级别
	private $userLevel;//用户级别 1:超级管理员 2:系统管理员 3:员工账户

	public function index(){
		$this->filename='index.html';
		$this->getLevel();
		$this->getSuperMenu();//加载顶部导航栏目菜单
		//$this->getAccountInfo();//获取账户信息
		$this->toString();
	}

	/*
		@加载模板数据
	*/
	public function getFram(){
		$TemName=G('t',2);
		$this->filename=$TemName.'.html';
		if($TemName=='left'){$this->getMenu();}//判断是否加载左侧菜单数据
		if($TemName=='main'){$this->getMain();}//判断是否加载首页欢迎信息
	}

	/*
		@加载后台菜单类
	*/
	private function getMenu(){
		if($this->isAdmin){
			$this->userLevel = 1;
		}elseif($this->Level=='1' && !$this->isAdmin){
			$this->userLevel = 2;
		}else{
			$this->userLevel = 3;
		}

		$this->getLevel();
		$LID=1;//获取菜单栏目值
		$LID = $this->CheckLevel($LID);//检测是否有权限级别查看该菜单组

		switch($this->userLevel){
			case 1:
				$menuArr = $this->superAdminMenuArr();
				$LID = 1;
				break;
			case 2:
				$menuArr = $this->adminMenuArr($LID);
				break;
			case 3:
				$menuArr = $this->adminMenuArr($LID);
				break;
		}
		$this->tpl('menuArr',$menuArr);
		$this->tpl('LID',$LID);
		$this->toString();
	}
	
	/*
		@加载超级管理员菜单数据
	*/
	private function superAdminMenuArr(){
		$Menu=new menu($this->c,1);
		return $Menu->getMenu('C_Type',1);		
	}

	/*
		@加载普通管理员菜单数据
	*/
	private function adminMenuArr($LID){
		$Menu=new menu($this->c,$LID);
		if($this->NavList){
			$LID = $this->getSmallMenu($LID);
			$menuArr = $Menu->getMenu('C_ID',$LID);
		}else{
			$menuArr = $Menu->getMenu('C_Type',$LID);
		}
		return $menuArr;
	}


	/*
		@进行子菜单数据化处理
	*/
	private function getSmallMenu($LID){
		$where = "C_Type IN('".$LID."')";
		$dataArr=json_decode($this->NavList,true);
		$arr=array_keys($dataArr);
		$this->c->table('managecate');
		$MenuArr=$this->c->search($where,'','','C_ID');
		$MenuArr=$this->Arrange($MenuArr);
		$dataArr=array_intersect($MenuArr,$arr);//计算2个数组中都包含的权限级别
		$data=join(',',$dataArr);
		return $data;
	}


	/*
		@数组整理方法
	*/
	private function Arrange($Array){
		if(!is_array($Array)){
			echo '数据错误!';
			exit;
		}
		foreach($Array as $v){ $temp[]=$v['C_ID']; }
		return $temp;
	}

	/*
		@加载首页欢迎信息
	*/
	private function getMain(){
		echo '欢迎光临精灵微信管理平台';
	}


	/*
		@菜单权限组检测	
	*/
	private function CheckLevel($l){
		$this->getLevel();
		if($this->Level=="1"){
			if(!$this->menuLevel){
				$menuArr = config::$UserMenuConfigArr;
				unset($menuArr[1]);
				foreach($menuArr as $k=>$v){ $arr[] = $k; }
				$this->Level = join(',',$arr);
			}elseif($this->menuLevel==1){
				$this->Level = $this->menuLevel;
			}else{
				$this->Level = join(',',$this->menuLevel);
			}
		}
		$levelArr = explode(',',$this->Level);
		if(!$l){ $l = $levelArr[0]; }//如果栏目级别为空则默认显示第一个栏目菜单
		if(!in_array($l,$levelArr) && !$this->isAdmin){
			echo '您无权限查看该菜单组!';
			exit;
		}
		return $l;
	}
	
	/*
		@获取顶部横导航信息
	*/
	private function getSuperMenu(){
		$UserMenuConfigArr=config::$UserMenuConfigArr;
		if($this->isAdmin){//超级管理员模式加载菜单
			$arr = $UserMenuConfigArr;
		}else if($this->Level==1){//管理员模式加载菜单
			if($this->menuLevel){
				$arr = $this->menuReturnArr($this->menuLevel,$UserMenuConfigArr);
			}else{
				unset($UserMenuConfigArr[1]);
				$arr = $UserMenuConfigArr;				
			}
		}else{//普通模式加载菜单
			$tempArr = explode(',',$this->Level);
			$arr = $this->menuReturnArr($tempArr,$UserMenuConfigArr);
		}
		$this->tpl('configMenuArr',$arr);
	}

	/*
		@获取账户基本信息
	*/
	private function getAccountInfo(){
		if($this->Level==1){
			$dataArr['U_Name'] = $_SESSION['U_UserName'];
			$dataArr['DepName'] = '技术部';
			$dataArr['Postion'] = '管理员';
		}else if($this->isAdmin){
			$dataArr['U_Name'] = $_SESSION['U_UserName'];
			$dataArr['DepName'] = '公司总部';
			$dataArr['Postion'] = '超级管理员';
		}else{//以下程序有问题，待改进
			//$fields = 'U_Name,U_ID,U_DepID,U_Team,(SELECT D_Name FROM sw_department WHERE D_ID=U_DepID) as DepName,(SELECT D_Name FROM sw_post WHERE P_ID=U_Post) as Postion';
			$fields = 'U_Name,U_ID,U_DepID,U_Post';
			$user = new user($this->UID);
			$dataArr = $user->getUserInfo($fields);
			
			$this->c->table('department');
			$depArr = $this->c->search("D_ID='".$dataArr['U_DepID']."'",'','','D_Name');
			
			$this->c->table('post');
			$postArr = $this->c->search("P_ID='".$dataArr['U_Post']."'",'','','P_Name');

			$dataArr['DepName'] = $depArr[0]['D_Name'];
			$dataArr['Postion'] = $postArr[0]['P_Name'];
		}
		$this->tpl('userArr',$dataArr);
	}

	/*
		@获取超级菜单数据
	*/
	private function getLevel(){
		if($this->isAdmin){//超管判断
			$this->menuLevel = 1;
			return 1;
		}
		$this->c->table('system_menu');
		$dataArr = $this->c->search("W_Number='".$this->Number."'");
		if($dataArr[0]['W_Level'] == '0'){
			$this->menuLevel = 0;
		}else{
			$this->menuLevel = explode(',',$dataArr[0]['W_Level']);
		}
	}

	/*
		@获取超级菜单数据
	*/
	private function menuReturnArr($tempArr,$UserMenuConfigArr){
		if(!count($tempArr)){ return $tempArr; }
		foreach($tempArr as $v){
			$arr[$v]=$UserMenuConfigArr[$v];
		}
		return $arr;
	}

}
?>