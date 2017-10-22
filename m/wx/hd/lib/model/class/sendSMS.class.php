<?php
/*
����:���ŷ�����
������:ʢ��

*/

class sendSMS{	
	private $smsURL;//���Žӿ��������͵�ַ
	private $smsAPI="http://www.sms1086.com/plan/Api/Send.aspx";
	private $smsUser; //���Žӿ��û���
	private $smsPass; //��Ϣ��ӿ�����
	private $smsContent; //���ŷ�������
	private $smsMobile; //���ŷ�������Ŀ���ֻ�
	private $smsCompany='���Ѳ���������'; //�������ݰ�Ȩ��˾
	private $Status;//���ŷ���״̬
	public $MobileNumber=array('13','18','15','14');

	function __construct($User,$Pass,$Company=''){
		$this->smsUser=$User;
		$this->smsPass=$Pass;
		if($Company){
			$this->smsPass=$Company;
		}
	}
	
	//���ŷ��ͷ���
	function send($Mobile,$Content){
		$this->smsMobile=$this->CheckMobile($Mobile);//��ⷢ���ֻ�����
		$this->smsContent=$Content;//��¼��������
		if($this->smsMobile){
			$this->smsURL=$this->smsAPI.'?username='.$this->smsUser.'&password='.$this->smsPass.'&mobiles='.$this->smsMobile.'&content='.$this->smsContent.$this->smsCompany.'&f=1';
			$str=file_get_contents($this->smsURL);
			$this->SendCheck($str);//��ⷢ���Ƿ�ɹ�
		}else{
			echo $Mobile.'�ֻ��Ų���ȷ!';
		}
	}

	//���ͳɹ����
	function SendCheck($str){
		$Arr=explode('=',$str);
		$max=count($Arr)-1;//��ȡ���һ������Ԫ��

		if($Arr[1]=='0'){
			$this->Status=urldecode($Arr[$max]);
		}else{
			$this->Status=urldecode($Arr[$max]);
		}
	}

	//��ȡ����״̬����
	function getStstus(){
		return $this->Status;
	}

	//����ֻ�����ȷ�ķ���
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