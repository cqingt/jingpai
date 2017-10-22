<?php
/*
	@日志写入类
*/
class writeLog{
	public static $smsStatusArr = Array('短信充值','验证码发送','单条营销短信','群发营销短信');//短信状态数组
	private $c;//数据库操作句柄
	private $Number;//商户号

	public function __construct($number=''){
		$this->c = new mysqlAction(config::$dbArr,'sms_log');//实例化数据库对象
		$this->Number = $number ? $number : W_NUMBER;
	}

	/**
	 * @ 记录短信日志
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
	 * @ 记录数据分配日志
	 * @ $dataArr:分配数据数组B_Status:判断是否为成交,B_Type:客户类型
	 * @ $fuid:获取数据的账户ID
	 * @ $uid:分配数据的账户
	 */
	public function dataLog($dataArr,$uid=0,$fuid=0){
		//获取数据收入人姓名
		$user = new user($fuid);
		$userArr = $user->getUserInfo('U_Name');
		$dataArr['L_fName'] = $userArr['U_Name'] ? $userArr['U_Name'] : '公共数据库';
		
		//获取分配人姓名
		$user->__set('uid',$uid);
		$userArr = $user->getUserInfo('U_Name');
		$dataArr['L_Name'] = $userArr['U_Name'] ? $userArr['U_Name'] : '公共数据库';

		//获取分配数据客户类型
		if($dataArr['B_Status']){
			$dataArr['L_Type'] = '成交客户';
		}else{
			if($dataArr['B_Type']){
				$cate = new customer;
				$dataArr['L_Type'] = $cate->getCategoryName($dataArr['B_Type']);
			}else{
				$dataArr['L_Type'] = '其它客户';
			}
		}
		
		$dataArr['Number'] = $this->Number;
		$dataArr['L_Time'] = time();
		$dataArr['L_ActionUser'] = $_SESSION['U_UserName'];
		$dataArr['L_Content'] = $dataArr['L_ActionUser'].'于'.date('Y-m-d H:i:s').'分配'.$dataArr['L_Name'].'的'.$dataArr['L_Type'].$dataArr['L_Num'].'条给'.$dataArr['L_fName'];

		$this->c->table('data_log');
		$this->c->insert($dataArr);
	}
}

?>