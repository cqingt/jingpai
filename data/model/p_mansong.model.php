<?php
/**
 * 满即送模型 
 *
 * 
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class p_mansongModel extends Model{

    const MANSONG_STATE_NORMAL = 1;
    const MANSONG_STATE_CLOSE = 2;
    const MANSONG_STATE_CANCEL = 3;

    private $mansong_state_array = array(
        0 => '全部',
        self::MANSONG_STATE_NORMAL => '正常',
        self::MANSONG_STATE_CLOSE => '已结束',
        self::MANSONG_STATE_CANCEL => '管理员关闭'
    );

    public function __construct(){
        parent::__construct('p_mansong');
    }

	/**
     * 读取满即送列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 限时折扣列表
	 *
	 */
	public function getMansongList($condition, $page=null, $order='', $field='*', $limit = 0) {
        $mansong_list = $this->field($field)->where($condition)->limit($limit)->page($page)->order($order)->select();
        if(!empty($mansong_list)) {
            for($i =0, $j = count($mansong_list); $i < $j; $i++) {
                $mansong_list[$i] = $this->getMansongExtendInfo($mansong_list[$i]);
            }
        }
        return $mansong_list;
	}

    /**
     * 获取店铺新满即送活动开始时间限制
     *
     */
    public function getMansongNewStartTime($store_id) {
        if(empty($store_id)) {
            return null;
        }
        $condition = array();
        $condition['store_id'] = $store_id;
        $condition['state'] = self::MANSONG_STATE_NORMAL;
        $mansong_list = $this->getMansongList($condition, null, 'end_time desc');
        return $mansong_list[0]['end_time'];
    }

    /**
	 * 根据条件读满即送信息
	 * @param array $condition 查询条件
     * @return array 限时折扣信息
	 *
	 */
    public function getMansongInfo($condition) {
        $mansong_info = $this->where($condition)->find();
        $mansong_info = $this->getMansongExtendInfo($mansong_info);
        return $mansong_info;
    }

    /**
	 * 根据满即送编号读取信息
	 * @param array $mansong_id 限制折扣活动编号
	 * @param int $store_id 如果提供店铺编号，判断是否为该店铺活动，如果不是返回null
     * @return array 限时折扣信息
	 *
	 */
    public function getMansongInfoByID($mansong_id, $store_id = 0) {
        if(intval($mansong_id) <= 0) {
            return null;
        }

        $condition = array();
        $condition['mansong_id'] = $mansong_id;
        $mansong_info = $this->getMansongInfo($condition);
        if($store_id > 0 && $mansong_info['store_id'] != $store_id) {
            return null;
        } else {
            return $mansong_info;
        }
    }

    /**
	 * 获取店铺当前可用满即送活动
	 * @param array $store_id 店铺编号 
     * @return array 满即送活动
	 *
	 */
    public function getMansongInfoByStoreID($store_id) {
        if(intval($store_id) <= 0) {
            return array();
        }
        // $info = $this->_rGoodsMansongCache($store_id);
        if (empty($info)) {
            $condition = array();
            $condition['state'] = self::MANSONG_STATE_NORMAL;
            $condition['store_id'] = $store_id;
            $condition['end_time'] = array('gt', TIMESTAMP);
            $mansong_list = $this->getMansongList($condition, null, 'start_time asc', '*', 1);

            $mansong_info = $mansong_list[0];
    
            if(!empty($mansong_info)) {
                $model_mansong_rule = Model('p_mansong_rule');
                $mansong_info['rules'] = $model_mansong_rule->getMansongRuleListByID($mansong_info['mansong_id']);
                if (empty($mansong_info['rules'])) {
                    $mansong_info = array(); // 如果不存在规则直接返回不记录缓存。
                } else {
                    // 规则数组序列化保存
                    $mansong_info['rules'] = serialize($mansong_info['rules']);
                }
            }
            $info['info'] = serialize($mansong_info);
            $this->_wGoodsMansongCache($store_id, $info);
        }
        $mansong_info = unserialize($info['info']);
        if (!empty($mansong_info) && $mansong_info['start_time'] > TIMESTAMP) {
            $mansong_info = array();
        }
        if (!empty($mansong_info)) {
            $mansong_info['rules'] = unserialize($mansong_info['rules']);
        }
        return $mansong_info;
    }

    /**
	 * 获取订单可用满即送规则
	 * @param array $store_id 店铺编号 
	 * @param array $order_price 订单金额
     * @return array 满即送规则
	 *
	 */
    public function getMansongRuleByStoreID($store_id, $order_price) {
        $mansong_info = $this->getMansongInfoByStoreID($store_id);

        if(empty($mansong_info)) {
            return null;
        }

        $rule_info = null;

        foreach ($mansong_info['rules'] as $value) {
            if($order_price >= $value['price']) {
                $rule_info = $value;
                $rule_info['mansong_name'] = $mansong_info['mansong_name'];
                $rule_info['start_time'] = $mansong_info['start_time'];
                $rule_info['end_time'] = $mansong_info['end_time'];
                // add xin 满送新规则
                if($mansong_info['mansong_type'] == 2){ //每满赠送
                    $rule_info['zeng_count'] = intval($order_price / $value['price']);
                }
                $rule_info['mansong_type'] = $mansong_info['mansong_type'];//add xin 20160112 增加满送规则
                break;
            }
        }

        return $rule_info;
    }

    /**
     * 获取满即送状态列表
     *
     */
    public function getMansongStateArray() {
        return $this->mansong_state_array;
    }

    /**
     * 获取满即送扩展信息，包括状态文字和是否可编辑状态
     * @param array $mansong_info
     * @return string
     *
     */
    public function getMansongExtendInfo($mansong_info) {
        if($mansong_info['end_time'] > TIMESTAMP) {
            $mansong_info['mansong_state_text'] = $this->mansong_state_array[$mansong_info['state']];
        } else {
            $mansong_info['mansong_state_text'] = '已结束';
        }

        if($mansong_info['state'] == self::MANSONG_STATE_NORMAL && $mansong_info['end_time'] > TIMESTAMP) {
            $mansong_info['editable'] = true;
        } else {
            $mansong_info['editable'] = false;
        }

        return $mansong_info;
    }

    /**
     * 增加 
     * @param array $param
     * @return bool
     *
     */
    public function addMansong($param){
        $param['state'] = self::MANSONG_STATE_NORMAL;
        $result = $this->insert($param);
        if ($result) {
            $this->_dGoodsMansongCache($param['store_id']);
        }
        return $result;
    }

    /**
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     *
     */
    public function editMansong($update, $condition){
        $mansong_list = $this->getMansongList($condition);
        if (empty($mansong_list)) {
            return true;
        }
        $result = $this->where($condition)->update($update);
        if ($result) {
            foreach ($mansong_list as $val) {
                $this->_dGoodsMansongCache($val['store_id']);
            }
        }
        return $result;
    }

    /**
     * 删除限时折扣活动，同时删除限时折扣商品
     * @param array $condition
     * @return bool
     *
     */
    public function delMansong($condition){
        $mansong_list = $this->getMansongList($condition);
        $mansong_id_string = '';
        if(!empty($mansong_list)) {
            foreach ($mansong_list as $value) {
                $mansong_id_string .= $value['mansong_id'] . ',';
                $this->_dGoodsMansongCache($value['store_id']);
            }
        }

        //删除满送规则
        $model_mansong_rule = Model('p_mansong_rule');
        $model_mansong_rule->delMansongRule($condition);

        return $this->where($condition)->delete();
    }


    /*
     * add 商品是否参与满送 规则判定 xin 20151110
     */
    public function canMansongInfo($goods_id,$store_id){
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id);
        $mansong_info = ($goods_info['is_virtual'] == 1) ? array() : Model('p_mansong')->getMansongInfoByStoreID($store_id);
        if(empty($mansong_info)){
            return $mansong_info;
        }

        /*
         * cate_rule值 1:全部商品参加，排除不参加商品
         *             2:按照店铺分类刷选参加商品，排除不参加上 分类 store_cates
         *             3:只有可用商品参加，商品都为 diff_goods
        */
        $goods_stcids = $goods_info['goods_stcids'];//商品所属店铺分类
        $ms_store_cates_arr = explode(",",$mansong_info['store_cates']);
        $ms_diff_goods_arr = explode(",",$mansong_info['diff_goods']);

        if($mansong_info['cate_rule'] == 1){
            if(in_array($goods_id,$ms_diff_goods_arr)){
                $mansong_info = array();//清空满送规则
            }
        }elseif($mansong_info['cate_rule'] == 2){
            if(in_array($goods_id,$ms_diff_goods_arr)){
                $mansong_info = array();//清空满送规则
            }else{
                $can_use_mansong = false;//再此规则中默认满送设置不可用
                if($ms_store_cates_arr[0] != ''){ //分类不为空
                    foreach($ms_store_cates_arr as $cate_ids){
                        $cate_ids_str = ','.$cate_ids.',';
                        if(strpos($goods_stcids,$cate_ids_str) !== false){
                            $can_use_mansong = true;
                            break;
                        }
                    }
                }
                if(!$can_use_mansong){
                    $mansong_info = array();//清空满送规则
                }
            }
        }elseif($mansong_info['cate_rule'] == 3){
            if(!in_array($goods_id,$ms_diff_goods_arr)){
                $mansong_info = array();//清空满送规则
            }
        }
        return $mansong_info;
    }

    /**
     * 取消满即送活动
     * @param array $condition
     * @return bool
     *
     */
    public function cancelMansong($condition){
        $update = array();
        $update['state'] = self::MANSONG_STATE_CANCEL;
        return $this->editMansong($update, $condition);
    }


    /**
     * 过期满送修改状态
     */
    public function editExpireMansong() {
        $updata = array();
        $update['state'] = self::MANSONG_STATE_CLOSE;

        $condition = array();
        $condition['end_time'] = array('lt', TIMESTAMP);
        $condition['state'] = self::MANSONG_STATE_NORMAL;
        $this->editMansong($update, $condition);
    }
    
    /**
     * 读取商品满即送缓存
     * @param int $store_id
     * @return array
     */
    private function _rGoodsMansongCache($store_id) {
        return rcache($store_id, 'goods_mansong');
    }
    
    /**
     * 写入商品满即送缓存
     * @param int $store_id
     * @param array $mansong_info
     * @return boolean
     */
    private function _wGoodsMansongCache($store_id, $mansong_info) {
        return wcache($store_id, $mansong_info, 'goods_mansong');
    }
    
    /**
     * 删除商品满即送缓存
     * @param int $store_id
     * @return boolean
     */
    private function _dGoodsMansongCache($store_id) {
        return dcache($store_id, 'goods_mansong');
    }
}
