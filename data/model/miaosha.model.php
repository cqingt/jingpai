<?php
/**
 * 秒杀活动模型
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class miaoshaModel extends Model{

    const MIAOSHA_STATE_REVIEW = 10;
    const MIAOSHA_STATE_NORMAL = 20;
    const MIAOSHA_STATE_REVIEW_FAIL = 30;
    const MIAOSHA_STATE_CANCEL = 31;
    const MIAOSHA_STATE_CLOSE = 32;

    private $miaosha_state_array = array(
        0 => '全部',
        self::MIAOSHA_STATE_REVIEW => '审核中',
        self::MIAOSHA_STATE_NORMAL => '正常',
        self::MIAOSHA_STATE_CLOSE => '已结束',
        self::MIAOSHA_STATE_REVIEW_FAIL => '审核失败',
        self::MIAOSHA_STATE_CANCEL => '管理员关闭',
    );

    public function __construct() {
        parent::__construct('miaosha');
    }

	/**
     * 读取秒杀列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 秒杀列表
	 *
	 */
	public function getMiaoshaList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        return $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
	}

	/**
     * 读取秒杀列表
	 * @param array $condition 查询条件
	 * @param int $page 分页数
	 * @param string $order 排序
	 * @param string $field 所需字段
     * @return array 秒杀列表
	 *
	 */
	public function getMiaoshaExtendList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        $miaosha_list = $this->getMiaoshaList($condition, $page, $order, $field, $limit);
        if(!empty($miaosha_list)) {
            for($i =0, $j = count($miaosha_list); $i < $j; $i++) {
                $miaosha_list[$i] = $this->getMiaoshaExtendInfo($miaosha_list[$i]);
            }
        }
        return $miaosha_list;
	}

    /**
     * 读取可用秒杀列表
     */
    public function getMiaoshaAvailableList($condition) {
        $condition['state'] = array('in', array(self::MIAOSHA_STATE_REVIEW, self::MIAOSHA_STATE_NORMAL));
        return $this->getMiaoshaExtendList($condition);
    }

	/**
	 * 查询秒杀数量
	 * @param array $condition
	 * @return int
	 */
	public function getMiaoshaCount($condition) {
	    return $this->where($condition)->count();
	}

    /**
     * 读取当前可用的秒杀列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 秒杀列表
     *
     */
    public function getMiaoshaOnlineList($condition, $page = null, $order = 'state asc', $field = '*') {
        $condition['state'] = self::MIAOSHA_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        return $this->getMiaoshaExtendList($condition, $page, $order, $field);
    }


    /**
     * 根据条件读取秒杀信息
     * @param array $condition 查询条件
     * @return array 秒杀信息
     *
	 */
    public function getMiaoshaInfo($condition) {
        $miaosha_info = $this->where($condition)->find();
        if (empty($miaosha_info)) return array();
        $miaosha_info = $this->getMiaoshaExtendInfo($miaosha_info);
        return $miaosha_info;
    }


    /**
	 * 根据秒杀编号读取秒杀信息
	 * @param array $miaosha_id 秒杀活动编号
	 * @param int $store_id 如果提供店铺编号，判断是否为该店铺活动，如果不是返回null
     * @return array 秒杀信息
	 *
	 */
    public function getMiaoshaInfoByID($miaosha_id, $store_id = 0) {
        if(intval($miaosha_id) <= 0) {
            return null;
        }

        $condition = array();
        $condition['miaosha_id'] = $miaosha_id;
        $miaosha_info = $this->getMiaoshaInfo($condition);

        if($store_id > 0 && $miaosha_info['store_id'] != $store_id) {
            return null;
        } else {
            return $miaosha_info;
        }
    }

    /**
     * 根据商品编号查询是否有可用秒杀活动，如果有返回秒杀信息，没有返回null
     * @param int $goods_id
     * @return array $miaosha_info
     *
     */
    public function getMiaoshaInfoByGoodsID($goods_id) {
        //$info = $this->_rGoodsMiaoshaCache($goods_id); 隐藏缓存
        $info = array();
        if (empty($info)) {
            $condition = array();
            $condition['state'] = self::MIAOSHA_STATE_NORMAL;
            $condition['start_time'] = array('lt', TIMESTAMP);
            $condition['end_time'] = array('gt', TIMESTAMP);
            $condition['goods_id'] = $goods_id;
            $miaosha_goods_list = $this->getMiaoshaExtendList($condition, null, 'start_time asc', '*', 1);
            $info['info'] = serialize($miaosha_goods_list[0]);
            $this->_wGoodsMiaoshaCache($goods_id, $info);
        }
        $miaosha_goods_info = unserialize($info['info']);

        if (!empty($miaosha_goods_info) && ($miaosha_goods_info['start_time'] > TIMESTAMP || $miaosha_goods_info['end_time'] < TIMESTAMP)) {
            $miaosha_goods_info = array();
        }
        return $miaosha_goods_info;
    }

    /**
     * 读取推荐抢购列表
     * @param int $limit 要读取的数量
     */
    public function getMiaoshaCommendedList($limit = 4,$AND='') {
		// $condition = array();
		// $condition['state'] = self::MIAOSHA_STATE_NORMAL;
		// $condition['start_time'] = array('lt', TIMESTAMP);
		//$condition['end_time'] = array('gt', TIMESTAMP);AND start_time < ".TIMESTAMP."
		$where = "state = ".self::MIAOSHA_STATE_NORMAL."  AND end_time > ".TIMESTAMP." AND max_quantity - buy_quantity > 0".$AND;
	
        return $this->getMiaoshaExtendList($where, null, 'start_time asc,m_sort asc', '*', $limit);
    }


    /**
     * 秒杀状态数组
     */
    public function getMiaoshaStateArray() {
        return $this->miaosha_state_array;
    }


	/*
	 * 增加
	 * @param array $param
	 * @return bool
     *
	 */
    public function addMiaosha($param){
        // 发布秒杀锁定商品
        //add 发布抢购锁定商品SKU及商品  xin 20151106
        Model('goods')->editGoodsSkuLock($param['goods_id']);
        //add end

        $param['state'] = self::MIAOSHA_STATE_REVIEW;
        $param['recommended'] = 0;
        $result = $this->insert($param);
        if ($result) {
            // 更新商品秒杀缓存
            $this->_dGoodsMiaoshaCache($param['goods_id']);
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
    public function editMiaosha($update, $condition) {
        $miaosha_list = $this->getMiaoshaList($condition, null, '', 'goods_id');
        $result = $this->where($condition)->update($update);
        if ($result) {
            if (!empty($miaosha_list)) {
                foreach ($miaosha_list as $val) {
                    // 更新商品秒杀缓存
                    $this->_dGoodsMiaoshaCache($val['goods_id']);
                }
            }
        }
        return $result;
    }

    /**
     * 更新秒杀产品信息
     * @param unknown $data
     * @param unknown $condition
     */
    public function updateMiaoshaGoods($data = array(), $condition = array()) {
        // 删除缓存
        //$this->dropCache();
        return $this->where($condition)->update($data);
    }

    /*
	 * 审核成功
	 * @param int $miaosha_id
	 * @return bool
     *
	 */
    public function reviewPassMiaosha($miaosha_id) {
        $condition = array();
        $condition['miaosha_id'] = $miaosha_id;

        $update = array();
        $update['state'] = self::MIAOSHA_STATE_NORMAL;

        return $this->editMiaosha($update, $condition);
    }

    /*
	 * 审核失败
	 * @param int $miaosha_id
	 * @return bool
     *
	 */
    public function reviewFailMiaosha($miaosha_id) {
        // 商品解锁
        $miaosha_info = $this->getMiaoshaInfoByID($miaosha_id);

        $condition = array();
        $condition['miaosha_id'] = $miaosha_id;

        $update = array();
        $update['state'] = self::MIAOSHA_STATE_REVIEW_FAIL;

        $return =  $this->editMiaosha($update, $condition);
        if ($return) {
            $this->unLockMiaosha($miaosha_id);
        }
        return $return;
    }

    /*
     * 取消
     * @param int $miaosha_id
     * @return bool
     *
     */
    public function cancelMiaosha($miaosha_id) {
        // 商品解锁
        $miaosha_info = $this->getMiaoshaInfoByID($miaosha_id);

        $condition = array();
        $condition['miaosha_id'] = $miaosha_id;

        $update = array();
        $update['state'] = self::MIAOSHA_STATE_CLOSE;

        $return = $this->editMiaosha($update, $condition);
        if ($return) {
            $this->unLockMiaosha($miaosha_id);
        }
        return $return;
    }

    /*
     * 解锁商品
     * @param int $miaosha_id
     * @return bool
     *
     */
    public function unLockMiaosha($miaosha_id) {
        // 商品解锁
        $miaosha_info = $this->getMiaoshaInfoByID($miaosha_id);
        Model('goods')->editGoodsSkuUnlock($miaosha_info['goods_id']);

        return true;
    }

    /*
     * 锁定商品
     * @param int $miaosha_id
     * @return bool
     *
     */
     public function LockMiaosha($miaosha_id) {
        // 商品解锁
        $miaosha_info = $this->getMiaoshaInfoByID($miaosha_id);
        Model('goods')->editGoodsSkuLock($miaosha_info['goods_id']);
        return true;
    }
	/*
	 * 删除秒杀活动
	 * @param array $condition
	 * @return bool
     *
	 */
    public function delMiaosha($condition){
        $miaosha_list = $this->getMiaoshaExtendList($condition);
        $result = $this->where($condition)->delete();

        if(!empty($miaosha_list) && $result) {
            foreach ($miaosha_list as $value) {
                // 商品解锁
                $this->unLockMiaosha($value['miaosha_id']);

                // 更新商品秒杀缓存
                $this->_dGoodsMiaoshaCache($value['goods_id']);

                list($base_name, $ext) = explode('.', $value['miaosha_image']);
                list($store_id) = explode('_', $base_name);
                $path = BASE_UPLOAD_PATH.DS.ATTACH_MIAOSHA.DS.$store_id.DS;
                @unlink($path.$base_name.'.'.$ext);
                @unlink($path.$base_name.'_small.'.$ext);
                @unlink($path.$base_name.'_mid.'.$ext);
                @unlink($path.$base_name.'_max.'.$ext);

                if(!empty($value['miaosha_image1'])) {
                    list($base_name, $ext) = explode('.', $value['miaosha_image1']);
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
     * 获取秒杀扩展信息
     */
    public function getMiaoshaExtendInfo($miaosha_info) {
        $goods_info = Model('goods')->getGoodsInfoByID($miaosha_info['goods_id']);
        $miaosha_info['goods_image'] = thumb($goods_info, 360);
        $miaosha_info['goods_url'] = urlShop('goods', 'index', array('goods_id' => $miaosha_info['goods_id']));
        $miaosha_info['start_time_text'] = date('Y-m-d H:i', $miaosha_info['start_time']);
        $miaosha_info['end_time_text'] = date('Y-m-d H:i', $miaosha_info['end_time']);
		$miaosha_info['is_shipping'] = $miaosha_info['is_shipping'];
        if(empty($miaosha_info['miaosha_image1'])) {
            $miaosha_info['miaosha_image1'] = $miaosha_info['miaosha_image'];
        }
        if($miaosha_info['start_time'] > TIMESTAMP && $miaosha_info['state'] == self::MIAOSHA_STATE_NORMAL) {
            $miaosha_info['miaosha_state_text'] = '正常(未开始)';
        } elseif ($miaosha_info['end_time'] < TIMESTAMP && $miaosha_info['state'] == self::MIAOSHA_STATE_NORMAL) {
            $miaosha_info['miaosha_state_text'] = '已结束(未解锁)';
        } else {
            $miaosha_info['miaosha_state_text'] = $this->miaosha_state_array[$miaosha_info['state']];
        }

        switch ($miaosha_info['state']) {
            case self::MIAOSHA_STATE_REVIEW:
                $miaosha_info['state_flag'] = 'not-verify';
                $miaosha_info['button_text'] = '未审核';
                break;
            case self::MIAOSHA_STATE_REVIEW_FAIL:
            case self::MIAOSHA_STATE_CANCEL:
            case self::MIAOSHA_STATE_CLOSE:
                $miaosha_info['state_flag'] = 'close';
                $miaosha_info['button_text'] = '已结束';
                break;
            case self::MIAOSHA_STATE_NORMAL:
                if($miaosha_info['start_time'] > TIMESTAMP) {
                    $miaosha_info['state_flag'] = 'not-start';
                    $miaosha_info['button_text'] = '未开始';
                    $miaosha_info['count_down_text'] = '距秒杀开始';
                    $miaosha_info['count_down'] = $miaosha_info['start_time'] - TIMESTAMP;
                } elseif ($miaosha_info['end_time'] < TIMESTAMP) {
                    $miaosha_info['state_flag'] = 'close';
                    $miaosha_info['button_text'] = '已结束';
                } else {
                    $miaosha_info['state_flag'] = 'buy-now';
                    $miaosha_info['button_text'] = '我要抢';
                    $miaosha_info['count_down_text'] = '距秒杀结束';
                    $miaosha_info['count_down'] = $miaosha_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $miaosha_info;
    }

    /**
     * 读取商品秒杀缓存
     * @param int $goods_id
     * @return array/bool
     */
    private function _rGoodsMiaoshaCache($goods_id) {
        return rcache($goods_id, 'goods_miaosha');
    }

    /**
     * 写入商品秒杀缓存
     * @param int $goods_id
     * @param array $info
     * @return boolean
     */
    private function _wGoodsMiaoshaCache($goods_id, $info) {
        return wcache($goods_id, $info, 'goods_miaosha');
    }

    /**
     * 删除商品秒杀缓存
     * @param int $goods_id
     * @return boolean
     */
    private function _dGoodsMiaoshaCache($goods_id) {
        return dcache($goods_id, 'goods_miaosha');
    }

    /**
     * 读取秒杀分类
     *
     * @return array
     */
    public function getMiaoshaClasses()
    {
        return $this->getCachedData('miaosha_classes');
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
        case 'miaosha_classes': // 秒杀分类
            $classes = Model()->table('miaosha_class')->order('sort asc')->limit(false)->select();
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
     * 缓存数据（秒杀分类、虚拟秒杀分类、虚拟秒杀地区）
     * 数组键为缓存名称 值为缓存数据
     *
     * 例 秒杀分类缓存数据格式如下
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
