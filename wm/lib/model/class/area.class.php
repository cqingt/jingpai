<?php
class area extends mysqlAction{
	public $dataArr;//区域数据
	public $value=0;

	function __construct(){
		$this->table('region');
	}

	private function getArea($rid){
		$dataArr=$this->search("parent_id='".$rid."'");
		return $dataArr;
	}
	
	public function showOptionStr($rid,$selectedID){
		$dataArr = $this->getArea($rid);
		return createSelectOption($dataArr,'region_name','region_id',$selectedID);
	}
}
?>