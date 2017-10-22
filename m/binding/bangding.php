<?php
header('Content-Type: text/html; charset=utf-8');
//获取用户名或密码
$user_name = $_POST['username'];
$password = md5($_POST['password']);
if($user_name == '' || $password == ''){
	echo '<script>alert("用户名或密码不能为空！");window.history.go(-1);</script>';
}
$db_host="sctxdata.mysql.rds.aliyuncs.com:3306";   //连接的服务器地址
$db_user="crmdata";     //连接数据库的用户名
$db_psw="Shengwei123";  //连接数据库的密码
$db_name="crmdata";		//连接的数据库名称

$mysqli=mysql_connect($db_host,$db_user,$db_psw) or die(mysql_errno());
mysql_select_db($db_name) or die (mysql_errno());
mysql_query('SET NAMES utf8');
$query="select * from sw_adminuser WHERE U_Number=2040 AND U_UserName='".$user_name."' AND U_Status=0 limit 1";

$result=mysql_query($query) or die(mysql_errno());
while($row=mysql_fetch_array($result)) //循环输出结果集中的记录
{
	//进行登陆验证
	if(count($row)){
		if($row['U_Pass']==$password){//登录成功获取openid进行绑定
			
			require(dirname(__FILE__) . '/../../core/framework/libraries/weixinsdk.php');
			$weixin = new weixinSDK;
			$returnURL = 'http://m.96567.com/index.php?act=getCode&op=index&df_UID='.$row['U_ID'].'&df_UName='.$row['U_UserName'];
			$weixin->getCode($returnURL);
			setCookie('df_UID',$row['U_ID'],time()+3600,"/","96567.com");
			setCookie('df_UName',$row['U_UserName'],time()+3600,"/","96567.com");
		}else{
			echo '<script>alert("密码错误!");window.history.go(-1);</script>';
		}
	}else{
		echo '<script>alert("用户名错误！");window.history.go(-1);</script>';
	}
	
}
if(mysql_fetch_array($result) === false){
	echo '<script>alert("用户名错误！");window.history.go(-1);</script>';
	exit;
}

?>