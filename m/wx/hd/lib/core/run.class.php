<?php
class sw{
	public $m;//ģ�Ͳ���
	public $c;//��������
	public $p;//��·������
	static function run(){
		//ʵ���������������
		$sw=new sw;
		$sw->checkFile();

		//������������ö���
		$c=$sw->c;
		$m=$sw->m;
		$show=new $m();
		$show->$c();
	}

	private function getData(){
		$this->m=G("m",2,2) ? G("m",2,2) : "main";//��ȡģ�Ͳ���
		$this->c=G("c",2,2) ? G("c",2,2) : "index";//��ȡ��������
		$this->p=G("p",2,2) ? G("p",2,2) : "main";//��ȡ·���ļ���
	}

	public function checkFile(){
		$this->getData();//��ȡURL����
		if(file_exists(AC_PATH.$this->m.'.class.php')){
			include(AC_PATH.$this->m.'.class.php');
		}else{
			echo '��������ȷ!';
			exit;
		}
	}
}
?>