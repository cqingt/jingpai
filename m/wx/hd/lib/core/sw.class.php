<?php
require_once(dirname(__FILE__)."/../model/class/mysqlAction.class.php");
class model{
	public $host;//��ȡ�ĵ�ǰ����
	protected $c;//���ݶ���
	protected $FolderName;//վ��ͼƬ�ļ������ļ�����
	protected $filename;//ģ���ļ���
	private $m;//ģ���������

	function __construct(){
		$this->checkExpire();//���ڼ��

		/***************���ض���*********************************/
		$this->c = new mysqlAction(config::$dbArr,'system_info');//ʵ�������ݿ����
		$this->m = new Smarty();//ʵ����Smarty
		/***************���ض���*********************************/
		
		/***************��������***************/
		$this->getConfig();//�������ݳ�ʼ������
		$this->setSmarty();//����Smarty���ò���
		/***********�������ý���***************/
		
		/************************************�����Զ��庯��**************************************/
		$this->m->register_function("in_array","check_in_array");//ע���ⲿ������smarty����
		$this->m->register_function("Rwrite","Rwrite");//ע���ⲿ������smarty����
		/************************************���������Զ��庯��**************************************/

		$this->getConfigData();//��������
	}


	/*
		@���õ��÷���
	*/
	private function getConfig(){
		if(file_exists('config/config.php')){
			include('config/config.php');
		}else{
			$this->show404();
		}
	}

	/*
		@��ʼSmarty������
	*/
	protected function setSmarty(){
		$this->m->template_dir=dirname(__FILE__)."/../../Template"; //�趨ģ��Ŀ¼
		$this->m->compile_dir=dirname(__FILE__)."/../../caches/Compile"; //�趨�����ļ�Ŀ¼
		$this->m->cache_dir=dirname(__FILE__)."/../../caches/Cache"; //�趨����Ŀ¼

		$this->m->caching=false; //�رջ��湦��
		$this->m->left_delimiter="{["; //��������޶���
		$this->m->right_delimiter="]}"; //�����ұ��޶���
	}

	/*
		@Smarty��ֵ��װ����
	*/
	protected function tpl($name,$value){
		$this->m->assign($name,$value);
	}

	/*
		@Smarty���ģ���װ����
	*/
	protected function display($TemplateFileName){
		$this->m->display($TemplateFileName);
	}

	protected function dbConnect($table='user'){
		$this->c = new mysqlAction(config::$dbArr,$table);//ʵ�������ݿ����
	}
	
	/*
		@���ڼ��
	*/
	private function checkExpire(){
		if( !D(time(),W_EXPIRYDATE) ){
			echo ERROR_MESSAGE;
			exit;
		}
	}

	/*
		@���س�ʼ����������
	*/
	private function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//���طֹ�˾����
		$this->tpl('DIR',DIR_MAIN);//����ģ��·��
		$this->tpl('COMPANY',W_COMPANY);//���طֹ�˾����
		$this->tpl('LOGO',W_LOGO);//������֤ģʽ
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//���طֹ�˾ͼƬĿ¼
	}

	/*
		@��������
	*/
	private function show404(){
		header('HTTP/1.1 404 Not Found');
		header("status: 404 Not Found");
		exit;
	}

	/*
		@�������
	*/
	protected function toString($filename=''){
		$this->filename=$filename ? $filename : $this->filename;
		$filepath = 'manage/user/'.$this->filename;
		if($this->filename){ $this->display($filepath);	}
	}
}
?>