<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageGallery
 * 
 * @功能：画廊认证
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageGallery.class.php
 * 
 * @开发时间：2015-1-9 15:28:17
 * 
 * @画廊认证
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
class manageGallery extends manage{
	public function __construct(){
		parent::__construct();
		$this->c->table('real_gallery');
	}

	/**
	 * @ 画廊认证申请列表
	 */
	public function index(){
		$this->getGalleryList();
		$this->filename = 'gallery_list.html';	
	}

	/**
	 * @ 获取画廊认证列表
	 */
	private function getGalleryList(){
		$w = $this->createGalleryWhere();
		$url = 'index.php?m=manageGallery&p=manage'.$w[1];
		$where = " 1=1 ".$w[0];
		$fields = '*,(select U_UserName from sw_user where U_ID = UID) as user_name';
		$page = new PageTurn($this->c,G('page',2,2),'real_gallery',$url,20,'id desc',$where,$fields);
		$dataArr = $page->dataArr;
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}
	
	/**
	 * @ 搜索画廊
	 */
	private function createGalleryWhere(){
		$a = G('a',2);
		if(!$a == 'search'){ return array(); }
		$key = G('key',2);
		if($key){
			$w[] = " g_name like '%".$key."%' ";
			$u[] = 'key='.$key;
		}
		$rzType = G('rzType',2,2);
		if($rzType){
			if($rzType == 1){
				$rzTypes = 0;
			}
			if($rzType == 2){
				$rzTypes = 1;
			}
			$w[] = " is_shen='".$rzTypes."' ";
			$u[] = 'rzType='.$rzType;
		}
		if(count($w)){
			$where = ' AND '.join(' AND ',$w);
			$url = '&'.join('&',$u);
		}
		$this->tpl('rzType',$rzType);
		$this->tpl('key',$key);
		return Array($where,$url);
	}
	
	/**
	 * @ 编辑认证信息
	 */
	public function Galleryedit(){
		$id = intval(G('id',3));
		$this->tpl('dataArr',$this->getShowGallery($id));
		$this->filename = 'pop/GalleryUp.html';	
	}
	
	/**
	 * @ 执行编辑认证信息
	 */
	public function update(){
		$imgArr = $_FILES;
		//上传营业执照图片
		if($imgArr['license_photo']["name"]){
			$up = new upload($imgArr['license_photo'],'UploadFile/pro',1);
			$up->small_width = 150;
			$up->small_height = 150;
			$up->rotateStatus = 1;//执行图片旋转
			$up->smallStatus = 1;//使用中心裁切缩略图生成模式
			$filename = $up->upimg();
			$license_photo = str_replace('UploadFile/pro/','UploadFile/pro/small/thumb_',$filename);
			$dataArr['license_photo'] = $license_photo;
		}
		if($imgArr['card_photo']["name"]){
			//上传手拿身份证正面照片
			$up1 = new upload($imgArr['card_photo'],'UploadFile/pro',1);
			$up1->small_width = 150;
			$up1->small_height = 150;
			$up1->rotateStatus = 1;//执行图片旋转
			$up1->smallStatus = 1;//使用中心裁切缩略图生成模式
			$filename1 = $up1->upimg();
			$card_photo = str_replace('UploadFile/pro/','UploadFile/pro/small/thumb_',$filename1);
			$dataArr['card_photo'] = $card_photo;
		}
		
		if($imgArr['gallery_photo']["name"]){
			//上传画廊logo
			$up2 = new upload($imgArr['gallery_photo'],'UploadFile/pro',1);
			$up2->small_width = 150;
			$up2->small_height = 150;
			$up2->rotateStatus = 1;//执行图片旋转
			$up2->smallStatus = 1;//使用中心裁切缩略图生成模式
			$filename2 = $up2->upimg();
			$gallery_photo = str_replace('UploadFile/pro/','UploadFile/pro/small/thumb_',$filename2);
			$dataArr['gallery_photo'] = $gallery_photo;
		}



		$id = G('id',1,2);
		$dataArr['g_name'] = G('g_name');
		$dataArr['license_no'] = G('license_no');
		$dataArr['head_name'] = G('head_name');
		$dataArr['card'] = G('card');
		$dataArr['phone'] = G('phone');
		$dataArr['wechat'] = G('wechat');
		$dataArr['g_desc'] = G('g_desc');
		$dataArr['province'] = G('province',1,2);
		$dataArr['city'] = G('city',1,2);
		$dataArr['county'] = G('county',1,2);
		$dataArr['address'] = G('address');
		$dataArr['collection'] = G('collection');
		$dataArr['bank'] = G('bank');
		$dataArr['bank_address'] = G('bank_address');
		$dataArr['g_password'] = md5(G('g_password'));
		$this->c->table('real_gallery');
		$this->c->update($dataArr,"id='".$id."'");//更新信息
		$dataOne = $this->c->search('id='.$id,'','','g_id');
		$this->c->table('gallery');
		$dataGallery['g_name'] = G('g_name');
		$this->c->update($dataGallery,"id='".$dataOne[0]['g_id']."'");
		show('修改信息成功!','index.php?m=manageGallery&p=manage');
	}

