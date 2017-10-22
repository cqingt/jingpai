<?php

require_once(dirname(__FILE__)."/league.class.php");
class index extends league{
	public function __construct(){
		parent::__construct();
		session::sessionRun($this->c);
		$this->c->table('user');
		$this->filename = 'member.html';
	}
	
	public function index(){
		echo '213123';
	}

}

?>