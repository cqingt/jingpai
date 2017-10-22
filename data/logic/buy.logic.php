<?php
/**
 * 购买行为
 *
 *
 *
 *
 * by abc  www.abc.com 开发
 */
defined('InShopNC') or exit('Access Invalid!');
class buyLogic {

    /**
     * 会员信息
     * @var array
     */
    private $_member_info = array();

    /**
     * 下单数据
     * @var array
     */
    private $_order_data = array();

    /**
     * 表单数据
     * @var array
     */
    private $_post_data = array();

    /**
     * buy_1.logic 对象
     * @var obj
     */
    private $_logic_buy_1;

    public function __construct() {
        $this->_logic_buy_1 = Logic('buy_1');
    }

    /**
     * 购买第一步
     * @param unknown $cart_id
     * @param unknown $ifcart
     * @param unknown $member_id
     * @param unknown $store_id
     * @return Ambigous <multitype:unknown, multitype:unknown >
     */
    public function buyStep1($cart_id, $ifcart, $member_id, $store_id) {

        //得到购买商品信息
        if ($ifcart) {
            $result = $this->getCartList($cart_id, $member_id);
        } else {
            $result = $this->getGoodsList($cart_id, $member_id, $store_id);
        }

        if(!$result['state']) {
            return $result;
        }

        //得到页面所需要数据：收货地址、发票、代金券、预存款、商品列表等信息
        $result = $this->getBuyStep1Data($member_id,$result['data']);
        return $result;
    }

    /**
     * 第一步：处理购物车
     *
     * @param array $cart_id 购物车
     * @param int $member_id 会员编号
     */
    public function getCartList($cart_id, $member_id) {
        $model_cart = Model('cart');

        //取得POST ID和购买数量
        $buy_items = $this->_parseItems($cart_id);
        if (empty($buy_items)) {
            return callback(false, '所购商品无效');
        }

        if (count($buy_items) > 50) {
            return callback(false, '一次最多只可购买50种商品');
        }

        //购物车列表
        $condition = array('cart_id'=>array('in',array_keys($buy_items)), 'buyer_id'=>$member_id);
        $cart_list	= $model_cart->listCart('db', $condition);

        //购物车列表 [得到最新商品属性及促销信息]
        $cart_list = $this->_logic_buy_1->getGoodsCartList($cart_list);

        //商品列表 [优惠套装子商品与普通商品同级罗列]
        $goods_list = $this->_getGoodsList($cart_list);

        //以店铺下标归类
        $store_cart_list = $this->_getStoreCartList($cart_list);

        return callback(true, '', array('goods_list' => $goods_list, 'store_cart_list' => $store_cart_list));

    }

    /**
     * 第一步：处理立即购买
     *
     * @param array $cart_id 购物车
     * @param int $member_id 会员编号
     * @param int $store_id 店铺编号
     */
    public function getGoodsList($cart_id, $member_id, $store_id) {

        //取得POST ID和购买数量
        $buy_items = $this->_parseItems($cart_id);
        if (empty($buy_items)) {
            return callback(false, '所购商品无效');
        }

        $goods_id = key($buy_items);
        $quantity = current($buy_items);

        //商品信息[得到最新商品属性及促销信息]
        $goods_info = $this->_logic_buy_1->getGoodsOnlineInfo($goods_id,intval($quantity));
		
        if(empty($goods_info)) {
            return callback(false, '商品已下架或不存在');
        }

        //不能购买自己店铺的商品
        if ($goods_info['store_id'] == $store_id) {
            return callback(false, '不能购买自己店铺的商品');
        }

        //进一步处理数组
        $store_cart_list = array();
        $goods_list = array();
        $goods_list[0] = $store_cart_list[$goods_info['store_id']][0] = $goods_info;

        return callback(true, '', array('goods_list' => $goods_list, 'store_cart_list' => $store_cart_list));
    }

