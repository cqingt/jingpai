<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������codeSMS
 * 
 * @���ܣ�������֤�뷢�ͽӿ�
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�codeSMS.class.php
 * 
 * @����ʱ�䣺2014-3-17 09:10:17
 * 
 */
require_once(dirname(__FILE__)."/../../model/interface/smsInterface.class.php");
class codeSMS implements smsInterface{
	public $mobile;
	public $content;
	public $status;//���ͷ���״̬;

	private $url = "http://125.208.3.91:8888/smsGBK.aspx";//���ŷ�������ַ
	private $companyID = "5268";//���ŷ�����ҵID
	private $user = "xpt10142";//���ŷ����ʺ�
	private $pass = "xpt1014258";//���ŷ�������
	private $number = W_NUMBER;//�̻�ID

	public function __construct(){
		$this->number = $number;
	}

	/**
	 * @ ���ŷ���������
	 */
	public function f($mobile,$content){
		$this->mobile = $mobile;
		$this->content = $content;
		$this->postSMS();
		$this->getStatus();
	}

	/**
	 * @ postģʽ��������
	 */
	private function getStatus(){
		preg_match("/<returnstatus>(.*?)<\/returnstatus>/",$this->status,$arr);
		if($arr[1] == 'Success'){
			$status = 1;
		}else{
			$status = 0;
		}
		$this->status = $status;
	}

	/**
	 * @ postģʽ��������
	 */
	private function postSMS(){
		$data = 'action=send&userid='.$this->companyID.'&account='.$this->user.'&password='.$this->pass.'&mobile='.$this->mobile.'&content='.$this->content.'&sendTime=&extno=';//��������
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//ʱ�򽫻�ȡ���ݷ���
		curl_setopt($ch, CURLOPT_POST, 1);//����ΪPOST����
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //post��ȥ����
		$output = curl_exec($ch);
		$this->status = $output;
	}
}
?>