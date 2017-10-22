<?php
/**
 * 抢购活动模型
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class paimaiModel extends Model{

    const PAIMAI_STATE_REVIEW = 10;
    const PAIMAI_STATE_NORMAL = 20;
    const PAIMAI_STATE_REVIEW_FAIL = 30;
    const PAIMAI_STATE_CANCEL = 31;
    const PAIMAI_STATE_CLOSE = 32;

    private $paimai_state_array = array(
        0 => '全部',
        self::PAIMAI_STATE_REVIEW => '审核中',
        self::PAIMAI_STATE_NORMAL => '正常',
        self::PAIMAI_STATE_CLOSE => '已结束',
        self::PAIMAI_STATE_REVIEW_FAIL => '审核失败',
        self::PAIMAI_STATE_CANCEL => '管理员关闭',
    );

    public function __construct() {
        parent::__construct('paimai');
    }

	/**
     * 读取抢购列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 抢购列表
	 *
	 */
	public function getPaimaiList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        return $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
	}

	/**
     * 读取抢购列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 抢购列表
	 *
	 */
	public function getPaimaiExtendList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        $paimai_list = $this->getPaimaiList($condition, $page, $order, $field, $limit);
        if(!empty($paimai_list)) {
            for($i =0, $j = count($paimai_list); $i < $j; $i++) {
                $paimai_list[$i] = $this->getPaimaiExtendInfo($paimai_list[$i]);
            }
        }
        return $paimai_list;
	}

    /**
     * 读取可用抢购列表
     */
    public function getPaimaiAvailableList($condition) {
        $condition['state'] = array('in', array(self::PAIMAI_STATE_REVIEW, self::PAIMAI_STATE_NORMAL));
        return $this->getPaimaiExtendList($condition);
    }

	/**
	 * 查询抢购数量
	 * @param array $condition
	 * @return int
	 */
	public function getPaimaiCount($condition) {
	    return $this->where($condition)->count();
	}

    /**
     * 读取当前可用的抢购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getPaimaiOnlineList($condition, $page = null, $order = 'state asc', $field = '*') {
        $condition['state'] = self::PAIMAI_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getPaimaiExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取即将开始的抢购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getPaimaiSoonList($condition, $page = null, $order = 'state asc', $field = '*') {
        $condition['state'] = self::PAIMAI_STATE_NORMAL;
        $condition['start_time'] = array('gt', TIMESTAMP);
        return $this->getPaimaiExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取已经结束的抢购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getPaimaiHistoryList($condition, $page = null, $order = 'state asc', $field = '*') {
        $condition['state'] = self::PAIMAI_STATE_CLOSE;
        return $this->getPaimaiExtendList($condition, $page, $order, $field);
    }

    /**
     * 读取推荐抢购列表
     * @param int $limit 要读取的数量
     */
    public function getPaimaiCommendedList($limit = 4) {
        $condition = array();
        $condition['state'] = self::PAIMAI_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getPaimaiExtendList($condition, null, 'recommended desc', '*', $limit);
    }

    /**
     * 根据条件读取抢购信息
     * @param array $condition 查询条件
     * @return array 抢购信息
     *
	 */
    public function getPaimaiInfo($condition) {
        $paimai_info = $this->where($condition)->find();
        if (empty($paimai_info)) return array();
        $paimai_info = $this->getPaimaiExtendInfo($paimai_info);
        return $paimai_info;
    }

    /**
     * 根据条件读取抢购信息
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getPaimaiOnlineInfo($condition) {
        $condition['state'] = self::PAIMAI_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $paimai_info = $this->where($condition)->find();
        return $paimai_info;
    }

    /**
	 * 根据抢购编号读取抢购信息
	 * @param array $paimai_id 抢购活动编号
	 * @param int $store_id 如果提供店铺编号，判断是否为该店铺活动，如果不是返回null
     * @return array 抢购信息
	 *
	 */
    public function getPaimaiInfoByID($paimai_id, $store_id = 0) {
        if(intval($paimai_id) <= 0) {
            return null;
        }

        $condition = array();
        $condition['paimai_id'] = $paimai_id;
        $paimai_info = $this->getPaimaiInfo($condition);

        if($store_id > 0 && $paimai_info['store_id'] != $store_id) {
            return null;
        } else {
            return $paimai_info;
        }
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购信息，没有返回null
     * @param int $goods_id
     * @return array $paimai_info
     *
     */
    public function getPaimaiInfoByGoodsCommonID($goods_commonid) {
        $info = $this->_rGoodsPaimaiCache($goods_commonid);
        if (empty($info)) {
            $condition = array();
            $condition['state'] = self::PAIMAI_STATE_NORMAL;
            $condition['end_time'] = array('gt', TIMESTAMP);
            $condition['goods_commonid'] = $goods_commonid;
            $paimai_goods_list = $this->getPaimaiExtendList($condition, null, 'start_time asc', '*', 1);
            $info['info'] = serialize($paimai_goods_list[0]);
            $this->_wGoodsPaimaiCache($goods_commonid, $info);
        }
        $paimai_goods_info = unserialize($info['info']);
        if (!empty($paimai_goods_info) && ($paimai_goods_info['start_time'] > TIMESTAMP || $paimai_goods_info['end_time'] < TIMESTAMP)) {
            $paimai_goods_info = array();
        }
        return $paimai_goods_info;
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @param string $goods_string 商品编号字符串，例：'1,22,33'
     * @return array $paimai_list
     *
     */
    public function getPaimaiListByGoodsCommonIDString($goods_commonid_string) {
        $paimai_list = $this->_getPaimaiListByGoodsCommon($goods_commonid_string);
        $paimai_list = array_under_reset($paimai_list, 'goods_commonid');
        return $paimai_list;
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @param string $goods_id_string
     * @return array $paimai_list
     *
     */
    private function _getPaimaiListByGoodsCommon($goods_commonid_string) {
        $condition = array();
        $condition['state'] = self::PAIMAI_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_commonid'] = array('in', $goods_commonid_string);
        $xianshi_goods_list = $this->getPaimaiExtendList($condition, null, 'paimai_id desc', '*');
        return $xianshi_goods_list;
    }

    /**
     * 抢购状态数组
     */
    public function getPaimaiStateArray() {
        return $this->paimai_state_array;
    }


	/*
	 * 增加
	 * @param array $param
	 * @return bool
     *
	 */
    public function addPaimai($param){
        // 发布抢购锁定商品
        $this->_lockGoods($param['goods_commonid']);

        $param['state'] = self::PAIMAI_STATE_REVIEW;
        $param['recommended'] = 0;
        $result = $this->insert($param);
        if ($result) {
            // 更新商品拍卖缓存
            $this->_dGoodsPaimaiCache($param['goods_commonid']);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 锁定商品
     */
    private function _lockGoods($goods_commonid) {
        $condition = array();
        $condition['goods_commonid'] = $goods_commonid;

        $model_goods = Model('goods');
        $model_goods->editGoodsCommonLock($condition);
    }

    /**
     * 解锁商品
     */
    private function _unlockGoods($goods_commonid) {
        $model_goods = Model('goods');
        $model_goods->editGoodsCommonUnlock(array('goods_commonid' => $goods_commonid));
        // 添加对列 更新商品促销价格
        QueueClient::push('updateGoodsPromotionPriceByGoodsCommonId', $goods_commonid);
    }

    /**
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     *
     */
    public function editPaimai($update, $condition) {
        $paimai_list = $this->getPaimaiList($condition, null, '', 'goods_commonid');
        $result = $this->where($condition)->update($update);
        if ($result) {
            if (!empty($paimai_list)) {
                foreach ($paimai_list as $val) {
                    // 更新商品抢购缓存
                    $this->_dGoodsPaimaiCache($val['goods_commonid']);
                }
            }
        }
        return $result;
    }

    /*
	 * 审核成功
	 * @param int $paimai_id
	 * @return bool
     *
	 */
    public function reviewPassPaimai($paimai_id) {
        $condition = array();
        $condition['paimai_id'] = $paimai_id;

        $update = array();
        $update['state'] = self::PAIMAI_STATE_NORMAL;

        return $this->editPaimai($update, $condition);
    }

    /*
	 * 审核失败
	 * @param int $paimai_id
	 * @return bool
     *
	 */
    public function reviewFailPaimai($paimai_id) {
        // 商品解锁
        $paimai_info = $this->getPaimaiInfoByID($paimai_id);

        $condition = array();
        $condition['paimai_id'] = $paimai_id;

        $update = array();
        $update['state'] = self::PAIMAI_STATE_REVIEW_FAIL;

        $return =  $this->editPaimai($update, $condition);
        if ($return) {
            $this->_unlockGoods($paimai_info['goods_commonid']);
        }
        return $return;
    }

    /*
     * 取消
     * @param int $paimai_id
     * @return bool
     *
     */
    public function cancelPaimai($paimai_id) {
        // 商品解锁
        $paimai_info = $this->getPaimaiInfoByID($paimai_id);

        $condition = array();
        $condition['paimai_id'] = $paimai_id;

        $update = array();
        $update['state'] = self::PAIMAI_STATE_CANCEL;

        $return = $this->editPaimai($update, $condition);
        if ($return) {
            $this->_unlockGoods($paimai_info['goods_commonid']);
        }
        return $return;
    }

    /**
     * 过期抢购修改状态，解锁对应商品
     */
    public function editExpirePaimai($condition) {
        $condition['end_time'] = array('lt', TIMESTAMP);
        $condition['state'] = array('in', array(self::PAIMAI_STATE_REVIEW, self::PAIMAI_STATE_NORMAL));

        $expire_paimai_list = $this->getPaimaiExtendList($condition, null);
        if (!empty($expire_paimai_list)) {
            $goodscommonid_array = array();
            foreach ($expire_paimai_list as $val) {
                $goodscommonid_array[] = $val['goods_commonid'];
            }
            // 更新商品促销价格，需要考虑抢购是否在进行中
            QueueClient::push('updateGoodsPromotionPriceByGoodsCommonId', $goodscommonid_array);
        }
        $paimai_id_string = '';
        if(!empty($expire_paimai_list)) {
            foreach ($expire_paimai_list as $value) {
                $paimai_id_string .= $value['paimai_id'].',';
            }
        }

        if($paimai_id_string != '') {
            $update = array();
            $update['state'] = self::PAIMAI_STATE_CLOSE;
            $condition = array();
            $condition['paimai_id'] = array('in', rtrim($paimai_id_string, ','));
            $result = $this->editPaimai($update, $condition);
            if ($result) {
                foreach ($expire_paimai_list as $value) {
                    $this->_unlockGoods($value['goods_commonid']);
                }
            }
        }
        return true;
    }

	/*
	 * 删除抢购活动
	 * @param array $condition
	 * @return bool
     *
	 */
    public function delPaimai($condition){
        $paimai_list = $this->getPaimaiExtendList($condition);
        $result = $this->where($condition)->delete();

        if(!empty($paimai_list) && $result) {
            foreach ($paimai_list as $value) {
                // 商品解锁
                $this->_unlockGoods($value['goods_commonid']);
                // 更新商品抢购缓存
                $this->_dGoodsPaimaiCache($value['goods_commonid']);

                list($base_name, $ext) = explode('.', $value['paimai_image']);
                list($store_id) = explode('_', $base_name);
                $path = BASE_UPLOAD_PATH.DS.ATTACH_GROUPBUY.DS.$store_id.DS;
                @unlink($path.$base_name.'.'.$ext);
                @unlink($path.$base_name.'_small.'.$ext);
                @unlink($path.$base_name.'_mid.'.$ext);
                @unlink($path.$base_name.'_max.'.$ext);

                if(!empty($value['paimai_image1'])) {
                    list($base_name, $ext) = explode('.', $value['paimai_image1']);
                    @unlink($path.$base_name.'.'.$ext);
                    @unlink($path.$base_name.'_small.'.$ext);
                    @unlink($path.$base_name.'_mid.'.$ext);
                    @unlink($path.$base_name.'_max.'.$ext);
                }
            }
        }
        return true;
    }

    /**
     * 获取抢购扩展信息
     */
    public function getPaimaiExtendInfo($paimai_info) {
        $paimai_info['paimai_url'] = urlShop('show_paimai', 'paimai_detail', array('group_id' => $paimai_info['paimai_id']));
        $paimai_info['goods_url'] = urlShop('goods', 'index', array('goods_id' => $paimai_info['goods_id']));
        $paimai_info['start_time_text'] = date('Y-m-d H:i', $paimai_info['start_time']);
        $paimai_info['end_time_text'] = date('Y-m-d H:i', $paimai_info['end_time']);
        if(empty($paimai_info['paimai_image1'])) {
            $paimai_info['paimai_image1'] = $paimai_info['paimai_image'];
        }
        if($paimai_info['start_time'] > TIMESTAMP && $paimai_info['state'] == self::PAIMAI_STATE_NORMAL) {
            $paimai_info['paimai_state_text'] = '正常(未开始)';
        } elseif ($paimai_info['end_time'] < TIMESTAMP && $paimai_info['state'] == self::PAIMAI_STATE_NORMAL) {
            $paimai_info['paimai_state_text'] = '已结束';
        } else {
            $paimai_info['paimai_state_text'] = $this->paimai_state_array[$paimai_info['state']];
        }

        if($paimai_info['state'] == self::PAIMAI_STATE_REVIEW) {
            $paimai_info['reviewable'] = 1;
        } else {
            $paimai_info['reviewable'] = 0;
        }

        if($paimai_info['state'] == self::PAIMAI_STATE_NORMAL) {
            $paimai_info['cancelable'] = 1;
        } else {
            $paimai_info['cancelable'] = 0;
        }

        switch ($paimai_info['state']) {
            case self::PAIMAI_STATE_REVIEW:
                $paimai_info['state_flag'] = 'not-verify';
                $paimai_info['button_text'] = '未审核';
                break;
            case self::PAIMAI_STATE_REVIEW_FAIL:
            case self::PAIMAI_STATE_CANCEL:
            case self::PAIMAI_STATE_CLOSE:
                $paimai_info['state_flag'] = 'close';
                $paimai_info['button_text'] = '已结束';
                break;
            case self::PAIMAI_STATE_NORMAL:
                if($paimai_info['start_time'] > TIMESTAMP) {
                    $paimai_info['state_flag'] = 'not-start';
                    $paimai_info['button_text'] = '未开始';
                    $paimai_info['count_down_text'] = '距抢购开始';
                    $paimai_info['count_down'] = $paimai_info['start_time'] - TIMESTAMP;
                } elseif ($paimai_info['end_time'] < TIMESTAMP) {
                    $paimai_info['state_flag'] = 'close';
                    $paimai_info['button_text'] = '已结束';
                } else {
                    $paimai_info['state_flag'] = 'buy-now';
                    $paimai_info['button_text'] = '我要抢';
                    $paimai_info['count_down_text'] = '距抢购结束';
                    $paimai_info['count_down'] = $paimai_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $paimai_info;
    }

    /**
     * 读取商品抢购缓存
     * @param int $goods_commonid
     * @return array/bool
     */
    private function _rGoodsPaimaiCache($goods_commonid) {
        return rcache($goods_commonid, 'goods_paimai');
    }

    /**
     * 写入商品抢购缓存
     * @param int $goods_commonid
     * @param array $info
     * @return boolean
     */
    private function _wGoodsPaimaiCache($goods_commonid, $info) {
        return wcache($goods_commonid, $info, 'goods_paimai');
    }

    /**
     * 删除商品抢购缓存
     * @param int $goods_commonid
     * @return boolean
     */
    private function _dGoodsPaimaiCache($goods_commonid) {
        return dcache($goods_commonid, 'goods_paimai');
    }

    /**
     * 读取抢购分类
     *
     * @return array
     */
    public function getPaimaiClasses()
    {
        return $this->getCachedData('paimai_classes');
    }

    /**
     * 读取虚拟抢购分类
     *
     * @return array
     */
    public function getPaimaiVrClasses()
    {
        return $this->getCachedData('paimai_vr_classes');
    }

    /**
     * 读取虚拟抢购地区
     *
     * @return array
     */
    public function getPaimaiVrCities()
    {
        return $this->getCachedData('paimai_vr_cities');
    }

    /**
     * 删除缓存
     *
     * @param string $key 缓存键
     */
    public function dropCachedData($key) {
        unset($this->cachedData[$key]);
        dkcache($key);
    }

    /**
     * 获取缓存
     *
     * @param string $key 缓存键
     * @return array 缓存数据
     */
    protected function getCachedData($key) {

        $data = $this->cachedData[$key];

        // 属性中存在则返回
        if ($data || is_array($data)) {
            return $data;
        }

        $data = rkcache($key);

        // 缓存中存在则返回
        if ($data || is_array($data)) {
            // 写入属性
            $this->cachedData[$key] = $data;
            return $data;
        }

        $data = $this->getCachingDataByQuery($key);

        // 写入缓存
        wkcache($key, $data);

        // 写入属性
        $this->cachedData[$key] = $data;

        return $data;
    }

    protected function getCachingDataByQuery($key) {
        $data = array();

        switch ($key) {
        case 'paimai_classes': // 抢购分类
            $classes = Model()->table('paimai_class')->order('sort asc')->limit(false)->select();
            foreach ((array) $classes as $v) {
                $id = $v['class_id'];
                $pid = $v['class_parent_id'];
                $data['name'][$id] = $v['class_name'];
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            break;

        case 'paimai_vr_classes': // 虚拟抢购分类
            $classes = Model()->table('vr_paimai_class')->order('class_sort asc')->limit(false)->select();
            foreach ((array) $classes as $v) {
                $id = $v['class_id'];
                $pid = $v['parent_class_id'];
                $data['name'][$id] = $v['class_name'];
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            break;

        case 'paimai_vr_cities': // 虚拟抢购地区
            // 一级地区 城市
            $arr = (array) Model()->table('vr_paimai_area')->where(array(
                'hot_city' => 1,
                'parent_area_id' => 0,
            ))->order('area_id asc')->limit(false)->key('area_id')->select();
            foreach ($arr as $v) {
                $id = $v['area_id'];
                $pid = $v['parent_area_id'];
                $data['name'][$id] = $v['area_name'];
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            if ($pids = array_keys($arr)) {
                // 二级地区 区域
                $arr = (array) Model()->table('vr_paimai_area')->where(array(
                    'parent_area_id' => array('in', $pids),
                ))->order('area_id asc')->limit(false)->key('area_id')->select();
                foreach ($arr as $v) {
                    $id = $v['area_id'];
                    $pid = $v['parent_area_id'];
                    $data['name'][$id] = $v['area_name'];
                    $data['parent'][$id] = $pid;
                    $data['children'][$pid][] = $id;
                }
                if ($pids = array_keys($arr)) {
                    // 三级地区 街区
                    $arr = (array) Model()->table('vr_paimai_area')->where(array(
                        'parent_area_id' => array('in', $pids),
                    ))->order('area_id asc')->limit(false)->key('area_id')->select();
                    $pids = array_keys($arr);
                    foreach ($arr as $v) {
                        $id = $v['area_id'];
                        $pid = $v['parent_area_id'];
                        $data['name'][$id] = $v['area_name'];
                        $data['parent'][$id] = $pid;
                        $data['children'][$pid][] = $id;
                    }
                }
            }
            break;

        default:
            throw new Exception("Invalid data key: {$key}");
        }

        return $data;
    }

    /**
     * 缓存数据（抢购分类、虚拟抢购分类、虚拟抢购地区）
     * 数组键为缓存名称 值为缓存数据
     *
     * 例 抢购分类缓存数据格式如下
     * array(
     *   'name' => array(
     *     '分类id' => '分类名称',
     *     // ..
     *   ),
     *   'parent' => array(
     *     '子分类id' => '父分类id',
     *     // ..
     *   ),
     *   'children' => array(
     *     '父分类id' => array(
     *       '子分类id 1',
     *       '子分类id 2',
     *       // ..
     *     ),
     *     // ..
     *   ),
     * )
     *
     * @return array
     */
    protected $cachedData;

}
