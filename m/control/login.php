<?php
/**
 * 前台登录 退出操作
 */
defined('InShopNC') or exit('Access Invalid!');

class loginControl extends mobileHomeControl {

    public function __construct(){
        parent::__construct();
    }

    private function isQQLogin(){
        return !empty($_GET[type]);
    }

    /**
     * 登录
     */
    public function indexOp(){

        if(chksubmit()){

            /*数据验证*/
            $obj_validate = new Validate();

            $obj_validate->validateparam = array(
                array("input"=>$_POST["username"],     "require"=>"true", "message"=>'用户名不能为空'),
                array("input"=>$_POST["password"],      "require"=>"true", "message"=>'密码不能为空'),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showWapMessage($error,'','error');
            }

            if(preg_match("/1[34578]{1}\d{9}$/",$_POST['username'])){
                $logintype='mobile';
            }else{
                $logintype='username';
            }


            /*是否存在*/
            $model_member   = Model('member');

            $salt_where	= array();
            if($logintype == 'mobile'){
                $salt_where['member_mobile'] = $_POST['username'];
            }else{
                $salt_where['member_name'] = $_POST['username'];
            }

			$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');

			$array	= array();
            if($logintype == 'mobile'){
                $array['member_mobile']	= $_POST['username'];
            }else{
                $array['member_name']	= $_POST['username'];
            }
			if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
				$array['member_passwd']	= md5(md5($_POST['password']).$is_salt['ec_salt']);
			}else{
				$array['member_passwd']	= md5($_POST['password']);
			}
            $member_info = $model_member->getMemberInfo($array);

			if(is_array($member_info) and !empty($member_info)) {
				if(!$member_info['member_state']){
			        showWapMessage("账号被停用",''.'error');
				}
			}else{
			    process::addprocess('login');
			    showWapMessage("登陆失败",'','error');
			}
           
            //会员存在，如果有openid存入，删除其他会员openid
            if($_SESSION['openid'] != '' && $member_info['openid'] != $_SESSION['openid']){
                $model_member->editMember(array('openid'=>$_SESSION['openid']),array('openid'=>''));
                $model_member->editMember(array('member_id'=>$member_info['member_id']),array('openid'=>$_SESSION['openid']));
            }

            /*信息存入session*/
            $model_member->createSession($member_info);

            // cookie中的cart存入数据库
            Model('cart')->mergecart($member_info,$_SESSION['store_id']);

            // cookie中的浏览记录存入数据库
            Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

            if($_POST['ref_url'] != '' && !strpos($_POST['ref_url'],'op=register')  && !strpos($_POST['ref_url'],'act=login')){
                redirect(urldecode($_POST['ref_url']));
            }else{
                redirect(urlWap('member','home'));
            }

        }else{

            Tpl::output('ref_url',$_GET['ref_url']);

            Tpl::output('nav_title','会员登陆');
            Tpl::output('html_title','会员登陆 - '.C('site_name'));

            Tpl::showpage('login');

        }

    }


    /**
     * 注册
     */
    public function registerOp(){

        if(chksubmit()){

            $model_member   = Model('member');

            $register_info = array();
            $register_info['username'] = $_POST['username'];
            $register_info['password'] = $_POST['password'];
            $register_info['password_confirm'] = $_POST['password_confirm'];
            $register_info['member_from'] = '手机';

            /*2015-11-16 Add is name Lt 手机号数据*/
            $register_info['mobile'] = $_POST['mobile'];
            /*End*/

            /*2015-11-16 Add is name Lt 手机站openid数据*/
            $register_info['openid'] = $_SESSION['openid'];
            /*End*/
            //根据openid查找推荐人id
            $tjr_info = $model_member->getMemberInfo(array('openid'=>$_SESSION['push_openid']));
			if($tjr_info){
				$register_info['inviter_id'] = intval($tjr_info['member_id']);
			}else{
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
			
			}
            $member_info = $model_member->register($register_info);

            if(!isset($member_info['error'])) { 
				if($_SESSION['push_openid']){
					//如果openid 绑定的有业务员则根据UID绑定业务员
					$getcode = Model ( 'getcode' );
					$openid_info = $getcode->selectOpenid(array('openid'=>$_SESSION['push_openid']),'UID');
					if(count($openid_info) > 0){
						$SW_URL="http://crm.96567.com/index.php?m=api&p=action&c=register";
						$zcontent=@file_get_contents($SW_URL."&N=".urlencode($register_info['username'])."&ID=".$member_info['member_id']."&M=".$register_info['mobile']."&U=".urlencode($register_info['username'])."&wx_uid=".$openid_info['UID']."&tg_from=".$_SESSION['tg_from']);
					}
				}

                /*信息存入session*/
                $model_member->createSession($member_info);

                // cookie中的cart存入数据库
                Model('cart')->mergecart($member_info,$_SESSION['store_id']);

                // cookie中的浏览记录存入数据库
                Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

                showWapMessage('注册成功',urlWap('member','home'));
            } else {
                showWapMessage($member_info['error'],'','error');
            }

        }else{

            Tpl::output('nav_title','会员注册');
            Tpl::output('html_title','会员注册 - '.C('site_name'));

            Tpl::showpage('register');
        }





    }


    /*退出*/
    public function login_outOp(){
        $_SESSION['member_id']  = '';
        $_SESSION['member_name']= '';
        $_SESSION['is_buy']     = '';
        $_SESSION['openid'] = '';

        redirect(urlWap('login','index'));
    }




}
