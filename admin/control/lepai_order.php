<?php
/**
 * 乐拍订单管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class lepai_orderControl extends SystemControl{
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
	    $model_lepai = Model('lepai_home');
        $condition	= array();
        if($_GET['order_sn']) {
        	$condition['order_sn'] = $_GET['order_sn'];
        }
        if($_GET['store_name']) {
            $lp_store_info = $model_lepai->getStoreInfo(array('company_name'=>$_GET['store_name']));
            if($lp_store_info['member_id'] != ''){
                $condition['store_member_id'] = $lp_store_info['member_id'];
            }
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
        $if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_start_time']);
        $if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_end_time']);
        $start_unixtime = $if_start_time ? strtotime($_GET['query_start_time']) : null;
        $end_unixtime = $if_end_time ? strtotime($_GET['query_end_time']): null;
        if ($start_unixtime || $end_unixtime) {
            $condition['add_time'] = array('time',array($start_unixtime,$end_unixtime));
        }
        $order_list	= $model_lepai->getLepaiOrder($condition,30);
        $lepaistore = array();
        if(!empty($order_list)){
            foreach($order_list as $k=>$v){
                if($lepaistore[$v['store_member_id']] == ''){
                    $lp_store_info = $model_lepai->getStoreInfo(array('member_id'=>$v['store_member_id']));
                    $lepaistore[$v['store_member_id']] = $lp_store_info['company_name'];
                }
            }
        }
        Tpl::output('lepaistore',$lepaistore);

        //显示支付接口列表(搜索)
        $payment_list = Model('payment')->getPaymentOpenList();
        Tpl::output('payment_list',$payment_list);


        Tpl::output('order_list',$order_list);
        Tpl::output('show_page',$model_lepai->showpage());
        Tpl::showpage('lepaiorder.index');
	}

}
