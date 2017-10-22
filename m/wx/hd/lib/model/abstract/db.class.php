<?php
/*
	@数据库抽象类方法
	@功能：定义数据库标准模式
	@开发人：精灵
	@开发时间：2013-11-19
*/

abstract class db{
	abstract protected function databaseLink();//数据库链接方法
	abstract protected function query($sql);//查询方法
	abstract protected function version();//返回数据版本信息
	abstract protected function free();//释放数据库内存
	abstract protected function close();//关闭数据库链接
	abstract public function __destruct();//定义关闭数据库链接的析构函数
}
?>