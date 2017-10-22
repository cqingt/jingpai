<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：areaAction
 * 
 * @功能：子系统管理主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：areaAction.class.php
 * 
 * @开发时间：2013-11-29 16:28:17
 * 
 * @地区类
 * 
 */
require_once(dirname(__FILE__)."/../main/base.class.php");
class areaAction extends base{

	public function __construct(){
		parent::__construct();
		$this->c->table('region');
	}

	private function getArea($rid){
		$dataArr=$this->c->search("parent_id='".$rid."'",'region_name ASC');
		return $dataArr;
	}

	/**
	 * @ 生成区域下来菜单选项
	 */
	public function showOptionStr($rid=1,$selectedID=''){
		$rid = G('rid',2,2);
		$selectedID = G('sid',2,2);

		$dataArr = $this->getArea($rid);
		echo createSelectOption($dataArr,'region_name','region_id',$selectedID);
	}
	
	/*
	
		@通过id字符串得到相应的省，市，地区
	*/
	public function getAddress(){
			
			$id=G('id',2);
			$AdressArr=$this->c->Search("region_id IN(".$id.")");
			//遍历地区地址
			if(count($AdressArr)){
				foreach($AdressArr as $k=>$v){
					echo '&nbsp;'.$v['region_name'];
				}
			}	
			
			exit;
	}	
}
?>