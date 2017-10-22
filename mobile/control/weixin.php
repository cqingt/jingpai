<?php
/**
 *  手机获取openid
 * 
 **/

defined('InShopNC') or exit('Access Invalid!');
class weixinControl extends mobileHomeControl{

    public function indexOp(){
    /*获取openid*/
        $url = urldecode(trim($_GET['url']));
        $openid = trim($_GET['openid']);
        setcookie('openid',$openid,time()+3600,'/');
        header("Location: {$url}");
        exit;
    }




    /*绑定openid*/
    public function doOpenidOp(){
        $openid = trim($_GET['openid']);
        if($this->wx_browser){
            if($openid){
                $id = trim($_GET['id']);
                $openid = trim($_GET['openid']);
                if($id && $openid){
                    $model = Model('member');
                    /*检测该openid是否存在于数据库中*/
                    $dataOpen['openid'] = $openid;
                    $userOpenid = $model->getMemberInfo($dataOpen,'member_id,openid');

                    /*如果存在则清除openid后再绑定到新帐户*/
                    if(!empty($userOpenid)){
                        $saveUser['member_id'] = $userOpenid['member_id'];
                        $saveUserOpenid['openid'] = '';
                        if($saveUser['member_id'] != ''){
                            $model->editMember($saveUser,$saveUserOpenid);
                        }else{
                            exit;
                        }
                    }
                    $where['member_id'] = $id;
                    $data['openid'] = $openid;
                    if($model->editMember($where,$data)){
                        echo "<script>alert('绑定成功');</script>";
                    }else{
                        echo "<script>alert('绑定失败');</script>";
                    }
                }else{
                    echo "<script>alert('绑定失败');</script>";
                }
            }else{
                $uid = trim($_GET['uid']);
                $userid = base64_decode(decrypt(strval($uid), sha1(md5('key')), 0));
                $uid = substr($userid,0,3);
                if($uid == 'uid'){
                    $id = substr($userid,3,strlen($userid));
                    $rurl = urlencode("http://www.96567.com/mobile/index.php?act=weixin&op=doOpenid&id=$id");
                    header("location:http://m.96567.com/weixin/openid/index.php?type=shopnc&rurl=$rurl");
                    exit;
                }else{
                    echo "<script>alert('当前用户ID不正确');</script>";
                }
            }
        }else{
            echo "<script>alert('请在微信浏览器打开');</script>";
        }
        
    }



    /*测试*/
    public function testOp(){
        $code = trim($_GET['code']);
        $weixin = new WeixinSDK();
        $weixin->getOpenID($code);
        if($weixin->openid){
            setcookie('openid',$weixin->openid,time()+3600,'/');
            header('Location: /wap/weixin.html');
        }
        exit;
    }

    /*AJAX获取JS-API数据*/
    public function weixinJsaipOp(){

        $url = html_entity_decode(trim($_GET['url']));

        $jsweixin = new JsSDK('wx00d52d21505f383f','1dad56778549190c2d1268caa9e2aa11',$url);

        $getSignPackage = $jsweixin->getSignPackage();

        echo json_encode($getSignPackage);
    }







}
