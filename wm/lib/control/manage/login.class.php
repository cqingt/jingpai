<?php
require_once(dirname(__FILE__)."/manage.class.php");
class login extends manage{

	public function __construct(){
		parent::__construct();
        $this->filename='login.html';
	}
	
	/*
		@输出登陆界面
	*/
	public function index(){
		$this->toString();
	}

	/*
		@登陆验证方法
	*/
	public function loginAction(){
		$Number=G('Number',1,2);
		$UserName=G('UserName');
		$Pass=md5(G('Pass'));
		$Code=G('Code');
		
		//验证码检测
		if(strtolower($Code)!=strtolower($_SESSION['sw_code'])){//验证验证码
			show('验证码错误!');
			exit;
		}

		$this->c->table('adminuser a,system_info b');
		$dataArr=$this->c->search("a.U_Number='".$Number."' AND a.U_UserName='".$UserName."' AND a.U_Number=b.W_Number");
		//进行登陆验证
		if(count($dataArr)){
			if($dataArr[0]['U_Pass']==$Pass){
				$this->setSession($dataArr);//加载Session数据
				$this->writeLoginInfo($dataArr[0]['U_ID']);//记录登陆信息
				show("登陆成功,当前时间:".date('Y-m-d H:i',time()).".登陆IP:".getIP(),'index.php?m=manageIndex&p=manage');
			}else{
				show('密码错误！');
			}
		}else{
			show('商户信息有误,请核实后从新输入!');
		}
	}

	/*
		@加载Seession数据
	*/
	private function setSession($dataArr){
		$_SESSION['U_ID'] = $dataArr[0]['U_ID'];
		$_SESSION['U_Number'] = $dataArr[0]['U_Number'];
		$_SESSION['U_UserName'] = $dataArr[0]['U_UserName'];
		$_SESSION['U_Level'] = $dataArr[0]['U_Level'];//记录横导航权限
		$_SESSION['U_isAdmin'] = $dataArr[0]['U_isAdmin'];//是否为管理员
		$_SESSION['U_Max'] = $dataArr[0]['U_Max'];//记录客户最大上限数
	}

	/*
		@记录登陆信息
	*/
	private function writeLoginInfo($uid){
		$IP=getIP();//获取当前登陆IP
		$this->c->table('adminuser');
		$this->c->update(Array('U_LoginIP'=>$IP,'U_LoginTime'=>time()),"U_ID='".$uid."'");
	}

	/*
		@登陆退出方法
	*/
	public function logout(){
		$_SESSION = Array();
		unset($_SESSION);
		show("退出成功!","index.php?m=login&p=manage");
	}
	
	/*
		@生成验证码
	*/
	public function createCode(){
		include('lib/model/class/captcha.class.php');
		$Code=new Code();
		$Code->show();
	}
}

?>