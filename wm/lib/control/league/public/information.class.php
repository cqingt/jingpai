<?php
/**
 * SW 消息记录
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：information
 * 
 * @功能：消息记录类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：information.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @消息记录类
 * 
 */
class information extends base{
	public function __construct(){
		parent::__construct();
		$this->c->table('information');
	}

	public static function writeInfo($dataArr){
		$x = new information;
		$x->addInfo($dataArr);
	}

	public function addInfo($dataArr){
		$dataArr['I_Time'] = time();
		$this->c->insert($dataArr);
	}
}

?>