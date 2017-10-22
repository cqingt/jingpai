<?php
/**
 * SW 前台控制核心类库
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
 * @文件名称：base.class.php
 * 
 * @开发时间：2014-7-28 15:00:00
 * 
 * @前台控制核心类库
 * 
 */
require_once(dirname(__FILE__)."/public/weixinAPI.class.php");
require_once(dirname(__FILE__)."/public/logcat.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
class base extends model{
	protected $user;//用户操作类
	protected $userArr;//用户操作类
	protected $noArr = array('receive','complete');

	public function __construct(){
		parent::__construct();
		$this->getConfigData();
		
		//获取openid
		$this->user = new user($this->c);
		$this->user->getOpenid();

		//加载微信用户信息
		$this->userArr = $this->user->getWeixinInfo($_COOKIE['openid']);
		$this->tpl('userArr',$this->userArr);
		$this->fuComplete();//检测是否获奖

		$this->tpl('rank',$this->user->rank($this->userArr['openid']));
	}

	/*
		@检测是否执行完成集福页面转向
	*/
	private function fuComplete(){
		if(G('c',2)!='show' && G('c',2)!='fenxiang' && G('c',2)!='lingqu'){
			if($this->userArr['fu']>=100 && !$this->userArr['isOver'] && !in_array(G('c',2),$this->noArr)){
				show('恭喜您已经获得价值千元的福字哦','index.php?m=main&c=complete&p=main');
			}
		}
	}

	/*
		@加载初始化数据配置
	*/
	private function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//加载分公司域名
		$this->tpl('DIR',DIR_MAIN);//加载模板路径
		$this->tpl('COMPANY',W_COMPANY);//加载分公司名称
		$this->tpl('LOGO',W_LOGO);//加载验证模式
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//加载分公司图片目录
	}
	
	/*
		@输出方法
	*/
	protected function toString($filename=''){
		$this->filename=$filename ? $filename : $this->filename;
		$filepath = 'tpl/wanfu/'.$this->filename;
		if($this->filename){ $this->display($filepath);	}
	}
}
?>