    /**
     * 购买第一步：返回商品、促销、地址、发票等信息，然后交前台抛出
     * @param unknown $member_id
     * @param unknown $data 商品信息
     * @return
     */
    public function getBuyStep1Data($member_id, $data) {
        list($goods_list,$store_cart_list) = $data;
        $goods_list = $data['goods_list'];
        $store_cart_list = $data['store_cart_list'];


        //定义返回数组
        $result = array();

        /* Add is name lt 2016-04-27 查看商品是否存在秒杀或者团购商品 */

        foreach ($data['goods_list'] as $k => $v) {

            if(!empty($v['miaosha_info'])){
                $miaosha_type = true;
                $result['miaosha_type'] = true;
                break;
            }elseif(!empty($v['groupbuy_info'])){
                $groupbuy_type = true;
                $result['groupbuy_type'] = true;
                break;
            }

        }

        //检测手机站是否有秒杀或者团购产品

        foreach ($data['store_cart_list'] as $key => $val) {

            foreach ($val as $k => $v) {
                if(!empty($v['miaosha_info'])){
                    $result['miaosha_type'] = true;
                    break;
                }elseif(!empty($v['groupbuy_info'])){
                    $result['groupbuy_type'] = true;
                    break;
                }
            }
            

        }



        /* End */

        //商品金额计算(分别对每个商品/优惠套装小计、每个店铺小计)
        list($store_cart_list,$store_goods_total,$store_mansong_total) = $this->_logic_buy_1->calcCartList($store_cart_list);
        $result['store_cart_list'] = $store_cart_list;
        $result['store_goods_total'] = $store_goods_total;

        //取得店铺优惠 - 满即送(赠品列表，店铺满送规则列表)
        list($store_premiums_list,$store_mansong_rule_list) = $this->_logic_buy_1->getMansongRuleCartListByTotal($store_mansong_total);
        $result['store_premiums_list'] = $store_premiums_list;
        $result['store_mansong_rule_list'] = $store_mansong_rule_list;

        //重新计算优惠后(满即送)的店铺实际商品总金额
        $store_goods_total = $this->_logic_buy_1->reCalcGoodsTotal($store_goods_total,$store_mansong_rule_list,'mansong');


        /* Add is name lt 2016-04-27 订单中存在秒杀或者团购商品则不能使用优惠券 */

        if(empty($miaosha_type) && empty($groupbuy_type)){


        //返回店铺可用的代金券
        $store_voucher_list = $this->_logic_buy_1->getStoreAvailableVoucherList($store_goods_total, $member_id);
        /*2015-11-10 Save is name LT*/
        $result['store_voucher_list'] = Model('voucher')->is_not_dai($store_cart_list,$store_voucher_list);
        // $result['store_voucher_list'] = $store_voucher_list;

        //返回可用的平台优惠券 20160330 xin
        $result['pingtai_voucher_list'] = Model('store_voucher')->getPingtaiAvailableVoucherList($member_id,$store_cart_list,$store_goods_total);

        }

        /* End */

        //返回需要计算运费的店铺ID数组 和 不需要计算运费(满免运费活动的)店铺ID及描述
        list($need_calc_sid_list,$cancel_calc_sid_list) = $this->_logic_buy_1->getStoreFreightDescList($store_goods_total);
        $result['need_calc_sid_list'] = $need_calc_sid_list;
        $result['cancel_calc_sid_list'] = $cancel_calc_sid_list;

        //将商品ID、数量、运费模板、运费序列化，加密，输出到模板，选择地区AJAX计算运费时作为参数使用
        $freight_list = $this->_logic_buy_1->getStoreFreightList($goods_list,array_keys($cancel_calc_sid_list));
		
        $result['freight_list'] = $this->buyEncrypt($freight_list, $member_id);

        //输出用户默认收货地址
        $result['address_info'] = Model('address')->getDefaultAddressInfo(array('member_id'=>$member_id));

        //输出有货到付款时，在线支付和货到付款及每种支付下商品数量和详细列表
        list($pay_goods_list,$store_pay_type_list) = $this->_logic_buy_1->getOfflineGoodsPay($goods_list);
        if (!empty($pay_goods_list['offline'])) {
            $result['pay_goods_list'] = $pay_goods_list;
            $result['ifshow_offpay'] = true;
            $result['pay_fee'] = $store_pay_type_list['pay_fee'];

            if(!empty($miaosha_type) || !empty($groupbuy_type)){

                $result['deny_edit_payment'] = true;
                
            }
        } else {
            //如果所购商品只支持线上支付，支付方式不允许修改
            $result['deny_edit_payment'] = true;
        }

        //发票 :只有所有商品都支持增值税发票才提供增值税发票
        foreach ($goods_list as $goods) {
        	if (!intval($goods['goods_vat'])) {
        	    $vat_deny = true;break;
        	}
        }
        //不提供增值税发票时抛出true(模板使用)
        $result['vat_deny'] = $vat_deny;
        $result['vat_hash'] = $this->buyEncrypt($result['vat_deny'] ? 'deny_vat' : 'allow_vat', $member_id);

        //输出默认使用的发票信息
        $inv_info = Model('invoice')->getDefaultInvInfo(array('member_id'=>$member_id));
        if ($inv_info['inv_state'] == '2' && !$vat_deny) {
            $inv_info['content'] = '增值税发票 '.$inv_info['inv_company'].' '.$inv_info['inv_code'].' '.$inv_info['inv_reg_addr'];
        } elseif ($inv_info['inv_state'] == '2' && $vat_deny) {
            $inv_info = array();
            $inv_info['content'] = '不需要发票';
        } elseif (!empty($inv_info)) {
            $inv_info['content'] = '普通发票 '.$inv_info['inv_title'].' '.$inv_info['inv_content'];
        } else {
            $inv_info = array();
            $inv_info['content'] = '不需要发票';
        }
        $result['inv_info'] = $inv_info;

        $buyer_info	= Model('member')->getMemberInfoByID($member_id);

        if (floatval($buyer_info['available_predeposit']) > 0) {
            $result['available_predeposit'] = $buyer_info['available_predeposit'];
        }
        if (floatval($buyer_info['available_rc_balance']) > 0) {
            $result['available_rc_balance'] = $buyer_info['available_rc_balance'];
        }
        $result['member_paypwd'] = $buyer_info['member_paypwd'] ? true : false;

        return callback(true,'',$result);
    }

    /**
     * 购买第二步
     * @param array $post
     * @param int $member_id
     * @param string $member_name
     * @param string $member_email
     * @return array
     */
    public function buyStep2($post, $member_id, $member_name, $member_email) {
        
        $this->_member_info['member_id'] = $member_id;
        $this->_member_info['member_name'] = $member_name;
        $this->_member_info['member_email'] = $member_email;
        $this->_post_data = $post;

        try {

            $model = Model('order');
            $model->beginTransaction();

            //第1步 表单验证
            $this->_createOrderStep1();
    
            //第2步 得到购买商品信息
            $this->_createOrderStep2();
    
            //第3步 得到购买相关金额计算等信息
            $this->_createOrderStep3();
    
            //第4步 生成订单
            $this->_createOrderStep4();

            //第5步 处理预存款
            $this->_createOrderStep5();
            $model->commit();

            //第6步 订单后续处理
            $this->_createOrderStep6();

            return callback(true,'',$this->_order_data);

        }catch (Exception $e){
            $model->rollback();
            return callback(false, $e->getMessage());
        }

    }

    /**
     * 删除购物车商品
     * @param unknown $ifcart
     * @param unknown $cart_ids
     */
    public function delCart($ifcart, $member_id, $cart_ids) {
        if (!$ifcart || !is_array($cart_ids)) return;
        $cart_id_str = implode(',',$cart_ids);
        if (preg_match('/^[\d,]+$/',$cart_id_str)) {
            QueueClient::push('delCart', array('buyer_id'=>$member_id,'cart_ids'=>$cart_ids));
        }
    }
    
