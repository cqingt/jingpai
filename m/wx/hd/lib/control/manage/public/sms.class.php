<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：sms
 * 
 * @功能：短信发送主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：sms.class.php
 * 
 * @开发时间：2013-12-17 16:28:17
 * 
 * @短信发送类
 * 
 */

class sms extends manage{
	private $filePath;//插件目录

	public function __construct(){
		parent::__construct();
		$this->filePath = $_SERVER['DOCUMENT_ROOT'].'/lib/plugins/sms';//加载短信插件目录
	}

	/**
	 * @ 执行段发送控制类
	 */	
	public function send($mobile,$content,$setTime=''){
		$smsConfigInfo = $this->getSMSinfo();
		$this->c = new mysqlAction(config::$dbArr);//实例化数据库对象
		$className = $smsConfigInfo['S_F'];
		include_once($this->filePath.'/'.$className.'.class.php');
		$sms = new $className;
		$sms->setTime = $setTime;
		$sms->F($mobile,$content);
		if($sms->status==1){//判断是否扣费
			$this->deduction(($smsConfigInfo['S_Num']-$sms->successCounts),$smsConfigInfo['S_Level']);
		}
		//记录短信发送日志
		$logArr['L_Num'] = $sms->successCounts;
		$logArr['L_Status'] = $sms->status;
		$logArr['L_ActionUser'] = $_SESSION['U_UserName'];
		$logArr['L_Content'] = $content;
		$this->writeLog($logArr);//记录日志
	}


	/**
	 * @ 加载短信插件列表
	 */	
	public function loadPlugin(){
		$arr = listFile($this->filePath);
		$smsPluginArr = $this->getPluginInfo($arr);
		return $smsPluginArr;
	}

	/**
	 * @ 获取短信插件信息，返回数组
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
	 * @ 获取短信配置信息
	 */
	public function getSMSinfo(){
		$user = new user($this->UID);
		$userArr = $user->getUserLevel();
		$smsNumArr = $user->getUserInfo('U_SMS');

		//获取系统主体短信配置
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
	 * @ 短信扣费操作
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
	 * @ 获取公司短信总数
	 */
	private function getCompanySMSnum(){
		$this->c->table('system_sms');
		$smsInfoArr = $this->c->search($this->where);
		return $smsInfoArr[0];
	}

	/**
	 * @ 记录短信发送日志
	 */
	private function writeLog($dataArr){
		$log = new writeLog;
		$log->smsLog($dataArr,3);
	}
}

?>