<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageGoods
 * 
 * @功能：产品列表
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageGoods.class.php
 * 
 * @开发时间：2014-10-16 15:28:17
 * 
 * @产品列表
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class manageGoods extends manage{
	public static $typeArr = Array('不限','出售','求购');
	public static $paymentArr = Array(1=>'线下交易',2=>'担保交易');
	public function __construct(){
		parent::__construct();
		$this->c->table('products');
		$this->tpl('typeArr',manageGoods::$typeArr);
	}

	/**
	 * @ 产品列表
	 */
	public function index(){
		$this->getGoodsList();
		$this->filename = 'goods_list.html';	
	}

	/**
	 * @ 获取产品列表
	 */
	private function getGoodsList(){
		$w = $this->createGoodsWhere();
		
		$sort = G('sort',3) == '' ? 'P_ID' : G('sort',3);
		$by_order = G('by_order',3) == '' ? 'DESC' : G('by_order',3);

		$url = 'index.php?m=manageGoods&p=manage'.$w[1]."&sort=".$sort."&by_order=".$by_order;
		$where = "1=1".$w[0];
		$fields = "*,(SELECT I_Img FROM sw_products_img WHERE I_PID=P_ID LIMIT 1) as Img,(SELECT region_name FROM sw_region WHERE region_id=P_Province) as Province,(SELECT region_name FROM sw_region WHERE region_id=P_City) as City";
		$page = new PageTurn($this->c,G('page',2,2),'products',$url,20,$sort.' '.$by_order,$where,$fields);
		$dataArr = $page->dataArr;
		if($dataArr){
			foreach($dataArr as $k=>$v){
				$dataArr[$k]['P_Name'] = $v['P_Name'] == '0' ? $v['P_Author'] : $v['P_Name'];
				$dataArr[$k]['P_BuyType'] = explode(',',$v['P_BuyType']);
				if($v['P_Size']){
					$P_Size = explode('|',$v['P_Size']);
					$P_C = ($P_Size[0]*$P_Size[1]*0.0009);
					$dataArr[$k]['P_Size'] = $P_Size;
					$dataArr[$k]['P_C'] = sprintf("%.2f", $P_C);
				}
			}
		}

		
		$this->tpl('sort',$sort);
		$this->tpl('by_order',$by_order);

		$this->tpl('paymentArr',manageGoods::$paymentArr);
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}

	/**
	 * @ 产品搜索
	 */
	private function createGoodsWhere(){
		$a = G('a',2);
		if($a == 'search'){
			$type = G('type',2,2);
			if($type){
				$w[] = "P_Type='".$type."'";
				$u[] = "type=".$type;
			}

			$payment = G('payment',2,2);
			if($payment){
				$w[] = "P_BuyType LIKE '%".$payment."%'";
				$u[] = "payment=".$payment;
			}

			$province = G('W_Province',2,2);
			if($province){
				$w[] = "P_Province='".$province."'";
				$u[] = "W_Province=".$province;
			}
			$city = G('W_City',2,2);
			if($city){
				$w[] = "P_City='".$city."'";
				$u[] = "W_City=".$city;
			}
			
			$key = G('key',2);
			if($key){
				$w[] = "(P_Name LIKE '%".$key."%' OR P_Author='".$key."' OR P_Contact='".$key."' OR P_Content LIKE '%".$key."%')";
				$u[] = "key=".$key;
			}

			if(count($w)){
				$where = " AND ".join(' AND ',$w);
				$url = "&".join('&',$u);
			}
			return Array($where,$url);
		}
		
	}
	
	/**
	 * @ 产品详情
	 */
	public function GoodsShow(){
		$goods_id = G('OID',2,2);
		$dataArr = $this->c->search("P_ID = '$goods_id'",'','','*');
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/GoodsShow.html';
	}

	/**
	 * @ 编辑产品
	 */
	public function up_goods(){
		$goods_id = G('pid',2,2);
		$dataArr = $this->c->search("P_ID = '$goods_id'",'','','*');
		$this->c->table('products_img');
		$Img_DataArr = $this->c->search('I_PID='.$goods_id);
		$this->tpl('Img_DataArr',$Img_DataArr);
		if($dataArr){
			foreach($dataArr as $k=>$v){
				if($v['P_Size']){
					$P_Size = explode('|',$v['P_Size']);
				}
				$dataArr[$k]['P_Width'] = $P_Size[0];
				$dataArr[$k]['P_Height'] = $P_Size[1];
				if($v['P_BuyType']){
					$P_BuyType = explode(',',$v['P_BuyType']);
				}
				$dataArr[$k]['P_BuyType1'] = $P_BuyType[0];
				$dataArr[$k]['P_BuyType2'] = $P_BuyType[1];
			}
		}
		$this->tpl('cateArr',$this->getCategory());
		$this->createIpnut($dataArr[0]);
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/GoodsUp.html';
	}


	/**
	 * @ ajax模式执行异步图片上传
	 */
	public function ajaxUploadImg(){
		$imgArr = $_FILES;
		$up = new upload($imgArr['imgPhonto0'],'UploadFile/pro',1);
		$up->small_width = 200;
		$up->small_height = 200;
		$up->rotateStatus = 1;//执行图片旋转
		$up->smallStatus = 1;//使用中心裁切缩略图生成模式
		$filename = $up->upimg();
		echo str_replace('UploadFile/pro/','UploadFile/pro/small/thumb_',$filename);

		//生成320*200图
		/**/
		$up->small_width = 320;
		$up->small_height = 200;
		$up->smallStatus = 1;
		$file = str_replace('UploadFile/pro/','',$filename);
		$up->NarrowImg($file,'UploadFile/pro/v-'.$file);
		
		
		//生成600*350图
		/**/
		$up->small_width = 620;
		$up->small_height = 400;
		$up->smallStatus = 0;
		$file = str_replace('UploadFile/pro/','',$filename);
		$up->NarrowImg($file,'UploadFile/pro/m-'.$file);

		
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
	 * @ 执行产品更新
	 */
	public function update(){
		$pid = G('id',1,2);
		$dataArr['P_Type'] = G('P_Type',1,2);
		$dataArr['P_Cate'] = G('P_Cate',1,2);
		$dataArr['P_SmallCate'] = G('P_SmallCate',1,2);
		$dataArr['P_Name'] = G('P_Name');
		$dataArr['P_Author'] = G('P_Author');
		$dataArr['P_Size'] = G('P_Width').'|'.G('P_Height');
		$dataArr['P_Money'] = G('P_Money');
		$dataArr['P_Contact'] = G('P_Contact');
		$dataArr['P_Mobile'] = G('P_Mobile');
		$dataArr['P_Content'] = str_replace(" ","<br>",G('P_Content'));
		$dataArr['P_Province'] = G('P_Province',1,2);
		$dataArr['P_City'] = G('P_City',1,2);
		$dataArr['P_BuyType'] = count($_POST['P_BuyType']) ? join(',',$_POST['P_BuyType']) : 0;
		$dataArr['P_UpTime'] = time();
		$this->c->table('products');
		$this->c->update($dataArr,"P_ID='".$pid."'");//更新信息
		//验证是否执行图片写入
		if($dataArr['P_Type'] == 1){
			$this->c->table('products_img');
			$this->c->del('I_PID',$pid);
			$this->addProductsImg($pid);
		}
		show('操作成功!','index.php?m=manageGoods&p=manage');
	}


	/**
	 * @ 执行产品图片信息写入
	 */
	private function addProductsImg($pid){
		$this->c->table('products_img');
		$imgArr = count($_POST['ImgArr']) ? $_POST['ImgArr'] : 0;
		if(!$imgArr){
			show('图片异常丢失，请选择产品编辑后从新上传!');
			exit;
		}
		$dataArr['I_PID'] = $pid;
		foreach($imgArr as $k=>$v){
			if($v){
				$dataArr['I_Img'] = $v;
				$this->c->insert($dataArr);
			}
		}
	}

	/**
	 * @ 加载所有一级分类
	 */
	private function getCategory(){
		$this->c->table('category');
		$dataArr = $this->c->search('C_ParentID=0');
		return $dataArr;
	}


	/**
	 * @ 删除产品
	 */
	public function del_goods(){
		$pid = intval(G('pid',2,2));
		$this->c->del('P_ID',$pid);
		//删除产品图片
		$this->c->table('products_img');
		$this->c->del('I_PID',$pid);
		show('操作成功!');
		exit;
	}

	
	

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}

	private function createIpnut($dataArr=array()){
		$this->tpl('P_Money',createNumberInput('P_Money',10,'class="input_zck" placeholder="价格为空则显示询价" value="'.$dataArr['P_Money'].'"'));
		$this->tpl('P_Size',createNumberInput('P_Size',20,'class="input_zck" value="'.$dataArr['P_Size'].'"'));
		$this->tpl('P_Mobile',createNumberInput('P_Mobile',11,'class="input_zck" value="'.$dataArr['P_Mobile'].'"'));
		$this->tpl('P_Width',createNumberInput('P_Width',8,'class="input50_a" placeholder="宽度" value="'.$dataArr['P_Width'].'"'));
		$this->tpl('P_Height',createNumberInput('P_Height',8,'class="input50_b" placeholder="高度" value="'.$dataArr['P_Height'].'"'));
	}
}
?>