    /**
     * 选择不同地区时，异步处理并返回每个店铺总运费以及本地区是否能使用货到付款
     * 如果店铺统一设置了满免运费规则，则运费模板无效
     * 如果店铺未设置满免规则，且使用运费模板，按运费模板计算，如果其中有商品使用相同的运费模板，则两种商品数量相加后再应用该运费模板计算（即作为一种商品算运费）
     * 如果未找到运费模板，按免运费处理
     * 如果没有使用运费模板，商品运费按快递价格计算，运费不随购买数量增加
     */
    public function changeAddr($freight_hash, $city_id, $area_id, $member_id) {
        //$city_id计算运费模板,$area_id计算货到付款
        $city_id = intval($city_id);
        $area_id = intval($area_id);
        if ($city_id <= 0 || $area_id <= 0) return null;
    
        //将hash解密，得到运费信息(店铺ID，运费,运费模板ID,购买数量),hash内容有效期为1小时
        $freight_list = $this->buyDecrypt($freight_hash, $member_id);
    
        //算运费
        $store_freight_list = $this->_logic_buy_1->calcStoreFreight($freight_list, $city_id);
        $data = array();
        $data['state'] = empty($store_freight_list) ? 'fail' : 'success';
        $data['content'] = $store_freight_list;
    
        //是否能使用货到付款(只有包含平台店铺的商品才会判断)
        //$if_include_platform_store = array_key_exists(DEFAULT_PLATFORM_STORE_ID,$freight_list['iscalced']) || array_key_exists(DEFAULT_PLATFORM_STORE_ID,$freight_list['nocalced']);
    
        //$offline_store_id_array = Model('store')->getOwnShopIds();
        $order_platform_store_ids = array();
    
        if (is_array($freight_list['iscalced']))
        foreach (array_keys($freight_list['iscalced']) as $k)
        //if (in_array($k, $offline_store_id_array))
            $order_platform_store_ids[$k] = null;
    
        if (is_array($freight_list['nocalced']))
        foreach (array_keys($freight_list['nocalced']) as $k)
        //if (in_array($k, $offline_store_id_array))
            $order_platform_store_ids[$k] = null;
    
        //if ($order_platform_store_ids) {
            $allow_offpay_batch = Model('offpay_area')->checkSupportOffpayBatch($area_id, array_keys($order_platform_store_ids));
    /*
            //JS验证使用
            $data['allow_offpay'] = array_filter($allow_offpay_batch) ? '1' : '0';
            $data['allow_offpay_batch'] = $allow_offpay_batch;
        } else {*/
            //JS验证使用
            $data['allow_offpay'] = array_filter($allow_offpay_batch) ? '1' : '0';
            $data['allow_offpay_batch'] = $allow_offpay_batch;
        //}

        //PHP验证使用
        $data['offpay_hash'] = $this->buyEncrypt($data['allow_offpay'] ? 'allow_offpay' : 'deny_offpay', $member_id);
        $data['offpay_hash_batch'] = $this->buyEncrypt($data['allow_offpay_batch'], $member_id);

        return $data;
    }
    
    /**
     * 验证F码
     * @param int $goods_commonid
     * @param string $fcode
     * @return array
     */
    public function checkFcode($goods_commonid, $fcode) {
        $fcode_info = Model('goods_fcode')->getGoodsFCode(array('goods_commonid' => $goods_commonid,'fc_code' => $fcode,'fc_state' => 0));
        if ($fcode_info) {
            return callback(true,'',$fcode_info);
        } else {
            return callback(false,'F码错误');
        }
    }

    /**
     * 订单生成前的表单验证与处理
     *
     */
    private function _createOrderStep1() {
        $post = $this->_post_data;

        //取得商品ID和购买数量
        $input_buy_items = $this->_parseItems($post['cart_id']);
        if (empty($input_buy_items)) {
            throw new Exception('所购商品无效');
        }

        //验证收货地址
        $input_address_id = intval($post['address_id']);
        if ($input_address_id <= 0) {
            throw new Exception('请选择收货地址');
        } else {
            $input_address_info = Model('address')->getAddressInfo(array('address_id'=>$input_address_id));
            if ($input_address_info['member_id'] != $this->_member_info['member_id']) {
                throw new Exception('请选择收货地址');
            }
        }

        //收货地址城市编号
        $input_city_id = intval($input_address_info['city_id']);

        //是否开增值税发票
        $input_if_vat = $this->buyDecrypt($post['vat_hash'], $this->_member_info['member_id']);
        if (!in_array($input_if_vat,array('allow_vat','deny_vat'))) {
            throw new Exception('订单保存出现异常[值税发票出现错误]，请重试');
        }
        $input_if_vat = ($input_if_vat == 'allow_vat') ? true : false;

        //是否支持货到付款
        $input_if_offpay = $this->buyDecrypt($post['offpay_hash'], $this->_member_info['member_id']);
        if (!in_array($input_if_offpay,array('allow_offpay','deny_offpay'))) {
            throw new Exception('订单保存出现异常[货到付款验证错误]，请重试');
        }
        $input_if_offpay = ($input_if_offpay == 'allow_offpay') ? true : false;

        // 是否支持货到付款 具体到各个店铺
        $input_if_offpay_batch = $this->buyDecrypt($post['offpay_hash_batch'], $this->_member_info['member_id']);
        if (!is_array($input_if_offpay_batch)) {
            throw new Exception('订单保存出现异常[部分店铺付款方式出现异常]，请重试');
        }

        //付款方式:在线支付/货到付款(online/offline) 增加bank银行转账 20151119 xin
        if (!in_array($post['pay_name'],array('online','offline','bank'))) {
            throw new Exception('付款方式错误，请重新选择');
        }
        $input_pay_name = $post['pay_name'];

        //验证发票信息
        if (!empty($post['invoice_id'])) {
            $input_invoice_id = intval($post['invoice_id']);
            if ($input_invoice_id > 0) {
                $input_invoice_info = Model('invoice')->getinvInfo(array('inv_id'=>$input_invoice_id));
                if ($input_invoice_info['member_id'] != $this->_member_info['member_id']) {
                    throw new Exception('请正确填写发票信息');
                }
            }
        }

        //验证店铺优惠券
        $input_voucher_list = array();
        if (!empty($post['voucher']) && is_array($post['voucher'])) {
            foreach ($post['voucher'] as $store_id => $voucher) {
                if (preg_match_all('/^(\d+)\|(\d+)\|([\d.]+)$/',$voucher,$matchs)) {
                    if (floatval($matchs[3][0]) > 0) {
                        $input_voucher_list[$store_id]['voucher_t_id'] = $matchs[1][0];
                        $input_voucher_list[$store_id]['voucher_price'] = $matchs[3][0];
                    }
                }
            }
        }

        //验证平台优惠券 add xin 20160331  店铺优惠券不为空的话，平台优惠券制空
        $input_pingtai_voucher = array();
        if (!empty($post['voucher_pingtai']) && empty($input_voucher_list)) {

            if (preg_match_all('/^(\d+)\|(\d+)\|([\d.]+)$/',$post['voucher_pingtai'],$matchs)) {
                if (floatval($matchs[3][0]) > 0) {
                    $input_pingtai_voucher['voucher_id'] = $matchs[1][0];
                    $input_pingtai_voucher['voucher_price'] = $matchs[3][0];
                }
            }
        }

        //保存数据
        $this->_order_data['input_buy_items'] = $input_buy_items;
        $this->_order_data['input_city_id'] = $input_city_id;
        $this->_order_data['input_pay_name'] = $input_pay_name;
        $this->_order_data['input_if_offpay'] = $input_if_offpay;
        $this->_order_data['input_if_offpay_batch'] = $input_if_offpay_batch;
        $this->_order_data['input_pay_message'] = $post['pay_message'];
        $this->_order_data['input_address_info'] = $input_address_info;
        $this->_order_data['input_invoice_info'] = $input_invoice_info;
        $this->_order_data['input_voucher_list'] = $input_voucher_list;
        $this->_order_data['input_pingtai_voucher'] = $input_pingtai_voucher;
        $this->_order_data['order_from'] = $post['order_from'] == 2 ? 2 : 1;

    }

