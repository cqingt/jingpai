<?php
/**
 * 会员中心——积分兑换订单
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_integralControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 我的商城
     */
    public function orderOp() {

        $where['point_buyerid'] = $_SESSION['member_id'];
        
        $model_pointorder = Model('pointorder');
        $order_list = $model_pointorder->getPointOrderList($where, '*', 10, 0, 'point_orderid desc');

        $order_idarr = array();
        $order_listnew = array();
        if (is_array($order_list) && count($order_list)>0){
            foreach ($order_list as $k => $v){
                $order_listnew[$v['point_orderid']] = $v;
                $order_idarr[] = $v['point_orderid'];
            }
        }
        
        //查询兑换商品
        if (is_array($order_idarr) && count($order_idarr)>0){
            $prod_list = $model_pointorder->getPointOrderGoodsList(array('point_orderid'=>array('in',$order_idarr)));
            if (is_array($prod_list) && count($prod_list)>0){
                foreach ($prod_list as $v){
                    if (isset($order_listnew[$v['point_orderid']])){
                        $order_listnew[$v['point_orderid']]['prodlist'][] = $v;
                    }
                }
            }
        }

        //信息输出
        Tpl::output('order_list',$order_listnew);

        Tpl::output('show_page',$model_pointorder->showpage(88));

        Tpl::output('nav_title','积分兑换订单');

        Tpl::output('html_title','积分兑换订单 - 会员中心 - 收藏天下');

        Tpl::showpage('member_integral_order.list');
    }



    /**
     *  取消兑换
     */
    public function del_orderOp(){
        $model_pointorder = Model('pointorder');
        //取消订单
        $data = $model_pointorder->cancelPointOrder($_GET['order_id'],$_SESSION['member_id']);
        if ($data['state']){
            showWapMessage('成功取消该订单');
        }else {
            showWapMessage($data['msg'],'','error');
        }
    }







}
