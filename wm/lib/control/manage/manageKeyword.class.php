<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageWeixin
 * 
 * @功能：微信接口功能操作类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageWeixin.class.php
 * 
 * @开发时间：2014-07-29 15:28:17
 * 
 * @微信接口功能操作类
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");


class manageKeyword extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('keyword_weixin');
	}

	/**
	 * @ 关联词列表
	 */
	public function index(){
		$this->getKeywordList();
		$this->filename = 'weixin_keyword.html';	
	}

	/**
	 * @ 获取关键词列表
	 */
	private function getKeywordList(){
		$url = 'index.php?m=manageKeyword&p=manage';
		$page = new PageTurn($this->c,G('page',2,2),'keyword_weixin',$url,20,'K_ID ASC');
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}

	/**
	 * @ 添加关联关键词
	 */
	public function addKeyword(){
		$type = G('K_Type');
		if($type == 'news'){
			$dataArr['K_Title'] = G('K_Title');
			$dataArr['K_Description'] = G('K_Description');
			$dataArr['K_Img'] = G('K_Img');
			$dataArr['K_Content'] = G('K_Content');
		}else{
			$dataArr['K_Title'] = G('K_Keyword');
		}
		$dataArr['K_Type'] = $type;
		$dataArr['K_Event'] = G('K_Event');
		$dataArr['K_Keyword'] = G('K_Keyword');
		$dataArr['K_Content'] = G('K_Content',1,1,1);
		$dataArr['K_Time'] = time();
		$this->c->insert($dataArr);
		$kid = $this->c->insertID();
		show('关联词设置成功!','index.php?m=manageKeyword&c=popWeixinKeyword&p=manage&a=update&kid='.$kid.'&type='.$type);
	}

	/**
	 * @ 更新关键词
	 */
	public function updateKeyword(){
		$type = G('K_Type');
		$kid = G('K_ID',1,2);
		if($type == 'news'){
			$dataArr['K_Title'] = G('K_Title');
			$dataArr['K_Description'] = G('K_Description');
			$dataArr['K_Img'] = G('K_Img');
			$dataArr['K_Content'] = G('K_Content');
		}else{
			$dataArr['K_Title'] = G('K_Keyword');
		}
		$dataArr['K_Type'] = $type;
		$dataArr['K_Keyword'] = G('K_Keyword');
		$dataArr['K_Content'] = G('K_Content',1,1,1);
		$this->c->update($dataArr,"K_ID='".$kid."'");
		show('更新成功!');
	}

	/**
	 * @ 删除关联关键词
	 */
	public function delKeyword(){
		$kid = G('kid',2,2);
		$this->c->del('K_ID',$kid);
		show('删除成功!');
	}

	/**
	 * @ 显示回复添加界面
	 */
	public function popWeixinKeyword(){
		$type = G('type',2);
		$kid = G('kid',2,2);
		if($kid){
			$dataArr = $this->c->search("K_ID='".$kid."'");
			$this->tpl('dataArr',$dataArr[0]);
			$this->tpl('update',1);
		}
		if($type=='news'){
			$editName = 'get'.W_EDIT;
			$this->tpl('edit',editClass::$editName('K_Content',622,455,$dataArr[0]['K_Content']));
		}
		$this->tpl('type',$type);
		$this->filename = 'pop/popWeixinKeyword.html';
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>