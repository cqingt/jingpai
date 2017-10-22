<?php
/*
require_once(dirname(__FILE__).'/zmop/request/ZhimaAuthInfoAuthorizeRequest.php');
require_once(dirname(__FILE__).'/zmop/ZmopClient.php');

class TestAuthFreeze{
    //芝麻信用网关地址
    public $gatewayUrl = "https://zmopenapi.zmxy.com.cn/openapi.do";
    //商户私钥文件
    public $privateKeyFile = "/home/rsa_key/rsa_private_key.pem";
    //芝麻公钥文件
    public $zmPublicKeyFile = "/home/rsa_key/zhima_public_key.pem";
    //数据编码格式
    public $charset = "UTF-8";
    //芝麻分配给商户的appId
    public $appId = "1000740";
    //生成PC端页面授权的URL，身份证姓名授权
    public function generatePcPageAuthUrl(){
        $client = new ZmopClient($this->gatewayUrl, $this->appId, $this->charset, $this->privateKeyFile, $this->zmPublicKeyFile);
        $request = new ZhimaAuthInfoAuthorizeRequest();
        $request->setScene("test");
        // 授权来源渠道设置为apppc
        $request->setChannel("apppc");
        // 授权类型设置为2标识为证件号授权见“章节4中的业务入参说明identity_type”
        $request->setIdentityType("2");
        // 构造授权业务入参证件号，姓名，证件类型;“章节4中的业务入参说明identity_param”
        $request->setIdentityParam('{"certNo":"422202198810213498","certType":"IDENTITY_CARD", "name":"盛威"}');
        // 构造业务入参扩展参数“章节4中的业务入参说明biz_params”
        //$request->setBizParams('{"auth_code":"M_APPPC_CERT","state":"xxx"}');
        return $client->generatePageRedirectInvokeUrl($request);
    }
}

$t = new TestAuthFreeze;
echo $t->generatePcPageAuthUrl();
 */
if($_GET['action']=='ok'){
	require_once(dirname(__FILE__).'/zhima.sdk.php');
	$zm = new zhima();
	$zm->SetCertNo($_POST['sfz'],$_POST['name']);
	$link = $zm->CreateAuthFreezeLink();
	header("location:".$link);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="?action=ok">
  <p>身份证：
  <input type="text" name="sfz" id="sfz" />
  </p>
  <p>姓名：
    <input type="text" name="name" id="name" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="提交" />
  </p>
</form>
</body>
</html>


