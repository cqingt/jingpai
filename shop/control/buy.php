<?php
/**
 * 购买流程
 ***/


defined('InShopNC') or exit('Access Invalid!');
class buyControl extends BaseBuyControl {

    public function __construct() {
        parent::__construct();
        Language::read('home_cart_index');
        if (!$_SESSION['member_id']){
            redirect('index.php?act=login&ref_url='.urlencode(request_uri()));
        }
        //验证该会员是否禁止购买
        if(!$_SESSION['is_buy']){
            showMessage(Language::get('cart_buy_noallow'),'','html','error');
        }
        Tpl::output('hidden_rtoolbar_cart', 1);
    }

    /**
     * 实物商品 购物车、直接购买第一步:选择收获地址和配送方式
     */
    public function buy_step1Op() {

        //虚拟商品购买分流
        $this->_buy_branch($_POST);

        //得到购买数据
        $logic_buy = Logic('buy');
        $result = $logic_buy->buyStep1($_POST['cart_id'], $_POST['ifcart'], $_SESSION['member_id'], $_SESSION['store_id']);
	
        if(!$result['state']) {
            showMessage($result['msg'], '', 'html', 'error');
        } else {
            $result = $result['data'];
        }

        //商品金额计算(分别对每个商品/优惠套装小计、每个店铺小计)
        Tpl::output('store_cart_list', $result['store_cart_list']);
        Tpl::output('store_goods_total', $result['store_goods_total']);

        //取得店铺优惠 - 满即送(赠品列表，店铺满送规则列表)
        Tpl::output('store_premiums_list', $result['store_premiums_list']);
        Tpl::output('store_mansong_rule_list', $result['store_mansong_rule_list']);

        //返回店铺可用的代金券
        Tpl::output('store_voucher_list', $result['store_voucher_list']);

        //返回平台可用的优惠券 xin 20160330
        Tpl::output('pingtai_voucher_list', $result['pingtai_voucher_list']);


        //返回需要计算运费的店铺ID数组 和 不需要计算运费(满免运费活动的)店铺ID及描述
        Tpl::output('need_calc_sid_list', $result['need_calc_sid_list']);
        Tpl::output('cancel_calc_sid_list', $result['cancel_calc_sid_list']);

        //将商品ID、数量、运费模板、运费序列化，加密，输出到模板，选择地区AJAX计算运费时作为参数使用
        Tpl::output('freight_hash', $result['freight_list']);

        //输出用户默认收货地址
        Tpl::output('address_info', $result['address_info']);

        //输出有货到付款时，在线支付和货到付款及每种支付下商品数量和详细列表
        Tpl::output('pay_goods_list', $result['pay_goods_list']);
        Tpl::output('ifshow_offpay', $result['ifshow_offpay']);
        Tpl::output('deny_edit_payment', $result['deny_edit_payment']);
        Tpl::output('pay_fee', $result['pay_fee']);//增加显示货到付款手续费

        //不提供增值税发票时抛出true(模板使用)
        Tpl::output('vat_deny', $result['vat_deny']);

        //增值税发票哈希值(php验证使用)
        Tpl::output('vat_hash', $result['vat_hash']);

        //输出默认使用的发票信息
        Tpl::output('inv_info', $result['inv_info']);

        //显示预存款、支付密码、充值卡
        Tpl::output('available_pd_amount', $result['available_predeposit']);
        Tpl::output('member_paypwd', $result['member_paypwd']);
        Tpl::output('available_rcb_amount', $result['available_rc_balance']);

        //删除购物车无效商品
        $logic_buy->delCart($_POST['ifcart'], $_SESSION['member_id'], $_POST['invalid_cart']);

        //标识购买流程执行步骤
        Tpl::output('buy_step','step2');

        Tpl::output('ifcart', $_POST['ifcart']);

        //店铺信息
        $store_list = Model('store')->getStoreMemberIDList(array_keys($result['store_cart_list']));
		if(array_keys($result['store_cart_list'])){
			foreach(array_keys($result['store_cart_list']) as $v){
				if($v != 22){
						$store_cart_list[] = $v;
				}
			}
			
		}
		$store_count = Model('store')->getStoreCount(array('store_id'=> array('in',$store_cart_list),'is_own_shop'=>array('neq',1)));//获取订单产品非自营店铺数量
		
		Tpl::output('store_count',$store_count);
        Tpl::output('store_list',$store_list);
        Tpl::showpage('buy_step1');
    }

