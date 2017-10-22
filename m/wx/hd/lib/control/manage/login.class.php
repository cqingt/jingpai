<?php
require_once(dirname(__FILE__)."/manage.class.php");
class login extends manage{

	public function __construct(){
		parent::__construct();
        $this->filename='login.html';
	}
	
	/*
		@�����½����
	*/
	public function index(){
		$this->toString();
	}

	/*
		@��½��֤����
	*/
	public function loginAction(){
		$Number=G('Number',1,2);
		$UserName=G('UserName');
		$Pass=md5(G('Pass'));
		$Code=G('Code');
		
		//��֤����
		if(strtolower($Code)!=strtolower($_SESSION['sw_code'])){//��֤��֤��
			show('��֤�����!');
			exit;
		}

		$this->c->table('adminuser a,system_info b');
		$dataArr=$this->c->search("a.U_Number='".$Number."' AND a.U_UserName='".$UserName."' AND a.U_Number=b.W_Number");
		//���е�½��֤
		if(count($dataArr)){
			if($dataArr[0]['U_Pass']==$Pass){
				$this->setSession($dataArr);//����Session����
				$this->writeLoginInfo($dataArr[0]['U_ID']);//��¼��½��Ϣ
				show("��½�ɹ�,��ǰʱ��:".date('Y-m-d H:i',time()).".��½IP:".getIP(),'index.php?m=manageIndex&p=manage');
			}else{
				show('�������');
			}
		}else{
			show('�̻���Ϣ����,���ʵ���������!');
		}
	}

	/*
		@����Seession����
	*/
	private function setSession($dataArr){
		$_SESSION['U_ID'] = $dataArr[0]['U_ID'];
		$_SESSION['U_Number'] = $dataArr[0]['U_Number'];
		$_SESSION['U_UserName'] = $dataArr[0]['U_UserName'];
		$_SESSION['U_Level'] = $dataArr[0]['U_Level'];//��¼�ᵼ��Ȩ��
		$_SESSION['U_isAdmin'] = $dataArr[0]['U_isAdmin'];//�Ƿ�Ϊ����Ա
		$_SESSION['U_Max'] = $dataArr[0]['U_Max'];//��¼�ͻ����������
	}

	/*
		@��¼��½��Ϣ
	*/
	private function writeLoginInfo($uid){
		$IP=getIP();//��ȡ��ǰ��½IP
		$this->c->table('adminuser');
		$this->c->update(Array('U_LoginIP'=>$IP,'U_LoginTime'=>time()),"U_ID='".$uid."'");
	}

	/*
		@��½�˳�����
	*/
	public function logout(){
		$_SESSION = Array();
		unset($_SESSION);
		show("�˳��ɹ�!","index.php?m=login&p=manage");
	}
	
	/*
		@������֤��
	*/
	public function createCode(){
		include('lib/model/class/captcha.class.php');
		$Code=new Code();
		$Code->show();
	}

	/*
		@���س�ʼ����������
	*/
	private function getConfigData(){
		$this->tpl('DIR',DIR_MANAGE);
		$this->tpl('COMPANY',W_COMPANY);
		$this->tpl('YEAR',date('Y'));
	}
}

?>