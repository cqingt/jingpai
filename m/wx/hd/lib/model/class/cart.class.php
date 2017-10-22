<?php
class cart{
	private $CartArray = array(); // 存放购物车的二维数组
	public $Expires = 86400; // Cookies过期时间，如果为0则不保存到本地 单位为秒
	public $type = 0;//保存模式,0为cookie模式，1为session模式

	/*
		添加商品到购物车
		@param int $Id 商品ID
		@param string $Conent 商品内容，可谓字符串与JSON型数据
		@return 如果商品存在，则在原来的数量上加1，并返回false
		@param string orderInfo 购物订单主题信息json类型信息
	*/
	public function addCart($id,$case_name,$pro_name=''){
		$this->CartArray = $this->CartView(); // 把数据读取并写入数组
		$this->CartArray['pro'][$id][$case_name['R_ID']] = $case_name;
		if($pro_name!=''){ $this->CartArray['pro'][$id][0] = $pro_name; }
		$this->save();
	}

	/*
		@记录订单主信息
	*/
	public function addOrderInfo($orderInfo=''){
		$this->CartArray = $this->CartView(); // 把数据读取并写入数组
		$this->CartArray['orderInfo'] = $orderInfo;
		$this->save();
	}

	/*
		@清空购物车
	*/
	public function RemoveAll(){
		$this->CartArray = array();
		$this->save();
	}

	/*
		@查看购物车信息
		@return array 返回一个二维数组
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
		@检查购物车是否有商品
		@return bool 如果有商品，返回true，否则false
	*/
	public function checkCart() {
		$tmpArray = $this->CartView();
		if (count($tmpArray[0]) < 1) {			
			return false;
		}
		return true;
	}

	/*
		@保存商品 如果不使用构造方法，此方法必须使用
		@保存模式0为cookie模式记录,1为session模式记录
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
		@设置保存数据值
	*/
	public function setCartArray($array){
		$this->CartArray = $array;
	}
}
?>