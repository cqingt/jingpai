<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������sms
 * 
 * @���ܣ����ŷ���������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�sms.class.php
 * 
 * @����ʱ�䣺2013-12-17 16:28:17
 * 
 * @���ŷ�����
 * 
 */

class sms extends manage{
	private $filePath;//���Ŀ¼

	public function __construct(){
		parent::__construct();
		$this->filePath = $_SERVER['DOCUMENT_ROOT'].'/lib/plugins/sms';//���ض��Ų��Ŀ¼
	}

	/**
	 * @ ִ�жη��Ϳ�����
	 */	
	public function send($mobile,$content,$setTime=''){
		$smsConfigInfo = $this->getSMSinfo();
		$this->c = new mysqlAction(config::$dbArr);//ʵ�������ݿ����
		$className = $smsConfigInfo['S_F'];
		include_once($this->filePath.'/'.$className.'.class.php');
		$sms = new $className;
		$sms->setTime = $setTime;
		$sms->F($mobile,$content);
		if($sms->status==1){//�ж��Ƿ�۷�
			$this->deduction(($smsConfigInfo['S_Num']-$sms->successCounts),$smsConfigInfo['S_Level']);
		}
		//��¼���ŷ�����־
		$logArr['L_Num'] = $sms->successCounts;
		$logArr['L_Status'] = $sms->status;
		$logArr['L_ActionUser'] = $_SESSION['U_UserName'];
		$logArr['L_Content'] = $content;
		$this->writeLog($logArr);//��¼��־
	}


	/**
	 * @ ���ض��Ų���б�
	 */	
	public function loadPlugin(){
		$arr = listFile($this->filePath);
		$smsPluginArr = $this->getPluginInfo($arr);
		return $smsPluginArr;
	}

	/**
	 * @ ��ȡ���Ų����Ϣ����������
	 */	
	private function getPluginInfo($arr){
		foreach($arr as $k=>$v){
			if($k>1){
				$file_content = getFileContent($v);
				preg_match_all('/\{\[(.*?)\]\}/',$file_content,$arr);
				$tempArr[] = $arr[1];
			}
		}
		return $tempArr;
	}

	/**
	 * @ ��ȡ����������Ϣ
	 */
	public function getSMSinfo(){
		$user = new user($this->UID);
		$userArr = $user->getUserLevel();
		$smsNumArr = $user->getUserInfo('U_SMS');

		//��ȡϵͳ�����������
		$smsInfoArr = $this->getCompanySMSnum();
		if($this->Level || $userArr['P_Level']==1){
			$smsInfoArr['S_Level'] = 1;
		}else{
			$smsInfoArr['S_Num'] = $smsNumArr['U_SMS'];
			$smsInfoArr['S_Level'] = $userArr['P_Level'];
		}
		return $smsInfoArr;
	}

	/**
	 * @ ���ſ۷Ѳ���
	 */
	private function deduction($counts,$level){
		if($level==1){
			$this->c->table('system_sms');
			$dataArr = $this->c->update(array('S_Num'=>$counts),$this->where);
		}else{
			$this->c->table('user_info');
			$dataArr = $this->c->update(array('U_SMS'=>$counts),"U_ID='".$this->UID."' AND ".$this->where);
		}
	}

	/**
	 * @ ��ȡ��˾��������
	 */
	private function getCompanySMSnum(){
		$this->c->table('system_sms');
		$smsInfoArr = $this->c->search($this->where);
		return $smsInfoArr[0];
	}

	/**
	 * @ ��¼���ŷ�����־
	 */
	private function writeLog($dataArr){
		$log = new writeLog;
		$log->smsLog($dataArr,3);
	}
}

?>