    /**
     * 得到购买商品信息
     *
     */
    private function _createOrderStep2() {
        $post = $this->_post_data;
        $input_buy_items = $this->_order_data['input_buy_items'];

        if ($post['ifcart']) {
            //购物车列表
            $model_cart = Model('cart');
            $condition = array('cart_id'=>array('in',array_keys($input_buy_items)),'buyer_id'=>$this->_member_info['member_id']);
            $cart_list	= $model_cart->listCart('db',$condition);

            //购物车列表 [得到最新商品属性及促销信息]
            $cart_list = $this->_logic_buy_1->getGoodsCartList($cart_list);

            //商品列表 [优惠套装子商品与普通商品同级罗列]
            $goods_list = $this->_getGoodsList($cart_list);

            //以店铺下标归类
            $store_cart_list = $this->_getStoreCartList($cart_list);
        } else {

            //来源于直接购买
            $goods_id = key($input_buy_items);
            $quantity = current($input_buy_items);

            //商品信息[得到最新商品属性及促销信息]
            $goods_info = $this->_logic_buy_1->getGoodsOnlineInfo($goods_id,intval($quantity));
            if(empty($goods_info)) {
                throw new Exception('商品已下架或不存在');
            }

            //进一步处理数组
            $store_cart_list = array();
            $goods_list = array();
            $goods_list[0] = $store_cart_list[$goods_info['store_id']][0] = $goods_info;

        }

        //F码验证
        $fc_id = $this->_checkFcode($goods_list, $post['fcode']);
        if(!$fc_id) {
            throw new Exception('F码商品验证错误');
        }
        //保存数据
        $this->_order_data['goods_list'] = $goods_list;
        $this->_order_data['store_cart_list'] = $store_cart_list;
        if ($fc_id > 0) {
            $this->_order_data['fc_id'] = $fc_id;
        }

    }

    /**
     * 得到购买相关金额计算等信息
     *
     */
    private function _createOrderStep3() {
        $goods_list = $this->_order_data['goods_list'];
        $store_cart_list = $this->_order_data['store_cart_list'];
        $input_voucher_list = $this->_order_data['input_voucher_list'];
        $input_city_id = $this->_order_data['input_city_id'];
        $input_pingtai_voucher = $this->_order_data['input_pingtai_voucher'];

        //商品金额计算(分别对每个商品/优惠套装小计、每个店铺小计)
        list($store_cart_list,$store_goods_total,$store_mansong_total) = $this->_logic_buy_1->calcCartList($store_cart_list);

        //取得店铺优惠 - 满即送(赠品列表，店铺满送规则列表)
        list($store_premiums_list,$store_mansong_rule_list) = $this->_logic_buy_1->getMansongRuleCartListByTotal($store_mansong_total);

        //重新计算店铺扣除满即送后商品实际支付金额
        $store_final_goods_total = $this->_logic_buy_1->reCalcGoodsTotal($store_goods_total,$store_mansong_rule_list,'mansong');

        //得到有效的代金券
        $input_voucher_list = $this->_logic_buy_1->reParseVoucherList($input_voucher_list,$store_goods_total,$this->_member_info['member_id']);


        //得到有效的平台优惠券 20160331 xin
        if(empty($input_voucher_list)){
            //如果店铺优惠券为空，再计算平台优惠券
            $input_pingtai_voucher = Model('store_voucher')->rePingtaiAvailableVoucher($this->_member_info['member_id'],$input_pingtai_voucher,$store_cart_list,$store_goods_total);
        }



        //重新计算店铺扣除优惠券送商品实际支付金额
        $store_final_goods_total = $this->_logic_buy_1->reCalcGoodsTotal($store_final_goods_total,$input_voucher_list,'voucher');



        //计算每个店铺(所有店铺级优惠活动)总共优惠多少
        $store_promotion_total = $this->_logic_buy_1->getStorePromotionTotal($store_goods_total, $store_final_goods_total);

        //重新计算扣除平台优惠券后实际支付金额  xin 20160331
        //因为平台优惠券可能只针对店铺某个商品做优惠，所以不按照系统的订单优惠比例给商品分配优惠金额
        $store_final_goods_total = $this->_logic_buy_1->reCalcGoodsTotal($store_final_goods_total,$input_pingtai_voucher,'pingtai_voucher');


        //计算每个店铺运费
        list($need_calc_sid_list,$cancel_calc_sid_list) = $this->_logic_buy_1->getStoreFreightDescList($store_final_goods_total);
        $freight_list = $this->_logic_buy_1->getStoreFreightList($goods_list,array_keys($cancel_calc_sid_list));
        $store_freight_total = $this->_logic_buy_1->calcStoreFreight($freight_list,$input_city_id);

        //计算店铺最终订单实际支付金额(加上运费)
        $store_final_order_total = $this->_logic_buy_1->reCalcGoodsTotal($store_final_goods_total,$store_freight_total,'freight');//修改取计算平台优惠券后的实际商品总额 xin 20160401
        //$store_final_order_total = $this->_logic_buy_1->reCalcGoodsTotal($store_final_goods_total_has_pingtai_voucher,$store_freight_total,'freight');


        //计算店铺分类佣金[改由任务计划]
		//zmr>>>
        $store_gc_id_commis_rate_list = Model('store_bind_class')->getStoreGcidCommisRateList($goods_list);
        //zmr<<<
        //将赠品追加到购买列表(如果库存0，则不送赠品)
        $append_premiums_to_cart_list = $this->_logic_buy_1->appendPremiumsToCartList($store_cart_list,$store_premiums_list,$store_mansong_rule_list,$this->_member_info['member_id']);
        if($append_premiums_to_cart_list === false) {
            throw new Exception('抱歉，您购买的商品库存不足，请重购买');
        } else {
            list($store_cart_list,$goods_buy_quantity,$store_mansong_rule_list) = $append_premiums_to_cart_list;
        }

        //保存数据
        $this->_order_data['store_goods_total'] = $store_goods_total;
        $this->_order_data['store_final_order_total'] = $store_final_order_total;
        $this->_order_data['store_freight_total'] = $store_freight_total;
        $this->_order_data['store_promotion_total'] = $store_promotion_total;
		//zmr>>>
        $this->_order_data['store_gc_id_commis_rate_list'] = $store_gc_id_commis_rate_list;
		//zmr<<<
        $this->_order_data['store_mansong_rule_list'] = $store_mansong_rule_list;
        $this->_order_data['store_cart_list'] = $store_cart_list;
        $this->_order_data['goods_buy_quantity'] = $goods_buy_quantity;
        $this->_order_data['input_voucher_list'] = $input_voucher_list;
        $this->_order_data['input_pingtai_voucher'] = $input_pingtai_voucher;
    }

