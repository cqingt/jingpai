<?php
/**
 * 购买
 *
 *
 *
 *
 * by 33hao.com 好商城V3 运营版
 */


defined('InShopNC') or exit('Access Invalid!');

class member_buyControl extends mobileMemberControl {

	public function __construct() {
		parent::__construct();
	}

    public function buy_step1Op() {
        $cart_id = explode(',', $_GET['cart_id']);

        //得到购买数据
        $logic_buy = Logic('buy');
        $result = $logic_buy->buyStep1($cart_id, $_GET['ifcart'], $_SESSION['member_id'], $_SESSION['store_id']);

        if(!$result['state']) {
            showWapMessage($result['msg'], '', 'error');
        } else {
            $result = $result['data'];
        }


        //商品金额计算(分别对每个商品/优惠套装小计、每个店铺小计)
        Tpl::output('store_cart_list', $result['store_cart_list']);
        Tpl::output('store_goods_total', $result['store_goods_total']);

        //取得店铺优惠 - 满即送(赠品列表，店铺满送规则列表)
        Tpl::output('store_premiums_list', $result['store_premiums_list']);
        Tpl::output('store_mansong_rule_list', $result['store_mansong_rule_list']);

        if(empty($result['miaosha_type']) && empty($result['groupbuy_type'])){

        //返回店铺可用的代金券
        Tpl::output('store_voucher_list', $result['store_voucher_list']);

        //返回平台可用的优惠券 xin 20160330
        Tpl::output('pingtai_voucher_list', $result['pingtai_voucher_list']);

        }

        //返回需要计算运费的店铺ID数组 和 不需要计算运费(满免运费活动的)店铺ID及描述
        Tpl::output('need_calc_sid_list', $result['need_calc_sid_list']);
        Tpl::output('cancel_calc_sid_list', $result['cancel_calc_sid_list']);

        //将商品ID、数量、运费模板、运费序列化，加密，输出到模板，选择地区AJAX计算运费时作为参数使用
        Tpl::output('freight_hash', $result['freight_list']);

        //输出用户默认收货地址
        Tpl::output('address_info', $result['address_info']);

        //输出有货到付款时，在线支付和货到付款及每种支付下商品数量和详细列表
        $offpay_store = array();
        if(!empty($result['pay_goods_list']['offline'])){
            foreach($result['pay_goods_list']['offline'] as $k=>$v){
                $offpay_store[$v['store_id']] = 1;
            }
        }

        Tpl::output('offpay_store', $offpay_store);
        Tpl::output('pay_goods_list', $result['pay_goods_list']);

        if(empty($result['miaosha_type']) && empty($result['groupbuy_type'])){

        Tpl::output('ifshow_offpay', $result['ifshow_offpay']);

        }

        Tpl::output('deny_edit_payment', $result['deny_edit_payment']);
        Tpl::output('pay_fee', $result['pay_fee']);//增加显示货到付款手续费

        //不提供增值税发票时抛出true(模板使用)
        Tpl::output('vat_deny', $result['vat_deny']);

        //增值税发票哈希值(php验证使用)
        Tpl::output('vat_hash', $result['vat_hash']);

        //输出默认使用的发票信息
        Tpl::output('inv_info', $result['inv_info']);
        Tpl::output('invoice_content_list', $this->invoice_content_list());

        //显示预存款、支付密码、充值卡
        Tpl::output('available_pd_amount', $result['available_predeposit']);
        Tpl::output('member_paypwd', $result['member_paypwd']);
        Tpl::output('available_rcb_amount', $result['available_rc_balance']);

        //删除购物车无效商品
        $logic_buy->delCart($_GET['ifcart'], $_SESSION['member_id'], $_GET['invalid_cart']);

        //标识购买流程执行步骤
        Tpl::output('buy_step','step2');

        Tpl::output('ifcart', $_GET['ifcart']);
        Tpl::output('cart_id', $_GET['cart_id']);
        Tpl::output('no_footer',true);
        //店铺信息
        $store_list = Model('store')->getStoreMemberIDList(array_keys($result['store_cart_list']));
        Tpl::output('store_list',$store_list);
		if(array_keys($result['store_cart_list'])){
			foreach(array_keys($result['store_cart_list']) as $v){
				if($v != 22){
						$store_cart_list[] = $v;
				}
			}
			
		}
		$store_count = Model('store')->getStoreCount(array('store_id'=> array('in',$store_cart_list),'is_own_shop'=>array('neq',1)));//获取订单产品非自营店铺数量
		
		Tpl::output('store_count',$store_count);

        Tpl::output('nav_title','订单');
        Tpl::output('html_title','订单 - '.C('site_name'));

        Tpl::showpage('buy_step1');
    }
    /**
     * 购物车、直接购买第一步:选择收获地址和配置方式
     */
    /*
    public function buy_step1Op() {
        $cart_id = explode(',', $_POST['cart_id']);

        $logic_buy = logic('buy');

        //得到购买数据
        $result = $logic_buy->buyStep1($cart_id, $_POST['ifcart'], $this->member_info['member_id'], $this->member_info['store_id']);
        if(!$result['state']) {
            output_error($result['msg']);
        } else {
            $result = $result['data'];
        }
        
        //整理数据
        $store_cart_list = array();
        foreach ($result['store_cart_list'] as $key => $value) {
            $store_cart_list[$key]['goods_list'] = $value;
            $store_cart_list[$key]['store_goods_total'] = $result['store_goods_total'][$key];
            if(!empty($result['store_premiums_list'][$key])) {
                $result['store_premiums_list'][$key][0]['premiums'] = true;
                $result['store_premiums_list'][$key][0]['goods_total'] = 0.00;
                $store_cart_list[$key]['goods_list'][] = $result['store_premiums_list'][$key][0];
            }
            $store_cart_list[$key]['store_mansong_rule_list'] = $result['store_mansong_rule_list'][$key];
            $store_cart_list[$key]['store_voucher_list'] = $result['store_voucher_list'][$key];
            if(!empty($result['cancel_calc_sid_list'][$key])) {
                $store_cart_list[$key]['freight'] = '0';
                $store_cart_list[$key]['freight_message'] = $result['cancel_calc_sid_list'][$key]['desc'];
            } else {
                $store_cart_list[$key]['freight'] = '1';
            }
            $store_cart_list[$key]['store_name'] = $value[0]['store_name'];
        }

        $buy_list = array();
        $buy_list['store_cart_list'] = $store_cart_list;
        $buy_list['freight_hash'] = $result['freight_list'];
        $buy_list['address_info'] = $result['address_info'];
        $buy_list['ifshow_offpay'] = $result['ifshow_offpay'];
        $buy_list['vat_hash'] = $result['vat_hash'];
        $buy_list['inv_info'] = $result['inv_info'];
        $buy_list['available_predeposit'] = $result['available_predeposit'];
        $buy_list['available_rc_balance'] = $result['available_rc_balance'];
        output_data($buy_list);
    }
    */

