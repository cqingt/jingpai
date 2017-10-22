<?php
/**
 *  手机获取openid
 *
 **/

defined('InShopNC') or exit('Access Invalid!');
class weixinControl extends mobileControl{

    public $wx;

    public function __construct(){

        $wx = new WeixinSDK();
        $this->wx = $wx;
    }

    public function indexOp(){

        $openid = $_SESSION['openid'];
        if($openid != ''){

            // $_SESSION['openid'] = $openid;
            $this->testingOpenidExistOp($openid);
            $primary_url = $_SESSION['primary_url'];
            if($primary_url != ''){
                unset($_SESSION['primary_url']);
                redirect(urldecode($primary_url));
            }else{
                redirect(urlWap('index','index'));
            }
        }else{
            $returenUrl  =  urlWap('weixin','get_user_openid');
            $this->wx->getCode($returenUrl);
        }

    }


    /*获取OpenId*/
    public function get_user_openidOp(){

        $wx_code = trim($_GET['code']);

        if($wx_code){

            $this->wx->getOpenID($wx_code);

            if($this->wx->openid){
                $_SESSION['openid'] = $this->wx->openid;
                $_SESSION['openid_test'] = $this->wx->openid;
                redirect(urlWap('weixin','index'));
            }

        }else{

            redirect(urlWap('weixin','index'));
        }

    }

    /*AJAX获取JS-API数据*/
    public function weixinJsaipOp(){

        $url = html_entity_decode(trim($_GET['url']));

        $jsweixin = new JsSDK('wx00d52d21505f383f','1dad56778549190c2d1268caa9e2aa11',$url);

        $getSignPackage = $jsweixin->getSignPackage();

        echo json_encode($getSignPackage);
    }

    /*检测登录状态*/
    private function testingOpenIdExistOp($openid){
        $model_member = Model('member');
        $condition['openid'] = $openid;
        $member_info = $model_member->getMemberInfo($condition);
        if(!empty($member_info)){
            /*信息存入session*/
            $model_member->createSession($member_info);
            // cookie中的cart存入数据库
            Model('cart')->mergecart($member_info,$_SESSION['store_id']);
            // cookie中的浏览记录存入数据库
            Model('goods_browse')->mergebrowse($member_info['member_id'],$_SESSION['store_id']);
        }
    }






}
