<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageCategory
 * 
 * @功能：分频分类管理类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageCategory.class.php
 * 
 * @开发时间：2014-08-18 14:37:17
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
class manageCategory extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('category');
		$this->filename='category.html';
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->tpl('dataArr',$this->getCategoryTree());
		$this->toString();
	}

	/**
	 * @ 加载分类信息并组合属性菜单
	 */
	private function getCategoryTree(){
		$dataArr = $this->c->search();
		if(!count($dataArr)){ return array(); }

		//将ID值转换成数组下标值
		foreach($dataArr as $k=>$v){ $temp[$v['C_ID']] = $v; }
		$arr = $temp;

		//执行属性结构转换
		foreach ($arr as $v){
			$arr[$v['C_ParentID']]['Menu'][$v['C_ID']] = &$arr[$v['C_ID']];
		}
		return isset($arr[0]['Menu']) ? $arr[0]['Menu'] : array(); 
	}

	/**
	 * @ 加载全部一级返回数组
	 */
	private function getCategory(){
		return $this->c->search("C_ParentID=0");
	}

	/**
	 * @ 分类添加/更新界面
	 */
	public function popAddCategory(){
		$cid = G('cid',2,2);
		$a = G('a',2);
		if($cid && $a=='update'){//显示更新界面信息
			$this->tpl('dataArr',$this->getCategoryInfo($cid));
			$this->tpl('update',1);
		}
		$this->tpl('cid',$cid);
		$this->tpl('cateArr',$this->getCategory());
		$this->filename = 'pop/popAddCategory.html';
		$this->toString();
	}

	/**
	 * @ 添加分类
	 */
	public function addCategory(){
		$dataArr['C_Name'] = G('C_Name');
		$dataArr['C_ParentID'] = G('C_ParentID',1,2);
		$this->c->insert($dataArr);
		show('添加成功！','index.php?m=manageCategory&p=manage');
	}

	public function delCategory(){
		$cid = G('cid',2,2);
		$num = $this->c->sumRows("C_ParentID='".$cid."'");
		if($num){
			show('该分类下存在子分类无法删除!');
		}else{
			$this->c->del('C_ID',$cid);
			show('删除成功！');
		}
	}

	/**
	 * @ 更改分类信息
	 */
	public function updateCategory(){
		$cid = G('cid',1,2);
		$dataArr['C_Name'] = G('C_Name');
		$dataArr['C_ParentID'] = G('C_ParentID',1,2);
		$this->c->update($dataArr,"C_ID='".$cid."'");
		show('修改成功！','index.php?m=manageCategory&p=manage');
	}

	/**
	 * @ 获取指定id分类信息
	 */
	public function getCategoryInfo($cid){
		$dataArr = $this->c->search("C_ID='".$cid."'");
		return $dataArr;
	}
}
?>