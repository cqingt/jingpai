<?php
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/menu.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
class manageIndex extends manage{
	private $menuLevel;//���򵼺��˵�����
	private $userLevel;//�û����� 1:��������Ա 2:ϵͳ����Ա 3:Ա���˻�

	public function index(){
		$this->filename='index.html';
		$this->getLevel();
		$this->getSuperMenu();//���ض���������Ŀ�˵�
		//$this->getAccountInfo();//��ȡ�˻���Ϣ
		$this->toString();
	}

	/*
		@����ģ������
	*/
	public function getFram(){
		$TemName=G('t',2);
		$this->filename=$TemName.'.html';
		if($TemName=='left'){$this->getMenu();}//�ж��Ƿ�������˵�����
		if($TemName=='main'){$this->getMain();}//�ж��Ƿ������ҳ��ӭ��Ϣ
	}

	/*
		@���غ�̨�˵���
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
		$LID=1;//��ȡ�˵���Ŀֵ
		$LID = $this->CheckLevel($LID);//����Ƿ���Ȩ�޼���鿴�ò˵���

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
		@���س�������Ա�˵�����
	*/
	private function superAdminMenuArr(){
		$Menu=new menu($this->c,1);
		return $Menu->getMenu('C_Type',1);		
	}

	/*
		@������ͨ����Ա�˵�����
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
		@�����Ӳ˵����ݻ�����
	*/
	private function getSmallMenu($LID){
		$where = "C_Type IN('".$LID."')";
		$dataArr=json_decode($this->NavList,true);
		$arr=array_keys($dataArr);
		$this->c->table('managecate');
		$MenuArr=$this->c->search($where,'','','C_ID');
		$MenuArr=$this->Arrange($MenuArr);
		$dataArr=array_intersect($MenuArr,$arr);//����2�������ж�������Ȩ�޼���
		$data=join(',',$dataArr);
		return $data;
	}


	/*
		@����������
	*/
	private function Arrange($Array){
		if(!is_array($Array)){
			echo '���ݴ���!';
			exit;
		}
		foreach($Array as $v){ $temp[]=$v['C_ID']; }
		return $temp;
	}

	/*
		@������ҳ��ӭ��Ϣ
	*/
	private function getMain(){
		echo '��ӭ���پ���΢�Ź���ƽ̨';
	}


	/*
		@�˵�Ȩ������	
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
		if(!$l){ $l = $levelArr[0]; }//�����Ŀ����Ϊ����Ĭ����ʾ��һ����Ŀ�˵�
		if(!in_array($l,$levelArr) && !$this->isAdmin){
			echo '����Ȩ�޲鿴�ò˵���!';
			exit;
		}
		return $l;
	}
	
	/*
		@��ȡ�����ᵼ����Ϣ
	*/
	private function getSuperMenu(){
		$UserMenuConfigArr=config::$UserMenuConfigArr;
		if($this->isAdmin){//��������Աģʽ���ز˵�
			$arr = $UserMenuConfigArr;
		}else if($this->Level==1){//����Աģʽ���ز˵�
			if($this->menuLevel){
				$arr = $this->menuReturnArr($this->menuLevel,$UserMenuConfigArr);
			}else{
				unset($UserMenuConfigArr[1]);
				$arr = $UserMenuConfigArr;				
			}
		}else{//��ͨģʽ���ز˵�
			$tempArr = explode(',',$this->Level);
			$arr = $this->menuReturnArr($tempArr,$UserMenuConfigArr);
		}
		$this->tpl('configMenuArr',$arr);
	}

	/*
		@��ȡ�˻�������Ϣ
	*/
	private function getAccountInfo(){
		if($this->Level==1){
			$dataArr['U_Name'] = $_SESSION['U_UserName'];
			$dataArr['DepName'] = '������';
			$dataArr['Postion'] = '����Ա';
		}else if($this->isAdmin){
			$dataArr['U_Name'] = $_SESSION['U_UserName'];
			$dataArr['DepName'] = '��˾�ܲ�';
			$dataArr['Postion'] = '��������Ա';
		}else{//���³��������⣬���Ľ�
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
		@��ȡ�����˵�����
	*/
	private function getLevel(){
		if($this->isAdmin){//�����ж�
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
		@��ȡ�����˵�����
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