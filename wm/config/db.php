<?php
date_default_timezone_set('PRC'); // 设置时差
class config{
	public static $DBGB="utf8";
	public static $UserMenuConfigArr=Array(	1=>'管理中心',
											8=>'安全中心'
											);



	//本地数据库连接
	public static $dbArr = Array(	'DBHOST'=>"localhost",
									'DBUSER'=>'root',
									'DBPWD'=>'root',
									'DBNAME'=>'weixinpingtai',
									'Prefix'=>'sw_'
								);

	//商城数据库连接
	public static $dbShopArr = Array('DBHOST'=>"localhost",
									'DBUSER'=>'root',
									'DBPWD'=>'root',
									'DBNAME'=>'paimai',
									'Prefix'=>'shop_'
								);




}
?>