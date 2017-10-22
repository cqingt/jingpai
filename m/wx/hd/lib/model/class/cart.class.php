<?php
class cart{
	private $CartArray = array(); // ��Ź��ﳵ�Ķ�ά����
	public $Expires = 86400; // Cookies����ʱ�䣬���Ϊ0�򲻱��浽���� ��λΪ��
	public $type = 0;//����ģʽ,0Ϊcookieģʽ��1Ϊsessionģʽ

	/*
		�����Ʒ�����ﳵ
		@param int $Id ��ƷID
		@param string $Conent ��Ʒ���ݣ���ν�ַ�����JSON������
		@return �����Ʒ���ڣ�����ԭ���������ϼ�1��������false
		@param string orderInfo ���ﶩ��������Ϣjson������Ϣ
	*/
	public function addCart($id,$case_name,$pro_name=''){
		$this->CartArray = $this->CartView(); // �����ݶ�ȡ��д������
		$this->CartArray['pro'][$id][$case_name['R_ID']] = $case_name;
		if($pro_name!=''){ $this->CartArray['pro'][$id][0] = $pro_name; }
		$this->save();
	}

	/*
		@��¼��������Ϣ
	*/
	public function addOrderInfo($orderInfo=''){
		$this->CartArray = $this->CartView(); // �����ݶ�ȡ��д������
		$this->CartArray['orderInfo'] = $orderInfo;
		$this->save();
	}

	/*
		@��չ��ﳵ
	*/
	public function RemoveAll(){
		$this->CartArray = array();
		$this->save();
	}

	/*
		@�鿴���ﳵ��Ϣ
		@return array ����һ����ά����
	*/
	public function CartView() {
		if($this->type){
			session_start();
			$cookie = stripslashes($_SESSION["aiduoli_buy"]);
		}else{
			$cookie = stripslashes($_COOKIE["aiduoli_buy"]);
		}
		if (!$cookie) return false;
		$tmpUnSerialize = unserialize($cookie);
		return $tmpUnSerialize;
	}

	/*
		@��鹺�ﳵ�Ƿ�����Ʒ
		@return bool �������Ʒ������true������false
	*/
	public function checkCart() {
		$tmpArray = $this->CartView();
		if (count($tmpArray[0]) < 1) {			
			return false;
		}
		return true;
	}

	/*
		@������Ʒ �����ʹ�ù��췽�����˷�������ʹ��
		@����ģʽ0Ϊcookieģʽ��¼,1Ϊsessionģʽ��¼
	*/
	public function save(){
		$tmpArray = $this->CartArray;
		$tmpSerialize = serialize($tmpArray);
		if($this->type){
			session_start();
			$_SESSION['aiduoli_buy'] = $tmpSerialize;
		}else{
			setcookie("aiduoli_buy",$tmpSerialize,time()+$this->Expires,'/',W_DOMAIN);
		}
	}

	/*
		@���ñ�������ֵ
	*/
	public function setCartArray($array){
		$this->CartArray = $array;
	}
}
?>