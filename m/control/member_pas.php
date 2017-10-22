<?php
/**
 * 找回密码
 *
 */


defined('InShopNC') or exit('Access Invalid!');

class member_pasControl extends mobileHomeControl {

	public function __construct() {
		parent::__construct();
	}

    public function pas_step1Op() {
        //标识购买流程执行步骤
		Tpl::output('html_title','找回密码');
        Tpl::output('pas_step','step2');
        Tpl::showpage('pas_step1');
    }
	//发送验证短信
	public function ajax_mobileOp() {
		$mobile=$_POST['arrnum']; // 手机号
		$member_name = $_POST['member_name']; // 用户名
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
		array("input"=>$member_name,		"require"=>"true",		"message"=>'用户名不能为空'),
        array("input"=>$mobile,		"require"=>"true",		"validator"=>"mobile", "message"=>'手机号码格式不正确'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
            echo $error;
			exit;
		}

		$check_member_mobile	= Model('member')->getMemberInfo(array('member_mobile'=>$mobile,'member_name'=>$member_name));
		if(count($check_member_mobile) == 0) {
			echo '输入的用户名和手机号不匹配';
			exit;
		}
		$this->isSMSsession();
		$_SESSION["ZhuanTicode"] = rand(100000,999999);//生成6位随机验证码
		$sms = new Sms();
		$result = $sms->send($mobile,"您好,您的手机验证码是".$_SESSION['ZhuanTicode']."");
		echo '1';
		exit;
		
	}
	
    /**
     * 重置密码
     */
    public function getpasswordOp() {
       $mobile=$_POST['mobile']; // 手机号
       $member_name = $_POST['member_name']; // 用户名
	   $code = $_POST['yzm']; // 验证码
	   if($_SESSION["ZhuanTicode"] != $code){
		   echo 0;
		   exit;
	   }
	   $check_member_mobile	= Model('member')->getMemberInfo(array('member_mobile'=>$mobile,'member_name'=>$member_name));
	   if(count($check_member_mobile) == 0) {
			echo -1;
			exit;
	   }
	   $pas = rand(100000,999999);//生成6位随机验密码
	   $sms = new Sms();
	   $sms->send($mobile,"您好,您的新密码是".$pas."");
	   Model('member')->editMember(array('member_id'=>$check_member_mobile['member_id']),array('member_passwd'=>md5($pas)));
	   echo 1;
	   exit;
    }

	//短信间隔60秒检测
	public function isSMSsession(){
		if($_SESSION['code_time']){
			if($_SESSION['code_time']>time()){
				echo 0;
				exit;
			}else{
				$_SESSION['code_time'] = time()+60;
			}
		}else{
			    $_SESSION['code_time'] = time()+60;
		}
	}

}