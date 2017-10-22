<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageMenu
 * 
 * @功能：菜单管理主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageMenu.class.php
 * 
 * @开发时间：2013-11-19 15:28:17
 * 
 * @菜单类
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/menu.class.php");
class manageMenu extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('managecate');
		$this->filename='menu.html';
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$tid = G('tid',2,2);
		$this->tpl('menuArr',manageMenu::getMenuArr($this->c));
		$this->tpl('tid',$tid);
		$this->toString();
	}

	/**
	 * @ 获取全部菜单数据，并返回树形结构数组
	 */
	static public function getMenuArr($db){
		$menu = new menu($db,1);
		foreach(config::$UserMenuConfigArr as $k=>$v){
			$temp[$k]['menuName'] = $v; 
			$temp[$k][] = $menu->getMenu('C_Type',$k);
		}
		return $temp;
	}

	/**
	 * @ 获取指定ID的菜单数据
	 */
	static public function getMenuSelect($db,$idArr){
		if(is_array($idArr) && count($idArr)){
			$menu = new menu($db,1);
			foreach(config::$UserMenuConfigArr as $k=>$v){
				$arr = $menu->getMenuID($k,join(',',$idArr));
				if(count($arr)){//检测下级是否有菜单
					$temp[$k]['menuName'] = $v; 
					$temp[$k][] = $arr;
				}
			}		
		}
		return $temp;
	}

	/**
	 * @ 菜单写入操作
	 */
	public function addMenu(){
		$dataArr['C_CateName'] = G('C_CateName');
		$dataArr['C_Link'] = G('C_Link');
		$dataArr['C_Level'] = G('C_Level',1,2);
		$dataArr['C_Type'] = G('C_Type',1,2);
		$this->c->insert($dataArr);
		show('添加成功','index.php?m=manageMenu&p=manage&tid='.$dataArr['C_Type']);
	}

	/**
	 * @ 菜单删除操作
	 */
	public function delMenu(){
		$tid = G('tid',2,2);
		$type = G('type',2,2);
		$num = $this->getSubMenuQuantity($tid);
		if($num){
			show('该菜单下属有子菜单无法删除');
		}else{
			$this->c->del('C_ID',$tid);
		}
		show('删除成功!','index.php?m=manageMenu&p=manage&tid='.$type);
	}

	/**
	 * @ 菜单删除操作
	 */
	private function getSubMenuQuantity($tid){
		return $this->c->sumRows("C_Level='".$tid."'");
	}

	/**
	 * @ 菜单更新显示界面
	 */
	public function popMenuUpdate(){
		$tid = G('tid',2,2);
		$dataArr = $this->c->search("C_ID='".$tid."'");
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl('menuArr',manageMenu::getMenuArr($this->c));

		$this->toString('pop/popMenuUpdate.html');
	}

	/**
	 * @ 菜单信息更新界面
	 */
	public function updateMenu(){
		$tid = G('C_ID',1,2);
		$dataArr['C_CateName'] = G('C_CateName');
		$dataArr['C_Type'] = G('C_Type',1,2);
		$dataArr['C_Level'] = G('C_Level',1,2);
		$dataArr['C_Link'] = G('C_Link');
		$dataArr['C_Sort'] = G('C_Sort',1,2);

		$this->c->update($dataArr,"C_ID='".$tid."'");
		show('更改成功!','index.php?m=manageMenu&p=manage&tid='.$type);
	}
	
	/**
	 * @ Ajax模式获取指定一级菜单的全部二级菜单
	 */
	public function ajaxGetSmallMenu(){
		$cid = G('cid',2,2);
		$tid = G('tid',2,2);
		if(!$tid){ $selected = 'selected="selected"'; }
		$dataArr = $this->c->search("C_Type='".$cid."' AND C_Level=0");
		$optionArr = createSelectOption($dataArr,'C_CateName','C_ID',$tid);
		echo "<option value='' ".$selected.">一级菜单</option>\n".$optionArr;
	}


}
?>