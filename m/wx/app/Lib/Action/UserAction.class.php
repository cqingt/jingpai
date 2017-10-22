<?php

class UserAction extends BaseAction
{
    public $userGroup;
    public $token;
    public $user;
    public $userFunctions;
    protected function _initialize()
    {
        parent::_initialize();
        $userinfo        = M('User_group')->where(array(
            'id' => session('gid')
        ))->find();
        $this->userGroup = $userinfo;
        $users           = M('Users')->where(array(
            'id' => $_SESSION['uid']
        ))->find();
        $this->user      = $users;
        $this->assign('thisUser', $users);
        $this->assign('viptime', $users['viptime']);
        if (session('uid')) {
            if ($users['viptime'] < time()) {
                session(null);
                session_destroy();
                unset($_SESSION);
                $this->error('您的帐号已经到期，请充值后再使用');
            }
        }
        $wecha = M('Wxuser')->field('wxname,weixin,wxid,headerpic')->where(array(
            'token' => session('token'),
            'uid' => session('uid')
        ))->find();
        $this->assign('wecha', $wecha);
        $this->token = session('token');
        $this->assign('token', $this->token);
        $token_open          = M('token_open')->field('queryname')->where(array(
            'token' => $this->token
        ))->find();
        $this->userFunctions = explode(',', $token_open['queryname']);
        $this->assign('userinfo', $userinfo);
        if (session('uid') == false) {
            if (MODULE_NAME != 'Upyun') {
                $this->redirect('Home/Index/login');
            }
        }
        define('UNYUN_BUCKET', C('up_bucket'));
        define('UNYUN_USERNAME', C('up_username'));
        define('UNYUN_PASSWORD', C('up_password'));
        define('UNYUN_FORM_API_SECRET', C('up_form_api_secret'));
        define('UNYUN_DOMAIN', C('up_domainname'));
        $this->assign('upyun_domain', 'http://' . UNYUN_DOMAIN);
        $this->assign('upyun_bucket', UNYUN_BUCKET);
        $token = $this->_session('token');
        if (!$token) {
            $token = 'admin';
        }
        $options                         = array();
        $now                             = time();
        $options['bucket']               = UNYUN_BUCKET;
        $options['expiration']           = $now + 3600*24*365;
        $options['save-key']             = '/' . $token . '/{year}/{mon}/{day}/' . $now . '_{random}{.suffix}';
        $options['allow-file-type']      = C('up_exts');
        $options['content-length-range'] = '0,' . intval(C('up_size')) * 1000;
        if (intval($_GET['width'])) {
            $options['x-gmkerl-type'] = 'fix_width';
            $options['fix_width ']    = $_GET['width'];
        }
        $policy = base64_encode(json_encode($options));
        $sign   = md5($policy . '&' . UNYUN_FORM_API_SECRET);
        $this->assign('editor_upyun_sign', $sign);
        $this->assign('editor_upyun_policy', $policy);
    }
}
?>