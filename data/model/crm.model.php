<?php
/**
 *CRM模型
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class crmModel extends Model{

    public function __construct() {
        parent::__construct('yw_info');
    }

    /**
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     *
     */
    public function updateYWinfo($condition, $update) {
        return $this->where($condition)->update($update);
    }

    /**
     * 获取 yw_info订单的已付款金额
     * @param array $update
     * @param array $condition
     * @return bool
     *
     */
    public function getPaidMoneyByOrderId($orderId) {
        $condition = array();
        $condition['orderid'] = $orderId;
        $order_info = $this->field('*')->where($condition)->find();
        if($order_info['money_paid'] > 0){
            return $order_info['money_paid'];
        }else{
            return 0;
        }
    }

    public function getYWinfo($condition, $field = '*') {
        return $this->field($field)->where($condition)->find();
    }

}
