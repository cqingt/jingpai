<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������uploadImg
 * 
 * @���ܣ�ͼƬ������洦��
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�uploadImg.class.php
 * 
 * @����ʱ�䣺2014-08-01 16:28:17
 * 
 * @ͼƬ������洦��
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
	 * @ ͼƬ�ϴ�����
	 */
	public function index(){

	}

	/**
	 * @ ִ���ϴ�����
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
	 * @ ����ϵͳ��������
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>