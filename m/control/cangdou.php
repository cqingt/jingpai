<?php
/**
 * 会员中心——藏豆板块
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class cangdouControl extends mobileMemberControl{

    /**
     * 邀请好友
     */
    public function indexOp() {
        Tpl::output('html_title','邀请好友获藏豆'.' - '.C('site_name'));
		Tpl::output('seo_keywords',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		$CountMember = Model('member')->getMemberCount(array('inviter_id'=>$_SESSION['member_id']));
		Tpl::output('CountMember',$CountMember);
		Tpl::output('nav_title','邀请好友获藏豆');
        Tpl::showpage('cangdou.index');
    }

    /*
     * 藏豆变更记录
     */
    public function cangdou_logOp() {
        $model = Model('pushuser_gift');
        $condition = array();
        $condition['C_PushId'] = $_SESSION['member_id'];

        if($_GET['stime'] && !$_GET['etime']){
            $condition['C_Time'] = array('gt',strtotime($_GET['stime']));
        }elseif(!$_GET['stime'] && $_GET['etime']){
            $condition['C_Time'] = array('lt',strtotime($_GET['etime']));
        }elseif($_GET['stime'] && $_GET['etime']){
            $condition['C_Time'] = array(array('gt',strtotime($_GET['stime'])),array('lt',strtotime($_GET['etime'])),'and');
        }
        Tpl::output('stime',trim($_GET['stime']));
        Tpl::output('etime',trim($_GET['etime']));

        $list = $model->getCangdouLogList($condition);
		Tpl::output('nav_title','藏豆变更记录');
        Tpl::output('list',$list);
        Tpl::output('html_title','藏豆变更记录'.' - '.C('site_name'));
  
        Tpl::showpage('cangdou.log');
    }


    /**
     * 藏豆兑换
     */
    public function cangdou_exchangeOp() {
        $model_cangdou = Model('pushuser_gift');
        $where = "cangdou_gift.starttime <='".TIMESTAMP."' AND cangdou_gift.endtime >= '".TIMESTAMP."'";
        $field = "*,(SELECT count(*) goods_duihuan_sum FROM shop_order_goods WHERE shop_order_goods.goods_id = cangdou_gift.goods_id AND shop_order_goods.lai_yuan = '藏豆兑换礼品' LIMIT 1) AS goods_duihuan_sum";
        $result_list = $model_cangdou->getCangdouGiftList($where,$field);
        Tpl::output('result_list',$result_list);

        $address_class = Model('address');
        $address_list = $address_class->getAddressList(array('member_id'=>$_SESSION['member_id']));
        Tpl::output('address_list',$address_list);

		Tpl::output('nav_title','藏豆兑换礼品');
		Tpl::output('seo_keywords',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
        Tpl::output('html_title','藏豆兑换礼品'.' - '.C('site_name'));
     
        Tpl::showpage('cangdou.exchange');
    }

	/**
     * 优惠推荐
     */
    public function cangdou_tuijianOp() {
        $model_cangdou = Model('pushuser_gift');
        $where = "cangdou_tuijian.starttime <='".TIMESTAMP."' AND cangdou_tuijian.endtime >= '".TIMESTAMP."'";
        $result_list = $model_cangdou->getCangdouTuiJianList($where,'*',0,"cangdou_tuijian.is_tuijian desc,cangdou_tuijian.addtime desc");
        Tpl::output('result_list',$result_list);

        Tpl::output('html_title','优惠购买'.' - '.C('site_name'));
		Tpl::output('seo_keywords',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::output('nav_title','优惠购买');
       
        Tpl::showpage('cangdou.tuijian');
    }

    public function add_addressOp(){
        Tpl::showpage('cangdou.exchange_addr','null_layout');
    }

    /*
     * 兑换礼品生成订单
     */
    public function exchange_onOp(){

        $model_addr = Model('address');
        $model_cangdou = Model('pushuser_gift');

        $gift_id = intval($_POST['gift_id']);
        $address_id = intval($_POST['addr']);
        $gift_info = $model_cangdou->getCangdouGiftInfo('cangdou_gift.id='.$gift_id);

        if(empty($gift_info)){
            showMessage('未找到可兑换礼品');
        }

		$my_order_info = Model('order')->getOrderGoodsInfo(array('goods_id'=>$gift_info['goods_id'],'lai_yuan'=>'藏豆兑换礼品','buyer_id'=>$_SESSION['member_id']),"count(*) as goods_duihuan_sum");
		if(intval($my_order_info['goods_duihuan_sum']) > 3){
			showMessage('您已兑换次商品三次，请更换其他藏品');
		}

        //新增地址
        if($address_id < 1) {

            //验证表单信息
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["true_name"], "require" => "true", "message" => "请填写收货人姓名"),
                array("input" => $_POST["area_id"], "require" => "true", "validator" => "Number", "message" => "请选择所在地区"),
                array("input" => $_POST["address"], "require" => "true", "message" => "请填写收货人详细地址"),
                array("input" => $_POST['mob_phone'], "require" => "true", "validator" => "mobile", "message" => '手机号码格式不正确'),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
                showMessage($error);
            }
            $data = array();
            $data['member_id'] = $_SESSION['member_id'];
            $data['true_name'] = $_POST['true_name'];
            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['area_info'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['mob_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
            $insert_id = $model_addr->addAddress($data);
            if ($insert_id) {
                $data['address_id'] = $insert_id;
                $data['prov'] = intval($_POST['prov']);
            }
        }
		

        //判定库存
        $storage = ($gift_info['kucun'] < $gift_info['goods_storage'])?$gift_info['kucun']:$gift_info['goods_storage'];
		$order_info = Model('order')->getOrderGoodsInfo(array('goods_id'=>$gift_info['goods_id'],'lai_yuan'=>'藏豆兑换礼品'),"count(*) as goods_duihuan_sum");
		if(intval($gift_info['kucun']-$order_info['goods_duihuan_sum']) <= 0 || $storage < 1){
			showMessage('礼品库存不足，请更换礼品');
		}

        //会员藏豆余额小于所需使用藏豆
        $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
        if($member_info['cangdou'] < $gift_info['use_cangdou']){
            showMessage('您的藏豆余额不足以兑换此礼品');
        }

        if($address_id < 1) {
            $address_info = $data;
        }else{
            $address_info = $model_addr->getAddressInfo(array('address_id'=>$address_id));
            $address_info['prov'] = 0;
        }

        //生成订单
        $model_zhuanti = Model('zhuanti');

        $goodsid_array = array($gift_info['goods_id']=>'0');
        $goods_amount = '0'; //商品总额
        $shipping_fee = '0'; //运费
        $res = $model_zhuanti->add_order($address_info,$goodsid_array,$goods_amount,$shipping_fee,'藏豆兑换礼品','藏豆兑换礼品',true);
        if($res['pay_sn'] != ''){
            $model_order = Model('order');
            $order_info = $model_order->getOrderInfo(array('pay_sn'=>$res['pay_sn']));
            //减掉会员藏豆
            $model_cangdou->table('member')->where(array('member_id'=>$_SESSION['member_id']))->setDec('cangdou',$gift_info['use_cangdou']);

            //记录藏豆变更日志
            $data_cangdou = array();
            $data_cangdou['C_Uid'] = 0;
            $data_cangdou['C_PushId'] = $member_info['member_id'];
            $data_cangdou['C_Time'] = TIMESTAMP;
            $data_cangdou['C_CangDou'] = 0 - $gift_info['use_cangdou'];
            $data_cangdou['C_DouType'] = 'duihuan';
            $data_cangdou['C_Remark'] = '藏豆兑换礼品';
            $model_cangdou->table('cangdou_log')->insert($data_cangdou);


            //修改订单状态为已付款
            $data_order = array();
            $data_order['order_state'] = ORDER_STATE_PAY;
            $data_order['payment_time'] = TIMESTAMP;
            $data_order['payment_code'] = 'CDduihuan';
            $result = $model_order->editOrder($data_order,array('order_id'=>$order_info['order_id']));



            //更新业务info订单 为已付款
            $update_data = array();
            $update_data['review'] = 1;
            $update_data['confirm_time'] = TIMESTAMP;
            $update_data['order_status'] = 1;
            $update_data['shipping_status'] = 5;
            $update_data['pay_status'] = 2;
            Model('order')->ywInfoUpdate($update_data,array('orderid'=>$order_info['order_id']));

            //记录订单日志
            $data = array();
            $data['order_id'] = $order_info['order_id'];
            $data['log_role'] = 'system';
            $data['log_user'] = '买家';
            $data['log_msg'] = '<font color="red">藏豆兑换商品，禁止业务员编辑此订单！</font>';
            $data['log_orderstate'] = ORDER_STATE_PAY;
            $insert = $model_order->addOrderLog($data);

            dcache($member_info['member_id'], 'member');

			unset($_POST);

            showMessage('礼品兑换成功,已为您生成订单','index.php?act=member_buy&op=pay&pay_sn='.$res['pay_sn']);
        }else{
            showMessage($res['error']);
        }
    }


    /**
     * 兑换礼品页面
     */
    public function giftexchangeOp(){
        $gift_id = intval($_GET['gift_id']);
        $model_cangdou = Model('pushuser_gift');

        $gift_info = $model_cangdou->getCangdouGiftInfo('cangdou_gift.id='.$gift_id);
        if(empty($gift_info)){

        }
        if($gift_id <= 0){
            $vid = intval($_POST['vid']);
        }
        if($_SESSION['is_login'] != '1'){
			 showWapMessage('请先登录','','error');
        }elseif ($_GET['dialog']){
		     //会员藏豆余额小于所需使用藏豆
		     $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
			 if($member_info['cangdou'] < $gift_info['use_cangdou']){
						showWapMessage('您的藏豆余额不足以兑换此礼品','','error');
				}
        }
        $result = true;
        $message = "";

		Tpl::output('nav_title','藏豆兑换');
        $address_class = Model('address');
        $address_list = $address_class->getAddressList(array('member_id'=>$_SESSION['member_id']));
        Tpl::output('address_list',$address_list);
		Tpl::output('result',$result);
        Tpl::output('gift_info',$gift_info);
        Tpl::showpage('cangdou.exchange_on');
    }

    

}
