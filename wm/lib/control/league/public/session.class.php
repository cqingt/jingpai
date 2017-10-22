<?php
/**
 * SW session控制类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：session
 * 
 * @功能：session控制类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：session.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @session检测类
 * 
 */
session_start();
class session{
	public $db;//数据库操作对象
	//private $weixin;//微信处理类属性
	public function __construct(){	
		//$this->weixin = new weixinAPI;
		if( G('code',2) && !$_SESSION['sw_openid'] ){
			//$_SESSION['sw_openid'] = $this->weixin->getOpenID();//获取OpenID
		}
	}

	public static function sessionRun($c){
		$session = new session;
		$session->db = $c;
		$session->checkLogin();
	}
	
	/**
	 * @ 检测是否登陆
	 */
	private function checkLogin(){
		if(!$_SESSION['sw_uid'] && !$_SESSION['sw_openid']){
			$this->checkOpenID();
		}else if(!$_SESSION['sw_uid'] && $_SESSION['sw_openid']){
			$this->loginOpenID();
		}else if($_SESSION['sw_uid'] && !$_SESSION['sw_openid']){
			$this->uid2OpenID($_SESSION['sw_uid']);	
		}else if($_SESSION['sw_uid'] && $_SESSION['sw_openid']){
			$this->uid2OpenID($_SESSION['sw_uid']);
		}
	}

	/**
	 * @ 检测是否有OpenID记录
	 */
	private function checkOpenID(){
		if($_SESSION['sw_openid']){
			$this->loginOpenID();
		}else{
			$this->sendOpenID();
		}
	}

	/**
	 * @ 执行OpenID登陆操作
	 */
	private function loginOpenID(){
		$this->db->table('user');
		$dataArr = $this->db->search("U_OpenID='".$_SESSION['sw_openid']."'",'','','U_ID,U_UserName,U_OpenID,U_isRZ');
		if(count($dataArr)){
			$_SESSION['sw_uid'] = $dataArr[0]['U_ID'];
			$_SESSION['sw_username'] = $dataArr[0]['U_UserName'];
			$_SESSION['sw_openid'] = $dataArr[0]['U_OpenID'];
			$_SESSION['sw_renzheng'] = $dataArr[0]['U_isRZ'];
		}else{
			$this->addUser();
			/*
			$swopenid = '&swopenid='.G('swopenid',2);
			header('location:http://'.W_DOMAIN.'/index.php?m=register&p=main&openid='.$_SESSION['sw_openid'].$swopenid);
			exit;
			*/
		}
		header('location:index.php?m=member&p=main');
	}

	/**
	 * @ 通过用户UID获取OpenID
	 */
	private function uid2OpenID($uid){
		$this->db->table('user');
		$where = "U_ID='".$uid."'";
		$dataArr = $this->db->search($where,'','','U_ID,U_UserName,U_OpenID,U_isRZ');
		$num = $this->db->sumRows($where);
		if($num){
			$_SESSION['sw_uid'] = $dataArr[0]['U_ID'];
			$_SESSION['sw_username'] = $dataArr[0]['U_UserName'];
			$_SESSION['sw_openid'] = $dataArr[0]['U_OpenID'];	
			$_SESSION['sw_renzheng'] = $dataArr[0]['U_isRZ'];
		}else{
			$_SESSION['sw_uid'] = '';
			$_SESSION['sw_username'] = '';
			$_SESSION['sw_openid'] = '';	
			$_SESSION['sw_renzheng'] = '';
			$this->loginOpenID();
		}
	}

	/**
	 * @ 发送获取openid的请求
	 */
	private function sendOpenID($backURL=''){
		if($_SERVER['QUERY_STRING']){ $queryString = '?'.$_SERVER['QUERY_STRING']; }
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$queryString;//获取当前页面完整URL地址
		$backURL = $backURL ? $backURL : $url;
		//$this->weixin->sendOpenIDInfo($backURL);
	}

	/**
	 * @ 完成用户自动注册
	 */
	private function addUser(){
		if(!$_SESSION['sw_openid']){
			$this->sendOpenID();
			exit;
		}
		$dataArr['U_OpenID'] = $_SESSION['sw_openid'];
		$dataArr['U_UserName'] = "sh".$this->createUserName();
		$dataArr['U_FromOpenID'] = $_COOKIE['af_openid'];
		$dataArr['U_Password'] = md5("88888888");
		$dataArr['U_Time'] = time();
		$dataArr['Up_openid'] = $_COOKIE['af_openid']; //推荐人的openid
		$this->db->table('user');
		$this->db->insert($dataArr);
		$inserID = $this->db->insertID();
		if($_COOKIE['affiliate_range']){
			$affiliate_range = explode(',',$_COOKIE['affiliate_range']);
			foreach($affiliate_range as $k1=>$v1){
				if($v1 == 1){
					$this->db->execute("UPDATE sw_user SET U_Integral = U_Integral+".$_COOKIE['level_register_all']." where U_OpenID = '".$_COOKIE['af_openid']."'"); //给推荐人赠送积分
				}
			}
		}
		
		//写入session信息
		$_SESSION['sw_uid'] = $inserID;
		$_SESSION['sw_username'] = $dataArr['U_UserName'];
		$_SESSION['sw_openid'] = $dataArr['U_OpenID'];	
	}

	/**
	 * @ 生成随机用户名
	 */
	private function createUserName(){
		$username = rand(10,99).date('Ym').rand(1,9);
		$num = $this->db->sumRows("U_UserName='".$username."'");
		if($num){
			$this->createUserName();
		}else{
			return $username;
		}
	}
}

?>