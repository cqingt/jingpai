<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������areaAction
 * 
 * @���ܣ���ϵͳ����������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�areaAction.class.php
 * 
 * @����ʱ�䣺2013-11-29 16:28:17
 * 
 * @������
 * 
 */
require_once(dirname(__FILE__)."/../main/base.class.php");
class areaAction extends model{

	public function __construct(){
		parent::__construct();
		$this->c->table('region');
	}

	private function getArea($rid){
		$dataArr=$this->c->search("parent_id='".$rid."'",'region_name ASC');
		return $dataArr;
	}

	/**
	 * @ �������������˵�ѡ��
	 */
	public function showOptionStr($rid=1,$selectedID=''){
		$rid = G('rid',2,2);
		$selectedID = G('sid',2,2);

		$dataArr = $this->getArea($rid);
		echo createSelectOption($dataArr,'region_name','region_id',$selectedID);
	}
	
	/*
	
		@ͨ��id�ַ����õ���Ӧ��ʡ���У�����
	*/
	public function getAddress(){
			
			$id=G('id',2);
			$AdressArr=$this->c->Search("region_id IN(".$id.")");
			//����������ַ
			if(count($AdressArr)){
				foreach($AdressArr as $k=>$v){
					echo '&nbsp;'.$v['region_name'];
				}
			}	
			
			exit;
	}	
}
?>