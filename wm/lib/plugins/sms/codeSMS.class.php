<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：codeSMS
 * 
 * @功能：阳洋验证码发送接口
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：codeSMS.class.php
 * 
 * @开发时间：2014-3-17 09:10:17
 * 
 */
require_once(dirname(__FILE__)."/../../model/interface/smsInterface.class.php");
class codeSMS implements smsInterface{
	public $mobile;
	public $content;
	public $status;//发送返回状态;

	private $url = "http://125.208.3.91:8888/smsGBK.aspx";//短信服务器地址
	private $companyID = "5268";//短信发送企业ID
	private $user = "xpt10142";//短信发送帐号
	private $pass = "xpt1014258";//短信发送密码
	private $number = W_NUMBER;//商户ID

	public function __construct(){
		$this->number = $number;
	}

	/**
	 * @ 短信发送主方法
	 */
	public function f($mobile,$content){
		$this->mobile = $mobile;
		$this->content = $content;
		$this->postSMS();
		$this->getStatus();
	}

	/**
	 * @ post模式发送数据
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
	 * @ post模式发送数据
	 */
	private function postSMS(){
		$data = 'action=send&userid='.$this->companyID.'&account='.$this->user.'&password='.$this->pass.'&mobile='.$this->mobile.'&content='.$this->content.'&sendTime=&extno=';//发送数据
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//时候将获取数据返回
		curl_setopt($ch, CURLOPT_POST, 1);//设置为POST传输
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //post过去数据
		$output = curl_exec($ch);
		$this->status = $output;
	}
}
?>