<?php
/**
 * SW 首页
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：main
 * 
 * @功能：前台控制核心类库
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：main.class.php
 * 
 * @开发时间：2014-7-28 15:00:00
 * 
 * @首页
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
		
		if($a != 'sw'){//如果为授权获取用户信息则跳过如下操作
			if($code){
				$openid = $this->weixin->getOpenID($code);//获取OpenID
				$this->getWeixinInfo($openid);
			}else if(!$code){
				$this->weixin->sendOpenID();
			}
		}
		
	}

	/**
	 * @ 通过openid获取用户信息
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
			//如果当前账户未关注微信公众号，则执行授权获取账户信息
			if($userArr['guanzhu']!='1'){
				$this->weixin->sq();
			}

		}else if($a == 'sw'){//获取确认授权后的用户信息
			$userArr = $this->weixin->getOauthUserInfo(G('code',2));
		}
		*/
		print_r($userArr);
	}
}

?>