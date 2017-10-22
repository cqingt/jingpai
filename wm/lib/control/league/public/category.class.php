<?php
/**
 * SW 分类管理类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：category
 * 
 * @功能：分类管理类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：category.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @category
 * 
 */
class category extends base{
	public function __construct(){
		parent::__construct();
		$this->c->table('category');
	}

	/**
	 * @ 加载全部分类并返回树形结构
	 */
	public function getCategoryTree(){
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
	 * @ 加载全部价格区间
	 */
	public function getPriceSettingTree(){
		$this->c->table('pricesetting');
		$dataArr = $this->c->search('','id asc');
		if($dataArr){
			foreach($dataArr as $k=>$v){
				if($v['P_mini'] > 0 && $v['P_max'] > 0){
				$dataArr[$k]['value'] = $v['P_mini']."-".$v['P_max'];
				}elseif($v['P_mini'] == 0){
					$dataArr[$k]['value'] = $v['P_max']." 以下";
				}else{
					$dataArr[$k]['value'] = $v['P_mini']." 以上";
				}
			}
		}
		return $dataArr;
	}
}

?>