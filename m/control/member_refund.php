<?php
/**
 * 买家退款
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_refundControl extends mobileMemberControl {
	public function __construct(){
		parent::__construct();
		Language::read('member_member_index');
		$model_refund = Model('refund_return');
		$model_refund->getmobileRefundStateArray();
	}
	/**
	 * 添加订单商品部分退款
	 *
	 */
	public function add_refundOp(){
		$model_refund = Model('refund_return');
		$condition = array();
		$reason_list = $model_refund->getReasonList($condition);//退款退货原因
		Tpl::output('reason_list',$reason_list);
		$order_id = intval($_GET['order_id']);
		$goods_id = intval($_GET['goods_id']);//订单商品表编号
		if ($order_id < 1 || $goods_id < 1) {//参数验证
			showWapMessage("参数错误",'index.php?act=member_order&op=index','error');
		}
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['order_id'] = $order_id;
		$order = $model_refund->getRightOrderList($condition, $goods_id);

		if(in_array($order['store_id'],array(3,22)) && $order['order_id'] != 533040){
			showWapMessage('该店铺暂不支持自主退款/退货申请，请联系客服处理，请见谅！','','notice','','5');
		}

		//检查订单状态是否签收 未签收系统自动签收
		if($order['order_state'] < 40){
			 $model_order = Model('order');
			 $condition = array();
			 $condition['order_id'] = $order['order_id'];
			 $condition['buyer_id'] = $_SESSION['member_id'];
			 $order_info	= $model_order->getOrderInfo($condition,array('order_goods'));
             $logic_order = Logic('order');
             $if_allow = $model_order->getOrderOperateState('receive',$order_info);
             if (!$if_allow) {
				showWapMessage('无权操作！','','notice','','5');
             }
            $logic_order->changeOrderStateReceive($order_info,'buyer',$_SESSION['member_name']);
			
		}

		$order_id = $order['order_id'];
		$order_amount = $order['order_amount'];//订单金额
		$order_refund_amount = $order['refund_amount'];//订单退款金额
		$goods_list = $order['goods_list'];
		$goods = $goods_list[0];
		$goods_pay_price = $goods['goods_pay_price'];//商品实际成交价
		if ($order_amount < ($goods_pay_price + $order_refund_amount)) {
		    $goods_pay_price = $order_amount - $order_refund_amount;
		    $goods['goods_pay_price'] = $goods_pay_price;
		}
		Tpl::output('goods',$goods);

		$goods_id = $goods['rec_id'];
		$condition = array();
		$condition['buyer_id'] = $order['buyer_id'];
		$condition['order_id'] = $order['order_id'];
		$condition['order_goods_id'] = $goods_id;
		$condition['seller_state'] = array('lt','3');
		$refund_list = $model_refund->getRefundReturnList($condition);
		$refund = array();
		if (!empty($refund_list) && is_array($refund_list)) {
			$refund = $refund_list[0];
		}
	    $refund_state = $model_refund->getRefundState($order);//根据订单状态判断是否可以退款退货
		if ($refund['refund_id'] > 0 || $refund_state != 1) {//检查订单状态,防止页面刷新不及时造成数据错误
			showWapMessage("参数错误",'index.php?act=member_order&op=index','error');
		}
		if (chksubmit() && $goods_id > 0){
			$refund_array = array();
			$refund_amount = floatval($_POST['refund_amount']);//退款金额
			if (($refund_amount < 0) || ($refund_amount > $goods_pay_price)) {
			    $refund_amount = $goods_pay_price;
			}
			$goods_num = intval($_POST['goods_num']);//退货数量
			if (($goods_num < 0) || ($goods_num > $goods['goods_num'])) {
			    $goods_num = 1;
			}
			$refund_array['reason_info'] = '';
			$reason_id = intval($_POST['reason_id']);//退货退款原因
			$refund_array['reason_id'] = $reason_id;
		    $reason_array = array();
		    $reason_array['reason_info'] = '其他';
			$reason_list[0] = $reason_array;
			if (!empty($reason_list[$reason_id])) {
			    $reason_array = $reason_list[$reason_id];
			    $refund_array['reason_info'] = $reason_array['reason_info'];
			}

            $pic_array = array();
            $pic_array['buyer'] = $this->upload_pic();//上传凭证
            $info = serialize($pic_array);
            $refund_array['pic_info'] = $info;

			$model_trade = Model('trade');
			$order_shipped = $model_trade->getOrderState('order_shipped');//订单状态30:已发货
			if ($order['order_state'] == $order_shipped) {
			    $refund_array['order_lock'] = '2';//锁定类型:1为不用锁定,2为需要锁定
			}
			$refund_array['refund_type'] = $_POST['refund_type'];//类型:1为退款,2为退货
			$show_url = 'index.php?act=member_return&op=index';
			$refund_array['return_type'] = '2';//退货类型:1为不用退货,2为需要退货
			if ($refund_array['refund_type'] != '2') {
			    $refund_array['refund_type'] = '1';
			    $refund_array['return_type'] = '1';
			    $show_url = 'index.php?act=member_refund&op=index';
			}
			$refund_array['seller_state'] = '1';//状态:1为待审核,2为同意,3为不同意
			$refund_array['refund_amount'] = ncPriceFormat($refund_amount);
			$refund_array['goods_num'] = $goods_num;
			$refund_array['buyer_message'] = $_POST['buyer_message'];
			$refund_array['add_time'] = time();
			$store_info = Model('store')->getStoreInfoByID($order['store_id']);
			if($store_info['is_own_shop'] || $store_info['store_id'] == '22'){
			}else{
				//du 非自营店铺发送微信通知
				//获取商家的 member_id
				$store_id_Array = array();
				$store_id_Array[] = $order['store_id'];
				$wx_store = Model('store')->getStoreMemberIDList($store_id_Array,'store_id,member_id,store_name');
				$member_info = Model('member')->getMemberInfoByID($wx_store[$order['store_id']]['member_id']);
				$goods_name_list = '';
				$dataArr['first'] = $wx_store[$order['store_id']]['store_name'].'，您有新退货/退款申请生成，请于24时内处理。';
				$dataArr['keyword1'] = '退货/退款申请';
				$dataArr['keyword2'] = $goods['goods_name'];
				$dataArr['keyword3'] = $order['order_sn'];
				$dataArr['keyword4'] = date("Y-m-d H:i:s",time());
				$dataArr['remark'] = "申请原因：".$refund_array['buyer_message'];
				$wx_param = array(
					 'func'=>'shouhou_notice',
					 'template_id'=>'',
					 'openid'=>$member_info['openid'],
					 'url'=>'',
					 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
				);

				QueueClient::push('sendWXTemplateMsg', $wx_param);
			}
			$state = $model_refund->addRefundReturn($refund_array,$order,$goods);

			if ($state) {
//    			if ($order['order_state'] == $order_shipped) {
//    			    $model_refund->editOrderLock($order_id);
//    			    Model('order')->editOrder(array('finnshed_time'=>time(),'order_state'=>40),array('order_id'=>$order_id));
//    			}

				showWapMessage("提交成功",$show_url,'succ');
			} else {
				showWapMessage("提交失败",'','error');
			}
		}
		Tpl::output('nav_title','退款退货');
		Tpl::showpage('member_refund_add');
	}


	/**
	 * 添加全部退款即取消订单
	 *
	 */
	public function add_refund_allOp(){
		$model_order = Model('order');
		$model_trade = Model('trade');
		$model_refund = Model('refund_return');
		$order_id = intval($_GET['order_id']);
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['order_id'] = $order_id;
		$order = $model_refund->getRightOrderList($condition);

        //add xin 20160105 判定订单是自营店铺，退款需联系业务员，不允许客户自行退款
        $store_info = Model('store')->getStoreInfoByID($order['store_id']);
        if($store_info['is_own_shop']){
            showWapMessage('退款/退货请致电客服热线 400-81-96567 或直接联系您的专属客服','index.php?act=member_order&op=index','','error');
        }

        if(in_array($order['store_id'],array(3,22))){
			showWapMessage('该店铺暂不支持自主退款/退货申请，请联系客服处理，请见谅！','','error');
		}
        
		Tpl::output('order',$order);
		$order_amount = $order['order_amount'];//订单金额
		$condition = array();
		$condition['buyer_id'] = $order['buyer_id'];
		$condition['order_id'] = $order['order_id'];
		$condition['goods_id'] = '0';
		$condition['seller_state'] = array('lt','3');
		$refund_list = $model_refund->getRefundReturnList($condition);
		$refund = array();
		if (!empty($refund_list) && is_array($refund_list)) {
			$refund = $refund_list[0];
		}
	    $order_paid = $model_trade->getOrderState('order_paid');//订单状态20:已付款
	    $payment_code = $order['payment_code'];//支付方式
		if ($refund['refund_id'] > 0 || $order['order_state'] != $order_paid || $payment_code == 'offline') {//检查订单状态,防止页面刷新不及时造成数据错误
			showWapMessage("参数错误",'index.php?act=member_order&op=index','error');
		}
		if (chksubmit()) {
			$refund_array = array();
			$refund_array['refund_type'] = '1';//类型:1为退款,2为退货
			$refund_array['seller_state'] = '1';//状态:1为待审核,2为同意,3为不同意
			$refund_array['order_lock'] = '2';//锁定类型:1为不用锁定,2为需要锁定
			$refund_array['goods_id'] = '0';
			$refund_array['order_goods_id'] = '0';
			$refund_array['reason_id'] = '0';
			$refund_array['reason_info'] = '取消订单，全部退款';
			$refund_array['goods_name'] = '订单商品全部退款';
			$refund_array['refund_amount'] = ncPriceFormat($order_amount);
			$refund_array['buyer_message'] = $_POST['buyer_message'];
			$refund_array['add_time'] = time();

            $pic_array = array();
            $pic_array['buyer'] = $this->upload_pic();//上传凭证
            $info = serialize($pic_array);
            $refund_array['pic_info'] = $info;
			$state = $model_refund->addRefundReturn($refund_array,$order);

			if ($state) {
			    $model_refund->editOrderLock($order_id);
				showWapMessage("提交成功",'index.php?act=member_refund&op=index','succ');
			} else {
				showWapMessage("提交失败",'','error');
			}
		}
		Tpl::output('nav_title','订单退款');
	    Tpl::showpage('member_refund_all');
	}
	/**
	 * 退款记录列表页
	 *
	 */
	public function indexOp(){
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];

		$keyword_type = array('order_sn','refund_sn','goods_name');
		if (trim($_GET['key']) != '' && in_array($_GET['type'],$keyword_type)){
			$type = $_GET['type'];
			$condition[$type] = array('like','%'.$_GET['key'].'%');
		}
		if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != ''){
			$add_time_from = strtotime(trim($_GET['add_time_from']));
			$add_time_to = strtotime(trim($_GET['add_time_to']));
			if ($add_time_from !== false || $add_time_to !== false){
				$condition['add_time'] = array('time',array($add_time_from,$add_time_to));
			}
		}
		$refund_list = $model_refund->getRefund_ReturnList($condition,10);
		Tpl::output('refund_list',$refund_list);
		Tpl::output('show_page',$model_refund->showpage());
