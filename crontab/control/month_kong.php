<?php
/**
 * 生成所有店铺为空的结算账单

 */
defined('InShopNC') or exit('Access Invalid!');
class month_kongControl extends BaseCronControl {

    /**
     * 默认方法
     */
    public function indexOp(){
        $this->_create_bill();
    }

    private function _create_bill() {
        //实物订单结算
        try {
            $this->_real_order();
        } catch (Exception $e) {
            $this->log('实物账单:'.$e->getMessage());
        }
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

        
            $i++;
        }
     
    }

    /**
     * 生成所有店铺月订单为空的出账单
     *
     * @param int $data
     */
    private function _create_real_order_bill($data){
		$model_order = Model('order');
		$model_bill = Model('bill');
		$model_store = Model('store');
 
			  
        //取店铺表数量(因为可能存在无订单，但有店铺活动费用，所以不再从订单表取店铺数量)
		$store_count = $model_store->getStoreCount(array());
		
        //分批生成该月份的店铺空结算表，每批生成300个店铺
        $insert = false;
        for ($i=0;$i<=$store_count;$i=$i+300){
            $store_list = $model_store->getStoreList(array(),null,'','store_id,store_name',"{$i},300");
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
					$data_bill['ob_create_date'] = TIMESTAMP;
					$data_bill['ob_state'] = 1;
					//店铺名字
					$data_bill['ob_store_name'] = $store_info['store_name'];
                    if (!$model_bill->getOrderBillInfo(array('ob_no'=>$data_bill['ob_no']))) {
                        $insert = $model_bill->addOrderBill($data_bill);
                        if (!$insert) {
                            throw new Exception('生成账单['.$data_bill['ob_no'].']失败');
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

}