<?php
date_default_timezone_set(PRC); // 设置时差
class config{
	public static $DBGB="gbk";
	public static $UserMenuConfigArr=Array(	1=>'核心管理',
											2=>'系统配置',
											3=>'业务系统',
											8=>'安全中心'
											);

	//本地数据库连接
	public static $dbArr = Array(	'DBHOST'=>"127.0.0.1",
									'DBUSER'=>'wanfu',
									'DBPWD'=>'shengwei!23',
									'DBNAME'=>'wanfu',
									'Prefix'=>'sw_'
								);
}
?>