//        $store_list = $model_refund->getRefundStoreList($refund_list);
//        Tpl::output('store_list', $store_list);
		self::profile_menu('member_order','buyer_refund');

		Tpl::output('html_title','退款及退货'.' - '.C('site_name'));

		Tpl::output('nav_title','退款退货列表页');
		Tpl::showpage('member_refund');
	}
	/**
	 * 退款记录查看
	 *
	 */
	public function viewOp(){
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['refund_id'] = intval($_GET['refund_id']);
		$refund_list = $model_refund->getRefundList($condition);
		$refund = $refund_list[0];
		Tpl::output('refund',$refund);
		$info['buyer'] = array();
	    if(!empty($refund['pic_info'])) {
	        $info = unserialize($refund['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		$condition = array();
		$condition['order_id'] = $refund['order_id'];
		$model_refund->getRightOrderList($condition, $refund['order_goods_id']);
		Tpl::output('nav_title','退款进度查询');
		Tpl::showpage('member_refund_view');
	}
	/**
	 * 退货记录查看页
	 *
	 */
	public function return_viewOp(){
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		Tpl::output('return',$return);
		$express_list  = rkcache('express',true);
		if ($return['express_id'] > 0 && !empty($return['invoice_no'])) {
			Tpl::output('return_e_name',$express_list[$return['express_id']]['e_name']);
		}
		$info['buyer'] = array();
	    if(!empty($return['pic_info'])) {
	        $info = unserialize($return['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		$condition = array();
		$condition['order_id'] = $return['order_id'];
		$model_refund->getRightOrderList($condition, $return['order_goods_id']);
		Tpl::output('nav_title','退货进度查询');
		

		$model_refund = Model('refund_return');
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		Tpl::output('return',$return);
		$express_list  = rkcache('express',true);
		Tpl::output('express_list',$express_list);

		$info['buyer'] = array();
	    if(!empty($return['pic_info'])) {
	        $info = unserialize($return['pic_info']);
	    }
		Tpl::output('pic_list',$info['buyer']);
		$condition = array();
		$condition['order_id'] = $return['order_id'];
		$model_refund->getRightOrderList($condition, $return['order_goods_id']);
		$model_trade = Model('trade');
		$return_delay = $model_trade->getMaxDay('return_delay');//发货默认5天后才能选择没收到
		Tpl::output('return_delay',$return_delay);
		Tpl::output('return_confirm',$model_trade->getMaxDay('return_confirm'));//卖家不处理收货时按同意并弃货处理
		Tpl::output('ship',1);

		Tpl::showpage('member_return_view');
	}

	/**
	 * 发货
	 *
	 */
	public function shipOp(){
		$model_refund = Model('refund_return');
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['refund_id'] = intval($_GET['return_id']);
		$return_list = $model_refund->getReturnList($condition);
		$return = $return_list[0];
		if ($return['seller_state'] != '2' || $return['goods_state'] != '1') {//检查状态,防止页面刷新不及时造成数据错误
			showWapMessage("参数错误",'reload','error');
		}
		if (chksubmit()) {
			$refund_array = array();
			$refund_array['ship_time'] = time();
			$refund_array['delay_time'] = time();
			$refund_array['express_id'] = $_POST['express_id'];
			$refund_array['invoice_no'] = $_POST['invoice_no'];
			$refund_array['goods_state'] = '2';
			$state = $model_refund->editRefundReturn($condition, $refund_array);
			if ($state) {
				showWapMessage("保存成功",'index.php?act=member_refund&op=index','succ');
			} else {
				showWapMessage("保存失败",'reload','error');
			}
		}
	}


	/**
	 * 上传凭证
	 *
	 */
    private function upload_pic() {
        $refund_pic = array();
        $refund_pic[1] = 'refund_pic1';
        $refund_pic[2] = 'refund_pic2';
        $refund_pic[3] = 'refund_pic3';
        $pic_array = array();
        $upload = new UploadFile();
        $dir = ATTACH_PATH.DS.'refund'.DS;
        $upload->set('default_dir',$dir);
        $upload->set('allow_type',array('jpg','jpeg','gif','png'));
        $count = 1;
        foreach($refund_pic as $pic) {
            if (!empty($_FILES[$pic]['name'])){
                $result = $upload->upfile($pic);
                if ($result){
                    $pic_array[$count] = $upload->file_name;
                    $upload->file_name = '';
                } else {
                    $pic_array[$count] = '';
                }
            }
            $count++;
        }
        return $pic_array;
    }
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @return
	 */
	private function profile_menu($menu_type,$menu_key='') {
		$menu_array = array();
		switch ($menu_type) {
			case 'member_order':
				$menu_array = array(
				array('menu_key'=>'buyer_refund','menu_name'=>Language::get('nc_member_path_buyer_refund'),	'menu_url'=>'index.php?act=member_refund'),
				array('menu_key'=>'buyer_return','menu_name'=>Language::get('nc_member_path_buyer_return'),	'menu_url'=>'index.php?act=member_return'),
				array('menu_key'=>'buyer_vr_refund','menu_name'=>'虚拟兑码退款',	'menu_url'=>'index.php?act=member_vr_refund'));
				break;
		}
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}
