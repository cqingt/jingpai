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

    /**
     * 购物车、直接购买第一步:选择收获地址和配置方式
     */
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
                if($store_info['is_own_shop']){
                    //查询订单支付状态
                    $order_info = Model('order')->getOrderInfo(array('order_id'=>$v['order_id']),array(),'order_id,buyer_id,order_amount,payment_time,payment_code,order_state');
                    //获取业务信息
                    $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']));

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
                        $insert_data['review'] = 1;
                        $insert_data['confirm_time'] = $order_info['payment_time'];
                        if($order_info['payment_code'] != 'offline'){
                            $insert_data['order_status'] = 1;
                            $insert_data['shipping_status'] = 5;
                            $insert_data['pay_status'] = 2;
                            @file_get_contents(CRM_SITE_URL."/index.php?m=api&p=action&c=updateTime&uid=".$order_info['buyer_id']."");
                        }
                    }
                    Model('order')->ywInfoInsert($insert_data);//存入业务info

                }
            }
        }
        //add end

        output_data(array('pay_sn' => $result['data']['pay_sn']));
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


}

