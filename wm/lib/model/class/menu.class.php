<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：db
 * 
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：db.class.php
 * 
 * @开发时间：2013-11-19 15:28:17
 * 
 * @菜单类
 * 
 */
class menu{
	public $ManageTable='managecate'; //目标数据表
	private $Level; //级别属性
	private $Resources; //数据库资源属性
	private $fields;//查询字段

	//定义构造函数
	public function __construct($conn,$Level){
		if(!$Level){//级别检测
			echo '级别权限错误!';
			exit;
		}
		$this->Resources=$conn; //引用外部资源
		$this->Resources->table($this->ManageTable); //设置数据库表
		//判断读取那些菜单目录
		$this->Level=$Level;
	}

	/**
	 * @ 获取指定栏目菜单数据，并返回树形结构数组
	 */
	public function getMenu($Fileds,$Level=false){
		$this->Level = $Level ? $Level : $this->Level;
		$rowArr=$this->Resources->search($Fileds." IN(".$this->Level.")",'C_Sort Asc');
		$Menu = $this->getTree($rowArr);
		return $Menu;
	}

	/**
	 * @ 按照指定ID数据查询菜单数据
	 */
	public function getMenuID($Level,$idStr){
		$rowArr=$this->Resources->search("C_Type='".$Level."' AND C_ID IN(".$idStr.")",'C_Sort Asc');
		$Menu = $this->getTree($rowArr);
		return $Menu;
	}

	/**
	 * @ 整理数组,将ID值转换为数组下标
	 */
	private function tiaozhengArr($Arr){
		foreach($Arr as $k=>$v){
			$temp[$v['C_ID']] = $v;
		}
		return $temp;
	}

	/**
	 * @ 将数据格式化成树形结构
	 */
	private function getTree($arr){
		if(count($arr)){
			$arr = $this->tiaozhengArr($arr);
		}else{
			return $arr;
		}

		foreach ($arr as $v){
			$arr[$v['C_Level']]['Menu'][$v['C_ID']] = &$arr[$v['C_ID']];
		}
		return isset($arr[0]['Menu']) ? $arr[0]['Menu'] : array(); 
	}
}
?>