    /**
     * 生成订单
     * @param array $input
     * @throws Exception
     * @return array array(支付单sn,订单列表)
     */
    private function _createOrderStep4() {

        extract($this->_order_data);


        $member_id = $this->_member_info['member_id'];
        $member_name = $this->_member_info['member_name'];
        $member_email = $this->_member_info['member_email'];

        $model_order = Model('order');

        //存储生成的订单数据
        $order_list = array();
        //存储通知信息
        $notice_list = array();

        //add xin 20160121 购物车无商品跳出
        if(empty($store_cart_list) || !is_array($store_cart_list)){
            throw new Exception('购物车无商品');
        }

        //每个店铺订单是货到付款还是线上支付,店铺ID=>付款方式[在线支付/货到付款]
        //修改货到付款 xin 20151119

        if($input_pay_name == 'offline'){ //如果是线下支付，走修改流程,否则走原版流程
            list($pay_goods_list,$store_pay_type_list) = $this->_logic_buy_1->getOfflineGoodsPay($goods_list);
        }else{
            $store_pay_type_list    = $this->_logic_buy_1->getStorePayTypeList($store_cart_list, $input_if_offpay, $input_pay_name);
        }

        $pay_fee = $store_pay_type_list['pay_fee'];//货到付款手续费
        $pay_sn = $this->_logic_buy_1->makePaySn($member_id);
        $order_pay = array();
        $order_pay['pay_sn'] = $pay_sn;
        $order_pay['buyer_id'] = $member_id;
        $order_pay_id = $model_order->addOrderPay($order_pay);
        if (!$order_pay_id) {
            throw new Exception('订单保存失败[未生成支付单]');
        }
    
        //收货人信息
        list($reciver_info,$reciver_name) = $this->_logic_buy_1->getReciverAddr($input_address_info);

        $huikuan_code = '';//如果是银行转账，设置汇款识别码，xin  20160330

        foreach ($store_cart_list as $store_id => $goods_list) {
    
            //取得本店优惠额度(后面用来计算每件商品实际支付金额，结算需要)
            $promotion_total = !empty($store_promotion_total[$store_id]) ? $store_promotion_total[$store_id] : 0;
            //本店总的优惠比例,保留3位小数
            $should_goods_total = $store_final_order_total[$store_id]-$store_freight_total[$store_id]+$promotion_total + $input_pingtai_voucher['store_total'][$store_id]['use_voucher_money'];
            $promotion_rate = abs(number_format($promotion_total/$should_goods_total,5));
            if ($promotion_rate <= 1) {
                $promotion_rate = floatval(substr($promotion_rate,0,5));
            } else {
                $promotion_rate = 0;
            }
    
            //每种商品的优惠金额累加保存入 $promotion_sum
            $promotion_sum = 0;
    
            $order = array();
            $order_common = array();
            $order_goods = array();
    
            $order['order_sn'] = $this->_logic_buy_1->makeOrderSn($order_pay_id);
            $order['pay_sn'] = $pay_sn;
            $order['store_id'] = $store_id;
            $order['store_name'] = $goods_list[0]['store_name'];
            $order['buyer_id'] = $member_id;
            $order['buyer_name'] = $member_name;
            $order['buyer_email'] = $member_email;
            $order['add_time'] = TIMESTAMP;
            $order['payment_code'] = $store_pay_type_list[$store_id];
            $order['order_state'] = ($store_pay_type_list[$store_id] == 'online' || $store_pay_type_list[$store_id] == 'bank') ? ORDER_STATE_NEW : ORDER_STATE_PAY;
            $order['order_amount'] = $store_final_order_total[$store_id]+intval($pay_fee[$store_id]);
            $order['shipping_fee'] = $store_freight_total[$store_id];
            $order['pay_fee'] = intval($pay_fee[$store_id]);
            $order['goods_amount'] = $order['order_amount'] - $order['shipping_fee'];
            $order['order_from'] = $order_from;
			$order['zrm_id'] = intval($_SESSION['tjid']);
			//中山小修改货到付款bug>>>
			if( $order['payment_code']=="")
			{
				$order['payment_code']="offline";
			}
			//中山小修改货到付款bug<<<
            $order_id = $model_order->addOrder($order);
            if (!$order_id) {
                throw new Exception('订单保存失败[未生成订单数据]');
            }

            //判定是否银行转账付款 xin 20160330
            if($store_pay_type_list[$store_id] == 'bank'){
                $huikuan_code = ($huikuan_code != "")?$huikuan_code:$order_id;
                $model_order->editOrder(array('huikuan_code'=>$huikuan_code),array('order_id'=>$order_id));
                //添加日志
                $data_log = array();
                $data_log['order_id'] = $order_id;
                $data_log['log_role'] = 'system';
                $data_log['log_user'] = '系统';
                $data_log['log_msg'] = '银行汇款识别码：'.$huikuan_code;
                $model_order->addOrderLog($data_log);
            }

            $order['order_id'] = $order_id;
            $order_list[$order_id] = $order;
    
            $order_common['order_id'] = $order_id;
            $order_common['store_id'] = $store_id;
            $order_common['order_message'] = $input_pay_message[$store_id];
    
            //代金券
            if (isset($input_voucher_list[$store_id])){
                $order_common['voucher_price'] = $input_voucher_list[$store_id]['voucher_price'];
                $order_common['voucher_code'] = $input_voucher_list[$store_id]['voucher_code'];
            }

            //平台优惠券存入common表 xin 20160331
            if (isset($input_pingtai_voucher['store_total'][$store_id])){
                $order_common['pingtai_voucher_price'] = $input_pingtai_voucher['store_total'][$store_id]['use_voucher_money'];
                $order_common['pingtai_voucher_code'] = $input_pingtai_voucher['voucher_code'];
            }

            $order_common['reciver_info']= $reciver_info;
            $order_common['reciver_name'] = $reciver_name;
            $order_common['reciver_city_id'] = $input_city_id;

            //发票信息
            $order_common['invoice_info'] = $this->_logic_buy_1->createInvoiceData($input_invoice_info);
    
            //保存促销信息
            if(is_array($store_mansong_rule_list[$store_id])) {
                $order_common['promotion_info'] = addslashes($store_mansong_rule_list[$store_id]['desc']);
            }
    
            $order_id = $model_order->addOrderCommon($order_common);
            if (!$order_id) {
                throw new Exception('订单保存失败[未生成订单扩展数据]');
            }

            /* Add is name lt 2016-10-25 删除下单后的活动*/
            $activity_list = Model('activity_goods')->getMemberAddActivityList();
            /* End */
    
            //生成order_goods订单商品数据
            $i = 0;
            foreach ($goods_list as $goods_info) {
                if (!$goods_info['state'] || !$goods_info['storage_state']) {
                    throw new Exception('部分商品已经下架或库存不足，请重新选择');
                }

                /* Add is name lt 2016-10-25 删除下单后的活动*/
                if(!empty($activity_list[$goods_info['goods_id']])){
                    if($goods_info['goods_num'] > $activity_list[$goods_info['goods_id']]['A_GoodsNum']){
                        throw new Exception('订单保存失败[超过该活动商品购买数量]');
                    }
                    $act_re_id = Model('activity_goods')->delActivityMemberById($_SESSION['member_id'],$activity_list[$goods_info['goods_id']]['A_Id']);
                    if(empty($act_re_id)){
                        throw new Exception('订单保存失败[取消活动资格失败]');
                    }
                }
                /* End */

                if (!intval($goods_info['bl_id'])) {
                    //如果不是优惠套装
                    $order_goods[$i]['order_id'] = $order_id;
                    $order_goods[$i]['goods_id'] = $goods_info['goods_id'];
                    $order_goods[$i]['store_id'] = $store_id;
                    $order_goods[$i]['goods_name'] = $goods_info['goods_name'];
                    /* Add is name lt 2016-10-25 修改订单商品价格*/
                    if(!empty($activity_list[$goods_info['goods_id']])){
                        $order_goods[$i]['goods_price'] = $activity_list[$goods_info['goods_id']]['A_GoodsPrice'];
                    }else{
                        $order_goods[$i]['goods_price'] = $goods_info['goods_price'];
                    }
                    /* End */
                    $order_goods[$i]['goods_num'] = $goods_info['goods_num'];
                    $order_goods[$i]['goods_image'] = $goods_info['goods_image'];
                    $order_goods[$i]['buyer_id'] = $member_id;
                    if ($goods_info['ifgroupbuy']) {
                        $ifgroupbuy = true;
                        $order_goods[$i]['goods_type'] = 2;
                    }elseif ($goods_info['ifxianshi']) {
                        $order_goods[$i]['goods_type'] = 3;
                    }elseif ($goods_info['ifzengpin']) {
                        $order_goods[$i]['goods_type'] = 5;
                    // add 秒杀模块 xin
                    }elseif ($goods_info['ifmiaosha']) {
                        $ifmiaosha = true;
                        $order_goods[$i]['goods_type'] = 6;
                    // add 会员特价模块 xin 20151130
                    }elseif ($goods_info['ifvipsale']) {
                        $ifvipsale = true;
                        $order_goods[$i]['goods_type'] = 7;
                    // add end
                    }elseif ($goods_info['iftuijian']) {
                        $iftuijian = true;
                        $order_goods[$i]['goods_type'] = 8;
                    // add end
                    }else {
                        $order_goods[$i]['goods_type'] = 1;
                    }

                    //判定商品是否参与了店铺优惠券，存入优惠金额
                    if(!empty($input_pingtai_voucher['store_goods_voucher'][$store_id][$goods_info['goods_id']])){
                        $order_goods[$i]['pingtai_voucher_price'] = $input_pingtai_voucher['store_goods_voucher'][$store_id][$goods_info['goods_id']]['use_voucher_money'];

                    }
                    $order_goods[$i]['promotions_id'] = $goods_info['promotions_id'] ? $goods_info['promotions_id'] : 0;
					//zmr>>>
                    $order_goods[$i]['commis_rate'] =floatval($store_gc_id_commis_rate_list[$store_id][$goods_info['gc_id']]);
					//zmr<<<
                    $order_goods[$i]['gc_id'] = $goods_info['gc_id'];
                    //计算商品金额
                    $goods_total = $goods_info['goods_price'] * $goods_info['goods_num'];
                    //计算本件商品优惠金额
                    $promotion_value = round($goods_total*($promotion_rate),2);
                    $order_goods[$i]['goods_pay_price'] = $goods_total - $promotion_value - $order_goods[$i]['pingtai_voucher_price'];
                    $promotion_sum += $promotion_value;
                    $i++;

                    //存储库存报警数据
                    if ($goods_info['goods_storage_alarm'] >= ($goods_info['goods_storage'] - $goods_info['goods_num'])) {
                        $param = array();
                        $param['common_id'] = $goods_info['goods_commonid'];
                        $param['sku_id'] = $goods_info['goods_id'];
                        $notice_list['goods_storage_alarm'][$goods_info['store_id']] = $param;
                    }

                } elseif (!empty($goods_info['bl_goods_list']) && is_array($goods_info['bl_goods_list'])) {

                    //优惠套装
                    foreach ($goods_info['bl_goods_list'] as $bl_goods_info) {
                        $order_goods[$i]['order_id'] = $order_id;
                        $order_goods[$i]['goods_id'] = $bl_goods_info['goods_id'];
                        $order_goods[$i]['store_id'] = $store_id;
                        $order_goods[$i]['goods_name'] = $bl_goods_info['goods_name'];
                        $order_goods[$i]['goods_price'] = $bl_goods_info['bl_goods_price'];
                        $order_goods[$i]['goods_num'] = $goods_info['goods_num'];
                        $order_goods[$i]['goods_image'] = $bl_goods_info['goods_image'];
                        $order_goods[$i]['buyer_id'] = $member_id;
                        $order_goods[$i]['goods_type'] = 4;
                        $order_goods[$i]['promotions_id'] = $bl_goods_info['bl_id'];
                        $order_goods[$i]['commis_rate'] = floatval($store_gc_id_commis_rate_list[$store_id][$bl_goods_info['gc_id']]);
                        $order_goods[$i]['gc_id'] = $bl_goods_info['gc_id'];
    
                        //计算商品实际支付金额(goods_price减去分摊优惠金额后的值)
                        $goods_total = $bl_goods_info['bl_goods_price'] * $goods_info['goods_num'];
                        //计算本件商品优惠金额
                        $promotion_value = floor($goods_total*($promotion_rate));
                        $order_goods[$i]['goods_pay_price'] = $goods_total - $promotion_value;
                        $promotion_sum += $promotion_value;
                        $i++;
    
                        //存储库存报警数据
                        if ($bl_goods_info['goods_storage_alarm'] >= ($bl_goods_info['goods_storage'] - $goods_info['goods_num'])) {
                            $param = array();
                            $param['common_id'] = $bl_goods_info['goods_commonid'];
                            $param['sku_id'] = $bl_goods_info['goods_id'];
                            $notice_list['goods_storage_alarm'][$bl_goods_info['store_id']] = $param;
                        }
                    }
                }
            }

            //将因舍出小数部分出现的差值补到最后一个商品的实际成交价中(商品goods_price=0时不给补，可能是赠品)
            if ($promotion_total > $promotion_sum) {
                $i--;
                for($i;$i>=0;$i--) {
                    if (floatval($order_goods[$i]['goods_price']) > 0) {
                        $order_goods[$i]['goods_pay_price'] -= $promotion_total - $promotion_sum;
                        break;
                    }
                }
            }
            $insert = $model_order->addOrderGoods($order_goods);
            if (!$insert) {
                throw new Exception('订单保存失败[未生成商品数据]');
            }
    
            //存储商家发货提醒数据
            if ($store_pay_type_list[$store_id] == 'offline') {
                $notice_list['new_order'][$order['store_id']] = array('order_sn' => $order['order_sn']);
            }
        }

        //银行转账给客户发送识别码短信 xin 20160330
        if($huikuan_code != ''){
           // $send_sms = new Sms();
            //$send_msg = "尊敬的会员您好，您的汇款识别码为：".$huikuan_code."，请在24小时内完成付款，并将识别码填写至汇款凭证的【用途、备注等栏】，请确保识别码填写正确";
           // $send_sms->send($input_address_info['mob_phone'], $send_msg);
        }

        //保存数据
        $this->_order_data['pay_sn'] = $pay_sn;
        $this->_order_data['order_list'] = $order_list;
        $this->_order_data['notice_list'] = $notice_list;
        $this->_order_data['ifgroupbuy'] = $ifgroupbuy;
        // add 秒杀模块 xin
        $this->_order_data['ifmiaosha'] = $ifmiaosha;
        // add 会员特价模块 xin 20151130
        $this->_order_data['ifvipsale'] = $ifvipsale;
		$this->_order_data['iftuijian'] = $iftuijian;
         // add end
    }

