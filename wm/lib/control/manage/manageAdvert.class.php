<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageAdvert
 * 
 * @功能：微信接口功能操作类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageAdvert.class.php
 * 
 * @开发时间：2014-07-29 15:28:17
 * 
 * @微信接口功能操作类
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
require_once(dirname(__FILE__)."/../../model/class/weixin/weixin.sdk.class.php");

class manageAdvert extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('advert');
	}

	/**
	 * @ 广告列表
	 */
	public function index(){
		$dataArr = $this->c->search();
		if($dataArr)
		{
			foreach($dataArr as $k => $v)
			{
				$dataArr[$k]['A_Type'] = $v['A_Type'] == 1 ? '顶部':'底部';
				$dataArr[$k]['A_State'] = $v['A_State'] == 1 ? '是':'否';
			}
		}
		$this->tpl('advertArr',$dataArr);
		$this->filename = 'advert_list.html';	
	}

	/**
	 * @ 广告处理弹窗界面
	 */
	public function popAdvert(){
		$cid = G('cid',2,2);
		$dataArr = $this->c->search("A_ID = '$cid'",'','','*');
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/popAdvert.html';
	}

	/**
	 * @ 添加广告
	 */
	public function addAdvert(){
		$img = G('ImgArr');
		$dataArr['A_Name'] = G('A_Name');
		$dataArr['A_Url'] = G('A_Url')?G('A_Url'):'#';
		$dataArr['A_Image'] = $img[0];
		$dataArr['A_Type'] = G('A_Type');
		$dataArr['A_State'] = G('A_State');
		$dataArr['A_Time'] = time();

		$this->c->insert($dataArr);
		$cid = $this->c->insertID();
		show('添加成功!','index.php?m=manageAdvert&c=index&p=manage');
	}

	/**
	 * @ 删除广告
	 */
	public function delAdvert(){
		$cid = G('cid',2,2);
		$this->c->del('A_ID',$cid);
		show('删除成功！');
	}

	/**
	 * @ 广告更新
	 */
	public function updateAdvert(){
		$img = G('ImgArr');
		$cid = G('id',1,2);
		$dataArr['A_Name'] = G('A_Name');
		$dataArr['A_Url'] = G('A_Url')?G('A_Url'):'#';
		$dataArr['A_Image'] = str_replace('UploadFile/pro/small/thumb_','UploadFile/pro/',$img[0]);
		$dataArr['A_Type'] = G('A_Type');
		$dataArr['A_State'] = G('A_State');
		$this->c->update($dataArr,"A_ID='".$cid."'");
		show('更新成功!','index.php?m=manageAdvert&c=index&p=manage');
	}


	/**
	 * @ ajax模式执行异步图片上传
	 */
	public function ajaxUploadImg(){
		$imgArr = $_FILES;
		$up = new upload($imgArr['imgPhonto0'],'UploadFile/pro',1);
		$up->small_width = 200;
		$up->small_height = 200;
		//$up->rotateStatus = 1;//执行图片旋转
		//$up->smallStatus = 1;//使用中心裁切缩略图生成模式
		$filename = $up->upimg();
		echo str_replace('UploadFile/pro/','UploadFile/pro/small/thumb_',$filename);

		//生成320*200图
		/*
		$up->small_width = 320;
		$up->small_height = 200;
		$up->smallStatus = 1;
		$file = str_replace('UploadFile/pro/','',$filename);
		$up->NarrowImg($file,'UploadFile/pro/v-'.$file);*/
		
		
		//生成600*350图
		/*
		$up->small_width = 620;
		$up->small_height = 400;
		$up->smallStatus = 0;
		$file = str_replace('UploadFile/pro/','',$filename);
		$up->NarrowImg($file,'UploadFile/pro/m-'.$file);*/

		
	}

	/**
	 * @ ajax模式执行异步图片删除
	 */
	public function ajaxDelImg(){
		$filenameX = G('filename',2);
		if(!$filenameX){return false;}
		$filenameD = str_replace('small/thumb_','',$filenameX);
		if(unlink($filenameD)){ echo 1;}
		if(unlink($filenameX)){ echo 1;}
	}


	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>