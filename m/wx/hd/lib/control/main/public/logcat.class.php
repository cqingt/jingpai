<?php
/**
 * SW session控制类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：logcat
 * 
 * @功能：logcat控制类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：logcat.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @log操作类
 * 
 */
class logcat{
	private $db;
	public function __construct($conn){	
		$this->db = $conn;
		$this->db->table('fu_log');
	}

	public static function write($conn,$sopenid,$fopenid,$fu,$type=0){
		$log = new logcat($conn);
		$log->logWrite($sopenid,$fopenid,$fu,$type);
	}

	/**
	 * @ 执行日志写入
	 */
	private function logWrite($sopenid,$fopenid,$fu,$type){
		$dataArr['L_Sopenid'] = $sopenid;
		$dataArr['L_Fopenid'] = $fopenid;
		$dataArr['L_FU'] = intval($fu);
		$dataArr['L_Type'] = $type;
		$dataArr['L_Time'] = time();
		$this->db->insert($dataArr);
	}
}

?>