<?php
/**
 * SW session������
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������logcat
 * 
 * @���ܣ�logcat������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�logcat.class.php
 * 
 * @����ʱ�䣺2014-8-13 15:44:00
 * 
 * @log������
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
	 * @ ִ����־д��
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