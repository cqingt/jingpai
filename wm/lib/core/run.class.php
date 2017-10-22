<?php
class sw{
	public $m;//模型参数
	public $c;//方法参数
	public $p;//类路径参数
	static function run(){
		//实例化加载所需参数
		$sw=new sw;
		$sw->checkFile();

		//工厂化所需调用对象
		$c=$sw->c;
		$m=$sw->m;
		$show=new $m();
		$show->$c();
	}

	private function getData(){
		$this->m=G("m",2,2) ? G("m",2,2) : "manageIndex";//获取模型参数
		$this->c=G("c",2,2) ? G("c",2,2) : "index";//获取方法参数
		$this->p=G("p",2,2) ? G("p",2,2) : C_PATH;//获取路径文件名
	}

	public function checkFile(){
		$this->getData();//获取URL数据
		if(file_exists(AC_PATH.$this->m.'.class.php')){
			include(AC_PATH.$this->m.'.class.php');
		}else{
			echo '参数不正确!';
			exit;
		}
	}
}
?>