    /**
     * 充值卡、预存款支付
     *
     */
    private function _createOrderStep5() {
        if (empty($this->_post_data['password'])) return ;
        $buyer_info	= Model('member')->getMemberInfoByID($this->_member_info['member_id']);
        if ($buyer_info['member_paypwd'] == '' || $buyer_info['member_paypwd'] != md5($this->_post_data['password'])) return ;

        //使用充值卡支付
        if (!empty($this->_post_data['rcb_pay'])) {
            $order_list = $this->_logic_buy_1->rcbPay($this->_order_data['order_list'], $this->_post_data, $buyer_info);
        }
        
        //使用预存款支付
        if (!empty($this->_post_data['pd_pay'])) {
            $this->_logic_buy_1->pdPay($order_list ? $order_list :$this->_order_data['order_list'], $this->_post_data, $buyer_info);
        }
    }

    /**
     * 订单后续其它处理
     *
     */
    private function _createOrderStep6() {
        $ifcart = $this->_post_data['ifcart'];
        $goods_buy_quantity = $this->_order_data['goods_buy_quantity'];
        $input_voucher_list = $this->_order_data['input_voucher_list'];
        $input_pingtai_voucher = $this->_order_data['input_pingtai_voucher'];
        $store_cart_list = $this->_order_data['store_cart_list'];
        $input_buy_items = $this->_order_data['input_buy_items'];
        $order_list = $this->_order_data['order_list'];
        $input_address_info = $this->_order_data['input_address_info'];
        $notice_list = $this->_order_data['notice_list'];
        $fc_id = $this->_order_data['fc_id'];
        $ifgroupbuy = $this->_order_data['ifgroupbuy'];
        // add 秒杀模块 xin
        $ifmiaosha = $this->_order_data['ifmiaosha'];
        // add 会员特价模块 xin
        $ifvipsale = $this->_order_data['ifvipsale'];
		// 
        $iftuijian = $this->_order_data['iftuijian'];
        // add end

        //变更库存和销量
        QueueClient::push('createOrderUpdateStorage', $goods_buy_quantity);

        //更新使用的代金券状态
        if (!empty($input_voucher_list) && is_array($input_voucher_list)) {
            QueueClient::push('editVoucherState', $input_voucher_list);
        }

        //更新使用的平台优惠券状态
        if (!empty($input_pingtai_voucher) && is_array($input_pingtai_voucher)) {
            QueueClient::push('editPingtaiVoucherState', $input_pingtai_voucher);
        }

        //更新F码使用状态
        if ($fc_id) {
            QueueClient::push('updateGoodsFCode', $fc_id);
        }

        //更新藏品惠购买人数和数量
        if ($ifgroupbuy) {
            foreach ($store_cart_list as $goods_list) {
                foreach ($goods_list as $goods_info) {
                    if ($goods_info['ifgroupbuy'] && $goods_info['groupbuy_id']) {
                        $groupbuy_info = array();
                        $groupbuy_info['groupbuy_id'] = $goods_info['groupbuy_id'];
                        $groupbuy_info['quantity'] = $goods_info['goods_num'];
                        QueueClient::push('editGroupbuySaleCount', $groupbuy_info);
                    }
                }
            }
        }

        // add 秒杀模块 xin
        //更新秒杀购买人数和数量
        if ($ifmiaosha) {
            foreach ($store_cart_list as $goods_list) {
                foreach ($goods_list as $goods_info) {
                    if ($goods_info['ifmiaosha'] && $goods_info['miaosha_id']) {
                        $miaosha_info = array();
                        $miaosha_info['miaosha_id'] = $goods_info['miaosha_id'];
                        $miaosha_info['quantity'] = $goods_info['goods_num'];
                        QueueClient::push('editMiaoshaSaleCount', $miaosha_info);
                    }
                }
            }
        }

        // add 会员特价模块 xin 20151130
        //更新会员特价购买人数和数量
        if ($ifvipsale) {
            foreach ($store_cart_list as $goods_list) {
                foreach ($goods_list as $goods_info) {
                    if ($goods_info['ifvipsale'] && $goods_info['vipsale_id']) {
                        $vipsale_info = array();
                        $vipsale_info['vipsale_id'] = $goods_info['vipsale_id'];
                        $vipsale_info['quantity'] = $goods_info['goods_num'];
                        QueueClient::push('editVipsaleSaleCount', $vipsale_info);
                    }
                }
            }
        }

		//更新优惠推荐购买人数和数量
        if ($iftuijian) {
            foreach ($store_cart_list as $goods_list) {
                foreach ($goods_list as $goods_info) {
                    if ($goods_info['iftuijian'] && $goods_info['youhuituijian_id']) {
                        $tuijian_info = array();
                        $tuijian_info['youhuituijian_id'] = $goods_info['youhuituijian_id'];
                        $tuijian_info['quantity'] = $goods_info['goods_num'];
                        QueueClient::push('editYouHuiTuiJianSaleCount', $tuijian_info);
                    }
                }
            }
        }
        // add end

        //删除购物车中的商品
        $this->delCart($ifcart,$this->_member_info['member_id'],array_keys($input_buy_items));
        @setNcCookie('cart_goods_num','',-3600);

        //保存订单自提点信息
        if (C('delivery_isuse') && intval($input_address_info['dlyp_id'])) {
            $data = array();
            $data['mob_phone'] = $input_address_info['mob_phone'];
            $data['tel_phone'] = $input_address_info['tel_phone'];
            $data['reciver_name'] = $input_address_info['true_name'];
            $data['dlyp_id'] = $input_address_info['dlyp_id'];
            foreach ($order_list as $v) {
                $data['order_sn_list'][$v['order_id']]['order_sn'] = $v['order_sn'];
                $data['order_sn_list'][$v['order_id']]['add_time'] = $v['add_time'];
            }
            QueueClient::push('saveDeliveryOrder', $data);
        }

        //发送提醒类信息
        if (!empty($notice_list)) {
            foreach ($notice_list as $code => $value) {
                QueueClient::push('sendStoreMsg', array('code' => $code, 'store_id' => key($value), 'param' => current($value)));
            }
        }

    }

