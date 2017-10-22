<?php
/**
 * 交易管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class orderControl extends SystemControl{
    /**
     * 每次导出订单数量
     * @var int
     */
	const EXPORT_SIZE = 1000;

	public function __construct(){
		parent::__construct();
		Language::read('trade');
	}

	public function indexOp(){
	    $model_order = Model('order');
        $condition	= array();
        if($_GET['order_sn']) {
        	$condition['order_sn'] = $_GET['order_sn'];
        }
        if($_GET['store_name']) {
            $condition['store_name'] = $_GET['store_name'];
        }
        if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order_state'] = $_GET['order_state'];
        }
        if($_GET['payment_code']) {
            $condition['payment_code'] = $_GET['payment_code'];
        }
        if($_GET['buyer_name']) {
            $condition['buyer_name'] = $_GET['buyer_name'];
        }
        if($_GET['trade_no']) {
            if(strlen($_GET['trade_no']) > 8){
                $condition['trade_no'] = $_GET['trade_no'];
            }else{
                $condition['huikuan_code'] = $_GET['trade_no'];
            }
        }
        if($_GET['pay_sn']) {
            $condition['pay_sn'] = $_GET['pay_sn'];
        }
		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$where = "(is_own_shop = 1 or store_id = 22)"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//第三方订单查询
		if($_GET['is_short'] == 2) {
			$where = "is_own_shop = 0 AND store_id <> 22  AND store_is_shuhua_ <> 1"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

        //代运营
		if($_GET['is_short'] == 3) {
			$where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//订单来源赛选
		if(intval($_GET['order_from']) > 0) {
			$condition['order_from'] = $_GET['order_from'];
        }

        $if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_start_time']);
        $if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_end_time']);
        $start_unixtime = $if_start_time ? strtotime($_GET['query_start_time']) : null;
        $end_unixtime = $if_end_time ? strtotime($_GET['query_end_time']): null;
        if ($start_unixtime || $end_unixtime) {
            $condition['add_time'] = array('time',array($start_unixtime,$end_unixtime));
        }
        $order_list	= $model_order->getOrderList($condition,30);

        foreach ($order_list as $order_id => $order_info) {
            //显示取消订单
            $order_list[$order_id]['if_cancel'] = $model_order->getOrderOperateState('system_cancel',$order_info);
            //显示收到货款
            $order_list[$order_id]['if_system_receive_pay'] = $model_order->getOrderOperateState('system_receive_pay',$order_info);
        }
        //显示支付接口列表(搜索)
        $payment_list = Model('payment')->getPaymentOpenList();
        Tpl::output('payment_list',$payment_list);
        Tpl::output('order_list',$order_list);
        Tpl::output('show_page',$model_order->showpage());
        Tpl::showpage('order.index');
	}

	/**
	 * 平台订单状态操作
	 *
	 */
	public function change_stateOp() {
        $order_id = intval($_GET['order_id']);
        if($order_id <= 0){
            showMessage(L('miss_order_number'),$_POST['ref_url'],'html','error');
        }
        $model_order = Model('order');

        //获取订单详细
        $condition = array();
        $condition['order_id'] = $order_id;
        $order_info	= $model_order->getOrderInfo($condition);

        if ($_GET['state_type'] == 'cancel') {
            $result = $this->_order_cancel($order_info);
        } elseif ($_GET['state_type'] == 'receive_pay') {
            $result = $this->_order_receive_pay($order_info,$_POST);
        }
        if (!$result['state']) {
            showMessage($result['msg'],$_POST['ref_url'],'html','error');
        } else {
            showMessage($result['msg'],$_POST['ref_url']);
        }
	}

	/**
	 * 系统取消订单
	 */
	private function _order_cancel($order_info) {
	    $order_id = $order_info['order_id'];
	    $model_order = Model('order');
	    $logic_order = Logic('order');
	    $if_allow = $model_order->getOrderOperateState('system_cancel',$order_info);
	    if (!$if_allow) {
	        return callback(false,'无权操作');
	    }
	    $result =  $logic_order->changeOrderStateCancel($order_info,'system', $this->admin_info['name']);
        if ($result['state']) {
            $this->log(L('order_log_cancel').','.L('order_number').':'.$order_info['order_sn'],1);
        }
        return $result;
	}

	/**
	 * 系统收到货款
	 * @throws Exception
	 */
	private function _order_receive_pay($order_info, $post) {
	    $order_id = $order_info['order_id'];
	    $model_order = Model('order');
	    $logic_order = Logic('order');
	    $if_allow = $model_order->getOrderOperateState('system_receive_pay',$order_info);
	    if (!$if_allow) {
	        return callback(false,'无权操作');
	    }

	    if (!chksubmit()) {
	        Tpl::output('order_info',$order_info);
	        //显示支付接口列表
	        $payment_list = Model('payment')->getPaymentOpenList();
	        //去掉预存款和货到付款
	        foreach ($payment_list as $key => $value){
	            if ($value['payment_code'] == 'predeposit' || $value['payment_code'] == 'offline') {
	               unset($payment_list[$key]);
	            }
	        }
	        Tpl::output('payment_list',$payment_list);
	        Tpl::showpage('order.receive_pay');
	        exit();
	    }
	    $order_list	= $model_order->getOrderList(array('pay_sn'=>$order_info['pay_sn'],'order_state'=>ORDER_STATE_NEW));
	    $result = $logic_order->changeOrderReceivePay($order_list,'system',$this->admin_info['name'],$post);
        if ($result['state']) {
            $this->log('将订单改为已收款状态,'.L('order_number').':'.$order_info['order_sn'],1);
        }
	    return $result;
	}

	/**
	 * 查看订单
	 *
	 */
	public function show_orderOp(){
	    $order_id = intval($_GET['order_id']);
	    if($order_id <= 0 ){
	        showMessage(L('miss_order_number'));
	    }
        $model_order	= Model('order');
        $order_info	= $model_order->getOrderInfo(array('order_id'=>$order_id),array('order_goods','order_common','store'));

		/*2016-01-09 Add is name lt 物流信息：收货人信息*/
		$order_user_info = array();
		if($order_info['extend_store']['is_own_shop'] != 1){}
			//$order_ = unserialize(@preg_replace('!s:(\d+):"(.*?)";!se','"s:".strlen("$2").":\"$2\";"',$order_info['extend_order_common_ser']['reciver_info']));
			$str = iconv("UTF-8","GB2312",$order_info['extend_order_common_ser']['reciver_info']); //收货人信息反序列化
			$str = @preg_replace('!s:(\d+):"(.*?)";!se','"s:".strlen("$2").":\"$2\";"',$str);
			$order_ = @unserialize($str);
			if(!$order_){
				$str = $order_info['extend_order_common_ser']['reciver_info']; //收货人信息反序列化
				$str = @preg_replace('!s:(\d+):"(.*?)";!se','"s:".strlen("$2").":\"$2\";"',$str);
			}
			$order_ = unserialize($str);
			$order_user_info['mob_phone'] = JieMiMobile($order_['mob_phone']);
			$encode = mb_detect_encoding($order_['address'], array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
			if($encode != 'UTF-8'){
				$order_user_info['address'] = iconv("GB2312","UTF-8//IGNORE",$order_['address']);
			}else{
				$order_user_info['address'] = $order_['address'];
			}
			if($order_user_info['mob_phone'] == 0){
				$order_user_info['mob_phone'] = JieMiMobile($order_['mob_phone']);
			}
		$express = rkcache('express',true);
		foreach($express as $k => $v){
			if($v['id'] == $order_info['extend_order_common_ser']['shipping_express_id']){
				$order_user_info['payment_code'] = $v['e_name'];
				break;
			}
		}

		Tpl::output('order_user_info',$order_user_info);

		/*2016-01-09 End*/



        //订单变更日志
		$log_list	= $model_order->getOrderLogList(array('order_id'=>$order_info['order_id']));
		Tpl::output('order_log',$log_list);

		//退款退货信息
        $model_refund = Model('refund_return');
        $condition = array();
        $condition['order_id'] = $order_info['order_id'];
        $condition['seller_state'] = 2;
        $condition['admin_time'] = array('gt',0);
        $return_list = $model_refund->getReturnList($condition);
        Tpl::output('return_list',$return_list);

        //退款信息
        $refund_list = $model_refund->getRefundList($condition);
        Tpl::output('refund_list',$refund_list);

		//卖家发货信息
		if (!empty($order_info['extend_order_common']['daddress_id'])) {
		    $daddress_info = Model('daddress')->getAddressInfo(array('address_id'=>$order_info['extend_order_common']['daddress_id']));
		    Tpl::output('daddress_info',$daddress_info);
		}


/* Add is name lt 2016-04-28 为商品查出佣金比例 */

$model_store_bind_class = Model('store_bind_class');
$store_bind_class_list = $model_store_bind_class->getStoreBindClassList(array('store_id'=>$order_info['store_id'],'state'=>array('in',array(1,2))), null);

$store_info = Model('store')->getStoreInfoByID($order_info['store_id']); //取得店铺详情
$goods_model = Model('goods');

foreach ($order_info['extend_order_goods'] as $gk=>$goods) {
	$goods_gc_id = $goods_model->getGoodsInfoByID($goods['goods_id'] , 'gc_id_1,gc_id_2,gc_id_3,goods_commonid');
	//检查当前结算店铺是否是代运营店铺
	if($store_info['store_is_shuhua_'] == 1){
		 $goods_common = $goods_model->getGoodeCommonInfoByID($goods_gc_id['goods_commonid'],'goods_costprice');
		 $order_info['extend_order_goods'][$gk]['goods_costprice'] = $goods_common['goods_costprice'];
	}
	$goods['gc_id_1'] = $goods_gc_id['gc_id_1'];
	$goods['gc_id_2'] = $goods_gc_id['gc_id_2'];
	$goods['gc_id_3'] = $goods_gc_id['gc_id_3'];

	foreach ($store_bind_class_list as $class) {

		if(!empty($class['class_1']) && empty($class['class_2']) && empty($class['class_3'])){
		//一级分类为真、其它为空
			if($class['class_1'] == $goods['gc_id_1']){
				$goods['commis_rate'] = $class['commis_rate'];
				continue;
			}

		}elseif(!empty($class['class_1']) && !empty($class['class_2']) && empty($class['class_3'])){
		//一、二级分类为真、三级为空
			if(($class['class_1'] == $goods['gc_id_1']) && ($class['class_2'] == $goods['gc_id_2'])){
				$goods['commis_rate'] = $class['commis_rate'];
				continue;
			}

		}else{
		//一、二、三级分类为真
			if(($class['class_1'] == $goods['gc_id_1']) && ($class['class_2'] == $goods['gc_id_2']) && ($class['class_3'] == $goods['gc_id_3'])){
				$goods['commis_rate'] = $class['commis_rate'];
				continue;
			}
		}

	}

}

/* End */



		Tpl::output('order_info',$order_info);
        Tpl::showpage('order.view');
	}

	/**
	 * 导出
	 *
	 */
	public function export_step1Op(){
		$lang	= Language::getLangContent();

	    $model_order = Model('order');
        $condition	= array();
        if($_GET['order_sn']) {
        	$condition['order_sn'] = $_GET['order_sn'];
        }
        if($_GET['store_name']) {
            $condition['store_name'] = $_GET['store_name'];
        }
        if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order_state'] = $_GET['order_state'];
        }
        if($_GET['payment_code']) {
            $condition['payment_code'] = $_GET['payment_code'];
        }
        if($_GET['buyer_name']) {
            $condition['buyer_name'] = $_GET['buyer_name'];
        }
        if($_GET['trade_no']) {
            if(strlen($_GET['trade_no']) > 8){
                $condition['trade_no'] = $_GET['trade_no'];
            }else{
                $condition['huikuan_code'] = $_GET['trade_no'];
            }
        }
		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$where = "(is_own_shop = 1 or store_id = 22)"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//第三方订单查询
		if($_GET['is_short'] == 2) {
			$where = "is_own_shop = 0 AND store_id <> 22  AND store_is_shuhua_ <> 1"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }

        //代运营
		if($_GET['is_short'] == 3) {
			$where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营订单查询
			$StoreList = Model('store')->getStoreList($where,'','','store_id','10000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['store_id'] = array('in',$store);
			}
        }
		//订单来源赛选
		if(intval($_GET['order_from']) > 0) {
			$condition['order_from'] = $_GET['order_from'];
        }

        $if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_start_time']);
        $if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_end_time']);
        $start_unixtime = $if_start_time ? strtotime($_GET['query_start_time']) : null;
        $end_unixtime = $if_end_time ? strtotime($_GET['query_end_time']): null;
        if ($start_unixtime || $end_unixtime) {
            $condition['add_time'] = array('time',array($start_unixtime,$end_unixtime));
        }

		if (!is_numeric($_GET['curpage'])){
			$count = $model_order->getOrderCount($condition);
			$array = array();
			if ($count > self::EXPORT_SIZE ){	//显示下载链接
				$page = ceil($count/self::EXPORT_SIZE);
				for ($i=1;$i<=$page;$i++){
					$limit1 = ($i-1)*self::EXPORT_SIZE + 1;
					$limit2 = $i*self::EXPORT_SIZE > $count ? $count : $i*self::EXPORT_SIZE;
					$array[$i] = $limit1.' ~ '.$limit2 ;
				}
				Tpl::output('list',$array);
				Tpl::output('murl','index.php?act=order&op=index');
				Tpl::showpage('export.excel');
			}else{	//如果数量小，直接下载
				$data = $model_order->getOrderList($condition,'','*','order_id desc',self::EXPORT_SIZE);
				$this->createExcel($data);
			}
		}else{	//下载
			$limit1 = ($_GET['curpage']-1) * self::EXPORT_SIZE;
			$limit2 = self::EXPORT_SIZE;
			$data = $model_order->getOrderList($condition,'','*','order_id desc',"{$limit1},{$limit2}");
			$this->createExcel($data);
		}
	}

	/**
	 * 生成excel
	 *
	 * @param array $data
	 */
	private function createExcel($data = array()){
		Language::read('export');
		import('libraries.excel');
		$excel_obj = new Excel();
		$excel_data = array();
		//设置样式
		$excel_obj->setStyle(array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1')));
		//header
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_no'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_store'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_buyer'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_xtimd'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_count'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_yfei'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_paytype'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_state'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_storeid'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_buyerid'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_bemail'));
		//data
		foreach ((array)$data as $k=>$v){
			$tmp = array();
			$tmp[] = array('data'=>'NC'.$v['order_sn']);
			$tmp[] = array('data'=>$v['store_name']);
			$tmp[] = array('data'=>$v['buyer_name']);
			$tmp[] = array('data'=>date('Y-m-d H:i:s',$v['add_time']));
			$tmp[] = array('format'=>'Number','data'=>ncPriceFormat($v['order_amount']));
			$tmp[] = array('format'=>'Number','data'=>ncPriceFormat($v['shipping_fee']));
			$tmp[] = array('data'=>orderPaymentName($v['payment_code']));
			$tmp[] = array('data'=>orderState($v));
			$tmp[] = array('data'=>$v['store_id']);
			$tmp[] = array('data'=>$v['buyer_id']);
			$tmp[] = array('data'=>$v['buyer_email']);
			$excel_data[] = $tmp;
		}
		$excel_data = $excel_obj->charset($excel_data,CHARSET);
		$excel_obj->addArray($excel_data);
		$excel_obj->addWorksheet($excel_obj->charset(L('exp_od_order'),CHARSET));
		$excel_obj->generateXML($excel_obj->charset(L('exp_od_order'),CHARSET).$_GET['curpage'].'-'.date('Y-m-d-H',time()));
	}
}
