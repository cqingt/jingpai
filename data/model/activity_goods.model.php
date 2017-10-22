<?php
/**
 * 活动
 *
 * 
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class activity_goodsModel extends Model{

	public function __construct() {
        parent::__construct('activity_goods');
    }


    /**
     * 取得用户参加的活动
     *
     */
    public function getMemberAddActivityList(){
    	$on = 'activity_goods.A_Id=activity_goods_user.U_ActivityId';
    	$condition['activity_goods.A_State'] = 1;
    	$condition['activity_goods_user.U_MemberId'] = $_SESSION['member_id'];
        $result = $this->table('activity_goods,activity_goods_user')->join('inner')->on($on)->where($condition)->order('activity_goods.A_Id DESC')->limit(10)->select();

        if(!empty($result)){

        	$array = array();

        	foreach ($result as $k => $v) {
        		$array[$v['A_GoodsId']] = $v;
        	}

        	return $array;
        }else{
        	return false;
        }
    }

    /**
     * 查出新增运费规则
     *
     */
    public function getActivityStoreYunfei($storeid){
        $condition['Y_State'] = 1;
        $condition['Y_StoreId'] = $storeid;
        $result = $this->table('activity_goods_yunfei')->where($condition)->find();
        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    /**
     * 删除仅参加一次活动的当前用户
     *
     */
    public function delActivityMemberById($member_id,$activity_id){
    	$condition['U_MemberId'] = $member_id;
    	$condition['U_ActivityId'] = $activity_id;
    	$condition['U_State'] = 1;
    	$re_id = $this->table('activity_goods_user')->where($condition)->delete();
    	if(!empty($re_id)){
    		return $re_id;
    	}else{
    		return false;
    	}
    }



}