    /**
     * 加密
     * @param array/string $string
     * @param int $member_id
     * @return mixed arrray/string
     */
    public function buyEncrypt($string, $member_id) {
        $buy_key = sha1(md5($member_id.'&'.MD5_KEY));
        if (is_array($string)) {
            $string = serialize($string);
        } else {
            $string = strval($string);
        }
        return encrypt(base64_encode($string), $buy_key);
    }

    /**
     * 解密
     * @param string $string
     * @param int $member_id
     * @param number $ttl
     */
    public function buyDecrypt($string, $member_id, $ttl = 0) {
        $buy_key = sha1(md5($member_id.'&'.MD5_KEY));
        if (empty($string)) return;
        $string = base64_decode(decrypt(strval($string), $buy_key, $ttl));
        return ($tmp = @unserialize($string)) !== false ? $tmp : $string;
    }

    /**
     * 得到所购买的id和数量
     *
     */
    private function _parseItems($cart_id) {
        //存放所购商品ID和数量组成的键值对
        $buy_items = array();
        if (is_array($cart_id)) {
            foreach ($cart_id as $value) {
                if (preg_match_all('/^(\d{1,10})\|(\d{1,6})$/', $value, $match)) {
                    if (intval($match[2][0]) > 0) {
                        $buy_items[$match[1][0]] = $match[2][0];
                    }
                }
            }
        }
        return $buy_items;
    }

