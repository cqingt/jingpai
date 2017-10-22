<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：uploadImg
 * 
 * @功能：图片上面界面处理
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：uploadImg.class.php
 * 
 * @开发时间：2014-08-01 16:28:17
 * 
 * @图片上面界面处理
 * 
 */
require_once(dirname(__FILE__)."/../manage/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
class uploadImg extends manage{

	public function __construct(){
		parent::__construct();
		$this->filename = 'showUploadImg.html';
	}

	/**
	 * @ 图片上传界面
	 */
	public function index(){

	}

	/**
	 * @ 执行上传操作
	 */
	public function uploadAction(){
		$imgArr = G('uImg',4);
		if($imgArr['name']){
			$up = new upload($imgArr,'UploadFile/weixin',0);
			$imgName = $up->upimg();
			$imgURL = 'http://'.W_DOMAIN.'/'.$imgName;
			$this->tpl('imgURL',$imgURL);
			$this->tpl('find',1);
		}
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>