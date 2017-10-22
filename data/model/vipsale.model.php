<?php
/**
 * 会员特价活动模型
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class vipsaleModel extends Model{

    const VIPSALE_STATE_REVIEW = 10;
    const VIPSALE_STATE_NORMAL = 20;
    const VIPSALE_STATE_REVIEW_FAIL = 30;
    const VIPSALE_STATE_CANCEL = 31;
    const VIPSALE_STATE_CLOSE = 32;

    private $vipsale_state_array = array(
        0 => '全部',
        self::VIPSALE_STATE_REVIEW => '审核中',
        self::VIPSALE_STATE_NORMAL => '正常',
        self::VIPSALE_STATE_CLOSE => '已结束',
        self::VIPSALE_STATE_REVIEW_FAIL => '审核失败',
        self::VIPSALE_STATE_CANCEL => '管理员关闭',
    );

    public function __construct() {
        parent::__construct('vipsale');
    }

	/**
     * 读取会员特价列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 会员特价列表
	 *
	 */
	public function getVipsaleList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        return $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
	}

	/**
     * 读取会员特价列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 会员特价列表
	 *
	 */
	public function getVipsaleExtendList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        $vipsale_list = $this->getVipsaleList($condition, $page, $order, $field, $limit);
        if(!empty($vipsale_list)) {
            for($i =0, $j = count($vipsale_list); $i < $j; $i++) {
                $vipsale_list[$i] = $this->getVipsaleExtendInfo($vipsale_list[$i]);
            }
        }
        return $vipsale_list;
	}

    /**
     * 读取可用会员特价列表
     */
    public function getVipsaleAvailableList($condition) {
        $condition['state'] = array('in', array(self::VIPSALE_STATE_REVIEW, self::VIPSALE_STATE_NORMAL));
        return $this->getVipsaleExtendList($condition);
    }

	/**
	 * 查询会员特价数量
	 * @param array $condition
	 * @return int
	 */
	public function getVipsaleCount($condition) {
	    return $this->where($condition)->count();
	}

    /**
     * 读取当前可用的会员特价列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 会员特价列表
     *
     */
    public function getVipsaleOnlineList($condition, $page = null, $order = 'state asc', $field = '*') {
        $condition['state'] = self::VIPSALE_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getVipsaleExtendList($condition, $page, $order, $field);
    }


    /**
     * 根据条件读取会员特价信息
     * @param array $condition 查询条件
     * @return array 会员特价信息
     *
	 */
    public function getVipsaleInfo($condition) {
        $vipsale_info = $this->where($condition)->find();
        if (empty($vipsale_info)) return array();
        $vipsale_info = $this->getVipsaleExtendInfo($vipsale_info);
        return $vipsale_info;
    }


    /**
	 * 根据会员特价编号读取会员特价信息
	 * @param array $vipsale_id 会员特价活动编号
	 * @param int $store_id 如果提供店铺编号，判断是否为该店铺活动，如果不是返回null
     * @return array 会员特价信息
	 *
	 */
    public function getVipsaleInfoByID($vipsale_id, $store_id = 0) {
        if(intval($vipsale_id) <= 0) {
            return null;
        }

        $condition = array();
        $condition['vipsale_id'] = $vipsale_id;
        $vipsale_info = $this->getVipsaleInfo($condition);

        if($store_id > 0 && $vipsale_info['store_id'] != $store_id) {
            return null;
        } else {
            return $vipsale_info;
        }
    }

    /**
     * 根据商品编号查询是否有可用会员特价活动，如果有返回会员特价信息，没有返回null
     * @param int $goods_id
     * @return array $vipsale_info
     *
     */
    public function getVipsaleInfoByGoodsID($goods_id) {
        $info = $this->_rGoodsVipsaleCache($goods_id);

        if (empty($info)) {
            $condition = array();
            $condition['state'] = self::VIPSALE_STATE_NORMAL;
            $condition['start_time'] = array('lt', TIMESTAMP);
            $condition['end_time'] = array('gt', TIMESTAMP);
            $condition['goods_id'] = $goods_id;
            $vipsale_goods_list = $this->getVipsaleExtendList($condition, null, 'start_time asc', '*', 1);
            $info['info'] = serialize($vipsale_goods_list[0]);
            $this->_wGoodsVipsaleCache($goods_id, $info);
        }
        $vipsale_goods_info = unserialize($info['info']);

        if (!empty($vipsale_goods_info) && ($vipsale_goods_info['start_time'] > TIMESTAMP || $vipsale_goods_info['end_time'] < TIMESTAMP)) {
            $vipsale_goods_info = array();
        }
        return $vipsale_goods_info;
    }

    /**
     * 读取推荐抢购列表
     * @param int $limit 要读取的数量
     */
    public function getVipsaleCommendedList($limit = 4) {
        $condition = array();
        $condition['state'] = self::VIPSALE_STATE_NORMAL;
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getVipsaleExtendList($condition, null, 'start_time asc,vipsale_id asc', '*', $limit);
    }


    /**
     * 会员特价状态数组
     */
    public function getVipsaleStateArray() {
        return $this->vipsale_state_array;
    }


	/*
	 * 增加
	 * @param array $param
	 * @return bool
     *
	 */
    public function addVipsale($param){

        $param['state'] = self::VIPSALE_STATE_REVIEW;
        $result = $this->insert($param);
        if ($result) {
            //add 发布抢购锁定商品SKU及商品  xin 20151106
            Model('goods')->editGoodsSkuLock($param['goods_id']);
            //add end
            // 更新商品会员特价缓存
            $this->_dGoodsVipsaleCache($param['goods_id']);
            return $result;
        } else {
            return false;
        }
    }


    /**
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     *
     */
    public function editVipsale($update, $condition) {
        $vipsale_list = $this->getVipsaleList($condition, null, '', 'goods_id');
        $result = $this->where($condition)->update($update);
        if ($result) {
            if (!empty($vipsale_list)) {
                foreach ($vipsale_list as $val) {
                    // 更新商品会员特价缓存
                    $this->_dGoodsVipsaleCache($val['goods_id']);
                }
            }
        }
        return $result;
    }

    /**
     * 更新会员特价产品信息
     * @param unknown $data
     * @param unknown $condition
     */
    public function updateVipsaleGoods($data = array(), $condition = array()) {
        // 删除缓存
        //$this->dropCache();
        return $this->where($condition)->update($data);
    }

    /*
	 * 审核成功
	 * @param int $vipsale_id
	 * @return bool
     *
	 */
    public function reviewPassVipsale($vipsale_id) {
        $condition = array();
        $condition['vipsale_id'] = $vipsale_id;

        $update = array();
        $update['state'] = self::VIPSALE_STATE_NORMAL;

        return $this->editVipsale($update, $condition);
    }

    /*
	 * 审核失败
	 * @param int $vipsale_id
	 * @return bool
     *
	 */
    public function reviewFailVipsale($vipsale_id) {
        // 商品解锁
        $vipsale_info = $this->getVipsaleInfoByID($vipsale_id);

        $condition = array();
        $condition['vipsale_id'] = $vipsale_id;

        $update = array();
        $update['state'] = self::VIPSALE_STATE_REVIEW_FAIL;

        $return =  $this->editVipsale($update, $condition);
        if ($return) {
            $this->unLockVipsale($vipsale_id);
        }
        return $return;
    }

    /*
     * 取消
     * @param int $vipsale_id
     * @return bool
     *
     */
    public function cancelVipsale($vipsale_id) {
        // 商品解锁
        $vipsale_info = $this->getVipsaleInfoByID($vipsale_id);

        $condition = array();
        $condition['vipsale_id'] = $vipsale_id;

        $update = array();
        $update['state'] = self::VIPSALE_STATE_CLOSE;

        $return = $this->editVipsale($update, $condition);
        if ($return) {
            $this->unLockVipsale($vipsale_id);
        }
        return $return;
    }

    /*
     * 解锁商品
     * @param int $vipsale_id
     * @return bool
     *
     */
    public function unLockVipsale($vipsale_id) {
        // 商品解锁
        $vipsale_info = $this->getVipsaleInfoByID($vipsale_id);
        Model('goods')->editGoodsSkuUnlock($vipsale_info['goods_id']);

        return true;
    }

    /*
     * 锁定商品
     * @param int $vipsale_id
     * @return bool
     *
     */
     public function LockVipsale($vipsale_id) {
        // 商品解锁
        $vipsale_info = $this->getVipsaleInfoByID($vipsale_id);
        Model('goods')->editGoodsSkuLock($vipsale_info['goods_id']);
        return true;
    }
	/*
	 * 删除会员特价活动
	 * @param array $condition
	 * @return bool
     *
	 */
    public function delVipsale($condition){
        $vipsale_list = $this->getVipsaleExtendList($condition);
        $result = $this->where($condition)->delete();

        if(!empty($vipsale_list) && $result) {
            foreach ($vipsale_list as $value) {
                // 商品解锁
                $this->unLockVipsale($value['vipsale_id']);

                // 更新商品会员特价缓存
                $this->_dGoodsVipsaleCache($value['goods_id']);

                list($base_name, $ext) = explode('.', $value['vipsale_image']);
                list($store_id) = explode('_', $base_name);
                $path = BASE_UPLOAD_PATH.DS.ATTACH_VIPSALE.DS.$store_id.DS;
                @unlink($path.$base_name.'.'.$ext);
                @unlink($path.$base_name.'_small.'.$ext);
                @unlink($path.$base_name.'_mid.'.$ext);
                @unlink($path.$base_name.'_max.'.$ext);

                if(!empty($value['vipsale_image1'])) {
                    list($base_name, $ext) = explode('.', $value['vipsale_image1']);
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
     * 获取会员特价扩展信息
     */
    public function getVipsaleExtendInfo($vipsale_info) {
        $goods_info = Model('goods')->getGoodsInfoByID($vipsale_info['goods_id']);
        $vipsale_info['goods_image'] = thumb($goods_info, 240);
        $vipsale_info['goods_url'] = urlShop('goods', 'index', array('goods_id' => $vipsale_info['goods_id']));
        $vipsale_info['start_time_text'] = date('Y-m-d H:i', $vipsale_info['start_time']);
        $vipsale_info['end_time_text'] = date('Y-m-d H:i', $vipsale_info['end_time']);
        if(empty($vipsale_info['vipsale_image1'])) {
            $vipsale_info['vipsale_image1'] = $vipsale_info['vipsale_image'];
        }
        if($vipsale_info['start_time'] > TIMESTAMP && $vipsale_info['state'] == self::VIPSALE_STATE_NORMAL) {
            $vipsale_info['vipsale_state_text'] = '正常(未开始)';
        } elseif ($vipsale_info['end_time'] < TIMESTAMP && $vipsale_info['state'] == self::VIPSALE_STATE_NORMAL) {
            $vipsale_info['vipsale_state_text'] = '已结束(未解锁)';
        } else {
            $vipsale_info['vipsale_state_text'] = $this->vipsale_state_array[$vipsale_info['state']];
        }

        switch ($vipsale_info['state']) {
            case self::VIPSALE_STATE_REVIEW:
                $vipsale_info['state_flag'] = 'not-verify';
                $vipsale_info['button_text'] = '未审核';
                break;
            case self::VIPSALE_STATE_REVIEW_FAIL:
            case self::VIPSALE_STATE_CANCEL:
            case self::VIPSALE_STATE_CLOSE:
                $vipsale_info['state_flag'] = 'close';
                $vipsale_info['button_text'] = '已结束';
                break;
            case self::VIPSALE_STATE_NORMAL:
                if($vipsale_info['start_time'] > TIMESTAMP) {
                    $vipsale_info['state_flag'] = 'not-start';
                    $vipsale_info['button_text'] = '未开始';
                    $vipsale_info['count_down_text'] = '距会员特价开始';
                    $vipsale_info['count_down'] = $vipsale_info['start_time'] - TIMESTAMP;
                } elseif ($vipsale_info['end_time'] < TIMESTAMP) {
                    $vipsale_info['state_flag'] = 'close';
                    $vipsale_info['button_text'] = '已结束';
                } else {
                    $vipsale_info['state_flag'] = 'buy-now';
                    $vipsale_info['button_text'] = '我要抢';
                    $vipsale_info['count_down_text'] = '距会员特价结束';
                    $vipsale_info['count_down'] = $vipsale_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $vipsale_info;
    }

    /**
     * 读取商品会员特价缓存
     * @param int $goods_id
     * @return array/bool
     */
    private function _rGoodsVipsaleCache($goods_id) {
        return rcache($goods_id, 'goods_vipsale');
    }

    /**
     * 写入商品会员特价缓存
     * @param int $goods_id
     * @param array $info
     * @return boolean
     */
    private function _wGoodsVipsaleCache($goods_id, $info) {
        return wcache($goods_id, $info, 'goods_vipsale');
    }

    /**
     * 删除商品会员特价缓存
     * @param int $goods_id
     * @return boolean
     */
    private function _dGoodsVipsaleCache($goods_id) {
        return dcache($goods_id, 'goods_vipsale');
    }

    /**
     * 读取会员特价分类
     *
     * @return array
     */
    public function getVipsaleClasses()
    {
        return $this->getCachedData('vipsale_classes');
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
        case 'vipsale_classes': // 会员特价分类
            $classes = Model()->table('vipsale_class')->order('sort asc')->limit(false)->select();
            foreach ((array) $classes as $v) {
                $id = $v['class_id'];
                $pid = $v['class_parent_id'];
                $data['name'][$id] = $v['class_name'];
                $data['parent'][$id] = $pid;
                $data['children'][$pid][] = $id;
            }
            break;
        default:
            throw new Exception("Invalid data key: {$key}");
        }

        return $data;
    }

    /**
     * 缓存数据（会员特价分类、虚拟会员特价分类、虚拟会员特价地区）
     * 数组键为缓存名称 值为缓存数据
     *
     * 例 会员特价分类缓存数据格式如下
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
