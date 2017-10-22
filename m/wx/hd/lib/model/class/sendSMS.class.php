<?php
/*
类名:短信发送类
开发者:盛威

*/

class sendSMS{	
	private $smsURL;//短信接口完整发送地址
	private $smsAPI="http://www.sms1086.com/plan/Api/Send.aspx";
	private $smsUser; //短信接口用户名
	private $smsPass; //短息年接口密码
	private $smsContent; //短信发送内容
	private $smsMobile; //短信发送内容目标手机
	private $smsCompany='【搜藏天下网】'; //短信内容版权公司
	private $Status;//短信发送状态
	public $MobileNumber=array('13','18','15','14');

	function __construct($User,$Pass,$Company=''){
		$this->smsUser=$User;
		$this->smsPass=$Pass;
		if($Company){
			$this->smsPass=$Company;
		}
	}
	
	//短信发送方法
	function send($Mobile,$Content){
		$this->smsMobile=$this->CheckMobile($Mobile);//检测发送手机号码
		$this->smsContent=$Content;//记录发送内容
		if($this->smsMobile){
			$this->smsURL=$this->smsAPI.'?username='.$this->smsUser.'&password='.$this->smsPass.'&mobiles='.$this->smsMobile.'&content='.$this->smsContent.$this->smsCompany.'&f=1';
			$str=file_get_contents($this->smsURL);
			$this->SendCheck($str);//检测发送是否成功
		}else{
			echo $Mobile.'手机号不正确!';
		}
	}

	//发送成功检测
	function SendCheck($str){
		$Arr=explode('=',$str);
		$max=count($Arr)-1;//获取最后一个数组元素

		if($Arr[1]=='0'){
			$this->Status=urldecode($Arr[$max]);
		}else{
			$this->Status=urldecode($Arr[$max]);
		}
	}

	//读取发送状态方法
	function getStstus(){
		return $this->Status;
	}

	//检测手机号正确的方法
	function CheckMobile($mobile){
		if(!is_numeric($mobile)){
			return false;
		}elseif(strlen($mobile)!=11){
			return false;
		}elseif(!in_array(substr($mobile,0,2),$this->MobileNumber)){
			return false;
		}else{
			return $mobile;
		}
	}
}
?>