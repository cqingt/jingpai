<?php
/**
 * 前台登录 退出操作
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class loginControl extends BaseHomeControl {

	public function __construct(){
		parent::__construct();
		Tpl::output('hidden_nctoolbar', 1);
	}

	/**
	 * 登录操作
	 *
	 */
	public function indexOp(){

		Language::read("home_login_index");
		$lang	= Language::getLangContent();
		$model_member	= Model('member');
		//检查登录状态
		$model_member->checkloginMember();
		if ($_GET['inajax'] == 1 && C('captcha_status_login') == '1'){
		    $script = "document.getElementById('codeimage').src='".APP_SITE_URL."/index.php?act=seccode&op=makecode&nchash=".getNchash()."&t=' + Math.random();";
		}
		$result = chksubmit(true,C('captcha_status_login'),'num');
		if ($result !== false){
			if ($result === -11){
				showDialog($lang['login_index_login_illegal'],'','error',$script);
			}elseif ($result === -12){
				showDialog($lang['login_index_wrong_checkcode'],'','error',$script);
			}
			if (process::islock('login')) {
				showDialog($lang['nc_common_op_repeat'],SHOP_SITE_URL,'','error',$script);
			}
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["user_name"],		"require"=>"true", "message"=>$lang['login_index_username_isnull']),
				array("input"=>$_POST["password"],		"require"=>"true", "message"=>$lang['login_index_password_isnull']),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
			    showDialog($error,SHOP_SITE_URL,'error',$script);
			}
            if(preg_match("/^1[34578]{1}\d{9}$/",$_POST['user_name'])){
                $logintype='mobile';
            }else{
                $logintype='username';
            }


			/*2015-11-10 Save is name LT 登录加上EC密码验证*/
			$salt_where	= array();
            if($logintype == 'mobile'){
                $salt_where['member_mobile'] = $_POST['user_name'];
            }else{
                $salt_where['member_name'] = $_POST['user_name'];
            }

			$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');

			$array	= array();
            if($logintype == 'mobile'){
                $array['member_mobile']	= $_POST['user_name'];
            }else{
                $array['member_name']	= $_POST['user_name'];
            }
			if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
				$array['member_passwd']	= md5(md5($_POST['password']).$is_salt['ec_salt']);
			}else{
				$array['member_passwd']	= md5($_POST['password']);
			}


			/*End*/
			$member_info = $model_member->getMemberInfo($array);
			if(is_array($member_info) and !empty($member_info)) {
				if(!$member_info['member_state']){
			        showDialog($lang['login_index_account_stop'],''.'error',$script);
				}
			}else{
			    process::addprocess('login');
					showDialog($lang['login_index_login_fail'],'','error',$script);
			}

    		$model_member->createSession($member_info);
			process::clear('login');

			// cookie中的cart存入数据库
			Model('cart')->mergecart($member_info,$_SESSION['store_id']);

			// cookie中的浏览记录存入数据库
			Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

			/* Add is name lt 2016-09-20 自动登录*/
			$endtiem = strtotime(date('Y-m-d').' 23:59:59')-time();//当天结束还剩多少秒
    		setcookie('is_login_cookie',$_SESSION['member_id'],time()+$endtiem,'/');
  			/* End */

			if ($_GET['inajax'] == 1){
			    showDialog('',$_POST['ref_url'] == '' ? 'reload' : $_POST['ref_url'],'js');
			} else {
			    redirect(LEPAI_SITE_URL);
			}
		}else{

			//登录表单页面
			$_pic = @unserialize(C('login_pic'));
			if ($_pic[0] != ''){
				Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
			}else{
				Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
			}

			if(empty($_GET['ref_url'])) {
			    $ref_url = getReferer();
			    if (!preg_match('/act=login&op=logout/', $ref_url)) {
			     $_GET['ref_url'] = $ref_url;
			    }
			}
			Tpl::output('html_title',$lang['login_index_login'].' - '.C('site_name'));
			if ($_GET['inajax'] == 1){
				Tpl::showpage('login_inajax','null_layout');
			}else{
				Tpl::showpage('login');
			}
		}
	}

    /**
     * 绑定手机号 - 发送验证码
     */
    public function send_ajax_mobileOp() {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$_GET["mobile"], "require"=>"true", 'validator'=>'mobile',"message"=>'请正确填写手机号码'),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            exit(json_encode(array('state'=>'false','msg'=>$error)));
        }

        $model_member = Model('member');
        $condition = array();
        $condition['member_mobile'] = $_GET['mobile'];
        $member_info = $model_member->getMemberInfo($condition,'member_id');
        if ($member_info) {
            exit(json_encode(array('state'=>'false','msg'=>'该手机号已被使用，请更换其它手机号')));
        }


        $verify_code = rand(10,99).rand(10,99);
        $_SESSION['yzm'] = $verify_code;


        $model_tpl = Model('mail_templates');
        $tpl_info = $model_tpl->getTplInfo(array('code'=>'modify_mobile'));
        $param = array();
        $param['site_name']	= C('site_name');
        $param['send_time'] = date('Y-m-d H:i',TIMESTAMP);
        $param['verify_code'] = $verify_code;
        $message	= ncReplaceText($tpl_info['content'],$param);
        $sms = new Sms();
        $result = $sms->send($_GET["mobile"],$message);
        if ($result) {
            exit(json_encode(array('state'=>'true','msg'=>'发送成功')));
        } else {
            exit(json_encode(array('state'=>'false','msg'=>'发送失败')));
        }
    }

	/**
	 * 退出操作
	 *
	 * @param int $id 记录ID
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function logoutOp(){
		Language::read("home_login_index");
		$lang	= Language::getLangContent();
		// 清理消息COOKIE
		setNcCookie('msgnewnum'.$_SESSION['member_id'],'',-3600);

		// 清理自动登录
		setcookie('is_login_cookie','',time()-3600);
		
		session_unset();
		session_destroy();
		setNcCookie('cart_goods_num','',-3600);
		if(empty($_GET['ref_url'])){
			$ref_url = getReferer();
		}else {
			$ref_url = $_GET['ref_url'];
		}
		redirect(LEPAI_SITE_URL);
		//redirect('index.php?act=login&ref_url='.urlencode($ref_url));
	}

	/**
	 * 会员注册页面
	 *
	 * @param
	 * @return
	 */
	public function registerOp() {
        //zmr>v30
		$zmr=intval($_GET['zmr']);
		if($zmr>0)
		{
		  setcookie('zmr', $zmr);
		}
		
        if(empty($_GET['ref_url'])){
            $_GET['ref_url'] = getReferer();
        }

		Language::read("home_login_register");
		$lang	= Language::getLangContent();
		$model_member	= Model('member');
		$model_member->checkloginMember();
		Tpl::output('html_title',$lang['login_register_join_us'].' - '.C('site_name'));
		Tpl::showpage('register');
	}

	/**
	 * 会员添加操作
	 *
	 * @param
	 * @return
	 */
	public function usersaveOp() {
		//重复注册验证
		if (process::islock('reg')){
			showDialog(Language::get('nc_common_op_repeat'));
		}
		Language::read("home_login_register");
		$lang	= Language::getLangContent();
		$model_member	= Model('member');
		$model_member->checkloginMember();
		$result = chksubmit(true,C('captcha_status_register'),'num');
		if ($result){
			if ($result === -11){
				showDialog($lang['invalid_request'],'','error');
			}elseif ($result === -12){
				showDialog($lang['login_usersave_wrong_code'],'','error');
			}
		} else {
		    showDialog($lang['invalid_request'],'','error');
		}
        $register_info = array();
        $register_info['username'] = $_POST['user_name'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password_confirm'];
        //$register_info['email'] = $_POST['email'];
        $register_info['mobile'] = $_POST['mobile'];
        if($_POST['register_liayuan'] == 'yuyue'){
        	$laiyuan = '立即预订';
        }else{
        	$laiyuan = '商城';
        }
        $register_info['member_from'] = $laiyuan;
        if($_POST['yzmobile'] == 'on' || $_POST['yzmobile'] == '1'){
            if($_POST['yzm'] != $_SESSION['yzm']){
                showDialog('手机绑定验证码错误','','error');
            }else{
                $register_info['member_mobile_bind'] = 1;
                unset($_SESSION['yzm']);
            }
        }

		//添加奖励积分zmr>v30
		$zmr=intval($_COOKIE['zmr']);
		if($zmr>0)
		{
			$pinfo=$model_member->getMemberInfoByID($zmr,'member_id');
			if(empty($pinfo))
			{
				$zmr=0;
			}
		}
		$register_info['inviter_id'] = $zmr;
        $member_info = $model_member->register($register_info);
        if(!isset($member_info['error'])) {
            $model_member->createSession($member_info,true);
			process::addprocess('reg');

			// cookie中的cart存入数据库
			Model('cart')->mergecart($member_info,$_SESSION['store_id']);

			// cookie中的浏览记录存入数据库
			Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

			$_POST['ref_url']	= (strstr($_POST['ref_url'],'logout')=== false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : 'index.php?act=member_information&op=member');
			redirect(LEPAI_SITE_URL);
        } else {
			showDialog($member_info['error']);
        }
	}
	/**
	 * 会员名称检测
	 *
	 * @param
	 * @return
	 */
	public function check_memberOp() {
			/**
		 	* 实例化模型
		 	*/
			$model_member	= Model('member');

			$check_member_name	= $model_member->getMemberInfo(array('member_name'=>$_GET['user_name']));
			if(is_array($check_member_name) and count($check_member_name)>0) {
				echo 'false';
			} else {
				echo 'true';
			}
	}

	/**
	 * 电子邮箱检测
	 *
	 * @param
	 * @return
	 */
	public function check_emailOp() {
		$model_member = Model('member');
		$check_member_email	= $model_member->getMemberInfo(array('member_email'=>$_GET['email']));
		if(is_array($check_member_email) and count($check_member_email)>0) {
			echo 'false';
		} else {
			echo 'true';
		}
	}

    /**
     * 电子邮箱检测
     *
     * @param
     * @return
     */
    public function check_mobileOp() {
        $model_member = Model('member');
        $check_member_mobile	= $model_member->getMemberInfo(array('member_mobile'=>$_GET['mobile']));

        if(is_array($check_member_mobile) and count($check_member_mobile)>0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

	/**
	 * 忘记密码页面
	 */
	public function forget_passwordOp(){
		/**
		 * 读取语言包
		 */
		Language::read('home_login_register');
		$_pic = @unserialize(C('login_pic'));
		if ($_pic[0] != ''){
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
		}else{
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
		}
		Tpl::output('html_title',Language::get('login_index_find_password').' - '.C('site_name'));
		Tpl::showpage('find_password');
	}

	/**
	 * 找回密码的发短信
	 */
	public function find_passwordOp(){
		Language::read('home_login_register');
		$lang	= Language::getLangContent();

		$result = chksubmit(true,true,'num');
		if ($result !== false){
		    if ($result === -11){
		        showDialog('非法提交');
		    }elseif ($result === -12){
		        showDialog('验证码错误');
		    }
		}

		if(empty($_POST['username'])){
			showDialog($lang['login_password_input_username']);
		}

		if (process::islock('forget')) {
		    showDialog($lang['nc_common_op_repeat'],'reload');
		}

        if(empty($_POST['mobile'])){
            showDialog('手机号不能为空','reload');
        }

		$member_model	= Model('member');
		$member	= $member_model->getMemberInfo(array('member_name'=>$_POST['username']));
		if(empty($member) or !is_array($member)){
		    process::addprocess('forget');
			showDialog('此用户不存在','reload');
		}
		
		$member	= $member_model->getMemberInfo(array('member_mobile'=>$_POST['mobile']));
		if(empty($member) or !is_array($member)){
		    process::addprocess('forget');
			showDialog('手机号错误，请重新填写','reload');
		}

		$member	= $member_model->getMemberInfo(array('member_name'=>$_POST['username'],'member_mobile'=>$_POST['mobile']));
		if(empty($member) or !is_array($member)){
		    process::addprocess('forget');
			showDialog('未找到相关用户','reload');
		}

		process::clear('forget');
		//产生密码
        $pas = rand(100000,999999);//生成6位随机验密码

        $new_password = md5($pas);

		if(!($member_model->editMember(array('member_id'=>$member['member_id']),array('member_passwd'=>$new_password,'ec_salt'=>'0')))){
			showDialog('新密码设置失败，请联系客服','reload');
		}
        $sms = new Sms();
        $smsres = $sms->send($_POST['mobile'],"您好,您的新密码是".$pas."");
        if($smsres != 1){
            showDialog('新密码短信发送失败，请联系客服','reload');
        }
        $ToApi = new ToApi();
        $ToApi->update_password($member['member_name'],$new_password);

		showDialog('新密码已经发送至您绑定的手机，请尽快登录并更改密码！','','succ','',5);
	}

	/**
	 * 邮箱绑定验证
	 */
	public function bind_emailOp() {
	   $model_member = Model('member');
	   $uid = @base64_decode($_GET['uid']);
	   $uid = decrypt($uid,'');
	   list($member_id,$member_email) = explode(' ', $uid);

	   if (!is_numeric($member_id)) {
	       showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $member_info = $model_member->getMemberInfo(array('member_id'=>$member_id),'member_email');
	   if ($member_info['member_email'] != $member_email) {
	       showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$member_id));
	   if (empty($member_common_info) || !is_array($member_common_info)) {
	       showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }
	   if (md5($member_common_info['auth_code']) != $_GET['hash'] || TIMESTAMP - $member_common_info['send_acode_time'] > 24*3600) {
	       showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $update = $model_member->editMember(array('member_id'=>$member_id),array('member_email_bind'=>1));
	   if (!$update) {
	       showMessage('系统发生错误，如有疑问请与管理员联系',SHOP_SITE_URL,'html','error');
	   }

	   $data = array();
	   $data['auth_code'] = '';
	   $data['send_acode_time'] = 0;
	   $update = $model_member->editMemberCommon($data,array('member_id'=>$_SESSION['member_id']));
	   if (!$update) {
	       showDialog('系统发生错误，如有疑问请与管理员联系');
	   }

	   /*2015-11-16 Add is name lt 首次绑定邮箱送代金卷*/
	   $model = Model('voucher');
        $voucherresult = $model->addDaiJingJuan($member_id,37);
        $vouchersucc = '';
        if($voucherresult['state'] == true){
            $vouchersucc = '、您的代金券已发送、请到帐户查看！';
        }
        /*End*/

	   showMessage('邮箱设置成功'.$vouchersucc,'index.php?act=member_security&op=index');

	}

    /*
     * 艺租登录同步登录信息 跳转GET传用户名,密码(MD5)
     */
    public function login_actionOp(){
        $username = $_GET['username'];
        $password = $_GET['password'];//已经MD5过
        $time = $_GET['time'];
        $sign = $_GET['sign'];
        $resUrl = $_GET['url'];
        if($username == '' || $password == ''){
            redirect(urlShop('index'));
        }
        $charsign = md5(md5($password).$time);
        if($charsign != $sign){
            redirect($resUrl);
        }

        $model_member = Model('member');
        $array	= array();
        $array['member_name']	= $username;
        $array['member_passwd']	= $password;
        $member_info = $model_member->getMemberInfo($array);
        if(is_array($member_info) and !empty($member_info)) {
            $model_member->createSession($member_info);
        }
        redirect($resUrl);
    }
}
