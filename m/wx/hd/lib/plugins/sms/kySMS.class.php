<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：{[kySMS]}
 * 
 * @功能：{[阳洋短信群发送接口]}
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：kySMS.class.php
 * 
 * @开发时间：2014-3-17 09:10:17
 * 
 */
require_once(dirname(__FILE__)."/../../model/interface/smsInterface.class.php");
class kySMS implements smsInterface{
	public $mobile;
	public $content;
	public $status;//发送返回状态;
	public $successCounts;//成功扣费的短信条数
	public $setTime;//定时发送时间,默认为空则立即发送
	public $qmName = '【搜藏天下】';//签名

	private $url = "http://125.208.3.91:8888/smsGBK.aspx";//短信服务器地址
	private $companyID = "5255";//短信发送企业ID
	private $user = "xpt10136";//短信发送帐号
	private $pass = "xpt1013658";//短信发送密码
	private $number = W_NUMBER;//商户ID

	public function __construct(){
		$this->number = $number;
	}

	/**
	 * @ 短信发送主方法
	 */
	public function f($mobile,$content){
		$this->mobile = $mobile;
		$this->content = $content.$this->qmName;
		$dataXML = $this->postSMS();
		$this->getStatus($dataXML);
	}

	/**
	 * @ post模式发送数据
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
	 * @ post模式发送数据
	 */
	private function postSMS(){
		$data = 'action=send&userid='.$this->companyID.'&account='.$this->user.'&password='.$this->pass.'&mobile='.$this->mobile.'&content='.$this->content.'&sendTime='.$this->setTime.'&extno=';//发送数据
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//时候将获取数据返回
		curl_setopt($ch, CURLOPT_POST, 1);//设置为POST传输
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //post过去数据
		$output = curl_exec($ch);
		return $output;
	}

	/**
	 * @ xml转换成数据对象
	 */
	private function xml2class($dataXML){
		if($dataXML){
			$statusClass = simplexml_load_string($dataXML);
		}
		return $statusClass;
	}
	
}
?>