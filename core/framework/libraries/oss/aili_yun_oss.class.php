<?php
/**
 * 加载sdk包以及错误代码包
 */
require_once 'sdk.class.php';
//$oss = new aili_yun_oss;
//$oss->yun_up_load_folder('images/',true);

class aili_yun_oss{
	public $bucket = 'sctx';
	public $log_status = false;
	private $oss; //实例化阿里OSS云端类
	private $responseArr; //返回状态数组

	public function __construct(){
		$this->oss = new ALIOSS(); //实例化阿里OSS云端类
		$this->oss->set_debug_mode(FALSE);
	}

	/**
	 * @ 单个图片OSS云端上传
	 * @ $object:要上传的图片文件路径
	 * @ $file:上传到云端的路径,如果$file为空则保持跟上传文件相同路径
	 */
	public function yun_upload_img($object,$file=''){
		if(!$file){ $file = $object; }
		$this->responseArr = $this->oss->upload_file_by_file($this->bucket,$object,$file);
		return $this->getStatus();
	}

	/**
	 * @ 检测$object是否存在
	 * @ $object:要检测的文件(可以是路径文件)
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
	 * @ 删除$object
	 * @ $object:指定要删除的文件名称(可为路径文件)
	 */
	public function delObject($object){
		$this->responseArr = $this->oss->delete_object($this->bucket,$object);
		$this->getStatus();
	}

	/**
	 * @ 批量删除$object文件
	 * @ $object:指定要删除的文件名称(数据模式多个显示)
	 * @ $options:设置返回模式 (verbose)模式和简单(quiet)模式，默认为verbose模式
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
	 * @ 通过multi-part上传整个目录文件
	 * @ $dir:要上传的文件夹路径
	 * @ $recursive:是否递归读取数据
	 */
	public function yun_up_load_folder($dir,$recursive=true){
		$create_mtu_object_by_dir_response = $this->oss->create_mtu_object_by_dir($this->bucket,$dir,$recursive); 
		print_r($create_mtu_object_by_dir_response);die(); 
	}

	/**
	 * @ 获取返回状态码
	 */
	private function getStatus(){
		$statusArr = $this->responseArr;
		return  $statusArr->status;
	}
}
?>