    /**
     * 购物车、直接购买第二步:保存订单入库，产生订单号，开始选择支付方式
     *
     */
    public function buy_step2Op() {

        $param = array();
        $param['ifcart'] = $_POST['ifcart'];
        $param['cart_id'] = explode(',', $_POST['cart_id']);
        $param['address_id'] = $_POST['address_id'];
        $param['vat_hash'] = $_POST['vat_hash'];
        $param['offpay_hash'] = $_POST['offpay_hash'];
        $param['offpay_hash_batch'] = $_POST['offpay_hash_batch'];
        $param['pay_name'] = $_POST['pay_name'];
        $param['invoice_id'] = $_POST['invoice_id'];

        //处理代金券
        $voucher = array();
        $post_voucher = explode(',', $_POST['voucher']);
        if(!empty($post_voucher)) {
            foreach ($post_voucher as $value) {
                list($voucher_t_id, $store_id, $voucher_price) = explode('|', $value);
                $voucher[$store_id] = $value;
            }
        }
        $param['voucher'] = $voucher;
        $param['voucher_pingtai'] = $_POST['voucher_pingtai'];

        //手机端暂时不做支付留言，页面内容太多了
        //$param['pay_message'] = json_decode($_POST['pay_message']);
        $param['pd_pay'] = $_POST['pd_pay'];
        $param['rcb_pay'] = $_POST['rcb_pay'];
        $param['password'] = $_POST['password'];
        $param['fcode'] = $_POST['fcode'];
        $param['order_from'] = 2;
        $logic_buy = logic('buy');

        $result = $logic_buy->buyStep2($param, $this->member_info['member_id'], $this->member_info['member_name'], $this->member_info['member_email']);

        if(!$result['state']) {
            output_error($result['msg']);
        }
        //add 增加订单生成后，自营店铺订单存入业务info表 xin 20151019
        $order_list = $result['data']['order_list'];
        if(is_array($order_list) && !empty($order_list)){
            foreach($order_list as $k=>$v){
                $store_info = Model('store')->getStoreInfoByID($v['store_id']);
                if($store_info['is_own_shop'] || $store_info['store_is_shuhua_'] == 1){
                    //查询订单支付状态
                    $order_info = Model('order')->getOrderInfo(array('order_id'=>$v['order_id']),array(),'order_id,buyer_id,order_amount,payment_time,payment_code,order_state');
					$DaiYunStoreId=0;
					if($store_info['store_is_shuhua_'] == 1){
						$DaiYunStoreId=$store_info['store_id'];
					}
                    //获取业务信息
                    $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']).'&store_id='.$DaiYunStoreId."&yw_id=".$_SESSION['yw_id']."&tg_from=".urlencode($this->member_info['tg_from']));

                    $yw_info = explode('|',gbk_to_utf8($yw_info_get));
                    $insert_data = array();
                    $insert_data['Number'] = $yw_info[0];
                    $insert_data['UserID'] = intval($yw_info[1]);
                    $insert_data['MemberName'] = $yw_info[2];
                    $insert_data['team'] = intval($yw_info[3]);
                    $insert_data['ShopID'] = $this->member_info['member_id'];
                    $insert_data['bumen'] = intval($yw_info[4]);
                    $insert_data['MemberID'] = intval($yw_info[5]);
                    $insert_data['order_sn'] = $v['order_sn'];
                    $insert_data['orderid'] = $v['order_id'];
                    if($order_info['order_state'] == '20'){ //20已支付

                        if($order_info['payment_code'] != 'offline'){
                            $insert_data['review'] = 1;
                            $insert_data['confirm_time'] = $order_info['payment_time'];
                            $insert_data['order_status'] = 1;
                            $insert_data['shipping_status'] = 5;
                            $insert_data['pay_status'] = 2;
                            @file_get_contents(CRM_SITE_URL."/index.php?m=api&p=action&c=updateTime&uid=".$order_info['buyer_id']."");
                        }
                    }
                    Model('order')->ywInfoInsert($insert_data);//存入业务info

                }elseif($store_info['store_id'] == '22'){
                    //查询订单支付状态
                    $order_info = Model('order')->getOrderInfo(array('order_id'=>$v['order_id']),array(),'order_id,buyer_id,order_amount,payment_time,payment_code,order_state');
                    $DaiYunStoreId=0;
                    if($store_info['store_is_shuhua_'] == 1){
                        $DaiYunStoreId=$store_info['store_id'];
                    }
                    //获取业务信息
                    $yw_info_get = file_get_contents('http://shuhuacrm.96567.com/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']).'&store_id='.$DaiYunStoreId."&yw_id=".$_SESSION['yw_id']."&tg_from=".urlencode($this->member_info['tg_from']));

                    $yw_info = explode('|',gbk_to_utf8($yw_info_get));
                    $insert_data = array();
                    $insert_data['Number'] = 2061;
                    $insert_data['UserID'] = intval($yw_info[1]);
                    $insert_data['MemberName'] = $yw_info[2];
                    $insert_data['team'] = intval($yw_info[3]);
                    $insert_data['ShopID'] = $this->member_info['member_id'];
                    $insert_data['bumen'] = intval($yw_info[4]);
                    $insert_data['MemberID'] = intval($yw_info[5]);
                    $insert_data['order_sn'] = $v['order_sn'];
                    $insert_data['orderid'] = $v['order_id'];
                    if($order_info['order_state'] == '20'){ //20已支付

                        if($order_info['payment_code'] != 'offline'){
                            $insert_data['review'] = 1;
                            $insert_data['confirm_time'] = $order_info['payment_time'];
                            $insert_data['order_status'] = 1;
                            $insert_data['shipping_status'] = 5;
                            $insert_data['pay_status'] = 2;
                            @file_get_contents("http://shuhuacrm.96567.com/index.php?m=api&p=action&c=updateTime&uid=".$order_info['buyer_id']."");
                        }
                    }
                    Model('order')->ywInfoInsert($insert_data);//存入业务info
                }
            }
        }
        //add end

        output_data(array('pay_sn' => $result['data']['pay_sn']));
    }

	/*
     * 拍卖惠订单支付下单
     */
    public function lepaiOrderOp(){
        $h_model = Model('lepai_home');
        $order_sn = trim($_GET['order_sn']);
        $orderInfo = $h_model->getLepaiOrderOne(array('order_sn'=>$order_sn,'buyer_id'=>$_SESSION['member_id']));
        if($orderInfo['order_id'] < 1){
            showMessage('未找到订单',urlWap('member_lepai','order'),'html','error');
        }
        $auction_info = $h_model->getGoodsInfoOne(array('G_Id'=>$orderInfo['lepai_goods_id'],'G_Atype'=>array('eq','6')));
        if($auction_info['G_EndTime'] > time()){
            showMessage('拍品还未结束',urlWap('lepai',''),'html','error');
        }

        if($auction_info['G_Id'] < 1){
            showMessage('未找到订单信息！',urlWap('member_lepai','order'),'html','error');
        }


        if($orderInfo['order_state'] == 0){
            showMessage('订单状态为关闭，不能下单支付！',urlWap('member_lepai','order'),'html','error');
        }

        //判定是否超时，3天后未支付订单超时
        if(($orderInfo['add_time']+86400*3 < TIMESTAMP)){
            $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$orderInfo['order_id']));
            showMessage('订单3天内未支付超时被取消！',urlWap('member_lepai','order'),'html','error');
        }

        if($orderInfo['order_state'] > 10){
            showMessage('订单已付款，不可重复下单！',urlWap('member_lepai','order'),'html','error');
        }

        $reciver_info = unserialize($orderInfo['reciver_info']);
        if($reciver_info['address_id'] > 0){
            $reciver_info['tel_phone'] = JieMiMobile($reciver_info['tel_phone']);
            $reciver_info['mob_phone'] =JieMiMobile($reciver_info['mob_phone']);
            Tpl::output('address_info',$reciver_info);
        }
		

        Tpl::output('buy_step','step2');
        Tpl::output('orderInfo',$orderInfo);
        Tpl::output('auction_info',$auction_info);
        Tpl::output('nav_title','拍卖惠订单');
        Tpl::output('html_title','拍卖惠订单 - '.C('site_name'));
        Tpl::showpage('buy_lepai');
    }

	 /**
     * 拍卖惠生成订单
     *
     */
    public function lepaiOrderstep2Op() {
        $h_model = Model('lepai_home');

        $order_sn = trim($_POST['order_sn']);

        $orderInfo = $h_model->getLepaiOrderOne(array('order_sn'=>$order_sn,'buyer_id'=>$_SESSION['member_id']));

        if($orderInfo['order_id'] < 1){
            showMessage('未找到订单',urlWap('member_lepai','order'),'html','error');
        }
        $auction_info = $h_model->getGoodsInfoOne(array('G_Id'=>$orderInfo['lepai_goods_id'],'G_Atype'=>array('egt','6')));

        if($auction_info['G_Id'] < 1){
            showMessage('未找到订单信息！',urlWap('member_lepai','order'),'html','error');
        }
        $address_id = intval($_POST['address_id']);
        $addressInfo = Model('address')->getDefaultAddressInfo(array('address_id'=>$address_id,'member_id'=>$_SESSION['member_id']));
        if($addressInfo['mob_phone']){
            $addressInfo['mob_phone'] = JiaMiMobile($addressInfo['mob_phone']);
        }
        if($addressInfo['tel_phone']){
            $addressInfo['tel_phone'] = JiaMiMobile($addressInfo['tel_phone']);
        }
        if($addressInfo['address_id'] < 1){
            showMessage('请重新选择收货地址信息！',urlWap('buy','lepaiOrder',array('order_sn'=>$order_sn)),'html','error');
        }

        $updateOrder = array();
        if($orderInfo['pay_sn'] == ''){
            $updateOrder['pay_sn'] = $pay_sn = Logic('buy_1')->makePaySn($order_sn['buyer_id']);
        }else{
            $pay_sn = $orderInfo['pay_sn'];
        }
        $updateOrder['reciver_info'] = serialize($addressInfo);//收货人信息

        $order_res = $h_model->updateLepaiOrder($updateOrder,array('order_id'=>$orderInfo['order_id']));
        if(!$order_res){
            showMessage('拍卖惠订单创建失败！',urlWap('buy','lepaiOrder',array('order_sn'=>$order_sn)),'html','error');
        }

        //跳转拍卖惠订单列表
        redirect('index.php?act=member_lepai&op=order');
    }

    /**
     * 下单时支付页面
     */
    public function payOp() {
        $pay_sn	= $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=member_order','html','error');
        }

        //查询支付单信息
        $model_order= Model('order');
        $pay_info = $model_order->getOrderPayInfo(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']),true);
        if(empty($pay_info)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=member_order','html','error');
        }
        Tpl::output('pay_info',$pay_info);

        //取子订单列表
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $condition['order_state'] = array('in',array(ORDER_STATE_NEW,ORDER_STATE_PAY));
        $order_list = $model_order->getOrderList($condition,'','order_id,order_state,payment_code,order_amount,rcb_amount,pd_amount,order_sn,store_id','','',array('order_goods'),true);
        if (empty($order_list)) {
            showMessage('未找到需要支付的订单','index.php?act=member_order','html','error');
        }

        //重新计算在线支付金额
        $pay_amount_online = 0;
        $pay_amount_offline = 0;
        //订单总支付金额(不包含货到付款)
        $pay_amount = 0;

        foreach ($order_list as $key => $order_info) {

            $money_paid = Model('crm')->getPaidMoneyByOrderId($order_info['order_id']);//获取订单已付款字段 add xin 20151117
            $payed_amount = floatval($order_info['rcb_amount'])+floatval($order_info['pd_amount'])+floatval($money_paid);
            //计算相关支付金额
            if ($order_info['payment_code'] != 'offline') {
                if ($order_info['order_state'] == ORDER_STATE_NEW) {
                    $pay_amount_online += ncPriceFormat(floatval($order_info['order_amount'])-$payed_amount);
                }
                $pay_amount += floatval($order_info['order_amount']);
            } else {
                $pay_amount_offline += floatval($order_info['order_amount']);
            }

            //显示支付方式与支付结果
            if ($order_info['payment_code'] == 'offline') {
                $order_list[$key]['payment_state'] = '货到付款';
            } else {
                if ($order_info['payment_code'] == 'bank') {
                    $order_list[$key]['payment_state'] = '银行转账';
                    $show_payment_code = 'bank';
                }else{
                    $order_list[$key]['payment_state'] = '在线支付';
                }

                if ($payed_amount > 0) {
                    $payed_tips = '';
                    if (floatval($order_info['rcb_amount']) > 0) {
                        $payed_tips = '充值卡已支付：￥'.$order_info['rcb_amount'];
                    }
                    if (floatval($order_info['pd_amount']) > 0) {
                        $payed_tips .= ' 预存款已支付：￥'.$order_info['pd_amount'];
                    }
                    if (floatval($payed_amount) > 0) {
                        $payed_tips .= ' 其他方式已支付：￥'.$money_paid;
                    }
                    $order_list[$key]['order_amount'] .= " ( {$payed_tips} )";
                }
            }
        }
        Tpl::output('order_list',$order_list);
        Tpl::output('pay_sn',$pay_sn);


        //如果线上线下支付金额都为0，转到支付成功页
        if (empty($pay_amount_online) && empty($pay_amount_offline)) {
            redirect('index.php?act=member_buy&op=pay_ok&pay_sn='.$pay_sn);
        }

        //输出订单描述
        if (empty($pay_amount_online)) {
            $order_remind = '下单成功，我们会尽快为您发货，请保持电话畅通！';
        } elseif (empty($pay_amount_offline)) {
            $order_remind = '请您及时付款，以便订单尽快处理！';
        } else {
            $order_remind = '部分商品需要在线支付，请尽快付款！';
        }
        Tpl::output('order_remind',$order_remind);
        Tpl::output('pay_amount_online',ncPriceFormat($pay_amount_online));
        Tpl::output('pd_amount',ncPriceFormat($pd_amount));

        Tpl::output('show_payment_code',$show_payment_code);
        //显示支付接口列表
        if ($pay_amount_online > 0) {
            $model_mb_payment = Model('mb_payment');

            $payment_list = $model_mb_payment->getMbPaymentOpenList();

            //判定非微信浏览器禁用微信支付
            if(strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger") === false){
                foreach($payment_list as $k=>$v){
                    if($v['payment_code'] == 'wxpay'){
                        unset($payment_list[$k]);
                    }
                }
            }
            Tpl::output('payment_list',$payment_list);

        }



        Tpl::output('nav_title','订单支付');
        Tpl::output('html_title','订单支付 - '.C('site_name'));
		Tpl::output('buy_step','step3');
        Tpl::showpage('member_buy.payment');
    }

    public function pay_okOp() {
        $pay_sn	= $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=member_order','html','error');
        }

        //查询支付单信息
        $model_order= Model('order');
        $pay_info = $model_order->getOrderPayInfo(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']));
        if(empty($pay_info)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=member_order','html','error');
        }
        $order_sn = $model_order->getOrderSnList(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']));

	    Tpl::output('pay_info',$pay_info);
		Tpl::output('order_sn',$order_sn);

        Tpl::output('nav_title','支付成功');
        Tpl::output('html_title','支付成功 - '.C('site_name'));

		     //取子订单列表
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $condition['order_state'] = 20;
        $order_list = $model_order->getOrderList($condition,'','*','','',array('order_goods'));
        Tpl::output('order_list',$order_list);

        Tpl::output('buy_step','step4');
        Tpl::showpage('member_buy.ok');
    }
	
	

	/**
	 * 加载买家收货地址
	 *
	 */
	public function load_addrOp() {
	    $model_addr = Model('address');
	    //如果传入ID，先删除再查询
	    if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
            $model_addr->delAddress(array('address_id'=>intval($_GET['id']),'member_id'=>$_SESSION['member_id']));
	    }
	    $condition = array();
	    $condition['member_id'] = $_SESSION['member_id'];
	    if (!C('delivery_isuse')) {
	        $condition['dlyp_id'] = 0;
	        $order = 'dlyp_id asc,address_id desc'; 
	    }
	    $list = $model_addr->getAddressList($condition,$order);
	    Tpl::output('address_list',$list);
	    Tpl::showpage('buy_address.load','null_layout');
	}

	 /**
      * 添加新的收货地址
      *
      */
     public function add_addrOp(){
        $model_addr = Model('address');
     	if (chksubmit()){
     		//验证表单信息
     		$obj_validate = new Validate();
     		$obj_validate->validateparam = array(
     			array("input"=>$_POST["true_name"],"require"=>"true","message"=>Language::get('cart_step1_input_receiver')),
     			array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>Language::get('cart_step1_choose_area')),
     			array("input"=>$_POST["address"],"require"=>"true","message"=>Language::get('cart_step1_input_address'))
     		);
     		$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			$data = array();
			$data['member_id'] = $_SESSION['member_id'];
			$data['true_name'] = $_POST['true_name'];
			$data['area_id'] = intval($_POST['area_id']);
			$data['city_id'] = intval($_POST['city_id']);
			$data['area_info'] = $_POST['area_info'];
			$data['address'] = $_POST['address'];
			$data['tel_phone'] = $_POST['tel_phone'];
			$data['mob_phone'] = $_POST['mob_phone'];
	     	//转码
            $data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
			$insert_id = $model_addr->addAddress($data);
			if ($insert_id){
				exit(json_encode(array('state'=>true,'addr_id'=>$insert_id)));
			}else {
				exit(json_encode(array('state'=>false,'msg'=>Language::get('cart_step1_addaddress_fail','UTF-8'))));
			}
     	} else {
     		Tpl::showpage('buy_address.add','null_layout');
     	}
     }



    /**
     * 验证密码
     */
    public function check_passwordOp() {
        if(empty($_POST['password'])) {
            output_error('参数错误');
        }

        $model_member = Model('member');

        $member_info = $model_member->getMemberInfoByID($this->member_info['member_id']);
        if($member_info['member_paypwd'] == md5($_POST['password'])) {
            output_data('1');
        } else {
            output_error('密码错误');
        }
    }

    /**
     * 更换收货地址
     */
    public function change_addressOp() {
        $logic_buy = Logic('buy');

        $data = $logic_buy->changeAddr($_POST['freight_hash'], $_POST['city_id'], $_POST['area_id'], $this->member_info['member_id']);
        if(!empty($data) && $data['state'] == 'success' ) {
            output_data($data);
        } else {
            output_error('地址修改失败');
        }
    }

    /**
     * 发票内容列表
     */
    private function invoice_content_list() {
        $invoice_content_list = array(
            '明细',
            '酒',
            '食品',
            '饮料',
            '玩具',
            '日用品',
            '装修材料',
            '化妆品',
            '办公用品',
            '学生用品',
            '家居用品',
            '饰品',
            '服装',
            '箱包',
            '精品',
            '家电',
            '劳防用品',
            '耗材',
            '电脑配件'
        );
        return $invoice_content_list;
    }


}

