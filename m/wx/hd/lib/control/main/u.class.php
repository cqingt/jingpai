<?php
/**
 * SW ��ҳ
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������main
 * 
 * @���ܣ�ǰ̨���ƺ������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�main.class.php
 * 
 * @����ʱ�䣺2014-7-28 15:00:00
 * 
 * @��ҳ
 * 
 */
require_once(dirname(__FILE__)."/public/weixinAPI.class.php");
require_once(dirname(__FILE__)."/base.class.php");
class u extends base{
	private $weixin;
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->weixin = new weixinAPI;
		$code = G('code',2);
		$a = G('state',2);
		
		if($a != 'sw'){//���Ϊ��Ȩ��ȡ�û���Ϣ���������²���
			if($code){
				$openid = $this->weixin->getOpenID($code);//��ȡOpenID
				$this->getWeixinInfo($openid);
			}else if(!$code){
				$this->weixin->sendOpenID();
			}
		}
		
	}

	/**
	 * @ ͨ��openid��ȡ�û���Ϣ
	 */
	private function getWeixinInfo($openid){
		
		if(!$openid){
			echo "<script>window.location.reload();</script>";
			exit;	
		}
		$userArr = $this->weixin->getWeixinUserInfo($openid);
		/*
		$a = G('state',2);
		if($a != 'sw'){
			$userArr = $this->weixin->getWeixinUserInfo($openid);
			//�����ǰ�˻�δ��ע΢�Ź��ںţ���ִ����Ȩ��ȡ�˻���Ϣ
			if($userArr['guanzhu']!='1'){
				$this->weixin->sq();
			}

		}else if($a == 'sw'){//��ȡȷ����Ȩ����û���Ϣ
			$userArr = $this->weixin->getOauthUserInfo(G('code',2));
		}
		*/
		print_r($userArr);
	}
}

?>