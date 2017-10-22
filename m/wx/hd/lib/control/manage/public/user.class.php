<?php
/*
	@账户信息加载公共类
*/
class user{
	private $uid;
	private $db;
	private $noStopWhere;
	public function __construct($uid,$stopStatus=0){
		$this->uid = intval($uid);
		$this->db = new mysqlAction(config::$dbArr,'user_info');

		if($stopStatus){//开启排除暂停账户信息
			$this->noStopWhere = " AND (SELECT U_Status FROM sw_adminuser WHERE sw_adminuser.U_ID=sw_user_info.U_ID)=0";
		}
	}

	/**
	 * @ 设置参数
	 */
	public function __set($name,$value){
		$this->$name = $value;
	}


	/**
	 * @ 获取用户信息
	 */
	public function getUserInfo($fileds=''){
		$fileds = $fileds ? $fileds : 'U_Name,(SELECT D_Name FROM sw_department WHERE D_ID=U_DepID) as DepName,(SELECT D_Name FROM sw_department WHERE D_ID=U_Team) as TeamName,(SELECT D_DepType FROM sw_department WHERE D_ID=U_DepID) as DepType';
		$this->db->table('user_info');
		$dataArr = $this->db->search("U_ID='".$this->uid."' AND Number='".W_NUMBER.$this->noStopWhere."'",'','',$fileds);
		return $dataArr[0];
	}

	/**
	 * @ 获取用户级别信息
	 */
	public function getUserLevel(){
		$this->db->table('user_info a,post b');
		$where = "a.U_ID='".$this->uid."' AND a.U_Post=b.P_ID AND a.Number='".W_NUMBER."'";
		$dataArr = $this->db->search($where,'','','a.U_DepID,a.U_Team,b.P_DepID,b.P_Level');
		return $dataArr[0];
	}

	/**
	 * @ 加载指定部门权限下的所有账户信息
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
	 * @ 获取级别下属全部账户ID
	 * @ $average 0:正常加载账户 1:排除暂停分配账户 2:排除暂停回收账户 3:查找暂停回收的账户
	 */
	public function getSubUserID($average=0){
		$cond = $this->Exclude($average);//检测是否存在排除条件
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
				echo '您的职位当前无法管理该功能!';
				exit;
		}

		$where = $where.$this->noStopWhere.$cond;//组合查询条件
		$dataArr = $this->db->search($where,'','','U_ID');
		if($dataArr)foreach($dataArr as $k=>$v){ $temp[] = $v['U_ID']; };
		return $temp;
	}

	/**
	 * @ 账户排除条件检测
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
	 * @ 获取指定部门ID下属全部账户ID
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