    /**
     * 从购物车数组中得到商品列表
     * @param unknown $cart_list
     */
    private function _getGoodsList($cart_list) {
        if (empty($cart_list) || !is_array($cart_list)) return $cart_list;
        $goods_list = array();
        $i = 0;
        foreach ($cart_list as $key => $cart) {
            if (!$cart['state'] || !$cart['storage_state']) continue;
            //购买数量
            $quantity = $cart['goods_num'];
            if (!intval($cart['bl_id'])) {
                //如果是普通商品
                $goods_list[$i]['goods_num'] = $quantity;
                $goods_list[$i]['goods_id'] = $cart['goods_id'];
                $goods_list[$i]['store_id'] = $cart['store_id'];
                $goods_list[$i]['gc_id'] = $cart['gc_id'];
                $goods_list[$i]['goods_name'] = $cart['goods_name'];
                $goods_list[$i]['goods_price'] = $cart['goods_price'];
                $goods_list[$i]['store_name'] = $cart['store_name'];
                $goods_list[$i]['goods_image'] = $cart['goods_image'];
                $goods_list[$i]['transport_id'] = $cart['transport_id'];
                $goods_list[$i]['goods_freight'] = $cart['goods_freight'];
                $goods_list[$i]['goods_vat'] = $cart['goods_vat'];
                $goods_list[$i]['is_fcode'] = $cart['is_fcode'];
                $goods_list[$i]['bl_id'] = 0;
                $i++;
            } else {
                //如果是优惠套装商品
                foreach ($cart['bl_goods_list'] as $bl_goods) {
                    $goods_list[$i]['goods_num'] = $quantity;
                    $goods_list[$i]['goods_id'] = $bl_goods['goods_id'];
                    $goods_list[$i]['store_id'] = $cart['store_id'];
                    $goods_list[$i]['gc_id'] = $bl_goods['gc_id'];
                    $goods_list[$i]['goods_name'] = $bl_goods['goods_name'];
                    $goods_list[$i]['goods_price'] = $bl_goods['goods_price'];
                    $goods_list[$i]['store_name'] = $bl_goods['store_name'];
                    $goods_list[$i]['goods_image'] = $bl_goods['goods_image'];
                    $goods_list[$i]['transport_id'] = $bl_goods['transport_id'];
                    $goods_list[$i]['goods_freight'] = $bl_goods['goods_freight'];
                    $goods_list[$i]['goods_vat'] = $bl_goods['goods_vat'];
                    $goods_list[$i]['bl_id'] = $cart['bl_id'];
                    $i++;
                }
            }
        }
        return $goods_list;
    }

    /**
     * 将下单商品列表转换为以店铺ID为下标的数组
     *
     * @param array $cart_list
     * @return array
     */
    private function _getStoreCartList($cart_list) {
        if (empty($cart_list) || !is_array($cart_list)) return $cart_list;
        $new_array = array();
        foreach ($cart_list as $cart) {
            $new_array[$cart['store_id']][] = $cart;
        }
        return $new_array;
    }

    /**
     * 本次下单是否需要码及F码合法性
     * 无需使用F码，返回 true
     * 需要使用F码，返回($fc_id/false)
     */
    private function _checkFcode($goods_list, $fcode) {
        foreach ($goods_list as $k => $v) {
            if ($v['is_fcode'] == 1) {
                $is_fcode = true; break;
            }
        }
        if (!$is_fcode) return true;
        if (empty($fcode) || count($goods_list) > 1) {
            return false;
        }
        $goods_info = $goods_list[0];
        $fcode_info = $this->checkFcode($goods_info['goods_commonid'],$fcode);
        if ($fcode_info['state']) {
            return intval($fcode_info['data']['fc_id']);
        } else {
            return false;
        }
    }
}
