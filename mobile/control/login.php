<?php
/**
 * 前台登录 退出操作
 *
 *
 *
 *
 * by www.shopjl.com 运营版
 */

use Shopnc\Tpl;

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
        if(!$this->isQQLogin()){
            if(empty($_POST['username']) || empty($_POST['password']) || !in_array($_POST['client'], $this->client_type_array)) {
                output_error('登录失败');
            }
        }
		$model_member = Model('member');
        $array = array();
        if($this->isQQLogin()){
            $array['member_qqopenid']	= $_SESSION['openid'];
        }else{
            if(preg_match("/1[34578]{1}\d{9}$/",$_POST['username'])){
                $logintype='mobile';
            }else{
                $logintype='username';
            }
            $salt_where	= array();
            if($logintype == 'mobile'){
                $salt_where['member_mobile'] = $_POST['username'];
            }else{
                $salt_where['member_name'] = $_POST['username'];
            }
            $is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');
            $array = array();
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
        }
        $member_info = $model_member->getMemberInfo($array);
        if(!empty($member_info)) {
            $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], $_POST['client']);
            if($token){
                    if($this->isQQLogin()){
                        setNc2Cookie('username',$member_info['member_name']);
                        setNc2Cookie('key',$token);
                        header("location:".WAP_SITE_URL.'/tmpl/member/member.html?act=member');
                    }else{
                        output_data(array('username' => $member_info['member_name'], 'key' => $token));
                    }
            } else {
                output_error('登录失败');
            }
        } else {
            output_error('用户名密码错误');
        }
    }

    /**
     * 登录生成token
     */
    private function _get_token($member_id, $member_name, $client) {
        $model_mb_user_token = Model('mb_user_token');

        //重新登录后以前的令牌失效
        //暂时停用
        //$condition = array();
        //$condition['member_id'] = $member_id;
        //$condition['client_type'] = $_POST['client'];
        //$model_mb_user_token->delMbUserToken($condition); ww w.sho pjl.co m出 品

        //生成新的token
        $mb_user_token_info = array();
        $token = md5($member_name . strval(TIMESTAMP) . strval(rand(0,999999)));
        $mb_user_token_info['member_id'] = $member_id;
        $mb_user_token_info['member_name'] = $member_name;
        $mb_user_token_info['token'] = $token;
        $mb_user_token_info['login_time'] = TIMESTAMP;
        $mb_user_token_info['client_type'] = $_POST['client'] == null ? 'Android' : $_POST['client'] ;

        $result = $model_mb_user_token->addMbUserToken($mb_user_token_info);

        if($result) {
            return $token;
        } else {
            return null;
        }

    }

	/**
	 * 注册
	 */
	public function registerOp(){
		$model_member	= Model('member');

        $register_info = array();
        $register_info['username'] = $_POST['username'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password_confirm'];
        $register_info['member_from'] = '手机';

        /*2015-11-16 Add is name Lt 手机号数据*/
        $register_info['mobile'] = $_POST['mobile'];
        /*End*/

        /*2015-11-16 Add is name Lt 手机站openid数据*/
        $register_info['openid'] = $_COOKIE['openid'];
        /*End*/


        $member_info = $model_member->register($register_info);
        if(!isset($member_info['error'])) {
            $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], $_POST['client']);
            if($token) {
                output_data(array('username' => $member_info['member_name'], 'key' => $token));
            } else {
                output_error('注册失败');
            }
        } else {
			output_error($member_info['error']);
        }

    }

    /**
     * 专题 航天纪念币 注册 add xin 20151126
     */
    public function register_ztOp(){
        $model_member	= Model('member');

        $register_info = array();
        $register_info['username'] = $_POST['username'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password'];
        $register_info['member_from'] = '航天钞兑换(m)';

        /*2015-11-16 Add is name Lt 手机号数据*/
        $register_info['mobile'] = $_POST['mobile'];
        /*End*/

        /*2015-11-16 Add is name Lt 手机站openid数据*/
        $register_info['openid'] = $_COOKIE['openid'];
        /*End*/


        $member_info = $model_member->register($register_info);
        if(!isset($member_info['error'])) {
            $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], $_POST['client']);
            if($token) {
                output_data(array('msg' => '您已经兑换成功，活动结束后将统一发货，请耐心等待。如有疑问请咨询在线客服或拔打400-81-96567'));
            } else {
                output_error('兑换失败');
            }
        } else {
            output_error($member_info['error']);
        }

    }
}
