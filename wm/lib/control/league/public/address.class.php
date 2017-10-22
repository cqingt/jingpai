<?php

class address extends base{
	public function __construct(){
		parent::__construct();
		$this->c->table('user_address');
	}

	/**
	 * @ 加载收货地址信息
	 */
	public function getAddressInfo(){
		$where = "A_UID='".$_SESSION['sw_uid']."'";
		$fields = "*,(SELECT region_name FROM sw_region WHERE region_id=A_Province) as province,(SELECT region_name FROM sw_region WHERE region_id=A_City) as city";
		$dataArr = $this->c->search($where,'','',$fields);
		return $dataArr[0];
	}

	/**
	 * @ 更新收货信息
	 */
	public function changeAddress($dataArr,$uid){
		if(is_array($dataArr) && $uid){
			$this->c->update($dataArr,"A_UID='".$uid."'");
			return true;
		}else{
			return false;
		}
	}
}

?>