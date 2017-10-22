<?php
/**
 * ����sdk���Լ���������
 */
require_once 'sdk.class.php';
//$oss = new aili_yun_oss;
//$oss->yun_up_load_folder('images/',true);

class aili_yun_oss{
	public $bucket = 'sctx';
	public $log_status = false;
	private $oss; //ʵ��������OSS�ƶ���
	private $responseArr; //����״̬����

	public function __construct(){
		$this->oss = new ALIOSS(); //ʵ��������OSS�ƶ���
		$this->oss->set_debug_mode(FALSE);
	}

	/**
	 * @ ����ͼƬOSS�ƶ��ϴ�
	 * @ $object:Ҫ�ϴ���ͼƬ�ļ�·��
	 * @ $file:�ϴ����ƶ˵�·��,���$fileΪ���򱣳ָ��ϴ��ļ���ͬ·��
	 */
	public function yun_upload_img($object,$file=''){
		if(!$file){ $file = $object; }
		$this->responseArr = $this->oss->upload_file_by_file($this->bucket,$object,$file);
		return $this->getStatus();
	}

	/**
	 * @ ���$object�Ƿ����
	 * @ $object:Ҫ�����ļ�(������·���ļ�)
	 */
	public function isObjectExist($object){
		$is_object_exist = $this->oss->is_object_exist($this->bucket,$object); 
		if($is_object_exist){
			return true;
		}else{
			return false;
		} 
	}

	/**
	 * @ ɾ��$object
	 * @ $object:ָ��Ҫɾ�����ļ�����(��Ϊ·���ļ�)
	 */
	public function delObject($object){
		$this->responseArr = $this->oss->delete_object($this->bucket,$object);
		$this->getStatus();
	}

	/**
	 * @ ����ɾ��$object�ļ�
	 * @ $object:ָ��Ҫɾ�����ļ�����(����ģʽ�����ʾ)
	 * @ $options:���÷���ģʽ (verbose)ģʽ�ͼ�(quiet)ģʽ��Ĭ��Ϊverboseģʽ
	 */
	public function del_all_object($objects){ 
		$options = array(
			'quiet' => false,
			//ALIOSS::OSS_CONTENT_TYPE => 'text/xml',
		);
		$delete_objects_response = $this->oss->delete_objects($this->bucket, $objects,$options); 
		return  $statusArr->status; 
		//print_r($delete_objects_response);die(); 
	}

	/**
	 * @ ͨ��multi-part�ϴ�����Ŀ¼�ļ�
	 * @ $dir:Ҫ�ϴ����ļ���·��
	 * @ $recursive:�Ƿ�ݹ��ȡ����
	 */
	public function yun_up_load_folder($dir,$recursive=true){
		$create_mtu_object_by_dir_response = $this->oss->create_mtu_object_by_dir($this->bucket,$dir,$recursive); 
		print_r($create_mtu_object_by_dir_response);die(); 
	}

	/**
	 * @ ��ȡ����״̬��
	 */
	private function getStatus(){
		$statusArr = $this->responseArr;
		return  $statusArr->status;
	}
}
?>



