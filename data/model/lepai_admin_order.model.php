<?php
/**
 * 地区模型
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class lepai_admin_orderModel extends Model {

    public function __construct() {
        parent::__construct('lepai_order');
    }

    /**
     * 搜索公共继承
     *
     */
    private function father($condition='',$type=''){
        $param  = array();
        $param['table'] = empty($condition['table'])?'lepai_order':$condition['table'];
        $param['field'] = empty($condition['field'])?'*':$condition['field'];
        $param['where'] = empty($condition['where'])?'':$condition['where'];
        $param['limit'] = empty($condition['limit'])?'':$condition['limit'];
        $param['order'] = empty($condition['order'])?'':$condition['order'];
        $param['page']  = empty($condition['page'])?'':$condition['page'];

        if($type){
            $result = $this->table($param['table'])->field($param['field'])->join($join)->$on($on)->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->find();
        }else{
            $result = $this->table($param['table'])->field($param['field'])->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->select();
        }
        return $result;
    }


    /*搜索所有订单*/
    public function sel($condition='',$type=''){
        $param  = array();
        $param['table'] = 'lepai_order';
        $param['field'] = '*,(SELECT G_Name FROM shop_lepai_admin_goods WHERE shop_lepai_order.lepai_goods_id=shop_lepai_admin_goods.G_Id LIMIT 1) AS G_Name ,
        (SELECT G_MainImg FROM shop_lepai_admin_goods WHERE shop_lepai_order.lepai_goods_id=shop_lepai_admin_goods.G_Id LIMIT 1) AS G_MainImg';
        $param['where'] = '';
        $param['order'] = '';
        $param['page']  = '10';
        if(!empty($condition)){
        foreach($condition as $k => $v){
            if($v['1'] == true){
                $param[$k] = $v[0];
            }else{
                $param[$k] = $param[$k].$v[0];
            }
        }
        }
        return $this->father($param,$type);
    }

    /*搜索所有订单*/
    public function selOrder($condition='',$type=''){
        $param  = array();
        $param['table'] = 'lepai_order,lepai_admin_goods,lepai_audit';
        $param['field'] = '*,(SELECT T_Title FROM shop_lepai_admin_theme WHERE shop_lepai_admin_theme.T_Id=lepai_order.lepai_theme_id limit 1) as theme_name,(SELECT type FROM shop_lepai_baoming WHERE shop_lepai_baoming.member_id=lepai_order.buyer_id AND shop_lepai_baoming.auction_id=lepai_order.lepai_goods_id limit 1) as Bao_type,(SELECT amount FROM shop_lepai_baoming WHERE shop_lepai_baoming.member_id=lepai_order.buyer_id AND shop_lepai_baoming.auction_id=lepai_order.lepai_goods_id limit 1) as Bao_amount';
        $param['where'] = '';
        $param['order'] = 'order_id DESC';
        $param['page']  = '10';
        $param['join']  = 'left';
        $param['on']  = 'lepai_order.lepai_goods_id=lepai_admin_goods.G_Id,lepai_order.store_member_id=lepai_audit.member_id';
        if(!empty($condition)){
        foreach($condition as $k => $v){
            if($v['1'] == true){
                $param[$k] = $v[0];
            }else{
                $param[$k] = $param[$k].$v[0];
            }
        }
        }
        return $this->table($param['table'])->field($param['field'])->join($param['join'])->on($param['on'])->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->select();

    }

/**

*/

    /*给订单发货*/
    public function orderPush($id,$array){
        return $this->table('lepai_order')->where("order_id='".$id."'")->update($array);
    }

    /*返回快递公司*/
    public function kuaidi($id){
        if($id){
            return $this->table('express')->where("id='".$id."'")->find();
        }else{
            return $this->table('express')->select();
        }
    }

    /*订单退款*/
    public function order_tuikuan($order_id,$money,$admin_info=''){
        $order_info = $this->table('lepai_order')->where(array('order_id'=>$order_id))->find();

        if($order_info['order_amount'] < $money){
            $data['error'] = true;
            $data['msg'] = '退款金额不可大过订单金额！';
            return $data;
        }

        $this->beginTransaction();
        try{

            // 变更订单
            $order_update['order_state'] = '0';
            $order_update['refund_state'] = 2;
            $order_update['refund_money'] = $money;
            $condition_order['order_id'] = $order_id;
            $order_result = $this->table('lepai_order')->where($condition_order)->update($order_update);

            if (!$order_result) {
                throw new Exception('操作失败！');
            }

            // 变更预存款
            $condition_member['member_id'] = $order_info['buyer_id'];
            $member_update['available_predeposit'] = array('exp','available_predeposit+'.$money);
            $member_result = $this->table('member')->where($condition_member)->update($member_update);

            if (!$member_result) {
                throw new Exception('操作失败！');
            }

            // 记录Log
            $Log['lg_member_id'] = $order_info['buyer_id'];
            $Log['lg_member_name'] = $order_info['buyer_name'];
            $Log['lg_admin_name'] = $admin_info['name'];
            $Log['lg_type'] = 'refund';
            $Log['lg_av_amount'] = $money;
            $Log['lg_freeze_amount'] = '0';
            $Log['lg_add_time'] = time();
            $Log['lg_desc'] = '确认退款，拍卖惠订单号: '.$order_info['order_sn'];
            $Log_result = $this->table('pd_log')->insert($Log);

            if (!$Log_result) {
                throw new Exception('操作失败！');
            }

            $this->commit();

            $data['error'] = false;
            $data['msg'] = '操作成功！';
            return $data;
            
        }catch(Exception $e) {

            $this->rollback();

            $data['error'] = true;
            $data['msg'] = '操作失败！';
            return $data;

        }


    }




}
