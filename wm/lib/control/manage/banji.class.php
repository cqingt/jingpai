<?php
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class banji extends manage{
	public $huoDong;
	public $mobanStyle;

	public function __construct(){
		parent::__construct();
		$this->dbConnect();//切换到shopnc数据库
	}

	public function index(){
		$this->filename = 'banji.html';
		$this->toString();

	}



}