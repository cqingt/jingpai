<?php

$conf['dbhost']       = 'sctxdata.mysql.rds.aliyuncs.com';
$conf['dbport']       = '3306';
$conf['dbuser']       = 'shopnc';
$conf['dbpwd']        = 'Shengwei123';
$conf['dbname']       = 'shopnc';
$conf['dbcharset']    = 'UTF-8';
$db = new mysqli($conf['dbhost'], $conf['dbuser'], $conf['dbpwd'], $conf['dbname'], $conf['dbport']);

$sql = 'SELECT * FROM shop_member LIMIT 1';

$stmt = $db->query($sql); 

$array = array();
while ($tmp=mysqli_fetch_array($stmt,MYSQLI_ASSOC)){
	$array[] = $tmp;
}



var_dump($array);

exit;

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name); 
$sql = "INSERT INTO `users` (id, name, gender, location) VALUES (?, ?, ?, ?)"; 
$stmt = $mysqli->prepare($sql); 


var_dump($db);

$mysql_server_name=$conf['dbhost']; //数据库服务器名称
$mysql_username=$conf['dbuser']; // 连接数据库用户名
$mysql_password=$conf['dbpwd']; // 连接数据库密码
$mysql_database=$conf['dbname']; // 数据库的名字

// 连接到数据库
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password);
mysql_select_db($mysql_database); 
var_dump($conn);