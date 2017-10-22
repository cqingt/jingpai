<?php
/**
 * SW 首页
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：main
 * 
 * @功能：前台控制核心类库
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：main.class.php
 * 
 * @开发时间：2014-7-28 15:00:00
 * 
 * @首页
 * 
 */
class web extends model{
	protected $sFu;
	public function __construct(){
		parent::__construct();
		$this->c->table('user');
	}
	
	public function index(){
		$total = $this->c->sumRows();
		$dataArr = $this->c->search('','time DESC',100);
		$dataNumArr = $this->c->search('','fu DESC',20);
		$this->tpl('total',$total);
		$this->tpl('dataArr',$dataArr);
		$this->tpl('dataNumArr',$dataNumArr);
		$this->display('tpl/wanfu/wanfu.html');
	}
}

?>