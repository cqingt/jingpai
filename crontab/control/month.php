<?php
/**
 * 任务计划 - 月执行的任务
 *
 * 
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class monthControl extends BaseCronControl {

    /**
     * 默认方法
     */
    public function indexOp(){
        $this->_create_bill();
    }

    private function _create_bill() {
        //更新订单商品佣金值
        $this->_order_commis_rate_update();

        $model = Model('bill');

        //实物订单结算
        try {
            $model->beginTransaction();
            $this->_real_order();
            $model->commit();
        } catch (Exception $e) {
            $this->log('实物账单:'.$e->getMessage());
        }

        //虚拟订单结算
        /*
        try {
            $model->beginTransaction();
            $this->_vr_order();
            $model->commit();
        } catch (Exception $e) {
            $this->log('虚拟账单:'.$e->getMessage());
        }
        */

    }

    /**
     * 生成上月账单[实物订单]
     */
    private function _real_order() {
        $model_order = Model('order');
        $model_bill = Model('bill');
        $order_statis_max_info = $model_bill->getOrderStatisInfo(array(),'os_end_date','os_month desc');

        //计算起始时间点，自动生成以月份为单位的空结算记录
        if (!$order_statis_max_info){
            $order_min_info = $model_order->getOrderInfo(array(),array(),'min(add_time) as add_time');
            $start_unixtime = is_numeric($order_min_info['add_time']) ? $order_min_info['add_time'] : TIMESTAMP;
        } else {
            $start_unixtime = $order_statis_max_info['os_end_date'];
        }
        $data = array();
        $i = 1;
        $start_unixtime = strtotime(date('Y-m-01 00:00:00', $start_unixtime));
        $current_time = strtotime(date('Y-m-01 00:00:01',TIMESTAMP));
        while (($time = strtotime('-'.$i.' month',$current_time)) >= $start_unixtime) {
            if (date('Ym',$start_unixtime) == date('Ym',$time)) {
                //如果两个月份相等检查库是里否存在
                $order_statis = $model_bill->getOrderStatisInfo(array('os_month'=>date('Ym',$start_unixtime)));
                if ($order_statis) {
                    break;
                }
            }
            $first_day_unixtime = strtotime(date('Y-m-01 00:00:00', $time));	//该月第一天0时unix时间戳
            $last_day_unixtime = strtotime(date('Y-m-01 23:59:59', $time)." +1 month -1 day"); //该月最后一天最后一秒时unix时间戳
            $key = count($data);
            $os_month = date('Ym',$first_day_unixtime);
            $data[$key]['os_month'] = $os_month;
            $data[$key]['os_year'] = date('Y',$first_day_unixtime);
            $data[$key]['os_start_date'] = $first_day_unixtime;
            $data[$key]['os_end_date'] = $last_day_unixtime;

            //生成所有店铺月订单出账单
            $this->_create_real_order_bill($data[$key]);

            $fileds = 'sum(ob_order_totals) as ob_order_totals,sum(ob_shipping_totals) as ob_shipping_totals,
                    sum(ob_order_return_totals) as ob_order_return_totals,
                    sum(ob_commis_totals) as ob_commis_totals,sum(ob_commis_return_totals) as ob_commis_return_totals,
                    sum(ob_store_cost_totals) as ob_store_cost_totals,sum(ob_result_totals) as ob_result_totals';
            $order_bill_info = $model_bill->getOrderBillInfo(array('os_month'=>$os_month),$fileds);
            $data[$key]['os_order_totals'] = floatval($order_bill_info['ob_order_totals']);
            $data[$key]['os_shipping_totals'] = floatval($order_bill_info['ob_shipping_totals']);
            $data[$key]['os_order_return_totals'] = floatval($order_bill_info['ob_order_return_totals']);
            $data[$key]['os_commis_totals'] = floatval($order_bill_info['ob_commis_totals']);
            $data[$key]['os_commis_return_totals'] = floatval($order_bill_info['ob_commis_return_totals']);
            $data[$key]['os_store_cost_totals'] = floatval($order_bill_info['ob_store_cost_totals']);
            $data[$key]['os_result_totals'] = floatval($order_bill_info['ob_result_totals']);
            $i++;
        }
        krsort($data);
        foreach ($data as $v) {
            $insert = $model_bill->addOrderStatis($v);
            if (!$insert) {
                throw new Exception('生成平台月出账单['.$v['os_month'].']失败');
            }
        }
    }

    /**
     * 生成所有店铺月订单出账单[实物订单]
     *
     * @param int $data
     */
    private function _create_real_order_bill($data){
        $model_order = Model('order');
        $model_bill = Model('bill');
        $model_store = Model('store');
    
				//批量插件order_bill表
				 $lepaicondition = array();
				 $lepaicondition['order_state'] = ORDER_STATE_SUCCESS;
				 $lepaicondition['finnshed_time'] = array(array('egt',$data['os_start_date']),array('elt',$data['os_end_date']),'and');

				 $lepaiorder_info = Model()->table('lepai_order')->where($condition)->count();

                 $condition = array();
                 $condition['order_state'] = ORDER_STATE_SUCCESS;
                 $condition['finnshed_time'] = array(array('egt',$data['os_start_date']),array('elt',$data['os_end_date']),'and');
        //         取出有最终成交订单的店铺ID数量（ID不重复）
               $store_count =  $model_order->getOrderInfo($condition,array(),'count(DISTINCT store_id) as c');
               $store_count = $store_count['c']+$lepaiorder_info;
			   
	

        //取店铺表数量(因为可能存在无订单，但有店铺活动费用，所以不再从订单表取店铺数量)
        //$store_count = $model_store->getStoreCount(array());

        //分批生成该月份的店铺空结算表，每批生成300个店铺
        $insert = false;
        for ($i=0;$i<=$store_count;$i=$i+300){
            $store_list = $model_order->getOrderList($condition,'','DISTINCT store_id','',"{$i},300");

			//获取店铺佣金比例
		

			$lepaiorderinfo = Model()->table('lepai_order')->field('DISTINCT store_member_id')->where($lepaicondition)->limit("{$i},300")->select();

			$store_list = array_merge($store_list, $lepaiorderinfo);
			//'store_state'=>'1'
             //$store_list = $model_store->getStoreList(array(),null,'','store_id',"{$i},10");
            if ($store_list){
                //自动生成以月份为单位的空结算记录
                $data_bill = array();
                foreach($store_list as $store_info){
					$lepaistore_info = Model()->table('store')->field('DISTINCT store_id')->where(array('member_id'=>intval($store_info['store_member_id'])))->find();
					if($lepaistore_info){
						$store_info['store_id'] = $lepaistore_info['store_id'];
					}

                    $data_bill['ob_no'] = $data['os_month'].$store_info['store_id'];
                    $data_bill['ob_start_date'] = $data['os_start_date'];
                    $data_bill['ob_end_date'] = $data['os_end_date'];
                    $data_bill['os_month'] = $data['os_month'];
                    $data_bill['ob_state'] = 0;
                    $data_bill['ob_store_id'] = $store_info['store_id'];
					//print_r($data_bill,true)
					//file_put_contents('a.txt',print_r($data_bill,true),FILE_APPEND);
                    if (!$model_bill->getOrderBillInfo(array('ob_no'=>$data_bill['ob_no']))) {
                        $insert = $model_bill->addOrderBill($data_bill);
                        if (!$insert) {
                            throw new Exception('生成账单['.$data_bill['ob_no'].']失败');
                        }
                        //对已生成空账单进行销量、退单、佣金统计
                        $update = $this->_calc_real_order_bill($data_bill);
                        if (!$update){
                            throw new Exception('更新账单['.$data_bill['ob_no'].']失败');
                        }

                        //add xin 增加账单计算乐拍订单 20160218
                        $update = $this->_calc_lepai_order_bill($data_bill);
                        if (!$update){
                            throw new Exception('更新乐拍账单['.$data_bill['ob_no'].']失败');
                        }

						$update = $this->_calc_QuXiaoLePai_order_bill($data_bill);
						 if (!$update){
                            throw new Exception('更新取消乐拍订单返还保证金['.$data_bill['ob_no'].']失败');
                        }
                        // 发送店铺消息
                        $param = array();
                        $param['code'] = 'store_bill_affirm';
                        $param['store_id'] = $store_info['store_id'];
                        $param['param'] = array(
                            'state_time' => date('Y-m-d H:i:s', $data_bill['ob_start_date']),
                            'end_time' => date('Y-m-d H:i:s', $data_bill['ob_end_date']),
                            'bill_no' => $data_bill['ob_no']
                        );
                        QueueClient::push('sendStoreMsg', $param);
                    }
                }
            }
        }
    }

    /**
     * 计算某月内，某店铺的乐拍订单结算信息[实物订单] xin 20160218
     *
     * @param array $data_bill
     */
    private function _calc_lepai_order_bill($data_bill){
        $model_bill = Model('bill');

        //获取店铺佣金比例
        $store_info = Model()->table('store,lepai_audit')->field('store.member_name,lepai_audit.member_id,lepai_audit.commis_rate')->join('inner')->on('store.member_id=lepai_audit.member_id')->where(array('store.store_id'=>$data_bill['ob_store_id']))->find();

        $condition = array();
        $condition['order_state'] = ORDER_STATE_SUCCESS;
        $condition['store_member_id'] = $store_info['member_id'];
        $condition['finnshed_time'] = array('between',"{$data_bill['ob_start_date']},{$data_bill['ob_end_date']}");

        //订单金额
        $fields = 'sum(order_amount) as order_amount,sum(shipping_fee) as shipping_amount,store_member_id';
        $order_info = Model()->table('lepai_order')->field($fields)->where($condition)->find();

        if(!empty($order_info) && !empty($store_info) && $order_info['order_amount'] > 0){
            $update = array();
            //本期应结
            $update['ob_order_totals'] = array('exp','ob_order_totals+'.$order_info['order_amount']);
            $update['ob_shipping_totals'] = array('exp','ob_shipping_totals+'.$order_info['shipping_amount']);
            $ob_commis_totals = $order_info['order_amount'] * $store_info['commis_rate'] / 100;//佣金金额
            $ob_result_totals = $order_info['order_amount'] - $ob_commis_totals;//应结金额
            $update['ob_commis_totals'] = array('exp','ob_commis_totals+'.$ob_commis_totals);
            $update['ob_result_totals'] = array('exp','ob_result_totals+'.$ob_result_totals);

			$update['ob_leipai_order_totals'] = array('exp','ob_leipai_order_totals+'.$order_info['order_amount']);//乐拍订单金额
			$update['ob_leipai_shipping_totals'] = array('exp','ob_leipai_shipping_totals+'.$order_info['shipping_amount']); //乐拍运费金额
			$update['ob_leipai_commis_totals'] = array('exp','ob_leipai_commis_totals+'.$ob_commis_totals);//乐拍佣金

            return $model_bill->editOrderBill($update,array('ob_no'=>$data_bill['ob_no']));
        }else{
            return true;
        }

    }

	 /**
     * 计算某月内，取消订单返还的保证金
     *
     * @param array $data_bill
     */
    private function _calc_QuXiaoLePai_order_bill($data_bill){
        $model_bill = Model('bill');

        //获取店铺佣金比例
        $store_info = Model()->table('store,lepai_audit')->field('store.member_name,lepai_audit.member_id,lepai_audit.commis_rate')->join('inner')->on('store.member_id=lepai_audit.member_id')->where(array('store.store_id'=>$data_bill['ob_store_id']))->find();

        $condition = array();
        $condition['order_state'] = 0;
		$condition['pd_amount'] = array('gt',0);
        $condition['store_member_id'] = $store_info['member_id'];
        $condition['cancel_time'] = array('between',"{$data_bill['ob_start_date']},{$data_bill['ob_end_date']}");

        //订单金额
        $fields = 'sum(pd_amount) as pd_amount,store_member_id';
        $order_info = Model()->table('lepai_order')->field($fields)->where($condition)->find();

        if(!empty($order_info) && !empty($store_info) && $order_info['pd_amount'] > 0){
            $update = array();
            //本期应结
			$update['ob_leipai_bao_totals'] = array('exp','ob_leipai_bao_totals+'.$order_info['pd_amount']);
            $update['ob_order_totals'] = array('exp','ob_order_totals+'.$order_info['pd_amount']);
            $ob_result_totals = $order_info['pd_amount'];//应结金额
            $update['ob_result_totals'] = array('exp','ob_result_totals+'.$ob_result_totals);
            return $model_bill->editOrderBill($update,array('ob_no'=>$data_bill['ob_no']));
        }else{
            return true;
        }

    }


    /**
     * 计算某月内，某店铺的销量，退单量，佣金[实物订单]
     *
     * @param array $data_bill
     */
    private function _calc_real_order_bill($data_bill){
        $model_order = Model('order');
        $model_bill = Model('bill');
        $model_store = Model('store');

        $order_condition = array();
        $order_condition['order_state'] = ORDER_STATE_SUCCESS;
        $order_condition['store_id'] = $data_bill['ob_store_id'];
        $order_condition['finnshed_time'] = array('between',"{$data_bill['ob_start_date']},{$data_bill['ob_end_date']}");

        $update = array();

        //订单金额
        $fields = 'sum(order_amount+(select sum(pingtai_voucher_price) from shop_order_goods where `shop_order_goods`.order_id = `shop_order`.order_id)) as order_amount,sum(shipping_fee) as shipping_amount,store_name';
        $order_info =  $model_order->getOrderInfo($order_condition,array(),$fields);
		
        $update['ob_order_totals'] = floatval($order_info['order_amount']);
        //运费
        $update['ob_shipping_totals'] = floatval($order_info['shipping_amount']);
        //店铺名字
        $store_info = $model_store->getStoreInfoByID($data_bill['ob_store_id']);
        $update['ob_store_name'] = $store_info['store_name'];
    
        //佣金金额
        $order_info =  $model_order->getOrderInfo($order_condition,array(),'count(DISTINCT order_id) as count');
        $order_count = $order_info['count'];
        $commis_rate_totals_array = array();
        //分批计算佣金，最后取总和
        for ($i = 0; $i <= $order_count; $i = $i + 300){
            $order_list = $model_order->getOrderList($order_condition,'','order_id','',"{$i},300");
            $order_id_array = array();
            foreach ($order_list as $order_info) {
                $order_id_array[] = $order_info['order_id'];
            }
            if (!empty($order_id_array)){
                $order_goods_condition = array();
                $order_goods_condition['order_id'] = array('in',$order_id_array);
				//判断是否是带运营店铺
				if($store_info['store_is_shuhua_'] == 1){
					$field = 'SUM(IF(ROUND((goods_pay_price+pingtai_voucher_price)*(1-commis_rate/100),2)<(select goods_costprice from shop_goods_common where goods_commonid=(select goods_commonid from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id))*goods_num,(goods_pay_price+pingtai_voucher_price)-(select goods_costprice from shop_goods_common where goods_commonid=(select goods_commonid from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id))*goods_num,ROUND((goods_pay_price+pingtai_voucher_price)*commis_rate/100,2))) as commis_amount';
				}else{
					$field = 'SUM(ROUND((goods_pay_price+pingtai_voucher_price)*commis_rate/100,2)) as commis_amount';
				}
                $order_goods_info = $model_order->getOrderGoodsInfo($order_goods_condition,$field);
                $commis_rate_totals_array[] = $order_goods_info['commis_amount'];
            }else{
                $commis_rate_totals_array[] = 0;
            }
        }
        $update['ob_commis_totals'] = floatval(array_sum($commis_rate_totals_array));

	

        //退款总额
        $model_refund = Model('refund_return');
        $refund_condition = array();
        $refund_condition['seller_state'] = 2;
        $refund_condition['store_id'] = $data_bill['ob_store_id'];
        $refund_condition['goods_id'] = array('gt',0);
        $refund_condition['admin_time'] = array(array('egt',$data_bill['ob_start_date']),array('elt',$data_bill['ob_end_date']),'and');
        $refund_info = $model_refund->getRefundReturnInfo($refund_condition,'sum(refund_amount) as amount');
        $update['ob_order_return_totals'] = floatval($refund_info['amount']);

        //退款佣金
        $refund  =  $model_refund->getRefundReturnInfo($refund_condition,'sum(ROUND(refund_amount*commis_rate/100,2)) as amount');
        if ($refund) {
            $update['ob_commis_return_totals'] = floatval($refund['amount']);
        } else {
            $update['ob_commis_return_totals'] = 0;
        }

        //店铺活动费用
        $model_store_cost = Model('store_cost');
        $cost_condition = array();
        $cost_condition['cost_store_id'] = $data_bill['ob_store_id'];
        $cost_condition['cost_state'] = 0;
        $cost_condition['cost_time'] = array(array('egt',$data_bill['ob_start_date']),array('elt',$data_bill['ob_end_date']),'and');
        $cost_info = $model_store_cost->getStoreCostInfo($cost_condition,'sum(cost_price) as cost_amount');
        $update['ob_store_cost_totals'] = floatval($cost_info['cost_amount']);

        //本期应结
        $update['ob_result_totals'] = $update['ob_order_totals'] - $update['ob_order_return_totals'] -
        $update['ob_commis_totals'] + $update['ob_commis_return_totals']-
        $update['ob_store_cost_totals'];

		//检查当前结算店铺是否是代运营店铺 如果是代运营店铺则判断是否有最低结算价
//		if($store_info['store_is_shuhua_'] == 1 && intval($store_info['least_shuhua']) > 0){
//
//			//检查结算金额是否大于最低结算价
//			if($update['ob_result_totals'] < $store_info['least_shuhua']){
//				$update['ob_result_totals'] = $store_info['least_shuhua'];
//				//佣金则是本期亏损金额 佣金金额则为负数
//				$update['ob_commis_totals'] = ($update['ob_order_totals']-$store_info['least_shuhua']);
//			}
//		}
        $update['ob_create_date'] = TIMESTAMP;
        $update['ob_state'] = 1;
        return $model_bill->editOrderBill($update,array('ob_no'=>$data_bill['ob_no']));
    }

    /**
     * 生成上月账单[虚拟订单]
     */
    private function _vr_order() {
        $model_order = Model('vr_order');
        $model_bill = Model('vr_bill');
        $order_statis_max_info = $model_bill->getOrderStatisInfo(array(),'os_end_date','os_month desc');
        //计算起始时间点，自动生成以月份为单位的空结算记录
        if (!$order_statis_max_info){
            $order_min_info = $model_order->getOrderInfo(array(),'min(add_time) as add_time');
            $start_unixtime = is_numeric($order_min_info['add_time']) ? $order_min_info['add_time'] : TIMESTAMP;
        } else {
            $start_unixtime = $order_statis_max_info['os_end_date'];
        }
        $data = array();
        $i = 1;
        $start_unixtime = strtotime(date('Y-m-01 00:00:00', $start_unixtime));
        $current_time = strtotime(date('Y-m-01 00:00:01',TIMESTAMP));
        while (($time = strtotime('-'.$i.' month',$current_time)) >= $start_unixtime) {
            if (date('Ym',$start_unixtime) == date('Ym',$time)) {
                //如果两个月份相等检查库是里否存在
                $order_statis = $model_bill->getOrderStatisInfo(array('os_month'=>date('Ym',$start_unixtime)));
                if ($order_statis) {
                    break;
                }
            }
            $first_day_unixtime = strtotime(date('Y-m-01 00:00:00', $time));	//该月第一天0时unix时间戳
            $last_day_unixtime = strtotime(date('Y-m-01 23:59:59', $time)." +1 month -1 day"); //该月最后一天最后一秒时unix时间戳
            $key = count($data);
            $os_month = date('Ym',$first_day_unixtime);
            $data[$key]['os_month'] = $os_month;
            $data[$key]['os_year'] = date('Y',$first_day_unixtime);
            $data[$key]['os_start_date'] = $first_day_unixtime;
            $data[$key]['os_end_date'] = $last_day_unixtime;
    
            //生成所有店铺月订单出账单
            $this->_create_vr_order_bill($data[$key]);
    
            $fileds = 'sum(ob_order_totals) as ob_order_totals,
                    sum(ob_commis_totals) as ob_commis_totals,sum(ob_result_totals) as ob_result_totals';
            $order_bill_info = $model_bill->getOrderBillInfo(array('os_month'=>$os_month),$fileds);
            $data[$key]['os_order_totals'] = floatval($order_bill_info['ob_order_totals']);
            $data[$key]['os_commis_totals'] = floatval($order_bill_info['ob_commis_totals']);
            $data[$key]['os_result_totals'] = floatval($order_bill_info['ob_result_totals']);
            $i++;
        }
        krsort($data);
        foreach ($data as $v) {
            $insert = $model_bill->addOrderStatis($v);
            if (!$insert) {
                throw new Exception('生成平台月出账单['.$v['os_month'].']失败');
            }
        }
    }

    /**
     * 生成所有店铺月订单出账单[虚拟订单]
     *
     * @param int $data
     */
    private function _create_vr_order_bill($data){
        $model_order = Model('vr_order');
        $model_bill = Model('vr_bill');
        $model_store = Model('store');
    
        //批量插入order_bill表
        $condition = array();
        $condition['order_state'] = array('egt',ORDER_STATE_PAY);
        $condition['payment_time'] = array(array('egt',$data['os_start_date']),array('elt',$data['os_end_date']),'and');
        //取出有最终成交订单的店铺ID数量（ID不重复）
        $order_info =  $model_order->getOrderInfo($condition,'count(DISTINCT store_id) as store_count');
        $store_count = $order_info['store_count'];
        //分批生成该月份的店铺空结算表，每批生成300个店铺
        $insert = false;
        for ($i=0;$i<=$store_count;$i=$i+300){
            $store_list = $model_order->getOrderList($condition,'','DISTINCT store_id','',"{$i},300");
            if ($store_list){
                //自动生成以月份为单位的空结算记录
                $data_bill = array();
                foreach($store_list as $store_info){
                    $data_bill['ob_no'] = $data['os_month'].$store_info['store_id'];
                    $data_bill['ob_start_date'] = $data['os_start_date'];
                    $data_bill['ob_end_date'] = $data['os_end_date'];
                    $data_bill['os_month'] = $data['os_month'];
                    $data_bill['ob_state'] = 0;
                    $data_bill['ob_store_id'] = $store_info['store_id'];
                    if (!$model_bill->getOrderBillInfo(array('ob_no'=>$data_bill['ob_no']))) {
                        $insert = $model_bill->addOrderBill($data_bill);
                        if (!$insert) {
                            throw new Exception('生成账单['.$data_bill['ob_no'].']失败');
                        }
                        //对已生成空账单进行销量、佣金统计
                        $update = $this->_calc_vr_order_bill($data_bill);
                        if (!$update){
                            throw new Exception('更新账单['.$data_bill['ob_no'].']失败');
                        }

                        // 发送店铺消息
                        $param = array();
                        $param['code'] = 'store_bill_affirm';
                        $param['store_id'] = $store_info['store_id'];
                        $param['param'] = array(
                                'state_time' => date('Y-m-d H:i:s', $data_bill['ob_start_date']),
                                'end_time' => date('Y-m-d H:i:s', $data_bill['ob_end_date']),
                                'bill_no' => $data_bill['ob_no']
                        );
                        QueueClient::push('sendStoreMsg', $param);
                    }
                }
            }
        }
    }
    
    /**
     * 计算某月内，某店铺的销量，佣金
     *
     * @param array $data_bill
     */
    private function _calc_vr_order_bill($data_bill){
        $model_order = Model('vr_order');
        $model_bill = Model('vr_bill');
        $model_store = Model('store');

        //计算已使用兑换码
        $order_condition = array();
        $order_condition['vr_state'] = 1;
        $order_condition['store_id'] = $data_bill['ob_store_id'];
        $order_condition['vr_usetime'] = array('between',"{$data_bill['ob_start_date']},{$data_bill['ob_end_date']}");

        $update = array();

        //订单金额
        $fields = 'sum(pay_price) as order_amount,SUM(ROUND(pay_price*commis_rate/100,2)) as commis_amount';
        $order_info =  $model_order->getOrderCodeInfo($order_condition, $fields);
        $update['ob_order_totals'] = floatval($order_info['order_amount']);

        //佣金金额
        $update['ob_commis_totals'] = $order_info['commis_amount'];

        //计算已过期不退款兑换码
        $order_condition = array();
        $order_condition['vr_state'] = 0;
        $order_condition['store_id'] = $data_bill['ob_store_id'];
        $order_condition['vr_invalid_refund'] = 0;
        $order_condition['vr_indate'] = array('between',"{$data_bill['ob_start_date']},{$data_bill['ob_end_date']}");

        //订单金额
        $fields = 'sum(pay_price) as order_amount,SUM(ROUND(pay_price*commis_rate/100,2)) as commis_amount';
        $order_info =  $model_order->getOrderCodeInfo($order_condition, $fields);
        $update['ob_order_totals'] += floatval($order_info['order_amount']);

        //佣金金额
        $update['ob_commis_totals'] += $order_info['commis_amount'];

        //店铺名
        $store_info = $model_store->getStoreInfoByID($data_bill['ob_store_id']);
        $update['ob_store_name'] = $store_info['store_name'];

        //本期应结
        $update['ob_result_totals'] = $update['ob_order_totals'] - $update['ob_commis_totals'];
        $update['ob_create_date'] = TIMESTAMP;
        $update['ob_state'] = 1;
        return $model_bill->editOrderBill($update,array('ob_no'=>$data_bill['ob_no']));
    }
}