<?php
/*
	@��־д����
*/
class writeLog{
	public static $smsStatusArr = Array('���ų�ֵ','��֤�뷢��','����Ӫ������','Ⱥ��Ӫ������');//����״̬����
	private $c;//���ݿ�������
	private $Number;//�̻���

	public function __construct($number=''){
		$this->c = new mysqlAction(config::$dbArr,'sms_log');//ʵ�������ݿ����
		$this->Number = $number ? $number : W_NUMBER;
	}

	/**
	 * @ ��¼������־
	 */
	public function smsLog($dataArr,$type=0){
		if(!is_array($dataArr)){ return false; }
		$dataArr['Number'] = $this->Number;
		$dataArr['L_Type'] = $type;
		$dataArr['L_Time'] = time();

		$this->c->table('sms_log');
		$this->c->insert($dataArr);
		return true;
	}

	/**
	 * @ ��¼���ݷ�����־
	 * @ $dataArr:������������B_Status:�ж��Ƿ�Ϊ�ɽ�,B_Type:�ͻ�����
	 * @ $fuid:��ȡ���ݵ��˻�ID
	 * @ $uid:�������ݵ��˻�
	 */
	public function dataLog($dataArr,$uid=0,$fuid=0){
		//��ȡ��������������
		$user = new user($fuid);
		$userArr = $user->getUserInfo('U_Name');
		$dataArr['L_fName'] = $userArr['U_Name'] ? $userArr['U_Name'] : '�������ݿ�';
		
		//��ȡ����������
		$user->__set('uid',$uid);
		$userArr = $user->getUserInfo('U_Name');
		$dataArr['L_Name'] = $userArr['U_Name'] ? $userArr['U_Name'] : '�������ݿ�';

		//��ȡ�������ݿͻ�����
		if($dataArr['B_Status']){
			$dataArr['L_Type'] = '�ɽ��ͻ�';
		}else{
			if($dataArr['B_Type']){
				$cate = new customer;
				$dataArr['L_Type'] = $cate->getCategoryName($dataArr['B_Type']);
			}else{
				$dataArr['L_Type'] = '�����ͻ�';
			}
		}
		
		$dataArr['Number'] = $this->Number;
		$dataArr['L_Time'] = time();
		$dataArr['L_ActionUser'] = $_SESSION['U_UserName'];
		$dataArr['L_Content'] = $dataArr['L_ActionUser'].'��'.date('Y-m-d H:i:s').'����'.$dataArr['L_Name'].'��'.$dataArr['L_Type'].$dataArr['L_Num'].'����'.$dataArr['L_fName'];

		$this->c->table('data_log');
		$this->c->insert($dataArr);
	}
}

?>