<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������db
 * 
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�db.class.php
 * 
 * @����ʱ�䣺2013-11-19 15:28:17
 * 
 * @�˵���
 * 
 */
class menu{
	public $ManageTable='managecate'; //Ŀ�����ݱ�
	private $Level; //��������
	private $Resources; //���ݿ���Դ����
	private $fields;//��ѯ�ֶ�

	//���幹�캯��
	public function __construct($conn,$Level){
		if(!$Level){//������
			echo '����Ȩ�޴���!';
			exit;
		}
		$this->Resources=$conn; //�����ⲿ��Դ
		$this->Resources->table($this->ManageTable); //�������ݿ��
		//�ж϶�ȡ��Щ�˵�Ŀ¼
		$this->Level=$Level;
	}

	/**
	 * @ ��ȡָ����Ŀ�˵����ݣ����������νṹ����
	 */
	public function getMenu($Fileds,$Level=false){
		$this->Level = $Level ? $Level : $this->Level;
		$rowArr=$this->Resources->search($Fileds." IN(".$this->Level.")",'C_Sort Asc');
		$Menu = $this->getTree($rowArr);
		return $Menu;
	}

	/**
	 * @ ����ָ��ID���ݲ�ѯ�˵�����
	 */
	public function getMenuID($Level,$idStr){
		$rowArr=$this->Resources->search("C_Type='".$Level."' AND C_ID IN(".$idStr.")",'C_Sort Asc');
		$Menu = $this->getTree($rowArr);
		return $Menu;
	}

	/**
	 * @ ��������,��IDֵת��Ϊ�����±�
	 */
	private function tiaozhengArr($Arr){
		foreach($Arr as $k=>$v){
			$temp[$v['C_ID']] = $v;
		}
		return $temp;
	}

	/**
	 * @ �����ݸ�ʽ�������νṹ
	 */
	private function getTree($arr){
		if(count($arr)){
			$arr = $this->tiaozhengArr($arr);
		}else{
			return $arr;
		}

		foreach ($arr as $v){
			$arr[$v['C_Level']]['Menu'][$v['C_ID']] = &$arr[$v['C_ID']];
		}
		return isset($arr[0]['Menu']) ? $arr[0]['Menu'] : array(); 
	}
}
?>