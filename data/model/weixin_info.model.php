<?php
/**
 * 微信用户信息
 *
 * 
 */
defined('InShopNC') or exit('Access Invalid!');
class weixin_infoModel extends Model{


	/**
     * 添加微信用户详细信息
     */
    public function addOneMemberWeixinInfo($insert){
        return $this->table('member_weixin_info')->insert($insert);
    }


	/**
     * 获取用户微信详细信息
     */
    public function getOneMemberWeixinInfo($openid,$laiyuan=''){
    	$condition['W_Openid'] = $openid;
        $laiyuan?$condition['ad_name'] = $laiyuan:'';
        $result =  $this->table('member_weixin_info')->where($condition)->find();
        if(!empty($result)){
        	return $result;
        }else{
        	return false;
        }
    }


    /**
     * 添加微信点赞信息
     */
    public function addWeixinZan($insert){
        return $this->table('member_weixin_dianzan')->insert($insert);
    }

    /**
     * 获取微信点赞信息
     */
    public function getOneWeixinZan($condition=''){
        $result =  $this->table('member_weixin_dianzan')->where($condition)->find();

        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
    }

    /**
     * 获取微信点赞数量
     */
    public function getCountWeixinZan($push_openid){
        $condition['D_PushOpenId'] = $push_openid;
        $result =  $this->table('member_weixin_dianzan')->where($condition)->count();

        if(!empty($result)){
            return $result;
        }else{
            return 0;
        }

    }





}