<?php
/*
	@�̻������̨�������
	@2013��7��6�տ���
	@������:����
	@��ϵQQ:9132761
*/
require_once(dirname(__FILE__)."/public/writeLog.class.php");
class manage extends model{
	protected $UID;//�û�ID
	protected $Umax;//�ͻ����������
	protected $Level;//��½Ȩ�޼�������
	protected $Number;//�̻���
	protected $where;//����ѯ����
	protected $NavList;//�˵�����
	protected $isAdmin;//����Ա�ж��ֶ� 1Ϊ����Ա��0Ϊ��ͨ�˻�
	protected $pMax = 10;//ÿҳ�����ʾ��������
	protected $Prefix;//��ǰ׺
	protected $startTime;//��ʼʱ��
	protected $endTime;//����ʱ��

	public function __construct(){
		parent::__construct();
		$m = G('m',2) ? G('m',2) : 'login';
		session_start();
		if( G('p',2)=='action' && $m=='manageTask' ){
			//�ж��Ƿ�ִ�мƻ�����
		}else if($m!='login'){//sessionȨ����֤����
			$this->setSession();//����Session��֤
			$this->checkLevel();//��⼶��Ȩ��
		}
		$this->where="Number=".W_NUMBER;
		$this->setTime();//���ر�������ʱ��
		$this->getConfigData();
	}

	/*
		@session��֤����
	*/
	private function setSession(){
		if(!$_SESSION['U_UserName'] && !$_SESSION['U_Level'] && !$_SESSION['U_Number']){
			echo '<script>top.location.href="index.php?m=login&p=manage"</script>';
			exit;
		}else{
			$this->UID = intval($_SESSION['U_ID']);
			$this->Level = $_SESSION['U_Level'];//���ص�½�û�Ȩ�޼���
			$this->Number = $_SESSION['U_Number'];//�����̻���
			$this->isAdmin = intval($_SESSION['U_isAdmin']);//���ع���Ա�ж��ֶ�
			$this->Umax = intval($_SESSION['U_Max']);//���ؼ�¼�ͻ����������
			$this->getUserMenu($this->UID);
		}
	}

	/*
		@�����û��˵��б�
	*/
	private function getUserMenu($uid){
		if($this->Level!='1'){
			$this->c->table('adminuser');
			$dataArr = $this->c->search("U_ID='".$uid."'",'','','U_NavList');
			$this->NavList = $dataArr[0]['U_NavList'];
		}elseif(!$this->isAdmin && $this->Level==1){
			$this->c->table('system_menu');
			$dataArr = $this->c->search("W_Number='".$this->Number."'",'','','W_Menu');
			$this->NavList = $dataArr[0]['W_Menu'];
			if(!$this->NavList){
				$this->NavList = json_encode($this->getMenuArrZ());
			}
		}else{
			$this->NavList = 1;
		}
	}

	/*
		@��ȡ�˵��б�����
	*/
	private function getMenuArrZ(){
		$this->c->table('managecate');
		$dataArr = $this->c->search('C_Type!=1','','','C_ID,C_Link');
		foreach($dataArr as $v){
			$tempArr[$v['C_ID']] = $v['C_Link'];
		}
		return $tempArr;
	}

	/*
		@�����Ŀ����Ȩ��
	*/
	private function checkLevel(){
		//����URL��ַ����
		$urlArr=explode('&',$_SERVER["QUERY_STRING"]);
		$url=trim($urlArr[0]);
		if( !strpos($this->NavList,$url) && !strpos($_SERVER["QUERY_STRING"],'p=action') && $this->isAdmin!=1 && !strpos($url,'manageIndex')){
			echo '����Ȩʹ�õ�ǰ����!';
			exit;
		}
	}
	
	/*
		@���س�ʼ����������
	*/
	private function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//���طֹ�˾����
		$this->tpl('DIR',DIR_MANAGE);//���طֹ�˾����·��
		$this->tpl('COMPANY',W_COMPANY);//���طֹ�˾����
		$this->tpl('W_NUMBER',W_NUMBER);//���طֹ�˾ID
		$this->tpl('W_ORDERMODE',W_ORDERMODE);//���طֹ�˾ID
		$this->tpl('W_VERMODE',W_VERMODE);//�����µ�ģʽ
		$this->tpl('LOGO',W_LOGO);//������֤ģʽ
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//���طֹ�˾ͼƬĿ¼
		$this->tpl('UID',$this->UID);//�������ID
		$this->tpl('level',$this->Level);//���뼶��ID
		$this->tpl('public_status',S_PUBLIC);//���뼶��ID
	}

	/**
	 * @ ��ȡÿҳ��ʾ����ҳ��
	 */	
	protected function getPageMax(){
		$pMax = G('pageMax',2,2);
		$this->pMax = $pMax ? $pMax : 10;
	}

	/**
	 * @ ���ݿ������л�
	 */
	protected function dbConnect(){
		if(W_ORDERMODE){
			$this->c = new mysqlAction(config::$dbShopArr);//ʵ�������ݿ����
			$this->Prefix = config::$dbShopArr['Prefix'];
		}else{
			$this->Prefix = config::$dbArr['Prefix'];
		}
	}

	/**
	 * @ ����ʱ�������
	 */
	protected function setTime(){
		$time = G('time') ? strtotime(G('time')) : time();
		$year = date('Y',$time);
		$month = date('m',$time);
		$day = date('j',$time);
		//$shijian = $year.'-'.($month+1);

		if(S_TIME=='No'){
			$endDay = Date('t',$time);
			$this->startTime = strtotime($year.'-'.$month.'-1');
			$this->endTime = strtotime($year.'-'.$month.'-'.$endDay);
		}else{
			$arr = explode('|',S_TIME);

			//������ʼʱ��
			if($arr[0]){
				if($day<$arr[1]){//�����ʼ����С�ڽ����������·ݼ�1������
					$startMonth = $month-1;
				}else{
					$startMonth = $month;
				}
				$this->startTime = $year.'-'.($startMonth).'-'.$arr[1];
			}else{
				$this->startTime = $year.'-'.$startMonth.'-'.$arr[1];
			}
			
			//���ý���ʱ��
			if($arr[2]){
				$this->endTime = $year.'-'.($month-1).'-'.$arr[1];
			}else{
				if($day>$arr[3]){//�������ʱ����ڽ���ʱ����ǰ�·ݼ�1Ϊ���½���ʱ��
					$endMonth = $month+1;	
				}else{
					$endMonth = $month;
				}
				$this->endTime = $year.'-'.$endMonth.'-'.$arr[3];
			}
			$this->startTime = strtotime($this->startTime.' 00:00:00');
			$this->endTime = strtotime($this->endTime.' 23:59:59');
		}
	}

	/*
		@������Ϣ���
	*/
	private function error($message){
		echo $message;
		exit;
	}
}

?>