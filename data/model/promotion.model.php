<?php
/**
 * 促销信息管理
 * @精灵添加
 * @添加时间：2015年9月25日
 * @功能说明：分类列表页右侧顶部促销信息管理
 ***/
defined('InShopNC') or exit('Access Invalid!');
class promotionModel{
	/**
	 * 促销信息列表
	 *
	 * @param array $condition 查询条件
	 * @param obj $page 分页对象
	 * @return array 二维数组
	 */
	public function getList($condition,$page=''){
		$param	= array();
		$param['table']	= 'promotion';
		$param['where']	= $this->getCondition($condition);

		$param['order']	= $condition['order'] ? $condition['order'] : 'p_id';
		return Db::select($param,$page);
	}
	/**
	 * 添加促销信息
	 *
	 * @param array $input
	 * @return bool
	 */
	public function add($input){
		return Db::insert('promotion',$input);
	}
	/**
	 * 更新活动
	 *
	 * @param array $input
	 * @param int $id
	 * @return bool
	 */
	public function update($input,$id){
		return Db::update('promotion',$input," p_id='$id' ");
	}
	/**
	 * 删除活动
	 *
	 * @param string $id
	 * @return bool
	 */
	public function del($id){
		return Db::delete('promotion','p_id in('.$id.')');
	}
	/**
	 * 根据id查询一条活动
	 *
	 * @param int $id 活动id
	 * @return array 一维数组
	 */
	public function getOneById($id){
		return Db::getRow(array('table'=>'promotion','field'=>'p_id','value'=>$id));
	}
	/**
	 * 根据条件
	 *
	 * @param array $condition 查询条件
	 * @param obj $page 分页对象
	 * @return array 二维数组
	 */
	public function getJoinList($condition,$page=''){
		$param	= array();
		$param['table']	= 'activity,activity_detail';
		$param['join_type']	= empty($condition['join_type'])?'right join':$condition['join_type'];
		$param['join_on']	= array('activity.activity_id=activity_detail.activity_id');
		$param['where']	= $this->getCondition($condition);
		$param['order']	= $condition['order'];
		return Db::select($param,$page);
	}
	/**
	 * 构造查询条件
	 *
	 * @param array $condition 条件数组
	 * @return string
	 */
	private function getCondition($condition){
		$conditionStr	= '';
		if($condition['p_id'] != ''){
			$conditionStr	.= " and promotion.p_id='{$condition['p_id']}' ";
		}
		
		//搜索位置
		if($condition['status'] != ''){
			$conditionStr	.= " and promotion.promotion_state = '{$condition['promotion_state']}' ";
		}
		//标题搜索
		if($condition['promotion_title'] != ''){
			$conditionStr	.= " and promotion.promotion_title like '%{$condition['promotion_title']}%' ";
		}
		//当前时间大于结束时间（过期）
		if ($condition['promotion_enddate_greater'] != ''){
			$conditionStr	.= " and promotion.promotion_end_date < '{$condition['promotion_enddate_greater']}'";
		}
		//可删除的活动记录
		if ($condition['promotion_enddate_greater_or'] != ''){
			$conditionStr	.= " or promotion.promotion_end_date < '{$condition['promotion_enddate_greater_or']}'";
		}
		//某时间段内正在进行的活动
		if($condition['promotion_daterange'] != ''){
			$conditionStr .= " and (promotion.promotion_end_date >= '{$condition['promotion_daterange']['startdate']}' and promotion.promotion_start_date <= '{$condition['promotion_daterange']['enddate']}')";
		}
		//分类
		if($condition['cate_id'] != ''){
			$conditionStr	.= " and promotion.cate_id='{$condition['cate_id']}' ";
		}
		return $conditionStr;
	}

	/**
	 * 根据分类获取促销信息
	 *
	 * @param int $cate_id 分类ID
	 * @param int $weizhi 位置ID 0为热卖推荐 1为商品精选 2为新品推荐
	 * @return array 二维数组
	 */
	 public function getPromotionList($cate_id,$weizhi=0,$num=7){
		if(!$cate_id){ return array(); }
		
		//判断是否按照分类级别加载
		if(!$weizhi){
			//2016-07-04  根据运营需求修改 选了那级分类就只在那级分类下边显示
//			$cate = Model('goods_class');
//			$dataArr = $cate->getCateArr($cate_id);
//			
//			$max = count($dataArr);
//			if($max==3){
//				unset($dataArr[$max-1]);
//				$arr = $dataArr;
//			}elseif($max==2){
//				$arr[] = $dataArr[0];
//			}elseif($max==1){
//				$arr = $cate->getCateDownArr($cate_id);
//				foreach($arr as $k=>$v){ $temp[] = $v['gc_id']; }
//				$temp[] = $cate_id;
//				$arr = $temp;
//			}
//			$idStr = join("','",$arr);
//			$w = "cate_id IN('".$idStr."') AND ";
			$w = "cate_id = ".$cate_id." AND ";
		}

		$param	= array();
		$shijian =time();
		$param['table']	= 'promotion';
		$param['where']	= $w."promotion_start_date<='".$shijian."' AND promotion_end_date>='".$shijian."' AND promotion_state='".$weizhi."'";
		$param['order']	= "promotion_sort ASC LIMIT ".$num;
		$dataArr = Db::select($param,$num);
		//2016-08-05 应运营要求修改只要有秒杀 团购等活动则显示活动价
		if($dataArr){
			foreach($dataArr as $k=>$v){
				//获取促销信息
				$goods_info = Model('goods')->getChuXiao($v['goods_id']);
				if($goods_info['promotion_type'] && $goods_info['promotion_price']){
					$dataArr[$k]['promotion_type'] = $goods_info['promotion_type'];
					$dataArr[$k]['promotion_price'] = $goods_info['promotion_price'];
				}
			}
		}
		return $dataArr;
	 }
}