	/**
	 * @ 通过或取消审核
	 */
	public function getShenHe(){
		$id = intval(G('id',3));
		$type = intval(G('type',3));
		$g_id = intval(G('g_id',3));
		//检测画廊是否已认证
		$g_dataArr = $this->c->search("id = '$id' AND g_id = '$g_id' AND is_shen = 1",'','','(select U_UserName from sw_user where U_ID = UID) as user_name');
		if($g_dataArr && $type == 1){
			show("该画廊已被会员《".$g_dataArr[0]['user_name']."》认证",'index.php?m=manageGallery&p=manage');
			exit;
		}
		$Gallery = $this->getShowGallery($id);
		$this->c->table('gallery');
		$gallery_dataArr['is_apply'] = "".$type."";
		$gallery_dataArr['U_ID'] = $type == 1 ? $Gallery['UID'] : '0';
		$gallery_dataArr['apply_time'] = time();
		$this->c->update($gallery_dataArr,"id='".$g_id."'");//更新信息

		$this->c->table('real_gallery');
		$dataArr['is_shen'] = "".$type."";
		$this->c->update($dataArr,"id='".$id."'");//更新信息
		$msg = $type == 1 ? '通过审核成功' : '取消审核成功';

		/*2015-4-23 L 加,通过认证后用户表也更新*/
		if($type == 1){
			$uid=$Gallery['UID'];//画廊对应user表UID
			$this->c->table('user');//用户表
			$this->c->execute("UPDATE sw_user SET U_isRZ=1 WHERE U_ID='".$uid."'");
		}else{
			$uid=$Gallery['UID'];//画廊对应user表UID
			$this->c->table('user');//用户表
			$this->c->execute("UPDATE sw_user SET U_isRZ=0 WHERE U_ID='".$uid."'");
		}
		/***********/
		show($msg,'index.php?m=manageGallery&p=manage');
	}
	
	/**
	 * @ 删除认证信息
	 */
	public function del_Gallery(){
		$id = intval(G('id',2,2));
		$g_dataArr = $this->c->search("id = '$id' AND is_shen = 1",'','','id');
		if($g_dataArr){
			show("该画廊已认证，不能被删除。",'index.php?m=manageGallery&p=manage');
			exit;
		}
		$this->c->del('id',$id);
		show('操作成功!');
		exit;
	}

	/**
	 * @ 获取某个认证画廊的详细信息
	 */
	private function getShowGallery($id){
		$dataArr = $this->c->search("id = '$id'",'','','*');
		if($dataArr){
			foreach($dataArr as $k=>$v){
				$dataArr[$k]['d_license_photo'] = str_replace('UploadFile/pro/small/thumb_','UploadFile/pro/',$v['license_photo']);
				$dataArr[$k]['d_card_photo'] = str_replace('UploadFile/pro/small/thumb_','UploadFile/pro/',$v['card_photo']);
				$dataArr[$k]['d_gallery_photo'] = str_replace('UploadFile/pro/small/thumb_','UploadFile/pro/',$v['gallery_photo']);
			}
		}
		return $dataArr[0];
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>	