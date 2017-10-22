<?php

!defined('IN_ASK2') && exit( 'Access Denied' );

class api_usercontrol extends base
{

    var $apikey = '';

    //构造函数
    function app_usercontrol( & $get , & $post )
    {
        $this->base($get , $post);
        $this->load('user');

    }

    //-----------------------------------用户注册录接口函数
    function onregisterapi()
    {
        // $this->check_apikey();//判断是否为正确的http请求
        if ( strtolower(trim($this->post['seccode_verify'])) != $_ENV['user']->get_code() ) {
            exit( '验证码错误' );
        }
        $username = strip_tags(trim($this->post['uname']));//用户注册名字，strip_tags第一层过滤
        $password = trim($this->post['upwd']);//用户注册密码

        $repassword = trim($this->post['rupwd']);//用户注册密码

        $this->checkdeepstring($username);
        $usernamecensor = $_ENV['user']->check_usernamecensor($username);
        if ( FALSE == $usernamecensor )
            exit( '用户包含敏感词' );
        $this->checkstring($password);
        $this->checkstring($repassword);
        $email = $this->post['email'];//用户邮箱

        $emailaccess = $_ENV['user']->check_emailaccess($email);
        if ( FALSE == $emailaccess
        ) {
            exit( "邮件地址被禁止注册" );
        }


        $groupid = 7;//角色ID
        if ( $repassword != $password ) {
            exit( "两次输入密码不一样" );//用户密码不能为空
        }
        if ( '' == $username || '' == $password ) {
            exit( "reguser_cant_null" );//用户密码不能为空
        } else if ( !preg_match("/^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/" , $email) ) {
            exit( "regemail_Illegal" );//注册邮箱不合法
        } else if ( $this->db->fetch_total('user' , " email='$email' ") ) {
            exit( "regemail_has_exits" );//注册邮箱已经存在
        } else if ( !$_ENV['user']->check_usernamecensor($username) ) {
            exit( "regemail_cant_use" );//注册邮箱不能使用
        }

        $user = $_ENV['user']->get_by_username($username);
        $user && exit( "reguser_has_exits" );//注册用户已经存在

        $uid = $_ENV['user']->adduserapi($username , $password , $email , $groupid);//插入model/user.class.php里adduserapi函数里
        $_ENV['user']->refresh($uid);
        $sitename = $this->setting['site_name'];


        if ( isset( $this->setting['register_on'] ) && $this->setting['register_on'] == '1' ) {

            $activecode = md5(rand(10000 , 50000));
            $url = SITE_URL . 'index.php?user/checkemail/' . $this->user['uid'] . '/' . $activecode;
            $message = "这是一封来自$sitename邮箱验证，<a target='_blank' href='$url'>请点击此处验证邮箱邮箱账号</a>";
            $v = md5("yanzhengask2email");
            $v1 = md5("yanzhengask2time");
            setcookie("emailsend");
            setcookie("useremailcheck");
            $expire1 = time() + 60; // 设置1分钟的有效期
            setcookie("emailsend" , $v1 , $expire1); // 设置一个名字为var_name的cookie，并制定了有效期
            $expire = time() + 86400; // 设置24小时的有效期
            setcookie("useremailcheck" , $v , $expire); // 设置一个名字为var_name的cookie，并制定了有效期
            $_ENV['user']->update_emailandactive($email , $activecode , $this->user['uid']);
            $_ENV['user']->refresh($this->user['uid'] , 1);
            sendmailto($email , "邮箱验证提醒-$sitename" , $message , $this->user['username']);


        }
        //   $this->credit($this->user['uid'], $this->setting['credit1_register'], $this->setting['credit2_register']); //注册增加积分
        if ( !isset( $_SESSION ) ) {
            session_start();
        }
        $_SESSION['username'] = $username;
        $_SESSION['uid'] = $user['uid'];
        $_SESSION['groupid'] = $user['groupid'];
        if ( isset( $this->setting['register_on'] ) && $this->setting['register_on'] == '1' ) {
            exit( "reguser_ok1" );
            // exit("注册成功，系统已发送注册邮件，24小时之内请进行邮箱验证，在您没激活邮件之前你不能发布问题和文章等操作！");//注册成功
        } else {
            exit( "reguser_ok" );
        }
    }

    //检查http请求的主机和请求的来路域名是否相同，不相同拒绝请求
    function check_apikey()
    {
        if ( !isset( $_SESSION ) ) {
            session_start();
        }
        if ( $_SESSION["apikey"] == null || $this->post['apikey'] == null ) {
            echo '非法操作!';
            exit();
        }
        if ( $_SESSION["apikey"] != $this->post['apikey'] ) {
            echo '非法操作!';
            exit();
        }


    }
    //---------------------------用户登录接口函数
    /*
     * 
     * 
     * uname:用户名
     * 
     * upwd:用户密码
     */
    function onloginapi()
    {

        //$this->check_apikey();//判断是否为正确的http请求
        if ( strtolower(trim($this->post['seccode_verify'])) != $_ENV['user']->get_code() ) {
            exit( '验证码错误' );
        }
        $username = trim($this->post['uname']); //用户名
        //判断是否包含特殊字符

        $password = md5(trim($this->post['upwd']));//用户密码

        $this->checkdeepstring($username);

        $this->checkstring($password);
        if ( '' == $username || '' == $password ) {
            exit( 'login_null' );//登录参数为空
        }
        $user = $_ENV['user']->get_by_username($username);
        $cookietime = 2592000;
        if ( is_array($user) && ( $password == $user['member_passwd'] ) ) {
            $_ENV['user']->refresh($user['uid'] , 1 , $cookietime);
            $_SESSION['username'] = $username;
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $this->post['upwd'];
            $_SESSION['groupid'] = $user['groupid'];
            exit( 'login_ok' );//登录成功
        }
        exit( 'login_user_or_pwd_error' );//用户名或者密码错误
    }

    //---------------------------------登录退出接口函数
    function onloginoutapi()
    {
        if ( !isset( $_SESSION ) ) {
            session_start();
        }


        session_destroy(); //清空以创建的所有SESSION
        $_ENV['user']->logout();
        exit( 'loginout_ok' );//退出成功
    }

    //--------------------------修改密码接口
    function oneditpwdapi()
    {
        $this->check_apikey();//判断是否为正确的http请求
        $uid = intval(trim($this->post['uid'])); //用户名
        //判断是否包含特殊字符

        $newpwd = trim($this->post['newpwd']);//用户密码
        $_ENV['user']->uppass($uid , trim($newpwd));
        exit( 'editpwd_ok' );//退出成功
    }

    //检查特殊字符函数
    function checkstring( $str )
    {
        if ( preg_match("/[\'<>{}]|\]|\[|\/|\\\|\"|\|/" , $str) ) {
            exit( 'Illegal' );//参数不合法
        }

    }

    //检查特殊字符函数
    function checkdeepstring( $str )
    {
        if ( preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/" , $str) ) {
            exit( 'Illegal' );//参数不合法
        }
    }


}

?>