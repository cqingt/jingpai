<?php
/*
	@��˾��Ϣ���ع�����
*/
class company extends manage{
	private $number;
	public function __construct($number){
		parent::__construct();
		$this->number = $number;//�����̻���
		$this->c->table('system_info');
	}

	/**
	 * @ ��ȡ��˾��Ϣ
	 */
	public function getCompanyInfo($fields='*',$where=''){
		$dataArr = $this->c->search($where,'','',$fields);
		return $dataArr[0];
	}
}

?>