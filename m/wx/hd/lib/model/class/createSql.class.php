<?php
/*
	@SQL���������
	@
	@����ʱ�䣺2013-11-21
	@
	@�����ˣ�����
*/

class createSql{

	private $status = 1;//����״̬
	private $fieldArr;//���ݿ��ֶ�����

	public function __construct($fieldArr){
		if(is_array($fieldArr) || count($fieldArr)){ $this->status = 0; }
		$this->fieldArr = $fieldArr;
	}

	/**
	 *	@����д��SQL���
	 *	@
	 *	@$arr:��Ҫд�����������
	 */
	 public function createInsertSql($arr,$table){
		foreach($this->fieldArr as $v){
			if($arr[$v]){
				$valueArr[] = $arr[$v];
				$fieldArr[] = $v;
			}
		}

		//�����������
		if(count($valueArr)){
			$valueStr = join("','",$valueArr);
			$fieldStr = join(",",$fieldArr);
			$sql = "INSERT INTO ".$table."(".$fieldStr.") VALUES ('".$valueStr."')";//����SQL���
			return $sql;
		}else{
			return false;
		}
	 }

	/**
	 *	@���ɸ���SQL���
	 *	@
	 *	@$arr:��Ҫд�����������
	 */
	 public function createUpdateSql($arr,$table){
		foreach($this->fieldArr as $v){
			if($arr[$v]!=''){
				$dataArr[] = $v."='".$arr[$v]."'";
			}
		}
		//�����������
		if(count($dataArr)){
			$dataStr = join(",",$dataArr);
			$sql = "UPDATE ".$table." SET ".$dataStr;//����SQL���
			return $sql;
		}else{
			return false;
		}
	 }

}
?>