<?php
/*
	@公司信息加载公共类
*/
class company extends manage{
	private $number;
	public function __construct($number){
		parent::__construct();
		$this->number = $number;//加载商户号
		$this->c->table('system_info');
	}

	/**
	 * @ 获取公司信息
	 */
	public function getCompanyInfo($fields='*',$where=''){
		$dataArr = $this->c->search($where,'','',$fields);
		return $dataArr[0];
	}
}

?>