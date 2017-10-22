<?php
/*
	@�˻���Ϣ���ع�����
*/
class user{
	private $uid;
	private $db;
	private $noStopWhere;
	public function __construct($uid,$stopStatus=0){
		$this->uid = intval($uid);
		$this->db = new mysqlAction(config::$dbArr,'user_info');

		if($stopStatus){//�����ų���ͣ�˻���Ϣ
			$this->noStopWhere = " AND (SELECT U_Status FROM sw_adminuser WHERE sw_adminuser.U_ID=sw_user_info.U_ID)=0";
		}
	}

	/**
	 * @ ���ò���
	 */
	public function __set($name,$value){
		$this->$name = $value;
	}


	/**
	 * @ ��ȡ�û���Ϣ
	 */
	public function getUserInfo($fileds=''){
		$fileds = $fileds ? $fileds : 'U_Name,(SELECT D_Name FROM sw_department WHERE D_ID=U_DepID) as DepName,(SELECT D_Name FROM sw_department WHERE D_ID=U_Team) as TeamName,(SELECT D_DepType FROM sw_department WHERE D_ID=U_DepID) as DepType';
		$this->db->table('user_info');
		$dataArr = $this->db->search("U_ID='".$this->uid."' AND Number='".W_NUMBER.$this->noStopWhere."'",'','',$fileds);
		return $dataArr[0];
	}

	/**
	 * @ ��ȡ�û�������Ϣ
	 */
	public function getUserLevel(){
		$this->db->table('user_info a,post b');
		$where = "a.U_ID='".$this->uid."' AND a.U_Post=b.P_ID AND a.Number='".W_NUMBER."'";
		$dataArr = $this->db->search($where,'','','a.U_DepID,a.U_Team,b.P_DepID,b.P_Level');
		return $dataArr[0];
	}

	/**
	 * @ ����ָ������Ȩ���µ������˻���Ϣ
	 */
	public function getUserInfoArr($arr=array()){
		if(!is_array($arr) || !count($arr)){
			$arr = $this->getSubUserID();
		}
		$idStr = join(',',$arr) ? join(',',$arr) : 0;
		$fields = "U_ID,U_Name,(SELECT D_Name FROM sw_department WHERE D_ID=U_DepID) as DepName,(SELECT D_Name FROM sw_department WHERE D_ID=U_Team) as TeamName";
		$order = 'U_DepID ASC,U_Team ASC,U_Post ASC';
		$userArr = $this->db->search("U_ID IN(".$idStr.") AND Number=".W_NUMBER.$this->noStopWhere,$order,'',$fields);
		return $userArr;
	}


	/**
	 * @ ��ȡ��������ȫ���˻�ID
	 * @ $average 0:���������˻� 1:�ų���ͣ�����˻� 2:�ų���ͣ�����˻� 3:������ͣ���յ��˻�
	 */
	public function getSubUserID($average=0){
		$cond = $this->Exclude($average);//����Ƿ�����ų�����
		$userArr = $this->getUserLevel();
		$this->db->table('user_info');
		switch($userArr['P_Level']){
			case 0:
				$where = "Number='".W_NUMBER."'";
				break;
			case 1:
				$where = "U_DepID IN(".$userArr['P_DepID'].") AND Number='".W_NUMBER."'";
				break;
			case 2:
				$where = "U_DepID IN(".$userArr['P_DepID'].") AND Number='".W_NUMBER."'";
				break;
			case 3:
				$where = "U_DepID IN(".$userArr['P_DepID'].") AND U_Team='".$userArr['U_Team']."' AND Number='".W_NUMBER."'";
				break;
			case 4:
			case 5:
				$where = "U_ID='".$this->uid."' AND Number='".W_NUMBER."'";
				break;
			default :
				echo '����ְλ��ǰ�޷�����ù���!';
				exit;
		}

		$where = $where.$this->noStopWhere.$cond;//��ϲ�ѯ����
		$dataArr = $this->db->search($where,'','','U_ID');
		if($dataArr)foreach($dataArr as $k=>$v){ $temp[] = $v['U_ID']; };
		return $temp;
	}

	/**
	 * @ �˻��ų��������
	 */
	private function Exclude($average){
		switch($average){
			case 1:
				$AND = ' AND U_Isallot = 0';
				break;
			case 2:
				$AND = ' AND U_Callback = 0';
				break;
			case 3:
				$AND = ' AND U_Callback = 1';
				break;
		}
		return $AND;
	}

	/**
	 * @ ��ȡָ������ID����ȫ���˻�ID
	 */
	public function getDepUserID($id,$fields){
		if($fields=='bumen'){
			$where = "U_DepID='".$id."' AND Number='".W_NUMBER."'";
		}else{
			$where = "U_Team='".$id."' AND Number='".W_NUMBER."'";
		}
		return $this->db->search($where.$this->noStopWhere,'','','U_ID');
	}
}

?>