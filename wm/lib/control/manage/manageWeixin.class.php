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
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
require_once(dirname(__FILE__)."/../../model/class/weixin/weixin.sdk.class.php");

class manageWeixin extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('menu_weixin');
	}

	/**
	 * @ 菜单列表
	 */
	public function menu(){
		$this->tpl('menuArr',$this->getMenuArr(0,1));
		$this->filename = 'weixin_menu.html';	
	}

	/**
	 * @ 菜单处理弹窗界面
	 */
	public function popWeixinMenu(){
		$cid = G('cid',2,2);
		$a = G('a',2);
		if($cid && !$update){
			$this->tpl('update',1);
			$this->tpl('cid',$cid);
			$this->tpl('dataArr',$this->getMenuInfo($cid));
		}
		$this->tpl('menuArr',$this->getMenuArr(0));
		$this->filename='pop/popWeixinMenu.html';
	}

	/**
	 * @ 加载指定ID的分类信息
	 */
	private function getMenuInfo($cid){
		return $this->c->search("M_ID='".$cid."'");
	}

	/**
	 * @ 添加菜单信息
	 */
	public function addMenu(){
		$dataArr['M_Name'] = G('M_Name');
		$dataArr['M_ParentID'] = G('M_ParentID',1,2);
		$dataArr['M_Type'] = G('M_Type');
		$dataArr['M_Key'] = G('M_Key');
		$dataArr['M_Url'] = G('M_Url');

		//数量检测
		$this->checkMenuMax($dataArr['M_ParentID']);

		$this->c->insert($dataArr);
		$cid = $this->c->insertID();
		show('添加成功!','index.php?m=manageWeixin&c=popWeixinMenu&p=manage&a=update&cid='.$cid);
	}

	/**
	 * @ 菜单数量检测
	 * @ 一级菜单最多只能3个，子菜单最多每个下面只能有5个，总共子菜单不得超过15个
	 */
	private function checkMenuMax($parentID=0){
		$num = $this->c->sumRows("M_ParentID='".$parentID."'");
		if(!$parentID && $num>=3){
			show('一级菜单最多只能添加3个!');
		}else if($parentID && $num>=5){
			show('一级菜单下的子菜单最多只能添加5个!');
		}
	}

	/**
	 * @ 删除菜单
	 */
	public function delMenu(){
		$cid = G('cid',2,2);
		$num = $this->c->sumRows("M_ParentID='".$cid."'");
		if($num){
			show('该菜单下存在子菜单无法删除!');
		}else{
			$this->c->del('M_ID',$cid);
		}
		show('删除成功！');
	}

	/**
	 * @ 菜单更新
	 */
	public function updateMenu(){
		$cid = G('M_ID',1,2);
		$dataArr['M_Name'] = G('M_Name');
		$dataArr['M_ParentID'] = G('M_ParentID',1,2);
		$dataArr['M_Type'] = G('M_Type');
		$dataArr['M_Key'] = G('M_Key');
		$dataArr['M_Url'] = G('M_Url');
		$this->c->update($dataArr,"M_ID='".$cid."'");
		show('更新成功!');
	}

	/**
	 * @ 执行创建微信菜单
	 */
	public function createMenu(){
		$this->createWeixinMenu();
	}
	/**
	 * @ 发送创建菜单数据到微信API
	 */
	private function createWeixinMenu(){
		$data = $this->arr2json($this->getMenuArr(0,1));
		$weixin = new weixinSDK;
		$weixin->createMenu($data);
	}

	/**
	 * @ 加载菜单并返回数组
	 * @ $cid:一级菜单的分类ID值。当$cid为0则显示全部一级菜单
	 */
	private function getMenuArr($cid=0,$type=0){
		if($type){//显示全部菜单，并按照分类数返回数组
			$dataArr = $this->getTreeArr();
		}else{//显示指定一级菜单下的全部子菜单
			$dataArr = $this->c->search("M_ParentID='".$cid."'");
		}
		return $dataArr;
	}

	/**
	 * @ 整理数组为树形结构菜单,并返回数组
	 */
	private function getTreeArr(){
		$dataArr = $this->c->search();
		if(count($dataArr)){
			foreach($dataArr as $k=>$v){ $arr[$v['M_ID']] = $v; }
		
			//执行树形结构处理
			foreach ($arr as $v){ $arr[$v['M_ParentID']]['Menu'][$v['M_ID']] = &$arr[$v['M_ID']]; }
			return isset($arr[0]['Menu']) ? $arr[0]['Menu'] : array();
		}
	}

	/**
	 * @ 将数组转换成微信菜单字符串形式
	 */
	private function arr2json($arr){
		if(!count($arr)){ return false; }
		foreach($arr as $v){
			if(count($v['Menu'])){
				foreach($v['Menu'] as $v1){ $arrTmp[] = $this->createMenuStr($v1); }
				$temp[] = '{"name":"'.$v['M_Name'].'",
							"sub_button":[
							'.join(',',$arrTmp).
							']}';
				unset($arrTmp);
			}else{
				$temp[] = $this->createMenuStr($v);
			}
		}
		$str = '{"button":['.join(',',$temp).']}';
		return $str;
	}

	/**
	 * @ 按菜单类型生成微信字符串
	 */
	private function createMenuStr($arr){
		if($arr['M_Type']=='click'){
			$var = '"key":"'.$arr['M_Key'].'"';
		}else{
			$var = '"url":"'.$arr['M_Url'].'"';
		}
		$str.='{
					"type":"'.$arr['M_Type'].'",
					"name":"'.$arr['M_Name'].'",
					'.$var.'
				}';
		return $str;
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>