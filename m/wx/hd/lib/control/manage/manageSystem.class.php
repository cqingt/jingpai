<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageSystem
 * 
 * @功能：系统站点配置类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageSystem.class.php
 * 
 * @开发时间：2013-11-29 16:28:17
 * 
 * @系统配置类
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");

class manageSystem extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('system_info');
		$this->Number = W_NUMBER;
		$this->filename = 'system.html';
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->showUpdateSystem();//加载系统信息

		//加载可用编辑器列表
		$edit = new editClass;
		$this->tpl('editArr',$edit->getEditArr());
	}

	/**
	 * @ 加载系统信息并输出
	 */
	private function showUpdateSystem(){
		if(!$this->Number){ return false;}//商户号为空，则不执行信息加载
		$this->tpl('update',1);
		$this->tpl('dataArr',$this->getSystemInfo());
	}

	/**
	 * @ 加载系统详细信息
	 */
	private function getSystemInfo(){
		$fields = "*,(SELECT E_Content FROM sw_event WHERE E_EventTitle='subscribe') as EventContent";
		$dataArr = $this->c->search("W_Number='".$this->Number."'",'','',$fields);
		return $dataArr[0];
	}


	/**
	 * @ 更新系统信息
	 */
	public function updateSystem(){
		$domain= G('W_Domain');
		//$dataArr['W_Contact'] = G('W_Contact');
		//$dataArr['W_Mobile'] = G('W_Mobile');
		$dataArr['W_Domain'] = G('W_Domain');
		$dataArr['W_Company'] = G('W_Company');
		$dataArr['W_Name'] = G('W_Name');
		$dataArr['W_Mail'] = G('W_Mail');
		$dataArr['W_Province'] = G('W_Province',1,2);
		$dataArr['W_City'] = G('W_City',1,2);
		$dataArr['W_Adress'] = G('W_Adress');
		$dataArr['W_Edit'] = G('W_Edit');

		$dataArr['W_ONLineSell'] = G('W_ONLineSell'); // 线上交易荣誉度  卖家
		$dataArr['W_ONLineBuy'] = G('W_ONLineBuy'); // 线上交易荣誉度  买家

		$dataArr['W_NextLineSell'] = G('W_NextLineSell'); // 线下交易荣誉度 卖家
		$dataArr['W_NexLineBuy'] = G('W_NexLineBuy'); // 线下交易荣誉度 买家

		//图片上传操作
		$img = $this->logoUpload($domain);
		if($img){ $dataArr['W_Logo'] = $img; }

		$this->c->update($dataArr,"W_Number='".$this->Number."'");//更新商户信息

		//写入关注回复内容
		$this->subscribe(G('E_Content',1,1,1));

		//生成商户配置文件
		$this->createSystemConfig($this->Number);

		show('系统更新成功!');
	}

	/**
	 * @ 生成商户配置文件
	 */
	private function createSystemConfig($Number){
		tool::createConfig($Number);
	}

	/**
	 * @ 写入系统菜单
	 */
	private function writeSystemMenu($number,$menu=0){
		$this->c->table('system_menu');
		$this->c->insert(array('W_Number'=>$number,'W_Menu'=>$menu));
	}

	/**
	 * @ 菜单数据整理
	 */
	static public function levelToStr($Array){
		if(!is_array($Array)){return false;}//验证是否为数组
		foreach($Array as $k=>$v){
			if(strpos($v,':')){//判断数组元素是否为ID与菜单链接地址组合
				$TempArr=explode(':',$v);//拆分菜单地址和菜单ID
				$Arr[$TempArr[0]]=$TempArr[1];//将菜单ID作为下标，菜单地址最为元素值组合成数组
			}else{//如果不是菜单ID与菜单链接组合则直接将菜单ID做为下标并赋予空值
				$Arr[$v]='';
			}
		}
		return json_encode($Arr);
	}

	/**
	 * @ 商户Logo上传
	 */
	private function logoUpload($domain){
		$imgArr = G('img',4);
		$filepath = 'static/upload/images/'.domain2folder($domain).'/logo';
		if($imgArr['name']){
			$upload = new upload($imgArr,$filepath,0);
			$upload->filename = 'logo';
			return $upload->upimg();
		}else{
			return false;
		}
	}

	/**
	 * @ 微信关注回复内容设定
	 */
	private function subscribe($content,$event='subscribe',$type='text'){
		if(!$content){ return false; }
		$this->c->table('event');
		$where = "E_EventTitle='".$event."'";
		$num = $this->c->sumRows($where);
		if($num){
			$this->c->update(array('E_Content'=>$content),$where);
		}else{
			$this->c->insert(array('E_EventTitle'=>$event,'E_Content'=>$content,'E_Type'=>$type));
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