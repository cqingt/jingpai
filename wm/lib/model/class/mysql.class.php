<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：db
 * 
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：db.class.php
 * 
 * @开发时间：2013-11-19 15:28:17
 * 
 * @数据库类
 * 
 */
include($_SERVER['DOCUMENT_ROOT'].'/wm/lib/model/abstract/db.class.php');//加载数据库抽象类
class mysql extends db{
    private $Host;//数据库IP
	private $DBName;//数据库名称
	private $DBUser;//数据库用户名
	private $DBPass;//数据库登陆密码
	private $Error;//错误ID
	private $LinkID = 0;//数据库链接
	private $RowResult = array();//结果集成组的数组
	private $RowPosition;//记录指针位置索引

	protected $QueryID = 0;//查询结果资源
	protected $DBTable;//数据库操作表
	protected $dbCharSet;//数据库编码

	/**
	 * @MySql数据库构造方法
	 * @作用：初始化数据库链接操作
	 */
	public function __construct($dbArr){
		$this->Host=$dbArr['DBHOST'];
		$this->DBUser=$dbArr['DBUSER'];
		$this->DBPass=$dbArr['DBPWD'];
		$this->DBName=$dbArr['DBNAME'];
		$this->dbCharSet=config::$DBGB;

		$this->databaseLink();//执行数据库链接操作
	}

	/**
	 * @创建数据库链接
	 */
	protected function databaseLink(){
		if($this->LinkID){ return true ;}
		$this->LinkID = mysql_connect($this->Host,$this->DBUser,$this->DBPass);
		if(!$this->LinkID){ $this->halt("连接数据库服务端失败!"); }
		if(!mysql_select_db($this->DBName,$this->LinkID)) $this->halt("不能打开指定的数据库".$this->DBName);
		mysql_query("SET NAMES '".$this->dbCharSet."'");
	}

	/**
	 * @SQL语句操作方法
	 */
	protected function query($sql){
		if(!$sql){ return false;}
		if($this->QueryID){ $this->free(); }//判断是否有查询，如果有则释放内存
		$this->QueryID = mysql_query($sql);
		if(!$this->QueryID){ $this->halt("SQL查询语句出错：".$sql); }
		return $this->QueryID;
	}

	/**
	 * @将结果集指针指向指定行
	 */
	protected function seek($Position){
		if(mysql_data_seek($this->QueryID,$Position)){
			$this->RowPosition=$Position;
			return true;
		}else{
			$this->halt("定位结果集发生错误");
			return false;
		}
	}

	/**
	 * @返回结果集记录组成数据
	 */
	private function get_rows_array(){
		$this->get_rows();
		for($i=0;$i<$this->Rows;$i++){
			if(!mysql_data_seek($this->Query_ID,$i)) $this->halt("mysql_data_seek查询语句出错");
			$this->Row_Result[$i]=mysql_fetch_array($this->Query_ID);
		}
		return $this->Row_Result;
	}

	/**
	 * @返回结果集记录行数
	 */
	protected function getRows(){
		return mysql_num_rows($this->QueryID);
	}

	/**
	 * @返回结果集字段数
	 */
	protected function getFields(){
		return mysql_num_fields($this->QueryID);
	}

	/**
	 * @返回最后插入数据库的数据ID
	 */
	protected function getInsertID(){
		return mysql_insert_id();
	}

	/**
	 * @获取MySql数据库版本
	 */
	protected function version(){
		return mysql_get_server_info();
	}

	/**
	 * @释放数据库内存
	 */
	protected function free(){
		if( !is_resource($this->QueryID) ){
			$this->QueryID = 0;
			return false;
		}
		if( mysql_free_result($this->QueryID) ){
			unset($this->RowResult);//释放由结果集组成的数组
		}
		$this->QueryID = 0;
	}

	/**
	 * @打印错误信息
	 */
	private function halt($msg){
		$this->Error=mysql_error();
		printf("<br><b>数据库发生错误：</b>%s<br>\n",$msg);
		printf("<b>MySQL 返回错误信息:</b> %s <br>\n",$this->Error);
		die("脚本终止");
	}

	/**
	 * @获取表名字段
	*/
	public  function getFieldName(){
		$this->QueryID = mysql_query("SELECT * FROM ".$this->DBTable."");
		$numfields = $this->getFields();
		for($i=0;$i<$numfields;$i++)
		{
			$fieldArr[] = mysql_field_name($this->QueryID ,$i);
		}
		if(is_array($fieldArr))
		{
			return $fieldArr;
		}else{
			return array();
		}
	}

	/**
	 * @关闭数据库链接
	 */
	protected function close(){
		if( is_resource($this->LinkID) ){
			mysql_close($this->LinkID);
		}
	}

	/**
	 * @定义构造函数
	 * @作用：当类执行完成后关闭数据库链接
	 */
	public function __destruct(){
		$this->close();
	}
}
?>