    /**
     * 生成订单
     *
     */
    public function buy_step2Op() {
		
        $logic_buy = logic('buy');

        $result = $logic_buy->buyStep2($_POST, $_SESSION['member_id'], $_SESSION['member_name'], $_SESSION['member_email']);
		
        if(!$result['state']) {
            showMessage($result['msg'], 'index.php?act=cart', 'html', 'error');
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
                    $yw_info_get = @file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']).'&store_id='.$DaiYunStoreId."&tg_from=".urlencode($this->member_info['tg_from']));
					
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
                    $yw_info_get = @file_get_contents('http://shuhuacrm.96567.com/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']).'&store_id='.$DaiYunStoreId."&tg_from=".urlencode($this->member_info['tg_from']));
                    
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

                }else{ //du 非自营店铺发送微信通知
					//获取商家的 member_id
					$store_id_Array = array();
					$store_id_Array[] = $v['store_id'];
					$wx_store = Model('store')->getStoreMemberIDList($v['store_id'],'store_id,member_id,store_name');
					$member_info = Model('member')->getMemberInfoByID($wx_store[$v['store_id']]['member_id']);
					$goods_name_list = '';
					if($result['data']['store_cart_list'][$v['store_id']]){
						foreach($result['data']['store_cart_list'][$v['store_id']] as $drk=>$drv){
							$goods_name_list .= $drv['goods_name']."\n";
						}
					}
					$dataArr['first'] = $member_info['member_name'].'，您好，您有一笔新订单生成哦~';
					$dataArr['keyword1'] = $v['order_sn'];
					$dataArr['keyword2'] = $v['order_amount'];
					$dataArr['keyword3'] = $goods_name_list;
					$dataArr['remark'] = "\n".$wx_store[$v['store_id']]['store_name'].'，您有新订单生成，请于24时内安排发货。';
					$wx_param = array(
						 'func'=>'order_notice',
						 'template_id'=>'',
						 'openid'=>$member_info['openid'],
						 'url'=>'',
						 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
					);

					QueueClient::push('sendWXTemplateMsg', $wx_param);
				}
            }
        }
        //add end


        /* Add is name lt 2016-04-08 提现申请通过、微信通知*/

        $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
		$goods_name_list = '';
        foreach ($result['data']['goods_list'] as $k => $v) {

            $goods_name_list .= $v['goods_name']."\n";
        }

        $order_list = end($result['data']['order_list']);

        $dataArr['first'] = $member_info['member_name'].',您好，您有一笔新订单生成哦~';
        $dataArr['keyword1'] = $order_list['order_sn'];
        $dataArr['keyword2'] = $order_list['order_amount'];
        $dataArr['keyword3'] = $goods_name_list;
        $dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';

        $wx_param = array(
             'func'=>'order_notice',
             'template_id'=>'',
             'openid'=>$member_info['openid'],
              'url'=>"http://m.96567.com/index.php?act=member_order&op=order_list",
             'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
        );

        QueueClient::push('sendWXTemplateMsg', $wx_param);

        /* End */



        //转向到商城支付页面
        redirect('index.php?act=buy&op=pay&pay_sn='.$result['data']['pay_sn']);
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
        $order_list = $model_order->getOrderList($condition,'','order_id,order_state,payment_code,order_amount,rcb_amount,pd_amount,order_sn,huikuan_code,store_id','','',array('order_goods'),true);
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

        //如果线上线下支付金额都为0，转到支付成功页
        if (empty($pay_amount_online) && empty($pay_amount_offline)) {
            redirect('index.php?act=buy&op=pay_ok&pay_sn='.$pay_sn.'&pay_amount='.ncPriceFormat($pay_amount));
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
            $model_payment = Model('payment');
            if($show_payment_code != 'bank'){
                $condition = array();
                $payment_list = $model_payment->getPaymentOpenList($condition);
                if (!empty($payment_list)) {
                    unset($payment_list['predeposit']);
                    unset($payment_list['offline']);
                    unset($payment_list['bank']);
                }
                if (empty($payment_list)) {
                    showMessage('暂未找到合适的支付方式','index.php?act=member_order','html','error');
                }
                Tpl::output('payment_list',$payment_list);
            }else{
                $payment_bank = $model_payment->getPaymentInfo(array('payment_code'=>'bank'));
                Tpl::output('payment_bank',$payment_bank);
            }

        }

        //标识 购买流程执行第几步
        Tpl::output('buy_step','step3');
        Tpl::showpage('buy_step2');
    }

    /**
     * 预存款充值下单时支付页面
     */
    public function pd_payOp() {
        $pay_sn	= $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('para_error'),'index.php?act=predeposit','html','error');
        }

        //查询支付单信息
        $model_order= Model('predeposit');
        $pd_info = $model_order->getPdRechargeInfo(array('pdr_sn'=>$pay_sn,'pdr_member_id'=>$_SESSION['member_id']));
        if(empty($pd_info)){
            showMessage(Language::get('para_error'),'','html','error');
        }
        if (intval($pd_info['pdr_payment_state'])) {
            showMessage('您的订单已经支付，请勿重复支付','index.php?act=predeposit','html','error');
        }
        Tpl::output('pdr_info',$pd_info);

        //显示支付接口列表
		$model_payment = Model('payment');
        $condition = array();
        $condition['payment_code'] = array('not in',array('offline','predeposit','bank'));
        $condition['payment_state'] = 1;
        $payment_list = $model_payment->getPaymentList($condition);
        if (empty($payment_list)) {
            showMessage('暂未找到合适的支付方式','index.php?act=predeposit&op=index','html','error');
        }
        Tpl::output('payment_list',$payment_list);

        //标识 购买流程执行第几步
        Tpl::output('buy_step','step3');
        Tpl::showpage('predeposit_pay');
    }

	/**
	 * 支付成功页面
	 */
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
        //王  2016.06.14
        
        //取子订单列表
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $condition['order_state'] = 20;
        $order_list = $model_order->getOrderList($condition,'','*','','',array('order_goods'));

        Tpl::output('pay_info',$pay_info);
        Tpl::output('order_sn',$order_sn);
        Tpl::output('order_list',$order_list);



        /* Add is name lt 2016-04-08 订单完成、微信消息*/

        $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);

        $order_goods_info = $model_order->getOrderInfo(array('buyer_id'=>$pay_info['buyer_id'],'pay_sn'=>$pay_info['pay_sn']),array('order_goods'));

        foreach ($order_goods_info['extend_order_goods'] as $k => $v) {

            $goods_name_list .= $v['goods_name']."\n";
        }

        $dataArr['first'] = $member_info['member_name'].',您好，您有一笔订单已完成付款，我们会尽快为您安排发货！';
        $dataArr['keyword1'] = $order_goods_info['order_sn'];
        $dataArr['keyword2'] = $order_goods_info['order_amount'];
        $dataArr['keyword3'] = $goods_name_list;
        $dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';

        $wx_param = array(
             'func'=>'order_notice',
             'template_id'=>'',
             'openid'=>$member_info['openid'],
              'url'=>"http://m.96567.com/index.php?act=member_order&op=order_list",
             'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
        );

        QueueClient::push('sendWXTemplateMsg', $wx_param);

        /* End */






	    Tpl::output('buy_step','step4');
	    Tpl::showpage('buy_step3');
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
     * 选择不同地区时，异步处理并返回每个店铺总运费以及本地区是否能使用货到付款
     * 如果店铺统一设置了满免运费规则，则运费模板无效
     * 如果店铺未设置满免规则，且使用运费模板，按运费模板计算，如果其中有商品使用相同的运费模板，则两种商品数量相加后再应用该运费模板计算（即作为一种商品算运费）
     * 如果未找到运费模板，按免运费处理
     * 如果没有使用运费模板，商品运费按快递价格计算，运费不随购买数量增加
     */
    public function change_addrOp() {
        $logic_buy = Logic('buy');

        $data = $logic_buy->changeAddr($_POST['freight_hash'], $_POST['city_id'], $_POST['area_id'], $_SESSION['member_id']);
        if(!empty($data)) {
            exit(json_encode($data));
        } else {
            exit();
        }
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
	 * 加载买家发票列表，最多显示10条
	 *
	 */
	public function load_invOp() {
        $logic_buy = Logic('buy');

	    $condition = array();
	    if ($logic_buy->buyDecrypt($_GET['vat_hash'], $_SESSION['member_id']) == 'allow_vat') {
	    } else {
	        Tpl::output('vat_deny',true);
	        $condition['inv_state'] = 1;
	    }
	    $condition['member_id'] = $_SESSION['member_id'];

	    $model_inv = Model('invoice');
	    //如果传入ID，先删除再查询
	    if (intval($_GET['del_id']) > 0) {
            $model_inv->delInv(array('inv_id'=>intval($_GET['del_id']),'member_id'=>$_SESSION['member_id']));
	    }
	    $list = $model_inv->getInvList($condition,10);
	    if (!empty($list)) {
	        foreach ($list as $key => $value) {
	           if ($value['inv_state'] == 1) {
	               $list[$key]['content'] = '普通发票'.' '.$value['inv_title'].' '.$value['inv_content'];
	           } else {
	               $list[$key]['content'] = '增值税发票'.' '.$value['inv_company'].' '.$value['inv_code'].' '.$value['inv_reg_addr'];
	           }
	        }
	    }
	    Tpl::output('inv_list',$list);
	    Tpl::showpage('buy_invoice.load','null_layout');
	}

     /**
      * 新增发票信息
      *
      */
     public function add_invOp(){
        $model_inv = Model('invoice');
     	if (chksubmit()){
     		//如果是增值税发票验证表单信息
     		if ($_POST['invoice_type'] == 2) {
     		    if (empty($_POST['inv_company']) || empty($_POST['inv_code']) || empty($_POST['inv_reg_addr'])) {
     		        exit(json_encode(array('state'=>false,'msg'=>Language::get('nc_common_save_fail','UTF-8'))));
     		    }
     		}
			$data = array();
            if ($_POST['invoice_type'] == 1) {
                $data['inv_state'] = 1;
                $data['inv_title'] = $_POST['inv_title_select'] == 'person' ? '个人' : $_POST['inv_title'];
                $data['inv_content'] = $_POST['inv_content'];
            } else {
                $data['inv_state'] = 2;
    			$data['inv_company'] = $_POST['inv_company'];
    			$data['inv_code'] = $_POST['inv_code'];
    			$data['inv_reg_addr'] = $_POST['inv_reg_addr'];
    			$data['inv_reg_phone'] = $_POST['inv_reg_phone'];
    			$data['inv_reg_bname'] = $_POST['inv_reg_bname'];
    			$data['inv_reg_baccount'] = $_POST['inv_reg_baccount'];
    			$data['inv_rec_name'] = $_POST['inv_rec_name'];
    			$data['inv_rec_mobphone'] = $_POST['inv_rec_mobphone'];
    			$data['inv_rec_province'] = $_POST['area_info'];
    			$data['inv_goto_addr'] = $_POST['inv_goto_addr'];
            }
            $data['member_id'] = $_SESSION['member_id'];
	     	//转码
            $data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
			$insert_id = $model_inv->addInv($data);
			if ($insert_id) {
				exit(json_encode(array('state'=>'success','id'=>$insert_id)));
			} else {
				exit(json_encode(array('state'=>'fail','msg'=>Language::get('nc_common_save_fail','UTF-8'))));
			}
     	} else {
     		Tpl::showpage('buy_address.add','null_layout');
     	}
     }

    /**
     * AJAX验证支付密码
     */
    public function check_pd_pwdOp(){
        if (empty($_GET['password'])) exit('0');
        $buyer_info	= Model('member')->getMemberInfoByID($_SESSION['member_id'],'member_paypwd');
        echo ($buyer_info['member_paypwd'] != '' && $buyer_info['member_paypwd'] === md5($_GET['password'])) ? '1' : '0';
    }

    /**
     * F码验证
     */
    public function check_fcodeOp() {
        $result = logic('buy')->checkFcode($_GET['goods_commonid'], $_GET['fcode']);
        echo $result['state'] ? '1' : '0';
        exit;
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
                    $buy_items[$match[1][0]] = $match[2][0];
                }
            }
        }
        return $buy_items;
    }

    /**
     * 购买分流
     */
    private function _buy_branch($post) {
        if (!$post['ifcart']) {
            //取得购买商品信息
            $buy_items = $this->_parseItems($post['cart_id']);
            $goods_id = key($buy_items);
            $quantity = current($buy_items);

            $goods_info = Model('goods')->getGoodsOnlineInfoAndPromotionById($goods_id);
            if ($goods_info['is_virtual']) {
                redirect('index.php?act=buy_virtual&op=buy_step1&goods_id='.$goods_id.'&quantity='.$quantity);
            }
        }
    }

    //add 拍卖惠 xin 20151024
    /*
     * 拍卖惠订单支付下单
     */
    public function lepaiOrderOp(){
        $h_model = Model('lepai_home');

        $order_sn = trim($_GET['order_sn']);

        $orderInfo = $h_model->getLepaiOrderOne(array('order_sn'=>$order_sn,'buyer_id'=>$_SESSION['member_id']));

        if($orderInfo['order_id'] < 1){
            showMessage('未找到订单',urlShop('lepai_order','index'),'html','error');
        }
        $auction_info = $h_model->getGoodsInfoOne(array('G_Id'=>$orderInfo['lepai_goods_id'],'G_Atype'=>array('eq','6')));
        if($auction_info['G_EndTime'] > time()){
            showMessage('拍品还未结束',urlLepai('index',''),'html','error');
        }


        if($auction_info['G_Id'] < 1){
            showMessage('未找到订单信息！',urlShop('lepai_order','index'),'html','error');
        }


        if($orderInfo['order_state'] == 0){
            showMessage('订单状态为关闭，不能下单支付！',urlShop('lepai_order','index'),'html','error');
        }

        //判定是否超时，3天后未支付订单超时
        if(($orderInfo['add_time']+86400*3 < TIMESTAMP)){
            $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$orderInfo['order_id']));
            showMessage('订单3天内未支付超时被取消！',urlShop('lepai_order','index'),'html','error');
        }

        if($orderInfo['order_state'] > 10){
            showMessage('订单已付款，不可重复下单！',urlShop('lepai_order','index'),'html','error');
        }

        $reciver_info = unserialize($orderInfo['reciver_info']);
        if($reciver_info['address_id'] > 0){
            $reciver_info['tel_phone'] = JieMiMobile($reciver_info['tel_phone']);
            $reciver_info['mob_phone'] =JieMiMobile($reciver_info['mob_phone']);
            Tpl::output('address_info',$reciver_info);
        }

        /* Add is name lt 2016-05-11 拍卖增加余额支付 */

        $buyer_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
        if (floatval($buyer_info['available_predeposit']) > 0) {
            Tpl::output('available_pd_amount', $buyer_info['available_predeposit']);
            Tpl::output('member_paypwd', $buyer_info['member_paypwd']);
        }

        /* End */

        Tpl::output('buy_step','step2');
        Tpl::output('orderInfo',$orderInfo);
        Tpl::output('auction_info',$auction_info);
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
            showMessage('未找到订单',urlShop('lepai_order','index'),'html','error');
        }
        $auction_info = $h_model->getGoodsInfoOne(array('G_Id'=>$orderInfo['lepai_goods_id'],'G_Atype'=>array('egt','6')));

        if($auction_info['G_Id'] < 1){
            showMessage('未找到订单信息！',urlShop('lepai_order','index'),'html','error');
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
            showMessage('请重新选择收货地址信息！',urlShop('buy','lepaiOrder',array('order_sn'=>$order_sn)),'html','error');
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
            showMessage('拍卖惠订单创建失败！',urlShop('buy','lepaiOrder',array('order_sn'=>$order_sn)),'html','error');
        }

        /* Add is name lt 2016-05-11 拍卖增加余额支付 */

        if(!empty($_POST['password']) && intval($_POST['pd_pay']) == 1){

            $model = Model('member');
            $model_order = Model('lepai_home');
            $member_id = $_SESSION['member_id'];
            $member_info = $model->getMemberInfoByID($member_id);

            //验证支付密码以及预存款是否足够
            $available_pd_amount = floatval($member_info['available_predeposit']);
            if ($available_pd_amount >= $orderInfo['order_amount'] && md5($_POST['password']) === $member_info['member_paypwd']){
                $data_log = array();
                $data_pd = array();

                //支付信息
                $data_log['lg_member_id'] = $member_info['member_id'];
                $data_log['lg_member_name'] = $member_info['member_name'];
                $data_log['lg_add_time'] = time();
                $data_log['lg_type'] = 'ord_lepai_pdpay';
                $data_log['lg_av_amount'] = -($orderInfo['order_amount']-$orderInfo['pd_amount']);
                $data_log['lg_desc'] = '拍卖下单，支付预存款，订单号: '.$orderInfo['order_sn'];

                //修改预存款
                $data_pd['available_predeposit'] = array('exp','available_predeposit-'.($orderInfo['order_amount']-$orderInfo['pd_amount']));

                //修改订单完成状态
                $order_pay['payment_code'] = 'predeposit';
                $order_pay['payment_time'] = time();
                $order_pay['pd_amount'] = $orderInfo['order_amount'];
                $order_pay['order_state'] = 20;

                try {

                    $model->beginTransaction();

                    $model->table('pd_log')->insert($data_log);

                    $model->editMember(array('member_id'=>$member_info['member_id']),$data_pd);

                    $model_order->updateLepaiOrder($order_pay,array('order_id'=>$orderInfo['order_id']));

                    $model->commit();

                } catch (Exception $e) {

                    $model->rollback();

                    throw $e;
                }
            }

        }

        /* End */

        //转向到商城支付页面
        redirect('index.php?act=buy&op=lepaiPay&pay_sn='.$pay_sn);
    }

    /**
     * 下单时支付页面
     */
    public function lepaiPayOp() {
        $h_model = Model('lepai_home');

        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php','html','error');
        }
        $orderInfo = $h_model->getLepaiOrderOne(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']));

        if($orderInfo['order_id'] < 1){
            showMessage('未找到需要支付的订单!',urlShop('lepai_order','index'),'html','error');
        }

        /* Add is name lt 2016-05-11 拍卖增加余额支付 */

        if($orderInfo['order_state'] >= 20 && !empty($orderInfo['payment_time'])){
            redirect('index.php?act=buy&op=lepai_pay_ok&pay_sn='.$pay_sn.'&pay_amount='.ncPriceFormat($orderInfo['order_amount']));
        }

        /* End */

        if($orderInfo['order_state'] !=  10){
            showMessage('订单支付状态错误!',urlShop('lepai_order','index'),'html','error');
        }

        //判定是否超时，3天后未支付订单超时
        if(($orderInfo['add_time']+86400*3 < TIMESTAMP)){
            // $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$orderInfo['order_id']));
            showMessage('订单3天内未支付超时被取消！',urlShop('lepai_order','index'),'html','error');
        }

        Tpl::output('orderInfo',$orderInfo);


        $model_payment = Model('payment');
        $condition = array();
        $payment_list = $model_payment->getPaymentOpenList($condition);
        if (!empty($payment_list)) {
            unset($payment_list['predeposit']);
            unset($payment_list['offline']);
            unset($payment_list['bank']);
        }
        if (empty($payment_list)) {
            showMessage('暂未找到合适的支付方式',urlShop('lepai_order','index'),'html','error');
        }

        Tpl::output('payment_list',$payment_list);

        //标识 购买流程执行第几步
        Tpl::output('buy_step','step3');
        Tpl::showpage('buy_lepai_pay');
    }

    /**
     * 支付成功页面
     */
    public function lepai_pay_okOp() {
        $pay_sn	= $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=member_order','html','error');
        }

        //查询支付单信息
        $h_model = Model('lepai_home');
        $pay_info = $h_model->getLepaiOrderOne(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']));
        if(empty($pay_info)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?act=lepai_order','html','error');
        }
        Tpl::output('pay_info',$pay_info);

        Tpl::output('buy_step','step4');
        Tpl::showpage('buy_lepai_succ');
    }
    //add end

}
