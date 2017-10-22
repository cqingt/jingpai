<?php
require_once(dirname(__FILE__)."/../model/class/mysqlAction.class.php");
class model{
	public $host;//获取的当前域名
	protected $c;//数据对象
	protected $FolderName;//站点图片文件保存文件夹名
	protected $filename;//模板文件名
	private $m;//模板引擎对象

	function __construct(){

		// $this->checkExpire();//到期检测

		/***************加载对象*********************************/
		$this->c = new mysqlAction(config::$dbArr,'system_info');//实例化数据库对象
		$this->m = new Smarty();//实例化Smarty
		/***************加载对象*********************************/
		
		/***************加载配置***************/
		// $this->getConfig();//加载数据初始化配置
		$this->setSmarty();//加载Smarty配置参数
		/***********加载配置结束***************/
		
		/************************************加载自定义函数**************************************/
		$this->m->register_function("in_array","check_in_array");//注册外部函数到smarty引擎
		$this->m->register_function("Rwrite","Rwrite");//注册外部函数到smarty引擎
		/************************************结束加载自定义函数**************************************/
	}


	/*
		@配置调用方法
	*/
	// private function getConfig(){
	// 	if(file_exists('config/config.php')){
	// 		include('config/config.php');
	// 	}else{
	// 		$this->show404();
	// 	}
	// }

	/*
		@初始Smarty类配置
	*/
	protected function setSmarty(){
		$this->m->template_dir=dirname(__FILE__)."/../../Template"; //设定模版目录
		$this->m->compile_dir=dirname(__FILE__)."/../../caches/Compile"; //设定编译文件目录
		$this->m->cache_dir=dirname(__FILE__)."/../../caches/Cache"; //设定缓存目录

		$this->m->caching=false; //关闭缓存功能
		$this->m->left_delimiter="{["; //设置左边限定符
		$this->m->right_delimiter="]}"; //设置右边限定符
	}

	/*
		@加载初始化数据配置
	*/
	protected function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//加载分公司域名
		$this->tpl('DIR',DIR_MAIN);//加载模板路径
		$this->tpl('COMPANY',W_COMPANY);//加载分公司名称
		$this->tpl('LOGO',W_LOGO);//加载logo
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//加载分公司图片目录
	}

	/*
		@Smarty传值封装方法
	*/
	protected function tpl($name,$value){
		$this->m->assign($name,$value);
	}

	/*
		@Smarty输出模板封装方法
	*/
	protected function display($TemplateFileName){
		$this->m->display($TemplateFileName);
	}
	
	/*
		@到期检测
	*/
	// private function checkExpire(){
	// 	if( !D(time(),W_EXPIRYDATE) ){
	// 		echo ERROR_MESSAGE;
	// 		exit;
	// 	}
	// }

	/*
		@错误处理方法
	*/
	private function show404(){
		header('HTTP/1.1 404 Not Found');
		header("status: 404 Not Found");
		exit;
	}

	/*
		@输出方法
	*/
	protected function toString($filename=''){
		$this->filename=$filename ? $filename : $this->filename;
		$filepath = 'manage/user/'.$this->filename;
		if($this->filename){ $this->display($filepath);	}
	}




	
}
?>