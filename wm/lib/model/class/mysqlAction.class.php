<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：mysqlAction
 * 
 * @功能：mysql数据增删改查操作
 *
 * @开发人：精灵
 * 
 * 联系QQ：9132761
 * 
 * @文件名称：mysqlAction.php
 * 
 * @开发时间：2013-11-19 17:26:37
 * 
 */
include('mysql.class.php');
include('createSql.class.php');
class mysqlAction extends mysql{
	private $Prefix;//表前缀
	private $Debug = 1;//是否开启调试模式,0关闭，1开启

	public function __construct($dbArr,$tableName=''){
		parent::__construct($dbArr);
		$this->Prefix = $dbArr['Prefix'];
		if($tableName){ $this->table($tableName); }//默认操作数据库表赋值
	}

	/**
	 *	@独立sql语句执行操作
	 */
	public function execute($sql){
		$this->query($sql);
	}

	/**
	 *	@表处理操作
	 */
	public function table($tableName){
		if(!$tableName){ return $tableName; }
		$tableName = $this->Prefix.str_replace(',',','.$this->Prefix,$tableName);
		$this->DBTable = $tableName;
	}

	/**
	 *	@表处理操作
	 *
	 *  @数据查询方法
	 */
	public function search($where='',$order='',$num='',$fileds='*'){
		$sql = 'SELECT '.$fileds.' FROM '.$this->DBTable;
		if($where){ $where = ' WHERE '.$where; }//加载搜索条件
		if($order){ $order = ' ORDER BY '.$order; }//加载排序
		if($num){ $num = ' LIMIT '.$num; }//加载读取条数
		$sql.= $where.$order.$num;
		return $this->returnArray($sql);
	}
	
	/**
	 *	@表处理操作
	 *
	 *  @查询一条数据的方法
	 */
	public  function getRow($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false)
        {
            return mysql_fetch_assoc($res);
        }
        else
        {
            return false;
        }
    }
	
	/**
	 *	@数据库查询资源处理
	 *
	 *  @将查询资源返回数组型数据
	 */
	private function returnArray($sql){
		$result=$this->query($sql) or die($this->showBug($sql)."语句错误！");
		while($row = mysql_fetch_assoc($result)){ $TmpArr[]=$row; }
		return $TmpArr;
	}

	/**
	 *	@数据库写入操作
	 */
	public function insert($dataArr){
		$sql = $this->createSQL('Insert',$dataArr);
		$this->query($sql);
	}

	/**
	 *	@数据库写入操作---新增---插入数据并返回ID
	 */
	public function insertOne($dataArr){
		$sql = $this->createSQL('Insert',$dataArr);
		if(!$sql){return false;}
		$oper=mysql_query($sql);
		if(!$oper){ $this->halt("SQL查询语句出错：".$sql); }
		return mysql_insert_id();
	}


	/**
	 *	@数据库更新操作
	 */
	public function update($dataArr,$where=''){
		$sql = $this->createSQL('Update',$dataArr);
		if($where){ $sql .= ' WHERE '.$where; }//判断是否需要加载更新条件
		$this->query($sql);
	}

	/**
	 *	@生成SQL语句
	 *
	 *  @Action:生成类型 Insert [生成插入语句],Update [生成更新语句],Delete [生成删除语句] 
	 *
	 *	@dataArr:需要写入的数据
	 */
	private function createSQL($Action,$dataArr){
		$this->setDatabaseResources();//加载资源
		$fieldArr = $this->getFieldsArray();//获取表头信息到数组
		
		$Action = 'create'.$Action.'Sql';
		$createSql = new createSql($fieldArr);//实例化SQL语句生成类
		$sql = $createSql->$Action($dataArr,$this->DBTable);
		if($sql){
			return $sql;
		}else{
			echo 'SQL语句创建失败!';
			exit;
		}
	}

	/**
	 *	@获取字段集合数组
	 */
	private function getFieldsArray(){
		$fieldsArr = $this->getFields();
		for($i=0;$i<$fieldsArr;$i++){
			$obj=mysql_fetch_field($this->QueryID);
			$temp[$i]=$obj->name;
		}
		return $temp;
	}

	/**
	 *	@数据库删除操作
	 *  @
	 */
	public function del($fields,$value,$where=false){
		if(is_array($value)){
			$w = $fields.' IN('.join(',',$value).')';
		}else{
			$w =  $fields."='".intval($value)."'";
		}
		
		//判断是否有删除附加条件
		if($where){ $w .= ' AND '.$where; }
		
		//生成删除SQL语句
		$sql = 'DELETE FROM '.$this->DBTable." WHERE ".$w;

		$this->query($sql);
	}

	/**
	 *	@获取指定条件数据总数
	 */
	public function sumRows($where=false){
		$sql = 'SELECT * FROM '.$this->DBTable;
		if($where){ $sql.=" WHERE ".$where; }
		$this->query($sql);
		$num = $this->getRows();
		return $num;
	}

	/**
	 *	@获取插入数据的ID信息
	 */
	public function insertID(){
		return $this->getInsertID();
	}

	/**
	 *	@加载查询数据库资源
	 */
	private function setDatabaseResources(){
		return $this->query('SELECT * FROM '.$this->DBTable.' LIMIT 1');
	}

	/**
	 *	@表处理操作
	 */
	private function showBug($sql){
		if($this->Debug){ return $sql; }
	}

}
?>
