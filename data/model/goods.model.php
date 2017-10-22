<?php
/**
 * 商品管理
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');

class goodsModel extends Model{
    public function __construct(){
        parent::__construct('goods');
    }

    const STATE1 = 1;       // 出售中
    const STATE0 = 0;       // 下架
    const STATE10 = 10;     // 违规
    const VERIFY1 = 1;      // 审核通过
    const VERIFY0 = 0;      // 审核失败
    const VERIFY10 = 10;    // 等待审核

    /**
     * 新增商品数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addGoods($insert) {
        $result = $this->table('goods')->insert($insert);
        if ($result) {
            $this->_dGoodsCache($result);
            $this->_dGoodsCommonCache($insert['goods_commonid']);
            $this->_dGoodsSpecCache($insert['goods_commonid']);
        }
        return $result;
    }

    /**
     * 新增商品公共数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addGoodsCommon($insert) {
        return $this->table('goods_common')->insert($insert);
    }

    /**
     * 新增多条商品数据
     *
     * @param unknown $insert
     */
    public function addGoodsImagesAll($insert) {
        $result = $this->table('goods_images')->insertAll($insert);
        if ($result) {
            foreach ($insert as $val) {
                $this->_dGoodsImageCache($val['goods_commonid'] . '|' . $val['color_id']);
            }
        }
        return $result;
    }

    /**
     * 商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array 二维数组
     */
    public function getGoodsList($condition, $field = '*', $group = '',$order = '', $limit = 0, $page = 0, $lock = false, $count = 0) {



        $condition = $this->_getRecursiveClass($condition);

		$goods_list = $this->table('goods')->field($field)->where($condition)->group($group)->order($order)->limit($limit)->page($page, $count)->lock($lock)->select();

        // unset($group);

		if($goods_list){
			foreach($goods_list as $k=>$v){
				//获取促销信息
				$goods_info = $this->getChuXiao($v['goods_id']);

				if($goods_info['promotion_type'] && $goods_info['promotion_price']){
					$goods_list[$k]['promotion_type'] = $goods_info['promotion_type'];
					$goods_list[$k]['promotion_price'] = $goods_info['promotion_price'];
				}
			}
		}

		return $goods_list;
    }

    /**
     * 出售中的商品SKU列表（只显示不同颜色的商品，前台商品索引，店铺也商品列表等使用）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param number $page
     * @return array
     */
    public function getGoodsListByColorDistinct($condition, $field = '*', $order = 'goods_id asc', $page = 0) {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        $condition = $this->_getRecursiveClass($condition);
        $field = "CONCAT(goods_commonid,',',color_id) as nc_distinct ," . $field;
        $count = $this->getGoodsOnlineCount($condition,"distinct CONCAT(goods_commonid,',',color_id)");

        $goods_list = array();
        if ($count != 0) {
            $goods_list = $this->getGoodsOnlineList($condition, $field, $page, $order, 0, 'nc_distinct', false, $count);
        }
        return $goods_list;
    }

    /**
     * 在售商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGeneralGoodsList($condition, $field = '*', $page = 0, $order = 'goods_id desc') {
        $condition['is_virtual']    = 0;
        $condition['is_fcode']      = 0;
        $condition['is_presell']    = 0;
        return $this->getGoodsList($condition, $field, '', $order, 0, $page, false, 0);
    }

    /**
     * 在售商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGoodsOnlineList($condition, $field = '*', $page = 0, $order = 'goods_id desc', $limit = 0, $group = '', $lock = false, $count = 0) {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsList($condition, $field, $group, $order, $limit, $page, $lock, $count);
    }

    /**
     * 出售中的普通商品列表，即不包括虚拟商品、F码商品、预售商品
     */
    public function getGoodsListForPromotion($condition, $field = '*', $page = 0, $type = '') {
        switch ($type) {
            case 'xianshi':
            case 'bundling':
            case 'combo':
                $condition['is_virtual']    = 0;
                $condition['is_fcode']      = 0;
                $condition['is_presell']    = 0;
                $condition['goods_state']   = self::STATE1;
                $condition['goods_verify']  = self::VERIFY1;
                break;
            case 'gift':
                $condition['is_virtual']    = 0;
                break;
            default:
                break;
        }
        return $this->getGoodsList($condition, $field, '', '', 0, $page);
    }

    /**
     * 商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonList($condition, $field = '*', $page = 10, $order = 'goods_commonid desc') {
        $condition = $this->_getRecursiveClass($condition);
        return $this->table('goods_common')->field($field)->where($condition)->order($order)->page($page)->select();
    }

    /**
     * 出售中的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonOnlineList($condition, $field = '*', $page = 10, $order = "goods_commonid desc") {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 出售中的普通商品列表，即不包括虚拟商品、F码商品、预售商品
     */
    public function getGoodsCommonListForPromotion($condition, $field = '*', $page = 10, $type) {
        if ($type == 'groupbuy') {
            $condition['is_virtual']    = 0;
            $condition['is_fcode']      = 0;
            $condition['is_presell']    = 0;
            $condition['goods_state']   = self::STATE1;
            $condition['goods_verify']  = self::VERIFY1;
        }
        //add 秒杀模块  xin
        if ($type == 'miaosha') {
            $condition['is_virtual']    = 0;
            $condition['is_fcode']      = 0;
            $condition['is_presell']    = 0;
            $condition['goods_state']   = self::STATE1;
            $condition['goods_verify']  = self::VERIFY1;
        }
        //add end
        return $this->getGoodsCommonList($condition, $field, $page);
    }

    /**
     * 出售中的未参加促销的虚拟商品列表
     */
    public function getGoodsCommonListForVrPromotion($condition, $field = '*', $page = 10) {
        $condition['is_virtual']    = 1;
        $condition['is_fcode']      = 0;
        $condition['is_presell']    = 0;
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;

        return $this->getGoodsCommonList($condition, $field, $page);
    }

    /**
     * 仓库中的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonOfflineList($condition, $field = '*', $page = 10, $order = "goods_commonid desc") {
        $condition['goods_state']   = self::STATE0;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 违规的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonLockUpList($condition, $field = '*', $page = 10, $order = "goods_commonid desc") {
        $condition['goods_state']   = self::STATE10;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 等待审核或审核失败的商品列表 卖家中心使用
     *
     * @param array $condition 条件
     * @param array $field 字段
     * @param string $page 分页
     * @param string $order 排序
     * @return array
     */
    public function getGoodsCommonWaitVerifyList($condition, $field = '*', $page = 10, $order = "goods_commonid desc") {
        if (!isset($condition['goods_verify'])) {
            $condition['goods_verify']  = array('neq', self::VERIFY1);
        }
        return $this->getGoodsCommonList($condition, $field, $page, $order);
    }

    /**
     * 查询商品SUK及其店铺信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsStoreList($condition, $field = '*') {
        $condition = $this->_getRecursiveClass($condition);
        return $this->table('goods,store')->field($field)->join('inner')->on('goods.store_id = store.store_id')->where($condition)->select();
    }

    /**
     * 计算商品库存
     *
     * @param array $goods_list
     * @return array|boolean
     */
    public function calculateStorage($goods_list) {
        // 计算库存
        if (!empty($goods_list)) {
            $goodsid_array = array();
            foreach ($goods_list as $value) {
                $goodscommonid_array[] = $value['goods_commonid'];
            }
            $goods_storage = $this->getGoodsList(array('goods_commonid' => array('in', $goodscommonid_array)), 'goods_storage,goods_commonid,goods_id,goods_storage_alarm');
            $storage_array = array();
            foreach ($goods_storage as $val) {
                if ($val['goods_storage_alarm'] != 0 && $val['goods_storage'] <= $val['goods_storage_alarm']) {
                    $storage_array[$val['goods_commonid']]['alarm'] = true;
                }
                $storage_array[$val['goods_commonid']]['sum'] += $val['goods_storage'];
                $storage_array[$val['goods_commonid']]['goods_id'] = $val['goods_id'];
            }
            return $storage_array;
        } else {
            return false;
        }
    }

    /**
     * 更新商品SUK数据
     *
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoods($update, $condition) {
        $goods_list = $this->getGoodsList($condition, 'goods_id');
        if (empty($goods_list)) {
            return true;
        }
        $goodsid_array = array();
        foreach ($goods_list as $value) {
            $goodsid_array[] = $value['goods_id'];
        }
        return $this->editGoodsById($update, $goodsid_array);
    }

    /**
     * 更新商品SUK数据
     * @param array $update
     * @param int|array $goodsid_array
     * @return boolean|unknown
     */
    public function editGoodsById($update, $goodsid_array) {
        if (empty($goodsid_array)) {
            return true;
        }
        $condition['goods_id'] = array('in', $goodsid_array);
        $update['goods_edittime'] = TIMESTAMP;
        $result = $this->table('goods')->where($condition)->update($update);
        if ($result) {
            foreach ((array)$goodsid_array as $value) {
                $this->_dGoodsCache($value);
            }
        }
        return $result;
    }

    /**
     * 更新商品促销价 (需要验证藏品惠和限时折扣是否进行)
     *
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoodsPromotionPrice($condition) {
        $goods_list = $this->getGoodsList($condition, 'goods_id,goods_commonid');
        $goods_array = array();
        foreach ($goods_list as $val) {
            $goods_array[$val['goods_commonid']][$val['goods_id']] = $val;
        }
        $model_groupbuy = Model('groupbuy');
        $model_xianshigoods = Model('p_xianshi_goods');
        foreach ($goods_array as $key => $val) {
            // 查询藏品惠时候进行
            $groupbuy = $model_groupbuy->getGroupbuyOnlineInfo(array('goods_commonid' => $key));
            if (!empty($groupbuy)) {
                // 更新价格
                $this->editGoods(array('goods_promotion_price' => $groupbuy['groupbuy_price'], 'goods_promotion_type' => 1), array('goods_commonid' => $key));
                continue;
            }
            foreach ($val as $k => $v) {
                // 查询限时折扣时候进行
                $xianshigoods = $model_xianshigoods->getXianshiGoodsInfo(array('goods_id' => $k, 'start_time' => array('lt', TIMESTAMP), 'end_time' => array('gt', TIMESTAMP)));
                if (!empty($xianshigoods)) {
                    // 更新价格
                    $this->editGoodsById(array('goods_promotion_price' => $xianshigoods['xianshi_price'], 'goods_promotion_type' => 2), $k);
                    continue;
                }

                // 没有促销使用原价
                $this->editGoodsById(array('goods_promotion_price' => array('exp', 'goods_price'), 'goods_promotion_type' => 0), $k);
            }
        }
        return true;
    }

    /**
     * 更新商品数据
     * @param array $update 更新数据
     * @param array $condition 条件
     * @return boolean
     */
    public function editGoodsCommon($update, $condition) {
        $common_list = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        if (empty($common_list)) {
            return false;
        }
        $commonid_array = array();
        foreach ($common_list as $val) {
            $commonid_array[] = $val['goods_commonid'];
        }
        return $this->editGoodsCommonById($update, $commonid_array);
    }

    /**
     * 更新商品数据
     * @param array $update
     * @param int|array $commonid_array
     * @return boolean|unknown
     */
    public function editGoodsCommonById($update, $commonid_array) {
        if (empty($commonid_array)) {
            return true;
        }
        $condition['goods_commonid'] = array('in', $commonid_array);
        $result = $this->table('goods_common')->where($condition)->update($update);
        if ($result) {
            foreach ((array)$commonid_array as $val) {
                $this->_dGoodsCommonCache($val);
            }
        }
        return $result;
    }

    /**
     * 锁定商品
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsCommonLock($condition) {
        $update = array('goods_lock' => 1);
        return $this->editGoodsCommon($update, $condition);
    }

     /**
     * 解锁商品
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsCommonUnlock($condition) {
        $update = array('goods_lock' => 0);
        return $this->editGoodsCommon($update, $condition);
    }

    /**
     * 锁定商品SKU和锁定商品
     * add xin 20151106
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsSkuLock($goods_id) {
        $goods_info = $this->getGoodsInfoByID($goods_id);
        if(!empty($goods_info) && is_array($goods_info)){
            $skuLock = $this->editGoodsById(array('sku_lock' => 1), $goods_info['goods_id']);
            if($skuLock){
                return $this->editGoodsCommonById(array('goods_lock'=> 1), $goods_info['goods_commonid']);
            }
        }

    }

    /**
     * 解锁商品SKU，如果同商品下其他SKU没有加锁，则解锁整个商品
     * add xin 20151106
     * @param unknown $condition
     * @return boolean
     */
    public function editGoodsSkuUnlock($goods_id) {
        $goods_info = $this->getGoodsInfoByID($goods_id);
        if(!empty($goods_info) && is_array($goods_info)){
            $skuLock = $this->editGoodsById(array('sku_lock' => 0), $goods_info['goods_id']);
            if($skuLock){
                //查询商品其他sku是否锁定
                $goods_list = $this->getGoodsList(array('goods_commonid'=>$goods_info['goods_commonid'],'sku_lock' => 1));
                if(is_array($goods_list) && !empty($goods_list)){
                    //其他SKU锁定状态，不做任何操作
                    return true;
                }else{
                    //解锁整个商品
                    return $this->editGoodsCommonById(array('goods_lock'=> 0), $goods_info['goods_commonid']);
                }
            }
        }
    }

    /**
     * 更新商品信息
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProduces($condition, $update1, $update2 = array()) {
        $update2 = empty($update2) ? $update1 : $update2;
        $goods_array = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        if (empty($goods_array)) {
            return true;
        }
        $commonid_array = array();
        foreach ($goods_array as $val) {
            $commonid_array[] = $val['goods_commonid'];
        }
        $return1 = $this->editGoodsCommonById($update1, $commonid_array);
        $return2 = $this->editGoods($update2, array('goods_commonid' => array('in', $commonid_array)));
        if ($return1 && $return2) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新商品信息（审核失败）
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProducesVerifyFail($condition, $update1, $update2 = array()) {
        $result = $this->editProduces($condition, $update1, $update2);
        if ($result) {
            $commonlist = $this->getGoodsCommonList($condition, 'goods_commonid,store_id,goods_verifyremark', 0);
            foreach ($commonlist as $val) {
                $param = array();
                $param['common_id'] = $val['goods_commonid'];
                $param['remark']= $val['goods_verifyremark'];
                $this->_sendStoreMsg('goods_verify', $val['store_id'], $param);
            }
        }
    }

    /**
     * 更新未锁定商品信息
     *
     * @param array $condition
     * @param array $update1
     * @param array $update2
     * @return boolean
     */
    public function editProducesNoLock($condition, $update1, $update2 = array()) {
        $condition['goods_lock'] = 0;
        return $this->editProduces($condition, $update1, $update2);
    }

    /**
     * 商品下架
     * @param array $condition 条件
     * @return boolean
     */
    public function editProducesOffline($condition){
        $update = array('goods_state' => self::STATE0);
        return $this->editProducesNoLock($condition, $update);
    }

    /**
     * 商品上架
     * @param array $condition 条件
     * @return boolean
     */
    public function editProducesOnline($condition){
        $update = array('goods_state' => self::STATE1);
        // 禁售商品、审核失败商品不能上架。
        $condition['goods_state'] = self::STATE0;
        $condition['goods_verify'] = array('neq', self::VERIFY0);
        // 修改预约商品状态
        $update['is_appoint'] = 0;
        return $this->editProduces($condition, $update);
    }

    /**
     * 违规下架
     *
     * @param array $update
     * @param array $condition
     * @return boolean
     */
    public function editProducesLockUp($update, $condition) {
        $update_param['goods_state'] = self::STATE10;
        $update = array_merge($update, $update_param);
        $return = $this->editProduces($condition, $update, $update_param);
        if ($return) {
            // 商品违规下架发送店铺消息
            $common_list = $this->getGoodsCommonList($condition, 'goods_commonid,store_id,goods_stateremark', 0);
            foreach ($common_list as $val) {
                $param = array();
                $param['remark'] = $val['goods_stateremark'];
                $param['common_id'] = $val['goods_commonid'];
                $this->_sendStoreMsg('goods_violation', $val['store_id'], $param);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取单条商品SKU信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodsInfo($condition, $field = '*') {
        return $this->table('goods')->field($field)->where($condition)->group('')->find();
    }

    /**
     * 获取单条商品SKU信息及其促销信息
     *
     * @param int $goods_id
     * @param string $field
     * @return array
     */
    public function getGoodsOnlineInfoForShare($goods_id) {
        $goods_info = $this->getGoodsOnlineInfoAndPromotionById($goods_id);
        if (empty($goods_info)) {
            return array();
        }
		//藏品惠
	    if (isset($goods_info['groupbuy_info'])) {
	        $goods_info['promotion_type'] = '藏品惠';
	        $goods_info['promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
	    }

	    if (isset($goods_info['xianshi_info'])) {
	        $goods_info['promotion_type'] = '限时折扣';
	        $goods_info['promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
	    }

        // add 秒杀模块 xin
        if (isset($goods_info['miaosha_info'])) {
            $goods_info['promotion_type'] = '秒杀';
            $goods_info['promotion_price'] = $goods_info['miaosha_info']['miaosha_price'];
        }

        //add 会员特价模块 xin  20151130
        if (isset($goods_info['vipsale_info'])) {
            $goods_info['promotion_type'] = '会员特价';
            $goods_info['promotion_price'] = $goods_info['vipsale_info']['vipsale_price'];
        }
		// add 藏豆推荐 du 20160419
        if ($goods_info['cangdoutuijian_info']) {
			
            $goods_info['promotion_type'] = '藏豆推荐';
            $goods_info['promotion_price'] = $goods_info['cangdoutuijian_info']['vipsale_price'];
        }
        // add end
		return $goods_info;
    }

    /**
     * 查询出售中的商品详细信息及其促销信息
     * @param int $goods_id
     * @return array
     */
    public function getGoodsOnlineInfoAndPromotionById($goods_id) {
        $goods_info = $this->getGoodsInfoAndPromotionById($goods_id);
        if (empty($goods_info) || $goods_info['goods_state'] != self::STATE1 || $goods_info['goods_verify'] != self::VERIFY1) {
            return array();
        }
        return $goods_info;
    }

    /**
     * 查询商品详细信息及其促销信息
     * @param int $goods_id
     * @return array
     */
    public function getGoodsInfoAndPromotionById($goods_id) {



        $goods_info = $this->getGoodsInfoByID($goods_id);

        if (empty($goods_info)) {
            return array();
        }
        //藏品惠
        if (C('groupbuy_allow')) {
            $goods_info['groupbuy_info'] = Model('groupbuy')->getGroupbuyInfoByGoodsID($goods_info['goods_id']);
        }


        //限时折扣
        if (C('promotion_allow') && empty($goods_info['groupbuy_info'])) {
            $goods_info['xianshi_info'] = Model('p_xianshi_goods')->getXianshiGoodsInfoByGoodsID($goods_info['goods_id']);
        }

        // add 秒杀模块 xin
        //秒杀
        if (C('miaosha_allow') && empty($goods_info['miaosha_info'])) {
            $goods_info['miaosha_info'] = Model('miaosha')->getMiaoshaInfoByGoodsID($goods_info['goods_id'],$goods_info);
        }



        // add 会员特价模块 xin 20151130
        if (C('vipsale_allow') && empty($goods_info['vipsale_info'])) {
            $goods_info['vipsale_info'] = Model('vipsale')->getVipsaleInfoByGoodsID($goods_info['goods_id']);
        }
		// add 藏豆推荐 du 20160419
        if (C('cangdoutuijian_allow') && empty($goods_info['cangdoutuijian_info'])) {
            $goods_info['cangdoutuijian_info'] = Model('pushuser_gift')->getYouHuiByGoodsID($goods_info['goods_id']);
			
        }
        // add end

        return $goods_info;
    }

    /**
     * 查询出售中的商品列表及其促销信息
     * @param array $goodsid_array
     * @return array
     */
    public function getGoodsOnlineListAndPromotionByIdArray($goodsid_array) {
        if (empty($goodsid_array) || !is_array($goodsid_array)) return array();

        $goods_list = array();
        foreach ($goodsid_array as $goods_id) {
            $goods_info = $this->getGoodsOnlineInfoAndPromotionById($goods_id);
            if (!empty($goods_info)) $goods_list[] = $goods_info;
        }

        return $goods_list;
    }

    /**
     * 获取单条商品信息
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getGoodeCommonInfo($condition, $field = '*') {
        return $this->table('goods_common')->field($field)->where($condition)->find();
    }

    /**
     * 取得商品详细信息（优先查询缓存）
     * 如果未找到，则缓存所有字段
     * @param int $goods_commonid
     * @param string $fields 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodeCommonInfoByID($goods_commonid, $fields = '*') {
        $common_info = $this->_rGoodsCommonCache($goods_commonid, $fields);
        if (empty($common_info)) {   }
            $common_info = $this->getGoodeCommonInfo(array('goods_commonid'=>$goods_commonid));
            $this->_wGoodsCommonCache($goods_commonid, $common_info);
     
        return $common_info;
    }

    /**
     * 获得商品SKU某字段的和
     *
     * @param array $condition
     * @param string $field
     * @return boolean
     */
    public function getGoodsSum($condition, $field) {
        return $this->table('goods')->where($condition)->sum($field);
    }

    /**
     * 获得商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsCount($condition) {
        return $this->table('goods')->where($condition)->count();
    }

    /**
     * 获得出售中商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsOnlineCount($condition, $field = '*') {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->table('goods')->where($condition)->group('')->count1($field);
    }
    /**
     * 获得商品数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsCommonCount($condition) {
        return $this->table('goods_common')->where($condition)->count();
    }

    /**
     * 出售中的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonOnlineCount($condition) {
        $condition['goods_state']   = self::STATE1;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 仓库中的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonOfflineCount($condition) {
        $condition['goods_state']   = self::STATE0;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 等待审核的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonWaitVerifyCount($condition) {
        $condition['goods_verify']  = self::VERIFY10;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 审核失败的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonVerifyFailCount($condition) {
        $condition['goods_verify']  = self::VERIFY0;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 违规下架的商品数量
     *
     * @param array $condition
     * @return int
     */
    public function getGoodsCommonLockUpCount($condition) {
        $condition['goods_state']   = self::STATE10;
        $condition['goods_verify']  = self::VERIFY1;
        return $this->getGoodsCommonCount($condition);
    }

    /**
     * 商品图片列表
     *
     * @param array $condition
     * @param array $order
     * @param string $field
     * @return array
     */
    public function getGoodsImageList($condition, $field = '*', $order = 'is_default desc,goods_image_sort asc') {
        $this->cls();
        return $this->table('goods_images')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 删除商品SKU信息
     *
     * @param array $condition
     * @return boolean
     */
    public function delGoods($condition) {
        $goods_list = $this->getGoodsList($condition, 'goods_id,goods_commonid,store_id');
        if (!empty($goods_list)) {
            $goodsid_array = array();
            // 删除商品二维码
            foreach ($goods_list as $val) {
                $goodsid_array[] = $val['goods_id'];
                @unlink(BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$val['store_id'].DS.$val['goods_id'].'.png');
                // 删除商品缓存
                $this->_dGoodsCache($val['goods_id']);
                // 删除商品规格缓存
                $this->_dGoodsSpecCache($val['goods_commonid']);
            }
            // 删除属性关联表数据
            $this->table('goods_attr_index')->where(array('goods_id' => array('in', $goodsid_array)))->delete();
            // 删除优惠套装商品
            Model('p_bundling')->delBundlingGoods(array('goods_id' => array('in', $goodsid_array)));
            // 优惠套餐活动下架
            Model('p_bundling')->editBundlingCloseByGoodsIds(array('goods_id' => array('in', $goodsid_array)));
            // 推荐展位商品
            Model('p_booth')->delBoothGoods(array('goods_id' => array('in', $goodsid_array)));
            // 限时折扣
            Model('p_xianshi_goods')->delXianshiGoods(array('goods_id' => array('in', $goodsid_array)));
            //删除商品浏览记录
            Model('goods_browse')->delGoodsbrowse(array('goods_id' => array('in', $goodsid_array)));
            // 删除买家收藏表数据
            $this->table('favorites')->where(array('fav_id' => array('in', $goodsid_array), 'fav_type' => 'goods'))->delete();
            // 删除商品赠品
            Model('goods_gift')->delGoodsGift(array('goods_id' => array('in', $goodsid_array), 'gift_goodsid'=> array('in', $goodsid_array), '_op' => 'or'));
            // 删除推荐组合
            Model('goods_combo')->delGoodsCombo(array('goods_id' => array('in', $goodsid_array), 'combo_goodsid' => array('in', $goodsid_array), '_op' => 'or'));
        }
        return $this->table('goods')->where($condition)->delete();
    }

    /**
     * 删除商品图片表信息
     *
     * @param array $condition
     * @return boolean
     */
    public function delGoodsImages($condition) {
        $image_list = $this->getGoodsImageList($condition, 'goods_commonid,color_id');
        if (empty($image_list)) {
            return true;
        }
        $result = $this->table('goods_images')->where($condition)->delete();
        if ($result) {
            foreach ($image_list as $val) {
                $this->_dGoodsImageCache($val['goods_commonid'] . '|' . $val['color_id']);
            }
        }
        return $result;
    }

    /**
     * 商品删除及相关信息
     *
     * @param   array $condition 列表条件
     * @return boolean
     */
    public function delGoodsAll($condition) {
        $goods_list = $this->getGoodsList($condition, 'goods_id,goods_commonid,store_id');
        if (empty($goods_list)) {
            return false;
        }
        $goodsid_array = array();
        $commonid_array = array();
        foreach ($goods_list as $val) {
            $goodsid_array[] = $val['goods_id'];
            $commonid_array[] = $val['goods_commonid'];
            // 商品公共缓存
            $this->_dGoodsCommonCache($val['goods_commonid']);
            // 商品规格缓存
            $this->_dGoodsSpecCache($val['goods_commonid']);
        }
        $commonid_array = array_unique($commonid_array);

        // 删除商品表数据
        $this->delGoods(array('goods_id' => array('in', $goodsid_array)));
        // 删除商品公共表数据
        $this->table('goods_common')->where(array('goods_commonid' => array('in', $commonid_array)))->delete();
        // 删除商品图片表数据
        $this->delGoodsImages(array('goods_commonid' => array('in', $commonid_array)));
        // 删除商品F码
        Model('goods_fcode')->delGoodsFCode(array('goods_commonid' => array('in', $commonid_array)));
        return true;
    }

    /**
     * 删除未锁定商品
     * @param unknown $condition
     */
    public function delGoodsNoLock($condition) {
        $condition['goods_lock'] = 0;
        $common_array = $this->getGoodsCommonList($condition, 'goods_commonid', 0);
        $common_array = array_under_reset($common_array, 'goods_commonid');
        $commonid_array = array_keys($common_array);
        return $this->delGoodsAll(array('goods_commonid' => array('in', $commonid_array)));
    }

    /**
     * 发送店铺消息
     * @param string $code
     * @param int $store_id
     * @param array $param
     */
    private function _sendStoreMsg($code, $store_id, $param) {
        QueueClient::push('sendStoreMsg', array('code' => $code, 'store_id' => $store_id, 'param' => $param));
    }

     /**
      * 获得商品子分类的ID
      * @param array $condition
      * @return array
      */
    private function _getRecursiveClass($condition){
        if (isset($condition['gc_id']) && !is_array($condition['gc_id'])) {
            $gc_list = Model('goods_class')->getGoodsClassForCacheModel();
            if (!empty($gc_list[$condition['gc_id']])) {
                $gc_id[] = $condition['gc_id'];
                $gcchild_id = empty($gc_list[$condition['gc_id']]['child']) ? array() : explode(',', $gc_list[$condition['gc_id']]['child']);
                $gcchildchild_id = empty($gc_list[$condition['gc_id']]['childchild']) ? array() : explode(',', $gc_list[$condition['gc_id']]['childchild']);
                $gc_id = array_merge($gc_id, $gcchild_id, $gcchildchild_id);
                $condition['gc_id'] = array('in', $gc_id);
            }
        }
        return $condition;
    }

    /**
     * 由ID取得在售单个虚拟商品信息
     * @param unknown $goods_id
     * @param string $field 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getVirtualGoodsOnlineInfoByID($goods_id) {
        $goods_info = $this->getGoodsInfoByID($goods_id,'*');
        return $goods_info['is_virtual'] == 1 && $goods_info['virtual_indate'] >= TIMESTAMP ? $goods_info : array();
    }

    /**
     * 取得商品详细信息（优先查询缓存）（在售）
     * 如果未找到，则缓存所有字段
     * @param int $goods_id
     * @param string $field 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodsOnlineInfoByID($goods_id, $field = '*') {
        if ($field != '*') {
            $field .= ',goods_state,goods_verify';
        }
        $goods_info = $this->getGoodsInfoByID($goods_id,trim($field,','));
        if ($goods_info['goods_state'] != self::STATE1 || $goods_info['goods_verify'] != self::VERIFY1) {
            $goods_info = array();
        }
		if($goods_info){
			//获取促销信息
			$ChuXIaoArray = $this->getChuXiao($goods_info['goods_id']);
			if($ChuXIaoArray['promotion_type'] && $ChuXIaoArray['promotion_price']){
				$goods_info['promotion_type'] = $ChuXIaoArray['promotion_type'];
				$goods_info['promotion_price'] = $ChuXIaoArray['promotion_price'];
			}
		}
		return $goods_info;
    }

    /**
     * 取得商品详细信息（优先查询缓存）
     * 如果未找到，则缓存所有字段
     * @param int $goods_id
     * @param string $fields 需要取得的缓存键值, 例如：'*','goods_name,store_name'
     * @return array
     */
    public function getGoodsInfoByID($goods_id, $fields = '*') {

        $goods_info = $this->_rGoodsCache($goods_id, $fields);

        if (empty($goods_info)) {
            $goods_info = $this->getGoodsInfo(array('goods_id'=>$goods_id));
            $this->_wGoodsCache($goods_id, $goods_info);
        }
	
        return $goods_info;
    }

    /**
     * 验证是否为普通商品
     * @param array $goods 商品数组
     * @return boolean
     */
    public function checkIsGeneral($goods) {
        if ($goods['is_virtual'] == 1 || $goods['is_fcode'] == 1 || $goods['is_presell'] == 1) {
            return false;
        }
        return true;
    }

    /**
     * 验证是否允许送赠品
     * @param unknown $goods
     * @return boolean
     */
    public function checkGoodsIfAllowGift($goods) {
        if ($goods['is_virtual'] == 1) {
            return false;
        }
        return true;
    }

    public function checkGoodsIfAllowCombo($goods) {
        if ($goods['is_virtual'] == 1 || $goods['is_fcode'] == 1 || $goods['is_presell'] == 1 || $goods['is_appoint'] == 1) {
            return false;
        }
        return true;
    }

    /**
     * 获得商品规格数组
     * @param unknown $common_id
     */
    public function getGoodsSpecListByCommonId($common_id) {
        $spec_list = $this->_rGoodsSpecCache($common_id);
        if (empty($spec_list)) {
            $spec_array = $this->getGoodsList(array('goods_commonid' => $common_id), 'goods_spec,goods_id,store_id,goods_image,color_id');
            $spec_list['spec'] = serialize($spec_array);
            $this->_wGoodsSpecCache($common_id, $spec_list);
        }
        $spec_array = unserialize($spec_list['spec']);
        return $spec_array;
    }

    /**
     * 获得商品图片数组
     * @param int $goods_id
     * @param array $condition
     */
    public function getGoodsImageByKey($key) {
        $image_list = $this->_rGoodsImageCache($key);
        if (empty($image_list)) {
            $array = explode('|', $key);
            list($common_id, $color_id) = $array;
            $image_more = $this->getGoodsImageList(array('goods_commonid' => $common_id, 'color_id' => $color_id), 'goods_image');
            $image_list['image'] = serialize($image_more);
            $this->_wGoodsImageCache($key, $image_list);
        }
        $image_more = unserialize($image_list['image']);
        return $image_more;
    }

    /**
     * 读取商品缓存
     * @param int $goods_id
     * @param string $fields
     * @return array
     */
    private function _rGoodsCache($goods_id, $fields) {
        return rcache($goods_id, 'goods', $fields);
    }

    /**
     * 写入商品缓存
     * @param int $goods_id
     * @param array $goods_info
     * @return boolean
     */
    private function _wGoodsCache($goods_id, $goods_info) {
        return wcache($goods_id, $goods_info, 'goods');
    }

    /**
     * 删除商品缓存
     * @param int $goods_id
     * @return boolean
     */
    private function _dGoodsCache($goods_id) {
        return dcache($goods_id, 'goods');
    }

    /**
     * 读取商品公共缓存
     * @param int $goods_commonid
     * @param string $fields
     * @return array
     */
    private function _rGoodsCommonCache($goods_commonid, $fields) {
        return rcache($goods_commonid, 'goods_common', $fields);
    }

    /**
     * 写入商品公共缓存
     * @param int $goods_commonid
     * @param array $common_info
     * @return boolean
     */
    private function _wGoodsCommonCache($goods_commonid, $common_info) {
        return wcache($goods_commonid, $common_info, 'goods_common');
    }

    /**
     * 删除商品公共缓存
     * @param int $goods_commonid
     * @return boolean
     */
    private function _dGoodsCommonCache($goods_commonid) {
        return dcache($goods_commonid, 'goods_common');
    }

    /**
     * 读取商品规格缓存
     * @param int $goods_commonid
     * @param string $fields
     * @return array
     */
    private function _rGoodsSpecCache($goods_commonid) {
        return rcache($goods_commonid, 'goods_spec');
    }

    /**
     * 写入商品规格缓存
     * @param int $goods_commonid
     * @param array $spec_list
     * @return boolean
     */
    private function _wGoodsSpecCache($goods_commonid, $spec_list) {
        return wcache($goods_commonid, $spec_list, 'goods_spec');
    }

    /**
     * 删除商品规格缓存
     * @param int $goods_commonid
     * @return boolean
     */
    private function _dGoodsSpecCache($goods_commonid) {
        return dcache($goods_commonid, 'goods_spec');
    }

    /**
     * 读取商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @param string $fields
     * @return array
     */
    private function _rGoodsImageCache($key) {
        return rcache($key, 'goods_image');
    }

    /**
     * 写入商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @param array $image_list
     * @return boolean
     */
    private function _wGoodsImageCache($key, $image_list) {
        return wcache($key, $image_list, 'goods_image');
    }

    /**
     * 删除商品图片缓存
     * @param int $key ($goods_commonid .'|'. $color_id)
     * @return boolean
     */
    private function _dGoodsImageCache($key) {
        return dcache($key, 'goods_image');
    }

    /**
     * 获取单条商品信息
     *
     * @param int $goods_id
     * @return array
     */
    public function getGoodsDetail($goods_id) {
        if($goods_id <= 0) {
            return null;
        }
        $result1 = $this->getGoodsInfoAndPromotionById($goods_id);

        if (empty($result1)) {
            return null;
        }
        $result2 = $this->getGoodeCommonInfoByID($result1['goods_commonid']);
        $goods_info = array_merge($result2, $result1);
		
        $goods_info['spec_value'] = unserialize($goods_info['spec_value']);
        $goods_info['spec_name'] = unserialize($goods_info['spec_name']);
        $goods_info['goods_spec'] = unserialize($goods_info['goods_spec']);
        $goods_info['goods_attr'] = unserialize($goods_info['goods_attr']);

        // 手机商品描述
        if ($goods_info['mobile_body'] != '') {
            $mobile_body_array = unserialize($goods_info['mobile_body']);
            if (is_array($mobile_body_array)) {
                $mobile_body = '';
                foreach ($mobile_body_array as $val) {
                    switch ($val['type']) {
                    	case 'text':
                    	    $mobile_body .= '<div>' . $val['value'] . '</div>';
                    	    break;
                    	case 'image':
                    	    $mobile_body .= '<img src="' . $val['value'] . '">';
                    	    break;
                    }
                }
                $goods_info['mobile_body'] = $mobile_body;
            }
        }

        // 查询所有规格商品
        $spec_array = $this->getGoodsSpecListByCommonId($goods_info['goods_commonid']);
        $spec_list = array();       // 各规格商品地址，js使用
        $spec_list_mobile = array();       // 各规格商品地址，js使用
        $spec_image = array();      // 各规格商品主图，规格颜色图片使用
        foreach ($spec_array as $key => $value) {
            $s_array = unserialize($value['goods_spec']);
            $tmp_array = array();
            if (!empty($s_array) && is_array($s_array)) {
                foreach ($s_array as $k => $v) {
                    $tmp_array[] = $k;
                }
            }
            sort($tmp_array);
            $spec_sign = implode('|', $tmp_array);
            $tpl_spec = array();
            $tpl_spec['sign'] = $spec_sign;
            $tpl_spec['url'] = urlShop('goods', 'index', array('goods_id' => $value['goods_id']));
            $spec_list[] = $tpl_spec;
            $spec_list_mobile[$spec_sign] = $value['goods_id'];
            $spec_image[$value['color_id']] = thumb($value, 60);
        }
        $spec_list = json_encode($spec_list);

        // 商品多图
        $image_more = $this->getGoodsImageByKey($goods_info['goods_commonid'] . '|' . $goods_info['color_id']);
        $goods_image = array();
        $goods_image_mobile = array();
        if (!empty($image_more)) {
            foreach ($image_more as $val) {
                $goods_image[] = "{ title : '', levelA : '".cthumb($val['goods_image'], 60, $goods_info['store_id'])."', levelB : '".cthumb($val['goods_image'], 360, $goods_info['store_id'])."', levelC : '".cthumb($val['goods_image'], 360, $goods_info['store_id'])."', levelD : '".cthumb($val['goods_image'], 1280, $goods_info['store_id'])."'}";
                $goods_image_mobile[] = cthumb($val['goods_image'], 360, $goods_info['store_id']);
            }
        } else {
            $goods_image[] = "{ title : '', levelA : '".thumb($goods_info, 60)."', levelB : '".thumb($goods_info, 360)."', levelC : '".thumb($goods_info, 360)."', levelD : '".thumb($goods_info, 1280)."'}";
            $goods_image_mobile[] = thumb($goods_info, 360);
        }

        //藏品惠 藏品惠修改每人限购字段upper_limit内容改成 藏品惠总数限购 藏品惠商品做库存判断 xin 20151104
        if (!empty($goods_info['groupbuy_info'])) {
            $groupbuy_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['groupbuy_info']['upper_limit'] > 0){ //如果限购
                $groupbuy_shengyu = $goods_info['groupbuy_info']['upper_limit'] - $goods_info['groupbuy_info']['buy_quantity'];
                $groupbuy_storage = ($groupbuy_shengyu >= $groupbuy_storage)?$groupbuy_storage:$groupbuy_shengyu;
            }
            if($groupbuy_storage > 0){
                $goods_info['promotion_type'] = 'groupbuy';
                $goods_info['title'] = '藏品惠';
                $goods_info['remark'] = $goods_info['groupbuy_info']['remark'];
                $goods_info['promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['groupbuy_info']['groupbuy_price']);
                $goods_info['goods_storage'] = $groupbuy_storage;
                if($goods_info['groupbuy_info']['upper_limit'] > 0){
                    $goods_info['upper_limit'] = ($goods_info['groupbuy_info']['upper_limit'] > $groupbuy_storage)?$groupbuy_storage:$goods_info['groupbuy_info']['upper_limit'];
                }else{
                    $goods_info['upper_limit'] = $groupbuy_storage;
                }

            }

            unset($goods_info['groupbuy_info']);
        }

        //限时折扣
        if (!empty($goods_info['xianshi_info'])) {
            $goods_info['promotion_type'] = 'xianshi';
            $goods_info['title'] = $goods_info['xianshi_info']['xianshi_title'];
            $goods_info['remark'] = $goods_info['xianshi_info']['xianshi_title'];
            $goods_info['promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
            $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['xianshi_info']['xianshi_price']);
            $goods_info['lower_limit'] = $goods_info['xianshi_info']['lower_limit'];
            $goods_info['explain'] = $goods_info['xianshi_info']['xianshi_explain'];


            unset($goods_info['xianshi_info']);
        }

        // add 秒杀模块  xin
        //秒杀

        if (!empty($goods_info['miaosha_info'])) {
            //先判断秒杀数量，卖光后不调用秒杀 秒杀限制库存减去秒杀购买量
            $miaosha_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['miaosha_info']['max_quantity'] > 0){
                $shengyu_quantity = $goods_info['miaosha_info']['max_quantity'] - $goods_info['miaosha_info']['buy_quantity'];
                $miaosha_storage = ($shengyu_quantity >= $miaosha_storage)?$miaosha_storage:$shengyu_quantity;
            }

            //秒杀剩余库存大于0，可秒杀
            if($miaosha_storage > 0){
                $goods_info['promotion_type'] = 'miaosha';
                $goods_info['title'] = '限时秒杀';//$goods_info['xianshi_info']['xianshi_title'];
				if($goods_info['miaosha_info']['is_shipping'] == 1){ //检查秒杀是否包邮
					$goods_info['goods_freight'] = 0;//如果包邮将运费设置为0
					$goods_info['transport_id'] = 0;//如果包邮将运费模版id写成0
				}
                $goods_info['goods_storage'] = $miaosha_storage;//秒杀总库存
                if($goods_info['miaosha_info']['upper_limit'] > 0){
                    $goods_info['upper_limit'] = ($goods_info['miaosha_info']['upper_limit'] > $miaosha_storage)?$miaosha_storage:$goods_info['miaosha_info']['upper_limit']; //每人限购数量
                }else{
                    $goods_info['upper_limit'] = $miaosha_storage; //不限购取限量
                }
                $goods_info['promotion_price'] = $goods_info['miaosha_info']['miaosha_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['miaosha_info']['miaosha_price']);
            }

            unset($goods_info['miaosha_info']);
        }

		// 藏豆会员推荐模块  du
        if (!empty($goods_info['cangdoutuijian_info'])) {
			$tuijian_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['cangdoutuijian_info']['number'] > 0){
                $shengyu_t_quantity = $goods_info['cangdoutuijian_info']['number'] - $goods_info['cangdoutuijian_info']['buy_quantity'];
                $tuijian_storage = ($shengyu_t_quantity >= $tuijian_storage)?$tuijian_storage:$shengyu_t_quantity;
            }
			//剩余库存大于0
            if($tuijian_storage > 0){
				$goods_info['promotion_type'] = 'tuijianyouhui';
				$goods_info['title'] = '推荐优惠';
				$goods_info['promotion_price'] = $goods_info['cangdoutuijian_info']['price'];
				$goods_info['tuijian_storage'] = $tuijian_storage;
				if($goods_info['cangdoutuijian_info']['member_number'] > 0){
                    $goods_info['tuijian_limit'] = ($goods_info['cangdoutuijian_info']['member_number'] > $tuijian_storage)?$tuijian_storage:$goods_info['cangdoutuijian_info']['member_number']; //每人限购数量
                }else{
                    $goods_info['tuijian_limit'] = $tuijian_storage; //不限购取限量
                }
				$goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['cangdoutuijian_info']['price']);
				$goods_info['tuijian_number'] = $goods_info['cangdoutuijian_info']['number']-$goods_info['cangdoutuijian_info']['buy_quantity']; //剩余数量
			}
            unset($goods_info['cangdoutuijian_info']);
        }

        //add 会员特价  xin  20151130
        /*
        if (!empty($goods_info['vipsale_info'])) {
            //会员等级大于等于会员特价要求等级
            if(intval($_SESSION['level']) >= $goods_info['vipsale_info']['level']){
                //先判断数量，卖光后不调用 限制库存减去购买量
                $vipsale_storage = $goods_info['goods_storage'];//取商品库存

                if($goods_info['vipsale_info']['max_quantity'] > 0){
                    $shengyu_quantity = $goods_info['vipsale_info']['max_quantity'] - $goods_info['vipsale_info']['buy_quantity'];
                    $miaosha_storage = ($shengyu_quantity >= $vipsale_storage)?$vipsale_storage:$shengyu_quantity;
                }

                //剩余库存大于0
                if($miaosha_storage > 0){
                    $goods_info['promotion_type'] = 'vipsale';
                    $goods_info['title'] = '会员特价';
                    $goods_info['goods_storage'] = $miaosha_storage;//会员特价总库存
                    if($goods_info['vipsale_info']['upper_limit'] > 0){
                        $goods_info['upper_limit'] = ($goods_info['vipsale_info']['upper_limit'] > $miaosha_storage)?$miaosha_storage:$goods_info['vipsale_info']['upper_limit']; //每人限购数量
                    }else{
                        $goods_info['upper_limit'] = $miaosha_storage; //不限购取限量
                    }
                    $goods_info['promotion_price'] = $goods_info['vipsale_info']['vipsale_price'];
                    $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['vipsale_info']['vipsale_price']);
                }
            }
            unset($goods_info['vipsale_info']);
        }
        */
        // add end

        // 验证是否允许送赠品
        if ($this->checkGoodsIfAllowGift($goods_info)) {
            $gift_array = Model('goods_gift')->getGoodsGiftListByGoodsId($goods_id);
            if (!empty($gift_array)) {
                $goods_info['have_gift'] = 'gift';
            }
        }

        // 加入购物车按钮
        $goods_info['cart'] = true;
        //虚拟、F码、预售不显示加入购物车
        if ($goods_info['is_virtual'] == 1 || $goods_info['is_fcode'] == 1 || $goods_info['is_presell'] == 1) {
            $goods_info['cart'] = false;
        }

        // 立即购买文字显示
        $goods_info['buynow_text'] = '立即购买';
        if ($goods_info['is_presell'] == 1) {
            $goods_info['buynow_text'] = '预售购买';
        } elseif ($goods_info['is_fcode'] == 1) {
            $goods_info['buynow_text'] = 'F码购买';
        }

        //满即送 原版隐藏，不做规则判断
        //$mansong_info = ($goods_info['is_virtual'] == 1) ? array() : Model('p_mansong')->getMansongInfoByStoreID($goods_info['store_id']);

        //add 满送规则判定，规则统一在p_mansong模型中  xin 20151110
        $mansong_info = Model('p_mansong')->canMansongInfo($goods_id,$goods_info['store_id']);
		if($mansong_info){
			//$goods_info['promotion_type'] = 'mansong';
		}
        //add end

        // 商品受关注次数加1
        $goods_info['goods_click'] = intval($goods_info['goods_click']) + 1;
        if (C('cache_open')) {
            $this->_wGoodsCache($goods_id, array('goods_click' => $goods_info['goods_click']));
            wcache('updateRedisDate', array($goods_id => $goods_info['goods_click']), 'goodsClick');
        }
		$this->editGoodsById(array('goods_click' => array('exp', 'goods_click + 1')), $goods_id);
        $result = array();
        $result['goods_info'] = $goods_info;
        $result['spec_list'] = $spec_list;
        $result['spec_list_mobile'] = $spec_list_mobile;
        $result['spec_image'] = $spec_image;
        $result['goods_image'] = $goods_image;
        $result['goods_images'] = $image_more;
        $result['goods_image_mobile'] = $goods_image_mobile;
        $result['mansong_info'] = $mansong_info;
        $result['gift_array'] = $gift_array;
        return $result;
    }
	
	
	public function getMobileBodyByCommonID($goods_commonid, $fields = 'mobile_body') {
         $common_info =$this->_rGoodsCommonCache($goods_commonid, $fields);
         if (empty($common_info)) {
             $common_info =$this->getGoodeCommonInfo(array('goods_commonid'=>$goods_commonid));
            $this->_wGoodsCommonCache($goods_commonid, $common_info);
         }

                      
                    // 手机商品描述
         if ($common_info['mobile_body'] != ''){
             $mobile_body_array =unserialize($common_info['mobile_body']);
             if (is_array($mobile_body_array)){
                 $mobile_body = '';
                 foreach ($mobile_body_array as$val) {
                     switch ($val['type']) {
                        case 'text':
                            $mobile_body .='<div>' . $val['value'] . '</div>';
                            break;
                        case 'image':
                            $mobile_body .='<img src="' . $val['value'] . '">';
                            break;
                     }
                 }
                 $common_info['mobile_body'] =$mobile_body;
             }
         }
         return $common_info;
     }
	 
	/**
     * 生成唯一的商品货号
     *
     */
    public function generate_g_serial($goods_commonid=0) {
		$MaxGId = $this->table('goods')->field("(MAX(goods_commonid)+1) as goods_commonid")->find();
        $goods_commonid = intval($goods_commonid) > 0 ? $goods_commonid : $MaxGId['goods_commonid'];
		$g_serial = '96'. str_repeat('0', 6 - strlen($goods_commonid)) . $goods_commonid; //用96开头生成货号
		$sn_list = $this->table('goods')->field("goods_serial")->where(array('goods_serial'=>array('like',"%".$g_serial."%"),'goods_commonid'=>array('neq' => $goods_commonid)))->find();
		if (in_array($g_serial, $sn_list))
		{
			$max = pow(10, strlen($sn_list['goods_serial']) - strlen($g_serial) + 1) - 1;
			$new_sn = $g_serial . mt_rand(0, $max);
			while (in_array($new_sn, $sn_list))
			{
				$new_sn = $g_serial . mt_rand(0, $max);
			}
			$g_serial = $new_sn;
		}
		return $g_serial;
    }

	/**
     * 检查货号是否重复
     *
     */
	public function is_g_serial($g_serial,$common_id=0,$store_id=''){
		$condition['goods_serial'] = $g_serial;
		$condition['goods_commonid'] = array('neq',$common_id);
        $condition['store_id'] = $store_id;
		return $this->table('goods')->where($condition)->count();
	}
	
	/**
     * 插入关联商品
     */
	public function GuanLianGoods($insert){
		$result = $this->table('goods_link')->insert($insert);
	}

	/**
     * 编辑产品 记录
     */
	public function InsertSellerLog($insert){
		$result = $this->table('goods_log')->insert($insert);
	}

	/**
     * 编辑产品 库存记录
     */
	public function InsertStorageLog($insert){
		$result = $this->table('goods_storage_log')->insert($insert);
	}
	
	
	/**
     * 查询关联商品
     */
	public function GetGoodsLink($condition,$field="*"){
		$goods_link = $this->table('goods_link')->field($field)->where($condition)->select();
		if($goods_link){
			foreach($goods_link as $k=>$v){
				$goods_link[$k]['title'] = unserialize($v['title']);
				$goodsid_array = explode(',',$v['link_goods_id']);
				$goods_link[$k]['goods_list'] = Model('goods')->getGoodsList(array('goods_id' => array('in', $goodsid_array)), 'goods_id,goods_price,goods_image,goods_name');
			}
		}
		return $goods_link;
	}
	
	/**
     * 删除关联商品
     */
	public function deleteGoodsLink($condition){
		$this->table('goods_link')->where($condition)->delete();
	}
	
	/**
     * 类目调整
     *
     * @param array $update
     * @param array $condition
     * @return boolean
     */
    public function editProducesGoodsClassUp($update,$update2, $condition) {
        $return = $this->editProduces($condition, $update,$update2);
        if ($return) {
            return true;
        } else {
            return false;
        }
    }

	/**
     * 获取所有促销活动详情
     *
     */
	public function getChuXiao($goods_id){

		$goods_info = $this->getGoodsInfoAndPromotionById($goods_id);

		//藏品惠 藏品惠修改每人限购字段upper_limit内容改成 藏品惠总数限购 藏品惠商品做库存判断 xin 20151104
        if (!empty($goods_info['groupbuy_info'])) {
            $groupbuy_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['groupbuy_info']['upper_limit'] > 0){ //如果限购
                $groupbuy_shengyu = $goods_info['groupbuy_info']['upper_limit'] - $goods_info['groupbuy_info']['buy_quantity'];
                $groupbuy_storage = ($groupbuy_shengyu >= $groupbuy_storage)?$groupbuy_storage:$groupbuy_shengyu;
            }

            if($groupbuy_storage > 0){
                $goods_info['promotion_type'] = '藏品惠';
                $goods_info['title'] = '藏品惠';
                $goods_info['remark'] = $goods_info['groupbuy_info']['remark'];
                $goods_info['promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['groupbuy_info']['groupbuy_price']);
                $goods_info['goods_storage'] = $groupbuy_storage;
                if($goods_info['groupbuy_info']['upper_limit'] > 0){
                    $goods_info['upper_limit'] = ($goods_info['groupbuy_info']['upper_limit'] > $groupbuy_storage)?$groupbuy_storage:$goods_info['groupbuy_info']['upper_limit'];
                }else{
                    $goods_info['upper_limit'] = $groupbuy_storage;
                }

            }

            unset($goods_info['groupbuy_info']);
        }

        //限时折扣
        if (!empty($goods_info['xianshi_info'])) {
            $goods_info['promotion_type'] = '限时折扣';
            $goods_info['title'] = $goods_info['xianshi_info']['xianshi_title'];
            $goods_info['remark'] = $goods_info['xianshi_info']['xianshi_title'];
            $goods_info['promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
            $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['xianshi_info']['xianshi_price']);
            $goods_info['lower_limit'] = $goods_info['xianshi_info']['lower_limit'];
            $goods_info['explain'] = $goods_info['xianshi_info']['xianshi_explain'];
            unset($goods_info['xianshi_info']);
        }

        // add 秒杀模块  xin
        //秒杀

        if (!empty($goods_info['miaosha_info'])) {
            //先判断秒杀数量，卖光后不调用秒杀 秒杀限制库存减去秒杀购买量
            $miaosha_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['miaosha_info']['max_quantity'] > 0){
                $shengyu_quantity = $goods_info['miaosha_info']['max_quantity'] - $goods_info['miaosha_info']['buy_quantity'];
                $miaosha_storage = ($shengyu_quantity >= $miaosha_storage)?$miaosha_storage:$shengyu_quantity;
            }

            //秒杀剩余库存大于0，可秒杀
            if($miaosha_storage > 0){
                $goods_info['promotion_type'] = '限时秒杀';
                $goods_info['title'] = '限时秒杀';//$goods_info['xianshi_info']['xianshi_title'];
				if($goods_info['miaosha_info']['is_shipping'] == 1){ //检查秒杀是否包邮
					$goods_info['goods_freight'] = 0;//如果包邮将运费设置为0
					$goods_info['transport_id'] = 0;//如果包邮将运费模版id写成0
				}
                $goods_info['goods_storage'] = $miaosha_storage;//秒杀总库存
                if($goods_info['miaosha_info']['upper_limit'] > 0){
                    $goods_info['upper_limit'] = ($goods_info['miaosha_info']['upper_limit'] > $miaosha_storage)?$miaosha_storage:$goods_info['miaosha_info']['upper_limit']; //每人限购数量
                }else{
                    $goods_info['upper_limit'] = $miaosha_storage; //不限购取限量
                }
                $goods_info['promotion_price'] = $goods_info['miaosha_info']['miaosha_price'];
                $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['miaosha_info']['miaosha_price']);
            }

            unset($goods_info['miaosha_info']);
        }

		// 藏豆会员推荐模块  du
        if (!empty($goods_info['cangdoutuijian_info'])) {
			$tuijian_storage = $goods_info['goods_storage'];//取商品库存
            if($goods_info['cangdoutuijian_info']['number'] > 0){
                $shengyu_t_quantity = $goods_info['cangdoutuijian_info']['number'] - $goods_info['cangdoutuijian_info']['buy_quantity'];
                $tuijian_storage = ($shengyu_t_quantity >= $tuijian_storage)?$tuijian_storage:$shengyu_t_quantity;
            }
			//剩余库存大于0
            if($tuijian_storage > 0){
				$goods_info['promotion_type'] = '推荐优惠';
				$goods_info['title'] = '推荐优惠';
				$goods_info['promotion_price'] = $goods_info['cangdoutuijian_info']['price'];
				$goods_info['tuijian_storage'] = $tuijian_storage;
				if($goods_info['cangdoutuijian_info']['member_number'] > 0){
                    $goods_info['tuijian_limit'] = ($goods_info['cangdoutuijian_info']['member_number'] > $tuijian_storage)?$tuijian_storage:$goods_info['cangdoutuijian_info']['member_number']; //每人限购数量
                }else{
                    $goods_info['tuijian_limit'] = $tuijian_storage; //不限购取限量
                }
				$goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['cangdoutuijian_info']['price']);
				$goods_info['tuijian_number'] = $goods_info['cangdoutuijian_info']['number']-$goods_info['cangdoutuijian_info']['buy_quantity']; //剩余数量
			}
            unset($goods_info['cangdoutuijian_info']);
        }

        //add 会员特价  xin  20151130
        /*
        if (!empty($goods_info['vipsale_info'])) {
            //会员等级大于等于会员特价要求等级
            if(intval($_SESSION['level']) >= $goods_info['vipsale_info']['level']){
                //先判断数量，卖光后不调用 限制库存减去购买量
                $vipsale_storage = $goods_info['goods_storage'];//取商品库存

                if($goods_info['vipsale_info']['max_quantity'] > 0){
                    $shengyu_quantity = $goods_info['vipsale_info']['max_quantity'] - $goods_info['vipsale_info']['buy_quantity'];
                    $miaosha_storage = ($shengyu_quantity >= $vipsale_storage)?$vipsale_storage:$shengyu_quantity;
                }

                //剩余库存大于0
                if($miaosha_storage > 0){
                    $goods_info['promotion_type'] = 'vipsale';
                    $goods_info['title'] = '会员特价';
                    $goods_info['goods_storage'] = $miaosha_storage;//会员特价总库存
                    if($goods_info['vipsale_info']['upper_limit'] > 0){
                        $goods_info['upper_limit'] = ($goods_info['vipsale_info']['upper_limit'] > $miaosha_storage)?$miaosha_storage:$goods_info['vipsale_info']['upper_limit']; //每人限购数量
                    }else{
                        $goods_info['upper_limit'] = $miaosha_storage; //不限购取限量
                    }
                    $goods_info['promotion_price'] = $goods_info['vipsale_info']['vipsale_price'];
                    $goods_info['down_price'] = ncPriceFormat($goods_info['goods_price'] - $goods_info['vipsale_info']['vipsale_price']);
                }
            }
            unset($goods_info['vipsale_info']);
        }
        */
        // add end
		return $goods_info;
	}
}
