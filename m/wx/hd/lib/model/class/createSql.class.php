<?php
/*
	@SQL语句生成类
	@
	@开发时间：2013-11-21
	@
	@开发人：精灵
*/

class createSql{

	private $status = 1;//操作状态
	private $fieldArr;//数据库字段数组

	public function __construct($fieldArr){
		if(is_array($fieldArr) || count($fieldArr)){ $this->status = 0; }
		$this->fieldArr = $fieldArr;
	}

	/**
	 *	@生成写入SQL语句
	 *	@
	 *	@$arr:需要写入的数据数组
	 */
	 public function createInsertSql($arr,$table){
		foreach($this->fieldArr as $v){
			if($arr[$v]){
				$valueArr[] = $arr[$v];
				$fieldArr[] = $v;
			}
		}

		//进行数据组合
		if(count($valueArr)){
			$valueStr = join("','",$valueArr);
			$fieldStr = join(",",$fieldArr);
			$sql = "INSERT INTO ".$table."(".$fieldStr.") VALUES ('".$valueStr."')";//生成SQL语句
			return $sql;
		}else{
			return false;
		}
	 }

	/**
	 *	@生成更新SQL语句
	 *	@
	 *	@$arr:需要写入的数据数组
	 */
	 public function createUpdateSql($arr,$table){
		foreach($this->fieldArr as $v){
			if($arr[$v]!=''){
				$dataArr[] = $v."='".$arr[$v]."'";
			}
		}
		//进行数据组合
		if(count($dataArr)){
			$dataStr = join(",",$dataArr);
			$sql = "UPDATE ".$table." SET ".$dataStr;//生成SQL语句
			return $sql;
		}else{
			return false;
		}
	 }

}
?>