<?php
/*
	@����������
*/
class order{
	private $db;
	public function __construct($conn){
		$this->uid = intval($uid);
		$this->db = $conn;
		$this->db->table('order');
	}
	
	//��������
	public function createOrder($id,$dataArr){
		if($this->checkOrder($id)){ return 1;}

		if(is_array($dataArr) && !empty($dataArr) && $id){
			$dataArr['uid'] = $id;
			$dataArr['order_sn'] = $this->createNumber();
			$dataArr['time'] = time();
			$this->db->table('order');
			$this->db->insert($dataArr);
			return 1;
		}else{
			return 0;
		}
	}
	
	//����Ƿ��Ѿ����ɹ��콱����
	public function checkOrder($uid){
		$num = $this->db->sumRows("uid='".$uid."'");
		return $num;
	}

	//���ɶ�����
	public function createNumber(){
		return date('YmdHis').rand(1000,9999);
	}
}

?>