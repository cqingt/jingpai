<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������{[kySMS]}
 * 
 * @���ܣ�{[�������Ⱥ���ͽӿ�]}
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�kySMS.class.php
 * 
 * @����ʱ�䣺2014-3-17 09:10:17
 * 
 */
require_once(dirname(__FILE__)."/../../model/interface/smsInterface.class.php");
class kySMS implements smsInterface{
	public $mobile;
	public $content;
	public $status;//���ͷ���״̬;
	public $successCounts;//�ɹ��۷ѵĶ�������
	public $setTime;//��ʱ����ʱ��,Ĭ��Ϊ������������
	public $qmName = '���Ѳ����¡�';//ǩ��

	private $url = "http://125.208.3.91:8888/smsGBK.aspx";//���ŷ�������ַ
	private $companyID = "5255";//���ŷ�����ҵID
	private $user = "xpt10136";//���ŷ����ʺ�
	private $pass = "xpt1013658";//���ŷ�������
	private $number = W_NUMBER;//�̻�ID

	public function __construct(){
		$this->number = $number;
	}

	/**
	 * @ ���ŷ���������
	 */
	public function f($mobile,$content){
		$this->mobile = $mobile;
		$this->content = $content.$this->qmName;
		$dataXML = $this->postSMS();
		$this->getStatus($dataXML);
	}

	/**
	 * @ postģʽ��������
	 */
	private function getStatus($dataXML){
		$statusClass = $this->xml2class($dataXML);
		if($statusClass->returnstatus == 'Success'){
			$this->status = 1;
		}else{
			$this->status = 0;
		}
		$this->successCounts = $statusClass->successCounts;
	}

	/**
	 * @ postģʽ��������
	 */
	private function postSMS(){
		$data = 'action=send&userid='.$this->companyID.'&account='.$this->user.'&password='.$this->pass.'&mobile='.$this->mobile.'&content='.$this->content.'&sendTime='.$this->setTime.'&extno=';//��������
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//ʱ�򽫻�ȡ���ݷ���
		curl_setopt($ch, CURLOPT_POST, 1);//����ΪPOST����
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //post��ȥ����
		$output = curl_exec($ch);
		return $output;
	}

	/**
	 * @ xmlת�������ݶ���
	 */
	private function xml2class($dataXML){
		if($dataXML){
			$statusClass = simplexml_load_string($dataXML);
		}
		return $statusClass;
	}
	
}
?>